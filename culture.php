<?php
/**
 * Template Name: 企业文化
 *
 * @package mine
 */

get_header();
?>

<div class="location">
    <?php echo mine_breadcrumb(); ?>
</div>
<?php
$banner_video = '';
$mp4_page = get_page_by_path( 'mp4' );
if ( $mp4_page && preg_match( '/\[video[^\]]*mp4="([^"]+)"/', $mp4_page->post_content, $matches ) ) {
    $banner_video = $matches[1];
}
if ( empty( $banner_video ) ) {
    $banner_video = get_template_directory_uri() . '/assets/uploads/aboutbanner.mp4';
}
?>
<div class="nbanner nbanner1" style="position:relative;">
    <video id="banner-video" class="c-v2" width="100%" playsinline="" x5-video-player-type="h5" x-webkit-airplay="" webkit-playsinline="" x5-playsinline="" x5-video-orientation="portrait" muted="" autoplay="" preload="auto" loop="loop" src="<?php echo esc_url( $banner_video ); ?>">
        <source src="<?php echo esc_url( $banner_video ); ?>" type="video/mp4" />
    </video>
    <span id="sound-toggle" style="position:absolute;bottom:20px;right:20px;width:36px;height:36px;background:rgba(0,0,0,0.5);border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:10;">
        <svg id="sound-off" viewBox="0 0 24 24" width="20" height="20" fill="#fff" style="display:none;"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/></svg>
        <svg id="sound-on" viewBox="0 0 24 24" width="20" height="20" fill="#fff"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>
    </span>
</div>
<div class="nav nav4">
    <div class="wrap">
        <ul class="clearfix">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>about" class="">企业简介</a><i></i></li>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>culture" class="cur">企业文化</a><i></i></li>
           
        </ul>
    </div>
</div>
<div class="main">
    <div class="wrap">
        <div class="content">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<script>
var $video = document.getElementById("banner-video");

function isWeChatBrowser() {
  return /MicroMessenger/i.test(navigator.userAgent);
}
function isAndroidWeChat() {
  const ua = navigator.userAgent;
  return /MicroMessenger/i.test(ua) && /Android/i.test(ua);
}

if ($video) {
  var $toggle = document.getElementById("sound-toggle");
  var $soundOff = document.getElementById("sound-off");
  var $soundOn = document.getElementById("sound-on");
  var hasSound = true;

  function updateSoundUI() {
    if (hasSound) {
      $soundOff.style.display = "none";
      $soundOn.style.display = "";
      $video.muted = false;
    } else {
      $soundOff.style.display = "";
      $soundOn.style.display = "none";
      $video.muted = true;
    }
  }

  $toggle.addEventListener("click", function () {
    hasSound = !hasSound;
    updateSoundUI();
  });

  // After autoplay starts (muted), try to unmute for sound
  $video.addEventListener("play", function () {
    if (hasSound) {
      var self = this;
      setTimeout(function () {
        self.muted = false;
      }, 100);
    }
  });

  $video.addEventListener("volumechange", function () {
    if (this.paused && !this.muted) {
      this.muted = true;
      hasSound = false;
      updateSoundUI();
      this.play();
    }
  });

  $video.addEventListener("canplaythrough", function (e) {
    if (this.paused) {
      this.play();
    }
  });

  if (isAndroidWeChat()) {
    var promise = $video.play();
    if (promise !== undefined) {
      promise.catch(function (error) {
        $video.muted = true;
        hasSound = false;
        updateSoundUI();
        $video.play();
        $video.controls = true;
      });
    }
  }

  if (isWeChatBrowser()) {
    document.addEventListener("WeixinJSBridgeReady", function () {
      $video.play().catch(function (e) {
        $video.muted = true;
        hasSound = false;
        updateSoundUI();
        $video.play();
      });
    });
  } else {
    $video.play().catch(function (e) {
      $video.muted = true;
      hasSound = false;
      updateSoundUI();
      $video.play();
    });
  }
}
</script>
