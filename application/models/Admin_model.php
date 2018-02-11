<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	public function  count_all_table_rows(){
		return array(
			'users'=>$this->db->count_all_results('payments'),
			'influencer'=>$this->db->count_all_results('influencers'),
			'brand'=>$this->db->count_all_results('brands'),
		);
	}
	public function encrypt_key($key){
		return $this->encrypt->encode(base64_encode($key));
	}
	public function decrypt_key($key){
		return base64_decode($this->encrypt->decode($key));
	}
	public function all_table_rorws($table){
		return $this->db->from($table)->get()->result();
	}
	public function get_record($table,$field,$value){
		return $this->db->from($table)->where($field,$value)->get()->result();
	}
	public function get_profile(){
		return $this->db->from('admins')->where('admin_email',$this->session->email)->get()->row();
	}
	public function get_payments(){
		return $this->db->select('influencers.inf_name,brands.brand_name,payments.*')->from('influencers,brands,payments')->where('(payments.payment_to=influencers.inf_id) AND (payments.payment_from=brands.brand_id)')->get()->result();
	}
	public function delete_row($data){
		return ($this->db->delete($data['table'],$data['where']))? TRUE: FALSE;
	}
	public function update_row($data){
		return ($this->db->set('is_active','!is_active',FALSE)->where($data['where'])->update($data['table']))?TRUE:FALSE;
	}
	public function update_payment(){
		return ($this->db->set('payment_status',1)->where(array('payment_id'=>$this->input->post('id')))->update('payments'))?TRUE:FALSE;
	}
	public function register_admin() {
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		if($password) {
			$data=array(
				'admin_name'=>$this->input->post('name'),
				'admin_email'=>$this->input->post('email'),
				'admin_phone'=>$this->input->post('phone'),
				'admin_password'=>$password
			);
			return ($this->db->insert('admins',$data))?TRUE:FALSE;
		}
		else {
			return FALSE;
		}
	}
	function get_session_admin(){
		$data=array(
			'admin_email'=>$this->input->post('email'),
			'admin_password'=>$this->input->post('pwd')
		);
		$query_test = $this->db->select('admin_password as pwd')->from('admins')->where('admin_email', $data['admin_email'])->get();

		if(password_verify($data['admin_password'], $query_test->row()->pwd)) {
			$query=$this->db->select('admin_name as name,admin_email as email,admin_phone as phone,admin_image as image')->from('admins')
			->where('admin_email',$data['admin_email'])->get();
			return $query->row();
		}
		else
		return FALSE;
	}
	public function update_profile($image_name){
		$data=array(
			'admin_name'=>$this->input->post('profile_name'),
			'admin_phone'=>$this->input->post('profile_contact'),
			'admin_image'=>$image_name
		);
		$this->db->set($data);
		$this->db->where('admin_email',$this->session->email);
		return ($this->db->update('admins'))?TRUE:FALSE;

	}
}
