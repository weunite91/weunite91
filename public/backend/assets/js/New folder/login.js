var Login = function () {
    
    var loginInit = function(){
        alert("Hello");
        var form = $('#login');
        var rules = {
            email: {required: true,email:true},
            password: {required: true},
        };

        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        }); 
    }

    return {
        init: function () {
            loginInit();
        }
    }
}();