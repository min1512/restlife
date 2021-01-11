/* made by KimEunJi in INET*/
//배열을 만듬
var motionArray = new Array();
motionArray[0] = new Array("PL"		,"1","2");//가로 2쪽
motionArray[1] = new Array("PU"		,"2","1");//세로 2쪽
motionArray[2] = new Array("HR"		,"1","5");//가로 좌측에
motionArray[3] = new Array("HL"		,"1","5");//가로 우측에
motionArray[4] = new Array("UL"		,"7","1");//세로 좌측아래
motionArray[5] = new Array("UR"		,"7","1");//세로 우측아래
motionArray[6] = new Array("UC"		,"7","1");//세로 중앙아래
motionArray[7] = new Array("UO"		,"7","1");//세로 외곽아래
motionArray[8] = new Array("DL"		,"7","1");//세로 상단위
motionArray[9] = new Array("DR"		,"7","1");//세로 좌측위
motionArray[10] = new Array("DC"	,"7","1");//세로 중앙위
motionArray[11] = new Array("DO"	,"7","1");//세로 외곽위
motionArray[12] = new Array("CellLT","7","5");//조각 좌측위
motionArray[13] = new Array("CellLB","7","5");//조각 좌측아래
motionArray[14] = new Array("CellRT","7","5");//조각 우측위
motionArray[15] = new Array("CellRB","7","5");//조각 좌측아래
motionArray[16] = new Array("Random","7","5");//랜덤 조각
//걍..랜덤으로 모션 넣고플때씀
function motionMake(obj){
	var ran = Math.floor(Math.random()*motionArray.length);
	obj.attr({
		"motion":motionArray[ran][0]
		,"Call":motionArray[ran][1]
		,"Rall":motionArray[ran][2]
	})
}
//모션을 적용시켜줌
function photoMotion(){
	var Obj = arguments[0];
	var MC = Obj.attr('motion');
	var Call = Obj.attr('Call')*1;
	var Rall = Obj.attr('Rall')*1;
	var i; var j; var time; var css;
	Obj.empty().attr("class",'').addClass("photoMC").addClass(MC);
	for(i = 0;i<Rall;i++){//세로
		for(j = 0;j<Call;j++){//가로
			switch(MC){//모션 설정
				case "PL"://Call='1' Rall='2'
					if(i==0){
						css = "transform-style: preserve-3d;transform-origin: 0% 50% ; transform:perspective( 1600px ) rotateY(90deg)"
					}else{
						css = "transform-style: preserve-3d;transform-origin: 100% 50% ; transform:perspective( 1600px ) rotateY(-90deg)"
					}
					time = 0
				break;
				case "PU"://Call='2' Rall='1'
					if(j==0){
						css = "transform-style: preserve-3d;transform-origin: 50% 0% ; transform:perspective( 1600px ) rotateX(-90deg)"
					}else{
						css = "transform-style: preserve-3d;transform-origin: 50% 100% ; transform:perspective( 1600px ) rotateX(90deg)"
					}
					time = 0
				break;
				case "HR":
					css = "transform:translateX(-100%)"
					time = i
					time = time*0.05
				break;
				case "HL":
					css = "transform:translateX(100%)"
					time = i
					time = time*0.05
				break;
				case "UL":
					css = "transform:translateY(100%)"
					time = j
					time = time*0.05
				break;
				case "UR":
					css = "transform:translateY(100%)"
					time = Call-j
					time = time*0.05
				break;
				case "UC":
					css = "transform:translateY(100%)"
					time = Math.abs((Call/2)-j)
					time = time*0.05
				break;
				case "UO":
					css = "transform:translateY(100%)"
					time = Math.abs(Math.abs(j-(Call/2))-Call/2)
					time = time*0.05
				break;
				case "DL":
					css = "transform:translateY(-100%)"
					time = j
					time = time*0.05
				break;
				case "DR":
					css = "transform:translateY(-100%)"
					time = Call-j
					time = time*0.05
				break;
				case "DC":
					css = "transform:translateY(-100%)"
					time = Math.abs((Call/2)-j)
					time = time*0.05
				break;
				case "DO":
					css = "transform:translateY(-100%)"
					time = Math.abs(Math.abs(j-(Call/2))-Call/2)
					time = time*0.05
				break;
				case "Random":
					css = "opacity:0;"
					time = Math.floor(Math.random()*20)
					time = time*0.05
				break;
				case "CellLT":
					css = "transform:scale(0.5);opacity:0;"
					time = (i*0.5)+j;
					time = time*0.05
				break;
				case "CellLB":
					css = "transform:scale(0.5);opacity:0;"
					time = j-(i*0.5);
					time = time*0.05
				break;
				case "CellRT":
					css = "transform:scale(0.5);opacity:0;"
					time = (Call-j)+(i*0.5);
					time = time*0.05
				break;
				case "CellRB":
					css = "transform:scale(0.5);opacity:0;"
					time = (Call-j)-(i*0.5);
					time = time*0.05
				break;
			}
			//칸만들기
			Obj.append('<li style="'+css+';transition-delay:'+time+'s;width:'+(100/Call)+'%;height:'+(100/Rall)+'%;"><p style="width:'+Call+'00%;height:'+Rall+'00%;left:-'+j+'00%;top:-'+i+'00%"></p></li>');
		}
	}
	Obj.clearQueue().delay(100).queue(function(){//모션 시작
		$(this).find('li').addClass("MOVE")
	});
}