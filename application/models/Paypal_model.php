<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Paypal_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_id(){
		return $this->db->select('id')->from('brands')->where('email',$this->session->email)->get()->row()->id;
	}

	function add_payment($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State,$camp_id) {
		$data = [];
		$data['sale_id'] = $saleId;
		$data['payment_from'] = 'Brand';
		$data['payer_id'] = $this->get_id();
		$data['payer_email'] = $PayerMail;
		$data['camp_id'] = $camp_id;
		$data['payment_method'] = $PaymentMethod;
		$data['total'] = $Total;
		$data['tax'] = $Tax;
		$data['subtotal'] = $Subtotal;
		$data['time'] = $CreateTime;

		return $this->db->insert('payments', $data);
	}
}
