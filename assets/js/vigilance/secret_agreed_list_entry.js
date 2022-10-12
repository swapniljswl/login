(function($){
	"use strict";
	var base_url=base_addr;
	$.fn.modify=function(options){
		var settings = $.extend({
        	data 	: null
        }, options);
         var agreed_secret_data={
        'empno'             	:settings.data[1],
        'in_secret_list'        :((settings.data[2].toUpperCase()=='YES')?1:0),
        'in_agreed_list'        :((settings.data[4].toUpperCase()=='YES')?1:0)        
      };
      show_modal_data('edit',agreed_secret_data);
      return this;
	};
	$.fn.add=function(){
		show_modal_data('add',null);
    	return this;
	};
	function show_modal_data(func,data){
		if(func=='edit'){
			$('#modal_secret_agreed_entry_form .modal-title').html('Edit: Secret/Agreed Entry');
			$('#empno').val(data.empno).prop('disabled',true);
			if(data.in_secret_list=='1')
				$('.secret_entry').addClass('hide');
			else
				$('.secret_entry').removeClass('hide');
			if(data.in_agreed_list=='1')
				$('.agreed_entry').addClass('hide');
			else
				$('.agreed_entry').removeClass('hide');
			$('#save_btn').removeClass('save');
			$('#save_btn').addClass('edit');
		}
		else if(func=='add'){
			$('#modal_secret_agreed_entry_form .modal-title').html('Add: Secret/Agreed Entry');
			$('#empno').val('');
			$('.secret_entry').removeClass('hide');
			$('.agreed_entry').removeClass('hide');
			$('#save_btn').removeClass('edit');
			$('#save_btn').addClass('save');	
		}
	}

}(jQuery));