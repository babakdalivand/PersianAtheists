<?php
/**
 * Donate Page Template — auto-used for /donate/
 */
get_header();
$is_en = ( pa_current_lang() === 'en' );
?>
<main class="site-main" id="main-content">
<style>
/* ─── DONATE PAGE ─── */
.don-hero {
    background: linear-gradient(135deg, #1A1714 0%, #0D0B09 100%);
    border-bottom: 1px solid var(--border);
    padding: 64px 0 56px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.don-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(ellipse 60% 80% at 50% 120%, rgba(235,94,40,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.don-hero-inner { position: relative; z-index: 1; }
.don-hero-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(235,94,40,0.12); border: 1px solid rgba(235,94,40,0.28);
    border-radius: 20px; padding: 4px 16px;
    font-size: 12px; color: var(--accent); font-weight: 700;
    margin-bottom: 20px;
}
.don-hero-title {
    font-size: clamp(28px, 4vw, 52px); font-weight: 900;
    color: var(--text); line-height: 1.2; margin-bottom: 14px;
}
.don-hero-sub {
    font-size: 16px; color: var(--muted);
    max-width: 560px; margin: 0 auto 32px; line-height: 1.7;
}
.don-hero-stats {
    display: flex; justify-content: center; gap: 32px; flex-wrap: wrap;
}
.don-stat { text-align: center; }
.don-stat-num { font-size: 26px; font-weight: 900; color: var(--accent); line-height: 1; }
.don-stat-lbl { font-size: 12px; color: var(--muted); margin-top: 4px; }

/* ─── WHY SECTION ─── */
.don-why {
    padding: 72px 0 64px;
    background: var(--bg);
}
.don-section-title {
    font-size: 24px; font-weight: 900; color: var(--text);
    text-align: center; margin-bottom: 8px;
}
.don-section-sub {
    text-align: center; color: var(--muted); font-size: 14px;
    margin-bottom: 48px;
}
.don-why-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
}
.don-why-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 32px 28px;
    transition: border-color .2s, transform .2s, box-shadow .2s;
}
.don-why-card:hover {
    border-color: var(--accent);
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}
.don-why-icon {
    width: 52px; height: 52px;
    background: rgba(235,94,40,0.12);
    border: 1px solid rgba(235,94,40,0.24);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px; margin-bottom: 20px;
}
.don-why-h { font-size: 17px; font-weight: 800; color: var(--text); margin-bottom: 10px; }
.don-why-p { font-size: 14px; color: var(--muted); line-height: 1.7; }

/* ─── PAYMENT SECTION ─── */
.don-pay {
    padding: 64px 0 80px;
    background: var(--surface);
    border-top: 1px solid var(--border);
}
.don-pay-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    margin-top: 48px;
}
.don-pay-card {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 20px; padding: 32px 28px;
    display: flex; flex-direction: column; gap: 16px;
    transition: border-color .2s, box-shadow .2s;
}
.don-pay-card:hover { border-color: var(--accent); box-shadow: 0 8px 32px rgba(0,0,0,0.12); }
.don-pay-top { display: flex; align-items: center; gap: 14px; }
.don-pay-icon {
    width: 48px; height: 48px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; flex-shrink: 0;
}
.don-pay-icon.pp  { background: rgba(0,48,135,0.15); border: 1px solid rgba(0,48,135,0.25); }
.don-pay-icon.cry { background: rgba(247,147,26,0.12); border: 1px solid rgba(247,147,26,0.25); }
.don-pay-icon.oth { background: rgba(235,94,40,0.12); border: 1px solid rgba(235,94,40,0.25); }
.don-pay-name { font-size: 17px; font-weight: 800; color: var(--text); }
.don-pay-desc { font-size: 13px; color: var(--muted); }
.don-pay-body { font-size: 13px; color: var(--muted); line-height: 1.7; flex: 1; }

/* Crypto address box */
.don-crypto-addr {
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--border);
    border-radius: 10px; padding: 10px 14px;
    font-family: monospace; font-size: 12px; color: var(--text);
    word-break: break-all; position: relative; margin-top: 4px;
}
.don-crypto-label {
    font-size: 11px; font-weight: 700;
    color: var(--accent); margin-bottom: 4px; display: block;
}
.don-copy-btn {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(235,94,40,0.08); border: 1px solid rgba(235,94,40,0.2);
    border-radius: 7px; padding: 4px 10px; font-size: 11px;
    color: var(--accent); cursor: pointer; margin-top: 6px;
    transition: all .2s; font-family: inherit; font-weight: 600;
}
.don-copy-btn:hover { background: rgba(235,94,40,0.16); }

/* Action buttons */
.don-btn {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 8px; padding: 11px 24px; border-radius: 12px;
    font-size: 14px; font-weight: 700;
    text-decoration: none; transition: all .2s; width: 100%;
    font-family: inherit; cursor: pointer; border: none;
}
.don-btn-primary {
    background: var(--accent); color: #fff;
    box-shadow: 0 4px 16px rgba(235,94,40,0.28);
}
.don-btn-primary:hover { background: #d4541e; transform: translateY(-1px); box-shadow: 0 6px 24px rgba(235,94,40,0.38); }
.don-btn-outline {
    background: transparent; color: var(--text);
    border: 1px solid var(--border);
}
.don-btn-outline:hover { border-color: var(--accent); color: var(--accent); }

/* PayPal button */
.don-btn-paypal {
    background: #0070ba; color: #fff;
    box-shadow: 0 4px 16px rgba(0,112,186,0.28);
}
.don-btn-paypal:hover { background: #005ea6; transform: translateY(-1px); }

/* ─── WP CONTENT AREA ─── */
.don-wp-content { padding: 56px 0 80px; }
.don-blocks { max-width: 900px; margin: 0 auto; }
.don-blocks .wp-block-columns {
    gap: 24px !important; margin-bottom: 0 !important;
}
.don-blocks .wp-block-column {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px; padding: 24px !important;
}
.don-blocks .wp-block-button { text-align: center !important; margin-top: 16px; }
.don-blocks .wp-block-button__link {
    background: var(--accent) !important; color: #fff !important;
    padding: 10px 24px !important; font-size: 14px !important;
    font-weight: 700 !important; border-radius: 10px !important;
    display: inline-flex !important; align-items: center !important;
    justify-content: center !important; min-height: unset !important;
    height: auto !important; line-height: 1.4 !important;
    transition: all .2s !important;
    box-shadow: 0 4px 14px rgba(235,94,40,0.25) !important;
}
.don-blocks .wp-block-button__link:hover {
    background: #d4541e !important;
    transform: translateY(-1px) !important;
}
.don-blocks h2, .don-blocks h3 {
    font-size: 20px !important; font-weight: 800 !important;
    color: var(--text) !important; margin-bottom: 12px !important;
}
.don-blocks p { color: var(--muted) !important; line-height: 1.8 !important; }

@media (max-width: 640px) {
    .don-hero { padding: 48px 0 40px; }
    .don-hero-stats { gap: 20px; }
    .don-why { padding: 52px 0 44px; }
    .don-pay { padding: 48px 0 60px; }
}
</style>

<!-- ═══ HERO ═══ -->
<section class="don-hero">
    <div class="container">
        <div class="don-hero-inner">
            <div class="don-hero-badge" data-reveal="fade">
                ❤️ <?php echo $is_en ? 'Support RAHA Network' : 'حمایت از شبکه رها'; ?>
            </div>
            <h1 class="don-hero-title" data-reveal>
                <?php echo $is_en ? 'Support Iranian Atheists' : 'حمایت از آتئیست‌های ایرانی'; ?>
            </h1>
            <p class="don-hero-sub" data-reveal>
                <?php echo $is_en
                    ? 'Your contribution keeps this platform free, secure and accessible for all Iranian freethinkers around the world.'
                    : 'حمایت مالی شما این پلتفرم را برای تمام آزاداندیشان ایرانی در سراسر جهان آزاد، امن و در دسترس نگه می‌دارد.'; ?>
            </p>
            <div class="don-hero-stats" data-reveal>
                <div class="don-stat"><div class="don-stat-num">۱۲۰۰۰+</div><div class="don-stat-lbl"><?php echo $is_en ? 'Active Members' : 'عضو فعال'; ?></div></div>
                <div class="don-stat"><div class="don-stat-num">۵۰۰+</div><div class="don-stat-lbl"><?php echo $is_en ? 'Articles' : 'مقاله'; ?></div></div>
                <div class="don-stat"><div class="don-stat-num">۱۰۰+</div><div class="don-stat-lbl"><?php echo $is_en ? 'Videos' : 'ویدیو'; ?></div></div>
                <div class="don-stat"><div class="don-stat-num">۸</div><div class="don-stat-lbl"><?php echo $is_en ? 'Years Active' : 'سال فعالیت'; ?></div></div>
            </div>
        </div>
    </div>
</section>

<!-- ═══ WHY SUPPORT ═══ -->
<section class="don-why">
    <div class="container">
        <h2 class="don-section-title" data-reveal>
            <?php echo $is_en ? 'Why Your Support Matters' : 'چرا حمایت شما مهم است؟'; ?>
        </h2>
        <p class="don-section-sub" data-reveal>
            <?php echo $is_en ? 'Every contribution, big or small, makes a difference.' : 'هر کمکی، کوچک یا بزرگ، تفاوت ایجاد می‌کند.'; ?>
        </p>
        <div class="don-why-grid">
            <div class="don-why-card" data-reveal>
                <div class="don-why-icon">📚</div>
                <h3 class="don-why-h"><?php echo $is_en ? 'Educational Content' : 'محتوای آموزشی'; ?></h3>
                <p class="don-why-p"><?php echo $is_en
                    ? 'Funding the creation of videos, articles and podcasts that educate and empower Iranian freethinkers.'
                    : 'تامین هزینه تولید ویدیوها، مقالات و پادکست‌هایی که آزاداندیشان ایرانی را توانمند می‌کنند.'; ?></p>
            </div>
            <div class="don-why-card" data-reveal>
                <div class="don-why-icon">🌐</div>
                <h3 class="don-why-h"><?php echo $is_en ? 'Safe Community' : 'جامعه امن'; ?></h3>
                <p class="don-why-p"><?php echo $is_en
                    ? 'Maintaining a safe, private and accessible space for atheists in Iran and the diaspora.'
                    : 'حفظ یک فضای امن، خصوصی و قابل دسترس برای آتئیست‌های ایران و دیاسپورا.'; ?></p>
            </div>
            <div class="don-why-card" data-reveal>
                <div class="don-why-icon">📢</div>
                <h3 class="don-why-h"><?php echo $is_en ? 'Amplifying Voices' : 'تقویت صداها'; ?></h3>
                <p class="don-why-p"><?php echo $is_en
                    ? 'Giving a platform to those who cannot speak freely, advocating for secularism and human rights.'
                    : 'دادن صدا به کسانی که نمی‌توانند آزادانه صحبت کنند، دفاع از سکولاریسم و حقوق بشر.'; ?></p>
            </div>
            <div class="don-why-card" data-reveal>
                <div class="don-why-icon">🔒</div>
                <h3 class="don-why-h"><?php echo $is_en ? 'Server & Security' : 'سرور و امنیت'; ?></h3>
                <p class="don-why-p"><?php echo $is_en
                    ? 'Covering server costs, security infrastructure and keeping the site online 24/7.'
                    : 'پوشش هزینه‌های سرور، زیرساخت امنیتی و نگه داشتن سایت آنلاین ۲۴/۷.'; ?></p>
            </div>
            <div class="don-why-card" data-reveal>
                <div class="don-why-icon">🎙️</div>
                <h3 class="don-why-h"><?php echo $is_en ? 'Podcast Production' : 'تولید پادکست'; ?></h3>
                <p class="don-why-p"><?php echo $is_en
                    ? 'Recording equipment, editing software and distribution costs for our growing podcast series.'
                    : 'تجهیزات ضبط، نرم‌افزار ویرایش و هزینه‌های توزیع سری پادکست‌های ما.'; ?></p>
            </div>
            <div class="don-why-card" data-reveal>
                <div class="don-why-icon">⚖️</div>
                <h3 class="don-why-h"><?php echo $is_en ? 'Legal Support' : 'حمایت حقوقی'; ?></h3>
                <p class="don-why-p"><?php echo $is_en
                    ? 'Supporting members who face legal threats due to their beliefs or activism.'
                    : 'حمایت از اعضایی که به خاطر باورها یا فعالیت‌هایشان با تهدیدات قانونی روبرو هستند.'; ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ═══ PAYMENT METHODS ═══ -->
<section class="don-pay">
    <div class="container">
        <h2 class="don-section-title" data-reveal>
            <?php echo $is_en ? 'Ways to Donate' : 'روش‌های حمایت مالی'; ?>
        </h2>
        <p class="don-section-sub" data-reveal>
            <?php echo $is_en ? 'Choose the method that works best for you.' : 'روشی که برای شما مناسب‌تر است را انتخاب کنید.'; ?>
        </p>
        <div class="don-pay-grid">

            <!-- PayPal -->
            <div class="don-pay-card" data-reveal>
                <div class="don-pay-top">
                    <div class="don-pay-icon pp">💳</div>
                    <div>
                        <div class="don-pay-name">PayPal</div>
                        <div class="don-pay-desc"><?php echo $is_en ? 'Fast & secure' : 'سریع و امن'; ?></div>
                    </div>
                </div>
                <p class="don-pay-body">
                    <?php echo $is_en
                        ? 'Donate securely via PayPal. Supports credit cards, debit cards and PayPal balance.'
                        : 'از طریق PayPal به صورت امن کمک کنید. از کارت اعتباری، کارت نقدی و موجودی PayPal پشتیبانی می‌کند.'; ?>
                </p>
                <a href="https://www.paypal.com/donate?hosted_button_id=REPLACE_WITH_BUTTON_ID"
                   target="_blank" rel="noopener" class="don-btn don-btn-paypal">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 0 0-.556.479l-1.187 7.527h-.506l-.24 1.516a.56.56 0 0 0 .554.647h3.882c.46 0 .85-.334.922-.788.06-.26.76-4.852.816-5.09a.932.932 0 0 1 .923-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.777-4.471z"/></svg>
                    <?php echo $is_en ? 'Donate via PayPal' : 'کمک از طریق PayPal'; ?>
                </a>
            </div>

            <!-- Crypto -->
            <div class="don-pay-card" data-reveal>
                <div class="don-pay-top">
                    <div class="don-pay-icon cry">₿</div>
                    <div>
                        <div class="don-pay-name"><?php echo $is_en ? 'Cryptocurrency' : 'ارز دیجیتال'; ?></div>
                        <div class="don-pay-desc"><?php echo $is_en ? 'Anonymous & borderless' : 'ناشناس و بدون مرز'; ?></div>
                    </div>
                </div>
                <p class="don-pay-body">
                    <?php echo $is_en
                        ? 'Send cryptocurrency directly. Bitcoin, Ethereum, and USDT accepted.'
                        : 'ارز دیجیتال مستقیم ارسال کنید. بیت‌کوین، اتریوم و USDT پذیرفته می‌شود.'; ?>
                </p>
                <?php
                $btc  = get_post_meta( get_the_ID(), 'pa_btc_address',  true );
                $eth  = get_post_meta( get_the_ID(), 'pa_eth_address',  true );
                $usdt = get_post_meta( get_the_ID(), 'pa_usdt_address', true );
                if ( $btc ): ?>
                <div class="don-crypto-addr">
                    <span class="don-crypto-label">Bitcoin (BTC)</span>
                    <?php echo esc_html( $btc ); ?>
                    <br><button class="don-copy-btn" onclick="paCopy(this,'<?php echo esc_js($btc); ?>')">📋 <?php echo $is_en ? 'Copy' : 'کپی'; ?></button>
                </div>
                <?php endif;
                if ( $eth ): ?>
                <div class="don-crypto-addr">
                    <span class="don-crypto-label">Ethereum (ETH)</span>
                    <?php echo esc_html( $eth ); ?>
                    <br><button class="don-copy-btn" onclick="paCopy(this,'<?php echo esc_js($eth); ?>')">📋 <?php echo $is_en ? 'Copy' : 'کپی'; ?></button>
                </div>
                <?php endif;
                if ( $usdt ): ?>
                <div class="don-crypto-addr">
                    <span class="don-crypto-label">USDT (TRC20)</span>
                    <?php echo esc_html( $usdt ); ?>
                    <br><button class="don-copy-btn" onclick="paCopy(this,'<?php echo esc_js($usdt); ?>')">📋 <?php echo $is_en ? 'Copy' : 'کپی'; ?></button>
                </div>
                <?php endif;
                if ( ! $btc && ! $eth && ! $usdt ): ?>
                <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="don-btn don-btn-outline">
                    <?php echo $is_en ? 'Get Crypto Address' : 'دریافت آدرس ارز دیجیتال'; ?>
                </a>
                <?php endif; ?>
            </div>

            <!-- Other -->
            <div class="don-pay-card" data-reveal>
                <div class="don-pay-top">
                    <div class="don-pay-icon oth">💬</div>
                    <div>
                        <div class="don-pay-name"><?php echo $is_en ? 'Other Methods' : 'روش‌های دیگر'; ?></div>
                        <div class="don-pay-desc"><?php echo $is_en ? 'Bank transfer & more' : 'انتقال بانکی و بیشتر'; ?></div>
                    </div>
                </div>
                <p class="don-pay-body">
                    <?php echo $is_en
                        ? 'For bank transfers, SEPA, or other payment methods please contact us directly. We\'ll find the best way together.'
                        : 'برای انتقال بانکی، SEPA یا سایر روش‌های پرداخت لطفاً مستقیماً با ما تماس بگیرید. با هم بهترین راه را پیدا می‌کنیم.'; ?>
                </p>
                <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="don-btn don-btn-primary">
                    <?php echo $is_en ? 'Contact Us' : 'تماس با ما'; ?>
                </a>
            </div>

        </div><!-- .don-pay-grid -->
    </div>
</section>

<!-- ═══ WP EDITOR CONTENT (for any additional info) ═══ -->
<?php if ( have_posts() ): while ( have_posts() ): the_post();
    $content = get_the_content();
    if ( trim( strip_tags($content) ) ):
?>
<div class="don-wp-content">
    <div class="container">
        <div class="don-blocks">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<?php endif; endwhile; endif; ?>

<script>
function paCopy(btn, text) {
    navigator.clipboard && navigator.clipboard.writeText(text).then(function() {
        var orig = btn.innerHTML;
        btn.innerHTML = '✓ <?php echo $is_en ? "Copied!" : "کپی شد!"; ?>';
        btn.style.background = 'rgba(34,197,94,0.12)';
        btn.style.borderColor = 'rgba(34,197,94,0.3)';
        btn.style.color = '#16a34a';
        setTimeout(function() { btn.innerHTML = orig; btn.style = ''; }, 2000);
    });
}
</script>

</main>
<?php get_footer(); ?>
