<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login/login'); }
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
//if (!$referer) {$this->redirect('user_login/login'); }
class Login extends CI_Controller {
      public function __construct()
    {
        parent::__construct();
		
		if ((!$this->session->has_userdata('user')) and (!$this->session->has_userdata('secret')))
		{
            $this->load->driver('cache'); # add
            $this->session->sess_destroy(); # Change
            $this->cache->clean();  # add
             redirect(base_url('user_login')); # Your default controller name 
		   
            ob_clean();
		}		
    }

	public function index()
	{
	   $userid = ($this->session->userid||$this->session->aadhar_no);
    
	 if (!$userid)  
	 {    
		    $this->load->library('session');
	        $this->session->set_flashdata('login_failed','Sorry !!! You are not a authorized user.');
		  	redirect('user_login/login');
	 }
	
	 else
	 {
	        $user_data=unserialize($this->session->secret);
		   // $user_name = $user_data[0]->name;
		    $userid = $user_data[0]->ipasid;
			$role = $user_data[0]->role;
			$usertype = $user_data[0]->rdso_nonrdso;
			$empstatus = $user_data[0]->emp_status;
			$activeflag = $user_data[0]->active_flag;
			$valid = $user_data[0]->validupto_nonrdso;
			$status = $user_data[0]->status;
			$this->session->set_userdata('login', 'sso');	
		
			if  (($empstatus =='w')&& ($activeflag =='y')&& ($status =='v')&& ($role !='')&& ($usertype !=''))
			{ 
		    redirect('home');
		    }
		  	
		  
		elseif  ($activeflag =='')
		 {	
	   //   $this->load->library('session');
	      $this->session->set_flashdata('login_failed','You are deactiveted by Admin.');
	    //  $this->load->helper('url');
	      $this->load->view('login1/login/user_login');
    	
		  }
		 		  
			else
		   {	
	   //   $this->load->library('session');
	      $this->session->set_flashdata('login_failed','Sorry !!! You are not verified by Directorate Admin.');
	    //  $this->load->helper('url');
	      $this->load->view('login1/login/user_login');
    	
		  }
		  
}
}
}
?>