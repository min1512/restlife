

<head>
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/style.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/_sub.css">

	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/firstSlider.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/main1.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/main2.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/owl/owl.carousel.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/footer.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">

	<title>Rest Life</title>

	<script src="https://kit.fontawesome.com/782926246a.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="http://min1512.cafe24.com/lsm/js/main.js" defer></script>
	<script src="http://min1512.cafe24.com/lsm/js/owl/owl.carousel.min.js"></script>
	<script src="http://min1512.cafe24.com/lsm/js/webfontloader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>


</head>
<body>


<div class="all_wrap">

	<!-- main2 -->
	<div class="cpage main2" id="main2">
		<div class="loader tImg" style="background-image: url(lsm/img/travel/airplane.jpg);"></div>
		<div class="sub_title">
			<div class="eng TRAN">VIEWS</div>
			<div class="txt TRAN">남들과 차원이 다르고 <span>효율적이고 가치있는 휴식을 취하세요.</span></div>
			<a class="btn_sub" href="http://min1512.cafe24.com/Travel/write">글쓰기 <i class="fas fa-caret-right"></i></a>
		</div>
		<div class="list">
			<div class="lists" style="border: 0.5px solid #d6d6d6;">
				<div class="blogview_info">
					<time class="txt_date"><?= $img_get[0]['reg_date'] ?></time>
					<span class="sympathy_wrap">
							<a href="#comment" class="info_sym" id="moveLayer">
                                <span class="ico_comm ico_comment">댓글수</span><span class="count_comment"><?= $replyCommentCount ?></span>
                            </a>
							<span id="title_daumlike">
							<span id="mobile-reaction">
								<button class="info_sym uoc-icon" onclick="likeButton( '<?= isset($session['session_id'])?$session['session_id']:"" ?>' )">
									<span class="ico_comm ico_heart">공감수</span>
									<span class="uoc-like-count"><?= isset($likeButtonCount)?$likeButtonCount:0 ?></span>
								</button>
							</span>
					</span>
					</span>
				</div>

				<div class="sub_title">
					<?php if($password == 'null' || empty($password)) {?>
						<a class="btn_sub" id="change_text" onclick="ChangeList()">글 수정</a>
					<?php }else{ ?>
						<a class="btn_sub" id="change_text" onclick="getInputValue()">글 수정</a>
						<input type="password" maxlength="10" name="change_text_pw_value" id="change_text_pw_value" placeholder="비밀번호를 입력하세요" />
					<?php } ?>
				</div>

				<div class="blogview_content">
					<?= $img_get[0]['content'] ?>
				</div>
			</div>
		</div>
<!--		댓글-->
		<div class="reply" id="reply">
			<div class="replys" style="border: 0.5px solid #d6d6d6">
				<div id="form-commentInfo">

					<h3 class="tit_comment">
						<span class="inner_comment">
							<span class="img_comm ico_comment ico_comm"></span>
							댓글
							<span class="num_comment"><?= $replyCommentCount ?></span>
						</span>
					</h3>

					<input id="comment-input" placeholder="댓글을 입력해 주세요."> <button id="submit" onclick="reply_insert('<?= isset($session['session_id'])?$session['session_id']:"" ?>')">등록</button>
				</div>
				<div id=comments>
					<ul class="list_cmt">
					<?php if(!empty($replyComment)) {
							foreach ($replyComment as $k => $v){
								foreach ($v as $k2 => $v2) {
									if ($k2 == 'user') $user = $v2;
									if ($k2 == 'comment') $comment = $v2;
									if ($k2 == 'REG_DT') $REG_DT = $v2;
								}
					?>
									<li>
										<div class="item_cmt reply_cmt">
											<a class="thumb_img">
												<img src="https://img1.daumcdn.net/thumb/C30x30/?scode=mtistory2&amp;fname=https%3A%2F%2Ft1.daumcdn.net%2Ftistory_admin%2Fblog%2Fadmin%2Fprofile_default_06.png" class="img_thumg" alt="프로필 이미지">
											</a>
											<div class="cmt_info">
												<strong class="info_append">
													<a class="link_author"><?= isset($user)?$user:"" ?></a>
													<span class="txt_date">
														<span><?= isset($REG_DT)?$REG_DT:"" ?></span>
													</span>
												</strong>
												<span class="txt_cmt"><?= isset($comment)?$comment:"" ?></span>
											</div>
										</div>
									</li>

						<?php } ?>
					</ul>
					<?php } ?>
				</div>
			</div>
		</div>

	</div>

</div>
<!--<div>-->
<!--	<div class="cpage main2" id="main3">-->
<!--		<div class="sub_title">-->
<!--			<div class="txt TRAN">인기 많은 글</div>-->
<!--		</div>-->
<!--		<div class="list">-->
<!--			<div class="lists">-->
<!--				<table>-->
<!--					--><?php //foreach ($tempImgGetAll as $k => $v) { ?>
<!--						--><?php //foreach ($v as $k2 => $v2) { ?>
<!--								--><?php //if($k2 == 'jpg_name'){
//									$jpg_name = $v2;
//								}else if ($k2 == 'jpg_src'){
//									$jpg_src = $v2;
//								}else if ($k2 == 'title'){
//									$title = $v2;
//									//$content = substr($content,0,20);
//								}else if($k2 == 'index'){
//									$index = $v2;
//								}else if($k2 == 'dir'){
//									$dir = $v2;
//								}
//								?>
<!--								<tr>-->
<!--									<td>-->
<!--										<div style="width: 150px; height: 150px">-->
<!--											--><?php //if(empty($jpg_name)) { ?>
<!--												<img src="--><?//= $jpg_src ?><!--" style="width: 150px; height: 150px;" >-->
<!--											--><?php //}else{ ?>
<!--												<img src="http://min1512.cafe24.com/lsm/img/food/--><?//= $jpg_name; ?><!--" style="width: 150px; height: 150px;">-->
<!--											--><?php //} ?>
<!--										</div>-->
<!--									</td>-->
<!--									<td>-->
<!--										<a href='min1512.cafe24.com/--><?//= $dir; ?><!--/lists/--><?//= $index; ?><!--'>--><?//= isset($title)?$title:"";  ?><!--</a>-->
<!--									</td>-->
<!--								</tr>-->
<!--						--><?// } ?>
<!--					--><?// } ?>
<!--				</table>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->

<script>
	function getInputValue()
	{
		var pw_value = $('input[name=change_text_pw_value]').val();
		$('#change_text_pw_value').show();
		$.ajax({
			url: 'http://www.restlife.shop/Update/password',
			type: 'post',
			data: { 'password' : pw_value, 'url' : '<?= $_SERVER['REQUEST_URI'] ?>' },
			dataType: 'text',
			success : function (result){
				console.log(result);
				if(result == 'fail'){
					alert('비밀 번호가 틀렸습니다.');
					return false;
				}else{
					let url = window.location.href;
					let dir = url.split('/');
					let href ="http://www.restlife.shop/"
					href += dir[3];
					href += '/';
					href += 'update/';
					href += result;
					location.href = href;
				}
			},
			error: function (result){
				console.log(result);
			}
		})
	}

	function ChangeList()
	{
		<?php
			$url = $_SERVER['PHP_SELF'];
			$url = explode('/',$url);
			$dir = $url[3];
			$index_map = $url[5];
		?>
		let href ='http://min1512.cafe24.com/';
		href += '<?= $dir; ?>';
		href += '/update/';
		href += '<?= $index_map; ?>';
		location.href = href;
	}

	function likeButton(session)
	{
		if(session == ''){
			alert('로그인 후 이용 부탁드립니다.');
			location.href = 'http://www.restlife.shop/Login';
		}else{
			<?php
				$url = $_SERVER['PHP_SELF'];
				$url = explode('/',$url);
				$dir = $url[3];
				$index_map = $url[5];
			?>
			$.ajax({
				url: 'http://www.restlife.shop/Update/LikeButton',
				type: 'post',
				data: { 'id' : session, 'index_map' : '<?= $index_map; ?>'  },
				dataType: 'text',
				success : function (result){
					console.log(result);
					if(result == 'sucess'){
						window.location.reload();
					}else{
						alert('Database error');
						return false;
					}
				},
				error: function (result){
					console.log(result);
					alert('Database error');
				}
			})
		}
	}

	function reply_insert(session)
	{
		if(session == ''){
			alert('로그인 후 이용 부탁드립니다.');
			location.href = 'http://www.restlife.shop/Login';
		}else{
			var commentInput = $('#comment-input').val();
			commentInput = XSSCheck(commentInput,'');
			if(commentInput == ''){
				alert('글을 작성하세요.');
				return false;
			}
			<?php
			$url = $_SERVER['PHP_SELF'];
			$url = explode('/',$url);
			$dir = $url[3];
			$index_map = $url[5];
			?>
			$.ajax({
				url: 'http://www.restlife.shop/Update/ReplyInsert',
				type: 'post',
				data: { 'id' : session, 'index_map' : '<?= $index_map; ?>', 'commentInput' : commentInput  },
				dataType: 'text',
				success : function (result){
					console.log(result);
					if(result == 'sucess'){
						window.location.reload();
					}else{
						alert('Database error');
						return false;
					}
				},
				error: function (result){
					console.log(result);
					alert('Database error');
				}
			})
		}
	}

	function XSSCheck(str, level) {
		if (level == undefined || level == 0) {
			str = str.replace(/\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-/g,"");
		} else if (level != undefined && level == 1) {
			str = str.replace(/\</g, "&lt;");
			str = str.replace(/\>/g, "&gt;");
		}
		return str;
	}

	$(function (){
		var session = '<?= isset($session['session_id'])?$session['session_id']:"" ?>';
		$.ajax({
			url: 'http://www.restlife.shop/Update/LikeButtonSelect',
			type: 'post',
			data: { 'id' : session, 'index_map' : '<?= $index_map; ?>' },
			dataType: 'text',
			success : function (result){
				console.log(result);
				if(result == 'sucess'){
					console.log(result);
					$('.ico_heart').css({
						"background-position" : "-20px -46px"
					})
				}else{
					console.log(result);
				}
			},
			error: function (result){
				console.log(result);
				alert('Database error');
			}
		})
	})

	//댓글 이미지 클릭시 페이지 아래로 이동(댓글 쓰는곳으로) => 2021-01-20 추가
	$(function (){
		$("#moveLayer").on("click",function (event){
			//reply 객체를 얻어온다.
			var offset = $('#reply').offset();
			$('html, body').animate({scrollTop:offset.top},400);
		});
	});

</script>
