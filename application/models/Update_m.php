<?php


class Update_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lists($dir,$index_map,$password)
	{

		$query = "
			select
				t.idx,
				t.title,
				t.content,
				t.index_map
			from
				".strtolower($dir)." t
			where
			 t.index_map ='".$index_map."'
			and
			 t.password = '".$password."' 
		";

		$result = $this->db->query($query);

		return $result->row_array();

	}

	public function likeButton($user,$index_map)
	{
		$query = "
			select
				t.idx,
				t.index_map,
				t.user,
				t.use_yn
			from
				like_button t
			where
			 	t.user ='".$user."'
				and
			 	t.index_map = '".$index_map."'
			 	and
			 	t.use_yn = 'Y' 
		";

		$result = $this->db->query($query);

		return $result->row_array();
	}

}
