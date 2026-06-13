<?php
/**
 * Theme Header
 *
 * @package mine
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="baidu-site-verification" content="codeva-rhofDRJnc4" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1, minimum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/favicon.ico" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="header">
        <div class="wrap clearfix">
            <div class="logo fl"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.png?v=2.0" alt="<?php bloginfo( 'name' ); ?>"></a></div>
            <div class="logo_m fl"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.jpg?v=2.0" alt="<?php bloginfo( 'name' ); ?>"></a></div>
            
            <div class="menu fl">
                <?php
                $theme_uri = get_template_directory_uri();
                $home_url  = home_url( '/' );
                ?>
                <ul class="clearfix">
                    <li>
                        <a href="<?php echo esc_url( $home_url ); ?>" class="menu_a"><i class="hover"><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_01_h.png" alt="首页"></i><i><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_01.png"></i>首页</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( $home_url ); ?>about" class="menu_a"><i class="hover"><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_02_h.png"></i><i><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_02.png"></i>关于我们</a>
                        <div class="sub">
                            <p><a href="<?php echo esc_url( $home_url ); ?>about">企业简介</a></p>
                            <p><a href="<?php echo esc_url( $home_url ); ?>culture">企业文化</a></p>
                            
                        </div>
                    </li>
                    <li class="li_pro">
                        <a href="<?php echo esc_url( $home_url ); ?>/category/products" class="menu_a"><i class="hover"><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_03_h.png" alt="产品中心"></i><i><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_03.png"></i>产品中心</a>
                        <div class="sub sub_pro">
                            <div class="sub_pro_wrap">
                                <?php
                                $products_cat = get_term_by( 'slug', 'products', 'category' );
                                if ( $products_cat && ! is_wp_error( $products_cat ) ) :
                                    $sub_cats = get_terms( array(
                                        'taxonomy'   => 'category',
                                        'parent'     => $products_cat->term_id,
                                        'hide_empty' => false,
                                        'orderby'    => 'id',
                                        'order'      => 'ASC',
                                    ) );
                                    if ( ! empty( $sub_cats ) && ! is_wp_error( $sub_cats ) ) :
                                        foreach ( $sub_cats as $sub_cat ) :
                                            ?>
                                            <p><a href="<?php echo esc_url( get_term_link( $sub_cat ) ); ?>"><?php echo esc_html( $sub_cat->name ); ?></a></p>
                                            <?php
                                        endforeach;
                                    endif;
                                endif;
                                ?>
                            </div>
                        </div>
                    </li>
                    
                    <li>
                        <a href="<?php echo esc_url( $home_url ); ?>spot-specifications" class="menu_a"><i class="hover"><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_04_h.png"></i><i><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_04.png"></i>现货规格</a>
                        <!-- <div class="sub">
                            <p><a href="<?php echo esc_url( $home_url ); ?>category-solutions/equipment">大型设备</a></p>
                            <p><a href="<?php echo esc_url( $home_url ); ?>category-solutions/metal">金属元件</a></p>
                            <p><a href="<?php echo esc_url( $home_url ); ?>category-solutions/electronics">电子元器件</a></p>
                        </div> -->
                    </li>
                    <li>
                        <a href="<?php echo esc_url( $home_url ); ?>category/news" class="menu_a"><i class="hover"><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_06_h.png" alt="新闻资讯"></i><i><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_06.png"></i>新闻资讯</a>
                    </li>
                    <li><a href="<?php echo esc_url( $home_url ); ?>contact" class="menu_a"><i class="hover"><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_05_h.png"></i><i><img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/icon_05.png"></i>联系我们</a></li>
                </ul>
            </div>
            <div class="m-btn fr"><span class="line1"></span><span class="line2"></span><span class="line3"></span></div>
            <div class="lang fr"><a href="https://www.kairuie.com/" target="_blank">EN</a></div>
        </div>
    </div>
    <!-- 移动端菜单 -->
    <div class="m-menu">
        <ul>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">首页</a></li>
            <li><a href="<?php echo esc_url( $home_url ); ?>about">关于我们<i></i></a>
                <div class="sub">
                    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>about">企业简介</a></p>
                    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>culture">企业文化</a></p>
                    
                </div>
            </li>
            <li><a href="<?php echo esc_url( $home_url ); ?>category/products">产品中心<i></i></a>
                <div class="sub">
                    <?php
                    $products_cat = get_term_by( 'slug', 'products', 'category' );
                    if ( $products_cat && ! is_wp_error( $products_cat ) ) :
                        $sub_cats = get_terms( array(
                            'taxonomy'   => 'category',
                            'parent'     => $products_cat->term_id,
                            'hide_empty' => false,
                            'orderby'    => 'id',
                            'order'      => 'ASC',
                        ) );
                        if ( ! empty( $sub_cats ) && ! is_wp_error( $sub_cats ) ) :
                            foreach ( $sub_cats as $sub_cat ) :
                                ?>
                                <p><a href="<?php echo esc_url( get_term_link( $sub_cat ) ); ?>"><?php echo esc_html( $sub_cat->name ); ?></a></p>
                                <?php
                            endforeach;
                        endif;
                    endif;
                    ?>
                </div>
            </li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>spot-specifications">现货规格</a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>category/news">新闻资讯</a></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>contact">联系我们</a></li>
        </ul>
    </div>
