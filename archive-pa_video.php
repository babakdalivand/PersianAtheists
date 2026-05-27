<?php
/**
 * Video Archive Template
 */
get_header();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">

    <!-- HEADER -->
    <div class="archive-hero">
        <div class="archive-hero-inner">
            <div class="archive-label">📹 ویدیوها</div>
            <h1 class="archive-title">کانال یوتیوب</h1>
            <p class="archive-desc">همه ویدیوهای آتئیست‌های ایرانی</p>
        </div>
        <div style="margin-top:16px;display:flex;gap:10px;flex-wrap:wrap;">
            <a href="https://youtube.com/@PersianAtheists" target="_blank" rel="noopener" class="btn btn-primary" style="gap:8px;">
                <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                دنبال کردن در یوتیوب
            </a>
        </div>
    </div>

    <?php if (have_posts()) : ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:var(--card-gap);padding-top:32px;">
            <?php while (have_posts()) : the_post();
                $yt_id    = pa_get_youtube_id();
                $duration = get_post_meta(get_the_ID(),'pa_duration',true);
            ?>
                <a href="<?php the_permalink(); ?>" class="media-card media-card-link" style="text-decoration:none;display:block;">
                    <div class="media-thumb">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('pa-card',['alt'=>get_the_title()]); ?>
                        <?php elseif ($yt_id) : ?>
                            <img src="https://img.youtube.com/vi/<?php echo esc_attr($yt_id); ?>/hqdefault.jpg" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php else : ?>
                            <div style="height:100%;background:var(--surface);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:36px;">▶</div>
                        <?php endif; ?>
                        <?php if ($duration) : ?><span class="media-duration"><?php echo esc_html($duration); ?></span><?php endif; ?>
                        <div class="play-overlay"><div class="play-circle"><svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><polygon points="5 3 19 12 5 21 5 3"/></svg></div></div>
                    </div>
                    <div class="media-info">
                        <div class="media-title"><?php the_title(); ?></div>
                        <div class="media-meta"><?php echo pa_time_ago(); ?></div>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
        <div class="archive-pagination" style="margin-top:32px;">
            <?php the_posts_pagination(['prev_text'=>'← قبلی','next_text'=>'بعدی →']); ?>
        </div>
    <?php else : ?>
        <div class="no-results" style="text-align:center;padding:60px 20px;">
            <div style="font-size:64px;margin-bottom:16px;">📹</div>
            <h2>هنوز ویدیویی منتشر نشده</h2>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary" style="margin-top:20px;">بازگشت به خانه</a>
        </div>
    <?php endif; ?>

</div>
</main>

<?php get_footer(); ?>
