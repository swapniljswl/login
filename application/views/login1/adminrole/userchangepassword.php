<?php    echo form_open('Changeuserpassword/changepwd'); ?>
 <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
	<div class="content-wrapper">
 <script>
 function doCalc(){ 
 a=document.getElementById('ipasno').value;
  //document.getElementById("demo").innerHTML = x;
//alert(ipasno.value);
//b=document.write(a);

}
 
</script>
<div class="content">	
      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
      
          </span>
          </div>
	  <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
                <th color="red" class="text-center"><h4 style="color: blue";>Change User's Password/उपयोगकर्ता का पासवर्ड बदलें</h4></th>
              </tr>
            </thead>
			</table>
		 <table class="table table-striped" id="tblGrid">	
            <tbody>
			<?php   $message = $this->session->flashdata('chpwd_success');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
			     <tr><td style="width:15%">Emp ID/Unique Id/ कर्मचारी सं</td>
           <td style="width:25%" colspan="2"> <?php  echo form_input(array('name'=>'ipasno','id'=>'ipasno','placeholder'=>'Emp NO/ Unique Id','class'=>'form-control','maxlength'=>'12','value'=>set_value('ipasno'), 'onblur'=>'doCalc()' ));?></td>
                </tr>
              <tr>
        	 <td class="danger" style="width:10%"> <?php echo form_error('ipasno',"<p class='text-danger'>","</p>"); ?>	</td>
         <td>  		  <?php  echo form_submit(array('name'=>'Detail','value'=>'Detail/विस्तार','class'=>'width-35 pull-center btn btn-sm btn-primary'));?></td>
			  </tr>
			 <?php
             			 
            // $value=ipasno.value			 
			   if (isset($_POST['Detail']))  { 
			 $user_data=unserialize($this->session->empdetail);
			if ($user_data > 0)
			{
		      $name = $user_data[0]->name;
			  $desig = $user_data[0]->desig_desc;
			   $dte = $user_data[0]->dte_desc; 
			
			//  $name = $row->name;
			  ?>
			    <tr>
				<td>name/नाम :-<?php echo $name; ?></td><td>designation/पद:-<?php echo $desig; ?></td><td>directorate/निदेशालय :-<?php echo $dte; ?></td>
              </tr>
			  
			  
			  
			<?php  } }
			   $this->session->unset_userdata('empdetail');
			  ?>
			 
		        </form
			<?php	  echo form_open('Changeuserpassword/changepwd'); ?>
			     <tr><td style="width:15%">New Password/नया पासवर्ड</td>
                <td style="width:25%" colspan="2"> <?php  echo form_input(array('name'=>'npassword','type'=>'password','placeholder'=>'New Password/नया पासवर्ड','class'=>'form-control' ));?></td>
                </tr>
				<tr>
				  <td class="danger"> </td>
				<td class="danger" style="width:10%" colspan="2"> <?php echo form_error('npassword',"<p class='text-danger'>","</p>"); ?>	</td>
              </tr>
			   <tr><td style="width:15%">Confirmed Password/पुष्टि पासवर्ड</td>
               <td style="width:25%" colspan="2">  <?php  echo form_input(array('name'=>'cpassword','type'=>'password','placeholder'=>'Re-enter Password/पासवर्ड पुनः दर्ज करें','class'=>'form-control' ));?></td>
               </tr>
			   <tr>
			     <td class="danger"> </td>
			   <td class="danger" style="width:10%" colspan="2">  <?php echo form_error('cpassword',"<p class='text-danger'>","</p>"); ?></td>	
              </tr>
			  
            </tbody>
          </table>
		  <button class="btn btn-danger" type="reset">Reset/रीसेट</button>
		  <?php  echo form_submit(array('name'=>'Submit','value'=>'Submit/प्रस्तुत करना','class'=>'width-35 pull-center btn btn-sm btn-primary'));?>
              
			 </form> 
	 
