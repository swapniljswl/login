<?php
class Modeluserchpwd extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		date_default_timezone_set('Asia/Calcutta');
	}
	 public function valid_pwd ($ipasno)
	{
	
/* 	  $user=$this->db->where(array('ipasid'=>$ipasno))
	                 ->or_where(array('aadhar_no',$ipasno));
                  ->get('comapp.comm_app_login_master'); */
	$query= "select 	* from comapp.comm_app_login_master where ipasid='$ipasno' or aadhar_no='$ipasno'";	  
	 $user=$this->db->query($query);		  
      if ($user->num_rows() > 0) {
		   return TRUE;
	  } else  {
		    return FALSE;  
	  }
     }
	  public function getdetail ($ipasno)
	{
	  $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$ipasno' or aadhar_no='$ipasno')";	
	  $query = $this->db->query("$sql1");
      $row = $query->row();
      $ipasid = $row->ipasid; 
	  $rdsononrdso = $row->rdso_nonrdso;
	  if ($rdsononrdso=='1')
	  {
	 $query="select a.login_id,a.name,a.desig_id,b.desig_desc,a.bldg_id,c.bldg_desc,a.dte_id,
		   d.dte_desc,a.address,a.mobno,a.email,a.rly_ph_off,a.rly_ph_home,a.rly,a.group from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
           left outer join comapp.comm_bldg_master c on a.bldg_id=c.bldg_id
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
		   left outer join comapp.comm_app_login_master e on a.login_id=e.ipasid
           where (a.login_id='$ipasno' or e.aadhar_no='$ipasno' ) ";
	  }
	  elseif ($rdsononrdso=='2')
	  {
	  $query="select a.name,d.dte_desc,'Non RDSO' desig_desc from comapp.comm_app_profile_nonrdso a , comapp.comm_app_login_master b ,
	  comapp.comm_dte_master d where  b.aadhar_no='$ipasno' and a.aadhar_no='$ipasno' and a.aadhar_no=b.aadhar_no
	  and a.nodal_dte=d.dte_id ";	
	  }   
		 //  echo $query ; exit;
			 $user1=$this->db->query($query);	
			  
	    if ($user1->num_rows() > 0) {
         // grab data
       	$this->session->set_userdata('empdetail',serialize($user1->result()));
		//   return $this->result_array();
		} else  {
		    return 0;  
	  }
     }
	  public function chg_pwd ($ipasno,$newpwd)
	{
	     $date = date('Y-m-d h:i:s a', time());
        $user_data=unserialize($this->session->user);
	    $empid = $user_data[0]->login_id;	
	  $this->db->where('ipasid', $ipasno);
	  $this->db->or_where('aadhar_no',$ipasno);
     $this->db->update('comapp.comm_app_login_master', array('password' => $newpwd,'modified_by'=>$empid,'modified_on'=>$date));
    $sql1=  "select * from comapp.comm_app_login_master where (ipasid='$ipasno' or aadhar_no='$ipasno')";	
	$query = $this->db->query("$sql1");
    $row = $query->row();
    $rdsononrdso = $row->rdso_nonrdso;
	if ($rdsononrdso=='1')
	{$query = $this->db->get("comapp.comm_app_login where login_id='$ipasno' ");}
	elseif ($rdsononrdso=='2')	{$query = $this->db->get("comapp.comm_app_profile_nonrdso where aadhar_no='$ipasno' ");}
    $ret = $query->row();
   $newuserpwd=$this->input->post('npassword');
	$from_email = "pass@rdso.railnet.gov.in"; 
       $to_email = $ret->email;
	   $name = $ret->name;
	  //  echo  $to_email;  exit;
	 $config = array(
                   'protocol'  => 'smtp',
	               'smtp_host' => 'ssl://email.gov.in',
	               'smtp_port' => '465',
	               'smtp_user' => 'pass.rdsor@nic.in',//'jeit1.rdsor@nic.in',//
	               'smtp_pass' => 'A@aBC%13',
	               'smtp_crypto' => 'security',
	               'mailtype'  => 'html', 
	               'charset'   => 'utf-8',
	               'newline'   => "\r\n",
	               'crlf' => "\r\n",
	               'wordwrap' => TRUE
);
         $this->load->library('email', $config);
         $this->email->initialize($config);
         $this->email->set_newline("\r\n"); 
         $this->email->set_mailtype("html");
         $this->email->from($from_email, 'RDSO'); 
         $this->email->to($to_email);
         $this->email->subject('Password change');
         $this->email->message("Your password in 'IT Apps' has been changed by Admin. Your new password is ".$newuserpwd."." );
		 //'Mr./Ms. ' .$name.', your new Password is '.$newuserpwd.', please login with your new password. ');
   //echo $passwordplain;
      return TRUE;
		
	  
     }
   }

?>
