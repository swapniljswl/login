<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profilemodel extends CI_Model
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
		 function getDirectorateList() //called from ProfileRole.php, FamilyRole.php, ProfileVerification.php,FamilyVerification.php, ReportFamilyVerification.php, ReportProfileVerification.php
        {
              
		$query = $this->db->query('select * from comapp.comm_dte_master order by dte_desc asc');
		return $query->result_array();
		}


public function get_emp_list($dir_id) //called from ProfileRole.php and FamilyRole.php
 {
		 
	if ($dir_id == '1000')
	{
	$sql="select a.login_id,a.name,d.desig_desc,c.dte_desc,a.dte_id,coalesce(b.role,'0') user_type from 
	comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and b.emp_status='w' and b.status='v' and b.active_flag='y' order by a.name asc";
	 }
	 else
	{
	$sql="select a.login_id,a.name,d.desig_desc,c.dte_desc,a.dte_id,coalesce(b.role,'0') user_type from 
	comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$dir_id' and b.emp_status='w' and b.status='v' and b.active_flag='y'
	order by a.name asc";
	}
	//echo ($sql);exit;
	$query = $this->db->query($sql);
 	return $query->result_array(); 
 }
 public function grant_profile_role($id) //called from ProfileRole.php
 {
		$date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;
		$this->db->trans_start();
		$sql="update comapp.comm_app_login_master set role =?,modified_by = ?,modified_on=? where ipasid =  ?";
		$query=$this->db->query($sql,array(5,$empid,$date,$id));
		$this->db->trans_complete();

	  }
  public function revoke_profile_role($id)  //called from ProfileRole.php
 {
	   $date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;
		$this->db->trans_start();
		$sql="update comapp.comm_app_login_master set role =?,modified_by = ?,modified_on=? where ipasid =  ?";
		$query=$this->db->query($sql,array(7,$empid,$date,$id));
		$this->db->trans_complete();
	  }

public function grant_family_role($id)  //called from FamilyRole.php
 {
		$date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;
		$this->db->trans_start();
		$sql="update comapp.comm_app_login_master set role =?,modified_by = ?,modified_on=? where ipasid =  ?";
		$query=$this->db->query($sql,array(6,$empid,$date,$id));
		$this->db->trans_complete();

	  }
  public function revoke_family_role($id)  //called from FamilyRole.php
 {
	   $date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;
		$this->db->trans_start();
		$sql="update comapp.comm_app_login_master set role =?,modified_by = ?,modified_on=? where ipasid =  ?";
		$query=$this->db->query($sql,array(7,$empid,$date,$id));
		$this->db->trans_complete();
	  }


 public function get_profile_verification_list($dir_id)  //called from ProfileVerification.php
 {
		 
	if ($dir_id == '1000')
	{
	$sql="select a.login_id,a.name,d.desig_desc,c.dte_desc from 
	comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where (a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and b.emp_status='w' and b.status='v') and (a.profile_verify_status is NULL or a.profile_verify_status='N' or a.profile_verify_status='') and (a.cur_basic is NOT NULL or a.cur_basic !=0 ) order by a.name asc";
	}
	else
	{
	$sql="select a.login_id,a.name,d.desig_desc,c.dte_desc from 
	comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$dir_id' and b.emp_status='w' and b.status='v' and (a.profile_verify_status is NULL or a.profile_verify_status='N' or a.profile_verify_status='')  and (a.cur_basic is NOT NULL or a.cur_basic !=0 ) order by a.name asc";
	}
	$query = $this->db->query($sql);
 	return $query->result_array(); 
 }  


// public function get_default_family_verification_list()  //called from FamilyVerification.php
//  {
		 
	
// 	$sql="select distinct b.ipas as login_id,a.name,a.desig_desc,a.dte_desc from comapp.empdetail a inner join comapp.comm_emp_family b on a.login_id=b.ipas
// 	where (a.family_verify_status is NULL or a.family_verify_status='N' or a.family_verify_status='') order by a.name";
// 	$query = $this->db->query($sql);
//  	return $query->result_array(); 
//  }  

public function get_family_verification_list($dir_id)  //called from FamilyVerification.php
 {
		 
	if ($dir_id == '1000')
	{
	$sql="select distinct b.ipas as login_id,a.name,a.desig_desc,a.dte_desc,a.pass_acct_no from comapp.empdetail a inner join comapp.comm_emp_family b on a.login_id=b.ipas
	where (a.family_verify_status is NULL or a.family_verify_status='N' or a.family_verify_status='') order by a.pass_acct_no";
	}
	else
	{
	$sql="select distinct b.ipas as login_id,a.name,a.desig_desc,a.dte_desc,a.pass_acct_no from comapp.empdetail a inner join comapp.comm_emp_family b on a.login_id=b.ipas
		where ( (a.family_verify_status is NULL or a.family_verify_status='N' or a.family_verify_status='') and (a.dte_id='$dir_id')) order by a.pass_acct_no";
	}

	$query = $this->db->query($sql);
 	return $query->result_array(); 
 }  

public function get_emp_details($id) //called from ProfileVerification.php
	{
		$query = $this->db->query("select a.login_id,a.name,b.desig_desc,		   d.dte_desc,a.mobno,a.email,a.rly,a.group,a.fname,
		    to_char(a.emp_dob,'dd-mm-yyyy') as emp_dob,a.marital_status,a.emp_sex,a.cur_basic,a.grade_pay,to_char(a.dt_retirement,'dd-mm-yyyy') as dt_retirement,to_char(a.init_doa,'dd-mm-yyyy') as init_doa,
           a.pay_level,to_char(a.doa_rdso,'dd-mm-yyyy') as doa_rdso,a.gaz_nongz		   
		   from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
           left outer join comapp.comm_bldg_master c on a.bldg_id=c.bldg_id
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
           where a.login_id='$id'");
		return $query->row_array();
    }

public function get_emp_email($id) //called from FamilyVerification.php
	{
	$query = $this->db->query("select login_id,email,pass_acct_no,mobno,rly_ph_off from comapp.comm_app_login where login_id='$id'");
		return $query->row_array();
    }

public function get_emp_family_details($id) //called from FamilyVerification.php
	{
		$query = $this->db->query("select name,sex,relation_desc,to_char(dob,'dd-mm-yyyy') as dob	   
		   from comapp.view_family where empno='$id' and active_flag='Y' order by relation_code");
		return $query->result_array();
    }

public function reject_profile($rejection_data)  //called from ProfileVerification.php 
	{
		$this->db->trans_start();
		$sql="update comapp.comm_app_login  set profile_verify_status  = ? where login_id =  ?";
		$query=$this->db->query($sql,array('R',$rejection_data['empno']));
		
		$sql="Insert into pass.profile_verification_history(empno,status,entry_by,entry_on,rejection_remarks) values(?,?,?,?,?)";
		$query=$this->db->query($sql,array($rejection_data['empno'],'R',$rejection_data['entry_by'],$rejection_data['entry_on'],$rejection_data['rejection_remarks']));
		$this->db->trans_complete();
	}

	
public function verify_profile($verification_data)  //called from ProfileVerification.php 
	{
		$this->db->trans_start();
		$sql="update comapp.comm_app_login  set profile_verify_status  = ? where login_id =  ?";
		$query=$this->db->query($sql,array('V',$verification_data['empno']));
		
		$sql="Insert into pass.profile_verification_history(empno,status,entry_by,entry_on) values(?,?,?,?)";
		$query=$this->db->query($sql,array($verification_data['empno'],'V',$verification_data['entry_by'],$verification_data['entry_on']));
		$this->db->trans_complete();
	}

public function reject_family($rejection_data)  //called from FamilyVerification.php 
	{
		$this->db->trans_start();
		$sql="update comapp.comm_app_login  set family_verify_status  = ? where login_id =  ?";
		$query=$this->db->query($sql,array('R',$rejection_data['empno']));
		
		$sql="Insert into pass.family_verification_history(empno,status,entry_by,entry_on,rejection_remarks) values(?,?,?,?,?)";
		$query=$this->db->query($sql,array($rejection_data['empno'],'R',$rejection_data['entry_by'],$rejection_data['entry_on'],$rejection_data['rejection_remarks']));
		$this->db->trans_complete();
	}

	
public function verify_family($verification_data)  //called from FamilyVerification.php 
	{
		$this->db->trans_start();
		$sql="update comapp.comm_app_login  set family_verify_status  = ? where login_id =  ?";
		$query=$this->db->query($sql,array('V',$verification_data['empno']));
		
		$sql="Insert into pass.family_verification_history(empno,status,entry_by,entry_on) values(?,?,?,?)";
		$query=$this->db->query($sql,array($verification_data['empno'],'V',$verification_data['entry_by'],$verification_data['entry_on']));
		$this->db->trans_complete();
	}

public function get_family_verification_report($dir_id,$dt1,$dt2) //called from ReportFamilyVerification.php 
	{
		$date1 = DateTime::createFromFormat('d-m-Y', $dt1)->format('Y-m-d');
		$date2 = DateTime::createFromFormat('d-m-Y', $dt2)->format('Y-m-d');
		if ($dir_id == '1000')
		{
	 	$query = $this->db->query("select a.login_id,a.name,a.desig_desc,a.dte_desc,b.status,to_char(b.entry_on, 'DD-MM-YYYY') as verified_on,b.entry_by as verified_by,b.rejection_remarks as remarks from comapp.empdetail a inner join pass.family_verification_history b on a.login_id=b.empno where (b.entry_on::date between '$date1' and '$date2') order by b.entry_on");
		}
		else
		{
			$query = $this->db->query("select a.login_id,a.name,a.desig_desc,a.dte_desc,b.status,to_char(b.entry_on, 'DD-MM-YYYY') as verified_on,b.entry_by as verified_by,b.rejection_remarks as remarks from comapp.empdetail a inner join pass.family_verification_history b on a.login_id=b.empno where (a.dte_id='$dir_id') and (b.entry_on::date between to_date('$date1','yyyy-mm-dd') and to_date('$date2','yyyy-mm-dd')) order by b.entry_on");
		}
		
		return $query->result_array();
		//echo $query->result_array();
	}

	public function get_family_verification_count($dir_id,$status_code) //called from CountFamilyVerification.php 
	{
		if ($dir_id == '1000')
		{
	 	
		$query = $this->db->query("select a.login_id,a.name,a.desig_desc,a.dte_desc from comapp.empdetail a inner join comapp.comm_app_login b on a.login_id=b.login_id where (b.family_verify_status='$status_code' ) order by a.name");
 	
		}
		else
		{
			$query = $this->db->query("select a.login_id,a.name,a.desig_desc,a.dte_desc,b.status,to_char(b.entry_on, 'DD-MM-YYYY') as verified_on,b.entry_by as verified_by,b.rejection_remarks as remarks from comapp.empdetail a inner join pass.family_verification_history b on a.login_id=b.empno where (a.dte_id='$dir_id') and (b.entry_on::date between to_date('$dt1','yyyy-mm-dd') and to_date('$dt2','yyyy-mm-dd')) order by b.entry_on");
		}
		return $query->result_array();
	}

	public function get_profile_verification_report($dir_id,$dt1,$dt2) //called from ReportProfileVerification.php 
	{
		$date1 = DateTime::createFromFormat('d-m-Y', $dt1)->format('Y-m-d');
		$date2 = DateTime::createFromFormat('d-m-Y', $dt2)->format('Y-m-d');
		if ($dir_id == '1000')
		{
	 	$query = $this->db->query("select a.login_id,a.name,a.desig_desc,a.dte_desc,b.status,to_char(b.entry_on, 'DD-MM-YYYY') as verified_on,b.entry_by as verified_by,b.rejection_remarks as remarks from comapp.empdetail a inner join pass.profile_verification_history b on a.login_id=b.empno where (b.entry_on::date between '$date1' and '$date2') order by b.entry_on");
		}
		else
		{
			$query = $this->db->query("select a.login_id,a.name,a.desig_desc,a.dte_desc,b.status,to_char(b.entry_on, 'DD-MM-YYYY') as verified_on,b.entry_by as verified_by,b.rejection_remarks as remarks from comapp.empdetail a inner join pass.profile_verification_history b on a.login_id=b.empno where (a.dte_id='$dir_id') and (b.entry_on::date between to_date('$date1','yyyy-mm-dd') and to_date('$date2','yyyy-mm-dd'))  order by b.entry_on");
		}
		return $query->result_array();
	}
public function closeConn()
	{
		$this->db->close();
	}	  
	   
  }
 


?>