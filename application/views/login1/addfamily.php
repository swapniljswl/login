<!--<script src="<?php echo base_url('assets/js/jquery/jquery.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/js/jquery/bootstrap-datepicker.min.js'); ?> "> </script>
<link href="<?php echo base_url('assets/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet">-->
 
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
                <th color="red" class="text-center"><h4 style="color: blue";>Add Family Detail.</h4> Allowed characters - a-z 0-9 /-.,.</th>
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
         	// echo form_open('Addfamily/addfamilydetail'); ?>
			<form id='form' data-parsley-validate="">
			 <table class="table table-striped" id="tblGrid">
			 
		       <tr>
			  <td>  <a href="#" id="add_member">Add Family Member</a></td>
				<td colspan="5"><span id="lastDateBlinker"><p  style="color: red";>Please update profile before adding family member.</p></span> </td>
			 	  </tr>
				   <tr>
			    <td  >Sno</td>
			   <td >Name</td>
               <td >Gender</td>
               <td >Date of Birth<br>(mm/dd/yyyy)</td>
               <td>Relation</td>
			   <td></td>
               </tr>
			   <table class="table m-0 table-responsive table-condensed" id="dataTable">
			   <tr class='new_row'>
			<?php   
			if ($userdetail > 0)
			{
			foreach ($userdetail as $row)
		
            { 
			$user_name = $row['name'];
	        $emp_dob = $row['emp_dob'];
            $emp_sex = $row['emp_sex']; 
			//echo  $emp_sex;exit;
			}
			}
			?>
			   	<td ><INPUT  class="form-control" type="text" name="itemno" id="itemNo_'0'" value="1" required="" data-parsley-group="grp1" readonly></td>
               <td ><INPUT  class="form-control" type="text" name="name" id="name_'0'" value="<?php echo $user_name ;  ?>" required="" data-parsley-group="grp1" readonly></td>
			  
			 <!--  <td style="width:35%"> <?php // echo form_input(array('name'=>'name[]','id'=>'name_'+i+'','type'=>'text','placeholder'=>'name','class'=>'form-control','value'=>$user_name));?></td> -->
				 <td >   <select class="form-control" name="sex" id="sex_'0'" data-parsley-group="grp1" />
            <?php 
              if ($emp_sex =="M")
				{
				echo '<option value="M">Male</option>';
			   
				}
				elseif ($emp_sex =="F")
				{
				echo '<option value="F">Female</option>';	
				
			    }
				
            ?>
            </select>
			</td>
			<td >
			<?php 
				if ($emp_dob!='')
				$dob1=	date("m/d/Y", strtotime($emp_dob));
                else
                {
				$dob1=null;	
				}					?>
			<INPUT  class="form-control" type="text" name="dob" id="dob_'0'"  data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy"  value="<?php echo $dob1; ?>" data-parsley-group="grp1" readonly>
			
			<?php 
				//  echo form_input(array('name'=>'dob','type'=>'date','placeholder'=>'Date of Birth','class'=>'form-control','value'=>set_value('dob',$emp_dob),'readonly'=>'true' )); " </td>"	
				?>
				
         
			 <td >   <select class="form-control" name="relation" id="relation_'0'" data-parsley-group="grp1" required/>
            <?php 
              echo '<option value="01">Self</option>';
                ?>
            </select>
			</td> 
            </tr>
 						
           </tbody>
          </table>
		  <div class="modal-footer">
							
							<button type="submit" class="btn btn-primary" name="save" id="save_btn" onSubmit="window.location.reload()">Save changes</button>
						</div>

		  </table>    
		  
        </form>
 
   <SCRIPT language="javascript">
$(document).ready(function() {
	 var sn=1;
     var no=1;
 	$('#add_member').click(function(e){
			html="<tr class='new_row'>";
			html+='<td><input type="text" name="itemno" id="itemNo_'+ ++sn +'" value="'+ ++no +'" class="form-control" required="" data-parsley-group="grp2" readonly/></td>'
			html+='<td><INPUT  class="form-control" type="text" name="name" id="name_'+ ++sn +'" value=""  data-parsley-group="grp2" required=""/></td>';
			html+='<td> <select class="form-control" name="sex" id="sex_'+ ++sn +'" data-parsley-group="grp2"   ><option value="M">Male</option><option value="F">Female</option></select></td>';
			html+='<td><INPUT  class="form-control" type="text" name="dob" id="dob_'+ ++sn +'" data-provide="datepicker" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy"  data-parsley-group="grp2" readonly="true" required=""/></td>';
		 	html+='<td><select class="form-control" name="relation" id="relation_'+ ++sn +'"   data-parsley-group="grp2" required>';
			html+="<?php
			 
			 foreach($records as $row)
			{
				echo '<option value='.$row['relation_code'].'>'.$row['relation_desc'].'</option>';
			}
			?>";
			html+='</select></td>';
			html+='<td><button type="button" class="btn btn-default"><a href="#" class="del_row">Delete</a></td></button>';
			html+="</tr>";
			$('#dataTable').append(html);
	});
	$('#dataTable').on('click','a[class*=del_row]',function(){
			$(this).closest('tr').remove();
			no--;
		});
	});
			</script>

	<script type="text/javascript">
$(document).ready(function() {
$('#save_btn').click(function(){ 
/* $('#form').parsley().whenValidate({
 				group : 'grp1'
 			}).done(function(){
				$('#form').parsley().whenValidate({
 					group : 'grp2'
 				}).done(function(){
	 if($('*').hasOwnProperty('required').value()=='')
	{
		alert('Error');
		return false;
	} */
 var family_data={};
$('#dataTable tr').each(function(index,v){
family_data[index]={
 "member_index":$(v).find('input[name*=itemno]').val(),
 "family_member_name" : $(v).find("input[name*=name]").val(),
 "sex" : $(v).find("select[name*=sex]").val(),
 "dob": $(v).find("input[name*=dob]").val(),
 "relation_code": $(v).find("select[name*=relation]").val()
}
	
});
                url_path="<?php echo base_url('Addfamily/addfamilydetail');?>"
				error_msg="Error occured while updating Pathology Test Data."
				success_msg="Test Details Updated Successfully."
 $.ajax({
					type:"POST",
					url:url_path,
					  data:{csrf_token : csrf_token,family_data : JSON.stringify(family_data)},   
					//data:{family_data : JSON.stringify(family_data)},
					success:function(response)
					{
					    
						//console.log(response);
						//response=parse(response);
						response=JSON.parse(response);
						console.log(response);
						if(response.error==true)
		                {
							 //alert("hi");
		                  alert(response.error_msg,'error_msg');
		                }
		               /*  else
		                {
		                	alert('data enter successfully');
		                } */
					}, 
										
});
});
});
//});
//});
</script>
<script type="text/javascript">
    function blinkLastDateSpan() {
        if ($("#lastDateBlinker").css("visibility").toUpperCase() == "HIDDEN") {
            $("#lastDateBlinker").css("visibility", "visible");
            setTimeout(blinkLastDateSpan, 200);
        } else {
            $("#lastDateBlinker").css("visibility", "hidden");
            setTimeout(blinkLastDateSpan, 200);
        }
    }
    blinkLastDateSpan();
</script>
