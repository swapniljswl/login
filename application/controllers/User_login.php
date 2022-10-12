<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class User_login extends CI_Controller {
      public function __construct()
    {
        parent::__construct();
        $this->lib_csrf->csrf_set_session();
        
    }
	public function index()
	{
		
		 $this->load->view('login1/login/user_login');
	}
	 public function login()
	{
	  
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('username','Emp No or Unique Id' , 'required|min_length[10]|max_length[12]');
	   $this->form_validation->set_rules('password','Password' , 'required');
	
	   if ($this->form_validation->run())
	   {
		   $this->lib_csrf->csrf_verify();
		   $username=$this->input->post('username');
		     // $password=$this->input->post('password');
		//   $password=strtoupper(md5($this->input->post('password')));
		      $password=md5($this->input->post('password'));
	    
		   $this->load->model('login/loginmodel');
		  if( $this->loginmodel->valid_login($username, $password ))
		  {
			  
		  $this->load->library('session');
		  $user_data=unserialize($this->session->secret);
		   // $user_name = $user_data[0]->name;
		   //print_r($user_data);exit;
		    $userid = $user_data[0]->ipasid;
			$aadharno = $user_data[0]->aadhar_no;
			$rdsononrdso = $user_data[0]->rdso_nonrdso;
			$this->session->set_userdata('userid', $userid);
			$this->session->set_userdata('aadhar_no', $aadharno);
            $this->session->set_userdata('rdso_nonrdso', $rdsononrdso);			
			$this->load->model('login/loginmodel');
			 if ($rdsononrdso=='1') 
			 {  	
				$this->loginmodel->getdetail($username);
				
			 }
             elseif ($rdsononrdso=='2')	
              {
				$this->loginmodel->getnonrdso($username);
				//echo $aadharno;exit;
			  }			 
			 if( $this->loginmodel->getdetail($username))
		    {			
			$user_data=unserialize($this->session->user);
		    $user_name = $user_data[0]->name; 			
		  	redirect('login');
		    }
		   elseif( $this->loginmodel->getnonrdso($username))
		    {		//echo $aadharno;exit;		
			$user_data=unserialize($this->session->user);
		    $user_name = $user_data[0]->name; 			
		  	redirect('login');
		    }
		  else
		 {	echo "hi";exit;
	      $this->load->library('session');
	      $this->session->set_flashdata('login_failed','invalid username/password.');
	      $this->load->helper('url');
	      $this->load->view('login1/login/user_login');
    	
		  }  
	   
	   }  
		  
		  else
		  {	
	     $this->load->library('session');
	      $this->session->set_flashdata('login_failed','invalid username/password.');
	     $this->load->helper('url');
	      $this->load->view('login1/login/user_login');
    	
		  }
	}  
	
	else
	{
    
	$this->load->view('login1/login/user_login');
	//echo validation_errors();
	}
	
	
	} 
	public function logout()
	{

	$this->load->driver('cache'); # add
    $this->session->sess_destroy(); # Change
    $this->cache->clean();  # add
    redirect('user_login/login'); # Your default controller name 
    ob_clean(); # add 
	}
	
}
?>