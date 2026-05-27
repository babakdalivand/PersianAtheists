<?php
/**
 * Home Page Template — Persian Atheists
 * صفحه اصلی دوزبانه کامل
 */
get_header();

$lang  = pa_current_lang();
$is_en = ($lang === 'en');

$t = [
    'hero_badge'     => $is_en ? 'Persian Atheists Network'      : 'شبکه آتئیست‌های ایرانی',
    'hero_title'     => $is_en ? 'Thinking Is Not a Crime'       : 'اندیشیدن جرم نیست',
    'hero_desc'      => $is_en ? 'A safe space for Iranian freethinkers, atheists, agnostics and humanists around the world.' : 'فضایی امن برای آزاداندیشان، آتئیست‌ها، آگنوستیک‌ها و اومانیست‌های ایرانی در سراسر جهان.',
    'tab_latest'     => $is_en ? 'Latest'                        : 'آخرین‌ها',
    'tab_top'        => $is_en ? 'Top'                           : 'برترین‌ها',
    'raha_r'         => $is_en ? 'Rationalist'                   : 'عقل‌گرا',
    'raha_a1'        => $is_en ? 'Atheist'                       : 'آتئیست',
    'raha_h'         => $is_en ? 'Humanist'                      : 'اومانیست',
    'raha_a2'        => $is_en ? 'Agnostic'                      : 'آگنوستیک',
    'stat_members'   => $is_en ? 'Active Members'                : 'عضو فعال',
    'stat_articles'  => $is_en ? 'Articles'                      : 'مقاله',
    'stat_podcasts'  => $is_en ? 'Podcasts'                      : 'پادکست',
    'stat_campaigns' => $is_en ? 'Campaigns'                     : 'کمپین',
    'filter_all'     => $is_en ? 'All'                           : 'همه',
    'filter_article' => $is_en ? 'Articles'                      : 'مقالات',
    'filter_video'   => $is_en ? 'Videos'                        : 'ویدیوها',
    'filter_podcast' => $is_en ? 'Podcasts'                      : 'پادکست‌ها',
    'filter_short'   => $is_en ? 'Short Videos'                   : 'ویدئوهای کوتاه',
    'latest_title'   => $is_en ? 'Latest Content'                : 'آخرین محتوا',
    'latest_more'    => $is_en ? 'See All'                       : 'مشاهده همه',
    'videos_title'   => $is_en ? 'Videos'                        : 'ویدیوها',
    'videos_more'    => $is_en ? 'See All Videos'                : 'همه ویدیوها',
    'podcasts_title' => $is_en ? 'Podcasts'                      : 'پادکست‌ها',
    'podcasts_more'  => $is_en ? 'See All Podcasts'              : 'همه پادکست‌ها',
    'shorts_title'   => $is_en ? 'Short Videos'                   : 'ویدئوهای کوتاه',
    'shorts_more'    => $is_en ? 'See All Short Videos'          : 'همه ویدئوهای کوتاه',
    'listen'         => $is_en ? 'Listen'                        : 'گوش بده',
    'ep'             => $is_en ? 'Ep.'                           : 'پادکست',
    'min_read'       => $is_en ? 'min read'                      : 'دقیقه مطالعه',
];

// ── Language filter ───────────────────────
// EN: only posts with pa_lang=en
// FA: posts with pa_lang=fa OR posts without pa_lang (legacy)
$lang_meta_query = $is_en
    ? array( array( 'key' => 'pa_lang', 'value' => 'en' ) )
    : array(
        'relation' => 'OR',
        array( 'key' => 'pa_lang', 'value' => 'fa' ),
        array( 'key' => 'pa_lang', 'compare' => 'NOT EXISTS' ),
      );

// ── Hero 4 Posts ──────────────────────────
$hero_4 = new WP_Query(array(
    'post_type'           => array('post','pa_video','pa_podcast','pa_short'),
    'posts_per_page'      => 4,
    'post_status'         => 'publish',
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => 1,
    'meta_query'          => $lang_meta_query,
));

// ── Other Queries ────────────────────────────
$latest_posts    = new WP_Query(array('post_type'=>'post',      'posts_per_page'=>6,'post_status'=>'publish','ignore_sticky_posts'=>1,'meta_query'=>$lang_meta_query));
$latest_videos   = new WP_Query(array('post_type'=>'pa_video',  'posts_per_page'=>4,'post_status'=>'publish','meta_query'=>$lang_meta_query));
$latest_podcasts = new WP_Query(array('post_type'=>'pa_podcast','posts_per_page'=>3,'post_status'=>'publish','meta_query'=>$lang_meta_query));
$latest_shorts   = new WP_Query(array('post_type'=>'pa_short',  'posts_per_page'=>6,'post_status'=>'publish','meta_query'=>$lang_meta_query));

// ── Helpers ──────────────────────────────────
function pa_get_type_label($post_type, $is_en) {
    $labels = array(
        'post'=>$is_en?'Article':'مقاله',
        'pa_video'=>$is_en?'Video':'ویدیو',
        'pa_podcast'=>$is_en?'Podcast':'پادکست',
        'pa_short'=>$is_en?'Short Video':'ویدئو کوتاه',
    );
    return isset($labels[$post_type]) ? $labels[$post_type] : $post_type;
}
function pa_get_slider_thumb($post_id, $post_type) {
    if (in_array($post_type, array('pa_video','pa_short'))) {
        $yt_id = get_post_meta($post_id, 'pa_youtube_id', true);
        if ($yt_id) return '<img src="https://img.youtube.com/vi/'.esc_attr($yt_id).'/maxresdefault.jpg" alt="" loading="lazy" onerror="this.src=\'https://img.youtube.com/vi/'.esc_attr($yt_id).'/mqdefault.jpg\'">';
    }
    if (has_post_thumbnail($post_id)) return get_the_post_thumbnail($post_id, 'pa-hero', array('loading'=>'lazy'));
    $icons = array('post'=>'📰','pa_video'=>'▶','pa_podcast'=>'🎙️','pa_short'=>'📱');
    $icon  = isset($icons[$post_type]) ? $icons[$post_type] : '📄';
    return '<div class="pa-slider-ph"><span>'.$icon.'</span></div>';
}
?>

<main class="site-main" id="main-content">

<style>
/* ══ DARK HEADER ON HOMEPAGE ══ */
body.home .site-header, body.blog .site-header {
    background: #0D0B09;
    border-bottom: none;
    box-shadow: none;
}
body.home .site-header::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 0; right: 0; height: 1px;
    background: rgba(255,252,242,0.05);
    pointer-events: none;
}
body.home .nav-list li a { color: rgba(255,252,242,0.72); }
body.home .nav-list li a:hover,
body.home .nav-list .current-menu-item > a {
    color: var(--accent); background: rgba(235,94,40,0.1);
}
body.home .pa-logo-name { color: #FFFCF2 !important; }
body.home .pa-logo-desc { color: rgba(255,252,242,0.45) !important; }
body.home .icon-btn { border-color: rgba(255,252,242,0.14); color: rgba(255,252,242,0.65); }
body.home .icon-btn:hover { border-color: var(--accent); color: var(--accent); background: rgba(235,94,40,0.1); }
body.home .pa-lang-slider { background: rgba(255,252,242,0.05); border-color: rgba(255,252,242,0.14); }
body.home .pa-lang-flag { filter: grayscale(0.2) opacity(0.75); }
body.home .pa-lang-item.active .pa-lang-flag { filter: grayscale(0) opacity(1); }

/* ══ HERO SPLIT LAYOUT ══ */
.pa-hero-full { background: #1A1714; overflow: hidden; }
.pa-hero-inner {
    display: grid;
    grid-template-columns: 45fr 55fr;
    grid-template-rows: minmax(380px, 1fr);
    /* RTL: اول در DOM = سمت راست. content-col اول → راست، slides-col دوم → چپ */
}

/* ── چپ: اسلاید پست‌ها ── */
.pa-hero-slides-col {
    position: relative;
    overflow: hidden;
    background: #0D0B09;
    border-inline-end: 1px solid rgba(255,252,242,0.06);
    min-height: 380px;
}
.pa-hs-slide {
    position: absolute; inset: 0;
    display: none; text-decoration: none;
}
.pa-hs-slide.active { display: block; }
.pa-hs-bg {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform 6s ease;
}
.pa-hs-slide.active .pa-hs-bg { transform: scale(1.04); }
.pa-hs-ph {
    width: 100%; height: 100%; display: flex;
    align-items: center; justify-content: center;
    background: #111; font-size: 64px;
}
.pa-hs-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top,
        rgba(13,11,9,0.95) 0%, rgba(13,11,9,0.4) 55%, transparent 100%);
}
.pa-hs-info {
    position: absolute; bottom: 0; left: 0; right: 0;
    padding: 20px 22px 18px; z-index: 2;
}
.pa-hs-type {
    display: inline-block; font-size: 10px; font-weight: 800;
    color: var(--accent); background: rgba(235,94,40,0.15);
    border: 1px solid rgba(235,94,40,0.3);
    padding: 2px 8px; border-radius: 10px;
    letter-spacing: .5px; margin-bottom: 7px;
}
.pa-hs-title {
    font-size: clamp(14px,1.5vw,19px); font-weight: 700;
    color: #FFFCF2; line-height: 1.4; margin-bottom: 7px;
    display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
}
.pa-hs-meta { font-size: 12px; color: rgba(255,252,242,0.45); }
.pa-hs-dots {
    position: absolute; bottom: 14px; left: 0; right: 0;
    display: flex; justify-content: center; gap: 6px; z-index: 3;
}
.pa-hs-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: rgba(255,252,242,0.28); border: none; cursor: pointer; padding: 0;
    transition: all .3s;
}
.pa-hs-dot.active { background: var(--accent); width: 20px; border-radius: 4px; }

/* ── راست: فیلسوف + متن + RAHA ── */
.pa-hero-content-col {
    position: relative; overflow: hidden;
    display: flex; align-items: center;
}
.pa-hero-philosopher {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    object-fit: cover; object-position: center top;
    opacity: 0.55; z-index: 0;
}
.pa-hero-content-col::before {
    content: ''; position: absolute; inset: 0; z-index: 1;
    background: linear-gradient(135deg,
        rgba(26,23,20,0.97) 0%, rgba(26,23,20,0.75) 55%, rgba(26,23,20,0.45) 100%);
}
.pa-hero-text {
    position: relative; z-index: 2;
    padding: 40px 36px; width: 100%;
}
.pa-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(235,94,40,0.14); border: 1px solid rgba(235,94,40,0.32);
    border-radius: 20px; padding: 5px 14px; margin-bottom: 16px;
}
.pa-badge-dot {
    width: 7px; height: 7px; background: var(--accent);
    border-radius: 50%; animation: pa-pulse 2s infinite;
}
@keyframes pa-pulse { 0%,100%{opacity:1} 50%{opacity:.35} }
.pa-hero-badge-text { font-size: 12px; font-weight: 700; color: var(--accent); letter-spacing: .5px; }
.pa-hero-title {
    font-size: clamp(22px, 2.6vw, 38px); font-weight: 900;
    color: #FFFCF2; line-height: 1.25; margin-bottom: 10px;
}
.pa-hero-desc {
    font-size: 14px; color: rgba(255,252,242,0.55);
    line-height: 1.7; margin-bottom: 22px;
}
.pa-raha-row { display: flex; gap: 8px; flex-wrap: wrap; }
.pa-raha-letter {
    background: rgba(255,252,242,0.06); border: 1px solid rgba(255,252,242,0.12);
    border-radius: 10px; padding: 9px 14px; min-width: 68px;
    text-align: center; transition: all .2s;
}
.pa-raha-letter:hover { border-color: var(--accent); background: rgba(235,94,40,0.1); }
.pa-raha-char { display: block; font-size: 18px; font-weight: 900; color: var(--accent); margin-bottom: 2px; }
.pa-raha-word { display: block; font-size: 10px; color: rgba(255,252,242,0.5); font-weight: 600; }

@media(max-width:768px){
    .pa-hero-inner { grid-template-columns: 1fr; }
    .pa-hero-slides-col { min-height: 260px; border-inline-end: none; border-bottom: 1px solid rgba(255,252,242,0.06); }
    .pa-hero-content-col::before { background: rgba(26,23,20,0.9); }
}
</style>

<!-- ══════════════════════════════════════════
     HERO — اسلاید چپ | فیلسوف + RAHA راست
══════════════════════════════════════════ -->
<section class="pa-hero-full">
    <div class="pa-hero-inner">

        <!-- DOM اول = سمت راست در RTL: فیلسوف + متن + RAHA -->
        <div class="pa-hero-content-col">
            <img class="pa-hero-philosopher"
                 src="<?php echo esc_url(PA_URI.'/assets/images/hero-philosopher.png'); ?>"
                 alt="" onerror="this.style.display='none'">
            <div class="pa-hero-text">
                <div class="pa-hero-badge">
                    <span class="pa-badge-dot"></span>
                    <span class="pa-hero-badge-text"><?php echo esc_html($t['hero_badge']); ?></span>
                </div>
                <h1 class="pa-hero-title"><?php echo esc_html($t['hero_title']); ?></h1>
                <p class="pa-hero-desc"><?php echo esc_html($t['hero_desc']); ?></p>
                <div class="pa-raha-row">
                    <div class="pa-raha-letter"><span class="pa-raha-char">R</span><span class="pa-raha-word"><?php echo esc_html($t['raha_r']); ?></span></div>
                    <div class="pa-raha-letter"><span class="pa-raha-char">A</span><span class="pa-raha-word"><?php echo esc_html($t['raha_a1']); ?></span></div>
                    <div class="pa-raha-letter"><span class="pa-raha-char">H</span><span class="pa-raha-word"><?php echo esc_html($t['raha_h']); ?></span></div>
                    <div class="pa-raha-letter"><span class="pa-raha-char">A</span><span class="pa-raha-word"><?php echo esc_html($t['raha_a2']); ?></span></div>
                </div>
            </div>
        </div>

        <!-- DOM دوم = سمت چپ در RTL: اسلاید 4 پست -->
        <div class="pa-hero-slides-col" id="paHeroSlider">
            <?php
            $slideIdx = 0;
            if ($hero_4->have_posts()):
                while ($hero_4->have_posts()): $hero_4->the_post();
                    $hid    = get_the_ID();
                    $htype  = get_post_type();
                    $hlabel = pa_get_type_label($htype, $is_en);
                    $hyt    = ($htype==='pa_video'||$htype==='pa_short') ? get_post_meta($hid,'pa_youtube_id',true) : '';
            ?>
            <a href="<?php the_permalink(); ?>" class="pa-hs-slide <?php echo $slideIdx===0?'active':''; ?>">
                <?php if ($hyt): ?>
                    <img class="pa-hs-bg" src="https://img.youtube.com/vi/<?php echo esc_attr($hyt); ?>/maxresdefault.jpg" alt="" loading="lazy" onerror="this.src='https://img.youtube.com/vi/<?php echo esc_attr($hyt); ?>/mqdefault.jpg'">
                <?php elseif (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('large', ['class'=>'pa-hs-bg','loading'=>'lazy']); ?>
                <?php else: ?>
                    <div class="pa-hs-ph"><?php echo $htype==='pa_podcast'?'🎙️':($htype==='pa_short'?'📱':'📰'); ?></div>
                <?php endif; ?>
                <div class="pa-hs-overlay"></div>
                <div class="pa-hs-info">
                    <span class="pa-hs-type"><?php echo esc_html($hlabel); ?></span>
                    <h3 class="pa-hs-title"><?php the_title(); ?></h3>
                    <span class="pa-hs-meta"><?php the_author(); ?> · <?php echo pa_time_ago(); ?></span>
                </div>
            </a>
            <?php $slideIdx++; endwhile; wp_reset_postdata(); endif; ?>
            <div class="pa-hs-dots" id="paHeroDots">
                <?php for ($i=0;$i<$slideIdx;$i++): ?>
                <button class="pa-hs-dot <?php echo $i===0?'active':''; ?>" data-slide="<?php echo $i; ?>"></button>
                <?php endfor; ?>
            </div>
        </div>

    </div>
</section>

<script>
(function(){
    var slides = document.querySelectorAll('#paHeroSlider .pa-hs-slide');
    var dots   = document.querySelectorAll('#paHeroDots .pa-hs-dot');
    if (!slides.length) return;
    var cur = 0;
    function goTo(n) {
        slides[cur].classList.remove('active');
        if (dots[cur]) dots[cur].classList.remove('active');
        cur = (n + slides.length) % slides.length;
        slides[cur].classList.add('active');
        if (dots[cur]) dots[cur].classList.add('active');
    }
    dots.forEach(function(d,i){ d.addEventListener('click',function(e){ e.preventDefault(); goTo(i); }); });
    setInterval(function(){ goTo(cur+1); }, 4500);
})();
</script>


<!-- ══════════════════════════════════════════
     CONTENT FILTER + LATEST
══════════════════════════════════════════ -->
<section class="pa-latest">
    <div class="container">
        <div class="pa-section-header">
            <h2 class="pa-section-title"><?php echo esc_html($t['latest_title']); ?></h2>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="pa-section-more"><?php echo esc_html($t['latest_more']); ?> →</a>
        </div>
        <div class="pa-filter-row">
            <button class="pa-pill active" data-filter="all"><?php echo esc_html($t['filter_all']); ?></button>
            <button class="pa-pill" data-filter="post"><?php echo esc_html($t['filter_article']); ?></button>
            <button class="pa-pill" data-filter="pa_video"><?php echo esc_html($t['filter_video']); ?></button>
            <button class="pa-pill" data-filter="pa_podcast"><?php echo esc_html($t['filter_podcast']); ?></button>
            <button class="pa-pill" data-filter="pa_short"><?php echo esc_html($t['filter_short']); ?></button>
        </div>
        <div class="pa-content-grid" id="pa-content-grid">
            <?php if($latest_posts->have_posts()): while($latest_posts->have_posts()): $latest_posts->the_post(); ?>
                <article class="pa-card" data-type="post">
                    <?php if(has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>" class="pa-card-thumb"><?php the_post_thumbnail('pa-card',['alt'=>get_the_title()]); ?></a>
                    <?php else: ?>
                        <a href="<?php the_permalink(); ?>" class="pa-card-thumb pa-card-thumb-placeholder"><span>📰</span></a>
                    <?php endif; ?>
                    <div class="pa-card-body">
                        <div class="pa-card-meta">
                            <span class="pa-card-type"><?php echo $is_en?'Article':'مقاله'; ?></span>
                            <span class="pa-card-date"><?php echo pa_time_ago(); ?></span>
                        </div>
                        <h3 class="pa-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
     VIDEOS + PODCASTS — کنار هم
══════════════════════════════════════════ -->
<section class="pa-media-duo">
    <div class="container">
    <div class="pa-media-duo-inner">

<!-- ستون ویدیوها -->
<div class="pa-media-duo-col">
<?php if($latest_videos->have_posts()): ?>
<div class="">
        <div class="pa-section-header">
            <h2 class="pa-section-title">
                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20" style="color:var(--accent)"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                <?php echo esc_html($t['videos_title']); ?>
            </h2>
            <a href="<?php echo esc_url(home_url('/videos')); ?>" class="pa-section-more"><?php echo esc_html($t['videos_more']); ?> →</a>
        </div>
        <div class="pa-media-grid">
            <?php while($latest_videos->have_posts()): $latest_videos->the_post();
                $yt_id=pa_get_youtube_id(); $dur=get_post_meta(get_the_ID(),'pa_duration',true);
            ?>
                <a href="<?php the_permalink(); ?>" class="pa-media-card">
                    <div class="pa-media-thumb">
                        <?php if($yt_id): ?><img src="https://img.youtube.com/vi/<?php echo esc_attr($yt_id); ?>/mqdefault.jpg" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php elseif(has_post_thumbnail()): the_post_thumbnail('pa-card',['loading'=>'lazy']);
                        else: ?><div class="pa-media-placeholder">▶</div><?php endif; ?>
                        <div class="pa-media-play"><svg viewBox="0 0 24 24" fill="white" width="22" height="22"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
                        <?php if($dur): ?><span class="pa-media-dur"><?php echo esc_html($dur); ?></span><?php endif; ?>
                    </div>
                    <div class="pa-media-info">
                        <div class="pa-media-title"><?php the_title(); ?></div>
                        <div class="pa-media-meta"><?php echo pa_time_ago(); ?></div>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
<?php endif; ?>
</div><!-- /ستون ویدیوها -->

<!-- ستون پادکست‌ها -->
<div class="pa-media-duo-col">
<?php if($latest_podcasts->have_posts()): ?>
<div class="">
        <div class="pa-section-header">
            <h2 class="pa-section-title">🎙️ <?php echo esc_html($t['podcasts_title']); ?></h2>
            <a href="<?php echo esc_url(home_url('/podcasts')); ?>" class="pa-section-more"><?php echo esc_html($t['podcasts_more']); ?> →</a>
        </div>
        <div class="pa-podcast-list">
            <?php while($latest_podcasts->have_posts()): $latest_podcasts->the_post();
                $ep_num=get_post_meta(get_the_ID(),'pa_episode_number',true);
                $dur=get_post_meta(get_the_ID(),'pa_duration',true);
            ?>
                <div class="pa-podcast-item">
                    <div class="pa-podcast-cover">
                        <?php if(has_post_thumbnail()): the_post_thumbnail('pa-square',['loading'=>'lazy']);
                        else: ?><div class="pa-podcast-cover-placeholder">🎙️</div><?php endif; ?>
                    </div>
                    <div class="pa-podcast-info">
                        <?php if($ep_num): ?><div class="pa-podcast-ep"><?php echo esc_html($t['ep']); ?> <?php echo esc_html($ep_num); ?></div><?php endif; ?>
                        <h3 class="pa-podcast-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="pa-podcast-meta">
                            <span><?php the_author(); ?></span>
                            <?php if($dur): ?><span>· 🕐 <?php echo esc_html($dur); ?></span><?php endif; ?>
                            <span>· <?php echo pa_time_ago(); ?></span>
                        </div>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="pa-podcast-link"><?php echo esc_html($t['listen']); ?> →</a>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
<?php endif; ?>
</div><!-- /ستون پادکست‌ها -->

    </div><!-- /pa-media-duo-inner -->
    </div><!-- /container -->
</section>

<!-- ══════════════════════════════════════════
     SHORTS SECTION
══════════════════════════════════════════ -->
<?php if($latest_shorts->have_posts()): ?>
<section class="pa-media-section">
    <div class="container">
        <div class="pa-section-header">
            <h2 class="pa-section-title">📱 <?php echo esc_html($t['shorts_title']); ?></h2>
            <a href="<?php echo esc_url(home_url('/shorts')); ?>" class="pa-section-more"><?php echo esc_html($t['shorts_more']); ?> →</a>
        </div>
        <div class="pa-shorts-grid">
            <?php while($latest_shorts->have_posts()): $latest_shorts->the_post();
                $yt_id=pa_get_youtube_id(); $dur=get_post_meta(get_the_ID(),'pa_duration',true);
            ?>
                <a href="<?php the_permalink(); ?>" class="pa-short-card">
                    <div class="pa-short-thumb">
                        <?php if($yt_id): ?><img src="https://img.youtube.com/vi/<?php echo esc_attr($yt_id); ?>/mqdefault.jpg" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php elseif(has_post_thumbnail()): the_post_thumbnail('pa-square',['loading'=>'lazy']);
                        else: ?><div class="pa-media-placeholder">📱</div><?php endif; ?>
                        <div class="pa-media-play pa-play-sm"><svg viewBox="0 0 24 24" fill="white" width="16" height="16"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
                        <?php if($dur): ?><span class="pa-media-dur"><?php echo esc_html($dur); ?></span><?php endif; ?>
                    </div>
                    <div class="pa-short-title"><?php the_title(); ?></div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

</main>

<script>
(function(){
    var AUTO = 5000;
    var sliders = {};

    function initSlider(id) {
        var wrap = document.getElementById('slider-'+id);
        var slidesEl = document.getElementById('slides-'+id);
        var dotsEl = document.getElementById('dots-'+id);
        var progressEl = document.getElementById('progress-'+id);
        if (!wrap||!slidesEl) return;
        var slides = slidesEl.querySelectorAll('.pa-slide');
        var total = slides.length;
        if (!total) return;
        var s = {current:0, timer:null};
        sliders[id] = s;

        // Dots
        if (dotsEl) {
            for (var i=0;i<total;i++) {
                var d = document.createElement('button');
                d.className = 'pa-slider-dot'+(i===0?' active':'');
                d.setAttribute('data-i',i);
                d.addEventListener('click',(function(idx){return function(){goTo(id,idx);};})(i));
                dotsEl.appendChild(d);
            }
        }

        // Arrows
        wrap.querySelectorAll('.pa-slider-arrow').forEach(function(btn){
            btn.addEventListener('click',function(e){
                e.preventDefault();
                var dir = btn.classList.contains('pa-slider-arrow-prev') ? -1 : 1;
                goTo(id,(s.current+dir+total)%total);
            });
        });

        // Touch
        var tx = null;
        slidesEl.addEventListener('touchstart',function(e){tx=e.touches[0].clientX;},{passive:true});
        slidesEl.addEventListener('touchend',function(e){
            if(tx===null)return;
            var diff = tx - e.changedTouches[0].clientX;
            if(Math.abs(diff)>50){
                var dir=diff>0?1:-1;
                if(document.documentElement.getAttribute('dir')==='rtl') dir=-dir;
                goTo(id,(s.current+dir+total)%total);
            }
            tx=null;
        },{passive:true});

        goTo(id,0,true);
        startAuto(id);
    }

    function goTo(id,idx,init){
        var slidesEl=document.getElementById('slides-'+id);
        var dotsEl=document.getElementById('dots-'+id);
        var progressEl=document.getElementById('progress-'+id);
        var s=sliders[id];
        if(!slidesEl||!s)return;
        s.current=idx;
        var total=slidesEl.querySelectorAll('.pa-slide').length;
        var rtl=document.documentElement.getAttribute('dir')==='rtl';
        var sign=rtl?1:-1;
        slidesEl.style.transform='translateX('+(sign*idx*100)+'%)';
        if(dotsEl) dotsEl.querySelectorAll('.pa-slider-dot').forEach(function(d,i){d.classList.toggle('active',i===idx);});
        if(progressEl){
            progressEl.style.transition='none';
            progressEl.style.width='0%';
            setTimeout(function(){progressEl.style.transition='width '+AUTO+'ms linear';progressEl.style.width='100%';},60);
        }
        if(!init){stopAuto(id);startAuto(id);}
    }

    function startAuto(id){
        var s=sliders[id]; if(!s)return;
        stopAuto(id);
        s.timer=setInterval(function(){
            var el=document.getElementById('slides-'+id); if(!el)return;
            var total=el.querySelectorAll('.pa-slide').length;
            goTo(id,(s.current+1)%total);
        },AUTO);
    }
    function stopAuto(id){var s=sliders[id];if(s&&s.timer){clearInterval(s.timer);s.timer=null;}}

    // Pause on hover
    ['latest','top'].forEach(function(id){
        var w=document.getElementById('slider-'+id); if(!w)return;
        w.addEventListener('mouseenter',function(){stopAuto(id);});
        w.addEventListener('mouseleave',function(){startAuto(id);});
    });

    // Tab switch
    document.querySelectorAll('.pa-slider-tab').forEach(function(tab){
        tab.addEventListener('click',function(){
            var target=tab.getAttribute('data-slider');
            document.querySelectorAll('.pa-slider-tab').forEach(function(t){t.classList.toggle('active',t===tab);});
            document.querySelectorAll('.pa-slider-wrap').forEach(function(w){w.classList.remove('active');});
            var tw=document.getElementById('slider-'+target);
            if(tw){
                tw.classList.add('active');
                if(!sliders[target]) initSlider(target);
                else{stopAuto(target);startAuto(target);goTo(target,sliders[target].current);}
            }
            Object.keys(sliders).forEach(function(id){if(id!==target)stopAuto(id);});
        });
    });

    // Filter pills
    document.querySelectorAll('.pa-pill').forEach(function(pill){
        pill.addEventListener('click',function(){
            document.querySelectorAll('.pa-pill').forEach(function(p){p.classList.remove('active');});
            this.classList.add('active');
            var f=this.getAttribute('data-filter');
            document.querySelectorAll('.pa-card').forEach(function(c){
                c.style.display=(f==='all'||c.getAttribute('data-type')===f)?'':'none';
            });
        });
    });

    // Init
    document.addEventListener('DOMContentLoaded',function(){initSlider('latest');});
})();
</script>

<?php get_footer(); ?>

