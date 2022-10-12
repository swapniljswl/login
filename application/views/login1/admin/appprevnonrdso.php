<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
        
          </span>
          </div>
				    <h4 style="color: blue"; class="text-center">Application Privilege to Non RDSO/गैर आरडीएसओ के लिए  एप्लीकेशन विशेषाधिकार</h4> 
                <?php   $message = $this->session->flashdata('email_sent');
               if (isset($message)) {
                 echo '<div align="center" class="col-lg-12 alert alert-info" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?> 					
				  <?php    echo form_open('Userverifyreject/selectemp'); ?>
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
			  </tr>
			   </form> 
             <?php    echo form_open('Userverifyreject/ADD'); 

             
			    $i=1;
				foreach ($detail as $row1)
				{  
			echo "<tr class='new_row'>
			<td ><b>NAME/नाम:-</b> $row1->name </td>
			<td ><b>Unique Id/युनिक आईडी:- </b>$row1->aadhar_no</td>
            <td ><b>Designation/पद:-</b>Non RDSO</td>
            </tr>"; 
				
			echo "<tr class='new_row'>
			<td ><b>Sno/क्रमांक</b></td>
			<td ><b>Application Name/एप्लीकेशन  नाम</b></td>
            <td ><b>ADD/Remove</b></td>
            </tr>";
			  				   
				foreach ($records as $row)
				{  ?>
				
		  <tr class='new_row'>
			    <?php  ?>
			      <td ><?php echo $i ?></td>
				  <td ><?php echo $row['app_name'] ?></td> 
			<?php if($row['flag']=='Y')
			{
			  echo "<td><a class='btn btn-danger' href='".base_url('Userverifyreject/deleteapp/'.$row['id']).'/'.$this->lib_csrf->get_csrf_hash()."'>Delete</button></td>";
			}
			elseif($row['flag']=='D')
			{
			  echo "<td><a class='btn btn-success' href='".base_url('Userverifyreject/Activeapp/'.$row['id']).'/'.$this->lib_csrf->get_csrf_hash()."'>ADD</button></td>";
			}
			else { ?>			  
			<td><?php echo form_input(array('name'=>'appid','value'=>$row['appid'],'type'=>'hidden','class'=>'form-control' ));
                      echo form_input(array('name'=>'aadharno','value'=>$row1->aadhar_no,'type'=>'hidden','class'=>'form-control' )); 			
			echo form_submit(array('name'=>'ADD','value'=>'ADD','class'=>'width-35 pull-center btn btn-sm btn-info')); }?></td>	</tr>
		<?php	    
			$i++;
			}
				}
           	     
			  ?>
         <input type="hidden" id="csrf_token" value="<?php echo $this->lib_csrf->get_csrf_hash();?>" name="csrf_token">
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
			
	 
