var Activeuserlist = function () {

    var activeUserList = function () {

        var dataArr = {};
        var columnWidth = {};
        var arrList = {
            'tableID': '#active-user-allocattion-cso-datatable',
            'ajaxURL': baseurl + "cso-active-user-allocation-list-ajaxAction",
            'ajaxAction': 'get-active-user-datatable',
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
                url: baseurl + "cso-active-user-allocation-list-ajaxAction",
                data: {'action': 'changestaffverify', 'id': id,'val':val},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

       });
    }

    var inactiveUserList = function () {

        var dataArr = {};
        var columnWidth = {};
        var arrList = {
            'tableID': '#inactive-user-allocattion-cso-datatable',
            'ajaxURL': baseurl + "cso-inactive-user-allocation-list-ajaxAction",
            'ajaxAction': 'get-inactive-user-datatable',
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
                url: baseurl + "cso-active-user-allocation-list-ajaxAction",
                data: {'action': 'changestaffverify', 'id': id,'val':val},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

       });
    }

    return {
        active: function () {
            activeUserList();
        },
        inactive: function () {
            inactiveUserList();
        },
    }
}();
