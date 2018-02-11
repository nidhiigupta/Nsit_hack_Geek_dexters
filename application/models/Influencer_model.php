<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Influencer_model extends CI_Model {

	private $table;
	private $primary_key;

	public function __construct()
	{
		parent::__construct();
		$this->table='influencers';
		$this->primary_key='id';
	}
	public function get_instagram_access_token() {
		return $this->db->select('instagram_access_token')->from('tokens')->where('token_id', '1')->get()->row()->instagram_access_token;
	}
	public function get_id(){
		return $this->db->select($this->primary_key)->from($this->table)->where('email',$this->session->email)->get()->row()->id;
	}
	public function store_page_id($page_id,$phone)
	{
		$this->db->query('update influencers set page_id="'.$page_id.'" where phone='.$phone);
	}
	public function get_outh_id(){
		$email=$this->session->email;
		$out=$this->db->query('SELECT oauth_uid FROM influencers where email="'.$email.'"')->result();
		return $out;
	}
	public function store_post_id($post_id,$camp_id,$link)
	{
		$this->db->query('update campaigns set post_id="'.$post_id.'",camp_link="'.$link.'" where camp_id='.$camp_id);
	}
	public function count_all_table_rows(){
		return array(
			'users'=>$this->db->count_all_results('payments'),
			'influencer'=>$this->db->count_all_results($this->table),
			'brand'=>$this->db->count_all_results('brands'),
		);
	}
	public function get_analytics_data($camp_id) {
		$q = "SELECT * FROM campaigns WHERE camp_id={$camp_id}";
		$data=$this->db->query($q);
		return $data->result_array();
	}
	public function update_profile($image_name){
		$data=array(
			'name'=>$this->input->post('profile_name'),
			'phone'=>$this->input->post('profile_contact'),
			'image'=>$image_name
		);

		$this->session->name = $this->input->post('profile_name');
		$this->session->phone = $this->input->post('profile_contact');
		$this->session->image = $image_name;

		$this->db->set($data);
		$this->db->where('email',$this->session->email);
		return ($this->db->update($this->table))?TRUE:FALSE;
	}
	public function all_table_rows($table){
		return $this->db->from($table)->get()->result();
	}
	public function get_record($table,$field,$value){
		return $this->db->from($table)->where($field,$value)->get()->row();
	}
	public function encrypt_key($key){
		return $this->encrypt->encode(base64_encode($key));
	}
	public function decrypt_key($key){
		return base64_decode($this->encrypt->decode($key));
	}
	function get_session_inf(){
		$data=array(
			'email'=>$this->input->post('l-email'),
			'password'=>$this->input->post('l-pwd')
		);
		$query_test=$this->db->select('password as pwd')->from($this->table)->where(array('email'=>$data['email'],'is_active'=>1))->or_where(array('username'=>$data['email']))->get();
	
		if($query_test->num_rows()==1){
			if(password_verify($data['password'], $query_test->row()->pwd)){
				$query=$this->db->select('name ,email ,phone , image','username')
				->from($this->table)
				->where('email',$data['email'])->or_where('username',$data['email'])
				->get();
				return $query->row();
			}
			else
			return FALSE;
		}
		else
		return FALSE;
	}
	function register_influencer(){
		$password = password_hash($this->input->post('pwd'), PASSWORD_DEFAULT);
		if($password) {
			$data=array(
				'name'=>$this->input->post('fname').' '.$this->input->post('lname'),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('mobile'),
				'password'=>$password,
				'image'=>'/images/default_profile_pic.png',
				'industry'=>'Patient',
				'is_active'=>0,
				//'type'=>$this->input->post('doc_type'),
			);
			$this->db->insert($this->table,$data);
			$brand_id = $this->db->select('id')->from('influencers')->where('email', $this->input->post('email'))->get()->row()->id;
			$unique_user = 'Doctors'.$brand_id;
			$this->db->set(array('username'=>$unique_user));
			$this->db->where('id',$brand_id);
			$this->db->update('influencers');
			return $unique_user;
		}
		else {
			return FALSE;
		}
	}
	public function setUser($data) {
		$this->db->where('email', $this->session->email);
		return $this->db->update('influencers', $data);
	}
	public function checkUser(){
		$data=$this->input->post();

		$this->db->select($this->primary_key);
		$this->db->from($this->table);
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();

		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update($this->table,$data,array($this->primary_key=>$prevResult[$this->primary_key]));
			$userID = $prevResult[$this->primary_key];
		}else{
			$data['created'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			$insert = $this->db->insert($this->table,$data);
			$userID = $this->db->insert_id();

		}
		return $userID?$userID:FALSE;
	}
	public function get_name($id) {
		$query = $this->db->select('name')->from('influencers')->where('id', $id)->get();
		$name = $query->row();
		$name = json_decode(json_encode($name), True);
		$name = $name['name'];
		return $name;
	}

	public function get_campaigns($offer) {
		$i = 0;
		$camp_ids = [];
		$query = $this->db->select('camp_id')->from('approval')->where(['value' => 1])->get()->result_array();
		foreach($query as $r) {
			$camp_ids[$i++] = $r['camp_id'];
		}

		$inf_id = $this->get_id();
		$data=array(
			'status'=>'Ongoing',
			'is_active'=>1
		);

		if($offer == 1) {
			$i = 0;
			$camp_ids_p = [];
			$query = $this->db->select('pro_for')->from('proposals')->where(['pro_by' => $inf_id, 'approval' => 1])->get()->result_array();
			foreach($query as $r) {
				$camp_ids_p[$i++] = $r['pro_for'];
			}
		}

		$final = [];
		$ids = [];
		if($offer == 0) {
			$ids = $this->db->distinct()->select('id,camp_created')->from('campaigns')->where($data)->order_by("camp_created", "desc")->get()->result_array();
		}
		else {
			if($camp_ids_p) {
				$this->db->where_in('camp_id', $camp_ids_p);
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

			/*if($camp_ids && $offer==0)
			$this->db->where_not_in('camp_id', $camp_ids);*/
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

	public function add_proposals(){
		$q = $this->db->select('camp_by')
		->from('campaigns')
		->where(['camp_id' => $this->input->post('camp_id')])->get();

		$q = $q->row();
		$q = json_decode(json_encode($q), True);
		$brand_id = $q['camp_by'];
		$inf_id = $this->get_id();

		$data['pro_msg'] = $this->input->post('msg');
		$data['brand_id'] = $brand_id;
		$data['pro_name'] = $this->get_name($inf_id);
		$data['pro_price'] = $this->input->post('price');
		$data['pro_for'] = $this->input->post('camp_id');
		$data['pro_by'] = $inf_id;
		if($this->db->insert('proposals',$data)) {
			return $brand_id;
		}
		else {
			return false;
		}
	}

	function add_bank_details(){
		$data['account_holder_name']=$this->input->post('holder-name');
		$data['bank_name']=$this->input->post('bank-name');
		$data['account_number']=$this->input->post('account-number');
		$data['ifsc_code']=$this->input->post('ifsc-code');
		$data['mobile_number']=$this->input->post('mobile-number');

		$data['user_id']=$this->get_id();
		$data['user_type']='Influencer';

		return ($this->db->insert('bank_details',$data))?TRUE:FALSE;
	}
	function get_bank_record(){
		$data['user_id']=$this->get_id();
		$data['user_type']='Influencer';
		$query=$this->db->where($data)->get('bank_details');
		return ($query->num_rows()>0)?$query->row():FALSE;
	}

	function add_approval($pro_id, $camp_id, $inf_id, $name, $image, $video, $content, $value) {
		$data = [];
		$data['pro_id'] = $pro_id;
		$data['camp_id'] = $camp_id;
		$data['video'] = $video;
		$data['name'] = $name;
		$data['inf_id'] = $inf_id;
		$data['image'] = $image;
		$data['content'] = $content;
		$data['value'] = $value;
		$query_test = $this->db->select('image, video')->from('approval')->where('pro_id', $pro_id)->get();
		$count = $query_test->conn_id->affected_rows;
		if($count == 0) {
			$data['brand_id'] = $this->db->select('camp_by')->from('campaigns')->where('camp_id', $camp_id)->get()->row()->camp_by;
			if($this->db->insert('approval', $data)) {
				return ['brand_id' => $data['brand_id'], 'operation' => '1'];
			}
			else {
				return ['brand_id' => 0, 'operation' => '1'];
			}
		}
		else {
			$query_test = $query_test->row();
			$image_del = $query_test->image;
			$video_del = $query_test->video;
			if($image_del != '/assets/images/noimage.png')
			unlink('.'.$image_del);
			unlink('.'.$video_del);
			$this->db->where('pro_id', $pro_id);
			if($this->db->update("approval", ['image' => $image, 'video' => $video, 'content' => $content, 'value' => '0'])) {
				$brand_id = $this->db->select('camp_by')->from('campaigns')->where('camp_id', $camp_id)->get()->row()->camp_by;
				return ['brand_id' => $brand_id, 'operation' => '2'];
			}
			else {
				return ['brand_id' => 0, 'operation' => '2'];
			}
		}
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
	public function claim(){
		$id = intval($this->input->post('id'));
		$inf_id = $this->get_id();
		if($id==intval($this->get_id())){
			$camp = $this->input->post('camp');
			$que = $this->db->select('*')->from('campaigns')->where('camp_id',$camp)->get();
			$que1 = $this->db->select('*')->from('camp_data')->where(['camp_id' => $camp, 'inf_id'=>$inf_id])->get();
			if($que->num_rows()>0){
				$que = $que->result_array();
				$que1 = $que1->result_array();
				$value = (intval($que1[0]['percent_completion'])/100)*intval($que[0]['camp_price']);
				$data = [];
				$data['camp_id'] = $camp;
				$data['value'] = $value;
				$data['brand_id'] = intval($que[0]['camp_by']);
				$data['inf_id'] = intval($id);
				return ($this->db->insert('claim', $data))?TRUE:FALSE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}

	function delete_social_account($id) {
		$data = ['is_active' => 0];
		$this->db->where('id', $id);
		return $this->db->update('tokens', $data);
	}

	function insert_token($data){
		extract($data);
		$this->db->where('id', $id);
		$this->db->update($table_name, array('token' => $token));
		return true;
	}

	function insert_activate_token($email, $token) {
		$this->db->where('email', $email);
		return $this->db->update('influencers', ['activate_token' => $token]);
	}

	function change_pass($data){
		extract($data);
		$check = $this->db->select('token')->from('influencers')->where('id',$id)->get()->result_array();
		$password = password_hash($pwd, PASSWORD_DEFAULT);
		if($check[0]['token']==$token){
			$this->db->where('id', $id);
			$this->db->update($table_name, array('token' => Null,'password'=>$password));
			return true;
		}else{
			return false;
		}
	}

	function getActivateToken($email) {
		return $this->db->select('activate_token')->from('influencers')->where('email', $email)->get()->row()->activate_token;
	}

	function activateAccount($email) {
		$data = [];
		$data['is_active'] = 1;
		$this->db->where('email', $email);
		return $this->db->update('influencers', $data);
	}

}
