<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rejectusermodel extends CI_Model
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
	 	 $user_data=unserialize($this->session->user);
	             $dte = $user_data[0]->dte_id;
 //  $sql="select * from comapp.comm_app_login where status is NULL or status ='';";
  // echo $sql; exit;
/*   $query=$this->db->query($sql);
	 return $result = $query->result(); */
	 	
	$sql="select * from comapp.comm_app_login a,comapp.comm_app_login_master b,comapp.comm_dte_master c,
	comapp.comm_desig_master d where a.login_id=b.ipasid and a.dte_id=c.dte_id and 
	a.desig_id = d.desig_id  and  b.status ='r' order by a.name asc";
		//echo $sql; exit;   
	    $query = $this->db->query($sql);
         return $query;  

   
  }
 public function verifyuser($login_id)
 {
	$date = date('Y-m-d h:i:s a', time());
   $user_data=unserialize($this->session->user);
	$empid = $user_data[0]->login_id;
   $this->db->where('ipasid', $login_id);
  $this->db->update('comapp.comm_app_login_master',array('status' =>'v','emp_status' =>'w','active_flag' =>'y','modified_by'=>$empid,'modified_on'=>$date) );
      return TRUE; 
      
		   return TRUE; 

   
  }
   public function rejectuser($login_id)
 {
    $date = date('Y-m-d h:i:s a', time());
    $user_data=unserialize($this->session->user);
	$empid = $user_data[0]->login_id;
    $this->db->where('ipasid', $login_id);
   $this->db->update('comapp.comm_app_login_master',array('status' =>'r','modified_by'=>$empid,'modified_on'=>$date) );
      
		   return TRUE; 

   
  }
 public function sendpassword($login_id)
        {
	      
        $passwordplain = 0;
        $passwordplain  = rand(999999999,9999999999);
		
	     $newpass['password'] =strtoupper(md5($passwordplain));
	  //  $newpass['pwd'] = $passwordplain;
       // $this->db->where('login_id', $loginid);
      //  $this->db->update('rhvms.comm_app_login', $newpass);
	    $this->db->where('ipasid', $login_id);
        $this->db->update('comapp.comm_app_login_master', array('password' => $newpass['password']));
		//$this->db->update('comapp.comm_app_login', array('pwd' => $passwordplain));
		$sql= "select * from comapp.comm_app_login a , comapp.comm_app_login_master b 
	    where b.ipasid='$login_id' and a.login_id='$login_id' and a.login_id=b.ipasid ";
		$query = $this->db->query("$sql");
        $row = $query->row();
        $pwd = $row->pwd; 
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
         $this->email->subject('User Verify');
         $this->email->message("You have been verified in 'IT Apps'. Your registration id is ".$login_id." and your password is ".$passwordplain.". Please login with your new password.");			 
        $mobile = $row->mobno;
		//echo $mobile;exit;
       $msg = "You have been verified in 'IT Apps'. Your registration id is ".$login_id." and your password is ".$passwordplain.". Please login with your new password.";	  
      /*  $username = 'RDSO';
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
			 
		
  return TRUE;
    

}  
public function sendmailreject($login_id)
        {
	            
		//$sql="select name,email,status from comapp.comm_app_login where login_id = '$login_id'";
		$sql= "select * from comapp.comm_app_login a , comapp.comm_app_login_master b 
	    where b.ipasid='$login_id' and a.login_id='$login_id' and a.login_id=b.ipasid ";
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
         $this->email->subject('User Reject');
         $this->email->message("You have been rejected by 'IT Apps' admin. In this regard you may contact your Directorate Admin.  ");			 
        // $this->email->Body ("Hello World");
          //Send mail 
		  $mobile=$row->mobno;
		 $msg = "You have been rejected by 'IT Apps' admin. In this regard you may contact your Directorate Admin.  "; 
      /*  $username = 'RDSO';
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
			 
		
  return TRUE;
    

}
}


?>
