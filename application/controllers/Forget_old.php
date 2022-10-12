<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Forget extends CI_Controller {
     function __construct() { 
         parent::__construct(); 
         $this->load->library('session'); 
         $this->load->helper('form'); 
		 date_default_timezone_set('Asia/Calcutta');
		 $this->load->helper(array('email'));
         $this->load->library(array('email'));
	     $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
	
      } 
		
	
	public function index()
	{
		
		 $this->load->view('login1/login/forget');
		
	}
	 public function forgotPassword()
   { 
         $this->load->library('form_validation');
	     $this->form_validation->set_rules('loginid', 'Emp No/ Unique Id', 'trim|required|min_length[11]|max_length[12]');
		 if ($this->form_validation->run()==FALSE)
	   {
		   $this->load->helper('html');
	      $this->load->helper('form');
	      $this->load->view('login1/login/forget');
		// echo validation_errors();
	   } 
	   else
	{
		   $loginid=$this->input->post('loginid');
			
		  $this->load->model('login/forgetmodel');
		  
		  if( $this->forgetmodel->forgetpwd($loginid))
		  { 
			  $user_data=unserialize($this->session->forget);
			//  print_r( $user_data);exit;
	    	  $status = $user_data[0]->status;
			  $username = $user_data[0]->name;
			  if ($status=='v')
			  
			  {
			$this->load->model('login/forgetmodel');
            if($this->forgetmodel->sendotp($loginid))
			{
            
         if($this->email->send()) 
		 {
			 unset ($_SESSION['password']);
         $this->session->set_flashdata("email_sent","A OTP has been sent on your emailid/mobile for change password."); 
	     $this->load->view('login1/login/forgetotp');
		// $this->session->sess_destroy(); # Change
        
		 }
         elseif(!$this->email->send())  
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
	     // echo $this->email->print_debugger(); 
          $this->load->view('login1/login/forget');
		//  $this->session->sess_destroy(); # Change
          
		 }		 
		  }	         
		  }
		  else
	     {
	    $this->session->set_flashdata("email_sent","Sorry !! User is not verified by directorate Admin. "); 
	    $this->load->view('login1/login/forget');	
		$this->session->sess_destroy(); # Change      
	     }
		  }
         else 
		 {
         $this->session->set_flashdata("email_sent","Invalid Emp No/Aadhar No! Please enter correct Emp No/Aadhar No."); 
	     $this->load->view('login1/login/forget');
		 $this->session->sess_destroy(); # Change         
		 }
		 }
	
	
	} 
 public function forgetotp()
   { 
         $this->load->library('form_validation');
	     $this->form_validation->set_rules('loginid', 'Emp No/Aadhar No', 'trim|required|min_length[11]|max_length[12]');
		   $this->form_validation->set_rules('otp', 'OTP', 'required');
		 if ($this->form_validation->run()==FALSE)
	   {
		  $this->load->helper('html');
	      $this->load->helper('form');
	      $this->load->view('login1/login/forgetotp');
		// echo validation_errors();
	   }
        else
		{
		    $loginid=$this->input->post('loginid');
			 $otp=md5($this->input->post('otp'));			
			//$loginid=base64_decode($ipasid);
			//echo $loginid;
		    $this->load->model('login/forgetmodel');
		  
		  if( $this->forgetmodel->forgetotp($loginid,$otp))
		  {
			  
			$this->load->model('login/forgetmodel');
            if($this->forgetmodel->resetpassword($loginid))
			{            
         if($this->email->send()) 
		 {
			 unset ($_SESSION['password']);
         $this->session->set_flashdata("email_sent","Please login with your new password which has been sent to your Email ID/Mobile. "); 
	     $this->load->view('login1/login/user_login');
		// $this->session->sess_destroy(); # Change
        
		 }
         elseif(!$this->email->send()) 
		 {
         $this->session->set_flashdata("email_sent","Error in sending email."); 
	   //   echo $this->email->print_debugger(); 
          $this->load->view('login1/login/forgetotp');
		 // $this->session->sess_destroy(); # Change
          
		 }
           }			 
         	  }
			  
         else 
		 {
         $this->session->set_flashdata("email_sent","Invalid Emp No/OTP ! Please enter correct Emp No/OTP."); 
	     $this->load->view('login1/login/forgetotp');
		// $this->session->sess_destroy(); # Change
          }
			}
   }	
		public function resetPassword()
   { 
        
		    $ipasid=$this->input->get('ipasid');
			$loginid=base64_decode($ipasid);
			//echo $loginid;
		    $this->load->model('login/forgetmodel');
		  
		  if( $this->forgetmodel->forgetpwd($loginid))
		  {
			  $user_data=unserialize($this->session->forget);
			//  print_r($user_data);exit;
	    	  $status = $user_data[0]->status;
			  $username = $user_data[0]->name;
			  if ($status=='v')
			  
			  {
			$this->load->model('login/forgetmodel');
            if($this->forgetmodel->resetpassword($loginid))
			{
            
         if($this->email->send()) 
		 {
			 unset ($_SESSION['password']);
         $this->session->set_flashdata("email_sent","Please login with your new password which has been sent to your Email ID/Mobile. "); 
	     $this->load->view('login1/login/user_login');
		 $this->session->sess_destroy(); # Change
        
		 }
         elseif(!$this->email->send())  
		 {
         $this->session->set_flashdata("email_sent","Error in sending email."); 
	   //   echo $this->email->print_debugger(); 
          $this->load->view('login1/login/forget');
		  $this->session->sess_destroy(); # Change
          
		 }
           }			 
         	  }
				  }
         else 
		 {
         $this->session->set_flashdata("email_sent","Invalid Emp No/Aadhar ! Please enter correct Emp No/Aadhar."); 
	     $this->load->view('login1/login/forget');
		 $this->session->sess_destroy(); # Change
          }
			}
					
	          } 
   ?>
