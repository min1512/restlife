<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>


	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/firstSlider.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/main1.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/main2.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/owl/owl.carousel.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">

	<title>Rest Life</title>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script src="http://www.restlife.shop/lsm/js/owl/owl.carousel.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
	<script>
		$(function () {
			view_text = $('#view_text');
			swiper_container = $('#swiper_container');
			contents_inner = $('#contents_inner');
			contents_inner.addClass('hide');

			view_text.click(function (){
				scrollPostion = $('#view_text').offset();
				swiper_container.toggle(
						function (){swiper_container.addClass('hide')},
						function (){swiper_container.addClass('show')}
				)
				contents_inner.toggle(
						function (){contents_inner.addClass('show')},
						function (){contents_inner.addClass('hide')}
				)
				$('html').animate({
					scrollTop : scrollPostion.top
				},400);
			});

		});
	</script>

</head>



<div class="all_wrap">

	<!-- main2 -->
	<div class="cpage main2" id="main2">
		<div class="loader tImg" style="background-image: url(lsm/img/travel/airplane.jpg);"></div>
		<div class="sub_title">
			<div class="eng TRAN">VIEWS</div>
			<div class="txt TRAN">남들과 차원이 다르고 <span>효율적이고 가치있는 휴식을 취하세요.</span></div>
			<a class="btn_sub" href="http://www.restlife.shop/Cafe/write">글쓰기 <i class="fa fa-caret-right"></i></a>
		</div>
		<div class="sub_title">
			<a class="btn_sub" href="#" id="view_text"><i class="fas fa-layer-group"></i></a>
		</div>


		<div class="swiper-container" id="contents_inner">
			<div class="swiper-wrapper">
				<?php foreach ($img_get as $k => $v) {
					foreach ($v as $k2 => $v2) {
						if($k2 == 'dir'){
							if($v2=='cafe'){
								?>
								<div class="swiper-slide">
									<a href="./Cafe/lists/<?= $img_get[$k]['index'] ?>"><img width="300px;" height="500px;" src="lsm/img/<?=$img_get[$k]['dir']?>/<?=$img_get[$k]['jpg_name']?>"></a>
								</div>
								<?php
							}
						}
					}
				}
				?>
			</div>

			<!-- 네비게이션 버튼 -->
			<div class="swiper-button-next"></div><!-- 다음 버튼 (오른쪽에 있는 버튼) -->
			<div class="swiper-button-prev"></div><!-- 이전 버튼 -->

			<!-- 페이징 -->
			<div class="swiper-pagination"></div>
		</div>


	</div>
	<div class="contents_inner" id="swiper_container">
		<div class="weekely_best">
			<h4 class="title_style">WEEKELY BEST</h4>
			<div class="basic_goods_list">
				<ul class="goods_list">
					<?php foreach ($img_get as $k =>$v) {
						foreach ($v as $k2 =>$v2){
							if($k2 == 'dir'){
								if($v2 == 'cafe'){
									?>
									<li class="goods_item">
										<div class="img">
											<a href="./Foods/lists/<?= $img_get[$k]['index'] ?>" class="img_link">
												<?php if(!empty($img_get[$k]['jpg_name'])) { ?>
													<img src="lsm/img/<?=$img_get[$k]['dir']?>/<?=$img_get[$k]['jpg_name']?>" alt>
												<?php }else if(!empty($img_get[$k]['jpg_src'])){ ?>
													<img src="<?=$img_get[$k]['jpg_src']?>">
												<?php }else{ ?>
													<img src="#">
												<?php } ?>
											</a>
											<div class="tag_wrap"></div>
										</div>
										<a href="#" class="goods_item_link">
											<span class="brand"><?= $img_get[$k]['title_name'] ?></span>
											<span class="name"><?= $img_get[$k]['title'] ?></span>
											<span class="price">
									<?= $img_get[$k]['reg_date'] ?>
<!--									<span class="dc_price">-->
												<!--										<s class="del_price">--><?//= number_format($shopping_list[$k]['price']) ?><!--</s>-->
												<!--										(--><?//= number_format($shopping_list[$k]['del_price_percent']) ?><!--%-->
												<!--										<span class="spr-common spr_ico_arrow_down"></span>-->
												<!--										)-->
												<!--									</span>-->
								</span>
											<!--								<span class="icon_block">-->
											<!--									<span class="spr-common spr_ico_coupon"></span>-->
											<!--								</span>-->
										</a>
									</li>
									<?php
								}
							}
						}
					}
					?>
				</ul>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function (){
			//slider random init
			function return_index(){
				var r_index = Math.floor(Math.random() * ( $('div .swiper-container .swiper-slide').length) );
				return parseInt(r_index);
			}
			new Swiper('.swiper-container', {
				lazy:{
					loadPrevNext : true //이전,다음 이미지는 미리 로딩
				},
				pagination : { // 페이징 설정
					el : '.swiper-pagination',
					clickable : true, // 페이징을 클릭하면 해당 영역으로 이동, 필요시 지정해 줘야 기능 작동
				},
				navigation : { // 네비게이션 설정
					nextEl : '.swiper-button-next', // 다음 버튼 클래스명
					prevEl : '.swiper-button-prev', // 이번 버튼 클래스명
				},
				initialSlide : return_index()
			});
		})
	</script>

</div>


