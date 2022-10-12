<!---<script src="<?php echo base_url('assets/js/jquery/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/jquery/bootstrap-datepicker.min.js'); ?>"> </script>
<link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet"> -->
<?php  
     $user_data=unserialize($this->session->secret);
	 $usertype = $user_data[0]->role; 	
	 $user_data1=unserialize($this->session->user1);
        
	       $user_name = $user_data1[0]->name;
		   $email1 = $user_data1[0]->email;
		   $mobile = $user_data1[0]->mobno;
		   $fname = $user_data1[0]->fname;
		   $emp_dob = $user_data1[0]->dob;
		   $dteid = $user_data1[0]->nodal_dte;
		   $valid = $user_data1[0]->validupto_nonrdso;
		    ?>
	<?php echo form_open('Changeprofile/nonrdsoprofile'); ?>
		<input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
	<div class="content">
	      <div class="content-wrapper">               
      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
		 
          </span>
          </div>
		  <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">			 
           			  
            </thead>
			</table>
		
	         <table class="table table-striped"  id="tblGrid">	
            <tbody>
			  <tr>
			   <font size="3" color="red">*</font> <font size="3" color="voilet"> Indicate Required fields</font> 
			   <?php   $message = $this->session->flashdata('chprof_success');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?>
			  <?php	if ($error = $this->session->flashdata('chpwd_success')) { ?>
               <?= $error ?> 
               </td></tr>
              <?php } ?>
			  </tr>
			  <tr>
			  <td colspan="3">User Name:- <font size="3" color="red">*</font>
			  <?php  echo form_input(array('name'=>'name','placeholder'=>'Name','value'=>set_value('name',$user_name),'class'=>'form-control' ));  " </td>"?>
			   <b> <?php // echo  $user_name ;  ?> </b></td>
			  </tr><tr>
			  <td class="danger" colspan="2">  <?php echo form_error('name',"<p class='text-danger'>","</p>"); ?>	</td>
			   </tr>
              <tr>
					
              <td >Date of Birth <font size="3" color="red">*</font> 
			 	
				<?php 
				if ($emp_dob!='')
				$dob1=	date("d/m/Y", strtotime($emp_dob));
                else
                {
				$dob1=null;	
				}	?>
                 <?php 
			 echo form_input(array('name'=>'dob','type'=>'text','data-date-format'=>'dd/mm/yyyy','data-provide'=>'datepicker','placeholder'=>'dd/mm/yyyy','class'=>'form-control','value'=>set_value('dob',$dob1),'readonly'=>'true')); " </td>"	
				?>
				 <td >Father Name:- <font size="3" color="red">*</font>
				<?php  echo form_input(array('name'=>'fname','placeholder'=>'Father Name','value'=>set_value('fname',$fname),'style'=>'required','class'=>'form-control' ));  " </td>"?>
			
                    
            </tr>
				 <tr>
				 <td class="danger">  <?php echo form_error('dob',"<p class='text-danger'>","</p>"); ?>	</td>
				 <td class="danger" > <?php echo form_error('fname',"<p class='text-danger'>","</p>"); ?>	</td>
			    </tr>
              <tr>
			   <td >Mobile No <font size="3" color="red">*</font>
				 <?php  echo form_input(array('name'=>'mobno','placeholder'=>'Mobile No','value'=>set_value('mobno',$mobile),'class'=>'form-control' ));  " </td>"?>
				
			        <td >Directorate <font size="3" color="red">*</font>
               <select class="form-control" name="direct">
           
			 <?php 
			
            foreach($record1 as $row)
            { ?>
			<option <?php if($row['dte_id'] == $dteid){ echo 'selected="selected"'; } ?> value="<?php echo $row['dte_id']; ?>"<?php echo set_select('direct', $row['dte_id'], False); ?>><?php echo $row['dte_desc'];?> </option>
          <?php  
            }
            ?>	
			
            </select></td>             
			  </tr>
			   <tr>
			   <td class="danger">  <?php echo form_error('mobno',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger" > <?php echo form_error('direct',"<p class='text-danger'>","</p>"); ?>	</td>
			    </tr>
			
			   <tr>
			   <td >Email <font size="3" color="red">*</font>
			     <?php  echo form_input(array('name'=>'email','placeholder'=>'Email ID','value'=>set_value('email',$email1),'class'=>'form-control' ));  " </td>"?>
			
				</td>
                 <td >Validty Upto <font size="3" color="red">*</font> 
			 	
				<?php 
				if ($valid!='')
				$valid1=	date("d/m/Y", strtotime($valid));
                else
                {
				$valid1=null;	
				}	?>
                 <?php 
			 echo form_input(array('name'=>'valid','type'=>'text','data-date-format'=>'dd/mm/yyyy','data-provide'=>'datepicker','placeholder'=>'dd/mm/yyyy','class'=>'form-control','value'=>set_value('dob',$valid1),'readonly'=>'true')); " </td>"	
				?>
                 </tr><tr>
			   <td class="danger">  <?php echo form_error('email',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger" > <?php echo form_error('valid',"<p class='text-danger'>","</p>"); ?>	</td>
			    </tr>				
                      </div> 
			  	 </div>		  
             </tbody>
          </table>
		  <button class="btn btn-danger" type="reset">Reset</button>
		  <?php  echo form_submit(array('name'=>'Submit','value'=>'Submit','class'=>'width-35 pull-center btn btn-sm btn-primary'));?>
                  </form>   

<script>
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});
</script>
 <style type="text/css">
        .table-condensed
        {
            width: 250px;
            height: 10px;
            font-size: 12px;
        }
    </style>	
     
