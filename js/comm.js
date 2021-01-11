//프레임 컨트롤
function iframeLoadFn(obj){
	if($(obj).attr("src").indexOf('ddnayo.com')>0 || $(obj).attr("src")=="")return;
	if($(obj).attr("src").indexOf('/inner/reservation/')>-1 ){
		$(obj).contents().find("p.b_title").css({"display":"none"})
		//상하 여백 없애기
		$(obj).contents().find("#contents-box").css({"padding":"0px","margin":"0","width":"750px"})
		$(obj).contents().find("#contents-box .section-div").css({"width":"100%"})
		$(obj).contents().find("p.b_title").css({"margin-top":"0px"})
	}else if($(obj).attr("src").indexOf('/inner/traffic/')>-1 ){
		$(obj).contents().find("#title-image,ul.traffic_sub_list").css({"display":"none"})
		$(obj).contents().find("img[src^='/web/images/tlt_traffic_name']").parent().css({"display":"none"})
		$(obj).contents().find("p:last").remove()
		//위쪽 여백 없애기
		$(obj).contents().find("#contents-box").css({"padding-top":"20px","padding-bottom":"20px"})
		$(obj).contents().find("#contents-box").css({"width":"950px","margin":"0"})
		$(obj).contents().find("#contents-box > p:first").css({"margin-bottom":"0px"})
		$(obj).contents().find("#traffic-auto-line").css({"margin-top":"0px","width":"950px"})
		$(obj).contents().find("#traffic-auto-line").css({"font-size":"13px","color":"#666"})
		$(obj).contents().find("#traffic-public-line").css({"margin-top":"0px","width":"920px","margin":"0"})
		$(obj).contents().find("#traffic-public-line").css({"font-size":"13px","color":"#666"})
	}else{
		$(obj).contents().find("ul.comm_sub_list").css({"display":"none"});
		$(obj).contents().find(".top_wrap").css({"display":"none"})
	}

	var hh = obj.contentWindow.document.body.scrollHeight;
	$(obj).height(hh+50);
	//링크타고 왔을때 아래로
	try{
		if(subBtnIdx!=1 && $(obj).attr('firstScroll') != 'set' ){
			eval($(".submenu a:eq("+(subBtnIdx-1)+")").attr('onclick'));
			$(obj).attr('firstScroll','set');
		}
	}catch(e){}
	$(window).resize()
}
