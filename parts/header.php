<?php
/**
 * Header Template Part
 * @package persian-atheists
 */
?>
<header id="site-header" role="banner">
  <div class="container">
    <div class="header-inner">

      <!-- LOGO -->
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
        <?php if ( has_custom_logo() ) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <img src="<?php echo esc_url( PA_URI . '/assets/images/logo.png' ); ?>"
               alt="<?php bloginfo( 'name' ); ?>" width="40" height="40" />
        <?php endif; ?>
        <div class="logo-text">
          <span class="name-fa">آتئیست‌های ایرانی</span>
          <span class="name-en">Persian Atheists</span>
        </div>
      </a>

      <!-- NAVIGATION -->
      <nav class="main-nav" id="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'persian-atheists' ); ?>">
        <?php
        $lang = pa_get_current_lang();
        $menu = $lang === 'en' ? 'primary-en' : 'primary';
        wp_nav_menu( [
          'theme_location' => $menu,
          'container'      => false,
          'items_wrap'     => '%3$s',
          'depth'          => 2,
          'fallback_cb'    => function() use ( $lang ) {
            $links_fa = [
              home_url( '/' )             => 'خانه',
              home_url( '/articles/' )    => 'مقالات',
              home_url( '/videos/' )      => 'ویدیوها',
              home_url( '/podcast/' )     => 'پادکست',
              home_url( '/shorts/' )      => 'شورت‌ها',
              home_url( '/categories/' )  => 'دسته‌بندی‌ها',
              home_url( '/about/' )       => 'درباره ما',
              home_url( '/constitution/' )=> 'اساسنامه',
            ];
            $links_en = [
              home_url( '/en/' )             => 'Home',
              home_url( '/en/articles/' )    => 'Articles',
              home_url( '/en/videos/' )      => 'Videos',
              home_url( '/en/podcast/' )     => 'Podcasts',
              home_url( '/en/shorts/' )      => 'Shorts',
              home_url( '/en/categories/' )  => 'Categories',
              home_url( '/en/about/' )       => 'About',
              home_url( '/en/constitution/' )=> 'Constitution',
            ];
            $links = $lang === 'en' ? $links_en : $links_fa;
            foreach ( $links as $url => $label ) {
              $active = ( home_url( $_SERVER['REQUEST_URI'] ) === $url ) ? ' class="active"' : '';
              echo '<a href="' . esc_url( $url ) . '"' . $active . '>' . esc_html( $label ) . '</a>';
            }
          }
        ] );
        ?>
      </nav>

      <!-- HEADER ACTIONS -->
      <div class="header-actions">

        <!-- Search -->
        <div class="search-wrapper">
          <button class="btn-icon search-toggle" id="search-toggle" aria-label="<?php esc_attr_e( 'Search', 'persian-atheists' ); ?>" aria-expanded="false">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
          </button>
          <div class="search-dropdown" id="search-dropdown" role="search">
            <div class="search-input-wrap">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
              </svg>
              <input type="search" id="search-input" placeholder="<?php esc_attr_e( 'جستجو...', 'persian-atheists' ); ?>" autocomplete="off" />
            </div>
            <div id="search-results" class="search-results" role="listbox"></div>
          </div>
        </div>

        <!-- Dark Mode Toggle -->
        <button class="btn-icon" id="theme-toggle" aria-label="<?php esc_attr_e( 'Toggle Dark Mode', 'persian-atheists' ); ?>">
          <span class="toggle-icon">🌙</span>
        </button>

        <!-- Language Switcher -->
        <div class="lang-switch" role="group" aria-label="<?php esc_attr_e( 'Language', 'persian-atheists' ); ?>">
          <button class="lang-btn active" data-lang="fa"
                  <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
                  data-url="<?php echo esc_url( pll_home_url( 'fa' ) ); ?>"
                  <?php endif; ?>>
            FA
          </button>
          <button class="lang-btn" data-lang="en"
                  <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
                  data-url="<?php echo esc_url( pll_home_url( 'en' ) ); ?>"
                  <?php endif; ?>>
            EN
          </button>
        </div>

        <!-- Donate Button -->
        <a href="<?php echo esc_url( home_url( '/donate/' ) ); ?>" class="btn btn-primary">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
          <?php esc_html_e( 'حمایت مالی', 'persian-atheists' ); ?>
        </a>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="<?php esc_attr_e( 'Menu', 'persian-atheists' ); ?>" aria-expanded="false">
          <span></span>
          <span></span>
          <span></span>
        </button>

      </div><!-- .header-actions -->
    </div><!-- .header-inner -->
  </div><!-- .container -->
</header>
