<?php

/*****************************************
 * 管理画面の左メニュー項目を削除する
 * あくまで表示だけなので直接URLを叩けばアクセス可能
 * 一部機能に関しては管理者の場合は削除しない
 *****************************************/
function remove_admin_sidemenu() {
  /* all users ---------- */
  /* top menu */

  /* sub menu */


  /* Non adminstrater ---------- */
  if(current_user_can('administrator')) {
  	return;
  }
  /* top menu */
  // remove_menu_page('index.php' );                // ダッシュボード
  // remove_menu_page('edit.php' );                 // 投稿
  // remove_menu_page('upload.php' );               // メディア
  remove_menu_page('edit.php?post_type=page' );  // 固定ページ
  remove_menu_page('edit-comments.php' );        // コメント
  remove_menu_page('themes.php' );               // 外観
  remove_menu_page('plugins.php' );              // プラグイン
  remove_menu_page('users.php' );                // ユーザー
  remove_menu_page('tools.php' );                // ツール
  remove_menu_page('options-general.php' );      // 設定

  /* sub menu */
  remove_submenu_page('index.php', 'update-core.php');                   // 更新
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');    // カテゴリ
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');    // タグ
  remove_submenu_page('admin.php', 'page=cptui_main_menu');              // 更新
  remove_submenu_page('admin.php', 'admin.php?page=cptui_main_menu');    // カテゴリの非表示
  remove_submenu_page('options-general.php', 'options-reading.php');     // 表示設定
  remove_submenu_page('options-general.php', 'options-discussion.php');  // ディスカッション
  remove_submenu_page('options-general.php', 'options-media.php');       // メディア
  remove_submenu_page('options-general.php', 'options-permalink.php');   // パーマリンク設定
}


/* 実行 */
add_action('admin_menu', 'remove_admin_sidemenu', 100);