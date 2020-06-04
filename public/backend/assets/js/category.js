var Category = function() {
    
     var list = function() {
            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
                setTimeout(function() {
                    $('.yes-sure:visible').attr('data-id', id);
                }, 500);
            })

            $('body').on('click', '.yes-sure', function() {
                var id = $(this).attr('data-id');
                var data = {id: id, _token: $('#_token').val()};
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "category-ajax-action",
                    data: {'action': 'deleteCategory', 'data': data},
                    success: function(data) {
                        handleAjaxResponse(data);
                    }
                });
            });
     }
     var addCategory = function() {
            var form = $('#addform');
            var rules = {
                categoryname: {required: true, minlength: 2},
            };
            handleFormValidate(form, rules, function(form) {
                handleAjaxFormSubmit(form,true);
            });
     }
     var editCategory = function() {
            var form = $('#editform');
            var rules = {
                categoryname: {required: true, minlength: 2},
            };
            handleFormValidate(form, rules, function(form) {
                handleAjaxFormSubmit(form,true);
            });
     }
   
    return {
        init: function() {
            list();
        },
        add: function() {
            addCategory();
        },
        edit: function() {
            editCategory();
        }
    }
}();