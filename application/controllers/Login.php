<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Travel
 * @property login_m $login_m
 *
 */
class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('login_m');
		$this->load->library('session');
		$this->load->helper('url');
		$this->sessions = array();
		$this->sessions['session_id'] = $this->session->id;
		$this->sessions['session_name'] = $this->session->name;
	}

	public function index()
	{
		$data = array();

		if(strpos($_SERVER['HTTP_REFERER'],'google')){
            $_SERVER['HTTP_REFERER'] = "http://www.restlife.shop";
        }

		$prevPage = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"http://www.restlife.shop";
		$data['sessions'] = $this->sessions;
		$data['prevPage'] = $prevPage;

        $layout = array();
        $layout['sessions'] = $this->sessions;

		$this->load->view('include/layout',$layout);
		$this->load->view('login',$data);
		$this->load->view('include/footer');
	}

	public function checkLoginForm()
	{

		$this->session->unset_userdata(null);
		$data = array();
		$ID        = $_POST['ID'];
		$PW        = $_POST['PW'];
		$data['id'] = $ID;
		$data['pw'] = $PW;

		$checkLoginForm = $this->login_m->checkLoginForm($data);

		if(!empty($checkLoginForm)){
			$session_data = array();
			$session_data['id'] = $checkLoginForm['id'];
			$session_data['name'] = $checkLoginForm['name'];

			$this->session->set_userdata($session_data);
			echo 'sucess';
		}else{
			echo 'fail';
		}
	}

	public function checkId()
	{
		$ID        = $_POST['ID'];

		$result = $this->login_m->checkId($ID);

		if(!empty($result)){
			echo 'fail';
		}else{
			echo 'sucess';
		}
	}

	public function naverLogin()
	{
		$client_id = "DJm5Va3pFcDNfVgSYvuC";
		$client_secret = "or4dJa8Q_R";
		$code = $_GET["code"];;
		$state = $_GET["state"];;
		$redirectURI = urlencode("http://www.restlife.shop");
		$url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
		$is_post = false;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $is_post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		$response = curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//echo "status_code:".$status_code."";
		curl_close ($ch);
		if($status_code == 200) {
			//echo $response;
			$responseJson = json_decode($response,JSON_UNESCAPED_UNICODE);
			$token = $responseJson['access_token'];
		} else {
			echo "Error 내용:".$response;
		}

		//위에서 token 값을 가져옴.
		$header = "Bearer ".$token; // Bearer 다음에 공백 추가
		$url = "https://openapi.naver.com/v1/nid/me";
		$is_post = false;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, $is_post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		$headers[] = "Authorization: ".$header;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//echo "status_code:".$status_code."<br>";
		curl_close ($ch);
		if($status_code == 200) {
			//echo $response;
			$responseJson2 = json_decode($response,JSON_UNESCAPED_UNICODE);
			$naverIdNum    = $responseJson2['response']['id'];
			$naverEmail    = $responseJson2['response']['email'];
			$naverMobile   = $responseJson2['response']['mobile'];
			$naverName     = $responseJson2['response']['name'];
			$naverBirthday = $responseJson2['response']['birthday'];

			$session_data = array();
			$session_data['id'] = $naverEmail;
			$session_data['name'] = $naverName;

			$this->session->set_userdata($session_data);
			echo "<script>location.href='http://www.restlife.shop'</script>";
		} else {
			echo "Error 내용:".$response;
		}

		//var_dump(json_encode($response,JSON_UNESCAPED_UNICODE));
	}

}
