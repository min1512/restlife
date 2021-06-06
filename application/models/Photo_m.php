<?php


class Photo_m extends CI_Model
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
			$query_add = "and t.index_map = '.$index.'and t.use_yn='Y'";
		}else{
			$query_add ="and t.use_yn='Y'";
		}

		$query = "
			select
				im.index
			 	,i.img_name      as title_name
			 	,im.dir         as dir
			 	,im.jpg_name    as jpg_name
			 	,im.jpg_src     as jpg_src
			 	,t.title        as title
			 	,t.content      as content
			 	,t.password     as password
			 	,t.reg_date     as reg_date
			from
				img_map im
				inner join img i 
				on i.idx = im.idx
				and i.img_name = 'photo'
				inner join photo t 
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
			insert into foods('title','content','user') values ('".null."','".$title."','".$content."','".$user."')
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

	public function likeButtonCount($index)
	{
		$query = "
			select
			 	*     
			from
				like_button lb
			where
				lb.index_map = '".$index."'
				and
				lb.use_yn = 'Y'  	
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}

	public function replyComment($index)
	{
		$query = "
			select
			 	rp.user,
			 	rp.comment,
			 	rp.REG_DT     
			from
				reply rp
			where
				rp.index_map = '".$index."'
				and
				rp.use_yn = 'Y'  	
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}

    public function img_get_detail_list($index,$param)
    {
        if(!empty($index)){
            $query_add = "and t.index_map = '.$index.'and t.use_yn='Y'";
        }else{
            $query_add ="and t.use_yn='Y'";
        }

        $query_limit = "limit ".$param['startLimit'].", ".$param['rdoLimitNumRows']."";

        $query = "
			select
				im.index
			 	,i.img_name      as title_name
			 	,im.dir         as dir
			 	,im.jpg_name    as jpg_name
			 	,im.jpg_src     as jpg_src
			 	,t.title        as title
			 	,t.content      as content
			 	,t.password     as password
			 	,t.reg_date     as reg_date
			from
				img_map im
				inner join img i 
				on i.idx = im.idx
				and i.img_name = 'photo'
				inner join photo t 
				on t.index_map = im.index
				".$query_add."
				".$query_limit."
		";
        //var_dump($query);
        $result = $this->db->query($query);

        return $result->result_array();
    }

	public function ckCountView( $dir,$index,$ip )
	{
		$query = "
			select
			 	CV.idx,
			    CV.ip
			from
				countViews CV
			where
				CV.chkViews = '".$dir."'
					and
				CV.index_map = '".$index."'
					and
				CV.ip = '".$ip."'  	
		";

		$result = $this->db->query($query);

		return $result->row_array();
	}

	public function CountView( $dir,$index )
	{
		$query = "
			select
			 	*
			from
				countViews CV
			where
				CV.chkViews = '".$dir."'
					and
				CV.index_map = '".$index."'					  	
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}
}
