<?php
/**
 * Search Results — with content-type filters
 */

$search_query = get_search_query();
$allowed_types = ['', 'post', 'pa_video', 'pa_podcast', 'pa_short', 'pa_book'];
$active_type   = isset($_GET['type']) ? sanitize_key($_GET['type']) : '';
if (!in_array($active_type, $allowed_types)) $active_type = '';

$type_labels = [
    ''           => ['label' => 'همه',          'icon' => '🔍'],
    'post'       => ['label' => 'مقاله',         'icon' => '📝'],
    'pa_video'   => ['label' => 'ویدیو',         'icon' => '📹'],
    'pa_podcast' => ['label' => 'پادکست',        'icon' => '🎙️'],
    'pa_short'   => ['label' => 'ویدیوی کوتاه', 'icon' => '⚡'],
    'pa_book'    => ['label' => 'کتاب',          'icon' => '📚'],
];

/* ── Count per type ── */
$counts = [];
foreach (array_filter(array_keys($type_labels)) as $pt) {
    $q = new WP_Query([
        's'              => $search_query,
        'post_type'      => $pt,
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'no_found_rows'  => false,
    ]);
    $counts[$pt] = $q->found_posts;
    wp_reset_postdata();
}
$counts[''] = array_sum($counts);

/* ── Main query ── */
$paged = max(1, get_query_var('paged'));
$args  = [
    's'              => $search_query,
    'post_type'      => $active_type !== '' ? $active_type : array_keys(array_filter($type_labels, fn($k) => $k !== '', ARRAY_FILTER_USE_KEY)),
    'posts_per_page' => 12,
    'paged'          => $paged,
];
if ($active_type === '') $args['post_type'] = ['post','pa_video','pa_podcast','pa_short','pa_book'];

$search_results = new WP_Query($args);

get_header();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">

    <!-- HERO -->
    <div class="archive-hero">
        <div class="archive-hero-inner">
            <div class="archive-label">🔍 جستجو</div>
            <h1 class="archive-title">
                نتایج برای: <em style="color:var(--accent);"><?php echo esc_html($search_query); ?></em>
            </h1>
            <p class="archive-desc"><?php echo number_format_i18n($counts['']); ?> نتیجه یافت شد</p>
        </div>
    </div>

    <!-- SEARCH BAR -->
    <div style="max-width:640px;margin:24px auto;">
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form" style="display:flex;gap:8px;">
            <input type="search" name="s"
                   value="<?php echo esc_attr($search_query); ?>"
                   placeholder="جستجو در همه محتوا..."
                   class="form-control search-input"
                   style="flex:1;padding:10px 16px;border-radius:var(--radius);border:1px solid var(--border);background:var(--surface);color:var(--text);font-family:inherit;font-size:15px;"
                   autocomplete="off">
            <?php if ($active_type): ?>
                <input type="hidden" name="type" value="<?php echo esc_attr($active_type); ?>">
            <?php endif; ?>
            <button type="submit" class="btn btn-primary" style="padding:10px 20px;border-radius:var(--radius);white-space:nowrap;">جستجو</button>
        </form>
    </div>

    <!-- TYPE FILTER TABS -->
    <div class="pa-search-tabs" style="display:flex;gap:8px;flex-wrap:wrap;justify-content:center;margin:24px 0 32px;">
        <?php foreach ($type_labels as $type => $info):
            $is_active = ($type === $active_type);
            $count     = $counts[$type] ?? 0;
            $url       = add_query_arg(['s' => $search_query, 'type' => $type], home_url('/'));
            if ($type === '') $url = add_query_arg('s', $search_query, home_url('/'));
        ?>
            <a href="<?php echo esc_url($url); ?>"
               class="pa-tab-btn<?php echo $is_active ? ' pa-tab-active' : ''; ?>"
               style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:20px;border:1px solid <?php echo $is_active ? 'var(--accent)' : 'var(--border)'; ?>;background:<?php echo $is_active ? 'var(--accent)' : 'var(--surface)'; ?>;color:<?php echo $is_active ? '#fff' : 'var(--text)'; ?>;text-decoration:none;font-size:13px;font-weight:<?php echo $is_active ? '700' : '500'; ?>;transition:var(--transition);">
                <span><?php echo $info['icon']; ?></span>
                <span><?php echo $info['label']; ?></span>
                <span style="background:<?php echo $is_active ? 'rgba(255,255,255,0.25)' : 'var(--bg)'; ?>;padding:1px 7px;border-radius:10px;font-size:11px;"><?php echo number_format_i18n($count); ?></span>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- RESULTS -->
    <?php if ($search_results->have_posts()): ?>

        <div class="pa-search-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:var(--card-gap);">
            <?php while ($search_results->have_posts()): $search_results->the_post();
                $pt = get_post_type();
            ?>

                <?php if ($pt === 'pa_video' || $pt === 'pa_short'): ?>
                    <?php
                    $yt_id    = pa_get_youtube_id();
                    $duration = get_post_meta(get_the_ID(), 'pa_duration', true);
                    ?>
                    <a href="<?php the_permalink(); ?>" class="media-card media-card-link" style="text-decoration:none;display:block;">
                        <div class="media-thumb">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('pa-card', ['alt' => get_the_title()]); ?>
                            <?php elseif ($yt_id): ?>
                                <img src="https://img.youtube.com/vi/<?php echo esc_attr($yt_id); ?>/hqdefault.jpg" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                                <div style="height:100%;background:var(--surface);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:36px;">▶</div>
                            <?php endif; ?>
                            <?php if ($duration): ?><span class="media-duration"><?php echo esc_html($duration); ?></span><?php endif; ?>
                            <div class="play-overlay"><div class="play-circle"><svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><polygon points="5 3 19 12 5 21 5 3"/></svg></div></div>
                            <span style="position:absolute;top:8px;right:8px;background:<?php echo $pt === 'pa_short' ? '#8b5cf6' : '#ef4444'; ?>;color:#fff;font-size:10px;padding:2px 8px;border-radius:10px;"><?php echo $pt === 'pa_short' ? '⚡ کوتاه' : '📹 ویدیو'; ?></span>
                        </div>
                        <div class="media-info">
                            <div class="media-title"><?php the_title(); ?></div>
                            <div class="media-meta"><?php echo pa_time_ago(); ?></div>
                        </div>
                    </a>

                <?php elseif ($pt === 'pa_podcast'): ?>
                    <?php
                    $ep  = get_post_meta(get_the_ID(), 'pa_episode_number', true);
                    $dur = get_post_meta(get_the_ID(), 'pa_duration', true);
                    ?>
                    <a href="<?php the_permalink(); ?>" style="text-decoration:none;display:flex;gap:14px;align-items:flex-start;padding:16px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);transition:var(--transition);" class="pa-podcast-row">
                        <div style="width:64px;height:64px;border-radius:12px;overflow:hidden;flex-shrink:0;background:var(--accent);display:flex;align-items:center;justify-content:center;">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('pa-square', ['style' => 'width:64px;height:64px;object-fit:cover;']); ?>
                            <?php else: ?>
                                <span style="font-size:28px;">🎙️</span>
                            <?php endif; ?>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <?php if ($ep): ?><span style="font-size:11px;color:var(--accent);font-weight:700;">قسمت <?php echo esc_html($ep); ?></span><?php endif; ?>
                            <div style="font-size:14px;font-weight:700;color:var(--text);line-height:1.4;margin:4px 0;"><?php the_title(); ?></div>
                            <div style="display:flex;gap:10px;font-size:12px;color:var(--muted);margin-top:6px;">
                                <span>🎙️ پادکست</span>
                                <?php if ($dur): ?><span>⏱ <?php echo esc_html($dur); ?></span><?php endif; ?>
                                <span><?php echo pa_time_ago(); ?></span>
                            </div>
                        </div>
                    </a>

                <?php elseif ($pt === 'pa_book'): ?>
                    <a href="<?php the_permalink(); ?>" style="text-decoration:none;display:flex;gap:14px;align-items:flex-start;padding:16px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);transition:var(--transition);">
                        <div style="width:64px;height:90px;border-radius:8px;overflow:hidden;flex-shrink:0;background:var(--bg);">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('pa-square', ['style' => 'width:64px;height:90px;object-fit:cover;']); ?>
                            <?php else: ?>
                                <div style="width:64px;height:90px;display:flex;align-items:center;justify-content:center;font-size:28px;background:var(--surface);">📚</div>
                            <?php endif; ?>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <span style="font-size:11px;color:var(--accent);font-weight:700;">📚 کتاب</span>
                            <div style="font-size:14px;font-weight:700;color:var(--text);line-height:1.4;margin:4px 0;"><?php the_title(); ?></div>
                            <div style="font-size:12px;color:var(--muted);margin-top:6px;"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></div>
                        </div>
                    </a>

                <?php else: /* post */ ?>
                    <article class="card article-card">
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('pa-card', ['class' => 'card-img', 'alt' => get_the_title()]); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <span style="font-size:11px;color:var(--accent);font-weight:700;margin-bottom:6px;display:block;">📝 مقاله</span>
                            <h2 class="card-title" style="font-size:15px;">
                                <a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a>
                            </h2>
                            <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></p>
                            <div class="card-meta" style="margin-top:10px;">
                                <span><?php the_author(); ?></span>
                                <span>·</span>
                                <span><?php echo pa_time_ago(); ?></span>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>

            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <!-- PAGINATION -->
        <div class="archive-pagination" style="margin-top:40px;">
            <?php
            echo paginate_links([
                'base'      => add_query_arg('paged', '%#%'),
                'format'    => '',
                'current'   => $paged,
                'total'     => $search_results->max_num_pages,
                'prev_text' => '← قبلی',
                'next_text' => 'بعدی →',
                'type'      => 'list',
            ]);
            ?>
        </div>

    <?php else: ?>
        <div style="text-align:center;padding:80px 0;">
            <div style="font-size:64px;margin-bottom:20px;">🔍</div>
            <h2 style="margin-bottom:12px;">نتیجه‌ای یافت نشد</h2>
            <p style="color:var(--muted);margin-bottom:24px;">
                جستجوی «<strong><?php echo esc_html($search_query); ?></strong>» در
                <?php echo $active_type ? $type_labels[$active_type]['label'] : 'همه محتوا'; ?>
                نتیجه‌ای نداشت.
            </p>
            <?php if ($active_type): ?>
                <a href="<?php echo esc_url(add_query_arg('s', $search_query, home_url('/'))); ?>" class="btn btn-primary">جستجو در همه محتوا</a>
            <?php else: ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">بازگشت به خانه</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>
</main>

<style>
.pa-tab-btn:hover { border-color: var(--accent) !important; color: var(--accent) !important; }
.pa-tab-active:hover { color: #fff !important; }
.pa-podcast-row:hover { border-color: var(--accent) !important; }
</style>

<?php get_footer(); ?>
