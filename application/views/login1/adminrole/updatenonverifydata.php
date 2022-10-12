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
                <th colspan="10" color="red" class="text-center"><h4 style="color: blue";>Modify Non Verify/Rejected Users/गैर-सत्यापित/अस्वीकृत उपयोगकर्ताओं को संशोधित करें</h4>(Allowed Chars- a-z 0-9 /-.,.)</th>
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
				  <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
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
			<option value="<?php echo $row1['dte_id']; ?>"<?php echo set_select('direc', $row1['dte_id'], False); ?> ><?php echo $row1['dte_desc'];?> </option>
       
           <?php 
            }
            ?>
            </select></td>
<td colspan="5"><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit/प्रस्तुत करना','class'=>' btn btn-sm btn-primary'));?>
			</td></tr></div></form>		
			<form  method='post' action='../../modify'  onkeypress="return event.keyCode != 13;">
         <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
			<?php 
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
			if ($row['rdso_nonrdso']=='1'){
			
			echo "<td >Emp No</td> <td> <input name='empno'   maxlength='11' value='".$loginid."' readonly></td>"; 
			 ?>
			 <td >Designation/पद</td><td> <select  class="form-control "  size="1" name="desg"  required>
            
            <?php 
              
            foreach($record2 as $row1)
            { ?>
			<option <?php if($row1['desig_id'] == $desig){ echo 'selected="selected"'; } ?> value="<?php echo $row1['desig_id']; ?>"<?php echo set_select('desg', $row1['desig_id'], False); ?> ><?php echo $row1['desig_desc'];?> </option>
			
           <?php 
            }
            ?>
            </select></td>
			<?php }
			if ($row['rdso_nonrdso']=='2'){
			echo "<td >Unique Id</td> <td> <input required pattern='[0-9]{12}' name='aadhar'  maxlength='12' value='".$row['aadhar_no']."' readonly></td>
			<td >Designation</td> <td> Non RDSO</td>"; }
			echo"</tr>
			<tr class='new_row'>
			<td >Email</td> <td> <input type='email' name='email'  value='".$email."' required></td>
			<td >Mobile</td> <td> <input required pattern='[0-9]{10}' name='mobno'  maxlength='10' value='".$mobno."' required></td> ";
			?>
			 <td >Directorate/पद</td><td> <select  class="form-control "  size="1" name="dte"  required>
            
			 <?php $dteid=	$row['dte_id']; 
            foreach($record1 as $row2)
            { ?>
			<option <?php if($row2['dte_id'] == $dteid){ echo 'selected="selected"'; } ?> value="<?php echo $row2['dte_id']; ?>"<?php echo set_select('direct', $row2['dte_id'], False); ?>><?php echo $row2['dte_desc'];?> </option>
           <?php 
		  }  }
            ?>
            </select></td></tr><tr class='new_row'><td colspan='7'>
			<?php  
			 echo form_input(array('name'=>'typeuser','value'=>$row['rdso_nonrdso'],'type'=>'hidden','class'=>'form-control' )); 
		   echo form_submit(array('name'=>'rectify','value'=>'Modify','class'=>'width-35 pull-center btn btn-sm btn-info')); ?></td>
			
		 </td></tr>    
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
  
