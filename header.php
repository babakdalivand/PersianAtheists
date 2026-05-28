<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo pa_is_rtl() ? 'rtl' : 'ltr'; ?>" data-theme="<?php echo esc_attr( pa_get_theme() ); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$lang  = pa_current_lang();
$is_fa = ( $lang === 'fa' );
?>

<style>
/* ══ LOGO SOLAR SYSTEM ══ */
.pa-logo-solar {
    position: relative;
    width: 64px; height: 64px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.pa-logo-solar::before {
    content: '';
    position: absolute;
    width: 44px; height: 44px;
    border-radius: 50%;
    background: var(--primary);
    z-index: 4;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
}
.pa-logo-solar img {
    width: 42px !important; height: 42px !important;
    border-radius: 50% !important; object-fit: contain !important;
    position: absolute !important; z-index: 5 !important;
    display: block !important;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
}
#pa-logo-fb { display: none !important; }
.pa-orbit-ring {
    position: absolute; border-radius: 50%;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    animation: pa-orbit-rot linear infinite;
    border-style: solid;
}
.pa-orbit-ring-1 { width: 54px; height: 54px; border-width: 1.2px; border-color: rgba(235,94,40,0.55); animation-duration: 6s; }
.pa-orbit-ring-2 { width: 64px; height: 64px; border-width: 1px; border-color: rgba(235,94,40,0.25); animation-duration: 11s; animation-direction: reverse; }
@keyframes pa-orbit-rot { from { transform: translate(-50%,-50%) rotate(0deg); } to { transform: translate(-50%,-50%) rotate(360deg); } }
.pa-orbit-dot { position: absolute; border-radius: 50%; top: 50%; left: 50%; z-index: 6; }
.pa-dot-earth { width: 8px; height: 8px; background: radial-gradient(circle at 35% 35%, #4fc3f7, #0277bd); box-shadow: 0 0 6px rgba(79,195,247,0.9); margin: -4px 0 0 -4px; animation: pa-dot-earth 6s linear infinite; }
.pa-dot-moon { width: 4px; height: 4px; background: #E8E8E8; box-shadow: 0 0 4px rgba(255,255,255,0.9); margin: -2px 0 0 -2px; animation: pa-dot-moon 2s linear infinite; position: absolute; border-radius: 50%; top: 50%; left: 50%; }
.pa-dot-planet { width: 7px; height: 7px; background: radial-gradient(circle at 35% 35%, #ffcc80, #e65100); box-shadow: 0 0 6px rgba(255,140,0,0.8); margin: -3.5px 0 0 -3.5px; animation: pa-dot-planet 11s linear infinite; }
@keyframes pa-dot-earth { from { transform: rotate(0deg) translateX(27px) rotate(0deg); } to { transform: rotate(360deg) translateX(27px) rotate(-360deg); } }
@keyframes pa-dot-moon { from { transform: rotate(0deg) translateX(9px) rotate(0deg); } to { transform: rotate(360deg) translateX(9px) rotate(-360deg); } }
@keyframes pa-dot-planet { from { transform: rotate(180deg) translateX(32px) rotate(-180deg); } to { transform: rotate(540deg) translateX(32px) rotate(-540deg); } }
.pa-logo-link { display: flex; align-items: center; gap: 10px; text-decoration: none !important; }
.pa-logo-texts { display: flex; flex-direction: column; }
.pa-logo-name { font-size: 14px; font-weight: 800; color: var(--text); line-height: 1.2; white-space: nowrap; }
.pa-logo-desc { font-size: 10px; color: var(--muted); white-space: nowrap; letter-spacing: .3px; }

/* ══ LANG SLIDER ══ */
.pa-lang-slider {
    position: relative; display: flex; align-items: center;
    background: var(--bg); border: 1px solid var(--border);
    border-radius: 20px; padding: 3px; overflow: hidden;
    width: 68px; height: 32px; flex-shrink: 0; cursor: pointer;
}
.pa-lang-track { display: flex; align-items: center; width: 100%; position: relative; z-index: 2; }
.pa-lang-item {
    display: flex; align-items: center; justify-content: center;
    width: 50%; height: 26px; border-radius: 16px;
    text-decoration: none; position: relative; z-index: 2;
    cursor: pointer; border: none; background: none;
    padding: 0; font-size: 16px;
}
.pa-lang-flag { line-height: 1; transition: transform .25s, filter .25s; filter: grayscale(0.4) opacity(0.6); }
.pa-lang-item.active .pa-lang-flag { transform: scale(1.18); filter: grayscale(0) opacity(1); }
.pa-lang-indicator {
    position: absolute; top: 3px; width: calc(50% - 3px);
    height: calc(100% - 6px); background: var(--accent);
    border-radius: 16px; transition: all .3s cubic-bezier(.4,0,.2,1);
    z-index: 1; box-shadow: 0 2px 8px rgba(235,94,40,0.4);
}
.pa-lang-indicator.pos-fa { right: 3px; left: auto; }
.pa-lang-indicator.pos-en { left: 3px; right: auto; }
.pa-lang-slider:hover { border-color: var(--accent); }
</style>

<header class="site-header" id="site-header">
    <div class="header-inner container">

        <!-- LOGO -->
        <div class="header-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="pa-logo-link">
                <div class="pa-logo-solar">
                    <div class="pa-orbit-ring pa-orbit-ring-1"></div>
                    <div class="pa-orbit-ring pa-orbit-ring-2"></div>
                    <div class="pa-orbit-dot pa-dot-earth">
                        <div class="pa-orbit-dot pa-dot-moon"></div>
                    </div>
                    <div class="pa-orbit-dot pa-dot-planet"></div>
                    <?php if (file_exists(get_template_directory() . '/assets/images/logo.png')): ?>
                        <img src="<?php echo esc_url(PA_URI . '/assets/images/logo.png'); ?>"
                             alt="<?php bloginfo('name'); ?>"
                             onerror="this.style.display='none';document.getElementById('pa-logo-fb').style.cssText='display:flex!important;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:42px;height:42px;border-radius:50%;background:var(--accent);align-items:center;justify-content:center;color:#fff;font-size:20px;font-weight:900;z-index:5;'">
                        <div id="pa-logo-fb">A</div>
                    <?php else: ?>
                        <div id="pa-logo-fb" style="display:flex!important;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:42px;height:42px;border-radius:50%;background:var(--accent);align-items:center;justify-content:center;color:#fff;font-size:20px;font-weight:900;z-index:5;">A</div>
                    <?php endif; ?>
                </div>
                <div class="pa-logo-texts">
                    <span class="pa-logo-name"><?php echo $is_fa ? 'آتئیست‌های ایرانی' : 'Persian Atheists'; ?></span>
                    <span class="pa-logo-desc">RAHA Network</span>
                </div>
            </a>
        </div>

        <!-- NAV -->
        <nav class="header-nav">
            <?php wp_nav_menu([
                'theme_location' => $is_fa ? 'primary' : 'primary-en',
                'container'      => false,
                'menu_class'     => 'nav-list',
                'fallback_cb'    => 'pa_fallback_menu',
            ]); ?>

        </nav>

        <!-- ACTIONS — [UI-03] دکمه حمایت مالی حذف شد -->
        <div class="header-actions">

            <button class="icon-btn search-toggle" aria-label="Search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </button>

            <button class="icon-btn dark-mode-toggle" id="darkModeToggle">
                <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            </button>

            <!-- ══ LANG SLIDER ══ -->
            <div class="pa-lang-slider">
                <div class="pa-lang-track">
                    <button class="pa-lang-item <?php echo $is_fa ? 'active' : ''; ?>"
                            onclick="paLangSwitch(this,'fa')" title="فارسی">
                        <span class="pa-lang-flag">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20" width="22" height="15" style="border-radius:2px;display:block;">
                                <rect width="30" height="7" fill="#239F40"/>
                                <rect y="7" width="30" height="6" fill="#FFFFFF"/>
                                <rect y="13" width="30" height="7" fill="#DA0000"/>
                                <g transform="translate(15,10)">
                                    <circle r="2.8" fill="#F4C542" opacity="0.9"/>
                                    <g stroke="#F4C542" stroke-width="0.5" opacity="0.8">
                                        <line x1="0" y1="-4.2" x2="0" y2="-3.2"/>
                                        <line x1="0" y1="3.2" x2="0" y2="4.2"/>
                                        <line x1="-4.2" y1="0" x2="-3.2" y2="0"/>
                                        <line x1="3.2" y1="0" x2="4.2" y2="0"/>
                                        <line x1="-3" y1="-3" x2="-2.3" y2="-2.3"/>
                                        <line x1="2.3" y1="2.3" x2="3" y2="3"/>
                                        <line x1="3" y1="-3" x2="2.3" y2="-2.3"/>
                                        <line x1="-2.3" y1="2.3" x2="-3" y2="3"/>
                                    </g>
                                    <path d="M-1.8,0.5 C-1.8,-0.8 -0.8,-1.8 0.2,-1.5 C0.8,-1.3 1.2,-0.6 1.4,0 C1.6,0.5 1.2,1.2 0.5,1.4 C0,1.6 -0.5,1.4 -0.8,1.8 L-1.5,2.2 C-1.8,1.8 -1.8,1.2 -1.8,0.5Z" fill="#8B4513" opacity="0.8"/>
                                </g>
                            </svg>
                        </span>
                    </button>
                    <button class="pa-lang-item <?php echo !$is_fa ? 'active' : ''; ?>"
                            onclick="paLangSwitch(this,'en')" title="English">
                        <span class="pa-lang-flag">🇬🇧</span>
                    </button>
                </div>
                <div class="pa-lang-indicator <?php echo $is_fa ? 'pos-fa' : 'pos-en'; ?>" id="paLangInd"></div>
            </div>

            <button class="icon-btn mobile-menu-toggle" id="mobileMenuToggle">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="header-search-bar" id="headerSearchBar">
        <div class="container">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
                <input type="search" name="s" placeholder="<?php echo $is_fa ? 'جستجو...' : 'Search...'; ?>" value="<?php the_search_query(); ?>" class="form-control search-input" autocomplete="off">
                <button type="submit" class="btn btn-primary search-submit"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></button>
                <button type="button" class="icon-btn search-close" id="searchClose">✕</button>
            </form>
        </div>
    </div>
</header>

<!-- Mobile Nav -->
<div class="mobile-nav-overlay" id="mobileNavOverlay">
    <div class="mobile-nav">
        <button class="mobile-nav-close" id="mobileNavClose">✕</button>
        <?php wp_nav_menu([
            'theme_location' => $is_fa ? 'primary' : 'primary-en',
            'container'      => false,
            'menu_class'     => 'mobile-nav-list',
            'fallback_cb'    => 'pa_fallback_menu',
        ]); ?>
    </div>
</div>

<script>
function paLangSwitch(el, lang) {
    if (el.classList.contains('active')) return;
    var ind = document.getElementById('paLangInd');
    if (ind) {
        ind.classList.remove('pos-fa', 'pos-en');
        ind.classList.add(lang === 'fa' ? 'pos-fa' : 'pos-en');
    }
    document.querySelectorAll('.pa-lang-item').forEach(function(b, i) {
        b.classList.toggle('active', lang === 'fa' ? i === 0 : i === 1);
    });
    var exp = new Date(Date.now() + 365*24*60*60*1000).toUTCString();
    document.cookie = 'pa_lang=' + lang + '; path=/; expires=' + exp;
    setTimeout(function() { location.reload(); }, 300);
}
</script>
