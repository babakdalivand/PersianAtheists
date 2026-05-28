<?php
/**
 * Template Name: Terms of Use
 */
get_header();
$is_en = (isset($_COOKIE['pa_lang']) && $_COOKIE['pa_lang'] === 'en');
?>
<style>
.pa-terms-wrap {
    max-width: 820px; margin: 0 auto;
    padding: 48px 24px 80px;
    direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>;
    font-family: 'Vazirmatn', Tahoma, sans-serif;
}
.pa-terms-hero {
    text-align: center;
    padding: 56px 24px 48px;
    background: linear-gradient(135deg, #1A1714 0%, #0D0B09 100%);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.pa-terms-hero-icon { font-size: 52px; margin-bottom: 16px; display: block; filter: drop-shadow(0 0 20px rgba(235,94,40,0.4)); }
.pa-terms-hero h1  { font-size: clamp(24px, 3vw, 38px); font-weight: 900; color: #FFFCF2; margin: 0 0 12px; direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>; }
.pa-terms-hero p   { font-size: 14px; color: rgba(255,252,242,0.5); margin: 0; direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>; }
.pa-terms-updated {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(235,94,40,0.15); border: 1px solid rgba(235,94,40,0.3);
    color: #EB5E28; font-size: 12px; font-weight: 700;
    padding: 4px 14px; border-radius: 20px; margin-top: 14px;
}
.pa-terms-section {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px; padding: 28px 28px 24px;
    margin-bottom: 16px; transition: border-color .2s;
}
.pa-terms-section:hover { border-color: rgba(235,94,40,0.3); }
.pa-terms-section-head { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
.pa-terms-section-icon {
    width: 40px; height: 40px; border-radius: 10px;
    background: rgba(212,160,23,0.1); border: 1px solid rgba(212,160,23,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
}
.pa-terms-section h2 { font-size: 16px; font-weight: 800; color: var(--text); margin: 0; }
.pa-terms-section p, .pa-terms-section li { font-size: 14px; color: var(--muted); line-height: 1.85; margin: 0 0 8px; }
.pa-terms-section ul { padding-<?php echo $is_en ? 'left' : 'right'; ?>: 20px; margin: 8px 0 0; }
.pa-terms-section li { margin-bottom: 6px; }
.pa-terms-highlight {
    background: var(--bg);
    border: 1px solid rgba(212,160,23,0.2);
    border-<?php echo $is_en ? 'left' : 'right'; ?>: 3px solid #D4A017;
    border-radius: 10px; padding: 16px 18px; margin-top: 12px;
}
.pa-terms-highlight p { color: var(--text) !important; margin: 0 !important; font-size: 14px !important; }
.pa-terms-highlight.orange {
    border-color: rgba(235,94,40,0.2);
    border-<?php echo $is_en ? 'left' : 'right'; ?>-color: #EB5E28;
}
.pa-terms-freedom {
    background: var(--surface);
    border: 1px solid rgba(212,160,23,0.3);
    border-radius: 16px; padding: 28px;
    margin-bottom: 16px; text-align: center;
}
.pa-terms-freedom-icon { font-size: 40px; display: block; margin-bottom: 12px; }
.pa-terms-freedom h3 { font-size: 18px; font-weight: 900; color: #D4A017; margin: 0 0 10px; }
.pa-terms-freedom p  { font-size: 14px; color: var(--muted); line-height: 1.85; margin: 0; }
.pa-terms-contact {
    text-align: center; padding: 32px 24px;
    background: var(--surface);
    border: 1px solid rgba(235,94,40,0.2);
    border-radius: 16px; margin-top: 8px;
}
.pa-terms-contact p { color: var(--muted); font-size: 14px; margin: 0 0 14px; }
.pa-terms-contact a {
    display: inline-flex; align-items: center; gap: 8px;
    background: #EB5E28; color: #fff; text-decoration: none;
    padding: 11px 24px; border-radius: 10px; font-weight: 700; font-size: 14px;
    transition: background .2s;
}
.pa-terms-contact a:hover { background: #c94d1e; }
</style>

<div class="pa-terms-hero">
    <span class="pa-terms-hero-icon">📜</span>
    <h1><?php echo $is_en ? 'Terms of Use' : 'شرایط استفاده'; ?></h1>
    <p><?php echo $is_en
        ? 'Please read these terms carefully before using our platform.'
        : 'پیش از استفاده از پلتفرم، این شرایط را با دقت مطالعه کنید.';
    ?></p>
    <div class="pa-terms-updated">📅 <?php echo $is_en ? 'Last updated: May 2026' : 'آخرین بروزرسانی: خرداد ۱۴۰۵'; ?></div>
</div>

<div class="pa-terms-wrap">

<?php if (!$is_en): ?>

    <div class="pa-terms-freedom">
        <span class="pa-terms-freedom-icon">🕊️</span>
        <h3>محتوا آزاد است — با ذکر منبع</h3>
        <p>ما به گسترش آگاهی اعتقاد داریم. <strong style="color:#D4A017">هر مقاله، متن، یا محتوایی که در رها منتشر می‌شود، می‌توانید آزادانه بازنشر کنید</strong> — به شرط اینکه منبع را ذکر کنید. آگاهی دارایی همگانی است.</p>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">✅</div><h2>پذیرش شرایط</h2></div>
        <p>با استفاده از وب‌سایت رها (persianatheists.com)، این شرایط را می‌پذیرید. اگر با هر بخشی مخالف هستید، لطفاً از استفاده از سایت خودداری کنید.</p>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">👤</div><h2>حساب کاربری</h2></div>
        <ul>
            <li>شما مسئول حفظ امنیت رمز عبور خود هستید.</li>
            <li>اطلاعات ثبت‌نامی باید صادقانه و دقیق باشند.</li>
            <li>هر حساب متعلق به یک شخص حقیقی است — انتقال حساب مجاز نیست.</li>
            <li>در صورت مشاهده هرگونه دسترسی غیرمجاز، فوراً با ما تماس بگیرید.</li>
        </ul>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">✍️</div><h2>قوانین محتوا</h2></div>
        <p>این پلتفرم فضایی برای گفتگوی آزاد، نقد دین، و تبادل اندیشه است. با این حال:</p>
        <ul>
            <li>محتوای تهدیدآمیز، توهین‌آمیز شخصی، یا ترویج خشونت مجاز نیست.</li>
            <li>اطلاعات شخصی دیگران بدون رضایت آن‌ها منتشر نکنید.</li>
            <li>محتوای هرزنامه یا تبلیغاتی بدون مجوز قابل حذف است.</li>
            <li>نقد ایده‌ها، باورها، و مذاهب با رعایت ادب، آزادانه مجاز است.</li>
        </ul>
        <div class="pa-terms-highlight">
            <p>💬 <strong>نقد دین، خداناباوری، و تفکر آزاد</strong> ماهیت اصلی این پلتفرم است و هیچ‌گاه سانسور نمی‌شود.</p>
        </div>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">🔁</div><h2>بازنشر و استفاده مجدد از محتوا</h2></div>
        <ul>
            <li><strong>بازنشر با ذکر منبع:</strong> هر محتوایی در رها را می‌توانید با درج لینک یا نام منبع بازنشر کنید.</li>
            <li><strong>ترجمه:</strong> ترجمه مقالات با ذکر منبع اصلی بلامانع است.</li>
            <li><strong>استفاده تجاری:</strong> برای استفاده تجاری گسترده، لطفاً با ما هماهنگ کنید.</li>
        </ul>
        <div class="pa-terms-highlight">
            <p>🌍 <strong>هدف ما گسترش آگاهی است، نه محدود کردن آن.</strong> مقالات را آزادانه به اشتراک بگذارید.</p>
        </div>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">⚖️</div><h2>تعلیق و حذف حساب</h2></div>
        <p>ما حق داریم در موارد زیر حساب کاربری را تعلیق یا حذف کنیم:</p>
        <ul>
            <li>نقض مکرر قوانین محتوا</li>
            <li>رفتار آزاردهنده نسبت به کاربران دیگر</li>
            <li>تلاش برای هک یا دسترسی غیرمجاز به سیستم</li>
        </ul>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">🔄</div><h2>تغییر شرایط</h2></div>
        <p>این شرایط ممکن است به‌روزرسانی شوند. در صورت تغییرات مهم، کاربران از طریق ایمیل یا اطلاعیه در سایت مطلع می‌شوند.</p>
    </div>

<?php else: ?>

    <div class="pa-terms-freedom">
        <span class="pa-terms-freedom-icon">🕊️</span>
        <h3>Content is Free — With Attribution</h3>
        <p>We believe in spreading awareness. <strong style="color:#D4A017">Any article, text, or content published on RAHA can be freely shared and republished</strong> — as long as you credit the source. Knowledge belongs to everyone.</p>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">✅</div><h2>Acceptance of Terms</h2></div>
        <p>By using the RAHA website (persianatheists.com), you agree to these terms. If you disagree with any part, please refrain from using the site.</p>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">👤</div><h2>User Accounts</h2></div>
        <ul>
            <li>You are responsible for maintaining the security of your password.</li>
            <li>Registration information must be honest and accurate.</li>
            <li>Each account belongs to one real person — account transfers are not permitted.</li>
            <li>Report any unauthorized access immediately by contacting us.</li>
        </ul>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">✍️</div><h2>Content Rules</h2></div>
        <p>This platform is a space for free dialogue, religious criticism, and exchange of ideas. However:</p>
        <ul>
            <li>Threatening, personally abusive, or violence-promoting content is not allowed.</li>
            <li>Do not publish others' personal information without their consent.</li>
            <li>Spam or unauthorized commercial content may be removed.</li>
            <li>Criticism of ideas, beliefs, and religions is freely permitted.</li>
        </ul>
        <div class="pa-terms-highlight">
            <p>💬 <strong>Criticism of religion, atheism, and free thought</strong> are the core nature of this platform and will never be censored.</p>
        </div>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">🔁</div><h2>Sharing &amp; Reuse of Content</h2></div>
        <ul>
            <li><strong>Republish with attribution:</strong> Any content on RAHA can be shared with a link or credit to the source.</li>
            <li><strong>Translation:</strong> Translating articles is permitted with a credit to the original source.</li>
            <li><strong>Commercial use:</strong> For broad commercial use, please coordinate with us first.</li>
        </ul>
        <div class="pa-terms-highlight">
            <p>🌍 <strong>Our goal is to spread awareness, not restrict it.</strong> Share articles freely.</p>
        </div>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">⚖️</div><h2>Account Suspension &amp; Removal</h2></div>
        <p>We reserve the right to suspend or remove accounts for:</p>
        <ul>
            <li>Repeated violation of content rules</li>
            <li>Harassing behavior toward other users</li>
            <li>Attempting to hack or gain unauthorized system access</li>
        </ul>
    </div>

    <div class="pa-terms-section">
        <div class="pa-terms-section-head"><div class="pa-terms-section-icon">🔄</div><h2>Changes to These Terms</h2></div>
        <p>These terms may be updated. For significant changes, users will be notified via email or a site announcement.</p>
    </div>

<?php endif; ?>

    <div class="pa-terms-contact">
        <p><?php echo $is_en ? 'Have questions about these terms?' : 'سوالی درباره این شرایط دارید؟'; ?></p>
        <a href="<?php echo esc_url(home_url('/contact')); ?>">✉️ <?php echo $is_en ? 'Contact Us' : 'تماس با ما'; ?></a>
    </div>

</div>

<?php get_footer(); ?>
