<?php
/**
 * Persian Atheists Theme - Functions
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'PA_VERSION', '1.0.0' );
define( 'PA_DIR', get_template_directory() );
define( 'PA_URI', get_template_directory_uri() );

// Load includes
require_once PA_DIR . '/inc/meta-boxes.php';
require_once PA_DIR . '/inc/admin.php';

/* ============================================
   THEME SETUP
   ============================================ */
function pa_theme_setup() {
    load_theme_textdomain( 'persian-atheists', PA_DIR . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo', [ 'height' => 60, 'width' => 180, 'flex-width' => true, 'flex-height' => true ] );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    add_image_size( 'pa-hero',   1200, 600, true );
    add_image_size( 'pa-card',   600,  400, true );
    add_image_size( 'pa-thumb',  400,  300, true );
    add_image_size( 'pa-square', 300,  300, true );

    register_nav_menus( [
        'primary'    => __( 'منوی اصلی / Primary Menu', 'persian-atheists' ),
        'footer'     => __( 'منوی فوتر / Footer Menu', 'persian-atheists' ),
        'primary-en' => __( 'Primary Menu English', 'persian-atheists' ),
    ] );
}
add_action( 'after_setup_theme', 'pa_theme_setup' );

/* ============================================
   ENQUEUE ASSETS
   ============================================ */
function pa_enqueue_assets() {
    wp_enqueue_style( 'pa-google-fonts', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap', [], null );
    wp_enqueue_style( 'pa-style', get_stylesheet_uri(), [ 'pa-google-fonts' ], PA_VERSION );
    wp_enqueue_style( 'pa-header', PA_URI . '/assets/css/header.css', [ 'pa-style' ], PA_VERSION );
    wp_enqueue_style( 'pa-components', PA_URI . '/assets/css/components.css', [ 'pa-style' ], PA_VERSION );
    wp_enqueue_script( 'pa-main', PA_URI . '/assets/js/main.js', [], PA_VERSION, true );
    wp_localize_script( 'pa-main', 'paData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'pa_nonce' ),
        'lang'    => pa_current_lang(),
        'isRtl'   => pa_is_rtl(),
    ] );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'pa_enqueue_assets' );

/* ============================================
   LANGUAGE HELPERS
   ============================================ */
function pa_current_lang() {
    if ( function_exists( 'pll_current_language' ) ) return pll_current_language();
    return 'fa';
}

function pa_is_rtl() {
    return pa_current_lang() === 'fa';
}

/* ============================================
   CUSTOM POST TYPES
   ============================================ */
function pa_register_post_types() {
    // Videos
    register_post_type( 'pa_video', [
        'labels'       => [ 'name' => __( 'ویدیوها', 'persian-atheists' ), 'singular_name' => __( 'ویدیو', 'persian-atheists' ), 'add_new_item' => __( 'افزودن ویدیو', 'persian-atheists' ) ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-video-alt3',
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'rewrite'      => [ 'slug' => 'videos' ],
        'show_in_rest' => true,
    ] );

    // Podcasts
    register_post_type( 'pa_podcast', [
        'labels'       => [ 'name' => __( 'پادکست‌ها', 'persian-atheists' ), 'singular_name' => __( 'پادکست', 'persian-atheists' ), 'add_new_item' => __( 'افزودن پادکست', 'persian-atheists' ) ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-microphone',
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'rewrite'      => [ 'slug' => 'podcasts' ],
        'show_in_rest' => true,
    ] );

    // Shorts
    register_post_type( 'pa_short', [
        'labels'       => [ 'name' => __( 'شورت‌ها', 'persian-atheists' ), 'singular_name' => __( 'شورت', 'persian-atheists' ) ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-format-video',
        'supports'     => [ 'title', 'thumbnail', 'custom-fields' ],
        'rewrite'      => [ 'slug' => 'shorts' ],
        'show_in_rest' => true,
    ] );

    // Membership Applications (private)
    register_post_type( 'pa_member_app', [
        'labels'          => [ 'name' => __( 'درخواست‌های عضویت', 'persian-atheists' ), 'singular_name' => __( 'درخواست عضویت', 'persian-atheists' ) ],
        'public'          => false,
        'show_ui'         => true,
        'menu_icon'       => 'dashicons-groups',
        'supports'        => [ 'title', 'custom-fields' ],
        'show_in_rest'    => false,
        'capability_type' => 'post',
        'capabilities'    => [ 'create_posts' => 'do_not_allow' ],
        'map_meta_cap'    => true,
    ] );
}
add_action( 'init', 'pa_register_post_types' );

/* ============================================
   USER ROLES
   ============================================ */
function pa_setup_roles() {
    if ( ! get_role( 'pa_member' ) ) {
        add_role( 'pa_member', __( 'عضو / Member', 'persian-atheists' ), [ 'read' => true ] );
    }
}
add_action( 'init', 'pa_setup_roles' );

/* ============================================
   SIDEBARS
   ============================================ */
function pa_register_sidebars() {
    register_sidebar( [
        'name'          => __( 'سایدبار اصلی', 'persian-atheists' ),
        'id'            => 'sidebar-main',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar-widget-title">',
        'after_title'   => '</div>',
    ] );
}
add_action( 'widgets_init', 'pa_register_sidebars' );

/* ============================================
   BODY CLASSES
   ============================================ */
function pa_body_classes( $classes ) {
    $classes[] = pa_is_rtl() ? 'lang-fa' : 'lang-en';
    return $classes;
}
add_filter( 'body_class', 'pa_body_classes' );

/* ============================================
   MEMBERSHIP AJAX HANDLER
   ============================================ */
function pa_handle_membership_form() {
    if ( ! isset( $_POST['pa_membership_nonce'] ) || ! wp_verify_nonce( $_POST['pa_membership_nonce'], 'pa_membership_submit' ) ) {
        wp_send_json_error( [ 'message' => 'خطای امنیتی.' ] );
    }

    $required = [ 'full_name', 'username', 'email', 'country', 'age', 'introduction', 'experience' ];
    foreach ( $required as $field ) {
        if ( empty( $_POST[ $field ] ) ) {
            wp_send_json_error( [ 'message' => 'لطفاً همه فیلدهای الزامی را پر کنید.' ] );
        }
    }

    if ( ! is_email( sanitize_email( $_POST['email'] ) ) ) {
        wp_send_json_error( [ 'message' => 'ایمیل نامعتبر است.' ] );
    }

    $post_id = wp_insert_post( [
        'post_title'  => sanitize_text_field( $_POST['full_name'] ) . ' — ' . sanitize_text_field( $_POST['username'] ),
        'post_type'   => 'pa_member_app',
        'post_status' => 'pending',
    ] );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( [ 'message' => 'خطا در ثبت اطلاعات.' ] );
    }

    $fields = [ 'full_name', 'username', 'email', 'country', 'age', 'introduction', 'experience', 'social_link' ];
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, 'pa_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }

    if ( ! empty( $_FILES['id_upload'] ) && $_FILES['id_upload']['error'] === UPLOAD_ERR_OK ) {
        $allowed = [ 'image/jpeg', 'image/png', 'application/pdf' ];
        if ( in_array( $_FILES['id_upload']['type'], $allowed, true ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            $uploaded = wp_handle_upload( $_FILES['id_upload'], [ 'test_form' => false ] );
            if ( ! isset( $uploaded['error'] ) ) {
                update_post_meta( $post_id, 'pa_id_upload', esc_url( $uploaded['url'] ) );
            }
        }
    }

    wp_mail(
        get_option( 'admin_email' ),
        'درخواست عضویت: ' . sanitize_text_field( $_POST['full_name'] ),
        "درخواست جدید:\nنام: " . sanitize_text_field( $_POST['full_name'] ) . "\nایمیل: " . sanitize_email( $_POST['email'] )
    );

    wp_send_json_success( [ 'message' => 'درخواست شما با موفقیت ثبت شد. پس از بررسی با شما تماس خواهیم گرفت.' ] );
}
add_action( 'wp_ajax_nopriv_pa_membership_submit', 'pa_handle_membership_form' );
add_action( 'wp_ajax_pa_membership_submit', 'pa_handle_membership_form' );

/* ============================================
   DARK MODE COOKIE
   ============================================ */
function pa_set_dark_mode() {
    check_ajax_referer( 'pa_nonce', 'nonce' );
    $mode = ( isset( $_POST['mode'] ) && $_POST['mode'] === 'dark' ) ? 'dark' : 'light';
    setcookie( 'pa_theme', $mode, time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
    wp_send_json_success();
}
add_action( 'wp_ajax_nopriv_pa_set_dark_mode', 'pa_set_dark_mode' );
add_action( 'wp_ajax_pa_set_dark_mode', 'pa_set_dark_mode' );

/* ============================================
   HELPERS
   ============================================ */
function pa_reading_time( $post_id = null ) {
    $words   = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );
    $minutes = max( 1, ceil( $words / 200 ) );
    return $minutes . ' دقیقه';
}

function pa_get_theme() {
    return ( isset( $_COOKIE['pa_theme'] ) && $_COOKIE['pa_theme'] === 'dark' ) ? 'dark' : 'light';
}

function pa_time_ago( $post_id = null ) {
    $diff = time() - get_the_time( 'U', $post_id );
    if ( $diff < 3600 )    return floor( $diff / 60 ) . ' دقیقه پیش';
    if ( $diff < 86400 )   return floor( $diff / 3600 ) . ' ساعت پیش';
    if ( $diff < 2592000 ) return floor( $diff / 86400 ) . ' روز پیش';
    return get_the_date( '', $post_id );
}

function pa_get_youtube_id( $post_id = null ) {
    return get_post_meta( $post_id ?? get_the_ID(), 'pa_youtube_id', true );
}

/* ============================================
   SECURITY
   ============================================ */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'login_errors', fn() => 'اطلاعات ورود نادرست است.' );

/* Excerpt */
add_filter( 'excerpt_length', fn() => 25 );
add_filter( 'excerpt_more',   fn() => '...' );

/* ============================================
   FALLBACK MENU
   ============================================ */
function pa_fallback_menu( $args ) {
    $pages = get_pages( [ 'sort_column' => 'menu_order', 'number' => 8 ] );
    if ( empty( $pages ) ) return;

    $class = isset( $args['menu_class'] ) ? esc_attr( $args['menu_class'] ) : 'nav-list';
    echo '<ul class="' . $class . '">';
    echo '<li><a href="' . esc_url( home_url('/') ) . '">خانه</a></li>';
    echo '<li><a href="' . esc_url( home_url('/articles') ) . '">مقالات</a></li>';
    echo '<li><a href="' . esc_url( home_url('/videos') ) . '">ویدیوها</a></li>';
    echo '<li><a href="' . esc_url( home_url('/podcasts') ) . '">پادکست‌ها</a></li>';
    echo '<li><a href="' . esc_url( home_url('/constitution') ) . '">اساسنامه</a></li>';
    echo '<li><a href="' . esc_url( home_url('/membership') ) . '">عضویت</a></li>';
    echo '<li><a href="' . esc_url( home_url('/about') ) . '">درباره ما</a></li>';
    echo '</ul>';
}

/* ============================================
   FEATURED ARTICLE QUERY
   ============================================ */
function pa_get_featured_article() {
    $q = new WP_Query( [
        'post_type'   => 'post',
        'posts_per_page' => 1,
        'meta_key'    => 'pa_featured',
        'meta_value'  => '1',
        'post_status' => 'publish',
    ] );
    if ( ! $q->have_posts() ) {
        $q = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 1, 'post_status' => 'publish' ] );
    }
    return $q;
}
