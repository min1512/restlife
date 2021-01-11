//팝업들
function linkPopup(param) {

	var url = "" ;
	var myname = "pspopup" ;
    var w = "400" ;
    var h = "300" ;
    var scroll = "yes" ;

	if(param == "bizno") {
		// 통신판매업 확인 745 X 656
		w = "745" ;
		h = "656" ;
		url = "http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no="+ biz_no ;
		scroll = "yes" ;
	}
	else if(param == "auth") {
		// 저작권 470 X 360
		w = "470" ;
		h = "360" ;
		url = "http://www.einet.co.kr/copyright.html" ;
		scroll = "yes" ;

	}
	else if(param == "rule") {
		// 개인정보 취급방침 600 X 450
		w = "600" ;
		h = "450" ;
		scroll = "yes" ;
		url = "http://www.einet.co.kr/privacy.html" ;
	}
    else if(param == "internet_rule") {
            // 이용약관 800 X 600
             w = "800" ;
             h = "600" ;
             scroll = "yes" ;
             url = "http://www2.einet.kr/internet_rule.html?biz_code="+pension_code;
    }
	else if(param == "admin") {
		window.open(encodeURI('http://einet.galtime.kr/super/client/index.html?biz_code='+pension_code + '&biz_name=' + biz_name))
		return;
		// 관리자로그인
		$('#admForm').one("submit", function(){
                window.open("","pop_admin","");
                this.action="http://www.einet.kr/adm/index.jsp";
                this.method="POST";
                this.target="pop_admin";
        }).trigger("submit");

		return ;
	}
	else if(param == "inet") {
		// 아이넷홈페이지
		url = "http://www.einet.co.kr/" ;
		window.open(url) ;
		return ;

	}

	var winl = (screen.width - w) / 2 ;
    var wint = (screen.height - h) / 2 ;
    winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll ;
    win = window.open(url, myname, winprops) ;

    if (parseInt(navigator.appVersion) >= 4) {
		win.window.focus() ;
	}

}
//아작스 가져오는 함수
function get_ajax(){
	var page = arguments[0];
	var gubun = arguments[1];
	var return_val;
	return_val = $.ajax({
		type: "POST",
		url:page,
		data:{
			"gubun":gubun
		},
		async: false,cache : false
	}).responseText;

	return return_val;
}
//슬라이더 px
function sliderCustom(idx,obj,cell,wrapW,once,max,inet_complet){
	//var obj = $('#rooms ul li:first');//움직일 ul이나 li
	//var cell = 280;//최소 움직일 넓이(보통 li);
	//var wrapW = $(window).width()-220;//슬라이더의 영역;
	//var once = Math.floor(wrapW/cell)*cell;//한번에 움직일 넓이;
	//var max = $('#rooms ul li').length*cell - wrapW;//요소의 총 넓이;
	//var inet_complet = null;//모션 실행후 호출할 함수, 없으면 null;

	var nowPx = obj.css("margin-left").replace("px","")*-1;
	var goIdx = nowPx*-1;
	if(obj.is(":animated"))return false;
	if(idx=='D'){
		if(nowPx>=max){
			return max;
		}else if(nowPx+once>max){
			obj.animate({"margin-left":max*-1+"px"},500,inet_complet);
			goIdx = max;
		}else{
			obj.animate({"margin-left":"-="+once+"px"},500,inet_complet);
			goIdx = goIdx-once;
		}
	}else if(idx=='U'){
		if(obj.css("margin-left")=="0px"){
			return 0;
		}else if(nowPx-once<0){
			obj.animate({"margin-left":"0px"},500,inet_complet)
			goIdx = 0;
		}else{
			obj.animate({"margin-left":"+="+once+"px"},500,inet_complet)
			goIdx = goIdx+once;
		}
	}else{
		obj.animate({"margin-left":(cell*idx)*-1+"px"},500,inet_complet)
		goIdx = (cell*idx)/cell+1;
	}
	return goIdx;
}
//슬라이더 %
function sliderCustomPer(obj,idx,per,allPg,inet_complet){
	//var obj = 움직일li
	//var idx = 방향
	//var per = 한번에 움직일 %
	//var allPg = 총 페이지수

	obj = $(obj);
	if(obj.is(":animated"))return;
	var len = obj.get(0).style.marginLeft
	len = len.replace("px","").replace("%","")*1;
	if(idx=="R"){
		if(-len/per>=Math.ceil(allPg)-1)return false;
		len -= per;
	}else if(idx=="L"){
		if(len>=0)return false;
		len += per;
	}else{
		len = idx*-per;
	}
	obj.stop().animate({"margin-left":len+"%"},250,inet_complet);
	return Math.ceil((len/-per).toFixed(2))+1;
}
//0붙이기
function zeroId(idx){
	var zoroIdx = ("00"+idx).split('');
	zoroIdx =  zoroIdx[zoroIdx.length-2]+zoroIdx[zoroIdx.length-1];
	return zoroIdx;
}
//슬라이더 재생정지
function sliderCansle(timer,obj,state){
	/*
	if(arguments.length==0){
		return (document.cookie).indexOf("sliderPlayNstop=STOP")>0 ? false : true;
	}
	btn = $(btn);
	if(btn.hasClass('STOP')){
		document.cookie = "sliderPlayNstop" + "=" + escape( "PLAY" ) + "; path=/;"
		clearTimeout(timer); 
		timer = null;
		obj.btnScroll('D');
		btn.removeClass("STOP");
	}else{
		document.cookie = "sliderPlayNstop" + "=" + escape( "STOP" ) + "; path=/;"
		clearTimeout(timer); 
		timer = 'stop';
		btn.addClass("STOP");
	}
	*/
	if(state=='play'){
		$('.playNstop').addClass('STOP');
		clearTimeout(timer); 
		timer = null;
		obj.btnScroll('D');
	}else{
		$('.playNstop').removeClass('STOP');

		clearTimeout(timer); 
		timer = 'stop';
	}
}
//우클릭금지 document.oncontextmenu = function (e) {	return false; }
//html5 안되면 풀페이지 버튼 없애기
function fullpage(){
	if(!parent.canvascheck)$(".fullscreen_btn").css({"display":"none"});
	$(".fullscreen_btn").click(function(){
		if(parent.fullscreen_state==false){
			parent.launchFullscreen();
			$(".fullscreen_btn").addClass("FULL")
		}else{
			parent.exitFullscreen();
			$(".fullscreen_btn").removeClass("FULL")
		}
	});
	if(parent.fullscreen_state) $(".fullscreen_btn").addClass("FULL");
};

$(document).ready(function(){
	fullpage();
	if($(".cpage:visible").length<=0) $(".cpage:first").css("display","block");
});

$(document).ready(function() {
	$('img.data-over').hover (
		function() {
			var src		= $(this).attr('src');
			var string	= src.substr(src.length-4, 4);
			src = src.replace(string, "_ov" + string);
			$(this).attr('src', src);
		},
		function(){
			var src		= $(this).attr('src');
			var string	= src.substr(src.length-4, 4);
			src = src.replace("_ov" + string, string);
			$(this).attr('src', src);
		}
	);

	// 롤링 플레이 스탑 제어하기..
	$('.playNstop').on('click', function() {
        var has = $(this).hasClass('STOP');

        if (has) {
            $(this).removeClass('STOP');
            sliderCansle(sliderObj_Timer,sliderObj,'stop');
        } else {
            sliderCansle(sliderObj_Timer,sliderObj,'play')
        }

    });

	$("a[href='#']").on('click', function ($) {
        $.preventDefault();
    });
});

// 앵커 이동
function fnMove(id){
    var offset = $("#" + id).offset();
    $('html, body').animate({scrollTop : offset.top}, 600);
}

function pad(n, width) {
  	n = n + '';
  	return n.length >= width ? n : new Array(width - n.length + 1).join('0') + n;
}