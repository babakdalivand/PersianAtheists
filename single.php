<?php
/**
 * Single Post Template
 * Full article with featured image, content, author box, related posts
 */
get_header();
?>

<main class="site-main" id="main-content">
<div class="container" style="padding-top:40px;padding-bottom:80px;">
<div class="single-layout">

<?php while ( have_posts() ) : the_post(); ?>

    <!-- ARTICLE -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>

        <!-- BREADCRUMB -->
        <nav class="breadcrumb" aria-label="مسیر">
            <a href="<?php echo esc_url( home_url('/') ); ?>">خانه</a>
            <span class="breadcrumb-sep">›</span>
            <?php $cats = get_the_category(); if ($cats): ?>
                <a href="<?php echo esc_url( get_category_link($cats[0]->term_id) ); ?>"><?php echo esc_html($cats[0]->name); ?></a>
                <span class="breadcrumb-sep">›</span>
            <?php endif; ?>
            <span><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></span>
        </nav>

        <!-- HEADER -->
        <header class="article-header">
            <?php if ($cats): ?>
                <a href="<?php echo esc_url( get_category_link($cats[0]->term_id) ); ?>" class="card-category"><?php echo esc_html($cats[0]->name); ?></a>
            <?php endif; ?>

            <h1 class="article-title"><?php the_title(); ?></h1>

            <div class="article-meta">
                <div class="article-meta-author">
                    <?php echo get_avatar(get_the_author_meta('email'), 36, '', get_the_author(), ['class' => 'author-avatar']); ?>
                    <div>
                        <span class="author-name"><?php the_author(); ?></span>
                        <span class="meta-sep">·</span>
                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo pa_time_ago(); ?></time>
                        <span class="meta-sep">·</span>
                        <span><?php echo pa_reading_time(); ?> مطالعه</span>
                    </div>
                </div>

                <!-- Share buttons -->
                <div class="share-btns">
                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="share-btn share-twitter" title="اشتراک در X">𝕏</a>
                    <a href="https://t.me/share/url?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="share-btn share-telegram" title="اشتراک در تلگرام">✈</a>
                    <button class="share-btn share-copy" onclick="navigator.clipboard.writeText('<?php the_permalink(); ?>').then(()=>alert('لینک کپی شد!'))" title="کپی لینک">🔗</button>
                </div>
            </div>

            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="article-featured-img">
                    <?php the_post_thumbnail('pa-hero', ['class' => 'featured-img', 'alt' => get_the_title()]); ?>
                    <?php $caption = get_the_post_thumbnail_caption(); if ($caption): ?>
                        <figcaption class="img-caption"><?php echo esc_html($caption); ?></figcaption>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </header>

        <!-- CONTENT -->
        <div class="article-content entry-content">
            <?php the_content(); ?>
        </div>

        <!-- TAGS -->
        <?php $tags = get_the_tags(); if ($tags): ?>
            <div class="article-tags">
                <span class="tags-label">برچسب‌ها:</span>
                <?php foreach ($tags as $tag): ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-badge"><?php echo esc_html($tag->name); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- AUTHOR BOX -->
        <div class="author-box">
            <?php echo get_avatar(get_the_author_meta('email'), 72, '', get_the_author(), ['class' => 'author-box-avatar']); ?>
            <div class="author-box-info">
                <div class="author-box-name"><?php the_author(); ?></div>
                <p class="author-box-bio"><?php the_author_meta('description'); ?></p>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="btn btn-outline" style="font-size:12px;padding:6px 14px;">
                    مشاهده همه مقالات
                </a>
            </div>
        </div>

    </article>

    <!-- RELATED POSTS -->
    <?php
    $cats       = get_the_category();
    $cat_ids    = $cats ? array_map(fn($c) => $c->term_id, $cats) : [];
    $related    = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post__not_in'   => [get_the_ID()],
        'category__in'   => $cat_ids,
        'orderby'        => 'rand',
    ]);

    if ($related->have_posts()): ?>
        <section class="related-posts">
            <h2 class="section-title">مقالات مرتبط</h2>
            <div class="articles-grid">
                <?php while ($related->have_posts()): $related->the_post(); ?>
                    <article class="card article-card">
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('pa-card', ['class'=>'card-img','alt'=>get_the_title()]); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <?php $rc = get_the_category(); if($rc): ?>
                                <span class="card-category"><?php echo esc_html($rc[0]->name); ?></span>
                            <?php endif; ?>
                            <h3 class="card-title"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h3>
                            <div class="card-meta"><span><?php the_author(); ?></span> · <span><?php pa_time_ago(); ?></span></div>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- COMMENTS -->
    <?php if (comments_open() || get_comments_number()): ?>
        <div class="comments-wrap">
            <?php comments_template(); ?>
        </div>
    <?php endif; ?>

<?php endwhile; ?>

</div><!-- /single-layout -->
</div><!-- /container -->
</main>

<?php get_footer(); ?>
