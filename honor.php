<?php
/**
 * Template Name: 资质荣誉
 *
 * @package mine
 */

get_header();
?>

<div class="location">
    <div class="wrap clearfix"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">首页</a>
        <span></span><a href="<?php echo esc_url( home_url( '/' ) ); ?>about">关于我们</a>
        <span></span><a href="javascript:" class="col01">资质荣誉</a>
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
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>organize" class="">组织架构</a><i></i></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>honor" class="cur">资质荣誉</a><i></i></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="wrap">
        <div class="content">
            <div class="honorlist">
                <ul class="clearfix">
                    <li><img src="https://www.betpak.com.cn/uploads/images/20250731/10c7ceb9712b09894971ea0c3edd0a45.png">
                        <p>专精特新</p>
                    </li>
                    <li><img src="https://www.betpak.com.cn/uploads/images/20260430/30d78c40156467e73a87f223de68eaad.jpg">
                        <p>高企证书</p>
                    </li>
                    <li><img src="https://www.betpak.com.cn/uploads/images/20250731/1e774ffed41b19cbc4f9fc4277d1faa2.png">
                        <p>ISO 9001</p>
                    </li>
                    <li><img src="https://www.betpak.com.cn/uploads/images/20250731/48d523a77a846bb2a7f02041c27b3291.png">
                        <p>ISO 14001</p>
                    </li>
                    <li><img src="https://www.betpak.com.cn/uploads/images/20260318/286a673c51d0296422d7e44a69a143aa.jpg">
                        <p>十级无尘室证书</p>
                    </li>
                    <li><img src="https://www.betpak.com.cn/uploads/images/20260318/d6e2f6bb284d01b3f17fc44f50f6a4d7.jpg">
                        <p>千级无尘室证书</p>
                    </li>
                </ul>
            </div>
            <div class="pages" align="center">
            </div>
        </div>
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
