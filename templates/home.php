<?php
/**
 * Home Page Template — Persian Atheists
 * صفحه اصلی دوزبانه کامل
 */
get_header();

$lang  = pa_current_lang();
$is_en = ($lang === 'en');

// ── Text strings ──────────────────────────────
$t = [
    'hero_badge'      => $is_en ? 'Persian Atheists Network'         : 'شبکه آتئیست‌های ایرانی',
    'hero_title'      => $is_en ? 'Thinking Is Not a Crime'          : 'اندیشیدن جرم نیست',
    'hero_desc'       => $is_en ? 'A safe space for Iranian freethinkers, atheists, agnostics and humanists around the world.' : 'فضایی امن برای آزاداندیشان، آتئیست‌ها، آگنوستیک‌ها و اومانیست‌های ایرانی در سراسر جهان.',
    'hero_btn1'       => $is_en ? 'Join Us'                          : 'عضو شو',
    'hero_btn2'       => $is_en ? 'About RAHA'                       : 'درباره رها',
    'raha_r'          => $is_en ? 'Rationalist'                      : 'عقل‌گرا',
    'raha_a1'         => $is_en ? 'Atheist'                          : 'آتئیست',
    'raha_h'          => $is_en ? 'Humanist'                         : 'اومانیست',
    'raha_a2'         => $is_en ? 'Agnostic'                         : 'آگنوستیک',
    'stat_members'    => $is_en ? 'Active Members'                   : 'عضو فعال',
    'stat_articles'   => $is_en ? 'Articles'                         : 'مقاله',
    'stat_podcasts'   => $is_en ? 'Podcasts'                         : 'پادکست',
    'stat_campaigns'  => $is_en ? 'Campaigns'                        : 'کمپین',
    'filter_all'      => $is_en ? 'All'                              : 'همه',
    'filter_article'  => $is_en ? 'Articles'                         : 'مقالات',
    'filter_video'    => $is_en ? 'Videos'                           : 'ویدیوها',
    'filter_podcast'  => $is_en ? 'Podcasts'                         : 'پادکست‌ها',
    'filter_short'    => $is_en ? 'Shorts'                           : 'شورت‌ها',
    'featured_label'  => $is_en ? '⭐ Featured'                      : '⭐ ویژه',
    'latest_title'    => $is_en ? 'Latest Content'                   : 'آخرین محتوا',
    'latest_more'     => $is_en ? 'See All'                          : 'مشاهده همه',
    'videos_title'    => $is_en ? 'Videos'                           : 'ویدیوها',
    'videos_more'     => $is_en ? 'See All Videos'                   : 'همه ویدیوها',
    'podcasts_title'  => $is_en ? 'Podcasts'                         : 'پادکست‌ها',
    'podcasts_more'   => $is_en ? 'See All Podcasts'                 : 'همه پادکست‌ها',
    'shorts_title'    => $is_en ? 'Shorts'                           : 'شورت‌ها',
    'shorts_more'     => $is_en ? 'See All Shorts'                   : 'همه شورت‌ها',
    'read_more'       => $is_en ? 'Read More'                        : 'ادامه مطلب',
    'watch'           => $is_en ? 'Watch'                            : 'تماشا',
    'listen'          => $is_en ? 'Listen'                           : 'گوش بده',
    'ep'              => $is_en ? 'Ep.'                              : 'پادکست',
    'no_content'      => $is_en ? 'No content yet.'                  : 'هنوز محتوایی اضافه نشده.',
    'min_read'        => $is_en ? 'min read'                         : 'دقیقه مطالعه',
];

// ── Queries ───────────────────────────────────
$featured = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'meta_key'       => 'pa_featured',
    'meta_value'     => '1',
    'post_status'    => 'publish',
]);
if (!$featured->have_posts()) {
    $featured = new WP_Query(['post_type'=>'post','posts_per_page'=>1,'post_status'=>'publish']);
}

$latest_posts = new WP_Query(['post_type'=>'post','posts_per_page'=>6,'post_status'=>'publish','ignore_sticky_posts'=>1]);
$latest_videos = new WP_Query(['post_type'=>'pa_video','posts_per_page'=>4,'post_status'=>'publish']);
$latest_podcasts = new WP_Query(['post_type'=>'pa_podcast','posts_per_page'=>3,'post_status'=>'publish']);
$latest_shorts = new WP_Query(['post_type'=>'pa_short','posts_per_page'=>6,'post_status'=>'publish']);
?>

<main class="site-main" id="main-content">

<!-- ══════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════ -->
<section class="pa-hero">
    <div class="pa-hero-bg"></div>
    <div class="container pa-hero-inner">

        <!-- Left: Text -->
        <div class="pa-hero-text">
            <div class="pa-hero-badge">
                <span class="pa-badge-dot"></span>
                <?php echo esc_html($t['hero_badge']); ?>
            </div>

            <h1 class="pa-hero-title">
                <?php echo esc_html($t['hero_title']); ?>
            </h1>

            <p class="pa-hero-desc">
                <?php echo esc_html($t['hero_desc']); ?>
            </p>

            <!-- RAHA Acronym -->
            <div class="pa-raha-row">
                <div class="pa-raha-letter">
                    <span class="pa-raha-char">R</span>
                    <span class="pa-raha-word"><?php echo esc_html($t['raha_r']); ?></span>
                </div>
                <div class="pa-raha-letter">
                    <span class="pa-raha-char">A</span>
                    <span class="pa-raha-word"><?php echo esc_html($t['raha_a1']); ?></span>
                </div>
                <div class="pa-raha-letter">
                    <span class="pa-raha-char">H</span>
                    <span class="pa-raha-word"><?php echo esc_html($t['raha_h']); ?></span>
                </div>
                <div class="pa-raha-letter">
                    <span class="pa-raha-char">A</span>
                    <span class="pa-raha-word"><?php echo esc_html($t['raha_a2']); ?></span>
                </div>
            </div>

            <div class="pa-hero-btns">
                <a href="<?php echo esc_url(home_url('/membership')); ?>" class="btn btn-primary">
                    <?php echo esc_html($t['hero_btn1']); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn btn-outline-light">
                    <?php echo esc_html($t['hero_btn2']); ?>
                </a>
            </div>
        </div>

        <!-- Right: Featured Post -->
        <div class="pa-hero-featured">
            <?php if($featured->have_posts()): $featured->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="pa-hero-card">
                    <?php if(has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('pa-hero', ['class'=>'pa-hero-card-img', 'alt'=>get_the_title()]); ?>
                    <?php else: ?>
                        <div class="pa-hero-card-placeholder">
                            <span>📰</span>
                        </div>
                    <?php endif; ?>
                    <div class="pa-hero-card-overlay">
                        <span class="pa-hero-card-badge"><?php echo esc_html($t['featured_label']); ?></span>
                        <h2 class="pa-hero-card-title"><?php the_title(); ?></h2>
                        <div class="pa-hero-card-meta">
                            <span><?php the_author(); ?></span>
                            <span>·</span>
                            <span><?php echo pa_reading_time(); ?></span>
                        </div>
                    </div>
                </a>
            <?php wp_reset_postdata(); endif; ?>
        </div>

    </div>
</section>

<!-- ══════════════════════════════════════════
     STATS BAR
══════════════════════════════════════════ -->
<section class="pa-stats">
    <div class="container">
        <div class="pa-stats-grid">
            <div class="pa-stat">
                <div class="pa-stat-num">+5000</div>
                <div class="pa-stat-label"><?php echo esc_html($t['stat_members']); ?></div>
            </div>
            <div class="pa-stat">
                <div class="pa-stat-num">+200</div>
                <div class="pa-stat-label"><?php echo esc_html($t['stat_articles']); ?></div>
            </div>
            <div class="pa-stat">
                <div class="pa-stat-num">+80</div>
                <div class="pa-stat-label"><?php echo esc_html($t['stat_podcasts']); ?></div>
            </div>
            <div class="pa-stat">
                <div class="pa-stat-num">+30</div>
                <div class="pa-stat-label"><?php echo esc_html($t['stat_campaigns']); ?></div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     CONTENT FILTER + LATEST
══════════════════════════════════════════ -->
<section class="pa-latest">
    <div class="container">

        <div class="pa-section-header">
            <h2 class="pa-section-title"><?php echo esc_html($t['latest_title']); ?></h2>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="pa-section-more">
                <?php echo esc_html($t['latest_more']); ?> →
            </a>
        </div>

        <!-- Filter Pills -->
        <div class="pa-filter-row">
            <button class="pa-pill active" data-filter="all"><?php echo esc_html($t['filter_all']); ?></button>
            <button class="pa-pill" data-filter="post"><?php echo esc_html($t['filter_article']); ?></button>
            <button class="pa-pill" data-filter="pa_video"><?php echo esc_html($t['filter_video']); ?></button>
            <button class="pa-pill" data-filter="pa_podcast"><?php echo esc_html($t['filter_podcast']); ?></button>
            <button class="pa-pill" data-filter="pa_short"><?php echo esc_html($t['filter_short']); ?></button>
        </div>

        <!-- Articles Grid -->
        <div class="pa-content-grid" id="pa-content-grid">
            <?php if($latest_posts->have_posts()): while($latest_posts->have_posts()): $latest_posts->the_post(); ?>
                <article class="pa-card" data-type="post">
                    <?php if(has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>" class="pa-card-thumb">
                            <?php the_post_thumbnail('pa-card', ['alt'=>get_the_title()]); ?>
                        </a>
                    <?php else: ?>
                        <a href="<?php the_permalink(); ?>" class="pa-card-thumb pa-card-thumb-placeholder">
                            <span>📰</span>
                        </a>
                    <?php endif; ?>
                    <div class="pa-card-body">
                        <div class="pa-card-meta">
                            <span class="pa-card-type"><?php echo esc_html($is_en ? 'Article' : 'مقاله'); ?></span>
                            <span class="pa-card-date"><?php echo pa_time_ago(); ?></span>
                        </div>
                        <h3 class="pa-card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="pa-card-footer">
                            <span class="pa-card-author"><?php the_author(); ?></span>
                            <span class="pa-card-read"><?php echo pa_reading_time(); ?></span>
                        </div>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>

    </div>
</section>

<!-- ══════════════════════════════════════════
     VIDEOS SECTION
══════════════════════════════════════════ -->
<?php if($latest_videos->have_posts()): ?>
<section class="pa-media-section">
    <div class="container">
        <div class="pa-section-header">
            <h2 class="pa-section-title">
                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20" style="color:var(--accent)"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                <?php echo esc_html($t['videos_title']); ?>
            </h2>
            <a href="<?php echo esc_url(home_url('/videos')); ?>" class="pa-section-more">
                <?php echo esc_html($t['videos_more']); ?> →
            </a>
        </div>

        <div class="pa-media-grid">
            <?php while($latest_videos->have_posts()): $latest_videos->the_post();
                $yt_id = pa_get_youtube_id();
                $dur   = get_post_meta(get_the_ID(), 'pa_duration', true);
            ?>
                <a href="<?php the_permalink(); ?>" class="pa-media-card">
                    <div class="pa-media-thumb">
                        <?php if($yt_id): ?>
                            <img src="https://img.youtube.com/vi/<?php echo esc_attr($yt_id); ?>/mqdefault.jpg"
                                 alt="<?php the_title_attribute(); ?>"
                                 loading="lazy">
                        <?php elseif(has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('pa-card', ['loading'=>'lazy']); ?>
                        <?php else: ?>
                            <div class="pa-media-placeholder">▶</div>
                        <?php endif; ?>
                        <div class="pa-media-play">
                            <svg viewBox="0 0 24 24" fill="white" width="22" height="22"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <?php if($dur): ?>
                            <span class="pa-media-dur"><?php echo esc_html($dur); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="pa-media-info">
                        <div class="pa-media-title"><?php the_title(); ?></div>
                        <div class="pa-media-meta"><?php echo pa_time_ago(); ?></div>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════
     PODCASTS SECTION
══════════════════════════════════════════ -->
<?php if($latest_podcasts->have_posts()): ?>
<section class="pa-media-section pa-bg-alt">
    <div class="container">
        <div class="pa-section-header">
            <h2 class="pa-section-title">
                🎙️ <?php echo esc_html($t['podcasts_title']); ?>
            </h2>
            <a href="<?php echo esc_url(home_url('/podcasts')); ?>" class="pa-section-more">
                <?php echo esc_html($t['podcasts_more']); ?> →
            </a>
        </div>

        <div class="pa-podcast-list">
            <?php while($latest_podcasts->have_posts()): $latest_podcasts->the_post();
                $ep_num = get_post_meta(get_the_ID(), 'pa_episode_number', true);
                $dur    = get_post_meta(get_the_ID(), 'pa_duration', true);
                $audio  = get_post_meta(get_the_ID(), 'pa_audio_url', true);
            ?>
                <div class="pa-podcast-item">
                    <div class="pa-podcast-cover">
                        <?php if(has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('pa-square', ['loading'=>'lazy']); ?>
                        <?php else: ?>
                            <div class="pa-podcast-cover-placeholder">🎙️</div>
                        <?php endif; ?>
                    </div>
                    <div class="pa-podcast-info">
                        <?php if($ep_num): ?>
                            <div class="pa-podcast-ep"><?php echo esc_html($t['ep']); ?> <?php echo esc_html($ep_num); ?></div>
                        <?php endif; ?>
                        <h3 class="pa-podcast-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="pa-podcast-meta">
                            <span><?php the_author(); ?></span>
                            <?php if($dur): ?><span>· 🕐 <?php echo esc_html($dur); ?></span><?php endif; ?>
                            <span>· <?php echo pa_time_ago(); ?></span>
                        </div>
                        <?php if($audio): ?>
                            <audio controls class="pa-podcast-player" preload="none">
                                <source src="<?php echo esc_url($audio); ?>" type="audio/mpeg">
                            </audio>
                        <?php endif; ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="pa-podcast-link">
                        <?php echo esc_html($t['listen']); ?> →
                    </a>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════
     SHORTS SECTION
══════════════════════════════════════════ -->
<?php if($latest_shorts->have_posts()): ?>
<section class="pa-media-section">
    <div class="container">
        <div class="pa-section-header">
            <h2 class="pa-section-title">
                📱 <?php echo esc_html($t['shorts_title']); ?>
            </h2>
            <a href="<?php echo esc_url(home_url('/shorts')); ?>" class="pa-section-more">
                <?php echo esc_html($t['shorts_more']); ?> →
            </a>
        </div>

        <div class="pa-shorts-grid">
            <?php while($latest_shorts->have_posts()): $latest_shorts->the_post();
                $yt_id = pa_get_youtube_id();
                $dur   = get_post_meta(get_the_ID(), 'pa_duration', true);
            ?>
                <a href="<?php the_permalink(); ?>" class="pa-short-card">
                    <div class="pa-short-thumb">
                        <?php if($yt_id): ?>
                            <img src="https://img.youtube.com/vi/<?php echo esc_attr($yt_id); ?>/mqdefault.jpg"
                                 alt="<?php the_title_attribute(); ?>"
                                 loading="lazy">
                        <?php elseif(has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('pa-square', ['loading'=>'lazy']); ?>
                        <?php else: ?>
                            <div class="pa-media-placeholder">📱</div>
                        <?php endif; ?>
                        <div class="pa-media-play pa-play-sm">
                            <svg viewBox="0 0 24 24" fill="white" width="16" height="16"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <?php if($dur): ?>
                            <span class="pa-media-dur"><?php echo esc_html($dur); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="pa-short-title"><?php the_title(); ?></div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

</main>

<!-- Filter JS -->
<script>
document.querySelectorAll('.pa-pill').forEach(function(pill) {
    pill.addEventListener('click', function() {
        document.querySelectorAll('.pa-pill').forEach(function(p){ p.classList.remove('active'); });
        this.classList.add('active');
        var filter = this.dataset.filter;
        document.querySelectorAll('.pa-card').forEach(function(card) {
            if (filter === 'all' || card.dataset.type === filter) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>

<?php get_footer(); ?>
