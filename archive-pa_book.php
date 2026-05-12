<?php
/**
 * Archive Books — کتاب‌خانه Persian Atheists
 */
get_header();
$lang  = pa_current_lang();
$is_en = ($lang === 'en');

$books = new WP_Query([
    'post_type'      => 'pa_book',
    'posts_per_page' => 20,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>
<style>
.pb-archive-wrap { max-width:1100px; margin:0 auto; padding:32px 20px 60px; }
.pb-archive-header { text-align:center; margin-bottom:36px; }
.pb-archive-title { font-size:clamp(24px,3vw,36px); font-weight:900; color:var(--text); margin-bottom:8px; }
.pb-archive-sub { color:var(--muted); font-size:15px; }
.pb-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 24px;
}
.pb-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    transition: all .25s;
    display: flex;
    flex-direction: column;
}
.pb-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.15);
    border-color: var(--accent);
}
.pb-card-cover {
    width: 100%;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: var(--primary);
    position: relative;
}
.pb-card-cover img { width:100%; height:100%; object-fit:cover; display:block; transition: transform .3s; }
.pb-card:hover .pb-card-cover img { transform: scale(1.04); }
.pb-card-cover-ph {
    width:100%; height:100%;
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    background: linear-gradient(135deg, #1E2A38, #2d3f54);
    padding:16px; box-sizing:border-box;
}
.pb-card-cover-ph .ph-icon { font-size:48px; margin-bottom:10px; }
.pb-card-cover-ph .ph-title { font-size:13px; font-weight:700; color:#fff; text-align:center; line-height:1.4; }
.pb-card-cover-ph .ph-author { font-size:11px; color:rgba(255,255,255,0.5); text-align:center; margin-top:4px; }
.pb-card-body { padding:14px; flex:1; }
.pb-card-cat { font-size:10px; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:.5px; margin-bottom:5px; }
.pb-card-title { font-size:14px; font-weight:800; color:var(--text); line-height:1.35; margin-bottom:4px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.pb-card-author { font-size:12px; color:var(--muted); }
.pb-card-footer { padding:10px 14px; border-top:1px solid var(--border); display:flex; gap:6px; }
.pb-btn { display:inline-flex; align-items:center; gap:4px; padding:6px 10px; border-radius:6px; font-size:11px; font-weight:700; text-decoration:none; flex:1; justify-content:center; transition:all .2s; }
.pb-btn-dl { background:var(--accent); color:#fff; }
.pb-btn-dl:hover { background:#b8870e; color:#fff; }
.pb-btn-info { background:var(--bg); border:1px solid var(--border); color:var(--muted); }
.pb-btn-info:hover { border-color:var(--accent); color:var(--accent); }

@media(max-width:600px){
    .pb-grid { grid-template-columns: repeat(2, 1fr); gap:14px; }
}
</style>

<main class="site-main">
<div class="pb-archive-wrap">

    <div class="pb-archive-header">
        <h1 class="pb-archive-title">📚 <?php echo $is_en ? 'Library' : 'کتاب‌خانه'; ?></h1>
        <p class="pb-archive-sub">
            <?php echo $is_en
                ? 'Books on atheism, philosophy, science and freethinking'
                : 'کتاب‌هایی درباره آتئیسم، فلسفه، علم و آزاداندیشی'; ?>
        </p>
    </div>

    <?php if ($books->have_posts()): ?>
    <div class="pb-grid">
        <?php while ($books->have_posts()): $books->the_post();
            $pid      = get_the_ID();
            $cover    = get_post_meta($pid, 'pa_book_cover', true);
            $author   = get_post_meta($pid, 'pa_book_author', true);
            $author_en= get_post_meta($pid, 'pa_book_author_en', true);
            $title_en = get_post_meta($pid, 'pa_book_title_en', true);
            $dl       = get_post_meta($pid, 'pa_book_download', true);
            $cat      = get_post_meta($pid, 'pa_book_category', true);
            $has_thumb = has_post_thumbnail($pid);
        ?>
        <div class="pb-card">
            <a href="<?php the_permalink(); ?>" class="pb-card-cover">
                <?php if ($has_thumb): ?>
                    <?php the_post_thumbnail('pa-card'); ?>
                <?php elseif ($cover): ?>
                    <img src="<?php echo esc_url($cover); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                <?php else: ?>
                    <div class="pb-card-cover-ph">
                        <div class="ph-icon">📖</div>
                        <div class="ph-title"><?php echo $is_en ? esc_html($title_en ?: get_the_title()) : get_the_title(); ?></div>
                        <div class="ph-author"><?php echo $is_en ? esc_html($author_en) : esc_html($author); ?></div>
                    </div>
                <?php endif; ?>
            </a>
            <div class="pb-card-body">
                <?php if ($cat): ?><div class="pb-card-cat"><?php echo esc_html($cat); ?></div><?php endif; ?>
                <div class="pb-card-title">
                    <a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;">
                        <?php echo $is_en ? esc_html($title_en ?: get_the_title()) : get_the_title(); ?>
                    </a>
                </div>
                <div class="pb-card-author"><?php echo $is_en ? esc_html($author_en) : esc_html($author); ?></div>
            </div>
            <div class="pb-card-footer">
                <?php if ($dl): ?>
                    <a href="<?php echo esc_url($dl); ?>" target="_blank" rel="noopener" class="pb-btn pb-btn-dl">
                        ⬇ <?php echo $is_en ? 'Download' : 'دانلود'; ?>
                    </a>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>" class="pb-btn pb-btn-info">
                    ℹ <?php echo $is_en ? 'Info' : 'اطلاعات'; ?>
                </a>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php else: ?>
        <p style="text-align:center;color:var(--muted);padding:40px;"><?php echo $is_en ? 'No books yet.' : 'هنوز کتابی اضافه نشده.'; ?></p>
    <?php endif; ?>

</div>
</main>

<?php get_footer(); ?>
