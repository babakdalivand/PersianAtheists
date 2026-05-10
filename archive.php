<?php
/**
 * Archive Template — Categories, Tags, Dates, Authors
 */
get_header();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">

    <!-- Archive Header -->
    <div class="archive-hero">
        <div class="archive-hero-inner">
            <div class="archive-label">
                <?php
                if (is_category()) echo '📁 دسته‌بندی';
                elseif (is_tag()) echo '🏷️ برچسب';
                elseif (is_author()) echo '✍️ نویسنده';
                elseif (is_date()) echo '📅 تاریخ';
                else echo '📂 آرشیو';
                ?>
            </div>
            <h1 class="archive-title"><?php the_archive_title(); ?></h1>
            <?php $desc = get_the_archive_description(); if ($desc): ?>
                <p class="archive-desc"><?php echo wp_kses_post($desc); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="home-layout" style="padding-top:32px;">
        <div class="main-column">

            <?php if (have_posts()): ?>
                <div class="articles-grid">
                    <?php while (have_posts()): the_post(); ?>
                        <article class="card article-card">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('pa-card', ['class'=>'card-img','alt'=>get_the_title()]); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <?php $cats = get_the_category(); if($cats): ?>
                                    <span class="card-category"><?php echo esc_html($cats[0]->name); ?></span>
                                <?php endif; ?>
                                <h2 class="card-title" style="font-size:16px;">
                                    <a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a>
                                </h2>
                                <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 16, '...'); ?></p>
                                <div class="card-meta" style="margin-top:10px;">
                                    <span><?php the_author(); ?></span>
                                    <span>·</span>
                                    <span><?php echo pa_time_ago(); ?></span>
                                    <span>·</span>
                                    <span><?php echo pa_reading_time(); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- PAGINATION -->
                <div class="archive-pagination">
                    <?php
                    the_posts_pagination([
                        'mid_size'  => 2,
                        'prev_text' => '← قبلی',
                        'next_text' => 'بعدی →',
                        'before_page_number' => '<span class="meta-nav screen-reader-text"></span>',
                    ]);
                    ?>
                </div>

            <?php else: ?>
                <div class="no-results">
                    <p>هیچ محتوایی یافت نشد.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">بازگشت به خانه</a>
                </div>
            <?php endif; ?>

        </div><!-- /main-column -->

        <aside class="sidebar-column">
            <?php get_template_part('parts/sidebar'); ?>
        </aside>
    </div>

</div>
</main>

<?php get_footer(); ?>
