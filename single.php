<?php
/**
 * Single Post Template
 *
 * @package mine
 */

get_header();
?>

<div class="location">
    <?php echo mine_breadcrumb(); ?>
</div>

<div class="nbanner nbanner1">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/p1.png" alt="">
</div>

<?php
$categories = get_the_category();
if ( ! empty( $categories ) ) :
    $top_cat = mine_get_top_category( $categories[0] );
    $sub_cats = get_terms( array(
        'taxonomy'   => 'category',
        'parent'     => $top_cat->term_id,
        'hide_empty' => false,
        'orderby'    => 'id',
        'order'      => 'asc',
    ) );
    if ( ! empty( $sub_cats ) && ! is_wp_error( $sub_cats ) ) :
        ?>
        <div class="nav pronav">
            <div class="wrap">
                <ul class="clearfix">
                    <?php foreach ( $sub_cats as $sub_cat ) : ?>
                        <li><a href="<?php echo esc_url( get_term_link( $sub_cat ) ); ?>"><?php echo esc_html( $sub_cat->name ); ?></a><i></i></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php
    endif;
endif;
?>

<div class="main">
    <div class="wrap">
        <div class="content">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="sin-art">
                    <h1 class="sin-title"><?php the_title(); ?></h1>
                    <div class="sin-meta">
                        <span class="sin-date">发布时间：<?php echo get_the_date( 'Y-m-d' ); ?></span>
                        <span class="sin-cat">分类：<?php the_category( '、' ); ?></span>
                    </div>
                    <div class="sin-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="sin-page-nav">
                    <div class="sin-prev">
                        <?php previous_post_link( '%link', '上一篇：%title' ); ?>
                    </div>
                    <div class="sin-next">
                        <?php next_post_link( '%link', '下一篇：%title' ); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<style>
.sin-art { padding-bottom: 40px; border-bottom: 1px solid #e8e8e8; }
.sin-title { font-size: 28px; text-align: center; color: #333; font-weight: normal; margin-bottom: 20px; line-height: 40px; }
.sin-meta { text-align: center; color: #999; font-size: 14px; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px dashed #e8e8e8; }
.sin-meta span { margin: 0 15px; }
.sin-content { line-height: 30px; font-size: 15px; color: #808080; }
.sin-content img { max-width: 100%; height: auto; }
.sin-content p { margin-bottom: 15px; }
.sin-page-nav { padding: 30px 0; overflow: hidden; }
.sin-page-nav a { color: #666; font-size: 14px; }
.sin-page-nav a:hover { color: #f07b38; }
.sin-prev { float: left; max-width: 48%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.sin-next { float: right; max-width: 48%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
@media screen and (max-width: 768px) {
    .sin-title { font-size: 20px; line-height: 30px; }
    .sin-prev, .sin-next { float: none; max-width: 100%; margin-bottom: 10px; }
}

.sin-content table {
  border-collapse: collapse;
  width: 100%;
}
.sin-content table, th, td {
  border: 1px solid black;
}
.sin-content th,
.sin-content td {
  padding: 8px 12px;
  white-space: nowrap;
}
@media screen and (max-width: 768px) {
  .sin-content {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .sin-content table {
    min-width: 600px;
  }
}
.sin-content div {
  margin-bottom: 10px;
}
.sin-content li {
  list-style: disc;
  margin-left: 2em;
}
</style>

<?php get_footer(); ?>
