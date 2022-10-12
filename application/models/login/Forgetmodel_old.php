<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forgetmodel extends CI_Model
{
		public function __construct()
	{
		$this->load->helper('string');
		parent::__construct();
		date_default_timezone_set('Asia/Calcutta');
		$this->load->database();	
	}
	
 public function forgetpwd($loginid)
 {
	  $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$loginid' or aadhar_no='$loginid')";
	  $query = $this->db->query($sql1); 
	  if ($query->num_rows()) {		  
      $row = $query->row();
     // $ipasid = $row->ipasid; 
	  $rdsononrdso = $row->rdso_nonrdso;
	//  ECHO  $rdsononrdso;EXIT;
	  if ($rdsononrdso=='1')
	  {
  $sql="select a.email,a.mobno,a.name,e.rdso_nonrdso,e.status,a.login_id from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
           left outer join comapp.comm_bldg_master c on a.bldg_id=c.bldg_id
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
           left outer join comapp.comm_app_login_master e on a.login_id=e.ipasid
		    left outer join comapp.comm_verify_role f on a.login_id=f.ipasid 
			where login_id='$loginid' ";
	  }
	  elseif ($rdsononrdso=='2')
	  {
	$sql="select *
		   from comapp.comm_app_profile_nonrdso a 
		   left outer join comapp.comm_app_login_master b on a.aadhar_no=b.aadhar_no
		   left outer join comapp.comm_dte_master d on a.nodal_dte=d.dte_id
           where a.aadhar_no='$loginid' ";   
	  }
	  elseif ($rdsononrdso=='')
	  {		
	   return FALSE;
	  }
	//  echo $sql;exit;
	    $query = $this->db->query($sql); 

          if ($query->num_rows()) {
        	$this->session->set_userdata('forget',serialize($query->result()));
			  		
		   return TRUE;
	  } else  {
		    return FALSE;  
	  }
	  } 
     }
 public function forgetotp($loginid,$otp)
 {
	  $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$loginid' or aadhar_no='$loginid')  ";	
	  $query = $this->db->query("$sql1");
      $row = $query->row();
      $ipasid = $row->ipasid; 
	  $rdsononrdso = $row->rdso_nonrdso;
	  if ($rdsononrdso=='1')
	  {
   /*  $sql="select * from comapp.comm_app_login a , comapp.comm_app_login_master b 
	where (b.ipasid='$loginid' or b.aadhar_no='$loginid') and b.otp='$otp'  and a.login_id=b.ipasid ";  */
	$sql="select * from comapp.comm_app_login_master where (ipasid='$loginid' or aadhar_no='$loginid')
				and otp='$otp'";  
	  }
	  elseif ($rdsononrdso=='2')
	  {
	$sql="select * from comapp.comm_app_profile_nonrdso a , comapp.comm_app_login_master b 
	where  b.aadhar_no='$loginid' and a.aadhar_no='$loginid' and b.otp='$otp' and a.aadhar_no=b.aadhar_no ";	  
	  }
   //  echo $sql;exit;	
	    $query = $this->db->query($sql); 

          if ($query->num_rows()) {
        	//$this->session->set_userdata('forget',serialize($query->result()));
			  		
		   return TRUE;
	  } else  {
		    return FALSE;  
	  }
     }

 public function sendotp($loginid)
{
	        $user_data=unserialize($this->session->forget);
			//print_r($user_data);exit;
			$usertype = $user_data[0]->rdso_nonrdso;
			if ($usertype=='1') {$user_id = $user_data[0]->login_id;
			$encid=base64_encode($user_id); }
			elseif ($usertype=='2') { $user_id = $user_data[0]->aadhar_no;
			$encid=base64_encode($user_id); }
			$email = $user_data[0]->email;
		//	echo $email;exit;
			$mobile = $user_data[0]->mobno;
			$name = $user_data[0]->name;			
		 $date = date('m/d/Y h:i:s a', time());        
        $passwordplain = 0;
        $passwordplain  = rand(999999999,9999999999);
		$newpass['password'] =md5($passwordplain);
		if ($usertype=='1')
		{ $this->db->where('ipasid', $loginid);
          $this->db->or_where('aadhar_no', $loginid);	}
	    elseif ($usertype=='2')
		{ $this->db->where('aadhar_no', $loginid);	}
        $this->db->update('comapp.comm_app_login_master', array('otp' => $newpass['password'],'modified_by'=>$user_id,'modified_on'=>$date));
		
			$from_email = "pass@rdso.railnet.gov.in"; 
            $to_email = $email; 
			//echo $to_email;exit;
	 $config = array(
                   'protocol'  => 'smtp',
	               'smtp_host' => 'ssl://mail.gov.in',
	               'smtp_port' => '465',
	               'smtp_user' => 'pass.rdsor@nic.in',//'jeit1.rdsor@nic.in',//
	               'smtp_pass' => 'A@aBC%13',//'123aA_456',//
	               'smtp_crypto' => 'security',
	               'mailtype'  => 'html', 
	               'charset'   => 'utf-8',
	               'newline'   => "\r\n",
	               'crlf' => "\r\n",
	               'wordwrap' => TRUE
);
         $this->load->library('email', $config);
         $this->email->initialize($config);
         $this->email->set_newline("\r\n"); 
         $this->email->set_mailtype("html");
         $this->email->from($from_email, 'RDSO'); 
		 $this->email->cc($from_email, "Your password in 'IT Apps' has been changed");
         $this->email->to($to_email);
         $this->email->subject('Reset Password');
         $this->email->message(" ".$passwordplain." is the OTP for reset password for IT Application. Please enter Emp No/Unique Id and OTP for reset your password.");
		 $user_data=unserialize($this->session->forget); 
        $mobile = $user_data[0]->mobno;	
        $msg = " ".$passwordplain." is the OTP for reset password for IT Application. Please enter Emp No/Aadhar and OTP for reset your password.";	  
      /*   $username = 'RDSO';
        $password = 'rdso@123';	   
	  $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$username."&passwd=".$password."&text=".urlencode($msg)."&msisdn=".$mobile."&mode=Txt";
	  */
	     $username='20091034';
	   $password='rgp46d';	  	
	 $url="http://bulksmsindia.mobi/sendurlcomma.aspx?user=".$username."&pwd=".$password."&senderid=RDSOTX&mobileno=".$mobile."&msgtext=".urlencode($msg)."&smstype=0/4/3 ";
	 $ch  = curl_init();
	 curl_setopt ($ch,CURLOPT_URL, $url) ;
	 curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	 $response = curl_exec($ch) ;
	 curl_close($ch) ;
    // echo $url; exit;
	    return TRUE;
	
}

public function resetpassword($loginid)
{
	        $user_data=unserialize($this->session->forget);
			//print_r($user_data);exit;
			$usertype = $user_data[0]->rdso_nonrdso;
			if ($usertype=='1') {
			$user_id = $user_data[0]->login_id;
			//$user_id = $user_data[0]->aadhar_no;
			//echo $user_id;exit;
			$encid=base64_encode($user_id); }
			elseif ($usertype=='2') { $user_id = $user_data[0]->aadhar_no;
			$encid=base64_encode($user_id); }
			$email = $user_data[0]->email;
			$mobile = $user_data[0]->mobno;
			$name = $user_data[0]->name;			
		 $date = date('m/d/Y h:i:s a', time());        
        $passwordplain = 0;
        $passwordplain  = rand(999999999,9999999999);
		$newpass['password'] =md5($passwordplain);
		if ($usertype=='1')
		{ $this->db->where('ipasid', $loginid);
         // $this->db->or_where('aadhar_no', $loginid);	
		 }
	    elseif ($usertype=='2')
		{ $this->db->where('aadhar_no', $loginid);	}
        $this->db->update('comapp.comm_app_login_master', array('password' => $newpass['password'],'modified_by'=>$user_id,'modified_on'=>$date));
		
			$from_email = "pass@rdso.railnet.gov.in"; 
            $to_email = $email; 
	 $config = array(
                   'protocol'  => 'smtp',
	               'smtp_host' => 'ssl://mail.gov.in',
	               'smtp_port' => '465',
	               'smtp_user' => 'pass.rdsor@nic.in',//'jeit1.rdsor@nic.in',//
	               'smtp_pass' => 'A@aBC%13',//'123aA_456',//
	               'smtp_crypto' => 'security',
	               'mailtype'  => 'html', 
	               'charset'   => 'utf-8',
	               'newline'   => "\r\n",
	               'crlf' => "\r\n",
	               'wordwrap' => TRUE
);
         $this->load->library('email', $config);
         $this->email->initialize($config);
         $this->email->set_newline("\r\n"); 
         $this->email->set_mailtype("html");
         $this->email->from($from_email, 'RDSO'); 
		 $this->email->cc($from_email, "Your password in 'IT Apps' has been reset");
         $this->email->to($to_email);
         $this->email->subject('Reset Password');
         $this->email->message("Your password in 'IT Apps' has been reset. Your new password is ".$passwordplain." ");
		 $user_data=unserialize($this->session->forget); 
        $mobile = $user_data[0]->mobno;	
        $msg = "Your password in 'IT Apps' has been reset. Your new password is ".$passwordplain."";	  
      /*   $username = 'RDSO';
        $password = 'rdso@123';	   
	  $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$username."&passwd=".$password."&text=".urlencode($msg)."&msisdn=".$mobile."&mode=Txt";
	  */
          $username='20091034';
	   $password='rgp46d';	  	
	 $url="http://bulksmsindia.mobi/sendurlcomma.aspx?user=".$username."&pwd=".$password."&senderid=RDSOTX&mobileno=".$mobile."&msgtext=".urlencode($msg)."&smstype=0/4/3 ";
	  $ch  = curl_init();
	 curl_setopt ($ch,CURLOPT_URL, $url) ;
	 curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	 $response = curl_exec($ch) ;
	 curl_close($ch) ;
    // echo $url; exit;
	    return TRUE;	    
}

}


?>
