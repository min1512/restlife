<?php


class Login_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *
	 * 중복 아이디 체크
	 */
	public function checkId($ID)
	{
		$query = "
			select
				u.idx
			from
				user u
			where
				u.id = '".$ID."'
		";

		$result = $this->db->query($query);

		return $result->row_array();
	}

	/**
	 *
	 * 회원가입 성공시 insert
	 */
	public function insert_user($data)
	{
		$query="
			insert into user(id,pw,name,birthday,phonetel,regdate) values('".$data['id']."', password('".$data['pw']."'), '".$data['name']."', '".$data['birthday']."', '".$data['phonetel']."', '".date('Y-m-d H:i:s')."' )
		";

		$result = $this->db->query($query);

		return $result;
	}

	/**
	 * @return mixed
	 */
	public function checkLoginForm($data)
	{
		$query = "
			select
				u.idx,
				u.id,
				u.name
			from
				user u
			where
				u.id = '".$data['id']."'
			and
				u.pw = password('".$data['pw']."')
		";

		$result = $this->db->query($query);

		return $result->row_array();
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
				and i.img_name = 'food'
				inner join foods t 
				on t.index_map = im.index
				".$query_add."
		";

		$result = $this->db->query($query);

		return $result->result_array();
	}

	/**
	 * 인기 많은 블로그 최상위 부터 호출
	 *
	 */
	public function img_get_all($index)
	{
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
				and i.img_name = 'food'
				inner join foods t 
				on t.index_map = im.index
				and t.use_yn='Y'
				and t.index_map != '".$index."'
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
}
