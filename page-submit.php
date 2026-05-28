<?php
/**
 * Template Name: Submit Article
 */

$is_en = (isset($_COOKIE['pa_lang']) && $_COOKIE['pa_lang'] === 'en');

$submit_status = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pa_submit_nonce'])) {
    if (!wp_verify_nonce($_POST['pa_submit_nonce'], 'pa_submit_article')) {
        $submit_status = 'error';
    } else {
        $name  = sanitize_text_field($_POST['pa_name'] ?? '');
        $email = sanitize_email($_POST['pa_email'] ?? '');
        $link  = esc_url_raw($_POST['pa_link'] ?? '');
        $note  = sanitize_textarea_field($_POST['pa_note'] ?? '');
        if (!$name || !$email || !$link) {
            $submit_status = 'missing';
        } elseif (!is_email($email)) {
            $submit_status = 'bademail';
        } elseif (!filter_var($link, FILTER_VALIDATE_URL)) {
            $submit_status = 'badlink';
        } else {
            $admin_email = get_option('admin_email');
            $subject = '[رها] ارسال مقاله جدید از ' . $name;
            $body  = "نام: {$name}\n";
            $body .= "ایمیل: {$email}\n";
            $body .= "لینک مقاله: {$link}\n";
            if ($note) $body .= "توضیحات: {$note}\n";
            $sent = wp_mail($admin_email, $subject, $body, ['Reply-To: ' . $email]);
            $submit_status = $sent ? 'ok' : 'mailfail';
        }
    }
}

get_header();
?>
<style>
.pa-submit-wrap {
    max-width: 760px; margin: 0 auto;
    padding: 48px 24px 80px;
    direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>;
    font-family: 'Vazirmatn', Tahoma, sans-serif;
}
.pa-submit-hero {
    text-align: center;
    padding: 56px 24px 48px;
    background: linear-gradient(135deg, #1A1714 0%, #0D0B09 100%);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.pa-submit-hero-icon {
    font-size: 52px; margin-bottom: 16px; display: block;
    filter: drop-shadow(0 0 20px rgba(235,94,40,0.5));
}
.pa-submit-hero h1 { font-size: clamp(24px, 3vw, 38px); font-weight: 900; color: #FFFCF2; margin: 0 0 12px; }
.pa-submit-hero p  { font-size: 15px; color: rgba(255,252,242,0.55); margin: 0 auto; max-width: 520px; line-height: 1.7; }

.pa-submit-steps {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
    margin-bottom: 28px;
}
@media (max-width: 560px) { .pa-submit-steps { grid-template-columns: 1fr; } }
.pa-submit-step {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px; padding: 20px 16px;
    text-align: center; transition: border-color .2s;
}
.pa-submit-step:hover { border-color: rgba(235,94,40,0.35); }
.pa-submit-step-num {
    width: 32px; height: 32px; border-radius: 50%;
    background: rgba(235,94,40,0.12); border: 1px solid rgba(235,94,40,0.3);
    color: #EB5E28; font-size: 13px; font-weight: 900;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 10px;
}
.pa-submit-step h4 { font-size: 13px; font-weight: 800; color: var(--text); margin: 0 0 5px; }
.pa-submit-step p  { font-size: 12px; color: var(--muted); margin: 0; line-height: 1.5; }

.pa-submit-info {
    background: var(--surface);
    border: 1px solid rgba(212,160,23,0.3);
    border-<?php echo $is_en ? 'left' : 'right'; ?>: 3px solid #D4A017;
    border-radius: 14px; padding: 22px 24px;
    margin-bottom: 24px;
    display: flex; gap: 14px; align-items: flex-start;
}
.pa-submit-info-icon { font-size: 26px; flex-shrink: 0; margin-top: 2px; }
.pa-submit-info h3  { font-size: 15px; font-weight: 800; color: #D4A017; margin: 0 0 8px; }
.pa-submit-info ul  { padding-<?php echo $is_en ? 'left' : 'right'; ?>: 18px; margin: 0; }
.pa-submit-info li  { font-size: 13px; color: var(--muted); line-height: 1.7; margin-bottom: 4px; }

.pa-submit-form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px; padding: 32px;
}
.pa-submit-form-card h2 {
    font-size: 17px; font-weight: 800; color: var(--text);
    margin: 0 0 24px; display: flex; align-items: center; gap: 10px;
}
.pa-form-group { margin-bottom: 18px; }
.pa-form-label {
    display: block; font-size: 13px; font-weight: 700;
    color: var(--text); margin-bottom: 7px; opacity: .85;
}
.pa-form-label .req { color: #EB5E28; margin-<?php echo $is_en ? 'left' : 'right'; ?>: 2px; }
.pa-form-input,
.pa-form-textarea {
    width: 100%; box-sizing: border-box;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 10px;
    color: var(--text); font-size: 14px;
    font-family: 'Vazirmatn', Tahoma, sans-serif;
    padding: 12px 14px;
    transition: border-color .2s, box-shadow .2s;
    direction: <?php echo $is_en ? 'ltr' : 'rtl'; ?>;
    outline: none;
}
.pa-form-input:focus,
.pa-form-textarea:focus {
    border-color: rgba(212,160,23,0.6);
    box-shadow: 0 0 0 3px rgba(212,160,23,0.1);
}
.pa-form-input::placeholder,
.pa-form-textarea::placeholder { color: var(--muted); opacity: .6; }
.pa-form-input.link-input { direction: ltr; }
.pa-form-textarea { min-height: 100px; resize: vertical; }
.pa-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media (max-width: 520px) { .pa-form-row { grid-template-columns: 1fr; } }
.pa-form-hint { font-size: 12px; color: var(--muted); opacity: .7; margin-top: 5px; }
.pa-optional { color: var(--muted); font-weight: 400; font-size: 12px; }

.pa-submit-btn {
    width: 100%;
    background: linear-gradient(135deg, #EB5E28 0%, #c94d1e 100%);
    color: #fff; border: none; border-radius: 10px;
    padding: 14px 28px; font-size: 15px; font-weight: 800;
    font-family: 'Vazirmatn', Tahoma, sans-serif;
    cursor: pointer; margin-top: 8px;
    transition: opacity .2s, transform .15s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.pa-submit-btn:hover { opacity: .9; transform: translateY(-1px); }
.pa-submit-btn:active { transform: translateY(0); }

.pa-alert {
    padding: 14px 18px; border-radius: 10px;
    font-size: 14px; font-weight: 600; margin-bottom: 20px;
    display: flex; align-items: center; gap: 10px;
}
.pa-alert-err { background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.25); color: #dc2626; }
[data-theme="dark"] .pa-alert-err { color: #f87171; background: rgba(239,68,68,0.12); }

.pa-submit-success {
    text-align: center; padding: 60px 24px;
    background: var(--surface); border: 1px solid rgba(34,197,94,0.2);
    border-radius: 16px;
}
.pa-submit-success-icon { font-size: 56px; display: block; margin-bottom: 20px; }
.pa-submit-success h2 { font-size: 22px; font-weight: 900; color: var(--text); margin: 0 0 12px; }
.pa-submit-success p  { font-size: 14px; color: var(--muted); margin: 0 0 24px; line-height: 1.7; }
.pa-submit-success a {
    display: inline-flex; align-items: center; gap: 8px;
    background: #EB5E28; color: #fff; text-decoration: none;
    padding: 11px 24px; border-radius: 10px; font-weight: 700; font-size: 14px;
    transition: background .2s;
}
.pa-submit-success a:hover { background: #c94d1e; }
</style>

<div class="pa-submit-hero">
    <span class="pa-submit-hero-icon">✍️</span>
    <h1><?php echo $is_en ? 'Submit an Article' : 'ارسال مقاله'; ?></h1>
    <p><?php echo $is_en
        ? 'Have a piece worth sharing with the Iranian freethinker community? Send us the link and we\'ll review it.'
        : 'مطلبی دارید که ارزش به‌اشتراک‌گذاری با جامعه آزاداندیش ایرانی را دارد؟ لینکش را برای ما بفرستید تا بررسی کنیم.';
    ?></p>
</div>

<div class="pa-submit-wrap">

<?php if ($submit_status === 'ok'): ?>

    <div class="pa-submit-success">
        <span class="pa-submit-success-icon">🎉</span>
        <h2><?php echo $is_en ? 'Received! Thank you.' : 'دریافت شد! ممنون.'; ?></h2>
        <p><?php echo $is_en
            ? 'We received your submission and will review it shortly. If it meets our guidelines, we\'ll be in touch via email.'
            : 'مقاله شما دریافت شد و به زودی بررسی می‌شود. اگر با معیارهای ما همخوانی داشت، از طریق ایمیل با شما تماس می‌گیریم.';
        ?></p>
        <a href="<?php echo esc_url(home_url('/')); ?>">🏠 <?php echo $is_en ? 'Back to Home' : 'بازگشت به خانه'; ?></a>
    </div>

<?php else: ?>

    <div class="pa-submit-steps">
        <div class="pa-submit-step">
            <div class="pa-submit-step-num">۱</div>
            <h4><?php echo $is_en ? 'Send the Link' : 'لینک بفرستید'; ?></h4>
            <p><?php echo $is_en ? 'Paste the URL of your article or content' : 'آدرس مقاله یا محتوا را کپی کنید'; ?></p>
        </div>
        <div class="pa-submit-step">
            <div class="pa-submit-step-num">۲</div>
            <h4><?php echo $is_en ? 'We Review' : 'بررسی می‌کنیم'; ?></h4>
            <p><?php echo $is_en ? 'Our team reviews within 7 days' : 'تیم ما ظرف ۷ روز بررسی می‌کند'; ?></p>
        </div>
        <div class="pa-submit-step">
            <div class="pa-submit-step-num">۳</div>
            <h4><?php echo $is_en ? 'Publication' : 'انتشار'; ?></h4>
            <p><?php echo $is_en ? 'Approved content gets published with full credit' : 'محتوای تأییدشده با ذکر نام منتشر می‌شود'; ?></p>
        </div>
    </div>

    <div class="pa-submit-info">
        <span class="pa-submit-info-icon">💡</span>
        <div>
            <h3><?php echo $is_en ? 'What we\'re looking for' : 'دنبال چه چیزی هستیم'; ?></h3>
            <ul>
                <?php if (!$is_en): ?>
                <li>مقالات و تحلیل‌های مرتبط با آتئیسم، دین‌پژوهی انتقادی، عقل‌گرایی، و فلسفه</li>
                <li>محتوای فارسی یا انگلیسی با کیفیت بالا و استناد به منابع معتبر</li>
                <li>داستان‌های تجربی — مسیر خروج از دین، زندگی در ایران به‌عنوان آتئیست</li>
                <li>ترجمه‌های ارزشمند از متون فلسفی و علمی</li>
                <li>نقد اجتماعی، حقوق بشر، و مبارزه با خرافه</li>
                <?php else: ?>
                <li>Articles and analyses on atheism, critical religious studies, rationalism, and philosophy</li>
                <li>High-quality Persian or English content with credible sources</li>
                <li>Personal experience — deconversion stories, life in Iran as an atheist</li>
                <li>Valuable translations of philosophical and scientific texts</li>
                <li>Social criticism, human rights, and anti-superstition content</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <?php if ($submit_status === 'missing'): ?>
        <div class="pa-alert pa-alert-err">⚠️ <?php echo $is_en ? 'Please fill in all required fields.' : 'لطفاً همه فیلدهای ضروری را پر کنید.'; ?></div>
    <?php elseif ($submit_status === 'bademail'): ?>
        <div class="pa-alert pa-alert-err">⚠️ <?php echo $is_en ? 'Please enter a valid email address.' : 'لطفاً یک آدرس ایمیل معتبر وارد کنید.'; ?></div>
    <?php elseif ($submit_status === 'badlink'): ?>
        <div class="pa-alert pa-alert-err">⚠️ <?php echo $is_en ? 'Please enter a valid URL (starting with https://).' : 'لطفاً یک لینک معتبر وارد کنید (با https:// شروع شود).'; ?></div>
    <?php elseif ($submit_status === 'mailfail'): ?>
        <div class="pa-alert pa-alert-err">⚠️ <?php echo $is_en ? 'Something went wrong. Please try again.' : 'مشکلی پیش آمد. لطفاً دوباره تلاش کنید.'; ?></div>
    <?php endif; ?>

    <div class="pa-submit-form-card">
        <h2><span style="font-size:20px">📨</span><?php echo $is_en ? 'Submit Your Content' : 'ارسال محتوا'; ?></h2>
        <form method="POST" action="">
            <?php wp_nonce_field('pa_submit_article', 'pa_submit_nonce'); ?>
            <div class="pa-form-row">
                <div class="pa-form-group">
                    <label class="pa-form-label" for="pa_name"><?php echo $is_en ? 'Your Name' : 'نام شما'; ?> <span class="req">*</span></label>
                    <input type="text" id="pa_name" name="pa_name" class="pa-form-input"
                        placeholder="<?php echo $is_en ? 'e.g. Ali Ahmadi' : 'مثلاً علی احمدی'; ?>"
                        value="<?php echo esc_attr($_POST['pa_name'] ?? ''); ?>" required>
                </div>
                <div class="pa-form-group">
                    <label class="pa-form-label" for="pa_email"><?php echo $is_en ? 'Email Address' : 'آدرس ایمیل'; ?> <span class="req">*</span></label>
                    <input type="email" id="pa_email" name="pa_email" class="pa-form-input link-input"
                        placeholder="you@example.com"
                        value="<?php echo esc_attr($_POST['pa_email'] ?? ''); ?>" required>
                    <div class="pa-form-hint"><?php echo $is_en ? 'For our response only. Never shared.' : 'فقط برای پاسخ ما. هرگز منتشر نمی‌شود.'; ?></div>
                </div>
            </div>
            <div class="pa-form-group">
                <label class="pa-form-label" for="pa_link"><?php echo $is_en ? 'Article / Content Link' : 'لینک مقاله یا محتوا'; ?> <span class="req">*</span></label>
                <input type="url" id="pa_link" name="pa_link" class="pa-form-input link-input"
                    placeholder="https://..."
                    value="<?php echo esc_attr($_POST['pa_link'] ?? ''); ?>" required>
                <div class="pa-form-hint"><?php echo $is_en
                    ? 'Link to your article, blog post, Google Doc, Medium, Virgool, or any accessible URL.'
                    : 'لینک مقاله، پست وبلاگ، Google Doc، ویرگول، مدیوم یا هر آدرس دسترس‌پذیری.';
                ?></div>
            </div>
            <div class="pa-form-group">
                <label class="pa-form-label" for="pa_note">
                    <?php echo $is_en ? 'Additional Notes' : 'توضیحات بیشتر'; ?>
                    <span class="pa-optional"><?php echo $is_en ? '(optional)' : '(اختیاری)'; ?></span>
                </label>
                <textarea id="pa_note" name="pa_note" class="pa-form-textarea"
                    placeholder="<?php echo $is_en
                        ? 'Brief description of your content or anything you\'d like us to know...'
                        : 'توضیح کوتاهی درباره محتوا یا هر چیزی که می‌خواهید بدانیم...';
                    ?>"><?php echo esc_textarea($_POST['pa_note'] ?? ''); ?></textarea>
            </div>
            <button type="submit" class="pa-submit-btn">✉️ <?php echo $is_en ? 'Send Submission' : 'ارسال مقاله'; ?></button>
        </form>
    </div>

<?php endif; ?>
</div>

<?php get_footer(); ?>
