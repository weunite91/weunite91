var Staffuserdetails = function() {

    var edituserdetails = function() {
        $('body').on("click", ".delete_img", function() {
            var imageid = $(this).attr('image-id');
            var product_image = $(this).attr('data-product_image');

            setTimeout(function() {
                $('.yes-sure:visible').attr('data-imageid', imageid);
                $('.yes-sure:visible').attr('data-product_image', product_image);
            }, 500);

        });


        $('body').on('click', '.yes-sure', function() {
            var imageid = $(this).attr('data-imageid');
            var product_image = $(this).attr('data-product_image');

            var data = { product_image: product_image, imageid: imageid, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "staff-ajaxAction",
                data: { 'action': 'deleteImageEditFr', 'data': data },
                success: function(data) {
                    $("#img_id" + imageid).remove();
                    $("#deleteModel").modal("hide");
                }
            });
        });

        $('body').on("click", ".delete_video", function() {
            var id = $(this).attr('data-id');
            var video = $(this).attr('data-video');

            setTimeout(function() {
                $('.yes-sure-deleteVideoModel:visible').attr('data-id', id);
                $('.yes-sure-deleteVideoModel:visible').attr('data-video', video);
            }, 500);

        });


        $('body').on('click', '.yes-sure-deleteVideoModel', function() {
            var id = $(this).attr('data-id');
            var video = $(this).attr('data-video');
            var data = { id: id, video: video, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "staff-ajaxAction",
                data: { 'action': 'deleteVideoEditFr', 'data': data },
                success: function(data) {
                    $("#videodiv").remove();
                    $("#deleteVideoModel").modal("hide");
                }
            });
        });

        var form = $('#editfundriserdetail-form');
        var rules = {
            firstname: {
                required: true,
                minlength: 3,

            },
            lastname: {
                required: true,
            },
            designation: {
                required: true

            },
            email: {
                required: true,
                email: true,

            },

            address: {
                required: true,
                maxlength: 250,
            },
            pincode: {
                required: true,
                number: true
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
            industry: {
                required: true
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
            firstname: {
                required: "Please enter your Firstname",
                minlength: "Your firstname must be at least 3 characters long",

            },
            lastname: {
                required: "Please enter your Lastname",

            },
            designation: {
                required: "Please select your Designation",
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: {
                required: "Please enter a valid email address",

            },

            address: {
                required: "Please enter your Address",
                maxlength: "Please enter your Address within 250 characters",
            },
            pincode: {
                required: "Please enter your Pincode",
                number: "Please enter pincode in digits"
            },
            mnumber: {
                required: "Please enter your phone number",
                number: "Please enter mobile number in digits",
                minlength: "Mobile Number must be at least 8 characters long",
                maxlength: "Mobile Number must be at least 12 characters long"
            },
            altnumber: {
                number: "Please enter alternative mobile number in digits",
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
            industry: {
                required: "Please select your Industry",
            },
            password: {
                required: "Please enter Password",
                minlength: "Your password must be at least 6 characters long",
                maxlength: "Your password must be 10 characters"
            },
            cpassword: {
                required: "Please enter Confirm Password",
                minlength: "Your password must be at least 6 characters long",
                maxlength: "Your password must be 10 characters",
                equalTo: "Password not matching"
            }
        };

        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });

        var form = $('#editFRcompanydetails-form');
        var rules = {

            min_investment: {
                required: true,
                minlength: 6,
                maxlength: 11,
                number: true,
            },
            max_investment: {
                required: true,
                minlength: 6,
                maxlength: 11,
                number: true,
                min: function() {
                    return parseInt($('#min_investment').val());
                }

            },
            min_accepted: {
                required: true,
                minlength: 5,
                maxlength: 11,
                number: true,
                max: function() {
                    return parseInt($('#max_investment').val());
                }
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
                maxlength: 300
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
                required: true,

            },

            position1: {
                required: true
            },


            roi: {
                maxlength: 3
            },
            coc: {
                maxlength: 3
            },
            pi: {
                maxlength: 11
            },
            amd: {
                maxlength: 3
            },
            fa: {
                maxlength: 12
            },
            ebitda: {
                maxlength: 3
            },
        };

        var messages = {
            min_investment: {
                required: "Minimum Investment required",
                minlength: "Minimum Investment amount not less than 1 lakh",
                maxlength: "Minimum Investment amount not greater than 1000 crore",
                number: "Please enter a valid number.",
            },
            max_investment: {
                required: "Maximum investment required",
                minlength: "Maximum Investment amount not less than 1 lakh",
                maxlength: "Maximum Investment amount not greater than 1000 crore",
                number: "Please enter a valid number.",
            },
            min_accepted: {
                required: "Minimum Accepted Investment required",
                minlength: "Minimum Accepted amount not less than 10000",
                maxlength: "Minimum Accepted amount not greater than 1000 crore",
                number: "Please enter a valid number.",
            },
            min_accepted: {
                required: "Minimum Accepted Investment required",
                minlength: "Minimum Accepted amount not less than 10000",
                maxlength: "Minimum Accepted amount not greater than 1000 crore",
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
                maxlength: "Introduction must be 300 words"
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
                required: "Member 1 is required",
                accept: "Enter vaild member 1 name"
            },
            member2: {
                accept: "Enter vaild member 2 name"
            },
            member3: {
                accept: "Enter vaild member 3 name"
            },
            member4: {
                accept: "Enter vaild member 4 name"
            },
            position1: {
                required: "Member 1's position is required"
            },

            roi: {
                maxlength: "Return of Investment must be 999 %"
            },
            coc: {
                maxlength: "Cost of capital must be 999 %"
            },
            pi: {
                maxlength: "Promotors Investment must be 1000 crore"
            },
            amd: {
                maxlength: "Assured minimum dividend must be 999 %"
            },
            fa: {
                maxlength: "Fixed assests must be 10000 crore"
            },
            ebitda: {
                maxlength: "Ebitda must be 999 %"
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });

        var form = $('#editFRpayment-form');
        var rules = {
            amount: {
                required: true,
            },
            planname: {
                required: true,
            },
        };

        var messages = {
            amount: {
                required: "Please select an amount.",
            },
            planname: {
                required: "Please select a plan.",
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });

        var form = $('#editinvestordetail-form');
        var rules = {
            "interestedcountry[]": {
                required: true,
            },
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
                min: function() {
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
            "interestedcountry[]": {
                required: "Please select Interested Countries.",
            },
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

        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });

        var form = $('#editfranchisedetails-form');
        var rules = {

            min_investment: {
                required: true,
                minlength: 6,
                maxlength: 11,
                number: true,
            },
            max_investment: {
                required: true,
                minlength: 6,
                maxlength: 11,
                number: true,
                min: function() {
                    return parseInt($('#min_investment').val());
                }

            },
            min_accepted: {
                required: true,
                minlength: 5,
                maxlength: 11,
                number: true,
                max: function() {
                    return parseInt($('#max_investment').val());
                }
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
                required: true,
                maxlength: 150
            },
            introduction: {
                required: true,
                maxlength: 300
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
                required: true,

            },

            position1: {
                required: true
            },
            terms: {
                required: true
            },

            roi: {
                maxlength: 3
            },
            coc: {
                maxlength: 3
            },
            pi: {
                maxlength: 11
            },
            amd: {
                maxlength: 3
            },
            fa: {
                maxlength: 12
            },
            ebitda: {
                maxlength: 3
            },
        };

        var messages = {
            min_investment: {
                required: "Minimum Investment required",
                minlength: "Minimum Investment amount not less than 1 lakh",
                maxlength: "Minimum Investment amount not greater than 1000 crore",
                number: "Please enter a valid number.",
            },
            max_investment: {
                required: "Maximum investment required",
                minlength: "Maximum Investment amount not less than 1 lakh",
                maxlength: "Maximum Investment amount not greater than 1000 crore",
                number: "Please enter a valid number.",
            },
            min_accepted: {
                required: "Minimum Accepted Investment required",
                minlength: "Minimum Accepted amount not less than 10000",
                maxlength: "Minimum Accepted amount not greater than 1000 crore",
                number: "Please enter a valid number.",
            },
            min_accepted: {
                required: "Minimum Accepted Investment required",
                minlength: "Minimum Accepted amount not less than 10000",
                maxlength: "Minimum Accepted amount not greater than 1000 crore",
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
                maxlength: "Introduction must be 300 words"
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
                required: "Member 1 is required",
                accept: "Enter vaild member 1 name"
            },
            member2: {
                accept: "Enter vaild member 2 name"
            },
            member3: {
                accept: "Enter vaild member 3 name"
            },
            member4: {
                accept: "Enter vaild member 4 name"
            },
            position1: {
                required: "Member 1's position is required"
            },
            terms: {
                required: "Please agree with T&C"
            },
            roi: {
                maxlength: "Return of Investment must be 999 %"
            },
            coc: {
                maxlength: "Cost of capital must be 999 %"
            },
            pi: {
                maxlength: "Promotors Investment must be 1000 crore"
            },
            amd: {
                maxlength: "Assured minimum dividend must be 999 %"
            },
            fa: {
                maxlength: "Fixed assests must be 10000 crore"
            },
            ebitda: {
                maxlength: "Ebitda must be 999 %"
            },
        };

        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });

        var form = $('#editpartnerdetails-form');
        var rules = {
            firstname: {
                required: true,
                minlength: 3,

            },
            lastname: {
                required: true,
            },
            designation: {
                required: true
            },
            email: {
                required: true,
                email: true,
            },
            address: {
                required: true,
                maxlength: 250,
            },
            pincode: {
                required: true,
                number: true
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
            introduction: {
                required: true,
                maxlength: 300
            },
            companyintro: {
                required: true,
                maxlength: 2500
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
            firstname: {
                required: "Please enter your Firstname",
                minlength: "Your firstname must be at least 3 characters long",
            },
            lastname: {
                required: "Please enter your Lastname",
            },
            designation: {
                required: "Please select your Designation",
            },
            email: {
                required: "Please enter a valid email address",
                email: "Please enter a valid email address",
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            address: {
                required: "Please enter your Address",
                maxlength: "Please enter your Address within 250 characters",
            },
            pincode: {
                required: "Please enter your Pincode",
                number: "Please enter pincode in digits"
            },
            mnumber: {
                required: "Please enter your phone number",
                number: "Please enter mobile number in digits",
                minlength: "Mobile Number must be at least 8 characters long",
                maxlength: "Mobile Number must be at least 12 characters long"
            },
            altnumber: {
                number: "Please enter alternative mobile number in digits",
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
            introduction: {
                required: "Please provide your Introduction",
                maxlength: "Introduction must be 300 words"
            },
            companyintro: {
                required: "Please write your Company Introduction",
                maxlength: "Your Company Introduction must be below 2500 characters"
            },
            password: {
                required: "Please enter Password",
                minlength: "Your password must be at least 6 characters long",
                maxlength: "Your password must be 10 characters"
            },
            cpassword: {
                required: "Please enter Confirm Password",
                minlength: "Your password must be at least 6 characters long",
                maxlength: "Your password must be 10 characters",
                equalTo: "Password not matching"
            }
        };

        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });

        $('body').on("change", "#country", function() {

            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "investoredit-staff-ajaxAction",
                data: { 'action': 'changecountry', 'id': val },
                success: function(data) {
                    var output = JSON.parse(data);
                    var temp_html = '';
                    var html = '<option value=""> State *</option>';
                    for (var i = 0; i < output.length; i++) {
                        temp_html = '<option value="' + output[i].id + '">' + output[i].name + '</option>';
                        html = html + temp_html;
                    }
                    $('#state').html(html);
                }
            });
        });

        $('body').on("change", "#state", function() {

            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "investoredit-staff-ajaxAction",
                data: { 'action': 'changestate', 'id': val },
                success: function(data) {
                    var output = JSON.parse(data);
                    var temp_html = '';
                    var html = '<option value=""> City *</option>';
                    for (var i = 0; i < output.length; i++) {
                        temp_html = '<option value="' + output[i].id + '">' + output[i].name + '</option>';
                        html = html + temp_html;
                    }
                    $('#city').html(html);
                }
            });
        });
    }

    return {
        init: function() {
            edituserdetails();
        },


    }
}();