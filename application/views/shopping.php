<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>


	<link rel="stylesheet" href="lsm/css/firstSlider.css">
	<link rel="stylesheet" href="lsm/css/main1.css">
	<link rel="stylesheet" href="lsm/css/main2.css">
	<link rel="stylesheet" href="lsm/css/owl/owl.carousel.css">
	<link rel="stylesheet" href="lsm/css/shopping.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">

	<title>Rest Life</title>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script src="lsm/js/owl/owl.carousel.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>

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


		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ($img_get as $k => $v) {
					foreach ($v as $k2 => $v2) {
						if($k2 == 'dir'){
							if($v2=='shopping'){
								?>
								<div class="swiper-slide">
									<a href="./Shopping/lists/<?= $img_get[$k]['index'] ?>"><img width="300px;" height="500px;" src="lsm/img/<?=$img_get[$k]['dir']?>/<?=$img_get[$k]['jpg_name']?>"></a>
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
<!--		<script src="https://nsp.pay.naver.com/sdk/js/naverpay.min.js"-->
<!--				data-client-id="u86j4ripEt8LRfPGzQ8"-->
<!--				data-mode="production"-->
<!--				data-merchant-user-key="가맹점 사용자 식별키"-->
<!--				data-merchant-pay-key="가맹점 주문 번호"-->
<!--				data-product-name="상품명을 입력하세요"-->
<!--				data-total-pay-amount="1000"-->
<!--				data-tax-scope-amount="1000"-->
<!--				data-tax-ex-scope-amount="0"-->
<!--				data-return-url="사용자 결제 완료 후 결제 결과를 받을 URL">-->
<!--		</script>-->

	</div>

	<div class="contents_inner">
		<div class="shopping_all">
			<h4 class="title_style">THE CHOICE</h4>
			<ul class="cpp_goods_list">
				<li class="cpp_goods_item">
					<a href="#" class="cpp_goods_link">
					<span class="cpp_goods_img">
						<img src="http://www.restlife.shop/lsm/img/shopping/shopping.jpg" alt>
					</span>
						<div class="tag-wrap"></div>
						<span class="cpp_goods_info">
						<em class="brand"></em>
						<span class="name"></span>
						<strong class="price">
							<span class="dc_price">
								<s class="del_price">
								</s>
								<span class="spr-common spr_ico_arrow_down"></span>
							</span>
						</strong>
					</span>
						<span class="cpp_goods_bg"></span>
						<span class="cpp_goods_info_bg" style="background: #000000;"></span>
					</a>
				</li>
			</ul>
		</div>

		<div class="weekely_best">
			<h4 class="title_style">WEEKELY BEST</h4>
			<div class="basic_goods_list">
				<ul class="goods_list">
					<?php foreach ($shopping_list as $k =>$v) { ?>
						<li class="goods_item">
							<div class="img">
								<a href="#" class="img_link">
									<img src="<?= $shopping_list[$k]['img_url'] ?>" alt>
								</a>
								<div class="tag_wrap"></div>
								<!--<ul class="goods_action_menu">
										<li class="goods_action_item">
											<button type="button" class="action_btn" onClick="javaScript:jsGoodsAction('W','','<?=$wrow['GOODS_CD']?>','','');">
												<span class="spr-common spr-heart2"></span>
												<span class="spr-common spr-bgcircle2"></span>
												<span class="button_text">Add wish list</span>
											</button>
										</li>
										<li class="goods_action_item goods_action_sns">
											<button type="button" class="action_btn action_btn__sns">
												<span class="spr-common spr_share"></span>
												<span class="spr-common spr-bgcircle2"></span>
												<span class="button_text">share</span>
											</button>
											<ul class="goods_sns_list">
												<li class="goods_sns_item">
													<button type="button" class="action_btn" onClick="javaScript:jsGoodsAction('S','P','<?=$wrow['GOODS_CD']?>','<?=$wrow['IMG_URL']?>','<?=$wrow['GOODS_NM']?>');">
														<span class="spr-common spr_share_pinter"></span>
														<span class="spr-common spr-bgcircle3"></span>
														<span class="button_text">핀터레스트</span>
													</button>
												</li>
												<li class="goods_sns_item">
													<button type="button" class="action_btn" onClick="javaScript:jsGoodsAction('S','K','<?=$wrow['GOODS_CD']?>','','<?=$wrow['GOODS_NM']?>');">
														<span class="spr-common spr_share_kakao"></span>
														<span class="spr-common spr-bgcircle3"></span>
														<span class="button_text">카카오스토리</span>
													</button>
												</li>
												<li class="goods_sns_item">
													<button type="button" class="action_btn" onClick="javaScript:jsGoodsAction('S','I','','');">
														<span class="spr-common spr_share_insta"></span>
														<span class="spr-common spr-bgcircle3"></span>
														<span class="button_text">인스타</span>
													</button>
												</li>
												<li class="goods_sns_item">
													<button type="button" class="action_btn" onClick="javaScript:jsGoodsAction('S','F','<?=$wrow['GOODS_CD']?>','<?=$wrow['IMG_URL']?>','<?=$wrow['GOODS_NM']?>');">
														<span class="spr-common spr_share_facebook"></span>
														<span class="spr-common spr-bgcircle3"></span>
														<span class="button_text">페이스북</span>
													</button>
												</li>
											</ul>
										</li>
									</ul>-->
							</div>
							<a href="#" class="goods_item_link">
								<span class="brand"><?= $shopping_list[$k]['brand_name'] ?></span>
								<span class="name"><?= $shopping_list[$k]['goods_name'] ?></span>
								<span class="price">
									<?= number_format($shopping_list[$k]['price'] - ($shopping_list[$k]['price']*$shopping_list[$k]['del_price_percent']/100)) ?>
									<span class="dc_price">
										<s class="del_price"><?= number_format($shopping_list[$k]['price']) ?></s>
										(<?= number_format($shopping_list[$k]['del_price_percent']) ?>%
										<span class="spr-common spr_ico_arrow_down"></span>
										)
									</span>
								</span>
								<span class="icon_block">
									<span class="spr-common spr_ico_coupon"></span>
								</span>
							</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
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
	</script>

</div>


