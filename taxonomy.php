<?php
/**
 * Taxonomy Archive Template
 */
get_header();
$term = get_queried_object();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">

    <div class="archive-hero">
        <div class="archive-hero-inner">
            <div class="archive-label">
                <?php echo esc_html( get_taxonomy($term->taxonomy)->labels->singular_name ?? 'دسته‌بندی' ); ?>
            </div>
            <h1 class="archive-title"><?php single_term_title(); ?></h1>
            <?php $desc = term_description(); if ($desc) : ?>
                <div class="archive-desc"><?php echo wp_kses_post($desc); ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="home-layout" style="padding-top:32px;">
        <div class="main-column">
            <?php if (have_posts()) : ?>
                <div class="articles-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="card article-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pa-card',['class'=>'card-img','alt'=>get_the_title()]); ?></a>
                            <?php endif; ?>
                            <div class="card-body">
                                <h2 class="card-title" style="font-size:16px;"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h2>
                                <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(),14,'...'); ?></p>
                                <div class="card-meta" style="margin-top:10px;">
                                    <span><?php the_author(); ?></span>
                                    <span>·</span><span><?php echo pa_time_ago(); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <div class="archive-pagination">
                    <?php the_posts_pagination(['prev_text'=>'← قبلی','next_text'=>'بعدی →']); ?>
                </div>
            <?php else : ?>
                <p style="color:var(--muted);text-align:center;padding:40px 0;">محتوایی در این دسته‌بندی یافت نشد.</p>
            <?php endif; ?>
        </div>
        <aside class="sidebar-column"><?php get_template_part('parts/sidebar'); ?></aside>
    </div>

</div>
</main>

<?php get_footer(); ?>
