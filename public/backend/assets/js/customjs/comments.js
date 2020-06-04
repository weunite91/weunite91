var Comments = function() {

    var addnote = function() {
        var form = $('#comments');
        var rules = {
            message: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });


    }
   return {
       init: function() {
        addnote();
       },
   }
}();
