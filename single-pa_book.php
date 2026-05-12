<?php
/**
 * Single Book — معرفی کتاب
 */
get_header();
$lang  = pa_current_lang();
$is_en = ($lang === 'en');
$pid   = get_queried_object_id();
$post  = get_post($pid);
if (!$post) { get_footer(); exit; }

$cover    = get_post_meta($pid, 'pa_book_cover', true);
$title_en = get_post_meta($pid, 'pa_book_title_en', true);
$author   = get_post_meta($pid, 'pa_book_author', true);
$author_en= get_post_meta($pid, 'pa_book_author_en', true);
$year     = get_post_meta($pid, 'pa_book_year', true);
$pages    = get_post_meta($pid, 'pa_book_pages', true);
$lang_b   = get_post_meta($pid, 'pa_book_lang', true);
$isbn     = get_post_meta($pid, 'pa_book_isbn', true);
$dl       = get_post_meta($pid, 'pa_book_download', true);
$buy      = get_post_meta($pid, 'pa_book_buy', true);
$cat      = get_post_meta($pid, 'pa_book_category', true);
$content  = get_the_content(null, false, $pid);
?>
<style>
.pb-wrap { max-width:860px; margin:0 auto; padding:28px 20px 60px; }
.pb-bread { display:flex; gap:6px; align-items:center; font-size:13px; color:var(--muted); margin-bottom:20px; flex-wrap:wrap; }
.pb-bread a { color:var(--muted); text-decoration:none; }
.pb-bread a:hover { color:var(--accent); }

/* Hero */
.pb-hero {
    display: flex;
    gap: 28px;
    align-items: flex-start;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

/* Cover */
.pb-cover-wrap {
    flex-shrink: 0;
    width: 160px;
}
.pb-cover {
    width: 160px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 8px 28px rgba(0,0,0,0.2);
    aspect-ratio: 3/4;
    background: linear-gradient(135deg, #1E2A38, #2d3f54);
    display: flex; align-items: center; justify-content: center;
}
.pb-cover img { width:100%; height:100%; object-fit:cover; display:block; }
.pb-cover-ph { font-size:52px; }

/* Info */
.pb-info { flex:1; min-width:200px; }
.pb-cat { font-size:11px; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:1px; margin-bottom:10px; }
.pb-title { font-size:clamp(20px,3vw,28px); font-weight:900; color:var(--text); line-height:1.3; margin-bottom:4px; }
.pb-title-en { font-size:14px; color:var(--muted); margin-bottom:16px; font-style:italic; }
.pb-author { font-size:16px; font-weight:700; color:var(--text); margin-bottom:16px; }
.pb-author-en { font-size:13px; color:var(--muted); }

/* Meta table */
.pb-meta { display:flex; flex-direction:column; gap:8px; margin-bottom:20px; }
.pb-meta-row { display:flex; gap:10px; align-items:center; font-size:13px; }
.pb-meta-label { color:var(--muted); min-width:80px; flex-shrink:0; }
.pb-meta-val { color:var(--text); font-weight:600; }

/* Action buttons */
.pb-actions { display:flex; gap:10px; flex-wrap:wrap; }
.pb-btn-main {
    display:inline-flex; align-items:center; gap:8px;
    padding:12px 20px; border-radius:10px;
    font-size:14px; font-weight:700; text-decoration:none;
    transition:all .2s;
}
.pb-btn-dl { background:var(--accent); color:#fff; }
.pb-btn-dl:hover { background:#b8870e; color:#fff; transform:translateY(-1px); }
.pb-btn-buy { background:var(--surface); border:2px solid var(--border); color:var(--text); }
.pb-btn-buy:hover { border-color:var(--accent); color:var(--accent); }
.pb-btn-share { background:var(--bg); border:1px solid var(--border); color:var(--muted); padding:10px 14px; }
.pb-btn-share:hover { border-color:var(--accent); color:var(--accent); }

/* Description */
.pb-desc { background:var(--surface); border:1px solid var(--border); border-radius:12px; padding:24px; margin-bottom:24px; }
.pb-desc-title { font-size:16px; font-weight:800; color:var(--text); margin-bottom:14px; padding-bottom:10px; border-bottom:1px solid var(--border); }
.pb-desc-body { font-size:15px; line-height:1.8; color:var(--muted); }
.pb-desc-body h2 { font-size:18px; font-weight:800; color:var(--text); margin:20px 0 10px; }
.pb-desc-body ul { padding-right:20px; margin-bottom:14px; }
body.lang-en .pb-desc-body ul { padding-left:20px; padding-right:0; }
.pb-desc-body li { margin-bottom:6px; }
.pb-desc-body blockquote { border-right:3px solid var(--accent); padding:10px 16px; margin:16px 0; background:rgba(212,160,23,0.06); border-radius:0 8px 8px 0; color:var(--muted); font-style:italic; }
body.lang-en .pb-desc-body blockquote { border-right:none; border-left:3px solid var(--accent); border-radius:8px 0 0 8px; }

/* More books */
.pb-more-title { font-size:18px; font-weight:800; color:var(--text); margin-bottom:16px; padding-bottom:8px; border-bottom:2px solid var(--accent); display:inline-block; }
.pb-more-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(150px,1fr)); gap:16px; }
.pb-more-item { background:var(--surface); border:1px solid var(--border); border-radius:10px; overflow:hidden; text-decoration:none; transition:all .2s; }
.pb-more-item:hover { transform:translateY(-3px); border-color:var(--accent); }
.pb-more-cover { width:100%; aspect-ratio:3/4; overflow:hidden; background:var(--primary); }
.pb-more-cover img { width:100%; height:100%; object-fit:cover; }
.pb-more-cover-ph { width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:36px; background:linear-gradient(135deg,#1E2A38,#2d3f54); }
.pb-more-body { padding:10px; }
.pb-more-item-title { font-size:12px; font-weight:700; color:var(--text); line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.pb-more-item-author { font-size:11px; color:var(--muted); margin-top:3px; }

@media(max-width:600px){
    .pb-hero { flex-direction:column; padding:18px; }
    .pb-cover-wrap { width:120px; }
    .pb-cover { width:120px; }
    .pb-more-grid { grid-template-columns:repeat(3,1fr); }
}
</style>

<main class="site-main">
<div class="pb-wrap">

    <!-- Breadcrumb -->
    <nav class="pb-bread">
        <?php if ($is_en): ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span style="opacity:.4">›</span>
            <a href="<?php echo esc_url(home_url('/books')); ?>">Library</a>
            <span style="opacity:.4">›</span>
            <span><?php echo esc_html($title_en ?: get_the_title($pid)); ?></span>
        <?php else: ?>
            <span><?php echo wp_trim_words(get_the_title($pid), 5, '...'); ?></span>
            <span style="opacity:.4">‹</span>
            <a href="<?php echo esc_url(home_url('/books')); ?>">کتاب‌خانه</a>
            <span style="opacity:.4">‹</span>
            <a href="<?php echo esc_url(home_url('/')); ?>">خانه</a>
        <?php endif; ?>
    </nav>

    <!-- Hero -->
    <div class="pb-hero">

        <!-- Cover -->
        <div class="pb-cover-wrap">
            <div class="pb-cover">
                <?php if (has_post_thumbnail($pid)): ?>
                    <?php echo get_the_post_thumbnail($pid, 'pa-card'); ?>
                <?php elseif ($cover): ?>
                    <img src="<?php echo esc_url($cover); ?>" alt="<?php echo esc_attr(get_the_title($pid)); ?>" loading="lazy">
                <?php else: ?>
                    <div class="pb-cover-ph">📖</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Info -->
        <div class="pb-info">
            <?php if ($cat): ?><div class="pb-cat">📚 <?php echo esc_html($cat); ?></div><?php endif; ?>

            <h1 class="pb-title"><?php echo $is_en ? esc_html($title_en ?: get_the_title($pid)) : get_the_title($pid); ?></h1>
            <?php if ($is_en && get_the_title($pid)): ?>
                <div class="pb-title-en"><?php echo get_the_title($pid); ?></div>
            <?php elseif (!$is_en && $title_en): ?>
                <div class="pb-title-en"><?php echo esc_html($title_en); ?></div>
            <?php endif; ?>

            <div class="pb-author">
                <?php echo $is_en ? esc_html($author_en) : esc_html($author); ?>
                <?php if ($is_en && $author): ?>
                    <span class="pb-author-en">(<?php echo esc_html($author); ?>)</span>
                <?php elseif (!$is_en && $author_en): ?>
                    <span class="pb-author-en">(<?php echo esc_html($author_en); ?>)</span>
                <?php endif; ?>
            </div>

            <!-- Meta -->
            <div class="pb-meta">
                <?php if ($year): ?>
                <div class="pb-meta-row">
                    <span class="pb-meta-label"><?php echo $is_en ? '📅 Year:' : '📅 سال:'; ?></span>
                    <span class="pb-meta-val"><?php echo esc_html($year); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($pages): ?>
                <div class="pb-meta-row">
                    <span class="pb-meta-label"><?php echo $is_en ? '📄 Pages:' : '📄 صفحات:'; ?></span>
                    <span class="pb-meta-val"><?php echo esc_html($pages); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($lang_b): ?>
                <div class="pb-meta-row">
                    <span class="pb-meta-label"><?php echo $is_en ? '🌐 Language:' : '🌐 زبان:'; ?></span>
                    <span class="pb-meta-val"><?php echo esc_html($lang_b); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($isbn): ?>
                <div class="pb-meta-row">
                    <span class="pb-meta-label">ISBN:</span>
                    <span class="pb-meta-val" style="font-family:monospace;font-size:12px;"><?php echo esc_html($isbn); ?></span>
                </div>
                <?php endif; ?>
            </div>

            <!-- Actions -->
            <div class="pb-actions">
                <?php if ($dl): ?>
                    <a href="<?php echo esc_url($dl); ?>" target="_blank" rel="noopener" class="pb-btn-main pb-btn-dl">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <?php echo $is_en ? 'Free Download' : 'دانلود رایگان'; ?>
                    </a>
                <?php endif; ?>
                <?php if ($buy): ?>
                    <a href="<?php echo esc_url($buy); ?>" target="_blank" rel="noopener" class="pb-btn-main pb-btn-buy">
                        🛒 <?php echo $is_en ? 'Buy' : 'خرید'; ?>
                    </a>
                <?php endif; ?>
                <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink($pid)); ?>&text=<?php echo urlencode(get_the_title($pid)); ?>"
                   target="_blank" rel="noopener" class="pb-btn-main pb-btn-share" title="Telegram">✈</a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink($pid)); ?>&text=<?php echo urlencode(get_the_title($pid)); ?>"
                   target="_blank" rel="noopener" class="pb-btn-main pb-btn-share" title="X">𝕏</a>
            </div>
        </div>
    </div>

    <!-- Description -->
    <?php if ($content): ?>
    <div class="pb-desc">
        <div class="pb-desc-title">📖 <?php echo $is_en ? 'About This Book' : 'درباره این کتاب'; ?></div>
        <div class="pb-desc-body"><?php echo apply_filters('the_content', $content); ?></div>
    </div>
    <?php elseif (get_the_excerpt($pid)): ?>
    <div class="pb-desc">
        <div class="pb-desc-title">📖 <?php echo $is_en ? 'About This Book' : 'درباره این کتاب'; ?></div>
        <div class="pb-desc-body"><p><?php echo get_the_excerpt($pid); ?></p></div>
    </div>
    <?php endif; ?>

    <!-- More Books -->
    <?php
    $more_q = new WP_Query(array('post_type'=>'pa_book','posts_per_page'=>6,'post__not_in'=>array($pid),'post_status'=>'publish','orderby'=>'date','order'=>'DESC'));
    if ($more_q instanceof WP_Query && $more_q->have_posts()):
    ?>
    <div style="margin-top:8px;">
        <div class="pb-more-title"><?php echo $is_en ? 'More Books' : 'کتاب‌های بیشتر'; ?></div>
        <div class="pb-more-grid">
            <?php while ($more_q->have_posts()): $more_q->the_post();
                $mc = get_post_meta(get_the_ID(), 'pa_book_cover', true);
                $ma = get_post_meta(get_the_ID(), 'pa_book_author', true);
                $ma_en = get_post_meta(get_the_ID(), 'pa_book_author_en', true);
                $mt = get_post_meta(get_the_ID(), 'pa_book_title_en', true);
            ?>
            <a href="<?php the_permalink(); ?>" class="pb-more-item">
                <div class="pb-more-cover">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('pa-thumb', ['style'=>'width:100%;height:100%;object-fit:cover;']);
                    elseif ($mc): ?><img src="<?php echo esc_url($mc); ?>" alt="" loading="lazy">
                    <?php else: ?><div class="pb-more-cover-ph">📖</div><?php endif; ?>
                </div>
                <div class="pb-more-body">
                    <div class="pb-more-item-title"><?php echo $is_en ? esc_html($mt ?: get_the_title()) : get_the_title(); ?></div>
                    <div class="pb-more-item-author"><?php echo $is_en ? esc_html($ma_en) : esc_html($ma); ?></div>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif; ?>

</div>
</main>

<?php wp_reset_postdata(); get_footer(); ?>
