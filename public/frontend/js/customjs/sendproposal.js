var Sendproposal = function () {
    
    var sendproposalform = function(){
            $('body').on("change",".message",function(){
                var value = $(this).val();
                $("#message_box").text();
               $("#message_box").text(value);
            });
            var form = $('#sendproposal');
            var rules = {
                  firstname: {
                    required: true,
                    minlength: 3
                  },
                  profilecode: {
                    required: true,
                  },
                  amount: {
                    required: true
                  },
                  about: {
                    required: true,
                    maxlength : 700,
                  },
                  cbu_checkbox: {
                    required: true,
                    
                  },
            };
            
              var messages = {
                  
                  
                  firstname: {
                    required: "Please enter your Firstname",
                    minlength: "Your firstname must be at least 3 characters long",
                  },
                  
                  profilecode: {
                    required: "Please enter your profile code",
                  },
                  
                  amount: {
                    required: "Please enter your invesment amount",
                  },
                  
                  about: {
                    required: "Please enter your message",
                    maxlength : "Your message must me less then 240 character",
                  },
                  cbu_checkbox: {
                    required: "Please Select Terms & Conditions"
                  },
              };

            handleFormValidateWithMsg(form, rules, messages, function (form) {
                handleAjaxFormSubmit(form, true);
            }); 
    }
    var frdetails = function(){
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
    
    var paymentetails = function(){
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
    var  payment = function(){
        var form = $('#contactbusiness');
            var rules = {
                
                pitchid: {
                    required: true,
                    digits: true,
                },
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                profilecode: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                phoneno: {
                    required: true,
                    digits: true,
                },
                ammount: {
                    required: true,
                    digits: true,
                },
            };
            
             var messages = {
                pitchid: {
                    required: "Please enter pitch id",
                    digits: "Please valid pitchid",
                },
                firstname: {
                    required: "Please enter first name",
                },
                lastname: {
                    required: "Please enter last name",
                },
                profilecode: {
                    required: "Please enter profile code",
                },
                email: {
                    required: "Please enter email",
                    email: "Please enter vaild email",
                },
                phoneno: {
                    required: "Please enter phone number",
                    digits: "Please enter vaild phone number ",
                },
                ammount: {
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
            sendproposalform();
        },
        contactpayment: function (){
            payment();
        },
    }
}();