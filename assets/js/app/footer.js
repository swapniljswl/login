 var resizefunc = [];
          $(document).ready(function(){
            $('input[type*=text]').prop('autocomplete','off');
            $('.autonumber').autoNumeric('init');
            $('.date_field').datepicker({
              format: 'dd-mm-yyyy',
              autoclose : true,
              todayHighlight: true,
              endDate : '+0d'
            });
            $('.allow_future_dt').datepicker('setEndDate','+30d');
            $('.allow_infinite_future_dt').datepicker('setEndDate','');
            $('.retirement_dt').datepicker('setEndDate','');
            
          });
          function show_info_dialog(msg,url=null)
          {
            $('#info_dialog .body').html(msg);
            $("#info_dialog").on("shown.bs.modal", function () { 
                $(this).find('.close').focus();
            });
            $('#info_dialog').on('hidden.bs.modal',function(){
                $('*[tabindex="1"]').focus();
            });
            if(url!=null){
                $('#info_dialog .close').click(function(){
                    window.location.href=url;
                });
            }
            $('#info_dialog').modal('show');

          }
          function show_alert_dialog(msg,next_modal=null)
          {
            $('#alert_dialog .body').html(msg);
            $('#alert_dialog').modal('show');
            if(next_modal!=null)
              $('#alert_dialog .close').attr('data-target','#'+next_modal);
            else
              $('#alert_dialog .close').attr('data-target','');
          }
          function show_confirm_dialog(title,msg,ok_activity,params=null)
          {
            var param_str='';
            var dfd=$.Deferred();
            $('#confirm_dialog .title').text(title);
            $('#confirm_dialog .body').html(msg);
            if(params!=null)
            {
              params.forEach(function(element){
                param_str+= element+',';        
            });
              param_str=param_str.slice(0,-1);
            }
            // $('#confirm_dialog .ok').click(function(){
            //   if(params!=null)
            //     $.when(ok_activity(param_str)).then(function(status){
            //       dfd.resolve(status);
            //     });
            //   else
            //     $.when(ok_activity()).then(function(status){
            //       dfd.resolve(status);
            //     });
            // });
            $('#confirm_dialog .ok').on('click',function(){
              if(params!=null)
                $.when(ok_activity(param_str)).then(function(status){
                  dfd.resolve(status);
                });
              else
                $.when(ok_activity()).then(function(status){
                  dfd.resolve(status);
                });
            });

            $('#confirm_dialog .cancel').on('click',function(){
              $('#confirm_dialog .ok').off('click');
            });
            
            $('#confirm_dialog').modal('show');
            return dfd.promise();
          }
