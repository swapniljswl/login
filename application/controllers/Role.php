<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Role extends CI_Controller {
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
    }

	 
	public function index()
	{
		$this->load->model('adminrole/Userrolemodel');
		
  $data['record1'] = null;
//  if($query){
 //  $data['record1'] =  $query;
//  }
		$data['record1'] = html_escape($this->Userrolemodel->getdirctRecords());
		$data['record2'] = html_escape($this->Userrolemodel->getroleRecords());
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	    $this->load->view('login1/login/header',$umenu);
    	$this->load->view('login1/adminrole/role',$data);
		$this->load->view('login1/login/footer');
	}
	public function selectemp()
	{
		 $this->lib_csrf->csrf_verify();
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('direc','direc' , 'required');
	    $this->form_validation->set_rules('role','role' , 'required');
	   if ($this->form_validation->run())
	   {
			 $role=$this->input->post('role');
			 $this->session->set_userdata('role', $role);
	//echo $role;exit;
	        $this->load->model('adminrole/Userrolemodel');
            $data['records'] = html_escape($this->Userrolemodel->getuser());
		    $data['record1'] = html_escape($this->Userrolemodel->getdirctRecords());
			$data['record2'] = html_escape($this->Userrolemodel->getroleRecords());
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	        $this->load->view('login1/login/header',$umenu);
		    $this->load->view('login1/adminrole/role',$data);
            $this->load->view('login1/login/footer');
}
else
{
	      $this->load->library('session');
		  $this->session->set_flashdata('arole','No Data found or select one of dropdown');
	      redirect('role/index');
}
	}	
	public function role($login_id,$csrf_token)
	{
	  $this->lib_csrf->csrf_verify_with_param($csrf_token);
	$role =$this->session->userdata('role');
     if ($role=='2'){ $assign='Sub Admin';} 
	 elseif ($role=='3'){ $assign='Admin';}
	 elseif ($role=='4'){ $assign='Dir Admin';}
	 elseif ($role=='5'){ $assign='Profile Admin';}
	 elseif ($role=='6'){ $assign='Family Admin';}
	 $this->load->model('adminrole/Userrolemodel');
	if( $this->Userrolemodel->role($login_id)) 	
  		  { // echo $role;exit;
			 if ($role!='3') 
			 {            	 
		    $this->load->library('session');
			$this->session->set_flashdata('arole',$assign.' Role is assigned to User.'  );
			$this->session->unset_userdata('role');	
			redirect('role/index');	
			 }
			 elseif ($role=='3') 
			 {
			$this->load->library('session');
			$this->session->set_flashdata('login_failed','Admin role assigned . Your Admin role is revoked.');
			$this->session->unset_userdata('role');	
			redirect('user_login');	
			 }
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('arole','sorry ! No role assigned to User.');
			 redirect('role/index');
		  
}
	}
	
}
?>
