<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Addfamily extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        // load Session Library
        $this->load->library('session');
		  $this->load->library('form_validation');
         date_default_timezone_set('Asia/Calcutta'); 
        // load url helper
       $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
		 $this->load->library('session');
		$id=$this->session->userdata('userid');
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
		 $user_data=unserialize($this->session->user);
	     $user_id = $user_data[0]->login_id;
		 $this->load->model('login/Modelchprofile');
         $data['records'] = html_escape($this->Modelchprofile->getrelationdetail());
		 $data['userdetail'] =html_escape($this->Modelchprofile->getempdetail($user_id));
		 //print_r($data['userdetail']);exit;
		 $data['record'] = html_escape($this->Modelchprofile->getfamilydetail($user_id));
		 $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);
		  if (($data['record']) > 0)
		   {
		 $this->load->view('login1/veiwfamily',$data);
		 $this->load->view('login1/login/footer');
		   }
		   else
		   {
			   $this->load->view('login1/addfamily',$data);
			   $this->load->view('login1/login/footer');
		   }
	}
	public function addfamilydetail()
	{
		 
		    try   {
		    	//$this->lib_csrf->csrf_set_session();
		    	$this->lib_csrf->csrf_verify(); //audit
			 $user_data=unserialize($this->session->user);
	         $user_id = $user_data[0]->login_id;
			

		    $data=json_decode($this->input->post('family_data'),TRUE);
			if(empty($data))
				throw new Exception('fill all details.');
			$response['error']=false;
			
		    $this->load->model('login/Modelchprofile');
			
			$this->Modelchprofile->insertfamilydetail($data,$user_id);
			//echo "hi";exit;
			$this->Modelchprofile->closeConn();
		  } 
		// }
		catch(Exception $e){
			$response['error']=true;
			$response['error_msg']=$e->getMessage();
		} 
		
		
			$response['url']=base_url('Addfamily');
			echo json_encode($response);
		  
	}
	public function getfamily()
	{
	    	$id=$this->uri->segment(3);
			$user_data=unserialize($this->session->user);
	       $user_id = $user_data[0]->login_id;
		   $this->load->model('login/Modelchprofile');
		   $data['records'] = html_escape($this->Modelchprofile->getrelationdetail());
           $data['result'] = html_escape($this->Modelchprofile->getfamilyrec($id,$user_id));
		   $this->load->model('login/Loginmodel');
	       $umenu['menu'] = $this->Loginmodel->menumaster();
	       $this->load->view('login1/login/header',$umenu);
		   $this->load->view('login1/editfamily',$data); 
           $this->load->view('login1/login/footer');		   
		     
	}
	public function updatefamily()
	{
		 $this->lib_csrf->csrf_verify();
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('sno','sno' , 'required');
	   $this->form_validation->set_rules('ipas','ipas' , 'required');
	   $this->form_validation->set_rules('name','Name' , 'required|max_length[100]|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('dob','Dob' , 'required');
	   $this->form_validation->set_rules('sex','Gender' , 'required');
	   $this->form_validation->set_rules('relation','Relation' , 'required');
	   if ($this->form_validation->run()==FALSE)
	   {
		redirect('Addfamily/index');
	
		  }
		  else
		  {
	    	$data=$this->input->post();
			//print_r($data);
			$id=$this->input->post('sno');
			$ipas=$this->input->post('ipas');
			$dob=$this->input->post('dob');
		   $this->load->model('login/Modelchprofile');
		   if($this->Modelchprofile->updatefamily($id,$ipas,$data,$dob))
		   {
			 $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Congrats ! Your data changed successfully.');
			 redirect('Addfamily/index');
		   }
        else		   
		{
			 $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Try again.');
		     redirect('Addfamily/getfamily'); 	
		}
		  }		
	}
	public function addnewfamily()
	{
	   $this->lib_csrf->csrf_verify();
	   $this->load->library('form_validation');
	   //$this->form_validation->set_rules('sno','sno' , 'required');
	  // $this->form_validation->set_rules('ipas','ipas' , 'required');
	   $this->form_validation->set_rules('name','Name' , 'required|max_length[100]|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('dob','Dob' , 'required');
	   $this->form_validation->set_rules('sex','Gender' , 'required');
	   $this->form_validation->set_rules('relation','Relation' , 'required');
	   if ($this->form_validation->run()==FALSE)
	   {
		//  $data=$this->input->post();
        // print_r($data);exit;
		  $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Please fill all details.');  
		redirect('Addfamily/index');
		  }
		  else
		  {
	        $data=$this->input->post();
			 $dob=$this->input->post('dob');
			//print_r($data);exit;
	        $user_data=unserialize($this->session->user);
	        $user_id = $user_data[0]->login_id;
			//echo $user_id; 
		 	$this->load->model('login/Modelchprofile');
            if($this->Modelchprofile->addnewmember($user_id,$data,$dob))
			{
             $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Congrats ! New member added successfully.');
		     redirect('Addfamily/index');
			}
             else
			 {
			 $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Please enter correct detail.');
			 redirect('Addfamily/index');
			 }				 
		  }
}
public function deletefamily()
	{
	 
	 $id=$this->uri->segment(3);
	 $this->load->model('login/Modelchprofile');
	if( $this->Modelchprofile->deactivefamily($id)) 	
  		  {
		    $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Congrats ! Member deactivate successfully.');
		    redirect('Addfamily/index');
		  }
		  else
		  {	
	        $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Please try again.');
		    redirect('Addfamily/index');
    	
		  }	 
	}  
	public function activate()
	{
		$this->lib_csrf->csrf_verify();
	 $id=$this->uri->segment(3);
	 $this->load->model('login/Modelchprofile');
	if( $this->Modelchprofile->activefamily($id)) 	
  		  {
		    $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Congrats ! Member activate successfully.');
		    redirect('Addfamily/index');
		  }
		  else
		  {	
	        $this->load->library('session');
			 $this->session->set_flashdata('chpwd_success','Sorry ! Please try again.');
		    redirect('Addfamily/index');
    	
		  }	 
	}

}
	

	?>