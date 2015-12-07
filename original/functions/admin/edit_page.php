<?php

/*****************************************
 * 管理画面の固定ページを修正する
 *****************************************/
function edit_admin_page() {
  global $original_config;
  global $wp_post_types;

  /* edit label */
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

/* 実行 */
add_action('init', 'edit_admin_page');