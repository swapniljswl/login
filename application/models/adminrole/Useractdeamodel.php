<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Useractdeamodel extends CI_Model
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
		 function getdirctRecords()
        {
              
          //    $q1 = $this->db->get("comapp.comm_dte_master");
          $sql= " select * from comapp.comm_dte_master order by dte_desc asc ";
	  //   echo $sql;exit;
	      $q1= $this->db->query($sql);    
                    
            if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                 
            }
            return array();
        }
	
 public function getuser($typeuser)
 {
		 $direc=$this->input->post('direc');
         $user=$this->input->post('user'); 		 
		
	if ($user=='V') {	
	if ($typeuser=='1')
	{
	/* $sql="select a.login_id,a.name,d.desig_desc,c.dte_desc,a.dte_id,b.role,b.active_flag from 
	comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$direc' and b.emp_status='w' and b.status='v'  order by a.name asc  "; */
		$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$direc' and b.emp_status='w' and  b.status ='v' and b.rdso_nonrdso='$typeuser' order by a.name asc";
	} elseif ($typeuser=='2')
	{
	$sql="select * from comapp.comm_app_profile_nonrdso a,comapp.comm_app_login_master b,comapp.comm_dte_master c
	where a.aadhar_no=b.aadhar_no and a.nodal_dte=c.dte_id and 
	 a.nodal_dte='$direc' and  b.status ='v' and b.rdso_nonrdso='$typeuser' order by a.name asc"; 	
		
	}
	}
   elseif ($user=='R') 
   {
	if ($typeuser=='1')
	{
	/* $sql="select a.login_id,a.name,d.desig_desc,c.dte_desc,a.dte_id,b.role,b.active_flag from 
	comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$direc' and b.emp_status='w' and b.status='v'  order by a.name asc  "; */
		$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$direc' and b.status ='r' and b.rdso_nonrdso='$typeuser' order by a.name asc";
	} elseif ($typeuser=='2')
	{
	$sql="select * from comapp.comm_app_profile_nonrdso a,comapp.comm_app_login_master b,comapp.comm_dte_master c
	where a.aadhar_no=b.aadhar_no and a.nodal_dte=c.dte_id and 
	 a.nodal_dte='$direc' and   b.status ='r' and b.rdso_nonrdso='$typeuser' order by a.name asc"; 	
		
	}   
   }
	$query = $this->db->query($sql);
 if ($query->num_rows() > 0) {
	       
         return $query->result_array(); 
			    
	  } else  {
	      
         return 0;
	  }
	//  return $query->result();
	  
  }
 public function deactive($login_id)
 {
	 
		 $date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;
	    $dteid=$this->session->userdata('dteid');
		  $this->db->where('ipasid', $login_id);
          $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'','modified_by'=>$empid,'modified_on'=>$date));
          $this->session->unset_userdata('dteid');
	        return TRUE;
	  }
	 public function active($login_id)
 {
	 
		$date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;
	    $dteid=$this->session->userdata('dteid');
		  $this->db->where('ipasid', $login_id);
          $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'y','modified_by'=>$empid,'modified_on'=>$date));
          $this->session->unset_userdata('dteid');
	        return TRUE;
	  }	 
	 public function nonrdsodeactive($aadhar_no)
 {
	 
		$date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;
	    $dteid=$this->session->userdata('dteid');
		  $this->db->where('aadhar_no', $aadhar_no);
          $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'','modified_by'=>$empid,'modified_on'=>$date));
          $this->session->unset_userdata('dteid');
	        return TRUE;
	  }
	 	 public function nonrdsoactive($aadhar_no)
 {
	 
		$date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;
	    $dteid=$this->session->userdata('dteid');
		  $this->db->where('aadhar_no', $aadhar_no);
          $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'y','modified_by'=>$empid,'modified_on'=>$date));
          $this->session->unset_userdata('dteid');
	        return TRUE;
	  } 
	  }	
	   
  
 


?>