(function($){
	"use strict";
	var base_url=base_addr;
	$.fn.save_case = function(){
		var case_dtl={};
		var suspect_dtl={};
		case_dtl={
			'case_dt'		: $('#case_dt').val(),
			'case_no'		: $('#case_no').val().toUpperCase(),
			'case_type_cd'	: $('#case_type_cd').val().toUpperCase(),
			'discipline_cd'	: $('#discipline_cd').val().toUpperCase(),
			'subject'		: $('#subject').val().toUpperCase(),
			'case_desc'		: $('#case_desc').val().toUpperCase(),
			'case_status'	: $('#case_status').val(),
			'remarks'		: $('#remarks').val().toUpperCase(),
			'dt_sent_to_rly_bd': $('#dt_sent_to_rly_bd').val(),
			'remarks_sys_imp': $('#remarks_sys_imp').val().toUpperCase()
		};
		if(case_dtl['case_type_cd']=='1')
			case_dtl['complaint_cat_cd']=$('#complaint_cat_cd').val().toUpperCase();

		if($('#suspect_list > tbody tr.new').length>0)
		{
			$.each($('#suspect_list > tbody tr.new'),function(i,v){
				suspect_dtl[i]={
					'empno'				: $(v).find('td:eq(1)').text(),
					'emp_name'			: $(v).find('td:eq(2)').text(),
					'desig'				: $(v).find('td:eq(3)').text(),
					'dte'				: $(v).find('td:eq(4)').text(),
					'cvc_bd_cvo_advice'	: $(v).find('td:eq(5)').text(),
					'action_proposed'	: $(v).find('td:eq(6)').text(),
					'final_penalty_cd'	: $(v).find('td:eq(7)').text(),
					'nip_dtl'			: $(v).find('td:eq(8)').text(),
					'nip_start_dt'		: $(v).find('td:eq(9)').text(),
					'nip_end_dt'		: $(v).find('td:eq(10)').text()
				};
			});
		}
		case_dtl=JSON.stringify(case_dtl);
		suspect_dtl=JSON.stringify(suspect_dtl);
		console.log(case_dtl);
		console.log(suspect_dtl);
		$.ajax({
			type:"POST",
			url:base_url+'Vig_Case_Entry/save_case',
			data:{case_dtl:case_dtl,suspect_dtl:suspect_dtl},
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
				var msg="Error occured while saving case.";
          		show_info_dialog(msg);
			}
		});
	};
	$.fn.update_case=function(){
		var case_id=$('#case_id').val();
		var suspect_dtl={};
		var case_dtl={
			'case_type_cd'		: $('#case_type_cd').val().toUpperCase(),
			'discipline_cd'		: $('#discipline_cd').val().toUpperCase(),
			'subject'			: $('#subject').val().toUpperCase(),
			'case_desc'			: $('#case_desc').val().toUpperCase(),
			'case_status'		: $('#case_status').val(),
			'remarks'			: $('#remarks').val().toUpperCase(),
			'dt_sent_to_rly_bd'	: $('#dt_sent_to_rly_bd').val(),
			'remarks_sys_imp'	: $('#remarks_sys_imp').val().toUpperCase()
		};
		if(case_dtl['case_type_cd']=='1')
			case_dtl['complaint_cat_cd']=$('#complaint_cat_cd').val().toUpperCase();

		if($('#suspect_list > tbody tr.new').length>0)
		{
			$.each($('#suspect_list > tbody tr.new'),function(i,v){
				suspect_dtl[i]={
					'empno'			: $(v).find('td:eq(1)').text(),
					'emp_name'			: $(v).find('td:eq(2)').text(),
					'desig'				: $(v).find('td:eq(3)').text(),
					'dte'				: $(v).find('td:eq(4)').text(),
					'cvc_bd_cvo_advice'	: $(v).find('td:eq(5)').text(),
					'action_proposed'	: $(v).find('td:eq(6)').text(),
					'final_penalty_cd'	: $(v).find('td:eq(7)').text(),
					'nip_dtl'			: $(v).find('td:eq(8)').text(),
					'nip_start_dt'		: $(v).find('td:eq(9)').text(),
					'nip_end_dt'		: $(v).find('td:eq(10)').text()
				};
			});
		}
		case_dtl=JSON.stringify(case_dtl);
		suspect_dtl=JSON.stringify(suspect_dtl);
		console.log(case_dtl);
		console.log(suspect_dtl);
		console.log(case_id);
		$.ajax({
			type:"POST",
			url:base_url+'Vig_Case_Entry/update_case',
			data:{case_dtl:case_dtl,suspect_dtl:suspect_dtl,case_id:case_id},
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
				var msg="Error occured while updating case details.";
          		show_info_dialog(msg);
			}
		});
	}

	$.fn.add_to_suspect_list = function(){
    	var table_html;
    	table_html='<tr class="sus_row new">';
    	table_html+='<td class="sn"><a href="#" data-toggle="collapse" data-target=".'+$('#empno').val().toUpperCase()+'" onClick="event.preventDefault();"></a><span class="del_sus_row"><i class="mdi mdi-delete"></i></span></td>';
    	table_html+='<td>'+$('#empno').val().toUpperCase()+'</td>';
    	table_html+='<td>'+$('#emp_name').val().toUpperCase()+'</td>';
    	table_html+='<td>'+$('#desig').val().toUpperCase()+'</td>';
    	table_html+='<td>'+$('#dte').val().toUpperCase()+'</td>';
    	table_html+='<td class="hide">'+$('#cvc_bd_cvo_advice').val().toUpperCase()+'</td>';
    	table_html+='<td class="hide">'+$('#action_proposed').val().toUpperCase()+'</td>';
    	table_html+='<td class="hide">'+$('#final_penalty_cd').val().toUpperCase()+'</td>';
    	table_html+='<td class="hide">'+$('#nip_dtl').val().toUpperCase()+'</td>';
    	table_html+='<td class="hide">'+$('#nip_start_dt').val()+'</td>';
    	table_html+='<td class="hide">'+$('#nip_end_dt').val()+'</td>';
    	table_html+='</tr>';
    	table_html+='<tr class="collapse '+$('#empno').val().toUpperCase()+'">';
    	table_html+='<td colspan="5"><div class="col-sm-6"><b>CVC/Rly Bd /CVO Advice:</b> '+$('#cvc_bd_cvo_advice').find('option:selected').text().toUpperCase()+'</div>';
    	table_html+='<div class="col-sm-6"><b>Action Proposed:</b> '+$('#action_proposed').find('option:selected').text().toUpperCase()+'</div>';
    	table_html+='<div class="col-sm-6"><b>Final Penalty: </b>'+$('#final_penalty_cd').find('option:selected').text().toUpperCase()+'</div>';
    	table_html+='<div class="col-sm-6"><b>NIP Details: </b>'+$('#nip_dtl').val().toUpperCase()+'</div>';
    	table_html+='<div class="col-sm-6"><b>NIP Start Date: </b>'+$('#nip_start_dt').val()+'</div>';
    	table_html+='<div class="col-sm-6"><b>NIP End Date: </b>'+$('#nip_end_dt').val()+'</div>';
    	table_html+='</td></tr>';
    	$('#suspect_list > tbody').append(table_html);
    };
    $.fn.add_suspect = function(){
    	show_modal_data('add');
    };
    $.fn.get_case_data = function(){
    	var case_dtl;
    	var table_html;
    	case_dtl ={
    		'case_no' : $('#q_case_no').val().toUpperCase(),
    		'case_dt' : $('#q_case_dt').val()
    	};
    	case_dtl=JSON.stringify(case_dtl);
    	// console.log(case_dtl);
    	$.ajax({
    		type : 'POST',
    		url  : base_url+'Vig_Case_Entry/get_case_detail',
    		data : {case_dtl : case_dtl},
    		success: function(response){
    			response=JSON.parse(response);
    			console.log(response);
    			if(response.error==true)
				{
					show_info_dialog(response.error_msg);
				}
				else
		        {
		        	$('#case_id').val(response.case_dtl.case_id);
		            $('#case_no').val(response.case_dtl.case_no).prop('disabled',true);
		            $('#case_dt').val(response.case_dtl.case_dt).prop('disabled',true);
		            $('#case_type_cd').val(response.case_dtl.case_type_cd);
		            if($('#case_type_cd').val()=='1')
		            	$('#complaint_cat_cd').closest('div').removeClass('hide');
		            else
		            	$('#complaint_cat_cd').closest('div').addClass('hide');
		            $('#complaint_cat_cd').val(response.case_dtl.complaint_cat_cd);
		            $('#discipline_cd').val(response.case_dtl.discipline_cd);
		            $('#subject').val(response.case_dtl.subject);
		            $('#case_desc').val(response.case_dtl.case_desc);
		            $('#case_status').val(response.case_dtl.case_status);
		            $('#remarks').val(response.case_dtl.remarks);
		            $('#dt_sent_to_rly_bd').val(response.case_dtl.dt_sent_to_rly_bd);
		            $('#remarks_sys_imp').val(response.case_dtl.remarks_sys_imp);
		            $.each(response.suspect_dtl,function(i,v){
		            	table_html+='<tr class="sus_row">';
		            	table_html+='<td class="sn"><a href="#" data-toggle="collapse" data-target=".'+v.empno+'" onClick="event.preventDefault();"></a></td>';
		            	table_html+='<td>'+v.empno+'</td>';
		            	table_html+='<td>'+v.emp_name+'</td>';
		            	table_html+='<td>'+v.desig+'</td>';
				    	table_html+='<td>'+v.dte+'</td>';
				    	table_html+='<td class="hide">'+v.cvc_bd_cvo_advice+'</td>';
				    	table_html+='<td class="hide">'+v.action_proposed+'</td>';
				    	table_html+='<td class="hide">'+v.final_penalty_cd+'</td>';
				    	table_html+='<td class="hide">'+v.nip_dtl+'</td>';
				    	table_html+='<td class="hide">'+v.nip_start_dt+'</td>';
				    	table_html+='<td class="hide">'+v.nip_end_dt+'</td>';
				    	table_html+='</tr>';
				    	table_html+='<tr class="collapse '+v.empno+'">';
				    	table_html+='<td colspan="5"><div class="col-sm-6"><b>CVC/Rly Bd /CVO Advice:</b> '+v.cvc_bd_cvo_advice_desc+'</div>';
				    	table_html+='<div class="col-sm-6"><b>Action Proposed:</b> '+v.action_proposed_desc+'</div>';
				    	table_html+='<div class="col-sm-6"><b>Final Penalty: </b>'+v.final_penalty_desc+'</div>';
				    	table_html+='<div class="col-sm-6"><b>NIP Details: </b>'+v.nip_dtl+'</div>';
				    	table_html+='<div class="col-sm-6"><b>NIP Start Date: </b>'+v.nip_start_dt+'</div>';
				    	table_html+='<div class="col-sm-6"><b>NIP End Date: </b>'+v.nip_end_dt+'</div>';
				    	table_html+='</td></tr>';
		            });
		            $('#suspect_list > tbody').html(table_html);
		            $('#update_case').prop('disabled',true);
		        }
    		},
    		error:function(){
    			var msg="Error occured while getting case details.";
          		show_info_dialog(msg);
    		}

    	})
    }

	function show_modal_data(func,suspect_data)
	{

		if(func=='edit')
		{
			
		}
		else if(func=='add')
		{
			$('#modal_suspect_entry .modal-title').html('Add: Suspect Details');
		    $('#empno').val('');
		    $('#emp_name').val('');
		    $('#desig').val('');
		    $('#dte').val('');
		    $('#cvc_bd_cvo_advice').val('');
		    $('#action_proposed').val('');
		    $('#final_penalty_cd').val('');
		    $('#nip_dtl').val('');
		    $('#nip_start_dt').val('');
		    $('#nip_end_dt').val('');
		    //$('#supplr_cd').find('option:eq(0)').prop('selected',true);
			// $('#save_btn').removeClass('edit');
			// $('#save_btn').addClass('save');
		}
	}
}(jQuery));