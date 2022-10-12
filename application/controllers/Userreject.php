<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Userreject extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
		    if ((!$this->session->userdata('secret')  ))
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
		  $type	=$this->session->userdata('login');
	      if ($type=='sso') {
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/admin/userreject');
		 $this->load->view('login1/login/footer');
	     } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/userreject');
		$this->load->view('login1/admin/footer.php');
			 
			}
	}
		public function selectemp()
	{
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('direc','direc' , 'required');
	
	   if ($this->form_validation->run())
	   {
		   $rdso= $this->input->post('direc');
		  $this->load->model('admin/Rejectuser');
	      $data['verify']=$this->Rejectuser->getverifyuser($rdso); 
		  $type	=$this->session->userdata('login');
		  if ($type=='sso') {
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/admin/userreject',$data);
		 $this->load->view('login1/login/footer');
		  } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/userreject',$data);
		$this->load->view('login1/admin/footer.php');
			 
			}

}
else
{
	   $this->session->set_flashdata("email_sent","Data not found."); 
	   redirect('userreject/index');
}
	}
	  
	
}
?>