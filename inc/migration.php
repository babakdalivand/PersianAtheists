<?php
/**
 * PA Migration Tool
 */
if ( ! defined('ABSPATH') ) exit;

add_action('admin_menu', function() {
    add_menu_page(
        'مهاجرت محتوا',
        'مهاجرت محتوا',
        'manage_options',
        'pa-migration',
        'pa_migration_page',
        'dashicons-migrate',
        30
    );
});

add_action('admin_init', function() {
    if ( ! current_user_can('manage_options') ) return;
    if ( empty($_POST['pa_migration_nonce']) ) return;
    if ( ! wp_verify_nonce($_POST['pa_migration_nonce'], 'pa_migration_action') ) wp_die('Security error');

    $action = sanitize_key($_POST['pa_action'] ?? '');

    if ( $action === 'update_single' ) {
        $post_id  = absint($_POST['post_id'] ?? 0);
        $new_lang = sanitize_key($_POST['new_lang'] ?? '');
        $new_type = sanitize_key($_POST['new_type'] ?? '');
        if ( $post_id ) {
            if ( $new_lang === '' ) delete_post_meta($post_id, 'pa_lang');
            elseif ( in_array($new_lang, ['fa','en'], true) ) update_post_meta($post_id, 'pa_lang', $new_lang);
            if ( in_array($new_type, ['post','pa_video','pa_podcast','pa_short','pa_book'], true) )
                wp_update_post(['ID' => $post_id, 'post_type' => $new_type]);
        }
        wp_redirect(admin_url('admin.php?page=pa-migration&msg=updated'));
        exit;
    }

    if ( $action === 'bulk_lang' ) {
        $lang      = sanitize_key($_POST['bulk_lang_value'] ?? 'fa');
        $post_type = sanitize_key($_POST['bulk_lang_type'] ?? 'all');
        $only_miss = ! empty($_POST['only_missing']);
        $args = [
            'post_type'      => $post_type === 'all' ? ['post','pa_video','pa_podcast','pa_short','pa_book'] : [$post_type],
            'posts_per_page' => -1, 'post_status' => 'any', 'fields' => 'ids',
        ];
        if ( $only_miss ) $args['meta_query'] = [['key'=>'pa_lang','compare'=>'NOT EXISTS']];
        $ids = get_posts($args);
        foreach ( $ids as $id ) update_post_meta($id, 'pa_lang', $lang);
        wp_redirect(admin_url('admin.php?page=pa-migration&msg=bulk&n=' . count($ids)));
        exit;
    }

    if ( $action === 'autofix_types' ) {
        $posts = get_posts(['post_type'=>'post','posts_per_page'=>-1,'post_status'=>'any']);
        $fixed = 0;
        foreach ( $posts as $p ) {
            $yt_id   = get_post_meta($p->ID, 'pa_youtube_id', true);
            $pod_url = get_post_meta($p->ID, 'pa_podcast_url', true);
            $has_yt  = $yt_id || strpos($p->post_content, 'youtube.com/embed') !== false;
            $has_aud = $pod_url || strpos($p->post_content, '<audio') !== false;
            if ( $has_yt ) {
                wp_update_post(['ID'=>$p->ID,'post_type'=>'pa_video']);
                if ( ! $yt_id ) {
                    preg_match('/youtube\.com\/embed\/([A-Za-z0-9_-]{11})/', $p->post_content, $m);
                    if ( $m ) update_post_meta($p->ID, 'pa_youtube_id', $m[1]);
                }
                $fixed++;
            } elseif ( $has_aud ) {
                wp_update_post(['ID'=>$p->ID,'post_type'=>'pa_podcast']);
                $fixed++;
            }
        }
        wp_redirect(admin_url('admin.php?page=pa-migration&msg=autofix&n=' . $fixed));
        exit;
    }
});

function pa_migration_page() {
    $type_labels = ['post'=>'مقاله','pa_video'=>'ویدیو','pa_podcast'=>'پادکست','pa_short'=>'ویدئو کوتاه','pa_book'=>'کتاب'];
    $posts = get_posts([
        'post_type'      => array_keys($type_labels),
        'posts_per_page' => -1,
        'post_status'    => ['publish','draft','pending','future'],
        'orderby'        => 'date', 'order' => 'DESC',
    ]);
    $no_lang = count(array_filter($posts, fn($p) => ! get_post_meta($p->ID,'pa_lang',true)));
    $has_fa  = count(array_filter($posts, fn($p) => get_post_meta($p->ID,'pa_lang',true)==='fa'));
    $has_en  = count(array_filter($posts, fn($p) => get_post_meta($p->ID,'pa_lang',true)==='en'));
    $msg     = $_GET['msg'] ?? '';
    $n       = absint($_GET['n'] ?? 0);
    ?>
    <div class="wrap">
    <h1 class="wp-heading-inline">مهاجرت محتوا</h1>
    <hr class="wp-header-end">

    <?php if ($msg==='updated'): ?><div class="notice notice-success is-dismissible"><p>پست بروزرسانی شد.</p></div>
    <?php elseif($msg==='bulk'):  ?><div class="notice notice-success is-dismissible"><p><?=$n?> پست بروزرسانی شد.</p></div>
    <?php elseif($msg==='autofix'):?><div class="notice notice-success is-dismissible"><p>نوع <?=$n?> پست اصلاح شد.</p></div>
    <?php endif; ?>

    <p>
        <strong>کل:</strong> <?=count($posts)?> &nbsp;|&nbsp;
        <strong style="color:#b45309;">بدون زبان:</strong> <?=$no_lang?> &nbsp;|&nbsp;
        <strong style="color:#15803d;">فارسی (FA):</strong> <?=$has_fa?> &nbsp;|&nbsp;
        <strong style="color:#1d4ed8;">انگلیسی (EN):</strong> <?=$has_en?>
    </p>

    <table class="form-table" style="max-width:700px;">
        <tr>
            <th scope="row">تنظیم زبان گروهی</th>
            <td>
                <form method="post" style="display:inline-flex;gap:8px;align-items:center;flex-wrap:wrap;">
                    <?php wp_nonce_field('pa_migration_action','pa_migration_nonce'); ?>
                    <input type="hidden" name="pa_action" value="bulk_lang">
                    <select name="bulk_lang_type">
                        <option value="all">همه انواع</option>
                        <?php foreach($type_labels as $v=>$l): ?><option value="<?=$v?>"><?=$l?></option><?php endforeach; ?>
                    </select>
                    <select name="bulk_lang_value">
                        <option value="fa">FA فارسی</option>
                        <option value="en">EN انگلیسی</option>
                    </select>
                    <label><input type="checkbox" name="only_missing" value="1" checked> فقط بدون زبان</label>
                    <input type="submit" class="button button-primary" value="اعمال">
                </form>
            </td>
        </tr>
        <tr>
            <th scope="row">تشخیص خودکار نوع</th>
            <td>
                <form method="post" style="display:inline;">
                    <?php wp_nonce_field('pa_migration_action','pa_migration_nonce'); ?>
                    <input type="hidden" name="pa_action" value="autofix_types">
                    <input type="submit" class="button button-secondary"
                        value="اجرا: مقاله‌های یوتیوب/پادکست تشخیص داده شوند"
                        onclick="return confirm('ادامه؟')">
                </form>
                <p class="description">پست‌های مقاله که محتوای یوتیوب دارند &rarr; ویدیو &nbsp;|&nbsp; محتوای صوتی &rarr; پادکست</p>
            </td>
        </tr>
    </table>

    <h2>لیست پست‌ها</h2>
    <table class="wp-list-table widefat fixed striped posts">
        <thead>
            <tr>
                <th scope="col" style="width:50px;">ID</th>
                <th scope="col">عنوان</th>
                <th scope="col" style="width:100px;">نوع</th>
                <th scope="col" style="width:100px;">زبان</th>
                <th scope="col" style="width:320px;">ویرایش سریع</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $p):
            $cur_lang = get_post_meta($p->ID,'pa_lang',true);
            $cur_type = $p->post_type;
            $warn     = ! $cur_lang ? 'style="background:#fffbeb;"' : '';
        ?>
        <tr <?=$warn?>>
            <td><?=$p->ID?></td>
            <td>
                <strong><?=esc_html($p->post_title ?: '(بدون عنوان)')?></strong><br>
                <small style="color:#999;"><?=esc_html(get_the_date('Y/m/d',$p->ID))?> &mdash; <?=$p->post_status==='publish'?'منتشر':'پیش‌نویس'?></small>
            </td>
            <td><?=$type_labels[$cur_type]??$cur_type?></td>
            <td>
                <?php if($cur_lang==='fa'): ?><span style="color:#15803d;font-weight:700;">FA فارسی</span>
                <?php elseif($cur_lang==='en'): ?><span style="color:#1d4ed8;font-weight:700;">EN انگلیسی</span>
                <?php else: ?><span style="color:#b45309;font-weight:700;">--- ندارد</span>
                <?php endif; ?>
            </td>
            <td>
                <form method="post" style="display:flex;gap:4px;align-items:center;">
                    <?php wp_nonce_field('pa_migration_action','pa_migration_nonce'); ?>
                    <input type="hidden" name="pa_action" value="update_single">
                    <input type="hidden" name="post_id" value="<?=$p->ID?>">
                    <select name="new_lang" style="font-size:12px;">
                        <option value="" <?=selected($cur_lang,'',false)?>>--- زبان</option>
                        <option value="fa" <?=selected($cur_lang,'fa',false)?>>FA فارسی</option>
                        <option value="en" <?=selected($cur_lang,'en',false)?>>EN انگلیسی</option>
                    </select>
                    <select name="new_type" style="font-size:12px;">
                        <?php foreach($type_labels as $v=>$l): ?>
                        <option value="<?=$v?>" <?=selected($cur_type,$v,false)?>><?=$l?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" class="button button-small" value="ذخیره">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php
}
