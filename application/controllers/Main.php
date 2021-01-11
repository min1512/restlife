<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('main_m');
		$this->load->library('session');

		$this->sessions = array();
		$this->sessions['session_id'] = $this->session->id;
		$this->sessions['session_name'] = $this->session->name;
	}

	public function index()
	{
		$data = array();

		$img_get = $this->main_m->img_get();

		//ip 로그 저장
		$ip_log = array();
		$IP = $_SERVER['REMOTE_ADDR'];
		$DATE = date('Y-m-d H:i:s');
		$ip_log['ip'] = $IP;
		$ip_log['date'] = $DATE;

		$this->db->insert('ip_log',$ip_log);
		$weather = $this->weather();
		$this->slack($IP,'restlife');
		foreach ($weather as $k => $v){
			foreach ($v as $k2 => $v2){
				if($k2 == 'title') $title = $v->title;
				if($k2 == 'pubDate') $reqDate = $v2;
				if($k2 == 'item'){
					foreach ($v2 as $k3 => $v3){
						foreach ($v3 as $k4 => $v4){
							if($k4 == 'body'){
								foreach ($v4 as $k5 => $v5){
									if($k5 == 'data'){
										foreach ($v5 as $k6 => $v6){
											//지금 온도
											if($k6 == 'temp') $temp = $v6;
											//최고 온도
											if($k6 == 'tmx') $tmx = $v6;
											//최저 온도
											if($k6 == 'tmn') $tmn = $v6;
											//맑음,흐림,비옴 등
											if($k6 == 'wfKor') $wfKor = $v6;
											if($k6 == 'wfEn' ) $wfEn = $v6;

										}
										break;
									}
								}
							}
						}
					}
				}
			}
		}
		$title = str_replace('기상청 동네예보 웹서비스 -','',$title);
		$title = str_replace('도표예보','',$title);
		$data['title'  ] =$title;
		$data['reqDate'] =$reqDate;
		$data['temp'   ] =$temp;
		$data['tmx'    ] =$tmx;
		$data['tmn'    ] =$tmn;
		$data['wfKor'  ] =$wfKor;
		$data['wfEn'   ] =$wfEn;

//		var_dump($reqDate);
//		var_dump($temp);
//		var_dump($tmx);
//		var_dump($tmn);
//		var_dump($wfKor);
//		var_dump($wfEn);

		//var_dump($weather);
		//$ch = curl_init();
		//$url = "https://leesangminhq.slack.com/services/hooks/slackbot?token=zgza0MkDsauEeGGojQKK4JkH&channel=restlife";
		//curl_setopt($ch,CURLOPT_URL,$url);
		//curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

		//$output = curl_exec($ch);
		//curl_close($ch);
		//var_dump($this->session);
		//var_dump($this -> sessions);
		$data['img_get'] = $img_get;
		$this->load->view('include/layout',$this->sessions);
		$this->load->view('main',$data);
		$this->load->view('include/footer');
	}

	public function Logout(){

		session_destroy();

		echo "<script>location.href='http://min1512.cafe24.com'</script>";
	}

	public function slack($message, $room = "restlife") {
		$room = ($room) ? $room : "restlife";
		$data = "payload=" . json_encode(array(
				"channel"       =>  "#{$room}",
				"text"          =>  $message
			));

		// You can get your webhook endpoint from your Slack settings
		$ch = curl_init("https://hooks.slack.com/services/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");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);

		// Laravel-specific log writing method
		// Log::info("Sent to Slack: " . $message, array('context' => 'Notifications'));

		return $result;
	}

	public function weather()
	{
		$ch = curl_init("http://www.kma.go.kr/wid/queryDFSRSS.jsp?zone=1171052000");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$object = simplexml_load_string($result);

		return $object->channel;
	}
}
