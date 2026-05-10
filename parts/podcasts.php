<?php
/**
 * Podcasts Section
 */

$podcasts = new WP_Query( [
    'post_type'      => 'pa_podcast',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
] );

if ( ! $podcasts->have_posts() ) return;
?>

<section class="site-section media-section">

    <div class="section-header">
        <h2 class="section-title">
            🎙️ <?php esc_html_e( 'آخرین پادکست‌ها', 'persian-atheists' ); ?>
        </h2>
        <a href="<?php echo esc_url( home_url( '/podcasts' ) ); ?>" class="view-all">
            <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ←
        </a>
    </div>

    <div class="scroll-row">
        <?php while ( $podcasts->have_posts() ) : $podcasts->the_post();
            $ep_num  = get_post_meta( get_the_ID(), 'pa_episode_number', true );
            $duration= get_post_meta( get_the_ID(), 'pa_duration', true );
        ?>
            <div class="media-card">
                <div class="media-thumb" style="aspect-ratio:1/1; background:linear-gradient(135deg,#1E2A38,#2d3f54);">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'pa-square', [ 'alt' => get_the_title() ] ); ?>
                    <?php else : ?>
                        <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:var(--accent);">
                            <span style="font-size:40px;">🎙️</span>
                            <?php if ( $ep_num ) : ?>
                                <span style="font-size:12px;color:rgba(255,255,255,0.6);margin-top:6px;">پادکست #<?php echo esc_html( $ep_num ); ?></span>
                            <?php endif; ?>
                        </div>
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
                    <?php if ( $ep_num ) : ?>
                        <div style="font-size:11px;color:var(--accent);font-weight:700;margin-bottom:4px;">پادکست <?php echo esc_html( $ep_num ); ?></div>
                    <?php endif; ?>
                    <div class="media-title">
                        <a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a>
                    </div>
                    <div class="media-meta"><?php pa_time_ago(); ?></div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

</section>
