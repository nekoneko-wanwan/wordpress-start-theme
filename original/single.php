<?php
/**
 * 投稿ページの詳細で使用されるテンプレート
 */
get_header(); ?>





<?php if(have_posts()): while(have_posts()): the_post(); ?>

    <p>タイトル: <?php the_title();?></p>
    <p>日付: <?php the_time('Y年m月d日');?></p>
    <p>アイキャッチ: <?php the_post_thumbnail();?></p>
    <p>本文: <?php the_content();?></p>
    <p>パーマリンク: <?php the_permalink(); ?></p>

<?php endwhile; ?>
<?php else : //記事が無い場合 ?>

    記事はありません。

<?php endif; ?>





<?php get_footer(); ?>