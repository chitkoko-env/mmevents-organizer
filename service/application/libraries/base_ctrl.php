<?php 
	class base_ctrl extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->helper('url');
		
			$this->headers = apache_request_headers();
			$this->load->model('Login_mdl');		
		}

		public function post(){
			return  json_decode(file_get_contents("php://input"));
		}

		public function auth_chk(){

			if(!isset($this->headers["Authorization"]) || empty($this->headers["Authorization"]))
			{
				$this->output->set_status_header('401');
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'Unauthroized Request')));
				exit();
			}
			else
			{
				// get token
				$token = explode(" ", $this->headers["Authorization"]);
				$token=trim($token[1],'"');
	    		// decode token
				$user = JWT::decode($token, SECRECT_KEY, array('HS256'));
				// Confirm user
				if($this->Login_mdl->checkUser($user->admin_id, $user->name) !== false){
					return array("user"=>$user,'trust'=>true);

				}else{
					// Invalid user
					$this->output->set_status_header('401');
					echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'Expire Token')));
					exit();
				}
			}
		}
	}

?>