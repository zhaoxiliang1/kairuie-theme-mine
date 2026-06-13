<?php
/**
 * News Category Template
 *
 * @package mine
 */

get_header();

function mine_get_news_thumb( $post_id = 0 ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    if ( has_post_thumbnail( $post_id ) ) {
        return get_the_post_thumbnail_url( $post_id, 'medium' );
    }
    $post = get_post( $post_id );
    if ( $post && preg_match( '/<img[^>]+src=[\'"]([^\'"]+)[\'"]/', $post->post_content, $matches ) ) {
        return $matches[1];
    }
    return get_template_directory_uri() . '/assets/images/probg.png';
}
?>

<div class="location">
    <?php echo mine_breadcrumb(); ?>
</div>
<style>
.pagination { display: inline-block; height: 40px; padding: 20px 0; margin: 0 auto; }
.pagination a, .pagination span { display: block; float: left; margin-right: 5px; padding: 2px 12px; font-size: 12px; line-height: 25px; }
.pagination a { border: 1px #ccc solid; background: #fff; text-decoration: none; color: #808080; }
.pagination a:hover { color: #f07b38; background: #fff; border: 1px #ccc solid; }
.pagination .current { background: #f07b38; color: #fff; border: 1px #f07b38 solid; }
.pagination .dots { border: none; background: none; color: #333; }
.newslist li a { display: flex; align-items: stretch; }
.newslist li .pic { flex-shrink: 0; width: 220px; overflow: hidden; background: #f0f0f0; }
.newslist li .pic img { width: 100%; height: 100%; display: block; }
.newslist li .info { flex: 1; min-width: 0; }
@media screen and (max-width: 768px) {
    .newslist li a { display: block; }
    .newslist li .pic { width: 100%; margin-bottom: 15px; }
    .newslist li .pic img { height: auto; }
}
</style>
<div class="nbanner nbanner1"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/p1.png" alt=""></div>
<div class="nav pronav">
    <div class="wrap">
        <ul class="clearfix">
            <?php
            $current_cat = get_queried_object();
            $current_slug = ( $current_cat && ! is_wp_error( $current_cat ) ) ? $current_cat->slug : '';
            $news_cat = get_term_by( 'slug', 'news', 'category' );
            if ( $news_cat && ! is_wp_error( $news_cat ) ) :
                $sub_cats = get_terms( array(
                    'taxonomy'   => 'category',
                    'parent'     => $news_cat->term_id,
                    'hide_empty' => false,
                    'orderby'    => 'id',
                    'order'      => 'desc',
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
            <div class="newslist">
                <ul>
                    <?php
                    if ( have_posts() ) :
                        $i = 0;
                        while ( have_posts() ) : the_post();
                            $odd_class = ( $i % 2 === 0 ) ? ' odd' : '';
                            $thumb     = mine_get_news_thumb( get_the_ID() );
                            ?>
                            <li class="<?php echo $odd_class; ?>">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="pic"><img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>"></div>
                                    <div class="info">
                                        <div class="text">
                                            <h3><?php the_title(); ?></h3>
                                            <div class="intro"><?php echo esc_html( get_the_excerpt() ); ?></div>
                                        </div>
                                        <div class="date"><span><?php echo get_the_date( 'Y-m-d' ); ?></span><i></i></div>
                                    </div>
                                </a>
                            </li>
                            <?php
                            $i++;
                        endwhile;
                    else :
                        echo '<li><div class="text"><h3>暂无文章</h3></div></li>';
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

<?php get_footer(); ?>
