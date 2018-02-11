<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('brand_model');
		$this->load->model('influencer_model');
	}

  private function check_session(){
		return ($this->session->is_logged) ? TRUE:FALSE;
	}
  private function getUserType() {
    if($this->session->influencer) {
      return 'i';
    }
    else if ($this->session->brand) {
      return 'b';
    }
    else {
      return false;
    }
  }

	private function influencerHeader($title = 'Dashboard') {
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
				'name'  => 'Dashboard',
				'url'   => SITEURL.'influencer/dashboard',
				'icon'  => 'gi gi-home'
			),
			array(
				'name'  => 'Campaigns',
				'icon'  => 'gi gi-gamepad',
				'sub'   => array(
					array(
						'name'  => 'All Campaigns',
						'url'   => SITEURL.'influencer/campaigns/all'
					),
					array(
						'name'  => 'Approved Campaigns',
						'url'   => SITEURL.'influencer/campaigns/approved'
					)
				)
			),
			array(
				'name'  => 'Payments',
				'url'   => SITEURL.'influencer/payments',
				'icon'  => 'gi gi-stopwatch'
			)
		);

		$this->load->view('template/config', ['template' => $template, 'primary_nav' => $primary_nav]);
		$this->load->view('template/template_start');
		$this->load->view('template/page_head');
	}

	private function brandHeader($title = 'Dashboard') {
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
				'name'  => 'Dashboard',
				'url'   => SITEURL.'brand/dashboard',
				'icon'  => 'gi gi-stopwatch'
			),
			array(
				'name'  => 'Campaigns',
				'icon'  => 'gi gi-shopping_cart',
				'sub'   => array(
					array(
						'name'  => 'All Campaigns',
						'url'   => SITEURL.'brand/campaigns/all'
					),
					array(
						'name'  => 'Offer Requests',
						'url'   => SITEURL.'brand/campaigns/offers'
					),
					array(
						'name'  => 'Pending Campaigns',
						'url'   => SITEURL.'brand/campaigns/pending'
					)
				)
			),
			array(
				'name'  => 'Payments',
				'url'   => SITEURL.'brand/payments',
				'icon'  => 'gi gi-stopwatch'
			),
			array(
				'name'  => 'Influencers',
				'url'   => SITEURL.'brand/influencer',
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

  public function index() {
    if(!$this->check_session()){
      redirect(SITEURL);
    }
		$userType = $this->getUserType();
		$type = $this->uri->segment(3);

		if($type == '') {
			if($userType == 'i') {
				redirect(SITEURL.'influencer/profile');
			}
			else if($userType == 'b') {
				redirect(SITEURL.'brand/profile');
			}
		}
  }

	public function brand() {
		if(!$this->check_session()){
      redirect(SITEURL);
    }
		$userType = $this->getUserType();
		$id = $this->input->get('id');

		if($id == '') {
			if($userType == 'i') {
				redirect(SITEURL.'influencer/profile');
			}
			else if($userType == 'b') {
				redirect(SITEURL.'brand/profile');
			}
		}

		$data['profile']=$this->brand_model->get_record('brands', 'id', $id);
		$profile = json_decode(json_encode($data['profile']), true);

		if(!isset($profile['image'])) {
			if($userType == 'i') {
				redirect(SITEURL.'influencer/profile');
			}
			else if($userType == 'b') {
				redirect(SITEURL.'brand/profile');
			}
		}

		if($userType == 'i') {
			$this->influencerHeader();
		}
		else if($userType == 'b') {
			$this->brandHeader();
		}
		$this->load->view('view_profile/brand', $data);
		$this->footer();
	}

	public function influencer() {
		if(!$this->check_session()){
      redirect(SITEURL);
    }
		$userType = $this->getUserType();
		$id = $this->input->get('id');

		if($id == '') {
			if($userType == 'i') {
				redirect(SITEURL.'influencer/profile');
			}
			else if($userType == 'b') {
				redirect(SITEURL.'brand/profile');
			}
		}

		$data['profile'] = $this->influencer_model->get_record('influencers', 'id', $id);
		$profile = json_decode(json_encode($data['profile']), true);

		if(!isset($profile['image'])) {
			if($userType == 'i') {
				redirect(SITEURL.'influencer/profile');
			}
			else if($userType == 'b') {
				redirect(SITEURL.'brand/profile');
			}
		}

		$data['tokens'] = $this->db->select('*')->from('tokens')->where('inf_id', $id)->get()->result_array();

		if($userType == 'i') {
			$this->influencerHeader();
		}
		else if($userType == 'b') {
			$this->brandHeader();
		}
		$this->load->view('view_profile/influencer', $data);
		$this->footer();
	}

}

?>
