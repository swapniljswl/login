<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib_email{
	private $CI;
	private $from_email = "pass@rdso.railnet.gov.in"; 
	private $config;
	public function __construct()
	{
		$this->CI=& get_instance();

		$this->config = array(
	    'protocol'  => 'smtp',
	    'smtp_host' => 'ssl://mail.gov.in',
	    'smtp_port' => '465',
	    'smtp_user' => 'pass.rdsor@nic.in',//'jeit1.rdsor@nic.in',//
	    'smtp_pass' => 'A@aBC%13',//'123aA_456',//
	    'smtp_crypto' => 'security',
	    'mailtype'  => 'html', 
	    'charset'   => 'utf-8',
	    'newline'   => "\r\n",
	    'crlf' => "\r\n",
	    'wordwrap' => TRUE
	    );
		date_default_timezone_set('Asia/Kolkata');	 
	    $this->CI->load->library('email');

	    $this->CI->email->initialize($this->config);
		
	}

	public function is_connected()
 	{
	    $connected = @fsockopen("www.google.com", 80); 
	   	//website, port  (try 80 or 443)
	    if ($connected){
	        $is_conn = true; //action when connected
	        fclose($connected);
	    }else{
	        $is_conn = false; //action in connection failure
	    }
	    return $is_conn;

 	}

	public function email($to,$sub,$msg,$attachment=Null)
 	{
 		
	    $this->CI->email->from($this->from_email, 'RDSO'); 
	    $this->CI->email->subject($sub);
	    $this->CI->email->message($msg); 
	    if($attachment)
	    	$this->CI->email->attach($attachment);
	    $this->CI->email->to($to);
	    $this->CI->email->cc($this->from_email);
	    $error=$this->CI->email->send();
	 
 	}
}