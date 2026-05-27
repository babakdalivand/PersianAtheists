<?php
/**
 * YouTube Shorts Section
 */

$shorts = new WP_Query( [
    'post_type'      => 'pa_short',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
] );

if ( ! $shorts->have_posts() ) return;
?>

<section class="site-section">

    <div class="section-header">
        <h2 class="section-title">
            📱 <?php esc_html_e( 'شورت‌های یوتیوب', 'persian-atheists' ); ?>
        </h2>
        <a href="<?php echo esc_url( home_url( '/shorts' ) ); ?>" class="view-all">
            <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ←
        </a>
    </div>

    <div class="scroll-row">
        <?php while ( $shorts->have_posts() ) : $shorts->the_post();
            $yt_id   = pa_get_youtube_id();
            $duration= get_post_meta( get_the_ID(), 'pa_duration', true );
        ?>
            <div class="media-card" style="min-width:180px;">
                <div class="media-thumb" style="aspect-ratio:9/16;">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'pa-square', [ 'alt' => get_the_title() ] ); ?>
                    <?php elseif ( $yt_id ) : ?>
                        <img src="https://i.ytimg.com/vi/<?php echo esc_attr( $yt_id ); ?>/oardefault.jpg" alt="<?php the_title_attribute(); ?>" style="object-position:center;object-fit:cover;width:100%;height:100%;">
                    <?php else : ?>
                        <div style="background:#1E2A38;width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:28px;">📱</div>
                    <?php endif; ?>

                    <?php if ( $duration ) : ?>
                        <span class="media-duration"><?php echo esc_html( $duration ); ?></span>
                    <?php endif; ?>

                    <div class="play-overlay">
                        <div class="play-circle">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                    </div>
                </div>
                <div class="media-info">
                    <div class="media-title" style="-webkit-line-clamp:3;">
                        <a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

</section>
