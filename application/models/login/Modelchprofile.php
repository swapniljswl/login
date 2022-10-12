<?php
class Modelchprofile extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Calcutta');	
		$this->load->database();	
	}
	 function getdesgRecords()
        {
			
         //  $q = $this->db->get("comapp.comm_desig_master");
			 $sql1= " select * from comapp.comm_desig_master  order by desig_desc asc ";
	  //   echo $sql;exit;
	      $q= $this->db->query($sql1);
                            
            if($q->num_rows() > 0)
            {
                return $q->result_array();
            }
            return array();
        }
	function getlevelRecords()
        {
		
			 $sql1= " select * from comapp.comm_pay_level order by id ";
	  //   echo $sql;exit;
	      $q= $this->db->query($sql1);
                            
            if($q->num_rows() > 0)
            {
                return $q->result_array();
            }
            return array();
        }
	function getgradegRecords()
        {
			      
			 $sql1= " select distinct grade_pay from comapp.pay_band_master  order by grade_pay asc ";
	  //   echo $sql;exit;
	      $q= $this->db->query($sql1);
                            
            if($q->num_rows() > 0)
            {
                return $q->result_array();
            }
            return array();
        }
	 function getdirctRecords()
        {
			
    $sql= " select * from comapp.comm_dte_master order by dte_desc asc ";
	  //   echo $sql;exit;
	      $q1= $this->db->query($sql);    
                    
            if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                 
            }
			 return array();
        }
	 function getrelationdetail()
        {
    $sql= " select * from comapp.comm_relation_master where relation_code!='01' order by relation_desc asc ";
	  //   echo $sql;exit;
	      $q1= $this->db->query($sql);    
                    
            if($q1->num_rows() > 0)
            {
                return $q1->result_array();
            }
			 return array();
        }
		function leveldetail($lcode)
        {
         $sql= " select distinct $lcode from comapp.viicpc_fixation_matrix order by $lcode ";
	   //  echo $sql;exit;
	      $q1= $this->db->query($sql);    
                    
            if($q1->num_rows() > 0)
            {
                return $q1->result();
                 
            }
			 return array();
        }
		function grade($lcode)
        {
         $sql= " select  gradelevel from comapp.comm_pay_level where  level_srt='$lcode' ";
	   //  echo $sql;exit;
	      $q1= $this->db->query($sql);                      
            if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                 
            }
			 return array();
        }
		 public function getempdetail ($user_id)
	{
		$query="select a.login_id,a.name,a.desig_id,b.desig_desc,a.bldg_id,c.bldg_desc,a.dte_id,
		   d.dte_desc,a.address,a.mobno,a.email,a.rly_ph_off,a.rly_ph_home,a.rly,a.group,a.fname,
		   a.emp_dob,A.marital_status,a.emp_sex,a.cur_basic,a.grade_pay,a.dt_retirement,a.init_doa,
           a.pay_level,a.pass_acct_no,a.ctrl_officer,a.doa_rdso,a.gaz_nongz,a.profile_verify_status		   
		   ,a.family_verify_status		   
		   from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
           left outer join comapp.comm_bldg_master c on a.bldg_id=c.bldg_id
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
           where a.login_id='$user_id'  ";
		  $q1= $this->db->query($query);    
                    
           if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                return array();  
            }
            else
             {
	        return 0;
	        }	
	}
		 function getfamilydetail($user_id)
        {
			$user_data=unserialize($this->session->user);
	        $empid = $user_data[0]->login_id;
			//echo $user_id;exit;
   $sql= " select * from comapp.comm_emp_family a,comapp.comm_relation_master b where ipas='$empid' 
   and a.relation_code=b.relation_code and a.active_flag='Y'  order by member_index ";

	     $q1= $this->db->query($sql);    
                    
           if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                return array();  
            }
            else
             {
	        return 0;
	        }	
        			
        }
		 function getbldgRecords()
        {
			
			$sql= " select * from comapp.comm_bldg_master  order by bldg_desc asc ";
	  //   echo $sql;exit;
	      $q1= $this->db->query($sql);    
                    
            if($q1->num_rows() > 0)
            {
                return $q1->result_array();
                 
            }
              return array();
             
        }
	 public function getall ($user_id)
	{
		$user_data=unserialize($this->session->secret);
	   $usertype = $user_data[0]->rdso_nonrdso;
	   if ($usertype=='1')
	   {
		$query="select a.login_id,a.name,a.desig_id,b.desig_desc,a.bldg_id,c.bldg_desc,a.dte_id,
		   d.dte_desc,a.address,a.mobno,a.email,a.rly_ph_off,a.rly_ph_home,a.rly,a.group,a.fname,
		   a.emp_dob,A.marital_status,a.emp_sex,a.cur_basic,a.grade_pay,a.dt_retirement,a.init_doa,
           a.pay_level,a.pass_acct_no,a.ctrl_officer,a.doa_rdso,a.gaz_nongz,a.profile_verify_status		   
		   ,a.family_verify_status,e.aadhar_no from comapp.comm_app_login a 
           left outer join comapp.comm_desig_master b on a.desig_id=b.desig_id
		   left outer join comapp.comm_app_login_master e on a.login_id=e.ipasid
           left outer join comapp.comm_bldg_master c on a.bldg_id=c.bldg_id
           left outer join comapp.comm_dte_master d on a.dte_id=d.dte_id
           where a.login_id='$user_id'  ";
		//   echo $query ; exit;
	   }
	   elseif ($usertype=='2')
	   {
	   $query="select a.aadhar_no,a.name,a.dob,a.fname,a.email,a.mobno,a.nodal_dte,c.validupto_nonrdso
		   from comapp.comm_app_profile_nonrdso a 
		   left outer join comapp.comm_dte_master b on a.nodal_dte=b.dte_id
		   left outer join comapp.comm_app_login_master c on a.aadhar_no=c.aadhar_no
           where a.aadhar_no='$user_id' "; 
	   }  
	       //echo $query ; exit;
			 $user1=$this->db->query($query);	
			  
	    if ($user1->num_rows()) {
         // grab data
       	$this->session->set_userdata('user1',serialize($user1->result()));
		//   return $this->result_array();
		} else  {
		    return FALSE;  
	  }	
	}	  
	
	
	 public function valid_pwd ($user_id,$oldpwd)
	{
	  $user=$this->db->where(array('login_id'=>$user_id,'pwd'=>$oldpwd))
                ->get('comapp.comm_app_login');
      if ($user->num_rows()) {
		   return TRUE;
	  } else  {
		    return FALSE;  
	  }
     }
	//  public function chg_prof($user_id,$desg,$direct,$building,$quarter,$mobno,$email,$rlyphoff,$rlyphhome,$railway,$grp)
	 public function chg_prof($user_id,$data,$rlyphoff,$rlyphhome,$building,$direct,$sex,$name,$dob,$doarail,$doardso,$dor,$level,$maritalstatus,$fname,$desg,$level_code,$gaz,$grp,$passac,$aadharno)
	{		
		$date = date('Y-m-d h:i:s a', time());
		$newdob = DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d');
	    if ($doardso=='') {$doa_rdso=NULL;} else {
		$doa_rdso =DateTime::createFromFormat('d/m/Y',$doardso)->format('Y-m-d'); }
		 if ($doarail=='') {$doa_rail=NULL;} else {
		 $doa_rail =DateTime::createFromFormat('d/m/Y',$doarail)->format('Y-m-d'); }
		  if ($dor=='') {$dor_rail=NULL;} else {
		  $dor_rail =DateTime::createFromFormat('d/m/Y',$dor)->format('Y-m-d'); }
		if ($rlyphoff == '')
		{
		$rlyphoff = NULL;
		}
		else
		{
		$rlyphoff ;	
		}
		if ($rlyphhome == '')
		{
		$rlyphhome = NULL;
		}
		else
		{
		$rlyphhome ;	
		}
		if ($level ==	'l_1')
		{
		 $gradepay = '1800';
		}
		elseif ($level ==	'l_2')
		{
		 $gradepay = '1900';
		}
		elseif ($level ==	'l_3')
		{
		 $gradepay = '2000';
		}
		elseif ($level ==	'l_4')
		{
		 $gradepay = '2400';
		}
		elseif ($level ==	'l_5')
		{
		 $gradepay = '2800';
		}
		elseif ($level ==	'l_6')
		{
		 $gradepay = '4200';
		}
		elseif ($level ==	'l_7')
		{
		 $gradepay = '4600';
		}
		elseif ($level ==	'l_8')
		{
		 $gradepay = '4800';
		}
		elseif ($level ==	'l_9')
		{
		 $gradepay = '5400';
		}
		elseif ($level ==	'l_10')
		{
		 $gradepay = '5400';
		}
		elseif ($level ==	'l_11')
		{
		 $gradepay = '6600';
		}
		elseif ($level ==	'l_12')
		{
		 $gradepay = '7600';
		}
		elseif ($level ==	'l_13')
		{
		 $gradepay = '8700';
		}
		elseif ($level ==	'l_13a')
		{
		 $gradepay = '8900';
		}
		elseif ($level ==	'l_14')
		{
		 $gradepay = '10000';
		}
		elseif ($level ==	'l_15')
		{
		 $gradepay = '0';
		}
		elseif ($level ==	'l_16')
		{
		 $gradepay = '0';
		}
		elseif ($level ==	'l_17')
		{
		 $gradepay = '0';
		}
		elseif ($level ==	'l_18')
		{
		 $gradepay = '0';
		}
		
		    $user_data=unserialize($this->session->user1);
	        $empid = $user_data[0]->login_id;
            $dteid1 = $user_data[0]->dte_id; 
			$name1 = $user_data[0]->name;
			$dob1 = $user_data[0]->emp_dob;
			$sex1 = $user_data[0]->emp_sex;			
		   $desig1 = $user_data[0]->desig_id;
		   $gaz1 = $user_data[0]->gaz_nongz; 
		   $desigdesc1 = $user_data[0]->desig_desc;
		   $dtedesc1 = $user_data[0]->dte_desc;
		   $bldgdesc1 = $user_data[0]->bldg_desc; 
		   $bldgid1 = $user_data[0]->bldg_id;
           $group1 = $user_data[0]->group;
		   $fname1 = $user_data[0]->fname;
		   $emp_dob1 = $user_data[0]->emp_dob;
		   $marital_status1 = $user_data[0]->marital_status;
		   $emp_sex1 = $user_data[0]->emp_sex;
		   $cur_basic1 = $user_data[0]->cur_basic;
		   $gradepay1 = $user_data[0]->grade_pay;
		   $dt_retirement1 = $user_data[0]->dt_retirement;
		   $init_doa1 = $user_data[0]->init_doa;
		   $pay_level1 = $user_data[0]->pay_level;
		   $pass_acct_no1 = $user_data[0]->pass_acct_no;
		   $doa_rdso1 = $user_data[0]->doa_rdso;
		 
		 if (($pass_acct_no1!=$passac) and (($name1!=$name) or ($sex1!=$sex)or ($dob1!=$newdob)or ($marital_status1!=$maritalstatus)or ($fname1!=$fname) or ($desig1!=$desg) 
			  or ($dteid1!=$direct) or ($pay_level1!=$level) or ($cur_basic1!=$level_code)or ($init_doa1!=$doa_rail)or ($doa_rdso1!=$doa_rdso)
              or ($dt_retirement1!=$dor_rail)or ($gaz1!=$gaz) or ($group1!=$grp)) )
		   {
       // echo "both";exit;
		$da = array(
		 'name' => $data['name'],
		'desig_id' => $data['desg'],
		 'dte_id' => $data['direct'],
	     
		 'group' => $data['grp'],
		 'rly' => $data['railway'],
		 'fname' => $data['fname'],
		 'gaz_nongz' => $data['gaz'],
		 'emp_dob' => $newdob,
		 'marital_status' => $data['maritalstatus'],
		 'emp_sex' => $data['sex'],
		 'cur_basic' => $data['level_code'],
		 'grade_pay' => $gradepay,
		// 'dt_retirement' => $data['dor'],
		 'init_doa' => $doa_rail,
		 'dt_retirement' => $dor_rail,
		// 'init_doa' => $data['doarail'],
		 'pay_level' => $data['level'],
		 'profile_verify_status' => 'N',
		 'doa_rdso' => $doa_rdso,
		 'modified_on' => $date,
		 'modified_by' => $user_id,
		 'pass_acct_no' => $data['passac'],	 
		 'family_verify_status' => 'N' 
		 	) ;
		   		 
		//	print_r ($da);exit;
		   $this->db->where('login_id', $user_id);
           $this->db->update('comapp.comm_app_login',$da);
		  		  
			}
			 	
			 elseif ($pass_acct_no1!=$passac)
			{
      	//	echo "pass";exit;	
		 $da = array(
		 'pass_acct_no' => $data['passac'],	 
		 'family_verify_status' => 'N',			 
		 'modified_on' => $date,
		 'modified_by' => $user_id
			) ;
			$this->db->where('login_id', $user_id);
            $this->db->update('comapp.comm_app_login',$da);
			
			}
			
		elseif ( ($name1!=$name) or ($sex1!=$sex)or ($dob1!=$newdob)or ($marital_status1!=$maritalstatus)or ($fname1!=$fname) or ($desig1!=$desg) 
			  or ($dteid1!=$direct) or ($pay_level1!=$level) or ($cur_basic1!=$level_code)or ($init_doa1!=$doa_rail)or ($doa_rdso1!=$doa_rdso)
              or ($dt_retirement1!=$dor_rail)or ($gaz1!=$gaz) or ($group1!=$grp))
		   {
          //    echo "esse";exit;
		$da = array(
		 'name' => $data['name'],
		'desig_id' => $data['desg'],
		 'dte_id' => $data['direct'],
	     
		 'group' => $data['grp'],
		 'rly' => $data['railway'],
		 'fname' => $data['fname'],
		 'gaz_nongz' => $data['gaz'],
		 'emp_dob' => $newdob,
		 'marital_status' => $data['maritalstatus'],
		 'emp_sex' => $data['sex'],
		 'cur_basic' => $data['level_code'],
		 'grade_pay' => $gradepay,
		// 'dt_retirement' => $data['dor'],
		 'init_doa' => $doa_rail,
		 'dt_retirement' => $dor_rail,
		// 'init_doa' => $data['doarail'],
		 'pay_level' => $data['level'],
		 'profile_verify_status' => 'N',
		 'doa_rdso' => $doa_rdso,
		 'modified_on' => $date,
		 'modified_by' => $user_id
		 
		 	) ;
		   		 
		//	print_r ($da);exit;
		   $this->db->where('login_id', $user_id);
           $this->db->update('comapp.comm_app_login',$da);
		  	  
			}	
		 else
		 {	
         //echo "no any";exit;	 
		 $da = array(
		 'rly_ph_off' => $rlyphoff,
		 'rly_ph_home' => $rlyphhome,	
		 'bldg_id' => $building,
		 'address' => $data['quarter'],
		 'mobno' => $data['mobno'],
		 'email' => $data['email'],
		 'modified_on' => $date,
		 'modified_by' => $user_id
			) ;
		   
			$this->db->where('login_id', $user_id);
            $this->db->update('comapp.comm_app_login',$da);
		
		 }
		 if ($aadharno!='')
			{
      	//	echo "pass";exit;	
		 $da = array(
		 'aadhar_no' => $aadharno,	 
		 'modified_on' => $date,
		 'modified_by' => $user_id
			) ;
			// print_r($da);exit;
			$this->db->where('ipasid', $user_id);
            $this->db->update('comapp.comm_app_login_master',$da);			
			}
		 
	   if (($name1!=$name) or ($sex1!=$sex) or ($newdob!=$dob))
		   {
           $da = array(
              'family_member_name' => $data['name'],
               'dob' => $newdob,
			   'sex' => $data['sex']
		   ) ;
		  
		   $this->db->where(array('ipas'=> $user_id,'relation_code'=>'01'));
           $this->db->update('comapp.comm_emp_family',$da);
		   
		   }
		    if($this->db->affected_rows())		  
		   {
			//  ECHO "HI";EXIT; 
			 return TRUE;   
		   }
		   else
		   {
			    
			  return false; 
		   }  
          // return $this->db->affected_rows();  
         	 
	}	 
	public function sendmail($user_id)
        {
	    $user_data=unserialize($this->session->secret);
	   $usertype = $user_data[0]->rdso_nonrdso;
        if ($usertype=='1')
		{			
		$sql= "select * from comapp.comm_app_login a , comapp.comm_app_login_master b 
	    where b.ipasid='$user_id' and a.login_id='$user_id' and a.login_id=b.ipasid ";
		}
		elseif ($usertype=='2')
		{
		$sql="select *
		   from comapp.comm_app_profile_nonrdso a 
		   left outer join comapp.comm_app_login_master b on a.aadhar_no=b.aadhar_no
		   left outer join comapp.comm_dte_master d on a.nodal_dte=d.dte_id
           where a.aadhar_no='$user_id' "; 	
		}
		//echo $sql;exit;
		$query = $this->db->query("$sql");
        $row = $query->row();
        $email = $row->email; 
		$name = $row->name; 
		$status = $row->status;
		//echo  $email;exit;
         if ($email!='')	
		 {			 
	     $from_email = "pass@rdso.railnet.gov.in";
        $to_email = $email;
	
	          $config = array(
                   'protocol'  => 'smtp',
	               'smtp_host' => 'ssl://email.gov.in',
	               'smtp_port' => '465',
	               'smtp_user' => 'pass.rdsor@nic.in',//'jeit1.rdsor@nic.in',//
	               'smtp_pass' => 'A@aBC%13',//'123aA_456',//
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
         //Load email library 
       //  $this->load->library('email'); 
         //echo ($from_email);exit;
		 $this->email->from($from_email, 'RDSO'); 
         $this->email->to($to_email);
         $this->email->subject('Profile Change');
         $this->email->message("Your profile changed successfully.  ");			 
        // $this->email->Body ("Hello World");
         /*  //Send mail 
		  $mobile=$row->mobno;
		 $msg = "Your profile changed successfully.  "; 
       $username = 'RDSO';
       $password = 'rdso@123';
	  
	   $url="http://122.176.77.205:8081/jinvani/SendMessegeServlet?uname=".$username."&passwd=".$password."&text=".urlencode($msg)."&msisdn=".$mobile."&mode=Txt";
	   $ch  = curl_init();
	 curl_setopt ($ch,CURLOPT_URL, $url) ;
	 curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
	 $response = curl_exec($ch) ;
	 curl_close($ch) ; */
			 
		
  return TRUE;
		 } 

}  
     
	 public function insertfamilydetail($data,$user_id)
	 {

 	$date = date('Y-m-d h:i:s a', time());
	//print_r($data);exit;

	foreach ($data as $row) {
			$row['ipas']=$user_id;
			$row['entry_by']=$user_id;
			$row['active_flag']='Y';
            $row['declaration_date']=$date;
            $row['entry_on']=$date;
            
			$this->db->reset_query();
			$this->db->set($row);
			$this->db->insert('comapp.comm_emp_family');
	 }
	 
	 }
	  function getfamilyrec($id,$user_id)
        {
		$sql= " select * from comapp.comm_emp_family a,comapp.comm_relation_master b where ipas='$user_id' and idrow='$id' and 
		a.relation_code=b.relation_code and a.active_flag ='Y' order by member_index ";
		//echo $sql;exit;
		$result=$this->db->query($sql)->result_array();
		return $result;
             
        }
		
		function updatefamily($id,$ipas,$data,$dob)
        {
		//	print_r($data);exit;
		$date = date('Y-m-d h:i:s a', time());
		 $dob =DateTime::createFromFormat('d/m/Y',$dob)->format('Y-m-d');
		$da = array(
		'family_member_name' => $data['name'],
		 'sex' => $data['sex'],
	     'dob' => $dob,
	     'relation_code' => $data['relation'],
         'modified_on' => $date,
		 'modified_by' => $data['ipas']
		 	) ;
           $this->db->where('idrow', $id);
		   $this->db->where('ipas', $ipas);
           $this->db->update('comapp.comm_emp_family',$da);
           if($this->db->affected_rows() > 0)
             {
	     $da = array(
		 'family_verify_status' => 'N',			 
		 'modified_on' => $date,
		 'modified_by' => $ipas
			) ;
			$this->db->where('login_id', $ipas);
            $this->db->update('comapp.comm_app_login',$da);
           return 1;
           }
          else
		  {
         return 0;
		  }
        }
		 public function addnewmember($user_id,$data,$dob)
	 {	
	  $date = date('Y-m-d h:i:s a', time());
	  $dob =DateTime::createFromFormat('d/m/Y',$dob)->format('Y-m-d');
	  $sql1=  "select max (member_index) from comapp.comm_emp_family where ipas='$user_id'";
	  $query = $this->db->query("$sql1");
      $row = $query->row();
      $maxmember = $row->max;
	
	//  print_r($data);
/*  //echo  $user_id;

for($i = 0; $i<$count; $i++){ */
$entries[] = array(
'ipas'=> $user_id,
'family_member_name'=>$data['name'],
'sex'=>$data['sex'],
'dob'=>$dob,
'relation_code'=>$data['relation'],
'member_index'=>$maxmember+1,
'active_flag'=>'Y',
'declaration_date'=>$date,
'entry_on'=>$date,
'entry_by'=>$user_id,
);
/* } */
$this->db->insert_batch('comapp.comm_emp_family', $entries);
if($this->db->affected_rows() > 0)
{
	 $da = array(
		 'family_verify_status' => 'N',			 
		 'modified_on' => $date,
		 'modified_by' => $user_id
			) ;
			$this->db->where('login_id', $user_id);
            $this->db->update('comapp.comm_app_login',$da);
return 1;
}
else
return 0;
	 }
	  public function deactivefamily($id)
 {
 // $date = date('d/m/Y');
 $date = date('Y-m-d h:i:s a', time());
   $user_data=unserialize($this->session->user);
	$empid = $user_data[0]->login_id;
  $this->db->where('idrow', $id);
  $this->db->update('comapp.comm_emp_family',array('active_flag' =>'D','modified_by'=>$empid,'modified_on'=>$date) );
      return TRUE; 

   
  }
  		 public function activefamily($id)
 {
 // $date = date('d/m/Y');
 $date = date('Y-m-d h:i:s a', time());
   $user_data=unserialize($this->session->user);
	$empid = $user_data[0]->login_id;
  $this->db->where('idrow', $id);
  $this->db->update('comapp.comm_emp_family',array('active_flag' =>'Y','modified_by'=>$empid,'modified_on'=>$date) );
      return TRUE; 

   
  }
   public function changenonrdso($data,$valid,$dob)
 {
 
 $date = date('Y-m-d h:i:s a', time());
 $user_data=unserialize($this->session->user);
 $aadhar = $user_data[0]->aadhar_no;
 $newdob = DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d');
 $valid1 = DateTime::createFromFormat('d/m/Y', $valid)->format('Y-m-d');
	$da=
	array('name' =>$data['name'],'fname' =>$data['fname'],'dob' =>$newdob,
	      'nodal_dte' =>$data['direct'],'mobno' =>$data['mobno'],'email' =>$data['email'],'modified_by'=>$aadhar,'modified_on'=>$date);
	//print_r($da);exit;
    $this->db->where('aadhar_no', $aadhar);
   if($this->db->update('comapp.comm_app_profile_nonrdso', $da))
   {
	  if ($valid1!='')
	  {
		$da=  array('validupto_nonrdso' =>$valid1,'modified_by'=>$aadhar,'modified_on'=>$date);
	//print_r($da);exit;
    $this->db->where('aadhar_no', $aadhar);
   if($this->db->update('comapp.comm_app_login_master', $da))
	  		  
      return TRUE; 
	  }
   
  }
}
 public function changerolediradmin()
 {
	 $date = date('Y-m-d h:i:s a', time());
   $user_data=unserialize($this->session->user1);
	$empid = $user_data[0]->login_id;
	$dteid = $user_data[0]->dte_id;
  $this->db->where('ipasid', $empid);
 if($this->db->update('comapp.comm_app_login_master',array('role' =>'7','modified_by'=>$empid,'modified_on'=>$date) ))
 {
$this->db->where('ipasid', $empid);
$this->db->where('dte_id', $dteid);
 $this->db->update('comapp.comm_verify_role',array('ipasid' =>'','modified_by'=>$empid,'modified_on'=>$date) ) ;
 	return TRUE;    
  } else { return FALSE;}
}
}
?>
