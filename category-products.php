<?php
/**
 * Template Name: 产品中心
 *
 * @package mine
 */

get_header();
?>

<div class="location">
    <?php echo mine_breadcrumb(); ?>
</div>
<style>
.nbanner-fade { position: relative; width: 100%; }
.nbanner-fade img { position: absolute; top: 0; left: 0; width: 100%; margin-left: 0; display: block; opacity: 0; transition: opacity 0.8s ease; }
.nbanner-fade img.active { opacity: 1; position: relative; }
.nbanner-dots { position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); z-index: 10; }
.nbanner-dots span { display: inline-block; width: 10px; height: 10px; margin: 0 5px; border-radius: 50%; background: rgba(255,255,255,0.5); cursor: pointer; }
.nbanner-dots span.active { background: #fff; }
.pagination { display: inline-block; height: 40px; padding: 20px 0; margin: 0 auto; }
.pagination a, .pagination span { display: block; float: left; margin-right: 5px; padding: 2px 12px; font-size: 12px; line-height: 25px; }
.pagination a { border: 1px #ccc solid; background: #fff; text-decoration: none; color: #808080; }
.pagination a:hover { color: #f07b38; background: #fff; border: 1px #ccc solid; }
.pagination .current { background: #f07b38; color: #fff; border: 1px #f07b38 solid; }
.pagination .dots { border: none; background: none; color: #333; }
</style>
<div class="nbanner nbanner1">
    <div class="nbanner-fade">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/p1.png" alt="" class="active">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/p2.png" alt="">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/p3.png" alt="">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/p4.png" alt="">
    </div>
    <div class="nbanner-dots">
        <span class="active"></span><span></span><span></span><span></span>
    </div>
</div>
<div class="nav pronav">
    <div class="wrap">
        <ul class="clearfix">
            <?php
            $current_cat = get_queried_object();
            $current_slug = ( $current_cat && ! is_wp_error( $current_cat ) ) ? $current_cat->slug : '';
            $products_cat = get_term_by( 'slug', 'products', 'category' );
            if ( $products_cat && ! is_wp_error( $products_cat ) ) :
                $sub_cats = get_terms( array(
                    'taxonomy'   => 'category',
                    'parent'     => $products_cat->term_id,
                    'hide_empty' => false,
                    'orderby'    => 'id',
                    'order'      => 'asc',
                ) );
                if ( ! empty( $sub_cats ) && ! is_wp_error( $sub_cats ) ) :
                    foreach ( $sub_cats as $sub_cat ) :
                        $is_cur = ( $current_slug === $sub_cat->slug ) ? ' class="cur"' : '';
                        ?>
                        <li><a href="<?php echo esc_url( get_term_link( $sub_cat ) ); ?>"<?php echo $is_cur; ?>><?php echo esc_html( $sub_cat->name ); ?></a><i></i></li>
                        <?php
                    endforeach;
                endif;
            endif;
            ?>
        </ul>
    </div>
</div>
<div class="main">
    <div class="wrap">
        <div class="content products">
            <div class="pro_list">
                <ul class="clearfix">
                    <?php
                    global $wp_query;
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                            ?>
                            <li><a href="<?php the_permalink(); ?>">
                                    <div class="pic img-dv"><img src="<?php echo esc_url( mine_get_first_image( get_the_ID() ) ); ?>" class="img2"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/probg.png" class="img1"></div>
                                    <div class="text">
                                        <p class="tit"><?php the_title(); ?></p>
                                        <div class="intro"><?php echo esc_html( get_the_excerpt() ); ?></div>
                                    </div>
                                    <div class="bottom">
                                        <div class="line"></div>
                                    </div>
                                </a></li>
                            <?php
                        endwhile;
                    else :
                        echo '<p>暂无产品</p>';
                    endif;
                    ?>
                </ul>
            </div>
            <div class="pages" align="center">
                <div class="pagination">
                    <?php
                    global $wp_query;
                    $pagination = paginate_links( array(
                        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => max( 1, get_query_var( 'paged' ) ),
                        'total'     => $wp_query->max_num_pages,
                        'prev_text' => '上一页',
                        'next_text' => '下一页',
                        'end_size'  => 1,
                        'mid_size'  => 2,
                    ) );
                    echo $pagination;
                    ?>
                </div>
        </div>
    </div>
</div>
</div>

<script>
(function() {
    var imgs = document.querySelectorAll('.nbanner-fade img');
    var dots = document.querySelectorAll('.nbanner-dots span');
    var current = 0;
    var len = imgs.length;
    setInterval(function() {
        imgs[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (current + 1) % len;
        imgs[current].classList.add('active');
        dots[current].classList.add('active');
    }, 4000);
})();
</script>

<?php get_footer(); ?>
