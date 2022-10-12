<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class ProfileVerification extends CI_Controller {
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
		$this->load->helper(array('form', 'url'));
	$this->load->model('profilerole/Profilemodel');
	date_default_timezone_set('Asia/Kolkata');
    }

	 
	public function index()
	{

    	$data['directorate_list'] = html_escape($this->Profilemodel->getDirectorateList());
		if($this->session->has_userdata('selected_dte')){
			$data['selected_dte']=$this->session->selected_dte;
			$this->session->unset_userdata('selected_dte');
		}
		else
			$data['selected_dte']='-1';
		$this->Profilemodel->closeConn();
		$this->load->model('login/Loginmodel');
	     $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/profileadmin/view_profile_verification_list',$data);
		 $this->load->view('login1/login/footer');
	}

		public function get_profile_verification_list($dir_id)
	{
		$this->lib_csrf->csrf_verify(); 
		$response['rep_data']=html_escape($this->Profilemodel->get_profile_verification_list($dir_id));  
		$this->Profilemodel->closeConn(); 
		$response['csrf_token']=$this->lib_csrf->get_csrf_hash();  
 		echo json_encode ($response);  

		// echo json_encode ($data);
	 }

		
	public function profile_verification($id,$dir_id)  //called from view_profile_verification_list
 		{
 		$data['get_emp_details']=html_escape($this->Profilemodel->get_emp_details($id));
		$data['dir']= $dir_id;
		$this->load->model('login/Loginmodel');
	     $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	     $this->load->view('login1/login/header',$umenu);
		$this->load->view('login1/profileadmin/view_profile_verification',$data);
		$this->load->view('login1/login/footer');
 		$this->Profilemodel->closeConn();
		 }

public function reject() //called from view_profile_verification.php
	{
		try{  //audit
			$this->lib_csrf->csrf_verify();  
			$response['error']=false;  
			$user_data=unserialize($this->session->secret);
			$rejection_data=json_decode($this->input->post('rejection_data'),True);
			$rejection_data['entry_on']=date("Y-m-j H:i:s");
			$rejection_data['entry_by']=$user_data[0]->ipasid;
			
			$is_valid=$this->form_validation->validate_data($rejection_data,'profile_rejection');   
			if(!$is_valid)   
	 			throw new Exception($this->form_validation->error_string());  
	 		else  
	 		{
	 		$this->Profilemodel->reject_profile($rejection_data);
			$this->email_to_emp($rejection_data['emp_mail'],$rejection_data['admin_name'],$rejection_data['admin_desig'],'R');
			$this->Profilemodel->closeConn();
			
			$this->session->set_userdata('selected_dte',$rejection_data['selected_dir_id']);
			}
		} //end of try
		catch(Exception $e)  //audit
		{
			$response['error']=true;
			$response['error_msg']=$e->getMessage();
		}  //end of catch   
			// $response = 'OK';
			// echo json_encode($response);
			$response['csrf_token']=$this->lib_csrf->get_csrf_hash();  
			echo json_encode($response);
		}

public function emp_profile_verify() //called from view_profile_verification.php
	{
		try{  //audit
			$this->lib_csrf->csrf_verify();  
			$response['error']=false;  
			$user_data=unserialize($this->session->secret);
			$verification_data=json_decode($this->input->post('verification_data'),True);
			$verification_data['entry_on']=date("Y-m-j H:i:s");
			$verification_data['entry_by']=$user_data[0]->ipasid;
			$is_valid=$this->form_validation->validate_data($verification_data,'profile_verification');   
			if(!$is_valid) //audit
	 			throw new Exception($this->form_validation->error_string()); //audit
	 		else //audit
	 		{
			$this->Profilemodel->verify_profile($verification_data);
			$this->email_to_emp($verification_data['emp_mail'],$verification_data['admin_name'],$verification_data['admin_desig'],'V');
			$this->Profilemodel->closeConn();
			$this->session->set_userdata('selected_dte',$verification_data['selected_dir_id']);
			}
		} //end of try
		catch(Exception $e)   
		{
			$response['error']=true;
			$response['error_msg']=$e->getMessage();
		}  //end of catch   

			//$response = 'OK';
			
			$response['csrf_token']=$this->lib_csrf->get_csrf_hash(); //audit
			echo json_encode($response);
		}

public function email_to_emp($emp_mail,$admin_name,$admin_desig,$status)  

 	{
 		$from_email = "pass@rdso.railnet.gov.in"; 
	    $config = array(
	    'protocol'  => 'smtp',
	    'smtp_host' => 'ssl://email.gov.in',
	    'smtp_port' => '465',
	    'smtp_user' => 'pass.rdsor@nic.in',
	    'smtp_pass' => 'A@aBC%13',
	    'smtp_crypto' => 'security',
	    'mailtype'  => 'html', 
	    'charset'   => 'utf-8',
	    'newline'   => "\r\n",
	    'crlf' => "\r\n",
	    'wordwrap' => TRUE
	    );
	    $this->load->library('email');
	    $this->email->initialize($config);
	    $this->email->from($from_email, 'RDSO-IT Applications'); 
	    if ($status== 'R')
	    {
	    	 $this->email->subject('Profile Rejection');
	    	 $this->email->message('Your profile has been rejected by the Establishment section. You may contact '. $admin_name. ','.$admin_desig.' of Establishment section.'); 
	    }
	   
		 else if($status== 'V')
	    {
	    	 $this->email->subject('Profile Verification');
	    	 $this->email->message('Your profile has been verified by the '. $admin_name. ','.$admin_desig.' of Establishment section'); 
	    }
		 
	   
	    $this->email->to($emp_mail);
	    $this->email->cc($from_email);
		$error=$this->email->send();
 	}	
		

			
}
?>
