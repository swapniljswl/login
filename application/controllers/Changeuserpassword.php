<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Changeuserpassword extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // load Session Library
        $this->load->library('session');
		$id=$this->session->userdata('userid');
		//echo $id;exit;
         if(!$this->session->userdata('userid'))
		{
			$this->load->driver('cache'); # add
            $this->session->sess_destroy(); # Change
            $this->cache->clean();  # add
             redirect(base_url('user_login')); # Your default controller name 
		   
            ob_clean();
			
		}
		$this->lib_csrf->csrf_set_session();
        // load url helper
		 date_default_timezone_set('Asia/Calcutta');
		 $this->load->helper(array('email'));
         $this->load->library(array('email'));
         $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
    }

	 
	public function index()
	{
         $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/adminrole/userchangepassword');
		 $this->load->view('login1/login/footer');
	}
	public function changepwd()
	{
	  if($this->input->post('Submit'))
{ 
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('ipasno','Emp No/Aadhar No' , 'required|min_length[11]|max_length[12]|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('npassword','new password' , 'required|min_length[5]');
	   $this->form_validation->set_rules('cpassword','confirmed password' , 'required|min_length[5]|matches[npassword]');
	   if ($this->form_validation->run()==FALSE)
	   {
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/adminrole/userchangepassword');
		 $this->load->view('login1/login/footer');
		  }
		  else
		  {	
	        
	        $ipasno=$this->input->post('ipasno');
	      // echo $ipasno;exit;
	     //  $oldpwd=$this->input->post('opassword');
		  $newpwd=md5($this->input->post('npassword'));
	     //  $newpwd=$this->input->post('npassword');
		  
			//echo $ipasno; 
		  $this->load->model('adminrole/Modeluserchpwd');
		  if( $this->Modeluserchpwd->valid_pwd($ipasno))
		  { 
			 $this->load->model('adminrole/Modeluserchpwd');
            if($this->Modeluserchpwd->chg_pwd($ipasno,$newpwd))
			{   
				 if($this->email->send()) 
		        {  
            $this->load->library('session');
			$this->session->set_flashdata('chpwd_success','Congrats !  password changed successfully.');
			// $this->load->view('login1/adminrole/userchangepassword');
			redirect('Changeuserpassword/index');
			   }
			   else
			   {   echo $this->email->print_debugger(); 
				 $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Email not send successfully.');
			 //$this->load->view('login1/adminrole/userchangepassword'); 
			 redirect('Changeuserpassword/index');
			   }
			}
             else
			 {
			 $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry !  password not changed. Please enter correct detail.');
			// $this->load->view('login1/adminrole/userchangepassword');
			 redirect('Changeuserpassword/index');
			 }				 
    	 //  echo "yes";
		  }
		 else {
		 	 $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Data Not Found Or Not Registered  .');
		   // $this->load->view('login1/adminrole/userchangepassword');
		     redirect('Changeuserpassword/index');
		 	
	   }
	
		
}
}
	  if($this->input->post('Detail'))
{ 
 	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('ipasno','Emp No/Aadhar No' , 'required|min_length[11]|max_length[12]');
	   if ($this->form_validation->run()==FALSE)
	   {
		     $this->load->model('login/Register');
             $data['records'] = html_escape($this->Register->getdesgRecords());
			  $this->load->model('login/Loginmodel');
	          $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	         $this->load->view('login1/login/header',$umenu);
			 $this->load->view('login1/adminrole/userchangepassword',$data);
             $this->load->view('login1/login/footer');			 
		
		  }
		  else
		  {	
	       $ipasno=$this->input->post('ipasno');
			 $this->load->model('adminrole/Modeluserchpwd');
		  if( $this->Modeluserchpwd->getdetail($ipasno))
		  {
			 $this->load->library('session');
			  $this->session->set_flashdata('chpwd_success','Sorry ! Data Not Found Or Not Registered  .');
			 $this->load->model('login/Register');
             $data['records'] = $this->Register->getdesgRecords();
			 $this->load->model('login/Loginmodel');
	         $umenu['menu'] = $this->Loginmodel->menumaster();
	         $this->load->view('login1/login/header',$umenu);   
			 $this->load->view('login1/adminrole/userchangepassword',$data);
             $this->load->view('login1/login/footer');			 
		  }
		  else {
		 	 $this->load->library('session');
			 $this->load->model('login/Loginmodel');
	         $umenu['menu'] = $this->Loginmodel->menumaster();
	         $this->load->view('login1/login/header',$umenu);
			 $this->load->view('login1/adminrole/userchangepassword');
			 $this->load->view('login1/login/footer');
	       } 
	
	}


}
}
public function empdetail()
	{
	   $ipasno=$this->input->post('ipasno'); 
			//echo $ipasno;exit; 
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('ipasno','Emp No/Aadhar No' , 'required||min_length[11]|max_length[12]');
	   if ($this->form_validation->run()==FALSE)
	   {
		     $this->load->model('login/Register');
             $data['records'] = $this->Register->getdesgRecords();
			 $this->load->model('login/Loginmodel');
	         $umenu['menu'] = $this->Loginmodel->menumaster();
	         $this->load->view('login1/login/header',$umenu);
			 $this->load->view('login1/adminrole/userchangepassword',$data);
             $this->load->view('login1/login/footer');			 
		
		  }
		  else
		  {	
	       
			 $this->load->model('adminrole/Modeluserchpwd');
		  if( $this->Modeluserchpwd->getdetail($ipasno))
		  {
			 $this->load->library('session');
			  $this->session->set_flashdata('chpwd_success','Sorry ! Data Not Found Or Not Registered .');
			 $this->load->model('login/Register');
             $data['records'] = $this->Register->getdesgRecords();
			  $this->load->model('login/Loginmodel');
	         $umenu['menu'] = $this->Loginmodel->menumaster();
	         $this->load->view('login1/login/header',$umenu);
			 $this->load->view('login1/adminrole/userchangepassword',$data); 
             $this->load->view('login1/login/footer');			 
		  }
		  else {
		 	 $this->load->library('session');
			  $this->load->model('login/Loginmodel');
	         $umenu['menu'] = $this->Loginmodel->menumaster();
	         $this->load->view('login1/login/header',$umenu);
			 $this->load->view('login1/adminrole/userchangepassword');
			  $this->load->view('login1/login/footer');
	       } 
	
	}
}
}
?>
