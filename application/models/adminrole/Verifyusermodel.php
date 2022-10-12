<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Verifyusermodel extends CI_Model
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
	 function getepstatus()
        {
     
            //  $q = $this->db->get("comapp.comm_desig_master");
			 $sql1= " select * from comapp.comm_emp_status  ";
	  //   echo $sql;exit;
	      $q= $this->db->query($sql1);
                            
            if($q->num_rows() > 0)
            {
                return $q->result();
            }
            return array();
        }
	
 public function getverifyuser()
 {
	    $direc=$this->input->post('direc');
	    $typeuser=$this->input->post('typeuser');
		//echo $typeuser;exit;
    	$this->session->set_userdata('dteid', $direc);
	if ($typeuser=='1')
	{
	$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id and a.dte_id='$direc' and  b.rdso_nonrdso='$typeuser' and (b.status ='' or b.status is NULL ) order by a.name asc";
	} elseif ($typeuser=='2')
	{
	$sql="select a.aadhar_no,a.name,null nonrdso,d.dte_desc,a.mobno,a.email,e.rdso_nonrdso,e.status
		   from comapp.comm_app_profile_nonrdso a 
           left outer join comapp.comm_dte_master d on a.nodal_dte=d.dte_id
		   left outer join comapp.comm_app_login_master e on a.aadhar_no=e.aadhar_no and e.rdso_nonrdso='$typeuser' 
            where a.nodal_dte='$direc' and (e.status is NULL or e.status ='') order by a.name asc   "; 	
	}
	
	/* 		
	$sql="select a.login_id,a.name,b.desig_desc,d.dte_desc,a.mobno,a.email,a.group 
		    from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
           left outer join comapp.comm_bldg_master c on a.bldg_id=c.bldg_id
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
		   left outer join comapp.comm_app_login_master e on a.login_id=e.ipasid
           where a.dte_id='$direc' and e.status is NULL or e.status ='' and e.rdso_nonrdso='1' order by a.name asc  ";  */	
      //  echo $sql; exit;	   
	    $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
	       
         return $query->result_array(); 
			    
	  } else  {
	      
         return 0;
	  } 

   
  }
 public function verifyuser($login_id)
 {
	   $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$login_id' or aadhar_no='$login_id')  ";	
	  $query = $this->db->query("$sql1");
     $row = $query->row();
     $rdsononrdso = $row->rdso_nonrdso;
	$date = date('Y-m-d h:i:s a', time());
   $user_data=unserialize($this->session->user);
	$empid = $user_data[0]->login_id;
   if ($rdsononrdso=='1')
	 {  $this->db->where('ipasid', $login_id);
     $this->db->update('comapp.comm_app_login_master',array('status' =>'v','role' =>'7','emp_status' =>'w','active_flag' =>'y','verified_by'=>$empid,'verified_on'=>$date) );     }
	 elseif ($rdsononrdso=='2')  
	 {  $this->db->where('aadhar_no', $login_id);
	 $this->db->update('comapp.comm_app_login_master',array('status' =>'v','role' =>'8','emp_status' =>'w','active_flag' =>'y','verified_by'=>$empid,'verified_on'=>$date) );}
  
      return TRUE; 

   
  }
   public function rejectuser($login_id)
 {
	  $reason=$this->input->post('reason');
	  $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$login_id' or aadhar_no='$login_id')  ";	
	  $query = $this->db->query("$sql1");
     $row = $query->row();
     $rdsononrdso = $row->rdso_nonrdso;

	$date = date('Y-m-d h:i:s a', time());
	$user_data=unserialize($this->session->user);
	$empid = $user_data[0]->login_id;
    if ($rdsononrdso=='1')
	 {  $this->db->where('ipasid', $login_id);	 }
	 elseif ($rdsononrdso=='2')  
	 {  $this->db->where('aadhar_no', $login_id);	 }
   $this->db->update('comapp.comm_app_login_master',array('rejection_reason'=>$reason,'status' =>'r','verified_by'=>$empid,'verified_on'=>$date) );
      
		   return TRUE; 

   
  }
 public function sendmail($login_id)
        {
	      
        $passwordplain = 0;
        $passwordplain  = rand(999999999,9999999999);
		
	     $newpass['password'] =md5($passwordplain);
	  //  $newpass['pwd'] = $passwordplain;
       // $this->db->where('login_id', $loginid);
      //  $this->db->update('rhvms.comm_app_login', $newpass);
	 
	    $this->db->where('ipasid', $login_id);
        $this->db->update('comapp.comm_app_login_master', array('password' => $newpass['password']));
		//$this->db->update('comapp.comm_app_login', array('pwd' => $passwordplain));
		//$sql="select name,pwd,email,status from comapp.comm_app_login where login_id = '$login_id'";
		$sql= "select * from comapp.comm_app_login a , comapp.comm_app_login_master b 
	    where b.ipasid='$login_id' and a.login_id='$login_id' and a.login_id=b.ipasid ";
		$query = $this->db->query("$sql");
        $row = $query->row();
        $pwd = $row->password; 
		$email = $row->email; 
		$name = $row->name; 
		$status = $row->status;
       		
	    $_SESSION['password']= $pwd;
		
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
         //Load email library 
       //  $this->load->library('email'); 
         //echo ($from_email);exit;
		 
         $this->email->from($from_email, 'RDSO'); 
         $this->email->to($to_email);
         $this->email->subject('User Verification');
         $this->email->message("You have been verified in 'IT Apps'. Your registration id is ".$login_id." and your password is ".$passwordplain.". Please login with your new password.");				 
        // $this->email->Body ("Hello World");
          //Send mail 
		//    	$user_data=unserialize($this->session->forget); 
      // $mobile = $user_data[0]->mobno;	
	     $mobile = $row->mobno;
		//echo $mobile;exit;
       $msg = "You have been verified in 'IT Apps'. Your registration id is ".$login_id." and your password is ".$passwordplain.". Please login with your new password.Regards- IT Apps, RDSO";
       $sms_template_id='1707163393905114961'; 
      /*  $username = 'RDSO';
       $password = 'rdso@123';	  
	   $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$username."&passwd=".$password."&text=".urlencode($msg)."&msisdn=".$mobile."&mode=Txt";
	   */
          $username='rdsotx';
	   //$password='rgp46d';	
  	     $password='1804e6-74fb8'; 	
	// $url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format=text";	 

  	$url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format={json|text}&pe_id=1701163289046207549&template_id=".$sms_template_id;	 
	//$url="http://bulksmsindia.mobi/sendurlcomma.aspx?user=".$username."&pwd=".$password."&senderid=RDSOTX&mobileno=".$mobile."&msgtext=".urlencode($msg)."&smstype=0/4/3 ";	   
	   $ch  = curl_init();
	 curl_setopt ($ch,CURLOPT_URL, $url) ;
	 curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	 $response = curl_exec($ch) ;
	 curl_close($ch) ;		 
		
  return TRUE;
    

}  
public function sendmailreject($login_id)
        {
	    $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$login_id' or aadhar_no='$login_id')  ";		 
	    
		$query = $this->db->query("$sql1");
        $row = $query->row();		
		$rdsononrdso = $row->rdso_nonrdso;
		if ($rdsononrdso=='1')	{
		$sql= "select * from comapp.comm_app_login a , comapp.comm_app_login_master b 
	    where b.ipasid='$login_id' and a.login_id='$login_id' and a.login_id=b.ipasid ";
		} elseif ($rdsononrdso=='2'){
		$sql="select *
		   from comapp.comm_app_profile_nonrdso a 
		   left outer join comapp.comm_app_login_master b on a.aadhar_no=b.aadhar_no
		   left outer join comapp.comm_dte_master d on a.nodal_dte=d.dte_id
           where a.aadhar_no='$login_id' ";	
		}
      //   echo $sql;exit;		
		$query = $this->db->query("$sql");
        $row = $query->row();
        $email = $row->email; 
		$name = $row->name; 
		$status = $row->status; 
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
         //Load email library 
       //  $this->load->library('email'); 
         //echo ($from_email);exit;
		 $this->email->from($from_email, 'RDSO'); 
         $this->email->to($to_email);
         $this->email->subject('User Rejection');
         $this->email->message("You have been rejected by 'IT Apps' admin. In this regard you may contact your Directorate Admin.  ");			 
        // $this->email->Body ("Hello World");
          //Send mail 
		  $mobile=$row->mobno;
		 $msg = "You have been rejected by 'IT Apps' admin. In this regard you may contact your Directorate Admin.Regards- IT Apps, RDSO"; 
      /*  $username = 'RDSO';
       $password = 'rdso@123';	  
	   $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$username."&passwd=".$password."&text=".urlencode($msg)."&msisdn=".$mobile."&mode=Txt";
	  */ 
	     $username='rdsotx';
	   //$password='rdso1234';	
  	     $password='1804e6-74fb8';	
  	     $sms_template_id='1707163393908539368';
		// $url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format=text";	
		$url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format={json|text}&pe_id=1701163289046207549&template_id=".$sms_template_id;	  
	//$url="http://bulksmsindia.mobi/sendurlcomma.aspx?user=".$username."&pwd=".$password."&senderid=RDSOTX&mobileno=".$mobile."&msgtext=".urlencode($msg)."&smstype=0/4/3 ";
	  $ch  = curl_init();
	 curl_setopt ($ch,CURLOPT_URL, $url) ;
	 curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	 $response = curl_exec($ch) ;
	 curl_close($ch) ;		
     return TRUE;
    

}
}


?>
