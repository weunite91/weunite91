var Deleterequest = function () {
    var list = function () {
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#delete-request-datatable',
             'ajaxURL': baseurl + "delete-request-ajaxAction",
             'ajaxAction': 'get-alluser-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 1,
             'defaultSortOrder': 'asc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
         
         
          $('body').on("click", ".apporverrequest", function () {
            var id = $(this).attr("data-id");
            var usertype = $(this).attr("data-usertype");
            setTimeout(function () {
                $('.yes-sure-apporverrequest:visible').attr('data-id', id).attr('data-usertype',usertype);
            }, 500);
        });

        $('body').on('click', '.yes-sure-apporverrequest', function () {
            var id = $(this).attr('data-id');
            var usertype = $(this).attr("data-usertype");
            var data = {id: id,usertype: usertype, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "delete-request-ajaxAction",
                data: {'action': 'apporverrequest', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
            $('body').on("click", ".declienrequest", function () {
                var id = $(this).attr("data-id");
                setTimeout(function () {
                    $('.yes-sure-declienrequest:visible').attr('data-id', id);
                }, 500);
            });

            $('body').on('click', '.yes-sure-declienrequest', function () {
                var id = $(this).attr('data-id');
                var data = {id: id, _token: $('#_token').val()};
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "delete-request-ajaxAction",
                    data: {'action': 'declienrequest', 'data': data},
                    success: function (data) {
                        handleAjaxResponse(data);
                    }
                });
            });
        
    }
    return {
        init: function () {
            list();
        }
    }
}();