<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property foods_m $foods_m
 * Created by PhpStorm.
 * User: 이상민
 * Date: 2020-12-04
 */
class Foods extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('foods_m');
		$this->load->library('session');
        $this->load->library('pagination');
		$this->load->helper('security');
		$this->sessions = array();
		$this->sessions['session_id'] = $this->session->id;
		$this->sessions['session_name'] = $this->session->name;

	}

	public function index()
	{
        //환경 체크
        $mAgent = array("iPhone","iPod","Android","Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony" );
        $chkMobile = false;
        for($i=0; $i<sizeof($mAgent); $i++){
            if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] ))
            {
                $chkMobile = true;
                break;
            }
        }

        if($chkMobile){
            //모바일
            $get = $this->input->get();

            $data = array();
            $countAll = $this->foods_m->img_get(null);

            $rdoLimitNumRows = 4;//한 페이지에 표시할 양
            $totalCnt = sizeof($countAll);//총 게시물
            $totalPage = ceil($totalCnt/$rdoLimitNumRows);//총페이지수
            $page = isset($get['per_page'])?($get['per_page']/4)+1:1;

            $startLimit = $page;
            if( $startLimit < 1 ) $startLimit = 1;
            $startLimit = ($startLimit -1 ) * $rdoLimitNumRows;
        }else{
            //PC
            $get = $this->input->get();

            $data = array();
            $countAll = $this->foods_m->img_get(null);

            $rdoLimitNumRows = 8;//한 페이지에 표시할 양
            $totalCnt = sizeof($countAll);//총 게시물
            $totalPage = ceil($totalCnt/$rdoLimitNumRows);//총페이지수
            $page = isset($get['per_page'])?($get['per_page']/8)+1:1;

            $startLimit = $page;
            if( $startLimit < 1 ) $startLimit = 1;
            $startLimit = ($startLimit -1 ) * $rdoLimitNumRows;
        }

        $param = array();
        $param['startLimit'] = $startLimit;
        $param['rdoLimitNumRows'] = $rdoLimitNumRows;

        $params = array();
        $params['per_page'] = $rdoLimitNumRows;

        $this->load->library('pagination');
        $config['base_url'] = 'http://www.restlife.shop/Travel';
        $config['uri_segment'] = 4;
        $config['total_rows'] = $totalCnt;//총 게시물
        $config['per_page'] = $rdoLimitNumRows;
        $config['num_links'		] = '5';
        //$config['suffix'		] = '?'.http_build_query($params, '&');
        $config['total_pages'] = $totalPage;//총페이지수
        //$config['page_query_string'] =true;
        $this->pagination->initialize($config);//페이지네이션 초기화
        $data['pagination']=$this->pagination->create_links();//페이징 링크를 생성하여 view에서 사용할 변수에 할당

        $img_get = $this->foods_m->img_get_detail_list(null,$param);
        $data['img_get'] = $img_get;

        $layout = array();
        $layout['sessions'] = $this->sessions;

        $this->load->view('include/layout',$layout);
        $this->load->view('foods',$data);
        $this->load->view('include/footer');
	}

    public function listAll()
    {
        //환경 체크
        $mAgent = array("iPhone","iPod","Android","Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony" );
        $chkMobile = false;
        for($i=0; $i<sizeof($mAgent); $i++){
            if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] ))
            {
                $chkMobile = true;
                break;
            }
        }

        if($chkMobile){
            //모바일
            $get = $this->input->get();
            $get['per_page'] = $this->uri->segment(3);

            $data = array();
            $countAll = $this->foods_m->img_get(null);

            $rdoLimitNumRows = 4;//한 페이지에 표시할 양
            $totalCnt = sizeof($countAll);//총 게시물
            $totalPage = ceil($totalCnt/$rdoLimitNumRows);//총페이지수
            $page = isset($get['per_page'])?$get['per_page']:1;

            $startLimit = $page;
            if( $startLimit < 1 ) $startLimit = 1;
            $startLimit = ($startLimit -1 ) * $rdoLimitNumRows;
        }else{
            //PC
            $get = $this->input->get();
            $get['per_page'] = $this->uri->segment(3);

            $data = array();
            $countAll = $this->foods_m->img_get(null);

            $rdoLimitNumRows = 8;//한 페이지에 표시할 양
            $totalCnt = sizeof($countAll);//총 게시물
            $totalPage = ceil($totalCnt/$rdoLimitNumRows);//총페이지수
            $page = isset($get['per_page'])?$get['per_page']:1;

            $startLimit = $page;
            if( $startLimit < 1 ) $startLimit = 1;
            $startLimit = ($startLimit -1 ) * $rdoLimitNumRows;
        }

        $param = array();
        $param['startLimit'] = $startLimit;
        $param['rdoLimitNumRows'] = $rdoLimitNumRows;

        $params = array();
        $params['per_page'] = $rdoLimitNumRows;

        $this->load->library('pagination');
        $config['base_url'] = 'http://www.restlife.shop/Foods/listAll';
        $config['uri_segment'] = 4;
        $config['total_rows'] = $totalCnt;//총 게시물
        $config['per_page'] = $rdoLimitNumRows;
        $config['num_links'		] = '5';
        //$config['suffix'		] = '?'.http_build_query($params, '&');
        $config['total_pages'] = $totalPage;//총페이지수
        //$config['page_query_string'] =true;
        $this->pagination->initialize($config);//페이지네이션 초기화
        $data['pagination']=$this->pagination->create_links();//페이징 링크를 생성하여 view에서 사용할 변수에 할당

        $img_get = $this->foods_m->img_get_detail_list(null,$param);
        $data['img_get'] = $img_get;

        $layout = array();
        $layout['sessions'] = $this->sessions;

        $this->load->view('include/layout',$layout);
        $this->load->view('foods',$data);
        $this->load->view('include/footer');
    }

	public function write()
	{
        $layout = array();
        $layout['sessions'] = $this->sessions;

		$this->load->view('include/layout',$layout);
		$this->load->view('write');
		$this->load->view('include/footer');
	}

	public function lists()
	{
		$dir = $this->uri->segment(1);
		$index = $this->uri->segment(3);

		//게시판 글 카운트  유무 확인
		$ckCountView = $this->foods_m->ckCountView($dir,$index,$_SERVER['REMOTE_ADDR']);

		if(empty($ckCountView)){
			//게시판 글 카운트 증가
			$views = array();
			$views['chkViews'] = $dir;
			$views['index_map'] = $index;
			$views['ip'] = $_SERVER['REMOTE_ADDR'];
			$this->db->insert('countViews',$views);
		}

		$data =array();
		//매핑이 되어 있는 이미지 호출
		$img_get = $this->foods_m->img_get($index);
		$data['img_get'] = $img_get;
		$data['password'] = isset($img_get[0]['password'])?$img_get[0]['password']:"null";
//		$data['tempImgGetAll'] = $tempImgGetAll;
		$data['session' ] = $this->sessions;
		$likeButtonCount = $this->foods_m->likeButtonCount($index);
		$data['likeButtonCount'] = count($likeButtonCount);
		$replyComment    = $this->foods_m->replyComment($index);
		$CountView    = $this->foods_m->CountView( $dir,$index );//조회수 갯수 몇개인지 체크 (2021-06-06)
		$data['replyComment'     ] = $replyComment;
		$data['replyCommentCount'] = count($replyComment);
		$data['CountView'] = count($CountView);//조회수 총 갯수

		//관련 카테고리 전체 글 가져 오기(2021-02-05 추가)
		$img_get_all = $this->foods_m->img_get(null);
		$data['img_get_all'] = $img_get_all;

        $layout = array();
        $layout['sessions'] = $this->sessions;
        if(!empty($img_get[0]['jpg_name'])){
            $tempJpgSrc = 'www.restlife.shop/lsm/img/travel/'.$img_get[0]['jpg_name'];
        }else{
            $tempJpgSrc = $img_get[0]['jpg_src'];
        }

        $layout['jpg_src'] = $tempJpgSrc;

		$this->load->view('include/layout',$layout);
		$this->load->view('list',$data);
		$this->load->view('include/footer');
	}

	public function update()
	{
		$dir = $this->uri->segment(1);
		$index = $this->uri->segment(3);

		//비번이 있는지 찾는 과정
		$img_get = $this->foods_m->img_get($index);

		if(!empty($img_get[0]['password'])) {
			//비번이 존재 할때임.
			$session = $this->session->all_userdata();
			$dir_session = $session['dir'];
			$index_map = $session['index_map'];
			$session_url = "www.restlife.shop/" . $dir_session . "/update/" . $index_map;
			$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			if ($session_url == $url) {
				$data = array();
				$img_get = $this->foods_m->img_get($index);
				$data['img_get'] = $img_get;
				$data['password'] = isset($img_get[0]['password']) ? $img_get[0]['password'] : "null";

                $layout = array();
                $layout['sessions'] = $this->sessions;

				$this->load->view('include/layout',$layout);
				$this->load->view('update', $data);
				$this->load->view('include/footer');
			} else {
				$url = 'http://www.restlife.shop/' . $dir . '/lists/' . $index;
				header('Location:' . $url);
				exit();
			}
		}else{
			//비번이 존재 하지 않음
			$data =array();
			$img_get = $this->foods_m->img_get($index);
			$data['img_get' ] = $img_get;
			$data['password'] = isset($img_get[0]['password'])?$img_get[0]['password']:"null";

            $layout = array();
            $layout['sessions'] = $this->sessions;

			$this->load->view('include/layout',$layout);
			$this->load->view('update',$data);
			$this->load->view('include/footer');
		}


	}


	public function upload()
	{
		// 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		//$config['upload_path'] = 'http://www.restlife.shop/lsm/img/travel';
		$uploadfullPath = "../www/lsm/img/food/";
		// git,jpg,png 파일만 업로드를 허용한다.
		//$config['allowed_types'] = 'gif|jpg|png';
		$imageBaseUrl = "/lsm/img/food/";
		// 허용되는 파일의 최대 사이즈
		//$config['max_size'] = '100';
		// 이미지인 경우 허용되는 최대 폭
		//$config['max_width']  = '1024';
		// 이미지인 경우 허용되는 최대 높이
		//$config['max_height']  = '768';
		//$this->load->library('upload', $config);
		//$CKEditor = $_GET['CKEditor'];
		//$funcNum = $_GET['CKEditorFuncNum'] ;
		$url = '';
		$message='';

		if(isset($_FILES['upload'])){
			$name = $_FILES['upload']['name'];

			$data = array();
			$data['idx'] = 5;
			$data['dir'] = 'food';
			$data['jpg_name'] = $name;
			$data['REG_DATE'] =date("Y-m-d H-i-s");
			$this->db->insert('img_map',$data);

			//$upload = $this->travel_m->upload('','6','travel',$name);
			move_uploaded_file($_FILES["upload"]["tmp_name"],$uploadfullPath.$name);

			//업로드된 이미지파일 정보를 가져 옵니다.
			$file = getimagesize($uploadfullPath.$name);
			//저용량 jpg 파일을 생성합니다.
			$quality = 50;
			if($file['mime'] == 'image/png'){
				$image = imagecreatefrompng($uploadfullPath.$name);
			}else if($file['mime'] == 'image/gif'){
				$image = imagecreatefrompng($uploadfullPath.$name);
			}else if($file['mime'] == 'image/jpeg'){
				$image = imagecreatefromjpeg($uploadfullPath.$name);

				$image = imagecreatefromjpeg($uploadfullPath.$name);

				$exif = exif_read_data($uploadfullPath.$name);

				if(!empty($exif['Orientation']))

				{

					switch($exif['Orientation'])

					{

						case 8:

							$image = imagerotate($image,90,0);

							break;

						case 3:

							$image = imagerotate($image,180,0);

							break;

						case 6:

							$image = imagerotate($image,-90,0);

							break;

					}

					imagejpeg($image,$uploadfullPath.$name);

				}

			}else{
				$image = imagecreatefromjpeg($uploadfullPath.$name);
			}

			//파일 압축 및 업로드
			imagejpeg($image,$uploadfullPath.$name,$quality);

			$url = $imageBaseUrl.$name;
		}else{
			$message='실패';
		}
		echo '
				{
				"fileName": "'.$name.'",
				"uploaded": 1,
				"url": "'.$url.'",
                    "error":{
                        "message":"'.$message.'"
                    }
				}
			';

//		if(!$this->upload()->do_upload('upload')){
//
//			echo "<script>alert('업로드 실패.".$this->upload()->display_errors()."')</script>";
////			echo '
////				{
////				"uploaded": 0,
////				"error": {"message":'.$this->upload()->display_errors().'}
////				}
////			';
//
//		}else{
//			$data = $this->upload()->data();
//			$file_name = $data['file_name'];
//			$url = 'http://www.restlife.shop/lsm/img/travel'.$file_name;
//
//
//			echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('1','".$url."','성공')</script>";
////			echo '
////				{
////				"fileName": "'.$file_name.'",
////				"uploaded": 1,
////				"url": "'.$url.'"
////				}
////			';
//			echo "성공";
//			var_dump($data);
//		}
	}

	public function uploadForm()
	{
		$update   = isset($_POST['update'])?$_POST['update'  ]:"";
		if($update != 'update'){
			//insert 하는 부분
			$title    = $this->security->xss_clean($_POST['title']);
			$content  = $this->security->xss_clean($_POST['contents']);
			$password = $this->security->xss_clean($_POST['password']);
			$user     = isset($_POST['user'])?$this->security->xss_clean($_POST['user']):"";

			$src = explode("src",$content);
			if(!empty($src[1])){
				$jpg_name = explode("/",$src[1]);
				$jpg_name = $jpg_name[4];
				$jpg_name = explode(".",$jpg_name);
				$jpg_name = $jpg_name[0];

				$index = $this->foods_m->get_index($jpg_name);
			}

			if(empty($index['index'])){
				$data = array();
				$data['idx'] = 5;
				$data['dir'] = 'food';
				preg_match_all("/<img[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", $content,$matchs);
				$data['jpg_src'] = isset($matchs[1][0])?$matchs[1][0]:"";
				$data['REG_DATE'] =date("Y-m-d H-i-s");
				$this->db->insert('img_map',$data);
				$result = $this->db->insert_id();
			}

			$data = array();
			$data['title'    ] = $title;
			$data['content'  ] = $content;
			$data['user'     ] = $user;
			$data['password' ] = $password;
			$data['REG_DATE' ] =date("Y-m-d H-i-s");
			$data['index_map'] =isset($index['index'])?$index['index']:$result;
			$this->db->insert('foods',$data);

			echo "<script>location.href='http://www.restlife.shop/Foods/listAll'</script>";
		}else if($update == 'update') {
			//update 하는 부분
			$index_map = $_POST['index_map'];
			$index_map = explode('/',$index_map);
			$index_map = $index_map[5];

			$title     = $this->security->xss_clean($_POST['title']);
			$content   = $this->security->xss_clean($_POST['contents']);
			$password  = $this->security->xss_clean($_POST['password']);
			$use_yn    = isset($_POST['use_yn'])?$_POST['use_yn']:"Y";
			$user      = isset($_POST['user'])?$this->security->xss_clean($_POST['user']):"";

			$src = explode("src",$content);
			if(!empty($src[1])){
				$jpg_name = explode("/",$src[1]);
				$jpg_name = $jpg_name[4];
				$jpg_name = explode(".",$jpg_name);
				$jpg_name = $jpg_name[0];

				$index = $this->foods_m->get_index($jpg_name);
			}

			if(empty($index['index'])){
				$data = array();
				$data['idx'] = 5;
				$data['dir'] = 'food';
				preg_match_all("/<img[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", $content,$matchs);
				$data['jpg_src'] = isset($matchs[1][0])?$matchs[1][0]:"";
				$data['REG_DATE'] =date("Y-m-d H-i-s");
				$where = array(
					'index' => $index_map
				);
				$this->db->update('img_map',$data,$where);
			}

			$data = array();
			$data['title'    ] = $title;
			$data['content'  ] = $content;
			$data['user'     ] = $user;
			$data['password' ] = $password;
			$data['REG_DATE' ] =date("Y-m-d H-i-s");
			$data['index_map'] =isset($index['index'])?$index['index']:$index_map;
			$data['use_yn'   ] = $use_yn;
			$where = array(
				'index_map' => $index_map
			);
			$this->db->update('foods',$data,$where);

			echo "<script>location.href='http://www.restlife.shop/Foods/listAll'</script>";
		}

	}

	public function Naver_Blog_Api()
	{
		$client_id = "GWm32zXzdOveq0oNSAoo";
		$client_secret = "5uuvos63jd";
		$encText = urlencode("강남술집");
		$url = "https://openapi.naver.com/v1/search/webkr.json?query=".$encText."&display=20&start=10"; // json 결과
//  $url = "https://openapi.naver.com/v1/search/blog.xml?query=".$encText; // xml 결과
		$is_post = false;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $is_post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		$headers[] = "X-Naver-Client-Id: ".$client_id;
		$headers[] = "X-Naver-Client-Secret: ".$client_secret;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		echo "status_code:".$status_code."";
		curl_close ($ch);
		if($status_code == 200) {
			//echo $response;
		} else {
			echo "Error 내용:".$response;
			return false;
		}
		$response = json_decode($response);
		foreach ($response as $k => $v){
			if($k == 'items'){
				$items = $v;
			}
		}

		$link=array();
		foreach ($items as $k => $v){
			foreach ($v as $k2 => $v2){
				if($k2 =="link"){
					$link[$k] = $v2;
				}
			}
		}
		//var_dump($response);
		var_dump($link);
		//$this->web_crowling($link);

	}

	public function web_crowling($link)
	{
		$this->load->library('Snoopy');
        $snoopy = new Snoopy;
		$src = array();
		for ($i=0; $i<sizeof($link); $i++){
			$this->snoopy->fetch($link[$i]);
            $snoopy->referer = 'http://blog.naver.com';
			preg_match('/<body>(.*?)<\/body>/is', $this->snoopy->results, $html);
			$src = isset($html[0])?$html[0]:"";
			$src = str_replace('<iframe id="mainFrame" name="mainFrame" allowfullscreen="true"',"",$src);
			preg_match('/src="\/(.*?)"/is', $src, $html);
			if(!empty($html[1])){
				$final_src = $html[1];
				$final_src = str_replace("&redirect=Dlog&widgetTypeCall=true&directAccess=false","",$final_src);
				$final_src = str_replace("PostView.nhn?blogId=","",$final_src);
				$final_src = str_replace("&logNo=","/",$final_src);
				$final_src = "http://m.blog.naver.com/".$final_src;
			}
		}
		var_dump($src);
	}

	public function web_crowling2($final_src)
	{
//        $curl = curl_init();
//
//        $timeout = 5;
//
//        $url=$final_src;
//
//        $reurl= "112.217.100.186";
//
//        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
//
//        curl_setopt ($curl, CURLOPT_SSLVERSION,1);
//
//        curl_setopt ($curl, CURLOPT_HEADER, 1);
//
//        curl_setopt($curl, CURLOPT_REFERER,$reurl);
//
//        curl_setopt($curl, CURLOPT_URL, $url);
//
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//
//        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
//
//        curl_setopt ($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36)");
//
////print curl_exec($curl);
//
//        $result = curl_exec($curl);
//
//        curl_close($curl);




		$this->load->library('Snoopy');
		$snoopy = new Snoopy;
		if(!empty($final_src)){
			for ($i=0; $i<sizeof($final_src); $i++){

                $SessionID = $this->snoopy->headers;
                foreach ($SessionID as $k => $v){
                    if($k==7){
                        $Sessionids = $v;
                    }
                }
                $Sessionids = str_replace("Set-Cookie:","",$Sessionids);
                $Sessionids = str_replace("; Path=/; Secure; HttpOnly","",$Sessionids);

				$snoopy->referer = 'http://naver.com';
				$snoopy->cookies["SessionID"] = $Sessionids;
				$snoopy->agent = "Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Mobile Safari/537.36";
				$snoopy->rawheaders["Pragma"] = "no-cache";
				$this->snoopy->fetch($final_src[$i]);
				//preg_match('/<div id="postListBody">(.*?)</div>/is', $this->snoopy->results, $result);
				//preg_match('/<div id="postListBody">(.*?)</div>/is',$this->snoopy->results,$result);
				//var_dump($result[0]);

				//preg_match('/<html>(.*?)</html>/is',$this->snoopy->results,$result);
				var_dump($this->snoopy->results);
				//preg_match('/<!doctype html>(.*?)<\/html>/is', $this->snoopy->results, $html);

			}
		}
	}
    //다음 블로그 웹 크롤링
	public function Daum_Blog_API()
    {
        $client_secret = "9f3ef833ad204541066f8c37b2bb99e2";
        $encText = urlencode("강남맛집");
        $path ='/v2/search/blog';
        $query = 'query='.$encText;
        $api_server = 'https://dapi.kakao.com';
        $headers = array('Authorization: KakaoAK '.$client_secret.'');
        $opts = array(
            CURLOPT_URL => $api_server . $path .'?' . $query,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 1,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $headers
        );

        $curl_session = curl_init();
        curl_setopt_array($curl_session, $opts);
        $return_data = curl_exec($curl_session);

        if (curl_errno($curl_session)) {
            throw new Exception(curl_error($curl_session));
        } else {
            print_r(curl_getinfo($curl_session));
            curl_close($curl_session);
            $return_data = json_decode($return_data);
            $result = array();
            foreach ($return_data as $k => $v){
                foreach ($v as $k2 => $v2){
                    foreach ($v2 as $k3=>$v3){
                        if($k3 == 'contents'){
                            $contents[$k2] = $v3;
                        }else if($k3 == 'datetime'){
                            $datetime[$k2] = $v3;
                        }else if($k3 == 'title'){
                            $title[$k2] = $v3;
                        }else if($k3 == 'url'){
                            $url[$k2] = $v3;
                        }
                    }
                }
            }
			//var_dump($url);
			$this->load->library('Snoopy');
            for($i=0; $i<sizeof($url); $i++){
				$this->snoopy->fetch($url[$i]);
				var_dump($this->snoopy->results);
			}

//            for ($i=0; $i<sizeof($contents); $i++){
//                $img_map = array();
//                $img_map['idx']=5;
//                $img_map['dir']='food';
//                $img_map['jpg_name']='Foods_Default.jpg';
//                $img_map['REG_DATE']=date('Y-m-d H:i:s');
//                $this->db->insert('img_map',$img_map);
//                $index = $this->db->insert_id();
//                $data = array();
//                $result = array();
//                $data['title'] = $title[$i];
//                $data['content'] = $contents[$i];
//                $data['user'] = '';
//                $data['REG_DATE'] = $datetime[$i];
//                $data['index_map'] = $index;
//                $result[] = $this->db->insert('foods',$data);
//
//            }


            //return $result;
			return $this->snoopy->results;
        }

    }

    public function tistory()
	{
		$this->load->library('Tistory_api');

		$tistory_api = new Tistory_api();

		$api_data = array();
		$api_data['callback_url'] = 'http://min1512.cafe24.com';
		$api_data['client_id'] = '75a513474f231f90035da9be9c5e4e9d';
		$api_data['secret_key'] = '75a513474f231f90035da9be9c5e4e9d2ef46b09b40be495c63807e37df755e71fa4ee6a';
		$tistory_api->set_api($api_data);

		$url = $tistory_api->authorize();


// 위의 $url로 접속(a 링크)하여, 어플리케이션을 승인하면, access_token을 발급받을 수 있습니다.

// 승인이 완료되어 access_token이 발급되면, 콜백주소로 티스토리에서 get 메소드로 code와 state를 리턴해줍니다.
		$code = 'ac06a2464c8d21458d6d644aefe620d541d6a7b9eb439dbdf80e15b324c5d36e5100ed2f';
		$access_token = $tistory_api->access_token($code);
		var_dump($access_token);
// access_token은 계속 사용할것이기때문에, 세션등으로 저장해줍니다.
		if (isset($access_token['access_token'])) {
			$_SESSION['access_token'] = $access_token['access_token'];
			$tistory_api->set_api(array('access_token'=>$access_token['access_token']));
		}

// access_token이 발급되었기 때문에 그 토큰을 사용하여, 티스토리의 api를 사용합니다.
		print_r($tistory_api->blog_info());


	}

	public function imgReSizing()
    {
        $parm = $this->input->get();
        $path = $parm['url'];

        $uploadfullPath = "../www/lsm/img/travel/";
        $name = $path;

        //업로드된 이미지파일 정보를 가져 옵니다.
        $file = getimagesize($uploadfullPath.$name);
        //저용량 jpg 파일을 생성합니다.
        $quality = 50;
        if($file['mime'] == 'image/png'){
            $image = imagecreatefrompng($uploadfullPath.$name);
        }else if($file['mime'] == 'image/gif'){
            $image = imagecreatefrompng($uploadfullPath.$name);
        }else if($file['mime'] == 'image/jpeg'){
			$image = imagecreatefromjpeg($uploadfullPath.$name);

			$exif = exif_read_data($uploadfullPath.$name);

			if(!empty($exif['Orientation']))

			{

				switch($exif['Orientation'])

				{

					case 8:

						$image = imagerotate($image,90,0);

						break;

					case 3:

						$image = imagerotate($image,180,0);

						break;

					case 6:

						$image = imagerotate($image,-90,0);

						break;

				}

				imagejpeg($image,$uploadfullPath.$name);

			}
        }else{
            $image = imagecreatefromjpeg($uploadfullPath.$name);
        }

        //파일 압축 및 업로드
        imagejpeg($image,$uploadfullPath.$name,$quality);
    }


}
