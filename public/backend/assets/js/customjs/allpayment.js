var Allpayment = function(){
    var revokelist = function(){
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#allpayment-datatable',
             'ajaxURL': baseurl + "allpayment-ajaxAction",
             'ajaxAction': 'get-allpayment-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 1,
             'defaultSortOrder': 'asc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);

         $('body').on("change",".approve",function(){

           var id= $(this).attr('data-id');
           var val = $(this).val();
           
           $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "revoke-ajaxAction",
                data: {'action': 'revokestatus', 'id': id,'val':val},
                success: function(data) {
                   handleAjaxResponse(data);
                }
            });
            
        });
    };

    return {
        init: function() {
            revokelist();
        },
        
    }
}();