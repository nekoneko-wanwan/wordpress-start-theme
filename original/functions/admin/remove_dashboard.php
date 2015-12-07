<?php

/*****************************************
 * 管理画面のダッシュボードの項目を削除する
 * 一部機能に関しては管理者の場合は削除しない
 *****************************************/
function remove_admin_dashboard() {
  remove_action('welcome_panel', 'wp_welcome_panel');                   // ようこそパネル
  remove_meta_box('dashboard_browser_nag', 'dashboard', 'normal');      // 旧ブラウザに対する警告表示
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');        // 現在の状況パネル
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');  // 最近のコメント
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');   // 非リンク
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');          // プラグイン
  // remove_meta_box('dashboard_activity', 'dashboard', 'normal');         // アクティビティ
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');        // クイック投稿
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');      // 最近の下書き
  remove_meta_box('dashboard_primary', 'dashboard', 'side');            // WordPress開発ブログ
  remove_meta_box('dashboard_secondary', 'dashboard', 'side');          // WordPressフォーラム
}

/* 実行 */
add_action('wp_dashboard_setup', 'remove_admin_dashboard');