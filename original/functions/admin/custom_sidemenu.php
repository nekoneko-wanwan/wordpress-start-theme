<?php

/*****************************************
 * 管理画面の左メニュー名を修正する
 * あくまでラベルだけなので、詳細ページはそのまま
 *****************************************/
function custom_admin_sidemenu() {
  global $original_config;

  /* all users ---------- */
  /* top menu */
  global $menu;
  // $menu[2][0]  = 'ダッシュボード';
  $menu[5][0]  = $original_config['postLabel'];
  // $menu[10][0] = 'メディア';
  // $menu[15][0] = 'リンク';
  $menu[20][0] = $original_config['pageLabel'];
  // $menu[25][0] = 'コメント';
  // $menu[60][0] = '概観';
  // $menu[65][0] = 'プラグイン';
  // $menu[70][0] = 'ユーザー';
  // $menu[75][0] = 'ツール';
  // $menu[80][0] = '設定';

  /* sub menu */
  global $submenu;
  // $submenu['index.php'][0][0]  = 'ホーム';
  // $submenu['index.php'][10][0] = '更新';

  $submenu['edit.php'][5][0]  = '一覧';
  // $submenu['edit.php'][10][0] = '新規追加';
  // $submenu['edit.php'][15][0] = 'カテゴリー';
  // $submenu['edit.php'][16][0] = 'タグ';

  // $submenu['upload.php'][5][0]  = 'ライブラリ';
  // $submenu['upload.php'][10][0] = '新規追加';

  $submenu['edit.php?post_type=page'][5][0] = '一覧';
  // $submenu['edit.php?post_type=page'][10][0] = '新規追加';

  // $submenu['edit-comments.php'][0][0] = 'コメント一覧';
  
  // $submenu['themes.php'][5][0] = 'テーマ';
  // $submenu['themes.php'][6][0] = 'カスタマイズ';

  // $submenu['plugins.php'][5][0]  = 'インストール済みプラグイン';
  // $submenu['plugins.php'][10][0] = '新規追加';
  // $submenu['plugins.php'][15][0] = 'プラグイン編集';

  // $submenu['users.php'][5][0]  = 'ユーザー一覧';
  // $submenu['users.php'][10][0] = '新規追加';
  // $submenu['users.php'][15][0] = 'あなたのプロフィール';

  // $submenu['tools.php'][5][0]  = '利用可能なツール';
  // $submenu['tools.php'][10][0] = 'インポート';
  // $submenu['tools.php'][15][0] = 'エクスポート';

  // $submenu['options-general.php'][10][0]  = '一般';
  // $submenu['options-general.php'][15][0]  = '投稿設定';
  // $submenu['options-general.php'][20][0]  = '表示設定';
  // $submenu['options-general.php'][25][0]  = 'ディスカッション';
  // $submenu['options-general.php'][30][0]  = 'メディア';
  // $submenu['options-general.php'][40][0]  = 'パーマリンク設定';
}

/* 実行 */
add_action('admin_menu', 'custom_admin_sidemenu', 100);