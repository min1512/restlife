<?php


class Shopping_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get(){
		$query = $this->db->get('entries',10);
		return $query->result();
	}

	public function img_get($index)
	{
		if(!empty($index)){
			$query_add = 'and t.index_map = '.$index.'';
		}else{
			$query_add ='';
		}

		$query = "
			select
				im.index
			 	,i.img_name      as title_name
			 	,im.dir         as dir
			 	,im.jpg_name    as jpg_name
			 	,t.content      as content
			from
				img_map im
				inner join img i 
				on i.idx = im.idx
				inner join shopping t 
				on t.index_map = im.index
				".$query_add."
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}

	public function upload($index,$idx,$dir,$jpg_name){
		$query = "
			insert into img_map values ('".$index."', '".$idx."','".$dir."','".$jpg_name."')
		";

		$result = $this->db->query($query);

		return $result;
	}

	public function uploadForm($title,$content,$user)
	{
		$query = "
			insert into shopping('title','content','user') values ('".null."','".$title."','".$content."','".$user."')
		";

		$result = $this->db->query($query);

		return $result;
	}

	public function get_index($jpg_name){
		$query = "
			select
			 	im.index        
			 	,im.jpg_name     
			from
				img_map im
			where
				im.jpg_name
			like
				'".$jpg_name.'%'."'  	
		";

		$result = $this->db->query($query);

		return $result->row_array();
	}

	public function shopping_list(){
		$query = "
			select
			 	sl.idx        
			 	,sl.img_url
			 	,sl.goods_name
			 	,sl.brand_name
			 	,sl.price
			 	,del_price_percent			 	     
			from
				shoppinglist sl
			where
				sl.use_yn='Y'
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}
}
