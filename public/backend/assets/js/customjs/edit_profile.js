var Edit_Profile = function () {
    
    var validate = function(){
       
            var form = $('#admin_profile_form');
            var rules = {
                firstname: {required: true,minlength:3},
                lastname: {required: true},
                email: {required: true,email:true},
                contactno: {digits: true,minlength:10,maxlength:12},
                countrycode: {required: true},
            };
            
             var messages = {
                 firstname: {
                    required: "Please enter Firstname",
                    minlength:"At least 3 characters long"
                  },
                  lastname: {
                    required: "Please enter Lastname",
                  },
                  email: {
                      required: "Please enter email address",
                      email : "Please enter vaild email"
                  },
                  contactno: {
                    // required: "Please enter your Number",
                    digits : "Please enter digits",
                    minlength: "At least 10 numbers long",
                    maxlength: "At most 12 numbers long",
                  },
                  countrycode: {
                    required: "Please enter Country Code",
                  },
            };

            handleFormValidateWithMsg(form, rules, messages, function (form) {
                handleAjaxFormSubmit(form, true);
            }); 
       
    }
 
    var change_password = function(){
        var form = $('#change_password');
        var rules = {
                new_password: {required: true,minlength:3},
                confirm_new_password: {required: true,minlength:3,equalTo : "#newpassword"},
                
            };
            
             var messages = {
                 new_password: {
                    required: "Please enter New Password",
                    minlength:"At least 3 characters long"
                  },
                  confirm_new_password: {
                    required: "Please enter New Confirm Password",
                    minlength:"At least 3 characters long",
                    equalTo: "Password not matching"
                  },
                  
            };

            handleFormValidateWithMsg(form, rules, messages, function (form) {
                handleAjaxFormSubmit(form);
            }); 
    }

    return {
        init: function () {
            validate();
        },
        change: function () {
            change_password();
        },
        
    }
}();