@extends('frontend.layout.layout')
@section('content')
<div id="Container" > 
    <div id="Content-Container">
        <div id="Content-Main">
            <div class="row" style="margin-top:5px !important;margin-bottom:5px !important; min-height:600px !important;max-height:600px !important">
                <div class="col-md-2 col-md-2" style="background-color:rgb(238, 238, 238) !important;
                                                   ">
                    
                        <h4>All Proposals</h4>
                      
                            <form name="sendproposal"  method="post" id="sendproposal" enctype="multipart/form-data">
                                
                                {{ csrf_field() }}
                                
                              @foreach($allproposallist as $rec)
                              
                              <div  style="width: 94%;padding-left:5px !important;margin:5px 5px 5px 5px !important;background-color:white">
                            <a href="#" onclick="get_proposal_history('{{$rec->sender_profile_code}}',event)" >{{$rec->sender_profile_code}} ({{$rec->totalcount}})</a>
                                    
                                </div>
                              @endforeach
                                
                            </form>
                  
                </div>
                
                                
                                
                <div class="col-md-9 col-md-9">
                   <div id="divMsgHistory" style="background-color:rgb(238, 238, 238) !important;max-height:520px !important;overflow:auto !important"></div>
                   <div id="divReplyForm" style="display:none">
                   <form name="frmReplyPropsosal"  method="post" id="frmReplyPropsosal" enctype="multipart/form-data">
                   {{ csrf_field() }}
                   <textarea id="txtmessage" name="txtmessage" placeholder="Type reply message here..." style="width:100%"></textarea>
                   <input type="hidden" id="profile_code" name="profile_code" />
                   </div>
                   <div class="pull-right">
                   <input type="button" id="sendMessage" value="Send" />
                   </div>
                   </form>
                </div>
            </div>
          
        </div>
    </div>	
</div>


@endsection
