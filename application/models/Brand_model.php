<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {
	private $table;
	private $primary_key;

	public function __construct() {
		parent::__construct();
		$this->table='brands';
		$this->primary_key='id';
	}
	public function get_id(){
		return $this->db->select($this->primary_key)->from($this->table)->where('email',$this->session->email)->get()->row()->id;
	}
	public function disable_profile(){
		$this->db->set('is_active','!is_active');
		$this->db->where('email',$this->session->email);
		return ($this->db->update($this->table))?TRUE:FALSE;
	}
	public function disable_campaign($id){
		$this->db->set('is_active','!is_active');
		$this->db->where('id',$id);
		return ($this->db->update('campaigns'))?TRUE:FALSE;
	}
	public function count_all_table_rows(){
		return array(
			'users'=>$this->db->count_all_results('payments'),
			'influencer'=>$this->db->count_all_results($this->table),
			'brand'=>$this->db->count_all_results($this->table),
		);
	}
	public function all_table_rows($table){
		return $this->db->from($table)->get()->result();
	}
	public function get_analytics_data($camp_id) {
		$q = "SELECT * FROM campaigns WHERE camp_id={$camp_id}";
		$data=$this->db->query($q);
		return $data->result_array();
	}

	public function get_campaigns($offer) {
		$brand_id = $this->get_id();
		if($offer==2) {
			$data=array(
				'camp_by'=>$brand_id,
				'status'=>'Ongoing',
				'is_active'=>2
			);
			$offer = 0;
		}
		else {
			$data=array(
				'camp_by'=>$brand_id,
				'status'=>'Ongoing',
				'is_active'=>1
			);
		}

		if($offer == 1) {
			$i = 0;
			$camp_ids = [];
			$query = $this->db->select('pro_for')->from('proposals')->where('brand_id', $brand_id)->get()->result_array();
			foreach($query as $r) {
				$camp_ids[$i++] = $r['pro_for'];
			}
		}

		$final = [];
		if($offer == 0) {
			$ids = $this->db->distinct()->select('id,camp_created')->from('campaigns')->where($data)->order_by("camp_created", "desc")->get()->result_array();
		}
		else {
			if($camp_ids) {
				$this->db->where_in('camp_id', $camp_ids);
				$ids = $this->db->distinct()->select('id,camp_created')->from('campaigns')->where($data)->order_by("camp_created", "desc")->get()->result_array();
			}
		}

		$executed = [];
		$execk = 0;
		foreach ($ids as $key => $id) {
			if(in_array($id['id'], $executed)) {
				continue;
			}
			$executed[$execk++] = $id['id'];

			$query = $this->db->select('*')->from('campaigns')->where('id', $id['id'])->get()->result_array();
			if($query) {
				$final[$key] = $query[0];
				$camp_type = '';
				$camp_category = '';
				$total_price = 0;
				foreach ($query as $key1 => $value1) {
					$camp_type .= $value1['camp_type'].'|';
					$camp_category .= $value1['camp_category'].'|';
					$total_price += $value1['camp_price'];
				}
				$final[$key]['total_camp_type'] = $camp_type;
				$final[$key]['total_camp_category'] = $camp_category;
				$final[$key]['total_price'] = $total_price;
			}
		}
		return $final;
	}

	function get_campaign_category(){
		$query="SHOW COLUMNS FROM campaigns LIKE 'status'";
		$r=$this->db->query($query);
		if($r->num_rows()>0){
			$row=$r->row();
			#$options=explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2",$row));
		}
		return $row;
	}
	public function get_record($table, $field, $value){
		return $this->db->from($table)->where($field, $value)->get()->row();
	}
	function add_bank_details(){
		$data['account_holder_name']=$this->input->post('holder-name');
		$data['bank_name']=$this->input->post('bank-name');
		$data['account_number']=$this->input->post('account-number');
		$data['ifsc_code']=$this->input->post('ifsc-code');
		$data['mobile_number']=$this->input->post('mobile-number');

		$data['user_id']=$this->get_id();
		$data['user_type']='Brand';

		return ($this->db->insert('bank_details',$data))?TRUE:FALSE;
	}

	function get_wallet_amount() {
		$brand_id = $this->get_id();
		if($this->db->select('amount')->from('wallets')->where('brand_id', $brand_id)->get()->num_rows()==1){
			return $this->db->select('amount')->from('wallets')->where('brand_id', $brand_id)->get()->row()->amount;
		}else{
			return 0;
		}
	}

	function deduct_wallet($amount) {
		$brand_id = $this->get_id();
		return $this->db->query('UPDATE wallets SET amount=amount-'.$amount.' WHERE brand_id='.$brand_id);
	}

	function addWithdrawRequest($amount) {
		$brand_id = $this->get_id();
		$data['brand_id'] = $brand_id;
		$data['amount'] = $amount;
		$data['status'] = 0;
		return $this->db->insert('withdraw', $data);
	}

	public function get_session_brand(){
		$email=$this->input->post('l-email');
		$pwd=$this->input->post('l-pwd');
		$is_active=1;

		$query_test=$this->db->select('password as pwd')->from($this->table)->where(array('email'=>$email,'is_active'=>$is_active))->or_where(array('username'=>$email))->get();
		if($query_test->num_rows()==1){
			if(password_verify($pwd, $query_test->row()->pwd)) {
				$query=$this->db->select('name,email,phone,image,doc_type')
				->from($this->table)
				->where('email',$email)->or_where('username',$email)
				->get();
				return $query->row();
			}
			else
			return False;
		}
		else
		return False;
	}
	public function encrypt_key($key){
		return $this->encrypt->encode(base64_encode($key));
	}
	public function decrypt_key($key){
		return base64_decode($this->encrypt->decode($key));
	}
	public function register_brand(){
		$password = password_hash($this->input->post('pwd'), PASSWORD_DEFAULT);
		if($password) {
			$data=array(
				'name'=>$this->input->post('fname').' '.$this->input->post('lname'),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('mobile'),
				'password'=>$password,
				'image'=>'/images/default_profile_pic.png',
				'industry'=>$this->input->post('industry'),
				'is_active'=>0,
				'doc_type'=>$this->input->post('doc_type'),
			);
			if($this->db->insert('brands', $data)) {
				$brand_id = $this->db->select('id')->from('brands')->where('email', $this->input->post('email'))->get()->row()->id;
				$unique_user = 'Geek'.$brand_id;
				$this->db->set(array('username'=>$unique_user));
				$this->db->where('id',$brand_id);
				$this->db->update('brands');
				$data = [];
				$data['brand_id'] = $brand_id;
				$data['amount'] = '0.0';
				$data['created'] = time();
				$this->db->insert('wallets', $data);
				return $unique_user;
			}
			else {
				return FALSE;
			}
		}
		else {
			return FALSE;
		}
	}

	public function add_campaign($image_name, $data){
		$this->db->trans_start();
		$val = $this->db->insert('campaigns',$data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		if($val)
		return $insert_id;
		else
		return FALSE;
	}
	public function add_cm_data($cm_id, $cm_link, $id) {
		$data = array(
			'cm_id' => $cm_id,
			'cm_link' => $cm_link
		);
		$this->db->trans_start();
		$this->db->where('camp_id', $id);
		$val = $this->db->update('campaigns', $data);
		$this->db->trans_complete();
		return $val;
	}
	public function update_profile($image_name){
		$data=array(
			'name'=>$this->input->post('profile_name'),
			'phone'=>$this->input->post('profile_contact'),
			'image'=>$image_name,
			'website'=>$this->input->post('profile_website')
		);

		$this->session->name = $this->input->post('profile_name');
		$this->session->phone = $this->input->post('profile_contact');
		$this->session->image = $image_name;
		$this->session->website = $this->input->post('profile_website');

		$this->db->set($data);
		$this->db->where('email',$this->session->email);
		return ($this->db->update($this->table))?TRUE:FALSE;
	}
	public function checkUser(){
		$data=$this->input->post();

		$this->db->select($this->primary_key);
		$this->db->from($this->table);
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();

		if($prevCheck > 0) {
			$prevResult = $prevQuery->row_array();
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update($this->table,$data,array($this->primary_key=>$prevResult[$this->primary_key]));
			$userID = $prevResult[$this->primary_key];
		}
		else {
			$data['created'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			$insert = $this->db->insert($this->table,$data);
			$userID = $this->db->insert_id();
		}

		return $userID?$userID:FALSE;
	}
	function get_influencers($cat){

		$data['is_active']=1;
		if($cat=='fbradio'){ // if changed by ajax request
			$order = 'fb_followers';
		}
		elseif($cat=='twradio'){ // if changed by ajax request
			$order = 'tw_followers';
		}
		elseif($cat=='insradio'){ // if changed by ajax request
			$order = 'ins_followers';
		}
		elseif($cat=='youradio'){ // if changed by ajax request
			$order = 'yt_followers';
		}elseif($cat=='ALL'){
			$order = 'id';
		}

		$query=$this->db->select('*')->from('influencers')->where($data)->get();
		if($query->num_rows()>0) {
			foreach ($query->result() as $value) {

				if($this->db->select('*')->from('tokens')->where('inf_id',$value->id)->where('category','fb')->get()->num_rows()>0){
				$value->fb_followers = $this->db->select_sum('followers')->from('tokens')->where('inf_id',$value->id)->get()->row()->followers;
				}
				if($this->db->select('*')->from('tokens')->where('inf_id',$value->id)->where('category','tw')->get()->num_rows()>0){
				$value->tw_followers = $this->db->select_sum('followers')->from('tokens')->where('inf_id',$value->id)->get()->row()->followers;
				}
				if($this->db->select('*')->from('tokens')->where('inf_id',$value->id)->where('category','yt')->get()->num_rows()>0){
				$value->yt_followers = $this->db->select_sum('followers')->from('tokens')->where('inf_id',$value->id)->get()->row()->followers;
				}
				if($this->db->select('*')->from('tokens')->where('inf_id',$value->id)->where('category','ins')->get()->num_rows()>0){
				$value->ins_followers = $this->db->select_sum('followers')->from('tokens')->where('inf_id',$value->id)->get()->row()->followers;
				}
				$value->image=$this->custom_functions->check_img($value->image);
			}
			return $query->result();
		}
		else
		return FALSE;
	}
	function get_bank_record(){
		$data['user_id']=$this->get_id();
		$data['user_type']='Brand';
		$query=$this->db->where($data)->get('bank_details');
		return ($query->num_rows()>0)?$query->row():FALSE;
	}

	function get_chats() {
		$cat = $this->input->post('cat');

		if($cat == 0) {
			$inf_id = $this->input->post('id');
			$query = $this->db->query("SELECT DISTINCT brand_id, MAX(chat_id) FROM chats WHERE inf_id = {$inf_id} GROUP BY brand_id ORDER BY MAX(time) DESC, brand_id")->result_array();
			$inf_name = $this->db->select('name')->from('influencers')->where('id', $inf_id)->get()->row()->name;
		}
		else {
			$brand_id = $this->input->post('id');
			$query = $this->db->query("SELECT DISTINCT inf_id, MAX(chat_id) FROM chats WHERE brand_id = {$brand_id} GROUP BY inf_id ORDER BY MAX(time) DESC, inf_id")->result_array();
			$brand_name = $this->db->select('name')->from('brands')->where('id', $brand_id)->get()->row()->name;
		}

		$ret = [];
		$i = 0;

		foreach ($query as $e) {
			$chat_id = $e['MAX(chat_id)'];
			$query2 = $this->db->query("SELECT * FROM chats WHERE chat_id = {$chat_id}")->result_array();
			$query2 = $query2[0];

			if($cat == 0) {
				$query2['brand_name'] = $this->db->select('name')->from('brands')->where('id', $query2['brand_id'])->get()->row()->name;
				$query2['inf_name'] = $inf_name;
			}
			else {
				$query2['brand_name'] = $brand_name;
				$query2['inf_name'] = $this->db->select('name')->from('influencers')->where('id', $query2['inf_id'])->get()->row()->name;
			}

			$ret[$i] = $query2;
			$i = $i + 1;
		}

		return $ret;
	}
	function get_conv() {
		$brand_id = $this->input->post('brand_id');
		$inf_id = $this->input->post('inf_id');

		$query = $this->db->query("SELECT * FROM chats WHERE brand_id = {$brand_id} AND inf_id = {$inf_id} ORDER BY time ASC")->result_array();
		$query['data'] = $query;
		$query['brand_name'] = $this->db->select('name')->from('brands')->where('id', $brand_id)->get()->row()->name;
		$query['inf_name'] = $this->db->select('name')->from('influencers')->where('id', $inf_id)->get()->row()->name;
		return $query;
	}
	function insert_chats($data) {
		if($this->db->insert('chats',$data)){
			return true;
		}else{
			return false;
		}

	}
	function insert_token($data){
		extract($data);
		$this->db->where('id', $id);
		$this->db->update($table_name, array('token' => $token));
		return true;

	}

	function change_pass($data){
		extract($data);
		$check = $this->db->select('token')->from('brands')->where('id',$id)->get()->result_array();
		$password = password_hash($pwd, PASSWORD_DEFAULT);
		if($check[0]['token']==$token){
			$this->db->where('id', $id);
			$this->db->update($table_name, array('token' => Null,'password'=>$password));
			return true;
		}
		else{
			return false;
		}
	}

	function insert_activate_token($email, $token) {
		$this->db->where('email', $email);
		return $this->db->update('brands', ['activate_token' => $token]);
	}

	function getActivateToken($email) {
		return $this->db->select('activate_token')->from('brands')->where('email', $email)->get()->row()->activate_token;
	}

	function activateAccount($email) {
		$data = [];
		$data['is_active'] = 1;
		$this->db->where('email', $email);
		return $this->db->update('brands', $data);
	}

}
