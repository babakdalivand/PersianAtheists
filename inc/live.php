<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Check if the YouTube channel has an active live stream.
 * Cached for 2 minutes via transient.
 *
 * @return array { active: bool, video_id: string, title: string }
 */
function pa_get_youtube_live() {
    $cached = get_transient( 'pa_yt_live' );
    if ( $cached !== false ) return $cached;

    $result = [ 'active' => false, 'video_id' => '', 'title' => '' ];

    $api_key  = get_option( 'pays_api_key', '' );
    $channels = get_option( 'pays_channels', [] );

    if ( ! $api_key || empty( $channels ) ) {
        set_transient( 'pa_yt_live', $result, 120 );
        return $result;
    }

    foreach ( $channels as $ch ) {
        $channel_id = is_array( $ch ) ? ( $ch['channel_id'] ?? $ch['id'] ?? '' ) : $ch;
        if ( ! $channel_id ) continue;

        $url = add_query_arg( [
            'part'      => 'snippet',
            'channelId' => $channel_id,
            'eventType' => 'live',
            'type'      => 'video',
            'key'       => $api_key,
        ], 'https://www.googleapis.com/youtube/v3/search' );

        $response = wp_remote_get( $url, [ 'timeout' => 5 ] );
        if ( is_wp_error( $response ) ) continue;

        $data = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( ! empty( $data['items'][0]['id']['videoId'] ) ) {
            $result = [
                'active'   => true,
                'video_id' => $data['items'][0]['id']['videoId'],
                'title'    => $data['items'][0]['snippet']['title'] ?? '',
            ];
            break;
        }
    }

    set_transient( 'pa_yt_live', $result, 120 );
    return $result;
}
