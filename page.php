<?php
/**
 * Static Page Template
 */
get_header();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">
<div class="page-layout">

    <div class="page-main">
        <?php while (have_posts()): the_post(); ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                <header class="page-article-header">
                    <h1 class="article-title"><?php the_title(); ?></h1>
                </header>
                <div class="article-content entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>

    <aside class="sidebar-column">
        <?php get_template_part('parts/sidebar'); ?>
    </aside>

</div>
</div>
</main>

<?php get_footer(); ?>
