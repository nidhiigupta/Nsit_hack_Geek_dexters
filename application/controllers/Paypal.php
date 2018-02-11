<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/paypal-php-sdk/paypal/rest-api-sdk-php/sample/bootstrap.php'); // require paypal files

use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Amount;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;

class Paypal extends CI_Controller {
  public $_api_context;

  function  __construct() {
    parent::__construct();
    $this->load->model('paypal_model', 'paypal');
    // paypal credentials
    $this->config->load('paypal');

    $this->_api_context = new \PayPal\Rest\ApiContext(
      new \PayPal\Auth\OAuthTokenCredential(PAYPAL_CLIENT_ID, PAYPAL_SECRET_ID)
    );
  }

  function index() {
    $camp_id = $this->input->get("camp_id");
    redirect(SITEURL.'brand/view_campaign?camp_id='.$camp_id."&status=failed");
  }

  function create_payment_with_paypal() {
    print_r("Paypal is coming soon...");
    exit();
    // setup PayPal api context
    $this->_api_context->setConfig($this->config->item('settings'));
    // ### Payer
    // A resource representing a Payer that funds a payment
    // For direct credit card payments, set payment method
    // to 'credit_card' and add an array of funding instruments.

    $camp_data = json_decode($this->input->post('camp_data'), true);
    $proposals_data = json_decode($this->input->post('proposals_data'), true);
    // $payer['payment_method'] = 'credit_card';
    $payer['payment_method'] = 'paypal';
    $camp_id = $camp_data['camp_id'];
    // ### Itemized information
    // (Optional) Lets you specify item wise
    // information

    $item1["currency"] = $camp_data['camp_price_currency'];
    $item1["quantity"] = 1;
    $item1["price"] = $proposals_data['pro_price'];

    $itemList = new ItemList();
    $itemList->setItems(array($item1));

    // ### Additional payment details
    // Use this optional field to set additional
    // payment information such as tax, shipping
    // charges etc.

    $details['subtotal'] = $proposals_data['pro_price'];
    //tax will be what webassets will earn
    $details['tax'] = (20/100)*floatval($details['subtotal']);
    // ### Amount
    // Lets you specify a payment amount.
    // You can also specify additional details
    // such as shipping, tax.
    $amount['currency'] = $camp_data['camp_price_currency'];
    $amount['total'] = $details['tax'] + $details['subtotal'];
    $amount['details'] = $details;
    // ### Transaction
    // A transaction defines the contract of a
    // payment - what is the payment for and who
    // is fulfilling it.
    $transaction['description'] ='Payment description';
    $transaction['amount'] = $amount;
    $transaction['invoice_number'] = uniqid();
    $transaction['item_list'] = $itemList;

    // ### Redirect urls
    // Set the urls that the buyer must be redirected to after
    // payment approval/ cancellation.
    $baseUrl = SITEURL;
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl($baseUrl."paypal/getPaymentStatus?camp_id=".$camp_id."&pro_id=".$proposals_data['pro_id'])
    ->setCancelUrl($baseUrl."paypal/getPaymentStatus?camp_id=".$camp_id);

    // ### Payment
    // A Payment Resource; create one using
    // the above types and intent set to sale 'sale'
    $payment = new Payment();
    $payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

    try {
      $payment->create($this->_api_context);
    }
    catch (Exception $ex) {
      // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
      print("Error: ");
      print_r($ex);
      exit();
    }
    foreach($payment->getLinks() as $link) {
      if($link->getRel() == 'approval_url') {
        $redirect_url = $link->getHref();
        break;
      }
    }

    if(isset($redirect_url)) {
      /** redirect to paypal **/
      redirect($redirect_url);
    }

    $this->session->set_flashdata('success_msg','Unknown error occurred');
    redirect('paypal/index');
  }

  public function getPaymentStatus() {
    /** Get the payment ID before session clear **/
    $payment_id = $this->input->get("paymentId");
    $PayerID = $this->input->get("PayerID");
    $token = $this->input->get("token");
    $camp_id = $this->input->get("camp_id");
    $pro_id = $this->input->get("pro_id");
    /** clear the session payment ID **/

    if (empty($PayerID) || empty($token)) {
      //NON AUTHENTICATED USER
      $this->session->set_flashdata('success_msg','Payment failed');
      redirect('paypal/index');
    }

    $payment = Payment::get($payment_id,$this->_api_context);

    /** PaymentExecution object includes information necessary **/
    /** to execute a PayPal account payment. **/
    /** The payer_id is added to the request query parameters **/
    /** when the user is redirected from paypal back to your site **/
    $execution = new PaymentExecution();
    $execution->setPayerId($this->input->get('PayerID'));

    /**Execute the payment **/
    $result = $payment->execute($execution,$this->_api_context);

    //  DEBUG RESULT, remove it later **/
    if ($result->getState() == 'approved') {
      $trans = $result->getTransactions();
      // item info
      $Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
      $Tax = $trans[0]->getAmount()->getDetails()->getTax();

      $payer = $result->getPayer();
      // payer info //
      $PaymentMethod =$payer->getPaymentMethod();
      $PayerStatus =$payer->getStatus();
      $PayerMail =$payer->getPayerInfo()->getEmail();

      $relatedResources = $trans[0]->getRelatedResources();
      $sale = $relatedResources[0]->getSale();
      // sale info //
      $saleId = $sale->getId();
      $CreateTime = date('Y-m-d H:i:s');
      $UpdateTime = date('Y-m-d H:i:s');
      $State = $sale->getState();
      $Total = $sale->getAmount()->getTotal();
      /** it's all right **/
      /** Here Write your database logic like that insert record or value in database if you want **/

      if($this->paypal->add_payment($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State,$camp_id)) {
        $this->db->set('approval', '1');
        $this->db->where(['pro_id'=> $pro_id]);
        $this->db->update('proposals');

        $this->session->set_flashdata('success_msg','Payment success');
        redirect(SITEURL.'brand/view_campaign?camp_id='.$camp_id."&status=success&redirect=id");
      }
      else {
        redirect(SITEURL.'brand/view_campaign?camp_id='.$camp_id."&status=failed&redirect=id");
      }
    }
    //$this->session->set_flashdata('success_msg','Payment failed');
    //redirect to any place you wANT
    redirect(SITEURL.'brand/view_campaign?camp_id='.$camp_id."&status=failed&redirect=id");
  }
}
?>
