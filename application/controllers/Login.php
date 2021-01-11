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
		$this->load->view('include/layout',$this->sessions);
		$this->load->view('login',$this->sessions);
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

}
