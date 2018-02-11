<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/openpayu/lib/openpayu.php');
require_once(APPPATH . 'config/payu.php');

class Payu extends CI_Controller {
  public $_api_context;

  function  __construct() {
    parent::__construct();
    $this->load->model('payu_model', 'payu');
    $this->load->model('brand_model');
  }

  public function index() {
    print("Direct access not allowed!!");
  }

  public function create_payment_with_payu() {
    /*print_r($this->db->select('*')->from('influencers'));
    $camp_data = json_decode($this->input->post('camp_data'), true);
    $proposals = json_decode($this->input->post('proposals_data'), true);
    $id = $proposals['pro_id'];*/
    $amount = $this->input->post('amount');

    $PAYU_BASE_URL = "https://secure.payu.in";
    $MERCHANT_KEY = PAYU_MERCHANT_KEY;
    $SALT = PAYU_SALT;
    $action = '';

    $posted = array();
    $formError = 0;
    if(empty($posted['txnid'])) {
      // Generate random transaction id
      $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    }
    else {
      $txnid = $posted['txnid'];
    }
    $hash = '';

    $posted['hash'] = $hash;
    $posted['key'] = $MERCHANT_KEY;
    $posted['txnid'] = $txnid;
    $posted['amount'] = $amount;
    $posted['firstname'] = $_SESSION['name'];
    $posted['email'] = $_SESSION['email'];
    $posted['phone'] = $_SESSION['phone'];
    $posted['productinfo'] = 'WebAssets Wallet';
    $posted['surl'] = SITEURL.'payu/payu_success';
    $posted['furl'] = SITEURL.'payu/payu_failed';
    $posted['service_provider'] = 'payu_paisa';
    $posted['udf1'] = 0;
    $posted['udf2'] = 0;

    // Hash Sequence
    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    if(empty($posted['hash']) && sizeof($posted) > 0) {
      if(
        empty($posted['key'])
        || empty($posted['txnid'])
        || empty($posted['amount'])
        || empty($posted['firstname'])
        || empty($posted['email'])
        || empty($posted['phone'])
        || empty($posted['productinfo'])
        || empty($posted['surl'])
        || empty($posted['furl'])
        || empty($posted['service_provider'])
      ) {
        $formError = 1;
      }
      else {
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach($hashVarsSeq as $hash_var) {
          $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
          $hash_string .= '|';
        }
        $hash_string .= $SALT;

        $hash = strtolower(hash('sha512', $hash_string));
        $posted['hash'] = $hash;

        $action = $PAYU_BASE_URL . '/_payment';

        php_redirect($action, $posted, 'POST');
        exit();
      }
    }
    elseif(!empty($posted['hash'])) {
      $hash = $posted['hash'];
      $action = $PAYU_BASE_URL . '/_payment';
    }
  }

  public function payu_success() {
    $brand_id = $this->brand_model->get_id();
    $status = $_POST["status"];
    $firstname = $_POST["firstname"];
    $amount = $_POST["amount"];
    $txnid = $_POST["txnid"];
    $posted_hash = $_POST["hash"];
    $key = $_POST["key"];
    $productinfo = $_POST["productinfo"];
    $email = $_POST["email"];
    $camp_id = $_POST["udf1"];
    $pro_id = $_POST["udf2"];
    $salt = PAYU_SALT;

    if (isset($_POST["additionalCharges"])) {
      $additionalCharges = $_POST["additionalCharges"];
      $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||'.$pro_id.'|'.$camp_id.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }
    else {
      $retHashSeq = $salt.'|'.$status.'|||||||||'.$pro_id.'|'.$camp_id.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }
	/*var_dump($_POST);
	var_dump($retHashSeq);
	die();*/
    $hash = hash("sha512", $retHashSeq);

    if ($hash != $posted_hash) {
      redirect(SITEURL.'brand/profile?status=failed');
    }
    else {
      $Total = $amount;
      $Subtotal = $amount;
      $Tax = 0;
      $PaymentMethod = 'payumoney';
      $PayerStatus = $status;
      $PayerMail = $email;
      $saleId = $txnid;
      $CreateTime = date('Y-m-d H:i:s');
      $UpdateTime = date('Y-m-d H:i:s');
      $State = $status;
      if($this->payu->add_payment($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State,$camp_id)) {
        if($this->db->query('UPDATE wallets SET amount = amount+'.$amount.' WHERE brand_id = '.$brand_id)) {
          redirect(SITEURL.'brand/profile?status=success');
        }
        else {
          redirect(SITEURL.'brand/profile?status=failed_webassets');
        }
      }
      else {
        redirect(SITEURL.'brand/profile?status=failed');
      }
    }
  }

  public function payu_failed() {
    $status=$_POST["status"];
    $firstname=$_POST["firstname"];
    $amount=$_POST["amount"];
    $txnid=$_POST["txnid"];

    $posted_hash=$_POST["hash"];
    $key=$_POST["key"];
    $productinfo=$_POST["productinfo"];
    $email=$_POST["email"];
    $camp_id=$_POST["udf1"];
    $pro_id=$_POST["udf2"];
    $salt=PAYU_SALT;

    if (isset($_POST["additionalCharges"])) {
      $additionalCharges=$_POST["additionalCharges"];
      $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||'.$pro_id.'|'.$camp_id.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }
    else {
      $retHashSeq = $salt.'|'.$status.'|||||||||'.$pro_id.'|'.$camp_id.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }
    $hash = hash("sha512", $retHashSeq);

    if ($hash != $posted_hash) {
      redirect(SITEURL.'brand/profile?status=success');
    }
    else {
      redirect(SITEURL.'brand/profile?status=failed');
    }
  }
}
?>
