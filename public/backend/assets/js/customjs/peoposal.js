var Peoposal = function () {

    var list = function () {
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#proposal-datatable',
             'ajaxURL': baseurl + "proposal-ajaxAction",
             'ajaxAction': 'get-proposal-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 2,
             'defaultSortOrder': 'asc',
             'setColumnWidth': columnWidth,
             'noSortingApply':0
         };
         getDataTable(arrList);
         
         
         $('body').on("change",".approve",function(){
           var id= $(this).attr('data-id');
           var val = $(this).val();
           
           $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "proposal-ajaxAction",
                data: {'action': 'approvechange', 'id': id,'val':val},
                success: function(data) {
                   handleAjaxResponse(data);
                }
            });
            
       });

       $('.btnDelete').on("click",function(){
        var id= $('#hidmodalDeleteId').val();
        var val ='rejected';
        var $activeElement = $(document.activeElement);
       
        $.ajax({
             type: "POST",
             headers: {
                 'X-CSRF-TOKEN': $('input[name="_token"]').val(),
             },
             url: baseurl + "proposal-ajaxAction",
             data: {'action': 'approvechange', 'id': id,'val':val},
             success: function(data) {
                handleAjaxResponse(data);
             }
         });
         
        });

        $('#deleteModel').on('hide.bs.modal show.bs.modal', function(event) {
        
            var activeElement = $(document.activeElement);
           
            if (activeElement.is('[data-toggle], [data-dismiss]')) {
              if (event.type === 'hide') {
                $('#hidmodalDeleteId').val('0')
              }
              
              if (event.type === 'show') {
                  var val= $(activeElement).attr('data-id');
                $('#hidmodalDeleteId').val(val);
               
              }
            }
          });
    }

    var editproposal = function(){

        var form = $('#editform-proposal');
            var rules = {
                firstname: {
                    required: true,
                    minlength: 3
                },
                amount: {
                    required:true,
                    number:true
                },
                message: {
                    required:true
                },
            };
            var messages = {
                firstname: {
                    required: "Please enter your Firstname",
                    minlength: "Your firstname must be at least 3 characters long"
                },
                amount: {
                    required:'Please enter Amount',
                    number: "Please enter Numbers",
                },
                message: {
                    required: "Please write your Message",
                },
            };

            handleFormValidateWithMsg(form, rules, messages, function (form) {
                handleAjaxFormSubmit(form, true);
            }); 
    }
    return{
        init: function () {
            list();
        },
        edit: function (){
            editproposal();
        },
    }
}();
$('.allcheckbox').on('click',function(){
    var checkedValue=$(this).is(":checked");
    $('.checkID').each(function(){
        $(this).prop('checked', checkedValue);
       
    });
   
});

$('#allSubmit').on('click',function(){
   var selectValue=$('#allaction').val();
   if (selectValue=='')
   {
    alert('please select Action');
   }
    var ids='';
   $('.checkID').each(function(){
       
        if ($(this).is(":checked")==true)
        {
            ids+= $(this).attr('data-id')+",";
        }
   });
   if (ids=='')
   {
       alert('please select atleast one user');
   }
   else
   {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "proposal-ajaxAction",
            data: {'action': 'allproposalaction', 'id': ids,'val':selectValue},
            success: function(data) {
            handleAjaxResponse(data);
            }
        });
   }
   
});