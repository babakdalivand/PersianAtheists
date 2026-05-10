<?php
/**
 * Podcast Archive Template
 */
get_header();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">

    <div class="archive-hero">
        <div class="archive-hero-inner">
            <div class="archive-label">🎙️ پادکست‌ها</div>
            <h1 class="archive-title">پادکست آتئیست‌های ایرانی</h1>
            <p class="archive-desc">همه اپیزودهای پادکست ما را اینجا گوش دهید</p>
        </div>
        <div style="margin-top:16px;display:flex;gap:10px;flex-wrap:wrap;">
            <a href="#" target="_blank" rel="noopener" class="btn" style="background:#1DB954;color:#fff;gap:8px;">🎵 Spotify</a>
            <a href="#" target="_blank" rel="noopener" class="btn btn-outline" style="gap:8px;">🎙️ Anchor</a>
        </div>
    </div>

    <div class="home-layout" style="padding-top:32px;">
        <div class="main-column">

            <?php if (have_posts()) : ?>
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <?php while (have_posts()) : the_post();
                        $ep_num  = get_post_meta(get_the_ID(),'pa_episode_number',true);
                        $duration= get_post_meta(get_the_ID(),'pa_duration',true);
                        $audio   = get_post_meta(get_the_ID(),'pa_audio_url',true);
                    ?>
                        <div class="card" style="display:flex;gap:20px;padding:20px;align-items:flex-start;">

                            <!-- Cover -->
                            <div style="width:90px;height:90px;border-radius:10px;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg,var(--primary),#2d3f54);display:flex;align-items:center;justify-content:center;">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('pa-square',['style'=>'width:100%;height:100%;object-fit:cover;']); ?>
                                <?php else : ?>
                                    <span style="font-size:32px;">🎙️</span>
                                <?php endif; ?>
                            </div>

                            <!-- Info -->
                            <div style="flex:1;min-width:0;">
                                <?php if ($ep_num) : ?>
                                    <div style="font-size:11px;font-weight:700;color:var(--accent);margin-bottom:4px;">پادکست <?php echo esc_html($ep_num); ?></div>
                                <?php endif; ?>
                                <h2 style="font-size:16px;font-weight:700;margin-bottom:8px;">
                                    <a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a>
                                </h2>
                                <p style="font-size:13px;color:var(--muted);line-height:1.6;margin-bottom:12px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                    <?php echo wp_trim_words(get_the_excerpt(),20,'...'); ?>
                                </p>
                                <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                                    <span style="font-size:12px;color:var(--muted);"><?php the_author(); ?></span>
                                    <span style="font-size:12px;color:var(--muted);">· <?php echo pa_time_ago(); ?></span>
                                    <?php if ($duration): ?><span style="font-size:12px;color:var(--muted);">· 🕐 <?php echo esc_html($duration); ?></span><?php endif; ?>

                                    <?php if ($audio) : ?>
                                        <audio controls preload="none" style="height:30px;flex:1;min-width:160px;">
                                            <source src="<?php echo esc_url($audio); ?>" type="audio/mpeg">
                                        </audio>
                                    <?php endif; ?>

                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline" style="font-size:12px;padding:5px 12px;margin-right:auto;">بیشتر بخوانید</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="archive-pagination">
                    <?php the_posts_pagination(['prev_text'=>'← قبلی','next_text'=>'بعدی →']); ?>
                </div>

            <?php else : ?>
                <div class="no-results" style="text-align:center;padding:60px 0;">
                    <div style="font-size:64px;margin-bottom:16px;">🎙️</div>
                    <h2>هنوز پادکستی منتشر نشده</h2>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary" style="margin-top:20px;">بازگشت</a>
                </div>
            <?php endif; ?>

        </div>
        <aside class="sidebar-column"><?php get_template_part('parts/sidebar'); ?></aside>
    </div>

</div>
</main>

<?php get_footer(); ?>
