<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Forgetpwd extends CI_Controller {
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
	 	 $this->lib_csrf->csrf_set_session();

      } 
		
	
	public function index()
	{
		
		 $this->load->view('login1/login/forget');
		
	}
	 public function forgotPassword()
   { 
   		
         $this->load->library('form_validation');
	     $this->form_validation->set_rules('loginid', 'Emp No/ Unique Id', 'trim|required|min_length[10]|max_length[12]');
		 if ($this->form_validation->run()==FALSE)
	   {
		   $this->load->helper('html');
	      $this->load->helper('form');
	      $this->load->view('login1/login/forget');
		// echo validation_errors();
	   } 
	   else
	{
		 $this->lib_csrf->csrf_verify();  
		   $loginid=$this->input->post('loginid');
			
		  $this->load->model('login/forgetmodel');
		  
		  if($data['data'] = $this->forgetmodel->forgetpwd($loginid))
		  { 
	         foreach ($data as $row)		
            { 
	          if ($row[0]->status=='v')			  
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
		  $this->session->sess_destroy(); # Change
          
		 }		 
		  }	         
		  } 
		  else
	     {
	    $this->session->set_flashdata("email_sent","Sorry !! User is not verified by directorate Admin. "); 
	    $this->load->view('login1/login/forget');	
		$this->session->sess_destroy(); # Change      
	     }
		  } }
         else 
		 {
         $this->session->set_flashdata("email_sent","Invalid Emp No/Unique Id! Please enter correct Emp No/Unique Id."); 
	     $this->load->view('login1/login/forget');
		 $this->session->sess_destroy(); # Change         
		 }
		 }
	
	}
	 
 public function forgetotp()
   { 
   		 
         $this->load->library('form_validation');
	     $this->form_validation->set_rules('loginid', 'Emp No/Unique Id', 'trim|required|min_length[11]|max_length[12]');
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
			$this->lib_csrf->csrf_verify(); 
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
         $this->session->set_flashdata("email_sent","Invalid OTP ! Please enter correct OTP."); 
	     $this->load->view('login1/login/forgetotp');
		// $this->session->sess_destroy(); # Change
          }
			}
   }	
		public function resetPassword()
   { 
        $this->lib_csrf->csrf_verify();
		    $ipasid=$this->input->get('ipasid');
			$loginid=base64_decode($ipasid);
			//echo $loginid;
		    $this->load->model('login/forgetmodel');		  
		   if($data['data'] = $this->forgetmodel->forgetpwd($loginid))
		  { 
	         foreach ($data as $row)		
            { 
	          if ($row[0]->status=='v')			  
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
			  else
			  {
		$this->session->set_flashdata("email_sent","Sorry !! User is not verified by directorate Admin. "); 
	    $this->load->view('login1/login/forget');	
		$this->session->sess_destroy(); # Change 
			  }
		  } }
         else 
		 {
         $this->session->set_flashdata("email_sent","Invalid Emp No/Unique Id ! Please enter correct Emp No/Unique Id."); 
	     $this->load->view('login1/login/forget');
		 $this->session->sess_destroy(); # Change
          }
			}					
	          } 
   ?>
