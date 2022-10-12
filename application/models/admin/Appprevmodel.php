<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Appprevmodel extends CI_Model
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
	public function checkverifyuser ($aadhar_no)
	{
		  
	       $type	=$this->session->userdata('login');
	   if ($type=='sso') {
	 $user_data=unserialize($this->session->user);
	  $empid = $user_data[0]->login_id;
	   $dte = $user_data[0]->dte_id; 
	    }  elseif ($type=='dgdash') {
		 $user_data=unserialize($this->session->dguser);
            $empid = $user_data[0]->email;
	        $dte = $user_data[0]->new_dte_id;		  
			
		}
	  
	 	$sql="select * from comapp.comm_app_profile_nonrdso a 
		   left outer join comapp.comm_dte_master b on a.nodal_dte=b.dte_id  
		   left outer join comapp.comm_app_login_master c on a.aadhar_no=c.aadhar_no 
           where a.aadhar_no='$aadhar_no' and a.nodal_dte='$dte' and c.status='v' and c.rdso_nonrdso='2' ";     
  // echo $sql;exit;	
	   $q= $this->db->query($sql);
                            
            if($q->num_rows() > 0)
            {
                return $q->result();
            }
            return array();	
	}	
 public function getappdetail($aadhar_no)
 {
	   

	$sql="select a.appid,a.app_name,b.id,b.aadhar_no,b.flag
		   from comapp.comm_application_master a 
		   left outer join comapp.comm_nonrdso_app_priv b 
		   on a.appid::integer=b.appid::integer and b.aadhar_no='$aadhar_no'
		    where a.appid in ('2','6') "; 
 //ECHO  $sql;EXIT;	
	
	      $q= $this->db->query($sql);
                            
            if($q->num_rows() > 0)
            {
                return $q->result_array();
            }
            return array();
   
  }
  public function addapp($data)
 {   
	    $date = date('Y-m-d h:i:s a', time());	  
	     $type	=$this->session->userdata('login');
	   if ($type=='sso') {
	 $user_data=unserialize($this->session->user);
	  $empid = $user_data[0]->login_id;
	   $dte = $user_data[0]->dte_id; 
	    }  elseif ($type=='dgdash') {
		 $user_data=unserialize($this->session->dguser);
            $empid = $user_data[0]->email;
	        $dte = $user_data[0]->new_dte_id;		  
			
		}			
		

$da=	array(
'aadhar_no'=>$data['aadharno'],
'appid'=>$data['appid'],
'flag'=>'Y',
'entry_by'=>$empid,
'entry_on'=>$date
);
$this->db->insert('comapp.comm_nonrdso_app_priv', $da);
	
	      if($this->db->affected_rows() > 0)
            {
                return true;
            } else {  return false; }
           
   
  }
 public function deleteapp($appid)
 {
	 
		$date = date('Y-m-d h:i:s a', time());
        
	     $type	=$this->session->userdata('login');
	   if ($type=='sso') {
	 $user_data=unserialize($this->session->user);
	  $empid = $user_data[0]->login_id;
	   $dte = $user_data[0]->dte_id; 
	    }  elseif ($type=='dgdash') {
		 $user_data=unserialize($this->session->dguser);
            $empid = $user_data[0]->email;
	        $dte = $user_data[0]->new_dte_id;		  
			
		}				
	
		  $this->db->where('id', $appid);
          $this->db->update('comapp.comm_nonrdso_app_priv',array('flag' =>'D','modified_by'=>$empid,'modified_on'=>$date));
          $this->session->unset_userdata('dteid');
	        return TRUE;
	  }
	 public function Activeapp($appid)
 {
	 
		$date = date('Y-m-d h:i:s a', time());
       
	     $type	=$this->session->userdata('login');
	   if ($type=='sso') {
	 $user_data=unserialize($this->session->user);
	  $empid = $user_data[0]->login_id;
	   $dte = $user_data[0]->dte_id; 
	    }  elseif ($type=='dgdash') {
		 $user_data=unserialize($this->session->dguser);
            $empid = $user_data[0]->email;
	        $dte = $user_data[0]->new_dte_id;		  
			
		}				
		
		  $this->db->where('id', $appid);
          $this->db->update('comapp.comm_nonrdso_app_priv',array('flag' =>'Y','modified_by'=>$empid,'modified_on'=>$date));
          $this->session->unset_userdata('dteid');
	        return TRUE;
	  }  
	  
	 public function active($login_id)
 {
	 
		$date = date('Y-m-d h:i:s a', time());
      
	     $type	=$this->session->userdata('login');
	   if ($type=='sso') {
	 $user_data=unserialize($this->session->user);
	  $empid = $user_data[0]->login_id;
	   $dte = $user_data[0]->dte_id; 
	    }  elseif ($type=='dgdash') {
		 $user_data=unserialize($this->session->dguser);
            $empid = $user_data[0]->email;
	        $dte = $user_data[0]->new_dte_id;		  
			
		}				
		
		  $this->db->where('ipasid', $login_id);
          $this->db->update('comapp.comm_app_login_master',array('active_flag' =>'y','modified_by'=>$empid,'modified_on'=>$date));
          $this->session->unset_userdata('dteid');
	        return TRUE;
	  }	 
}



?>