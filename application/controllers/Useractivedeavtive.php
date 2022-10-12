<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Useractivedeavtive extends CI_Controller {
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
		$this->load->model('adminrole/Useractdeamodel');
		
         $data['record1'] = null;
//  if($query){
 //  $data['record1'] =  $query;
//  }
		$data['record1'] = html_escape($this->Useractdeamodel->getdirctRecords());
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	    $this->load->view('login1/login/header',$umenu);
    	$this->load->view('login1/adminrole/useractivedeact',$data);
		$this->load->view('login1/login/footer');
	}
	public function selectemp()
	{
		 $this->lib_csrf->csrf_verify();
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('direc','direc' , 'required');
	    $this->form_validation->set_rules('typeuser','typeuser' , 'required');
		$this->form_validation->set_rules('user','user' , 'required');
	   if ($this->form_validation->run())
	   {
		    $typeuser=  $this->input->post('typeuser');
			$user= $this->input->post('user');
			$this->load->model('adminrole/Useractdeamodel');
            $data['records'] = html_escape($this->Useractdeamodel->getuser($typeuser));
		    $data['record1'] = html_escape($this->Useractdeamodel->getdirctRecords());
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	        $this->load->view('login1/login/header',$umenu);
			if ($user=='V') {
		    $this->load->view('login1/adminrole/useractivedeact',$data); }
		    elseif ($user=='R') {
		    $this->load->view('login1/adminrole/userreject',$data); }
			$this->load->view('login1/login/footer');

}
else
{
	 redirect('Useractivedeavtive/index');
}
	}	
	public function deactive($login_id,$csrf_token)
	{
	  $this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $this->load->model('adminrole/Useractdeamodel');
	if( $this->Useractdeamodel->deactive($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','User deactiveted successfully.');
			redirect('Useractivedeavtive/index');			
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','Sorry ! User not deactiveted .');
			 redirect('Useractivedeavtive/index');
		  
}
	} 
	
	public function active($login_id,$csrf_token)
	{
	  $this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $this->load->model('adminrole/Useractdeamodel');
	if( $this->Useractdeamodel->active($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','User activeted successfully.');
			redirect('Useractivedeavtive/index');	
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','Sorry ! User not activeted .');
			 redirect('Useractivedeavtive/index');
		  
}
	}
	public function nonrdsodeactive($aadhar_no)
	{
	 
	 $this->load->model('adminrole/Useractdeamodel');
	if( $this->Useractdeamodel->nonrdsodeactive($aadhar_no)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','User deactiveted successfully.');
			redirect('Useractivedeavtive/index');			
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','Sorry ! User not deactiveted .');
			 redirect('Useractivedeavtive/index');
		  
}
	}
public function nonrdsoactive($aadhar_no)
	{
	 
	 $this->load->model('adminrole/Useractdeamodel');
	if( $this->Useractdeamodel->nonrdsoactive($aadhar_no)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','User activeted successfully.');
			redirect('Useractivedeavtive/index');	
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','Sorry ! User not activeted .');
			 redirect('Useractivedeavtive/index');
		  
}
	}
public function verify($login_id)
	{
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
         $this->session->set_flashdata("role","Email sent successfully and user verify successfully."); 
	      redirect('Useractivedeavtive/index');
		 
		 }
         elseif (!$this->email->send()) 
		 {
         $this->session->set_flashdata("role","Error in sending Email."); 
	     //echo $this->email->print_debugger(); 
         redirect('Useractivedeavtive/index');      		  }
		
		  }	 
	} }
public function nonrdsoverify()
	{
         $aadhar=  $this->uri->segment(3);	
         $this->load->model('adminrole/Useractdeamodel');
		 $data['record1'] = $this->Useractdeamodel->getdirctRecords();		 
		 $this->load->model('admin/Verifyuser');
		 $data['appmaster'] = $this->Verifyuser->appmaster();
		 $data['detail'] = $this->Verifyuser->nonrdsodetail($aadhar); 		
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		  $this->load->view('login1/adminrole/verifynonrdso',$data);
		 $this->load->view('login1/login/footer');
		 

}
	
public function nonrdsoverify1()
	{
	 if($this->input->post('submit'))
{ 
$appid= $this->input->post('appid');
  if ($appid=='')
  {
         $this->session->set_flashdata("role","please select one of check box.");  
         redirect('Useractivedeavtive/index');		   
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
         $this->session->set_flashdata("role","Email sent successfully and user verify successfully."); 
	      redirect('Useractivedeavtive/index');
		 
		 }
         elseif (!$this->email->send()) 
		 {
         $this->session->set_flashdata("role","Error in sending Email."); 
	     //echo $this->email->print_debugger(); 
         redirect('Useractivedeavtive/index');     		  }
		
		  }	 
	}  
      }	
	}
	}
		public function getdetail($login_id,$csrf_token)	       
	{     
 //print_r($_POST);exit;
	//$ipasid=  $this->uri->segment(3);
	   		$this->load->model('adminrole/Modifynonverify');
            $data['records'] = html_escape($this->Modifynonverify->getuserdetail($login_id));
		    $data['record1'] = html_escape($this->Modifynonverify->getdirctRecords());
			$data['record2'] = html_escape($this->Modifynonverify->getdesgRecords());
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	        $this->load->view('login1/login/header',$umenu);
		    $this->load->view('login1/adminrole/updatenonverifydata',$data);
			$this->load->view('login1/login/footer');
	}
public function modify()
	{  
		 $this->lib_csrf->csrf_verify();
		 $usertype=$this->input->post('typeuser');
	   $this->load->library('form_validation');
	    if ($usertype=='1')
	   { $this->form_validation->set_rules('empno','Emp No' , 'required|exact_length[11]|regex_match[/^[a-z0-9\. ,]*$/i]');
         $this->form_validation->set_rules('desg','Designation' , 'required');   
		} 
		 elseif ($usertype=='2')
	    {
			$this->form_validation->set_rules('aadhar','Aadhar No' , 'required|numeric|exact_length[12]');
		}
	   $this->form_validation->set_rules('name','user name' , 'required|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|regex_match[/^[a-z0-9\. , @]*$/i]');
   	   $this->form_validation->set_rules('mobno','Mobile number' , 'required|numeric|exact_length[10]');       
	   $this->form_validation->set_rules('dte','Directorate' , 'required');
	
		if ($this->form_validation->run()==FALSE)
	   {
         $this->session->set_flashdata('role','Please enter the correct details.');
		 redirect('Useractivedeavtive/index');
       } 
	   else {
            $typeuser=$this->input->post('typeuser');
			 $name=$this->input->post('name');
			 $dte=$this->input->post('dte');
			if ($typeuser=='1')
			{ $empno=$this->input->post('empno');
             $desg=$this->input->post('desg');		}				
           if ($typeuser=='2')
			{ $empno=$this->input->post('aadhar'); }
			
			$email=$this->input->post('email');
			$mobno=$this->input->post('mobno');		 
			$this->load->model('adminrole/Modifynonverify');
           if($this->Modifynonverify->modifydata($empno,$typeuser,$desg,$name,$dte,$email,$mobno))
		   {
    	    $this->session->set_flashdata('role','Congrats!! Data modified successfully.');
		    redirect('Useractivedeavtive/index');
		   }
		   else
		   {
		 $this->session->set_flashdata('role','Sorry!! Please try again.');
		 redirect('Useractivedeavtive/index');  
		   }
	} 
	}	
}
?>
