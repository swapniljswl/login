<!--<script src="<?php echo base_url('assets/js/jquery/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/jquery/bootstrap-datepicker.min.js'); ?> "> </script>
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

<?php    
	 $user_data=unserialize($this->session->user);
	             $user_name = $user_data[0]->name;
	   echo form_open('Addfamily/updatefamily'); ?>
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
              <tr>
                <th color="red" class="text-center"><h4 style="color: blue";> Edit Family Details/ पारिवारिक विवरण संपादित करें</h4></th>
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

			<tr class='new_row'>
			<td style="width:2%">Sno/क्र सं</td>
			<td style="width:15%">Name/नाम</td>
            <td style="width:15%">Sex/लिंग</td>
            <td style="width:15%">Date of Birth/जन्म की तारीख</td>
            <td style="width:15%">Relation/रिश्ता</td>
			<td style="width:15%">Save/सहेजें</td>
            </tr>
			    <?php
				$i=1;
		 foreach ($result as $row)
		
            { 
			  $id=$row["idrow"];
			?>
			
             <tr class='new_row'>
			    <?php  echo form_input(array('name'=>'sno','value'=>$row["idrow"],'type'=>'hidden','class'=>'form-control' ));?>
			    <?php  echo form_input(array('name'=>'ipas','value'=>$row["ipas"],'type'=>'hidden','class'=>'form-control' ));?>
			     <td ><?php echo $i ?></td>
				<td ><?php  echo form_input(array('name'=>'name','value'=>$row["family_member_name"],'type'=>'text','class'=>'form-control','required'=>'true' ));?></td></td >
				<td style="width:15%">   <select class="form-control" name="sex" required>
				<?php 
                     		
				         $gender='';
				       $gendercd=$row["sex"];
				
				         if ($gendercd=='M')
						 {
							$gender='Male'; 
						 echo '<option value="'.$gendercd.'">'.$gender.'</option>';	
						 echo '<option value="F">Female</option>';
						 }
						 elseif ($gendercd=='F')
						 {
							$gender='Female';
                        echo '<option value="'.$gendercd.'">'.$gender.'</option>';								
						echo '<option value="M">Male</option>'; 
							
						 }
						 elseif ($gendercd=='')
						 {
							$gender='Female';                       								
						echo '<option value="M">Male</option>'; 
						echo '<option value="F">Female</option>'; 
							
						 }
				   ?>
			     </select>
				<td >
				
				<?php $dob1=	date("d/m/Y", strtotime($row["dob"])); 
			    echo form_input(array('name'=>'dob','type'=>'text','data-date-format'=>'dd/mm/yyyy','data-provide'=>'datepicker','placeholder'=>'dd/mm/yyyy','class'=>'form-control','value'=>set_value('dob',$dob1),'readonly'=>'true','required')); " </td>"	
				?>
				</td>
				<td >
                  <select class="form-control" name="relation" required>
            <?php 
			     if   ($row["relation_code"]!='')
				 {	 
                echo '<option value="'.$row["relation_code"].'">'.$row["relation_desc"].'</option>';
                foreach($records as $row)
                { $relcode=$row->relation_code;
				?>
   
			
            <?php  echo '<option value="'.$row['relation_code'].'">'.$row['relation_desc'].'</option>';
               }
				 }
				 elseif ($row["relation_code"]='')
				 {
				foreach($records as $row)
                { 
               echo '<option value="'.$row['relation_code'].'">'.$row['relation_desc'].'</option>';
               }	 
				 }
            ?>
               </select></td>
				
       <td>  <input type="submit" name="action" id="action" class="btn btn-success" value="UPDATE/अपडेट करें" />	</td>		
				</tr>
				<tr>
				 <td class="danger">  	</td>
				 <td class="danger">  <?php echo form_error('name',"<p class='text-danger'>","</p>"); ?>	</td>
			    <td class="danger" > <?php echo form_error('dob',"<p class='text-danger'>","</p>"); ?>	</td>
				<td class="danger" > <?php echo form_error('sex',"<p class='text-danger'>","</p>"); ?>	</td>
				 <td class="danger" > <?php echo form_error('relation',"<p class='text-danger'>","</p>"); ?>	</td>
				  <td class="danger">  	</td>
			    </tr>
          <?php 
		
		$i++;
	 }
		?>	
        </form>
 

