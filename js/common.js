$.urlParam = function(name){
	var results = new RegExp('[\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
	if (results==null){
		return null;
	}
	else{
		return results[1] || 0;
	}
}

var scMCobj = {
	ca1bottom:new Array({
		sel:"#lImg"
		,sCss:{transform:"translateX(-34px)"}
		,eCss:{transform:"translateX(0)"}
	},{
		sel:"#rImg"
		,sCss:{transform:"translateX(34px)"}
		,eCss:{transform:"translateX(0)"}
	})
};

var scrollObjANI = {};
var scrollObj;

var leadingZeros = function (date, num) {
	var zero = '';
 	date = date.toString();

 	if (date.length < num) {
  	for (i = 0; i < num - date.length; i++)
   		zero += '0';
 	}
 	return zero + date;
}

function playIconSet(k) {
	if( k == 'play') {
		$('#icon-play').addClass('active');
		$('#icon-pause').removeClass('active');
	}
	else if(k == 'pause') {
		$('#icon-play').removeClass('active');
		$('#icon-pause').addClass('active');
	}
}

//vimeo
var revapi = null ;
var sliderAuto = null ;
var is_play = true ;

/* 전체보기 */
$(document).on('click','.icon_fullscreen',function(e) {
	if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
		$('#icon-full').hide();
		$('#icon-normal').show();

		if (document.documentElement.requestFullscreen) {
			document.documentElement.requestFullscreen();
		} else if (document.documentElement.msRequestFullscreen) {
			document.documentElement.msRequestFullscreen();
		} else if (document.documentElement.webkitRequestFullscreen) {
			document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
		}
	} else {
		$('#icon-normal').hide();
		$('#icon-full').show();

		if (document.exitFullscreen) {
			document.exitFullscreen();
		}
		else if (document.msExitFullscreen) {
			document.msExitFullscreen();
		}
		else if (document.webkitExitFullscreen) {
			document.webkitExitFullscreen();
		}
	}	
});

$(document).ready(function() {

	// gnb_menu 자동 계산
	function resize_gnb() {
		var $logo_width = $('.logo').width();
		var $quick_width = $('.quick_menu').width();
		var $window_width = $(window).width();  // 17 = 스크롤바 넓이

		//$ww = $window_width - $logo_width - $quick_width - 100; // 100 = 좌우 마진
		//$('.gnb_menu').css('max-width', $ww).css('margin-left', $logo_width+100+'px');
	}

	$(window).resize(function() {
		if($(window).width() > 1400) {
			resize_gnb();
		}else {
			$('.gnb_menu').css('max-width', '100%');
		}

		// 슬라이드 bullet 조절
		if($(window).width() < 500) {
			if($('.firstSliderWrap .owl-item').not('.firstSliderWrap .owl-item .cloned').length > 12) {
				$('.firstSliderWrap .owl-dots').hide();
				$('.firstSliderWrap .pageObj').show();
			}
		}else {
			$('.firstSliderWrap .owl-dots').show();
			$('.firstSliderWrap .pageObj').hide();
		}

	});

	$(window).scroll(function(){
		if($(window).scrollTop()>80){
			$('.navigation').addClass('naviFix');
			/*$('.header').css('height', '90px');
			$('#web-logo').fadeOut(200);
			$('#web-logo-top').fadeIn(200);*/
		}else {
			$('.navigation').removeClass('naviFix');
			/*$('.header').css('height', '157px');
			$('#web-logo').fadeIn(200);
			$('#web-logo-top').fadeOut(200);*/
		}

		if($(window).scrollTop() > $('.header').height()+50) {
			$('.scrollTop').addClass('active');
		}else {
			$('.scrollTop').removeClass('active');
		}
	});

	$('#menu_open').click(function() {
		if($(this).hasClass('is-active')) {
			$(this).removeClass('is-active');
			$('.gnb_menu_mobile_inner').removeClass('OPEN');
		}else {
			$(this).addClass('is-active');
			$('.gnb_menu_mobile_inner').addClass('OPEN');
		}
	});

	$('.mobile_menu_sub > li > a').click(function(e) {
		e.preventDefault();
	
		var $li = $(this).parent();	
		var $next_ul = $li.find('> ul');
		
		$('.mobile_menu_sub > li').removeClass('active').find('> ul').stop().slideUp();
		
		if(!$next_ul.is(':visible')){
			$li.addClass('active');
			$next_ul.stop().slideDown();
		}
	});

	// 메인 슬라이드
	var owl = $('.main-slides');
	owl.owlCarousel({
		items:1,
		loop:true,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		pagination: true,
		autoplay:true,
		autoplayTimeout:5000,
		//autoplayHoverPause:true,
		nav:true,
		dots:true,
		navText:["<span class='slideArrow'><img src='http://img.einet.kr/P201805016/responsive/arrowL.png' alt=''></span>", "<span class='slideArrow'><img src='http://img.einet.kr/P201805016/responsive/arrowR.png' alt=''></span>"],
		onInitialized : function(e) {
			var cur = (e.item.index - e.relatedTarget._clones.length / 2) + 1;
			var idx =  leadingZeros(cur, 2);
			var cnt = leadingZeros(e.item.count, 2);

			$('.pageObj .now').text(idx);
			$('.pageObj .all').text(cnt);
		},
		onChanged : function(e) {
			var curr = 1;
			var no = 1;

			$('#firstSlider button.owl-dot').each(function() {
				if($(this).hasClass('active')) {
					curr = no;
					return false;
				}
				no++;
			}) ;
			
			if(curr > 1) {
				$('.sloganWrap').fadeOut();
			}else {
				$('.sloganWrap').fadeIn();
			}

			var idx =  leadingZeros(no, 2);
			$('.pageObj .now').text(idx);
		}
	});

	$(document).on('click','#icon-play',function(e) {
		owl.trigger('play.owl.autoplay',[4000]) ;
		playIconSet('play') ;
	});

	$(document).on('click','#icon-pause',function(e) {
		owl.trigger('stop.owl.autoplay',[4000]) ;
		playIconSet('pause') ;
	});

	$('#icon-play').addClass('active');
	$('#icon-pause').removeClass('active');

	scrollObj = $.parallax({
		 setWrap: window
		,setSel	: "#firstMovie,#firstSliderWrap,#main1,#main2,#main4,#main5,#about1,#about3,#previewTop,#room1,#room4,#fac1,#fac3,#service1,#service2,#travel1,#travel2"
		,getMc	: scMCobj
		,step : function(obj){
			for(var k in obj){
				if(scrollObjANI[obj[k].name]!=true && (obj[k].oP>=0 && obj[k].oP<=1)){
					scrollObjANI[obj[k].name] = true;
					obj[k].obj.addClass("ANI")
				}else if(scrollObjANI[obj[k].name]!=false && (obj[k].oP<0 || obj[k].oP>1)){
					scrollObjANI[obj[k].name] = false;
					obj[k].obj.removeClass("ANI")
				}
			}
		}
	});
	
	scrollObj.setMCall(0);
});

