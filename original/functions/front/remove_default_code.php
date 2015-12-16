<?php

/*****************************************
 * 表側ページのwp_head, wp_footerなどのデフォルト出力を削除する
 *****************************************/
function remove_front_default_code() {
  /* 色々 */
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'noindex', 1);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'feed_links_extra', 3);
  /* wp4.4~ */
  remove_action('wp_head', 'rest_output_link_wp_head');
  remove_action('wp_head','wp_oembed_add_discovery_links');
  remove_action('wp_head','wp_oembed_add_host_js');

  /* Remove Emoji */  
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles' );
  remove_action('admin_print_styles', 'print_emoji_styles');

  /* Remove script */
  function remove_default_script() {
    wp_deregister_script('jquery');
  }
  add_action('wp_enqueue_scripts', 'remove_default_script');
  
  /* Remove css */
  function remove_dequeue_styles() {
    wp_dequeue_style('wp-pagenavi');
    wp_dequeue_style('mw-wp-form');
  }
  add_action('wp_print_styles', 'remove_dequeue_styles');

  /* Remove admin bar */
  add_filter( 'show_admin_bar', '__return_false' );
}

/* 実行 */
add_action('init', 'remove_front_default_code');
