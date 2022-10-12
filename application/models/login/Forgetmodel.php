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

	    $q= $this->db->query($sql1);
                            
            if($q->num_rows() > 0)
            {
                return $q->result();
            }
            return array();
	  }
    else
	  {		
	   return FALSE;
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
      $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$loginid' or aadhar_no='$loginid')  ";	
	  $query = $this->db->query("$sql1");
      $row = $query->row();
      $ipasid = $row->ipasid; 
	  $rdsononrdso = $row->rdso_nonrdso;
	  if ($rdsononrdso=='1')
	  {
  	$sql="select * from comapp.comm_app_login_master a,comapp.comm_app_login b 
	where (ipasid='$loginid' or aadhar_no='$loginid') and a.ipasid=b.login_id";  
	  }
	  elseif ($rdsononrdso=='2')
	  {
	$sql="select * from comapp.comm_app_profile_nonrdso a , comapp.comm_app_login_master b 
	where  b.aadhar_no='$loginid' and a.aadhar_no='$loginid'  and a.aadhar_no=b.aadhar_no ";	  
	  }
	 // echo $sql;exit;
	   $query = $this->db->query("$sql");
      $row1 = $query->row();
      $ipasid = $row1->ipasid;
			//print_r($user_data);exit;
			$usertype = $row1->rdso_nonrdso;
			if ($usertype=='1') {$user_id = $row->ipasid;
			 }
			elseif ($usertype=='2') { $user_id = $row->aadhar_no;
			
			}
			$email = $row1->email;
		//	echo $email;exit;
			$mobile = $row1->mobno;
			$name = $row1->name;			
		 $date = date('m/d/Y h:i:s a', time());        
        $passwordplain = 0;
        $passwordplain  = rand(999999999,9999999999);
		$newpass['password'] =md5($passwordplain);
		if ($usertype=='1')
		{ $this->db->where('ipasid', $loginid);
          $this->db->or_where('aadhar_no', $loginid);
	   $this->db->update('comapp.comm_app_login_master', array('otp' => $newpass['password'],'modified_by'=>$user_id,'modified_on'=>$date));		  
		  }
	    elseif ($usertype=='2')
		{ $this->db->where('aadhar_no', $loginid);
         $this->db->update('comapp.comm_app_login_master', array('otp' => $newpass['password'],'modified_by'=>$user_id,'modified_on'=>$date));		
		} 
	 
		 		
			$from_email = "pass@rdso.railnet.gov.in"; 
            $to_email = $email; 
			//echo $to_email;exit;
	 $config = array(
                   'protocol'  => 'smtp',
	               'smtp_host' => 'ssl://email.gov.in',
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
        $mobile = $row1->mobno;	
        $msg = " ".$passwordplain." is the OTP for reset password for IT Application. Please enter Emp No/Aadhar and OTP for reset your password.Regards- IT Apps, RDSO";	  
       /*  $username = 'RDSO';
        $password = 'rdso@123';	   
	  $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$username."&passwd=".$password."&text=".urlencode($msg)."&msisdn=".$mobile."&mode=Txt";
	  */
	     $username='rdsotx';
	  //$password='rgp46d';	
  	     $password='1804e6-74fb8'; 	
  	     $sms_template_id='1707163393898234936';
	// $url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format=text";	 
  	 $url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format={json|text}&pe_id=1701163289046207549&template_id=".$sms_template_id;
	//$url="http://bulksmsindia.mobi/sendurlcomma.aspx?user=".$username."&pwd=".$password."&senderid=RDSOTX&mobileno=".$mobile."&msgtext=".urlencode($msg)."&smstype=0/4/3 ";
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
	  $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$loginid' or aadhar_no='$loginid')  ";	
	  $query = $this->db->query("$sql1");
      $row = $query->row();
      $ipasid = $row->ipasid; 
	  $rdsononrdso = $row->rdso_nonrdso;
	  if ($rdsononrdso=='1')
	  {
  	$sql="select * from comapp.comm_app_login_master a,comapp.comm_app_login b 
	where (ipasid='$loginid' or aadhar_no='$loginid') and a.ipasid=b.login_id";  
	  }
	  elseif ($rdsononrdso=='2')
	  {
	$sql="select * from comapp.comm_app_profile_nonrdso a , comapp.comm_app_login_master b 
	where  b.aadhar_no='$loginid' and a.aadhar_no='$loginid'  and a.aadhar_no=b.aadhar_no ";	  
	  }
	 // echo $sql;exit;
	   $query = $this->db->query("$sql");
      $row1 = $query->row();
	  $usertype = $row1->rdso_nonrdso;
	  if ($usertype=='1') {$user_id = $row->ipasid;	 }
	  elseif ($usertype=='2') { $user_id = $row->aadhar_no;	}
      $ipasid = $row1->ipasid;
	  $email = $row1->email;
	  $mobile = $row1->mobno;
	  $name = $row1->name;			
	  $date = date('m/d/Y h:i:s a', time());        
      $passwordplain = 0;
        $passwordplain  = rand(999999999,9999999999);
		$newpass['password'] =md5($passwordplain);
		if ($usertype=='1')
		{ $this->db->where('ipasid', $loginid);
	     $this->db->or_where('aadhar_no', $loginid);	
         $this->db->update('comapp.comm_app_login_master', array('password' => $newpass['password'],'modified_by'=>$user_id,'modified_on'=>$date));
		 }
	    elseif ($usertype=='2')
		{ $this->db->where('aadhar_no', $loginid);
         $this->db->update('comapp.comm_app_login_master', array('password' => $newpass['password'],'modified_by'=>$user_id,'modified_on'=>$date));
		}
       
			$from_email = "pass@rdso.railnet.gov.in"; 
            $to_email = $email; 
	 $config = array(
                   'protocol'  => 'smtp',
	               'smtp_host' => 'ssl://email.gov.in',
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
        $mobile = $row1->mobno;	
        $msg = "Your password in 'IT Apps' has been reset. Your new password is ".$passwordplain.".Regards- IT Apps,RDSO";	  
       /*  $username = 'RDSO';
        $password = 'rdso@123';	   
	  $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$username."&passwd=".$password."&text=".urlencode($msg)."&msisdn=".$mobile."&mode=Txt";
	  */
          $username='rdsotx';
	   //$password='rdso1234';	
  	     $password='1804e6-74fb8'; 
  	     $sms_template_id='1707163393902306233';	
	 //$url="http://bulksmsindia.mobi/sendurlcomma.aspx?user=".$username."&pwd=".$password."&senderid=RDSOTX&mobileno=".$mobile."&msgtext=".urlencode($msg)."&smstype=0/4/3 ";
	// $url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format=text";	 
	$url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format={json|text}&pe_id=1701163289046207549&template_id=".$sms_template_id; 
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

