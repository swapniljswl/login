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
           <h4 style="color: blue"; class="text-center">List Of Users Pending For Verification/सत्यापन के लिए लंबित उपयोगकर्ताओं की सूची</h4>          
           <?php   $message = $this->session->flashdata('role');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 
            <thead >
			<?php echo form_open('Userverifyrole/selectemp'); ?>
				 <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
			<tr>
			<td > <select  class="form-control"  name="typeuser"  size="1" required>
            <option value="1">RDSO</option>
            <option value="2">Non RDSO</option>
            </select></td>
			<td > <select  class="form-control" name="direc" required>            
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
			<!-- <form  method='post' action='../reject'  onkeypress="return event.keyCode != 13;"> -->
        <?php echo form_open('Userverifyrole/reject'); ?> 
         <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
      <tr>
			<?php 
           	 foreach ($records as $row)		
		  {	
                        			 
            echo "<div class='table-responsive'>          
            <table class='table'>
			  <th >Name:-</th><th >".$row['name']."</th>";
			     if ($row['rdso_nonrdso']=='1')
			  { 
			  echo " <th >Emp No/कर्मचारी सं:-</th><th >".$row['ipasid']."</th>
			  <th >Designation/पद:-</th><th >".$row['desig_desc']."</th>";
			  }
			  elseif ($row['rdso_nonrdso']=='2')
			  { 
			  echo " <th >Unique Id/युनिक आईडी:-</th><th >".$row['aadhar_no']."</th>
			  <th >Designation/पद:-</th><th >Non RDSO</th>";
			  }
			 echo " 
			</tr>
			<tr >
			<th >Directorate/निदेशालय:-</th><th >".$row['dte_desc']."</th>
			<th >Email/ईमेल:-</th><th >".$row['email']."</th>
			<th >Mobile/मोबाइल :-</th><th >".$row['mobno']."</th>
			</tr>
			<tr>
				 <td >Rejection reaseon/अस्वीकृति का कारण:-</td> <td colspan='8'> <input type='text' name='reason' maxlength='50' size='50' required></td>	
     			 </tr>";	
		  }	  echo "<tr class='new_row'><td colspan='7'>";
           if ($row['rdso_nonrdso']=='1')  {
		   echo form_input(array('name'=>'ipasid','value'=>$row['ipasid'],'type'=>'hidden','class'=>'form-control' )); 		  
			  }  elseif ($row['rdso_nonrdso']=='2')  {
			  echo form_input(array('name'=>'ipasid','value'=>$row['aadhar_no'],'type'=>'hidden','class'=>'form-control' )); }
		   echo form_submit(array('name'=>'Reject','value'=>'Reject','class'=>'width-35 pull-center btn btn-sm btn-danger')); ?></td>
			
		 </td></tr>
		     </table>  
	            </thead>

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
