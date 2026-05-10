<?php
/**
 * Template Name: Membership Page
 * Description: Full membership application page with detailed form
 */
get_header();
?>

<main class="site-main" id="main-content">

    <!-- HERO -->
    <div class="membership-hero" style="background:linear-gradient(135deg,#1E2A38 0%,#2d3f54 100%);padding:70px 0;text-align:center;color:#fff;">
        <div class="container">
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(212,160,23,0.15);border:1px solid rgba(212,160,23,0.35);border-radius:99px;padding:6px 20px;margin-bottom:20px;">
                <span style="font-size:13px;font-weight:700;color:var(--accent);">👥 عضویت رسمی</span>
            </div>
            <h1 style="color:#fff;font-size:36px;margin-bottom:16px;">عضویت در دنیای واقعی</h1>
            <p style="color:rgba(255,255,255,0.7);max-width:540px;margin:0 auto;font-size:16px;line-height:1.75;">
                فرم درخواست عضویت فعال در گروه آتئیست‌های ایرانی را با دقت پر کنید.
                پس از بررسی، با شما تماس خواهیم گرفت.
            </p>

            <!-- Benefits -->
            <div style="display:flex;justify-content:center;gap:32px;margin-top:40px;flex-wrap:wrap;">
                <?php foreach ([
                    ['🔒', 'کاملاً محرمانه'],
                    ['✅', 'بررسی دستی'],
                    ['🌍', 'برای همه ایرانیان'],
                    ['🤝', 'جامعه امن'],
                ] as $b): ?>
                    <div style="text-align:center;color:rgba(255,255,255,0.8);">
                        <div style="font-size:28px;margin-bottom:6px;"><?php echo esc_html($b[0]); ?></div>
                        <div style="font-size:13px;font-weight:600;"><?php echo esc_html($b[1]); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- FORM SECTION -->
    <div class="container" style="padding:60px 20px 80px;">

        <div style="display:grid;grid-template-columns:1fr 340px;gap:40px;align-items:start;max-width:1100px;margin:0 auto;">

            <!-- LEFT: FORM -->
            <div class="membership-form-wrap">

                <!-- Progress bar -->
                <div class="form-progress" style="margin-bottom:28px;">
                    <div style="display:flex;justify-content:space-between;font-size:12px;color:var(--muted);margin-bottom:6px;">
                        <span>اطلاعات شخصی</span>
                        <span>معرفی و تجربه</span>
                        <span>تأیید و ارسال</span>
                    </div>
                    <div style="height:4px;background:var(--border);border-radius:2px;overflow:hidden;">
                        <div id="formProgressBar" style="height:100%;background:var(--accent);width:33%;border-radius:2px;transition:width 0.3s ease;"></div>
                    </div>
                </div>

                <!-- Message -->
                <div id="membershipMsg" style="display:none;padding:14px 18px;border-radius:var(--radius);margin-bottom:20px;font-weight:600;font-size:14px;"></div>

                <form id="fullMembershipForm" enctype="multipart/form-data">
                    <?php wp_nonce_field('pa_membership_submit', 'pa_membership_nonce'); ?>

                    <!-- SECTION 1: Personal Info -->
                    <h3 class="form-section-title">🧑 اطلاعات شخصی</h3>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="form-group">
                            <label class="form-label">نام کامل <span class="required">*</span></label>
                            <input type="text" name="full_name" class="form-control" placeholder="نام و نام خانوادگی" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">نام کاربری <span class="required">*</span></label>
                            <input type="text" name="username" class="form-control" placeholder="مثال: ali_tehrani" required pattern="[a-zA-Z0-9_]{3,30}">
                            <div class="form-hint">فقط حروف انگلیسی، اعداد و _ (بدون فاصله)</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">ایمیل <span class="required">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                        <div class="form-hint">از این ایمیل برای تماس با شما استفاده می‌شود.</div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="form-group">
                            <label class="form-label">کشور محل سکونت <span class="required">*</span></label>
                            <select name="country" class="form-control" required>
                                <option value="">انتخاب کنید...</option>
                                <option value="IR">ایران 🇮🇷</option>
                                <option value="DE">آلمان 🇩🇪</option>
                                <option value="GB">انگلستان 🇬🇧</option>
                                <option value="US">آمریکا 🇺🇸</option>
                                <option value="SE">سوئد 🇸🇪</option>
                                <option value="CA">کانادا 🇨🇦</option>
                                <option value="NL">هلند 🇳🇱</option>
                                <option value="AU">استرالیا 🇦🇺</option>
                                <option value="TR">ترکیه 🇹🇷</option>
                                <option value="FR">فرانسه 🇫🇷</option>
                                <option value="other">کشور دیگر</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">سن <span class="required">*</span></label>
                            <input type="number" name="age" class="form-control" placeholder="سن شما" min="16" max="100" required>
                            <div class="form-hint">حداقل سن برای عضویت: ۱۶ سال</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">لینک پروفایل شبکه اجتماعی</label>
                        <input type="url" name="social_link" class="form-control" placeholder="https://twitter.com/username">
                        <div class="form-hint">توییتر، اینستاگرام، لینکدین یا هر شبکه دیگر (اختیاری)</div>
                    </div>

                    <!-- SECTION 2: Introduction -->
                    <h3 class="form-section-title" style="margin-top:8px;">✍️ معرفی و تجربه</h3>

                    <div class="form-group">
                        <label class="form-label">معرفی کوتاه <span class="required">*</span></label>
                        <textarea name="introduction" class="form-control" rows="4"
                            placeholder="خودتان را معرفی کنید. چرا می‌خواهید عضو شوید؟ چه دیدگاهی دارید؟" required minlength="50"></textarea>
                        <div class="form-hint">حداقل ۵۰ کاراکتر بنویسید</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">تجربه و فعالیت‌های قبلی <span class="required">*</span></label>
                        <textarea name="experience" class="form-control" rows="4"
                            placeholder="آیا قبلاً در گروه‌های مشابه فعالیت داشتید؟ چه تجربه‌ای در حوزه الحاد، سکولاریسم یا فلسفه دارید؟" required minlength="30"></textarea>
                    </div>

                    <!-- SECTION 3: Upload & Consent -->
                    <h3 class="form-section-title" style="margin-top:8px;">🔒 تأیید هویت و قوانین</h3>

                    <div class="form-group">
                        <label class="form-label">آپلود تصویر شناسایی</label>
                        <div class="upload-area" id="uploadArea">
                            <div style="font-size:36px;margin-bottom:10px;">📎</div>
                            <div id="uploadLabel" style="font-size:13px;font-weight:600;color:var(--text);">
                                برای آپلود کلیک کنید
                            </div>
                            <div style="font-size:12px;color:var(--muted);margin-top:4px;">
                                JPG، PNG یا PDF — حداکثر ۵ مگابایت (اختیاری)
                            </div>
                            <input type="file" name="id_upload" id="idUploadInput" accept=".jpg,.jpeg,.png,.pdf" style="display:none;">
                        </div>
                        <div class="form-hint">برای افزایش اعتبار درخواست، اما الزامی نیست.</div>
                    </div>

                    <div class="form-group" style="background:rgba(212,160,23,0.06);border:1px solid rgba(212,160,23,0.2);border-radius:var(--radius-sm);padding:16px;">
                        <p style="font-size:13px;color:var(--text);line-height:1.7;margin-bottom:12px;">
                            با ارسال این فرم تأیید می‌کنید که:
                            اصول و قوانین گروه را خوانده و پذیرفته‌اید. اطلاعات ارائه شده صادقانه و دقیق است.
                            با ذخیره‌سازی ایمن اطلاعات توسط گروه موافقید.
                        </p>
                        <label class="form-check" style="font-size:13px;font-weight:600;color:var(--text);">
                            <input type="checkbox" name="consent" required>
                            <span>* با تمام موارد فوق و <a href="<?php echo esc_url(home_url('/constitution')); ?>" target="_blank" style="color:var(--accent);">اساسنامه گروه</a> موافقم</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary" id="membershipSubmitBtn" style="width:100%;justify-content:center;padding:14px;font-size:16px;margin-top:8px;">
                        📨 ارسال درخواست عضویت
                    </button>

                    <p style="font-size:12px;color:var(--muted);text-align:center;margin-top:12px;">
                        🔒 اطلاعات شما کاملاً محرمانه است و هرگز به اشخاص ثالث منتقل نمی‌شود.
                    </p>

                </form>
            </div>

            <!-- RIGHT: INFO -->
            <div style="position:sticky;top:90px;">

                <div class="sidebar-widget">
                    <div class="sidebar-widget-title">❓ سؤالات متداول</div>
                    <div class="sidebar-widget-body" style="padding:14px;">
                        <?php
                        $faqs = [
                            ['چه کسانی می‌توانند عضو شوند؟', 'هر ایرانی که الحاد، آزاداندیشی یا اومانیسم را باور داشته باشد.'],
                            ['چه مدت طول می‌کشد؟', 'معمولاً ۷ تا ۱۴ روز پس از ارسال درخواست.'],
                            ['آیا اطلاعاتم محرمانه است؟', 'بله. اطلاعات هرگز به خارج از گروه منتقل نمی‌شود.'],
                            ['آیا عضویت رایگان است؟', 'بله. عضویت کاملاً رایگان است.'],
                        ];
                        foreach ($faqs as $faq): ?>
                            <div style="padding:12px 0;border-bottom:1px solid var(--border);">
                                <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:4px;">❓ <?php echo esc_html($faq[0]); ?></div>
                                <div style="font-size:12px;color:var(--muted);line-height:1.6;"><?php echo esc_html($faq[1]); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="sidebar-widget" style="margin-top:0;">
                    <div class="sidebar-widget-title">📜 اساسنامه</div>
                    <div class="sidebar-widget-body">
                        <p style="font-size:13px;color:var(--muted);margin-bottom:14px;line-height:1.6;">قبل از ارسال درخواست، اساسنامه گروه را مطالعه کنید.</p>
                        <a href="<?php echo esc_url(home_url('/constitution')); ?>" class="btn btn-outline" style="width:100%;justify-content:center;">مطالعه اساسنامه →</a>
                    </div>
                </div>

                <div class="sidebar-widget" style="margin-top:0;">
                    <div class="sidebar-widget-title">📬 تماس مستقیم</div>
                    <div class="sidebar-widget-body">
                        <p style="font-size:13px;color:var(--muted);margin-bottom:12px;">سؤال دارید؟ از طریق تلگرام یا ایمیل با ما تماس بگیرید.</p>
                        <a href="https://t.me/PersianAtheists" target="_blank" rel="noopener" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:8px;">✈ تلگرام</a>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline" style="width:100%;justify-content:center;">📧 فرم تماس</a>
                    </div>
                </div>

            </div><!-- /right -->

        </div><!-- /grid -->
    </div><!-- /container -->

</main>

<script>
// Upload area behavior
document.getElementById('uploadArea')?.addEventListener('click', function() {
    document.getElementById('idUploadInput').click();
});
document.getElementById('idUploadInput')?.addEventListener('change', function() {
    const lbl = document.getElementById('uploadLabel');
    if (this.files[0] && lbl) {
        lbl.textContent = '✅ ' + this.files[0].name;
        lbl.style.color = 'var(--accent)';
    }
});

// Progress bar on input
const fields = document.querySelectorAll('#fullMembershipForm input, #fullMembershipForm textarea, #fullMembershipForm select');
const bar    = document.getElementById('formProgressBar');
fields.forEach(f => {
    f.addEventListener('input', function() {
        let filled = 0;
        fields.forEach(fi => { if(fi.value) filled++; });
        const pct = Math.min(100, Math.round((filled / fields.length) * 100));
        if(bar) bar.style.width = pct + '%';
    });
});
</script>

<?php get_footer(); ?>
