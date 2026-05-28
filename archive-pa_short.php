<?php
/**
 * Template Name: Archive — Shorts
 * آرشیو ویدیوهای کوتاه
 */
get_header(); ?>

<main id="primary" class="site-main pa-archive-shorts">

    <div class="pa-container">

        <header class="pa-archive-header">
            <h1 class="pa-archive-title">ویدیوهای کوتاه</h1>
            <p class="pa-archive-desc">کلیپ‌های کوتاه و خلاصه‌شده از محتوای Persian Atheists</p>
        </header>

        <?php if ( have_posts() ) : ?>

            <div class="pa-shorts-grid">
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                    $yt_id    = get_post_meta( get_the_ID(), 'pa_youtube_id', true );
                    $duration = get_post_meta( get_the_ID(), 'pa_duration', true );
                    $thumb    = $yt_id
                        ? 'https://img.youtube.com/vi/' . esc_attr($yt_id) . '/hqdefault.jpg'
                        : get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                    ?>

                    <article <?php post_class('pa-short-card'); ?>>
                        <a href="<?php the_permalink(); ?>" class="pa-short-card__thumb-wrap">
                            <?php if ( $thumb ) : ?>
                                <img src="<?php echo esc_url($thumb); ?>"
                                     alt="<?php the_title_attribute(); ?>"
                                     loading="lazy"
                                     class="pa-short-card__thumb">
                            <?php endif; ?>
                            <?php if ( $duration ) : ?>
                                <span class="pa-short-card__duration"><?php echo esc_html($duration); ?></span>
                            <?php endif; ?>
                        </a>
                        <div class="pa-short-card__body">
                            <h2 class="pa-short-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <time class="pa-short-card__date" datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </div>
                    </article>

                <?php endwhile; ?>
            </div>

            <div class="pa-pagination">
                <?php the_posts_pagination(['mid_size' => 2]); ?>
            </div>

        <?php else : ?>
            <p class="pa-no-results">هنوز ویدیوی کوتاهی منتشر نشده است.</p>
        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>
