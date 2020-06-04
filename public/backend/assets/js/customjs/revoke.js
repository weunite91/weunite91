var Revoke = function(){
    var revokelist = function(){
       var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#revoke-datatable',
             'ajaxURL': baseurl + "revoke-ajaxAction",
             'ajaxAction': 'get-revoke-datatable',
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

    var approvedrevokelist = function(){
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#approvedrevoke-datatable',
             'ajaxURL': baseurl + "revoke-ajaxAction",
             'ajaxAction': 'get-approvedrevoke-datatable',
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
                data: {'action': 'approverevokestatus', 'id': id,'val':val},
                success: function(data) {
                   handleAjaxResponse(data);
                }
            });
            
        });
    };

    var addRevokeNote = function (){

        var form = $('#addrevokenotform');
        var rules = {
            revokenote: {required: false},
        };
        
        var messages = {
           
             revokenote: {
               required: "Please enter your Note",
             },
        }
        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        }); 
    }
    return {
        init: function() {
            revokelist();
        },
        approved: function() {
            approvedrevokelist();
        },
        addnote: function() {
            addRevokeNote();
        },
    }
}();