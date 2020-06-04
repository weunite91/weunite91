       
        var form = $('#gladform');
        var rules = {
            firstname: {
                required: true,
                minlength: 3
            },
            mobilenumber: {
                required: true,
                minlength: 8,
                maxlength: 12
            },
            email: {
                required: true,
                email: true,
            },
            address: {
                required: true,
                maxlength: 240
            },
        };
        var messages = {
            firstname: {
                required: "Please enter your first name",
                minlength: "Your firstname must be at least 3 characters long"
            },
            mobilenumber: {
                required: "Please enter your mobile number",
                minlength: "Your mobile number must be at least 8 to 12 characters long",
                maxlength: "Your mobile number must be at least 8 to 12 characters long",
            },
            email: {
                required: "Please enter your email ",
                email: "Please enter vaild email ",
            },
            address: {
                required: "Please enter your address ",
                maxlength: "Your qurey must be at least 3 characters long"
            },

        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxResponse(form, true);
        });