<?php
/**
 * Single Video Template
 */
get_header();
while ( have_posts() ) : the_post();
    $yt_id    = pa_get_youtube_id();
    $duration = get_post_meta( get_the_ID(), 'pa_duration', true );
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">
<div class="home-layout">

    <div class="main-column">

        <!-- BREADCRUMB -->
        <nav class="breadcrumb">
            <a href="<?php echo esc_url( home_url('/') ); ?>">خانه</a>
            <span class="breadcrumb-sep">›</span>
            <a href="<?php echo esc_url( home_url('/videos') ); ?>">ویدیوها</a>
            <span class="breadcrumb-sep">›</span>
            <span><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></span>
        </nav>

        <!-- VIDEO PLAYER -->
        <div class="video-player-wrap" style="position:relative;aspect-ratio:16/9;background:#000;border-radius:var(--radius);overflow:hidden;margin-bottom:24px;">
            <?php if ( $yt_id ) : ?>
                <iframe
                    src="https://www.youtube.com/embed/<?php echo esc_attr($yt_id); ?>?autoplay=0&rel=0&modestbranding=1"
                    title="<?php the_title_attribute(); ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    style="position:absolute;inset:0;width:100%;height:100%;"
                ></iframe>
            <?php elseif ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail('pa-hero', ['style'=>'width:100%;height:100%;object-fit:cover;','alt'=>get_the_title()]); ?>
            <?php else : ?>
                <div style="display:flex;align-items:center;justify-content:center;height:100%;color:var(--accent);font-size:64px;">▶</div>
            <?php endif; ?>
        </div>

        <!-- INFO -->
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px;margin-bottom:24px;">
            <h1 class="article-title" style="font-size:22px;margin-bottom:12px;"><?php the_title(); ?></h1>

            <div class="article-meta" style="border:none;padding:0;margin-bottom:16px;">
                <div class="article-meta-author">
                    <?php echo get_avatar(get_the_author_meta('email'), 34, '', '', ['style'=>'border-radius:50%;']); ?>
                    <div>
                        <span class="author-name"><?php the_author(); ?></span>
                        <span class="meta-sep">·</span>
                        <time><?php echo pa_time_ago(); ?></time>
                        <?php if ($duration) : ?>
                            <span class="meta-sep">·</span>
                            <span>🕐 <?php echo esc_html($duration); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="share-btns">
                    <?php if ($yt_id) : ?>
                        <a href="https://youtube.com/watch?v=<?php echo esc_attr($yt_id); ?>" target="_blank" rel="noopener" class="share-btn" title="مشاهده در یوتیوب" style="width:auto;padding:0 12px;border-radius:8px;font-size:12px;font-weight:700;gap:5px;">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            یوتیوب
                        </a>
                    <?php endif; ?>
                    <a href="https://t.me/share/url?url=<?php the_permalink(); ?>" target="_blank" rel="noopener" class="share-btn" title="اشتراک در تلگرام">✈</a>
                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" rel="noopener" class="share-btn" title="اشتراک در X">𝕏</a>
                </div>
            </div>

            <?php if ( get_the_content() ) : ?>
                <div class="article-content" style="font-size:15px;border-top:1px solid var(--border);padding-top:16px;">
                    <?php the_content(); ?>
                </div>
            <?php elseif ( get_the_excerpt() ) : ?>
                <p style="color:var(--muted);font-size:15px;line-height:1.7;"><?php the_excerpt(); ?></p>
            <?php endif; ?>
        </div>

        <!-- MORE VIDEOS -->
        <?php
        $more = new WP_Query(['post_type'=>'pa_video','posts_per_page'=>4,'post__not_in'=>[get_the_ID()],'post_status'=>'publish']);
        if ($more->have_posts()) : ?>
            <section>
                <h2 class="section-title">ویدیوهای بیشتر</h2>
                <div class="scroll-row">
                    <?php while ($more->have_posts()) : $more->the_post();
                        $mid = pa_get_youtube_id(); $dur = get_post_meta(get_the_ID(),'pa_duration',true); ?>
                        <div class="media-card">
                            <div class="media-thumb">
                                <?php if ($mid) : ?><img src="https://img.youtube.com/vi/<?php echo esc_attr($mid); ?>/mqdefault.jpg" alt="<?php the_title_attribute(); ?>"><?php elseif (has_post_thumbnail()) : ?><?php the_post_thumbnail('pa-thumb'); ?><?php endif; ?>
                                <?php if ($dur) : ?><span class="media-duration"><?php echo esc_html($dur); ?></span><?php endif; ?>
                                <div class="play-overlay"><div class="play-circle"><svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><polygon points="5 3 19 12 5 21 5 3"/></svg></div></div>
                            </div>
                            <div class="media-info">
                                <div class="media-title"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></div>
                                <div class="media-meta"><?php pa_time_ago(); ?></div>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </section>
        <?php endif; ?>

    </div><!-- /main-column -->

    <aside class="sidebar-column">
        <?php get_template_part('parts/sidebar'); ?>
    </aside>

</div>
</div>
</main>

<?php endwhile; get_footer(); ?>
