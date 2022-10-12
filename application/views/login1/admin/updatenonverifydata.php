<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
        
          </span>
          </div>
				    <h4 style="color: blue"; class="text-center">Modify Non Verify/Rejected Users/गैर-सत्यापित/अस्वीकृत उपयोगकर्ताओं को संशोधित करें</h4> (Allowed Chars- a-z 0-9 /-.,.)
                    <?php   $message = $this->session->flashdata('email_sent');
               if (isset($message)) {
                 echo '<div align="center" class="col-lg-12 alert alert-info" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
				
               ?> 					
                  <?php echo form_open('Userverifyreject/selectemp'); ?>	
                   <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
				  <div class="row">    
	  			  
              <div class='table-responsive'>          
              <table class='table'>
			<tr>
			<td > <select  class="form-control"  name="type"  size="1" required>
            <option value="1">RDSO</option>
            <option value="2">Non RDSO</option>
            </select></td>
			<td > <select  class="form-control"  name="user"  size="1" required>
            <option value="V">Verified Users</option>
            <option value="R">Rejected Users</option>
            </select></td>
            <td><?php  echo form_submit(array('name'=>'Submit','value'=>'Submit','class'=>'width-35 pull-left btn btn-sm btn-primary'));?>
			</td></tr></form> <thead> </table>
            <?php echo form_open('Userverifyreject/modify'); ?>			
			  <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
			<?php 
           	 foreach ($records as $row)		
		  {	
             $user_data=unserialize($this->session->nonverify);
			// print_r( $user_data);exit;
			 $user_name = $user_data[0]->name;
             //$typeuser = $user_data[0]->rdso_nonrdso;
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
               echo "<div class='table-responsive'>          
            <table class='table'>";			 
            echo "<div class='table-responsive'>";		  
			echo "<tr class='new_row'>";
			echo "<td >Name</td> <td> <input name='name' value='".$user_name."' required></td>";
			if ($row['rdso_nonrdso']=='1'){
			
			echo "<td >Emp No/कर्मचारी सं:-</td> <td> <input name='empno'   maxlength='11' value='".$loginid."' readonly></td>"; 
			 ?>
			 <td >Designation/पद:</td><td> <select  class="form-control "  size="1" name="desg"  required>
            
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
			echo "<td >Unique Id/युनिक आईडी</td> <td> <input required pattern='[0-9]{12}' name='aadhar'  maxlength='12' value='".$row['aadhar_no']."' readonly></td>
			<td >Designation/पद:</td> <td> Non RDSO</td>"; }
			echo"</tr>
			<tr class='new_row'>
			<td >Email/ईमेल</td> <td> <input type='email' name='email'  value='".$email."' required></td>
			<td >Mobile/मोबाइल</td> <td> <input required pattern='[0-9]{10}' name='mobno'  maxlength='10' value='".$mobno."' required></td> ";
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
</form></div></div></div></div>
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
  
