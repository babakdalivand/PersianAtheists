<?php
/**
 * Custom Login Page — Persian Atheists FINAL
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'login_headerurl',  fn() => home_url('/') );
add_filter( 'logout_redirect',  fn() => home_url('/') );
add_filter( 'login_title',      fn() => 'ورود | Persian Atheists — RAHA Network' );

// حذف استایل‌های پیش‌فرض
add_action( 'login_enqueue_scripts', 'pa_login_remove_defaults', 1 );
function pa_login_remove_defaults() {
    wp_dequeue_style('login');
    wp_dequeue_style('dashicons');
}

add_action( 'login_enqueue_scripts', 'pa_login_enqueue' );
function pa_login_enqueue() {

    // SVG لوگو inline — همیشه کار می‌کنه
    $logo_svg = base64_encode('<svg width="66" height="66" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <radialGradient id="g1" cx="40%" cy="35%" r="60%">
                <stop offset="0%" stop-color="#f0c040"/>
                <stop offset="100%" stop-color="#b87800"/>
            </radialGradient>
        </defs>
        <circle cx="33" cy="33" r="32" fill="url(#g1)" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
        <text x="33" y="46" font-family="Arial Black,Georgia,sans-serif" font-size="36" font-weight="900" text-anchor="middle" fill="white" style="text-shadow:0 2px 4px rgba(0,0,0,0.3)">A</text>
    </svg>');
    $logo_data = 'data:image/svg+xml;base64,' . $logo_svg;

    // چک PNG
    $png_path = get_template_directory() . '/assets/images/logo.png';
    $png_url  = get_template_directory_uri() . '/assets/images/logo.png';
    $use_png  = file_exists($png_path);

    $bg = 'https://images.pexels.com/photos/207529/pexels-photo-207529.jpeg';
    ?>
    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html {
        background: #060e1c url('<?php echo esc_url($bg); ?>') center/cover no-repeat fixed !important;
    }

    body.login {
        background: transparent !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        direction: rtl !important;
        min-height: 100vh !important;
        padding: 0 !important; margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative !important;
    }

    body.login::before {
        content: '';
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.52);
        z-index: 0; pointer-events: none;
    }

    /* WP container */
    #login {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        width: 360px !important;
        max-width: calc(100vw - 32px) !important;
        margin: 0 auto !important;
        position: relative !important;
        z-index: 10 !important;
    }

    /* H1 */
    #login h1 {
        padding: 0 !important;
        margin: 0 0 14px !important;
        text-align: center !important;
    }
    #login h1 a {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 10px !important;
        text-decoration: none !important;
        width: auto !important; height: auto !important;
        background: none !important;
        color: #fff !important;
        cursor: default !important;
        outline: none !important;
        box-shadow: none !important;
    }

    /* Orbit */
    .pa-ow {
        position: relative;
        width: 100px; height: 100px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto;
    }
    .pa-logo {
        width: 66px !important; height: 66px !important;
        border-radius: 50% !important;
        object-fit: contain !important;
        position: relative; z-index: 5;
        display: block !important;
        filter: drop-shadow(0 0 16px rgba(212,160,23,0.6));
    }
    .pa-ring {
        position: absolute; border-radius: 50%;
        top: 50%; left: 50%;
        transform: translate(-50%,-50%);
        animation: pa-rot linear infinite;
    }
    .pa-r1 { width: 84px; height: 84px; border: 1.5px solid rgba(212,160,23,0.6); animation-duration: 5s; }
    .pa-r2 { width: 100px; height: 100px; border: 1px solid rgba(212,160,23,0.25); animation-duration: 9s; animation-direction: reverse; }
    @keyframes pa-rot { from { transform: translate(-50%,-50%) rotate(0deg); } to { transform: translate(-50%,-50%) rotate(360deg); } }
    .pa-dot { position: absolute; border-radius: 50%; top: 50%; left: 50%; }
    .pa-d1 { width: 7px; height: 7px; background: #D4A017; box-shadow: 0 0 8px rgba(212,160,23,0.9); margin: -3.5px 0 0 -3.5px; animation: pa-d1 5s linear infinite; }
    .pa-d2 { width: 5px; height: 5px; background: #fff; box-shadow: 0 0 6px rgba(255,255,255,0.9); margin: -2.5px 0 0 -2.5px; animation: pa-d2 9s linear infinite; }
    @keyframes pa-d1 { to { transform: rotate(360deg) translateX(42px); } }
    @keyframes pa-d2 { to { transform: rotate(360deg) translateX(50px); } }

    .pa-name { font-size: 15px; font-weight: 800; color: #fff; letter-spacing: .3px; }
    .pa-net  { font-size: 11px; color: #D4A017; font-weight: 700; letter-spacing: .8px; }

    /* Lang */
    .pa-lang {
        display: flex; align-items: center;
        justify-content: center; gap: 8px;
        margin-bottom: 14px;
    }
    .pa-lb {
        padding: 5px 16px; border-radius: 20px;
        font-size: 12px; font-weight: 700; cursor: pointer;
        border: 1px solid rgba(255,255,255,0.25);
        background: transparent; color: rgba(255,255,255,0.65);
        font-family: 'Vazirmatn',Tahoma,sans-serif; transition: all .2s;
    }
    .pa-lb.on, .pa-lb:hover { background: #D4A017; border-color: #D4A017; color: #fff; }
    .pa-sep { color: rgba(255,255,255,0.25); }

    /* Glass card */
    #loginform {
        background: rgba(255,255,255,0.11) !important;
        backdrop-filter: blur(24px) saturate(1.5) !important;
        -webkit-backdrop-filter: blur(24px) saturate(1.5) !important;
        border-radius: 18px !important;
        border: 1px solid rgba(255,255,255,0.22) !important;
        box-shadow: 0 24px 64px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.12) !important;
        padding: 28px 24px !important;
        margin: 0 !important;
    }

    .pa-fh {
        text-align: center; font-size: 14px; font-weight: 700;
        color: rgba(255,255,255,0.88); margin-bottom: 18px;
        font-family: 'Vazirmatn',Tahoma,sans-serif;
    }

    /* Labels */
    #loginform label {
        font-size: 12px !important; font-weight: 600 !important;
        color: rgba(255,255,255,0.6) !important;
        display: block !important; margin-bottom: 5px !important;
        font-family: 'Vazirmatn',Tahoma,sans-serif !important;
    }

    /* Inputs */
    #loginform input[type="text"],
    #loginform input[type="password"] {
        width: 100% !important;
        background: rgba(0,0,0,0.35) !important;
        border: 1px solid rgba(255,255,255,0.2) !important;
        border-radius: 10px !important;
        color: #fff !important;
        font-size: 14px !important;
        font-family: 'Vazirmatn',Tahoma,sans-serif !important;
        padding: 11px 14px !important;
        outline: none !important; box-shadow: none !important;
        transition: border-color .2s, box-shadow .2s !important;
        direction: ltr; text-align: right;
    }
    #loginform input[type="text"]::placeholder,
    #loginform input[type="password"]::placeholder { color: rgba(255,255,255,0.35) !important; }
    #loginform input[type="text"]:focus,
    #loginform input[type="password"]:focus {
        border-color: #D4A017 !important;
        box-shadow: 0 0 0 3px rgba(212,160,23,0.2) !important;
    }

    /* Remember */
    #loginform .forgetmenot {
        display: flex !important; align-items: center !important;
        gap: 7px !important; font-size: 12px !important;
        color: rgba(255,255,255,0.6) !important;
        font-family: 'Vazirmatn',Tahoma,sans-serif !important;
        margin: 12px 0 !important;
    }
    #loginform .forgetmenot input[type="checkbox"] {
        accent-color: #D4A017 !important;
        width: 14px !important; height: 14px !important; margin: 0 !important;
    }

    /* Submit */
    #loginform .submit { padding: 0 !important; }
    #wp-submit {
        width: 100% !important; padding: 13px !important;
        background: #D4A017 !important; border: none !important;
        border-radius: 10px !important; color: #fff !important;
        font-size: 15px !important; font-weight: 800 !important;
        font-family: 'Vazirmatn',Tahoma,sans-serif !important;
        cursor: pointer !important; transition: all .25s !important;
        box-shadow: 0 4px 20px rgba(212,160,23,0.45) !important;
        text-shadow: none !important; letter-spacing: .3px;
        margin-top: 0 !important;
    }
    #wp-submit:hover {
        background: #B8880F !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 24px rgba(212,160,23,0.55) !important;
    }

    /* Nav links */
    #nav, #backtoblog { text-align: center !important; padding: 12px 0 0 !important; background: transparent !important; }
    #nav a, #backtoblog a {
        color: rgba(255,255,255,0.6) !important; font-size: 12px !important;
        font-family: 'Vazirmatn',Tahoma,sans-serif !important;
        text-decoration: none !important; transition: color .2s;
    }
    #nav a:hover, #backtoblog a:hover { color: #D4A017 !important; }

    /* Errors */
    #login_error {
        background: rgba(239,68,68,0.12) !important;
        border: 1px solid rgba(239,68,68,0.3) !important;
        border-right: 3px solid #ef4444 !important; border-left: none !important;
        border-radius: 8px !important; color: #fca5a5 !important;
        font-size: 13px !important; font-family: 'Vazirmatn',Tahoma,sans-serif !important;
        padding: 10px 14px !important; margin-bottom: 14px !important; box-shadow: none !important;
    }
    .login .message {
        background: rgba(212,160,23,0.1) !important;
        border: 1px solid rgba(212,160,23,0.3) !important;
        border-right: 3px solid #D4A017 !important; border-left: none !important;
        border-radius: 8px !important; color: rgba(255,255,255,0.85) !important;
        font-size: 13px !important; font-family: 'Vazirmatn',Tahoma,sans-serif !important;
        padding: 10px 14px !important; margin-bottom: 14px !important; box-shadow: none !important;
    }

    /* Privacy */
    .pa-priv {
        display: flex; align-items: flex-start; gap: 7px;
        background: rgba(212,160,23,0.08); border: 1px solid rgba(212,160,23,0.2);
        border-radius: 8px; padding: 9px 12px; margin-top: 14px;
        font-size: 11px; color: rgba(255,255,255,0.5);
        line-height: 1.6; font-family: 'Vazirmatn',Tahoma,sans-serif; text-align: right;
    }

    @media (max-width: 400px) {
        #login { width: 100% !important; }
        #loginform { padding: 22px 16px !important; border-radius: 14px !important; }
    }
    </style>

    <script>
    // اجرا بعد از load کامل
    document.addEventListener('DOMContentLoaded', function() {

        // ── ۱. Logo + Orbit در H1 ──
        var link = document.querySelector('#login h1 a');
        if (link) {
            <?php if ($use_png): ?>
            var logoSrc = '<?php echo esc_js($png_url); ?>';
            <?php else: ?>
            var logoSrc = '<?php echo esc_js($logo_data); ?>';
            <?php endif; ?>

            link.innerHTML =
                '<div class="pa-ow">' +
                    '<div class="pa-ring pa-r1"></div>' +
                    '<div class="pa-ring pa-r2"></div>' +
                    '<div class="pa-dot pa-d1"></div>' +
                    '<div class="pa-dot pa-d2"></div>' +
                    '<img src="' + logoSrc + '" class="pa-logo" alt="PA" ' +
                    'onerror="this.src=\'<?php echo esc_js($logo_data); ?>\'">' +
                '</div>' +
                '<div class="pa-name" id="pa-name">آتئیست‌های ایرانی</div>' +
                '<div class="pa-net" id="pa-net">شبکه رها</div>';
        }

        // ── ۲. Lang switcher قبل از H1 ──
        var loginBox = document.getElementById('login');
        var h1 = document.querySelector('#login h1');
        if (loginBox && h1) {
            var lang = document.createElement('div');
            lang.className = 'pa-lang';
            lang.innerHTML =
                '<button class="pa-lb on" onclick="paLang(\'fa\')">فارسی</button>' +
                '<span class="pa-sep">|</span>' +
                '<button class="pa-lb" onclick="paLang(\'en\')" style="font-family:\'Inter\',sans-serif;">English</button>';
            loginBox.insertBefore(lang, h1);
        }

        // ── ۳. Heading داخل فرم ──
        var form = document.getElementById('loginform');
        if (form) {
            var fh = document.createElement('div');
            fh.className = 'pa-fh'; fh.id = 'pa-fh';
            fh.textContent = 'ورود به حساب کاربری';
            form.insertBefore(fh, form.firstChild);
        }

        // ── ۴. Placeholder ──
        var ul = document.getElementById('user_login');
        var up = document.getElementById('user_pass');
        if (ul) ul.placeholder = 'نام کاربری یا ایمیل';
        if (up) up.placeholder = 'رمز عبور';

        // ── ۵. زبان ذخیره شده ──
        var saved = document.cookie.split(';')
            .map(function(c){return c.trim();})
            .find(function(c){return c.startsWith('pa_lang=');});
        if (saved && saved.split('=')[1] === 'en') paLang('en');
    });

    function paLang(l) {
        document.cookie = 'pa_lang='+l+';path=/;max-age=31536000';
        var e = l === 'en';
        document.documentElement.dir = e ? 'ltr' : 'rtl';
        document.body.style.direction = e ? 'ltr' : 'rtl';

        document.querySelectorAll('.pa-lb').forEach(function(b,i){
            b.classList.toggle('on', e ? i===1 : i===0);
        });

        var ids = {
            'pa-name': e ? 'Persian Atheists'       : 'آتئیست‌های ایرانی',
            'pa-net':  e ? 'RAHA NETWORK'            : 'شبکه رها',
            'pa-fh':   e ? 'Sign in to your account' : 'ورود به حساب کاربری',
        };
        Object.keys(ids).forEach(function(id){
            var el = document.getElementById(id);
            if (el) el.textContent = ids[id];
        });

        var ul=document.getElementById('user_login'), up=document.getElementById('user_pass'), sub=document.getElementById('wp-submit');
        if (ul)  ul.placeholder  = e ? 'Username or Email' : 'نام کاربری یا ایمیل';
        if (up)  up.placeholder  = e ? 'Password'          : 'رمز عبور';
        if (sub) sub.value       = e ? 'Login'             : 'ورود';

        var priv = document.querySelector('.pa-priv span');
        if (priv) priv.textContent = e
            ? 'Your email is never publicly displayed. Only your username is visible.'
            : 'ایمیل شما هرگز نمایش داده نمیشه. فقط نام کاربری عمومیه.';

        var rem = document.querySelector('.forgetmenot label');
        if (rem) { var cb=rem.querySelector('input'); rem.textContent=e?'Remember Me':'مرا به خاطر بسپار'; if(cb) rem.prepend(cb); }
    }
    </script>
    <?php
}

// H1 text خالی — JS کنترل می‌کنه
add_filter('login_headertext', fn() => '&nbsp;');

// Privacy note
add_action('login_footer', 'pa_login_footer_final');
function pa_login_footer_final() {
    $is_en = (isset($_COOKIE['pa_lang']) && $_COOKIE['pa_lang']==='en');
    $txt   = $is_en
        ? 'Your email is never publicly displayed. Only your username is visible.'
        : 'ایمیل شما هرگز نمایش داده نمیشه. فقط نام کاربری عمومیه.';
    echo '<div class="pa-priv">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#D4A017" stroke-width="1.5" stroke-linecap="round" style="flex-shrink:0;margin-top:1px">
            <rect x="3" y="11" width="18" height="11" rx="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
        <span>'.esc_html($txt).'</span>
    </div>';
}
