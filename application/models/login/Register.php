<?php
class Register extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}
	 function getdesgRecords()
        {
     
            //  $q = $this->db->get("comapp.comm_desig_master");
			 $sql1= " select * from comapp.comm_desig_master order by desig_desc asc ";
	  //   echo $sql;exit;
	      $q= $this->db->query($sql1);
                            
            if($q->num_rows() > 0)
            {
                return $q->result_array();
            }
            return array();
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
public function check_user ($empno,$aadhar)
	{
	
	//$sql= " select * from comapp.comm_app_login where login_id='$loginid' ";
	$sql= "select ipasid from comapp.comm_app_login a , comapp.comm_app_login_master b 
	where b.ipasid='$empno' and a.login_id='$empno' and a.login_id=b.ipasid 
	union
     select a.aadhar_no from comapp.comm_app_profile_nonrdso a , comapp.comm_app_login_master b where 
     b.aadhar_no='$aadhar' and a.aadhar_no='$aadhar' and a.aadhar_no=b.aadhar_no";
	//echo $sql;
	$user= $this->db->query($sql);	 
	if(($user->num_rows()) >= 1)
{
    return TRUE; 
	 // Has keys 'code' and 'message'
}	    
  }
		
	
    public function valid_register ($data)
	{
		   $user = $this->input->post('typeuser');		  
		  $empno = $this->input->post('empno');
		  $aadharno = $this->input->post('aadharno');
		 // echo  $user;echo  $empno;echo  $aadharno;exit;
		 $date = date('m/d/Y h:i:s a', time());
		// echo $date;exit;
		if ($user=='1')
		{	
	   $sql = "INSERT INTO comapp.comm_app_login_master (ipasid,rdso_nonrdso,validupto_nonrdso) VALUES(".$this->db->escape($empno).",$user,'2050-12-31')";	
	   if($this->db->query($sql))
	   {
	    	$da = array(
		'login_id' => $data['empno'],
		 'name' => $data['username'],
	     'email' => $data['email'],
	     'mobno' => $data['mobile'],
         'desig_id' => $data['desg'],
		 'dte_id' => $data['direc'],
		 'registered_on' => $date,
         'registered_by' => $data['empno'],
		) ;
	    return $this->db->insert('comapp.comm_app_login',$da); 
  	    return TRUE;
	   }
	   else 
		{return false;}
    	}
       if ($user=='2')
		{	
	   $sql = "INSERT INTO comapp.comm_app_login_master (aadhar_no,rdso_nonrdso) VALUES(".$this->db->escape($aadharno).",$user)";	
	   if($this->db->query($sql))
	   {
	    	$da = array(
		 'aadhar_no' => $data['aadharno'],
		 'name' => $data['username'],
	     'email' => $data['email'],
	     'mobno' => $data['mobile'],
         'nodal_dte' => $data['direc'],
		 'registered_on' => $date,
        'registered_by' => $data['aadharno']) ;
	    return $this->db->insert('comapp.comm_app_profile_nonrdso',$da); 
  	    return TRUE;
	   }
	   else 
	   {return false;} 
	  }  
	}
}
?>