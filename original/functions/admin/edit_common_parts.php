<?php

/*****************************************
 * 管理画面の共通パーツを修正する
 *****************************************/
function edit_admin_common_parts() {
  /* all users ---------- */
  /* footer */
  function edit_admin_footer() {
    global $original_config;
    echo $original_config['contactMail'];
  }
  add_filter('admin_footer_text', 'edit_admin_footer');
}


/* 実行 */
add_action('wp_before_admin_bar_render', 'edit_admin_common_parts');
