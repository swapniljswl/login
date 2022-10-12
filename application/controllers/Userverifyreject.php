<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Userverifyreject extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
		  if ((!$this->session->userdata('secret')))
		{
			$this->load->driver('cache'); # add
            $this->session->sess_destroy(); # Change
            $this->cache->clean();  # add
            redirect(base_url('login')); # Your default controller name 		   
             ob_clean();

		}
		 $this->lib_csrf->csrf_set_session();
    }

	 
	public function index()
	{
		  $type	=$this->session->userdata('login');  
		 if ($type=='sso') {
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/admin/userreject');
		 $this->load->view('login1/login/footer');
		 } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/userreject');
		$this->load->view('login1/admin/footer.php');
		 }
			 
		
	}
		public function selectemp()
	{  
		 $this->lib_csrf->csrf_verify();
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('type','type' , 'required');
	    $this->form_validation->set_rules('user','user' , 'required');
	   if ($this->form_validation->run())
	   {
		  $rdso= $this->input->post('type');
		  $user= $this->input->post('user');
		  $this->load->model('admin/Verifyrejectuser');
	      $data['verify']=$this->Verifyrejectuser->getverifyuser($rdso,$user); 		
	      $this->load->model('login/Loginmodel');
	      $umenu['menu'] = html_escape($this->Loginmodel->menumaster());
	      $this->load->view('login1/login/header',$umenu);
		  if ($user=='V') {
		  $this->load->view('login1/admin/listverify',$data); }
		  elseif ($user=='R') {
		  $this->load->view('login1/admin/userreject',$data); }
		  $this->load->view('login1/login/footer.php');
			 
			}
     else
    {
	   $this->session->set_flashdata("email_sent","Data not found."); 
	   redirect('Userverifyreject/index');
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
	      redirect('Userverifyreject/index');
		 
		 }
         elseif (!$this->email->send()) 
		 {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
	     //echo $this->email->print_debugger(); 
         	      redirect('Userverifyreject/index');      		  }
		  else
		  {	
	    $this->load->model('admin/Verifyuser');
        $data['verify']=$this->Verifyuser->getverifyuser(); 
		$this->load->view('admin/Userverifyreject',$data);
    	  }
		  }	 
	} }
	public function deactive($login_id,$csrf_token)
	{
	 $this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $this->load->model('admin/Listactdeacdirmod');
	if( $this->Listactdeacdirmod->deactive($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('email_sent','User deactiveted successfully.');
			redirect('Userverifyreject/index');
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('email_sent','Sorry ! User not deactiveted .');
			 redirect('Userverifyreject/index');
		  
}
	} 
	
	public function active($login_id,$csrf_token)
	{
	  $this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $this->load->model('admin/Listactdeacdirmod');
	if( $this->Listactdeacdirmod->active($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('email_sent','User activeted successfully.');
			redirect('Userverifyreject/index');		  
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('email_sent','Sorry ! User not activeted .');
			redirect('Userverifyreject/index');
		  
}
	}
	public function nonrdsodeactive($aadhar_no,$csrf_token)
	{
	 $this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $this->load->model('admin/Listactdeacdirmod');
	if( $this->Listactdeacdirmod->nonrdsodeactive($aadhar_no)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('email_sent','User deactiveted successfully.');
			redirect('Userverifyreject/index');			
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('email_sent','Sorry ! User not deactiveted .');
			 redirect('Userverifyreject/index');
		  
}
	}
public function nonrdsoactive($aadhar_no,$csrf_token)
	{
	 $this->lib_csrf->csrf_verify_with_param($csrf_token);
	 $this->load->model('admin/Listactdeacdirmod');
	if( $this->Listactdeacdirmod->nonrdsoactive($aadhar_no)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('email_sent','User activeted successfully.');
			redirect('Userverifyreject/index');	
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('email_sent','Sorry ! User not activeted .');
			 redirect('Userverifyreject/index');
		  
}
	}
public function appprevnnrdso($aadhar_no,$csrf_token)
	{
		    // $aadhar_no= $this->uri->segment(3) ; 
		    $this->lib_csrf->csrf_verify_with_param($csrf_token); 
             $this->load->model('admin/appprevmodel');
             $data['records'] = html_escape($this->appprevmodel->getappdetail($aadhar_no));
			 $data['detail'] = $this->appprevmodel->checkverifyuser($aadhar_no);
            // print_r($data['detail']);exit;			 
		    $type	=$this->session->userdata('login');  
		 if ($type=='sso') {
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		   $this->load->view('login1/admin/appprevnonrdso',$data);
		 $this->load->view('login1/login/footer');
		 } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		  $this->load->view('login1/admin/appprevnonrdso',$data);
		$this->load->view('login1/admin/footer.php');
		 }
	
	}
	public function ADD()
	{
	 $this->lib_csrf->csrf_verify();
	  $data=$this->input->post();
	//  print_r($data);exit;
     $this->load->model('admin/appprevmodel');
	 if($this->appprevmodel->addapp($data))
	 {
	 $this->session->set_flashdata("email_sent","Congrates! Application  Added Successfully."); 
     redirect('Userverifyreject/index');		 
	 }
	 else {
	 $this->session->set_flashdata("email_sent","Sorry! Application is not Added.");
     redirect('Userverifyreject/index');				 
 
	}
	}	 
	public function deleteapp($id,$csrf_token)
	{
	 $this->lib_csrf->csrf_verify_with_param($csrf_token); 
	 //$id= $this->uri->segment(3) ;
	 $this->load->model('admin/appprevmodel');
	// echo $login_id;exit;
	if( $this->appprevmodel->deleteapp($id)) 	
  		  {
	$this->session->set_flashdata("email_sent","Congrates! Application  Deleted Successfully."); 
          redirect('Userverifyreject/index');	         	
		  }
		  else
		  {	
	      $this->session->set_flashdata("email_sent","Sorry! Application is not Deleted."); 
          redirect('Userverifyreject/index');	   	
		  }	 
	}  
	public function Activeapp($id,$csrf_token)
	{
		 $this->lib_csrf->csrf_verify_with_param($csrf_token); 
	 //$id= $this->uri->segment(3) ;
	 $this->load->model('admin/appprevmodel');
	// echo $login_id;exit;
	if( $this->appprevmodel->Activeapp($id)) 	
  		  {
	$this->session->set_flashdata("email_sent","Congrates! Application  Added Successfully."); 
          redirect('Userverifyreject/index');	         	
		  }
		  else
		  {	
	      $this->session->set_flashdata("email_sent","Sorry! Application is not Added."); 
          redirect('Userverifyreject/index');	   	
		  }	 
	}
    public function getdetail($login_id,$csrf_token)	       
	{     
 //print_r($_POST);exit;
	        // $ipasid=  $this->uri->segment(3);
	   		$this->load->model('admin/Modifynonverify');
            $data['records'] = html_escape($this->Modifynonverify->getuserdetail($login_id));
			//$data['records'] = $this->Modifynonverify->getuserdetail($ipasid);
		    $data['record1'] = html_escape($this->Modifynonverify->getdirctRecords());
			$data['record2'] = html_escape($this->Modifynonverify->getdesgRecords());			 
		      $type	=$this->session->userdata('login');  
		 if ($type=='sso') {
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		   $this->load->view('login1/admin/updatenonverifydata',$data);
		 $this->load->view('login1/login/footer');
		 } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/updatenonverifydata',$data);
		$this->load->view('login1/admin/footer.php');
		 }
		  
		   
		
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
	   $this->form_validation->set_rules('name','user name' , 'required|max_length[100]|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('email', 'Email ID', 'trim|required|regex_match[/^[a-z0-9\. , @]*$/i]|valid_email');
   	   $this->form_validation->set_rules('mobno','Mobile number' , 'required|numeric|exact_length[10]');       
	   $this->form_validation->set_rules('dte','Directorate' , 'required');
	
		if ($this->form_validation->run()==FALSE)
	   {
         $this->session->set_flashdata('email_sent','Please enter the correct details.');
		 redirect('Userverifyreject/index');
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
			$this->load->model('admin/Modifynonverify');
           if($this->Modifynonverify->modifydata($empno,$typeuser,$desg,$name,$dte,$email,$mobno))
		   {
    	    $this->session->set_flashdata('email_sent','Congrats!! Data modified successfully.');
		    redirect('Userverifyreject/index');
		   }
		   else
		   {
		 $this->session->set_flashdata('email_sent','Sorry!! Please try again.');
		 redirect('Userverifyreject/index');   
		   }
	} 
	}
	public function nonrdsoverify($aadhar_no,$csrf_token)
	{
         //$aadhar=  $this->uri->segment(3);	
          $this->lib_csrf->csrf_verify_with_param($csrf_token);        
		 $this->load->model('admin/Verifyuser');
		 $data['appmaster'] = $this->Verifyuser->appmaster();
		 $data['detail'] = $this->Verifyuser->nonrdsodetail($aadhar_no); 		
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
}
?>