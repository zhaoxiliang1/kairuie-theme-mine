<?php
/**
 * Template Name: 现货规格
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

<div class="main">
    <div class="wrap">
        <div class="content">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="sin-art">
                    <h1 class="sin-title"><?php the_title(); ?></h1>
                    <div class="sin-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<style>
.sin-art { padding-bottom: 40px; }
.sin-title { font-size: 28px; text-align: center; color: #333; font-weight: normal; margin-bottom: 30px; line-height: 40px; }
.sin-content { line-height: 30px; font-size: 15px; color: #808080; }
.sin-content img { max-width: 100%; height: auto; }
.sin-content p { margin-bottom: 15px; }
@media screen and (max-width: 768px) {
    .sin-title { font-size: 20px; line-height: 30px; }
}
.sin-content table {
  border-collapse: collapse;
  width: 100%;
}
.content table, th, td {
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
</style>


<?php get_footer(); ?>
