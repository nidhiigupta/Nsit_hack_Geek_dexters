<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function send_contact_mail(){
		$data=array(
			'name'=>$this->input->post('name'),
			'email'=>$this->input->post('email'),
			'subject'=>$this->input->post('subject'),
			'message'=>$this->input->post('msg'),
			'time'=>date('Y-m-d:h:i:s')
		);
		if($this->db->insert('contact_us',$data))
			return TRUE;
		else
			return FALSE;
	}
}