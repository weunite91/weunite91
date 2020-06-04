var Userallocation = function() {

    var list = function() {
        var dataArr = {};
        var columnWidth = {};

        var arrList = {
            'tableID': '#user-allocattion-datatable',
            'ajaxURL': baseurl + "user-allocattion-ajaxAction",
            'ajaxAction': 'get-user-allocattion-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on("click", ".paginate_button ", function() {
            $(".allusercheckbox").attr("data-type", "uncheck");
            $('.allusercheckbox').each(function() {
                this.checked = false;
            });
        });
        $('body').on("click", "#btnAllocate ", function() {

            var selectMember = $("#selectMember").val();
            if (selectMember) {
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
                        url: baseurl + "user-allocattion-ajaxAction",
                        data: { 'action': 'allocation', 'selectMember': selectMember, 'idarray': idarray },
                        success: function(data) {
                            handleAjaxResponse(data);
                        }
                    });
                }
            } else {
                showToster('error', "Please select staff", '');
            }

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
    }

    return {
        init: function() {
            list();
        },


    }
}();