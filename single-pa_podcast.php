<?php
/**
 * Single Podcast Template
 */
get_header();
while ( have_posts() ) : the_post();
    $ep_num   = get_post_meta( get_the_ID(), 'pa_episode_number', true );
    $duration = get_post_meta( get_the_ID(), 'pa_duration', true );
    $audio    = get_post_meta( get_the_ID(), 'pa_audio_url', true );
    $anchor   = get_post_meta( get_the_ID(), 'pa_anchor_url', true );
    $spotify  = get_post_meta( get_the_ID(), 'pa_spotify_url', true );
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">
<div class="home-layout">

    <div class="main-column">

        <nav class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">خانه</a>
            <span class="breadcrumb-sep">›</span>
            <a href="<?php echo esc_url(home_url('/podcasts')); ?>">پادکست‌ها</a>
            <span class="breadcrumb-sep">›</span>
            <?php if ($ep_num) : ?><span>پادکست <?php echo esc_html($ep_num); ?></span><span class="breadcrumb-sep">›</span><?php endif; ?>
            <span><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></span>
        </nav>

        <!-- PODCAST CARD -->
        <div style="background:linear-gradient(135deg,var(--primary) 0%,#2d3f54 100%);border-radius:var(--radius);padding:32px;margin-bottom:24px;display:flex;gap:24px;align-items:center;flex-wrap:wrap;">

            <!-- Cover -->
            <div style="width:140px;height:140px;border-radius:12px;overflow:hidden;flex-shrink:0;background:rgba(212,160,23,0.2);display:flex;align-items:center;justify-content:center;">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('pa-square', ['style'=>'width:100%;height:100%;object-fit:cover;']); ?>
                <?php else : ?>
                    <span style="font-size:48px;">🎙️</span>
                <?php endif; ?>
            </div>

            <!-- Info -->
            <div style="flex:1;min-width:200px;">
                <?php if ($ep_num) : ?>
                    <div style="font-size:12px;font-weight:700;color:var(--accent);margin-bottom:8px;letter-spacing:1px;text-transform:uppercase;">پادکست <?php echo esc_html($ep_num); ?></div>
                <?php endif; ?>
                <h1 style="color:#fff;font-size:20px;font-weight:800;margin-bottom:10px;line-height:1.4;"><?php the_title(); ?></h1>
                <div style="display:flex;gap:16px;font-size:13px;color:rgba(255,255,255,0.65);flex-wrap:wrap;">
                    <span><?php the_author(); ?></span>
                    <?php if ($duration) : ?><span>🕐 <?php echo esc_html($duration); ?></span><?php endif; ?>
                    <span><?php echo pa_time_ago(); ?></span>
                </div>
            </div>
        </div>

        <!-- AUDIO PLAYER -->
        <?php if ($audio) : ?>
            <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:20px;margin-bottom:24px;">
                <p style="font-size:13px;font-weight:700;color:var(--muted);margin-bottom:12px;">🎵 پخش آنلاین</p>
                <audio controls style="width:100%;" preload="metadata">
                    <source src="<?php echo esc_url($audio); ?>" type="audio/mpeg">
                    مرورگر شما از پخش صوتی پشتیبانی نمی‌کند.
                </audio>
            </div>
        <?php endif; ?>

        <!-- LISTEN ON -->
        <?php if ($anchor || $spotify) : ?>
            <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:20px;margin-bottom:24px;">
                <p style="font-size:13px;font-weight:700;color:var(--muted);margin-bottom:14px;">گوش دادن در:</p>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <?php if ($spotify) : ?>
                        <a href="<?php echo esc_url($spotify); ?>" target="_blank" rel="noopener" class="btn" style="background:#1DB954;color:#fff;gap:8px;font-size:13px;">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
                            Spotify
                        </a>
                    <?php endif; ?>
                    <?php if ($anchor) : ?>
                        <a href="<?php echo esc_url($anchor); ?>" target="_blank" rel="noopener" class="btn" style="background:#1A1A1A;color:#fff;font-size:13px;">
                            🎙️ Anchor / Spotify for Podcasters
                        </a>
                    <?php endif; ?>
                    <a href="https://t.me/share/url?url=<?php the_permalink(); ?>" target="_blank" rel="noopener" class="btn btn-outline" style="font-size:13px;">✈ تلگرام</a>
                </div>
            </div>
        <?php endif; ?>

        <!-- CONTENT -->
        <?php if (get_the_content()) : ?>
            <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px;margin-bottom:24px;">
                <h2 style="font-size:18px;font-weight:700;margin-bottom:16px;">📝 درباره این پادکست</h2>
                <div class="article-content"><?php the_content(); ?></div>
            </div>
        <?php endif; ?>

        <!-- MORE PODCASTS -->
        <?php
        $more = new WP_Query(['post_type'=>'pa_podcast','posts_per_page'=>4,'post__not_in'=>[get_the_ID()],'post_status'=>'publish','orderby'=>'date']);
        if ($more->have_posts()) : ?>
            <section>
                <h2 class="section-title">پادکست‌های بیشتر</h2>
                <div class="scroll-row">
                    <?php while ($more->have_posts()) : $more->the_post();
                        $mep = get_post_meta(get_the_ID(),'pa_episode_number',true);
                        $mdur= get_post_meta(get_the_ID(),'pa_duration',true); ?>
                        <div class="media-card">
                            <div class="media-thumb" style="aspect-ratio:1/1;background:linear-gradient(135deg,var(--primary),#2d3f54);">
                                <?php if (has_post_thumbnail()) : ?><?php the_post_thumbnail('pa-square'); ?>
                                <?php else : ?><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:var(--accent);"><span style="font-size:36px;">🎙️</span><?php if($mep):?><span style="font-size:11px;color:rgba(255,255,255,0.5);margin-top:6px;">#<?php echo esc_html($mep);?></span><?php endif;?></div>
                                <?php endif; ?>
                                <?php if ($mdur): ?><span class="media-duration"><?php echo esc_html($mdur); ?></span><?php endif; ?>
                            </div>
                            <div class="media-info">
                                <?php if ($mep): ?><div style="font-size:11px;color:var(--accent);font-weight:700;margin-bottom:4px;">پادکست <?php echo esc_html($mep); ?></div><?php endif; ?>
                                <div class="media-title"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></div>
                                <div class="media-meta"><?php pa_time_ago(); ?></div>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </section>
        <?php endif; ?>

    </div><!-- /main-column -->

    <aside class="sidebar-column"><?php get_template_part('parts/sidebar'); ?></aside>

</div>
</div>
</main>

<?php endwhile; get_footer(); ?>
