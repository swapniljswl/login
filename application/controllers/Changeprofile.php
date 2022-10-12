<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if (!$_SERVER['HTTP_REFERER']){ $this->redirect('user_login'); }
class Changeprofile extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
		$this->load->helper('date');
         date_default_timezone_set('Asia/Calcutta'); 
        // load url helper
       $this->load->helper('url');
		 $this->load->helper('html');
		 $this->load->helper('form');
		 $this->load->library('session');
		$id=$this->session->userdata('userid');
			if ((!$this->session->has_userdata('user')) and (!$this->session->has_userdata('secret')))
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

	   $user_data=unserialize($this->session->secret);
	   $usertype = $user_data[0]->rdso_nonrdso;
	   if ($usertype=='1')
	   {
	   $user_data=unserialize($this->session->user);
	   $user_id = $user_data[0]->login_id;
	   $this->load->model('login/Modelchprofile');
    $data['records'] = html_escape($this->Modelchprofile->getdesgRecords());
    $data['record1'] = html_escape($this->Modelchprofile->getdirctRecords());
    $data['record2'] = html_escape($this->Modelchprofile->getbldgRecords());
	$data['record3'] = html_escape($this->Modelchprofile->getgradegRecords());
	$data['record4'] = html_escape($this->Modelchprofile->getlevelRecords());
	//$data['record5'] = $this->Modelchprofile->getempdetail();
	$this->Modelchprofile->getall($user_id);
    $this->load->model('login/Loginmodel');
	$umenu['menu'] = ($this->Loginmodel->menumaster());
	$this->load->view('login1/login/header',$umenu); 
    $this->load->view("login1/changeprofile",$data);
	$this->load->view('login1/login/footer');
	   }
	   elseif ($usertype=='2')
	   {
	$user_data=unserialize($this->session->user);
	$user_id = $user_data[0]->aadhar_no;	   
	$this->load->model('login/Modelchprofile');	   
	$data['record1'] = html_escape(($this->Modelchprofile->getdirctRecords()));	   
	$this->Modelchprofile->getall($user_id);
    $this->load->model('login/Loginmodel');
	$umenu['menu'] = html_escape(($this->Loginmodel->menumaster()));
	$this->load->view('login1/login/header',$umenu); 
    $this->load->view("login1/nonrdsoprofile",$data);
	$this->load->view('login1/login/footer');   
	   }
	}
	public function changeprof()
	{
	   $this->lib_csrf->csrf_verify();
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('name','Name' , 'required|max_length[100]|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('desg','Designation' , 'required');
	   $this->form_validation->set_rules('direct','Directorate' , 'required');
	 //  $this->form_validation->set_rules('bldg','Building' , 'required');
	   $this->form_validation->set_rules('mobno','Mobile No' , 'required|numeric|exact_length[10]');
	   $this->form_validation->set_rules('email','Email' ,'trim|required|regex_match[/^[a-z0-9\. , @]*$/i]|valid_email');
	   $this->form_validation->set_rules('rlyphoff','railway phone (office)' , 'numeric');
	   $this->form_validation->set_rules('rlyphhome','railway phone (Home)' , 'numeric');
	   $this->form_validation->set_rules('railway','Railway' , 'required');
	   $this->form_validation->set_rules('grp','Group ' , 'required');
	   $this->form_validation->set_rules('gaz','Gaz/Non-Gaz' , 'required');
	   $this->form_validation->set_rules('fname','Father Name' ,'required|max_length[60]|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('dob','Date of Birth' ,'required');
	   $this->form_validation->set_rules('sex','Gender' , 'required');
	   $this->form_validation->set_rules('level','Level' , 'required');
	   $this->form_validation->set_rules('level_code','Basic' , 'required');
	  // $this->form_validation->set_rules('doarail','Date of Appointment(railway)' , 'required');
	  // $this->form_validation->set_rules('doardso','Date of Appointment(RDSO)' , 'required');
	  // $this->form_validation->set_rules('dor','Date of Retirement' , 'required');
	   $this->form_validation->set_rules('railway','Railway' , 'required');
	   $this->form_validation->set_rules('grp','Group' , 'required');
	   //$this->form_validation->set_rules('passac','Pass Account No' , 'required|max_length[10]|regex_match[/^[a-z0-9\. , @]*$/i]');
	   $this->form_validation->set_rules('quarter','Quarter' , 'regex_match[/^[a-z0-9\. ,\/\-]*$/i]');
	   $this->form_validation->set_rules('maritalstatus','Marital Status' , 'required');
	   $this->form_validation->set_rules('aadharno','Aadhar No' , 'numeric|exact_length[12]');
	   if ($this->form_validation->run()==FALSE)
	   {
		//   echo validation_errors();exit;
		 $this->load->library('session');
		 $this->session->set_flashdata('chprof_success','Sorry ! Your profile not update. Please try again ');
		  $user_data=unserialize($this->session->user);
	   $user_id = $user_data[0]->login_id;
	   $this->load->model('login/Modelchprofile');
       $data['records'] = html_escape($this->Modelchprofile->getdesgRecords());
       $data['record1'] = html_escape($this->Modelchprofile->getdirctRecords());
       $data['record2'] =html_escape($this->Modelchprofile->getbldgRecords());
	   $data['record3'] = html_escape($this->Modelchprofile->getgradegRecords());
	   $data['record4'] =html_escape($this->Modelchprofile->getlevelRecords());
	   //$data['record5'] = $this->Modelchprofile->getempdetail();
	   $this->Modelchprofile->getall($user_id);
       $this->load->model('login/Loginmodel');
	   $umenu['menu'] = ($this->Loginmodel->menumaster());
	   $this->load->view('login1/login/header',$umenu); 
       $this->load->view("login1/changeprofile",$data);
	   $this->load->view('login1/login/footer');		
		  }
		  else
		  {	
	       
	        $data=$this->input->post();
			//PRINT_R($data);EXIT;
			 $rlyphoff=$this->input->post('rlyphoff');
	        $rlyphhome=$this->input->post('rlyphhome');
			 $building=$this->input->post('bldg');
			 $direct=$this->input->post('direct');
	         $sex=$this->input->post('sex');
			 $name=$this->input->post('name');
			 $desg=$this->input->post('desg');
			 $dob=$this->input->post('dob');
			 $doarail=$this->input->post('doarail');
			 $doardso=$this->input->post('doardso');
			 $dor=$this->input->post('dor');
			 $level=$this->input->post('level');
			 $maritalstatus=$this->input->post('maritalstatus');
			 $fname=$this->input->post('fname');
			 $level_code=$this->input->post('level_code');
			 $gaz=$this->input->post('gaz');
			 $grp=$this->input->post('grp');
			 $passac=$this->input->post('passac');
			 $aadharno=$this->input->post('aadharno');
		     $user_data=unserialize($this->session->user);
	         $user_id = $user_data[0]->login_id;			
			  $user_data=unserialize($this->session->secret);
		      $role = $user_data[0]->role;
			  $user_data1=unserialize($this->session->user1);
			  $dteid = $user_data1[0]->dte_id; 
				//echo $role;exit; 
              if($role!='4') 
			 {	
		 if($this->load->model('login/Modelchprofile'))	 
		 {
		 $this->Modelchprofile->chg_prof($user_id,$data,$rlyphoff,$rlyphhome,$building,$direct,$sex,$name,$dob,$doarail,$doardso,$dor,$level,$maritalstatus,$fname,$desg,$level_code,$gaz,$grp,$passac,$aadharno);
		
			   				  
				 if($this->Modelchprofile->sendmail($user_id))
			{
         
         if($this->email->send()) 
		 { 			
		 $this->load->library('session');
		 $this->session->set_flashdata('chprof_success','Congrats ! Your profile update successfully !!!!');
		 redirect("Changeprofile/index");
         }
		 else
		 { 
		$this->load->library('session');
		 $this->session->set_flashdata('chprof_success','Congrats ! Your profile update successfully but email not sent !!!!');
		 redirect("Changeprofile/index"); 
		       } 
			 }    } 
			  $this->load->library('session');
			 $this->session->set_flashdata('chprof_success','sorry ! your profile not update please try again ');
			 redirect("Changeprofile/index");			 
			 }	
           elseif(($role=='4')  AND ($direct==$dteid))
			 {	
		 if($this->load->model('login/Modelchprofile'))	 
		 {
		 $this->Modelchprofile->chg_prof($user_id,$data,$rlyphoff,$rlyphhome,$building,$direct,$sex,$name,$dob,$doarail,$doardso,$dor,$level,$maritalstatus,$fname,$desg,$level_code,$gaz,$grp,$passac,$aadharno);
		
			   				  
				 if($this->Modelchprofile->sendmail($user_id))
			{
         
         if($this->email->send()) 
		 { 			
		 $this->load->library('session');
		 $this->session->set_flashdata('chprof_success','Congrats ! Your profile update successfully !!!!');
		 redirect("Changeprofile/index");
         }
		 else
		 { 
		$this->load->library('session');
		 $this->session->set_flashdata('chprof_success','Congrats ! Your profile update successfully but email not sent !!!!');
		 redirect("Changeprofile/index"); 
		       } 
			 }    } 
			  $this->load->library('session');
			 $this->session->set_flashdata('chprof_success','sorry ! your profile not update please try again ');
			 redirect("Changeprofile/index");			 
			 }			 
		   elseif(($role=='4') AND ($direct!=$dteid))
		   { 	
			 if($this->load->model('login/Modelchprofile'))	 
		 { 
		 $this->Modelchprofile->chg_prof($user_id,$data,$rlyphoff,$rlyphhome,$building,$direct,$sex,$name,$dob,$doarail,$doardso,$dor,$level,$maritalstatus,$fname,$desg,$level_code,$gaz,$grp,$passac,$aadharno);
		
			   	$this->Modelchprofile->changerolediradmin(); 			  
				 if($this->Modelchprofile->sendmail($user_id))
			{
            
         if($this->email->send()) 
		 { 			
		 $this->load->library('session');
		$this->session->set_flashdata('login_failed','Your role is revoked from Directorate Admin!!');
		redirect("user_login"); 
         }
		 elseif (!$this->email->send()) 
		 {
		$this->load->library('session');
		$this->session->set_flashdata('login_failed','Your role is revoked from Directorate Admin and email not sent successfully!!');
		redirect("user_login"); 
		       } 
			 }   }   
			   else {
				 
			 $this->load->library('session');
			 $this->session->set_flashdata('chprof_success','sorry ! your profile not update please try again ');
			 redirect("Changeprofile/index");
	        }  
			   }			   			   
	}  }
			       
                				   
	
	
	public function level()
	{
	$lcode = $this->input->post('level');
    $this->load->model('login/Modelchprofile');
    $levelcode = $this->Modelchprofile->leveldetail($lcode);
	
	if (count($levelcode)>0)
		$pro_select_box='';
	   // $pro_select_box.='<option value="">select </option>';
		foreach($levelcode as $grpcode)
		{
		$pro_select_box.='<option value="'.$grpcode->$lcode.'">'.$grpcode->$lcode.'</option>';	
		}
    echo ($pro_select_box); 
	}
	public function grade()
	{
	$lcode = $this->input->post('level');
	$this->load->model('login/Modelchprofile');
    $grade= html_escape($this->Modelchprofile->grade($lcode));
	if (count($grade)>0)
		$pro_select_box='';
	   // $pro_select_box.='<option value="">select </option>';
		foreach($grade as $grpcode)
		{
		$pro_select_box.='<option value="'.$grpcode['gradelevel'].'">'.$grpcode['gradelevel'].'</option>';	
		}
    echo $pro_select_box;

	}
public function nonrdsoprofile()
	{
	    
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('name','Name' , 'required|max_length[100]|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('direct','Directorate' , 'required');
	   $this->form_validation->set_rules('mobno','Mobile No' , 'required|numeric|exact_length[10]');
	   $this->form_validation->set_rules('fname','Father Name' ,'required|max_length[60]|regex_match[/^[a-z0-9\. ,]*$/i]');
	   $this->form_validation->set_rules('email','Email' ,'trim|required|valid_email|regex_match[/^[a-z0-9\. , @]*$/i]|valid_email');
	   $this->form_validation->set_rules('dob','Date of Birth' ,'required');
	   $this->form_validation->set_rules('valid','Validity Upto' ,'required');
	   if ($this->form_validation->run()==FALSE)
	   {
		  // echo validation_errors();exit;
		 $this->load->library('session');
		 $this->session->set_flashdata('chprof_success','Sorry ! Your profile not update. Please try again ');
		$user_data=unserialize($this->session->user);
	$user_id = $user_data[0]->aadhar_no;	   
	$this->load->model('login/Modelchprofile');	   
	$data['record1'] = $this->Modelchprofile->getdirctRecords();	   
	$this->Modelchprofile->getall($user_id);
    $this->load->model('login/Loginmodel');
	$umenu['menu'] = $this->Loginmodel->menumaster();
	$this->load->view('login1/login/header',$umenu); 
    $this->load->view("login1/nonrdsoprofile",$data);
	$this->load->view('login1/login/footer'); 		
		 }
		 else
		 {
		  $user_data=unserialize($this->session->user);
	      $user_id = $user_data[0]->aadhar_no;	 
		  $data=$this->input->post();
		  $valid=$this->input->post('valid');
		  $dob=$this->input->post('dob');
	      $this->load->model('login/Modelchprofile');		   
		 if($this->Modelchprofile->changenonrdso($data,$valid,$dob))
		 {
		 if($this->Modelchprofile->sendmail($user_id))
		    {
          if($this->email->send()) 
		 { 			
		 $this->load->library('session');
		 $this->session->set_flashdata('chprof_success','Congrats ! Your profile update successfully !!!!');
		 redirect("Changeprofile/index");
         }
		 elseif(!$this->email->send()) 
		 {
		$this->load->library('session');
		 $this->session->set_flashdata('chprof_success','Sorry ! Email not send successfully !!!!');
		 redirect("Changeprofile/index"); 
		       } 
		   } }
		    else
			 {
				 
			 $this->load->library('session');
			 $this->session->set_flashdata('chprof_success','sorry ! your profile not update please try again ');
			 redirect("Changeprofile/index");
			   }      
	             }  
			       }


}
?>
