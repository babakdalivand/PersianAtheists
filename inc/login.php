<?php
/**
 * Custom Login Page — Persian Atheists
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'login_headerurl',  fn() => home_url( '/' ) );
add_filter( 'logout_redirect',  fn() => home_url( '/' ) );
add_filter( 'login_title',      fn() => 'ورود | Persian Atheists — RAHA Network' );
add_filter( 'login_headertext', fn() => '' );

add_action( 'login_enqueue_scripts', 'pa_login_remove_defaults', 1 );
function pa_login_remove_defaults() {
    wp_dequeue_style( 'login' );
    wp_dequeue_style( 'dashicons' );
}

add_action( 'login_enqueue_scripts', 'pa_login_enqueue' );
function pa_login_enqueue() {
    $is_en   = ( isset( $_COOKIE['pa_lang'] ) && $_COOKIE['pa_lang'] === 'en' );
    $phil    = get_template_directory_uri() . '/assets/images/hero-philosopher.png';
    $logo    = get_template_directory_uri() . '/assets/images/logo.png';
    $dir     = $is_en ? 'ltr' : 'rtl';
    ?>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body.login {
        width: 100%; height: 100%; min-height: 100vh;
        background: #0D0B09 !important;
        overflow: hidden;
    }
    body.login {
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        padding: 0 !important; margin: 0 !important;
        direction: <?php echo $dir; ?> !important;
    }

    /* ─── MAIN SPLIT WRAPPER ─── */
    #pa-wrap {
        display: flex;
        width: 100vw; height: 100vh;
        direction: ltr; /* layout always LTR */
    }

    /* ─── LEFT PANEL: philosopher ─── */
    #pa-left {
        flex: 1;
        position: relative;
        background: #1A1714 url('<?php echo esc_url( $phil ); ?>') center top / cover no-repeat;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 52px 56px;
        overflow: hidden;
    }
    #pa-left::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(160deg,
            rgba(13,11,9,0.25) 0%,
            rgba(13,11,9,0.50) 55%,
            rgba(13,11,9,0.88) 100%);
    }
    .pa-lc { position: relative; z-index: 2; direction: <?php echo $dir; ?>; }

    .pa-lbadge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(235,94,40,0.15); border: 1px solid rgba(235,94,40,0.32);
        border-radius: 20px; padding: 4px 14px;
        font-size: 12px; color: #EB5E28; font-weight: 700; letter-spacing: .4px;
        margin-bottom: 14px;
    }
    .pa-ltitle {
        font-size: clamp(26px, 2.8vw, 46px); font-weight: 900;
        color: #FFFCF2; line-height: 1.2; margin-bottom: 16px;
    }
    .pa-lquote {
        font-size: 14px; color: rgba(255,252,242,0.62);
        font-style: italic; line-height: 1.8;
        max-width: 460px; margin-bottom: 6px;
    }
    .pa-lwho {
        font-size: 12px; color: rgba(255,252,242,0.38);
        font-style: normal; margin-bottom: 24px;
    }
    .pa-pills { display: flex; gap: 8px; flex-wrap: wrap; direction: ltr; }
    .pa-pill {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 8px; padding: 6px 14px;
        font-size: 11px; color: rgba(255,252,242,0.5);
        display: flex; align-items: center; gap: 5px;
    }
    .pa-pill-char { color: #EB5E28; font-weight: 900; font-size: 13px; }

    /* ─── RIGHT PANEL: form ─── */
    #pa-right {
        width: 400px; min-width: 340px;
        height: 100vh; overflow-y: auto;
        background: #0D0B09;
        border-left: 1px solid rgba(255,255,255,0.06);
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        padding: 40px 36px;
        gap: 0;
    }

    .pa-logo-block {
        display: flex; flex-direction: column;
        align-items: center; gap: 8px; margin-bottom: 18px;
        text-decoration: none;
    }
    .pa-logo-img {
        width: 60px; height: 60px; border-radius: 50%;
        object-fit: contain;
        filter: drop-shadow(0 0 14px rgba(212,160,23,0.5));
    }
    .pa-logo-name { font-size: 15px; font-weight: 800; color: #FFFCF2; }
    .pa-logo-sub  { font-size: 11px; color: #D4A017; font-weight: 700; letter-spacing: .8px; }

    .pa-lang-row {
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 18px;
    }
    .pa-lb {
        padding: 5px 18px; border-radius: 20px;
        font-size: 12px; font-weight: 700; cursor: pointer;
        border: 1px solid rgba(255,255,255,0.18);
        background: transparent; color: rgba(255,255,255,0.5);
        font-family: 'Vazirmatn', Tahoma, sans-serif;
        transition: all .2s;
    }
    .pa-lb.on, .pa-lb:hover { background: #D4A017; border-color: #D4A017; color: #0D0B09; }
    .pa-lsep { color: rgba(255,255,255,0.18); }

    .pa-form-title {
        font-size: 17px; font-weight: 800;
        color: #FFFCF2; text-align: center;
        margin-bottom: 20px; width: 100%;
        direction: <?php echo $dir; ?>;
    }

    /* ─── WP #login overrides ─── */
    #login {
        background: transparent !important;
        box-shadow: none !important; border: none !important;
        padding: 0 !important; width: 100% !important;
        max-width: 320px !important; margin: 0 !important;
    }
    #login h1 { display: none !important; }

    #loginform {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 32px rgba(0,0,0,0.35) !important;
        padding: 24px 22px !important; margin: 0 !important;
        direction: <?php echo $dir; ?> !important;
    }
    #loginform label {
        font-size: 12px !important; font-weight: 600 !important;
        color: rgba(255,255,255,0.45) !important;
        display: block !important; margin-bottom: 5px !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
    }
    #loginform input[type="text"],
    #loginform input[type="password"] {
        width: 100% !important;
        background: rgba(255,255,255,0.07) !important;
        border: 1px solid rgba(255,255,255,0.12) !important;
        border-radius: 10px !important;
        color: #FFFCF2 !important; font-size: 14px !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        padding: 11px 14px !important;
        outline: none !important; box-shadow: none !important;
        transition: border-color .2s, box-shadow .2s !important;
        direction: ltr !important; text-align: <?php echo $is_en ? 'left' : 'right'; ?> !important;
    }
    #loginform input[type="text"]:focus,
    #loginform input[type="password"]:focus {
        border-color: #D4A017 !important;
        box-shadow: 0 0 0 3px rgba(212,160,23,0.12) !important;
    }
    #loginform .forgetmenot {
        display: flex !important; align-items: center !important;
        gap: 7px !important; margin: 14px 0 0 !important;
        font-size: 12px !important; color: rgba(255,255,255,0.45) !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
    }
    #loginform .forgetmenot input[type="checkbox"] {
        accent-color: #D4A017 !important;
        width: 14px !important; height: 14px !important; margin: 0 !important;
    }
    #loginform .submit { padding: 0 !important; margin-top: 16px !important; }
    #wp-submit {
        width: 100% !important; padding: 13px !important;
        background: #D4A017 !important; border: none !important;
        border-radius: 10px !important; color: #0D0B09 !important;
        font-size: 15px !important; font-weight: 800 !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        cursor: pointer !important; letter-spacing: .3px;
        box-shadow: 0 4px 18px rgba(212,160,23,0.28) !important;
        transition: all .2s !important; margin-top: 0 !important;
    }
    #wp-submit:hover {
        background: #B8880F !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 6px 24px rgba(212,160,23,0.45) !important;
    }
    #nav, #backtoblog {
        text-align: center !important; padding: 10px 0 0 !important;
        background: transparent !important;
    }
    #nav a, #backtoblog a {
        color: rgba(255,255,255,0.38) !important; font-size: 12px !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        text-decoration: none !important;
    }
    #nav a:hover, #backtoblog a:hover { color: #D4A017 !important; }

    #login_error {
        background: rgba(239,68,68,0.1) !important;
        border: 1px solid rgba(239,68,68,0.25) !important;
        border-<?php echo $is_en ? 'left' : 'right'; ?>: 3px solid #ef4444 !important;
        border-<?php echo $is_en ? 'right' : 'left'; ?>: none !important;
        border-radius: 8px !important; color: #fca5a5 !important;
        font-size: 13px !important; font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        padding: 10px 14px !important; margin-bottom: 14px !important;
        box-shadow: none !important;
    }
    .login .message {
        background: rgba(212,160,23,0.08) !important;
        border: 1px solid rgba(212,160,23,0.22) !important;
        border-<?php echo $is_en ? 'left' : 'right'; ?>: 3px solid #D4A017 !important;
        border-<?php echo $is_en ? 'right' : 'left'; ?>: none !important;
        border-radius: 8px !important; color: rgba(255,255,255,0.8) !important;
        font-size: 13px !important; font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        padding: 10px 14px !important; margin-bottom: 14px !important;
        box-shadow: none !important;
    }
    .pa-priv {
        display: flex; align-items: flex-start; gap: 7px;
        background: rgba(212,160,23,0.05);
        border: 1px solid rgba(212,160,23,0.12);
        border-radius: 8px; padding: 9px 12px; margin-top: 12px;
        font-size: 11px; color: rgba(255,255,255,0.38); line-height: 1.6;
        font-family: 'Vazirmatn', Tahoma, sans-serif;
        direction: <?php echo $dir; ?>;
    }

    @media (max-width: 700px) {
        #pa-left { display: none !important; }
        #pa-right { width: 100vw !important; min-width: unset !important;
                    border-left: none !important; }
        html, body.login { overflow: auto !important; }
    }
    </style>

    <script>
    (function() {
        var isEn   = <?php echo $is_en ? 'true' : 'false'; ?>;
        var philUrl = '<?php echo esc_js( $phil ); ?>';
        var logoUrl = '<?php echo esc_js( $logo ); ?>';

        var TX = {
            badge:  isEn ? 'Persian Atheists Network' : 'شبکه آتئیست‌های ایرانی',
            title:  isEn ? 'Thinking Is Not a Crime'  : 'اندیشیدن جرم نیست',
            fTitle: isEn ? 'Sign in to your account'  : 'ورود به حساب کاربری',
            logoN:  isEn ? 'Persian Atheists'         : 'آتئیست‌های ایرانی',
            logoS:  isEn ? 'RAHA NETWORK'             : 'شبکه رها',
            uPh:    isEn ? 'Username or Email'        : 'نام کاربری یا ایمیل',
            pPh:    isEn ? 'Password'                 : 'رمز عبور',
            submit: isEn ? 'Login'                    : 'ورود',
            remMe:  isEn ? 'Remember Me'              : 'مرا به خاطر بسپار',
            pills: isEn
                ? [['R','Rationalist'],['A','Atheist'],['H','Humanist'],['A','Agnostic']]
                : [['R','عقل‌گرا'],['A','آتئیست'],['H','اومانیست'],['A','آگنوستیک']],
        };

        var QFA = [
            {t:'آنچه بدون شواهد ادعا شود، بدون شواهد رد می‌شود.',w:'کریستوفر هیچنز'},
            {t:'علم منبع عمیق‌ترین معنا برای روح انسان است.',w:'کارل سِیگن'},
            {t:'اگر با خدا روبرو شوم می‌گویم: مدرک کافی نداشتید.',w:'برتراند راسل'},
            {t:'شک کردن آغاز دانستن است.',w:'رنه دکارت'},
            {t:'دانش یگانه راه آزادی است.',w:'فردریک داگلاس'},
        ];
        var QEN = [
            {t:'What can be asserted without evidence can be dismissed without evidence.',w:'Christopher Hitchens'},
            {t:'Science is the source of the deepest meaning the human spirit can have.',w:'Carl Sagan'},
            {t:'If I met God, I would say: not enough evidence.',w:'Bertrand Russell'},
            {t:'Doubt is the beginning, not the end, of wisdom.',w:'René Descartes'},
            {t:'Knowledge is the pathway from slavery to freedom.',w:'Frederick Douglass'},
        ];
        var qs = isEn ? QEN : QFA;
        var q  = qs[ Math.floor( Math.random() * qs.length ) ];

        document.addEventListener('DOMContentLoaded', function() {
            var loginBox = document.getElementById('login');
            if (!loginBox) return;

            /* ── Build left panel ── */
            var left = document.createElement('div');
            left.id = 'pa-left';
            var pillsHtml = TX.pills.map(function(p) {
                return '<div class="pa-pill"><span class="pa-pill-char">' + p[0] + '</span>' + p[1] + '</div>';
            }).join('');
            left.innerHTML =
                '<div class="pa-lc">' +
                    '<div class="pa-lbadge">&#127890; ' + TX.badge + '</div>' +
                    '<h2 class="pa-ltitle">' + TX.title + '</h2>' +
                    '<p class="pa-lquote">&#8220;' + q.t + '&#8221;</p>' +
                    '<p class="pa-lwho">— ' + q.w + '</p>' +
                    '<div class="pa-pills">' + pillsHtml + '</div>' +
                '</div>';

            /* ── Build right panel ── */
            var right = document.createElement('div');
            right.id = 'pa-right';

            right.innerHTML =
                '<div class="pa-logo-block">' +
                    '<img src="' + logoUrl + '" class="pa-logo-img" alt="PA" onerror="this.style.display=\'none\'">' +
                    '<div class="pa-logo-name">' + TX.logoN + '</div>' +
                    '<div class="pa-logo-sub">' + TX.logoS + '</div>' +
                '</div>' +
                '<div class="pa-lang-row">' +
                    '<button class="pa-lb' + (isEn ? '' : ' on') + '" onclick="paLang(\'fa\')">فارسی</button>' +
                    '<span class="pa-lsep">|</span>' +
                    '<button class="pa-lb' + (isEn ? ' on' : '') + '" onclick="paLang(\'en\')" style="font-family:Inter,sans-serif;">English</button>' +
                '</div>' +
                '<div class="pa-form-title">' + TX.fTitle + '</div>';

            /* Move loginBox into right */
            right.appendChild(loginBox);

            /* ── Build main wrapper ── */
            var wrap = document.createElement('div');
            wrap.id = 'pa-wrap';
            wrap.appendChild(left);
            wrap.appendChild(right);

            /* Prepend wrap, hide all other body children */
            document.body.insertBefore(wrap, document.body.firstChild);

            /* Move .pa-priv (from login_footer) into loginBox before hiding */
            var priv = document.querySelector('body > .pa-priv');
            if (priv) loginBox.appendChild(priv);

            /* Hide remaining body children */
            Array.from(document.body.children).forEach(function(el) {
                if (el.id !== 'pa-wrap') el.style.display = 'none';
            });

            /* Update form elements */
            var ul = document.getElementById('user_login');
            var up = document.getElementById('user_pass');
            var sub = document.getElementById('wp-submit');
            if (ul)  ul.placeholder  = TX.uPh;
            if (up)  up.placeholder  = TX.pPh;
            if (sub) sub.value       = TX.submit;

            var remLabel = document.querySelector('.forgetmenot label');
            if (remLabel) {
                var cb = remLabel.querySelector('input');
                remLabel.textContent = TX.remMe;
                if (cb) remLabel.prepend(cb);
            }
        });

        window.paLang = function(l) {
            document.cookie = 'pa_lang=' + l + ';path=/;max-age=31536000';
            location.reload();
        };
    })();
    </script>
    <?php
}

add_action( 'login_footer', 'pa_login_footer_priv' );
function pa_login_footer_priv() {
    $is_en = ( isset( $_COOKIE['pa_lang'] ) && $_COOKIE['pa_lang'] === 'en' );
    $txt   = $is_en
        ? 'Your email is never publicly displayed. Only your username is visible.'
        : 'ایمیل شما هرگز نمایش داده نمیشه. فقط نام کاربری عمومیه.';
    echo '<div class="pa-priv">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#D4A017" stroke-width="1.5" stroke-linecap="round" style="flex-shrink:0;margin-top:1px">
            <rect x="3" y="11" width="18" height="11" rx="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
        <span>' . esc_html( $txt ) . '</span>
    </div>';
}
