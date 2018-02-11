<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use MetzWeb\Instagram\Instagram;
use Abraham\TwitterOAuth\TwitterOAuth;
require_once APPPATH.'libraries/LinkedIn/autoload.php';
use LinkedIn\LinkedIn;

class Influencer extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('influencer_model');
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
			array(
				'name'  => 'Reports',
				'icon'  => 'gi gi-stats',
				'sub'   => array(
					array(
						'name'  => 'Blood Reports',
						'url'   => SITEURL.'influencer/reports/blood'
					),
					array(
						'name'  => 'Chronic Reports',
						'url'   => SITEURL.'influencer/reports/chronic'
					),
					
					array(
						'name'  => 'Genetic Reports',
						'url'   => SITEURL.'influencer/reports/genetic'
					),
					array(
						'name'  => 'Others Reports',
						'url'   => SITEURL.'influencer/reports/other'
					)
					
				)
			),
			array(
				'name'  => 'Payments',
				'url'   => SITEURL.'influencer/payments',
				'icon'  => 'gi gi-stopwatch'
			),
			array(
				'name'  => 'Self Diagnosis Tool',
				'url'   =>'http://127.0.0.1:5000',
				'icon'  => 'gi gi-stopwatch'
			),
			array(
				'name'  => 'Body Marks Index Calculation',
				'url'   =>SITEURL.'influencer/bmi',
				'icon'  => 'gi gi-stopwatch'
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

	public function index(){
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=influencer');
		}
		else{
			redirect(SITEURL.'influencer/bmi');
		}
	}

	private function upload_file($location, $name="", $userfile='userfile', $filetypes='gif|jpg|png'){
		$config['upload_path']          = $location;
		$config['allowed_types']        = $filetypes;
		if($name)
		$config['file_name'] = $name;
		$config['remove_spaces'] = TRUE;
		$config['max_size'] = 0;
		#$config['max_width']            = 1024;
		#$config['max_height']           = 768;
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
		return ($this->session->is_logged && $this->session->influencer) ? TRUE:FALSE;
	}

	public function dashboard(){
		if($this->check_session()){
			$this->header('Dashboard');
			$res = $this->dashboard_data();
			$this->load->view('influencer/new_index', $res);
			$this->footer();
		}
		else{
			redirect(SITEURL.'influencer');
		}
	}

	private function add_notif_inf($inf_id, $msg, $link, $category="") {
		$data = array(
			'inf_id' => $inf_id,
			'msg' => $msg,
			'link' => $link,
			'category' => $category,
			'time' => time()
		);
		$this->db->insert('notif_inf', $data);
	}

	private function add_notif_brand($brand_id, $msg, $link, $category="") {
		$data = array(
			'brand_id' => $brand_id,
			'msg' => $msg,
			'link' => $link,
			'category' => $category,
			'time' => time()
		);
		$this->db->insert('notif_brand', $data);
	}

	public function check_accounts() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=influencer');
		}
		$cat = $this->input->post('cat');
		$inf_id = $this->influencer_model->get_id();

		if($cat == 'Facebook') {
			$usedTokens = $this->db->distinct()->select('token_id')->from('camp_data')->where(['inf_id' => $inf_id])->get()->result_array();
			$usedTokens2 = [];
			foreach ($usedTokens as $key => $value) {
				$usedTokens2[] = $value['token_id'];
			}
			if(sizeof($usedTokens2) > 0) {
				$data = $this->db->select('id, category, name')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'fb', 'is_active' => 1])->where_not_in('id', $usedTokens2)->get()->result_array();
			}
			else {
				$data = $this->db->select('id, category, name')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'fb', 'is_active' => 1])->get()->result_array();
			}

			$ret = [];
			if(sizeof($data) > 1 || (sizeof($usedTokens2)>0&&sizeof($data)>0)) {
				$ret['multipleAccounts'] = true;
				$ret['accounts'] = $data;
			}
			else {
				$ret['multipleAccounts'] = false;
			}
			header('Content-type: application/json');
			exit(json_encode($ret));
		}
	}

	public function get_posts() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=influencer');
		}
		$cat = $this->input->post('cat');
		$msg = $this->input->post('msg');
		$inf_id = $this->influencer_model->get_id();
		$camp_id = $this->input->post('camp_id');
		$type = $this->db->select('camp_type,cm_link')->from('campaigns')->where('camp_id', $camp_id)->get()->row();
		$msg = $this->db->select('content')->from('approval')->where(['camp_id' => $camp_id, 'value' => 1, 'inf_id' => $inf_id])->get()->row()->content;
		$camp_type = $type->camp_type;
		$cm_link = $type->cm_link;

		if($cat == 'Facebook') {
			$fb = new Facebook\Facebook([
				'app_id' => FB_APP_ID,
				'app_secret' => FB_APP_SECRET,
				'default_graph_version' => FB_API_VERSION,
				'default_access_token' => FB_ACCESS_TOKEN
			]);
			$fbApp = new Facebook\FacebookApp(FB_APP_ID, FB_APP_SECRET);

			$account = $this->input->post('account');
			if($account) {
				$data = $this->db->select('*')->from('tokens')->where(['id' => $account, 'inf_id' => $inf_id, 'category' => 'fb', 'is_active' => 1])->get()->result_array();
			}
			else {
				$data = $this->db->select('*')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'fb', 'is_active' => 1])->get()->result_array();
			}
			if(isset($data[0])) {
				$data = $data[0];
			}
			else {
				$info['error'] = true;
				$info['msg'] = 'Database error';
				header('Content-type: application/json');
				exit(json_encode($info));
			}

			$page_id = $data['cat_id'];
			$access_token = $data['cat_token'];
			$access_token = json_decode($access_token, true);

			$request = new Facebook\FacebookRequest($fbApp, $access_token['access_token'], 'GET', '/'.$page_id.'/feed');
			$response = $fb->getClient()->sendRequest($request);
			$posts = $response->getDecodedBody();
			$posts = $posts['data'];

			$posts_p = [];
			$i = 0;
			foreach ($posts as $key => $value) {
				if(isset($value['message'])) {
					if($camp_type == 'Click') {
						if(strpos($value['message'], $cm_link) !== false) {
							similar_text($msg, $value['message'], $p);
							$value['percentage'] = $p;
							if($p>MIN_MATCH_PERCENT) {
								$posts_p[$i] = $value;
								$i=$i+1;
							}
						}
					}
					else {
						similar_text($msg, $value['message'], $p);
						$value['percentage'] = $p;
						if($p>MIN_MATCH_PERCENT) {
							$posts_p[$i] = $value;
							$i=$i+1;
						}
					}
				}
			}

			$posts = array_sort($posts_p, 'percentage', SORT_DESC);
			$size = sizeof($posts);
			if($size <= 5) {
				$posts_p = $posts;
			}
			else {
				$posts_p = [];
				for($i=0;$i<5;$i=$i+1) {
					$posts_p[$i] = $posts[$i];
				}
			}

			$info = [];
			$info['data'] = $posts_p;
			$info['account'] = $account;
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else if($cat == 'Instagram') {
			$data = $this->db->select('*')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'ins', 'is_active' => 1])->get()->result_array();
			$data = $data[0];

			$fb = new Facebook\Facebook([
				'app_id' => FB_APP_ID,
				'app_secret' => FB_APP_SECRET,
				'default_graph_version' => FB_API_VERSION,
				'default_access_token' => FB_ACCESS_TOKEN
			]);
			$fbApp = new Facebook\FacebookApp(FB_APP_ID, FB_APP_SECRET);

			$token = json_decode($data['cat_token'], true);
			$page_access_token = $token['access_token'];
			$account_id = $token['id'];

			$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/'.$account_id.'/media');
			$response = $fb->getClient()->sendRequest($request);
			$body = $response->getDecodedBody();
			$body = $body['data'];
			$posts = [];
			$posts_p = [];
			$i = 0;

			foreach ($body as $key => $value) {
				$post_id = $value['id'];//17895695668004550?fields=id,media_type,media_url,owner,timestamp
				$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/'.$post_id, ['fields' => 'media_url,caption,permalink']);
				$response = $fb->getClient()->sendRequest($request);
				$post_data = $response->getDecodedBody();

				if(isset($post_data['caption'])) {
					if($camp_type == 'Click') {
						if(strpos($post_data['caption'], $cm_link) !== false) {
							similar_text($msg, $post_data['caption'], $p);
							if($p>MIN_MATCH_PERCENT) {
								$posts[$i] = ['id' => $post_data['id'], 'msg' => $post_data['caption'], 'link' => $post_data['permalink'], 'image' => $post_data['media_url'], 'percentage' => $p];
								$i=$i+1;
							}
						}
					}
					else {
						similar_text($msg, $post_data['caption'], $p);
						if($p>MIN_MATCH_PERCENT) {
							$posts[$i] = ['id' => $post_data['id'], 'msg' => $post_data['caption'], 'link' => $post_data['permalink'], 'image' => $post_data['media_url'], 'percentage' => $p];
							$i=$i+1;
						}
					}
				}
			}

			$posts = array_sort($posts, 'percentage', SORT_DESC);
			$size = sizeof($posts);
			if($size <= 5) {
				$posts_p = $posts;
			}
			else {
				$posts_p = [];
				for($i=0;$i<5;$i=$i+1) {
					$posts_p[$i] = $posts[$i];
				}
			}
			header('Content-type: application/json');
			exit(json_encode($posts_p));
		}

		else if($cat == 'Twitter') {
			$data = $this->db->select('*')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'tw', 'is_active' => 1])->get()->result_array();
			$data = $data[0];
			$user_id = $data['cat_id'];
			$token = $data['cat_token'];

			$token = json_decode($token, true);
			$access_token = $token['access_token'];
			$access_token_secret = $token['access_token_secret'];

			$posts_p = [];
			$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $access_token, $access_token_secret);
			$posts = $connection->get("statuses/user_timeline", ["count" => 200, "exclude_replies" => true, 'screen_name' => $user_id]);
			$posts = json_decode(json_encode($posts), true);

			$i=0;
			foreach ($posts as $key => $value) {
				if(isset($value['text']) && $value['text'][0]!= 'R' && $value['text'][1]!= 'T') {
					similar_text($msg, $value['text'], $p);
					if($p>MIN_MATCH_PERCENT) {
						$posts_p[$i] = ['id' => $value['id_str'], 'msg' => $value['text'], 'percentage' => $p];
						$i=$i+1;
					}
				}
			}
			$posts = array_sort($posts_p, 'percentage', SORT_DESC);
			$size = sizeof($posts);
			if($size <= 5) {
				$posts_p = $posts;
			}
			else {
				$posts_p = [];
				for($i=0;$i<5;$i=$i+1) {
					$posts_p[$i] = $posts[$i];
				}
			}
			header('Content-type: application/json');
			exit(json_encode($posts_p));
		}
		else if($cat == 'Youtube') {
			$data = $this->db->select('*')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'yt', 'is_active' => 1])->get()->result_array();
			$data = $data[0];

			$yt_id = $data['cat_id'];
			$token = $data['cat_token'];
			$access_token = json_decode($token, true);

			$client = new Google_Client();
			$client->setApplicationName('WebAssets');
			$client->setScopes('https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/yt-analytics.readonly');
			$client->setAuthConfig(APPPATH.'config/google_client_secret.json');
			$client->setAccessType('offline');
			$client->setApprovalPrompt('force');
			$client->setRedirectUri(SITEURL.'influencer/reporting_google_callback');
			$guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
			$client->setHttpClient($guzzleClient);

			$client->setAccessToken($access_token);
			if ($client->isAccessTokenExpired()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			}

			$service = new Google_Service_YouTube($client);

			$part = 'snippet,contentDetails,statistics';
			$params = array('id' => $yt_id);
			$params = array_filter($params);
			$response = $service->channels->listChannels($part, $params);
			$channel = $response->getItems();
			$uploads = $channel[0]['contentDetails']['relatedPlaylists']['uploads'];

			$part = 'snippet,contentDetails';
			$params = array('maxResults' => 50, 'playlistId' => $uploads);
			$response = $service->playlistItems->listPlaylistItems($part, $params);
			$response = $response->getItems();

			$ret = [];
			$i=0;
			foreach ($response as $key => $value) {
				$ret[$i]['kind'] = $value['modelData']['snippet']['resourceId']['kind'];
				$ret[$i]['videoId'] = $value['modelData']['snippet']['resourceId']['videoId'];
				$i++;
			}

			header('Content-type: application/json');
			exit(json_encode($ret));
		}
		else if($cat == 'LinkedIn') {
			$data = $this->db->select('*')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'lin', 'is_active' => 1])->get()->result_array();
			$data = $data[0];
			$lin_id = $data['cat_id'];
			$token = $data['cat_token'];
			$access_token = json_decode($token, true);

			$li = new LinkedIn(
				array(
					'api_key' => LINKEDIN_CLIENT_ID,
					'api_secret' => LINKEDIN_CLIENT_SECRET,
					'callback_url' => SITEURL.'influencer/reporting_linkedin_callback'
				)
			);

			$li->setAccessToken($access_token['access_token']);
			$info = $li->get("/companies/{$lin_id}/updates?count=1000&format=json");
			$posts = $info['values'];

			$i=0;
			foreach ($posts as $key => $value) {
				if(isset($value['updateContent']['companyStatusUpdate']['share']['comment'])) {
					$content = $value['updateContent']['companyStatusUpdate']['share']['comment'];
					if($camp_type == 'Click') {
						if(strpos($content, $cm_link) !== false) {
							similar_text($msg, $content, $p);
							if($p>MIN_MATCH_PERCENT) {
								$posts_p[$i] = ['id' => $value['updateKey'], 'msg' => $content, 'percentage' => $p];
								$i=$i+1;
							}
						}
					}
					else {
						similar_text($msg, $content, $p);
						if($p>MIN_MATCH_PERCENT) {
							$posts_p[$i] = ['id' => $value['updateKey'], 'msg' => $content, 'percentage' => $p];
							$i=$i+1;
						}
					}
				}
			}

			$posts = array_sort($posts_p, 'percentage', SORT_DESC);
			$size = sizeof($posts);
			if($size <= 5) {
				$posts_p = $posts;
			}
			else {
				$posts_p = [];
				for($i=0;$i<5;$i=$i+1) {
					$posts_p[$i] = $posts[$i];
				}
			}
			header('Content-type: application/json');
			exit(json_encode($posts_p));
		}
	}

	public function analytics() {
		if($this->check_session()){
			$this->form_validation->set_rules('link','Link','required|xss_clean|trim');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

			if($this->form_validation->run()) {
				$cat = $this->input->post('cat');
				$inf_id = $this->influencer_model->get_id();
				if($cat == 'Facebook') {
					$link = $this->input->post("link");
					$camp_id = $this->input->post("camp_id");
					$account = $this->input->post('account');

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $inf_id;
					$data['token_id'] = $account;
					$data['camp_link'] = "https://www.facebook.com/".$link;
					$data['post_id'] = $link;
					$data['percent_completion'] = 0;
					$data['status'] = 1;
					$this->db->insert('camp_data', $data);

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $this->influencer_model->get_id();
					$data['last_run'] = time();
					$data['time'] = time();
					$data['is_active'] = '1';
					$data['token_id'] = $account;
					$this->db->insert('analytics', $data);

					$info['error']=FALSE;
					$info['msg']="Campaign Added!";
					header('Content-type: application/json');
					exit(json_encode($info));
				}
				else if($cat == 'Twitter') {
					$link = $this->input->post("link");
					$camp_id = $this->input->post("camp_id");

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $inf_id;
					$data['camp_link'] = 'https://www.twitter.com/statuses/'.$link;
					$data['post_id'] = $link;
					$data['percent_completion'] = 0;
					$data['status'] = 1;
					$this->db->insert('camp_data', $data);

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $this->influencer_model->get_id();
					$data['last_run'] = time();
					$data['time'] = time();
					$data['is_active'] = '1';
					$this->db->insert('analytics', $data);

					$info['error']=FALSE;
					$info['msg']="Camapign Added!";
					header('Content-type: application/json');
					exit(json_encode($info));
				}
				else if($cat == 'Youtube') {
					$link = $this->input->post("link");
					$camp_id = $this->input->post("camp_id");

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $inf_id;
					$data['camp_link'] = 'https://www.youtube.com/watch?v='.$link;
					$data['post_id'] = $link;
					$data['percent_completion'] = 0;
					$data['status'] = 1;
					$this->db->insert('camp_data', $data);

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $this->influencer_model->get_id();
					$data['last_run'] = time();
					$data['time'] = time();
					$data['is_active'] = '1';
					$this->db->insert('analytics', $data);

					$info['error']=FALSE;
					$info['msg']="Camapign Added!";
					header('Content-type: application/json');
					exit(json_encode($info));
				}
				else if($cat == 'Instagram') {
					$data = $this->input->post("link");
					$data = explode('@', $data);
					$link = $data[1];
					$post_id = $data[0];
					$camp_id = $this->input->post("camp_id");

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $inf_id;
					$data['camp_link'] = $link;
					$data['post_id'] = $post_id;
					$data['percent_completion'] = 0;
					$data['status'] = 1;
					$this->db->insert('camp_data', $data);

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $this->influencer_model->get_id();
					$data['last_run'] = time();
					$data['time'] = time();
					$data['is_active'] = '1';
					$this->db->insert('analytics', $data);

					$info['error']=FALSE;
					$info['msg']="Camapign Added!";
					header('Content-type: application/json');
					exit(json_encode($info));
				}
				else if($cat == 'LinkedIn') {
					$data = $this->input->post("link");
					$post_id = explode('-', $data);
					$camp_id = $this->input->post("camp_id");
					$this->db->where('camp_id', $camp_id);
					$this->db->update('campaigns', ['camp_link' => 'https://www.linkedin.com/feed/update/urn:li:activity:'.$post_id[2], 'post_id' => $data]);

					$data = [];
					$data['camp_id'] = $camp_id;
					$data['inf_id'] = $this->influencer_model->get_id();
					$data['last_run'] = time();
					$data['time'] = time();
					$data['is_active'] = '1';
					$this->db->insert('analytics', $data);

					$info['error']=FALSE;
					$info['msg']="Camapign Added!";
					header('Content-type: application/json');
					exit(json_encode($info));
				}
			}
			else {
				$info['error']=TRUE;
				foreach ($this->input->post() as $key => $value) {
					$info[$key]=form_error($key);
				}
			}
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else{
			redirect(SITEURL.'influencer');
		}
	}
	public function update_profile() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=influencer');
		}
		$info['status']=FALSE;
		$this->form_validation->set_rules('profile_name','Name','required|xss_clean');
		$this->form_validation->set_rules('profile_contact','Contact No','required|xss_clean');
		#$this->form_validation->set_rules('c-image','Image','required|xss_clean');
		if($this->form_validation->run()){
			$file_name = "";
			if(isset($_FILES['userfile']['name'])) {
				$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				$file_name = substr(md5(rand()), 0, 15).'.'.$ext;
				if(file_exists('./assets/images/influencers/'.$file_name)) {
					while(file_exists('./assets/images/influencers/'.$file_name)) {
						$file_name = substr(md5(rand()), 0, 15).'.'.$ext;
					}
				}
				$this->upload_file('./assets/images/influencers/', $file_name);
			}
			if($file_name) {
				$file_name = 'images/influencers/'.$file_name;
			}
			else if($this->input->post('image_link') != '') {
				$file_name = $this->input->post('image_link');
			}
			else {
				$file_name = $this->session->image;
			}

			if($page_name=$this->influencer_model->update_profile($file_name)){
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
		$_SESSION['phone']=$this->input->post('profile_contact');
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function do_login() {
		$this->form_validation->set_rules('l-email','Email','required|xss_clean');
		$this->form_validation->set_rules('l-pwd','Password','required|xss_clean');
		if($this->form_validation->run()){
			if($data=$this->influencer_model->get_session_inf()){
				$new_data=array();
				foreach($data as $key=>$value){
					$new_data[$key]=$value;
				}
				$info['status']=$new_data['is_logged']=TRUE;
				$new_data['influencer']=TRUE;
				$this->session->set_userdata($new_data);
			}
			else{
				$info['custom']='Either email or password is invalid!';
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

		$dbToken = $this->influencer_model->getActivateToken($email);
		if($dbToken == $token) {
			$this->influencer_model->activateAccount($email);
			redirect(SITEURL.'login?user=influencer&activate=success');
		}
		else {
			redirect(SITEURL.'login?user=influencer&activate=failed');
		}
	}

	public function do_signup() {
		$this->form_validation->set_rules('fname','First Name','required|xss_clean');
		$this->form_validation->set_rules('lname','Last Name','required|xss_clean');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[influencers.email]|is_unique[brands.email]|xss_clean');
		$this->form_validation->set_rules('mobile','Mobile number','required|exact_length[10]|integer|xss_clean');
		$this->form_validation->set_rules('pwd','Password','required|min_length[8]|xss_clean');
		$this->form_validation->set_rules('re-pwd','Retype-Password','required|matches[pwd]|xss_clean');
	
		if($this->form_validation->run()){
			$email = $this->input->post('email');
			$name = $this->input->post('fname');
			if($uniq_name = $this->influencer_model->register_influencer()){
				$length = 30;
				$token = $this->custom_functions->randomString($length);
				
				if($this->influencer_model->insert_activate_token($email, $token)){
					$to = [];
					$to[0] = $email;
					$from = 'info@webassets.in';
					$subject = 'Activate your account | WebAssets';
					$attach= null;
					$URL = SITEURL."influencer/activate_account?email=".$email."&token=".$token;
					$body = "<div>Hello <b>" . $name . "</b>,<br><br><p>In Order to activate your account, please click the link below <br><a href='".$URL."'>".$URL."</a><br><br></p>Regards,<br> Team Geek Dexter.<br>".$uniq_name."</div>";;
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
				$info['msg']='Account could not be created!';
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

	public function delete_social_account() {
		if(!$this->check_session()) {
			redirect(SITEURL.'influencer');
		}

		$id = $this->input->post('id');

		if($this->influencer_model->delete_social_account($id)) {
			header('Content-type: application/json');
			exit(json_encode(['error' => false]));
		}
		else {
			header('Content-type: application/json');
			exit(json_encode(['error' => true]));
		}
	}

	public function profile() {
		if($this->check_session()) {
			$fb = new Facebook\Facebook([
				'app_id' => FB_APP_ID,
				'app_secret' => FB_APP_SECRET,
				'default_graph_version' => FB_API_VERSION,
			]);

			$helper = $fb->getRedirectLoginHelper();

			$permissions = ['manage_pages', 'read_insights', 'pages_show_list'];
			$FBloginUrl = $helper->getLoginUrl(SITEURL.'influencer/reporting_facebook_callback', $permissions);

			$fb = new Facebook\Facebook([
				'app_id' => FB_APP_ID,
				'app_secret' => FB_APP_SECRET,
				'default_graph_version' => FB_API_VERSION,
			]);

			$helper = $fb->getRedirectLoginHelper();

			$permissions = ['manage_pages', 'read_insights', 'pages_show_list', 'instagram_basic', 'instagram_manage_insights'];
			$InsloginUrl = $helper->getLoginUrl(SITEURL.'influencer/reporting_fb_ins_callback', $permissions);

			$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
			$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => SITEURL."influencer/reporting_twitter_callback"));

			if(isset($request_token['oauth_token'])) {
				$_SESSION['oauth_token'] = $request_token['oauth_token'];
				$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

				$TWloginUrl = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
			}
			else {
				redirect(SITEURL.'influencer');
			}

			$client = new Google_Client();
			$client->setApplicationName('WebAssets');
			$client->setScopes('https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/yt-analytics.readonly');
			$client->setAuthConfig(APPPATH.'config/google_client_secret.json');
			$client->setAccessType('offline');
			$client->setApprovalPrompt('force');
			$client->setRedirectUri(SITEURL.'influencer/reporting_google_callback');
			$GoogleauthUrl = $client->createAuthUrl();

			$li = new LinkedIn(
				array(
					'api_key' => LINKEDIN_CLIENT_ID,
					'api_secret' => LINKEDIN_CLIENT_SECRET,
					'callback_url' => SITEURL.'influencer/reporting_linkedin_callback'
				)
			);

			$LinkedInurl = $li->getLoginUrl(array(LinkedIn::SCOPE_BASIC_PROFILE,LinkedIn::SCOPE_READ_WRITE_COMPANY_ADMIN));

			$inf_id = $this->influencer_model->get_id();

			$this->header('Profile');
			$data['profile']=$this->influencer_model->get_record('influencers', 'email', $this->session->email);
			$data['tokens']=$this->db->select('*')->from('tokens')->where(['inf_id' => $inf_id, 'is_active' => 1])->get()->result_array();
			$data['bank']=$this->influencer_model->get_bank_record();
			$data['facebook_login_url'] = $FBloginUrl;
			$data['instagram_login_url'] = $InsloginUrl;
			$data['twitter_login_url'] = $TWloginUrl;
			$data['google_login_url'] = $GoogleauthUrl;
			$data['linkedin_login_url'] = $LinkedInurl;
			$this->load->view('influencer/profile', $data);
			$this->footer();
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}

	public function reporting_linkedin_callback() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=influencer');
		}

		if(isset($_GET['code'])) {
			$li = new LinkedIn(
				array(
					'api_key' => LINKEDIN_CLIENT_ID,
					'api_secret' => LINKEDIN_CLIENT_SECRET,
					'callback_url' => SITEURL.'influencer/reporting_linkedin_callback'
				)
			);

			$token = $li->getAccessToken($_GET['code']);
			$token_expires = $li->getAccessTokenExpiration();
			$_SESSION['linkedin_access_token'] = $token;

			$li->setAccessToken($token);
			$info = $li->get('/companies?format=json&is-company-admin=true');
			if($info['_total'] == 0) {
				php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'You do not have any LinkedIn pages in your account.', 'type' => 'error']);
			}
			else {
				$this->header('LinkedIn callback');
				$this->load->view('influencer/linkedin_page_select', ['pages' => json_encode($info['values'])]);
				$this->footer();
			}
		}
		else {
			php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'Something went wrong.', 'type' => 'error']);
		}
	}

	public function linkedin_page_select() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=influencer');
		}
		$lin_id = $this->input->post('page_id');
		$lin_oauth_uid = json_encode(['access_token' => $_SESSION['linkedin_access_token']]);

		$li = new LinkedIn(
			array(
				'api_key' => LINKEDIN_CLIENT_ID,
				'api_secret' => LINKEDIN_CLIENT_SECRET,
				'callback_url' => SITEURL.'influencer/reporting_linkedin_callback'
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

	public function reporting_google_callback() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=influencer');
		}
		if($this->input->get('error')) {
			php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'Something went wrong!.', 'type' => 'error']);
		}
		$client = new Google_Client();
		$client->setApplicationName('WebAssets');
		$client->setScopes('https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/yt-analytics.readonly');
		$client->setAuthConfig(APPPATH.'config/google_client_secret.json');
		$client->setAccessType('offline');
		$client->setApprovalPrompt('force');
		$client->setRedirectUri(SITEURL.'influencer/reporting_google_callback');
		$guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
		$client->setHttpClient($guzzleClient);

		$authCode = $this->input->get('code');
		$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
		$client->setAccessToken($accessToken);

		if ($client->isAccessTokenExpired()) {
			$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
		}
		$service = new Google_Service_YouTube($client);
		$part = 'snippet,contentDetails,statistics';
		$params = array('mine' => true);
		$params = array_filter($params);
		$response = $service->channels->listChannels($part, $params);
		$channels = $response->getItems();

		$data = [];
		$i=0;
		foreach ($channels as $key => $value) {
			$data[$i]['id'] = $value['id'];
			$data[$i]['subscriberCount'] = $value['statistics']['subscriberCount'];
			$data[$i]['title'] = $value['snippet']['title'];
			$i++;
		}

		$_SESSION['google_access_token'] = $accessToken;

		$this->header('Google callback');
		$this->load->view('influencer/youtube_channel_select', ['channels' => json_encode($data)]);
		$this->footer();
	}

	public function youtube_channel_select() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=influencer');
		}

		$yt_id = $this->input->post('yt_id');
		$subscribers = $this->input->post('yt_followers');
		$channel_name = $this->input->post('channel_name');
		$yt_oauth_uid = json_encode($_SESSION['google_access_token']);

		$inf_id = $this->influencer_model->get_id();
		$time = time();
		$next_refresh = $time + 60*24*60*60;
		$table = ['inf_id' => $inf_id, 'category' => 'yt', 'cat_id' => $yt_id, 'name' => $channel_name, 'cat_token' => $yt_oauth_uid, 'followers' => $subscribers, 'added_on' => $time, 'next_refresh' => $next_refresh, 'is_active' => 1];
		$this->db->insert('tokens', $table);

		header('Content-type: application/json');
		exit(json_encode(['status' => true]));
	}

	public function reporting_twitter_callback() {
		if($this->check_session()) {
			if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
				$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
				$access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_GET['oauth_verifier']]);

				$data = array('id' => $access_token['user_id'],
				'access_token' => $access_token['oauth_token'],
				'access_token_secret' => $access_token['oauth_token_secret']);
				$data = json_encode($data);

				$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
				$content = $connection->get("account/verify_credentials");
				$followers = $content->followers_count ? $content->followers_count:0;

				$inf_id = $this->influencer_model->get_id();
				$time = time();
				$next_refresh = $time + 60*24*60*60;
				$table = ['inf_id' => $inf_id, 'category' => 'tw', 'cat_id' => $access_token['screen_name'], 'name' => $access_token['screen_name'], 'cat_token' => $data, 'followers' => $followers, 'added_on' => $time, 'next_refresh' => $next_refresh, 'is_active' => 1];
				$this->db->insert('tokens', $table);

				php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Congrats!', 'msg' => 'Your Twitter Account is now linked.', 'type' => 'success']);
			}
			else {
				php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'Something went wrong!.', 'type' => 'error']);
			}
		}
		else {
			php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'Something went wrong!.', 'type' => 'error']);
		}
	}

	public function reporting_fb_ins_callback() {
		if(!$this->check_session()){
			redirect(SITEURL.'influencer');
		}
		$fb = new Facebook\Facebook([
			'app_id' => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => FB_API_VERSION
		]);

		$helper = $fb->getRedirectLoginHelper();

		try {
			$accessToken = $helper->getAccessToken(SITEURL.'influencer/reporting_fb_ins_callback');
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if(!isset($accessToken)) {
			if($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			}
			else {
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

		if (!$accessToken->isLongLived()) {
			try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
				exit;
			}
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;
		redirect(SITEURL.'influencer/fb_ins_page_select');
	}

	public function fb_ins_page_select() {
		if(!$this->check_session()){
			redirect(SITEURL.'influencer');
		}
		$inf_id = $this->influencer_model->get_id();

		if($this->input->post('account_id')) {
			$q = $this->db->select('COUNT(*)')->from('tokens')->where(['cat_id' => $this->input->post('account_id'), 'category' => 'ins', 'inf_id' => $inf_id, 'is_active' => 1])->get()->result_array();
			if($q[0]['COUNT(*)'] > 0) {
				header('Content-type: application/json');
				exit(json_encode(['error' => true, 'msg' => 'Account already linked']));
			}

			$fb = new Facebook\Facebook([
				'app_id' => FB_APP_ID,
				'app_secret' => FB_APP_SECRET,
				'default_graph_version' => FB_API_VERSION,
				'default_access_token' => FB_ACCESS_TOKEN
			]);
			$fbApp = new Facebook\FacebookApp(FB_APP_ID, FB_APP_SECRET);

			$account_id = $this->input->post('account_id');
			$page_access_token = $_SESSION['fb_access_token'];
			$data = [];
			$data['access_token'] = $page_access_token;

			$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/'.$account_id, ['fields' => 'followers_count,username,profile_picture_url']);
			$response = $fb->getClient()->sendRequest($request);
			$body = $response->getDecodedBody();
			$followers = $body['followers_count'];
			$username = $body['username'];
			$profile_image = "";
			if(isset($body['profile_picture_url']))
			$profile_image = $body['profile_picture_url'];

			$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/me');
			$response = $fb->getClient()->sendRequest($request);
			$me = $response->getDecodedBody();
			$data['page_id'] = $me['id'];
			$data['id'] = $account_id;
			$data = json_encode($data);

			$inf_id = $this->influencer_model->get_id();
			$time = time();
			$next_refresh = $time + 60*24*60*60;
			$table = ['image' => $profile_image, 'inf_id' => $inf_id, 'category' => 'ins', 'cat_id' => $username, 'name' => $username, 'cat_token' => $data, 'followers' => $followers, 'added_on' => $time, 'next_refresh' => $next_refresh, 'is_active' => 1];
			$this->db->insert('tokens', $table);

			header('Content-type: application/json');
			exit(json_encode(['error' => false]));
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

		if($pages == Array()) {
			php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'Page access not given.', 'type' => 'error']);
			exit();
		}

		$key1 = 0;
		$pages1 = [];
		foreach ($pages as $key => $value) {
			$request = new Facebook\FacebookRequest($fbApp, $access_token, 'GET', '/'.$value['id'].'?fields=instagram_business_account');
			$response = $fb->getClient()->sendRequest($request);
			$body = $response->getDecodedBody();
			if(isset($body['instagram_business_account'])) {
				$ins_account = $body['instagram_business_account']['id'];
				$request = new Facebook\FacebookRequest($fbApp, $access_token, 'GET', '/'.$ins_account.'?fields=username');
				$response = $fb->getClient()->sendRequest($request);
				$body = $response->getDecodedBody();
				$value['ins_id'] = $ins_account;
				$value['ins_username'] = $body['username'];
				$value['access_token'] = 'nah bro!';
				$pages1[$key1++] = $value;
			}
		}

		if($pages1 == Array()) {
			php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'No Instagram account is linked.', 'type' => 'error']);
			exit();
		}
		$this->header('Instagram account select');
		$this->load->view('influencer/fb_ins_page_select', ['pages' => json_encode($pages1)]);
		$this->footer();
	}

	public function reporting_facebook_callback() {
		if(!$this->check_session()){
			redirect(SITEURL.'influencer');
		}
		$fb = new Facebook\Facebook([
			'app_id' => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => FB_API_VERSION
		]);

		$helper = $fb->getRedirectLoginHelper();

		try {
			$accessToken = $helper->getAccessToken(SITEURL.'influencer/reporting_facebook_callback');
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if(!isset($accessToken)) {
			if($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			}
			else {
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

		if (!$accessToken->isLongLived()) {
			try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
				exit;
			}
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;
		redirect(SITEURL.'influencer/facebook_page_select');
	}

	public function facebook_page_select() {
		if(!$this->check_session()){
			redirect(SITEURL.'influencer');
		}
		$inf_id = $this->influencer_model->get_id();

		if($this->input->post('page_id')) {
			$q = $this->db->select('COUNT(*)')->from('tokens')->where(['cat_id' => $this->input->post('page_id'), 'category' => 'fb', 'inf_id' => $inf_id, 'is_active' => 1])->get()->result_array();
			if($q[0]['COUNT(*)'] > 0) {
				header('Content-type: application/json');
				exit(json_encode(['error' => true, 'msg' => 'Account already linked']));
			}
			$fb = new Facebook\Facebook([
				'app_id' => FB_APP_ID,
				'app_secret' => FB_APP_SECRET,
				'default_graph_version' => FB_API_VERSION,
				'default_access_token' => FB_ACCESS_TOKEN
			]);
			$fbApp = new Facebook\FacebookApp(FB_APP_ID, FB_APP_SECRET);

			$page_id = $this->input->post('page_id');
			$page_access_token = $_SESSION['fb_access_token'];
			$data = [];
			$data['access_token'] = $page_access_token;

			$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/'.$page_id, ['fields' => 'fan_count']);
			$response = $fb->getClient()->sendRequest($request);
			$likes = $response->getDecodedBody();

			$request = new Facebook\FacebookRequest($fbApp, $page_access_token, 'GET', '/me');
			$response = $fb->getClient()->sendRequest($request);
			$me = $response->getDecodedBody();
			$data['id'] = $me['id'];
			$data = json_encode($data);
			$page_name = $this->input->post('page_name');

			$request = new Facebook\FacebookRequest($fbApp, $_SESSION['fb_user_access_token'], 'GET', '/me/picture', ['redirect' => false, 'height' => 2048]);
			$response = $fb->getClient()->sendRequest($request);
			$image = $response->getDecodedBody();
			$image = $image['data']['url'];

			$inf_id = $this->influencer_model->get_id();
			$time = time();
			$next_refresh = $time + 60*24*60*60;
			$table = ['image' => $image, 'inf_id' => $inf_id, 'category' => 'fb', 'name' => $page_name, 'cat_id' => $page_id, 'cat_token' => $data, 'followers' => $likes['fan_count'], 'added_on' => $time, 'next_refresh' => $next_refresh, 'is_active' => 1];
			$this->db->insert('tokens', $table);

			header('Content-type: application/json');
			exit(json_encode(['error' => false]));
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
		$_SESSION['fb_user_access_token'] = $access_token;

		$request = new Facebook\FacebookRequest($fbApp, $access_token, 'GET', '/me/accounts');
		$response = $fb->getClient()->sendRequest($request);
		$pages = $response->getDecodedBody();
		$pages = $pages['data'];

		if($pages == Array()) {
			php_redirect(SITEURL.'influencer/profile', ['swal' => '1', 'title' => 'Error!', 'msg' => 'Page access not given.', 'type' => 'error']);
			exit();
		}

		foreach ($pages as $key => $value) {
			$value['access_token'] = 'nah bro!';
			$pages[$key] = $value;
		}

		$this->header('Facebook page select');
		$this->load->view('influencer/facebook_page_select', ['pages' => json_encode($pages)]);
		$this->footer();
	}

	public function payments() {
		if($this->check_session()) {
			$inf_id = $this->influencer_model->get_id();
			$data = $this->db->select('*')->from('payments')->where(['payment_from' => 'WebAssets', 'payer_id' => $inf_id])->get()->result_array();

			$this->header('Payments');
			$this->load->view('influencer/payments', ['payments' => $data]);
			$this->footer();
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}

	public function campaigns() {
		if($this->check_session()) {
			$this->header('Campaigns');
			$this->load->view('influencer/campaigns');
			$this->footer();
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}
	public function messages() {
		if($this->check_session()) {
			$this->header('Messages');
			$data['payments']=$this->influencer_model->get_payments();
			$this->load->view('influencer/messages',$data);
			$this->footer();
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}
	public function update_influencer() {
		if($this->check_session()){
			$data=array(
				'table'=>'influencers',
				'where'=>array('id'=>$this->input->post('id'))
			);
			if($this->influencer_model->update_row($data)){
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
			echo json_encode($info);
		}
		else{
			redirect(SITEURL.'influencer');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(SITEURL.'influencer');
	}

	public function campaigns_ajax() {
		if($this->check_session()) {
			$seg = $this->input->post('seg');
			if($seg == 'all' || $seg == "")
			$info = $this->influencer_model->get_campaigns(0);
			else if($seg == 'approved')
			$info = $this->influencer_model->get_campaigns(1);
			else
			$info = $this->influencer_model->get_campaigns(0);

			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}

	public function open_notification() {
		if(!$this->check_session()){
			redirect(SITEURL.'influencer');
		}
		$id = $this->input->post('id');

		$notif = $this->db->select("*")->from('notif_inf')->where('id', $id)->where('category !=','Messages')->get()->result_array();
		if(!$notif || $notif == array() || !isset($notif[0])) {
			$info['error'] = true;
		}
		else {
			$info = $notif[0];
			$this->db->where('id', $id);
			$info['error'] = !$this->db->update('notif_inf', ['clicked' => '1']);
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}
	public function clear_notification() {
		if(!$this->check_session()){
			redirect(SITEURL.'influencer');
		}
		$inf_id = $this->influencer_model->get_id();
		$this->db->where('inf_id', $inf_id);
		$notif = $this->db->update('notif_inf', ['clicked' => '1']);

		if($notif) {
			$info['success']="Notification Cleared...";
		}
		else {
			$info['error'] = 'ERROR Please Try Again...';
		}
		header('Content-type: application/json');
		exit(json_encode($info));
	}

	public function check_proposal_get_approvals() {
		if($this->check_session()) {
			$camp_id = $this->input->post('camp_id');
			$inf_id = $this->influencer_model->get_id();

			$category_id = "";
			$camp_data = $this->db->select('*')->from('campaigns')->where('camp_id', $camp_id)->get()->result_array();
			if(sizeof($camp_data)==0) {
				$info['offer']['val'] = -2;
				header('Content-type: application/json');
				exit(json_encode($info));
			}
			$camp_data_new = $this->db->select('*')->from('camp_data')->where(['camp_id' => $camp_id, 'inf_id' => $inf_id])->get()->result_array();
			if(sizeof($camp_data_new)!=0) {
				$camp_data[0]['camp_link'] = $camp_data_new[0]['camp_link'];
				$camp_data[0]['post_id'] = $camp_data_new[0]['post_id'];
				$camp_data[0]['percent_completion'] = $camp_data_new[0]['percent_completion'];
			}
			else {
				$camp_data[0]['camp_link'] = "";
				$camp_data[0]['post_id'] = "";
				$camp_data[0]['percent_completion'] = "";
			}

			$info['camp_data'] = $camp_data[0];
			$category = $camp_data[0]['camp_category'];
			if($category == 'Facebook') {
				$category_id = $this->db->select('cat_id')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'fb'])->get()->result_array();
			}
			else if($category == 'Twitter') {
				$category_id = $this->db->select('cat_id')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'tw'])->get()->result_array();
			}
			else if($category == 'Youtube') {
				$category_id = $this->db->select('cat_id')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'yt'])->get()->result_array();
			}
			else if($category == 'Instagram') {
				$category_id = $this->db->select('cat_id')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'ins'])->get()->result_array();
			}
			else if($category == 'LinkedIn') {
				$category_id = $this->db->select('cat_id')->from('tokens')->where(['inf_id' => $inf_id, 'category' => 'lin'])->get()->result_array();
			}

			if(sizeof($category_id)==0) {
				$info['val'] = -1;
				$info['cat'] = $category;
			}
			else {
				$q = $this->db->select('pro_id, pro_price, pro_msg, approval')->from('proposals')->where(['pro_for' => $camp_id, 'pro_by' => $inf_id])->get()->result_array();
				if(!isset($q[0])) {
					$info['val'] = true;
				}
				else {
					$info = $q[0];
					$info['camp_data'] = $camp_data[0];
					$info['val'] = false;
				}
			}

			$data_ret['offer'] = $info;

			$this->db->where(['camp_id'=> $camp_id, 'inf_id' => $inf_id]);
			$q = $this->db->get('approval');
			$data = $q->result_array();
			$ret = [];
			$ret['camp_id'] = $camp_id;
			$ret['inf_id'] = $inf_id;
			if(!$data || $data == Array()) {
				$ret['approve'] = 0;
				$ret['error'] = 1;
			}
			else if($data[0]['value'] == 0) {
				$ret['approve'] = 0;
				$ret['error'] = 2;
				$ret['data'] = json_encode($data[0]);
			}
			else {
				$ret['approve'] = $data[0]['value'];
				$ret['error'] = 0;
				$ret['data'] = json_encode($data[0]);
			}

			$data = $camp_data;
			$ret['cat'] = $data[0]['camp_category'];
			if($data[0]['camp_link'] == "" || !$data[0]['camp_link']) {
				$ret['link'] = 0;
			}
			else {
				$ret['link'] = 1;
				$ret['link_val'] = $data[0]['camp_link'];
				$ret['post_id'] = $data[0]['post_id'];
			}
			$ret['cm_link'] = $data[0]['cm_link'];
			$this->db->where(['pro_for' => $camp_id, 'pro_by'=>$inf_id]);
			$this->db->select(['pro_id', 'approval']);
			$q = $this->db->get('proposals');
			$data = $q->result_array();
			if(!$data || $data == Array())
			$ret['pro'] = 0;
			else if($data[0]['approval'] == '0')
			$ret['pro'] = 1;
			else {
				$ret['pro'] = 2;
			}

			$data_ret['campaign'] = $ret;

			header('Content-type: application/json');
			exit(json_encode($data_ret));
		}
		else{
			redirect(SITEURL.'influencer');
		}
	}

	public function add_approval() {
		if($this->check_session()){
			$this->form_validation->set_rules('camp_id','Campaign Id','required|numeric|xss_clean|trim');
			$this->form_validation->set_rules('inf_id','Influencer Id','required|numeric|xss_clean|trim');
			$this->form_validation->set_rules('content','Campaign Content','required|max_length[2000]|xss_clean|trim');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if($this->form_validation->run()) {
				$camp_id = $this->input->post('camp_id');
				$inf_id = $this->input->post('inf_id');
				$pro_id = $this->input->post('pro_id');
				$content = htmlspecialchars($this->input->post('content'));
				$name = $this->influencer_model->get_name($inf_id);
				$imagename = "";
				$videoname = "";

				print_r($_FILES);

				if(isset($_FILES['userfile']['name'])) {
					$size = sizeof($_FILES['userfile']['name']);

					for ($i=0; $i < $size; $i++) {
						$ext = pathinfo($_FILES['userfile']['name'][$i], PATHINFO_EXTENSION);
						print_r($ext);

						if(strcasecmp($ext, 'jpg') == 0) {
							$file_name = substr(md5(rand()), 0, 15).'.'.$ext;
							if(file_exists('./uploads/images/approval/'.$file_name)) {
								while(file_exists('./uploads/images/approval/'.$file_name)) {
									$file_name = substr(md5(rand()), 0, 15).'.'.$ext;
								}
							}
							if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i], './uploads/images/approval/'.$file_name)) {
								$imagename = '/uploads/images/approval/'.$file_name;
							}
							else {
								$imagename = "/assets/images/noimage.png";
							}
						}
						else if(strcasecmp($ext, 'mp4') == 0) {
							$ext = pathinfo($_FILES['userfile']['name'][$i], PATHINFO_EXTENSION);
							$file_name = substr(md5(rand()), 0, 15).'.'.$ext;
							if(file_exists('./uploads/videos/approval/'.$file_name)) {
								while(file_exists('./uploads/videos/approval/'.$file_name)) {
									$file_name = substr(md5(rand()), 0, 15).'.'.$ext;
								}
							}
							if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i], './uploads/videos/approval/'.$file_name))
							$videoname = '/uploads/videos/approval/'.$file_name;
						}
					}
				}

				if($imagename == '') {
					$imagename = "/assets/images/noimage.png";
				}
				if($videoname == '') {
				}

				$ret = $this->influencer_model->add_approval($pro_id, $camp_id, $inf_id, $name, $imagename, $videoname, $content, 0);
				$ret_error = $ret['brand_id'];
				if($ret_error) {
					if($ret['operation'] == 1) {
						$this->add_notif_brand($ret_error, 'New campaign request', 'brand/view_campaign?camp_id='.$camp_id.'&redirect=id', 'Campaign');
					}
					else {
						$this->add_notif_brand($ret_error, 'Campaign request updated', 'brand/view_campaign?camp_id='.$camp_id.'&redirect=id', 'Campaign');
					}
					$info['error'] = false;
					$info['msg'] = "Campaign Request Placed!";
				}
				else {
					$info['error']=true;
					$info['msg']="Unknown error!";
				}
			}
			else {
				$info['error']=TRUE;
				foreach ($this->input->post() as $key => $value) {
					$info[$key]=form_error($key);
				}
			}
			redirect(SITEURL.'influencer/campaigns/all');
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else{
			redirect(SITEURL.'influencer');
		}
	}

	public function proposals_ajax(){
		if($this->check_session()) {
			$this->form_validation->set_rules('price','Price','required|numeric|xss_clean|trim');
			$this->form_validation->set_rules('msg','Message','required|xss_clean|max_length[250]|trim');
			$this->form_validation->set_rules('camp_id','OO','required|numeric|xss_clean|trim');
			$this->form_validation->set_error_delimiters('', '');
			if($this->form_validation->run()){
				$camp_id = $this->input->post('camp_id');
				$brand_id = $this->influencer_model->add_proposals();
				if($brand_id) {
					$info['error']=FALSE;
					$info['msg']='Successfully Placed';
					$this->add_notif_brand($brand_id, 'New offer on your campaign', 'brand/view_campaign?camp_id='.$camp_id.'&redirect=id', 'Offer');
				}
				else{
					$info['error']=TRUE;
					$info['msg']='Oh no!';
				}
			}
			else{
				$info['error']=TRUE;
				foreach ($this->input->post() as $key => $value) {
					if(form_error($key) != '') {
						$info['msg']=form_error($key);
						break;
					}
					$info[$key]=form_error($key);
				}
			}
			header('Content-type: application/json');
			exit(json_encode($info));
		}
		else {
			redirect(SITEURL.'influencer');
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
				if($this->influencer_model->add_bank_details()){
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
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}

	public function php_redirect() {
		if($this->check_session()) {
			php_redirect($this->input->post('url'), $_POST);
			exit();
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}

	public function analytics_check() {
		if(!$this->check_session()){
			redirect(SITEURL.'login?user=brand');
		}
		$camp_id = $this->input->post('camp_id');
		$inf_id = $this->influencer_model->get_id();

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

	public function view_campaign() {
		if($this->check_session() && $this->input->get('camp_id')) {
			if($this->input->get('redirect') == 'id') {
				$status = $this->input->get('status');
				$camp_data = $this->db->select("id")->from('campaigns')->where('camp_id', $this->input->get('camp_id'))->get()->result_array();
				$id = $camp_data[0]['id'];
				if($status != '') {
					php_redirect(SITEURL.'influencer/view_campaign', ['camp_id' => $id, 'status' => $status], 'GET');
				}
				else {
					php_redirect(SITEURL.'influencer/view_campaign', ['camp_id' => $id], 'GET');
				}
				exit();
			}

			$camp_data = $this->db->select("*")->from('campaigns')->where('id', $this->input->get('camp_id'))->get()->result_array();
			if(!$camp_data || !$camp_data[0]) {
				redirect(SITEURL.'influencer');
			}
			if($camp_data[0]['is_active'] == 0) {
				redirect(SITEURL.'influencer');
			}
			$this->header('View Campaign');
			$this->load->view('influencer/view_campaign', ['camp_data_all' => $camp_data]);
			$this->footer();
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}

	public function chat() {
		if($this->check_session()) {
			$id = $this->influencer_model->get_id();
			$id2 = $this->input->post('inf_id');
			if(isset($id2)){
				if($id==$id2){
				}else{
					redirect(SITEURL.'brand');
				}
			}
			$this->header('Chat');
			$this->load->view('brand/new_chat');
			$this->footer();
		}
		else {
			redirect(SITEURL.'influencer');
		}
	}

	public function dashboard_data() {
		$inf_id = $this->influencer_model->get_id();

		$click =0;
		$price = 0;
		$totalPrice = 0;
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
		$id = $this->influencer_model->get_id();
		$this->db->select('pro_for')->where('pro_by',$id)->where('approval',1)->from('proposals');
		$campquery=$this->db->get();
		$yourcamp = $campquery->num_rows();
		$this->db->select('chat_id')->where('inf_id',$id);
		$this->db->distinct();
		$this->db->from('chats');
		$chatquery=$this->db->get();
		$yourchat = $chatquery->num_rows();
		$query10 = $this->db->query("SELECT * FROM payments WHERE payer_id = {$id} AND payment_from = 'WebAssets'")->result_array();
		$totalprice = $this->db->query("SELECT * FROM payments WHERE   payment_from = 'WebAssets'")->result_array();
		$query5 = $this->db->query("SELECT * FROM proposals WHERE pro_by = {$id}")->result_array();

		$data = [];
		$i = 0;
		$ongoing_camp = 0;
		$completed_camp = 0;

		foreach( $query5 as $row) {
			$query6 = $this->db->select('name,created,image')->from('brands')->where('id',$row['brand_id'])->get()->result_array();
			$que = $this->db->select('*')->from('claim')->where('camp_id',$row['pro_for'])->get();

			if($que->num_rows()>0){
				$claim = TRUE;
			}else{
				$claim = FALSE;
			}
			$ongoing_camp = $this->db->select('*')->from('campaigns')->where('status','Ongoing')->where('camp_id',$row['pro_for'])->get()->num_rows()+$ongoing_camp;
			$completed_camp = $this->db->select('*')->from('campaigns')->where('status','Completed')->where('camp_id',$row['pro_for'])->get()->num_rows()+$completed_camp;
			$query7 = $this->db->select('value')->from('approval')->where('pro_id',$row['pro_id'])->get();
			$count = $query7->num_rows();
			$id2 = $row['pro_for'];
			$query8 = $this->db->query("SELECT * FROM campaigns WHERE camp_id = {$id2}");
			$query9 = $this->db->select('*')->from('camp_data')->where('camp_id',$id2)->where('inf_id',$id)->get();


			$count2 = $query8->num_rows();
			$count3 = $query9->num_rows();

			if($count2>0){
				if($count != 0) {
					$query7=$query7->result_array();
					$data[$i]['approval2']  = $query7[0]['value'];
				}
				else {
					$data[$i]['approval2']  = 'NULL';
				}
				$query8  = $query8->result_array();
				$query9  = $query9->result_array();

				$data[$i]['bname'] =  $query6[0]['name'];
				$data[$i]['created'] = $query6[0]['created'];
				$data[$i]['image'] = $query6[0]['image'];
				$data[$i]['brandid'] = $row['brand_id'];
				$data[$i]['infid'] = $id;
				$data[$i]['promsg'] = $row['pro_msg'];
				$data[$i]['pro_price']=$row['pro_price'];
				if($count3>0){
					$data[$i]['complete']=$query9[0]['percent_completion'];
				}else{
					$data[$i]['complete']=0;
				}
				$data[$i]['camp_name']= $query8[0]['camp_name'];
				$data[$i]['camp']= $query8[0]['camp_id'];
				$data[$i]['camp_category']= $query8[0]['camp_category'];

				$data[$i]['camp_completion_date']= $query8[0]['camp_completion_date'];
				$data[$i]['claim']= $claim;
				$data[$i]['is_active'] = $query8[0]['is_active'];
				if($row['approval']=='1') {
					$data[$i]['status']='APPROVED';
				}
				elseif($row['approval']=='-1') {
					$data[$i]['status']='REJECTED';
				}
				else {
					$data[$i]['status']='PENDING';
				}
				$i++;

				if($query10){
					foreach($query10 as $row){
						$price += $row['total'];
					}
				}
				if($totalprice){
					foreach($totalprice as $row){
						$totalPrice += $row['total'];
					}
				}
			}
		}

		$retVal= array('infcount'=>$inf,'brandcount'=>$brands,'campcount'=>$camp,'chatscount'=>$chta,'data'=>$data,'clicks'=>$click,'price'=>$price,'yourchat'=>$yourchat,'yourcamp'=>$yourcamp,'totalprice'=>$totalPrice,'ongoing_camp'=>$ongoing_camp,'completed_camp'=>$completed_camp);
		return $retVal;
	}

	public function clickmeter_report_datapoint($datapoint) {
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

	public function claim() {
		if($this->input->post('id')){
			$info = $this->influencer_model->claim();
			header('Content-type: application/json');
			exit(json_encode($info));

		}else{
			redirect(SITEURL.'influencer');
		}
	}
	public function check_user(){
		$this->form_validation->set_rules('for_email','Email','required|valid_email|xss_clean');
		if($this->form_validation->run()){
			$for_email =$_POST['for_email'];
			$count = $this->db->select('id,email,name')->from('influencers')->where('email',$for_email)->where('is_active',1)->get();
			if($count->num_rows()>0){
				$count = $count->result_array();
				$length = 30;
				$token = $this->custom_functions->randomString($length);
				$data = array(
					'table_name' => 'influencers', // pass the real table name
					'id' => $count[0]['id'],
					'token' => $token
				);
				if($this->influencer_model->insert_token($data)){
					$info['status'] = true;
					$info['msg'] = 'Reset link send to the registered email!';
					$to = array($count[0]['email']);
					$from = 'info@webassets.in';
					$subject = 'Password Reset Link';
					$attach= null;
					$URL = SITEURL."influencer/forgot_pass?id=".$count[0]["id"]."&user=influencer&token=".$token;
					$body = "<div>Hello <b>" . $count[0]["name"] . "</b>,<br><br><p>In Order To Change Your Password Please .Click the Link Below <br><a href='".$URL."'>".$URL."</a><br><br></p>Regards,<br> Team Webassets.</div>";;
					$response = $this->custom_functions->mail_Send($to,$from,$subject,$attach,$body);
					if($response=='Message could not be sent.'){
						$info['status'] = false;
						$info['custom'] = 'Email server error! Try again.';
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
		$check = $this->db->select('*')->from('influencers')->where('id',$_GET['id'])->where('token',$_GET['token'])->get();
		$count = $check->num_rows();
		if($count>0){
			$data = array('title'=>'Influencer','error'=>false);
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
				'table_name' => 'influencers',
				'id' => $_POST['id'],
				'token' => $_POST['token'],
				'pwd'=>$_POST['pwd']
			);
			if($this->influencer_model->change_pass($data)){
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
	public function bmi(){
		$this->header('Body Mass Index');
		$this->load->view('influencer/bmi');
		$this->footer();
		
		}

}
