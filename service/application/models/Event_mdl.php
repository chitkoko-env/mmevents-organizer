<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_event_list($data){
		$chkorganizerid = $this->db->escape_like_str($data->organizerid);

	  	$this->db->select('e.*,ec.*,sc.sub_category_name,c.category_name,ci.city_name,t.township_name, v.v_name');
		$this->db->from('event e');
		$this->db->join('event_content ec', 'ec.event_id = e.event_id');
		$this->db->join('sub_category sc', 'sc.sub_category_id = e.sub_category_id');
		$this->db->join('category c', 'c.category_id = sc.category_id');
		$this->db->join('city ci', 'ci.city_id = e.city_id');
		$this->db->join('township t', 't.township_id = e.township_id');
		$this->db->join('venue v', 'v.venue_id = e.venue_id');
		$array = array('e.organizer_id' => $chkorganizerid);
		$this->db->where($array);
		$q = $this->db->get();
		return $q->result();
	}

	function add_event($data){
		$eventdata=array(
				"organizer_id"=>$this->db->escape_like_str($data->organizerid),
				"sub_category_id"=>$this->db->escape_like_str($data->subcateid),
				"venue_id"=>$this->db->escape_like_str($data->venueid),
				"city_id"=>$this->db->escape_like_str($data->cityid),
				"township_id"=>$this->db->escape_like_str($data->townshipid),
				"fb_link"=>$this->db->escape_like_str($data->fblink),
				"email"=>$this->db->escape_like_str($data->email),
				"phone"=>$this->db->escape_like_str($data->phone),
				"fax"=>$this->db->escape_like_str($data->fax),
				"website"=>$this->db->escape_like_str($data->weblink),
				"contact"=>$this->db->escape_like_str($data->caddress)
			);

		if($this->db->insert("event",$eventdata)){
			$eventid = $this->db->insert_id();
			$eventcdata=array(
					"event_id"=>$eventid,
					"title"=>$this->db->escape_like_str($data->etitle),
					"ec_description"=>$this->db->escape_like_str($data->description)
				);
			return $this->db->insert("event_content",$eventcdata);
		}
	}

	function update_event($data){
		$chkeventid = $this->db->escape_like_str($data->eventid);
		$d=array(
				"sub_category_id"=>$this->db->escape_like_str($data->subcateid),
				"venue_id"=>$this->db->escape_like_str($data->venueid),
				"city_id"=>$this->db->escape_like_str($data->cityid),
				"township_id"=>$this->db->escape_like_str($data->townshipid),
				"fb_link"=>$this->db->escape_like_str($data->fblink),
				"email"=>$this->db->escape_like_str($data->email),
				"phone"=>$this->db->escape_like_str($data->phone),
				"fax"=>$this->db->escape_like_str($data->fax),
				"website"=>$this->db->escape_like_str($data->weblink),
				"contact"=>$this->db->escape_like_str($data->caddress)
			);

		if($this->db->update("event",$d,array("event_id"=>$chkeventid))){
			$eventcdata=array(
					"title"=>$this->db->escape_like_str($data->etitle),
					"ec_description"=>$this->db->escape_like_str($data->description)
				);
			return $this->db->update("event_content",$eventcdata,array("event_id"=>$chkeventid));
		}
	}

	//get city data list
	function get_city_list(){
		$this->db->select("*");
		$this->db->from("city");
		$q=$this->db->get();
		return $q->result();
	}

	//get township data list
	function get_township_list($data){
		$chkcityid = $this->db->escape_like_str($data->cityid);
		$this->db->select("*");
		$this->db->from("township");
		$array = array('city_id' => $chkcityid);
		$this->db->where($array);
		$q=$this->db->get();
		return $q->result();
	}

	//get category list
	function get_category_list(){
		$this->db->select("*");
		$this->db->from("category");
		$q=$this->db->get();
		return $q->result();
	}

	//get sub category list
	function get_subcategory_list($data){
		$chkcateid = $this->db->escape_like_str($data->cateid);
		$this->db->select("*");
		$this->db->from("sub_category");
		$array = array('category_id' => $chkcateid);
		$this->db->where($array);
		$q=$this->db->get();
		return $q->result();
	}

	//get venue list
	function get_venue_list(){
		$this->db->select("venue_id,v_name");
		$this->db->from("venue");
		$q=$this->db->get();
		return $q->result();
	}

	function get_event_detail($data){
		$chkorganizerid = $this->db->escape_like_str($data->userid);
		$chkeventid = $this->db->escape_like_str($data->eventid);

	  	$this->db->select('e.*,ec.*,sc.sub_category_name,c.category_name,c.category_id,ci.city_name,t.township_name, v.v_name, ed.*');
		$this->db->from('event e');
		$this->db->join('event_content ec', 'ec.event_id = e.event_id');
		$this->db->join('sub_category sc', 'sc.sub_category_id = e.sub_category_id');
		$this->db->join('category c', 'c.category_id = sc.category_id');
		$this->db->join('city ci', 'ci.city_id = e.city_id');
		$this->db->join('township t', 't.township_id = e.township_id','left');
		$this->db->join('venue v', 'v.venue_id = e.venue_id');
		$this->db->join('event_by_date ed', 'ed.event_id = e.event_id','left');
		$array = array('e.organizer_id' => $chkorganizerid,'e.event_id' => $chkeventid);
		$this->db->where($array);
		$q = $this->db->get();
		return $q->result();
	}

	//add event date
	function add_event_date($data){
		$chkeventid = $this->db->escape_like_str($data->eventid);
		$emdatechk = $this->db->escape_like_str($data->edatechk);
		if($emdatechk==true){
			$enddate = $this->db->escape_like_str($data->enddate);
		}else{
			$enddate = 0;
		}
		$eventcdata=array(
				"event_id"=>$chkeventid,
				"start_date"=>$this->db->escape_like_str($data->startdate),
				"end_date"=> $enddate,
				"start_time"=>$this->db->escape_like_str($data->starttime),
				"end_time"=>$this->db->escape_like_str($data->endtime)
			);
		return $this->db->insert("event_by_date",$eventcdata);
	}

	//update event date
	function update_event_date($data){
		$chkeventid = $this->db->escape_like_str($data->eventid);
		$emdatechk = $this->db->escape_like_str($data->edatechk);
		if($emdatechk==true){
			$enddate = $this->db->escape_like_str($data->enddate);
		}else{
			$enddate = 0;
		}
		$eventcdata=array(
				"start_date"=>$this->db->escape_like_str($data->startdate),
				"end_date"=> $enddate,
				"start_time"=>$this->db->escape_like_str($data->starttime),
				"end_time"=>$this->db->escape_like_str($data->endtime)
			);
		return $this->db->update("event_by_date",$eventcdata,array("event_id"=>$chkeventid));
	}

	//upload event cover image
	function upload_cover_img($eventid,$imgname){
		$chkeventid = $this->db->escape_like_str($eventid);
		$chkimgname = $this->db->escape_like_str($imgname);

		$eventcdata=array(
					"imgfile"=>$chkimgname
			);
		return $this->db->update("event",$eventcdata,array("event_id"=>$chkeventid));
	}

	//upload event gallery image
	function upload_gallery_img($eventid,$imgname,$userid){
		$chkeventid = $this->db->escape_like_str($eventid);
		$chkimgname = $this->db->escape_like_str($imgname);
		$chkuserid = $this->db->escape_like_str($userid);

		$eventcdata=array(
					"event_id"=>$chkeventid,
					"imgfile"=>$chkimgname,
					"user_id"=>$chkuserid
			);
		return $this->db->insert("event_images",$eventcdata);
	}

	//get event gallery list
	function get_event_gallery_list($data){
		$chkeventid = $this->db->escape_like_str($data->eventid);
		$this->db->select("*");
		$this->db->from("event_images");
		$array = array('event_id' => $chkeventid);
		$this->db->where($array);
		$q=$this->db->get();
		return $q->result();
	}

	//event image del
	function drop_photo($eimgid){ 
		$chkeimgid = $this->db->escape_like_str($eimgid);
	  	return $this->db->delete('event_images', array('eimg_id' => $chkeimgid));
	} 

	//add event map
	function add_event_map($data){
		$chkeventid = $this->db->escape_like_str($data->eventid);
		
		$eventcdata=array(
					"map_lat"=> $this->db->escape_like_str($data->emaplat),
					"map_lng"=> $this->db->escape_like_str($data->emaplng)
			);
		return $this->db->update("event",$eventcdata,array("event_id"=>$chkeventid));
	}

}
?>