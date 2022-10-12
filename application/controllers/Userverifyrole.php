<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Userverifyrole extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         $this->load->database();
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
             $this->lib_csrf->csrf_set_session();
			
		}
    }
public function index()
	{
		$this->load->model('adminrole/Verifyusermodel');		
        $data['record1'] = null;
		$data['record1'] = html_escape($this->Verifyusermodel->getdirctRecords());
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu);
    	$this->load->view('login1/adminrole/userverifyrole',$data);
		$this->load->view('login1/login/footer');
	}
	public function selectemp()
	{ 
		$this->lib_csrf->csrf_verify();
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('direc','direc' , 'required');
	    $this->form_validation->set_rules('typeuser','typeuser' , 'required');
	   if ($this->form_validation->run())
	   {
		
	        $this->load->model('adminrole/Verifyusermodel');
            $data['records'] = html_escape($this->Verifyusermodel->getverifyuser());
		    $data['record1'] = html_escape($this->Verifyusermodel->getdirctRecords());
		    $this->load->model('login/Loginmodel');
	        $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	        $this->load->view('login1/login/header',$umenu);
    	    $this->load->view('login1/adminrole/userverifyrole',$data);
		    $this->load->view('login1/login/footer');

}
else
{
	    $this->load->model('adminrole/Verifyusermodel');
		$data['record1'] = html_escape($this->Verifyusermodel->getdirctRecords());
    	$this->load->model('login/Loginmodel');
	    $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	    $this->load->view('login1/login/header',$umenu);
    	$this->load->view('login1/adminrole/userverifyrole',$data);
		$this->load->view('login1/login/footer');
}
	}
public function verify($login_id,$csrf_token)
	{
		 $this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $id= $this->input->post('loginid');
	  $this->load->model('adminrole/Verifyusermodel');
	// echo $login_id;exit;
	//verifyuser
	if( $this->Verifyusermodel->verifyuser($login_id)) 	
  		  {
		 $this->load->model('adminrole/Verifyusermodel');
		if($this->Verifyusermodel->sendmail($login_id))
			{
            
         if($this->email->send()) 
		 {
			 unset ($_SESSION['password']);
             $this->session->set_flashdata("email_sent","Email sent successfully and user verify successfully."); 
	         redirect('Userverifyrole/index');
		 
		 }
         elseif (!$this->email->send()) 
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
	    // echo $this->email->print_debugger(); 
          redirect('Userverifyrole/index');
		 }
           
		   }
		  else
		  {
           $this->load->model('adminrole/Verifyusermodel');			  
	       $data['records'] = html_escape($this->Verifyusermodel->getverifyuser());
		    $data['record1'] = html_escape($this->Verifyusermodel->getdirctRecords());
		    $this->load->model('login/Loginmodel');
	        $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	        $this->load->view('login1/login/header',$umenu);
    	    $this->load->view('login1/adminrole/userverifyrole',$data);
		    $this->load->view('login1/login/footer');
    	
		  }	 
	}  
		
}
public function reject()
	{
		 $this->lib_csrf->csrf_verify();
	 if (isset($_POST['Reject']))  {
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('reason','reason' , 'required|regex_match[/^[a-z0-9\. ,]*$/i]');
	
	     if ($this->form_validation->run()==FALSE)
		  
{
	  $this->session->set_flashdata("email_sent","Sorry!! User not rejected.Please try agail..");
	  redirect('Userverifyrole/index');
}  else
	   { 
		
		$login_id=$this->input->post('ipasid');
		$this->load->model('adminrole/Verifyusermodel');
	// echo $login_id;exit;
	if( $this->Verifyusermodel->rejectuser($login_id)) 	
  		  {
		$this->load->model('adminrole/Verifyusermodel');
		if($this->Verifyusermodel->sendmailreject($login_id))
			{
            
         if($this->email->send()) 
		 {
			 unset ($_SESSION['password']);
         $this->session->set_flashdata("email_sent","User is rejected and Email sent to his email ID."); 
	        $this->load->model('adminrole/Verifyusermodel');			  
	      //  $data['records'] = $this->Verifyusermodel->getverifyuser();
		    $data['record1'] = $this->Verifyusermodel->getdirctRecords();
		    $this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu);
    	    $this->load->view('login1/adminrole/userverifyrole',$data);
		    $this->load->view('login1/login/footer');
		 
		 }
         elseif (!$this->email->send()) 
		 {
            $this->session->set_flashdata("email_sent","Error in sending Email."); 
	    // echo $this->email->print_debugger(); 
            $this->load->model('adminrole/Verifyusermodel');			  
	       // $data['records'] = $this->Verifyusermodel->getverifyuser();
		    $data['record1'] = $this->Verifyusermodel->getdirctRecords();
		    $this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu);
    	    $this->load->view('login1/adminrole/userverifyrole',$data);
		    $this->load->view('login1/login/footer');
		 }	  
		
		  } }
		  else
		  {	
	        $this->session->set_flashdata("email_sent","Sorry!! User not rejected.Please try agail."); 
	        $this->load->model('adminrole/Verifyusermodel');			  
	       // $data['records'] = $this->Verifyusermodel->getverifyuser();
		    $data['record1'] = $this->Verifyusermodel->getdirctRecords();
		    $this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu);
    	    $this->load->view('login1/adminrole/userrejectreason',$data);
		    $this->load->view('login1/login/footer');
		  } 	
		  } 		
	}	}
    	public function getdetail($login_id,$csrf_token)	       
	{    
	       $this->lib_csrf->csrf_verify_with_param($csrf_token);
	        //$ipasid=  $this->uri->segment(3);
	   		$this->load->model('adminrole/Modifynonverify');
            $data['records'] = html_escape($this->Modifynonverify->getuserdetail($login_id));
			//print_r($data['records']);exit;
		    $data['record1'] = html_escape($this->Modifynonverify->getdirctRecords());
			$data['record2'] = html_escape($this->Modifynonverify->getdesgRecords());
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	        $this->load->view('login1/login/header',$umenu);
		    $this->load->view('login1/adminrole/userrejectreason',$data);
			$this->load->view('login1/login/footer');
	}	
   public function nonrdsoverify($aadhar_no,$csrf_token)
	{
          //$aadhar=  $this->uri->segment(3);
          $this->load->model('adminrole/Verifyusermodel');		
          $data['record1'] = html_escape($this->Verifyusermodel->getdirctRecords());		 
		  $this->load->model('admin/Verifyuser');
		  $data['appmaster'] = html_escape($this->Verifyuser->appmaster());
		  $data['detail'] = html_escape($this->Verifyuser->nonrdsodetail($aadhar_no));
          $type	=$this->session->userdata('login');		   
		  $this->load->model('login/Loginmodel');
	      $umenu['menu'] = $this->Loginmodel->menumaster();
	      $this->load->view('login1/login/header',$umenu); 
		  $this->load->view('login1/adminrole/verifynonrdso',$data);
	      $this->load->view('login1/login/footer');
		

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
         redirect('Userverifyrole/index'); 		   
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
	      redirect('Userverifyrole/index');
		 
		 }
         elseif (!$this->email->send()) 
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
	     //echo $this->email->print_debugger(); 
         redirect('Userverifyrole/index');      		  }
		 
		  }	 
	}  
      }	
	}
	}	
}
?>
