<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('shopping_m');
		$this->load->library('session');
		$this->sessions = array();
		$this->sessions['session_id'] = $this->session->id;
		$this->sessions['session_name'] = $this->session->name;

	}

	public function index()
	{

		$data = array();
		$img_get = $this->shopping_m->img_get(null);
		$shopping_list = $this->shopping_m->shopping_list();
		//var_dump($shopping_list);
		$data['img_get'] = $img_get;
		$data['shopping_list'] = $shopping_list;
		$this->load->view('include/layout',$this->sessions);
		$this->load->view('shopping',$data);
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
		$img_get = $this->shopping_m->img_get($index);
		$data['img_get'] = $img_get;

		$this->load->view('include/layout',$this->sessions);
		$this->load->view('list',$data);
		$this->load->view('include/footer');
	}


	public function upload()
	{
		// 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		//$config['upload_path'] = 'http://min1512.cafe24.com/lsm/img/travel';
		$uploadfullPath = "../www/lsm/img/shopping/";
		// git,jpg,png 파일만 업로드를 허용한다.
		//$config['allowed_types'] = 'gif|jpg|png';
		$imageBaseUrl = "/lsm/img/shopping/";
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
			$data['idx'] = 2;
			$data['dir'] = 'shopping';
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
//			$url = 'http://min1512.cafe24.com/lsm/img/travel'.$file_name;
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
		$title = $_POST['title'];
		$content = $_POST['contents'];
		$user = isset($_POST['user'])?$_POST['user']:"";

		$src = explode("src",$content);
		$jpg_name = explode("/",$src[1]);
		$jpg_name = $jpg_name[4];
		$jpg_name = explode(".",$jpg_name);
		$jpg_name = $jpg_name[0];

		$index = $this->shopping_m->get_index($jpg_name);

		$data = array();
		$data['title'] = $title;
		$data['content'] = $content;
		$data['user'] = $user;
		$data['REG_DATE'] =date("Y-m-d H-i-s");
		$data['index_map'] =$index['index'];
		$this->db->insert('shopping',$data);

		//$uploadForm = $this->travel_m->uploadForm($title,$content,$user);


		echo "<script>location.href='http://min1512.cafe24.com/Shopping'</script>";
	}

	public function list_add()
	{

		$data_all = file_get_contents("php://input");
		//print_r($data_all);
		$data_all = json_decode($data_all);
		//print_r($data_all);

		if(isset($data_all)){
			foreach ($data_all as $k => $v){
				if($k=='img_url'){
					$img_url = $v;
				}else if($k=='goods_name'){
					$goods_name = $v;
				}else if($k=='brand_name'){
					$brand_name = $v;
				}else if($k=='price'){
					$price = $v;
				}else if($k=='del_price_percent'){
					$del_price_percent = $v;
				}else if($k =='use_yn'){
					$use_yn = $v;
				}
			}
		}else{
			echo "값이 존재 하지 않음";
			return false;
		}

		//유효성
		if(empty($img_url)){
			echo "img_url 입력하세요";
			return false;
		}

		if(empty($goods_name)){
			echo "goods_name 입력하세요";
			return false;
		}

		if(empty($brand_name)){
			echo "brand_name 입력하세요";
			return false;
		}

		if(empty($price)){
			echo "price 입력하세요";
			return false;
		}

		if(empty($del_price_percent)){
			echo "del_price_percent 입력하세요";
			return false;
		}

		$param = array();
		$param['img_url'          ] = $img_url;
		$param['goods_name'       ] = $goods_name;
		$param['brand_name'       ] = $brand_name;
		$param['price'            ] = $price;
		$param['del_price_percent'] = $del_price_percent;
		$param['use_yn'           ] = isset($use_yn)?$use_yn:"N";
		$param['date_time'        ] = date('Y-m-d H:i:s');

		$result = $this->db->insert('shoppinglist',$param);

		if(isset($result)){
			echo "등록 성공";
		}else{
			echo "등록 실패";
		}
	}





}
