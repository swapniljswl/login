
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

<?php	 $user_data=unserialize($this->session->user);
	 $user_name = $user_data[0]->name;
	$user_desig = $user_data[0]->desig_desc; ?>
	<div class="content">
	<div class="content-wrapper">

      <div class="container-fluid">
        <div class="text-right">
          <span class="small float-right "> 
                   </span>
          </div>
 <div  class="row form-group" >
   <div class="col-md-12" align="text-center">
          <h5 style="color: blue";>Profile verification/प्रोफ़ाइल सत्यापन</h5>
        </div>
		   </div>  
        <fieldset class="fset" id="book_rh">
      <legend class="legend"></legend>
      <div class="row form-group">
          
      
          <div class="col-md-12">
       <b> Directorate:-</b>
           <select id="dir_code" name="dir_code">
                      <option value="1000">All Directorate</option>
                      <?php
                     foreach($directorate_list as $directorate)
                     {
                        if($selected_dte==$directorate['dte_id'])
                          echo '<option value="' .$directorate['dte_id']. '" selected>' .$directorate['dte_desc'].'</option>';
                        else
                        echo '<option value="' .$directorate['dte_id']. '">' .$directorate['dte_desc'].'</option>';
                     }
                     ?>
                    </select>
            <?php
              if($selected_dte!='-1'){
             ?>
                <script>$(document).ready(function() {
                        $('#btn_view').trigger('click');
                });</script>
              <?php } ?>

                    <input type="button" class="btn btn-outline-primary btn-sm btn-default" name="view" value="View" id="btn_view">
      </div>
      
          
    </fieldset>
        
       <fieldset class="fset app_list hide" id="fset_emp_list" style="font-size: .8em">
       <legend class="legend">List of Employees of selected directorate pending for Profile Verification/प्रोफ़ाइल सत्यापन के लिए लंबित चयनित निदेशालय के कर्मचारियों की सूची</legend>
      <div class='col-md-12 table-responsive' >
        <table class="table table-condensed table-hover" id="table_profile_list">
          <thead>
            <tr>
            <th>SNo/क्रमांक</th>    
            <th>IPAS ID/कर्मचारी सं</th>
             <th>Name/नाम</th>
             <th>Designation/पद</th>
            <th>Directorare/निदेशालय</th>
            <th></th>
             </tr>
          </thead>
          <tbody>
          
          </tbody>
        </table>
      </div>
    </fieldset>
  
    <script>
 
$(document).ready(function() {
  
}); //document ready
 

    $('#btn_view').click(function(){
       var dir_id= $('#dir_code').val();
        var srno=0;
    $('#table_profile_list > tbody').empty();
             $.ajax({
            type: "POST",
         url:"<?php echo base_url() . 'ProfileVerification/get_profile_verification_list/'?>"+dir_id,
         data:{csrf_token:csrf_token},  
          //dataType: "JSON",
            success: function(data){
             data=JSON.parse(data);         
            csrf_token=data.csrf_token;     
            $('#fset_emp_list').removeClass('hide');
            $('#fset_emp_list').addClass('show');   
          // $.each(data,function(index, val) {
              $.each(data.rep_data,function(index, val) {

            var html="<tr><td>"+ ++srno +"</td>"; 
            html+="<td>"+val.login_id+"</td>";  
            html+="<td>"+val.name+"</td>"; 
            html+="<td>"+val.desig_desc+"</td>"; 
            html+="<td>"+val.dte_desc+"</td>";   
            html+="<td><a target='_blank' href='"+"<?php echo base_url();?>"+"ProfileVerification/profile_verification/"+val.login_id+"/"+dir_id+"'>View </a></td>"; 
            html+="</tr>";
                $('#table_profile_list > tbody:last-child').append(html);
                });

              },
                 error: function(){
                 msg="Error while getting employee profile list!";
                 window.alert(msg);
                              }
          }); //ajax
    }); //$('#btn_view').click
   

     </script>
     
