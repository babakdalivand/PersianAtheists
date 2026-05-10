<?php
/**
 * Latest Articles Section
 */

$articles = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'offset'         => 3,
] );

if ( ! $articles->have_posts() ) return;
?>

<section class="site-section articles-section">

    <div class="section-header">
        <h2 class="section-title"><?php esc_html_e( 'آخرین مقالات', 'persian-atheists' ); ?></h2>
        <a href="<?php echo esc_url( home_url( '/articles' ) ); ?>" class="view-all">
            <?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?> ←
        </a>
    </div>

    <div class="articles-grid">
        <?php while ( $articles->have_posts() ) : $articles->the_post(); ?>
            <article class="card article-card">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'pa-card', [ 'class' => 'card-img', 'alt' => get_the_title() ] ); ?>
                    </a>
                <?php endif; ?>
                <div class="card-body">
                    <?php
                    $cats = get_the_category();
                    if ( $cats ) : ?>
                        <span class="card-category"><?php echo esc_html( $cats[0]->name ); ?></span>
                    <?php endif; ?>
                    <h3 class="card-title">
                        <a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a>
                    </h3>
                    <p class="card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?></p>
                    <div class="card-meta" style="margin-top:12px;">
                        <span><?php the_author(); ?></span>
                        <span>·</span>
                        <span><?php pa_time_ago(); ?></span>
                        <span>·</span>
                        <span><?php echo pa_reading_time(); ?></span>
                    </div>
                </div>
            </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

</section>
