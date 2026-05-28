<?php
/**
 * Custom Login Page — Persian Atheists
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'login_headerurl',  fn() => home_url( '/' ) );
add_filter( 'logout_redirect',  fn() => home_url( '/' ) );
add_filter( 'login_title',      fn() => 'ورود | آتئیست‌های ایرانی' );
add_filter( 'login_headertext', fn() => '' );

add_action( 'login_enqueue_scripts', 'pa_login_remove_defaults', 1 );
function pa_login_remove_defaults() {
    wp_dequeue_style( 'login' );
    wp_dequeue_style( 'dashicons' );
}

add_action( 'login_enqueue_scripts', 'pa_login_enqueue' );
function pa_login_enqueue() {
    $logo = get_template_directory_uri() . '/assets/images/logo.png';
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800;900&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body.login {
        width: 100%; min-height: 100vh;
        background: #0D0B09 !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        direction: rtl !important;
        overflow-y: auto !important;
        padding: 0 !important;
    }

    /* ── CENTER STAGE ── */
    #pa-stage {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 16px 48px;
        background:
            radial-gradient(ellipse 600px 400px at 50% -60px, rgba(212,160,23,0.07) 0%, transparent 70%),
            #0D0B09;
    }

    /* ── CARD ── */
    #pa-card {
        width: 100%;
        max-width: 360px;
        background: #181410;
        border-radius: 28px;
        padding: 40px 32px 36px;
        box-shadow:
            12px 12px 32px rgba(0,0,0,0.65),
            -4px -4px 16px rgba(255,255,255,0.04),
            0 0 0 1px rgba(255,255,255,0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* ── SOLAR LOGO ── */
    #pa-solar {
        position: relative;
        width: 96px; height: 96px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px;
        flex-shrink: 0;
    }

    #pa-solar::before {
        content: '';
        position: absolute;
        width: 62px; height: 62px;
        border-radius: 50%;
        background: #0D0B09;
        box-shadow:
            0 0 0 2px rgba(212,160,23,0.25),
            0 4px 18px rgba(0,0,0,0.6);
        z-index: 4;
        top: 50%; left: 50%;
        transform: translate(-50%,-50%);
    }

    #pa-solar-img {
        width: 58px !important; height: 58px !important;
        border-radius: 50% !important;
        object-fit: contain !important;
        position: absolute !important;
        z-index: 5 !important;
        top: 50%; left: 50%;
        transform: translate(-50%,-50%);
    }

    .pa-ring {
        position: absolute;
        border-radius: 50%;
        top: 50%; left: 50%;
        transform: translate(-50%,-50%) rotate(0deg);
        border-style: solid;
        animation-fill-mode: both;
    }
    .pa-ring-1 {
        width: 78px; height: 78px;
        border-width: 1.5px;
        border-color: rgba(212,160,23,0.55);
        animation: pa-ring-rot 6s linear infinite;
        animation-play-state: paused;
    }
    .pa-ring-2 {
        width: 96px; height: 96px;
        border-width: 1px;
        border-color: rgba(212,160,23,0.22);
        animation: pa-ring-rot-r 11s linear infinite;
        animation-play-state: paused;
    }

    @keyframes pa-ring-rot   { to { transform: translate(-50%,-50%) rotate(360deg);  } }
    @keyframes pa-ring-rot-r { to { transform: translate(-50%,-50%) rotate(-360deg); } }

    .pa-dot {
        position: absolute;
        border-radius: 50%;
        top: 50%; left: 50%;
        z-index: 6;
        animation-play-state: paused;
    }
    .pa-dot-earth {
        width: 9px; height: 9px;
        background: radial-gradient(circle at 35% 35%, #4fc3f7, #0277bd);
        box-shadow: 0 0 7px rgba(79,195,247,0.9);
        margin: -4.5px 0 0 -4.5px;
        animation: pa-anim-earth 6s linear infinite;
        animation-play-state: paused;
    }
    .pa-dot-moon {
        width: 4px; height: 4px;
        background: #E8E8E8;
        box-shadow: 0 0 4px rgba(255,255,255,0.9);
        margin: -2px 0 0 -2px;
        animation: pa-anim-moon 2s linear infinite;
        animation-play-state: paused;
    }
    .pa-dot-planet {
        width: 8px; height: 8px;
        background: radial-gradient(circle at 35% 35%, #ffcc80, #e65100);
        box-shadow: 0 0 7px rgba(255,140,0,0.8);
        margin: -4px 0 0 -4px;
        animation: pa-anim-planet 11s linear infinite;
        animation-play-state: paused;
    }

    @keyframes pa-anim-earth  {
        from { transform: rotate(0deg)   translateX(39px) rotate(0deg);    }
        to   { transform: rotate(360deg) translateX(39px) rotate(-360deg); }
    }
    @keyframes pa-anim-moon {
        from { transform: rotate(0deg)   translateX(13px) rotate(0deg);    }
        to   { transform: rotate(360deg) translateX(13px) rotate(-360deg); }
    }
    @keyframes pa-anim-planet {
        from { transform: rotate(180deg) translateX(48px) rotate(-180deg); }
        to   { transform: rotate(540deg) translateX(48px) rotate(-540deg); }
    }

    /* When spinning mode is on */
    #pa-solar.spinning .pa-ring,
    #pa-solar.spinning .pa-dot {
        animation-play-state: running !important;
    }

    /* ── BRAND TEXT ── */
    .pa-raha {
        font-size: 13px; font-weight: 900;
        letter-spacing: 4px;
        color: #D4A017;
        text-transform: uppercase;
        margin-bottom: 4px;
    }
    .pa-brand-name {
        font-size: 14px; font-weight: 700;
        color: rgba(255,252,242,0.7);
        margin-bottom: 28px;
        text-align: center;
    }

    /* ── FORM TITLE ── */
    .pa-ftitle {
        font-size: 17px; font-weight: 800;
        color: #FFFCF2;
        margin-bottom: 22px;
        text-align: center;
        width: 100%;
    }

    /* ── INPUT GROUP ── */
    .pa-input-wrap {
        width: 100%;
        position: relative;
        margin-bottom: 14px;
    }
    .pa-input-icon {
        position: absolute;
        right: 14px;
        top: 50%; transform: translateY(-50%);
        color: rgba(212,160,23,0.55);
        pointer-events: none;
        z-index: 1;
    }
    .pa-input {
        width: 100%;
        background: #111009 !important;
        border: none !important;
        border-radius: 14px !important;
        color: #FFFCF2 !important;
        font-size: 14px !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        padding: 14px 44px 14px 16px !important;
        outline: none !important;
        box-shadow:
            inset 4px 4px 12px rgba(0,0,0,0.5),
            inset -2px -2px 6px rgba(255,255,255,0.03) !important;
        transition: box-shadow .2s !important;
        direction: ltr !important;
        text-align: right !important;
    }
    .pa-input::placeholder { color: rgba(255,252,242,0.28) !important; text-align: right; }
    .pa-input:focus {
        box-shadow:
            inset 4px 4px 12px rgba(0,0,0,0.5),
            inset -2px -2px 6px rgba(255,255,255,0.03),
            0 0 0 2px rgba(212,160,23,0.35) !important;
    }

    /* ── SUBMIT BUTTON ── */
    .pa-btn {
        width: 100%;
        padding: 15px !important;
        background: #D4A017 !important;
        border: none !important;
        border-radius: 14px !important;
        color: #0D0B09 !important;
        font-size: 16px !important;
        font-weight: 900 !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        cursor: pointer !important;
        letter-spacing: .5px;
        box-shadow:
            4px 4px 14px rgba(0,0,0,0.4),
            -2px -2px 8px rgba(212,160,23,0.18),
            0 0 0 1px rgba(212,160,23,0.2) !important;
        transition: all .2s !important;
        margin-top: 8px !important;
    }
    .pa-btn:hover {
        background: #e6b020 !important;
        transform: translateY(-1px) !important;
        box-shadow:
            6px 6px 20px rgba(0,0,0,0.45),
            0 0 22px rgba(212,160,23,0.35) !important;
    }
    .pa-btn:active { transform: translateY(0) !important; }

    /* ── REMEMBER ME ── */
    .pa-remember {
        display: flex; align-items: center; gap: 8px;
        margin-top: 14px; width: 100%;
        font-size: 12px; color: rgba(255,252,242,0.38);
    }
    .pa-remember input[type="checkbox"] {
        accent-color: #D4A017;
        width: 14px; height: 14px;
    }

    /* ── FORGOT PASSWORD ── */
    .pa-forgot {
        margin-top: 18px;
        font-size: 13px;
        text-align: center;
        width: 100%;
    }
    .pa-forgot a {
        color: rgba(212,160,23,0.65) !important;
        text-decoration: none !important;
        transition: color .2s;
    }
    .pa-forgot a:hover { color: #D4A017 !important; text-decoration: underline !important; }

    /* ── ERROR / MESSAGE ── */
    #login_error, .login .message {
        width: 100%;
        border-radius: 10px !important;
        box-shadow: none !important;
        font-family: 'Vazirmatn', Tahoma, sans-serif !important;
        font-size: 13px !important;
        padding: 10px 14px !important;
        margin-bottom: 14px !important;
    }
    #login_error {
        background: rgba(239,68,68,0.1) !important;
        border: 1px solid rgba(239,68,68,0.3) !important;
        color: #fca5a5 !important;
    }
    .login .message {
        background: rgba(212,160,23,0.08) !important;
        border: 1px solid rgba(212,160,23,0.25) !important;
        color: rgba(255,252,242,0.8) !important;
    }

    /* Hide WP default junk */
    #login h1, body.login #login p.submit, body.login #loginform .submit { display: none !important; }
    #login { background: transparent !important; box-shadow: none !important;
             border: none !important; padding: 0 !important; width: 100% !important;
             max-width: 100% !important; margin: 0 !important; }
    #loginform { background: transparent !important; box-shadow: none !important;
                 border: none !important; padding: 0 !important; margin: 0 !important; }
    #loginform label { display: none !important; }
    #loginform p { margin: 0 !important; padding: 0 !important; }
    #nav, #backtoblog { display: none !important; }
    </style>
    <?php
}

add_action( 'login_footer', 'pa_login_footer_html' );
function pa_login_footer_html() {
    $logo          = get_template_directory_uri() . '/assets/images/logo.png';
    $lost_pass_url = wp_lostpassword_url();
    ?>
    <div id="pa-stage">
        <div id="pa-card">

            <!-- ── Solar Logo ── -->
            <div id="pa-solar">
                <div class="pa-ring pa-ring-2"></div>
                <div class="pa-ring pa-ring-1"></div>
                <img id="pa-solar-img" src="<?php echo esc_url($logo); ?>" alt="PA">
                <div class="pa-dot pa-dot-planet"></div>
                <div class="pa-dot pa-dot-earth"></div>
                <div class="pa-dot pa-dot-moon"></div>
            </div>

            <div class="pa-raha">RAHA</div>
            <div class="pa-brand-name">آتئیست‌های ایرانی</div>

            <div class="pa-ftitle">ورود به حساب کاربری</div>

            <?php // WP injects #login_error and .message here via login_header — we move them with JS ?>

            <!-- ── Username ── -->
            <div class="pa-input-wrap">
                <svg class="pa-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
                <input id="pa-user" type="text" name="log" class="pa-input"
                       placeholder="نام کاربری یا ایمیل" autocomplete="username" autocapitalize="none">
            </div>

            <!-- ── Password ── -->
            <div class="pa-input-wrap">
                <svg class="pa-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input id="pa-pass" type="password" name="pwd" class="pa-input"
                       placeholder="رمز عبور" autocomplete="current-password">
            </div>

            <!-- ── Remember me ── -->
            <label class="pa-remember">
                <input type="checkbox" name="rememberme" value="forever">
                <span>مرا به خاطر بسپار</span>
            </label>

            <!-- ── Submit ── -->
            <button type="button" id="pa-submit" class="pa-btn">ورود</button>

            <!-- ── Forgot password ── -->
            <div class="pa-forgot">
                <a href="<?php echo esc_url($lost_pass_url); ?>">رمز عبور را فراموش کردید؟</a>
            </div>

        </div>
    </div>

    <script>
    (function() {
        /* ── Orbit step animation on every keystroke ── */
        var solar  = document.getElementById('pa-solar');
        var ring1  = solar.querySelector('.pa-ring-1');
        var ring2  = solar.querySelector('.pa-ring-2');
        var dotE   = solar.querySelector('.pa-dot-earth');
        var dotM   = solar.querySelector('.pa-dot-moon');
        var dotP   = solar.querySelector('.pa-dot-planet');

        // Track negative animation-delay (seconds) for each element
        // paused + negative delay = "scrub" to that frame
        var d1 = 0, d2 = 0, dE = 0, dM = 0, dP = 0;

        function stepOrbit() {
            d1 = (d1 + 0.28) % 6;
            d2 = (d2 + 0.18) % 11;
            dE = d1; // earth follows ring1 period
            dM = (dM + 0.1)  % 2;
            dP = (dP + 0.18) % 11;

            ring1.style.animationDelay = '-' + d1 + 's';
            ring2.style.animationDelay = '-' + d2 + 's';
            dotE.style.animationDelay  = '-' + dE + 's';
            dotM.style.animationDelay  = '-' + dM + 's';
            dotP.style.animationDelay  = '-' + dP + 's';
        }

        document.addEventListener('keydown', function(e) {
            // Step on printable keys and backspace
            if (e.key && (e.key.length === 1 || e.key === 'Backspace')) {
                stepOrbit();
            }
        });

        /* ── Submit: start full spin then submit form ── */
        var submitBtn = document.getElementById('pa-submit');

        submitBtn.addEventListener('click', function() {
            var user = document.getElementById('pa-user').value.trim();
            var pass = document.getElementById('pa-pass').value;
            if (!user || !pass) {
                shakeCard();
                return;
            }
            // Start full spinning
            solar.classList.add('spinning');
            submitBtn.textContent = 'در حال ورود...';
            submitBtn.disabled = true;

            // Build and submit real WP login form after short delay (let user see spin)
            setTimeout(function() { submitWP(); }, 900);
        });

        function submitWP() {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>';

            var fields = {
                log:        document.getElementById('pa-user').value,
                pwd:        document.getElementById('pa-pass').value,
                rememberme: document.querySelector('input[name="rememberme"]').checked ? 'forever' : '',
                redirect_to:'<?php echo esc_url( admin_url() ); ?>',
                testcookie: '1',
                wp_submit:  'ورود',
            };
            for (var k in fields) {
                var i = document.createElement('input');
                i.type = 'hidden'; i.name = k; i.value = fields[k];
                form.appendChild(i);
            }
            document.body.appendChild(form);
            form.submit();
        }

        /* ── Shake card on empty submit ── */
        function shakeCard() {
            var card = document.getElementById('pa-card');
            card.style.transition = 'transform .08s';
            var seq = [6,-6,5,-5,3,-3,0];
            var i = 0;
            var t = setInterval(function() {
                card.style.transform = 'translateX(' + seq[i] + 'px)';
                i++;
                if (i >= seq.length) { clearInterval(t); card.style.transform = ''; }
            }, 60);
        }

        /* ── Enter key triggers submit ── */
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') submitBtn.click();
        });

        /* ── Move WP error messages into card ── */
        document.addEventListener('DOMContentLoaded', function() {
            var err = document.querySelector('#login_error, .login .message');
            var card = document.getElementById('pa-card');
            var title = card.querySelector('.pa-ftitle');
            if (err && card && title) {
                card.insertBefore(err, title);
            }
        });

    })();
    </script>
    <?php
}
