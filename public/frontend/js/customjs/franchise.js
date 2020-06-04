var Franchise = function () {
    
  var franchisedashborad = function(){
      
      
      
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
              url: baseurl + "franchise-ajaxAction",
              data: {'action': 'deleteprofile', 'data': data},
              success: function (data) {
                  handleAjaxResponse(data);
              }
          });
      });
          var form = $('#myform');
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
                 industry: {
                  required:true
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
                password: {
                  required: "Please provide a password",
                  minlength: "Your password must be at least 5 characters long"
                },
                email: 
                 {
                  required: "Please enter a valid email address",
                  
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

          handleFormValidateWithMsg(form, rules, messages, function (form) {
              handleAjaxFormSubmit(form, true);
          }); 
          
          
          $('body').on("change","#country",function(){
              
              var val = $(this).val();
              $.ajax({
                  type: "POST",
                  headers: {
                      'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                  },
                  url: baseurl + "franchise-ajaxAction",
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
                  url: baseurl + "franchise-ajaxAction",
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
          
  }
  var frdetails = function(){
      
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
              url: baseurl + "franchise-ajaxAction",
              data: {'action': 'deleteprofile', 'data': data},
              success: function (data) {
                  handleAjaxResponse(data);
              }
          });
      });
      $('body').on('click', '#csubmit', function(evt) {
          var support=$('#supportkpi').val();
          $.ajax({
              type: "POST",
              headers: {
                  'X-CSRF-TOKEN': $('input[name="_token"]').val(),
              },
              url: baseurl + "support-email",
              data: {'action': 'support','support':support},
              success: function(data) {
                  handleAjaxResponse(data);
              }
          });
      });
      
      $('body').on('change', '.fileinput', function(evt) {
          var tgt = evt.target || window.event.srcElement,
          files = tgt.files;
          
                  if (FileReader && files && files.length) {
                      var fr = new FileReader();
                      fr.onload = function () {
                          document.getElementById('change_overview').src = fr.result;
                      }
                      fr.readAsDataURL(files[0]);
                  }else {
                      console.log('ddd');
                  }
      });
      
      
      $('body').on('change', '.team_change', function(evt) {
          var tgt = evt.target || window.event.srcElement,
          files = tgt.files;
          if (FileReader && files && files.length) {
                  var fr = new FileReader();
                  fr.onload = function () {
                  document.getElementById('pre_team_change').src = fr.result;
                  }
                  fr.readAsDataURL(files[0]);
                  }else {
                  console.log('ddd');
          }
      });

      $('body').on('change', '.video_change', function(evt) {
          var tgt = evt.target || window.event.srcElement,
          files = tgt.files;

          if (FileReader && files && files.length) {
                  console.log(files);
                  var fr = new FileReader();
                  fr.onload = function () {
                  document.getElementById('pre_video_change').src = fr.result;
                  }
                  fr.readAsDataURL(files[0]);
                  }else {
                  console.log('ddd');
          }
      });
      $('body').on("click",".preview_pitch",function(){
          
          var min_investment=$('#min_investment').val();
          var max_investment=$('#max_investment').val();
          var min_accepted=$('#min_accepted').val();
          $('#pre_min_accept').val(min_accepted);

          var usp1=$('#usp1').val();
          
          if( usp1 != '' ){
              $('#pre_usp1').html(usp1);
              $('#pre_usp1').css("display",'');
          }else{
              $('#pre_usp1').css("display",'none');
          }
          
          var usp2=$('#usp2').val();
          if( usp2 != '' ){
              $('#pre_usp2').html(usp2);
              $('#pre_usp2').css("display",'');
          }else{
              $('#pre_usp2').css("display",'none');
          }
          
          

          var usp3=$('#usp3').val();
          if( usp3 != '' ){
              $('#pre_usp3').html(usp3);
              $('#pre_usp3').css("display",'');
          }else{
              $('#pre_usp3').css("display",'none');
          }
          
          var usp4=$('#usp4').val();
          if( usp4 != '' ){
              $('#pre_usp4').html(usp4);
              $('#pre_usp4').css("display",'');
          }else{
              $('#pre_usp4').css("display",'none');
          }
//            $('#pre_usp4').html(usp4);

          var introduction=$('#introduction').val();
          $('#pre_intro').html(introduction);

          var idea=$('#idea').val();
          $('#pre_idea').html(idea);
          
          var teamoverview=$('#team_overview').val();
          $('#pre_overview').html(teamoverview);

          var member1=$('#member1').val();
          
          var position1=$('#position1').val();
          if( member1 != '' && position1 != ''){
              
              $('#pre_member1').html(member1);
              $('#pre_position1').html(position1);
              $('#li1').css("display",'');
          }
          

          var member2=$('#member2').val();
          
          
          var position2=$('#position2').val();
          
          if( member2 != '' && position2 != ''){
              
              $('#pre_member2').html(member2);
              $('#pre_position2').html(position2);
              $('#li2').css("display",'');
          }
          
          
          
          var member3=$('#member3').val();
          var position3=$('#position3').val();
          if( member3 != '' && position3 != ''){
              $('#pre_member3').html(member3);
              $('#pre_position3').html(position3);
              $('#li3').css("display",'');
          }
          
          
          var member4=$('#member4').val();
          
          var position4=$('#position4').val();
          if( member4 != '' &&  position4 != ''){
              $('#pre_member4').html(member4);
              $('#pre_position4').html(position4);
              $('#li4').css("display",'');
          }
          

          var roi=$('#roi').val();
          $('#pre_roi').html(roi+" %");

          var coc=$('#coc').val();
          $('#pre_coc').html(coc+" %");

          var pi=$('#pi').val();
          $('#pre_pi').html(pi+" INR");

          var amd=$('#amd').val();
          $('#pre_amd').html(amd+" %");

          var fa=$('#fa').val();
          $('#pre_fa').html(fa+" INR");

          var ebitda=$('#ebitda').val();
          $('#pre_ebitda').html(ebitda+" %");
      });


      var form = $('#frdetails');
      var rules = {
          
          min_investment: {
              required: true,
              minlength: 6,
              maxlength : 11,
              number:true,
          },
          max_investment: {
              required: true,
              minlength: 6,
              maxlength : 11,
              number:true,
              min: function() 
                  {
                     return parseInt($('#min_investment').val());
                  }
            
          },
          min_accepted: {
              required: true,
              minlength: 5,
              maxlength : 11,
              number:true,
              max: function() 
                  {
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
          terms: {
            required: true
          },
          
            roi : {
                  maxlength: 3
                    },
                    coc : {
                          maxlength: 3
                    },
                    pi : {
                          maxlength: 11
                    },
                    amd : {
                          maxlength: 3
                    },
                    fa : {
                          maxlength: 12
                    },
                    ebitda : {
                          maxlength: 3
                    },
      };
      
       var messages = {
              min_investment: {
                  required: "Minimum Investment required",
                  minlength: "Minimum Investment amount not less than 1 lakh",
                  maxlength : "Minimum Investment amount not greater than 1000 crore",
                  number:"Please enter a valid number.",
              },
              max_investment: {
                  required: "Maximum investment required",
                  minlength: "Maximum Investment amount not less than 1 lakh",
                  maxlength : "Maximum Investment amount not greater than 1000 crore",
                  number:"Please enter a valid number.",
              },
              min_accepted: {
                  required: "Minimum Accepted Investment required",
                  minlength: "Minimum Accepted amount not less than 10000",
                  maxlength : "Minimum Accepted amount not greater than 1000 crore",
                  number:"Please enter a valid number.",
              },
              min_accepted: {
                  required: "Minimum Accepted Investment required",
                  minlength: "Minimum Accepted amount not less than 10000",
                  maxlength : "Minimum Accepted amount not greater than 1000 crore",
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
                accept : "Enter vaild member 1 name"
              },
              member2: {
                 accept : "Enter vaild member 2 name"
              },
              member3: {
                 accept : "Enter vaild member 3 name"
              },
              member4: {
                 accept : "Enter vaild member 4 name"
              },
              position1: {
                required: "Member 1's position is required"
              },
              terms: {
                required: "Please agree with T&C"
              },
              roi : {
                  maxlength: "Return of Investment must be 999 %"
                },
                coc : {
                  maxlength: "Cost of capital must be 999 %"
                },
                pi : {
                  maxlength: "Promotors Investment must be 1000 crore"
                },
                amd : {
                  maxlength: "Assured minimum dividend must be 999 %"
                },
                fa : {
                  maxlength: "Fixed assests must be 10000 crore"
                },
                ebitda : {
                  maxlength: "Ebitda must be 999 %"
                },
      };

      handleFormValidateWithMsg(form, rules, messages, function (form) {
          handleAjaxFormSubmit(form, true);
      }); 
  }
  
  var paymentetails = function(){
      
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
              url: baseurl + "franchise-ajaxAction",
              data: {'action': 'deleteprofile', 'data': data},
              success: function (data) {
                  handleAjaxResponse(data);
              }
          });
      });
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
          var start = new Date().getTime();

          handleFormValidateWithMsg(form, rules, messages, function (form) {
            var end = new Date().getTime();
            var time = end - start;
             conslole.log('Execution time: ' + time);
            $('#payuForm').submit();
          }); 
  }
  
  var profileimagenew =function(){
      var form = $('#profileimage');
          var rules = {
              profileimage_new: {
                  required: true,
              },
          };
          
           var messages = {
              profileimage_new: {
                  required: "Please upload profile image",
              },
          };

          handleFormValidateWithMsg(form, rules, messages, function (form) {
              handleAjaxFormSubmit(form, true);
          }); 
  }
  return {
      init: function () {
          franchisedashborad();
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
      profileimage: function () {
          profileimagenew();
      },
      
  }
}();
$('#btnmainPasscode').on('click',function(){

$('#divPasscode').toggle(500);

});
$('#btnPasscodeApply').on('click',function(){
showprogress();
  var data =$('#passcode' ).val();
  $.ajax({
      type: 'POST',
      headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val(),
      },
      data:{pass_code:data},
      url: baseurl+"apply-passcode",
      dataType:'json',
      
      success: function (result) {
        $('.modal-dialog').css('max-width','500px');
  
        $('.modal-title').text('Message');
        $('.modal-body').html();
        $('.modal-body').html(result['message']);
        $('#btnModal').click();
          hideprogress();
      }
  });
});

$(document).ready(function(){
  $('.basicanchor').on('click',function(e){
   
    e.preventDefault();
    $('#divPlatinum').hide();
    $('#divBasic').show();
   
  });
  $('.platinumanchor').on('click',function(e){
   
    e.preventDefault();
    $('#divBasic').hide();
    $('#divPlatinum').show();
  })
})