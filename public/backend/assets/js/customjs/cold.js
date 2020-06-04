var Cold = function() {

    var allUserList = function() {
        var dataArr = {};
        var columnWidth = {};

        var arrList = {
            'tableID': '#all-cold-datatable',
            'ajaxURL': baseurl + "admin-cold-user-ajaxAction",
            'ajaxAction': 'get-alluser-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'ASC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on("click", ".paginate_button ", function() {
            $(".allusercheckbox").attr("data-type", "uncheck");
            $('.allusercheckbox').each(function() {
                this.checked = false;
            });
        });

        $('body').on("click", ".allusercheckbox", function() {
            var type = $(this).attr("data-type");
            if (type == "uncheck") {
                $(this).attr("data-type", "checked");
                $('.usercheckbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(this).attr("data-type", "uncheck");
                $('.usercheckbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('body').on("click", "#btnRemoveAllocate ", function() {
            var id = $(this).data("id");

            var ids = [];
            $.each($(".usercheckbox:checked"), function() {
                ids.push($(this).val());
            });

            if (ids.length < 1) {
                showToster('error', "Please select users", '');
            } else {
                var idarray = JSON.stringify(ids);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "admin-cold-user-ajaxAction",
                    data: { 'action': 'movecold', "id": id, 'idarray': idarray },
                    success: function(data) {
                        handleAjaxResponse(data);
                    }
                });
            }
        });
    }


    var colduserlist = function() {

        var dataArr = {};
        var columnWidth = {};

        var arrList = {
            'tableID': '#cold-user-datatable',
            'ajaxURL': baseurl + "admin-cold-user-ajaxAction",
            'ajaxAction': 'get-cold-user-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'ASC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on("click", ".paginate_button ", function() {
            $(".allusercheckbox").attr("data-type", "uncheck");
            $('.allusercheckbox').each(function() {
                this.checked = false;
            });
        });

        $('body').on("click", ".allusercheckbox", function() {
            var type = $(this).attr("data-type");
            if (type == "uncheck") {
                $(this).attr("data-type", "checked");
                $('.usercheckbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(this).attr("data-type", "uncheck");
                $('.usercheckbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('body').on("click", "#btnRemoveAllocate ", function() {
            var id = $(this).data("id");

            var ids = [];
            $.each($(".usercheckbox:checked"), function() {
                ids.push($(this).val());
            });

            if (ids.length < 1) {
                showToster('error', "Please select users", '');
            } else {
                var idarray = JSON.stringify(ids);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "admin-cold-user-ajaxAction",
                    data: { 'action': 'removecold', "id": id, 'idarray': idarray },
                    success: function(data) {
                        handleAjaxResponse(data);
                    }
                });
            }
        });
    }
    return {
        init: function() {
            allUserList();
        },
        colduser: function() {
            colduserlist();
        }
    }
}();