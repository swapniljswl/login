<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dirssohome extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('dguser'))
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
	$this->load->view('login1/login/dirssohome.php');		
	}
	  public function ssohome()
	{	 
		
		$this->load->view('login1/admin/header.php');
		//$this->load->view('login1/login/view_home.php');
		$this->load->view('login1/admin/footer.php');
	
      }

}