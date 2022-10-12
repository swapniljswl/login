<?php
class Modelchpwd extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}
	 public function valid_pwd ($user_id,$oldpwd)
	{
	  $user=$this->db->where(array('ipasid'=>$user_id,'password'=>$oldpwd))
                ->get('comapp.comm_app_login_master');
      if ($user->num_rows()) {
		   return TRUE;
	  } else  {
		    return FALSE;  
	  }
     }
	  public function chg_pwd ($user_id,$newpwd)
	{
	  $this->db->where('ipasid', $user_id);
     $this->db->update('comapp.comm_app_login_master', array('password' => $newpwd));
      
		   return TRUE;
	  
     }
}

?>