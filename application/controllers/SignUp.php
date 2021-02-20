<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class SignUp
 * @property Signup_m $Signup_m
 *
 */
class SignUp extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Signup_m');
		$this->load->library('session');
		$this->load->helper('url');
		$this->sessions = array();
		$this->sessions['session_id'] = $this->session->id;
		$this->sessions['session_name'] = $this->session->name;
	}

	public function index()
	{
        $layout = array();
        $layout['sessions'] = $this->sessions;

		$this->load->view('include/layout',$layout);
		$this->load->view('signup');
		$this->load->view('include/footer');
	}

	public function checkLoginForm()
	{

		$ID        = $_POST['ID'];
		$PW        = $_POST['PW'];
		$PW_CK     = $_POST['PW_CK'];
		$NAME      = $_POST['NAME'];
		$YY        = $_POST['YY'];
		$MM        = $_POST['MM'];
		$DD        = $_POST['DD'];
		$PHONE_TEL = $_POST['PHONE_TEL'];

		$data = array();
		$data['id'] = $ID;
		$data['pw'] = $PW;
		$data['name'] = $NAME;
		$data['birthday'] = $YY.'-'.$MM.'-'.$DD;
		$data['phonetel'] = $PHONE_TEL;

		$result = $this->Signup_m->insert_user($data);
		//$result = $this->db->insert('user', $data);

		if(!empty($result)){
			echo 'sucess';
		}else{
			echo 'fail';
		}
	}

	public function checkId()
	{
		$ID        = $_POST['ID'];

		$result = $this->Signup_m->checkId($ID);

		if(!empty($result)){
			echo 'fail';
		}else{
			echo 'sucess';
		}
	}

}
