<?php

/*****************************************
 * 表側ページの投稿やアーカイブの表示条件を設定する
 *****************************************/
 function edit_front_posts($query) {
  global $original_config;

  /* 管理画面、メインクエリに干渉しないために必須 */
  if( is_admin() || ! $query->is_main_query() ){
    return;
  }

  /* 細かく設定することもできる */
  /* 年別アーカイブページの場合 */
  if ($query -> is_year()) {
  }

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  // ページングに使用
  $query -> set('paged', $paged);
  $query -> set('posts_per_page', $original_config['postsPerPage']);
  $query -> set('order', $original_config['postsOrder']);
  return;
}

/* 実行 */
add_action('pre_get_posts', 'edit_front_posts');