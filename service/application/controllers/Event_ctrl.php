<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Event_ctrl extends base_ctrl
	{
		function __construct()
		{
			parent::__construct();
			$this->headers = apache_request_headers();
			$this->load->model('Event_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		//get event list for related organizer
		function geteventlist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_event_list($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		//add new event
		function addevent(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_event($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		//update event
		function updateevent(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_event($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		//get city list
		function getcitylist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_city_list();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}	

		//get township list
		function gettownshiplist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_township_list($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get category list
		function getcatelist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_category_list();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get sub category list
		function getsubcatelist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_subcategory_list($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get venue list
		function getvenuelist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_venue_list();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//get event detail
		function geteventdetail(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_event_detail($this->post());
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//add event date
		function addeventdate(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_event_date($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		//edit event date
		function editeventdate(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_event_date($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//event cover image file upload
		function do_upload(){
			$data = '';
			$error = '';
			$this->load->library('image_lib');

			$config = array(
				'upload_path' => "./../static/uploadimgs/original/",
				'allowed_types' => "gif|jpg|png|jpeg",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "",
				'max_width' => "",
				'file_name' => $_POST['newfilename']
			);

			$this->load->library('upload', $config);
			if($this->upload->do_upload('file')){
				//for thumbs image
				//your desired config for the resize() function
			    $config = array(
			    'source_image'      => "./../static/uploadimgs/original/".$_POST['newfilename'], //path to the uploaded image
			    'new_image'         => "./../static/uploadimgs/thumbs/", //path to
			    'maintain_ratio'    => true,
			    'width'             => 255,
			    'height'            => 170
			    );
			    $this->image_lib->initialize($config);
    			$this->image_lib->resize();

				$data = array('upload_data' => $this->model->upload_cover_img($_POST['eventid'],$_POST['newfilename']));
				// $data = array('imageid'=>$_POST['imageid'],'imagename'=>$_POST['newfilename']);
				$success = "success";
			}else{
				$error = array('error' => $this->upload->display_errors());
				$success = "fail";
			}
			echo json_encode(array("data" => $data ,"error" => $error,'success'=>$success));	

		}

		//get event gallery images
		function geteventgallery(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_event_gallery_list($this->post());
				echo json_encode($data);	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//event gallery image file upload
		function do_upload_gallery(){
			$data = '';
			$error = '';
			$this->load->library('image_lib');

			$config = array(
				'upload_path' => "./../static/uploadimgs/original/",
				'allowed_types' => "gif|jpg|png|jpeg",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "",
				'max_width' => "",
				'file_name' => $_POST['newfilename']
			);

			$this->load->library('upload', $config);
			if($this->upload->do_upload('file')){
				//for thumbs image
				//your desired config for the resize() function
			    $config = array(
			    'source_image'      => "./../static/uploadimgs/original/".$_POST['newfilename'], //path to the uploaded image
			    'new_image'         => "./../static/uploadimgs/thumbs/", //path to
			    'maintain_ratio'    => true,
			    'width'             => 300,
			    'height'            => 300
			    );
			    $this->image_lib->initialize($config);
    			$this->image_lib->resize();

				$data = array('upload_data' => $this->model->upload_gallery_img($_POST['eventid'],$_POST['newfilename'],$_POST['userid']));
				// $data = array('imageid'=>$_POST['imageid'],'imagename'=>$_POST['newfilename']);
				$success = "success";
			}else{
				$error = array('error' => $this->upload->display_errors());
				$success = "fail";
			}
			echo json_encode(array("data" => $data ,"error" => $error,'success'=>$success));	

		}

		//event image del
		function deleimage(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){

				$originalpath = './../static/uploadimgs/original/';
				$thumbpath = './../static/uploadimgs/thumbs/';
				$data = $this->post();
				$file_photo = $data->imgfile;

		      	if($this->model->drop_photo($data->eimgid)){
		      		$orginalfiledel = unlink($originalpath.$file_photo);
		      		$thumbfiledel = unlink($thumbpath.$file_photo);
		      		if(!$orginalfiledel){
		      			$messages[] = 'Couldn\'t delete original file '.$file_photo;
		      		}else if(!$thumbfiledel){
		      			$messages[] = 'Couldn\'t delete thumb file '.$file_photo;
		      		}else{
		      			$messages[] = 'File '.$file_photo.' deleted successfuly';
		      		}
		       	 	$info = true;
		      	}else{
		        	
		        	$info = false;
		      	}

		      	echo json_encode(array("success"=>$info,"message"=>$messages));	

			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}

		//add event map
		function addeventmap(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_event_map($this->post());
				echo json_encode(array("success"=>$data));		
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}
		}
	}
?>