<?php
$lang  = pa_current_lang();
$is_en = ( $lang === 'en' );
$logo_path = get_template_directory() . '/assets/images/logo.png';
$logo_url  = get_template_directory_uri() . '/assets/images/logo.png';
$has_logo  = file_exists( $logo_path );
?>

<!-- CTA STRIP — minimal -->
<section class="cta-strip-mini">
    <div class="container">
        <div class="cta-mini-row">
            <a href="<?php echo esc_url( home_url('/constitution') ); ?>" class="cta-mini-item">
                <span class="cta-mini-icon">📜</span>
                <span class="cta-mini-label"><?php echo $is_en ? 'Constitution' : 'اساسنامه'; ?></span>
            </a>
            <span class="cta-mini-sep"></span>
            <a href="<?php echo esc_url( home_url('/membership') ); ?>" class="cta-mini-item cta-mini-highlight">
                <span class="cta-mini-icon">👥</span>
                <span class="cta-mini-label"><?php echo $is_en ? 'Join Us' : 'عضویت'; ?></span>
            </a>
            <span class="cta-mini-sep"></span>
            <a href="<?php echo esc_url( home_url('/donate') ); ?>" class="cta-mini-item cta-mini-highlight">
                <span class="cta-mini-icon">❤️</span>
                <span class="cta-mini-label"><?php echo $is_en ? 'Donate' : 'حمایت'; ?></span>
            </a>
            <span class="cta-mini-sep"></span>
            <a href="<?php echo esc_url( home_url('/submit') ); ?>" class="cta-mini-item">
                <span class="cta-mini-icon">✏️</span>
                <span class="cta-mini-label"><?php echo $is_en ? 'Write for Us' : 'ارسال مقاله'; ?></span>
            </a>
        </div>
    </div>
</section>
<style>
.cta-strip-mini {
    background: #111827;
    border-top: 1px solid rgba(255,255,255,0.08);
    padding: 0;
}
[data-theme="dark"] .cta-strip-mini { background: #070f1e; }
.cta-mini-row {
    display: flex;
    align-items: stretch;
    justify-content: center;
    flex-wrap: wrap;
}
.cta-mini-item {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 14px 24px;
    color: rgba(255,255,255,0.6);
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: color .2s, background .2s;
    white-space: nowrap;
}
.cta-mini-item:hover { color: var(--accent); background: rgba(235,94,40,0.08); }
.cta-mini-highlight { color: #fff; }
.cta-mini-icon { font-size: 16px; }
.cta-mini-sep {
    width: 1px;
    background: rgba(255,255,255,0.12);
    margin: 8px 0;
    flex-shrink: 0;
}
@media (max-width: 600px) {
    .cta-mini-row { justify-content: flex-start; overflow-x: auto; flex-wrap: nowrap; }
    .cta-mini-item { padding: 12px 16px; }
}
</style>

<style>
/* Footer logo */
.footer-logo-wrap {
    width: 48px; height: 48px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(124,58,237,0.3);
    overflow: hidden;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.footer-logo-img {
    width: 48px !important;
    height: 48px !important;
    object-fit: contain !important;
    display: block !important;
}
.footer-logo-fallback {
    width: 48px; height: 48px;
    background: var(--accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 22px;
    font-weight: 900;
}
</style>

<!-- FOOTER -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">

            <!-- About -->
            <div class="footer-col">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                    <!-- لوگو واقعی -->
                    <div class="footer-logo-wrap">
                        <?php if ( $has_logo ) : ?>
                            <img src="<?php echo esc_url($logo_url); ?>"
                                 alt="<?php bloginfo('name'); ?>"
                                 class="footer-logo-img"
                                 onerror="this.parentElement.innerHTML='<div class=\'footer-logo-fallback\'>A</div>'">
                        <?php else : ?>
                            <div class="footer-logo-fallback">A</div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div style="color:#fff;font-weight:700;font-size:15px;"><?php bloginfo('name'); ?></div>
                        <div style="font-size:11px;color:rgba(255,255,255,0.5);"><?php echo $is_en ? 'Iranian Atheists Community' : 'جامعه آتئیست‌های ایرانی'; ?></div>
                    </div>
                </div>
                <p class="footer-about">
                    <?php echo $is_en
                        ? 'Persian Atheists is an independent, non-profit group. We provide a safe space for free thought, science and rationalism.'
                        : 'آتئیست‌های ایرانی یک گروه مستقل و غیرانتفاعی است. ما یک فضای ایمن برای آزادی خرد، علم و آزاداندیشی فراهم می‌کنیم.';
                    ?>
                </p>
                <div class="footer-social">
                    <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
                    <a href="#" aria-label="Telegram"><svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.96 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg></a>
                    <a href="#" aria-label="Twitter"><svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                    <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg></a>
                    <a href="#" aria-label="Email"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <div class="footer-col-title"><?php echo $is_en ? 'Content' : 'محتوا'; ?></div>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/articles')); ?>"><?php echo $is_en ? 'Articles' : 'مقالات'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/videos')); ?>"><?php echo $is_en ? 'Videos' : 'ویدیوها'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/podcasts')); ?>"><?php echo $is_en ? 'Podcasts' : 'پادکست‌ها'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/library')); ?>"><?php echo $is_en ? 'Library' : 'کتابخانه'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php echo $is_en ? 'About Us' : 'درباره ما'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php echo $is_en ? 'Contact' : 'تماس با ما'; ?></a></li>
                </ul>
            </div>

            <!-- Categories — از دیتابیس واقعی -->
            <div class="footer-col">
                <div class="footer-col-title"><?php echo $is_en ? 'Categories' : 'دسته‌بندی‌ها'; ?></div>
                <ul class="footer-links footer-cats">
                    <?php
                    $cats = get_categories(['number'=>6,'orderby'=>'count','order'=>'DESC','hide_empty'=>true,'parent'=>0]);
                    foreach($cats as $cat):
                        $raw = $cat->name;
                        if (strpos($raw, '|') !== false) {
                            $parts = array_map('trim', explode('|', $raw));
                            $label = $is_en ? ($parts[1] ?? $raw) : ($parts[0] ?? $raw);
                        } else {
                            $label = $raw;
                        }
                    ?>
                    <li><a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($label); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Useful Links -->
            <div class="footer-col">
                <div class="footer-col-title"><?php echo $is_en ? 'About Us' : 'سایت'; ?></div>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/constitution')); ?>"><?php echo $is_en ? 'Constitution' : 'اساسنامه'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/membership')); ?>"><?php echo $is_en ? 'Join the Group' : 'عضویت در گروه'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/donate')); ?>"><?php echo $is_en ? 'Donate' : 'حمایت مالی'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/submit')); ?>"><?php echo $is_en ? 'Write for Us' : 'ارسال مقاله'; ?></a></li>
                    <li><a href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php echo $is_en ? 'Privacy Policy' : 'حریم خصوصی'; ?></a></li>
                </ul>
            </div>

            <!-- Donate Box -->
            <div class="footer-col">
                <div class="footer-donate-box">
                    <div class="footer-donate-title">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14" style="color:#e74c3c;"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/></svg>
                        <?php echo $is_en ? 'Support Us' : 'حمایت مالی'; ?>
                    </div>
                    <p class="footer-donate-desc"><?php echo $is_en ? 'Help us grow with a small donation.' : 'با کمک مالی کوچک به رشد ما کمک کنید.'; ?></p>
                    <a href="<?php echo esc_url(home_url('/donate')); ?>" class="donate-paypal-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/></svg>
                        <?php echo $is_en ? 'Donate Now' : 'حمایت کنید'; ?>
                    </a>
                    <div class="crypto-row">
                        <a href="#" class="crypto-btn crypto-btc" title="Bitcoin">₿</a>
                        <a href="#" class="crypto-btn crypto-eth" title="Ethereum">Ξ</a>
                        <a href="#" class="crypto-btn crypto-usdt" title="USDT">₮</a>
                        <a href="https://paypal.com" target="_blank" rel="noopener" class="crypto-btn" title="PayPal" style="font-size:10px;padding:4px 8px;">PP</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <span>
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                <?php echo $is_en ? 'All rights reserved.' : 'تمام حقوق محفوظ است.'; ?>
                &nbsp;·&nbsp;
                <span style="color:rgba(255,255,255,0.4);font-size:11px;">
                    Designed by <a href="https://dalivand.com" target="_blank" rel="noopener" style="color:rgba(255,255,255,0.55);text-decoration:none;">Babak Dalivand</a>
                </span>
            </span>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php echo $is_en ? 'Privacy Policy' : 'سیاست حریم خصوصی'; ?></a>
                <a href="<?php echo esc_url(home_url('/terms')); ?>"><?php echo $is_en ? 'Terms of Use' : 'شرایط استفاده'; ?></a>
                <a href="<?php echo esc_url(home_url('/sitemap.xml')); ?>">Sitemap</a>
            </div>
        </div>

    </div>
</footer>

<!-- Cookie Consent Banner -->
<div id="pa-cookie-banner" aria-live="polite" role="dialog" aria-label="<?php echo $is_en ? 'Cookie notice' : 'اطلاعیه کوکی'; ?>" style="display:none">
    <div class="pa-cookie-inner">
        <div class="pa-cookie-text">
            <span class="pa-cookie-icon">🍪</span>
            <div>
                <strong><?php echo $is_en ? 'We use cookies' : 'ما از کوکی استفاده می‌کنیم'; ?></strong>
                <p><?php echo $is_en
                    ? 'We use essential cookies only to keep you logged in and remember your preferences. No tracking or advertising cookies.'
                    : 'فقط از کوکی‌های ضروری برای حفظ وضعیت ورود و تنظیمات شما استفاده می‌کنیم. هیچ کوکی تبلیغاتی یا ردیابی وجود ندارد.';
                ?></p>
            </div>
        </div>
        <div class="pa-cookie-actions">
            <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="pa-cookie-link">
                <?php echo $is_en ? 'Learn more' : 'اطلاعات بیشتر'; ?>
            </a>
            <button id="pa-cookie-accept" class="pa-cookie-btn">
                <?php echo $is_en ? 'Got it' : 'متوجه شدم'; ?> ✓
            </button>
        </div>
    </div>
</div>

<style>
#pa-cookie-banner {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    z-index: 99999;
    padding: 0 16px 16px;
    pointer-events: none;
    transform: translateY(120%);
    transition: transform .4s cubic-bezier(.16,1,.3,1);
}
#pa-cookie-banner.pa-cookie-visible {
    transform: translateY(0);
    pointer-events: auto;
}
.pa-cookie-inner {
    max-width: 860px;
    margin: 0 auto;
    background: #1C1915;
    border: 1px solid rgba(212,160,23,0.25);
    border-radius: 14px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: 0 -4px 32px rgba(0,0,0,0.5);
    direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>;
    font-family: 'Vazirmatn', Tahoma, sans-serif;
    flex-wrap: wrap;
}
.pa-cookie-text {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    flex: 1;
    min-width: 0;
}
.pa-cookie-icon { font-size: 24px; flex-shrink: 0; margin-top: 1px; }
.pa-cookie-text strong {
    display: block;
    color: #FFFCF2;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 3px;
}
.pa-cookie-text p {
    color: rgba(255,252,242,0.55);
    font-size: 13px;
    margin: 0;
    line-height: 1.6;
}
.pa-cookie-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
}
.pa-cookie-link {
    color: rgba(212,160,23,0.8);
    font-size: 13px;
    text-decoration: none;
    font-weight: 600;
    white-space: nowrap;
    transition: color .2s;
}
.pa-cookie-link:hover { color: #D4A017; }
.pa-cookie-btn {
    background: #D4A017;
    color: #0D0B09;
    border: none;
    border-radius: 8px;
    padding: 9px 20px;
    font-size: 13px;
    font-weight: 800;
    cursor: pointer;
    white-space: nowrap;
    transition: background .2s, transform .15s;
    font-family: 'Vazirmatn', Tahoma, sans-serif;
}
.pa-cookie-btn:hover { background: #e6b51e; transform: scale(1.03); }
.pa-cookie-btn:active { transform: scale(0.98); }
@media (max-width: 560px) {
    .pa-cookie-inner { flex-direction: column; align-items: stretch; }
    .pa-cookie-actions { justify-content: flex-end; }
}
</style>

<script>
(function(){
    var STORAGE_KEY = 'pa_cookie_ok';
    if (localStorage.getItem(STORAGE_KEY)) return;

    var banner = document.getElementById('pa-cookie-banner');
    if (!banner) return;

    banner.style.display = 'block';
    setTimeout(function(){ banner.classList.add('pa-cookie-visible'); }, 600);

    document.getElementById('pa-cookie-accept').addEventListener('click', function(){
        localStorage.setItem(STORAGE_KEY, '1');
        banner.classList.remove('pa-cookie-visible');
        setTimeout(function(){ banner.style.display = 'none'; }, 450);
    });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
