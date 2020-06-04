var User = function () {
    
    var allverifyaddressUserList = function(){
       
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#verifyaddress-datatable',
             'ajaxURL': baseurl + "verify-address-ajaxAction",
             'ajaxAction': 'verifyaddress-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 4,
             'defaultSortOrder': 'desc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
    }
    

    

    return {
        init: function () {
            allverifyaddressUserList();
        },
       
       
    }
}();

$('body').on("change",".verify_status_type",function(){
    var id= $(this).attr('data-id');
    var val = $(this).val();
    
    $.ajax({
         type: "POST",
         headers: {
             'X-CSRF-TOKEN': $('input[name="_token"]').val(),
         },
         url: baseurl + "user-ajaxAction",
         data: {'action': 'changeverifyaddressstatus', 'id': id,'val':val},
         success: function(data) {
            handleAjaxResponse(data);
         }
     });
     
});
