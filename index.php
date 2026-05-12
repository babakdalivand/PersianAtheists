<?php
/**
 * Main Index — loads home template if front page
 */
if (is_front_page() || is_home()) {
    include get_template_directory() . '/templates/home.php';
} else {
    get_header();
    ?>
    <main class="site-main" id="main-content">
        <div class="container" style="padding:48px 0;">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('pa-card', get_the_ID()); ?> style="margin-bottom:24px;">
                    <div class="pa-card-body" style="padding:24px;">
                        <h2 class="pa-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div style="font-size:14px;color:var(--muted);margin-bottom:12px;"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary" style="font-size:13px;padding:8px 18px;">
                            <?php echo pa_current_lang() === 'en' ? 'Read More' : 'ادامه مطلب'; ?> →
                        </a>
                    </div>
                </article>
            <?php endwhile; else: ?>
                <p style="text-align:center;color:var(--muted);padding:60px 0;">
                    <?php echo pa_current_lang() === 'en' ? 'No content found.' : 'محتوایی یافت نشد.'; ?>
                </p>
            <?php endif; ?>
        </div>
    </main>
    <?php get_footer();
}
