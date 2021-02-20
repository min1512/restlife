

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
	<script src="http://min1512.cafe24.com/lsm/js/owl/owl.carousel.min.js"></script>
	<script src="http://min1512.cafe24.com/lsm/js/webfontloader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>


</head>
<body>


<div class="all_wrap">

	<!-- main2 -->
	<div class="cpage main2" id="main2">
		<div class="loader tImg" style="background-image: url(http://www.restlife.shop/lsm/img/travel/airplane.jpg);"></div>
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
<!--		카테고리 다른글-->
		<div class="another_category another_category_color_gray">
			<?php
				$url = $_SERVER['REQUEST_URI'];
				$url = explode('/',$url);
				$url = 'http://www.restlife.shop/'.$url[1].'/listAll';
			?>
			<h4>'<a href="#">RestLife</a>&nbsp;&gt;&nbsp;<a href="<?= $url; ?>"><?=$img_get_all[0]['dir'];?></a>' 카테고리의 다른 글</h4>
			<div class="jb-responsive-table">
				<table>
					<tbody>

					<?php foreach ($img_get_all as $k => $v) {
							if($img_get_all[$k]['dir'] == 'food') $img_get_all[$k]['dir'] ='foods';
						?>
					<tr class="categoryNum">
						<th>
							<a href="http://www.restlife.shop/<?=$img_get_all[$k]['dir'];?>/lists/<?=$img_get_all[$k]['index'];?>"><?= $img_get_all[$k]['title']; ?></a>&nbsp;&nbsp;
						</th>
						<td><?= $img_get_all[$k]['reg_date']; ?></td>
					</tr>
					<?php } ?>


					</tbody>
				</table>
			</div>
			<!--					카테고리 리스트 페이징-->
			<div id="categoryListPaging">
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
						<!--					댓글 리스트 페이징-->
						<div id="replyListPaging">
						</div>
					</ul>
					<?php } ?>
				</div>
			</div>
		</div>

	</div>

</div>
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
	//사용 안함
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
		if(session != ''){
            $.ajax({
                url: 'http://www.restlife.shop/Update/LikeButtonSelect',
                type: 'post',
                data: { 'id' : session, 'index_map' : '<?= $index_map; ?>' },
                dataType: 'text',
                success : function (result){
                    //console.log(result);
                    if(result == 'sucess'){
                        //console.log(result);
                        $('.ico_heart').css({
                            "background-position" : "-20px -46px"
                        })
                    }else{
                        //console.log(result);
                    }
                },
                error: function (result){
                    //console.log(result);
                    alert('Database error');
                }
            })
        }
	})

	//댓글 이미지 클릭시 페이지 아래로 이동(댓글 쓰는곳으로) => 2021-01-20 추가
	$(function (){
		$("#moveLayer").on("click",function (event){
			//reply 객체를 얻어온다.
			var offset = $('#reply').offset();
			$('html, body').animate({scrollTop:offset.top},400);
		});
	});

	//2021-02-07 추가 한거임.(카테고리 및 댓글 부분 페이징 처리)
	//관련 카테고리글 페이징 처리
	$(function (){
		//처음 페이징 로딩 되었을때는 카테고리글 무조건 5개 보이게
		$('.categoryNum').each(function (index){
			if(index > 4){
				$(this).hide();
			}
		});
		//처음 페이징 로딩 되었을때는 댓글 글 무조건 5개 보이게
		$('.item_cmt').each(function (index){
			if(index > 4){
				$(this).hide();
			}
		});


		//카테고리 총 리스트 갯수
		var listAll = $('.jb-responsive-table table tbody tr').length;
		//댓글 총 리스트 갯수
		var replyAll = $('.item_cmt').length;

		//웹일 경우 5개씩, 모바일일때는 3개
		var pagelist = 5;

		//카테고리 페이지 넘버 수
		var pageTotal = Math.ceil(listAll/pagelist);
		//댓글 넘버 수
		var replyPageTotal = Math.ceil(replyAll/pagelist);


		//카테고리꺼
		//지금 당장은 쓰지 않음. 차후 추가 할지 생각
		//$('#categoryListPaging').append('<a class="pagingCategory" href="#" value="before"><</a>');
		for (i=0; i<pageTotal; i++){
			var pageNum = parseInt(i)+1;
			$('#categoryListPaging').append('<a class="pagingCategory" value='+pageNum+'>'+pageNum+'</a>');
		}
		//지금 당장은 쓰지 않음. 차후 추가 할지 생각
		//$('#categoryListPaging').append('<a class="pagingCategory" href="#" value="after">></a>');


		//댓글꺼
		$('#replyListPaging').append('<a class="pagingReplys" id="before" value="before"><</a>');
		for (i=0; i<replyPageTotal; i++){
			var pageNum = parseInt(i)+1;
			if(pageNum%5 ==0){
				$('#replyListPaging').append('<a class="pagingReply" id='+pageNum+'>'+pageNum+'</a>');
			}else{
				$('#replyListPaging').append('<a class="pagingReply" >'+pageNum+'</a>');
			}
		}
		$('#replyListPaging').append('<a class="pagingReplys" id="after" value="after">></a>');

		//카테고리꺼
		$('#categoryListPaging').css('margin','auto').css('text-align','center');
		$('.pagingCategory').css('color','#909090').css('font-size','20px').css('padding-right','5px');
		//댓글꺼
		$('#replyListPaging').css('margin','auto').css('text-align','center');
		$('.pagingReply').css('color','#909090').css('font-size','20px').css('padding-right','5px');
		$('.pagingReplys').css('color','#909090').css('font-size','20px').css('padding-right','5px');


		//pagingCategory클릭 했을때 발생하는 이벤트
		$('.pagingCategory').each(function (indexs){
			var indexs = parseInt(indexs)+1;
			$(this).click(function (){
				$('.categoryNum').each(function (index){
					var index = parseInt(index)+1;
					var ckValue = (parseInt(indexs) - 1)*5;

					if(index <= 5+parseInt(ckValue) && index >= 1+parseInt(ckValue)){
						$(this).show();//앞에 5개 보여줌
					}else{
						$(this).hide();//앞에 5개 이외는 모두 hide
					}
				});
			});
		})


		$('.pagingReply').each(function (index){
			var index = index+1;
			if(index > 5){
				$(this).hide();
			}

			if(index <= 5){
				$('.pagingReplys').hide();
			}else{
				$('.pagingReplys').show();
			}
		})

		$('.pagingReplys').click(function (){
			var chkval = $(this).attr('id');
			$('.pagingReply').each(function (index){
				var last = $('.pagingReply:last').index();
				var index = index+1;
				var view = $(this).is(':visible');
				if(view == true){
					var id = $(this).attr('id');//현재 보여주는 곳의 마지막 해당 글 id
					if(id != undefined){
						var lastId = id;
						pagingReplys(lastId,chkval);//현재 보여주는 곳의 마지막 해당 글 id
						return false;
					}
				}

				if(index == last){
					if(last %5 != 0){
						var mok = last/5;
						pagingReplys(parseInt(mok)*5+5,chkval,'noAction');//현재 보여주는 곳의 마지막 해당 글 id
					}
				}

			})
		})

		function pagingReplys(lastId,chkval,check)
		{
			$('.pagingReply').each(function (index){
				var index = index+1;
				if(chkval == 'after'){
					if(check != 'noAction'){
						if(index >= 1+parseInt(lastId) && index <= 5+parseInt(lastId)){
							$(this).show();
						}else{
							$(this).hide();
						}
					}
				}else if(chkval == 'before'){
					if(lastId != 5 || check == 'noAction'){
						if(index <= parseInt(lastId)-5 && index > parseInt(lastId)-10 ){
							$(this).show();
						}else{
							$(this).hide();
						}
					}
				}

			})
		}

		//pagingReply클릭 했을때 발생하는 이벤트
		$('.pagingReply').each(function (indexs){
			var indexs = parseInt(indexs)+1;
			$(this).click(function (){
				$('.item_cmt').each(function (index){
					var index = parseInt(index)+1;
					var ckValue = (parseInt(indexs) - 1)*5;

					if(index <= 5+parseInt(ckValue) && index >= 1+parseInt(ckValue)){
						$(this).show();//앞에 5개 보여줌
					}else{
						$(this).hide();//앞에 5개 이외는 모두 hide
					}
				});
			});
		})

		//댓글 항목쪽 글 많아질 경우 페이징 처리
		// $('#replyPageTotal').each(function (index)){
		// 	var index = index+1;
		// 	if(index >5){
		// 		$(this).hide();
		// 	}
		// }
	})

</script>
