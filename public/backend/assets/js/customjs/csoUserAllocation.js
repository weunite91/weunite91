var UserAllocation = function () {

    var list = function () {

        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#user-allocattion-cso-datatable',
             'ajaxURL': baseurl + "cso-user-allocation-ajaxAction",
             'ajaxAction': 'get-cso-user-allocation-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 5,
             'defaultSortOrder': 'desc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);

         $('body').on("change",".staff_verify_status",function(){
            var id= $(this).attr('data-id');
           var val = $(this).val();
           $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "cso-user-allocation-ajaxAction",
                data: {'action': 'changestaffverify', 'id': id,'val':val},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

       });

    }

    return{
        init: function () {
            list();
        },
    }
}();
