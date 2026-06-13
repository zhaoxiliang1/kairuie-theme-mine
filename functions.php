<?php
/**
 * mine Theme - Functions
 *
 * @package mine
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function mine_theme_setup() {
    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
    ) );

    register_nav_menus( array(
        'primary' => __( '主导航菜单', 'mine' ),
    ) );
}
add_action( 'after_setup_theme', 'mine_theme_setup' );

function mine_enqueue_assets() {
    $theme_dir = get_template_directory_uri();

    wp_enqueue_style( 'swiper', $theme_dir . '/assets/css/swiper.min.css', array(), '1.0' );
    wp_enqueue_style( 'mine-main', $theme_dir . '/assets/css/css.css', array(), '7.0' );
    wp_enqueue_style( 'mine-screen', $theme_dir . '/assets/css/screen.css', array(), '5.0' );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'prefixfree', $theme_dir . '/assets/js/prefixfree.min.js', array(), '1.0', false );
    wp_enqueue_script( 'superslide', $theme_dir . '/assets/js/jquery.SuperSlide.2.1.1.js', array( 'jquery' ), '2.1.1', false );
    wp_enqueue_script( 'mine-common', $theme_dir . '/assets/js/common.js', array( 'jquery' ), '3.0', true );
    wp_enqueue_script( 'swiper', $theme_dir . '/assets/js/swiper.min.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'mine_enqueue_assets' );

function mine_category_template_inherit( $template ) {
    if ( ! is_category() ) {
        return $template;
    }

    $cat     = get_queried_object();
    $slugs   = array( $cat->slug );
    $anc_ids = get_ancestors( $cat->term_id, 'category', 'taxonomy' );

    foreach ( $anc_ids as $anc_id ) {
        $anc     = get_term( $anc_id );
        $slugs[] = $anc->slug;
    }

    foreach ( $slugs as $slug ) {
        $tpl = get_template_directory() . '/category-' . $slug . '.php';
        if ( file_exists( $tpl ) ) {
            return $tpl;
        }
    }

    return $template;
}
add_filter( 'category_template', 'mine_category_template_inherit' );


function mine_register_contact_cpt() {
    register_post_type( 'contact_submission', array(
        'labels'          => array(
            'name'          => '客户留言',
            'singular_name' => '客户留言',
            'menu_name'     => '客户留言',
            'all_items'     => '所有留言',
            'edit_item'     => '查看留言',
        ),
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'menu_icon'       => 'dashicons-email-alt',
        'menu_position'   => 30,
        'supports'        => array( 'title', 'editor' ),
        'capability_type' => 'post',
        'map_meta_cap'    => true,
    ) );
}
add_action( 'init', 'mine_register_contact_cpt' );


function mine_contact_columns( $columns ) {
    $new = array();
    foreach ( $columns as $key => $value ) {
        $new[ $key ] = $value;
        if ( 'title' === $key ) {
            $new['contact_name']  = '姓名';
            $new['contact_email'] = '邮箱';
            $new['contact_phone'] = '电话';
        }
    }
    unset( $new['date'] );
    $new['date'] = '提交时间';
    return $new;
}
add_filter( 'manage_contact_submission_posts_columns', 'mine_contact_columns' );

function mine_contact_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'contact_name':
            echo esc_html( get_post_meta( $post_id, '_contact_name', true ) );
            break;
        case 'contact_email':
            echo esc_html( get_post_meta( $post_id, '_contact_email', true ) );
            break;
        case 'contact_phone':
            echo esc_html( get_post_meta( $post_id, '_contact_phone', true ) ) ?: '-';
            break;
    }
}
add_action( 'manage_contact_submission_posts_custom_column', 'mine_contact_column_content', 10, 2 );


function mine_get_dynamic_title() {
    if ( is_home() || is_front_page() ) {
        $title = get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );
    } elseif ( is_singular() ) {
        $title = get_the_title() . '_' . get_bloginfo( 'name' );
    } else {
        $title = wp_get_document_title();
    }
    return esc_html( $title );
}


function mine_get_current_slug() {
    global $post;
    if ( is_front_page() ) {
        return 'home';
    }
    if ( $post && $post->post_name ) {
        return $post->post_name;
    }
    return '';
}


function mine_breadcrumb() {
    $items   = array();
    $items[] = '<a href="' . esc_url( home_url( '/' ) ) . '">首页</a>';

    if ( is_page() ) {
        $ancestors = get_post_ancestors( get_the_ID() );
        if ( ! empty( $ancestors ) ) {
            $ancestors = array_reverse( $ancestors );
            foreach ( $ancestors as $ancestor_id ) {
                $items[] = '<a href="' . esc_url( get_permalink( $ancestor_id ) ) . '">' . esc_html( get_the_title( $ancestor_id ) ) . '</a>';
            }
        }
        $items[] = '<a href="javascript:;" class="col01">' . esc_html( get_the_title() ) . '</a>';
    } elseif ( is_category() ) {
        $current_cat = get_queried_object();
        if ( $current_cat && ! empty( $current_cat->parent ) ) {
            $parents   = get_ancestors( $current_cat->term_id, 'category', 'taxonomy' );
            $parents   = array_reverse( $parents );
            foreach ( $parents as $parent_id ) {
                $parent_cat = get_term( $parent_id );
                if ( $parent_cat && ! is_wp_error( $parent_cat ) ) {
                    $items[] = '<a href="' . esc_url( get_term_link( $parent_cat ) ) . '">' . esc_html( $parent_cat->name ) . '</a>';
                }
            }
        }
        $items[] = '<a href="javascript:;" class="col01">' . esc_html( single_cat_title( '', false ) ) . '</a>';
    } elseif ( is_single() ) {
        $cats = get_the_category();
        if ( ! empty( $cats ) ) {
            $cat      = $cats[0];
            $ancestors = get_ancestors( $cat->term_id, 'category', 'taxonomy' );
            if ( ! empty( $ancestors ) ) {
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $anc_id ) {
                    $anc_cat = get_term( $anc_id );
                    if ( $anc_cat && ! is_wp_error( $anc_cat ) ) {
                        $items[] = '<a href="' . esc_url( get_term_link( $anc_cat ) ) . '">' . esc_html( $anc_cat->name ) . '</a>';
                    }
                }
            }
            $items[] = '<a href="' . esc_url( get_term_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';
        }
        $items[] = '<a href="javascript:;" class="col01">' . esc_html( get_the_title() ) . '</a>';
    } else {
        $items[] = '<a href="javascript:;" class="col01">' . esc_html( get_the_title() ) . '</a>';
    }

    $output = '';
    $count  = count( $items );
    foreach ( $items as $i => $item ) {
        $output .= $item;
        if ( $i < $count - 1 ) {
            $output .= '<span>&gt;</span>';
        }
    }

    return '<div class="wrap clearfix">' . $output . '</div>';
}


function mine_contact_form_submit() {
    if ( ! isset( $_POST['mine_contact_nonce'] )
        || ! wp_verify_nonce( wp_unslash( $_POST['mine_contact_nonce'] ), 'mine_contact_form' ) ) {
        wp_send_json_error( '安全验证失败，请刷新页面后重试' );
    }

    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $content = isset( $_POST['content'] ) ? sanitize_textarea_field( wp_unslash( $_POST['content'] ) ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $content ) ) {
        wp_send_json_error( '请填写所有必填项' );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( '请输入有效的电子邮箱地址' );
    }

    $post_id = wp_insert_post( array(
        'post_type'    => 'contact_submission',
        'post_title'   => sprintf( '%s - %s', $name, current_time( 'Y-m-d H:i' ) ),
        'post_content' => $content,
        'post_status'  => 'publish',
        'meta_input'   => array(
            '_contact_name'  => $name,
            '_contact_email' => $email,
            '_contact_phone' => $phone,
        ),
    ), true );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( '提交失败，请稍后重试' );
    }

    $to      = get_option( 'admin_email' );
    $subject = sprintf( '【%s】来自 %s 的留言', get_bloginfo( 'name' ), $name );
    $body    = sprintf(
        "姓名：%s\n邮箱：%s\n电话：%s\n\n留言内容：\n%s",
        $name,
        $email,
        $phone ?: '未填写',
        $content
    );
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        sprintf( 'Reply-To: %s <%s>', $name, $email ),
    );

    wp_mail( $to, $subject, $body, $headers );

    wp_send_json_success( '提交成功，我们会尽快与您联系！' );
}
add_action( 'wp_ajax_mine_contact_submit', 'mine_contact_form_submit' );
add_action( 'wp_ajax_nopriv_mine_contact_submit', 'mine_contact_form_submit' );

function mine_get_top_category( $cat ) {
    if ( empty( $cat->parent ) ) {
        return $cat;
    }
    $ancestors = get_ancestors( $cat->term_id, 'category', 'taxonomy' );
    if ( ! empty( $ancestors ) ) {
        $top_id = end( $ancestors );
        $top = get_term( $top_id );
        if ( $top && ! is_wp_error( $top ) ) {
            return $top;
        }
    }
    return $cat;
}

function mine_get_first_image( $post_id = 0 ) {
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
