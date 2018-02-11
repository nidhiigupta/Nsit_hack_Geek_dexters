<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use MetzWeb\Instagram\Instagram;
use Abraham\TwitterOAuth\TwitterOAuth;
require_once APPPATH.'libraries/LinkedIn/autoload.php';
use LinkedIn\LinkedIn;

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->library('session');
	}

	private function header($title = 'Dashboard') {
		$template = array(
			'name'              => 'WebAssets',
			'version'           => 'beta',
			'author'            => 'WebAssets',
			'robots'            => 'WebAssets is a social media monetization and management platform.',
			'title'             => $title.' - WebAssets',
			'description'       => 'WebAssets is a social media monetization and management platform.',
			'page_preloader'    => false,
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
			array(
				'name' => 'All Admins',
				'icon'  => 'gi gi-gamepad',
				'url' => SITEURL.'admin/admins'
			),
			array(
				'name' => 'All Brands',
				'icon'  => 'gi gi-gamepad',
				'url' => SITEURL.'admin/all_brands'
			),
			array(
				'name' => 'All Influencers',
				'icon'  => 'gi gi-gamepad',
				'url' => SITEURL.'admin/all_influencers'
			),
			array(
				'name'  => 'Campaigns',
				'icon'  => 'gi gi-gamepad',
				'sub'   => array(
					array(
						'name'  => 'Live Campaigns',
						'url'   => SITEURL.'admin/campaigns/live'
					),
					array(
						'name'  => 'Review Pending Campaigns',
						'url'   => SITEURL.'admin/campaigns/pending'
					),
					array(
						'name'  => 'Blocked Campaigns',
						'url'   => SITEURL.'admin/campaigns/blocked'
					)
				)
			),
			array(
				'name' => 'Reporting',
				'icon'  => 'gi gi-gamepad',
				'url' => SITEURL.'admin/reporting'
			),
			array(
				'name' => 'Influencer Claims',
				'icon'  => 'gi gi-gamepad',
				'url' => SITEURL.'admin/claims'
			),
			array(
				'name' => 'Brand Withdrawals',
				'icon'  => 'gi gi-gamepad',
				'url' => SITEURL.'admin/withdraw_request'
			)
		);

		$this->load->view('template/config', ['template' => $template, 'primary_nav' => $primary_nav]);
		$this->load->view('template/template_start');
		$this->load->view('template/page_head');
	}
	private function footer() {
		$this->load->view('template/page_footer');
		$this->load->view('template/template_scripts');
		$this->load->view('template/template_end');
	}
	private function check_session(){
		return ($this->session->is_logged && $this->session->admin) ? TRUE:FALSE;
	}
	public function index(){
		if(!$this->check_session()){
			$this->load->view('admin/login');
		}
		else{
			redirect(SITEURL.'admin/campaigns/live');
		}
	}

	public function campaigns() {
		if($this->check_session()) {
			$this->header('Campaigns');
			$this->load->view('admin/campaigns');
			$this->footer();
		}
		else {
			redirect(SITEURL.'admin');
		}
	}

	public function campaigns_ajax() {
		if(!$this->check_session()){
			$this->load->view('admin/login');
		}
		$seg = $this->input->post('seg');
		if($seg == 'pending') {
			$data=array(
				'status' => 'Ongoing',
				'is_active' => '2'
			);
		}
		else if($seg == 'blocked') {
			$data=array(
				'status' => 'Ongoing',
				'is_active' => '3'
			);
		}
		else {
			$data=array(
				'status' => 'Ongoing',
				'is_active' => '1'
			);
		}
		$final = [];
		$ids = $this->db->distinct()->select('id')->from('campaigns')->where($data)->get()->result_array();

		foreach ($ids as $key => $id) {
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

		header('Content-type: application/json');
		exit(json_encode($final));
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

	public function approve_campaign(){
		if(!$this->check_session()) {
			redirect(SITEURL.'admin');
		}
		$id = $this->uri->segment(3);
		$this->db->set('is_active','1');
		$this->db->where('id', $id);
		if($this->db->update('campaigns')) {
			$brand_id = $this->db->select('camp_by')->from('campaigns')->where('id', $id)->get()->row()->camp_by;
			$info='Successfully Approved!';
			$this->add_notif_brand($brand_id, 'Campaign approved!', 'brand/view_campaign?camp_id='.$id, 'Campaign');
		}
		else {
			$info='Error!';
		}

		header('Content-type: application/json');
		echo json_encode($info);
	}

	public function block_campaign(){
		if(!$this->check_session()) {
			redirect(SITEURL.'admin');
		}
		$id = $this->uri->segment(3);
		$this->db->set('is_active','3');
		$this->db->where('id', $id);
		if($this->db->update('campaigns')) {
			$info='Successfully Blocked!';
		}
		else {
			$info='Error!';
		}

		header('Content-type: application/json');
		echo json_encode($info);
	}

	public function view_campaign() {
		if($this->check_session() && $this->input->get('camp_id')) {
			$camp_data = $this->db->select("*")->from('campaigns')->where('id', $this->input->get('camp_id'))->get()->result_array();
			$camp_id = $camp_data[0]['camp_id'];
			if(!$camp_data || !$camp_data[0]) {
				redirect(SITEURL.'admin');
			}

			$this->header('View Campaign');
			$this->load->view('admin/view_campaign', ['camp_data_all' => $camp_data]);
			$this->footer();
		}
		else {
			redirect(SITEURL.'brand');
		}
	}

	public function do_login(){
		$this->form_validation->set_rules('email','Email','required|max_length[50]|valid_email|xss_clean');
		$this->form_validation->set_rules('pwd','Password','required|max_length[50]|xss_clean');
		if($this->form_validation->run()){
			if($data=$this->admin_model->get_session_admin()){
				$new_data=array();
				foreach($data as $key=>$value){
					$new_data[$key]=$value;
				}
				$info['status']=$new_data['is_logged']=TRUE;
				$new_data['admin']=TRUE;
				$this->session->set_userdata($new_data);
			}
			else{
				$info['custom']='Either email or password is invalid!';
			}
		}else{
			foreach ($this->input->post() as $key => $value) {
				$info[$key]=form_error($key);
			}
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function do_signup() {
		$this->form_validation->set_rules('name','Name','required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[admins.admin_email]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('phone','Mobile number','required|exact_length[10]|integer|xss_clean');
		$this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[50]|xss_clean');

		if($this->form_validation->run()) {
			if($this->admin_model->register_admin()){
				$info['status']=TRUE;
				$info['msg']='Your account successfully created!';
			}
			else
			$info['msg']='Account could not be created!';
		}
		else {
			foreach ($this->input->post() as $key => $value) {
				$info[$key]=form_error($key);
			}
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function dashboard(){
		if($this->check_session()){
			$data['total']=$this->admin_model->count_all_table_rows();
			$this->header();
			$this->load->view('admin/index',$data);
			$this->footer();
		}
		else
		redirect(SITEURL.'admin');
	}
	public function admins(){
		if($this->check_session()){
			$this->header();
			$data['admins']=$this->admin_model->all_table_rorws('admins');
			$this->load->view('admin/admins',$data);
			$this->footer();
		}else{
			redirect(SITEURL.'admin');
		}
	}
	public function payments(){
		if($this->check_session()){
			$this->header();
			$data['payments']=$this->admin_model->get_payments();
			$this->load->view('admin/payments',$data);
			$this->footer();
		}else{
			redirect(SITEURL.'admin');
		}
	}
	public function influencers(){
		if($this->check_session()){
			$this->header();
			$data['influencers']=$this->admin_model->all_table_rorws('influencers');
			$this->load->view('admin/influencers',$data);
			$this->footer();
		}else{
			redirect(SITEURL.'admin');
		}
	}
	public function brands(){
		if($this->check_session()){
			$this->header();
			$data['brands']=$this->admin_model->all_table_rorws('brands');
			$this->load->view('admin/brands',$data);
			$this->footer();
		}else{
			redirect(SITEURL.'admin');
		}
	}
	public function profile(){
		if($this->check_session()){
			$this->header();

			$data['profile']=$this->admin_model->get_profile();
			$this->load->view('admin/profile',$data);
			$this->footer();
		}else{
			redirect(SITEURL.'admin');
		}
	}
	public function update_profile(){
		$info['status']=FALSE;
		#$this->form_validation->set_rules('profile_name','Title','required|xss_clean');
		#$this->form_validation->set_rules('profile_contact','Contact No','required|xss_clean');
		if($this->form_validation->run()){
			if($this->upload_file('./assets/images/admins/')){
				if($this->admin_model->update_profile('/images/admins/'.$_FILES['userfile']['name'])){
					$info['msg']='Profile Updated Successfully!';
					$info['status']=TRUE;
				}
				else{
					$info['error']='Ohh no !!';
				}
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

	public function update_brand(){
		if($this->check_session()){
			$data=array(
				'table'=>'brands',
				'where'=>array('brand_id'=>$this->input->post('id'))
			);
			if($this->admin_model->update_row($data)){
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
		}
		else {
			redirect(SITEURL.'admin');
		}
	}

	public function delete_brand(){
		if($this->check_session()){
			$data=array(
				'table'=>'brands',
				'where'=>array('brand_id'=>$this->input->post('id')),
			);
			if($this->admin_model->delete_row($data)){
				$info['status']=TRUE;
				$info['msg']='Successfully deleted!';
			}
			else{
				$info['status']=FALSE;
				$info['msg']='OOps.., try again!';
			}
			header('Content-type: application/json');
			echo json_encode( $info);
		}
		else {
			redirect(SITEURL.'admin');
		}
	}

	public function update_influencer(){
		if($this->check_session()){
			$data=array(
				'table'=>'influencers',
				'where'=>array('inf_id'=>$this->input->post('id'))
			);
			if($this->admin_model->update_row($data)){
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
		}else {
			redirect(SITEURL.'admin');
		}
	}

	public function update_payment(){
		if($this->check_session()){
			if($this->admin_model->update_payment()){
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
		}
		else {
			redirect(SITEURL.'admin');
		}
	}

	public function delete_influencer(){
		if($this->check_session()){
			$data=array(
				'table'=>'influencers',
				'where'=>array('inf_id'=>$this->input->post('id')),
			);
			if($this->admin_model->delete_row($data)){
				$info['status']=TRUE;
				$info['msg']='Successfully deleted!';
			}
			else{
				$info['status']=FALSE;
				$info['msg']='OOps.., try again!';
			}
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else{
			redirect(SITEURL.'admin');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(SITEURL.'admin');
	}

	/*public function run_analytics() {
		if($this->check_session()){

			$this->db->update('analytics', ['is_active' => 0]);
			$this->db->update('reporting', ['is_active' => 0]);

			$this->header();
			$this->load->view('admin/run_analytics');
			$this->footer();
		}
		else {
			redirect(SITEURL.'admin');
		}
	}*/

	public function reporting() {
		if(!$this->check_session()){
			redirect(SITEURL.'admin');
		}
		$data = $this->db->select("report_id,id,category,name")->from('reporting')->get()->result_array();

		$fb = new Facebook\Facebook([
			'app_id' => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => FB_API_VERSION,
		]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['manage_pages', 'read_insights'];
		$FBloginUrl = $helper->getLoginUrl(SITEURL.'admin/reporting_facebook_callback', $permissions);

		$instagram = new Instagram(array(
			'apiKey'      => INSTAGRAM_CLIENT_ID,
			'apiSecret'   => INSTAGRAM_CLIENT_SECRET,
			'apiCallback' => SITEURL.'admin/reporting_instagram_callback'
		));

		$InsloginUrl = $instagram->getLoginUrl(['basic']);

		$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => SITEURL."admin/reporting_twitter_callback"));

		if(isset($request_token['oauth_token'])) {
			$_SESSION['oauth_token'] = $request_token['oauth_token'];
			$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

			$TWloginUrl = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		}
		else {
			redirect(SITEURL.'admin');
		}

		$li = new LinkedIn(
			array(
				'api_key' => LINKEDIN_CLIENT_ID,
				'api_secret' => LINKEDIN_CLIENT_SECRET,
				'callback_url' => SITEURL.'admin/reporting_linkedin_callback'
			)
		);

		$LinkedInurl = $li->getLoginUrl(array(LinkedIn::SCOPE_BASIC_PROFILE,LinkedIn::SCOPE_READ_WRITE_COMPANY_ADMIN));

		$this->header();
		$this->load->view('admin/reporting', ['facebook_login_url' => $FBloginUrl, 'instagram_login_url' => $InsloginUrl, 'twitter_login_url' => $TWloginUrl, 'linkedin_login_url' => $LinkedInurl, 'data' => $data]);
		$this->footer();
	}

	public function reporting_linkedin_callback() {
		if(!$this->check_session()){
			redirect(SITEURL.'admin');
		}
		if(isset($_GET['code'])) {
			$li = new LinkedIn(
				array(
					'api_key' => LINKEDIN_CLIENT_ID,
					'api_secret' => LINKEDIN_CLIENT_SECRET,
					'callback_url' => SITEURL.'admin/reporting_linkedin_callback'
				)
			);

			$token = $li->getAccessToken($_GET['code']);
			$token_expires = $li->getAccessTokenExpiration();
			$_SESSION['linkedin_access_token'] = $token;

			$li->setAccessToken($token);
			$info = $li->get('/companies?format=json&is-company-admin=true');
			if($info['_total'] == 0) {
				print_r("NOT ADMIN");
				//php_redirect(SITEURL.'brand/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'You do not have any LinkedIn pages in your account.', 'type' => 'error']);
			}
			else {
				$this->header();
				$this->load->view('admin/linkedin_page_select', ['pages' => json_encode($info['values'])]);
				$this->footer();
			}
		}
		else {
			print_r("NOT ADMIN");
			//php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'Something went wrong.', 'type' => 'error']);
		}
	}

	public function linkedin_page_select() {
		if(!$this->check_session()){
			redirect(SITEURL.'admin');
		}
		$lin_id = $this->input->post('page_id');
		$lin_oauth_uid = json_encode(['access_token' => $_SESSION['linkedin_access_token']]);

		$li = new LinkedIn(
			array(
				'api_key' => LINKEDIN_CLIENT_ID,
				'api_secret' => LINKEDIN_CLIENT_SECRET,
				'callback_url' => SITEURL.'admin/reporting_linkedin_callback'
			)
		);

		$li->setAccessToken($_SESSION['linkedin_access_token']);
		$info = $li->get("/companies/{$lin_id}/company-statistics?format=json");
		$followers = $info['followStatistics']['count'];

		$table = ['lin_id' => $lin_id, 'lin_oauth_uid' => $lin_oauth_uid, 'lin_followers' => $followers];
		$inf_id = $this->influencer_model->get_id();
		$this->db->where('id', $inf_id);
		$this->db->update('influencers', $table);

		header('Content-type: application/json');
		exit(json_encode(['status' => true]));
	}

	public function reporting_twitter_callback() {
		if($this->check_session()) {
			if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
				$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
				$access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_GET['oauth_verifier']]);

				$data = array('cat' => 'Twitter',
				'id' => $access_token['user_id'],
				'access_token' => $access_token['oauth_token'],
				'access_token_secret' => $access_token['oauth_token_secret']);

				$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
				$content = $connection->get("account/verify_credentials");
				$_SESSION['report_data'] = "";
				$_SESSION['report_data'] = $content->name." (".$content->screen_name.")";

				php_redirect(SITEURL.'admin/add_report', $data);
			}
			else {
				redirect(SITEURL.'admin');
			}
		}
		else {
			redirect(SITEURL.'admin');
		}
	}

	public function reporting_instagram_callback() {
		if(!$this->check_session()){
			redirect(SITEURL.'admin');
		}
		if($this->input->get('code')) {
			$instagram = new Instagram(array(
				'apiKey'      => INSTAGRAM_CLIENT_ID,
				'apiSecret'   => INSTAGRAM_CLIENT_SECRET,
				'apiCallback' => SITEURL.'admin/reporting_instagram_callback'
			));

			$code = $_GET['code'];
			$data = $instagram->getOAuthToken($code);
			$data = json_decode(json_encode($data), true);

			if(!isset($data['access_token'])) {
				$error = true;
			}
			else {
				$_SESSION['id'] = $data['user']['id'];
				$_SESSION['username'] = $data['user']['username'];
				$_SESSION['access_token'] = $data['access_token'];
				$_SESSION['cat'] = 'Instagram';
				$error = false;
				redirect(SITEURL.'admin/add_report');
			}
		}
		else {
			redirect(SITEURL.'admin');
		}
	}

	public function reporting_facebook_callback() {
		if(!$this->check_session()){
			redirect(SITEURL.'admin');
		}
		$fb = new Facebook\Facebook([
			'app_id' => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => FB_API_VERSION,
			'default_access_token' => FB_ACCESS_TOKEN
		]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['manage_pages', 'read_insights'];
		$FBloginUrl = $helper->getLoginUrl(SITEURL.'admin/reporting_facebook_callback', $permissions);

		try {
			$accessToken = $helper->getAccessToken(SITEURL.'admin/reporting_facebook_callback');
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if (!isset($accessToken)) {
			if ($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			} else {
				header('HTTP/1.0 400 Bad Request');
				echo 'Bad request';
			}
			exit;
		}
		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);

		$tokenMetadata->validateAppId(FB_APP_ID);
		$tokenMetadata->validateExpiration();

		if (! $accessToken->isLongLived()) {
			// Exchanges a short-lived access token for a long-lived one
			try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			}
			catch (Facebook\Exceptions\FacebookSDKException $e) {
				echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
				exit;
			}
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;
		header('Location: '.SITEURL.'admin/facebook_reporting');
	}

	public function facebook_reporting() {
		if(!$this->check_session()){
			redirect(SITEURL.'admin');
		}
		$fb = new Facebook\Facebook([
			'app_id' => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => FB_API_VERSION,
			'default_access_token' => FB_ACCESS_TOKEN
		]);
		$fbApp = new Facebook\FacebookApp(FB_APP_ID, FB_APP_SECRET);

		$access_token = $_SESSION['fb_access_token'];
		$request = new Facebook\FacebookRequest($fbApp, FB_ACCESS_TOKEN, 'GET', '/oauth/access_token?grant_type=fb_exchange_token&client_id='.FB_APP_ID.'&client_secret='.FB_APP_SECRET.'&fb_exchange_token='.$access_token);
		try {
			$response = $fb->getClient()->sendRequest($request);
		}
		catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		}
		catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$arr = $response->getDecodedBody();
		$access_token = $arr['access_token'];

		$request = new Facebook\FacebookRequest($fbApp, $access_token, 'GET', '/me/accounts');
		$response = $fb->getClient()->sendRequest($request);
		$pages = $response->getDecodedBody();

		$pages = $pages['data'];
		$_SESSION['report_data'] = $pages;

		$this->header();
		$this->load->view('admin/facebook_reporting', ['pages' => json_encode($pages)]);
		$this->footer();
	}

	public function add_report(){
		if(!$this->check_session()){
			redirect(SITEURL.'admin');
		}
		$category = $this->input->post('cat');
		if($category == '' && isset($_SESSION['cat']))
		$category = $_SESSION['cat'];
		$info = [];

		if($category == 'Facebook') {
			$data['id'] = $this->input->post('page_id');
			$data['access_token'] = $_SESSION['fb_access_token'];
			$data['access_token_secret'] = '';
			$data['category'] = $category;
			$data['last_run'] = time();
			$data['time'] = time();
			$data['name'] = "";
			foreach ($_SESSION['report_data'] as $key => $value) {
				if($value['id'] == $data['id']) {
					$data['name'] = $value['name'];
					break;
				}
			}
			$this->db->insert('reporting', $data);

			$info['error'] = 0;
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else if($category == 'Instagram') {
			$data['id'] = $_SESSION['id'];
			$data['access_token'] = $_SESSION['access_token'];
			$data['access_token_secret'] = '';
			$data['category'] = $category;
			$data['last_run'] = time();
			$data['time'] = time();
			$data['name'] = $_SESSION['username'];
			$this->db->insert('reporting', $data);

			$info['error'] = 0;
			redirect(SITEURL.'admin/reporting');
		}
		else if($category == 'Twitter') {
			$data['id'] = $this->input->post('id');
			$data['access_token'] = $this->input->post('access_token');
			$data['access_token_secret'] = $this->input->post('access_token_secret');
			$data['category'] = $category;
			$data['last_run'] = time();
			$data['time'] = time();
			$data['name'] = "";
			if(isset($_SESSION['report_data'])) {
				$data['name'] = $_SESSION['report_data'];
			}
			$this->db->insert('reporting', $data);

			$info['error'] = 0;
			redirect(SITEURL.'admin/reporting');
		}
		else if($category == 'LinkedIn') {
			$data['id'] = $this->input->post('id');
			$data['access_token'] = $_SESSION['linkedin_access_token'];
			$data['category'] = $category;
			$data['last_run'] = time();
			$data['time'] = time();
			$data['name'] = $this->input->post('name');
			$this->db->insert('reporting', $data);

			$info['error'] = 0;
			redirect(SITEURL.'admin/reporting');
		}

		$info['error'] = 1;
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function call_reports() {
		$cat = $this->input->post('category');
		$report_id = $this->input->post('report_id');

		$reports = $this->db->select('*')->from('reporting')->where('report_id', $report_id)->get()->row();

		if($cat == 'Facebook') {
			$fb = new Facebook\Facebook([
				'app_id' => FB_APP_ID,
				'app_secret' => FB_APP_SECRET,
				'default_graph_version' => FB_API_VERSION,
				'default_access_token' => FB_ACCESS_TOKEN
			]);
			$fbApp = new Facebook\FacebookApp(FB_APP_ID, FB_APP_SECRET);

			$page_id = $reports->id;
			$page_access_token = $reports->access_token;

			$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/'.$page_id.'/insights/page_views_total,page_engaged_users,page_consumptions,page_consumptions_unique,page_impressions,page_impressions_unique');
			$response = $fb->getClient()->sendRequest($request);
			$insights = $response->getDecodedBody();
			$insights = $insights['data'];
			$data = [];
			foreach ($insights as $key => $value) {
				if($value['name'] == 'page_engaged_users' && $value['period'] == 'day') {
					$data['page_engaged_users'] = $value['values'][1]['value'];
				}
				if($value['name'] == 'page_consumptions' && $value['period'] == 'day') {
					$data['page_consumptions'] = $value['values'][1]['value'];
				}
				if($value['name'] == 'page_consumptions_unique' && $value['period'] == 'day') {
					$data['page_consumptions_unique'] = $value['values'][1]['value'];
				}
				if($value['name'] == 'page_impressions' && $value['period'] == 'day') {
					$data['page_impressions'] = $value['values'][1]['value'];
				}
				if($value['name'] == 'page_impressions_unique' && $value['period'] == 'day') {
					$data['page_impressions_unique'] = $value['values'][1]['value'];
				}
				if($value['name'] == 'page_views_total' && $value['period'] == 'day') {
					$data['page_views_total'] = $value['values'][1]['value'];
				}
			}

			$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/'.$page_id.'/feed');
			$response = $fb->getClient()->sendRequest($request);
			$posts = $response->getDecodedBody();
			$posts = $posts['data'];
			$data['posts_count'] = count($posts);

			$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/'.$page_id, ['fields' => 'fan_count']);
			$response = $fb->getClient()->sendRequest($request);
			$likes = $response->getDecodedBody();
			$data['page_likes'] = $likes['fan_count'];

			$data['time'] = date('jS F Y h:i:s A');
			$data['timestamp'] = time();

			$file = @fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'r');
			if(!$file) {
				@fclose($file);
				$file = fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'w');
				fputcsv($file, ['page_engaged_users', 'page_consumptions', 'page_consumptions_unique', 'page_impressions', 'page_impressions_unique', 'page_views_total', 'posts_count', 'page_likes', 'date_time', 'timestamp']);
				fclose($file);
			}

			$file = fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'a+');
			fputcsv($file, $data);
			fclose($file);
			print("OK");
			exit();
		}

		else if($cat == 'Instagram') {
			$insta_user_id = $reports->id;
			$access_token = $reports->access_token;

			$instagram = new Instagram(array(
				'apiKey'      => INSTAGRAM_CLIENT_ID,
				'apiSecret'   => INSTAGRAM_CLIENT_SECRET,
				'apiCallback' => SITEURL.'admin/reporting_instagram_callback'
			));

			$instagram->setAccessToken($access_token);
			$data = $instagram->getUser();
			$insta_user = json_decode(json_encode($data), true);

			$data = [];
			$data = $insta_user['data']['counts'];
			$data['time'] = date('jS F Y h:i:s A');
			$data['timestamp'] = time();

			$file = @fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'r');
			if(!$file) {
				@fclose($file);
				$file = fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'w');
				fputcsv($file, ['total_posts', 'following', 'followers', 'date_time', 'timestamp']);
				fclose($file);
			}

			$file = fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'a+');
			fputcsv($file, $data);
			fclose($file);
			print("OK");
			exit();
		}

		else if($cat == 'Twitter') {
			$user_id = $reports->id;
			$access_token = $reports->access_token;
			$access_token_secret = $reports->access_token_secret;

			$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $access_token, $access_token_secret);
			$content = $connection->get("account/verify_credentials");
			$data['followers'] = $content->followers_count ? $content->followers_count:0;
			$data['following'] = $content->friends_count ? $content->friends_count:0;
			$data['tweets'] = $content->statuses_count ? $content->statuses_count:0;

			$content = $connection->get("statuses/mentions_timeline", ['count' => '200']);
			$data['twitter_mentions'] = sizeof($content);

			$data['time'] = date('jS F Y h:i:s A');
			$data['timestamp'] = time();

			$file = @fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'r');
			if(!$file) {
				@fclose($file);
				$file = fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'w');
				fputcsv($file, ['followers', 'following', 'tweets', 'twitter_mentions', 'date_time', 'timestamp']);
				fclose($file);
			}

			$file = fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'a+');
			fputcsv($file, $data);
			fclose($file);
			print("OK");
			exit();
		}

		else if($cat == 'LinkedIn') {
			$lin_id = $reports->id;
			$access_token = $reports->access_token;
			$li = new LinkedIn(
				array(
					'api_key' => LINKEDIN_CLIENT_ID,
					'api_secret' => LINKEDIN_CLIENT_SECRET,
					'callback_url' => SITEURL.'admin/reporting_linkedin_callback'
				)
			);

			$li->setAccessToken($access_token);
			$time = time()*1000 - 24*60*1000;

			$info = $li->get("companies/{$lin_id}/historical-follow-statistics?time-granularity=day&start-timestamp={$time}&format=json");
			$data['totalFollowerCount'] = 0;
			$data['paidFollowerCount'] = 0;
			if(isset($info['values'][0]['totalFollowerCount'])) {
				$data['totalFollowerCount'] = $info['values'][0]['totalFollowerCount'];
				$data['paidFollowerCount'] = $info['values'][0]['paidFollowerCount'];
			}

			$info = $li->get("companies/{$lin_id}/historical-status-update-statistics?time-granularity=day&start-timestamp={$time}&format=json");
			$data['impressionCount'] = 0;
			if(isset($info['values'][0]['impressionCount'])) {
				$data['impressionCount'] = $info['values'][0]['impressionCount'];
			}
			$data['time'] = date('jS F Y h:i:s A');
			$data['timestamp'] = time();

			$file = @fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'r');
			if(!$file) {
				@fclose($file);
				$file = fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'w');
				fputcsv($file, ['totalFollowerCount', 'paidFollowerCount', 'impressionCount', 'date_time', 'timestamp']);
				fclose($file);
			}

			$file = fopen(FCPATH.'assets/downloads/reporting/reporting_'.$report_id.'.csv', 'a+');
			fputcsv($file, $data);
			fclose($file);
			print("OK");
			exit();
		}

		else {
			print_r("Category mismatch");
			exit();
		}
	}
}
