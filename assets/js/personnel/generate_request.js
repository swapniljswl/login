(function($){
	"use strict";
	var base_url=base_addr;
	$.fn.save_request=function(){
		var clearance_req={
			'req_type'		: $('#req_type').val().toUpperCase(),
			'purpose_cd'	: $('#purpose_cd').val().toUpperCase(),
			'empno'			: $('#empno').val().toUpperCase(),
			'emp_name'		: $('#emp_name').val().toUpperCase(),
			'emp_desig'		: $('#emp_desig').val().toUpperCase(),
			'emp_dte'		: $('#emp_dte').val().toUpperCase()
		};
		clearance_req=JSON.stringify(clearance_req);
		console.log(clearance_req);
		$.ajax({
			type 	: "POST",
			url 	: base_url+'Generate_Request/save_request',
			data 	: {clearance_req : clearance_req},
			success:function(response){
				response=JSON.parse(response);
	 			if(response.error==true)
				{
					show_info_dialog(response.error_msg);
				}
				else
		        {
		            show_info_dialog(response.msg,response.url);
		        }
			},
			error:function(){
				var msg="Error occured while saving request.";
          		show_info_dialog(msg);
			}
		});
	}
}(jQuery));