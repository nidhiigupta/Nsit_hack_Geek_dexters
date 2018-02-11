<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use MetzWeb\Instagram\Instagram;
use Abraham\TwitterOAuth\TwitterOAuth;
require_once APPPATH.'libraries/LinkedIn/autoload.php';
use LinkedIn\LinkedIn;

class Brand extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('brand_model');
		$this->load->library('custom_functions');
	}
	private function header($title = 'Dashboard') {
		$template = array(
			'name'              => 'Geek Dexters',
			'version'           => 'beta',
			'author'            => 'Geeks',
			'robots'            => 'Its Platform for Predicting the No. Of Patients over certain region',
			'title'             => $title.' - Geeks Dexter',
			'description'       => 'Geeks Dexter is a social media monetization and management platform.',
			'page_preloader'    => true,
			'menu_scroll'       => true,
			'header_navbar'     => 'navbar-inverse',
			'header'            => '',
			'sidebar'           => 'sidebar-partial sidebar-visible-lg sidebar-no-animations',
			'footer'            => '',
			'main_style'        => '',
			'cookies'           => '',
			'theme'             => '',
			'header_content'    => '',
			'active_page'       => basename($_SERVER['PHP_SELF'])
		);
		/* Primary navigation array (the primary navigation will be created automatically based on this array, up to 3 levels deep) */
		$primary_nav = array(
			/*array(
				'name'  => 'Dashboard',
				'url'   => SITEURL.'brand/dashboard',
				'icon'  => 'gi gi-stopwatch'
			),*/
			array(
				'name'  => 'Reports',
				'icon'  => 'gi gi-stats',
				'sub'   => array(
					array(
						'name'  => 'Blood Reports',
						'url'   => SITEURL.'brand/reports_blood'
					),
					array(
						'name'  => 'Chronic Reports',
						'url'   => SITEURL.'brand/reports_chronic'
					),
					
					array(
						'name'  => 'Genetic Reports',
						'url'   => SITEURL.'brand/reports_genetic'
					),
					array(
						'name'  => 'Others Reports',
						'url'   => SITEURL.'brand/reports_other'
					)
					
				)
			),
			array(
				'name'  => 'Online Chat',
				'url'   => SITEURL.'brand/chat',
				'icon'  => 'gi gi-chat'
			),
			array(
				'name'  => 'Hospital Wise Prediction',
				'url'   => SITEURL.'brand/predict',
				'icon'  => 'gi gi-charts'
			),
			array(
				'name'  => 'Submit Reports',
				'url'   => SITEURL.'brand/campaigns/all',
				'icon'  => 'gi gi-gamepad'
			),
			
		);
		$this->load->view('template/config', ['template' => $template, 'primary_nav' => $primary_nav]);
		$this->load->view('template/template_start');
		$this->load->view('template/page_head');
	}

	private function footer(){
		$this->load->view('template/page_footer');
		$this->load->view('template/template_scripts');
		$this->load->view('template/template_end');
	}

	private function upload_file($location, $name="", $userfile='userfile', $filetypes='gif|jpg|png'){
		$config['upload_path']          = $location;
		$config['allowed_types']        = $filetypes;
		if($name)
		$config['file_name'] = $name;
		$config['remove_spaces'] = TRUE;
		$config['max_size'] = 0;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload($userfile)) {
			return TRUE;
		}
		else {
			return $this->upload->display_errors();
		}
	}

	private function check_session(){
		return ($this->session->is_logged && $this->session->brand) ? TRUE:FALSE;
	}

	public function index(){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		else{
			redirect(SITEURL.'brand/campaigns/all');
		}
	}

	public function dashboard(){
		if($this->check_session()){
			$this->header('Dashboard');
			if($this->input->post('main_id')){
				$abc = $this->input->post('main_id');
				}
			else{
				$abc = "LATEST";
			}
			$res = $this->dashboard_data($abc);
			//var_dump($res);
			$this->load->view('brand/new_index',$res);
			$this->footer();
		}
		else{
			redirect(SITEURL.'brand');
		}
	}

	private function add_notif_inf($inf_id, $msg, $link, $category="Messages") {
		$data = array(
			'inf_id' => $inf_id,
			'msg' => $msg,
			'link' => $link,
			'category' => $category,
			'time' => time()
		);
		$this->db->insert('notif_inf', $data);
	}

	private function add_notif_brand($brand_id, $msg, $link, $category="Messages") {
		$data = array(
			'brand_id' => $brand_id,
			'msg' => $msg,
			'link' => $link,
			'category' => $category,
			'time' => time()
		);
		$this->db->insert('notif_brand', $data);
	}

	public function analytics_check() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$camp_id = $this->input->post('camp_id');
		$inf_id = $this->input->post('inf_id');

		$camp_data = $this->db->select('*')->from('camp_data')->where(['camp_id' => $camp_id, 'inf_id' => $inf_id])->get()->result_array();
		if(sizeof($camp_data) == 0) {
			$info = [];
			$info['error'] = true;
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		$camp_data = $camp_data[0];

		$camp = $this->db->select('*')->from('campaigns')->where('camp_id', $camp_id)->get()->result_array();
		$camp = $camp[0];

		$info = [];
		$info['camp_type'] = $camp['camp_type'];
		$info['number_of'] = $camp['number_of'];
		$info['cm_id'] = $camp['cm_id'];
		$info['percent_completion'] = $camp_data['percent_completion'];
		$info['cat'] = $camp['camp_category'];

		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function do_login(){
		$this->form_validation->set_rules('l-email','Email','required|xss_clean');
		$this->form_validation->set_rules('l-pwd','Password','required|xss_clean');
		if($this->form_validation->run()){
			if($data=$this->brand_model->get_session_brand()){
				$new_data=array();
				foreach($data as $key=>$value){
					$new_data[$key]=$value;
				}
				$info['status']=$new_data['is_logged']=TRUE;
				$new_data['brand']=TRUE;
				$this->session->set_userdata($new_data);
//$info['custom']=$this->brand_model->get_session_brand();
			}
			else{
				$info['custom']='Email/Useranme is not correct!!';
			}
		}
		else{
			foreach ($this->input->post() as $key => $value) {
				$info[$key]=form_error($key);
			}
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}
	public function activate_account() {
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		if($email == '' || $token == '') {
			redirect(SITEURL.'login');
		}

		$dbToken = $this->brand_model->getActivateToken($email);
		if($dbToken == $token) {
			$this->brand_model->activateAccount($email);
			redirect(SITEURL.'login?user=brand&activate=success');
		}
		else {
			redirect(SITEURL.'login?user=brand&activate=failed');
		}
	}

	public function do_signup(){
	
		$this->form_validation->set_rules('fname','First Name','required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('lname','Last Name','required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[brands.email]|is_unique[influencers.email]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|integer|xss_clean');
		$this->form_validation->set_rules('pwd','Password','required|min_length[8]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('re-pwd','Retype-Password','required|matches[pwd]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('re-pwd','Retype-Password','required|matches[pwd]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('industry','Industry','required|xss_clean');
		$this->form_validation->set_rules('doc_type','Doctor Type','required|xss_clean');
		
		
		if($this->form_validation->run()){
				
				$uniq_id= $this->brand_model->register_brand();
				$email = $this->input->post('email');
				$name = $this->input->post('fname');
				$length = 30;
				$token = $this->custom_functions->randomString($length);
				if($this->brand_model->insert_activate_token($email, $token)){
					$to = [];
					$to[0] = $email;
					$from = 'info@webassets.in';
					$subject = 'Activate your account | Geek Dexters ';
					$attach= null;
					$URL = SITEURL."brand/activate_account?email=".$email."&token=".$token;
					$body = "<div>Hello <b>" . $name . "</b>,<br><br><p>In Order to activate your account, please click the link below <br><a href='".$URL."'>".$URL."</a><br><br></p>Regards,<br> Team Geek Dexters.
					<br>Your Username".$uniq_id."</div>";;
					$response = $this->custom_functions->mail_Send($to,$from,$subject,$attach,$body);
					if($response == 'Message could not be sent.'){
						$info['status'] = false;
						$info['msg'] = 'Your account successfully created! Check your email to activate your account.';
					}
					else {
						$info['status'] = TRUE;
						$info['msg'] = 'Your account successfully created! Check your email to activate your account.';
					}
				}
				else {
					$info['status'] = false;
					$info['custom'] = 'Database error!';
				}
			
		}
		else{
			foreach ($this->input->post() as $key => $value) {
				$info[$key]=form_error($key);
			}
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function profile() {
		if($this->check_session()) {
			$this->header('Profile');
			$data['profile']=$this->brand_model->get_record('brands','email',$this->session->email);
			$data['bank']=$this->brand_model->get_bank_record();
			$data['wallet_amount'] = $this->brand_model->get_wallet_amount();

			$this->load->view('brand/profile', $data);
			$this->footer();
		}
		else {
			redirect(SITEURL.'brand');
		}
	}

	public function payments() {
		if($this->check_session()) {
			$brand_id = $this->brand_model->get_id();
			$data = $this->db->select('*')->from('payments')->where(['payment_from' => 'Brand', 'payer_id' => $brand_id])->get()->result_array();
			$this->header('Payments');
			$this->load->view('brand/payments', ['payments' => $data]);
			$this->footer();
		}
		else {
			redirect(SITEURL.'brand');
		}
	}
	public function add_bank_account(){
		if($this->check_session()){
			$this->form_validation->set_rules('holder-name','Account holder\'s Name','required|xss_clean|trim');
			$this->form_validation->set_rules('bank-name','Bank Name','required|xss_clean|trim');
			$this->form_validation->set_rules('account-number','Account Number','required|numeric|xss_clean|trim');
			$this->form_validation->set_rules('ifsc-code','IFSC Code','required|xss_clean|trim');
			$this->form_validation->set_rules('mobile-number','Mobile Number','required|numeric|exact_length[10]|xss_clean|trim');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if($this->form_validation->run()){
				if($this->brand_model->add_bank_details()){
					$info['msg']="Successfully Saved!";
					$info['error']=FALSE;
				}else{
					$info['msg']="Ohh No Try Again!";
					$info['error']=TRUE;
				}
			}else{
				$info['error']=TRUE;
				foreach ($this->input->post() as $key => $value) {
					$info[$key]=form_error($key);
				}
			}
			header('Content-type: application/json');
			exit(json_encode($info));
		}else{
			redirect(SITEURL.'brand');
		}
	}
	public function campaigns() {
		if($this->check_session()) {
			$this->header('Campaigns');
			$this->load->view('brand/campaigns');
			$this->footer();
		}
		else {
			redirect(SITEURL.'brand');
		}
	}
	public function campaigns_ajax() {
		if($this->check_session()){
			$seg = $this->input->post('seg');
			if($seg == 'all' || $seg == "")
			$info = $this->brand_model->get_campaigns(0);
			else if($seg == 'offers')
			$info = $this->brand_model->get_campaigns(1);
			else if($seg == 'pending')
			$info = $this->brand_model->get_campaigns(2);
			else
			$info = $this->brand_model->get_campaigns(0);
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else {
			redirect(SITEURL.'brand');
		}
	}
	public function add_campaign() {
		$info['status']=FALSE;
			
			$common_id = $this->db->select('MAX(id)')->from('campaigns')->get()->result_array();
			$common_id = $common_id[0]['MAX(id)']+1;
			$brand_id = $this->brand_model->get_id();
			foreach ($this->input->post('c-category') as $key => $value) {
			if($value=='Youtube'){
			
			$data = array(
			'id'=>$common_id,
			'name'=>$this->input->post('name_p'),
			'age'=>$this->input->post('age_p'),
			'type'=>'Other Report',
			'weight'=>$this->input->post('weight_p'),
			'height'=>$this->input->post('height_p'),
			'address'=>$this->input->post('address_p'),
			'smoke'=>$this->input->post('c-type-Smoke'),
			'alcohol'=>$this->input->post('c-type-Alcohol'),
			'anxiety'=>$this->input->post('c-type-Anxiety_Level'),
			'allergy'=>$this->input->post('c-type-Allergies'),
			'patient_id'=>'Geek22',//$this->input->post('p_id_p'),
			'doc_id'=>$this->brand_model->get_id(),
			);

			$this->db->insert('report',$data);
				
			}
			if($value=='Facebook'){
			
			$data = array(
			'id'=>$common_id,
			'name'=>$this->input->post('name_p'),
			'type'=>'Blood Report',
			'age'=>$this->input->post('age_p'),
			'weight'=>$this->input->post('weight_p'),
			'height'=>$this->input->post('height_p'),
			'address'=>$this->input->post('address_p'),
			'blood_group'=>$this->input->post('c-type-Blood_Group'),
			'esr'=>$this->input->post('c-type-ESR'),
			'haematocrit'=>$this->input->post('c-type-Haematocrit'),
			'cbc'=>$this->input->post('c-type-CBC'),
			'patient_id'=>'Geek22',#$this->input->post('p_id_p'),
			'doc_id'=>$this->brand_model->get_id(),
			);

			$this->db->insert('report',$data);
				
			}
			if($value=='Twitter'){
			
			$data = array(
			'id'=>$common_id,
			'name'=>$this->input->post('name_p'),
			'type'=>'Chronic Report',
			'age'=>$this->input->post('age_p'),
			'weight'=>$this->input->post('weight_p'),
			'height'=>$this->input->post('height_p'),
			'address'=>$this->input->post('address_p'),
			'dibaties'=>$this->input->post('c-type-Type_1_Diabetes'),
			'narcolepsy'=>$this->input->post('c-type-Narcolepsy'),
			'hla'=>$this->input->post('c-type-HLA_Typing'),
			'parkinsons'=>$this->input->post('c-type-Parkinsons_Disease'),
			'patient_id'=>$this->input->post('p_id_p'),
			'doc_id'=>$this->brand_model->get_id(),
			);

			$this->db->insert('report',$data);
				
			}
			if($value=='Instagram'){
			
			$data = array(
			'id'=>$common_id,
			'name'=>$this->input->post('name_p'),
			'type'=>'Genetic Report',
			'age'=>$this->input->post('age_p'),
			'weight'=>$this->input->post('weight_p'),
			'height'=>$this->input->post('height_p'),
			'address'=>$this->input->post('address_p'),
			'pharmacogenomics'=>$this->input->post('c-type-Pharmacogenomics'),
			'heridity'=>$this->input->post('c-type-Hereditary_Disease'),
			'hiv'=>$this->input->post('c-type-HIV_Test'),
			'last'=>$this->input->post('c-type-Last_Disease'),
			'patient_id'=>$this->input->post('p_id_p'),
			'doc_id'=>$this->brand_model->get_id(),
			);

			$this->db->insert('report',$data);
				
			}
					
		
		}
		$info['msg'] = 'Disease Report Generated Successfully!!';
		$info['status'] =True;
		
		header('Content-type: application/json');
		exit(json_encode($info));
	}
	public function get_offers_approvals() {
		if($this->check_session()){
			$camp_id = $this->input->post('camp_id');
			$sort_val = $this->input->post('sort_val');
			$camp_type = $this->input->post('camp_category');
			$range = $this->input->post('range');
			if($range == '0-1k') {
				$this->db->where("(pro_price >= 0 AND pro_price <= 1000)");
			}
			else if($range == '1k-10k') {
				$this->db->where("(pro_price >= 1000 AND pro_price <= 10000)");
			}
			else if($range == '10k-50k') {
				$this->db->where("(pro_price >= 10000 AND pro_price <= 50000)");
			}
			else if($range == '50k-100k') {
				$this->db->where("(pro_price >= 50000 AND pro_price <= 100000)");
			}
			else if($range == '100k-1m') {
				$this->db->where("(pro_price >= 100000 AND pro_price <= 1000000)");
			}
			if($sort_val == 1) {
				$this->db->order_by("pro_price", "asc");
				$this->db->where(['pro_for'=> $camp_id]);
				$q = $this->db->get('proposals');
				$data = $q->result_array();
			}
			else if($sort_val == 2) {
				$this->db->order_by("pro_price", "desc");
				$this->db->where(['pro_for'=> $camp_id]);
				$q = $this->db->get('proposals');
				$data = $q->result_array();
			}
			else {
				$this->db->where(['pro_for'=> $camp_id]);
				$q = $this->db->get('proposals');
				$data = $q->result_array();
			}
			$i = 0;
			foreach ($data as $key) {
				$inf_id = $key['pro_by'];
				$camp_id = $key['pro_for'];
				$ret = $this->db->select(['id', 'name', 'image', 'created'])->from('influencers')->where('id', $inf_id)->get()->result_array();
				$ret2 = $this->db->select('percent_completion')->from('camp_data')->where(['camp_id' => $camp_id, 'inf_id' => $inf_id])->get()->result_array();
				if(sizeof($ret2)!=0) {
					$data[$i]['complete'] = $ret2[0]['percent_completion'];
				}
				else {
					$data[$i]['complete'] = 0;
				}
				$data[$i]['proposal_data'] = $key;
				$data[$i]['inf_id'] = $ret[0]['id'];
				$data[$i]['name'] = $ret[0]['name'];
				$data[$i]['image'] = $this->custom_functions->check_img($ret[0]['image']);
				$data[$i]['created'] = $ret[0]['created'];
				$i = $i + 1;
			}
			$data_ret['offers'] = $data;

			$this->db->where(['camp_id'=> $camp_id]);
			$q = $this->db->get('approval');
			$data_ret['campaign'] = $q->result_array();

			header('Content-type: application/json');
			exit(json_encode($data_ret));
		}
		else{
			redirect(SITEURL.'brand');
		}
	}

	public function get_approval() {
		if($this->check_session()){
			$camp_id = $this->input->post('camp_id');
			$this->db->where(['camp_id'=> $camp_id]);
			$q = $this->db->get('approval');
			$data = $q->result_array();
			header('Content-type: application/json');
			exit(json_encode($data));
		}
		else{
			redirect(SITEURL.'brand');
		}
	}

	public function get_values() {
		if($this->check_session()){
			$req = $this->input->post('req');
			if($req == 'approval') {
				$id = $this->input->post('approve_id');
				$this->db->where(['approve_id'=> $id]);
				$q = $this->db->get('approval');
				$data = $q->result_array();
				header('Content-type: application/json');
				exit(json_encode($data));
			}
			else if($req == 'offer') {
				$id = $this->input->post('pro_id');
				$this->db->where(['pro_id'=> $id]);
				$q = $this->db->get('proposals');
				$data = $q->result_array();
				header('Content-type: application/json');
				exit(json_encode($data));
			}
		}
		else{
			redirect(SITEURL.'brand');
		}
	}
	public function set_approval() {
		if($this->check_session()){
			$id = $this->input->post('approve_id');
			$value = $this->input->post('value');

			$approval_table = $this->db->select('*')->from('approval')->where('approve_id', $id)->get()->result_array();
			$brand_id_from_approve = $approval_table[0]['brand_id'];
			$inf_id = $approval_table[0]['inf_id'];
			$camp_id = $approval_table[0]['camp_id'];
			$brand_id = $this->brand_model->get_id();
			$info = [];

			if($brand_id == $brand_id_from_approve) {
				$this->db->set('value', $value);
				$this->db->where(['approve_id'=> $id]);
				$info['error'] = $this->db->update('approval');

				if($value == 1) {
					$this->add_notif_inf($inf_id, 'You campaign has been accepted', 'influencer/view_campaign?camp_id='.$camp_id.'&redirect=id', 'Campaign');
				}
			}
			else {
				$info['error'] = true;
			}
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else{
			redirect(SITEURL.'brand');
		}
	}
	public function set_offer() {
		if($this->check_session()){
			$id = $this->input->post('pro_id');
			$approval = $this->input->post('approval');
			$proposals = $this->db->select('*')->from('proposals')->where('pro_id', $id)->get()->result_array();
			$proposals = $proposals[0];
			$pro_for = $proposals['pro_for'];
			$inf_id = $proposals['pro_by'];
			$brand_id_table = $proposals['brand_id'];
			if($brand_id_table != $this->brand_model->get_id()) {
				redirect(SITEURL.'brand');
			}
			if($approval == 1) {
				$price = $proposals['pro_price'];
				header('Content-type: application/json');
				exit(json_encode(['pro_price' => $price]));
			}
			else {
				$this->db->set('approval', $approval);
				$this->db->where(['pro_id'=> $id]);
				$this->db->update('proposals');
				if($approval == -1) {
					$this->add_notif_inf($inf_id, 'You offer has been rejected', 'influencer/view_campaign?camp_id='.$pro_for.'&redirect=id', 'Offer');
				}
			}
		}
		else{
			redirect(SITEURL.'brand');
		}
	}

	public function accept_offer() {
		if(!$this->check_session()) {
			redirect(SITEURL.'login?user=brand');
		}
		$pro_id = $this->input->post('pro_id');
		$proposals = $this->db->select('*')->from('proposals')->where('pro_id', $pro_id)->get()->result_array();
		$proposals = $proposals[0];
		$pro_for = $proposals['pro_for'];
		$brand_id_table = $proposals['brand_id'];
		if($brand_id_table != $this->brand_model->get_id()) {
			redirect(SITEURL.'brand');
		}
		$tax = 20;
		$wallet_amount = $this->brand_model->get_wallet_amount();
		$total = $proposals['pro_price'] + $proposals['pro_price']*$tax/100;

		if($wallet_amount < $total) {
			php_redirect(SITEURL.'brand/profile', Array('title' => 'Error!', 'msg' => 'Not enough funds. Please add money to your wallet', 'type' => 'error'), 'POST');//'?camp_id='.$pro_for.'&status=failed&redirect=id');
		}
		else {
			$camp_data = $this->db->select('*')->from('campaigns')->where('camp_id', $pro_for)->get()->result_array();
			$this->header('Accept Offer');
			$this->load->view('brand/accept_offer', ['proposal_data' => $proposals, 'camp_data' => $camp_data[0], 'tax' => $tax, 'wallet_amount' => $wallet_amount]);
			$this->footer();
		}
	}

	public function confirm_offer_accept() {
		if(!$this->check_session()) {
			redirect(SITEURL.'login?user=brand');
		}
		$pro_id = $this->input->post('pro_id');
		$proposals = $this->db->select('*')->from('proposals')->where('pro_id', $pro_id)->get()->result_array();
		$proposals = $proposals[0];
		$pro_for = $proposals['pro_for'];
		$brand_id_table = $proposals['brand_id'];
		$inf_id = $proposals['pro_by'];
		if($brand_id_table != $this->brand_model->get_id()) {
			redirect(SITEURL.'brand');
		}

		$tax = 20;
		$total = $proposals['pro_price'] + $proposals['pro_price']*$tax/100;
		if($this->brand_model->deduct_wallet($total)) {
			$this->db->set('approval', '1');
			$this->db->where(['pro_id'=> $pro_id]);
			$this->db->update('proposals');

			$this->add_notif_inf($inf_id, 'You offer has been accepted', 'influencer/view_campaign?camp_id='.$pro_for.'&redirect=id', 'Offer');
			redirect(SITEURL.'brand/view_campaign?camp_id='.$pro_for.'&status=success&redirect=id');
		}
		else {
			redirect(SITEURL.'brand/view_campaign?camp_id='.$pro_for.'&status=failed&redirect=id');
		}
	}

	public function open_notification() {
		if(!$this->check_session()){
			redirect(SITEURL.'brand');
		}
		$id = $this->input->post('id');
		$brand_id = $this->brand_model->get_id();

		$notif = $this->db->select("*")->from('notif_brand')->where('id', $id)->get()->result_array();
		if(!$notif || $notif == array() || !isset($notif[0])) {
			$info['error'] = true;
		}
		else if($notif[0]['brand_id'] != $brand_id) {
			$info['error'] = true;
		}
		else {
			$info['link'] = $notif[0]['link'];
			$this->db->where('id', $id);
			$info['error'] = !$this->db->update('notif_brand', ['clicked' => '1']);
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function clear_notification() {
		if(!$this->check_session()){
			redirect(SITEURL.'brand');
		}
		$brand_id = $this->brand_model->get_id();

		$this->db->where('brand_id', $brand_id);
		$notif = $this->db->update('notif_brand', ['clicked' => '1']);

		if($notif) {
			$info['success']="Notification Cleared...";
		}
		else {
			$info['error'] = 'ERROR Please Try Again...';
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function update_profile(){
		if(!$this->check_session()) {
			redirect(SITEURL.'login?user=brand');
		}
		$info['status']=FALSE;
		$this->form_validation->set_rules('profile_name','Title','required|xss_clean');
		#$this->form_validation->set_rules('profile_email','Email','required|xss_clean');
		$this->form_validation->set_rules('profile_contact','Contact No','required|xss_clean');
		$this->form_validation->set_rules('profile_website','Website','required|xss_clean');
		#$this->form_validation->set_rules('c-image','Image','required|xss_clean');
		if($this->form_validation->run()){
			$file_name = "";
			if($_FILES['userfile']['name']) {
				$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				$file_name = substr(md5(rand()), 0, 15).'.'.$ext;
				if(file_exists('./assets/images/brands/'.$file_name)) {
					while(file_exists('./assets/images/brands/'.$file_name)) {
						$file_name = substr(md5(rand()), 0, 15).'.'.$ext;
					}
				}
				$this->upload_file('./assets/images/brands/', $file_name);
			}
			if($file_name)
			$file_name = 'images/brands/'.$file_name;
			else
			$file_name = $this->session->image;
			if($this->brand_model->update_profile($file_name)){
				$info['msg']='Profile Updated Successfully!';
				$info['status']=TRUE;
			}
			else{
				$info['error']=$this->upload->display_errors();
			}
		}
		else{
			foreach ($this->input->post() as $key => $value) {
				$info['form_errors'][$key]=form_error($key);
			}
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function messages(){
		if($this->check_session()){
			$this->header('Chat');
			$data['payments']=$this->brand_model->get_payments();
			$this->load->view('brand/messages',$data);
			$this->footer();
		}else{
			redirect(SITEURL.'brand');
		}
	}
	public function suspend_profile(){
		if($this->brand_model->disable_profile())
		redirect(SITEURL.'brand/profile');
	}
	public function suspend_campaign(){
		if(!$this->check_session()){
			redirect(SITEURL.'brand');
		}
		if($this->brand_model->disable_campaign($this->uri->segment(3)))
		$info='Successfully Suspended!';
		else
		$info='OOps.. ,try again!';
		header('Content-type: application/json');
		echo json_encode( $info);
	}
	public function update_brand(){
		if($this->check_session()){
			$data=array(
				'table'=>'brand',
				'where'=>array('brand_id'=>$this->input->post('id'))
			);
			if($this->brand_model->update_row($data)){
				$info['title']='Success';
				$info['status']=TRUE;
				$info['msg']='Successfully updated!';
			}
			else{
				$info['title']='Failed';
				$info['status']=FALSE;
				$info['msg']='OOps.., try again!';
			}
			header('Content-type: application/json');
			echo json_encode( $info);
		}else{
			redirect(SITEURL.'brand');
		}
	}
	public function brand_social(){
		// don't not chane name of function
		echo "<script>alert();</script>";
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(SITEURL.'brand');
	}
	function social_brand(){
		$this->form_validation->set_rules('oauth_provider','Provider','required|xss_clean');
		$this->form_validation->set_rules('oauth_uid','ID','required|xss_clean');
		#$this->form_validation->set_rules('email','Email','required|valid_email|xss_clean');
		#$this->form_validation->set_rules('image','Image','required|valid_email|xss_clean');
		$this->form_validation->set_rules('name','Name','required|xss_clean');
		if($this->form_validation->run()){
			if($this->brand_model->checkUser()){
				$session_data=array(
					'is_logged'=>TRUE,
					'brand'=>TRUE,
					'name'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'image'=>$this->input->post('image')
				);
				$info['status']=TRUE;
				$this->session->set_userdata($session_data);
				$info['msg']='Successfully login';
			}
			else{
				$info['msg']='sorry';
			}
		}
		else{
			$info['msg']='Validation error';
		}
		header('Content-type: application/json');
		echo json_encode( $info);
	}
	function influencer(){
		// get all influencers
		if($this->check_session()){
			$this->header('Influencers');
			$this->load->view('brand/influencers');
			$this->footer();
		}else{
			redirect(SITEURL.'brand');
		}
	}
	public function influencer_ajax(){
		if($this->check_session()){
			$cat = $this->input->post('hell');

			$info=$this->brand_model->get_influencers($cat);
			header('Content-type: application/json');
			exit(json_encode($info));
		}else{
			redirect(SITEURL.'brand');
		}
	}
	public function view_campaign() {
		if($this->check_session() && $this->input->get('camp_id')) {
			if($this->input->get('redirect') == 'id') {
				$status = $this->input->get('status');
				$camp_data = $this->db->select("id")->from('campaigns')->where('camp_id', $this->input->get('camp_id'))->get()->result_array();
				$id = $camp_data[0]['id'];
				if($status != '') {
					php_redirect(SITEURL.'brand/view_campaign', ['camp_id' => $id, 'status' => $status], 'GET');
				}
				else {
					php_redirect(SITEURL.'brand/view_campaign', ['camp_id' => $id], 'GET');
				}
				exit();
			}
			$camp_data = $this->db->select("*")->from('campaigns')->where('id', $this->input->get('camp_id'))->get()->result_array();
			$camp_id = $camp_data[0]['camp_id'];
			$brand_id = $this->brand_model->get_id();
			if($brand_id != $camp_data[0]['camp_by']) {
				redirect(SITEURL.'brand/campaigns/all');
			}
			if(!$camp_data || !$camp_data[0]) {
				redirect(SITEURL.'brand');
			}
			$this->header('View Campaign');
			$this->load->view('brand/view_campaign', ['camp_data_all' => $camp_data]);
			$this->footer();
		}
		else {
			redirect(SITEURL.'brand');
		}
	}
	public function chat() {
		if($this->check_session()) {
			$id = $this->brand_model->get_id();
			$this->header('Chat');
			$this->load->view('brand/new_chat');
			$this->footer();
		}
		else {
			redirect(SITEURL.'brand');
		}
	}
	public function get_chats() {
		if($this->input->post('id')) {
			$cat = $this->input->post('cat');
			$chats = $this->brand_model->get_chats();
			header('Content-type: application/json');
			exit(json_encode($chats));
		}
		else {
			redirect(SITEURL);
		}
	}
	public function get_conv() {
		if($this->input->post('brand_id')) {
			$chats = $this->brand_model->get_conv();
			header('Content-type: application/json');
			exit(json_encode($chats));
		}
		else {
			redirect(SITEURL);
		}
	}
	public function chat_insert() {
		if($this->input->post('msg')) {
			$brand_id = $this->input->post('b_id');
			$inf_id = $this->input->post('i_id');
			$msg = $this->input->post('msg');
			$msg = htmlspecialchars($msg);
			$msg  = strip_tags($msg);
			$msg_by = $this->input->post('msg_by');
			$timestamp = time();
			$brand_name = $this->db->select('name')->from('brands')->where('id',$brand_id)->get()->result_array();
			$inf_name = $this->db->select('name')->from('influencers')->where('id',$inf_id)->get()->result_array();
			$brand_name = $brand_name[0]['name'];
			$inf_name = $inf_name[0]['name'];

			$data = array(
				'brand_id'=>$brand_id,
				'inf_id'=>$inf_id,
				'msg'=>$msg,
				'msg_by'=>$msg_by,
			);
			$arr = array('hi'=>'yo');
			$resu = $this->brand_model->insert_chats($data);
			if($resu){
				if($msg_by=='b'){
					$hii = 'Message From '.$inf_name;
					$this->add_notif_inf($inf_id,$hii,'influencer/chat');
				}else{
					$hii = 'Message From '.$brand_name;
					$this->add_notif_brand($brand_id,$hii,'brand/chat');
				}

			}
			header('Content-type: application/json');
			exit(json_encode($resu));
		}
		else {
			redirect(SITEURL);
		}
	}
	public function clickmeter_create_group($name) {
		if(!$this->check_session()) {
			redirect(SITEURL.'login?user=brand');
		}
		//$name is the name of campaign you wnat to start
		$url = 'http://apiv2.clickmeter.com/groups';
		$cm_api_key = CLICKMETER_API_KEY; // add your api key here
		//set POST variables
		$fields = array(
			"name"=> $name,
		);
		$fields_json = json_encode($fields);
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Clickmeter-Authkey: '.$cm_api_key, 'Content-Type: application/json' ));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		//execute post
		$result = curl_exec($ch);
		//close connection
		$error = curl_error($ch);
		curl_close($ch);
		return $result;
	}
	public function clickmeter_datapoint_id($groupId,$name,$destinationURL) {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		//$name is the name of link like baseUrl/$name it should be unique
		//$groupId will be the campaignid stoder in database across that campaign
		//$title can be any title
		//$destinationURL is the url you want to redirect to
		$url = 'http://apiv2.clickmeter.com/datapoints';
		$cm_api_key = CLICKMETER_API_KEY; // add your api key here
		//set POST variables
		$fields = array(
			'type' => 0,
			'title' => $name,
			'groupId' => $groupId,
			'name' => $name,
			'typeTL' => array(
				'domainId' =>12781,
				'redirectType' => 301,
				'url' => $destinationURL
			)
		);
		$fields_json = json_encode($fields);
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Clickmeter-Authkey: '.$cm_api_key, 'Content-Type: application/json' ));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		//execute post
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		return $result;
	}
	public function clickmeter_created_link($id){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$url = 'http://apiv2.clickmeter.com/datapoints/'.$id;
		$cm_api_key = CLICKMETER_API_KEY; // add your api key here
		//set POST variables
		$fields = array(
		);
		$fields_json = json_encode($fields);
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Clickmeter-Authkey: '.$cm_api_key, 'Content-Type: application/json' ));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		//execute post
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		return $result;
	}
	public function clickmeter_report_datapoint($datapoint){
		$url = 'http://apiv2.clickmeter.com:80/reports?type=browsers&timeframe=last180&datapoint='.$datapoint;
		$cm_api_key = CLICKMETER_API_KEY; // add your api key here
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Clickmeter-Authkey: '.$cm_api_key, 'Content-Type: application/json' ));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		//execute post
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		return $result;
	}
	public function dashboard_data($abc) {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$click =0;
		$totalprice=0;
		$price= 0;
		//overall stats
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
		$this->db->select('id')->where('is_active',1);
		$this->db->from('campaigns');
		$query3=$this->db->get();
		$camp = $query3->num_rows();

		$this->db->select('chat_id');
		$this->db->distinct();
		$this->db->from('chats');
		$query4=$this->db->get();
		$chta = $query4->num_rows();


		$id = $this->brand_model->get_id();
		//user stats

		$this->db->distinct();
		$this->db->select('id');
		$this->db->from('brands');
		$query2=$this->db->get();
		$brands = $query2->num_rows();
		$this->db->distinct();
		$this->db->select('id')->where('camp_by',$id);
		$this->db->from('campaigns')->where('is_active',1);
		$campquery=$this->db->get();
		$yourcamp = $campquery->num_rows();
		$this->db->select('chat_id')->where('brand_id',$id);
		$this->db->distinct();
		$this->db->from('chats');
		$chatquery=$this->db->get();
		$yourchat = $chatquery->num_rows();
		$yourwallet = $this->brand_model->get_wallet_amount();
		$ongoing_camp = $this->db->select('*')->from('campaigns')->where('status','Ongoing')->where('camp_by',$id)->get()->num_rows();
		$completed_camp = $this->db->select('*')->from('campaigns')->where('status','Completed')->where('camp_by',$id)->get()->num_rows();


		//number of camps Check
		$run = $this->db->select('camp_name')->from('campaigns')->where('camp_by',$id)->where('is_active',1)->get();
		if($run->num_rows()>0){
			if($abc ==  'LATEST'){
				$latest = $this->db->query('SELECT id,camp_id from campaigns where camp_by = '.$id.' and is_active = 1 ORDER BY camp_id DESC LIMIT 1 ')->result_array();
			}else{
				$latest = $this->db->query('SELECT id,camp_id from campaigns where camp_by = '.$id.' and is_active = 1 AND id='.$abc.' LIMIT 1 ')->result_array();
			}
			$click_check = $this->db->select('camp_id')->from('campaigns')->where('id',$latest[0]['id'])->where('camp_type','Click')->get()->result_array();
			$click_name = $this->db->select('camp_name')->from('campaigns')->where('id',$latest[0]['id'])->where('camp_type','Click')->get()->result_array();
			$query11 = $this->db->select('camp_category')->from('campaigns')->where('id',$latest[0]['id'])->get()->result_array();
			$facebook = False;
			$multiple_fb = False;
			$dropdown_fb = array();
			$twitter = False;
			$insta = False;
			$youtube = False;
			$linkdn = False;
			foreach($query11 as $row){
				if($row['camp_category']=='Facebook'){
					$data_fb = $this->db->query('SELECT camp_data.id,tokens.name FROM camp_data,tokens Where camp_data.camp_id='.$latest[0]['camp_id'].' AND camp_data.token_id = tokens.id AND tokens.category="fb"')->result_array();
					if(sizeof($data_fb)==1){
					$facebook = True;
					}elseif(sizeof($data_fb)==0){
					$multiple_fb = False;
					$facebook = False;
					}else{
					$multiple_fb = True;
					$dropdown_fb = $data_fb;
					}
				}
				if($row['camp_category']=='Twitter'){
					$twitter = True;
				}
				if($row['camp_category']=='Instagram'){
					$insta = True;
				}
				if($row['camp_category']=='Youtube'){
					$youtube = True;
				}
				if($row['camp_category']=='Youtube'){
					$linkdn = True;
				}
			}
			$query5 = $this->db->query("SELECT * FROM proposals WHERE brand_id = {$id}")->result_array();
			$query6 = $this->db->query("SELECT * FROM payments WHERE payer_id = {$id} AND payment_from = 'Brand'")->result_array();
			$totalpric = $this->db->query("SELECT * FROM payments WHERE  payment_from = 'Brand'")->result_array();

			$dropdown = $this->db->distinct()->select('camp_name,id')->from('campaigns')->where('camp_by',$id)->where('is_active',1)->order_by("id", "desc")->get()->result_array();

			if($query6){
				foreach($query6 as $row){
					$price += $row['total'];
				}
			}
			if($totalpric){
				foreach($totalpric as $row){
					$totalprice += $row['total'];
				}
			}

			$retVal= array('infcount'=>$inf,'brandcount'=>$brands,'campcount'=>$camp,'chatscount'=>$chta,'clicks'=>$click,'price'=>$price,'latest'=>$latest,'facebook'=>$facebook,'multiple_fb'=>$multiple_fb,'dropdown_fb'=>$dropdown_fb,'twitter'=>$twitter,'insta'=>$insta,'youtube'=>$youtube,'linkdn'=>False,'dropdown'=>$dropdown,'click_check'=>$click_check,'click_name'=>$click_name,'yourchat'=>$yourchat,'yourcamp'=>$yourcamp,'totalprice'=>$totalprice,'yourwallet'=>$yourwallet,'ongoing_camp'=>$ongoing_camp,'completed_camp'=>$completed_camp);
			return $retVal;
		}
		else{
			$retVal= array('infcount'=>$inf,'brandcount'=>$brands,'campcount'=>$camp,'chatscount'=>$chta,'clicks'=>$click,'latest'=>False,'price'=>$price,'facebook'=>False,'multiple_fb'=>$multiple_fb,'twitter'=>False,'dropdown_fb'=>array(),'insta'=>False,'youtube'=>False,'linkdn'=>False,'dropdown'=>False,'click_check'=>False,'click_name'=>False,'yourchat'=>$yourchat,'yourcamp'=>$yourcamp,'totalprice'=>$totalprice,'yourwallet'=>$yourwallet,'ongoing_camp'=>$ongoing_camp,'completed_camp'=>$completed_camp);
			return $retVal;

		}
	}
	public function start_campaign() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$this->header('Start Campaign');
		$this->load->view('brand/start_campaign');
		$this->footer();
	}
	public function click_city_country($datapoint) {
		$url = 'http://apiv2.clickmeter.com/clickstream?datapoint='.$datapoint;
		$cm_api_key = CLICKMETER_API_KEY; // add your api key here
		//set POST variables
		$fields = array(
			"datapoint"=> $datapoint,
		);
		$fields_json = json_encode($fields);
		//open connection
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Clickmeter-Authkey: '.$cm_api_key, 'Content-Type: application/json' ));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		//execute post
		$result = curl_exec($ch);
		//close connection
		$error = curl_error($ch);
		curl_close($ch);
		$red = json_decode($result,true);
		return ($red['rows']);
		//only area code and country is to be stored
	}
	public function dashboard_ajax(){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$brand_id = 2252;
		$id = 3;
		$type = $this->db->select('camp_type,camp_id,camp_name')->from('campaigns')->where('camp_category','Facebook')->where('id',$id)->get()->result_array();
		$table = 'webassets_fb_analytics_'.$brand_id;
		if ($this->db->table_exists($table) )
		{
			$data1 = [];
			$data = $this->db->select('*')->from($table)->where('camp_id', $type[0]['camp_id'])->order_by("timestamp", "asc")->get()->result_array();
			foreach ($data as $key => $value) {
				$value['data'] = json_decode($value['data'], true);
				$data[$key] = $value;
			}
			foreach ($data as $key => $value) {
				if(isset($data[$key+1])) {
					foreach ($value['data'] as $key1 => $value1) {
						if($key1 =='post_impressions')
						$value1 = $data[$key+1]['data'][$key1]-$value1;
						$value['data'][$key1] = $value1;
					}
					$data[$key] = $value;
				}
			}
			for($i=0;$i<sizeof($data);$i++){
				$data[$i]['camp_name'] = $type[0]['camp_name'];
				$data[$i]['camp_type'] = $type[0]['camp_type'];
			}
			var_dump($data);
		}
		else
		{
			$data = array('error'=>'NOT FOUND');
			header('Content-type: application/json');
			exit(json_encode($data));
		}
		$this->load->view('chart');
	}
	public function dashboard_fb() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		if($this->input->post('analy_id')=='nochoice'){
			$data = array('error'=>'pagenot');
			header('Content-type: application/json');
			exit(json_encode($data));
		}else{
		$brand_id = $this->brand_model->get_id();
		$id = $this->input->post('camp_id');
		
		$type = $this->db->select('camp_type,camp_id,camp_name')->from('campaigns')->where('camp_category','Facebook')->where('id',$id)->get()->result_array();
		$table = 'webassets_fb_analytics_'.$brand_id;
		if ($this->db->table_exists($table) )
		{
			$data1 = [];
			if($this->input->post('analy_id')!='nochoice'){
			$data = $this->db->select('*')->from($table)->where('camp_id', $type[0]['camp_id'])->where('camp_data_id',$this->input->post('analy_id'))->order_by('timestamp','asc')->get()->result_array();
			}else{
			$data = $this->db->select('*')->from($table)->where('camp_id', $type[0]['camp_id'])->order_by('timestamp','asc')->get()->result_array();
			}
			foreach ($data as $key => $value) {
				$value['data'] = json_decode($value['data'], true);
				$data[$key] = $value;
			}
			foreach ($data as $key => $value) {
				if(isset($data[$key+1])) {
					foreach ($value['data'] as $key1 => $value1) {
						$value1 = $data[$key+1]['data'][$key1]-$value1;
						$value['data'][$key1] = $value1;
					}
					$data[$key] = $value;
				}
			}
			for($i=0;$i<sizeof($data);$i++){
				$data[$i]['camp_name'] = $type[0]['camp_name'];
				$data[$i]['camp_type'] = $type[0]['camp_type'];
			}
			header('Content-type: application/json');
			exit(json_encode($data));
		}
		else
		{
			$data = array('error'=>'NOT FOUND');
			header('Content-type: application/json');
			exit(json_encode($data));
		}
		}
	}
	public function dashboard_twitter(){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$brand_id = $this->brand_model->get_id();
		$id = $this->input->post('camp_id');
		$type = $this->db->select('camp_type,camp_id,camp_name')->from('campaigns')->where('camp_category','Twitter')->where('id',$id)->get()->result_array();
		$table = 'webassets_tw_analytics_'.$brand_id;
		if ($this->db->table_exists($table))
		{
			$data1 = [];
			$data = $this->db->select('*')->from($table)->where('camp_id', $type[0]['camp_id'])->order_by('timestamp','asc')->get()->result_array();
			foreach ($data as $key => $value) {
				$value['data'] = json_decode($value['data'], true);
				$data[$key] = $value;
			}
			foreach ($data as $key => $value) {
				if(isset($data[$key+1])) {
					foreach ($value['data'] as $key1 => $value1) {
						$value1 = $data[$key+1]['data'][$key1]-$value1;
						$value['data'][$key1] = $value1;
					}
					$data[$key] = $value;
				}
			}
			for($i=0;$i<sizeof($data);$i++){
				$data[$i]['camp_name'] = $type[0]['camp_name'];
				$data[$i]['camp_type'] = $type[0]['camp_type'];
			}
			header('Content-type: application/json');
			exit(json_encode($data));
		}
		else
		{
			$data = array('error'=>'NOT FOUND');
			header('Content-type: application/json');
			exit(json_encode($data));
		}
	}
	public function dashboard_insta(){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$brand_id = $this->brand_model->get_id();
		$id = $this->input->post('camp_id');
		$type = $this->db->select('camp_type,camp_id,camp_name')->from('campaigns')->where('camp_category','Instagram')->where('id',$id)->get()->result_array();
		$table = 'webassets_ins_analytics_'.$brand_id;
		if ($this->db->table_exists($table))
		{
			$data1 = [];
			$data = $this->db->select('*')->from($table)->where('camp_id', $type[0]['camp_id'])->order_by('timestamp','asc')->get()->result_array();
			foreach ($data as $key => $value) {
				$value['data'] = json_decode($value['data'], true);
				$data[$key] = $value;
			}
			foreach ($data as $key => $value) {
				if(isset($data[$key+1])) {
					foreach ($value['data'] as $key1 => $value1) {
						$value1 = $data[$key+1]['data'][$key1]-$value1;
						$value['data'][$key1] = $value1;
					}
					$data[$key] = $value;
				}
			}
			for($i=0;$i<sizeof($data);$i++){
				$data[$i]['camp_name'] = $type[0]['camp_name'];
				$data[$i]['camp_type'] = $type[0]['camp_type'];
			}
			header('Content-type: application/json');
			exit(json_encode($data));
		}
		else
		{
			$data = array('error'=>'NOT FOUND');
			header('Content-type: application/json');
			exit(json_encode($data));
		}
	}
	public function dashboard_youtube(){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$brand_id = $this->brand_model->get_id();
		$id = $this->input->post('camp_id');
		$type = $this->db->select('camp_type,camp_id,camp_name')->from('campaigns')->where('camp_category','Youtube')->where('id',$id)->get()->result_array();
		$table = 'webassets_yt_analytics_'.$brand_id;
		if ($this->db->table_exists($table))
		{		$data1 = [];
			$data = $this->db->select('*')->from($table)->where('camp_id', $type[0]['camp_id'])->order_by('timestamp','asc')->get()->result_array();
			foreach ($data as $key => $value) {
				$value['data'] = json_decode($value['data'], true);
				$data[$key] = $value;
			}
			foreach ($data as $key => $value) {
				if(isset($data[$key+1])) {
					foreach ($value['data'] as $key1 => $value1) {
						$value1 = $data[$key+1]['data'][$key1]-$value1;
						$value['data'][$key1] = $value1;
					}
					$data[$key] = $value;
				}
			}
			for($i=0;$i<sizeof($data);$i++){
				$data[$i]['camp_name'] = $type[0]['camp_name'];
				$data[$i]['camp_type'] = $type[0]['camp_type'];
			}
			header('Content-type: application/json');
			exit(json_encode($data));
		}
		else
		{
			$data = array('error'=>'NOT FOUND');
			header('Content-type: application/json');
			exit(json_encode($data));
		}
	}
	public function click_dash(){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$brand_id = $this->brand_model->get_id();
		$id = $this->input->post('camp');
		$table = 'webassets_clicks_'.$id;
		if ($this->db->table_exists($table))
		{
			$data = $this->db->query('SELECT * FROM '.$table.' Where 1')->result_array();
			header('Content-type: application/json');
			print_r(json_encode($data));
		}
		else
		{
			$data = array('error'=>'NOT FOUND');
			header('Content-type: application/json');
			exit(json_encode($data));
		}
	}

	public function camp_stats(){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$data = array();
		$brand_id = $this->brand_model->get_id();
		$res = $this->db->select('*')->from('campaigns')->where('camp_by',$brand_id)->get()->result_array();
		//var_dump($res);
		$i =0;
		$fb_count = 0;
		$ins_count = 0;
		$tw_count = 0;
		$you_count = 0;
		$lk_count = 0;
		foreach($res as $sts){
			if($sts['camp_category']=='Facebook'){
				$fb_count++;
			}
			if($sts['camp_category']=='Twitter'){
				$tw_count++;
			}
			if($sts['camp_category']=='Instagram'){
				$ins_count++;
			}
			if($sts['camp_category']=='Youtube'){
				$you_count++;
			}
			if($sts['camp_category']=='LinkedIn'){
				$lk_count++;
			}
		}
		$array = array('Facebook','Twitter','Instagram','Youtube','LinkedIn');
		for($i=0;$i<sizeof($array);$i++){
			$data[$i]['camp'] = $j;
			$data[$i]['count'] = $j;
		}
	}

	public function check_user(){
		$this->form_validation->set_rules('for_email','Email','required|valid_email|xss_clean');
		if($this->form_validation->run()){
			$for_email =$_POST['for_email'];
			$count = $this->db->select('id,email,name')->from('brands')->where('email',$for_email)->where('is_active',1)->get();
			if($count->num_rows()>0){
				$count = $count->result_array();
				$length = 30;
				$token = $this->custom_functions->randomString($length);
				$data = array(
					'table_name' => 'brands', // pass the real table name
					'id' => $count[0]['id'],
					'token' => $token
				);
				if($this->brand_model->insert_token($data)){
					$info['status'] = true;
					$info['msg'] = 'Reset link send to the registered email!';
					$to = array($count[0]['email']);
					$from = 'info@webassets.in';
					$subject = 'Password Reset Link';
					$attach= null;
					$URL = SITEURL."brand/forgot_pass?id=".$count[0]["id"]."&user=Brand&token=".$token;
					$body = "<div>Hello <b>" . $count[0]["name"] . "</b>,<br><br><p>In Order To Change Your Password Please .Click the Link Below <br>".$URL."<br><br></p>Regards,<br> Team Webassets.</div>";;
					$response = $this->custom_functions->mail_Send($to,$from,$subject,$attach,$body);
					if($response=='Message could not be sent.'){
						$info['status'] = false;
						$info['custom'] = 'Email server error! Try again';
					}
				}
				else{
					$info['status'] = false;
					$info['custom'] = 'Database error!';
				}
			}
			else{
				$info['custom'] = 'This email is not registered';
			}
		}
		else{
			foreach ($this->input->post() as $key => $value) {
				$info[$key]=form_error($key);
			}
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function forgot_pass(){
		$check = $this->db->select('*')->from('brands')->where('id',$_GET['id'])->where('token',$_GET['token'])->get();
		$count = $check->num_rows();
		if($count>0){
			$data = array('title'=>'Brand','error'=>false);
		}
		else{
			$data = array('title'=>'Brand','error'=>true);
		}
		$this->load->view('home/header');
		$this->load->view('login/reset_password',$data);
		$this->load->view('home/footer');
	}

	public function reset_pass(){
		$this->form_validation->set_rules('pwd','Password','required|min_length[8]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('re-pwd','Retype-Password','required|matches[pwd]|max_length[50]|xss_clean');
		if($this->form_validation->run()){
			$data = array(
				'table_name' => 'brands',
				'id' => $_POST['id'],
				'token' => $_POST['token'],
				'pwd'=>$_POST['pwd']
			);
			if($this->brand_model->change_pass($data)){
				$info['status']=TRUE;
				$info['msg']='Your Password Changed Successfully !';
			}
			else{
				$info['custom']='Password Could Not Be Changed!';
			}
		}
		else{
			$info['status']=False;
			foreach ($this->input->post() as $key => $value) {
				$info[$key]=form_error($key);
			}
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function maile(){
		$to = array('shivam.1513089@kiet.edu');
		$from = 'info@webassets.in';
		$subject = 'HELLO';
		$attach= null;
		$body = 'HELLO';
		$response = $this->custom_functions->mail_Send($to,$from,$subject,$attach,$body);
		var_dump($response);
	}

	public function withdraw_request() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}

		$amount = $this->input->post('amount');
		$walletAmount = $this->brand_model->get_wallet_amount();

		if($amount == '') {
			$info['error'] = true;
			$info['msg'] = 'Blank input!';
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		if($walletAmount < $amount) {
			$info['error'] = true;
			$info['msg'] = 'Not enough Balance!';
			header('Content-type: application/json');
			exit(json_encode($info));
		}

		if($this->brand_model->deduct_wallet($amount)) {
			if($this->brand_model->addWithdrawRequest($amount)) {
				$info['error'] = false;
				$info['msg'] = 'Request added';
				header('Content-type: application/json');
				exit(json_encode($info));
			}
			else {
				$info['error'] = true;
				$info['msg'] = 'Database error!';
				header('Content-type: application/json');
				exit(json_encode($info));
			}
		}
		else {
			$info['error'] = true;
			$info['msg'] = 'Database error!';
			header('Content-type: application/json');
			exit(json_encode($info));
		}

	}
	public function predict(){
		
		$brand_id = $this->brand_model->get_id();
			$data = $this->db->select('*')->from('payments')->where(['payment_from' => 'Brand', 'payer_id' => $brand_id])->get()->result_array();
			$this->header('Payments');
			$this->load->view('brand/predict');
			$this->footer();
		
	}
	public function reports_blood(){
		
		$brand_id = $this->brand_model->get_id();
			$data = $this->db->select('*')->from('payments')->where(['payment_from' => 'Brand', 'payer_id' => $brand_id])->get()->result_array();
			$this->header('Payments');
			$this->load->view('brand/predict');
			$this->footer();
		
	}

}

?>
