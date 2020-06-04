var Order = function () {

    var list = function () {

        $('body').on('click', '.YES', function () {

            var id = $(this).attr('order-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "order-ajaxaction",
                data: {'action': 'updatestatus', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        $('body').on('click', '.confirm', function () {

            var id = $(this).attr('order-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "order-ajaxaction",
                data: {'action': 'confirmstatus', 'data': data},
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