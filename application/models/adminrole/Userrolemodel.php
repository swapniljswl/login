<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Userrolemodel extends CI_Model
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
	 function getroleRecords()
        {
          $user_data=unserialize($this->session->secret);
		  $role = $user_data[0]->role;
		  if ($role=='3'){
          $sql= " select * from comapp.comm_role_master where role_id  in ('3','2','4','5','6') order by role_id asc ";
		  }
		   elseif ($role=='2'){
          $sql= " select * from comapp.comm_role_master where role_id  in ('4','5','6') order by role_id asc ";
		  }
	      $q1= $this->db->query($sql);    
                    
            if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                 
            }
            return array();
        }
 public function getuser()
 {
		 $direc=$this->input->post('direc');
		
		$this->session->set_userdata('dteid', $direc);
	
	$sql="select a.login_id,a.name,d.desig_desc,c.dte_desc,a.dte_id,b.role from 
	comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$direc' and b.emp_status='w' and b.status='v' and b.rdso_nonrdso='1' order by a.name asc  ";
/*	$sql="select a.login_id,a.name,a.desig_id,b.desig_desc,a.bldg_id,c.bldg_desc,a.dte_id,
           d.dte_desc,a.address,a.mobno,a.email,a.rly_ph_off,a.rly_ph_home,a.rly,a.group,
		   a.gaz_nongz from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
           left outer join comapp.comm_bldg_master c on a.bldg_id=c.bldg_id
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
           left outer join comapp.comm_app_login_master e on a.login_id=e.ipasid
           where e.emp_status='w' and e.status='v' and a.dte_id='$direc' and e.user_type!='2' "; */
		  // echo $sql;exit;
	$query = $this->db->query($sql);
 if ($query->num_rows() > 0) {
	       
         return $query->result_array(); 
			    
	  } else  {
	      
         return 0;
	  }
	//  return $query->result();
	  
  }
 public function role($login_id)
 {      $role	=$this->session->userdata('role');
 //$this->session->unset_userdata('role');
	     $user_data=unserialize($this->session->user);
	     $empid = $user_data[0]->login_id;
	     $date = date('Y-m-d h:i:s a', time());
	 	 $dteid=$this->session->userdata('dteid');
		 if ($role=='4') {
	     $sql="select * from comapp.comm_verify_role where dte_id='$dteid'";
		  $query = $this->db->query($sql); 
	  if ($query->num_rows()) {
        			  
      $row = $query->row();
      $ipasid = $row->ipasid; 
	  $this->db->where('ipasid', $ipasid);
      $this->db->update('comapp.comm_app_login_master',array('role' =>'7','modified_by'=>$empid,'modified_on'=>$date));
      }
	   
		    $this->db->where('dte_id', $dteid);
          $this->db->update('comapp.comm_verify_role',array('ipasid' =>$login_id,'modified_by'=>$empid,'modified_on'=>$date));
          
		   $this->db->where('ipasid', $login_id);
          $this->db->update('comapp.comm_app_login_master',array('role' =>$role,'modified_by'=>$empid,'modified_on'=>$date));
            $this->session->unset_userdata('dteid');
			$this->session->unset_userdata('role');
		 return TRUE; }
		 elseif (($role=='2') or ($role=='5') or ($role=='6'))
		 {
		 $this->db->where('ipasid', $login_id);
          $this->db->update('comapp.comm_app_login_master',array('role' =>$role,'modified_by'=>$empid,'modified_on'=>$date));
          $this->session->unset_userdata('dteid');
		// $this->session->unset_userdata('role');
		 return TRUE; 
			 
		 }
		 elseif ($role=='3')
		 {
		$this->db->where('role', '3');
        if($this->db->update('comapp.comm_app_login_master',array('role' =>'7','modified_by'=>$empid,'modified_on'=>$date)))
		{		
		$this->db->where('ipasid', $login_id);
        $this->db->update('comapp.comm_app_login_master',array('role' =>'3','modified_by'=>$empid,'modified_on'=>$date));
	    $this->session->unset_userdata('dteid');
	    return TRUE;	 
		 }
	  }
 }
		 public function roledel($login_id)
 { 
          $this->db->where('ipasid', $login_id);
          $this->db->update('comapp.comm_app_login_master',array('role' =>'7','modified_by'=>$empid,'modified_on'=>$date));
         
		 return TRUE; 
 } 
	
	  }	
	   
  
 


?>