<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('home_model');
	}
	public function index() {
		$this->load->view('home/header');
		$this->load->view('home/index');
		$this->load->view('home/footer');
	}
	public function brand() {
		$this->load->view('home/header');
		$this->load->view('home/brand');
		$this->load->view('home/footer');
	}
	public function influencer() {
		$this->load->view('home/header');
		$this->load->view('home/influencer');
		$this->load->view('home/footer');
	}
	public function about() {
		$this->load->view('home/header');
		$this->load->view('home/about');
		$this->load->view('home/footer');
	}
	public function contact() {
		$this->load->view('home/header');
		$this->load->view('home/contact');
		$this->load->view('home/footer');
	}
	public function privacy() {
		$this->load->view('home/header');
		$this->load->view('home/privacy');
		$this->load->view('home/footer');
	}

	public function contact_us() {
		$this->form_validation->set_rules('msg','Query','required|xss_clean|trim');
		$this->form_validation->set_rules('subject','Subject','required|xss_clean|trim');
		$this->form_validation->set_rules('name','Name','required|xss_clean|trim');
		$this->form_validation->set_rules('email','Email','required|xss_clean|valid_email|trim');

		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		$response= array(
			'msg' =>$this->input->post('msg'),
			'subject' =>$this->input->post('subject'),
			'name' =>$this->input->post('name'),
			'email' =>$this->input->post('email')
		);

		if($this->form_validation->run()){
			if($this->home_model->send_contact_mail()){
				$response['status']=true;
				$response['msg']='Thank you for contacting us we will contact you shortly!';
			}
			else{
				$response['errors']='Oh No! , Try Again';
			}
		}
		else{
			$errors=array();
			foreach ($this->input->post() as $key => $value) {
				$errors[$key]=form_error($key);
			}
			$response['errors']=array_filter($errors);
		}

		header('Content-Type:application/json');
		exit(json_encode($response));
	}

	public function dashboard_data() {
		$this->db->distinct();
		$this->db->select('id');
		$this->db->from('influencers');
		$query=$this->db->get();
		$inf = $query->num_rows();

		$this->db->distinct();
		$this->db->select('id');
		$this->db->from('brands');
		$query2=$this->db->get();
		$brands = $query2->num_rows();

		$this->db->distinct();
		$this->db->select('camp_id');
		$this->db->from('campaigns');
		$query3=$this->db->get();
		$camp = $query3->num_rows();

		$this->db->select('chat_id');
		$this->db->distinct();
		$this->db->from('chats');
		$query4=$this->db->get();
		$chta = $query4->num_rows();

		$retVal= array('infcount'=>$inf,'brandcount'=>$brands,'campcount'=>$camp,'chatscount'=>$chta);
		return $retVal;
	}
}
