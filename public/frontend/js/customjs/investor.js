var Investor = function () {

    var investordashborad = function () {

        $('body').on("change", "#country", function () {

            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "investor-ajaxAction",
                data: {'action': 'changecountry', 'id': val},
                success: function (data) {
                    var output = JSON.parse(data);
                    var temp_html = '';
                    var html = '<option value=""> State *</option>';
                    for (var i = 0; i < output.length; i++) {
                        temp_html = '<option value="' + output[i].id + '">' + output[i].name + '</option>';
                        html = html + temp_html;
                    }
                    $('.state').html(html);
                }
            });
        });

        $('body').on("change", "#state", function () {

            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "investor-ajaxAction",
                data: {'action': 'changestate', 'id': val},
                success: function (data) {
                    var output = JSON.parse(data);
                    if (output.length > 0) {
                        $('.city').attr('name', 'city');
                    } else {
                        $(".city").removeAttr("name");
                    }
                    var temp_html = '';
                    var html = '<option value=""> City *</option>';
                    for (var i = 0; i < output.length; i++) {
                        temp_html = '<option value="' + output[i].id + '">' + output[i].name + '</option>';
                        html = html + temp_html;
                    }
                    $('.city').html(html);


                }
            });
        });
        $('body').on('click', '.revokbuton', function () {
            var revokeid = $(this).attr("data-id");
            setTimeout(function () {
                $('.revoke:visible').attr('data-id', revokeid);
            }, 500);
        });

        $('body').on('click', '.revoke', function () {
            var id = $(this).data('id');

            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "investor-ajaxAction",
                data: {'action': 'revoke_offer', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });

        // $('select').val([1]);
        $('.select_all').formSelect();
        $('select.select_all').siblings('ul').prepend('<li id=sm_select_all><span>Select All</span></li>');
        $('#sl_interest').find('input').first().attr('placeholder', 'Interest in Investing');
        $('#sl_interest').find('input').first().attr('name', 'interestin_val');
        $('li#sm_select_all').on('click', function () {
            var jq_elem = $(this),
                    jq_elem_span = jq_elem.find('span'),
                    select_all = jq_elem_span.text() == 'Select All',
                    set_text = select_all ? 'Select None' : 'Select All';
            jq_elem_span.text(set_text);
            jq_elem.siblings('li').filter(function () {
                return $(this).find('input').prop('checked') != select_all;
            }).click();
        });

        $('.select_all2').formSelect();
        $('select.select_all2').siblings('ul').prepend('<li id=sm_select_all2><span>Select All</span></li>');
        $('#sl_interest2').find('input').first().attr('placeholder', 'Interested in Industries');
        $('#sl_interest2').find('input').first().attr('name', 'industries_val');
        $('li#sm_select_all2').on('click', function () {
            var jq_elem = $(this),
                    jq_elem_span = jq_elem.find('span'),
                    select_all = jq_elem_span.text() == 'Select All',
                    set_text = select_all ? 'Select None' : 'Select All';
            jq_elem_span.text(set_text);
            jq_elem.siblings('li').filter(function () {
                return $(this).find('input').prop('checked') != select_all;
            }).click();
        });

        $('.select_all3').formSelect();
        $('select.select_all3').siblings('ul').prepend('<li id=sm_select_all3><span>Select All</span></li>');
        $('#sl_interest3').find('input').first().attr('placeholder', 'Interested Investing in Country');
        $('#sl_interest3').find('input').first().attr('name', 'interested_country');
        $('li#sm_select_all3').on('click', function () {
            var jq_elem = $(this),
                    jq_elem_span = jq_elem.find('span'),
                    select_all = jq_elem_span.text() == 'Select All',
                    set_text = select_all ? 'Select None' : 'Select All';
            jq_elem_span.text(set_text);
            jq_elem.siblings('li').filter(function () {
                return $(this).find('input').prop('checked') != select_all;
            }).click();
        });

        $('body').on('click', '.deleteprofile', function (evt) {
            var deleteprofileid = $(this).attr("data-id");
            setTimeout(function () {
                $('.yes-sure-deleteprofile:visible').attr('data-id', deleteprofileid);
            }, 500);
        });

        $('body').on('click', '.yes-sure-deleteprofile', function () {
            var id = $(this).attr('data-id');

            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "investor-ajaxAction",
                data: {'action': 'deleteprofile', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });


        var form = $('#myform');
        var rules = {
            interestin_val: {
                required: true,
            },
            industries_val: {
                required: true,
            },
            interested_country: {
                required: true,
            },
            firstname: {
                required: true,
                minlength: 3
            },
            lastname: {
                required: true,
            },
            investortype: {
                required: true

            },
            interestin: {
                required: true

            },
            mnumber: {
                required: true,
                minlength: 8,
                maxlength: 12,
                number: true
            },
            altnumber: {
                minlength: 8,
                maxlength: 12,
                number: true
            },
            country: {
                required: true
            },
            state: {
                required: true
            },
            city: {
                required: true
            },
            pincode: {
                required: true,
                number: true
            },
            address: {
                required: true,
                maxlength: 250,
            },
            email: {
                required: true,
                email: true,
            },

            designation: {
                required: true
            },
            industry: {
                required: true
            },
            introduction: {
                required: true,
                maxlength: 250
            },
            companyintro: {
                required: true,
                maxlength: 2500
            },
            min_investment: {
                number: true,
                required: true,
                minlength: 5,

            },
            max_investment: {
                number: true,
                required: true,
                minlength: 5,
                min: function ()
                {
                    return parseInt($('#min_investment').val());
                }
            },
            password: {
                minlength: 6,
                maxlength: 10
            },
            cpassword: {
                minlength: 6,
                maxlength: 10,
                equalTo: "#password"
            }
        };

        var messages = {
            interestin_val: {
                required: "Please select Interest In",
            },
            industries_val: {
                required: "Please select Industry",
            },
            interested_country: {
                required: "Please select Interested Countries",
            },
            firstname: {
                required: "Please enter your Firstname",
                minlength: "Your firstname must be at least 3 characters long"
            },
            lastname: {
                required: "Please enter your Lastname",
            },
            investortype: {
                required: "Please select Investor Type",
            },
            interestin: {
                required: "Please select Interest In",
            },
            mnumber: {
                required: 'Please enter your Mobile Number',
                number: "Please enter Numbers",
                minlength: "Mobile Number must be at least 8 characters long",
                maxlength: "Mobile Number must be at least 12 characters long"
            },
            altnumber: {
                number: "Please enter Numbers",
                minlength: "Mobile Number must be at least 8 characters long",
                maxlength: "Mobile Number must be at least 12 characters long"
            },
            Country: {
                required: "Please select your Country",
            },
            state: {
                required: "Please select your State",
            },
            city: {
                required: "Please select your City",
            },
            pincode: {
                required: "Please enter your Pincode",
                number: "Please enter Numbers"
            },
            address: {
                required: "Please enter your Address",
                maxlength: "Address must be below 250 characters",
            },
            email: {
                required: "Please enter a valid email address",
            },

            designation: {
                required: "Please select your Designation",
            },
            industry: {
                required: "Please select your Industry",
            },
            introduction: {
                required: "Please write your Introduction",
                maxlength: "Your Introduction must be below 250 characters"
            },
            companyintro: {
                required: "Please write your Company Introduction",
                maxlength: "Your Company Introduction must be below 2500 characters"
            },
            min_investment: {
                number: "Please enter only Numbers",
                required: "Minimum Investment offered required",
                minlength: "Minimum Investment not less then 10000",
            },
            max_investment: {
                number: "Please enter only Numbers",
                required: "Maximum investment offered required"
            },
            password: {
                required: "Please enter Password",
                minlength: "Your password must be at least 6 characters long",
                maxlength: "Your password must be below 10 characters"
            },
            cpassword: {
                required: "Please enter Confirm Password",
                minlength: "Your password must be at least 6 characters long",
                maxlength: "Your password must be below 10 characters",
                equalTo: "Password not matching"
            }
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });



        $('body').on("change", "#country", function () {

            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "investor-ajaxAction",
                data: {'action': 'changecountry', 'id': val},
                success: function (data) {
                    var output = JSON.parse(data);
                    var temp_html = '';
                    var html = '<option value=""> State *</option>';
                    for (var i = 0; i < output.length; i++) {
                        temp_html = '<option value="' + output[i].id + '">' + output[i].name + '</option>';
                        html = html + temp_html;
                    }
                    $('.state').html(html);
                }
            });
        });

        $('body').on("change", "#state", function () {

            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "investor-ajaxAction",
                data: {'action': 'changestate', 'id': val},
                success: function (data) {
                    var output = JSON.parse(data);
                    if (output.length > 0) {
                        $('.city').attr('name', 'city');
                    } else {
                        $(".city").removeAttr("name");
                    }
                    var temp_html = '';
                    var html = '<option value=""> City *</option>';
                    for (var i = 0; i < output.length; i++) {
                        temp_html = '<option value="' + output[i].id + '">' + output[i].name + '</option>';
                        html = html + temp_html;
                    }
                    $('.city').html(html);


                }
            });
        });
    }
    var frdetails = function () {
        var form = $('#frdetails');
        var rules = {

            min_investment: {
                required: true
            },
            max_investment: {
                required: true,

            },
            min_accepted: {
                required: true
            },
            usp1: {
                required: true,
                maxlength: 150
            },
            usp2: {
                required: true,
                maxlength: 150
            },
            usp3: {
                required: true,
                maxlength: 150
            },
            usp4: {
                maxlength: 150
            },
            introduction: {
                required: true,
                maxlength: 200
            },
            idea: {
                required: true,
                maxlength: 2200
            },
            team_overview: {
                required: true,
                maxlength: 700
            },
            member1: {
                required: true
            },
            position1: {
                required: true
            },
            terms: {
                required: true
            }
        };

        var messages = {
            min_investment: {
                required: "Minimum Investment required"
            },
            max_investment: {
                required: "Maximum investment required"
            },
            min_accepted: {
                required: "Minimum Accepted Investment required"
            },
            min_accepted: {
                required: "Minimum Accepted Investment required"
            },
            usp1: {
                required: "Please enter your USP1",
                maxlength: "USP1 must be 150 words"
            },
            usp2: {
                required: "Please enter your USP2",
                maxlength: "USP2 must be 150 words"
            },
            usp3: {
                required: "Please enter your USP3",
                maxlength: "USP1 must be 150 words"
            },
            usp4: {
                maxlength: "USP1 must be 150 words"
            },
            introduction: {
                required: "Please provide your Introduction",
                maxlength: "Introduction must be 200 words"
            },
            idea: {
                required: "Please provide your Idea",
                maxlength: "Introduction must be 2200 words"
            },
            team_overview: {
                required: "Please provide your Team overview",
                maxlength: "Team overview must be 700 words"
            },
            member1: {
                required: "Member 1 is required"
            },
            position1: {
                required: "Member 1's position is required"
            },
            terms: {
                required: "Please agree with T&C"
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }

    var paymentetails = function () {
        var form = $('#payuForm');
        var rules = {

            plan: {
                required: true,
            },
            firstname: {
                required: true,
            },
            lname: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                digits: true,
            },
            amount: {
                required: true,
                digits: true,
            },
        };

        var messages = {
            plan: {
                required: "Please select Plan",
            },
            firstname: {
                required: "Please enter first name",
            },
            lname: {
                required: "Please enter last name",
            },
            email: {
                required: "Please enter email",
                email: "Please enter vaild email",
            },
            phone: {
                required: "Please enter phone number",
                digits: "Please enter vaild phone number ",
            },
            amount: {
                required: "Don't change amount",
                digits: "Please enter vaild amount",
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    return {
        init: function () {
            investordashborad();
        },
        verify: function () {
            verifymail();
        },

        details: function () {
            frdetails();
        },
        payment: function () {
            paymentetails();
        },

    }
}();