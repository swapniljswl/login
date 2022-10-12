(function($){
	"use strict";
	var base_url=base_addr;
	$.fn.get_results=function(){
		var html='';
		var rep_data={
			'from_dt' 	: $('#from_dt').val(),
			'to_dt' 	: $('#to_dt').val(),
			'req_type'	: $('#req_type').val().toUpperCase(),
			'status'	: $('#status').val().toUpperCase()
		}
		rep_data=JSON.stringify(rep_data);
		console.log(rep_data);
		$.ajax({
			type:"POST",
			url:base_url+"Report_Clearance_Requested/get_results",
			data:{rep_data:rep_data},
			success:function(response)
			{
				response=JSON.parse(response);
				$.each(response,function(i,v){
					html+='<tr>';
					html+='<td class="sn"></td>';
					html+='<td>'+v.req_dt+'</td>';
					html+='<td>'+v.empno+'</td>';
					html+='<td>'+v.emp_name+' '+v.emp_desig+' /'+v.emp_dte+'</td>';
					html+='<td>'+v.req_type_desc+'</td>';
					html+='<td>'+v.dt_processed_on_by_vig+'</td>';
					html+='<td>'+v.dt_processed_on_by_dar+'</td>';
					html+='</tr>';
				});
				$('#clearance_req_list > tbody').html(html);
			},
			error:function()
			{
				var msg="Error occured while getting results.";
          		show_info_dialog(msg);
			}
		})
	}
}(jQuery));