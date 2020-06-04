var Slider = function() {
    var sliderlist = function() {

        $('body').on('click', '.deleteslider', function() {

            // $('#deleteModel').modal('show');
            var id = $(this).data('id');
            var image = $(this).data('image');

            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
                $('.yes-sure:visible').attr('data-image', image);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var image = $(this).attr('data-image');

            var data = { image: image, id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "slider-ajaxAction",
                data: { 'action': 'deleteslider', 'data': data },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });


        var dataArr = {};
        var columnWidth = { "width": "10%", "targets": 0 };

        var arrList = {
            'tableID': '#slider-datatable',
            'ajaxURL': baseurl + "slider-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0, 1, 2],
            'noSortingApply': [0, 1, 2],
            'defaultSortColumn': 1,
            'defaultSortOrder': 'asc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }


    var addslider = function() {

        var form = $('#add_slider');
        var rules = {
            slider: { required: true },
        };
        var messages = {
            slider: {
                required: "Please add silder image",
            }
        }
        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    var email = function() {

        var form = $('#add_email_image');
        var rules = {
            add_email_image: { required: true },
        };
        var messages = {
            add_email_image: {
                required: "Please add email image image",
            }
        }
        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    return {
        init: function() {
            sliderlist();
        },
        add: function() {
            addslider();
        },
        emailImages: function() {
            email();
        },
    }
}();