<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo pa_is_rtl() ? 'rtl' : 'ltr'; ?>" data-theme="<?php echo esc_attr( pa_get_theme() ); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="header-inner container">

        <!-- LOGO -->
        <div class="header-logo">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-text-link">
                    <img src="<?php echo esc_url( PA_URI . '/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <span class="logo-text" style="display:none;">
                        <span class="logo-icon">A</span>
                        <span class="logo-label">
                            <strong><?php bloginfo( 'name' ); ?></strong>
                            <small><?php bloginfo( 'description' ); ?></small>
                        </span>
                    </span>
                </a>
            <?php endif; ?>
        </div>

        <!-- PRIMARY NAV -->
        <nav class="header-nav" aria-label="<?php esc_attr_e( 'منوی اصلی', 'persian-atheists' ); ?>">
            <?php
            wp_nav_menu( [
                'theme_location' => pa_is_rtl() ? 'primary' : 'primary-en',
                'container'      => false,
                'menu_class'     => 'nav-list',
                'fallback_cb'    => 'pa_fallback_menu',
            ] );
            ?>
        </nav>

        <!-- HEADER ACTIONS -->
        <div class="header-actions">

            <!-- Search -->
            <button class="icon-btn search-toggle" aria-label="<?php esc_attr_e( 'جستجو', 'persian-atheists' ); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>

            <!-- Dark Mode -->
            <button class="icon-btn dark-mode-toggle" id="darkModeToggle" aria-label="<?php esc_attr_e( 'تغییر حالت', 'persian-atheists' ); ?>">
                <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
                <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                </svg>
            </button>

            <!-- Language Switch -->
            <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
                <div class="lang-switch" id="langSwitch">
                    <button class="lang-btn" aria-expanded="false">
                        <span><?php echo strtoupper( pa_current_lang() ); ?></span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="lang-dropdown">
                        <?php pll_the_languages( [ 'show_flags' => 0, 'show_names' => 1, 'display_names_as' => 'name', 'hide_current' => 0 ] ); ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="lang-switch">
                    <a href="<?php echo esc_url( home_url( '/en/' ) ); ?>" class="lang-static <?php echo pa_current_lang() === 'en' ? 'active' : ''; ?>">EN</a>
                    <span class="lang-sep">|</span>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="lang-static <?php echo pa_current_lang() === 'fa' ? 'active' : ''; ?>">FA</a>
                </div>
            <?php endif; ?>

            <!-- Donate Button -->
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-donate">
                ❤️ <?php esc_html_e( 'حمایت مالی', 'persian-atheists' ); ?>
            </a>

            <!-- Mobile Hamburger -->
            <button class="icon-btn mobile-menu-toggle" id="mobileMenuToggle" aria-label="منو">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>

        </div><!-- /header-actions -->
    </div><!-- /header-inner -->

    <!-- SEARCH BAR -->
    <div class="header-search-bar" id="headerSearchBar">
        <div class="container">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
                <input type="search" name="s" placeholder="<?php esc_attr_e( 'جستجو در سایت...', 'persian-atheists' ); ?>" value="<?php the_search_query(); ?>" class="form-control search-input" autocomplete="off">
                <button type="submit" class="btn btn-primary search-submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </button>
                <button type="button" class="icon-btn search-close" id="searchClose">✕</button>
            </form>
        </div>
    </div>
</header>

<!-- MOBILE NAV OVERLAY -->
<div class="mobile-nav-overlay" id="mobileNavOverlay">
    <div class="mobile-nav">
        <button class="mobile-nav-close" id="mobileNavClose">✕</button>
        <?php
        wp_nav_menu( [
            'theme_location' => pa_is_rtl() ? 'primary' : 'primary-en',
            'container'      => false,
            'menu_class'     => 'mobile-nav-list',
            'fallback_cb'    => 'pa_fallback_menu',
        ] );
        ?>
    </div>
</div>
