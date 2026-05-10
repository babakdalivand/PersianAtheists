<?php
/**
 * Search Results Template
 */
get_header();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">

    <div class="archive-hero">
        <div class="archive-hero-inner">
            <div class="archive-label">🔍 جستجو</div>
            <h1 class="archive-title">
                <?php printf('نتایج جستجو برای: <em>%s</em>', esc_html(get_search_query())); ?>
            </h1>
            <?php if (have_posts()): ?>
                <p class="archive-desc"><?php printf('%d نتیجه یافت شد', $wp_query->found_posts); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Search form -->
    <div style="max-width:600px;margin:24px auto;">
        <?php get_search_form(); ?>
    </div>

    <div class="home-layout" style="padding-top:24px;">
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
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="archive-pagination">
                    <?php the_posts_pagination(['prev_text' => '← قبلی', 'next_text' => 'بعدی →']); ?>
                </div>

            <?php else: ?>
                <div class="no-results" style="text-align:center;padding:60px 0;">
                    <div style="font-size:64px;margin-bottom:20px;">🔍</div>
                    <h2 style="margin-bottom:12px;">نتیجه‌ای یافت نشد</h2>
                    <p style="color:var(--muted);margin-bottom:24px;">جستجوی "<strong><?php echo esc_html(get_search_query()); ?></strong>" نتیجه‌ای نداشت.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">بازگشت به خانه</a>
                </div>
            <?php endif; ?>

        </div>
        <aside class="sidebar-column">
            <?php get_template_part('parts/sidebar'); ?>
        </aside>
    </div>

</div>
</main>

<?php get_footer(); ?>
