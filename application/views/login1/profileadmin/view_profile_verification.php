

<script src="<?php echo base_url('assets/js/jquery/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/jquery/bootstrap-datepicker.min.js'); ?>"> 

hr {
    height: 20px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}

</script>
<link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet">
<?php  

$user_data=unserialize($this->session->user);
$user_name = $user_data[0]->name;
$user_desig = $user_data[0]->desig_desc; ?>
?>
	<div class="content">
	      <div class="content-wrapper">
               
      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
		 <?php  echo 'Welcome Profile Admin!! '.$user_name. ',' .$user_desig  ; ?> 
		  </span>
          </div>
  <div id="dialog" style="display: none"></div>
	  <div  class="row form-group" >
   <div class="col-md-12" align="text-center">
          <h5 style="color: blue";>Profile Verification/प्रोफ़ाइल सत्यापन</h5>
        </div>
		   </div>  
<fieldset class="fset">
  	<legend class="legend">Employe Profile details/कर्मचारी प्रोफ़ाइल विवरण <label style="font-weight: bold; color: red" id="lblfamily_verified"></label></legend>
		<div class="col-md-12 row">
				<div class="col-md-2">
					<label class="control-label label text-primary">Name/नाम  </label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['name'] ; ?></label>  
		        </div>
				<div class="col-md-2">
					<label class="control-label label text-primary">Designation/पद</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label" ><?php echo $get_emp_details['desig_desc'] ; ?></label>  
		        </div>
				<div class="col-md-2">
					<label class="control-label label text-primary">Directorate/निदेशालय</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label" ><?php echo $get_emp_details['dte_desc'] ; ?></label>  
	        </div>
    	</div>
	
		<hr/> 

	 	<div class="col-md-12 row">

	 		<div class="col-md-2">
					<label class="control-label label text-primary">Employee No./कर्मचारी सं</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label" id="lbllogin_id"><?php echo $get_emp_details['login_id'] ; ?></label>  
		        </div>
				<div class="col-md-2">
					<label class="control-label label text-primary">Dt of Birth/जन्म तिथि </label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['emp_dob'] ; ?></label>  
		        </div>
				<div class="col-md-2">
					<label class="control-label label text-primary">Father Name/पिता का नाम </label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['fname'] ; ?></label>  
		        </div>
		       
    	</div>
		<hr/> 

		<div class="col-md-12 row">
				<div class="col-md-2">
					<label class="control-label label text-primary">Dt of Appointment/नियुक्ति   (Rly)</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['init_doa'] ; ?></label>  
		        </div>
				<div class="col-md-2">
					<label class="control-label label text-primary">Dt of Appointment/नियुक्ति    (RDSO)</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['doa_rdso'] ; ?></label>  
		        </div>
		        <div class="col-md-2">
					<label class="control-label label text-primary">Dt of Retirement/सेवानिवृत्ति  तिथि</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label" ><?php echo $get_emp_details['dt_retirement'] ; ?></label>  
		        </div>
    	</div>
		   
		 <hr/>  
		

		<div class="col-md-12 row">
				<div class="col-md-2">
					<label class="control-label label text-primary">Pay Level/वेतन स्तर</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['pay_level'] ; ?></label>  
		        </div>
				<div class="col-md-2">
					<label class="control-label label text-primary">Current Basic/वर्तमान मूल</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['cur_basic'] ; ?></label>  
		        </div>
		        <div class="col-md-2">
					<label class="control-label label text-primary">Marital Status/ वैवाहिक स्थिति </label>
				</div>
				<div class="col-md-2">
					<?php if ($get_emp_details['marital_status'] == 'M')  
					{ ?>
			       <label class="control-label label">Married</label>  
			   		<?php } 
					elseif ($get_emp_details['marital_status'] == 'U')  
					{ ?>
						 <label class="control-label label">Unmarried</label> 
					<?php }  ?>
		        </div>
		        </div>
		<hr/> 

<div class="col-md-12 row">

			<div class="col-md-1">
					<label class="control-label label text-primary">Gaz./राजपत्रित</label>
				</div>
				<div class="col-md-2">
					<?php if ($get_emp_details['gaz_nongz'] == 'Y')  
					{ ?>
			       <label class="control-label label">Yes</label>  
			   		<?php } 
					elseif ($get_emp_details['gaz_nongz'] == 'N')  
					{ ?>
						 <label class="control-label label">No</label> 
					<?php }  ?>
		        </div>
				<div class="col-md-1">
					<label class="control-label label text-primary">Group/ समूह</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['group'] ; ?></label>  
		        </div>

		         <div class="col-md-1">
					<label class="control-label label text-primary">Gender/लिंग </label>
				</div>
				<div class="col-md-2">
					<?php if ($get_emp_details['emp_sex'] == 'M')  
					{ ?>
			       <label class="control-label label">Male</label>  
			   		<?php } 
					elseif ($get_emp_details['emp_sex'] == 'F')  
					{ ?>
						 <label class="control-label label">Female</label> 
					<?php }  ?>
		        </div>
				<div class="col-md-1">
					<label class="control-label label text-primary">Rly</label>
				</div>
				<div class="col-md-2">
			       <label class="control-label label"><?php echo $get_emp_details['rly'] ; ?></label>  
		        </div>
	  	</div>
</fieldset> 
    	<br>
    	<fieldset class="fset">
  	<legend class="legend">Profile Verification<label style="font-weight: bold; color: red" id="lblfamily_verified"></label></legend>
	<div class="col-md-12 row"> 
		<div class="col-md-3">
					
				    <select id="DDaction" name="DDaction" >
                      <option value="0">Select Action</option>
                      <option value="V">Employee Profile Verified</option>
                      <option value="R">Employee Profile Rejected</option>
                    </select>
		</div>

		<div class="col-md-2">
					
		<input type="button" class="btn btn-outline-primary btn-sm btn-default" id="bt_submit" value="Submit">
		</div>
		<div class="col-md-7">
					
		<input type="text" class="hide" size="50" id="txtRejectRemarks" name="txtRejectRemarks"  maxlength="49" placeholder="Please give reason for rejection">        
		</div>
		</div>
		</fieldset> 
		
<script type="text/javascript">
$(document).ready(function(){

			
	$('#DDaction').change(function() {
	if ($('#DDaction').val()=='R')
	{

	$('#txtRejectRemarks').removeClass('hide');
	$('#txtRejectRemarks').addClass('show');
	
	}
	else
	{
	$('#txtRejectRemarks').removeClass('show');
	$('#txtRejectRemarks').addClass('hide');
	}
	});	 //DDaction change

$('#bt_submit').click(function(){
  	
		if($('#DDaction').val()=='0') {	
			msg="Please select the action from dropdown";
                window.alert(msg);
				return false;
		}	
			
		if($('#DDaction').val()=='R') 
		{	
			
			if ($('#txtRejectRemarks').val() == '')
			{
			msg="Please give the proper reason for rejection";
                 window.alert(msg);
				return false;
		}	

		else
		{
		
		//**Imp - Remarks start - In case of rejection to insert Rejections remarks, status='R' etc in profile_verification_history table  for an employee. It will also update the profile_verify_status of comm_app_login table

		var rejection_info={
              
               'rejection_remarks'	:  $('#txtRejectRemarks').val(),
               'status'	:  'R',
				'empno'	: '<?php echo $get_emp_details['login_id']; ?>',
				'emp_mail' : '<?php echo $get_emp_details['email']; ?>',
				'admin_name' : '<?php  echo $user_name; ?>',
				'admin_desig' : '<?php  echo $user_desig; ?>',
				'selected_dir_id' : '<?php echo $dir; ?>',	
							
              };	

		rejection_info=JSON.stringify(rejection_info);

			$.ajax({
                type:"POST",
                url:"<?php echo base_url('ProfileVerification/reject')?>",
                data:{csrf_token:csrf_token,rejection_data  : rejection_info},
                 //data:{rejection_data : rejection_info },
  				success:function(response){
                  response=JSON.parse(response);
                   csrf_token=response.csrf_token  
                  if(response.error==true)
                  {
                    window.alert (response.error_msg)
                  }
                  else
                  {
 				   msg="Profile rejected successfully";
                    window.alert(msg);
                  	window.opener.location.reload(true);
           		   window.close();
                  }
                },
				error: function(){
                 msg="Error while employee profile rejection!";
                 window.alert(msg);
					} 
				}); // $.ajax({
			} //if ($('#txtRejectRemarks').val() == '')

		}  //if($('#DDaction').val()=='R')

	//**Imp - Remarks End 

//**Imp - Remarks start - In case of verification to insert status='V' etc in profile_verification_history table  for an employee. It will also update the profile_verify_status of comm_app_login table
	if($('#DDaction').val()=='V') 
		{	
		var verification_info={
                'status'	:  'V',
				'empno'	: '<?php echo $get_emp_details['login_id']; ?>',
				'emp_mail' : '<?php echo $get_emp_details['email']; ?>',
				'selected_dir_id' : '<?php echo $dir; ?>',
				'admin_name' : '<?php  echo $user_name; ?>',
				'admin_desig' : '<?php  echo $user_desig; ?>',	
              };	

		verification_info=JSON.stringify(verification_info);

			$.ajax({
                type:"POST",
                url:"<?php echo base_url('ProfileVerification/emp_profile_verify')?>",
                 data:{csrf_token:csrf_token,verification_data  : verification_info},
                 //data:{verification_data : verification_info },
  				success:function(response){
                  response=JSON.parse(response);
                    csrf_token=response.csrf_token  
                  if(response.error==true)
                  {
                   window.alert(response.error_msg);
                  }
                  else
                  {
 				   msg="Profile verified successfully";
                    window.alert(msg);
					window.opener.location.reload(true);
           		   window.close();

                    }
                },
				error: function(){
                 msg="Error while employee profile verification!";
                 window.alert(msg);
					} 
				}); // $.ajax({
			

		}  //if($('#DDaction').val()=='V') 
	//**Imp - Remarks End 

});	//$('#bt_submit').click(function(){


		});  //doument ready
</script>

