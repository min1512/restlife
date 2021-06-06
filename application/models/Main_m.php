<?php


class Main_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get(){
		$query = $this->db->get('entries',10);
		return $query->result();
	}

	public function img_get()
	{
		$query = "
			select
			 	i.img_name      as title_name
			 	,im.dir         as dir
			 	,im.jpg_name    as jpg_name
			from
				img_map im
				inner join img i 
				on i.idx = im.idx
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}
	public function naverNews()
	{
		$query = "
			select
			 	News.idx,
			 	News.title,
			 	News.orginalLink,
			 	News.imgUrl,
			 	News.description,
			 	News.pubDate,
			 	News.regDate
			from
				naverNews News
			order by News.regDate desc
			limit 5
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}
}
