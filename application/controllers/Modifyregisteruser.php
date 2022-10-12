<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Modifyregisteruser extends CI_Controller {
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
		 
		$this->load->model('adminrole/Modifynonverify');		
        $data['record1'] = null;
		$data['record1'] = $this->Modifynonverify->getdirctRecords();
		$this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu);
    	$this->load->view('login1/adminrole/modifynonverify',$data);
		$this->load->view('login1/login/footer');
			
	}
	public function selectemp()
	{
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('direc','direc' , 'required');
	    $this->form_validation->set_rules('typeuser','typeuser' , 'required');
	    if ($this->form_validation->run()==FALSE)
		  
{
	  redirect('Modifyregisteruser/index');
}  else
	   {
		   	  if($this->input->post('Submit'))
    { 
		    $typeuser=  $this->input->post('typeuser');
			$this->load->model('adminrole/Modifynonverify');
            $data['records'] = $this->Modifynonverify->getuser($typeuser);
		    $data['record1'] = $this->Modifynonverify->getdirctRecords();
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu);
		    $this->load->view('login1/adminrole/modifynonverify',$data);
			$this->load->view('login1/login/footer');
   }
   	   	 }
	}	
	public function getdetail()	       
	{     
 //print_r($_POST);exit;
	$ipasid=  $this->uri->segment(3);
	   		$this->load->model('adminrole/Modifynonverify');
            $data['records'] = $this->Modifynonverify->getuserdetail($ipasid);
		    $data['record1'] = $this->Modifynonverify->getdirctRecords();
			$data['record2'] = $this->Modifynonverify->getdesgRecords();
			$this->load->model('login/Loginmodel');
	        $umenu['menu'] = $this->Loginmodel->menumaster();
	        $this->load->view('login1/login/header',$umenu);
		    $this->load->view('login1/adminrole/updatenonverifydata',$data);
			$this->load->view('login1/login/footer');
	} 
	
	public function modify()
	{  
		 $usertype=$this->input->post('typeuser');
	   $this->load->library('form_validation');
	    if ($usertype=='1')
	   { $this->form_validation->set_rules('empno','Emp No' , 'required|exact_length[11]');
         $this->form_validation->set_rules('desg','Designation' , 'required');   
		} 
		 elseif ($usertype=='2')
	    {
			$this->form_validation->set_rules('aadhar','Aadhar No' , 'required|numeric|exact_length[12]');
		}
	   $this->form_validation->set_rules('name','user name' , 'required');
	   $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
   	   $this->form_validation->set_rules('mobno','Mobile number' , 'required|numeric|exact_length[10]');       
	   $this->form_validation->set_rules('dte','Directorate' , 'required');
	
		if ($this->form_validation->run()==FALSE)
	   {
         $this->session->set_flashdata('role','Please enter the correct details.');
		 redirect('Modifyregisteruser/index');
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
		    redirect('Modifyregisteruser/index');
		   }
		   else
		   {
		 $this->session->set_flashdata('role','Sorry!! Please try again.');
		 redirect('Modifyregisteruser/index');   
		   }
	} 
	}
	
	
}

?>
