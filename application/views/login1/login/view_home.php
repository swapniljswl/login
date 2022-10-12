<div class="content">
    <div class="container" >
      <div class="row">
          <div class="col-xs-12">
            <div class="page-title-box">
              <div class="vig_heading" style="width:100%"> <span> </span>&nbsp;&nbsp;IT Applications / आईटी अनुप्रयोग</div>

                 <!-- <h4 class="page-title">Home</h4> -->            
          <div class="clearfix"></div>
      </div>
  </div>
</div>
<form class="form">
    <?php   $message = $this->session->flashdata('chprof_success');
               if (isset($message)) {
                 echo '<div align="center" class="alert alert-info" >' . $message . '</div>';
                 $this->session->unset_userdata('message');
                 }
               ?>
            <thead >
           <?php  echo '<table width="100%">';
		   $cnt=0;  	   
					   foreach ($record1 as $row)
                 { 					
		       if($cnt == 0){
               echo '<tr>';
    }
     ?>       <td width="30%">
                     	<div class="form-group">
							<span style="width:100%">
							 <a href= <?php echo $row->app_link ?> class="btn btn-info" role="button"><?php echo $row->app_name ?></a>
								 </span>
				        </div>
                      </div>                     
            <?php
    echo '</td>';
    if($cnt == 1){
        $cnt = 0;
        echo '</tr>';
    } else {
        $cnt = $cnt + 1;
    } ?>              	
        <?php          
			 }
			?> 
</form>



</div> <!-- End of Container -->
 



