<?php
/**
 * Auto-convert uploaded images to WebP
 */
if ( ! defined('ABSPATH') ) exit;

add_filter('wp_handle_upload', function( $upload ) {
    $convertible = [ 'image/jpeg', 'image/png', 'image/bmp' ];
    $type = $upload['type'] ?? '';

    if ( ! in_array($type, $convertible, true) ) return $upload;
    if ( ! function_exists('imagewebp') )         return $upload;

    $source = $upload['file'];
    $target = preg_replace('/\.[^.\/]+$/', '.webp', $source);
    $url    = preg_replace('/\.[^.\/]+$/', '.webp', $upload['url']);

    switch ( $type ) {
        case 'image/jpeg':
            $img = imagecreatefromjpeg( $source );
            break;
        case 'image/png':
            $img = imagecreatefrompng( $source );
            if ( $img ) {
                imagealphablending( $img, true );
                imagesavealpha( $img, true );
            }
            break;
        case 'image/bmp':
            $img = function_exists('imagecreatefrombmp') ? imagecreatefrombmp( $source ) : false;
            break;
        default:
            return $upload;
    }

    if ( ! $img ) return $upload;

    if ( imagewebp( $img, $target, 82 ) ) {
        imagedestroy( $img );
        @unlink( $source );
        $upload['file'] = $target;
        $upload['url']  = $url;
        $upload['type'] = 'image/webp';
    } else {
        imagedestroy( $img );
    }

    return $upload;
});
