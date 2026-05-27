<?php
/**
 * Single Short Video — Persian Atheists
 */
get_header();

$lang  = pa_current_lang();
$is_en = ($lang === 'en');

while ( have_posts() ) : the_post();
    $yt_id    = pa_get_youtube_id();
    $duration = get_post_meta( get_the_ID(), 'pa_duration', true );

/* ── Atheist quotes pool ── */
$quotes = [
    ['text' => 'آنچه بدون شواهد ادعا شود، بدون شواهد رد می‌شود.',  'who' => 'کریستوفر هیچنز'],
    ['text' => 'خداوند با قریب به یقین وجود ندارد. زندگی کن و لذت ببر.', 'who' => 'ریچارد داوکینز'],
    ['text' => 'علم نه تنها با روح انسانی سازگار است، بلکه منبع عمیق‌ترین معنا برای آن است.', 'who' => 'کارل سِیگن'],
    ['text' => 'اگر من ایستم در برابر خداوند، می‌گویم: مدرک کافی نداشتید.', 'who' => 'برتراند راسل'],
    ['text' => 'من به خدای شخصی‌ای که در امور انسانی دخالت می‌کند، باور ندارم.', 'who' => 'آلبرت اینشتین'],
    ['text' => 'دین یک توهم است و قدرتش از این است که آرزوهای ما را برآورده می‌کند.', 'who' => 'زیگموند فروید'],
    ['text' => 'فکر کردن برای خودتان شجاعانه‌ترین عملی است که می‌توانید انجام دهید.', 'who' => 'ولتر'],
    ['text' => 'دانش یگانه راه آزادی است.', 'who' => 'فردریک داگلاس'],
    ['text' => 'پرسیدن سوال نشانه هوشمندی است، نه بی‌ادبی.', 'who' => 'ابن‌رشد'],
    ['text' => 'هیچ فرضیه‌ای به‌اندازه وجود خدا دلایل خوبی ندارد که رد شود.', 'who' => 'دیوید هیوم'],
];
$quote = $quotes[ array_rand($quotes) ];

/* ── Scholar profiles pool ── */
$scholars = [
    ['name'=>'ریچارد داوکینز','role'=>'زیست‌شناس و نویسنده — نوشته ژن خودخواه','emoji'=>'🔬'],
    ['name'=>'کارل سِیگن',    'role'=>'اخترشناس — نوشته کیهان و پیام آبی کمرنگ', 'emoji'=>'🌌'],
    ['name'=>'کریستوفر هیچنز','role'=>'روزنامه‌نگار و نویسنده — نوشته خدا بزرگ نیست','emoji'=>'✍️'],
    ['name'=>'سام هریس',       'role'=>'نوروساینتیست — نوشته پایان ایمان',          'emoji'=>'🧠'],
    ['name'=>'برتراند راسل',  'role'=>'فیلسوف و ریاضیدان — نوشته چرا مسیحی نیستم', 'emoji'=>'📐'],
    ['name'=>'دنیل دنت',      'role'=>'فیلسوف — نوشته جادوی شکستن',                'emoji'=>'🦋'],
    ['name'=>'ابن‌رشد',        'role'=>'فیلسوف و پزشک اندلسی قرون وسطی',            'emoji'=>'📚'],
    ['name'=>'فردریک نیچه',   'role'=>'فیلسوف آلمانی — خدا مرده است',               'emoji'=>'⚡'],
];
$scholar = $scholars[ array_rand($scholars) ];
?>

<style>
.ps-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: 28px 20px 60px;
}
.ps-layout {
    display: grid;
    grid-template-columns: 340px 1fr;
    gap: 32px;
    align-items: start;
}
.ps-player-col { position: sticky; top: 90px; }
.ps-player {
    position: relative;
    aspect-ratio: 9/16;
    background: #000;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 48px rgba(0,0,0,.4);
}
.ps-player iframe, .ps-player img {
    position: absolute; inset: 0; width: 100%; height: 100%;
    border: none; object-fit: cover;
}
.ps-share { display: flex; gap: 8px; margin-top: 14px; }
.ps-share a, .ps-share button {
    flex: 1; display: flex; align-items: center; justify-content: center; gap: 5px;
    padding: 9px 12px; border-radius: 10px; font-size: 12px; font-weight: 700;
    text-decoration: none; border: 1px solid var(--border); cursor: pointer;
    background: var(--surface); color: var(--muted); font-family: inherit;
    transition: all .2s;
}
.ps-share a:hover, .ps-share button:hover { border-color: var(--accent); color: var(--accent); }
.ps-share .yt-btn { background: #FF0000 !important; border-color: #FF0000 !important; color: #fff !important; }

.ps-content-col { min-width: 0; }
.ps-bread { display:flex; gap:6px; align-items:center; font-size:13px; color:var(--muted); margin-bottom:18px; flex-wrap:wrap; }
.ps-bread a { color:var(--muted); text-decoration:none; }
.ps-bread a:hover { color:var(--accent); }
.ps-title { font-size:clamp(18px,2.5vw,24px); font-weight:900; color:var(--text); line-height:1.4; margin-bottom:12px; }
.ps-meta { font-size:13px; color:var(--muted); display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px; }

/* Quote card */
.ps-quote {
    background: linear-gradient(135deg, rgba(124,58,237,.1), rgba(79,184,180,.08));
    border: 1px solid rgba(124,58,237,.25);
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 24px;
    position: relative;
}
.ps-quote::before { content: '❝'; font-size:40px; color:var(--accent); opacity:.25; position:absolute; top:8px; right:14px; line-height:1; }
.ps-quote-text { font-size: 15px; line-height: 1.8; color: var(--text); font-weight: 600; padding-right: 28px; }
.ps-quote-who { font-size: 12px; color: var(--muted); margin-top: 10px; text-align: left; }

/* Scholar card */
.ps-scholar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 18px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: border-color .2s;
}
.ps-scholar:hover { border-color: var(--accent); }
.ps-scholar-avatar {
    width: 52px; height: 52px; border-radius: 50%;
    background: var(--accent); display: flex; align-items: center;
    justify-content: center; font-size: 26px; flex-shrink: 0;
}
.ps-scholar-label { font-size: 10px; color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 4px; }
.ps-scholar-name { font-size: 15px; font-weight: 800; color: var(--text); }
.ps-scholar-role { font-size: 12px; color: var(--muted); margin-top: 3px; }

/* Related articles */
.ps-articles { margin-bottom: 28px; }
.ps-section-title {
    font-size: 15px; font-weight: 800; color: var(--text);
    padding-bottom: 8px; border-bottom: 2px solid var(--accent);
    margin-bottom: 14px; display: inline-block;
}
.ps-article-item {
    display: flex; gap: 12px; padding: 10px 0;
    border-bottom: 1px solid var(--border); text-decoration: none;
    transition: opacity .2s;
}
.ps-article-item:last-child { border-bottom: none; }
.ps-article-item:hover { opacity: .75; }
.ps-article-thumb { width: 72px; height: 50px; border-radius: 8px; overflow: hidden; flex-shrink: 0; background: var(--primary); }
.ps-article-thumb img { width:100%; height:100%; object-fit:cover; }
.ps-article-title { font-size:13px; font-weight:700; color:var(--text); line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.ps-article-date { font-size:11px; color:var(--muted); margin-top:4px; }

/* More shorts */
.ps-more-title { font-size:15px; font-weight:800; color:var(--text); padding-bottom:8px; border-bottom:2px solid var(--accent); margin-bottom:14px; display:inline-block; }
.ps-shorts-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; }

@media (max-width: 760px) {
    .ps-layout { grid-template-columns: 1fr; }
    .ps-player-col { position: static; }
    .ps-player { max-width: 300px; margin: 0 auto; }
    .ps-shorts-grid { grid-template-columns: repeat(2,1fr); }
}
</style>

<main class="site-main" id="main-content">
<div class="ps-wrap">

    <!-- Breadcrumb -->
    <nav class="ps-bread">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo $is_en ? 'Home' : 'خانه'; ?></a>
        <span>›</span>
        <a href="<?php echo esc_url(home_url('/shorts')); ?>"><?php echo $is_en ? 'Short Videos' : 'ویدئوهای کوتاه'; ?></a>
        <span>›</span>
        <span><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></span>
    </nav>

    <div class="ps-layout">

        <!-- ── Player column (sticky) ── -->
        <div class="ps-player-col">
            <div class="ps-player">
                <?php if ($yt_id) : ?>
                    <iframe
                        src="https://www.youtube.com/embed/<?php echo esc_attr($yt_id); ?>?autoplay=0&rel=0&modestbranding=1"
                        title="<?php the_title_attribute(); ?>"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                <?php elseif (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('pa-card', ['style'=>'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;']); ?>
                <?php else : ?>
                    <div style="display:flex;align-items:center;justify-content:center;height:100%;color:var(--accent);font-size:56px;">🎬</div>
                <?php endif; ?>
                <?php if ($duration) : ?>
                    <span class="media-duration"><?php echo esc_html($duration); ?></span>
                <?php endif; ?>
            </div>

            <!-- Share buttons -->
            <div class="ps-share">
                <?php if ($yt_id) : ?>
                    <a href="https://youtube.com/shorts/<?php echo esc_attr($yt_id); ?>" target="_blank" rel="noopener" class="yt-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="13" height="13"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        YouTube
                    </a>
                <?php endif; ?>
                <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener">✈</a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener">𝕏</a>
                <button onclick="navigator.clipboard.writeText('<?php echo esc_js(get_permalink()); ?>');this.textContent='✓'">🔗</button>
            </div>
        </div>

        <!-- ── Content column ── -->
        <div class="ps-content-col">

            <!-- Title + meta -->
            <h1 class="ps-title"><?php the_title(); ?></h1>
            <div class="ps-meta">
                <span>🎬 <?php echo $is_en ? 'Short Video' : 'ویدئو کوتاه'; ?></span>
                <span>·</span>
                <span><?php the_author(); ?></span>
                <span>·</span>
                <span><?php echo pa_time_ago(); ?></span>
                <?php if ($duration) : ?><span>· ⏱ <?php echo esc_html($duration); ?></span><?php endif; ?>
            </div>

            <?php if (get_the_excerpt()) : ?>
                <p style="color:var(--muted);font-size:14px;line-height:1.8;margin-bottom:24px;"><?php the_excerpt(); ?></p>
            <?php endif; ?>

            <!-- Quote card -->
            <div class="ps-quote">
                <div class="ps-quote-text"><?php echo esc_html($quote['text']); ?></div>
                <div class="ps-quote-who">— <?php echo esc_html($quote['who']); ?></div>
            </div>

            <!-- Scholar spotlight -->
            <div class="ps-scholar">
                <div class="ps-scholar-avatar"><?php echo $scholar['emoji']; ?></div>
                <div>
                    <div class="ps-scholar-label"><?php echo $is_en ? 'Featured Thinker' : 'اندیشمند برجسته'; ?></div>
                    <div class="ps-scholar-name"><?php echo esc_html($scholar['name']); ?></div>
                    <div class="ps-scholar-role"><?php echo esc_html($scholar['role']); ?></div>
                </div>
            </div>

            <!-- Related articles -->
            <?php
            $related = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            if ($related->have_posts()) : ?>
                <div class="ps-articles">
                    <div class="ps-section-title"><?php echo $is_en ? 'Latest Articles' : 'مقالات اخیر'; ?></div>
                    <?php while ($related->have_posts()) : $related->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="ps-article-item">
                            <div class="ps-article-thumb">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('pa-thumb', ['style'=>'width:100%;height:100%;object-fit:cover;']); ?>
                                <?php else : ?>
                                    <div style="width:100%;height:100%;background:var(--primary);display:flex;align-items:center;justify-content:center;font-size:20px;">📄</div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div class="ps-article-title"><?php the_title(); ?></div>
                                <div class="ps-article-date"><?php echo pa_time_ago(); ?></div>
                            </div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>

            <!-- More short videos -->
            <?php
            $more = new WP_Query([
                'post_type'      => 'pa_short',
                'posts_per_page' => 6,
                'post__not_in'   => [get_the_ID()],
                'post_status'    => 'publish',
            ]);
            if ($more->have_posts()) : ?>
                <div class="ps-more-title"><?php echo $is_en ? '▶ More Short Videos' : '🎬 ویدئوهای کوتاه بیشتر'; ?></div>
                <div class="ps-shorts-grid">
                    <?php while ($more->have_posts()) : $more->the_post();
                        $mid  = pa_get_youtube_id();
                        $mdur = get_post_meta(get_the_ID(), 'pa_duration', true); ?>
                        <a href="<?php the_permalink(); ?>" style="text-decoration:none;">
                            <div class="media-card">
                                <div class="media-thumb" style="aspect-ratio:9/16;">
                                    <?php if ($mid) : ?>
                                        <img src="https://i.ytimg.com/vi/<?php echo esc_attr($mid); ?>/oardefault.jpg"
                                             alt="<?php the_title_attribute(); ?>"
                                             style="object-fit:cover;width:100%;height:100%;">
                                    <?php elseif (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('pa-square'); ?>
                                    <?php else : ?>
                                        <div style="height:100%;background:var(--primary);display:flex;align-items:center;justify-content:center;color:var(--accent);">🎬</div>
                                    <?php endif; ?>
                                    <?php if ($mdur) : ?><span class="media-duration"><?php echo esc_html($mdur); ?></span><?php endif; ?>
                                    <div class="play-overlay"><div class="play-circle"><svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><polygon points="5 3 19 12 5 21 5 3"/></svg></div></div>
                                </div>
                                <div class="media-info">
                                    <div class="media-title" style="-webkit-line-clamp:2;font-size:11px;"><?php the_title(); ?></div>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>

        </div><!-- .ps-content-col -->
    </div><!-- .ps-layout -->

</div>
</main>

<?php endwhile; get_footer(); ?>
