<?php

/*****************************************
 * 管理画面の共通パーツを修正する
 *****************************************/
function custom_admin_common_parts() {
  /* all users ---------- */
  /* footer */
  function custom_admin_footer() {
    global $original_config;
    echo $original_config['contactMail'];
  }
  add_filter('admin_footer_text', 'custom_admin_footer');
}


/* 実行 */
add_action('wp_before_admin_bar_render', 'custom_admin_common_parts');
