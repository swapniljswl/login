<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Userverify extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
		 $type	=$this->session->userdata('login');
		
		 	if ((!$this->session->userdata('secret')  ))
		{
			$this->load->driver('cache'); # add
            $this->session->sess_destroy(); # Change
            $this->cache->clean();  # add
             redirect(base_url('user_login')); # Your default controller name 
		   
            ob_clean();
            $this->lib_csrf->csrf_set_session();
			
		} 
    }

	 
	public function index()
	{		
	     $type	=$this->session->userdata('login');  
		 if ($type=='sso') {
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/admin/userverify');
		 $this->load->view('login1/login/footer');
		 } elseif ($type=='dgdash') {
			 	$this->load->view('login1/admin/header.php');
		        $this->load->view('login1/admin/userverify');
		        $this->load->view('login1/admin/footer.php');
			 
			}
	}
	public function selectemp()
	{
		 $this->lib_csrf->csrf_verify();
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('direc','direc' , 'required');
	
	   if ($this->form_validation->run())
	   {
		   $rdso= $this->input->post('direc');
		  $this->load->model('admin/Verifyuser');
	      $data['verify']=$this->Verifyuser->getverifyuser($rdso);
		   $type	=$this->session->userdata('login');		   
		  if ($type=='sso') {
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/admin/userverify',$data);
		 $this->load->view('login1/login/footer'); 
		  }  elseif ($type=='dgdash') {
          	$this->load->view('login1/admin/header.php');
		    $this->load->view('login1/admin/userverify',$data);
		    $this->load->view('login1/admin/footer.php');
		  }
}
else
{
	   $this->session->set_flashdata("email_sent","Data not found."); 
	   redirect('Userverify/index');
}
	}
	public function verify($login_id,$csrf_token)
	{
		 $this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $id= $this->input->post('loginid');
	 $this->load->model('admin/Verifyuser');
	// echo $login_id;exit;
	
	if( $this->Verifyuser->verifyuser($login_id)) 	
  		  {
		$this->load->model('admin/Verifyuser');
		if($this->Verifyuser->sendpassword($login_id))
			{
            
         if($this->email->send()) 
		 {
		unset ($_SESSION['password']);
         $this->session->set_flashdata("email_sent","Email sent successfully and user verify successfully."); 
	      redirect('Userverify/index');
		 
		 }
         elseif (!$this->email->send()) 
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
	     //echo $this->email->print_debugger(); 
         redirect('Userverify/index');      		  }
		 
		  }	 
	}  
		
}
public function nonrdsoverify($aadhar_no,$csrf_token)
	{
		 $this->lib_csrf->csrf_verify_with_param($csrf_token);
         //$aadhar=  $this->uri->segment(3);	        
		 $this->load->model('admin/Verifyuser');
		 $data['appmaster'] = html_escape($this->Verifyuser->appmaster());
		 $data['detail'] = html_escape($this->Verifyuser->nonrdsodetail($aadhar_no));
          $type	=$this->session->userdata('login');		   
		  if ($type=='sso') {		 
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu); 
		 $this->load->view('login1/admin/verifynonrdso',$data);
	     $this->load->view('login1/login/footer');
		  } elseif ($type=='dgdash') {
          	$this->load->view('login1/admin/header.php');
		    $this->load->view('login1/admin/verifynonrdso',$data);
		    $this->load->view('login1/admin/footer.php');
		  }

}
	

public function nonrdsoverify1()
	{
		 $this->lib_csrf->csrf_verify();
				  if($this->input->post('submit'))
{ 
$appid= $this->input->post('appid');
  if ($appid=='')
  {
         $this->session->set_flashdata("email_sent","please select one of check box.");  
         redirect('Userverify/index'); 		   
		  }
		  else{
		//$data= $this->input->post();
		$appid= $this->input->post('appid');
		$aadhar_no= $this->input->post('aadharno');
		// print_r($data);exit;
	    $this->load->model('admin/Verifyuser'); 
	if($this->Verifyuser->verifynonuser($aadhar_no,$appid)) 	
  		  {
		
		if($this->Verifyuser->sendpassword($aadhar_no))
			{
            
         if($this->email->send()) 
		 {
		unset ($_SESSION['password']);
         $this->session->set_flashdata("email_sent","Email sent successfully and user verify successfully."); 
	      redirect('Userverify/index');
		 
		 }
         elseif (!$this->email->send()) 
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
	     //echo $this->email->print_debugger(); 
         redirect('Userverify/index');      		  }
		 
		  }	 
	}  
      }	
	}
	}
public function reject()
	{
		 $this->lib_csrf->csrf_verify();
	$this->load->library('form_validation');
	$this->form_validation->set_rules('reason','reason' , 'required|regex_match[/^[a-z0-9\. ,]*$/i]');
	
	     if ($this->form_validation->run()==FALSE)
		  
{
	  $this->session->set_flashdata("email_sent","Sorry!! User not rejected.Please try agail..");
	  redirect('Userverify/index');
}  else
	   {	
	 $login_id=$this->input->post('ipasid');
     $this->load->model('admin/Verifyuser');
	//echo $login_id;exit;
	if( $this->Verifyuser->rejectuser($login_id)) 	
  		  {
		$this->load->model('admin/Verifyuser');
		if($this->Verifyuser->sendmailreject($login_id))
			{
            
         if($this->email->send()) 
		 {
		 unset ($_SESSION['password']);
         $this->session->set_flashdata("email_sent","User is rejected and Email sent to his email ID."); 
	     redirect('Userverify/index');
		 
		 
		 }
         elseif(!$this->email->send()) 
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
	     redirect('Userverify/index');}		
		  }
		  else
		  {	
	    $this->load->model('admin/Verifyuser');
        $data['verify']=$this->Verifyuser->getverifyuser(); 
		$this->load->view('login1/admin/userverify',$data);    	
		  }	 
	}  
		
	} }
 	public function getdetail($login_id,$csrf_token)	       
	{ 
		$this->lib_csrf->csrf_verify_with_param($csrf_token);
	        // $login_id=  $this->uri->segment(3);			
	   		$this->load->model('admin/Verifyuser');
            $data['records'] = html_escape($this->Verifyuser->getuser($login_id));
        	 $type	=$this->session->userdata('login');		   
		     if ($type=='sso') {
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu);
		    $this->load->view('login1/admin/userrejectreason',$data);
			$this->load->view('login1/login/footer');
			 } elseif ($type=='dgdash') {
          	$this->load->view('login1/admin/header.php');
		    $this->load->view('login1/admin/userrejectreason',$data);
		    $this->load->view('login1/admin/footer.php');
		  }
	}

}
?>
