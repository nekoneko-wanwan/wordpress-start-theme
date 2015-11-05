<?php
/**
 * Blogのトップページで使用されるテンプレート
 */
get_header(); ?>


<p>これはtop pageです<br>投稿記事を全部出力します<br>archive.phpの元テンプレートにも<br>
実際には使わないと思うのでタイトルの出力は要調整</p>
<hr>





<?php if(have_posts()): while(have_posts()): the_post(); ?>

    <div>タイトル: <?php the_title();?></div>
    <div>日付: <?php the_time('Y年m月d日');?></div>
    <div>アイキャッチ: <?php the_post_thumbnail();?></div>
    <div>本文: <?php the_content();?></div>
    <div>パーマリンク: <?php the_permalink(); ?></div>

	<hr>

<?php endwhile; ?>
<?php else : //記事が無い場合 ?>

    記事はありません。

<?php endif; ?>





<?php get_footer(); ?>
