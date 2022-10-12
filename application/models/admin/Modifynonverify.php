<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Modifynonverify extends CI_Model
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
         
          $sql= " select * from comapp.comm_dte_master order by dte_desc asc ";
	  //   echo $sql;exit;
	      $q1= $this->db->query($sql);    
                    
            if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                 
            }
            return array();
        }
	function getdesgRecords()
        {
         
          $sql= " select * from comapp.	comm_desig_master order by desig_desc asc ";
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
		
	      $user_data=unserialize($this->session->dguser);
          $dte = $user_data[0]->new_dte_id;			
		
		
	if ($typeuser=='1')
	{

		$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$dte' and (b.status ='' or b.status is NULL or b.status='r') order by a.name asc";
	} elseif ($typeuser=='2')
	{
	$sql="select * from comapp.comm_app_profile_nonrdso a,comapp.comm_app_login_master b,comapp.comm_dte_master c
	where a.aadhar_no=b.aadhar_no and a.nodal_dte=c.dte_id and 
	 a.nodal_dte='$dte' and (b.status ='' or b.status is NULL or b.status='r') order by a.name asc"; 	
		
	}
    // echo $sql;exit;
	$query = $this->db->query($sql);
 if ($query->num_rows() > 0) {
	       
         return $query->result_array(); 
			    
	  } else  {
	      
         return 0;
	  }
	//  return $query->result();
	  
  }
 public function getuserdetail($ipasid)
 {
	  $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$ipasid' or aadhar_no='$ipasid')";
	  $query = $this->db->query($sql1); 
	  if ($query->num_rows()) {		  
      $row = $query->row();
      $typeuser = $row->rdso_nonrdso;
	 
	if ($typeuser=='1')
	{
	$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.login_id='$ipasid' and (b.status ='' or b.status is NULL or b.status='r') and  b.rdso_nonrdso='1' ";
	}
	elseif ($typeuser=='2') 
	{
	$sql="select * from comapp.comm_app_profile_nonrdso a 
		   left outer join comapp.comm_dte_master b on a.nodal_dte=b.dte_id  
		   left outer join comapp.comm_app_login_master c on a.aadhar_no=c.aadhar_no 
           where a.aadhar_no='$ipasid' and (c.status ='' or c.status is NULL or c.status='r') and  c.rdso_nonrdso='2' "; 
	}	 
 //ECHO  $sql;EXIT;	
	
	      $q= $this->db->query($sql);
                            
            if($q->num_rows() > 0)
            { $this->session->set_userdata('nonverify',serialize($q->result()));
                return $q->result_array();
				
            }
            return array();
   
 } }
  public function modifydata($empno,$typeuser,$desg,$name,$dte,$email,$mobno)
 {
$date = date('Y-m-d h:i:s a', time());
   
	   $user_data=unserialize($this->session->dguser);
       $empid = $user_data[0]->email;
	 //  $dte = $user_data[0]->new_dte_id;				
		
if ($typeuser=='1') {	
$da=
array('name' =>$name,'desig_id' =>$desg,'dte_id' =>$dte,'mobno' =>$mobno,'email'=>$email,'modified_by'=>$empid,'modified_on'=>$date);
//print_r($da);exit;
 $this->db->where('login_id', $empno);
  if($this->db->update('comapp.comm_app_login',$da ))
  {
  $this->db->where('ipasid', $empno);
  $this->db->update('comapp.comm_app_login_master',array('status' =>'','modified_by'=>$empid,'modified_on'=>$date) );

  }
}
 if ($typeuser=='2') {	
$da=
array('name' =>$name,'nodal_dte' =>$dte,'mobno' =>$mobno,'email'=>$email,'modified_by'=>$empid,'modified_on'=>$date);
 // print_r($da);exit;
  $this->db->where('aadhar_no', $empno); 
 if( $this->db->update('comapp.comm_app_profile_nonrdso',$da ))
 {
  $this->db->where('aadhar_no', $empno);
  $this->db->update('comapp.comm_app_login_master',array('status' =>'','modified_by'=>$empid,'modified_on'=>$date) );
 }
} 
      return TRUE; 
	 
	 
	 
 }
	 
	  }	
	   
  
 


?>