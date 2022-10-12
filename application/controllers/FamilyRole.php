<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class FamilyRole extends CI_Controller {
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
		$this->load->helper(array('form', 'url'));
	$this->load->model('profilerole/Profilemodel');
	date_default_timezone_set('Asia/Kolkata');
    }

	 
	public function index()
	{
		//$this->load->model('profilerole/Profilemodel');
		
  		//$data['record1'] = null;
		$data['directorate_list'] = $this->Profilemodel->getDirectorateList();
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu);
		$this->load->view('login1/profileadmin/view_familyrole',$data);
		$this->load->view('login1/login/footer');
	}
	public function get_emp_list($dir_id)
	{
		
		$data=$this->Profilemodel->get_emp_list($dir_id);   
		 echo json_encode ($data);
	 }

		
		public function grant_family_role($id)
 		{
		$this->Profilemodel->grant_family_role($id);
		$this->Profilemodel->closeConn();
		$response = 'OK';
		echo $response;
		 }

		public function revoke_family_role($id)
 		{
		$this->Profilemodel->revoke_family_role($id);
		$this->Profilemodel->closeConn();
		$response = 'OK';
		echo $response;
		 }
		
		
		
	
}
?>
