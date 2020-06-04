var Usercsefunction = function () {

    var list = function(){
        $('body').on("change",".staff_verify_status",function(){
            var id= $(this).attr('data-id');
            var val = $(this).val();
            $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "cso-cse-allocation-ajaxAction",
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
