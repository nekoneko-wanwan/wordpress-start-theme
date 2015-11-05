<?php



/* テンプレート側でも呼び出すことは可能 */
$original_config = array(
  "initMode"     => false,  // trueでfunctionの変更を無視する
  "contactMail"  => 'hoge@yahoo.co.jp',  // <a href="mailto:xxx@zzz">お問い合わせメールアドレス先</a>'
  "postLabel"    => 'お知らせ',
  "postsPerPage" => 10,   // 投稿を複数表示させるときの記事数
  "postsOrder"   => 'ASC',  // 投稿を複数表示させるときのソート順
  "pageLabel"    => '静的ページ'
);




/* ===================== Admin edit start ===================== */



/*****************************************
 * Remove admin common parts
 * 
 * 管理画面において、共通パーツを削除する
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



/*****************************************
 * Custom admin common parts
 * 
 * 管理画面において、共通パーツを修正する
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



/*****************************************
 * Remove admin side menu
 * 
 * 管理画面において、左メニューから項目を削除する
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



/*****************************************
 * Custom admin side menu
 * 
 * 管理画面において、左メニューの項目名を修正する
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



/*****************************************
 * Remove admin dashboard
 * 
 * 管理画面において、ダッシュボードの不要なものを削除する
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



/*****************************************
 * Custom admin post
 * 
 * 管理画面において、投稿について修正する
 *****************************************/
function custom_admin_post() {
  global $original_config;
  global $wp_post_types;

  /* Custom label */
  $labels = $wp_post_types['post']->labels;
  $labels->name = $original_config['postLabel'];
  $labels->singular_name = $original_config['postLabel'];
  // $labels->add_new = '新規追加';
  $labels->add_new_item = $original_config['postLabel'] . 'を追加';
  $labels->edit_item    = $original_config['postLabel'] . 'の編集';
  $labels->new_item     = $original_config['postLabel'] . 'を追加';
  $labels->view_item    = $original_config['postLabel'] . 'を表示';
  $labels->search_items = $original_config['postLabel'] . 'を検索';
  $labels->not_found    = $original_config['postLabel'] . 'が見つかりませんでした。';
  $labels->all_items    = 'すべての' . $original_config['postLabel'];
  // $labels->not_found_in_trash = 'ゴミ箱内に投稿が見つかりませんでした。';

  /* Remove post top page */
  function remove_admin_posts_columns($columns) {
    // unset($columns['categories']);
    unset($columns['tags']);
    unset($columns['comments']);
    // unset($columns['author']);
    return $columns;
  }
  add_filter( 'manage_posts_columns', 'remove_admin_posts_columns' );

  /* Remove metaBox  */
  function remove_admin_post_metaboxes() {
    // remove_meta_box('categorydiv', 'post', 'normal');      // カテゴリ
    remove_meta_box('tagsdiv-post_tag', 'post', 'side');   // タグ
    remove_meta_box('postexcerpt', 'post', 'normal');      // 抜粋
    remove_meta_box('trackbacksdiv', 'post', 'normal');    // トラックバック
    remove_meta_box('postcustom', 'post', 'normal');       // カスタムフィールド
    remove_meta_box('commentstatusdiv', 'post', 'normal'); // ディスカッション
    remove_meta_box('commentsdiv', 'post', 'normal');      // コメント
    remove_meta_box('slugdiv', 'post', 'normal');          // スラッグ
    remove_meta_box('authordiv', 'post', 'normal');        // 作成者
  }
  add_action('admin_menu', 'remove_admin_post_metaboxes');

  /* Useable eyecatch */
  // add_theme_support('post-thumbnails');
}



/*****************************************
 * Custom admin post
 * 
 * 管理画面において、固定ページについて修正する
 *****************************************/
function custom_admin_page() {
  global $original_config;
  global $wp_post_types;

  /* Custom label */
  $labels = $wp_post_types['page']->labels;
  $labels->name = $original_config['pageLabel'];
  $labels->singular_name = $original_config['pageLabel'];
  // $labels->add_new = '新規追加';
  $labels->add_new_item = $original_config['pageLabel'] . 'を追加';
  $labels->edit_item    = $original_config['pageLabel'] . 'の編集';
  $labels->new_item     = $original_config['pageLabel'] . 'を追加';
  $labels->view_item    = $original_config['pageLabel'] . 'を表示';
  $labels->search_items = $original_config['pageLabel'] . 'を検索';
  $labels->not_found    = $original_config['pageLabel'] . 'が見つかりませんでした。';
  $labels->all_items    = 'すべての' . $original_config['pageLabel'];
  // $labels->not_found_in_trash = 'ゴミ箱内に投稿が見つかりませんでした。';

  /* Remove page top page */
  function remove_admin_pages_columns($columns) {
    unset($columns['comments']);
    unset($columns['author']);
    unset($columns['date']);
    return $columns;
  }
  add_filter('manage_pages_columns', 'remove_admin_pages_columns');

  /* Remove metaBox  */
  function remove_admin_pages_metaboxes() {
    remove_meta_box('pageparentdiv', 'page', 'normal');    // ページ属性
    remove_meta_box('postcustom', 'page', 'normal');       // カスタムフィールド
    remove_meta_box('commentstatusdiv', 'page', 'normal'); // ディスカッション
    remove_meta_box('commentsdiv', 'page', 'normal');      // コメント
    remove_meta_box('slugdiv', 'page', 'normal');          // スラッグ
    remove_meta_box('authordiv', 'page', 'normal');        // 作成者
  }
  add_action('admin_menu', 'remove_admin_pages_metaboxes');
}



/*****************************************
 * Run Admin functions
 * 
 * 管理画面のカスタマイズを実行する
 *****************************************/
function run_admin_fnc() {
  add_action('wp_before_admin_bar_render', 'remove_admin_common_parts'); 
  add_action('wp_before_admin_bar_render', 'custom_admin_common_parts'); 
  add_action('admin_menu', 'remove_admin_sidemenu', 100);
  add_action('admin_menu', 'custom_admin_sidemenu', 100);
  add_action('wp_dashboard_setup', 'remove_admin_dashboard');
  add_action('init', 'custom_admin_post');
  add_action('init', 'custom_admin_page');
}

/* デフォルトモードが有効になっている場合は実行しない  */
if ($original_config['initMode'] === false) {
  run_admin_fnc();
}




/* ===================== Front edit start ===================== */



/*****************************************
 * Remove Front default code
 * 
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



/*****************************************
 * Custom Front get posts
 * 
 * 表側ページの投稿やアーカイブの表示条件を設定する
 *****************************************/
 function custom_front_get_posts($query) {
  global $original_config;

  /* 管理画面、メインクエリに干渉しないために必須 */
  if( is_admin() || ! $query->is_main_query() ){
    return;
  }

  /* 細かく設定することもできる */
  /* 年別アーカイブページの場合 */
  if ($query -> is_year()) {}

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  // ページングに使用
  $query -> set('paged', $paged);
  $query -> set('posts_per_page', $original_config['postsPerPage']);
  $query -> set('order', $original_config['postsOrder']);
  return;
}





/*****************************************
 * Run Front functions
 * 
 * 表側ページのカスタマイズを実行する
 *****************************************/
function run_front_fnc() {
  add_action('init', 'remove_front_default_code');
  add_action('pre_get_posts', 'custom_front_get_posts');
}


run_front_fnc();


