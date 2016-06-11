<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('./application/libraries/base_ctrl.php');

class Login_ctrl extends base_ctrl {

	public function __construct() {
		parent::__construct();		
		$this->headers = apache_request_headers();
	    $this->load->model('Login_mdl');
	}
	public function index(){
		echo 'hello';
	}

	public function login()
	{
			// check ajax request
		if($this->input->is_ajax_request())
		{
			// check post parameter
			if(!$this->input->post("username") || !$this->input->post("password"))
			{
				echo json_encode(array("code" => 2, "response" => "Data insufficient"));
			}
			$uname = $this->input->post("username");
			$password = $this->input->post("password");
			// check login
			$user = $this->Login_mdl->login($uname, $password);

			// $sid=$this->Login_mdl->addsession($user->user_id,$user->user_name,$user->db_pass);
			
			if($user !== false)
			{
				// $chksesstbl = $this->Login_mdl->check_active_user($user->user_id);
				// if($chksesstbl){
				// 	$this->Login_mdl->reset_active_session($user->user_id);
				// }
				// $sessionid = session_id();
				// $sid = $this->Login_mdl->add_new_session($user->user_id,$sessionid);
			
	    		$user->iat = time();
				$user->exp = time() + 28800000; //8 hr extend; default 5000 
				// $user->sid= $sid;
				//encdoe token
				$jwt = JWT::encode($user, SECRECT_KEY);
				echo json_encode(array("data" =>$user,'token'=>$jwt,
					"status" => array("code" => 0,'success'=>true,'msg'=>'ok')));
			}else{
				echo json_encode(array("data" =>'','token'=>'',
					"status" => array("code" => 0,'success'=>false,'msg'=>'')));
			}
		}
	}
	
	// public function check_active(){

	// 	if(!isset($this->headers["Authorization"]) || empty($this->headers["Authorization"])){
	// 		$this->output->set_status_header('401');
	// 		echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'Expire Token')));
	// 	}else
	// 	{  
	// 		// get token
	// 		$token = explode(" ", $this->headers["Authorization"]);
	// 		$token=trim($token[1],'"');
 //    		// decode token
	// 		$user = JWT::decode($token, SECRECT_KEY, array('HS256'));
	// 		$data=$this->Login_mdl->check_user($user->user_id,$user->sid);
	// 		echo json_encode(array("status" => array("code" => 0,'success'=>true),"data"=>$data));
	// 	}	
	// }

	public function logout(){

		$uid=$this->input->post("uid");
		$res=$this->Login_mdl->logout_update_session_tbl($uid);

		echo json_encode(array("success" => $res));
		// echo "success";
	}

}
