<?php get_header(); ?>

<main id="main-content" class="site-main">
    <div class="container">
        <div class="home-layout">

            <!-- ====== MAIN CONTENT COLUMN ====== -->
            <div class="main-column">

                <?php get_template_part( 'parts/hero' ); ?>
                <?php get_template_part( 'parts/articles' ); ?>
                <?php get_template_part( 'parts/shorts' ); ?>
                <?php get_template_part( 'parts/videos' ); ?>
                <?php get_template_part( 'parts/podcasts' ); ?>

            </div><!-- /main-column -->

            <!-- ====== SIDEBAR ====== -->
            <aside class="sidebar-column" aria-label="<?php esc_attr_e( 'سایدبار', 'persian-atheists' ); ?>">
                <?php get_template_part( 'parts/sidebar' ); ?>
            </aside>

        </div><!-- /home-layout -->
    </div><!-- /container -->
</main>

<?php get_footer(); ?>
