<?php

/*****************************************
 * 管理画面の共通パーツを削除する
 * 一部機能に関しては管理者の場合は削除しない
 *****************************************/
function remove_admin_common_parts() {
  /* all users ---------- */
  /* header */
  global $wp_admin_bar;
  $wp_admin_bar -> remove_menu('wp-logo');
  $wp_admin_bar -> remove_menu('updates');
  $wp_admin_bar -> remove_menu('comments');
  $wp_admin_bar -> remove_menu('new-content');
  $wp_admin_bar -> remove_menu('wporg');

  /* ヘルプ */
  echo '<style type="text/css">#contextual-help-link-wrap{display:none;}</style>';


  /* Non adminstrater ---------- */
  if(current_user_can('administrator')) {
  	return;
  }
  /* update info (右下も消える) */
  add_filter('pre_site_transient_update_core', '__return_zero');
  remove_action('wp_version_check', 'wp_version_check');
  remove_action('admin_init', '_maybe_update_core');
}


/* 実行 */
add_action('wp_before_admin_bar_render', 'remove_admin_common_parts');