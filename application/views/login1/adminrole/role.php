<script>
$('form[name=test]').submit(function(e) {
   e.preventDefault();
   window.scrollTo(5000,500);

   // a sample AJAX request
   $.ajax({
     url : this.action,
     type : this.method,
     data : $(this).serialize(),
     success : function(response) {

     }
   });
});
</script>
<div class="content">	
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
         
          </span>
          </div>
		    <div class="table-responsive">          
            <table class="table">
            <thead>
          <!--  <table class="table table-striped" id="tblGrid">
            <thead id="tblHead"> -->
              <tr>
                <th color="red" class="text-center"><h4 style="color: blue";>Assign Role/ भूमिका सौंपें</h4></th>
              </tr>
            </thead>
           <?php   $message = $this->session->flashdata('arole');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
            <thead >
			<?php echo form_open('Role/selectemp'); ?>
       <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
				
			<tr>
			<td > <select  class="form-control "  size="1" name="role" id="role"  required>
            <option value=""> Select</option>
            <?php 
              
            foreach($record2 as $row2)
            { ?>
				<option value="<?php echo $row2['role_id']; ?>"<?php echo set_select('role', $row2['role_id'], False); ?> ><?php echo $row2['role_name']; ?> </option>
                   <?php 
            }
            ?>
            </select></td>
			<td > <select  class="form-control "  size="1" name="direc" id="direc" onselect="javascript:reloadPage(this)"  required>
               <option value=""> Select</option>
            <?php 
              
            foreach($record1 as $row1)
            { ?>
				<option value="<?php echo $row1['dte_id']; ?>"<?php echo set_select('direc', $row1['dte_id'], False); ?> ><?php echo $row1['dte_desc'];?> </option>
                   <?php //echo '<option value="'.$row1->dte_id.'">'.$row1->dte_desc.'</option>';
            }
            ?>
            </select></td>
			
<td><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit/प्रस्तुत करना','class'=>' btn btn-sm btn-primary'));?>
			</td></tr></div>
			<form  method='post' action='Userrole/role'  onkeypress="return event.keyCode != 13;">
           <?php
		 if (isset($_POST['Submit']))  { 
 if ($records > 0)
			{
$type1=0;				
             echo "<div class='table-responsive'>          
            <table class='table' id='table' >
              <tr >
             <th align='center'>S.No/क्रमांक</th>
             <th align='center'>IPAS Id/आईपास आईडी </th>
             <th align='center' >Name/नाम  </th>
			 <th align='center'>Directorate/पद</th>
             <th align='center'>Designation/निदेशालय</th>
			  <th> Role/भूमिका </th>
			 <th > Assign Role/भूमिका सौंपें </th>
			 
             </tr>";  ?>
           <?php 
		     $i=1;
			// if(isset($records)) 
			
				 foreach ($records as $row)		
		  {
 
  echo "<tr>";
  echo "<td align='center'><name='id'> $i </td>" ;
  echo "<td align='left' ><type='text' name='loginid'>". $row["login_id"]." </td>" ;
  echo "<td align='left' ><type='text' name='name'>". $row["name"]." </td>" ;
  echo "<td align='left' ><type='text' name='dte'>". $row["dte_desc"]." </td>" ;
  echo "<td align='left' ><type='text' name='desig'>". $row["desig_desc"]." </td>" ;
if  (($row["role"])=='2')
{
$type1="Sub Admin";	
}
elseif (($row["role"])=='3')
{
$type1="Admin";	
}
elseif (($row["role"])=='4')
{
$type1="Directorate Admin";	
}
elseif (($row["role"])=='5')
{
$type1="Profile Admin";	
}
elseif (($row["role"])=='6')
{
$type1="Family Admin";	
}
else
{
$type1=null;	
}	
    echo "<td align='left' ><type='text' name='desig'>". $type1." </td>" ; 
		if ((($row["role"])!='3') and ($row["role"])!='2' and ($row["role"])!='4' and ($row["role"])!='5' and ($row["role"])!='6'   )	
{
 echo "<td><a class='btn btn-success'  href='".base_url('Role/role/'.$row["login_id"]).'/'.$this->lib_csrf->get_csrf_hash()."'>Assign Role</</td>";
 
}
	 
 echo "</tr>";
   $i++;   
		  }
			}
			else
			{
				 echo "<div class='table-responsive'>          
                <table class='table'>
                <tr>
				 <th align='center'>Sorry ! No data found.</th>
				 </tr>";
			}				
	
		 }
 ?>     
		     </table>  
	            </thead>
</table>
</form>
  <script type="text/javascript">
		$(document).ready(function(){
				    $("#role").on("click", function ()  {
                    $("#direc").val('');
					$('#table').empty();					
		});
		});
</script>
