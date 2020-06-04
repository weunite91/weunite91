var Pending = function () {
    
    var allUserList = function(){
       
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#Pending-datatable',
             'ajaxURL': baseurl + "pending-ajaxAction",
             'ajaxAction': 'get-pendinguser-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 5,
             'defaultSortOrder': 'desc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
    }
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

    var revokeOffers = function(){
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
    }

    return {
        init: function () {
            allUserList();
        },
        
        fundraiser: function () {
            allUserList();
        },
        
        investor: function () {
            allUserList();
        },
        
        partner: function () {
            allUserList();
        },
        
        init: function () {
            allUserList();
        },
        addnote: function () {
            addusernote();
        },
        revoke: function () {
            revokeOffers();
        },
    }
}();