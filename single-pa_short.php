<?php
/**
 * Single Short Template
 */
get_header();
while ( have_posts() ) : the_post();
    $yt_id    = pa_get_youtube_id();
    $duration = get_post_meta( get_the_ID(), 'pa_duration', true );
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">

    <nav class="breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">خانه</a>
        <span class="breadcrumb-sep">›</span>
        <a href="<?php echo esc_url(home_url('/shorts')); ?>">شورت‌ها</a>
        <span class="breadcrumb-sep">›</span>
        <span><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></span>
    </nav>

    <div style="display:grid;grid-template-columns:400px 1fr;gap:32px;align-items:start;max-width:900px;margin:0 auto;">

        <!-- VERTICAL PLAYER -->
        <div style="position:sticky;top:90px;">
            <div style="position:relative;aspect-ratio:9/16;background:#000;border-radius:var(--radius);overflow:hidden;">
                <?php if ($yt_id) : ?>
                    <iframe
                        src="https://www.youtube.com/embed/<?php echo esc_attr($yt_id); ?>?autoplay=0&rel=0&modestbranding=1"
                        title="<?php the_title_attribute(); ?>"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        style="position:absolute;inset:0;width:100%;height:100%;"
                    ></iframe>
                <?php elseif (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('pa-card', ['style'=>'width:100%;height:100%;object-fit:cover;']); ?>
                <?php else : ?>
                    <div style="display:flex;align-items:center;justify-content:center;height:100%;color:var(--accent);font-size:48px;">📱</div>
                <?php endif; ?>
                <?php if ($duration) : ?>
                    <span class="media-duration"><?php echo esc_html($duration); ?></span>
                <?php endif; ?>
            </div>

            <!-- Share -->
            <div style="display:flex;gap:8px;margin-top:14px;justify-content:center;">
                <?php if ($yt_id) : ?>
                    <a href="https://youtube.com/shorts/<?php echo esc_attr($yt_id); ?>" target="_blank" rel="noopener" class="btn btn-primary" style="flex:1;justify-content:center;font-size:13px;">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        یوتیوب
                    </a>
                <?php endif; ?>
                <a href="https://t.me/share/url?url=<?php the_permalink(); ?>" target="_blank" rel="noopener" class="share-btn" title="تلگرام">✈</a>
                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" rel="noopener" class="share-btn" title="X">𝕏</a>
            </div>
        </div>

        <!-- INFO -->
        <div>
            <h1 style="font-size:20px;font-weight:800;color:var(--text);margin-bottom:14px;line-height:1.4;"><?php the_title(); ?></h1>
            <div style="font-size:13px;color:var(--muted);display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;">
                <span><?php the_author(); ?></span>
                <span>·</span>
                <span><?php echo pa_time_ago(); ?></span>
                <?php if ($duration) : ?><span>· <?php echo esc_html($duration); ?></span><?php endif; ?>
            </div>
            <?php if (get_the_excerpt()) : ?>
                <p style="color:var(--muted);font-size:14px;line-height:1.75;"><?php the_excerpt(); ?></p>
            <?php endif; ?>

            <!-- More shorts -->
            <?php
            $more = new WP_Query(['post_type'=>'pa_short','posts_per_page'=>6,'post__not_in'=>[get_the_ID()],'post_status'=>'publish']);
            if ($more->have_posts()) : ?>
                <h3 style="font-size:16px;font-weight:700;margin-top:28px;margin-bottom:16px;">📱 شورت‌های بیشتر</h3>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;">
                    <?php while ($more->have_posts()) : $more->the_post();
                        $mid = pa_get_youtube_id(); $mdur=get_post_meta(get_the_ID(),'pa_duration',true); ?>
                        <a href="<?php the_permalink(); ?>" style="text-decoration:none;">
                            <div class="media-card">
                                <div class="media-thumb" style="aspect-ratio:9/16;">
                                    <?php if ($mid): ?><img src="https://i.ytimg.com/vi/<?php echo esc_attr($mid);?>/oardefault.jpg" alt="<?php the_title_attribute();?>" style="object-fit:cover;width:100%;height:100%;"><?php elseif(has_post_thumbnail()):?><?php the_post_thumbnail('pa-square');?><?php else:?><div style="height:100%;background:var(--primary);display:flex;align-items:center;justify-content:center;color:var(--accent);">📱</div><?php endif;?>
                                    <?php if($mdur):?><span class="media-duration"><?php echo esc_html($mdur);?></span><?php endif;?>
                                </div>
                                <div class="media-info"><div class="media-title" style="-webkit-line-clamp:2;"><?php the_title();?></div></div>
                            </div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>
</main>

<?php endwhile; get_footer(); ?>
