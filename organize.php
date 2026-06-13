<?php
/**
 * Template Name: 组织架构
 *
 * @package mine
 */

get_header();
?>

<div class="location">
    <div class="wrap clearfix"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">首页</a>
        <span></span><a href="<?php echo esc_url( home_url( '/' ) ); ?>about">关于我们</a>
        <span></span><a href="javascript:;" class="col01">组织架构</a>
    </div>
</div>
<div class="nbanner nbanner1">
    <video class="c-v2" width="100%" playsinline="" x5-video-player-type="h5" x-webkit-airplay="" webkit-playsinline="" x5-playsinline="" x5-video-orientation="portrait" muted="" autoplay="" preload="auto" loop="loop" src="https://www.betpak.com.cn/uploads/video/aboutbannervideo.mp4">
        <source src="https://www.betpak.com.cn/uploads/video/aboutbannervideo.mp4" type="video/mp4" />
    </video>
</div>
<div class="nav nav4">
    <div class="wrap">
        <ul class="clearfix">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>about" class="">企业简介</a><i></i></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>culture" class="">企业文化</a><i></i></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>organize" class="cur">组织架构</a><i></i></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>honor" class="">资质荣誉</a><i></i></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="wrap">
        <div class="content">
            <img src="https://www.betpak.com.cn/uploads/images/20260303/bf0ed3b0ffdfa09fe1979b7a6117896f.jpg" alt="" />
<p style="text-align:center;">
    <br />
</p>        </div>
    </div>
</div>

<?php get_footer(); ?>

<script>
$("video").each(function () {
  $(this).attr(
    "poster",
    $(this).attr("src") +
      "?x-oss-process=video/snapshot,t_2000,f_jpg,w_400,h_350"
  );
  $(this).attr("src", $(this).attr("src") + "#t=0.1");
  $(this).attr("preload", "metadata");
});

var $videos = document.querySelectorAll("video[autoplay][muted]");

function isWeChatBrowser() {
  return /MicroMessenger/i.test(navigator.userAgent);
}
function isAndroidWeChat() {
  const ua = navigator.userAgent;
  return /MicroMessenger/i.test(ua) && /Android/i.test(ua);
}

if ($videos.length > 0) {
  for (var i = 0; i < $videos.length; i++) {
    (function ($video) {
      $video.addEventListener("canplaythrough", function (e) {
        if (this.paused) {
          this.play();
        }
      });

      if (isAndroidWeChat()) {
        var promise = $video.play();
        if (promise !== undefined) {
          promise.catch((error) => {
            $video.muted = true;
            $video.play();
            $video.controls = true;
          });
        }
      }

      if (isWeChatBrowser()) {
        document.addEventListener("WeixinJSBridgeReady", function () {
          $video.play().catch((e) => {
            $video.muted = true;
            $video.play();
          });
        });
      } else {
        $video.play().catch((e) => {
          $video.muted = true;
          $video.play();
        });
      }
    })($videos[i]);
  }
}
</script>
