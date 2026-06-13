<?php
/**
 * Theme Footer
 *
 * @package mine
 */
?>
    <div class="footer">
        <div class="wrap">

            <?php if(is_home() || is_front_page()) : ?>

            <div class="foot-top clearfix">
                <div class="i-news fl">
                    <div class="title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>category/news">新闻资讯<span class="en">News</span></a></div>
                    <div class="i-news-con clearfix">
                        <div class="left fl">
                            <ul>
                                <?php
                                $recent_posts = wp_get_recent_posts( array(
                                    'numberposts'  => 4,
                                    'post_status'  => 'publish',
                                    'category_name' => 'news',
                                ) );
                                foreach ( $recent_posts as $post ) :
                                    $thumb = mine_get_first_image( $post['ID'] );
                                ?>
                                    <li style="margin-bottom: 10px;"><a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>">
                                            <div class="pic"><img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $post['post_title'] ); ?>" style="max-height:127px;"></div>
                                            <div class="tit"><?php echo esc_html( $post['post_title'] ); ?></div>
                                        </a></li>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                        </div>
                        <div class="right fr">
                            <ul>
                                <?php
                                $more_posts = wp_get_recent_posts( array(
                                    'numberposts'  => 9,
                                    'offset'       => 4,
                                    'post_status'  => 'publish',
                                    'category_name' => 'news',
                                ) );
                                foreach ( $more_posts as $post ) :
                                ?>
                                    <li><a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>" title="<?php echo esc_attr( $post['post_title'] ); ?>"><?php echo esc_html( mb_strlen( $post['post_title'] ) > 17 ? mb_substr( $post['post_title'], 0, 17 ) . '...' : $post['post_title'] ); ?></a></li>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="f_contact-1 fr">
                    <div class="title">公司简介<span class="en">ABOUT US</span></div>
                    <div class="text">
                        <p>凯瑞尔电子材料（湖北省）有限公司坐落于湖北省大冶市高新科技园区，是一家专注于电子元器件包装领域、集载带、盖带、胶盘研发生产与智能包装设备自主制造于一体的技术整合型企业。公司拥有20年包装行业深厚技术积淀，致力于为客户提供从耗材到设备、从工艺到品质的电子包装全链条解决方案。</p>


                    </div>
                </div>
            </div>

            <?php endif; ?>
<div class="copyright">
    <p style="text-align: center; margin-bottom: 8px;">
        <span style="font-weight:bold;">友情链接：</span>
        <a href="https://302496647.b2b.11467.com/" target="_blank" rel="noopener">凯瑞尔电子材料 顺企网商铺</a>
    </p>
    <p style="text-align: center;">版权所有&#169;<?php echo esc_html( date( 'Y' ) ); ?> 凯瑞尔电子材料有限公司 &nbsp;<a href="https://beian.miit.gov.cn" target="_blank">鄂ICP备2026017039号-2</a> </p>
</div>
        </div>
    </div>

<?php wp_footer(); ?>


</body>
</html>
