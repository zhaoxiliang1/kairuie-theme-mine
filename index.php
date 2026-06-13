<?php
/**
 * Template: 首页
 *
 * @package mine
 */

get_header();
?>

<div class="i-main">
    <div class="i-banner swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/uploads/banner1.jpg" alt="载带解决方案"></a></div>
            <div class="swiper-slide"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/uploads/banner2.jpg" alt="胶盘解决方案"></a></div>
            <div class="swiper-slide"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/uploads/banner3.jpg" alt="盖带解决方案"></a></div>
            <div class="swiper-slide"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/uploads/banner4.jpg" alt="电子包装设备解决方案"></a></div>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div class="m-ban">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/uploads/banner1.jpg" alt="载带解决方案"></a></div>
                <div class="swiper-slide"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/uploads/banner2.jpg" alt="胶盘解决方案"></a></div>
                <div class="swiper-slide"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/uploads/banner3.jpg" alt="盖带解决方案"></a></div>
                <div class="swiper-slide"><a href=""><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/uploads/banner4.jpg" alt="电子包装设备解决方案"></a></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="i-pro">
        <div class="i-pro-tit">凯瑞尔服务</div>
        <div class="wrap">
            <ul>
                <li><a href="/category/products/载带/">
                        <div class="tit">载带</div>
                        <div class="pic"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/bg190x215.png" class="img1"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/zd.jpg" alt="载带介绍" class="img2"></div>
                    </a></li>
                <li><a href="/category/products/胶盘/">
                        <div class="tit">胶盘</div>
                        <div class="pic"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/bg190x215.png" class="img1"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/jp.jpg" alt="胶盘介绍" class="img2"></div>
                    </a></li>
                <li><a href="/category/products/盖带/">
                        <div class="tit">盖带</div>
                        <div class="pic"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/bg190x215.png" class="img1"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/gd.jpg" alt="盖带介绍" class="img2"></div>
                    </a></li>
                <li><a href="/category/products/电子包装设备/">
                        <div class="tit">电子包装设备</div>
                        <div class="pic"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/bg190x215.png" class="img1"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/dzbz.jpg" alt="电子包装设备介绍" class="img2"></div>
                    </a></li>
            </ul>
        </div>
    </div>
</div>
<div id="fbdseodivhhh">
</div>
<script>
document.getElementById('fbdseodivhhh').style.display = "none";
</script>

<?php get_footer(); ?>

<script>
window.addEventListener('load', function() {
    new Swiper('.i-banner', {
        loop: true,
        speed: 1000,
        slidesPerView: 1,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.i-banner .swiper-button-next',
            prevEl: '.i-banner .swiper-button-prev',
        },
    });
    new Swiper('.m-ban .swiper-container', {
        loop: true,
        speed: 1000,
        slidesPerView: 1,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.m-ban .swiper-pagination',
            clickable: true,
        },
    });
});
</script>