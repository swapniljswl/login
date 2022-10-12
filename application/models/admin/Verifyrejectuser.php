<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Verifyrejectuser extends CI_Model
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
	 function getepstatus()
        {
     
            //  $q = $this->db->get("comapp.comm_desig_master");
			 $sql1= " select * from comapp.comm_emp_status  ";
	  //   echo $sql;exit;
	      $q= $this->db->query($sql1);
                            
            if($q->num_rows() > 0)
            {
                return $q->result();
            }
            return array();
        }
	
 public function getverifyuser($rdso,$user)
 {
	 
		   $type	=$this->session->userdata('login');
	      if ($type=='sso') {
	      $user_data=unserialize($this->session->user);	 
	      $dte = $user_data[0]->dte_id; 
	      }  elseif ($type=='dgdash') {
	      $user_data=unserialize($this->session->dguser);
          $dte = $user_data[0]->new_dte_id;			
		  }	  
		if ($user=='R') {
	 	if ($rdso=='1')
		{		
	
	$sql="select a.login_id,a.name,b.desig_desc,d.dte_desc,a.mobno,a.email,e.rdso_nonrdso,e.rejection_reason,e.verified_on
		    from comapp.comm_app_login a 
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
		   left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
		   left outer join comapp.comm_app_login_master e on a.login_id=e.ipasid 
           where a.dte_id='$dte' and e.rdso_nonrdso='1' and e.status ='r' order by a.name asc   "; 	
		} elseif ($rdso=='2')
		{
		$sql="select a.aadhar_no,a.name,null nonrdso,d.dte_desc,a.mobno,a.email,e.rdso_nonrdso,e.rejection_reason,e.verified_on
		    from comapp.comm_app_profile_nonrdso a 
           left outer join comapp.comm_dte_master d on a.nodal_dte=d.dte_id
		   left outer join comapp.comm_app_login_master e on a.aadhar_no=e.aadhar_no
           where a.nodal_dte='$dte' and e.rdso_nonrdso='$rdso' and e.status ='r' order by a.name asc   "; 	
		}
		}
		elseif ($user=='V') {
		if ($rdso=='1')
	{
	$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$dte' and  b.status ='v' order by a.name asc";
 } elseif ($rdso=='2') {
	$sql="select * from comapp.comm_app_profile_nonrdso a,comapp.comm_app_login_master b,comapp.comm_dte_master c
	where a.aadhar_no=b.aadhar_no and a.nodal_dte=c.dte_id and 
	 a.nodal_dte='$dte' and  b.status ='v' order by a.name asc"; 
 }		
			
		}
		
//	echo $sql; exit;   
	    $query = $this->db->query($sql);
         return $query;  

   
  }

}


?>