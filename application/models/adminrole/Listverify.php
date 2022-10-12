<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listverify extends CI_Model
{
		public function __construct()
	{
		$this->load->helper('string');
		parent::__construct();
		$this->load->database();
         $this->load->library('session'); 
         $this->load->helper('form'); 
		 date_default_timezone_set('Asia/Calcutta');
		 $this->load->helper(array('email'));
         $this->load->library(array('email'));
		
	}
	
 public function getverifyuser()
 {
	 $user_data=unserialize($this->session->user);
	 $id = $user_data[0]->login_id;
	 $dte = $user_data[0]->dte_id;
 
	
	$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$dte' and  b.status ='v' order by a.name asc  ";
  // echo $sql;exit;
	    $query = $this->db->query($sql);
         return $query;  

   
  }

}



?>