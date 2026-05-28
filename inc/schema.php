<?php
/**
 * Schema.org JSON-LD markup
 */

if ( ! defined('ABSPATH') ) exit;

add_action('wp_head', 'pa_schema_output', 5);

function pa_schema_output(): void {
    if ( is_singular('pa_video') ) {
        pa_schema_video();
    } elseif ( is_singular('pa_podcast') ) {
        pa_schema_podcast();
    } elseif ( is_singular('post') ) {
        pa_schema_article();
    } elseif ( is_home() || is_front_page() ) {
        pa_schema_website();
    }
}

function pa_schema_video(): void {
    $post_id  = get_the_ID();
    $yt_id    = get_post_meta($post_id, 'pa_youtube_id', true);
    $duration = get_post_meta($post_id, 'pa_duration', true);

    $thumb = $yt_id
        ? "https://img.youtube.com/vi/{$yt_id}/hqdefault.jpg"
        : get_the_post_thumbnail_url($post_id, 'large');

    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'VideoObject',
        'name'        => get_the_title($post_id),
        'description' => wp_strip_all_tags(get_the_excerpt($post_id) ?: get_the_content()),
        'uploadDate'  => get_the_date('c', $post_id),
        'url'         => get_permalink($post_id),
    ];

    if ( $thumb ) {
        $schema['thumbnailUrl'] = $thumb;
    }

    if ( $yt_id ) {
        $schema['embedUrl'] = "https://www.youtube.com/embed/{$yt_id}";
        $schema['contentUrl'] = "https://www.youtube.com/watch?v={$yt_id}";
    }

    if ( $duration ) {
        // تبدیل mm:ss به ISO 8601 (PT#M#S)
        $parts = explode(':', $duration);
        if ( count($parts) === 2 ) {
            $schema['duration'] = 'PT' . intval($parts[0]) . 'M' . intval($parts[1]) . 'S';
        } elseif ( count($parts) === 3 ) {
            $schema['duration'] = 'PT' . intval($parts[0]) . 'H' . intval($parts[1]) . 'M' . intval($parts[2]) . 'S';
        }
    }

    $schema['publisher'] = [
        '@type' => 'Organization',
        'name'  => get_bloginfo('name'),
        'url'   => home_url('/'),
    ];

    pa_echo_schema($schema);
}

function pa_schema_podcast(): void {
    $post_id   = get_the_ID();
    $episode   = get_post_meta($post_id, 'pa_episode_number', true);
    $duration  = get_post_meta($post_id, 'pa_duration', true);
    $audio_url = get_post_meta($post_id, 'pa_audio_url', true);

    $schema = [
        '@context'     => 'https://schema.org',
        '@type'        => 'PodcastEpisode',
        'name'         => get_the_title($post_id),
        'description'  => wp_strip_all_tags(get_the_excerpt($post_id) ?: get_the_content()),
        'datePublished'=> get_the_date('c', $post_id),
        'url'          => get_permalink($post_id),
        'partOfSeries' => [
            '@type' => 'PodcastSeries',
            'name'  => get_bloginfo('name'),
            'url'   => home_url('/'),
        ],
    ];

    if ( $episode ) {
        $schema['episodeNumber'] = intval($episode);
    }

    if ( $audio_url ) {
        $schema['associatedMedia'] = [
            '@type'     => 'MediaObject',
            'contentUrl'=> $audio_url,
        ];
    }

    if ( $duration ) {
        $parts = explode(':', $duration);
        if ( count($parts) === 2 ) {
            $schema['duration'] = 'PT' . intval($parts[0]) . 'M' . intval($parts[1]) . 'S';
        } elseif ( count($parts) === 3 ) {
            $schema['duration'] = 'PT' . intval($parts[0]) . 'H' . intval($parts[1]) . 'M' . intval($parts[2]) . 'S';
        }
    }

    if ( has_post_thumbnail($post_id) ) {
        $schema['image'] = get_the_post_thumbnail_url($post_id, 'large');
    }

    pa_echo_schema($schema);
}

function pa_schema_article(): void {
    $post_id = get_the_ID();

    $schema = [
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        'headline'      => get_the_title($post_id),
        'description'   => wp_strip_all_tags(get_the_excerpt($post_id)),
        'datePublished' => get_the_date('c', $post_id),
        'dateModified'  => get_the_modified_date('c', $post_id),
        'url'           => get_permalink($post_id),
        'author'        => [
            '@type' => 'Person',
            'name'  => get_the_author_meta('display_name', get_post_field('post_author', $post_id)),
        ],
        'publisher'     => [
            '@type' => 'Organization',
            'name'  => get_bloginfo('name'),
            'url'   => home_url('/'),
        ],
        'inLanguage'    => get_locale(),
    ];

    if ( has_post_thumbnail($post_id) ) {
        $schema['image'] = get_the_post_thumbnail_url($post_id, 'large');
    }

    pa_echo_schema($schema);
}

function pa_schema_website(): void {
    $schema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        'name'            => get_bloginfo('name'),
        'url'             => home_url('/'),
        'description'     => get_bloginfo('description'),
        'inLanguage'      => 'fa',
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => [
                '@type'       => 'EntryPoint',
                'urlTemplate' => home_url('/?s={search_term_string}'),
            ],
            'query-input' => 'required name=search_term_string',
        ],
    ];

    pa_echo_schema($schema);
}

function pa_echo_schema(array $schema): void {
    echo '<script type="application/ld+json">'
        . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
        . '</script>' . "\n";
}
