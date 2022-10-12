<!---<script src="<?php echo base_url('assets/js/jquery/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/jquery/bootstrap-datepicker.min.js'); ?>"> </script>
<link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet"> -->
<?php  
     $user_data=unserialize($this->session->secret);
	 $usertype = $user_data[0]->role; 
	
	// echo $aadharno;exit;
	 $user_data1=unserialize($this->session->user1);
        
	       $user_name = $user_data1[0]->name;
		   $desig = $user_data1[0]->desig_id;
		   $email1 = $user_data1[0]->email;
		   $mobile = $user_data1[0]->mobno;
		   $qtrno = $user_data1[0]->address;
		   $rlyphoff = $user_data1[0]->rly_ph_off; 
		   $rlyphhome = $user_data1[0]->rly_ph_home; 	              
           $desigid = $user_data1[0]->desig_id; 
		   $gaz = $user_data1[0]->gaz_nongz; 
		   $desigdesc = $user_data1[0]->desig_desc;
		   $dteid = $user_data1[0]->dte_id; 
		   $dtedesc = $user_data1[0]->dte_desc;
		   $bldgdesc = $user_data1[0]->bldg_desc; 
		   $bldgid = $user_data1[0]->bldg_id;
           $group = $user_data1[0]->group;
		   $fname = $user_data1[0]->fname;
		   $emp_dob = $user_data1[0]->emp_dob;
		   $marital_status = $user_data1[0]->marital_status;
		   $emp_sex = $user_data1[0]->emp_sex;
		   $cur_basic = $user_data1[0]->cur_basic;
		   $gradepay = $user_data1[0]->grade_pay;
		   $dt_retirement = $user_data1[0]->dt_retirement;
		   $init_doa = $user_data1[0]->init_doa;
		   $pay_level = $user_data1[0]->pay_level;
		   $pass_acct_no = $user_data1[0]->pass_acct_no;
		   $doa_rdso = $user_data1[0]->doa_rdso;
		   $profile = $user_data1[0]->profile_verify_status;
		    $aadharno = $user_data1[0]->aadhar_no;
		  //echo $profile;exit;
		   
			  ?>
	<?php echo form_open('Changeprofile/changeprof'); ?>
	<div class="content">
	      <div class="content-wrapper">               
      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
		 
          </span>
          </div>
	<?php echo form_open('Changeprofile/changeprof'); ?>
	<input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
	<h4 class="text-center" style="color: blue";>Update Profile Data / प्रोफ़ाइल डेटा अपडेट करें</h4>
	          
				  <?php if (($profile=='') or ($profile =='N')) { ?>
			 <p style="color:red;"><marquee>Your Profile has not been Verified by Establishment Section.</marquee> </p>
			  <?PHP  } elseif ($profile=='V') { ?>
			 <p style="color:green;"><marquee>Your Profile has been Verified by Establishment Section. </marquee> </p>
			  <?php  } 
				 elseif ($profile=='R') { ?>
			 <p style="color:red;"><marquee>Your Profile has been Rejected by Establishment Section. </marquee> </p>
			  <?php  } ?> 	         
		
	         <table class="table table-striped"  id="tblGrid">	
            <tbody>
			  <tr>
			   <font size="3" color="red">*</font> <font size="3" color="voilet"> Indicate Required fields. Allowed characters - a-z 0-9 /-.,.</font> 
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
			  <td colspan="3">User Name:- / उपयोगकर्ता नाम:- * <font size="3" color="red">*</font>
			  <?php  echo form_input(array('name'=>'name','placeholder'=>'Name','value'=>set_value('name',$user_name),'class'=>'form-control','maxlength' => '100' ));  " </td>"?>
			   <b> <?php // echo  $user_name ;  ?> </b></td>
			  </tr>
			  <td class="danger" colspan="3">  <?php echo form_error('name',"<p class='text-danger'>","</p>"); ?>	</td>
			   </tr>
              <tr>
				<td >Gender / लिंग <font size="3" color="red">*</font>
			  <select class="form-control" name="sex" id="sex" >
            <?php 
		    	if ($emp_sex =="M")
				{ ?>
			   <option value="M" <?php echo set_select('sex', 'M'); ?> >Male</option>
               <option value="F" <?php echo set_select('sex', 'F'); ?> >Female</option>
				
			 <?php	}
				elseif ($emp_sex =="F")
				{?>
				<option value="F" <?php echo set_select('sex', 'F'); ?> >Female</option>
			   <option value="M" <?php echo set_select('sex', 'M'); ?> >Male</option>
               				
			 <?php }
				elseif ($emp_sex =="")
				{ ?>
				<option value=""  >Select</option>
				<option value="M" <?php echo set_select('sex', 'M'); ?> >Male</option>
				<option value="F" <?php echo set_select('sex', 'F'); ?> >Female</option>
			    
               				
			 <?php   } ?>
            </select>
			</td>
			
              <td >Date of Birth / जन्म तिथि  <font size="3" color="red">*</font> 
			 	
				<?php 
				if ($emp_dob!='')
				$dob1=	date("d/m/Y", strtotime($emp_dob));
                else
                {
				$dob1=null;	
				}	?>
                 <?php 
			 echo form_input(array('name'=>'dob','id'=>'dob','type'=>'text','data-date-format'=>'dd/mm/yyyy','data-provide'=>'datepicker','placeholder'=>'dd/mm/yyyy','class'=>'form-control','value'=>set_value('dob',$dob1),'readonly'=>'true')); " </td>"	
				?>

                <td >Marital Status/ वैवाहिक स्थिति <font size="3" color="red">*</font>
			  <select class="form-control" name="maritalstatus" >
            <?php 
					
			   if ($marital_status == "")
				{
              echo '<option value="">select</option>'; ?>
              <option value="M" <?php echo set_select('maritalstatus', 'M'); ?> >Married</option>
			  <option value="U" <?php echo set_select('maritalstatus', 'U'); ?> >Unmarried</option>
			  <option value="D" <?php echo set_select('maritalstatus', 'D'); ?> >Divorced</option>
				<?php }
				elseif ($marital_status == "M")
				{ ?>				
			  <option value="M" <?php echo set_select('maritalstatus', 'M'); ?> >Married</option>
			  <option value="U" <?php echo set_select('maritalstatus', 'U'); ?> >Unmarried</option>
			  <option value="D" <?php echo set_select('maritalstatus', 'D'); ?> >Divorced</option>
			  <?php
				}
				elseif ($marital_status == "U")
				{ ?>				
			   <option value="U" <?php echo set_select('maritalstatus', 'U'); ?> >Unmarried</option>
               <option value="M" <?php echo set_select('maritalstatus', 'M'); ?> >Married</option>
			   <option value="D" <?php echo set_select('maritalstatus', 'D'); ?> >Divorced</option>
			<?php	}
				elseif ($marital_status == "D")
				{
            ?>
			   <option value="D" <?php echo set_select('maritalstatus', 'D'); ?> >Divorced</option>
			   <option value="U" <?php echo set_select('maritalstatus', 'U'); ?> >Unmarried</option>
               <option value="M" <?php echo set_select('maritalstatus', 'M'); ?> >Married</option>			   
			<?php	} ?>
            </select>
			</td>
			
				</tr>
				 <tr>
				 <td class="danger">  <?php echo form_error('sex',"<p class='text-danger'>","</p>"); ?>	</td>
			    <td class="danger" > <?php echo form_error('dob',"<p class='text-danger'>","</p>"); ?>	</td>
				 <td class="danger" > <?php echo form_error('maritalstatus',"<p class='text-danger'>","</p>"); ?>	</td>
			    </tr>
              <tr>
			  <td >Father Name/पिता का नाम :- <font size="3" color="red"></font>
				<?php  echo form_input(array('name'=>'fname','placeholder'=>'Father Name','value'=>set_value('fname',$fname),'style'=>'required','class'=>'form-control','maxlength' => '60' ));  " </td>"?>
			  
			  <td >Designation/ पद <font size="3" color="red">*</font>
              <select class="form-control" name="desg">
            
			<?php 
			
            foreach($records as $row)
            { 	
			?>
			<option <?php if($row['desig_id'] == $desigid){ echo 'selected="selected"'; } ?> value="<?php echo $row['desig_id']; ?>"<?php echo set_select('desg', $row['desig_id'], False); ?> ><?php echo $row['desig_desc'];?> </option>
			    
			        
			<?php 
			} 
           ?>
            </select>
               </td>
                <td >Directorate/ निदेशालय  <font size="3" color="red">*</font>
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
			   <td class="danger">  <?php echo form_error('fname',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger">  <?php echo form_error('desg',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger" > <?php echo form_error('direct',"<p class='text-danger'>","</p>"); ?>	</td>
			    </tr>
			  <tr>
			  <td >Pay Level / वेतन स्तर <font size="3" color="red">*</font>
               <select class="form-control" name="level"  id="level" >
              <option value=""  >Select</option>   
           <?php 
				   		
            foreach($record4 as $row)
            { 
			
			?>
                       
			<option <?php if($row['level_srt'] == $pay_level){ echo 'selected="selected"'; } ?> value="<?php echo $row['level_srt']; ?>"<?php echo set_select('level', $row['level_desc'], False); ?>><?php echo $row['level_desc'];?> </option>
          <?php  
            }
            ?>
            </select>
			
			</td>
			  <td >Current Basic/ वर्तमान मूल <font size="3" color="red">*</font>
				<select class="form-control form-control-sm" name='level_code' id='level_code' >
                <?php   echo '<option value="'.$cur_basic.'">'.$cur_basic.'</option>'; ?>
			    </select>
			   <td >Railway / रेलवे 
                <?php  echo form_input(array('name'=>'railway','placeholder'=>'RDSO','value'=>'RDSO','class'=>'form-control','readonly'=>'true' ));?></td>			 			
               </tr>
			   <tr>
			   <td class="danger" > <?php echo form_error('level',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger">  <?php echo form_error('level_code',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger"><?php echo form_error('railway',"<p class='text-danger'>","</p>"); ?>	</td>			   
              </tr>
               <tr>
			   <td >Date of Appointment/ नियुक्ति की तिथि  (Railway)<font size="3" color="red"></font>
			   
				<?php 
				if ($init_doa!=''){
					$initdoa=	date("d/m/Y", strtotime($init_doa)); 
			  		}
					else
					{
					$initdoa=null;	
					}
				
			?>
              
  			 <?php 
			 echo form_input(array('name'=>'doarail','type'=>'text','data-date-format'=>'dd/mm/yyyy','data-provide'=>'datepicker','placeholder'=>'dd/mm/yyyy','class'=>'form-control','value'=>set_value('doarail',$initdoa),'readonly'=>'true')); " </td>"	
				?>
			     <td >Date of Appointment/ नियुक्ति की तिथि (RDSO)  <font size="3" color="red"></font>
				  <?php 
				 	 
				if ($doa_rdso!='')
				$doardso=	date("d/m/Y", strtotime($doa_rdso));
                else
                {
				$doardso=null;	
				}					
				  
				  
		    	 echo form_input(array('name'=>'doardso','type'=>'text','data-date-format'=>'dd/mm/yyyy','data-provide'=>'datepicker','placeholder'=>'dd/mm/yyyy','class'=>'form-control','value'=>set_value('doardso',$doardso),'readonly'=>'true')); " </td>"	
				?>
			    
			   <td >Date of Retirement / सेवानिवृत्ति की तिथि <font size="3" color="red"></font>
			     <?php 
				//  $dtretirement=	date("d/m/Y", strtotime($dt_retirement));
				 	 
				if ($dt_retirement!='')
				$dtretirement=	date("d/m/Y", strtotime($dt_retirement));
                else
                {
				$dtretirement=null;	
				}					
				  
		    	 echo form_input(array('name'=>'dor','id'=>'dor','type'=>'text','data-date-format'=>'dd/mm/yyyy','data-provide'=>'datepicker','placeholder'=>'dd/mm/yyyy','class'=>'form-control','value'=>set_value('dor',$dtretirement),'readonly'=>'true')); " </td>"	
				?>
			 <tr>
			   <td class="danger">  <?php echo form_error('doarail',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger">  <?php echo form_error('doardso',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger" > <?php echo form_error('dor',"<p class='text-danger'>","</p>"); ?>	</td>
			
              </tr>
			    <tr>
				 <td >Gaz/Non-Gaz <font size="3" color="red">*</font>
			  <select class="form-control" name="gaz" >
            <?php 
					
			   if ($gaz == "")
				{
              echo '<option value="">select</option>'; ?>
              <option value="Y" <?php echo set_select('gaz', 'Y'); ?> >Gaz</option>
			  <option value="N" <?php echo set_select('gaz', 'N'); ?> >Non-Gaz</option>
				<?php }
				elseif ($gaz == "Y")
				{ ?>
			  <option value="Y" <?php echo set_select('gaz', 'Y'); ?> >Gaz</option>
			  <option value="N" <?php echo set_select('gaz', 'N'); ?> >Non-Gaz</option>
			  
			  <?php
				}
				elseif ($gaz == "N")
				{ ?>				
			   <option value="N" <?php echo set_select('gaz', 'N'); ?> >Non-Gaz</option>
               <option value="Y" <?php echo set_select('gaz', 'Y'); ?> >Gaz</option>
			<?php	}
				
            ?>
            </select>
			</td>
				
                 <td >Group/ समूह <font size="3" color="red">*</font>
                <select class="form-control" name="grp">
			  <?php if ($group == 'A')
		     	{ echo '<option value="'.$group.'">'.$group.'</option>';  ?>
		       <option value="B" <?php echo set_select('grp', 'B'); ?> >B</option>
                <option value="C" <?php echo set_select('grp', 'C'); ?> >C</option>
			  <?php  } elseif ($group == 'B')  {
			   echo '<option value="'.$group.'">'.$group.'</option>';  ?>
			    <option value="A" <?php echo set_select('grp', 'A'); ?> >A</option>
                <option value="C" <?php echo set_select('grp', 'C'); ?> >C</option>
				<?php  } elseif ($group == 'C')  {
				 echo '<option value="'.$group.'">'.$group.'</option>';  ?>
			    <option value="A" <?php echo set_select('grp', 'A'); ?> >A</option>
                <option value="B" <?php echo set_select('grp', 'B'); ?> >B</option>
								<?php  }  elseif ($group == '')  { ?>
				<option value="" <?php echo set_select('grp', '', TRUE); ?> >Select</option>				
				<option value="A" <?php echo set_select('grp', 'A'); ?> >A</option>
                <option value="B" <?php echo set_select('grp', 'B'); ?> >B</option>
				 <option value="C" <?php echo set_select('grp', 'C'); ?> >C</option>
				<?php } ?>
              </select></td>
			 <td >Pass Account No / पास खाता संख्या  <font size="3" color="red">(Format: X-999)</font>
			  <?php  echo form_input(array( 'pattern'=>'regexp','name'=>'passac','placeholder'=>'Pass Account No','pattern'=>'([A-Z]{1})+-([0-9.]{1,})','value'=>set_value('passac',$pass_acct_no),'class'=>'form-control','maxlength' => '10' ));  " </td>"?>
			
			  </tr>
			  
			   <tr>
			   <td class="danger"><?php echo form_error('gaz',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger" ><?php echo form_error('grp',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger" ><?php echo form_error('passac',"<p class='text-danger'>","</p>"); ?>	</td>
              </tr>
			   <tr>
			   <td >Email/ ईमेल <font size="3" color="red">*</font>
			     <?php  echo form_input(array('name'=>'email','placeholder'=>'Email ID','value'=>set_value('email',$email1),'class'=>'form-control','maxlength' => '50' ));  " </td>"?>
				
			   <td >Building/ इमारत 
                  <select class="form-control" name="bldg">
            <?php 
               
                foreach($record2 as $row)
                { 
				?>
				<option <?php if($row['bldg_id'] == $bldgid){ echo 'selected="selected"'; } ?> value="<?php echo $row['bldg_id']; ?>"<?php echo set_select('bldg', $row['bldg_id'], False); ?>><?php echo $row['bldg_desc'];?> </option>
                    <?php //echo '<option value="'.$row->bldg_id.'">'.$row->bldg_desc.'</option>';   
				} 
            ?>
			
            </select></td>
				</td>
                <td>Address/ पता
				    
				 <?php  echo form_input(array('name'=>'quarter','placeholder'=>'Quarter No','value'=>set_value('quarter',$qtrno),'class'=>'form-control','maxlength' => '200' ));  " </td>"?>
				</tr>
			   <tr>
			   <td class="danger">  <?php echo form_error('email',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger" > <?php echo form_error('bldg',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger" > <?php echo form_error('quarter',"<p class='text-danger'>","</p>"); ?>	</td>
			   </tr>
			   <tr><td >Railway Phone/ रेलवे फोन (OFFICE)
			    <?php  echo form_input(array('name'=>'rlyphoff','placeholder'=>'Railway Phone (OFFICE)','value'=>set_value('rlyphoff',$rlyphoff),'class'=>'form-control','maxlength' => '5' ));  " </td>"?>
			<td >Railway Phone/ रेलवे फोन (HOME)
				 <?php  echo form_input(array('name'=>'rlyphhome','placeholder'=>'Railway Phone (HOME)','value'=>set_value('rlyphhome',$rlyphhome),'class'=>'form-control','maxlength' => '5' ));  " </td>"?>
				
				 <td >Mobile No/ मोबाइल नंबर <font size="3" color="red">*</font>
				 <?php  echo form_input(array('name'=>'mobno','placeholder'=>'Mobile No','value'=>set_value('mobno',$mobile),'class'=>'form-control','maxlength' => '10' ));  " </td>"?>
				    
			  </tr>
			   <tr>
			   <td class="danger">  <?php echo form_error('rlyphoff',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger"> <?php echo form_error('rlyphhome',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger"> <?php echo form_error('mobno',"<p class='text-danger'>","</p>"); ?>	</td>
               </tr>
			     <tr><td >Unique Id/ युनिक आईडी
			    <?php  echo form_input(array('name'=>'aadharno','placeholder'=>'Unique Id','value'=>set_value('aadharno',$aadharno),'class'=>'form-control','maxlength' => '12' ));  " </td>"?>
				<td></td>	
                <td></td>					
			  </tr>
			   <tr>
			   <td class="danger">  <?php echo form_error('aadharno',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger"> <?php echo form_error('',"<p class='text-danger'>","</p>"); ?>	</td>
			   <td class="danger"> <?php echo form_error('',"<p class='text-danger'>","</p>"); ?>	</td>
               </tr>
                      </div> 
			  	 </div>		  
             </tbody>
          </table>
		  <button class="btn btn-danger" type="reset">Reset</button>
		  <?php  echo form_submit(array('name'=>'Submit','value'=>'Submit','class'=>'width-35 pull-center btn btn-sm btn-primary'));?>
                  </form>   
<script type="text/javascript">
		$(document).ready(function(){
	
				$('select').on('change',function(){
				var level=$(this).val();
				//alert(level);
				$.ajax({
				url:"<?php echo base_url('Changeprofile/level'); ?> ",	
				type:"POST",
				data:{level :level},
				success:function(data){
					
					$('#level_code').html(data);
				   // alert('ok');
				},
				error:function()
				{
				//	alert('error');
				}
				
			});
		});
		});
</script>
<script type="text/javascript">
		$(document).ready(function(){
				$('select').on('change',function(){
				var level=$(this).val();
				//alert(level);
				$.ajax({
				url:"<?php echo base_url('Changeprofile/grade'); ?> ",	
				type:"POST",
				data:{level :level},
				success:function(data){
					
					$('#gradepay').html(data);
				 //  alert('ok');
				},
				error:function()
				{
					//alert('error');
				}
				
			});
		});
		});
</script>
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
   
  <script> type="text/javascript">
$('#dob').change(function(){
var dt_arr=$('#dob').val().split('/');
dt_arr[2]=parseInt(dt_arr[2])+60;
var lastday=new Date(dt_arr[2],dt_arr[1],0).getDate();
dt_arr[0]=lastday;
$('#dor').val(dt_arr.join('/'));
});


 </script>
