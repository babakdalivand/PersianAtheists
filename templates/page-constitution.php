<?php
/**
 * Template Name: Constitution Page
 * Description: Structured constitution page with TOC and animated sections
 */
get_header();

$sections = [
    [
        'id'      => 'section-1',
        'num'     => '۱',
        'title'   => 'مقدمه',
        'content' => 'این گروه بر چهار اصول چارچوب: خردگرایی، الحاد، اومانیسم و آزاداندیشی بنا شده است. ما متعهد به ترویج خرد، آزاداندیشی، علم باوری و حقوق بشر هستیم. ما به آزادی عقیده، آزادی بیان و حق انتخاب هر فرد احترام می‌گذاریم.',
    ],
    [
        'id'      => 'section-2',
        'num'     => '۲',
        'title'   => 'اصول بنیادین',
        'content' => 'خردگرایی: احترام به عقل، منطق و شواهد علمی به عنوان پایه تصمیم‌گیری. آزاداندیشی: حق هر فرد برای داشتن عقاید متفاوت بدون ترس از تنبیه. اومانیسم: اعتقاد به ارزش ذاتی و کرامت هر انسانی. الحاد: عدم باور به وجود خدا یا موجودات ماورایی.',
    ],
    [
        'id'      => 'section-3',
        'num'     => '۳',
        'title'   => 'عضویت در گروه',
        'content' => 'عضویت تنها پس از بررسی فرم درخواست و تأیید اعضای هیئت مدیره ممکن است. هر متقاضی باید اصول بنیادین را بپذیرد. اطلاعات اعضا محرمانه است و به هیچ عنوان به اشخاص ثالث منتقل نمی‌شود.',
    ],
    [
        'id'      => 'section-4',
        'num'     => '۴',
        'title'   => 'قوانین و مقررات',
        'content' => 'تمام اعضا باید در فعالیت‌های گروه صادقانه و بر اساس اصول اخلاقی رفتار کنند. هرگونه تبعیض، آزار یا رفتار ناشایست باعث حذف عضویت خواهد شد. اعضا حق دارند آزادانه نظرات خود را ابراز کنند مشروط بر اینکه به دیگران احترام بگذارند.',
    ],
    [
        'id'      => 'section-5',
        'num'     => '۵',
        'title'   => 'اصلاح اساسنامه',
        'content' => 'تغییرات اساسنامه تنها توسط اعضای اصلی گروه (حداقل دو سوم رأی) امکان‌پذیر است. پیشنهادات اصلاحی باید حداقل دو هفته قبل از رأی‌گیری اعلام شوند. هیچ تغییری که ارزش‌های اصلی گروه را نقض کند پذیرفتنی نیست.',
    ],
];
?>

<main class="site-main">

    <!-- PAGE HERO -->
    <div style="background:linear-gradient(135deg,var(--primary) 0%,#2d3f54 100%);padding:60px 0;text-align:center;color:#fff;">
        <div class="container">
            <div style="font-size:48px;margin-bottom:16px;">📜</div>
            <h1 style="color:#fff;margin-bottom:12px;">اساسنامه گروه</h1>
            <p style="color:rgba(255,255,255,0.7);max-width:560px;margin:0 auto;font-size:16px;line-height:1.7;">اصول، ارزش‌ها و قوانینی که پایه فعالیت آنتی‌تیست‌های ایرانی را شکل می‌دهند.</p>
        </div>
    </div>

    <div class="container" style="padding-top:48px;padding-bottom:80px;">
        <div style="display:grid;grid-template-columns:280px 1fr;gap:48px;align-items:start;">

            <!-- STICKY TOC -->
            <div class="constitution-toc" style="position:sticky;top:90px;">
                <div class="sidebar-widget">
                    <div class="sidebar-widget-title">🗂️ فهرست مطالب</div>
                    <div class="sidebar-widget-body">
                        <?php foreach ( $sections as $s ) : ?>
                            <a href="#<?php echo esc_attr( $s['id'] ); ?>" class="toc-item">
                                <div class="toc-num"><?php echo esc_html( $s['num'] ); ?></div>
                                <div class="toc-label"><?php echo esc_html( $s['title'] ); ?></div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="sidebar-widget" style="margin-top:16px;">
                    <div class="sidebar-widget-body">
                        <p style="font-size:13px;color:var(--muted);line-height:1.6;margin-bottom:14px;">برای عضویت در گروه، فرم درخواست را پر کنید.</p>
                        <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="btn btn-primary" style="width:100%;justify-content:center;">👥 درخواست عضویت</a>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div>
                <?php foreach ( $sections as $index => $s ) : ?>
                    <div class="constitution-section" id="<?php echo esc_attr( $s['id'] ); ?>">
                        <div class="section-number"><?php echo esc_html( $s['num'] ); ?></div>
                        <h2 style="font-size:var(--h2);font-weight:800;color:var(--text);margin-bottom:20px;">
                            <?php echo esc_html( $index + 1 ); ?>. <?php echo esc_html( $s['title'] ); ?>
                        </h2>
                        <p style="font-size:16px;color:var(--text);line-height:1.9;">
                            <?php echo nl2br( esc_html( $s['content'] ) ); ?>
                        </p>
                    </div>
                <?php endforeach; ?>

                <!-- Signature -->
                <div style="margin-top:48px;padding:32px;background:var(--surface);border-radius:var(--radius);border:1px solid var(--border);text-align:center;">
                    <div style="font-size:40px;margin-bottom:14px;">🤝</div>
                    <h3 style="margin-bottom:12px;">تأیید اساسنامه</h3>
                    <p style="color:var(--muted);max-width:500px;margin:0 auto;font-size:14px;line-height:1.7;">
                        با عضویت در این گروه، تمامی موارد فوق را خوانده و پذیرفته‌اید.
                    </p>
                    <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="btn btn-primary" style="margin-top:20px;">درخواست عضویت</a>
                </div>
            </div>

        </div>
    </div>
</main>

<?php get_footer(); ?>
