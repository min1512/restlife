<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property photo_m $photo_m
 * Created by PhpStorm.
 * User: 이상민
 * Date: 2020-12-04
 */
class Photo extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('photo_m');
		$this->load->library('session');
		$this->load->helper('url');
		$this->sessions = array();
		$this->sessions['session_id'] = $this->session->id;
		$this->sessions['session_name'] = $this->session->name;

	}

	public function index()
	{

		$data = array();
		$img_get = $this->photo_m->img_get(null);

		$data['img_get'] = $img_get;
		$this->load->view('include/layout',$this->sessions);
		$this->load->view('photo',$data);
		$this->load->view('include/footer');
	}

	public function write()
	{
		$this->load->view('include/layout',$this->sessions);
		$this->load->view('write');
		$this->load->view('include/footer');
	}

	public function lists()
	{
		$dir = $this->uri->segment(1);
		$index = $this->uri->segment(3);

		$data =array();
		$img_get = $this->photo_m->img_get($index);
		$data['img_get'] = $img_get;
		$data['password'] = isset($img_get[0]['password'])?$img_get[0]['password']:"null";
		$data['session' ] = $this->sessions;
		$likeButtonCount = $this->photo_m->likeButtonCount($index);
		$data['likeButtonCount'] = count($likeButtonCount);
		$replyComment    = $this->photo_m->replyComment($index);
		$data['replyComment'     ] = $replyComment;
		$data['replyCommentCount'] = count($replyComment);

		$this->load->view('include/layout',$this->sessions);
		$this->load->view('list',$data);
		$this->load->view('include/footer');
	}

	public function update()
	{
		$dir = $this->uri->segment(1);
		$index = $this->uri->segment(3);

		//비번이 있는지 찾는 과정
		$img_get = $this->photo_m->img_get($index);

		if(!empty($img_get[0]['password'])) {
			//비번이 존재 할때임.
			$session = $this->session->all_userdata();
			$dir_session = $session['dir'];
			$index_map = $session['index_map'];
			$session_url = "www.restlife.shop/" . $dir_session . "/update/" . $index_map;
			$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			if ($session_url == $url) {
				$data = array();
				$img_get = $this->photo_m->img_get($index);
				$data['img_get'] = $img_get;
				$data['password'] = isset($img_get[0]['password']) ? $img_get[0]['password'] : "null";

				$this->load->view('include/layout',$this->sessions);
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
			$img_get = $this->photo_m->img_get($index);
			$data['img_get' ] = $img_get;
			$data['password'] = isset($img_get[0]['password'])?$img_get[0]['password']:"null";

			$this->load->view('include/layout',$this->sessions);
			$this->load->view('update',$data);
			$this->load->view('include/footer');
		}


	}


	public function upload()
	{
		// 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		//$config['upload_path'] = 'http://www.restlife.shop/lsm/img/travel';
		$uploadfullPath = "../www/lsm/img/photo/";
		// git,jpg,png 파일만 업로드를 허용한다.
		//$config['allowed_types'] = 'gif|jpg|png';
		$imageBaseUrl = "/lsm/img/photo/";
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
			$data['idx'] = 3;
			$data['dir'] = 'photo';
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
			$title    = $_POST['title'   ];
			$content  = $_POST['contents'];
			$password = $_POST['password'];
			$user     = isset($_POST['user'])?$_POST['user']:"";

			$src = explode("src",$content);
			if(!empty($src[1])){
				$jpg_name = explode("/",$src[1]);
				$jpg_name = $jpg_name[4];
				$jpg_name = explode(".",$jpg_name);
				$jpg_name = $jpg_name[0];

				$index = $this->photo_m->get_index($jpg_name);
			}


			if(empty($index['index'])){
				$data = array();
				$data['idx'] = 3;
				$data['dir'] = 'photo';
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
			$this->db->insert('photo',$data);

			echo "<script>location.href='http://www.restlife.shop/Photo'</script>";
		}else if($update == 'update'){
			//update 하는 부분
			$index_map = $_POST['index_map'];
			$index_map = explode('/',$index_map);
			$index_map = $index_map[5];

			$title     = $_POST['title'   ];
			$content   = $_POST['contents'];
			$password  = $_POST['password'];
			$use_yn    = isset($_POST['use_yn'])?$_POST['use_yn']:"Y";
			$user      = isset($_POST['user'])?$_POST['user']:"";

			$src = explode("src",$content);
			if(!empty($src[1])){
				$jpg_name = explode("/",$src[1]);
				$jpg_name = $jpg_name[4];
				$jpg_name = explode(".",$jpg_name);
				$jpg_name = $jpg_name[0];

				$index = $this->photo_m->get_index($jpg_name);
			}

			if(empty($index['index'])){
				$data = array();
				$data['idx'] = 3;
				$data['dir'] = 'photo';
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
			$this->db->update('photo',$data,$where);

			echo "<script>location.href='http://www.restlife.shop/Photo'</script>";
		}
	}



}
