var Validation = function () {

    var kpivalidation = function () {

        var form = $('#kpiupdateform');
        var rules = {
            roi: {
                maxlength: 3
            },
            coc: {
                maxlength: 3
            },
            pi: {
                maxlength: 11
            },
            amd: {
                maxlength: 3
            },
            fa: {
                maxlength: 12
            },
            ebitda: {
                maxlength: 3
            },
        };

        var messages = {
            roi: {
                maxlength: "Return of Investment must be 999 %"
            },
            coc: {
                maxlength: "Cost of capital must be 999 %"
            },
            pi: {
                maxlength: "Promotors Investment must be 1000 crore"
            },
            amd: {
                maxlength: "Assured minimum dividend must be 999 %"
            },
            fa: {
                maxlength: "Fixed assests must be 10000 crore"
            },
            ebitda: {
                maxlength: "Ebitda must be 999 %"
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
        var form = $('#kpiHelp');
        var rules = {
            support: {
                required: true,
            },
        };

        var messages = {
            support: {
                required: "Please enter your message",
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        var form = $('#videoUpload');
        var rules = {
            upload_video: {
                required: true,
            },
        };

        var messages = {
            upload_video: {
                required: "Please choose your video",
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    return {
        init: function () {
            kpivalidation();
        },
    }
}();