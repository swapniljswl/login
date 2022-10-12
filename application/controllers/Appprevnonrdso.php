<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Appprevnonrdso extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // load Session Library
        $this->load->library('session');
		$id=$this->session->userdata('userid');
		//echo $id;exit;
          if ((!$this->session->userdata('secret')  ))
		{
			$this->load->driver('cache'); # add
            $this->session->sess_destroy(); # Change
            $this->cache->clean();  # add
             redirect(base_url('user_login')); # Your default controller name 
		   
            ob_clean();
			
		}
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
		 $type	=$this->session->userdata('login');
	      if ($type=='sso') {
         $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		 $this->load->view('login1/admin/appprevnonrdso');
		 $this->load->view('login1/login/footer');
		  } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/appprevnonrdso');
		$this->load->view('login1/admin/footer.php');			 
			}
	}
	public function detail()
	{
	  if($this->input->post('Detail'))
{ 
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('aadharno','Aadhar No' , 'required|numeric|exact_length[12]');
	   if ($this->form_validation->run()==FALSE)
	   {
		 $this->session->set_flashdata("appprev","Enter valid Aadhar No"); 
         redirect('Appprevnonrdso/index');
		 }
		 else 
		 {    
			 $aadharno=$this->input->post('aadharno');
		     $this->load->model('admin/appprevmodel');
		  if($this->appprevmodel->checkverifyuser($aadharno))
		  {
		  $this->session->set_flashdata("appprev","User is not Verified or Registered."); 
          redirect('Appprevnonrdso/index');			  
		  }
		 else{
			 $aadharno=$this->input->post('aadharno');
		     $this->load->model('admin/appprevmodel');
             $data['records'] = $this->appprevmodel->getappdetail($aadharno);
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
		 }
      }
	  	  if($this->input->post('ADD'))
    { 
     $data=$this->input->post();
     $this->load->model('admin/appprevmodel');
	 if($this->appprevmodel->addapp($data))
	 {
	 $this->session->set_flashdata("appprev","Congrates! Application  Deleted Successfully."); 
     redirect('Appprevnonrdso/index');		 
	 }
	 else {
	 $this->session->set_flashdata("appprev","Sorry! Application is not Added.");
     redirect('Appprevnonrdso/index');		 
	 }
	}
	}
	public function ADD()
	{
	  if($this->input->post('ADD'))
    { 
			 
			 echo"hi";
			
			 
		     $this->load->model('admin/appprevmodel');
		  if($this->appprevmodel->checkverifyuser($aadharno))
		  {
		  $this->session->set_flashdata("appprev","User is not Verified or Registered."); 
          redirect('Appprevnonrdso/index');			  
		  }
		 else{
			 $aadharno=$this->input->post('aadharno');
		     $this->load->model('admin/appprevmodel');
             $data['records'] = $this->appprevmodel->getappdetail($aadharno);
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
		 }
      }
	
public function deleteapp()
	{
	 $id= $this->uri->segment(3) ;
	 $this->load->model('admin/appprevmodel');
	// echo $login_id;exit;
	if( $this->appprevmodel->deleteapp($id)) 	
  		  {
	$this->session->set_flashdata("appprev","Congrates! Application  Deleted Successfully."); 
          redirect('Appprevnonrdso/index');	         	
		  }
		  else
		  {	
	      $this->session->set_flashdata("appprev","Sorry! Application is not Deleted."); 
          redirect('Appprevnonrdso/index');	   	
		  }	 
	}  
	public function Activeapp()
	{
	 $id= $this->uri->segment(3) ;
	 $this->load->model('admin/appprevmodel');
	// echo $login_id;exit;
	if( $this->appprevmodel->Activeapp($id)) 	
  		  {
	$this->session->set_flashdata("appprev","Congrates! Application  Added Successfully."); 
          redirect('Appprevnonrdso/index');	         	
		  }
		  else
		  {	
	      $this->session->set_flashdata("appprev","Sorry! Application is not Added."); 
          redirect('Appprevnonrdso/index');	   	
		  }	 
	} 
		
}	
	


?>
