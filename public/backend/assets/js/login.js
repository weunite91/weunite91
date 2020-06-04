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
        var form = $('#loginform');
        var rules = {
            email: {required: true, email: true},
                password: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
             handleAjaxFormSubmit(form);
        });
    }
    return {
        init: function () {
            register();
        },
        add: function(){
            login();
        }
    }
}();