<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Listacivedeactdirec extends CI_Controller {
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
             redirect(base_url('user_login')); # Your default controller name 
		   
            ob_clean();
			
		}
    }

	 
	public function index()
	{
		$type	=$this->session->userdata('login');
	      if ($type=='sso') {
        $this->load->model('login/Loginmodel');
	    $umenu['menu'] = $this->Loginmodel->menumaster();
	    $this->load->view('login1/login/header',$umenu);   		
		$this->load->view('login1/admin/acticedeactive');
		$this->load->view('login1/login/footer');
		  } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/acticedeactive');
		$this->load->view('login1/admin/footer.php');
			 
			}
	}
	
		public function getverifylist()
	{
		$typeuser=$this->input->post('typeuser');
		//echo $typeuser;exit;
		$this->load->model('admin/Listactdeacdirmod');
        $data['verify']=$this->Listactdeacdirmod->getverifyuser($typeuser); 
		$type	=$this->session->userdata('login');
	      if ($type=='sso') {
         $this->load->model('login/Loginmodel');
	     $umenu['menu'] = $this->Loginmodel->menumaster();
	     $this->load->view('login1/login/header',$umenu);   		
		 $this->load->view('login1/admin/acticedeactive',$data);
		 $this->load->view('login1/login/footer');
		  } elseif ($type=='dgdash') {
		$this->load->view('login1/admin/header.php');
		$this->load->view('login1/admin/acticedeactive',$data);
		$this->load->view('login1/admin/footer.php');
			 
			}
	}
	public function deactive($login_id)
	{
	// echo $login_id;exit;
	 $this->load->model('admin/Listactdeacdirmod');
	if( $this->Listactdeacdirmod->deactive($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','User deactiveted successfully.');
			redirect('Listacivedeactdirec/index');
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','Sorry ! User not deactiveted .');
			 redirect('Listacivedeactdirec/index');
		  
}
	} 
	
	public function active($login_id)
	{
	 
	 $this->load->model('admin/Listactdeacdirmod');
	if( $this->Listactdeacdirmod->active($login_id)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','User activeted successfully.');
			redirect('Listacivedeactdirec/index');		  
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','Sorry ! User not activeted .');
			redirect('Listacivedeactdirec/index');
		  
}
	}
	public function nonrdsodeactive($aadhar_no)
	{
	
	 $this->load->model('admin/Listactdeacdirmod');
	if( $this->Listactdeacdirmod->nonrdsodeactive($aadhar_no)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','User deactiveted successfully.');
			redirect('Listacivedeactdirec/index');			
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','Sorry ! User not deactiveted .');
			 redirect('Listacivedeactdirec/index');
		  
}
	}
public function nonrdsoactive($aadhar_no)
	{
	 
	 $this->load->model('admin/Listactdeacdirmod');
	if( $this->Listactdeacdirmod->nonrdsoactive($aadhar_no)) 	
  		  {
		    $this->load->library('session');
			$this->session->set_flashdata('role','User activeted successfully.');
			redirect('Listacivedeactdirec/index');	
}
else
{
             $this->load->library('session');
			 $this->session->set_flashdata('role','Sorry ! User not activeted .');
			 redirect('Listacivedeactdirec/index');
		  
}
	}
		
}


?>
