<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="footer">
				<ul>
					<li><a href="#">사이트 도움말</a></li>
					<li><a href="#">사이트 이용약관</a></li>
					<li><a href="#">사이트 운영원칙</a></li>
					<li><a href="#"><strong>개인정보취급방침</strong></a></li>
					<li><a href="#">책임의 한계와 법적고지</a></li>
					<li><a href="#">게시중단요청서비스</a></li>
					<li><a href="#">min1512@hanmail.net</a></li>
				</ul>
				<address>
					Copyright ©
					<a href="http://restlife.shop"><strong>LeeSangMin</strong></a><br>
					All Rights Reserved.
				</address>
			</div>
		</div>
	</div>
</footer>
<a onclick="scrollToTop()" class="jb-top" style="display: block;"><i class="fa fa-arrow-up"></i></a>
</body>

<script>
	var timeOut;
	function scrollToTop() {
		if (document.body.scrollTop!=0 || document.documentElement.scrollTop!=0){
			window.scrollBy(0,-50);
			timeOut=setTimeout('scrollToTop()',10);
		}
		else clearTimeout(timeOut);
	}
</script>
</html>


