 <link href="<?php echo base_url('assets/css/jquery.treetable.css')?>" rel="stylesheet" type="text/css">
 <link href="<?php echo base_url('assets/css/jquery.treetable.theme.default.css')?>" rel="stylesheet" type="text/css">
 
 <script src="<?php echo base_url('assets/js/jquery.treetable.js'); ?>"></script>
 <script src="<?php echo base_url('assets');?>/plugins/custombox/js/custombox.min.js"></script>
  <script src="<?php echo base_url('assets');?>/plugins/custombox/js/legacy.min.js"></script>
  <link href="<?php echo base_url('assets');?>/plugins/custombox/css/custombox.min.css" rel="stylesheet">



  <style>


div.modal_role_table > div:nth-of-type(odd) {
    background: #e0e0e0;
}
/*div.modal_role_table >div.row
{
  height: 6vh;
}*/
div.modal_role_table>div.row:hover {
    background-color: #9f9fad;

}
.treetable tbody>tr:hover{
 background-color: #9f9fad;
}

</style>

<div class="content">
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="page-title-box">
        <h4 class="page-title">Role Master</h4>

        <ol class="breadcrumb p-0 m-0">

          <li>
            <a href="#">Administration</a>
          </li>
          <li class="active">
            Role Master
          </li>
        </ol>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>

         <div class="card-box">

          <a href="#modal_submenu" id='show_modal' class="hide btn btn-primary waves-effect waves-light m-r-5 m-b-10" data-animation="rotatedown" data-plugin="custommodal"
                                                      data-overlaySpeed="100" data-overlayColor="#36404a">Rotate Down</a>

        <div class="row">
   
          </div>
          <div class="card-body">
           <div class="table-responsive" >
             <table id="role_tree" class="treetable" style="font-size: 1em;">
              <thead>
                <tr>
                  <th>Role Name</th>
                  <th style="display:none;">Role Id</th>
                  <th style="display: none;">lft</th>
                  <th style="display: none;">rght</th>
                   <th>Sort Order</th>
                 
                </tr>
              </thead>
              <tbody>
                <tr data-tt-id="<?php echo $root_role['role_id']; ?>">
                  <td><?php echo $root_role['role_name']; ?></td>
                  <td style="display: none;"><?php echo $root_role['role_id'];?></td>
                  <td style="display: none;"><?php echo $root_role['lft'];?></td>
                  <td style="display: none;"><?php echo $root_role['rght'];?></td>
                  <td><?php echo $root_role['sort_order']; ?></td>
                </tr>
             
            <?php
                foreach ($role_items as $role_item)
                {
                  echo '<tr data-tt-id="'.$role_item['role_id'].'" data-tt-parent-id="'.$role_item['parent_id'].'">';
                  
                  echo '<td><span>'.$role_item['role_name'].'</span></td>';
                  echo '<td style="display:none;">'.$role_item['role_id'].'</td>';
                  echo '<td style="display:none;">'.$role_item['lft'].'</td>';
                  echo '<td style="display:none;">'.$role_item['rght'].'</td>';
                  echo '<td>'.$role_item['sort_order'].'</td>';
                  echo '</tr>';

                }
              
              ?>
               </tbody>
             </table>
           </div>
         </div>
       </div>
  <!--<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>-->
  <!-- <div class="modal fade" id="modal_submenu">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" style="word-wrap: break-word;">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary btn-sm" id="add_row">Add Row </button>
          <button type="button" class="btn btn-outline-primary btn-sm" id="save_menu">Save changes</button>
          <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> -->

<div id="modal_submenu" class="modal-demo">
          <button type="button" class="close" onclick="Custombox.close();">
              <span>&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="custom-modal-title modal-title"></h4>
          <div class="custom-modal-text modal-body" style="word-wrap: break-word;">
             
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary btn-sm" id="add_row">Add Row </button>
          <button type="button" class="btn btn-outline-primary btn-sm" id="save_menu">Save changes</button>
          <button type="button" class="btn btn-outline-danger btn-sm" onclick="Custombox.close();">Close</button>
        </div>
      </div>


  </div> <!-- End of Container-->
<script>
  $("#role_tree").treetable({ expandable: true,clickableNodeNames: true,initialState: "expanded" });
  //$("#menu_tree").treetable("expandAll");
  $(document).ready(function() {
    

    $("#role_tree tbody").on("mousedown", "tr", function() 
    {
      $(".selected").not(this).removeClass("selected");
      $(this).toggleClass("selected");
    });

    $("#role_tree tr").dblclick(function(){
      var submenu={};
      var parent_id=$(this).attr('data-tt-id');
      var parent_title=$(this).find("td:eq(0)").text();
      var parent_lft=$(this).find("td:eq(2)").text();
      $("#role_tree tr").each(function(row,tr){
        if($(this).attr('data-tt-parent-id')==parent_id)
        {
          submenu[row]={
            'role_name'   : $(this).find("td:eq(0)").text(),
            'role_id'     : $(this).find("td:eq(1)").text(),
            'lft'         : $(this).find("td:eq(2)").text(),
            'rght'        : $(this).find("td:eq(3)").text(),
            'sort_order'  : $(this).find("td:eq(4)").text()       
          };
        }
      });

      $("#modal_submenu .modal-title").text('Edit Role- '+parent_title);
      $("#modal_submenu .modal-body").html(submenu_html(submenu,parent_id));
      // $("#modal_submenu").modal('show');
      $('#show_modal').click();
    });

    $("#add_row").click(function(){
      var sn=parseInt($(".modal_role_table div:last-child").find("div:eq(0)").text());
      if(isNaN(sn))
        sn=0;
      sn++;
      $(".modal_role_table").append('<div class="row new"><div class="col-md-2">'+sn+'</div><div class="col-md-6"><input type="text" class="form-control-sm form-control"></div><div class="col-md-2"><input type="text" class="form-control-sm form-control"></div></div>');
    });

    $("#save_menu").click(function(){
      var submenu={};
      var submenu_update={};
      $(".new").each(function(row,div){
        //debugger
        submenu[row]={
          'role_name'     : $(this).find("div:eq(1)").find("input[type='text']").val(), 
          'sort_order'    : $(this).find("div:eq(2)").find("input[type='text']").val()
        };

        });
       $(".update").each(function(row,div){
          submenu_update[row]={
            'role_id'       : $(this).find("div:eq(2)").text(),
            'role_name'     : $(this).find("div:eq(1)").find("input[type='text']").val(),
            'sort_order'    : $(this).find("div:eq(3)").find("input[type='text']").val()
          };
      });
       
        parent_id=$(".modal_role_table").attr('id');
        submenu=JSON.stringify(submenu);
        submenu_update=JSON.stringify(submenu_update);
        // console.log(parent_id+' '+submenu);
        
        $.ajax({
          type:"POST",
          url: "<?php echo base_url('Role_Master/add')?>",
          //data: {role  : submenu, parent : parent_id},
           data: {csrf_token:csrf_token,role  : submenu, parent : parent_id},
          success: function(response){
            response=JSON.parse(response);
            csrf_token=response.csrf_token;
             $("#modal_submenu").modal('hide');
            window.location.href=response.url;
          },
          error: function(){
            $("#modal_submenu").modal('hide');
              msg="Error while saving Role Data.";
              show_alert_dialog(msg,'modal_submenu');
          }

        });
         $.ajax({
            type:"POST",
            url:"<?php echo base_url('Role_Master/update');?>",
            //data: {role : submenu_update },
            //success: function($url){
               data: {csrf_token:csrf_token,role : submenu_update },
               success: function(response){
              response=JSON.parse(response);
              csrf_token=response.csrf_token;
              $("#modal_submenu").modal('hide');
                window.location.href=response.url;
            },
            error: function(){
              $("#modal_submenu").modal('hide');
              msg="Error while updating Role Data.";
              show_alert_dialog(msg,'modal_submenu');
            }
        });
      
    });
  $("#modal_submenu .modal-body").on('dblclick','div[class*=role_item]',function(){
    if(!($(this).hasClass('update')))
    {
      $(this).addClass('update');
      var sub_role_name=$(this).find('div:eq(1)');
      var sort_order=$(this).find('div:eq(3)');
      sub_role_name=sub_role_name.html('<input type="text" class="form-control" value="'+sub_role_name.text()+'">');
      sort_order=sort_order.html('<input type="text" class="form-control" value="'+sort_order.text()+'">');
    }
    

  });
    
  });


  function submenu_html(submenu,parent)
  {
    var table_html='<div class="modal_role_table" id="'+parent+'"><div class="row">';
    table_html+='<div class="col-md-2"><b>Sr No.</b></div>';
    table_html+='<div class="col-md-6"><b>SubRole Name</b></div>';
    table_html+='<div class="col-sm-2"><b>Sort Order</b></div>';
    table_html+='</div>';
    sn=1;
    $.each(submenu,function(index,val){
     
      table_html+='<div class="row role_item"><div class="col-md-2">'+sn+'</div>';
      table_html+='<div class="col-md-6">'+submenu[index].role_name+'</div>';
      table_html+='<div class="hide">'+submenu[index].role_id+'</div>';
      table_html+='<div class="col-sm-2">'+submenu[index].sort_order+'</div>';
      table_html+='</div>';
      sn++;
    });
    table_html+='</div>';
    return table_html;

  }
  

</script>