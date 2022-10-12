<!--<script src="<?php echo base_url('assets/js/jquery/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/jquery/bootstrap-datepicker.min.js'); ?>"> </script>
<link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet"> -->
<style>
.table {
	counter-reset: rowNumber;
}
.table tbody tr.test_item {
	counter-increment: rowNumber;
}
.table tbody td.sn a::before {
	content: counter(rowNumber);
	min-width: 1em;
	margin-right: 0.5em;
}
</style>
<div class="content">
	  <div class="content-wrapper">
      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right ">          
          </span>
          </div>
	  <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
			  <?php  foreach ($userdetail  as  $row )
			  { 
			  $family = $row['family_verify_status'];
			     ?>
                <th color="red" class="text-center"><h4 style="color: blue";> Family Details/ पारिवारिक विवरण</h4></th>
				  <?php if (($family=='') or ($family =='N')) { ?>
			  <p style="color:red;"><marquee>Your Family details have not been Verified by Pass Section.</marquee> </p>
			  <?PHP  } elseif ($family=='V') { ?>
			  <p style="color:green;"><marquee>Your Family details have been Verified by Pass Section. </marquee> </p>
			  <?php  } 
				 elseif ($family=='R') { ?>
			  <p style="color:red;"><marquee>Your Family details have been Rejected  by Pass Section. </marquee> </p>
			  <?php  } } ?>
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
              
			  echo form_open(''); 
			if ($record > 0)
			
			{ 
			    
				$i=1; ?>
				<?php  echo form_submit(array('name'=>'Detail','value'=>'Add new Family Member/परिवार के नए सदस्य को जोड़ें','class'=>'width-35 pull-center btn btn-sm btn-primary'));?></td>
			<tr class='new_row'>
			<td style="width:2%"></td>
			<td style="width:2%">Sno/क्र सं</td>
			<td style="width:15%">Name/नाम</td>
            <td style="width:15%">Sex/लिंग</td>
            <td style="width:15%">Date of Birth/जन्म की तारीख</td>
            <td style="width:15%">Relation/रिश्ता</td>
			<td >Edit/ संपादित करें</td>
			<td >Delete/हटाएं</td>
			  </tr>
			   <?php
		 foreach ($record as $row)
		
            { 
			$id=$row['idrow'];
			$dob= date('d-F-Y',strtotime($row['dob']));
			?>
			
             <tr class='new_row'>
			    <td ></td>
			  	<td ><?php echo $i ?></td>
				<td ><?php echo $row['family_member_name']; ?></td>
				<td ><?php echo $row['sex']; ?></td>
				<td ><?php echo $dob;?></td>
				<td ><?php echo $row['relation_desc']; ?></td>
		<?php	if ($row['relation_desc'] != 'Self')
		{
		  echo "<td><button type='button' class='btn btn-info'><a href='".base_url('addfamily/getfamily/'.$id)."'>Edit/संपादित करें</button></td>";  				
		  echo "<td><button type='button' class='btn btn-danger'><a  href='".base_url('addfamily/deletefamily/'.$id)."'>Delete/हटाएं </button></td>";
		}
     
			?>

			 
			</tr>
			</form>
          <?php 
		
		$i++;
			}
 if (isset($_POST['Detail']))  { 
            echo form_open('Addfamily/addnewfamily'); 
			  ?>
			  <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
			   <tr class='new_row'>
			   <td></td>
			   	<td style="width:6%"><INPUT  class="form-control" type="text" name="itemno" id="itemNo_'0'" value="<?php echo $i ?>" readonly></td>
				
               <td style="width:30%"><INPUT  class="form-control" type="text" name="name" id="name_'0'" value="" required></td>
			 <!--  <td style="width:35%"> <?php // echo form_input(array('name'=>'name[]','id'=>'name_'+i+'','type'=>'text','placeholder'=>'name','class'=>'form-control','value'=>$user_name));?></td> -->
				
				<td style="width:10%">   <select class="form-control" name="sex" id="sex_'0'" required>
            <?php 
              echo '<option value="">select</option>';
              echo '<option value="M">Male</option>';
			  echo '<option value="F">Female</option>';
            ?>
            </select>
			</td>
            <!--    <td style="width:25%">  <?php // echo form_input(array('name'=>'dob[]','type'=>'date','class'=>'form-control' ,'required'));?></td>-->
             
			 <td style="width:10%">
			  <?php 
			 echo form_input(array('name'=>'dob','type'=>'text','data-date-format'=>'dd/mm/yyyy','data-provide'=>'datepicker','placeholder'=>'dd/mm/yyyy','class'=>'form-control','value'=>set_value('dob'),'readonly'=>'true','required')); " </td>"	
				?>
			</td>
			 <td style="width:25%">   <select class="form-control" name="relation" id="relation_'0'" required>
  			<option value=''>Select</option>
            <?php 
              foreach($records as $row)
			{
				echo '<option value='.$row['relation_code'].'>'.$row['relation_desc'].'</option>';
			}
                ?>
            </select>
			</td> 
			
				
			  
            <td><?php  echo form_submit(array('name'=>'submit','value'=>'submit','class'=>'width-35 pull-center btn btn-sm btn-info'));?></td>			
            </tr>
			 <tr>
			 <td class="danger">  	</td>
				 <td class="danger">  <?php echo form_error('name',"<p class='text-danger'>","</p>"); ?>	</td>
				 <td class="danger" > <?php echo form_error('sex',"<p class='text-danger'>","</p>"); ?>	</td>
			     <td class="danger" > <?php echo form_error('dob',"<p class='text-danger'>","</p>"); ?>	</td>
				 <td class="danger" > <?php echo form_error('relation',"<p class='text-danger'>","</p>"); ?>	</td>
				  <td class="danger">  	</td>
			 </tr>
			  			<?php  }
 } ?>
			 			
</form>
</table>

   <style type="text/css">
        .table-condensed
        {
            width: 250px;
            height: 10px;
            font-size: 12px;
        }
    </style>
 