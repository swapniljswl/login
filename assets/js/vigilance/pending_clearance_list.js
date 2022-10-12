(function($){
	"use strict";
	var base_url=base_addr;
	$.fn.show_vig_his=function(options){
		var settings = $.extend({
			row : null
		},options);
		var req_data={
			req_id 	: settings.row.find('.req_id').text(),
			req_dt 	: settings.row.find('.req_dt').text(),
			empno	: settings.row.find('.empno').text().toUpperCase(),
			emp_desc: settings.row.find('.emp_desc').text().toUpperCase(),
			clearance_purpose:settings.row.find('.clearance_purpose').text().toUpperCase()
		};
		var vig_hist;
		$.when(get_vig_his(req_data.req_id)).then(function(status){
			if(status!=false){
				vig_hist=status;
				show_modal_data(req_data,vig_hist);
			}
		});
		
	};
	$.fn.get_vig_his_desc=function(){
		var desc_id=$(this).closest('tr').find('.desc_id').text().toLowerCase();
        var req_id=$('#req_id').text();
        var html='';
        $.ajax({
          type  :"POST",
          url   :base_url+'Pending_Clearance_Vig/get_vig_his_desc',
          data  :{req_id:req_id,desc_id:desc_id},
          success:function(response){
            response=JSON.parse(response);
            if(response.error==true)
            {
            	$('#modal_emp_vig_his').modal('hide');
            	show_alert_dialog(response.error_msg,'modal_emp_vig_his');
            }
            else
            {
              $.each(response.data,function(i,v){
                html+='<tr><td>'+v.case_no+'</td><td>'+v.case_dt+'</td></tr>';
              });
              $('.vig_his_desc_header').html(desc_id.toUpperCase());
              $('.vig_his_desc').closest('div').removeClass('hide');
              $('.vig_his_desc >tbody').html(html);
            }
          },
          error:function(){
            var msg="Error occured while getting Details.";
            $('#modal_emp_vig_his').modal('hide');
            show_alert_dialog(msg,'modal_emp_vig_his');
            $('.vig_his_desc').closest('div').addClass('hide');
          }
        });
	};
	$.fn.process_case=function(){
		var req_id=$('#req_id').text();
		$('#modal_emp_vig_his').modal('hide');
		$.ajax({
			type 	: "POST",
			url 	: base_url+'Pending_Clearance_Vig/save_vig_history',
			data 	: {req_id:req_id},
			success:function(response){
				response=JSON.parse(response);
	 			if(response.error==true)
				{
					show_info_dialog(response.error_msg);
				}
				else
				{

					show_info_dialog(response.msg);
				}
			},
			error:function(){
				var msg="Error occured while processing clearance request.";
				show_info_dialog(msg);
			}
		});
	}
	function get_vig_his(req_id)
	{
		var dfd=$.Deferred();
		$.ajax({
			type 	: "POST",
			url		: base_url+'Pending_Clearance_Vig/get_vig_history',
			data 	: {req_id:req_id},
			success:function(response){
				response=JSON.parse(response);
	 			if(response.error==true)
				{
					show_info_dialog(response.error_msg);
					dfd.resolve(false);
				}
				else
		        {
		        	dfd.resolve(response.data);
		        }
			},
			error:function(){
				var msg="Error occured while getting Vigilance History.";
          		show_info_dialog(msg);
          		dfd.resolve(false);
			}
		});
		return dfd.promise();
	}
	function show_modal_data(req_data,vig_hist)
	{

		var html='';
		$('#req_id').text(req_data.req_id);
	    $('#req_dt').text(req_data.req_dt);
	    $('#clearance_purpose').text(req_data.clearance_purpose);
	    $('#empno').text(req_data.empno);
	    $('#emp_desc').text(req_data.emp_desc);
	    $.each(vig_hist,function(i,v){
	    	html+='<tr><td>'+v.description+'</td><td><a href="#" onClick="event.preventDefault();" class="get_vig_his_desc">'+v.cnt+'</a></td><td class="hide desc_id">'+v.desc_id+'</td></tr>';
	    });
	    $('#modal_emp_vig_his .vig_his > tbody').html(html);
	    $('.vig_his_desc').closest('div').addClass('hide');
	    $('#modal_emp_vig_his').modal('show');
	}
	
}(jQuery));