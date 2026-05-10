<?php
/**
 * 404 Error Template
 */
get_header();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding:100px 20px;text-align:center;">

    <div style="font-size:80px;margin-bottom:24px;opacity:0.8;">🔭</div>
    <h1 style="font-size:80px;font-weight:900;color:var(--accent);line-height:1;margin-bottom:0;">404</h1>
    <h2 style="margin-bottom:16px;">صفحه‌ای یافت نشد</h2>
    <p style="color:var(--muted);max-width:440px;margin:0 auto 32px;font-size:16px;line-height:1.7;">
        صفحه‌ای که به دنبالش هستید حذف شده، تغییر نام داده یا موقتاً در دسترس نیست.
    </p>

    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">🏠 بازگشت به خانه</a>
        <a href="<?php echo esc_url(home_url('/articles')); ?>" class="btn btn-outline">📰 مشاهده مقالات</a>
    </div>

    <!-- Search Box -->
    <div style="max-width:480px;margin:48px auto 0;">
        <p style="color:var(--muted);font-size:14px;margin-bottom:14px;">یا چیزی جستجو کنید:</p>
        <?php get_search_form(); ?>
    </div>

    <!-- Latest Posts -->
    <?php
    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 3, 'post_status' => 'publish']);
    if ($recent->have_posts()):
    ?>
    <div style="max-width:800px;margin:60px auto 0;text-align:right;">
        <h3 class="section-title">آخرین مقالات</h3>
        <div class="articles-grid">
            <?php while ($recent->have_posts()): $recent->the_post(); ?>
                <article class="card article-card">
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pa-thumb', ['class'=>'card-img','alt'=>get_the_title()]); ?></a>
                    <?php endif; ?>
                    <div class="card-body">
                        <h3 class="card-title" style="font-size:15px;"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h3>
                        <div class="card-meta"><span><?php pa_time_ago(); ?></span></div>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>

</div>
</main>

<?php get_footer(); ?>
