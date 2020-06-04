var User = function () {

    var userlogin = function () {
       
        var form = $('#register');
        var rules = {
            firstname: {required: true, minlength: 3, accept: "[a-zA-Z]+"},
            lastname: {required: true, accept: "[a-zA-Z]+"},
            published: {required: true},
            email: {required: true, email: true},
            newpassword: {required: true, minlength: 6, maxlength: 12},
            confirmpassword: {required: true, minlength: 6, maxlength: 12, equalTo: "#newpassword"},
        };

        var messages = {
            firstname: {
                required: "Please enter Firstname",
                minlength: "At least 3 characters long",
                accept: "Please enter only characters in first name"
            },
            lastname: {
                required: "Please enter Lastname",
                accept: "Please enter only characters in last name"
            },
            published: {
                required: "Please select user type",
            },
            email: {
                required: "Please enter email address",
                email: "Please enter vaild email"
            },

            newpassword: {
                required: "Please enter Password",
                minlength: "At least 6 characters long",
                maxlength: "At most 10 characters"
            },
            confirmpassword: {
                required: "Please enter Confirm Password",
                minlength: "At least 6 characters long",
                maxlength: "At most 10 characters",
                equalTo: "Conform password not matching with password"
            }
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });


        $('#userlogin').validate({
            rules: {
                email: {required: true, email: true},
                password: {required: true},
            },
            messages: {
                email: {required: "Please Enter your Email"},
                password: {required: "Please Enter your Password"}
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                $('#loader').hide();
                $(".submitbtn:visible").removeAttr("disabled");
                $(".submitbtn:visible").val("Submit");
            },
            submitHandler: function (form) {
                $('#loader').show();
                
                $(".submitbtn:visible").attr("disabled","disabled");
                $(".submitbtn:visible").val("Please wait");
                form.submit();
            }
        });




    }


    var verifymail = function () {

        var form = $('#verifyaccount');
        var rules = {
            otp: {
                    required: true,
                    digits: true,
                    maxlength:6,
                    minlength:6,
                },
        };
        var messages = {
            otp: {
                required: "Please Enter your otp",
                digits: "Please enter only numerical value",
                maxlength: "OTP mixmum length is 6",
                minlength: "OTP minimum length is 6",
            }
        };
        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
        
        $('body').on('click','.resndotp',function(){
            var email = $(this).attr('data-email');
            $(this).attr("readonly","readonly");
            $(this).text("Resnding OTP....");
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "login-ajaxAction",
                data: {'action': 'resndotp', 'email': email},
                success: function (data) {
                    
                    handleAjaxResponse(data);
                }
            });
        });
    }
    var resetpassword = function () {

        var form = $('#forgotpassword');
        var rules = {
            email: {required: true, email: true},
        };
        var messages = {
            email: {required: "Please Enter your Email"}
        };
        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    var updatepassword = function () {

        var form = $('#updatepassword');
        var rules = {
            password: {required: true, minlength: 6, maxlength: 12},
            confirmpassword: {required: true, minlength: 6, maxlength: 12, equalTo: "#newpassword"},
        };
        var messages = {
            password: {
                required: "Please enter Password",
                minlength: "At least 6 characters long",
                maxlength: "At most 10 characters"
            },
            confirmpassword: {
                required: "Please enter Confirm Password",
                minlength: "At least 6 characters long",
                maxlength: "At most 10 characters",
                equalTo: "Conform password not matching with password"
            }
        };
        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }

    return {
        init: function () {
            userlogin();
        },
        verify: function () {
            verifymail();
        },
        forgotpassword: function () {
            resetpassword();
        },
        resetpassword: function () {
            updatepassword();
        },
    }
}();