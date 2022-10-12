<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Dirlogin extends CI_Controller {
      public function __construct()
    {
        parent::__construct();
        
    }
	public function index()
	{
		
		 $this->load->view('login1/login/dirlogin');
	}
	 public function login()
	{
	   
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('username','Email', 'required' );
	   $this->form_validation->set_rules('password','Password' , 'required');
	
	   if ($this->form_validation->run())
	   {		  
		   $username=$this->input->post('username');		  
		   $password=md5($this->input->post('password'));	    
		   $this->load->model('login/DirLoginmodel');
		  if( $this->DirLoginmodel->valid_login($username, $password ))
		  {	
	        	  
		    $this->load->library('session');
		    $user_data=unserialize($this->session->dguser);
			//print_r($user_data);exit;
		    $home=$this->session->userdata('login');
			if ($home=='sso')
			{
		    $userid = $user_data[0]->ipasid;
			$aadharno = $user_data[0]->aadhar_no;
			$rdsononrdso = $user_data[0]->rdso_nonrdso;
			$this->session->set_userdata('userid', $userid);
			$this->session->set_userdata('aadhar_no', $aadharno);
            $this->session->set_userdata('rdso_nonrdso', $rdsononrdso);
          	$this->load->model('login/DirLoginmodel');
			if( $this->DirLoginmodel->getdetail($userid))
		    {
             $this->load->model('login/DirLoginmodel');  
			 $this->DirLoginmodel->dgdash($username,$password)	;			
			$user_data=unserialize($this->session->user);
		    $user_name = $user_data[0]->name; 			
		  //	redirect('login');
		     redirect('Dirhome');
		    } 
			}			
			elseif ($home=='dgdash')
			{
			redirect('Dirhome');	
		  } }
		  else
		 {	
	      $this->load->library('session');
	      $this->session->set_flashdata('login_failed','invalid username/password.');
	      $this->load->helper('url');
	      $this->load->view('login1/login/dirlogin');
    	
		  }  
	   
	   }  
		  
		 else
	     {
    
	  $this->load->view('login1/login/dirlogin');
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