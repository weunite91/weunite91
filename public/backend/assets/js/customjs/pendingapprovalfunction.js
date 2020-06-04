var Pendingfunction = function () {
    
    var list = function(){
       $('body').on("click",".deleteuser",function(){
           var id= $(this).attr('data-id');
           setTimeout(function () {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
            
       });
       
       
        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');
            
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "pending-ajaxAction",
                data: {'action': 'deleteUser', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
       $('body').on("change",".user_type",function(){
           var id= $(this).attr('data-id');
           var val = $(this).val();
           
           $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "pending-ajaxAction",
                data: {'action': 'changeusertype', 'id': id,'val':val},
                success: function(data) {
                   handleAjaxResponse(data);
                }
            });
            
       });
       
       $('body').on("change",".user_type_staff",function(){
           var id= $(this).attr('data-id');
           var val = $(this).val();
           
           $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "staff-ajaxAction",
                data: {'action': 'changeusertypestaff', 'id': id,'val':val},
                success: function(data) {
                   handleAjaxResponse(data);
                }
            });
            
       });
       
       
       $('body').on("change",".admin_verify_status",function(){
            var id= $(this).attr('data-id');
           var val = $(this).val();
           $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "pending-ajaxAction",
                data: {'action': 'changeadminverify', 'id': id,'val':val},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
           
       });
       
       $('body').on("change",".staff_verify_status",function(){
            var id= $(this).attr('data-id');
           var val = $(this).val();
           $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "staff-ajaxAction",
                data: {'action': 'changestaffverifypendingapproval', 'id': id,'val':val},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
           
       });
    }

    return {
        init: function () {
            list();
        },
        
    }
}();