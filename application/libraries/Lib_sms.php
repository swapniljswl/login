<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib_sms{

	private $username='20091034';
	//private $password='rgp46d';
	private $password='sms@rdso11';
	public function sms($mob,$msg)
	{
	  
	 // $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$this->username."&passwd=".$this->password."&text=".urlencode($msg)."&msisdn=".$mob."&mode=Txt";
$url="http://bulksmsindia.mobi/sendurlcomma.aspx?user=".$this->username."&pwd=".$this->password."&senderid=RDSOTX&mobileno=".$mob."&msgtext=".urlencode($msg)."&smstype=0/4/3 ";
	 $ch  = curl_init();
	 curl_setopt ($ch,CURLOPT_URL, $url) ;
	 curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	 $response = curl_exec($ch) ;
	 curl_close($ch) ;
	}
}
