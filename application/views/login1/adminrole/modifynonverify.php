Modifynonverify
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
<script>

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
                <th colspan="10" color="red" class="text-center"><h4 style="color: blue";>Modify Non Verify/Rejected Users/गैर-सत्यापित/अस्वीकृत उपयोगकर्ताओं को संशोधित करें</h4></th>
              </tr>
            </thead>
           <?php   $message = $this->session->flashdata('role');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
            <thead >
			<?php echo form_open('Useractivedeavtive/selectemp'); ?>
				
			<tr>
			<td > <select  class="form-control"  name="typeuser"  size="1" required>
            <option value="1">RDSO</option>
            <option value="2">Non RDSO</option>
            </select></td>
			<td > <select  class="form-control"  name="user"  size="1" required>
            <option value="V">Verified Users</option>
            <option value="R">Rejected Users</option>
            </select></td>
			<td > <select  class="form-control "  size="1" name="direc"  required>            
            <?php               
            foreach($record1 as $row1)
            { ?>
			<option value="<?php echo $row1->dte_id; ?>"<?php echo set_select('direc', $row1->dte_id, False); ?> ><?php echo $row1->dte_desc;?> </option>
       
           <?php 
            }
            ?>
            </select></td>
<td colspan="5"><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit/प्रस्तुत करना','class'=>' btn btn-sm btn-primary'));?>
			</td></tr></div></form>
			<form  method='post' action='getdetail'  onkeypress="return event.keyCode != 13;">
           <?php
		 if (isset($_POST['Submit']))  { 
 if ($records > 0)
			{
$type1=0;				
             echo "<div class='table-responsive'>          
            <table class='table'>
              <tr>
             <th align='center'>S.No/क्रमांक</th>
             <th align='center' >Name/नाम </th>
			 <th align='center'>Emp No/Unique Id/कर्मचारी सं </th>
			  <th align='center'>Designation/पद</th>
			 <th align='center' >Directorate/निदेशालय </th>
             <th align='center'>Modify/संशोधित</th>		 
             </tr>";  ?>
           <?php 
		     $i=1;
			// if(isset($records)) 
			
				 foreach ($records as $row)		
		  {
 
      echo "<tr>";
  echo "<td align='center'><name='id'> $i </td>" ;
   echo "<td ><type='text' >".$row["name"]." </td>" ;
    if ($row["rdso_nonrdso"]=='1') {
	 echo "<td ><type='text' >".$row["login_id"]." </td>" ;	
	  echo "<td ><type='text' >".$row["desig_desc"]." </td>" ;	
   } 
  elseif ($row["rdso_nonrdso"]=='2') {
	   echo "<td ><type='text' >".$row["aadhar_no"]." </td>" ;
     echo "<td >Non RDSO</td>" ;	   
  	 }
    echo "<td ><type='text' >".$row["dte_desc"]." </td>" ;
   	if ($row["rdso_nonrdso"]=='1') { ?>
		<?php   echo "<td  ><a class='btn btn-danger' href='".base_url('Modifyregisteruser/getdetail/'.$row["login_id"].'/'.$row["rdso_nonrdso"])."'>Modify</a></button></td>";
			?>
			                                   
			
	<?php 
	} elseif ($row["rdso_nonrdso"]=='2') { ?>
	<?php echo "<td ><a class='btn btn-danger' href='".base_url('Modifyregisteruser/getdetail/'.$row["aadhar_no"].'/'.$row["rdso_nonrdso"])."'>Modify</a></button></td>";
 echo "</tr>";
     
			}
		 $i++;	} }
			
			else
			{
				 echo "<div class='table-responsive'>          
                <table class='table'>
                <tr>
				 <th align='center'>Sorry ! No data found.</th>
				 </tr> </table>";
			}				
			} ?> </form>
			<form  method='post' action='modify'  onkeypress="return event.keyCode != 13;">
			<?php if (isset($_POST['Modify'])) 
				{
           	 foreach ($records as $row)		
		  {	
             $user_data=unserialize($this->session->nonverify);
			// print_r( $user_data);exit;
			 $user_name = $user_data[0]->name;
             $typeuser = $user_data[0]->rdso_nonrdso;
			 if ($typeuser=='1'){
             $loginid = $user_data[0]->login_id;
			 $desig = $user_data[0]->desig_id;
			 $dteid = $user_data[0]->dte_id;
			 }
			 elseif ($typeuser=='1'){
			$aadharno = $user_data[0]->aadhar_no;
            $dteid = $user_data[0]->nodal_dte;   			
			 }            
             $email = $user_data[0]->email;
             $mobno = $user_data[0]->mobno;	
             			 
            echo "<div class='table-responsive'>";		  
			echo "<tr class='new_row'>";
			echo "<td >Name</td> <td> <input name='name' value='".$user_name."' required></td>";
			if ($row->rdso_nonrdso=='1'){
			
			echo "<td >Emp No</td> <td> <input name='empno'   maxlength='11' value='".$loginid."' readonly></td>"; 
			 ?>
			 <td >Designation</td><td> <select  class="form-control "  size="1" name="desg"  required>
            
            <?php 
              
            foreach($record2 as $row1)
            { ?>
			<option <?php if($row1->desig_id == $desig){ echo 'selected="selected"'; } ?> value="<?php echo $row1->desig_id; ?>"<?php echo set_select('desg', $row1->desig_id, False); ?> ><?php echo $row1->desig_desc;?> </option>
			
           <?php 
            }
            ?>
            </select></td>
			<?php }
			if ($row->rdso_nonrdso=='2'){
			echo "<td >Aadhar No</td> <td> <input required pattern='[0-9]{12}' name='aadhar'  maxlength='12' value='".$row->aadhar_no."' readonly></td>
			<td >Designation</td> <td> Non RDSO</td>"; }
			echo"</tr>
			<tr class='new_row'>
			<td >Email</td> <td> <input type='email' name='email'  value='".$email."' required></td>
			<td >Mobile</td> <td> <input required pattern='[0-9]{10}' name='mobno'  maxlength='10' value='".$mobno."' required></td> ";
			?>
			 <td >Directorate</td><td> <select  class="form-control "  size="1" name="dte"  required>
            
			 <?php $dteid=	$row->dte_id; 
            foreach($record1 as $row2)
            { ?>
			<option <?php if($row2->dte_id == $dteid){ echo 'selected="selected"'; } ?> value="<?php echo $row2->dte_id; ?>"<?php echo set_select('direct', $row2->dte_id, False); ?>><?php echo $row2->dte_desc;?> </option>
           <?php 
		  }  }
            ?>
            </select></td></tr><tr class='new_row'><td colspan='7'>
			<?php  
			 echo form_input(array('name'=>'typeuser','value'=>$row->rdso_nonrdso,'type'=>'hidden','class'=>'form-control' )); 
		   echo form_submit(array('name'=>'rectify','value'=>'Modify','class'=>'width-35 pull-center btn btn-sm btn-info')); ?></td>
			
		<?php  }
				
			?> </td></tr>    
		     </table>  
	            </thead>
</table>
</form>
  <script>
(function (global) { 

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {            
        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };          
    }

})(window);
</script>  
  
