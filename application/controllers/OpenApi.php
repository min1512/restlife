<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class OpenApi
 * @property OpenApi_m $OpenApi_m
 *
 */
class OpenApi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('OpenApi_m');
		$this->load->library('session');
		$this->load->helper('url');
		$this->sessions = array();
		$this->sessions['session_id'] = $this->session->id;
		$this->sessions['session_name'] = $this->session->name;
	}

	public function naverNews()
	{
		$lastregDate = $this->OpenApi_m->lastregDate();

		$date = date('Y-m-d');
		//$date = date('Y-m-d',strtotime($date."-2 day"));
		$date = explode('-',$date);
		$date = $date[1].'월'.$date[2].'일 헤드라인';
		$date = '오늘의 헤드라인';
		$client_id = "GWm32zXzdOveq0oNSAoo";
		$client_secret = "5uuvos63jd";
		$encText = urlencode($date);
		$url = "https://openapi.naver.com/v1/search/news.json?query=".$encText."&display=5&start=1"; // json 결과
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
		//echo "status_code:".$status_code."";
		curl_close ($ch);
		if($status_code == 200) {
			//echo $response;
		} else {
			echo "Error 내용:".$response;
			return false;
		}
		$response = json_decode($response);
		//var_dump($response);
		$result = array();
		foreach ($response as $k => $v){
			if($k =='items'){
				foreach ($v as $k2 => $v2){
					foreach ($v2 as $k3 => $v3){
						if($k3 == 'title'){
							$title = $v3; //기사 제목
						}else if($k3 == 'originallink'){
							$orginalLink = $v3; //검색 결과 문서의 제공 언론사 하이퍼텍스트 link를 나타낸다.
						}else if($k3 == 'link'){
							$link = $v3; //검색 결과 문서의 제공 네이버 하이퍼텍스트 link를 나타낸다.
						}else if($k3 == 'description'){
							$description = $v3; //검색 결과 문서의 내용을 요약한 패시지 정보이다. 문서 전체의 내용은 link를 따라가면 읽을 수 있다. 패시지에서 검색어와 일치하는 부분은 태그로 감싸져 있다.
						}else if($k3 == 'pubDate'){
							$pubDate = $v3; //검색 결과 문서가 네이버에 제공된 시간이다.
						}
					}
					$result['title'] = $title;
					$result['orginalLink'] = $orginalLink;
					$result['link'] = $link;
					$result['description'] = $description;
					$result['pubDate'] = $pubDate;
					$result['regDate'] = date('Y-m-d H:i:s');
					$result['updDate'] = date('Y-m-d H:i:s');
					$this->db->insert('naverNews',$result);
				}
			}
		}
	}

	public function web_crowling()
	{
		$web_crowling = $this->OpenApi_m->web_crowling();

		foreach ($web_crowling as $k => $v){
			foreach ($v as $k2 => $v2){
				if($k2 =='orginalLink'){
					$url = $v2;
				}

				if(!empty($url)){
					if(strpos($url,'newspim')){
						$this->img_crawl($url);
					}else{
						continue;
					}
				}

			}
		}


	}

	public function img_crawl($url)
	{
		$this->load->library('Snoopy');
		$snoopy = new Snoopy;
		$this->snoopy->fetch($url);
		$result = preg_replace("/ style=(\"|\')?([^\"\']+)(\"|\')?/","",$this->snoopy->results);
		$result_1 = explode('<div id="wrap">',$result);
		$result_2 = explode('<div id="news_contents" itemprop="articleBody">',$result_1[1]);
		$result_3 = explode('<header>',$result_2[0]);
		$result_4 = explode('<div class="container">',$result_3[1]);
		$result_5 = explode('<div class="bodynews">',$result_4[1]);
		$result_6 = explode('<div id="news_contents" itemprop="articleBody">',$result_5[1]);
		$result_7 = explode('<table>',$result_6[0]);
		//preg_match('/<div class=\"container\">(.*?)<\/div>/is', $result, $html);
		preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $result_7[1], $html);
		$imgSrc = $html[1];

		$data = array();
		$data['imgUrl'] = $imgSrc;
		$where = array(
			'orginalLink' => $url
		);

		$this->db->update('naverNews',$data,$where);
	}

}
