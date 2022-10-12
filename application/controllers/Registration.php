<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Registration extends CI_Controller {
 function __construct() { 
         parent::__construct(); 
         $this->load->helper('form'); 
		 date_default_timezone_set('Asia/Calcutta');
		 $this->load->helper(array('email'));
         $this->load->library(array('email'));
		 $this->load->helper('security');
	     $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
		 $this->load->library('session');
		  $this->lib_csrf->csrf_set_session();
      } 
	
	public function index()
	{
		 $this->load->library('session');
		 $this->load->helper('html');
		 $this->load->helper('form');
		 $this->load->model('login/Register');
         $data['records'] = html_escape($this->Register->getdesgRecords());
		 $data['record1'] = html_escape($this->Register->getdirctRecords());
		 $this->load->view('login1/login/registration',$data);
	}
	public function register()
	{
	   $this->lib_csrf->csrf_verify();
	   $usertype=$this->input->post('typeuser');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('typeuser', 'checkbox', 'trim|required');
	   if ($usertype=='1')
	   { $this->form_validation->set_rules('empno','Emp No' , 'required|exact_length[11]|regex_match[/^[a-z0-9\. ,]*$/i]');
         $this->form_validation->set_rules('desg','Designation' , 'required');   
		} 
		 elseif ($usertype=='2')
	    {
			$this->form_validation->set_rules('aadharno','Unique Id' , 'required|numeric|min_length[10]|max_length[12]');
		}
	   $this->form_validation->set_rules('username','user name' , 'required|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('email', 'Email ID', 'trim|required|regex_match[/^[a-z0-9\. , @]*$/i]|valid_email');
   	   $this->form_validation->set_rules('mobile','Mobile number' , 'required|numeric|exact_length[10]');       
	   $this->form_validation->set_rules('direc','Directorate' , 'required');
	
		if ($this->form_validation->run()==FALSE)
	   {
		   $this->load->helper('html');
	       $this->load->helper('form');
	        $this->load->model('login/Register');
            $data['records'] = html_escape($this->Register->getdesgRecords());
		    $data['record1'] = html_escape($this->Register->getdirctRecords());
		    $this->load->view('login1/login/registration',$data);
		//echo validation_errors();
	   } 
	   else
	{				
		   $data = array(
		   $empno=$this->input->post('empno'),
		   $aadhar=$this->input->post('aadharno'),
		   $email=$this->input->post('email'),
		   $username=$this->input->post('username'),
		   $mobile=$this->input->post('mobile') );
		  // $password=strtoupper(md5($this->input->post('password'))), 
		  // $epassword=$this->input->post('password') );
		  	$data= $this->input->post(); 
			//print_r($data);exit;
		    unset ($data['submit']);
		 
		    $this->load->model('login/register');
	       if( $this->register->check_user($empno,$aadhar))
		  {	             
			$this->session->set_flashdata('email_sent',"Data already register");
			$this->load->helper('html');
	        $this->load->helper('form');
	        $this->load->model('login/Register');
            $data['records'] = html_escape($this->Register->getdesgRecords());
		    $data['record1'] = html_escape($this->Register->getdirctRecords());
		    $this->load->view('login1/login/registration',$data);
		  }
			else 
		  {
		     $this->load->model('login/register');
             if( $this->register->valid_register($data))
			 {
		 if ($usertype=='1') { $regid=$this->input->post('empno');}
         elseif ($usertype=='2') { $regid=$this->input->post('aadharno');}
		 $to_email = $this->input->post('email'); 
		 $from_email = "pass@rdso.railnet.gov.in"; 
		 //include ('Sendmail');
		// require_once(APPPATH.'controllers/Sendmail.php');
		 $from_email = "pass@rdso.railnet.gov.in";                   
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
         $this->email->to($to_email);
         $this->email->subject('Employee Registration');
         $this->email->message("You have been registered in 'IT Apps' and your registration id is ".$regid.". Your password will be sent to your email id/mobile after verification. Regards- IT Apps,RDSO"); 
	    
		 
         if($this->email->send()) 
		 {
			
		//	 unset ($_SESSION['password']);
         $this->session->set_flashdata("feedback","You have been registered in 'IT Apps' and your registration id is ".$regid.". Your password will be sent to your email id/mobile after verification."); 
	    
      //    	$user_data=unserialize($this->session->forget); 
      // $mobile = $user_data[0]->mobno;	
	    $mobile=$this->input->post('mobile');
		//echo $mobile;exit;
       $msg = "You have been registered in 'IT Apps' and your registration id is ".$regid.". Your password will be sent to your email id/mobile after verification.Regards- IT Apps,RDSO";	
       $sms_template_id='1707163393893368744';  
      /*  $username = 'RDSO';
       $password = 'rdso@123';
	  
	   $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$username."&passwd=".$password."&text=".urlencode($msg)."&msisdn=".$mobile."&mode=Txt";
	 */   
	   $username='rdsotx';
	   $password='1804e6-74fb8';	  	
	// $url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format=text";

	$url="http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=".$username."&password=".$password."&sender=RDSOTX&to=".$mobile."&message=".urlencode($msg)."&reqid=1&format={json|text}&pe_id=1701163289046207549&template_id=".$sms_template_id;	 

	//$url="http://bulksmsindia.mobi/sendurlcomma.aspx?user=".$username."&pwd=".$password."&senderid=RDSOTX&mobileno=".$mobile."&msgtext=".urlencode($msg)."&smstype=0/4/3 ";
	   $ch  = curl_init();
	   curl_setopt ($ch,CURLOPT_URL, $url) ;
	   curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	   $response = curl_exec($ch) ;
	   curl_close($ch) ;	    
	   $this->load->view('login1/login/user_login');
		 
		 }
         elseif(!$this->email->send())  
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email. You have been registered in 'IT Apps'."); 
	    //  echo $this->email->print_debugger(); 
           $this->load->view('login1/login/user_login');
		 }
		
         
		  }		
			
			else
			{
				$this->session->set_flashdata('email_sent',"Data Not Inserted Successfully. Please try again");
				$this->load->helper('html');
	             $this->load->helper('form');
	             $this->load->view('login1/login/registration');
				//echo "not successful";
		  } 
		  } 
          
	}

}

}
 ?>
