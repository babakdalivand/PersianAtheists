<?php
/**
 * Template Name: Privacy Policy
 */
get_header();
$is_en = (isset($_COOKIE['pa_lang']) && $_COOKIE['pa_lang'] === 'en');
?>
<style>
.pa-policy-wrap {
    max-width: 820px; margin: 0 auto;
    padding: 48px 24px 80px;
    direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>;
    font-family: 'Vazirmatn', Tahoma, sans-serif;
}
.pa-policy-hero {
    text-align: center;
    padding: 56px 24px 48px;
    background: linear-gradient(135deg, #1A1714 0%, #0D0B09 100%);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.pa-policy-hero-icon { font-size: 52px; margin-bottom: 16px; display: block; filter: drop-shadow(0 0 20px rgba(212,160,23,0.4)); }
.pa-policy-hero h1  { font-size: clamp(24px, 3vw, 38px); font-weight: 900; color: #FFFCF2; margin: 0 0 12px; direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>; }
.pa-policy-hero p   { font-size: 14px; color: rgba(255,252,242,0.5); margin: 0; direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>; }
.pa-policy-updated {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(212,160,23,0.15); border: 1px solid rgba(212,160,23,0.3);
    color: #D4A017; font-size: 12px; font-weight: 700;
    padding: 4px 14px; border-radius: 20px; margin-top: 14px;
}
.pa-policy-section {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px; padding: 28px 28px 24px;
    margin-bottom: 16px; transition: border-color .2s;
}
.pa-policy-section:hover { border-color: rgba(212,160,23,0.3); }
.pa-policy-section-head { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
.pa-policy-section-icon {
    width: 40px; height: 40px; border-radius: 10px;
    background: rgba(235,94,40,0.1); border: 1px solid rgba(235,94,40,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
}
.pa-policy-section-icon.gold { background: rgba(212,160,23,0.1); border-color: rgba(212,160,23,0.2); }
.pa-policy-section h2 { font-size: 16px; font-weight: 800; color: var(--text); margin: 0; }
.pa-policy-section p, .pa-policy-section li { font-size: 14px; color: var(--muted); line-height: 1.85; margin: 0 0 8px; }
.pa-policy-section ul { padding-<?php echo $is_en ? 'left' : 'right'; ?>: 20px; margin: 8px 0 0; }
.pa-policy-section li { margin-bottom: 6px; }
.pa-policy-highlight {
    background: var(--bg);
    border: 1px solid rgba(212,160,23,0.2);
    border-<?php echo $is_en ? 'left' : 'right'; ?>: 3px solid #D4A017;
    border-radius: 10px; padding: 16px 18px; margin-top: 12px;
}
.pa-policy-highlight p { color: var(--text) !important; margin: 0 !important; font-size: 14px !important; }
.pa-policy-highlight.red {
    border-color: rgba(235,94,40,0.2);
    border-<?php echo $is_en ? 'left' : 'right'; ?>-color: #EB5E28;
}
.pa-policy-shield {
    background: var(--surface);
    border: 1px solid rgba(212,160,23,0.3);
    border-radius: 16px; padding: 28px;
    margin-bottom: 16px; text-align: center;
}
.pa-policy-shield-icon { font-size: 44px; display: block; margin-bottom: 12px; }
.pa-policy-shield h3 { font-size: 18px; font-weight: 900; color: #D4A017; margin: 0 0 10px; }
.pa-policy-shield p  { font-size: 14px; color: var(--muted); line-height: 1.85; margin: 0; }
.pa-policy-contact {
    text-align: center; padding: 32px 24px;
    background: var(--surface);
    border: 1px solid rgba(235,94,40,0.2);
    border-radius: 16px; margin-top: 8px;
}
.pa-policy-contact p { color: var(--muted); font-size: 14px; margin: 0 0 14px; }
.pa-policy-contact a {
    display: inline-flex; align-items: center; gap: 8px;
    background: #EB5E28; color: #fff; text-decoration: none;
    padding: 11px 24px; border-radius: 10px; font-weight: 700; font-size: 14px;
    transition: background .2s;
}
.pa-policy-contact a:hover { background: #c94d1e; }
</style>

<div class="pa-policy-hero">
    <span class="pa-policy-hero-icon">🔒</span>
    <h1><?php echo $is_en ? 'Privacy Policy' : 'سیاست حریم خصوصی'; ?></h1>
    <p><?php echo $is_en
        ? 'We know what\'s at stake. Your safety is not a feature — it\'s our foundation.'
        : 'می‌دانیم چه خطراتی در کار است. امنیت شما یک ویژگی نیست — پایه کار ماست.';
    ?></p>
    <div class="pa-policy-updated">📅 <?php echo $is_en ? 'Last updated: May 2026' : 'آخرین بروزرسانی: خرداد ۱۴۰۵'; ?></div>
</div>

<div class="pa-policy-wrap">

<?php if (!$is_en): ?>

    <div class="pa-policy-shield">
        <span class="pa-policy-shield-icon">🛡️</span>
        <h3>تعهد ما به امنیت شما</h3>
        <p>در ایران، آتئیسم، شک دینی و نقد اسلام می‌تواند پیامدهای قانونی سنگینی داشته باشد. این پلتفرم با آگاهی کامل از این واقعیت طراحی شده است. <strong style="color:#D4A017">هویت شما هرگز — تحت هیچ شرایطی — در اختیار هیچ دولت، نهاد، یا شخص ثالثی قرار نمی‌گیرد.</strong></p>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon">👁️</div><h2>چه اطلاعاتی جمع‌آوری می‌کنیم؟</h2></div>
        <p>ما تنها حداقل اطلاعات لازم برای ارائه خدمات را جمع‌آوری می‌کنیم:</p>
        <ul>
            <li><strong>اطلاعات ثبت‌نام:</strong> نام کاربری، آدرس ایمیل و رمز عبور هش‌شده.</li>
            <li><strong>اطلاعات فعالیت:</strong> کامنت‌ها، پست‌ها و تعاملات شما در سایت.</li>
            <li><strong>اطلاعات فنی:</strong> آدرس IP و نوع مرورگر — فقط برای امنیت و عملکرد.</li>
        </ul>
        <div class="pa-policy-highlight">
            <p>⚡ <strong>ایمیل شما هرگز به‌صورت عمومی نمایش داده نمی‌شود.</strong> فقط نام کاربری برای سایرین قابل مشاهده است. توصیه می‌کنیم از نام مستعار استفاده کنید.</p>
        </div>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon" style="background:rgba(235,94,40,0.15);border-color:rgba(235,94,40,0.3)">🚨</div><h2>امنیت در برابر تهدیدات سیاسی</h2></div>
        <p>این بخش برای کاربرانی نوشته شده که در کشورهایی زندگی می‌کنند که آزاداندیشی در آن‌ها جرم محسوب می‌شود:</p>
        <ul>
            <li><strong>هیچ همکاری با جمهوری اسلامی:</strong> ما به هیچ درخواست اطلاعاتی از سوی حاکمیت ایران پاسخ نمی‌دهیم.</li>
            <li><strong>هیچ داده‌ای تحویل نمی‌دهیم:</strong> حتی در صورت فشار قانونی در ایران، داده‌های کاربران در اختیار نهادهای سرکوبگر قرار نمی‌گیرد.</li>
            <li><strong>آدرس IP ذخیره نمی‌شود:</strong> لاگ‌های IP به‌طور منظم پاک می‌شوند و قابل پیگیری نیستند.</li>
            <li><strong>حق ناشناسی:</strong> شما می‌توانید با نام کاملاً مستعار و ایمیل موقت ثبت‌نام کنید.</li>
        </ul>
        <div class="pa-policy-highlight red">
            <p>🔴 <strong>توصیه امنیتی:</strong> برای امنیت بیشتر از VPN یا Tor Browser استفاده کنید. ایمیل ثبت‌نام نباید به هویت واقعی شما مرتبط باشد.</p>
        </div>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon">🍪</div><h2>کوکی‌ها</h2></div>
        <p>ما از کوکی‌های ضروری برای حفظ وضعیت ورود، تنظیمات زبان و امنیت فرم‌ها استفاده می‌کنیم. هیچ کوکی تبلیغاتی یا ردیابی شخص ثالث بدون اطلاع شما نصب نمی‌شود.</p>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon">🚫</div><h2>چه چیزی انجام نمی‌دهیم</h2></div>
        <ul>
            <li>اطلاعات شما را به هیچ شخص ثالث، شرکت، یا دولتی نمی‌فروشیم یا تحویل نمی‌دهیم.</li>
            <li>ایمیل شما را بدون رضایت شما در اختیار دیگران قرار نمی‌دهیم.</li>
            <li>محتوای پیام‌های خصوصی شما را نمی‌خوانیم.</li>
            <li>از اطلاعات شما برای تبلیغات هدفمند استفاده نمی‌کنیم.</li>
            <li>به درخواست‌های دولت‌های سرکوبگر برای شناسایی کاربران پاسخ نمی‌دهیم.</li>
        </ul>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon gold">🛡️</div><h2>امنیت فنی اطلاعات</h2></div>
        <p>رمزهای عبور با الگوریتم‌های استاندارد هش می‌شوند. ارتباط سایت از طریق HTTPS رمزنگاری می‌شود. در صورت بروز هرگونه نقص امنیتی، بلافاصله به کاربران اطلاع می‌دهیم.</p>
        <div class="pa-policy-highlight">
            <p>🔐 ارتباطات سایت با <strong>TLS/HTTPS</strong> رمزنگاری شده است. داده‌ها در سرور امن خارج از ایران نگه‌داری می‌شوند.</p>
        </div>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon gold">⚖️</div><h2>حقوق شما</h2></div>
        <p>شما در هر زمان حق دارید:</p>
        <ul>
            <li>درخواست مشاهده اطلاعاتی که از شما داریم.</li>
            <li>درخواست حذف کامل حساب و تمام اطلاعات مرتبط.</li>
            <li>تصحیح اطلاعات نادرست یا ناقص.</li>
        </ul>
        <div class="pa-policy-highlight">
            <p>✉️ برای اعمال این حقوق کافیست با ما تماس بگیرید. درخواست‌ها ظرف ۷ روز کاری پردازش می‌شوند.</p>
        </div>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon">🌐</div><h2>سرویس‌های شخص ثالث</h2></div>
        <p>ما از یوتیوب برای پخش ویدیو استفاده می‌کنیم. هنگام تماشای ویدیوهای تعبیه‌شده، سیاست حریم خصوصی گوگل/یوتیوب هم اعمال می‌شود. توصیه می‌کنیم در صورت نگرانی، از حالت خصوصی مرورگر استفاده کنید.</p>
    </div>

<?php else: ?>

    <div class="pa-policy-shield">
        <span class="pa-policy-shield-icon">🛡️</span>
        <h3>Our Commitment to Your Safety</h3>
        <p>In Iran, atheism, religious doubt, and criticism of Islam can carry severe legal consequences. This platform is built with full awareness of that reality. <strong style="color:#D4A017">Your identity will never — under any circumstances — be shared with any government, institution, or third party.</strong></p>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon">👁️</div><h2>What We Collect</h2></div>
        <p>We collect only the minimum information necessary to provide our services:</p>
        <ul>
            <li><strong>Registration info:</strong> Username, email address, and hashed password.</li>
            <li><strong>Activity info:</strong> Comments, posts, and interactions on the site.</li>
            <li><strong>Technical info:</strong> IP address and browser type — only for security and performance.</li>
        </ul>
        <div class="pa-policy-highlight">
            <p>⚡ <strong>Your email is never publicly displayed.</strong> Only your username is visible to others. We recommend using a pseudonym.</p>
        </div>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon" style="background:rgba(235,94,40,0.15);border-color:rgba(235,94,40,0.3)">🚨</div><h2>Protection Against Political Threats</h2></div>
        <ul>
            <li><strong>No cooperation with the Islamic Republic:</strong> We do not respond to any information requests from the Iranian government.</li>
            <li><strong>No data handovers:</strong> User data will not be handed to repressive institutions.</li>
            <li><strong>IP addresses not retained:</strong> IP logs are regularly purged and are not traceable.</li>
            <li><strong>Right to anonymity:</strong> You may register with a pseudonymous identity and a temporary email.</li>
        </ul>
        <div class="pa-policy-highlight red">
            <p>🔴 <strong>Security tip:</strong> Use a VPN or Tor Browser for additional safety. Your registration email should not be linked to your real identity.</p>
        </div>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon">🍪</div><h2>Cookies</h2></div>
        <p>We use essential cookies only — to maintain login sessions, language preferences, and form security. No advertising or third-party tracking cookies are installed without your knowledge.</p>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon">🚫</div><h2>What We Don't Do</h2></div>
        <ul>
            <li>We never sell or hand over your data to any third party, company, or government.</li>
            <li>We never share your email without your explicit consent.</li>
            <li>We never read the content of your private messages.</li>
            <li>We never use your data for targeted advertising.</li>
            <li>We never respond to requests from repressive governments to identify users.</li>
        </ul>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon gold">🛡️</div><h2>Technical Security</h2></div>
        <p>Passwords are hashed using industry-standard algorithms and are never stored in plain text. All site communication is encrypted via HTTPS. Users will be notified immediately of any potential security breach.</p>
        <div class="pa-policy-highlight">
            <p>🔐 All connections are encrypted with <strong>TLS/HTTPS</strong>. Data is stored on secure servers outside of Iran.</p>
        </div>
    </div>

    <div class="pa-policy-section">
        <div class="pa-policy-section-head"><div class="pa-policy-section-icon gold">⚖️</div><h2>Your Rights</h2></div>
        <p>You have the right at any time to:</p>
        <ul>
            <li>Request access to the data we hold about you.</li>
            <li>Request complete deletion of your account and all associated data.</li>
            <li>Correct inaccurate or incomplete information.</li>
        </ul>
        <div class="pa-policy-highlight">
            <p>✉️ Contact us to exercise these rights. Requests are processed within 7 business days.</p>
        </div>
    </div>

<?php endif; ?>

    <div class="pa-policy-contact">
        <p><?php echo $is_en ? 'Questions about your privacy? We\'re here to help.' : 'سوالی درباره حریم خصوصی‌تان دارید؟ اینجاییم.'; ?></p>
        <a href="<?php echo esc_url(home_url('/contact')); ?>">✉️ <?php echo $is_en ? 'Contact Us' : 'تماس با ما'; ?></a>
    </div>

</div>

<?php get_footer(); ?>
