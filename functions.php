<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'PA_VERSION', '1.1.2' );
define( 'PA_DIR', get_template_directory() );
define( 'PA_URI', get_template_directory_uri() );

require_once PA_DIR . '/inc/meta-boxes.php';
require_once PA_DIR . '/inc/admin.php';
require_once PA_DIR . '/inc/login.php';
require_once PA_DIR . '/inc/migration.php';
require_once PA_DIR . '/inc/webp.php';

/* ── LANGUAGE ── */
function pa_current_lang() {
    if ( isset( $_COOKIE['pa_lang'] ) ) {
        $l = sanitize_key( $_COOKIE['pa_lang'] );
        if ( in_array( $l, ['fa','en'] ) ) return $l;
    }
    return 'fa';
}
function pa_is_rtl() { return pa_current_lang() === 'fa'; }

/* ── THEME SETUP ── */
function pa_theme_setup() {
    load_theme_textdomain( 'persian-atheists', PA_DIR . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', ['search-form','comment-form','comment-list','gallery','caption','style','script'] );
    add_theme_support( 'custom-logo', ['height'=>60,'width'=>180,'flex-width'=>true,'flex-height'=>true] );
    add_image_size( 'pa-hero',   1200, 600, true );
    add_image_size( 'pa-card',   600,  400, true );
    add_image_size( 'pa-thumb',  400,  300, true );
    add_image_size( 'pa-square', 300,  300, true );
    register_nav_menus( [
        'primary'    => 'منوی اصلی / Primary Menu',
        'footer'     => 'منوی فوتر / Footer Menu',
        'primary-en' => 'Primary Menu English',
    ] );
}
add_action( 'after_setup_theme', 'pa_theme_setup' );

/* ── ENQUEUE ── */
function pa_enqueue_assets() {
    wp_enqueue_style( 'pa-iran-yekan',
        'https://fonts.cdnfonts.com/css/iran-yekan',
        [], null
    );
    wp_enqueue_style( 'pa-google-fonts',
        'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700;800;900&family=Merriweather:ital,wght@0,400;0,700;0,900;1,400&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap',
        [], null
    );
    wp_enqueue_style( 'pa-style',      get_stylesheet_uri(),                ['pa-google-fonts'],    PA_VERSION );
    wp_enqueue_style( 'pa-logo',       PA_URI.'/assets/css/logo.css',      ['pa-style'],           PA_VERSION );
    wp_enqueue_style( 'pa-header',     PA_URI.'/assets/css/header.css',    ['pa-style','pa-logo'], PA_VERSION );
    wp_enqueue_style( 'pa-components', PA_URI.'/assets/css/components.css',['pa-style'],           PA_VERSION );
    if ( is_front_page() || is_home() ) {
        wp_enqueue_style( 'pa-home', PA_URI.'/assets/css/home.css', ['pa-style'], PA_VERSION );
    }
    wp_enqueue_style( 'pa-fixes', PA_URI.'/assets/css/fixes.css', ['pa-style','pa-header','pa-components'], PA_VERSION );
    wp_enqueue_script( 'pa-main', PA_URI.'/assets/js/main.js', [], PA_VERSION, true );
    wp_localize_script( 'pa-main', 'paData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('pa_nonce'),
        'lang'    => pa_current_lang(),
        'isRtl'   => pa_is_rtl(),
    ]);
}
add_action( 'wp_enqueue_scripts', 'pa_enqueue_assets' );

/* ── CPTs ── */
function pa_register_post_types() {
    register_post_type( 'pa_video', [
        'labels'   => ['name'=>'ویدیوها','singular_name'=>'ویدیو','add_new_item'=>'افزودن ویدیو'],
        'public'   => true, 'has_archive'=>true, 'menu_icon'=>'dashicons-video-alt3',
        'supports' => ['title','editor','thumbnail','excerpt','custom-fields'],
        'rewrite'  => ['slug'=>'videos'], 'show_in_rest'=>true,
    ]);
    register_post_type( 'pa_podcast', [
        'labels'   => ['name'=>'پادکست‌ها','singular_name'=>'پادکست','add_new_item'=>'افزودن پادکست'],
        'public'   => true, 'has_archive'=>true, 'menu_icon'=>'dashicons-microphone',
        'supports' => ['title','editor','thumbnail','excerpt','custom-fields'],
        'rewrite'  => ['slug'=>'podcasts'], 'show_in_rest'=>true,
    ]);
    register_post_type( 'pa_short', [
        'labels'   => ['name'=>'ویدئوهای کوتاه','singular_name'=>'ویدئو کوتاه','add_new_item'=>'افزودن ویدئو کوتاه'],
        'public'   => true, 'has_archive'=>true, 'menu_icon'=>'dashicons-format-video',
        'supports' => ['title','thumbnail','custom-fields'],
        'rewrite'  => ['slug'=>'shorts'], 'show_in_rest'=>true,
    ]);
    register_post_type( 'pa_member_app', [
        'labels'          => ['name'=>'درخواست‌های عضویت','singular_name'=>'درخواست عضویت'],
        'public'          => false, 'show_ui'=>true, 'menu_icon'=>'dashicons-groups',
        'supports'        => ['title','custom-fields'],
        'capability_type' => 'post', 'capabilities'=>['create_posts'=>'do_not_allow'], 'map_meta_cap'=>true,
    ]);
    // ── کتاب‌خانه ──
    register_post_type( 'pa_book', [
        'labels'   => [
            'name'          => '📚 کتاب‌خانه',
            'singular_name' => 'کتاب',
            'add_new_item'  => 'افزودن کتاب',
            'edit_item'     => 'ویرایش کتاب',
            'all_items'     => 'همه کتاب‌ها',
        ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-book',
        'supports'     => ['title','editor','thumbnail','excerpt','custom-fields'],
        'rewrite'      => ['slug'=>'books'],
        'show_in_rest' => true,
    ]);
}
add_action( 'init', 'pa_register_post_types' );

/* ── REST META FIELDS ── */
add_action( 'init', function() {
    $all_types = [ 'post', 'pa_video', 'pa_podcast', 'pa_short', 'pa_book' ];
    foreach ( $all_types as $pt ) {
        register_post_meta( $pt, 'pa_lang', [
            'show_in_rest'  => true, 'single' => true,
            'type'          => 'string',
            'auth_callback' => '__return_true',
        ]);
        register_post_meta( $pt, 'pa_youtube_id', [
            'show_in_rest'  => true, 'single' => true,
            'type'          => 'string',
            'auth_callback' => '__return_true',
        ]);
    }
    register_post_meta( 'pa_podcast', 'pa_podcast_url', [
        'show_in_rest'  => true, 'single' => true,
        'type'          => 'string',
        'auth_callback' => '__return_true',
    ]);
});

/* ── ROLES ── */
add_action( 'init', function() {
    if ( ! get_role('pa_member') ) add_role( 'pa_member', 'عضو / Member', ['read'=>true] );
});

/* ── SIDEBARS ── */
add_action( 'widgets_init', function() {
    register_sidebar(['name'=>'سایدبار اصلی','id'=>'sidebar-main',
        'before_widget'=>'<div class="sidebar-widget">','after_widget'=>'</div>',
        'before_title'=>'<div class="sidebar-widget-title">','after_title'=>'</div>']);
});

/* ── BODY CLASS ── */
add_filter( 'body_class', function($c) {
    $c[] = pa_is_rtl() ? 'lang-fa' : 'lang-en';
    return $c;
});

/* ── MEMBERSHIP AJAX ── */
function pa_handle_membership_form() {
    if ( ! isset($_POST['pa_membership_nonce']) || ! wp_verify_nonce($_POST['pa_membership_nonce'],'pa_membership_submit') )
        wp_send_json_error(['message'=>'خطای امنیتی.']);
    foreach ( ['full_name','username','email','country','age','introduction','experience'] as $f )
        if ( empty($_POST[$f]) ) wp_send_json_error(['message'=>'لطفاً همه فیلدهای الزامی را پر کنید.']);
    if ( ! is_email(sanitize_email($_POST['email'])) ) wp_send_json_error(['message'=>'ایمیل نامعتبر است.']);
    $id = wp_insert_post(['post_title'=>sanitize_text_field($_POST['full_name']).' — '.sanitize_text_field($_POST['username']),'post_type'=>'pa_member_app','post_status'=>'pending']);
    if ( is_wp_error($id) ) wp_send_json_error(['message'=>'خطا.']);
    foreach ( ['full_name','username','email','country','age','introduction','experience','social_link'] as $f )
        if ( isset($_POST[$f]) ) update_post_meta($id,'pa_'.$f,sanitize_text_field($_POST[$f]));
    wp_send_json_success(['message'=>'ثبت شد.']);
}
add_action( 'wp_ajax_nopriv_pa_membership_submit', 'pa_handle_membership_form' );
add_action( 'wp_ajax_pa_membership_submit',        'pa_handle_membership_form' );

/* ── DARK MODE ── */
add_action( 'wp_ajax_nopriv_pa_set_dark_mode', 'pa_set_dark_mode' );
add_action( 'wp_ajax_pa_set_dark_mode',        'pa_set_dark_mode' );
function pa_set_dark_mode() {
    check_ajax_referer('pa_nonce','nonce');
    $mode = (isset($_POST['mode']) && $_POST['mode']==='dark') ? 'dark' : 'light';
    setcookie('pa_theme',$mode,time()+YEAR_IN_SECONDS,COOKIEPATH,COOKIE_DOMAIN);
    wp_send_json_success();
}

/* ── HELPERS ── */
function pa_reading_time( $id=null ) {
    $w = str_word_count(wp_strip_all_tags(get_post_field('post_content',$id)));
    $m = max(1,ceil($w/200));
    return pa_current_lang()==='en' ? $m.' min read' : $m.' دقیقه';
}
function pa_get_theme() {
    return (isset($_COOKIE['pa_theme']) && $_COOKIE['pa_theme']==='dark') ? 'dark' : 'light';
}
function pa_time_ago( $id=null ) {
    $d = time() - get_the_time('U',$id);
    $en = pa_current_lang()==='en';
    if ($d<3600)    return $en ? floor($d/60).' min ago'     : floor($d/60).' دقیقه پیش';
    if ($d<86400)   return $en ? floor($d/3600).' hr ago'    : floor($d/3600).' ساعت پیش';
    if ($d<2592000) return $en ? floor($d/86400).' days ago' : floor($d/86400).' روز پیش';
    return get_the_date($en?'M j, Y':'j F Y',$id);
}
function pa_get_youtube_id( $id=null ) { return get_post_meta($id??get_the_ID(),'pa_youtube_id',true); }
function pa_get_featured_article() {
    $q = new WP_Query(['post_type'=>'post','posts_per_page'=>1,'meta_key'=>'pa_featured','meta_value'=>'1','post_status'=>'publish']);
    if (!$q->have_posts()) $q = new WP_Query(['post_type'=>'post','posts_per_page'=>1,'post_status'=>'publish']);
    return $q;
}
function pa_fallback_menu() {
    $en = pa_current_lang()==='en';
    $items = $en
        ? ['/'=>'Home','/videos'=>'Videos','/podcasts'=>'Podcasts','/shorts'=>'Shorts','/books'=>'Library','/about'=>'About']
        : ['/'=>'خانه','/videos'=>'ویدیوها','/podcasts'=>'پادکست‌ها','/shorts'=>'ویدئوهای کوتاه','/books'=>'کتاب‌خانه','/about'=>'درباره ما'];
    echo '<ul class="nav-list">';
    foreach ($items as $p=>$l) echo '<li><a href="'.esc_url(home_url($p)).'">'.esc_html($l).'</a></li>';
    echo '</ul>';
}

/* ── SECURITY ── */
remove_action('wp_head','wp_generator');
add_filter('xmlrpc_enabled','__return_false');
add_filter('excerpt_length',fn()=>25);
add_filter('excerpt_more',fn()=>'...');
