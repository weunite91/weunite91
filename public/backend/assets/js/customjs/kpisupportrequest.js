var KPISupport = function() {

    var allRequestList = function() {

        var dataArr = {};
        var columnWidth = {};

        var arrList = {
            'tableID': '#request-datatable',
            'ajaxURL': baseurl + "kpisupport-ajaxAction",
            'ajaxAction': 'get-kpisupport-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn': 4,
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);



        $('body').on("click", ".deleterequest", function() {
            var id = $(this).attr('data-id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);

        });


        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');

            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "kpisupport-ajaxAction",
                data: { 'action': 'deleterequest', 'data': data },
                success: function(data) {
                    handleAjaxResponse(data);

                }
            });
        });

    }
    return {
        init: function() {
            allRequestList();
        },

    }
}();