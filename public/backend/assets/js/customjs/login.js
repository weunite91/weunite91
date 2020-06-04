var Login = function () {
    var register = function () {
       
        var form = $('#registerform');
        var rules = {
            fname: {required: true, minlength: 2},
            lname: {required: true},
            email: {required: true, email: true},
            mobile: {required: true, maxlength: 10, minlength: 10},
            password: {required: true, maxlength: 10},
            confirmpassword: {required: true, equalTo: "#password"},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
        
        $('#loginform').validate({
            rules: {
                email: {required: true, email: true},
                password: {required: true},
            },
            messages: {
                email: {required: "Please Enter your Email"},  
                password: {required: "Please Enter your Password"}
                },
            submitHandler: function (form) {
                form.submit();
            }
        });
    }
    var login = function(){
        
       $('#loginform').validate({
            rules: {
                email: {required: true, email: true},
                password: {required: true},
            },
            messages: {
                email: {required: "Please Enter your Email"},  
                password: {required: "Please Enter your Password"}
                },
            submitHandler: function (form) {
                console.log(form);
                exit;
//                handleAjaxFormSubmit(form);
            }
        });
    }
    var f_password = function(){
        
       $('#f_password').validate({
            rules: {
                email: {required: true, email: true},
                password: {required: true},
            },
            messages: {
                email: {required: "Please Enter your Email"},  
                password: {required: "Please Enter your Password"}
                },
            submitHandler: function (form) {
                handleAjaxFormSubmit(form);
            }
        });
    }
    var resetpassword = function(){
        
       $('#adminresetpassword').validate({
            rules: {
                password: {required: true},
                cpassword: {required: true,equalTo: "#password"},
            },
            messages: {
                password: {required: "Please Enter your Email"},  
                cpassword: {
                    required: "Please Enter your New confirm password",
                    equalTo : "New confirm password not match with new password"
                }
                },
            submitHandler: function (form) {
                handleAjaxFormSubmit(form);
            }
        });
    }
    return {
        init: function () {
            login();
        },
        fpassword: function () {
            f_password();
        },
        adminresetpassword: function () {
            resetpassword();
        },
        add: function(){
            register();
        }
    }
}();