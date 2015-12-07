<?php

/*****************************************
 * 管理画面のpostを修正する
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

/* 実行 */
add_action('init', 'custom_admin_post');