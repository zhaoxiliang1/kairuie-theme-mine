jQuery(function($){
		//  LINKS
		$(".lang").hover(function(){
			$(this).find(".lang-select").stop().slideDown(300);
			$(this).find(".icon").addClass("cur")
		}, function(){
			$(this).find(".lang-select").stop().slideUp(300)
			$(this).find(".icon").removeClass("cur")
		});
		$(".menu li").hover(function(){
			$(this).children(".sub").stop().slideDown();
			$(this).children(".menu_a").addClass("cur");
		},function(){
			$(this).children(".sub").stop().slideUp();
			$(this).children(".menu_a").removeClass("cur");
		});
		$('.m-btn').click(function(){
			$('.m-menu').slideToggle();
			$(this).toggleClass('open-menu');
		});
		// Mobile menu: click + icon to toggle submenu
		$('.m-menu li>a').click(function(e){
			var _this = $(this);
			var $sub = _this.siblings('.sub').length ? _this.siblings('.sub') : _this.next('.sub');
			// Click on the <i> toggle icon: expand/collapse submenu
			if ($(e.target).is('i')) {
				e.preventDefault();
				if (_this.hasClass('cur')) {
					_this.removeClass('cur');
					$sub.slideUp();
				} else {
					_this.addClass('cur');
					_this.parent('li').siblings('li').children('a').removeClass('cur').next('.sub').slideUp();
					_this.parent('li').siblings('li').children('a').siblings('.sub').slideUp();
					$sub.slideDown();
				}
				return;
			}
			// Fallback for javascript: links (no real href)
			if (_this.attr('href') === 'javascript:') {
				e.preventDefault();
				if (_this.hasClass('cur')) {
					_this.removeClass('cur');
					$sub.slideUp();
				} else {
					_this.addClass('cur');
					_this.parent('li').siblings('li').children('a').removeClass('cur').next('.sub').slideUp();
					_this.parent('li').siblings('li').children('a').siblings('.sub').slideUp();
					$sub.slideDown();
				}
			}
		});

		// nav收缩展开
		$('.pro-category-ul .secnav').on('click',function(){
			if ($(this).next().css('display') == "none") {
				$('.pro-category-ul li').children('ul').slideUp(300);
				$(this).next('ul').slideDown(300);
				$(this).parent('li').addClass('active').siblings('li').removeClass('active');
			}else{
				$(this).next('ul').slideUp(300);
				$('.pro-category-ul>li.active').removeClass('active');
			}
		});
		$('.search_m').click(function(){
			$('.search_m_form').fadeIn();
		});
		$('.search_m .closed').click(function(){
			$('.search_m_form').hide();
		});
		$('.preview-video .closed, .gallery-thumbs').click(function(){
			$('.preview-video').hide();
		});
		$('.video-btn').click(function(){
			$('.preview-video').show();
		});

		$('.prodetail-list a').on('click',function(){
			var obj   = $(this),
				paren = obj.parents('.prodetail');
			var index=$(this).index();
			$(this).addClass('active').siblings().removeClass('active');
			paren.find('.prodetail-con-hd').removeClass('active');
			paren.find('.prodetail-con-hd').eq(index).addClass('active');
		});

		$(window).scroll(function() {
			if($(window).scrollTop()>=600){
				$("#toTop").fadeIn();
			}else{
				$("#toTop").fadeOut();
			}
			if($(window).scrollTop()>=100){
				$('.m-footer').addClass('show')
			}else{
				$('.m-footer').removeClass('show')
			}
		});

		$("#toTop").click(function () {
			var speed=300;
			$('body,html').animate({ scrollTop: 0 }, speed);
			return false;
		});

		$('a[href*=#],area[href*=#]').click(function() {
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var $target = $(this.hash);
				$target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
				if ($target.length) {
					var targetOffset = $target.offset().top;
					$('html,body').animate({
						scrollTop: targetOffset-70
					},
					1000);
					return false;
				}
			}
		});
	});
