var Subcategory = function() {
    
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
                    url: baseurl + "subcategory-ajax-action",
                    data: {'action': 'deleteSubcategory', 'data': data},
                    success: function(data) {
                        handleAjaxResponse(data);
                    }
                });
            });
     }
     var addCategory = function() {
              
            var submitFrom = true;
            var customValid = true;
            var validateTrip = true;
            $('#addsubcategory').validate({
                rules: {
                    category: {required: true},
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

            $('.subcategoryname').each(function () {
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
        };
    
            
            $('body').on("click",".addcategory", function(){
                var html ='<div class="row removediv">'+
                            '<div class="col-md-10 col-sm-10">'+
                                '<label for="simpleFormEmail">&nbsp;</label>'+
                                '<input type="text" class="form-control subcategoryname"  id="subcategoryname" name="subcategoryname[]" placeholder="Enter subcategory name">'+
                            '</div>'+
                            '<div class="col-md-2 col-sm-2">'+
                                '<label for="simpleFormEmail">&nbsp;</label>'+
                                '<button class="form-control btn btn-danger removecategory" data-dir="up" type="button"><span class="fa fa-minus"></span></button>'+
                            '</div>'+
                        '</div>';
                $(".addsubcategory").append(html);
            });
            
            $('body').on("click",".removecategory", function(){
                $(this).closest('.removediv').remove();
            });
     }
     var editCategory = function() {
            var submitFrom = true;
            var customValid = true;
            var validateTrip = true;
            $('#editform').validate({
                rules: {
                    category: {required: true},
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

            $('.subcategoryname').each(function () {
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
        };
              $('body').on("click",".addcategory", function(){
                var html ='<div class="row removediv">'+
                            '<div class="col-md-10 col-sm-10">'+
                                '<label for="simpleFormEmail">&nbsp;</label>'+
                                '<input type="text" class="form-control subcategoryname"  id="subcategoryname" name="subcategoryname[]" placeholder="Enter subcategory name">'+
                            '</div>'+
                            '<div class="col-md-2 col-sm-2">'+
                                '<label for="simpleFormEmail">&nbsp;</label>'+
                                '<button class="form-control btn btn-danger removecategory" data-dir="up" type="button"><span class="fa fa-minus"></span></button>'+
                            '</div>'+
                        '</div>';
                $(".addsubcategory").append(html);
            });
            
            $('body').on("click",".removecategory", function(){
                $(this).closest('.removediv').remove();
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