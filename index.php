<?php
/*
  Plugin Name: WP REST API Syn By Design Custom Meta
  Plugin URI: http://synbydesign.com
  Description: Adds custom meta fields to WP REST API responses specific for site
  Version: 0.1
  Author: Eric Masiello
  Author URI: http://synbydesign.com
  License: GPL2
*/

function qod_add_custom_meta_to_posts( $data, $post, $context ) {
  // We only want to modify the 'view' context, for reading posts
  if ( $context !== 'view' || is_wp_error( $data ) ) {
  return $data;
}

$mix_url = get_post_meta( $post['ID'], 'mix_url', true );
$track_list = get_post_meta( $post['ID'], 'track_list', true );

if ( ! empty( $mix_url ) ) {
  $data['custom_meta'] = array( 'mix_url' => $mix_url, 'track_list' => $track_list );
}

return $data;
}

add_filter( 'json_prepare_post', 'qod_add_custom_meta_to_posts', 10, 3 );
?>