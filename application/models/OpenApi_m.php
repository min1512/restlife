<?php


class OpenApi_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get(){
		$query = $this->db->get('entries',10);
		return $query->result();
	}

	public function lastregDate()
	{
		$query = "
			select
			 	News.idx,
			 	News.regDate
			from
				naverNews News
			order by News.idx desc limit 1;
		";

		$result = $this->db->query($query);

		return $result->row_array();
	}

	public function web_crowling()
	{
		$query = "
			select
			 	News.idx,
			 	News.orginalLink,
			 	News.regDate
			from
				naverNews News
			order by News.idx desc limit 20;
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}
}
