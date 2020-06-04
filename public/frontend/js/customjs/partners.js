var Partner = function () {

	var partnerDetails = function(){
		$('body').on('click', '.deleteprofile', function(evt) {
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
                url: baseurl + "partner-ajaxAction",
                data: {'action': 'deleteprofile', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });

		$('body').on("change","#country",function(){
                
                var val = $(this).val();
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "partner-ajaxAction",
                    data: {'action': 'changecountry','id':val},
                    success: function(data) {
                        var  output = JSON.parse(data);
                        var temp_html = '';
                        var html ='<option value=""> State *</option>';
                        for(var i = 0; i < output.length ; i++){
                            temp_html = '<option value="'+output[i].id+'">'+ output[i].name +'</option>';
                            html = html + temp_html;
                        }       
                        $('.state').html(html);
                    }
                });
            });
            
             $('body').on("change","#state",function(){
                
                var val = $(this).val();
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "partner-ajaxAction",
                    data: {'action': 'changestate','id':val},
                    success: function(data) {
                        var  output = JSON.parse(data);
                        if(output.length >0){
                          $('.city').attr('name', 'city'); 
                        }else{
                          $(".city").removeAttr("name"); 
                        }
                        var temp_html = '';
                        var html ='<option value=""> City *</option>';
                        for(var i = 0; i < output.length ; i++){
                            temp_html = '<option value="'+output[i].id+'">'+ output[i].name +'</option>';
                            html = html + temp_html;
                        }       
                        $('.city').html(html);
                    }
                });
            });
		var form = $('#partnerdetails');
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
                    maxlength : 250,
              	},
              	pincode: {
                    required: true,
                    number:true
              	},
              	mnumber: {
                    required: true,
                    minlength : 8,
                    maxlength : 12,
                    number:true
              	},
              	altnumber: {
                    minlength : 8,
                    maxlength : 12,
                    number:true
              	},
               	country: {
                    required:true
              	},
				state: {
                    required:true
              	},
               	city: {
                    required:true
              	},
              	introduction: {
                  required: true,
                  maxlength: 300
                },
                companyintro: {
                    required: true,
                    maxlength: 2500
                  },
              	password : {
              		minlength : 6,
                    maxlength:10
              	},
              	cpassword : {
              		minlength : 6,
                    maxlength:10,
                    equalTo : "#password"
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
                    email:"Please enter a valid email address",
            	},
              	password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
              	},
              	address: {
                     required:  "Please enter your Address",
                     maxlength:  "Please enter your Address within 250 characters",
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
                    required:"Please write your Company Introduction",
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

        handleFormValidateWithMsg(form, rules, messages, function (form) {
            handleAjaxFormSubmit(form, true);
        });
	}
	return {
        init: function () {
            partnerDetails();
        },
        
    }
}();