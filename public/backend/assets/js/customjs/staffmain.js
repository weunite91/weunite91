var Staffmain = function () {
    
    var allUserList = function(){
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#pending-datatable',
             'ajaxURL': baseurl + "staff-ajaxAction",
             'ajaxAction': 'get-pending-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 0,
             'defaultSortOrder': 'desc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
    }

    var pendingApproval = function(){
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#pendingApproval-datatable',
             'ajaxURL': baseurl + "staff-ajaxAction",
             'ajaxAction': 'get-pendingapproval-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 0,
             'defaultSortOrder': 'asc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
    }
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
            url: baseurl + "staff-ajaxAction",
            data: {'action': 'deleteUser', 'data': data},
            success: function (data) {
                handleAjaxResponse(data);

            }
        });
    });

    var addusernote = function(){
       var form = $('#addusernotform');
        var rules = {
            usertype: {required: true},
            profile_code: {required: true},
            firstname: {required: true,minlength: 3},
            lastname: {required: true,minlength: 3},
            usernote: {required: true},
        };
        
        var messages = {
            firstname: {
               required: "Please enter Firstname",
               minlength:"At least 3 characters long"
             },
             lastname: {
               required: "Please enter Lastname",
               minlength:"At least 3 characters long",
             },
             usertype: {
                 required: "Please enter User Type"
             },
             profile_code: {
               required: "Please enter your Number",
             },
             usernote: {
               required: "Please enter your Note",
             },
        }
        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        }); 
    }

    return {
        init: function () {
            allUserList();
        },
        pending: function(){
            pendingApproval();
        },
        addnote: function () {
            addusernote();
        },
    }
}();