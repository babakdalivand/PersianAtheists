<?php
/**
 * Template Name: Membership
 * @package persian-atheists
 */

get_header();
?>

<main id="main-content" role="main">
  <div class="membership-page">

    <!-- Page Header -->
    <header class="page-header" style="text-align:center;margin-bottom:var(--space-8)">
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(212,160,23,0.1);border:1px solid rgba(212,160,23,0.3);border-radius:99px;padding:6px 18px;margin-bottom:20px">
        <svg width="14" height="14" fill="none" stroke="var(--accent)" stroke-width="2" viewBox="0 0 24 24">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
        </svg>
        <span style="font-size:13px;font-weight:600;color:var(--accent)"><?php esc_html_e( 'عضویت رسمی', 'persian-atheists' ); ?></span>
      </div>
      <h1 style="font-size:32px;margin-bottom:12px"><?php esc_html_e( 'عضویت در دنیای واقعی', 'persian-atheists' ); ?></h1>
      <p class="text-muted" style="font-size:16px;max-width:500px;margin:0 auto">
        <?php esc_html_e( 'فرم درخواست عضویت در گروه آتئیست‌های ایرانی را با دقت پر کنید. پس از بررسی، با شما تماس خواهیم گرفت.', 'persian-atheists' ); ?>
      </p>
    </header>

    <!-- Notice / Status -->
    <div id="form-notice" class="form-notice" style="display:none;padding:14px 18px;border-radius:var(--radius);margin-bottom:var(--space-6);font-weight:600"></div>

    <!-- Benefits -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:var(--space-8)">
      <?php
      $benefits = [
        [ 'icon' => '🔒', 'title' => 'امنیت اطلاعات', 'desc' => 'اطلاعات شما کاملاً محرمانه نگه داشته می‌شود.' ],
        [ 'icon' => '👥', 'title' => 'بررسی دستی', 'desc' => 'هر درخواست توسط تیم مدیریت بررسی می‌شود.' ],
        [ 'icon' => '✅', 'title' => 'تأیید پس از مصاحبه', 'desc' => 'پس از مصاحبه، عضویت تأیید می‌شود.' ],
      ];
      foreach ( $benefits as $b ) :
      ?>
      <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-lg);padding:var(--space-5);text-align:center">
        <div style="font-size:28px;margin-bottom:8px"><?php echo esc_html( $b['icon'] ); ?></div>
        <h3 style="font-size:15px;margin-bottom:6px"><?php echo esc_html( $b['title'] ); ?></h3>
        <p class="text-muted text-sm"><?php echo esc_html( $b['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Form -->
    <div class="membership-form-wrap">
      <form id="membership-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data" novalidate>

        <?php wp_nonce_field( 'pa_membership_form', 'pa_membership_nonce' ); ?>
        <input type="hidden" name="action" value="pa_membership_form" />

        <!-- Section 1: Personal Info -->
        <div class="form-section-title">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
          <?php esc_html_e( 'اطلاعات شخصی', 'persian-atheists' ); ?>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label for="full_name" class="form-label">
              <span class="required">*</span>
              <?php esc_html_e( 'نام کامل', 'persian-atheists' ); ?>
            </label>
            <input type="text" id="full_name" name="full_name" class="form-control"
                   placeholder="<?php esc_attr_e( 'نام و نام خانوادگی', 'persian-atheists' ); ?>"
                   required autocomplete="name" />
          </div>

          <div class="form-group">
            <label for="username" class="form-label">
              <?php esc_html_e( 'نام کاربری', 'persian-atheists' ); ?>
            </label>
            <input type="text" id="username" name="username" class="form-control"
                   placeholder="<?php esc_attr_e( 'نام کاربری دلخواه', 'persian-atheists' ); ?>"
                   autocomplete="username" />
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label for="email" class="form-label">
              <span class="required">*</span>
              <?php esc_html_e( 'آدرس ایمیل', 'persian-atheists' ); ?>
            </label>
            <input type="email" id="email" name="email" class="form-control"
                   placeholder="example@email.com"
                   required autocomplete="email" />
          </div>

          <div class="form-group">
            <label for="country" class="form-label">
              <span class="required">*</span>
              <?php esc_html_e( 'کشور محل سکونت', 'persian-atheists' ); ?>
            </label>
            <select id="country" name="country" class="form-control" required>
              <option value=""><?php esc_html_e( '-- انتخاب کشور --', 'persian-atheists' ); ?></option>
              <?php
              $countries = [
                'IR' => 'ایران',
                'DE' => 'آلمان',
                'US' => 'ایالات متحده',
                'GB' => 'بریتانیا',
                'CA' => 'کانادا',
                'SE' => 'سوئد',
                'NL' => 'هلند',
                'FR' => 'فرانسه',
                'AU' => 'استرالیا',
                'TR' => 'ترکیه',
                'AF' => 'افغانستان',
                'OTHER' => 'سایر',
              ];
              foreach ( $countries as $code => $name ) :
              ?>
              <option value="<?php echo esc_attr( $code ); ?>"><?php echo esc_html( $name ); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group" style="max-width:160px">
          <label for="age" class="form-label">
            <span class="required">*</span>
            <?php esc_html_e( 'سن', 'persian-atheists' ); ?>
          </label>
          <input type="number" id="age" name="age" class="form-control"
                 placeholder="25" min="16" max="99" required />
          <span class="form-hint"><?php esc_html_e( 'حداقل سن: ۱۶ سال', 'persian-atheists' ); ?></span>
        </div>

        <div class="divider"></div>

        <!-- Section 2: About You -->
        <div class="form-section-title" style="margin-top:var(--space-2)">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          <?php esc_html_e( 'درباره شما', 'persian-atheists' ); ?>
        </div>

        <div class="form-group">
          <label for="introduction" class="form-label">
            <span class="required">*</span>
            <?php esc_html_e( 'معرفی خود', 'persian-atheists' ); ?>
          </label>
          <textarea id="introduction" name="introduction" class="form-control" rows="4"
                    placeholder="<?php esc_attr_e( 'خودتان را معرفی کنید - چه کسی هستید، چه می‌کنید و چرا می‌خواهید عضو شوید...', 'persian-atheists' ); ?>"
                    required></textarea>
        </div>

        <div class="form-group">
          <label for="experience" class="form-label">
            <?php esc_html_e( 'تجربه و فعالیت قبلی', 'persian-atheists' ); ?>
          </label>
          <textarea id="experience" name="experience" class="form-control" rows="3"
                    placeholder="<?php esc_attr_e( 'آیا سابقه فعالیت در گروه‌های مشابه دارید؟ مهارت‌هایی که می‌توانید به گروه اضافه کنید...', 'persian-atheists' ); ?>"></textarea>
        </div>

        <div class="form-group">
          <label for="social_link" class="form-label">
            <?php esc_html_e( 'لینک شبکه اجتماعی', 'persian-atheists' ); ?>
          </label>
          <input type="url" id="social_link" name="social_link" class="form-control"
                 placeholder="https://twitter.com/username" autocomplete="url" />
          <span class="form-hint"><?php esc_html_e( 'توییتر، اینستاگرام، تلگرام یا لینکدین', 'persian-atheists' ); ?></span>
        </div>

        <div class="divider"></div>

        <!-- Section 3: Identity Verification -->
        <div class="form-section-title" style="margin-top:var(--space-2)">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/>
          </svg>
          <?php esc_html_e( 'تأیید هویت', 'persian-atheists' ); ?>
        </div>

        <div class="form-group">
          <label class="form-label">
            <?php esc_html_e( 'بارگذاری مدرک هویتی', 'persian-atheists' ); ?>
          </label>
          <div class="file-upload">
            <input type="file" id="id_document" name="id_document"
                   accept="image/jpeg,image/png,image/gif,application/pdf" />
            <div style="pointer-events:none">
              <svg width="32" height="32" fill="none" stroke="var(--text-muted)" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 8px">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
              </svg>
              <p id="file-label" style="font-size:13px;color:var(--text-muted)">
                <?php esc_html_e( 'کلیک کنید یا فایل را اینجا بکشید', 'persian-atheists' ); ?>
              </p>
              <p style="font-size:11px;color:var(--text-muted);margin-top:4px">
                <?php esc_html_e( 'JPEG, PNG, PDF — حداکثر ۵ مگابایت', 'persian-atheists' ); ?>
              </p>
            </div>
          </div>
          <span class="form-hint"><?php esc_html_e( 'گذرنامه، کارت ملی یا هر مدرک هویتی معتبر.', 'persian-atheists' ); ?></span>
        </div>

        <div class="divider"></div>

        <!-- Consent -->
        <div class="form-group">
          <label class="checkbox-group">
            <input type="checkbox" name="consent" id="consent" value="1" required />
            <span class="text-sm">
              <?php esc_html_e( 'با ', 'persian-atheists' ); ?>
              <a href="<?php echo esc_url( home_url( '/constitution/' ) ); ?>" style="color:var(--accent)" target="_blank">
                <?php esc_html_e( 'اساسنامه و اصول گروه', 'persian-atheists' ); ?>
              </a>
              <?php esc_html_e( ' موافقم و آن را پذیرفتم.', 'persian-atheists' ); ?>
              <span class="required">*</span>
            </span>
          </label>
        </div>

        <!-- Submit -->
        <div style="margin-top:var(--space-6)">
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;font-size:16px">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
            <?php esc_html_e( 'ارسال درخواست', 'persian-atheists' ); ?>
          </button>
          <p class="text-muted text-sm" style="text-align:center;margin-top:12px">
            <?php esc_html_e( 'پس از ارسال، تیم ما درخواست شما را بررسی کرده و در صورت تأیید با شما تماس خواهد گرفت.', 'persian-atheists' ); ?>
          </p>
        </div>

      </form>
    </div><!-- .membership-form-wrap -->

  </div><!-- .membership-page -->
</main>

<style>
.form-notice.success {
  background: rgba(16, 185, 129, 0.1);
  border: 1px solid rgba(16, 185, 129, 0.3);
  color: #10B981;
}
.form-notice.error {
  background: rgba(239, 68, 68, 0.1);
  border: 1px solid rgba(239, 68, 68, 0.3);
  color: #EF4444;
}
</style>

<?php
get_template_part( 'parts/footer' );
wp_footer();
?>
