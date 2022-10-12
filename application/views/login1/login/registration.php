<?php include 'headerlogin.php'; ?>
<script type="text/javascript">  
            window.onbeforeunload = function()  
            {  
                var inputs = document.getElementsByTagName("INPUT");  
                for (var i = 0; i < inputs.length; i++)  
                {  
                    if (inputs[i].type == "button" || inputs[i].type == "submit")  
                    {  
                        inputs[i].disabled = true;  
                    }  
                }  
            };  
        </script>
		<?php //echo form_open('registration/register'); ?>
<fieldset>

			<!-- start: LOGIN BOX -->
			<div class="box-login">
				<h4>New User Registration/ नया उपयोगकर्ता पंजीकरण</h4>
				<?php   $message = $this->session->flashdata('email_sent');
                 if (isset($message)) {
                  echo '<div class="alert alert-info">' . $message . '</div>';
                   $this->session->unset_userdata('message');
                   }
                  ?> 
				<form class="form-login" action="<?=base_url()."registration/register"; ?>" method="post" >
					<input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
					<fieldset>
					<div class="form-group" >
					<span class="input-icon">
					<input type="radio" id="rdso" name="typeuser" value="1"  autocomplete="off" checked required> RDSO User
                    <input type="radio" id="nonrdso" name="typeuser" value="2"  autocomplete="off" required> Non RDSO User<br>
					  </div>
						<div class="form-group" id="empno">Emp No / कर्मचारी सं (Allowed Chars- a-z 0-9 /-.,.)
						<span class="input-icon">
						<?php  echo form_input(array('name'=>'empno','placeholder'=>'Emp No/ कर्मचारी सं ','maxlength' => '11','class'=>'form-control','value'=>set_value('empno'),'required' => 'required'));?>	
						<?php echo form_error('empno',"<p class='text-danger'>","</p>"); ?>	
							<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group" id="aadhar" style="display:none">Unique Id / युनिक  आईडी (Only Numeric allowed)
							<span class="input-icon">
							<?php  echo form_input(array('name'=>'aadharno','type'=>'number','placeholder'=>'Unique Id / युनिक  आईडी','maxlength' => '12','class'=>'form-control','value'=>set_value('aadharno'),'required' => 'required'));?>	
							<?php echo form_error('aadharno',"<p class='text-danger'>","</p>"); ?>	
							<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group" id="aadhar" >Name / नाम (Allowed Chars- a-z 0-9 /-.,.)
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'username','placeholder'=>'Name / नाम','class'=>'form-control','value'=>set_value('username'),'required' => 'required' ));?>	
								<?php echo form_error('username',"<p class='text-danger'>","</p>"); ?>	
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">Email/ ईमेल
							<span class="input-icon">
							<?php  echo form_input(array('name'=>'email','placeholder'=>'Email Id / ईमेल','class'=>'form-control','value'=>set_value('email'),'required' => 'required' ));?>
							<?php echo form_error('email',"<p class='text-danger'>","</p>"); ?>		
								<i class="fa fa-envelope"></i>
								 </span>
						</div>
						<div class="form-group form-actions">Mobile No/ मोबाइल  नं
							<span class="input-icon">
								<?php  echo form_input(array('name'=>'mobile','type'=>'number','placeholder'=>'Mobile No/मोबाइल  नं','maxlength' => '10','class'=>'form-control','value'=>set_value('mobile'),'required' => 'required' ));?>
							<?php echo form_error('mobile',"<p class='text-danger'>","</p>"); ?>	
							<i class="fa fa-phone"></i>
								 </span>
						</div>
						<div class="form-group form-actions" id="desig">
							<span class="input-icon">
								<select class="form-control" name="desg" required>
                                <?php 
                                 echo '<option value="">Designation / पद</option>';
                              foreach($records as $row)
                                   { ?>
								<option value="<?php echo $row['desig_id']; ?>"<?php echo set_select('desg', $row['desig_id'], False); ?> ><?php echo $row['desig_desc'];?> </option>		
                                <?php  //echo '<option value="'.$row->desig_id.'">'.$row->desig_desc.'</option>';
                                    }
                                 ?>
                                     </select>
								 <?php echo form_error('desg',"<p class='text-danger'>","</p>"); ?>
								 </span>
						</div>
						<div class="form-group form-actions" >
							<span class="input-icon">
							<select class="form-control" name="direc" required>	
								  <?php 
                               echo '<option value="">Directorate/ निदेशालय</option>';
                                 foreach($record1 as $row)
                                    { ?>
                                <option value="<?php echo $row['dte_id']; ?>"<?php echo set_select('direc', $row['dte_id'], False); ?> ><?php echo $row['dte_desc'];?> </option>	
							<?php  //echo '<option value="'.$row->dte_id.'">'.$row->dte_desc.'</option>';
                                   }
                                   ?>
                                </select>
								<?php echo form_error('direc',"<p class='text-danger'>","</p>"); ?>
								 </span>
						</div>
						<div class="form-group form-actions" >
							<span class="input-icon">
						<button type="reset" class="width-30 pull-left btn btn-sm">
                         <i class="ace-icon fa fa-refresh"></i>
                         <span class="bigger-110">Reset/ रीसेट</span>
                           </button>
	                       <?php  echo form_submit(array('name'=>'signup','value'=>'Register/ रजिस्टर करें ','class'=>'width-35 pull-right btn btn-sm btn-primary'));?>	
							
								 </span>
						</div>
					
					</fieldset>
					<div class="toolbar center">
                  <a href="<?php echo base_url('user_login'); ?>" data-target="#signup-box" class="user-signup-link">
                   Back to Login/लॉगिन पर वापस जाएं
                   <i class="ace-icon fa fa-arrow-right"></i>
                  </a>
                  </div>
				</form>
			</div>
			
		</div>
<?php include 'footerlogin.php'; ?>
<script>
$(document).ready(function () {
    $('#rdso').click(function () {
        $('#aadhar').hide('fast');
		$('#empno').show('fast');
        $('#desig').show('fast');
	   
    //    $('#div1').show('fast');
    });
    $('#nonrdso').click(function () {
		$('#aadhar').show('fast');
        $('#empno').hide('fast');
        $('#desig').hide('fast');
    });
	
  
});	
</script>
<script>
$( 'input[type="checkbox"]' ).prop('checked', false);

</script>