var Product = function () {

    var list = function () {
        $('body').on('click', '.delete', function () {
            var id = $(this).data('id');
            setTimeout(function () {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "product-ajaxaction",
                data: {'action': 'deleteProduct', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
    }
    var addproduct = function () {

        var submitFrom = true;
        var customValid = true;
        var validateTrip = true;
        $('#addproductform').validate({
            rules: {
                category: {required: true},
                subcategory: {required: true},
                productcode: {required: true},
                productname: {required: true},
                price: {required: true},
                description: {required: true},
                quantity: {required: true}
            },
            invalidHandler: function (event, validator) {
                validateTrip = false;
                customValid = customerInfoValid();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.c-input, .form-control').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.c-input, .form-control').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                return false;
            },
            submitHandler: function (form) {
                customValid = customerInfoValid();
                if (submitFrom && customValid)
                {
                    var options = {
                        resetForm: false, // reset the form after successful submit
                        success: function (output) {
                            //   App.stopPageLoading();
                            handleAjaxResponse(output);
                        }
                    };
                    $(form).ajaxSubmit(options);
                }
            }
        });

        function customerInfoValid() {

            var customValid = true;

            $('.size, .quantity').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            return customValid;
        }
        ;

        $("body").on("change", ".category", function () {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "product-ajaxaction",
                data: {'action': 'changecategory', 'id': id},
                success: function (data) {
                    var output = JSON.parse(data);

                    var subcategoryhtml = '<option value="">Select sub category</option>';
                    for (var i = 0; i < output.length; i++) {
                        var temp_html = "";
                        temp_html = '<option value="' + output[i].id + '">' + output[i].subcategoryname + '</option>';
                        subcategoryhtml = subcategoryhtml + temp_html;
                    }

                    $(".selectsubcategory").html(subcategoryhtml);
//                        handleAjaxResponse(data);
                }
            });
        });


        $("body").on("change", ".subcategory", function () {
            $('#sizebutton').prop('disabled', false);
            var category = $('#category').val();
            var subcategory = $('#subcategory').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "product-ajaxaction",
                data: {'action': 'changesize', 'subcategory': subcategory, 'category': category},
                success: function (data) {
                    var output = JSON.parse(data);
                    var subcategoryhtml = '<option value="">Select size</option>';
                    for (var i = 0; i < output.length; i++) {
                        var temp_html = "";
                        temp_html = '<option value="' + output[i].id + '">' + output[i].size + '</option>';
                        subcategoryhtml = subcategoryhtml + temp_html;
                    }
                    $(".sizeselect").html(subcategoryhtml);
//                        handleAjaxResponse(data);
                }
            });
        });

        $('body').on("click", ".addimage", function () {
            var html = '<div class="form-group removediv">' +
                    '<div class="row">' +
                    '<div class="col-md-10 col-sm-10">' +
                    '<label for="simpleFormEmail">&nbsp;</label>' +
                    '<input type="file" class="form-control product" id="image" name="image[]">' +
                    '</div>' +
                    '<div class="col-md-2 col-sm-2">' +
                    '<label for="simpleFormEmail">&nbsp;</label>' +
                    '<button class="form-control btn btn-danger removeimage" data-dir="up" type="button"><span class="fa fa-minus"></span></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            $(".appendproduct").append(html);
        });
        
        $('body').on("click", ".removeimage", function () {
            $(this).closest('.removediv').remove();
        });

        $('body').on("click", ".addsizequantity", function () {
            var category = $('#category').val();
            var subcategory = $('#subcategory').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "product-ajaxaction",
                data: {'action': 'changesize', 'subcategory': subcategory, 'category': category},
                success: function (data) {
                    var output = JSON.parse(data);

                    var selectoptionhtml = '<option value="">Select Size</option>';
                    for (var i = 0; i < output.length; i++) {
                        var temp_html = "";
                        temp_html = '<option value="' + output[i].id + '">' + output[i].size + '</option>';
                        selectoptionhtml = selectoptionhtml + temp_html;
                    }
                    var html = '<div class="row removesizeQuantity">' +
                            '<div class="col-md-5 col-sm-5">' +
                            '<label for="simpleFormEmail">&nbsp;</label>' +
                            '<select class="form-control size" name="size[]" id="size">' + selectoptionhtml +
                            '</select>' +
                            '</div>' +
                            '<div class="col-md-5 col-sm-5">' +
                            '<label for="simpleFormEmail">&nbsp;</label>' +
                            '<input type="text" class="form-control quantity" id="quantity" name="quantity[]" placeholder="Enter Quantity">' +
                            '</div>' +
                            '<div class="col-md-2 col-sm-2">' +
                            '<label for="simpleFormEmail">&nbsp;</label>' +
                            '<button class="form-control btn btn-danger removesize" data-dir="up" type="button"><span class="fa fa-minus"></span></button>' +
                            '</div>' +
                            '</div>';
                    $(".appendsize").append(html);
                }
            });
        });
        $('body').on("click", ".removesize", function () {
            $(this).closest('.removesizeQuantity').remove();
        });

    }
    var editproduct = function () {
        var submitFrom = true;
        var customValid = true;
        var validateTrip = true;
        $('#editproductform').validate({
            rules: {
                category: {required: true},
                subcategory: {required: true},
                productcode: {required: true},
                productname: {required: true},
                price: {required: true},
                description: {required: true},
                quantity: {required: true}
            },
            invalidHandler: function (event, validator) {
                validateTrip = false;
                customValid = customerInfoValid();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.c-input, .form-control').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.c-input, .form-control').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                return false;
            },
            submitHandler: function (form) {
                customValid = customerInfoValid();
                if (submitFrom && customValid)
                {
                    var options = {
                        resetForm: false, // reset the form after successful submit
                        success: function (output) {
                            //   App.stopPageLoading();
                            handleAjaxResponse(output);
                        }
                    };
                    $(form).ajaxSubmit(options);
                }
            }
        });

        function customerInfoValid() {

            var customValid = true;

            $('.size, .quantity').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            return customValid;
        }
        ;

        $("body").on("change", ".category", function () {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "size-ajaxaction",
                data: {'action': 'changecategory', 'id': id},
                success: function (data) {
                    var output = JSON.parse(data);

                    var subcategoryhtml = '<option value="">Select sub category</option>';
                    for (var i = 0; i < output.length; i++) {
                        var temp_html = "";
                        temp_html = '<option value="' + output[i].id + '">' + output[i].subcategoryname + '</option>';
                        subcategoryhtml = subcategoryhtml + temp_html;
                    }

                    $(".selectsubcategory").html(subcategoryhtml);
//                        handleAjaxResponse(data);
                }
            });
        });

        $("body").on("change", ".subcategory", function () {
            var category = $('#category').val();
            var subcategory = $('#subcategory').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "product-ajaxaction",
                data: {'action': 'changesize', 'subcategory': subcategory, 'category': category},
                success: function (data) {
                    var output = JSON.parse(data);
                    var subcategoryhtml = '<option value="">Select size</option>';
                    for (var i = 0; i < output.length; i++) {
                        var temp_html = "";
                        temp_html = '<option value="' + output[i].id + '">' + output[i].size + '</option>';
                        subcategoryhtml = subcategoryhtml + temp_html;
                    }
                    $(".sizeselect").html(subcategoryhtml);
//                        handleAjaxResponse(data);
                }
            });
        });
        
        
        $('body').on("click", ".addsizequantity", function () {
            var category = $('#category').val();
            var subcategory = $('#subcategory').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "product-ajaxaction",
                data: {'action': 'changesize', 'subcategory': subcategory, 'category': category},
                success: function (data) {
                    var output = JSON.parse(data);
                    var selectoptionhtml = '<option value="">Select Size</option>';
                    for (var i = 0; i < output.length; i++) {
                        var temp_html = "";
                        temp_html = '<option value="' + output[i].id + '">' + output[i].size + '</option>';
                        selectoptionhtml = selectoptionhtml + temp_html;
                    }
                    var html = '<div class="row removesizeQuantity">' +
                            '<div class="col-md-5 col-sm-5">' +
                            '<label for="simpleFormEmail">&nbsp;</label>' +
                            '<select class="form-control size" name="size[]" id="size">' + selectoptionhtml +
                            '</select>' +
                            '</div>' +
                            '<div class="col-md-5 col-sm-5">' +
                            '<label for="simpleFormEmail">&nbsp;</label>' +
                            '<input type="text" class="form-control quantity" id="quantity" name="quantity[]" placeholder="Enter Quantity">' +
                            '</div>' +
                            '<div class="col-md-2 col-sm-2">' +
                            '<label for="simpleFormEmail">&nbsp;</label>' +
                            '<button class="form-control btn btn-danger removesize" data-dir="up" type="button"><span class="fa fa-minus"></span></button>' +
                            '</div>' +
                            '</div>';
                    $(".appendsize").append(html);
                }
            });
        });
        
        $('body').on("click", ".removesize", function () {
            $(this).closest('.removesizeQuantity').remove();
        });
        
        $('body').on("click", ".addimage", function () {
            var html = '<div class="col-md-10 col-sm-10">' +
                    '<label for="simpleFormEmail">&nbsp;</label>' +
                    '<input type="file" class="form-control product" id="image" name="image[]">' +
                    '</div>' +
                    '<div class="col-md-2 col-sm-2">' +
                    '<label for="simpleFormEmail">&nbsp;</label>' +
                    '<button class="form-control btn btn-danger removeimage" data-dir="up" type="button"><span class="fa fa-minus"></span></button>' +
                    '</div>' ;
            $(".appendimage").append(html);
        });
    }

    return{
        add: function () {
            addproduct();
        },
        edit: function () {
            editproduct();
        },
        init: function () {
            list();
        }
    }
}();