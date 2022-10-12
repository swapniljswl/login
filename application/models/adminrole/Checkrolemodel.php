<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkrolemodel extends CI_Model
{
		public function __construct()
	{
		$this->load->helper('string');
		parent::__construct();
		$this->load->database();
        date_default_timezone_set('Asia/Calcutta');
		
	}
	function getroleRecord()
        {
          $user_data=unserialize($this->session->secret);
		  $role = $user_data[0]->role;
		  if ($role=='3'){
          $sql= "select * from comapp.comm_role_master where role_id not in (1,7,8) order by role_id asc";
		  } elseif ($role=='2') {
		  $sql= "select * from comapp.comm_role_master where role_id not in (1,7,8,2,3) order by role_id asc";
		  }
	  //   echo $sql;exit;
	      $q1= $this->db->query($sql);    
                    
            if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                 
            }
            return array();
        }
 public function getroleuser()
 {    $role=$this->input->post('role');
	 	
	/*$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and b.user_type='1' order by a.name asc ";
       //echo $sql;exit; */
	   	$sql="select a.login_id,a.name,b.desig_desc,c.dte_desc,c.dte_id,e.role from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
           left outer join comapp.comm_dte_master c on a.dte_id=c.dte_id
           left outer join comapp.comm_app_login_master e on a.login_id=e.ipasid
		   left outer join comapp.comm_verify_role f on a.login_id=f.ipasid
           where   e.role ='$role' and e.rdso_nonrdso='1' and e.emp_status='w' and e.status='v' and e.active_flag='y'
		   order by a.name asc "; 
		 //echo $sql;exit;
	  	$query = $this->db->query($sql);
 if ($query->num_rows() > 0) {
	       
         return $query->result_array(); 
			    
	  } else  {
	      
         return 0;
	  } 

   
  }
 	
	   
  }





?>