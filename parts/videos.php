<?php
/**
 * YouTube Videos Section
 */

$videos = new WP_Query( [
    'post_type'      => 'pa_video',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
] );

if ( ! $videos->have_posts() ) return;
?>

<section class="site-section media-section">

    <div class="section-header">
        <h2 class="section-title">
            <svg viewBox="0 0 24 24" fill="currentColor" width="22" height="22" style="color:var(--accent)"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            <?php esc_html_e( 'ویدیوهای یوتیوب', 'persian-atheists' ); ?>
        </h2>
        <a href="<?php echo esc_url( home_url( '/videos' ) ); ?>" class="view-all">
            <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ←
        </a>
    </div>

    <div class="scroll-row">
        <?php while ( $videos->have_posts() ) : $videos->the_post();
            $yt_id    = pa_get_youtube_id();
            $duration = get_post_meta( get_the_ID(), 'pa_duration', true );
        ?>
            <div class="media-card">
                <div class="media-thumb">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'pa-thumb', [ 'alt' => get_the_title() ] ); ?>
                    <?php elseif ( $yt_id ) : ?>
                        <img src="https://img.youtube.com/vi/<?php echo esc_attr( $yt_id ); ?>/hqdefault.jpg" alt="<?php the_title_attribute(); ?>">
                    <?php else : ?>
                        <div style="background:#1E2A38;width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:32px;">▶</div>
                    <?php endif; ?>

                    <?php if ( $duration ) : ?>
                        <span class="media-duration"><?php echo esc_html( $duration ); ?></span>
                    <?php endif; ?>

                    <div class="play-overlay">
                        <div class="play-circle">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                    </div>
                </div>
                <div class="media-info">
                    <div class="media-title">
                        <a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a>
                    </div>
                    <div class="media-meta"><?php pa_time_ago(); ?></div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

</section>
