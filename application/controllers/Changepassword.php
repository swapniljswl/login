<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Changepassword extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
		$id=$this->session->userdata('userid');
		//echo $id;exit;
        	if ((!$this->session->has_userdata('user')) and (!$this->session->has_userdata('secret')))
		{
			$this->load->driver('cache'); # add
            $this->session->sess_destroy(); # Change
            $this->cache->clean();  # add
             redirect(base_url('user_login')); # Your default controller name 
		   
            ob_clean();
			
		}
       	 $this->lib_csrf->csrf_set_session();
         $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
    }

	 
	public function index()
	{
    $this->load->model('login/Loginmodel');
	$umenu['menu'] = $this->Loginmodel->menumaster();
	$this->load->view('login1/login/header',$umenu); 
	$this->load->view('login1/changepassword');
	$this->load->view('login1/login/footer');
	}
	public function changepwd()
	{
	   $this->lib_csrf->csrf_verify();
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('opassword','old password' , 'required|min_length[5]');
	   $this->form_validation->set_rules('npassword','new password' , 'required|min_length[5]');
	   $this->form_validation->set_rules('cpassword','confirmed password' , 'required|min_length[5]|matches[npassword]');
	   if ($this->form_validation->run()==FALSE)
	   {
	   $this->load->model('login/Loginmodel');
	   $umenu['menu'] = $this->Loginmodel->menumaster();
	   $this->load->view('login1/login/header',$umenu); 
	   $this->load->view('login1/changepassword');
	   $this->load->view('login1/login/footer');
		//redirect("Changepassword/index");
		//echo validation_errors();
		  }
		  else
		  {	
	        $oldpwd=md5($this->input->post('opassword'));
	     //  $oldpwd=$this->input->post('opassword');
		  $newpwd=md5($this->input->post('npassword'));
	     //  $newpwd=$this->input->post('npassword');
		   $user_data=unserialize($this->session->secret);
		   $usertype = $user_data[0]->rdso_nonrdso;
		   if ($usertype=='1'){ $user_id = $user_data[0]->ipasid;}
		   elseif ($usertype=='2'){ $user_id = $user_data[0]->aadhar_no;}
			//echo $user_id; exit;
		  $this->load->model('login/modelchpwd');
		  if( $this->modelchpwd->valid_pwd($user_id,$oldpwd))
		  {
			$this->load->model('login/modelchpwd');
            if($this->modelchpwd->chg_pwd($user_id,$newpwd))
			{
             $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Congrats ! Your password changed successfully.');
			// $this->load->view('login1/changepassword');
			redirect('User_login');
			}
             else
			 {
			 $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Your password not changed. Please enter correct detail.');
			// $this->load->view('login1/changepassword');
			redirect('Changepassword/index');
			 }				 
    	 //  echo "yes";
		  }
		 else {
		 	 $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Please enter correct detail or enter valid old password.');
			// $this->load->view('login1/changepassword');
		 	redirect('Changepassword/index');
	   }
	
		
}

}
}
?>
