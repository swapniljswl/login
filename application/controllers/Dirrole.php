<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Dirrole extends CI_Controller {
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
		$this->load->model('adminrole/Userrolemodel');
		
  $data['record1'] = null;
//  if($query){
 //  $data['record1'] =  $query;
//  }
		$data['record1'] = $this->Userrolemodel->getdirctRecords();
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu);
    	$this->load->view('login1/adminrole/userrole',$data);
		$this->load->view('login1/login/footer');
	}
	public function selectemp()
	{
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('direc','direc' , 'required');
	
	   if ($this->form_validation->run())
	   {
		
	        $this->load->model('adminrole/Userrolemodel');
            $data['records'] = $this->Userrolemodel->getuser();
		    $data['record1'] = $this->Userrolemodel->getdirctRecords();
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu);
		    $this->load->view('login1/adminrole/userrole',$data);
            $this->load->view('login1/login/footer');
}
else
{
	      $this->load->library('session');
		  $this->session->set_flashdata('role','No Data found or select one of dropdown');
	      redirect('Dirrole/index');
}
	}	
	public function role($login_id)
	{
	 
	 $this->load->model('adminrole/Userrolemodel');
	if( $this->Userrolemodel->role($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','Directorate Admin role is assigned to user.');
			 redirect('Dirrole/index');	
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','sorry ! You cannot assign more than one Admin role to this directorate.');
			 redirect('Dirrole/index');
		  
}
	} 
}
?>
