<?php
/**
 * Hero Section — Featured article + 2 side cards
 */

$featured_query = pa_get_featured_article();
$side_query     = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 2,
    'post_status'    => 'publish',
    'offset'         => 1,
] );
?>

<section class="hero-section site-section">

    <?php if ( $featured_query->have_posts() ) : ?>
    <div class="hero-grid">

        <!-- FEATURED LARGE CARD -->
        <?php $featured_query->the_post(); ?>
        <div class="hero-main">
            <a href="<?php the_permalink(); ?>" class="hero-card">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="hero-img-wrap">
                        <?php the_post_thumbnail( 'pa-hero', [ 'class' => 'hero-img', 'alt' => get_the_title() ] ); ?>
                    </div>
                <?php else : ?>
                    <div class="hero-img-wrap hero-placeholder">
                        <span>Persian Atheists</span>
                    </div>
                <?php endif; ?>

                <div class="hero-overlay">
                    <?php
                    $cats = get_the_category();
                    if ( $cats ) : ?>
                        <span class="badge badge-featured"><?php echo esc_html( $cats[0]->name ); ?></span>
                    <?php endif; ?>
                    <span class="hero-featured-label">
                        ⭐ <?php esc_html_e( 'مقاله ویژه', 'persian-atheists' ); ?>
                    </span>
                    <h1 class="hero-title"><?php the_title(); ?></h1>
                    <p class="hero-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
                    <div class="hero-meta">
                        <span><?php the_author(); ?></span>
                        <span>·</span>
                        <span><?php pa_time_ago(); ?></span>
                        <span>·</span>
                        <span><?php echo pa_reading_time(); ?></span>
                    </div>
                    <span class="btn btn-primary hero-btn">
                        <?php esc_html_e( 'مطالعه مقاله', 'persian-atheists' ); ?>
                    </span>
                </div>
            </a>
        </div><!-- /hero-main -->

        <!-- 2 SIDE CARDS -->
        <div class="hero-side">
            <?php while ( $side_query->have_posts() ) : $side_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="hero-side-card card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'pa-thumb', [ 'class' => 'hero-side-img', 'alt' => get_the_title() ] ); ?>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php
                        $cats = get_the_category();
                        if ( $cats ) : ?>
                            <span class="card-category"><?php echo esc_html( $cats[0]->name ); ?></span>
                        <?php endif; ?>
                        <h2 class="card-title" style="font-size:16px;"><?php the_title(); ?></h2>
                        <div class="card-meta">
                            <span><?php the_author(); ?></span>
                            <span><?php pa_time_ago(); ?></span>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        </div><!-- /hero-side -->

    </div><!-- /hero-grid -->
    <?php endif; wp_reset_postdata(); ?>

</section>
