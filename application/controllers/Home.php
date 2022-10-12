<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
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
		$this->lib_csrf->csrf_set_session();			
	}
	
	public function index()
	{		
		 $user=$this->session->rdso_nonrdso;
       	 $this->load->model('login/Loginmodel');
		 $data['record1'] = $this->Loginmodel->getappdetail();
		 $umenu['menu'] = $this->Loginmodel->menumaster();
		// print_r($umenu['menu']);exit;
		if ($umenu['menu'] > 0)
		{
		$this->load->view('login1/login/header.php',$umenu);
		$this->load->view('login1/login/view_home.php',$data);
		$this->load->view('login1/login/footer.php');
		}
		else
		{
		 $this->session->set_flashdata('login_failed','Sorry !!! You are not a authorized user.');	
		 redirect(base_url('user_login'));	
		}
	}
	
}

