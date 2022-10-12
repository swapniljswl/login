<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listactdeacdirmod extends CI_Model
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
	
 public function getverifyuser($typeuser)
 {
	  
	 $user_data=unserialize($this->session->dguser);
   	 $dte = $user_data[0]->new_dte_id;		  
	
  // echo $typeuser;exit;
	if ($typeuser=='1')
	{
	$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$dte' and  b.status ='v' and  b.emp_status ='w' order by a.name asc";
  // echo $sql;exit;
	} elseif ($typeuser=='2')
	{
		$sql="select * from comapp.comm_app_profile_nonrdso a,comapp.comm_app_login_master b,
		comapp.comm_dte_master c where a.aadhar_no=b.aadhar_no and a.nodal_dte=c.dte_id and 
	    a.nodal_dte='$dte' and  b.status ='v' order by a.name asc"; 	
		
	}
	//echo $sql;exit;
	    $query = $this->db->query($sql);
         return $query;  

   
  }
 public function deactive($login_id)
 {
	  
	   $user_data=unserialize($this->session->dguser);
       $empid = $user_data[0]->email;
	   $dte = $user_data[0]->new_dte_id;				
			 
		$date = date('Y-m-d h:i:s a', time());      
		$this->db->where('ipasid', $login_id);
        $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'','modified_by'=>$empid,'modified_on'=>$date));
        $this->session->unset_userdata('dteid');
	        return TRUE;
	  }
	 public function active($login_id)
 {
	 	 
		 $user_data=unserialize($this->session->dguser);
         $empid = $user_data[0]->email;
	     $dte = $user_data[0]->new_dte_id;				
		$date = date('Y-m-d h:i:s a', time());
        $this->db->where('ipasid', $login_id);
        $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'y','modified_by'=>$empid,'modified_on'=>$date));
        $this->session->unset_userdata('dteid');
	        return TRUE;
	  }
     public function nonrdsodeactive($aadhar_no)
 {
	   
		 $user_data=unserialize($this->session->dguser);
         $empid = $user_data[0]->email;
	     $dte = $user_data[0]->new_dte_id;				
			 
		$date = date('Y-m-d h:i:s a', time());
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'','modified_by'=>$empid,'modified_on'=>$date));
        $this->session->unset_userdata('dteid');
	        return TRUE;
	  }
	 	 public function nonrdsoactive($aadhar_no)
 {
	    
		 $user_data=unserialize($this->session->dguser);
         $empid = $user_data[0]->email;
	     $dte = $user_data[0]->new_dte_id;				
		  
		$date = date('Y-m-d h:i:s a', time());
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'y','modified_by'=>$empid,'modified_on'=>$date));
        $this->session->unset_userdata('dteid');
	    return TRUE;
	  }	  
}



?>