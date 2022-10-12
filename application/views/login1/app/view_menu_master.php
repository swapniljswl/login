<link href="<?php echo base_url('assets/css/jquery.treetable.css')?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/jquery.treetable.theme.default.css')?>" rel="stylesheet" type="text/css">

<script src="<?php echo base_url('assets/js/jquery.treetable.js'); ?>"></script>
<script src="<?php echo base_url('assets');?>/plugins/custombox/js/custombox.min.js"></script>
  <script src="<?php echo base_url('assets');?>/plugins/custombox/js/legacy.min.js"></script>
  <link href="<?php echo base_url('assets');?>/plugins/custombox/css/custombox.min.css" rel="stylesheet">

<style>
div.modal_menu_table > div:nth-of-type(odd) {
    background: #e0e0e0;
}
/*div.modal_menu_table >div.row
{
  height: 6vh;
}*/
div.modal_menu_table>div.row:hover {
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
        <h4 class="page-title">Menu Master</h4>

        <ol class="breadcrumb p-0 m-0">

          <li>
            <a href="#">Administration</a>
          </li>
          <li class="active">
            Menu Master
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
     <div class="table-responsive" >
       <table id="menu_tree" class="treetable" style="font-size:1em;">
        <thead>
          <tr>

            <th>Menu Name</th>
            <th>Title</th>
            <th>Path</th>
            <th style="display:none;">Menu_id</th>
            <th style="display: none;">lft</th>
            <th style="display: none;">rght</th>
            <th>Sort Order</th>

          </tr>
        </thead>
        <tbody>
          <tr data-tt-id="<?php echo $root_menu['menu_id']; ?>">

            <td><?php echo $root_menu['menu_name']; ?></td>
            <td><?php echo $root_menu['title'];?></td>
            <td><?php echo $root_menu['path'];?></td>
            <td style="display: none;"><?php echo $root_menu['menu_id'];?></td>
            <td style="display: none;"><?php echo $root_menu['lft'];?></td>
            <td style="display: none;"><?php echo $root_menu['rght'];?></td>
            <td><?php echo $root_menu['sort_order']; ?></td>
          </tr>

          <?php
          foreach ($menu_items as $menu_item)
          {
            echo '<tr data-tt-id="'.$menu_item['menu_id'].'" data-tt-parent-id="'.$menu_item['parent_id'].'">';

            echo '<td>'.$menu_item['menu_name'].'</td>';
            echo '<td>'.$menu_item['title'].'</td>';
            echo '<td>'.$menu_item['path'].'</td>';
            echo '<td style="display:none;">'.$menu_item['menu_id'].'</td>';
            echo '<td style="display:none;">'.$menu_item['lft'].'</td>';
            echo '<td style="display:none;">'.$menu_item['rght'].'</td>';
            echo '<td>'.$menu_item['sort_order'].'</td>';
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
$("#menu_tree").treetable({ expandable: true,clickableNodeNames: true,initialState: "expanded" });
//$("#menu_tree").treetable("expandAll");
$(document).ready(function() {

  $("#menu_tree tbody").on("mousedown", "tr", function() 
  {
    $(".selected").not(this).removeClass("selected");
    $(this).toggleClass("selected");
  });

  $("#menu_tree tr").dblclick(function(){
    var submenu={};
    var parent_id=$(this).attr('data-tt-id');
    var parent_title=$(this).find("td:eq(1)").text();
    var parent_lft=$(this).find("td:eq(4)").text();
    $("#menu_tree tr").each(function(row,tr){
      if($(this).attr('data-tt-parent-id')==parent_id)
      {
        submenu[row]={
          'menu_name'   : $(this).find("td:eq(0)").text(),
          'title'       : $(this).find("td:eq(1)").text(),
          'path'        : $(this).find("td:eq(2)").text(),
          'menu_id'     : $(this).find("td:eq(3)").text(),
          'lft'         : $(this).find("td:eq(4)").text(),
          'rght'        : $(this).find("td:eq(5)").text(),
          'sort_order'  : $(this).find("td:eq(6)").text()    
        };
      }
    });

    $("#modal_submenu .modal-title").text('Edit Menu- '+parent_title);
    $("#modal_submenu .modal-body").html(submenu_html(submenu,parent_id));
    // $("#modal_submenu").modal('show');
    $('#show_modal').click();
  });

  $("#add_row").click(function(){
    var sn=parseInt($(".modal_menu_table div:last-child").find("div:eq(0)").text());
    if(isNaN(sn))
      sn=0;
    sn++;
    $(".modal_menu_table").append('<div class="row new"><div class="col-sm-1 checkbox checkbox-success checkbox-circle">'+sn+'<input type="checkbox" style="margin-left:2px;"></div><div class="col-sm-2"><input type="text" class="form-control-sm form-control"></div><div class="col-sm-3"><input type="text" class="form-control-sm form-control"></div><div class="col-sm-4"><input type="text" class="form-control-sm form-control"></div><div class="col-sm-2"><input type="text" class="form-control-sm form-control"></div></div>');
  });

  $("#save_menu").click(function(){
    var submenu={};
    var submenu_update={};
    $(".new").each(function(row,div){
      //debugger
      submenu[row]={
        'menu_name'     : $(this).find("div:eq(1)").find("input[type='text']").val(), 
        'title'         : $(this).find("div:eq(2)").find("input[type='text']").val(),
        'path'          : $(this).find("div:eq(3)").find("input[type='text']").val(),
        'sort_order'    : $(this).find("div:eq(4)").find("input[type='text']").val(),
        'icon'          : $(this).find('div:eq(0)').find("input[type='checkbox']").is(':checked')

      };

    });
    $(".update").each(function(row,div){
      submenu_update[row]={
        'menu_id'       : $(this).find("div:eq(5)").text(),
        'menu_name'     : $(this).find("div:eq(1)").find("input[type='text']").val(), 
        'title'         : $(this).find("div:eq(2)").find("input[type='text']").val(),
        'path'          : $(this).find("div:eq(3)").find("input[type='text']").val(),
        'sort_order'    : $(this).find("div:eq(4)").find("input[type='text']").val()
      };
    });

    parent_id=$(".modal_menu_table").attr('id');
    submenu=JSON.stringify(submenu);
    submenu_update=JSON.stringify(submenu_update);
    console.log(submenu);
    console.log(parent_id);
    console.log(submenu_update);

    $.ajax({
      type:"POST",
      url: "<?php echo base_url('Menu_Master/add')?>",
      //data: {menu  : submenu, parent : parent_id},
      data: {csrf_token:csrf_token,menu  : submenu, parent : parent_id},
      //success: function($url){
        success: function(response){
          //window.alert($msg);
          response=JSON.parse(response);
          csrf_token=response.csrf_token;
          $("#modal_submenu").modal('hide');
          window.location.href=response.url;
        },
        error: function(){
          $("#modal_submenu").modal('hide');
          msg="Error while saving Menu Data.";
          show_alert_dialog(msg,'modal_submenu');
        }

      });
    $.ajax({
      type:"POST",
      url:"<?php echo base_url('Menu_Master/update');?>",
      //data: {menu : submenu_update },
      data: {csrf_token:csrf_token,menu : submenu_update },
      //success: function($url){
        success: function(response){
        response=JSON.parse(response);
        csrf_token=response.csrf_token;
        $("#modal_submenu").modal('hide');
          window.location.href=response.url;
      },
      error: function(){
        $("#modal_submenu").modal('hide');
        msg="Error while updating Menu Data.";
        show_alert_dialog(msg,'modal_submenu');
      }
    });
    
  });
  $("#modal_submenu .modal-body").on('dblclick','div[class*=menu_item]',function(){
    if(!($(this).hasClass('update'))){
    $(this).addClass('update');
    var sub_menu_name=$(this).find('div:eq(1)');
    var title=$(this).find('div:eq(2)');
    var path=$(this).find('div:eq(3)');
    var sort_order=$(this).find('div:eq(4)');
    sub_menu_name=sub_menu_name.html('<input type="text" class="form-control" value="'+sub_menu_name.text()+'">');
    title=title.html('<input type="text" class="form-control" value="'+title.text()+'">');
    path=path.html('<input type="text" class="form-control" value="'+path.text()+'">');
    sort_order=sort_order.html('<input type="text" class="form-control" value="'+sort_order.text()+'">');
  }

  });
});


function submenu_html(submenu,parent)
{
  var table_html='<div class="modal_menu_table" id="'+parent+'"><div class="row">';
  table_html+='<div class="col-sm-1"><b>Sr No.</b></div>';
  table_html+='<div class="col-sm-2"><b>SubMenu Name</b></div>';
  table_html+='<div class="col-sm-3"><b>Title</b></div>';
  table_html+='<div class="col-sm-4"><b>Path</b></div>';
  table_html+='<div class="col-sm-2"><b>Sorting</b></div>';
  table_html+='</div>';
  sn=1;
  $.each(submenu,function(index,val){

    table_html+='<div class="row menu_item"><div class="col-sm-1">'+sn+'</div>';
    table_html+='<div class="col-sm-2">'+submenu[index].menu_name+'</div>';
    table_html+='<div class="col-sm-3">'+submenu[index].title+'</div>';
    table_html+='<div class="col-sm-4">'+submenu[index].path+'</div>';
    table_html+='<div class="col-sm-2">'+submenu[index].sort_order+'</div>';
    table_html+='<div class="hide">'+submenu[index].menu_id+'</div>';
    table_html+='</div>';
    sn++;
  });
  table_html+='</div>';
  return table_html;

}


</script>