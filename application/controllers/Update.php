<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 2020-12-19 이상민
 * @property update_m $update_m
 */
class Update extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('update_m');
		$this->load->library('session');

	}

	public function password()
	{
		$password = $_POST['password'];
		$url      = $_POST['url'];
		$url      = explode('/',$url);


		$result = $this->update_m->lists($url[1], $url[3], $password);

		if(isset($result['index_map'])){
			//세션 초기화
			$session_data = array(
				'dir' => '',
				'index_map' => ''
			);
			$this->session->unset_userdata($session_data);
			//세션 생성
			$session_data = array(
				'dir' => $url[1],
				'index_map' => $url[3]
			);
			$this->session->set_userdata($session_data);
		}

		echo isset($result['index_map'])?$result['index_map']:"fail";
	}
	//좋아요 버튼 누르면 활성화 시키거나 비활성화 시키는거
	public function LikeButton()
	{
		$user        = $_POST['id'];
		$index_map = $_POST['index_map'];

		$likeButton = $this->update_m->likeButton($user,$index_map);

		if(empty($likeButton)){
			//공감 버튼 활성 추가
			$data = array();
			$data['index_map'] = $index_map;
			$data['user'     ] = $user;
			$data['REG_DATE' ] = date('Y-m-d H:i:s');
			$data['UPD_DATE' ] = date('Y-m-d H:i:s');
			$this->db->insert('like_button',$data);
		}else{
			//공감 버튼 비활성 변환
			$data = array();
			$data['use_yn'   ] = 'N';
			$data['UPD_DATE' ] = date('Y-m-d H:i:s');

			$where = array();
			$where['index_map'] = $index_map;
			$where['user'     ] = $user;
			$this->db->update('like_button',$data,$where);
		}

		echo 'sucess';
	}
	// 좋아요 버튼 눌렀는지 찾는거
	public function LikeButtonSelect()
	{
		$user        = $_POST['id'];
		$index_map = $_POST['index_map'];

		$likeButton = $this->update_m->likeButton($user,$index_map);

		if(!empty($likeButton)){
			//좋아요 버튼 눌렀으면 sucess
			echo 'sucess';
		}else{
			//좋아요 버튼 안 눌렀으면 fail
			echo 'false';
		}
	}

	public function ReplyInsert()
	{
		$data = array();
		$user         = $_POST['id'];
		$index_map    = $_POST['index_map'];
		$commentInput = $_POST['commentInput'];
		$use_yn       = 'Y';
		$reg_dt       = date('Y-m-d H:i:s');
		$upd_dt       = date('Y-m-d H:i:s');

		$data['index_map'] = $index_map;
		$data['user'     ] = $user;
		$data['comment'  ] = $commentInput;
		$data['USE_YN'   ] = $use_yn;
		$data['REG_DT'   ] = $reg_dt;
		$data['UPD_DT'   ] = $upd_dt;

		$this->db->insert('reply',$data);

		echo 'sucess';
	}

	public function upload()
	{
		// 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		//$config['upload_path'] = 'http://min1512.cafe24.com/lsm/img/travel';
		$uploadfullPath = "../www/lsm/img/travel/";
		// git,jpg,png 파일만 업로드를 허용한다.
		//$config['allowed_types'] = 'gif|jpg|png';
		$imageBaseUrl = "/lsm/img/travel/";
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
			$data['idx'] = 6;
			$data['dir'] = 'travel';
			$data['jpg_name'] = $name;
			$data['REG_DATE'] =date("Y-m-d H-i-s");
			$this->db->insert('img_map',$data);

			//$upload = $this->travel_m->upload('','6','travel',$name);
			move_uploaded_file($_FILES["upload"]["tmp_name"],$uploadfullPath.$name);
			$url = $imageBaseUrl.$name;
		}else{
			$message='실패';
		}
		echo '
				{
				"fileName": "'.$name.'",
				"uploaded": 1,
				"url": "'.$url.'"
				}
			';
	}

	public function uploadForm()
	{
		var_dump($_POST);
		$title    = $_POST['title'   ];
		$content  = $_POST['contents'];
		$password = $_POST['password'];
		$use_yn   = $_POST['use_yn'  ];
		$user     = isset($_POST['user'])?$_POST['user']:"";

		$src = explode("src",$content);
		$jpg_name = explode("/",$src[1]);
		$jpg_name = $jpg_name[4];
		$jpg_name = explode(".",$jpg_name);
		$jpg_name = $jpg_name[0];

		$index = $this->travel_m->get_index($jpg_name);

		if(empty($index['index'])){
			$data = array();
			$data['idx'] = 6;
			$data['dir'] = 'travel';
			preg_match_all("/<img[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", $content,$matchs);
			$data['jpg_src'] = $matchs[1][0];
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
		$data['use_yn'   ] =$use_yn;
		$this->db->insert('travel',$data);

		//$uploadForm = $this->travel_m->uploadForm($title,$content,$user);


		echo "<script>location.href='http://min1512.cafe24.com/Travel'</script>";
	}

}
