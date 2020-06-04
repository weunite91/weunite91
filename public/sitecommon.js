function inrFormat(num) { // nStr is the input string
    if (num=='-')
    {
        return 0;
    }
    var search=",";
    if( (num!='') &&(num!=null))
    {
        num= num.toString().replace(new RegExp(search, 'g'), "");
    var n1, n2;
            num = num + '' || '';
            // works for integer and floating as well
            n1 = num.split('.');
            n2 = n1[1] || null;
            n1 = n1[0].replace(/(\d)(?=(\d\d)+\d$)/g, "$1,");
            if ( (n2==null)||(n2.length==0))
            {
                n2="00";
            }
            else if (n2.length==1)
            {
                n2=n2+"0";
            }
            num = n2 ? n1 + '.' + n2 : n1;
            return n1;
    }
   return 0;
 }

 $(document).ready(function(){
    getNotifications();
    $(".inrformat").each(function(){
        change_to_inr_format(this);
    });
    $(".inrformat") .on('change',function()
    {
        change_to_inr_format(this)
    });
     get_proposal_history_check();


 });
 function  get_proposal_history_check()
 {
    if (window.location.href.indexOf("/get-all-proposal-list/")>0)
    {
        var url=window.location.href;
        var sender_profile_code='';
        var lastIndex=url.lastIndexOf("/");
        sender_profile_code=url.substring(lastIndex+1);

       get_proposal_history_ajax(sender_profile_code);
    }
 }
 function change_to_inr_format(thisVar)
 {
     if ($(thisVar).val()=='')
     {
        $(thisVar).val('0');
     }
    var finValue=inrFormat($(thisVar).val());
    $(thisVar).val(finValue);
    var originalTextboxId=(thisVar.id).replace("_dis","");
    var withOutCommaValue= finValue.replace(/,/g, "");
    $('#'+originalTextboxId).val(withOutCommaValue);
    $('#'+originalTextboxId).valid();
    console.log($('#'+originalTextboxId).val());
 }



function getNotifications() {

    $.ajax({
        type: 'GET',
        url: baseurl+"get-notifications",
        dataType:'json',

        success: function (result) {
            prepare_notification(result)
        }
    });
}
function prepare_notification(result)
{
    $('.badge').html(result.length);
    if (result.length>0)
    {
        var html='';
        for(var i=0;i<result.length;i++)
        {
            html+='<li style="background-color:white !important;'+
                        'margin:10px 10px 10px 10px;border-radius:10px !important">';

            html+="<div  class=' notificationdetails' style=''>"+
                    "profile code:" +result[i]['sender_profile_code'] + "<br/>" +
                    "subject :" +result[i]['subject'] +"<br/>" +
                    "message :" +result[i]['message'] +"<br/>" +
                    "</div>";
                    html+='<div style="text-align:right;padding-right:5px !important">'+
                            '<a href="'+ baseurl +'get-all-proposal-list/'+result[i]['sender_profile_code']+'"><i class="fa fa-reply" style="font-size:10px;margin-right:2px" aria-hidden="true"></i>'+
                            'reply'+
                            '</a> '+
                          '</div>';
            html+='</li>';

        }

        $('#divNotificationDetails').html(html);
    }
    else{

    }
}
function get_proposal_history(profile_code,event)
{
    event.preventDefault();
    get_proposal_history_ajax(profile_code);

}
function get_proposal_history_ajax(profile_code)
{
    showprogress();
    $.ajax({
        type: 'GET',
        url: baseurl+"get-proposal-history"+"/"+profile_code,
        dataType:'json',

        success: function (result) {
            prepare_replyproposal(result,profile_code);
            hideprogress();
        }
    });
}
function prepare_replyproposal(result,profile_code)
{
    if (result.length>0)
    {
        var html='';
        for(var i=0;i<result.length;i++)
        {
            var fromhtml='';
            var fromclass='';
            if(profile_code==result[i]['sender_profile_code'])
            {

                fromhtml+='From '+result[i]['sender_profile_code']+':' ;
            }
            else{
                fromclass=' class="pull-right"';
                fromhtml+='From You:';
            }
            html+='<div ' + fromclass +' style="'+
            'margin:10px 10px 10px 0px;border-radius:10px !important">';
            html+= fromhtml+' </div>';
            html+='<div style="clear:both" />';
            html+='<div'+ fromclass+' style="width:fit-content !important;background-color:white !important;'+
                        'margin:10px 10px 10px 10px;border-radius:10px !important;padding:10px 10px 10px 10px;border-radius:10px !important">';

            html+="<div  class=' ' style='padding:10px 10px 10px 10px;border-radius:10px !important'>"+

                    "subject :" +result[i]['subject'] +"<br/>" +
                    "message :" +result[i]['message'] +"<br/>" +
                    "</div>";

            html+='</div>';
            html+='<div style="clear:both" />';
        }

        $('#divMsgHistory').html(html);
        $('#txtmessage').val('');
        $('#profile_code').val(profile_code);
        $('#divReplyForm').show();
        $('#divMsgHistory').scrollTop($('#divMsgHistory').height())
    }
}

$('#sendMessage').on('click',function(){
    showprogress();
    var data =$('#frmReplyPropsosal' ).serialize();
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
        },
        data:data,
        url: baseurl+"reply-proposal",
        dataType:'json',

        success: function (result) {
            $('#txtmessage').val('');
            hideprogress();
        }
    });
});

function showprogress() {
    document.getElementById("divoverlayspinner").style.display = "block";
  }

  function hideprogress() {
    document.getElementById("divoverlayspinner").style.display = "none";
  }

  function submitpagefilter(pageno)
  {
      $('#pagetype').val(pageno);
    $('#pageaction').click();
  }

