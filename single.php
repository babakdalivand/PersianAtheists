<?php
/**
 * Single Post Template — Bilingual
 */
get_header();

$lang  = pa_current_lang();
$is_en = ($lang === 'en');

$t = [
    'home'          => $is_en ? 'Home'              : 'خانه',
    'read_time'     => $is_en ? 'min read'           : 'دقیقه مطالعه',
    'share'         => $is_en ? 'Share'              : 'اشتراک‌گذاری',
    'copy_link'     => $is_en ? 'Link copied!'       : 'لینک کپی شد!',
    'tags'          => $is_en ? 'Tags:'              : 'برچسب‌ها:',
    'all_articles'  => $is_en ? 'All Articles'       : 'همه مقالات',
    'related'       => $is_en ? 'Related Articles'   : 'مقالات مرتبط',
    'comments'      => $is_en ? 'Comments'           : 'نظرات',
];
?>

<style>
.single-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 32px;
    max-width: 1140px;
    margin: 0 auto;
    padding: 40px 0 80px;
}

[dir="rtl"] .single-layout { direction: rtl; }

.single-article { min-width: 0; }

/* Breadcrumb */
.pa-breadcrumb {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; color: var(--muted);
    margin-bottom: 28px; flex-wrap: wrap;
}
.pa-breadcrumb a { color: var(--muted); text-decoration: none; transition: color .2s; }
.pa-breadcrumb a:hover { color: var(--accent); }
.pa-breadcrumb-sep { opacity: .4; }

/* Article header */
.pa-article-cat {
    display: inline-block;
    font-size: 11px; font-weight: 700;
    color: var(--accent);
    background: rgba(212,160,23,0.1);
    border: 1px solid rgba(212,160,23,0.25);
    padding: 4px 12px; border-radius: 20px;
    margin-bottom: 16px;
    text-decoration: none;
    letter-spacing: .5px; text-transform: uppercase;
}

.pa-article-title {
    font-size: clamp(22px, 3vw, 34px);
    font-weight: 900; line-height: 1.3;
    color: var(--text); margin-bottom: 20px;
}

/* Meta */
.pa-article-meta {
    display: flex; align-items: center;
    justify-content: space-between;
    flex-wrap: wrap; gap: 12px;
    padding: 14px 0;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    margin-bottom: 24px;
}

.pa-meta-author {
    display: flex; align-items: center; gap: 10px;
}

.pa-meta-author img {
    width: 38px; height: 38px;
    border-radius: 50%;
    object-fit: cover;
}

.pa-author-name { font-size: 14px; font-weight: 700; color: var(--text); }
.pa-meta-info { font-size: 12px; color: var(--muted); display: flex; gap: 6px; align-items: center; flex-wrap: wrap; margin-top: 2px; }
.pa-meta-dot { opacity: .4; }

/* Share buttons */
.pa-share-btns { display: flex; gap: 8px; }
.pa-share-btn {
    width: 34px; height: 34px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--surface);
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; color: var(--muted);
    font-size: 14px; cursor: pointer;
    transition: all .2s;
}
.pa-share-btn:hover { border-color: var(--accent); color: var(--accent); }

/* Featured image */
.pa-featured-img {
    border-radius: var(--radius);
    overflow: hidden;
    margin-bottom: 28px;
}
.pa-featured-img img { width: 100%; height: auto; display: block; }
.pa-img-caption {
    font-size: 12px; color: var(--muted);
    text-align: center; padding: 8px;
    background: var(--bg);
}

/* Article content */
.pa-article-content {
    font-size: 17px; line-height: 1.9;
    color: var(--text); margin-bottom: 32px;
}

[dir="rtl"] .pa-article-content { text-align: right; }
[dir="ltr"] .pa-article-content { text-align: left; }

.pa-article-content h2 { font-size: 22px; font-weight: 800; margin: 32px 0 16px; color: var(--text); }
.pa-article-content h3 { font-size: 18px; font-weight: 700; margin: 24px 0 12px; color: var(--text); }
.pa-article-content p  { margin-bottom: 18px; }
.pa-article-content a  { color: var(--accent); text-decoration: underline; }
.pa-article-content ul, .pa-article-content ol { padding-right: 24px; margin-bottom: 18px; }
[dir="ltr"] .pa-article-content ul,
[dir="ltr"] .pa-article-content ol { padding-left: 24px; padding-right: 0; }
.pa-article-content li { margin-bottom: 8px; }
.pa-article-content blockquote {
    border-right: 4px solid var(--accent);
    padding: 12px 20px; margin: 20px 0;
    background: rgba(212,160,23,0.06);
    border-radius: 0 8px 8px 0;
    font-style: italic; color: var(--muted);
}
[dir="ltr"] .pa-article-content blockquote {
    border-right: none;
    border-left: 4px solid var(--accent);
    border-radius: 8px 0 0 8px;
}
.pa-article-content img { max-width: 100%; border-radius: 8px; margin: 16px 0; }
.pa-article-content code {
    background: var(--bg); padding: 2px 6px;
    border-radius: 4px; font-size: 14px;
}
.pa-article-content pre {
    background: var(--bg); padding: 16px;
    border-radius: 8px; overflow-x: auto;
    margin-bottom: 18px;
}

/* Tags */
.pa-article-tags {
    display: flex; align-items: center; gap: 8px;
    flex-wrap: wrap; margin-bottom: 32px;
}
.pa-tags-label { font-size: 13px; color: var(--muted); font-weight: 600; }
.pa-tag {
    font-size: 12px; padding: 4px 12px;
    border-radius: 20px;
    background: var(--bg);
    border: 1px solid var(--border);
    color: var(--muted);
    text-decoration: none;
    transition: all .2s;
}
.pa-tag:hover { border-color: var(--accent); color: var(--accent); }

/* Author box */
.pa-author-box {
    display: flex; gap: 18px; align-items: flex-start;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px; margin-bottom: 40px;
}
.pa-author-box img {
    width: 72px; height: 72px;
    border-radius: 50%; object-fit: cover; flex-shrink: 0;
}
.pa-author-box-name { font-size: 16px; font-weight: 800; color: var(--text); margin-bottom: 6px; }
.pa-author-box-bio { font-size: 14px; color: var(--muted); line-height: 1.7; margin-bottom: 12px; }

/* Related */
.pa-related { margin-bottom: 40px; }
.pa-related-title {
    font-size: 20px; font-weight: 800;
    color: var(--text); margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--accent);
    display: inline-block;
}
.pa-related-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; }

/* Sidebar */
.pa-single-sidebar { min-width: 0; }

.pa-sidebar-widget {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px; margin-bottom: 20px;
}
.pa-sidebar-title {
    font-size: 15px; font-weight: 800;
    color: var(--text); margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--accent);
}

/* Responsive */
@media (max-width: 900px) {
    .single-layout { grid-template-columns: 1fr; }
    .pa-single-sidebar { display: none; }
    .pa-related-grid { grid-template-columns: repeat(2,1fr); }
}

@media (max-width: 600px) {
    .pa-article-title { font-size: 22px; }
    .pa-article-content { font-size: 16px; }
    .pa-related-grid { grid-template-columns: 1fr; }
    .pa-author-box { flex-direction: column; }
}
</style>

<main class="site-main" id="main-content">
<div class="container">
<div class="single-layout">

<!-- ═══ MAIN CONTENT ═══ -->
<div class="single-article">
<?php while (have_posts()): the_post();
    $cats = get_the_category();
?>

    <!-- Breadcrumb -->
    <nav class="pa-breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo $t['home']; ?></a>
        <span class="pa-breadcrumb-sep">›</span>
        <?php if ($cats): ?>
            <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>"><?php echo esc_html($cats[0]->name); ?></a>
            <span class="pa-breadcrumb-sep">›</span>
        <?php endif; ?>
        <span><?php echo wp_trim_words(get_the_title(), 7, '...'); ?></span>
    </nav>

    <!-- Category badge -->
    <?php if ($cats): ?>
        <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="pa-article-cat">
            <?php echo esc_html($cats[0]->name); ?>
        </a>
    <?php endif; ?>

    <!-- Title -->
    <h1 class="pa-article-title"><?php the_title(); ?></h1>

    <!-- Meta -->
    <div class="pa-article-meta">
        <div class="pa-meta-author">
            <?php echo get_avatar(get_the_author_meta('email'), 38, '', get_the_author(), ['class'=>'']); ?>
            <div>
                <div class="pa-author-name"><?php the_author(); ?></div>
                <div class="pa-meta-info">
                    <span><?php echo pa_time_ago(); ?></span>
                    <span class="pa-meta-dot">·</span>
                    <span><?php echo pa_reading_time(); ?></span>
                </div>
            </div>
        </div>
        <div class="pa-share-btns">
            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="pa-share-btn" title="X / Twitter">𝕏</a>
            <a href="https://t.me/share/url?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="pa-share-btn" title="Telegram">✈</a>
            <button class="pa-share-btn" title="<?php echo $is_en ? 'Copy link' : 'کپی لینک'; ?>"
                onclick="navigator.clipboard.writeText('<?php the_permalink(); ?>').then(()=>this.textContent='✓').catch(()=>{})">🔗</button>
        </div>
    </div>

    <!-- Featured Image -->
    <?php if (has_post_thumbnail()): ?>
        <div class="pa-featured-img">
            <?php the_post_thumbnail('pa-hero', ['alt'=>get_the_title()]); ?>
            <?php $cap = get_the_post_thumbnail_caption(); if ($cap): ?>
                <div class="pa-img-caption"><?php echo esc_html($cap); ?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Content -->
    <div class="pa-article-content">
        <?php the_content(); ?>
    </div>

    <!-- Tags -->
    <?php $tags = get_the_tags(); if ($tags): ?>
        <div class="pa-article-tags">
            <span class="pa-tags-label"><?php echo $t['tags']; ?></span>
            <?php foreach ($tags as $tag): ?>
                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="pa-tag"><?php echo esc_html($tag->name); ?></a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Author Box -->
    <div class="pa-author-box">
        <?php echo get_avatar(get_the_author_meta('email'), 72, '', get_the_author()); ?>
        <div>
            <div class="pa-author-box-name"><?php the_author(); ?></div>
            <p class="pa-author-box-bio"><?php echo nl2br(esc_html(get_the_author_meta('description'))); ?></p>
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="btn btn-outline" style="font-size:12px;padding:6px 14px;">
                <?php echo $t['all_articles']; ?> →
            </a>
        </div>
    </div>

    <!-- Related Posts -->
    <?php
    $related = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post__not_in'   => [get_the_ID()],
        'category__in'   => $cats ? array_map(fn($c) => $c->term_id, $cats) : [],
        'orderby'        => 'rand',
        'post_status'    => 'publish',
    ]);
    if ($related->have_posts()): ?>
        <section class="pa-related">
            <div class="pa-related-title"><?php echo $t['related']; ?></div>
            <div class="pa-related-grid">
                <?php while ($related->have_posts()): $related->the_post(); ?>
                    <article class="pa-card">
                        <a href="<?php the_permalink(); ?>" class="pa-card-thumb">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('pa-card', ['alt'=>get_the_title()]); ?>
                            <?php else: ?>
                                <div class="pa-card-thumb-placeholder">📰</div>
                            <?php endif; ?>
                        </a>
                        <div class="pa-card-body">
                            <h3 class="pa-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="pa-card-footer">
                                <span><?php the_author(); ?></span>
                                <span><?php echo pa_time_ago(); ?></span>
                            </div>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- Comments -->
    <?php if (comments_open() || get_comments_number()): ?>
        <div class="pa-comments-wrap">
            <?php comments_template(); ?>
        </div>
    <?php endif; ?>

<?php endwhile; ?>
</div>

<!-- ═══ SIDEBAR ═══ -->
<aside class="pa-single-sidebar">

    <!-- Recent Posts -->
    <?php
    $recent = new WP_Query(['post_type'=>'post','posts_per_page'=>5,'post_status'=>'publish']);
    if ($recent->have_posts()):
    ?>
    <div class="pa-sidebar-widget">
        <div class="pa-sidebar-title"><?php echo $is_en ? 'Recent Articles' : 'آخرین مقالات'; ?></div>
        <div style="display:flex;flex-direction:column;gap:14px;">
            <?php while ($recent->have_posts()): $recent->the_post(); ?>
                <div style="display:flex;gap:10px;align-items:flex-start;">
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>" style="flex-shrink:0;">
                            <?php the_post_thumbnail('pa-thumb', ['style'=>'width:60px;height:60px;object-fit:cover;border-radius:8px;display:block;','alt'=>get_the_title()]); ?>
                        </a>
                    <?php endif; ?>
                    <div>
                        <a href="<?php the_permalink(); ?>" style="font-size:13px;font-weight:700;color:var(--text);text-decoration:none;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;line-height:1.4;"><?php the_title(); ?></a>
                        <div style="font-size:11px;color:var(--muted);margin-top:4px;"><?php echo pa_time_ago(); ?></div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Recent Videos -->
    <?php
    $svids = new WP_Query(['post_type'=>'pa_video','posts_per_page'=>3,'post_status'=>'publish']);
    if ($svids->have_posts()):
    ?>
    <div class="pa-sidebar-widget">
        <div class="pa-sidebar-title"><?php echo $is_en ? 'Latest Videos' : 'آخرین ویدیوها'; ?></div>
        <div style="display:flex;flex-direction:column;gap:12px;">
            <?php while ($svids->have_posts()): $svids->the_post();
                $sid = pa_get_youtube_id();
            ?>
                <a href="<?php the_permalink(); ?>" style="display:flex;gap:10px;text-decoration:none;">
                    <div style="width:80px;height:50px;border-radius:6px;overflow:hidden;flex-shrink:0;background:var(--primary);">
                        <?php if ($sid): ?>
                            <img src="https://img.youtube.com/vi/<?php echo esc_attr($sid); ?>/mqdefault.jpg" style="width:100%;height:100%;object-fit:cover;" alt="">
                        <?php elseif (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('pa-thumb', ['style'=>'width:100%;height:100%;object-fit:cover;']); ?>
                        <?php endif; ?>
                    </div>
                    <div style="font-size:12px;font-weight:600;color:var(--text);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;"><?php the_title(); ?></div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Recent Podcasts -->
    <?php
    $spods = new WP_Query(['post_type'=>'pa_podcast','posts_per_page'=>3,'post_status'=>'publish']);
    if ($spods->have_posts()):
    ?>
    <div class="pa-sidebar-widget">
        <div class="pa-sidebar-title"><?php echo $is_en ? 'Latest Podcasts' : 'آخرین پادکست‌ها'; ?></div>
        <div style="display:flex;flex-direction:column;gap:12px;">
            <?php while ($spods->have_posts()): $spods->the_post();
                $sep = get_post_meta(get_the_ID(),'pa_episode_number',true);
            ?>
                <a href="<?php the_permalink(); ?>" style="display:flex;gap:10px;text-decoration:none;align-items:center;">
                    <div style="width:48px;height:48px;border-radius:8px;overflow:hidden;flex-shrink:0;background:var(--primary);display:flex;align-items:center;justify-content:center;">
                        <?php if (has_post_thumbnail()): the_post_thumbnail('pa-square',['style'=>'width:100%;height:100%;object-fit:cover;']);
                        else: echo '<span style="font-size:20px;">🎙️</span>'; endif; ?>
                    </div>
                    <div>
                        <?php if ($sep): ?><div style="font-size:10px;color:var(--accent);font-weight:700;"><?php echo $is_en ? 'Ep.' : 'پادکست'; ?> <?php echo esc_html($sep); ?></div><?php endif; ?>
                        <div style="font-size:12px;font-weight:600;color:var(--text);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;"><?php the_title(); ?></div>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>

</aside>

</div><!-- /single-layout -->
</div><!-- /container -->
</main>

<?php get_footer(); ?>
