<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Checkdirrole extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
		 	if(!$this->session->userdata('userid'))
		{
			$this->load->driver('cache'); # add
            $this->session->sess_destroy(); # Change
            $this->cache->clean();  # add
             redirect(base_url('user_login')); # Your default controller name 
		   
            ob_clean();
			
		}
		$this->lib_csrf->csrf_set_session();
    }
public function index()
	{
		$this->load->model('adminrole/Checkrolemodel');		
        $data['record1'] = null;
		$data['record1'] = html_escape($this->Checkrolemodel->getroleRecord());
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	    $this->load->view('login1/login/header',$umenu);
    	$this->load->view('login1/adminrole/checkrole',$data);
		$this->load->view('login1/login/footer');
	}
	public function selectemp()
	{
		 $this->lib_csrf->csrf_verify();
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('role','role' , 'required');
	
	   if ($this->form_validation->run())
	   {
		   
	        $this->load->model('adminrole/Checkrolemodel');
			 $data['records'] = html_escape($this->Checkrolemodel->getroleuser());
			$data['record1'] = html_escape($this->Checkrolemodel->getroleRecord());          
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	        $this->load->view('login1/login/header',$umenu);
		    $this->load->view('login1/adminrole/checkrole',$data);
            $this->load->view('login1/login/footer');
}
else
{
	      $this->load->library('session');
		  $this->session->set_flashdata('role','No Data found or select one of dropdown');
	      redirect('Checkdirrole/index');
}
	}
	 
public function roledel($login_id,$csrf_token)
	{
	 
	$this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $this->load->model('adminrole/Userrolemodel');
	if( $this->Userrolemodel->roledel($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','Role is revoked from user.');
			 redirect('Checkdirrole/index');	
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','sorry ! You cannot assign more than one Admin role to this directorate.');
			 redirect('Checkdirrole/index');
		  
}
	}

}
?>
