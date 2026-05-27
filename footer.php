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
    background: var(--primary);
    border-top: 1px solid var(--border);
    padding: 0;
}
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
    color: var(--muted);
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: color .2s, background .2s;
    white-space: nowrap;
}
.cta-mini-item:hover { color: var(--accent); background: rgba(124,58,237,.06); }
.cta-mini-highlight { color: var(--text); }
.cta-mini-icon { font-size: 16px; }
.cta-mini-sep {
    width: 1px;
    background: var(--border);
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
                <div class="footer-col-title"><?php echo $is_en ? 'Quick Access' : 'دسترسی سریع'; ?></div>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/articles')); ?>"><?php echo $is_en ? 'Articles' : 'مقالات'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/videos')); ?>"><?php echo $is_en ? 'Videos' : 'ویدیوها'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/podcasts')); ?>"><?php echo $is_en ? 'Podcasts' : 'پادکست‌ها'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/library')); ?>"><?php echo $is_en ? 'Library' : 'کتابخانه'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php echo $is_en ? 'About Us' : 'درباره ما'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php echo $is_en ? 'Contact' : 'تماس با ما'; ?></a></li>
                </ul>
            </div>

            <!-- Categories -->
            <div class="footer-col">
                <div class="footer-col-title"><?php echo $is_en ? 'Categories' : 'دسته‌بندی‌ها'; ?></div>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/category/science')); ?>"><?php echo $is_en ? 'Science' : 'علم'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/philosophy')); ?>"><?php echo $is_en ? 'Philosophy' : 'فلسفه'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/history')); ?>"><?php echo $is_en ? 'History' : 'تاریخ'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/atheism')); ?>"><?php echo $is_en ? 'Atheism' : 'الحاد'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/secularism')); ?>"><?php echo $is_en ? 'Secularism' : 'سکولاریسم'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/category/iran')); ?>"><?php echo $is_en ? 'Iran' : 'ایران'; ?></a></li>
                </ul>
            </div>

            <!-- Useful Links -->
            <div class="footer-col">
                <div class="footer-col-title"><?php echo $is_en ? 'Useful Links' : 'لینک‌های مفید'; ?></div>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/constitution')); ?>"><?php echo $is_en ? 'Constitution' : 'اساسنامه'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/membership')); ?>"><?php echo $is_en ? 'Join the Group' : 'عضویت در گروه'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php echo $is_en ? 'About Us' : 'درباره ما'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php echo $is_en ? 'Contact Us' : 'تماس با ما'; ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/donate')); ?>"><?php echo $is_en ? 'Donate' : 'حمایت مالی'; ?></a></li>
                    <li><a href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php echo $is_en ? 'Privacy Policy' : 'حریم خصوصی'; ?></a></li>
                </ul>
            </div>

            <!-- Donate Box -->
            <div class="footer-col">
                <div class="footer-donate-box">
                    <div class="footer-donate-title">❤️ <?php echo $is_en ? 'Support Us' : 'حمایت مالی'; ?></div>
                    <a href="https://paypal.com" target="_blank" rel="noopener" class="donate-paypal-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.59 3.025-2.566 4.643-5.813 4.643h-1.38l-1.016 6.44h2.19c.456 0 .843-.332.915-.781l.764-4.843c.072-.449.46-.781.916-.781h.577c3.733 0 6.65-1.518 7.503-5.912a4.13 4.13 0 0 0-3.008-2.479z"/></svg>
                        PayPal
                    </a>
                    <div class="crypto-row">
                        <a href="#" class="crypto-btn crypto-btc" title="Bitcoin">₿ BTC</a>
                        <a href="#" class="crypto-btn crypto-eth" title="Ethereum">Ξ ETH</a>
                        <a href="#" class="crypto-btn crypto-usdt" title="USDT">₮ USDT</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <span>
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                <?php echo $is_en ? 'All rights reserved.' : 'تمام حقوق محفوظ است.'; ?>
            </span>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url(get_privacy_policy_url()); ?>"><?php echo $is_en ? 'Privacy Policy' : 'سیاست حریم خصوصی'; ?></a>
                <a href="<?php echo esc_url(home_url('/terms')); ?>"><?php echo $is_en ? 'Terms of Use' : 'شرایط استفاده'; ?></a>
                <a href="<?php echo esc_url(home_url('/sitemap.xml')); ?>">Sitemap</a>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
