<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function index() {
    if(!isset($_GET['user']) || ($_GET['user'] != 'brand' && $_GET['user'] != 'influencer')) {
      php_redirect(SITEURL."login?user=brand", []);
    }

    $this->load->view('home/header');
    $this->load->view('login/index');
    $this->load->view('home/footer');
  }
}
