<?php
/**
 * Single Video — Persian Atheists
 */
get_header();

$lang    = pa_current_lang();
$is_en   = ($lang === 'en');
$post_id = get_queried_object_id();
$post    = get_post($post_id);

if (!$post) { get_footer(); exit; }

$yt_id   = get_post_meta($post_id, 'pa_youtube_id', true);
$dur     = get_post_meta($post_id, 'pa_duration', true);
$content = get_the_content(null, false, $post_id);
$author  = get_the_author_meta('display_name', $post->post_author);
?>
<style>
.pv-wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 28px 20px 60px;
    box-sizing: border-box;
}
.pv-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 28px;
    align-items: start;
}
.pv-main { min-width: 0; }
.pv-sidebar { position: sticky; top: 90px; }
.pv-widget {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 20px;
}
.pv-widget-title {
    font-size: 13px; font-weight: 800; color: var(--text);
    padding: 12px 16px; border-bottom: 1px solid var(--border);
    background: rgba(124,58,237,.04);
}
.pv-widget-body { padding: 12px 16px; }
.pv-witem {
    display: flex; gap: 10px; padding: 8px 0;
    border-bottom: 1px solid var(--border);
    text-decoration: none; transition: opacity .2s;
}
.pv-witem:last-child { border-bottom: none; padding-bottom: 0; }
.pv-witem:hover { opacity: .75; }
.pv-wthumb { width: 64px; height: 44px; border-radius: 6px; overflow: hidden; flex-shrink: 0; background: var(--primary); position: relative; }
.pv-wthumb img { width:100%; height:100%; object-fit:cover; }
.pv-wtitle { font-size: 12px; font-weight: 700; color: var(--text); line-height: 1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.pv-wmeta { font-size: 11px; color: var(--muted); margin-top: 3px; }
.pv-wdur { position:absolute; bottom:3px; right:3px; background:rgba(0,0,0,.8); color:#fff; font-size:10px; padding:1px 4px; border-radius:3px; font-weight:600; }
.pv-quote-widget {
    background: linear-gradient(135deg, rgba(124,58,237,.12), rgba(79,184,180,.08));
    border: 1px solid rgba(124,58,237,.2);
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
}
.pv-quote-widget .q-text { font-size:13px; color:var(--text); font-weight:600; line-height:1.7; margin-bottom:8px; }
.pv-quote-widget .q-who { font-size:11px; color:var(--muted); text-align:left; }
@media (max-width: 860px) {
    .pv-layout { grid-template-columns: 1fr; }
    .pv-sidebar { position: static; }
}
.pv-bread {
    display: flex; gap: 6px; align-items: center;
    font-size: 13px; color: var(--muted);
    margin-bottom: 20px; flex-wrap: wrap;
}
.pv-bread a { color: var(--muted); text-decoration: none; }
.pv-bread a:hover { color: var(--accent); }
.pv-sep { opacity: .4; }
.pv-player {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0 6px 32px rgba(0,0,0,0.25);
}
.pv-player iframe,
.pv-player img {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: none;
    object-fit: cover;
}
.pv-player-ph {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 80px;
}
.pv-info {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 28px;
}
.pv-title {
    font-size: clamp(20px, 3vw, 26px);
    font-weight: 900;
    color: var(--text);
    line-height: 1.4;
    margin-bottom: 16px;
    font-family: 'Vazirmatn', Tahoma, sans-serif;
}
body.lang-en .pv-title { font-family: 'Inter', Arial, sans-serif; }
.pv-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    padding: 14px 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    margin-bottom: 16px;
}
.pv-author { display: flex; align-items: center; gap: 10px; }
.pv-author img { width: 36px; height: 36px; border-radius: 50%; }
.pv-aname { font-size: 14px; font-weight: 700; color: var(--text); }
.pv-asub { font-size: 12px; color: var(--muted); display: flex; gap: 6px; margin-top: 2px; }
.pv-actions { display: flex; gap: 8px; flex-wrap: wrap; }
.pv-btn {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 8px 14px; border-radius: 8px;
    font-size: 13px; font-weight: 600;
    text-decoration: none; cursor: pointer;
    border: 1px solid var(--border);
    background: var(--surface); color: var(--muted);
    transition: all .2s; font-family: inherit;
}
.pv-btn:hover { border-color: var(--accent); color: var(--accent); }
.pv-btn-yt { background: #FF0000 !important; border-color: #FF0000 !important; color: #fff !important; }
.pv-btn-yt:hover { background: #CC0000 !important; }
.pv-desc { font-size: 15px; line-height: 1.8; color: var(--muted); }
.pv-more-title {
    font-size: 18px; font-weight: 800; color: var(--text);
    margin-bottom: 16px; padding-bottom: 8px;
    border-bottom: 2px solid var(--accent);
    display: inline-block;
}
.pv-list { display: flex; flex-direction: column; gap: 12px; }
.pv-item {
    display: flex; gap: 12px; text-decoration: none;
    padding: 10px; border-radius: 10px;
    border: 1px solid var(--border);
    background: var(--surface); transition: all .2s;
}
.pv-item:hover { border-color: var(--accent); }
.pv-thumb {
    width: 130px; height: 74px;
    border-radius: 8px; overflow: hidden;
    flex-shrink: 0; background: var(--primary);
    position: relative;
}
.pv-thumb img { width: 100%; height: 100%; object-fit: cover; }
.pv-thumb-ph {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    font-size: 28px; color: var(--accent);
}
.pv-dur {
    position: absolute; bottom: 5px; right: 5px;
    background: rgba(0,0,0,.8); color: #fff;
    font-size: 11px; padding: 2px 6px;
    border-radius: 4px; font-weight: 600;
}
.pv-ititle {
    font-size: 14px; font-weight: 700; color: var(--text);
    line-height: 1.4; margin-bottom: 6px;
    display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
}
.pv-imeta { font-size: 12px; color: var(--muted); }
@media (max-width: 600px) {
    .pv-wrap { padding: 16px 14px 40px; }
    .pv-info { padding: 16px; }
    .pv-thumb { width: 100px; height: 58px; }
    .pv-title { font-size: 18px; }
}
</style>

<?php
$pv_quotes = [
    ['text'=>'آنچه بدون شواهد ادعا شود، بدون شواهد رد می‌شود.','who'=>'کریستوفر هیچنز'],
    ['text'=>'خداوند با قریب به یقین وجود ندارد.','who'=>'ریچارد داوکینز'],
    ['text'=>'علم نه تنها با روح انسانی سازگار است، بلکه منبع عمیق‌ترین معنا برای آن است.','who'=>'کارل سِیگن'],
    ['text'=>'اگر در برابر خداوند ایستادم، می‌گویم: مدرک کافی نداشتید.','who'=>'برتراند راسل'],
    ['text'=>'من به خدای شخصی که در امور انسانی دخالت می‌کند، باور ندارم.','who'=>'آلبرت اینشتین'],
    ['text'=>'پرسیدن سوال نشانه هوشمندی است، نه بی‌ادبی.','who'=>'ابن‌رشد'],
];
$pv_q = $pv_quotes[array_rand($pv_quotes)];
?>
<main class="site-main">
<div class="pv-wrap">

    <!-- Breadcrumb -->
    <nav class="pv-bread">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo $is_en ? 'Home' : 'خانه'; ?></a>
        <span class="pv-sep">›</span>
        <a href="<?php echo esc_url(home_url('/videos')); ?>"><?php echo $is_en ? 'Videos' : 'ویدیوها'; ?></a>
        <span class="pv-sep">›</span>
        <span><?php echo wp_trim_words(get_the_title($post_id), 8, '...'); ?></span>
    </nav>

    <div class="pv-layout">
    <div class="pv-main">

    <!-- Player -->
    <div class="pv-player">
        <?php if ($yt_id): ?>
            <iframe
                src="https://www.youtube.com/embed/<?php echo esc_attr($yt_id); ?>?rel=0&modestbranding=1"
                title="<?php echo esc_attr(get_the_title($post_id)); ?>"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        <?php elseif (has_post_thumbnail($post_id)): ?>
            <?php echo get_the_post_thumbnail($post_id, 'pa-hero', ['style'=>'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;']); ?>
        <?php else: ?>
            <div class="pv-player-ph">▶</div>
        <?php endif; ?>
    </div>

    <!-- Info -->
    <div class="pv-info">
        <h1 class="pv-title"><?php echo get_the_title($post_id); ?></h1>
        <div class="pv-meta">
            <div class="pv-author">
                <?php echo get_avatar(get_the_author_meta('email', $post->post_author), 36, '', '', ['class'=>'']); ?>
                <div>
                    <div class="pv-aname"><?php echo esc_html($author); ?></div>
                    <div class="pv-asub">
                        <span><?php echo pa_time_ago($post_id); ?></span>
                        <?php if ($dur): ?><span>· 🕐 <?php echo esc_html($dur); ?></span><?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="pv-actions">
                <?php if ($yt_id): ?>
                    <a href="https://youtube.com/watch?v=<?php echo esc_attr($yt_id); ?>"
                       target="_blank" rel="noopener" class="pv-btn pv-btn-yt">
                        ▶ YouTube
                    </a>
                <?php endif; ?>
                <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink($post_id)); ?>"
                   target="_blank" class="pv-btn">✈</a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink($post_id)); ?>"
                   target="_blank" class="pv-btn">𝕏</a>
                <button class="pv-btn"
                    onclick="navigator.clipboard.writeText('<?php echo esc_js(get_permalink($post_id)); ?>').then(function(){this.textContent='✓';}.bind(this))">🔗</button>
            </div>
        </div>
        <?php if ($content): ?>
            <div class="pv-desc"><?php echo apply_filters('the_content', $content); ?></div>
        <?php endif; ?>
    </div>

    <!-- More Videos -->
    <?php
    $more_args = array(
        'post_type'      => 'pa_video',
        'posts_per_page' => 6,
        'post__not_in'   => array($post_id),
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $more_query = new WP_Query($more_args);
    ?>
    <?php if ($more_query instanceof WP_Query && $more_query->have_posts()): ?>
    <div>
        <div class="pv-more-title"><?php echo $is_en ? 'More Videos' : 'ویدیوهای بیشتر'; ?></div>
        <div class="pv-list">
            <?php while ($more_query->have_posts()): $more_query->the_post();
                $mid  = get_post_meta(get_the_ID(), 'pa_youtube_id', true);
                $mdur = get_post_meta(get_the_ID(), 'pa_duration', true);
            ?>
                <a href="<?php the_permalink(); ?>" class="pv-item">
                    <div class="pv-thumb">
                        <?php if ($mid): ?>
                            <img src="https://img.youtube.com/vi/<?php echo esc_attr($mid); ?>/mqdefault.jpg"
                                 alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php elseif (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('pa-thumb', ['style'=>'width:100%;height:100%;object-fit:cover;']); ?>
                        <?php else: ?>
                            <div class="pv-thumb-ph">▶</div>
                        <?php endif; ?>
                        <?php if ($mdur): ?>
                            <span class="pv-dur"><?php echo esc_html($mdur); ?></span>
                        <?php endif; ?>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div class="pv-ititle"><?php the_title(); ?></div>
                        <div class="pv-imeta"><?php echo pa_time_ago(); ?></div>
                    </div>
                </a>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>

    </div><!-- .pv-main -->

    <!-- ── Sidebar ── -->
    <aside class="pv-sidebar">

        <!-- Quote -->
        <div class="pv-quote-widget">
            <div class="q-text">❝ <?php echo esc_html($pv_q['text']); ?></div>
            <div class="q-who">— <?php echo esc_html($pv_q['who']); ?></div>
        </div>

        <!-- Latest articles -->
        <?php
        $pv_articles = new WP_Query(['post_type'=>'post','posts_per_page'=>4,'post_status'=>'publish','orderby'=>'date','order'=>'DESC']);
        if ($pv_articles->have_posts()) : ?>
            <div class="pv-widget">
                <div class="pv-widget-title">📰 <?php echo $is_en ? 'Latest Articles' : 'مقالات اخیر'; ?></div>
                <div class="pv-widget-body" style="padding:8px 12px;">
                    <?php while ($pv_articles->have_posts()) : $pv_articles->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="pv-witem">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="pv-wthumb"><?php the_post_thumbnail('pa-thumb',['style'=>'width:100%;height:100%;object-fit:cover;']); ?></div>
                            <?php endif; ?>
                            <div><div class="pv-wtitle"><?php the_title(); ?></div><div class="pv-wmeta"><?php echo pa_time_ago(); ?></div></div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Latest short videos -->
        <?php
        $pv_shorts = new WP_Query(['post_type'=>'pa_short','posts_per_page'=>4,'post_status'=>'publish']);
        if ($pv_shorts->have_posts()) : ?>
            <div class="pv-widget">
                <div class="pv-widget-title">🎬 <?php echo $is_en ? 'Short Videos' : 'ویدئوهای کوتاه'; ?></div>
                <div class="pv-widget-body" style="padding:8px 12px;">
                    <?php while ($pv_shorts->have_posts()) : $pv_shorts->the_post();
                        $svid = pa_get_youtube_id();
                        $sdur = get_post_meta(get_the_ID(),'pa_duration',true); ?>
                        <a href="<?php the_permalink(); ?>" class="pv-witem">
                            <div class="pv-wthumb" style="aspect-ratio:9/16;width:30px;height:52px;">
                                <?php if ($svid): ?><img src="https://i.ytimg.com/vi/<?php echo esc_attr($svid); ?>/oardefault.jpg" alt="" loading="lazy"><?php else: ?><div style="height:100%;background:var(--primary);display:flex;align-items:center;justify-content:center;">🎬</div><?php endif; ?>
                                <?php if ($sdur) : ?><span class="pv-wdur"><?php echo esc_html($sdur); ?></span><?php endif; ?>
                            </div>
                            <div><div class="pv-wtitle"><?php the_title(); ?></div><div class="pv-wmeta"><?php echo pa_time_ago(); ?></div></div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>

    </aside><!-- .pv-sidebar -->
    </div><!-- .pv-layout -->

</div>
</main>

<?php wp_reset_postdata(); get_footer(); ?>
