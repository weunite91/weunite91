var Staff = function () {

    var list = function () {
        
         $('body').on("click", ".deletestaff", function () {
            var id = $(this).attr("data-id");
           
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
                url: baseurl + "staff-admin-ajaxAction",
                data: {'action': 'deleteStaff', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#staffloist-datatable',
             'ajaxURL': baseurl + "staff-admin-ajaxAction",
             'ajaxAction': 'get-staff-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 1,
             'defaultSortOrder': 'asc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
    }
    var addstaff = function () {
        var form = $('#addform');
        var rules = {
            firstname: {required: true,minlength:3},
            lastname: {required: true,minlength:3},
            email: {required: true,email:true},
            phonenumber: {digits:true,minlength:8,maxlength:12},
            password: {required: true,minlength:6,maxlength:10},
            cpassword: {required: true,minlength:6,maxlength:10,equalTo:"#password"},
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
             email: {
                 required: "Please enter email address",
                 email : "Please enter vaild email"
             },
             phonenumber: {
//               required: "Please enter your Number",
               digits : "Please enter digits",
               minlength: "At least 8 numbers long",
               maxlength: "At most 12 numbers long",
             },
             password: {
               required: "Please enter Password",
               minlength: "At least 6 characters long",
               maxlength: "At most 10 characters"
             },
             cpassword: {
               required: "Please enter Confirm Password",
               minlength: "At least 6 characters long",
               maxlength: "At most 10 characters",
               equalTo: "Conform password not matching with password"
             }
        }
         handleFormValidateWithMsg(form, rules, messages, function (form) {
                handleAjaxFormSubmit(form, true);
            }); 
            
    }
    var editstaff = function () {
        
         var form = $('#editform');
        var rules = {
            firstname: {required: true,minlength:3},
            lastname: {required: true,minlength:3},
            email: {required: true,email:true},
            phonenumber: {digits:true,minlength:8,maxlength:12},
            confirmpassword: {equalTo:"#password"},
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
             email: {
                 required: "Please enter email address",
                 email : "Please enter vaild email"
             },
             phonenumber: {
//               required: "Please enter your Number",
               digits : "Please enter digits",
               minlength: "At least 8 numbers long",
               maxlength: "At most 12 numbers long",
             },
             confirmpassword: {
               equalTo: "Conform password not matching with password"
             }
             
        }
         handleFormValidateWithMsg(form, rules, messages, function (form) {
                handleAjaxFormSubmit(form, true);
            }); 
    }
    return{
        init: function () {
            list();
        },
        add: function () {
            addstaff();
        },
        edit: function () {
            editstaff();
        },
    }
}();