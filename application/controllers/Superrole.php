<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Superrole extends CI_Controller {
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
    }

	 
	public function index()
	{
		$this->load->model('adminrole/Superrolemodel');
		$data['record1'] = null;
		$data['record1'] = $this->Superrolemodel->getdirctRecords();
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu); 
    	$this->load->view('login1/adminrole/superrole',$data);
		$this->load->view('login1/login/footer');
	}
	public function selectemp()
	{
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('direc','direc' , 'required');
	
	   if ($this->form_validation->run())
	   {
		
	        $this->load->model('adminrole/Superrolemodel');
            $data['records'] = $this->Superrolemodel->getuser();
		    $data['record1'] = $this->Superrolemodel->getdirctRecords();
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu); 
		    $this->load->view('login1/adminrole/superrole',$data);
			$this->load->view('login1/login/footer');

}
else
{
	    $this->load->model('adminrole/Superrolemodel');
		$data['record1'] = null;
		$data['record1'] = $this->Superrolemodel->getdirctRecords();
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu); 
    	$this->load->view('login1/adminrole/superrole',$data);
		$this->load->view('login1/login/footer');
}
	}	
	public function role($login_id)
	{
	 
	 $this->load->model('adminrole/Superrolemodel');
	if( $this->Superrolemodel->adminrole($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('login_failed','Super Admin role assigned . Your Admin role is revoked.');
			redirect('user_login');		
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','sorry ! No role assign. Please try again.');
			 $this->load->model('adminrole/Userrolemodel');
            $data['record1'] = $this->Userrolemodel->getdirctRecords();
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu);
    	    $this->load->view('login1/adminrole/superrole',$data);
		    $this->load->view('login1/login/footer');
}
	}
	
}
?>
