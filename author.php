<?php
/**
 * Author Archive Template
 */
get_header();
$author = get_queried_object();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">

    <!-- AUTHOR PROFILE -->
    <div style="background:linear-gradient(135deg,var(--primary) 0%,#2d3f54 100%);border-radius:var(--radius);padding:40px;margin-bottom:40px;display:flex;gap:28px;align-items:center;flex-wrap:wrap;">
        <div>
            <?php echo get_avatar($author->user_email, 96, '', $author->display_name, ['style'=>'border-radius:50%;border:3px solid var(--accent);']); ?>
        </div>
        <div>
            <div style="font-size:12px;font-weight:700;color:var(--accent);margin-bottom:6px;letter-spacing:1px;">نویسنده</div>
            <h1 style="color:#fff;font-size:26px;font-weight:800;margin-bottom:8px;"><?php echo esc_html($author->display_name); ?></h1>
            <?php if ($author->description) : ?>
                <p style="color:rgba(255,255,255,0.7);font-size:14px;line-height:1.7;max-width:560px;"><?php echo esc_html($author->description); ?></p>
            <?php endif; ?>
            <div style="display:flex;gap:16px;margin-top:14px;font-size:13px;color:rgba(255,255,255,0.55);">
                <span><?php printf('%d مقاله', count_user_posts($author->ID, 'post')); ?></span>
                <?php if ($author->user_url) : ?>
                    <a href="<?php echo esc_url($author->user_url); ?>" target="_blank" rel="noopener" style="color:var(--accent);">وب‌سایت ↗</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ARTICLES -->
    <div class="home-layout">
        <div class="main-column">
            <h2 class="section-title">مقالات <?php echo esc_html($author->display_name); ?></h2>

            <?php if (have_posts()) : ?>
                <div class="articles-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="card article-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pa-card',['class'=>'card-img','alt'=>get_the_title()]); ?></a>
                            <?php endif; ?>
                            <div class="card-body">
                                <?php $cats=get_the_category(); if($cats): ?><span class="card-category"><?php echo esc_html($cats[0]->name); ?></span><?php endif; ?>
                                <h3 class="card-title"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h3>
                                <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(),14,'...'); ?></p>
                                <div class="card-meta" style="margin-top:10px;">
                                    <span><?php echo pa_time_ago(); ?></span>
                                    <span>·</span>
                                    <span><?php echo pa_reading_time(); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <div class="archive-pagination">
                    <?php the_posts_pagination(['prev_text'=>'← قبلی','next_text'=>'بعدی →']); ?>
                </div>
            <?php else : ?>
                <div class="no-results" style="text-align:center;padding:40px 0;">
                    <p style="color:var(--muted);">هنوز مقاله‌ای منتشر نشده.</p>
                </div>
            <?php endif; ?>
        </div>

        <aside class="sidebar-column"><?php get_template_part('parts/sidebar'); ?></aside>
    </div>

</div>
</main>

<?php get_footer(); ?>
