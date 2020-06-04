var Fundraiser = function () {

    var FundraiserList = function(){

        var dataArr = {};
        var columnWidth = {};

        var arrList = {
            'tableID': '#fund-raiser-datatable',
            'ajaxURL': baseurl + "user-ajaxAction",
            'ajaxAction': 'get-fundraiser-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    return {
        init: function () {
            FundraiserList();
        },

    }
}();

$('body').on("change",".free_verify_status",function(){
    var id= $(this).attr('data-id');
    var val = $(this).val();

    $.ajax({
         type: "POST",
         headers: {
             'X-CSRF-TOKEN': $('input[name="_token"]').val(),
         },
         url: baseurl + "user-ajaxAction",
         data: {'action': 'freeaddressverify', 'id': id,'val':val},
         success: function(data) {
            handleAjaxResponse(data);
         }
     });

});
