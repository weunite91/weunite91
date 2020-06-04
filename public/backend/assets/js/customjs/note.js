var Note = function () {

    var list = function () {
        var form = $('#comments');
        var rules = {
            message: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });

        $('body').on("click",".deleteuser",function(){
            var id= $(this).attr('data-id');
            setTimeout(function () {
                 $('.yes-sure:visible').attr('data-id', id);
             }, 500);

        });

        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');

            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "my-note-ajaxAction",
                data: {'action': 'deletenote', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
    }
    return{
        init: function () {
            list();
        }
    }
}();
