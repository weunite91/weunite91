var Details = function () {
    var details = function () {
        var form = $('#details');
        var rules = {
            infor: {required: true,maxlength:40},
            addressline1: {required: true},
            addressline2: {required: true},
            mobileno: {required: true},
            email: {required: true,email:true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    return {
        init: function () {
            details();
        }
    }
}();