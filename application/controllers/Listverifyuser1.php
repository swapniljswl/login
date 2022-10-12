<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Listverifyuser extends CI_Controller {
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
		$this->load->view('login1/admin/listverify');
		$this->load->view('login1/login/footer');
		   } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/listverify');
		$this->load->view('login1/admin/footer.php');
			 
			}
	}
	public function verifyuser()
	{
		$typeuser=$this->input->post('direc');
		
		$this->load->model('admin/Listverify');
        $data['verify']=$this->Listverify->getverifyuser($typeuser); 
		$type	=$this->session->userdata('login');
	      if ($type=='sso') {
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu);
		$this->load->view('login1/admin/listverify',$data);
		$this->load->view('login1/login/footer');
		 } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/listverify',$data);
		$this->load->view('login1/admin/footer.php');
			 
			}
	}
	
		
}


?>
