<?php
/**
 * Category Archive — Modern Design
 */
get_header();
$cat   = get_queried_object();
$color = '#EB5E28';
?>
<main class="site-main">

<style>
.pa-cat-hero {
    background: linear-gradient(135deg, #1A1714 0%, #2A2320 100%);
    padding: 48px 0 40px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 0;
}
.pa-cat-hero-inner { display:flex; align-items:center; gap:20px; }
.pa-cat-icon {
    width:60px; height:60px; border-radius:16px;
    background: rgba(235,94,40,0.15);
    border: 1px solid rgba(235,94,40,0.3);
    display:flex; align-items:center; justify-content:center;
    font-size:28px; flex-shrink:0;
}
.pa-cat-badge {
    display:inline-flex; align-items:center; gap:6px;
    background:rgba(235,94,40,0.15); border:1px solid rgba(235,94,40,0.3);
    border-radius:20px; padding:3px 12px; font-size:11px;
    color:var(--accent); font-weight:700; margin-bottom:10px;
    letter-spacing:.5px;
}
.pa-cat-title { font-size:clamp(22px,3vw,36px); font-weight:900; color:#FFFCF2; margin:0 0 8px; }
.pa-cat-desc { font-size:14px; color:rgba(255,255,255,0.5); margin:0; }
.pa-cat-count {
    margin-right:auto; text-align:center;
    background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);
    border-radius:12px; padding:12px 20px;
}
.pa-cat-count-num { font-size:28px; font-weight:900; color:var(--accent); line-height:1; }
.pa-cat-count-label { font-size:11px; color:rgba(255,255,255,0.45); margin-top:2px; }

.pa-cat-content { padding:40px 0 60px; }
.pa-cat-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:24px;
}
.pa-cat-card {
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:16px;
    overflow:hidden;
    transition:transform .2s, box-shadow .2s, border-color .2s;
    text-decoration:none; display:block; color:inherit;
}
.pa-cat-card:hover {
    transform:translateY(-3px);
    box-shadow:0 8px 30px rgba(0,0,0,0.12);
    border-color:var(--accent);
}
.pa-cat-card-thumb {
    aspect-ratio:16/9; overflow:hidden; background:var(--bg);
    position:relative;
}
.pa-cat-card-thumb img { width:100%;height:100%;object-fit:cover;transition:transform .3s; }
.pa-cat-card:hover .pa-cat-card-thumb img { transform:scale(1.04); }
.pa-cat-card-thumb-placeholder {
    width:100%;height:100%;display:flex;align-items:center;justify-content:center;
    background:linear-gradient(135deg,var(--surface),var(--bg));
    font-size:48px;
}
.pa-cat-card-body { padding:16px; }
.pa-cat-card-meta {
    display:flex;align-items:center;gap:8px;margin-bottom:8px;
}
.pa-cat-card-type {
    font-size:10px;font-weight:800;color:var(--accent);
    background:rgba(235,94,40,0.1);border:1px solid rgba(235,94,40,0.2);
    border-radius:8px;padding:2px 8px;
}
.pa-cat-card-date { font-size:11px;color:var(--muted); }
.pa-cat-card-title {
    font-size:15px;font-weight:700;color:var(--text);
    line-height:1.4;margin:0 0 8px;
    display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
}
.pa-cat-card-author { font-size:12px;color:var(--muted); }
.pa-cat-empty {
    text-align:center;padding:80px 20px;
    color:var(--muted);
}
.pa-cat-empty-icon { font-size:64px;margin-bottom:16px;display:block; }
.pa-cat-pagination { margin-top:40px;text-align:center; }
@media(max-width:600px){
    .pa-cat-hero { padding:32px 0 28px; }
    .pa-cat-count { display:none; }
}
</style>

<!-- Hero -->
<div class="pa-cat-hero">
    <div class="container">
        <div class="pa-cat-hero-inner">
            <div>
                <div class="pa-cat-badge">📂 دسته‌بندی</div>
                <h1 class="pa-cat-title"><?php echo esc_html($cat->name); ?></h1>
                <?php if ($cat->description): ?>
                <p class="pa-cat-desc"><?php echo esc_html($cat->description); ?></p>
                <?php endif; ?>
            </div>
            <div class="pa-cat-count">
                <div class="pa-cat-count-num"><?php echo $cat->count; ?></div>
                <div class="pa-cat-count-label">مقاله</div>
            </div>
        </div>
    </div>
</div>

<!-- Posts -->
<div class="pa-cat-content">
    <div class="container">
        <?php if (have_posts()): ?>
        <div class="pa-cat-grid">
            <?php while (have_posts()): the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="pa-cat-card">
                <div class="pa-cat-card-thumb">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('pa-card',['alt'=>get_the_title()]); ?>
                    <?php else: ?>
                        <div class="pa-cat-card-thumb-placeholder">📰</div>
                    <?php endif; ?>
                </div>
                <div class="pa-cat-card-body">
                    <div class="pa-cat-card-meta">
                        <span class="pa-cat-card-type">مقاله</span>
                        <span class="pa-cat-card-date"><?php echo pa_time_ago(); ?></span>
                    </div>
                    <h2 class="pa-cat-card-title"><?php the_title(); ?></h2>
                    <div class="pa-cat-card-author"><?php the_author(); ?></div>
                </div>
            </a>
            <?php endwhile; ?>
        </div>
        <div class="pa-cat-pagination">
            <?php the_posts_pagination(['prev_text'=>'← قبلی','next_text'=>'بعدی →']); ?>
        </div>
        <?php else: ?>
        <div class="pa-cat-empty">
            <span class="pa-cat-empty-icon">📂</span>
            <h2>محتوایی در این دسته‌بندی یافت نشد</h2>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary" style="margin-top:20px;">بازگشت به خانه</a>
        </div>
        <?php endif; ?>
    </div>
</div>

</main>
<?php get_footer(); ?>
