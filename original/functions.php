<?php

/* テンプレート側でも呼び出すことは可能 */
$original_config = array(
  "contactMail"  => 'hoge@yahoo.co.jp',  // <a href="mailto:xxx@zzz">お問い合わせメールアドレス先</a>'
  "postLabel"    => 'お知らせ',
  "postsPerPage" => 10,   // 投稿を複数表示させるときの記事数
  "postsOrder"   => 'ASC',  // 投稿を複数表示させるときのソート順
  "pageLabel"    => '静的ページ'
);


/* Admin remove functions */
/* 権限毎に削除する項目を細かく制御している */
require_once locate_template('functions/admin/remove_common_parts.php');
require_once locate_template('functions/admin/remove_sidemenu.php');
require_once locate_template('functions/admin/remove_dashboard.php');

/* Admin custom functions */
require_once locate_template('functions/admin/edit_common_parts.php');
require_once locate_template('functions/admin/edit_sidemenu.php');
require_once locate_template('functions/admin/edit_post.php');
require_once locate_template('functions/admin/edit_page.php');


/* front */
require_once locate_template('functions/front/remove_default_code.php');
require_once locate_template('functions/front/edit_post.php');

