<?php
class Modelallletter extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}

	 public function sum ()
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
	   $sql = "SELECT SUM ( CASE WHEN a.letter_poirity::integer = 1 THEN 1 ELSE 0 END ) AS top,
            SUM ( CASE WHEN a.letter_poirity::integer = 2 THEN 1 ELSE 0 END ) AS medium,
              SUM ( CASE WHEN a.letter_poirity::integer = 3 THEN 1 ELSE 0 END ) AS low,
            SUM ( CASE WHEN a.letter_poirity::integer <= 3 THEN 1 ELSE 0 END ) AS all
             FROM dgdash.tm_letter_master a,dgdash.t_letter_circulate b where
			 a.letter_serial_no=b.letter_serial_no and b.new_dte_id='$dte' and a.status='O'   ";
	//	echo 	$sql;   exit;
	  $q=$this->db->query($sql);
	  if($q->num_rows()>0) {
	  	return $q->result();
	  	}
	  	return array();
     }
	   public function prosum ()
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
	   $sql = "select sum(top)top,sum(medium)medium,sum(low)low,sum(alll)alll from (
	         SELECT SUM ( CASE WHEN priority::integer = 1 THEN 1 ELSE 0 END ) AS top,
            SUM ( CASE WHEN priority::integer = 2 THEN 1 ELSE 0 END ) AS medium,
              SUM ( CASE WHEN priority::integer = 3 THEN 1 ELSE 0 END ) AS low,
            SUM ( CASE WHEN priority::integer <= 3 THEN 1 ELSE 0 END ) AS alll
             FROM dgdash.tm_project_master a,dgdash.t_project_dte b
			 where a.project_id::integer=b.project_id::integer and b.new_dte_id='$dte' 
             and b.delete_flag!='Y' and openstatus='O'
			 union 
			SELECT SUM ( CASE WHEN priority::integer = 1 THEN 1 ELSE 0 END ) AS top,
            SUM ( CASE WHEN priority::integer = 2 THEN 1 ELSE 0 END ) AS medium,
            SUM ( CASE WHEN priority::integer = 3 THEN 1 ELSE 0 END ) AS low,
            SUM ( CASE WHEN priority::integer <= 3 THEN 1 ELSE 0 END ) AS all
			FROM dgdash.tm_project_master a
			where  a.new_dte_id='$dte'  and openstatus='O') a ";
		//echo 	$sql;  exit; 
	  $q=$this->db->query($sql);
	  if($q->num_rows()>0) {
	  	return $q->result();
	  	}
	  	return array();
     }
	  public function projsumres ()
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
	  $sql = "SELECT SUM ( CASE WHEN priority::integer = 1 THEN 1 ELSE 0 END ) AS top,
            SUM ( CASE WHEN priority::integer = 2 THEN 1 ELSE 0 END ) AS medium,
              SUM ( CASE WHEN priority::integer = 3 THEN 1 ELSE 0 END ) AS low,
            SUM ( CASE WHEN priority::integer <= 3 THEN 1 ELSE 0 END ) AS all
             FROM dgdash.tm_project_master where openstatus='O'";
		//echo 	$sql;  exit; 
	  $q=$this->db->query($sql);
	  if($q->num_rows()>0) {
	  	return $q->result();
	  	}
	  	return array();
     }
	    public function leavsum ()
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
			$sql = "select sum(edleave1)edleave,sum(dleave1)dleave
			 from ( select 
			SUM ( CASE WHEN (desig_id in ('004','005','006','007','008','010') ) THEN 1 ELSE 0 END ) AS edleave1,
			SUM ( CASE WHEN (desig_id in('014','013')) THEN 1 ELSE 0 END ) AS dleave1 
			from tour.leave_application a,comapp.empdetail b
	        where b.login_id=a.emp_no and a.leave_app_status='A'  and b.dte_id='$dte'
	        and current_date between a.leave_from and a.leave_upto
			union all
			select 
			SUM ( CASE WHEN ((level::integer = 1)and (leave_tour::integer = 1)) THEN 1 ELSE 0 END ) AS edleave,
			SUM ( CASE WHEN ((level::integer = 2)and (leave_tour::integer = 1)) THEN 1 ELSE 0 END ) AS dleave
			 from dgdash.t_leave_tour a,comapp.comm_dte_master b  where  a.new_dte_id=b.dte_id and 
			 new_dte_id='$dte' and current_date between peroid_from and period_to)a"; 
	 //echo 	$sql; exit;  
	  $q=$this->db->query($sql);
	  if($q->num_rows()>0) {
	  	return $q->result();
	  	}
	  	return array();
     }
	  public function toursum ()
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
			$sql = "select sum(edtour1)edtour,sum(dtour1)dtour
			 from ( select 
			SUM ( CASE WHEN (desig_id in ('004','005','006','007','008','010') ) THEN 1 ELSE 0 END ) AS edtour1,
			SUM ( CASE WHEN (desig_id in('014','013')) THEN 1 ELSE 0 END ) AS dtour1 
			from tour.tour_application a,comapp.empdetail b
	        where b.login_id=a.emp_no and a.tour_app_status='A' and b.dte_id='$dte'
	        and current_date between a.tour_start_dt and a.tour_end_dt)a"; 
	//echo 	$sql; exit;  
	 $db2=$this->load->database('tour',TRUE);		
	  $q=$db2->query($sql);
	  if($q->num_rows()>0) {
	  	return $q->result();
	  	}
	  	return array();
     }
	  public function comapp ()
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
	  /*  $sql = "SELECT SUM ( CASE WHEN (b.status = 'v' or b.status = '' or b.status = 'NULL') 
	   THEN 1 ELSE 0 END ) AS register1,
	   SUM ( CASE WHEN b.status = 'v' THEN 1 ELSE 0 END ) AS verify1,
	   SUM ( CASE WHEN b.active_flag = 'y' THEN 1 ELSE 0 END ) AS active1,
	   SUM ( CASE WHEN b.status = 'r' THEN 1 ELSE 0 END ) AS reject1 
	   FROM comapp.comm_app_login a,comapp.comm_app_login_master  b 
	   where a.login_id=b.ipasid and  a.dte_id='$dte'  "; */
	 $sql = "   select sum(register) AS register1,sum(verify) AS verify1,sum(active) AS active1,sum(reject ) AS reject1 from (
SELECT SUM ( CASE WHEN (b.status = 'v' or b.status = '' or b.status = 'NULL') THEN 1 ELSE 0 END ) AS register,
 SUM ( CASE WHEN b.status = 'v' THEN 1 ELSE 0 END ) AS verify, 
 SUM ( CASE WHEN b.active_flag = 'y' THEN 1 ELSE 0 END ) AS active, 
 SUM ( CASE WHEN b.status = 'r' THEN 1 ELSE 0 END ) AS reject 
 FROM comapp.comm_app_login a,comapp.comm_app_login_master b where a.login_id=b.ipasid and a.dte_id='$dte'
union
SELECT SUM ( CASE WHEN (b.status = 'v' or b.status = '' or b.status = 'NULL') THEN 1 ELSE 0 END ) AS register,
 SUM ( CASE WHEN b.status = 'v' THEN 1 ELSE 0 END ) AS verify,
 SUM ( CASE WHEN b.active_flag = 'y' THEN 1 ELSE 0 END ) AS active, 
 SUM ( CASE WHEN b.status = 'r' THEN 1 ELSE 0 END ) AS reject FROM comapp.comm_app_profile_nonrdso
a,comapp.comm_app_login_master b where a.aadhar_no=b.aadhar_no and a.nodal_dte='$dte') a ";
           		
	//	echo 	$sql;   exit;
	  $q=$this->db->query($sql);
	  if($q->num_rows()>0) {
	  	return $q->result();
	  	}
	  	return array();
     }
}
?>