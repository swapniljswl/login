<?php
class Modelchpwd extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Calcutta');
		$this->load->database();	
	}
	 public function valid_pwd ($user_id,$oldpwd)
	{
	  /* $user=$this->db->where(array('ipasid'=>$user_id,'password'=>$oldpwd))
                ->get('comapp.comm_app_login_master'); */
     $query= "select * from comapp.comm_app_login_master where (ipasid='$user_id' or aadhar_no='$user_id') and password='$oldpwd'";	  
     // ECHO  $query;EXIT;	
	$user=$this->db->query($query);		  
      if ($user->num_rows() > 0) {
		   return TRUE;
	  } else  {
		    return FALSE;  
	  }
     }
	  public function chg_pwd ($user_id,$newpwd)
	{
		$date = date('Y-m-d h:i:s a', time());
	  $this->db->where('ipasid', $user_id);
	  $this->db->or_where('aadhar_no',$user_id);
     $this->db->update('comapp.comm_app_login_master', array('password' => $newpwd,'modified_by' => $user_id,'modified_on' => $date));
      
		   return TRUE;
	  
     }
}

?>