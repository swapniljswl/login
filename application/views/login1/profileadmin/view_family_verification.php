<script src="<?php echo base_url('assets/js/jquery/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/jquery/bootstrap-datepicker.min.js'); ?>"> </script>
<link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet">
<?php  
$user_data=unserialize($this->session->user);
$user_name = $user_data[0]->name;
$user_desig = $user_data[0]->desig_desc; ?>
<div class="content">
	      <div class="content-wrapper">
               
      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
		 </span>
          </div>
  <div id="dialog" style="display: none"></div>
	   <div  class="row form-group" >
   <div class="col-md-12" align="text-center">
          <h5 style="color: blue";>Family Verification/परिवार सत्यापन</h5>
        </div>
		   </div> 
<fieldset class="fset">
  	<legend class="legend">Employee Family details/कर्मचारी परिवार विवरण <label style="font-weight: bold; color: red" id="lblfamily_verified"></label></legend>
  	<div class='col-md-12 row' >
  		<div class="col-md-3">
			<label class="control-label label text-primary">Pass Account No/पास खाता संख्या : </label>
			<label class="control-label label"><?php echo $get_emp_email['pass_acct_no']; ?></label>  
		</div>
		<div class="col-md-3">
			<label class="control-label label text-primary">Mobile No/मोबाइल : </label>
			<label class="control-label label"><?php echo $get_emp_email['mobno']; ?></label>  
		</div>
		<div class="col-md-3">
			<label class="control-label label text-primary">Rly (O) : </label>
			<label class="control-label label"><?php echo $get_emp_email['rly_ph_off']; ?></label>  
		</div>

  	</div>
<br/>
  	<?php $counter=0; ?>
	<div class='col-md-12 table-responsive' >
		<table class="table table-condensed table-hover" id="table_family_details" style="width: 100%">
        <!-- <table id="table_family_details" class="border_table" style="width: 100%">  -->
		<colgroup>

    		<col style="width:5%"/>
    		<col style="width:25%"/>
    		<col style="width:25%"/>
    		<col style="width:20%"/>
    	</colgroup>
    <tbody> 

    	<tr>
    		<th> Sr./क्रमांक</th>
    		<th> Name/नाम </th>
    		<th> Relation/रिश्ता</th>
    		<th> DOB/जन्म तिथि </th>
    	</tr>
    	<?php
    		foreach($family_data as $row)
    		{
    			echo '<tr>';
    			echo '<td>'.++$counter.'</td>';
    			echo '<td>'.$row['name'].'</td>';
    			echo '<td>'.$row['relation_desc'].'</td>';
    			echo '<td>'.$row['dob'].'</td>';
    			echo '</tr>';
    		}
    	?>

	</tbody></table>
      </div>	


</fieldset> 
    	<br>
    	<fieldset class="fset">
  	<legend class="legend">Family Verification/परिवार सत्यापन<label style="font-weight: bold; color: red" id="lblfamily_verified"></label></legend>
	<div class="col-md-12 row"> 
		<div class="col-md-4">
					
				    <select id="DDaction" name="DDaction" >
                      <option value="0">Select Action</option>
                      <option value="V">Family Details and Pass A/c no. is Verified</option>
                      <option value="R">Family Details and Pass A/c no. is Rejected</option>
                    </select>
		</div>

		<div class="col-md-2">
					
		<input type="button" class="btn btn-outline-primary btn-sm btn-default" id="bt_submit" value="Submit">
		</div>
		<div class="col-md-6">
					
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
		
		//**Imp - Remarks start - In case of rejection to insert Rejections remarks, status='R' etc in family_verification_history table  for an employee. It will also update the family_verify_status of comm_app_login table

		var rejection_info={
              
                'rejection_remarks'	:  $('#txtRejectRemarks').val(),
                'status'	:  'R',
				        'empno'	: '<?php echo $get_emp_email['login_id']; ?>',
				        'emp_mail' : '<?php echo $get_emp_email['email']; ?>',
				        'admin_name' : '<?php  echo $user_name; ?>',
				        'admin_desig' : '<?php  echo $user_desig; ?>',
                'selected_dir_id' : '<?php echo $dir; ?>',
				
              };	

		  rejection_info=JSON.stringify(rejection_info);

			$.ajax({
                type:"POST",
                url:"<?php echo base_url('FamilyVerification/reject')?>",
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
 				   msg="Family details rejected successfully";
                    window.alert(msg);
                   window.opener.location.reload(true);
                    window.close();
                  }
                },
				        error: function(){
                 msg="Error while employee family verification!";
                 window.alert(msg);
					       }
				}); // $.ajax({
			} //if ($('#txtRejectRemarks').val() == '')

		}  //if($('#DDaction').val()=='R')

	//**Imp - Remarks End 

//**Imp - Remarks start - In case of verification to insert status='V' etc in family_verification_history table  for an employee. It will also update the family_verify_status of comm_app_login table
	if($('#DDaction').val()=='V') 
		{	
		var verification_info={
                'status'	:  'V',
				'empno'	: '<?php echo $get_emp_email['login_id']; ?>',
				'emp_mail' : '<?php echo $get_emp_email['email']; ?>',	
                'selected_dir_id' : '<?php echo $dir; ?>',	
                'admin_name' : '<?php  echo $user_name; ?>',
				'admin_desig' : '<?php  echo $user_desig; ?>',
              };	

		verification_info=JSON.stringify(verification_info);

			$.ajax({
                type:"POST",
                url:"<?php echo base_url('FamilyVerification/emp_family_verify')?>",
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
 				           msg="Family details verified successfully";
                    window.alert(msg);
                    window.opener.location.reload(true);
                    window.close();
                  }
                },
				        error: function(){
                 msg="Error while employee family verification!";
                 window.alert(msg);
					       }
				}); // $.ajax({
			

		}  //if($('#DDaction').val()=='V') 
	//**Imp - Remarks End 


});	//$('#bt_submit').click(function(){


		});  //doument ready
</script>

     
