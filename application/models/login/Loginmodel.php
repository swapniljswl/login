<?php
class Loginmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}
    public function valid_login ($username,$password)
	{
	         /* $query=$this->db->where(array('ipasid'=>$username ,'password'=>$password))
             ->get('comapp.comm_app_login_master'); */
			 	$sql="select * from comapp.comm_app_login_master where (ipasid='$username' or aadhar_no='$username')
				and password='$password'";  
  // echo $sql;exit;	
	$query = $this->db->query($sql);
      if ($query->num_rows()) {
	       	$this->session->set_userdata('secret',serialize($query->result()));
		   
	        return TRUE;
		    
	  } else  {
		    return FALSE;  
	  }
      
	  
	}
	  public function verifymanage($username)
	{
	       $verify=$this->db->where(array('ipasid'=>$username,'password'=>$password))
             ->get('comapp.comm_verify_role');
      if ($verify->num_rows()) {
	       	$this->session->set_userdata('verfyrole',serialize($verify->result()));
		   
	        return TRUE;
		    
	  } else  {
		    return FALSE;  
	  }
      
	  
	}
	public function getdetail ($username)
	{
	  $sql1=  "select ipasid from comapp.comm_app_login_master where (ipasid='$username' or aadhar_no='$username')";	
	  $query = $this->db->query("$sql1");
      $row = $query->row();
      $ipasid = $row->ipasid;
	 	$sql="select a.login_id,a.name,a.desig_id,b.desig_desc,a.bldg_id,c.bldg_desc,a.dte_id,
		   d.dte_desc,a.address,a.mobno,a.email,a.rly_ph_off,a.rly_ph_home,a.rly,a.group,a.fname,
		   a.emp_dob,A.marital_status,a.emp_sex,a.cur_basic,a.grade_pay,a.dt_retirement,a.init_doa,
           a.pay_level,a.pass_acct_no,a.ctrl_officer,a.doa_rdso,a.gaz_nongz,a.profile_verify_status		   
		   ,a.family_verify_status from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
           left outer join comapp.comm_bldg_master c on a.bldg_id=c.bldg_id
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
           left outer join comapp.comm_app_login_master e on a.login_id=e.ipasid
		    left outer join comapp.comm_verify_role f on a.login_id=f.ipasid 
			where login_id='$ipasid' ";  
    // echo $sql;exit;	
	$user = $this->db->query($sql); 
      if ($user->num_rows()) {
	       	$this->session->set_userdata('user',serialize($user->result()));
		   
	        return TRUE;
		    
	  } else  {
		    return FALSE;  
	  }	
	}
		public function getnonrdso ($username)
	{

	 	$sql="select a.aadhar_no,a.name,a.dob,a.fname,a.email,a.mobno,a.nodal_dte
		   from comapp.comm_app_profile_nonrdso a 
		   left outer join comapp.comm_dte_master d on a.nodal_dte=d.dte_id
           where a.aadhar_no='$username' ";     
  // echo $sql;exit;	
	$user = $this->db->query($sql); 
      if ($user->num_rows()) {
	       	$this->session->set_userdata('user',serialize($user->result()));
		   
	        return TRUE;
		    
	  } else  {
		    return FALSE;  
	  }	
		
		
		
		
	}
	 function getappdetail()
        {
		 $user=$this->session->rdso_nonrdso;
         $user_data=unserialize($this->session->secret);
         $user_id = $user_data[0]->ipasid;		 
        if ($user=='1')
		{
			// $sql1= " select appid,app_name,app_link from
	  //               (select appid,app_name,app_link from comapp.comm_application_master where appid not in (5,7,10)
	  //               union
			// 		select appid,app_name,app_link from comapp.comm_application_master a,
			// 		comapp.view_vig_role b,comapp.empdetail c
			// 		where appid  in (5) and b.user_id=c.login_id and b.user_id='$user_id' 
			// 		union
			// 		select appid,app_name,app_link from comapp.comm_application_master a,
			// 		comapp.view_dar_role b,comapp.empdetail c
			// 		where appid  in (7) and b.user_id=c.login_id and b.user_id='$user_id'
			// 		union
			// 		select appid,app_name,app_link from comapp.comm_application_master a,
			// 		comapp.view_trc_role b,comapp.empdetail c
			// 		where appid  in (10) and b.user_id=c.login_id and b.user_id='$user_id'
			// 		) a
   //                  order by CHAR_LENGTH(app_name) desc ";

                    $sql1= " select appid,app_name,app_link from
	                (select appid,app_name,app_link from comapp.comm_application_master  
	                
					) a
                    order by CHAR_LENGTH(app_name) desc ";
					}
	    elseif ($user=='2')
		{  $aadharno=$this->session->aadhar_no;
		$sql1= " select * from comapp.comm_application_master a,comapp.comm_nonrdso_app_priv b 
                   where a.appid::integer=b.appid::integer and b.aadhar_no='$aadharno' and flag='Y'
				   order by CHAR_LENGTH(app_name) desc ";}         
	    //echo $sql1;exit;
	      $q= $this->db->query($sql1);
                            
            if($q->num_rows() > 0)
            {
            return $q->result();
            }
            return array();
        }
	function menumaster()
        {
		 $user_data=unserialize($this->session->secret);		
	      $rdsononrdso = $user_data[0]->rdso_nonrdso;
		
		  if ($rdsononrdso=='1')
		  {  $user_id = $user_data[0]->ipasid; }
	       elseif ($rdsononrdso=='2')
		   { $user_id = $user_data[0]->aadhar_no;}
		 //  echo $user_id;exit;
       $sql = " select distinct m_c.menu_id,m_c.menu_name,m_c.title,m_c.\"path\",m_c.lft,m_c.rght,'N' flag,m_c.icon,m_c.sort_order
		from comapp.comm_role_master p
		join comapp.comm_role_master c on (c.lft between p.lft and p.rght),
		comapp.comm_role_priv b,comapp.comm_menu_master m_p
		join comapp.comm_menu_master m_c on (m_c.lft between m_p.lft and m_p.rght),
		comapp.comm_app_login_master d
		where (d.ipasid='$user_id' or d.aadhar_no='$user_id')
		and p.role_id=d.role::integer
		and coalesce(d.status,'A')<>'D'
		and c.role_id=b.role_id
		and coalesce(b.status,'A')<>'D'
		and b.menu_id=m_p.menu_id
		union
		select distinct m_p.menu_id,m_p.menu_name,m_p.title,m_p.\"path\",m_p.lft,m_p.rght,'N' flag,m_p.icon,m_p.sort_order
		from comapp.comm_role_master p
		join comapp.comm_role_master c on (c.lft between p.lft and p.rght),
		comapp.comm_role_priv b,comapp.comm_menu_master m_c
		join comapp.comm_menu_master m_p on (m_c.lft> m_p.lft and m_c.lft < m_p.rght),
		comapp.comm_app_login_master d
		where (d.ipasid='$user_id' or d.aadhar_no='$user_id')
		and p.role_id=d.role::integer
		and coalesce(d.status,'A')<>'D'
		and c.role_id=b.role_id
		and coalesce(b.status,'A')<>'D'
		and b.menu_id=m_c.menu_id
		and m_p.lft<>0
		order by sort_order";			
		//	$result=$this->db->query($sql)->result_array();
		//return $result;
		//echo($sql);exit;
			$result=$this->db->query($sql);			
			 if($result->num_rows() > 0)
            {  
             return $result->result_array(); 
            }
			else {return 0;}          
        }	
		
}
?>