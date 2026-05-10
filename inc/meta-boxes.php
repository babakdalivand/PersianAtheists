<?php
/**
 * Custom Meta Boxes for Videos, Podcasts, Shorts
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ============================================
   REGISTER META BOXES
   ============================================ */
function pa_register_meta_boxes() {

    // Video meta box
    add_meta_box(
        'pa_video_meta',
        '📹 اطلاعات ویدیو',
        'pa_video_meta_cb',
        'pa_video',
        'normal',
        'high'
    );

    // Podcast meta box
    add_meta_box(
        'pa_podcast_meta',
        '🎙️ اطلاعات پادکست',
        'pa_podcast_meta_cb',
        'pa_podcast',
        'normal',
        'high'
    );

    // Short meta box
    add_meta_box(
        'pa_short_meta',
        '📱 اطلاعات شورت',
        'pa_short_meta_cb',
        'pa_short',
        'normal',
        'high'
    );

    // Post featured meta box
    add_meta_box(
        'pa_post_meta',
        '⭐ تنظیمات پست',
        'pa_post_meta_cb',
        'post',
        'side',
        'high'
    );

    // Member application meta box (read-only)
    add_meta_box(
        'pa_member_app_meta',
        '👤 جزئیات درخواست عضویت',
        'pa_member_app_meta_cb',
        'pa_member_app',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'pa_register_meta_boxes' );

/* ============================================
   VIDEO META BOX
   ============================================ */
function pa_video_meta_cb( $post ) {
    wp_nonce_field( 'pa_meta_save', 'pa_meta_nonce' );
    $yt_id    = get_post_meta( $post->ID, 'pa_youtube_id', true );
    $duration = get_post_meta( $post->ID, 'pa_duration', true );
    ?>
    <table class="form-table" style="width:100%;">
        <tr>
            <th style="width:160px;padding:10px 0;"><label for="pa_youtube_id">شناسه یوتیوب</label></th>
            <td>
                <input type="text" id="pa_youtube_id" name="pa_youtube_id" value="<?php echo esc_attr($yt_id); ?>" class="regular-text" placeholder="مثال: dQw4w9WgXcQ">
                <p class="description">شناسه ویدیو از URL یوتیوب (بخش بعد از ?v=)</p>
                <?php if ($yt_id): ?>
                    <img src="https://img.youtube.com/vi/<?php echo esc_attr($yt_id); ?>/mqdefault.jpg" style="margin-top:8px;border-radius:6px;max-width:240px;" alt="YouTube Thumbnail">
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th style="padding:10px 0;"><label for="pa_duration">مدت زمان</label></th>
            <td>
                <input type="text" id="pa_duration" name="pa_duration" value="<?php echo esc_attr($duration); ?>" class="small-text" placeholder="مثال: 12:34">
                <p class="description">فرمت: دقیقه:ثانیه یا ساعت:دقیقه:ثانیه</p>
            </td>
        </tr>
    </table>
    <?php
}

/* ============================================
   PODCAST META BOX
   ============================================ */
function pa_podcast_meta_cb( $post ) {
    wp_nonce_field( 'pa_meta_save', 'pa_meta_nonce' );
    $ep_num    = get_post_meta( $post->ID, 'pa_episode_number', true );
    $duration  = get_post_meta( $post->ID, 'pa_duration', true );
    $audio_url = get_post_meta( $post->ID, 'pa_audio_url', true );
    $anchor    = get_post_meta( $post->ID, 'pa_anchor_url', true );
    $spotify   = get_post_meta( $post->ID, 'pa_spotify_url', true );
    ?>
    <table class="form-table">
        <tr>
            <th style="width:160px;padding:8px 0;"><label for="pa_episode_number">شماره اپیزود</label></th>
            <td><input type="number" id="pa_episode_number" name="pa_episode_number" value="<?php echo esc_attr($ep_num); ?>" class="small-text" min="1" placeholder="۱"></td>
        </tr>
        <tr>
            <th style="padding:8px 0;"><label for="pa_duration">مدت زمان</label></th>
            <td><input type="text" id="pa_duration" name="pa_duration" value="<?php echo esc_attr($duration); ?>" class="small-text" placeholder="۴۵:۳۰"></td>
        </tr>
        <tr>
            <th style="padding:8px 0;"><label for="pa_audio_url">لینک فایل صوتی (MP3)</label></th>
            <td><input type="url" id="pa_audio_url" name="pa_audio_url" value="<?php echo esc_attr($audio_url); ?>" class="large-text"></td>
        </tr>
        <tr>
            <th style="padding:8px 0;"><label for="pa_anchor_url">لینک Anchor/Spotify</label></th>
            <td><input type="url" id="pa_anchor_url" name="pa_anchor_url" value="<?php echo esc_attr($anchor); ?>" class="large-text" placeholder="https://anchor.fm/..."></td>
        </tr>
        <tr>
            <th style="padding:8px 0;"><label for="pa_spotify_url">لینک Spotify</label></th>
            <td><input type="url" id="pa_spotify_url" name="pa_spotify_url" value="<?php echo esc_attr($spotify); ?>" class="large-text" placeholder="https://open.spotify.com/..."></td>
        </tr>
    </table>
    <?php
}

/* ============================================
   SHORTS META BOX
   ============================================ */
function pa_short_meta_cb( $post ) {
    wp_nonce_field( 'pa_meta_save', 'pa_meta_nonce' );
    $yt_id    = get_post_meta( $post->ID, 'pa_youtube_id', true );
    $duration = get_post_meta( $post->ID, 'pa_duration', true );
    ?>
    <table class="form-table">
        <tr>
            <th style="width:160px;padding:8px 0;"><label for="pa_youtube_id">شناسه شورت یوتیوب</label></th>
            <td>
                <input type="text" id="pa_youtube_id" name="pa_youtube_id" value="<?php echo esc_attr($yt_id); ?>" class="regular-text" placeholder="شناسه از URL Shorts">
            </td>
        </tr>
        <tr>
            <th style="padding:8px 0;"><label for="pa_duration">مدت زمان</label></th>
            <td><input type="text" id="pa_duration" name="pa_duration" value="<?php echo esc_attr($duration); ?>" class="small-text" placeholder="۰:۵۹"></td>
        </tr>
    </table>
    <?php
}

/* ============================================
   POST META BOX (Featured Flag)
   ============================================ */
function pa_post_meta_cb( $post ) {
    wp_nonce_field( 'pa_meta_save', 'pa_meta_nonce' );
    $featured    = get_post_meta( $post->ID, 'pa_featured', true );
    $recommended = get_post_meta( $post->ID, 'pa_recommended', true );
    ?>
    <p>
        <label>
            <input type="checkbox" name="pa_featured" value="1" <?php checked('1', $featured); ?>>
            ⭐ مقاله ویژه (نمایش در هرو)
        </label>
    </p>
    <p>
        <label>
            <input type="checkbox" name="pa_recommended" value="1" <?php checked('1', $recommended); ?>>
            🔥 مقاله منتخب (نمایش در سایدبار)
        </label>
    </p>
    <?php
}

/* ============================================
   MEMBER APPLICATION META BOX (Read-Only)
   ============================================ */
function pa_member_app_meta_cb( $post ) {
    $fields = [
        'pa_full_name'   => 'نام کامل',
        'pa_username'    => 'نام کاربری',
        'pa_email'       => 'ایمیل',
        'pa_country'     => 'کشور',
        'pa_age'         => 'سن',
        'pa_social_link' => 'لینک شبکه اجتماعی',
        'pa_introduction'=> 'معرفی',
        'pa_experience'  => 'تجربه',
        'pa_id_upload'   => 'تصویر شناسایی',
    ];

    echo '<table class="form-table">';
    foreach ($fields as $key => $label) {
        $val = get_post_meta($post->ID, $key, true);
        if (!$val) continue;
        echo '<tr><th style="width:140px;padding:8px 0;">' . esc_html($label) . '</th><td>';
        if ($key === 'pa_id_upload') {
            echo '<a href="' . esc_url($val) . '" target="_blank" class="button button-small">مشاهده فایل</a>';
        } elseif (strlen($val) > 80) {
            echo '<p style="margin:0;line-height:1.6;">' . esc_html($val) . '</p>';
        } else {
            echo esc_html($val);
        }
        echo '</td></tr>';
    }
    echo '</table>';

    // Status change
    ?>
    <hr>
    <p><strong>تغییر وضعیت درخواست:</strong></p>
    <div style="display:flex;gap:8px;flex-wrap:wrap;">
        <a href="<?php echo wp_nonce_url(add_query_arg(['action'=>'pa_approve_member','post_id'=>$post->ID], admin_url('admin-post.php')), 'pa_approve_'.$post->ID); ?>" class="button button-primary">✅ تأیید عضویت</a>
        <a href="<?php echo wp_nonce_url(add_query_arg(['action'=>'pa_reject_member','post_id'=>$post->ID], admin_url('admin-post.php')), 'pa_reject_'.$post->ID); ?>" class="button button-secondary" style="background:#ef4444;color:#fff;border-color:#ef4444;">❌ رد درخواست</a>
    </div>
    <?php
}

/* ============================================
   SAVE META
   ============================================ */
function pa_save_meta( $post_id ) {
    if ( ! isset( $_POST['pa_meta_nonce'] ) || ! wp_verify_nonce( $_POST['pa_meta_nonce'], 'pa_meta_save' ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [
        'pa_youtube_id', 'pa_duration', 'pa_episode_number',
        'pa_audio_url', 'pa_anchor_url', 'pa_spotify_url',
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }

    // Checkboxes
    update_post_meta($post_id, 'pa_featured',    isset($_POST['pa_featured']) ? '1' : '');
    update_post_meta($post_id, 'pa_recommended', isset($_POST['pa_recommended']) ? '1' : '');
}
add_action('save_post', 'pa_save_meta');

/* ============================================
   APPROVE / REJECT MEMBER APPLICATION
   ============================================ */
function pa_approve_member() {
    if ( ! wp_verify_nonce($_GET['_wpnonce'], 'pa_approve_'.$_GET['post_id']) ) wp_die('Security check failed.');
    if ( ! current_user_can('edit_posts') ) wp_die('Permission denied.');

    $post_id = intval($_GET['post_id']);
    wp_update_post(['ID' => $post_id, 'post_status' => 'publish']);

    // Notify applicant
    $email = get_post_meta($post_id, 'pa_email', true);
    $name  = get_post_meta($post_id, 'pa_full_name', true);
    if ($email) {
        wp_mail($email, 'درخواست عضویت شما تأیید شد', "سلام {$name},\n\nدرخواست عضویت شما در گروه آتئیست‌های ایرانی تأیید شد. به زودی با شما تماس خواهیم گرفت.\n\nبا احترام،\nتیم آتئیست‌های ایرانی");
    }

    wp_redirect(admin_url('edit.php?post_type=pa_member_app&pa_notice=approved'));
    exit;
}
add_action('admin_post_pa_approve_member', 'pa_approve_member');

function pa_reject_member() {
    if ( ! wp_verify_nonce($_GET['_wpnonce'], 'pa_reject_'.$_GET['post_id']) ) wp_die('Security check failed.');
    if ( ! current_user_can('edit_posts') ) wp_die('Permission denied.');

    $post_id = intval($_GET['post_id']);
    wp_update_post(['ID' => $post_id, 'post_status' => 'trash']);

    wp_redirect(admin_url('edit.php?post_type=pa_member_app&pa_notice=rejected'));
    exit;
}
add_action('admin_post_pa_reject_member', 'pa_reject_member');
