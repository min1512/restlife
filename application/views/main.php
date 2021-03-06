<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
    //사이트 처음 켰을때 알림 가게 하는거
    window.onload = function () {
        if (window.Notification) {
            Notification.requestPermission();
        }
    }


    setTimeout(function () {
        notify();
    }, 1000);


    function notify() {
        if (Notification.permission !== 'granted') {

        }
        else {
            var notification = new Notification('Notification title', {
                icon: 'http://www.restlife.shop/lsm/img/favicon.ico',
                body: 'RestLife',
            });

            notification.onclick = function () {
                window.open('http://www.restlife.shop');
            };
        }
    }

	$(document).ready(function(){
		var owl = $('.owl-carousel');

		owl.owlCarousel({
			items:3,                 // 한번에 보여줄 아이템 수
			loop:true,               // 반복여부
			margin:35,               // 오른쪽 간격
			autoplay:true,           // 자동재생 여부
			autoplayTimeout:1800,    // 재생간격
			autoplayHoverPause:true  //마우스오버시 멈출지 여부
		});

		$('.customNextBtn').click(function() {
			owl.trigger('next.owl.carousel');
		})

		$('.customPrevBtn').click(function() {
			owl.trigger('prev.owl.carousel', [300]);
		})

		var filter = "win16|win32|win64|mac|macintel";

		if ( navigator.platform ) {
			if ( filter.indexOf( navigator.platform.toLowerCase() ) < 0 ) {
				//mobile

			}
			else {
				//pc

			}
		}


	});

</script>


	<div class="all_wrap">

		<!-- 메인 슬라이드 -->
		<div id="firstSliderWrapmain1_top" class="cpage firstSliderWrap" style="z-index: -1;">
			<div class="firstSlider" id="firstSlider">
				<div class="main-slides owl-carousel">
					<img class="img1" height="770px" src="http://min1512.cafe24.com/lsm/img/rest1.jpg">
					<img class="img2" height="770px" src="http://min1512.cafe24.com/lsm/img/rest2.jpg">
					<img class="img3" height="770px" src="http://min1512.cafe24.com/lsm/img/rest3.jpg">
				</div>
				<div class="sloganWrap">
					<h5 class="main-slogan TRAN">Rest Life</h5>
					<h6 class="main-slogan TRAN">쉬어가는 공간</h6>
				</div>

				<div class="pageObj">
					<span class="now">01</span>
					<span class="all">00</span>
				</div>
			</div>
		</div>


		<!-- main1 -->
		<div class="cpage main1" id="main1">
			<div class="main1_top">
				<div class="sub_title">
					<div class="eng TRAN">Rest Life</div>
					<div class="txt TRAN">
						휴식은 굉장히 중요 합니다.<br>
						공부,운동,이 외 모든것은 한 후에 충분 한 휴식을 가져야 합니다.<br>
						좋은 방법으로 가치있는 휴식을 가지는 것은 중요합니다.<br>
						Rest is valueable<br>
						Growth your life with Rest
					</div>
					<a class="btn_sub" href="#">exterior view <i class="fa fa-caret-right"></i></a>
				</div>
			</div>
			<div class="main1_bottom_wrap">
				<div class="main1_bottom">
					<a href="http://www.restlife.shop/Travel/listAll">
						<div class="icon"><img src="/lsm/img/travel/travel1.png" alt="" height="100px"></div>
						<div class="con_ttl">Travel</div>
						<div class="con_txt">
							대한 민국 명소들 소개가
							<br>준비되어 있습니다.
						</div>
						<div class="btn_view">view more</div>
					</a>
					<a href="http://www.restlife.shop/Foods/listAll">
						<div class="icon"><img src="/lsm/img/food/food1.jpg" alt="" height="100px"></div>
						<div class="con_ttl">Foods</div>
						<div class="con_txt">여행의 묘미 맛집 찾기
							<br>Lest's Go
						</div>
						<div class="btn_view">view more</div>
					</a>
					<a href="http://www.restlife.shop/Photo/listAll">
						<div class="icon"><img src="/lsm/img/photo/photo1.jpg" alt="" height="100px"></div>
						<div class="con_ttl">Photo</div>
						<div class="con_txt">다양한 사진들이 준비
							<br>되어 있습니다.
						</div>
						<div class="btn_view">view more</div>
					</a>
					<a href="http://www.restlife.shop/Cafe/listAll">
						<div class="icon"><img src="/lsm/img/cafe/cafe1.png" alt="" height="100px"></div>
						<div class="con_ttl">Cafe</div>
						<div class="con_txt">분위기 좋고 힐링이 되는
							<br>카페로 준비가 되어 있습니다.
						</div>
						<div class="btn_view">view more</div>
					</a>
				</div>
			</div>
		</div>

		<div class="cpage main3" id="main3">
			<div class="loader tImg" style="background-image: url(lsm/img/rest2.jpg);"></div>
			<div class="sub_title">
				<div class="eng TRAN">WEATHER</div>
				<div class="txt TRAN">오늘 날씨 입니다. <span>좋은 하루 보내세요.</span></div>
				<table class="afternoon-session" cellspacing="1">
					<thead>
						<tr>
							<th scope="row">LOCATION</th>
							<th scope="row">RQ TIME</th>
							<th scope="row">AVG TEMP</th>
							<th scope="row">MAX TEMP</th>
							<td scope="row">MIN TEMP</td>
							<td scope="row">STATE KR</td>
							<td scope="row">STATE EG</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= isset($title)?$title:"" ?></td>
							<td><?= isset($reqDate)?$reqDate:"" ?></td>
							<td class="numeric"><?= isset($temp)?$temp:"" ?></td>
							<td class="numeric"><?= isset($tmx)?$tmx:"" ?></td>
							<td class="numeric"><?= isset($tmn)?$tmn:"" ?></td>
							<td class="numeric"><?= isset($wfKor)?$wfKor:"" ?></td>
							<td class="numeric"><?= isset($wfEn)?$wfEn:"" ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>


		<?php

			$mAgent = array("iPhone","iPod","Android","Blackberry",
				"Opera Mini", "Windows ce", "Nokia", "sony" );
			$chkMobile = false;
			for($i=0; $i<sizeof($mAgent); $i++){
				if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
					$chkMobile = true;
				}
			}
		?>

		<!-- main3 -->
		<div class="cpage main3" id="main3">
			<div class="loader tImg" style="background-image: url(lsm/img/rest1.jpg);"></div>
			<div class="sub_title">
				<div class="eng TRAN">NEWS</div>
				<div class="txt TRAN">오늘의 헤드라인<span>뉴스입니다.</span></div>
<!--				<a class="btn_sub" href="#">view all post <i class="fas fa-caret-right"></i></a>-->
				<?php if($chkMobile != true) { ?>
                <table class="afternoon-sessions" cellspacing="1">
                    <thead>
                    <tr>
                        <th scope="row">Title</th>
                        <th scope="row">Description</th>
                        <th scope="row">PubDate</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($naverNews as $k => $v) {
                            foreach ($v as $k2 => $v2) {
                                if($k2 == 'title'){
                                    $title = $v2;
                                }else if($k2 =='orginalLink'){
                                    $orginalLink = $v2;
                                }else if($k2 =='description'){
                                    $description = $v2;
                                }else if($k2 =='regDate'){
                                    $regDate = $v2;
                                }
                            }
                    ?>
                    <tr>
                        <td><a href="<?= $orginalLink; ?>" style="color: #0b0b0b"><?= isset($title)?$title:"" ?></a></td>
                        <td><a href="<?= $orginalLink; ?>" style="color: #0b0b0b"><?= isset($description)?$description:"" ?></a></td>
                        <td><?= isset($regDate)?$regDate:"" ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
			</div>
		</div>
		<?php } else{ ?>
			<div class="press_edit_news _nudge_wrap _CURATION_CARD">
				<ul class="press_edit_news_list">
					<?php foreach ($naverNews as $k => $v) {
						foreach ($v as $k2 => $v2) {
							if($k2 == 'title'){
								$title = $v2;
							}else if($k2 =='orginalLink'){
								$orginalLink = $v2;
							}else if($k2 =='description'){
								$description = $v2;
							}else if($k2 =='regDate'){
								$regDate = $v2;
							}else if($k2 =='imgUrl'){
								$imgUrl = $v2;
								$imgUrl = isset($imgUrl)?$imgUrl:"https://mimgnews.pstatic.net/image/origin/037/2021/02/20/28752.jpg?type=nf212_140&amp;ut=1613782889000";
							}

						}

						?>
					<li class="press_edit_news_item as_thumb">
						<a href="<?= $orginalLink; ?>" class="press_edit_news_link">
						<span class="press_edit_news_thumb">
							<img src="<?= $imgUrl ?>" width="106" height="70" alt="" onerror="this.src='https://ssl.pstatic.net/static.news/image/news/errorimage/noimage_212x140.png';">
						</span>
						<span class="press_edit_news_text">
							<span class="press_edit_news_title"><?= $title; ?></span>
							<span class="press_edit_news_description"><?= $description; ?></span>
							<span class="r_ico_b r_modify"><b><?= $regDate ?></b></span>
						</span>
						</a>
						<a href="<?= $orginalLink ?>" class="r_ico_b r_cmt">100<span class="r_symbol"><span class="blind">이상</span>+</span></a>
					</li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>

	</div>

	<script>
		new Swiper('.swiper-container', {
			pagination : { // 페이징 설정
				el : '.swiper-pagination',
				clickable : true, // 페이징을 클릭하면 해당 영역으로 이동, 필요시 지정해 줘야 기능 작동
			},
			navigation : { // 네비게이션 설정
				nextEl : '.swiper-button-next', // 다음 버튼 클래스명
				prevEl : '.swiper-button-prev', // 이번 버튼 클래스명
			},
		});

		function addCellHeader(table) {
			if (!table) {
				return false;
			}

			var trs = table.getElementsByTagName('tr');
			var trsChild;
			var grid = {};
			var cells;
			for (var i = 0, cntI = trs.length; i < cntI; i++) {
				if (!grid[i]) {
					grid[i] = {};
				}
				trsChild = trs.item(i).childNodes;
				cells = 0;
				for (var j = 0, cntJ = trsChild.length; j < cntJ; j++) {
					if (trsChild[j].nodeType == 1) {
						grid[i][cells++] = trsChild[j];
					}
				}
			}
			var cellHeader = '';
			for (row in grid) {
				if (row == 0) {
					continue;
				}
				for (cell in grid[row]) {
					cellHeader =  grid[0][cell].innerHTML;
					grid[row][cell].setAttribute('data-cell-header', cellHeader);
				}
			}
		}
		addCellHeader(document.querySelector('.afternoon-session'));
        addCellHeader(document.querySelector('.afternoon-sessions'));
	</script>

