<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_mdl extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function login($username,$password){
		$username = $this->db->escape_like_str($username);
		$password = $this->db->escape_like_str($password);
		$enctpwd = md5($password);

	  	$this->db->select('organizer_id as admin_id,name');
		$this->db->from('organizer');
		// $this->db->join('user_group ug', 'ug.user_gp_id = u.user_gp_id');
		// $this->db->join('role r', 'r.role_id = ug.role_id');
		$array = array('username' => $username, 'password'=>$enctpwd);
		$this->db->where($array);
	   	$this->db->limit(1);
	   	$query = $this->db->get();
      	if($query->num_rows() == 1)
	   	{
	     	return $query->row();
	   	}
	   	else{
	   		return false;
	   	}
	}

	//check active user session tbl
	function check_active_user($userid){
		$this->db->select('*');
		$this->db->from('session');
		$array = array('userid' => $userid, 'active'=>1);
		$this->db->where($array);
		// $this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->result();
		}else{
			return false;
		}
	}

	//reset active session
	function reset_active_session($userid){
		$data = array(
			'logout_time' => date("Y-m-d H:i:s"),
	        'note' => 'force_logout',
	        'active' => 0
		);
		
		$array = array('userid' => $userid, 'active'=>1);
		$this->db->where($array);
		return $this->db->update('session',$data);
	}

	//add session user
	function add_new_session($userid,$sessionid){
		$data = array(
	        'userid' => $userid,
	        'session_id' => $sessionid,
	        'login_time' => date("Y-m-d H:i:s"),
	        'active' => 1
	        );
		if($this->db->insert('session', $data)){
			return $this->db->insert_id();
		}
	}

	//logout update info in session tbl
	function logout_update_session_tbl($userid){
		$data = array(
			'logout_time' => date("Y-m-d H:i:s"),
	        'note' => 'user_logout',
	        'active' => 0
		);
		
		$array = array('userid' => $userid, 'active'=>1);
		$this->db->where($array);
		$this->db->order_by('session','DESC');
		$this->db->limit(1);
		return $this->db->update('session',$data);
	}

	//check user for access permission
	public function checkUser($id, $name)
	{
		$this->db->select('organizer_id,name');
	  	$this->db->from('organizer');
	   	$this->db->where('organizer_id', $id);
	   	$this->db->where('name', $name);
	   	// $this->db->where('is_active', 1);
	   	$this->db->limit(1);
	   	$query = $this->db->get();
      	if($query->num_rows() == 1)
	   	{
	     	return true;
	   	}
	   	else{
	   		return false;
	   	}
		// $query = $this->userdb->limit(1)->get_where("users", array("user_id" => $id, "name" => $name));
		// return $query->num_rows() === 1;
	}

}	