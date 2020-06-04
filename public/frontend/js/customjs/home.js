var Home = function () {

    var add_favrite = function (usertype) {

        $('body').on('click', '#remove_favourite', function () {

            var pitchid = $(this).attr("data-id");
            var userid = $(this).attr("data-userid");
            var data = {pitchid: pitchid, userid: userid, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "home-ajaxAction",
                data: {'action': 'removefavourite', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });

        $('body').on('click', '#add_favourite', function (evt) {
            var pitchid = $(this).attr("data-id");
            var userid = $(this).attr("data-userid");
            var data = {pitchid: pitchid, userid: userid, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "home-ajaxAction",
                data: {'action': 'addfavourite', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });

        var form = $('#offered');
        var rules = {
            offered_investment: {
                required: true
            },
        };
        var messages = {
            offered_investment: {
                required: "Please Enter Amount"
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            if (usertype == 2) {//2 for INvestor check controller
                handleAjaxResponse(form, true);
            } else if (usertype == 1 || usertype == 22) {//1 for fund riser check controller
                handleAjaxFormSubmit(form, true);
            }
        });
    }

    var pay_now = function () {
        var form = $('#paynow');
        var rules = {
            terms: {
                required: true
            },
            refund: {
                required: true
            },
        };
        var messages = {
            terms: {
                required: "Please agree with T&C"
            },
            refund: {
                required: "Please agree with Refund policies"
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            var end = new Date().getTime();
              var time = end - start;
               conslole.log('Execution time: ' + time);
            $('#paynow').submit();
           
        });
    }

    var favourite_pitch = function () {
        $('body').on("click", ".removefavorite", function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "home-ajaxAction",
                data: {'action': 'removefavorite', 'id': id},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var Offer = function (usertype, pageno, pagecount, totalitem, perpageitem) {

        $(function () {
            $('#pagination').pagination({
                items: totalitem,
                itemsOnPage: perpageitem,
                cssStyle: 'dark-theme'
            });
            $('#pagination').pagination('selectPage', pageno);
            // $(selector).pagination('updateItemsOnPage', 3);
        });

        $('body').on('click', '.page-link', function () {
            var page = $(this).data('id');
            window.location.href = page;
            // alert(page);
        });


        var form = $('#offered');
        var rules = {
            offered_investment: {
                required: true
            },
        };
        var messages = {
            offered_investment: {
                required: "Please Enter Amount"
            },

        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            if (usertype == 2) {//2 for INvestor check controller
                handleAjaxResponse(form, true);
            } else if (usertype == 1 || usertype == 22) {//1 for fund riser check controller
                handleAjaxFormSubmit(form, true);
            }
        });
    }

    var homejs = function () {

        var form = $('#gladform');
        var rules = {
            glad_fullname: {
                required: true,
                minlength: 3
            },
            glad_mobilenumber: {
                required: true,
                minlength: 8,
                maxlength: 12
            },
            glad_supportemail: {
                required: true,
                email: true,
            },
            glad_querymsg: {
                required: true,
                maxlength: 240
            },
        };
        var messages = {
            glad_fullname: {
                required: "Please enter your first name",
                minlength: "Your firstname must be at least 3 characters long"
            },
            glad_mobilenumber: {
                required: "Please enter your mobile number",
                minlength: "Your mobile number must be at least 8 to 12 characters long",
                maxlength: "Your mobile number must be at least 8 to 12 characters long",
            },
            glad_supportemail: {
                required: "Please enter your email ",
                email: "Please enter vaild email ",
            },
            glad_querymsg: {
                required: "Please enter your address ",
                maxlength: "Your qurey must be at least 3 characters long"
            },

        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });


        var form = $('#supportform');
        var rules = {
            fullname: {
                required: true,
                minlength: 3
            },
            mobilenumber: {
                required: true,
                minlength: 8,
                maxlength: 12
            },
            supportemail: {
                required: true,
                email: true,
            },
            querymsg: {
                required: true,
                maxlength: 240
            },
            qureytype: {
                required: true,
            },
        };
        var messages = {
            fullname: {
                required: "Please enter your first name",
                minlength: "Your firstname must be at least 3 characters long"
            },
            mobilenumber: {
                required: "Please enter your mobile number",
                minlength: "Your mobile number must be at least 8 to 12 characters long",
                maxlength: "Your mobile number must be at least 8 to 12 characters long",
            },
            supportemail: {
                required: "Please enter your email ",
                email: "Please enter vaild email ",
            },
            querymsg: {
                required: "Please enter your qurey message ",
                maxlength: "Your qurey must be at least 3 characters long"
            },

        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }

    return {
        init: function (usertype) {

            add_favrite(usertype);
        },
        offered: function () {
            pay_now();
        },
        favouritepitch: function () {
            favourite_pitch();
        },
        offer_submit: function (usertype, pageno, pagecount, totalitem, perpageitem) {
            Offer(usertype, pageno, pagecount, totalitem, perpageitem);
        },
        homepage: function () {
            homejs();
        },
    }
}();

function favouritesubmit(id)
{
    var offeredvalue=parseInt($('#offered_investment_'+id).val());
    var minimumvalue=parseInt($('#min_investment_'+id).val());
    if (offeredvalue<minimumvalue)
    {
        $('#fav_error_'+id).show();
        return false;
    }
    
}

