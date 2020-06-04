var Crew = function () {

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
                url: baseurl + "crew-ajaxAction",
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
             'ajaxURL': baseurl + "crew-ajaxAction",
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

    var viewUserList = function(){
        var staffId = $("#staffId").val();
        var dataArr = {'staffId':staffId};
        var columnWidth = {};

         var arrList = {
             'tableID': '#user-allocattion-datatable',
             'ajaxURL': baseurl + "crew-ajaxAction",
             'ajaxAction': 'get-user-allocattion-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'noSortingApply' : [0],
             'defaultSortColumn': 5,
             'defaultSortOrder': 'desc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);

         $('body').on("click",".paginate_button ",function(){
            $(".allusercheckbox").attr("data-type","uncheck");
            $('.allusercheckbox').each(function(){
                this.checked = false;
            });
         });


         $('body').on("click","#btnChangeAllocate ",function(){
            var staffid = $(this).data("staffid");
            var selectMember= $("#selectMember").val();
            if(selectMember){
                var ids = [];
                $.each($(".usercheckbox:checked"), function(){
                    ids.push($(this).val());
                });

                if( ids.length < 1){
                    showToster('error',"Please select users" , '');
                }else{
                    var idarray = JSON.stringify(ids);

                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        },
                        url: baseurl + "crew-ajaxAction",
                        data: {'action': 'changeallocation','staffid':staffid , 'selectMember': selectMember ,'idarray':idarray},
                        success: function (data) {
                            handleAjaxResponse(data);
                        }
                    });
                }
            }else{
                showToster('error',"Please select staff" , '');
            }

         });


         $('body').on("click","#btnRemoveAllocate ",function(){
                var staffid = $(this).data("staffid");

                var ids = [];
                $.each($(".usercheckbox:checked"), function(){
                    ids.push($(this).val());
                });

                if( ids.length < 1){
                    showToster('error',"Please select users" , '');
                }else{
                    var idarray = JSON.stringify(ids);

                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        },
                        url: baseurl + "crew-ajaxAction",
                        data: {'action': 'removeAllocation',"staffid":staffid,'idarray':idarray},
                        success: function (data) {
                            handleAjaxResponse(data);
                        }
                    });
                }


         });

         $('body').on("click",".allusercheckbox",function(){
             var type = $(this).attr("data-type") ;
             if(type == "uncheck"){
                $(this).attr("data-type","checked");
                $('.usercheckbox').each(function(){
                    this.checked = true;
                });
             }else{
                $(this).attr("data-type","uncheck");
                $('.usercheckbox').each(function(){
                    this.checked = false;
                });
             }

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
        view: function () {
            viewUserList();
        },
    }
}();
