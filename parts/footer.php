<?php
/**
 * Footer Template Part
 * @package persian-atheists
 */
?>
<footer id="site-footer" role="contentinfo">
  <div class="container">
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-brand">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
          <img src="<?php echo esc_url( PA_URI . '/assets/images/logo.png' ); ?>"
               alt="<?php bloginfo( 'name' ); ?>" width="36" height="36" loading="lazy" />
          <div class="logo-text">
            <span class="name-fa">آتئیست‌های ایرانی</span>
            <span class="name-en">Persian Atheists</span>
          </div>
        </a>
        <p class="footer-desc">
          <?php esc_html_e( 'آتئیست‌های ایرانی یک گروه مستقل و فرامرزی است، به‌دور از هر سازمان و گرایش سیاسی، با هدف ترویج تفکر آزاد، اندیشه انتقادی و حقوق بشر فعالیت می‌کند.', 'persian-atheists' ); ?>
        </p>
        <div class="social-links">
          <a href="#" class="social-link" aria-label="YouTube" rel="noopener noreferrer" target="_blank">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.19a3 3 0 0 0-2.11-2.12C19.49 3.5 12 3.5 12 3.5s-7.49 0-9.39.57A3 3 0 0 0 .5 6.19C0 8.1 0 12 0 12s0 3.9.5 5.81a3 3 0 0 0 2.11 2.12C4.51 20.5 12 20.5 12 20.5s7.49 0 9.39-.57a3 3 0 0 0 2.11-2.12C24 15.9 24 12 24 12s0-3.9-.5-5.81zM9.75 15.5v-7l6.5 3.5-6.5 3.5z"/></svg>
          </a>
          <a href="#" class="social-link" aria-label="Telegram" rel="noopener noreferrer" target="_blank">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.94 8.19l-2.02 9.53c-.14.65-.52.8-1.05.5l-2.9-2.14-1.4 1.35c-.15.15-.28.28-.58.28l.2-2.9 5.25-4.74c.23-.2-.05-.32-.35-.12L6.07 15.5l-2.84-.89c-.62-.19-.63-.62.13-.92l11.07-4.27c.52-.19.97.13.8.92l-.29-.15z"/></svg>
          </a>
          <a href="#" class="social-link" aria-label="Twitter/X" rel="noopener noreferrer" target="_blank">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="#" class="social-link" aria-label="Instagram" rel="noopener noreferrer" target="_blank">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
          </a>
          <a href="#" class="social-link" aria-label="Email" rel="noopener noreferrer">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <h3 class="footer-heading"><?php esc_html_e( 'دسترسی سریع', 'persian-atheists' ); ?></h3>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url( home_url( '/articles/' ) ); ?>"><?php esc_html_e( 'مقالات', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/videos/' ) ); ?>"><?php esc_html_e( 'ویدیوها', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/podcast/' ) ); ?>"><?php esc_html_e( 'پادکست', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/library/' ) ); ?>"><?php esc_html_e( 'کتابخانه', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'درباره ما', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'تماس با ما', 'persian-atheists' ); ?></a></li>
        </ul>
      </div>

      <!-- Categories -->
      <div>
        <h3 class="footer-heading"><?php esc_html_e( 'دسته‌بندی‌ها', 'persian-atheists' ); ?></h3>
        <ul class="footer-links">
          <?php
          $cats = get_categories( [ 'number' => 8, 'hide_empty' => false ] );
          foreach ( $cats as $cat ) :
          ?>
          <li>
            <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
              <?php echo esc_html( $cat->name ); ?>
            </a>
          </li>
          <?php endforeach; ?>
          <?php if ( empty( $cats ) ) : ?>
          <li><a href="#">علم</a></li>
          <li><a href="#">فلسفه</a></li>
          <li><a href="#">تاریخ</a></li>
          <li><a href="#">الحاد</a></li>
          <li><a href="#">اسکالریسم</a></li>
          <li><a href="#">انسان‌گرایی</a></li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Useful Links -->
      <div>
        <h3 class="footer-heading"><?php esc_html_e( 'لینک‌های مفید', 'persian-atheists' ); ?></h3>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url( home_url( '/constitution/' ) ); ?>"><?php esc_html_e( 'اساسنامه', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>"><?php esc_html_e( 'عضویت در گروه', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'درباره ما', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'تماس با ما', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/donate/' ) ); ?>"><?php esc_html_e( 'حمایت مالی', 'persian-atheists' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'حریم خصوصی', 'persian-atheists' ); ?></a></li>
        </ul>
      </div>

      <!-- Donation Box -->
      <div>
        <h3 class="footer-heading"><?php esc_html_e( 'حمایت مالی', 'persian-atheists' ); ?></h3>
        <div class="donation-box">
          <h4>
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
            <?php esc_html_e( 'از ما حمایت کنید', 'persian-atheists' ); ?>
          </h4>
          <div class="donate-methods">
            <button class="donate-btn donate-paypal" onclick="window.open('https://paypal.com','_blank')">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.254-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 0 0-.556.479l-1.187 7.527h-.506l-.24 1.516a.56.56 0 0 0 .554.647h3.882c.46 0 .85-.334.922-.788.06-.26.76-4.852.816-5.09a.932.932 0 0 1 .923-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.777-4.471z"/></svg>
              PayPal
            </button>
            <div class="crypto-row">
              <button class="donate-crypto" title="Bitcoin">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.638 14.904c-1.602 6.43-8.113 10.34-14.542 8.736C2.67 22.05-1.244 15.525.362 9.105 1.962 2.67 8.475-1.243 14.9.358c6.43 1.605 10.342 8.115 8.738 14.548v-.002zm-6.35-4.613c.24-1.59-.974-2.45-2.64-3.03l.54-2.153-1.315-.33-.525 2.107c-.345-.087-.705-.167-1.064-.25l.526-2.127-1.32-.33-.54 2.165c-.285-.067-.565-.132-.84-.2l-1.815-.45-.35 1.407s.975.225.955.236c.535.136.63.486.615.766l-1.477 5.92c-.075.166-.24.406-.614.314.015.02-.96-.24-.96-.24l-.66 1.51 1.71.426.93.242-.54 2.19 1.32.327.54-2.17c.36.1.705.19 1.05.273l-.51 2.154 1.32.33.545-2.19c2.24.427 3.93.257 4.64-1.774.57-1.637-.03-2.58-1.217-3.196.854-.193 1.5-.76 1.68-1.93h.01zm-3.01 4.22c-.404 1.64-3.157.75-4.05.53l.72-2.9c.896.23 3.757.67 3.33 2.37zm.41-4.24c-.37 1.49-2.662.735-3.405.55l.654-2.64c.744.18 3.137.524 2.75 2.084v.006z"/></svg>
                BTC
              </button>
              <button class="donate-crypto" title="Ethereum">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 17.97L4.58 13.62 11.943 24l7.37-10.38-7.372 4.35h.003zM12.056 0L4.69 12.223l7.365 4.354 7.365-4.35L12.056 0z"/></svg>
                ETH
              </button>
              <button class="donate-crypto" title="USDT">
                <span style="font-size:11px;font-weight:800;letter-spacing:-0.5px">₮</span>
                USDT
              </button>
            </div>
          </div>
        </div>
      </div>

    </div><!-- .footer-grid -->
  </div><!-- .container -->

  <!-- Footer Bottom -->
  <div style="border-top: 1px solid rgba(255,255,255,0.08)">
    <div class="container">
      <div class="footer-bottom">
        <p>© <?php echo date( 'Y' ); ?> <?php esc_html_e( 'آتئیست‌های ایرانی. تمام حقوق محفوظ است.', 'persian-atheists' ); ?></p>
        <div class="footer-legal">
          <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'حریم خصوصی', 'persian-atheists' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'شرایط استفاده', 'persian-atheists' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/sitemap.xml' ) ); ?>">Sitemap</a>
        </div>
      </div>
    </div>
  </div>

</footer>
