<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class ReportProfileVerification extends CI_Controller {
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

    	$data['directorate_list'] = html_escape($this->Profilemodel->getDirectorateList());
		$this->Profilemodel->closeConn();
		$this->load->model('login/Loginmodel');
	     $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	     $this->load->view('login1/login/header',$umenu);
		$this->load->view('login1/profileadmin/view_profile_verification_report',$data);
		$this->load->view('login1/login/footer');
	}

	public function get_profile_verification_report($dir_id,$dt1,$dt2)  //called from view_profile_verification_report
 		
	{
		$this->lib_csrf->csrf_verify();
		// $data=$this->Profilemodel->get_profile_verification_report($dir_id,$dt1,$dt2);   
		 $response['rep_data']=html_escape($this->Profilemodel->get_profile_verification_report($dir_id,$dt1,$dt2));   
		 $this->Profilemodel->closeConn(); 
		 $response['csrf_token']=$this->lib_csrf->get_csrf_hash(); 
		 //echo json_encode ($data);
		 echo json_encode ($response);  
	 }

		
	

			
}
?>
