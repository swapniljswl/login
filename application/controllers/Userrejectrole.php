<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Userrejectrole extends CI_Controller {
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
		$this->load->model('adminrole/Rejectusermodel');
        $data['verify']=$this->Rejectusermodel->getverifyuser(); 
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu);
		$this->load->view('login1/adminrole/userrejectrole',$data);
		$this->load->view('login1/login/footer');
	}
	public function verify($login_id)
	{
	  $id= $this->input->post('loginid');
	  $this->load->model('adminrole/Rejectusermodel');
	// echo $login_id;exit;
	//verifyuser
	if( $this->Rejectusermodel->verifyuser($login_id)) 	
  		  {
		 $this->load->model('adminrole/Rejectusermodel');
		if($this->Rejectusermodel->sendmail($login_id))
			{
            
         if($this->email->send()) 
		 {
			 unset ($_SESSION['password']);
         $this->session->set_flashdata("email_sent","Email sent successfully and user verify successfully"); 
	        $this->load->model('adminrole/Rejectusermodel');
            $data['records'] = $this->Rejectusermodel->getverifyuser();
		    $data['record1'] = $this->Rejectusermodel->getdirctRecords();
		    $this->load->view('login1/adminrole/userrejectrole',$data);
		 
		 }
         elseif (!$this->email->send()) 
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
	    // echo $this->email->print_debugger(); 
           $this->load->model('adminrole/Rejectusermodel');
            $data['records'] = $this->Rejectusermodel->getverifyuser();
		    $data['record1'] = $this->Rejectusermodel->getdirctRecords();
		    $this->load->view('login1/adminrole/userrejectrole',$data);
		 }
           
		   }
		  else
		  {
           $this->load->model('adminrole/Rejectusermodel');			  
	       $data['records'] = $this->Rejectusermodel->getverifyuser();
		    $data['record1'] = $this->Rejectusermodel->getdirctRecords();
		    $this->load->view('login1/adminrole/userrejectrole',$data);
    	
		  }	 
	}


}
}
?>
