@extends('frontend.layout.layout')
@section('content')
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<div id="Container"> 
    <div id="Content-Container">
        <div id="Content-Main">
            <div class="table-div">
                <div id="Content" class="table-cell">
                    <article class="textMain ">
                        <h1>Contact Business</h1>
                        <div class="contact-form" style="">	
                            <form name="sendproposal"  method="post" id="sendproposal" enctype="multipart/form-data">
                                <input type="hidden" class="hidden" name="investordetailsid" placeholder="investordetailsid" value="{{ $id }}" readonly/>
                                {{ csrf_field() }}
                               
                               
                                <p>From, </p>
                                <div class="row">
                                <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Name</div>
                                    <div class="colon">:</div>
                                    <div  class="col-md-3 col-lg-3">{{ $session['logindata'][0]['firstname'] }}</div>

                                    <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Email</div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3">{{ $session['logindata'][0]['email'] }}</div>

                                   
                                </div>
                                
                                <div class="row">
                               
                                <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Profile Code</div>
                                    <div class="colon">:</div>
                                    <div  class="col-md-3 col-lg-3">{{ $session['logindata'][0]['profile_code'] }}</div>
                                    <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Location</div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3">{{ $userDetails[0]->cityname }}, {{ $userDetails[0]->countryname }}</div>
                                </div>
                                
                                <hr/>
                                
                                <p>To, </p>
                                <p>Fundraiser </p>
                                <div class="row">
                                    <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Profile Code</div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3">{{ $fund_userDetails[0]->profile_code }}</div>

                                    <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Location</div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3">{{ $fund_userDetails[0]->city }}, {{ $fund_userDetails[0]->country }}</div>
                                </div>
                                

                                <div class="inline-input"  style="display:none" >

                                <p>Business Profile Code </p>
                                    <input type="text" name="reciver_profile_code" placeholder="" value="{{ $business_profile_code }}" readonly/>
                                </div>

                                <div class="inline-input" style="display:none">
                                    <input type="text" name="firstname" placeholder="First Name" value="{{ $session['logindata'][0]['firstname'] }}" readonly/>
                                </div>
                                <div class="inline-input" style="display:none">
                                    <input type="text" name="profilecode" placeholder="Profile Code" value="{{ $session['logindata'][0]['profile_code'] }}" readonly/>
                                </div>
                                <div class="inline-input" style="width: 94%;display:none">
                                    <input type="text" name="subject" placeholder="Subject" value="" />
                                </div>
                                <div class="block-area" style="margin: 10px;">
                                    <textarea name="about" id="message_box" placeholder="Please enter your message (you can choose message below option)" maxlength="700"></textarea>
                                </div>
                                
                                <div class="block-area" style="margin: 10px;">
                                    <select  class="message" id="message">
                                        <option value="">Please select your message(optional)</option>
                                        <option value="Interested in your business">Interested in your business</option>
                                        <option value="I am not interested to Invest">I am not interested to Invest</option>
                                        <option value="Require more details from you">Require more details from you</option>
                                        <option value="Send us your proposal">Send us your proposal</option>
                                        <option value="I want more time to reply">I want more time to reply</option>
                                        <option value="I will reply shortly">I will reply shortly</option>
                                        <option value="Unable to contact yo">Unable to contact you</option>
                                    </select>
                                </div>
                                <div class="block-area">
                                    <input type="checkbox" id="cbu_checkbox" name="cbu_checkbox" style="vertical-align:middle !important" /> 
                                    <span style="vertical-align:middle !important" >I agree with </span>
                                    <a href="{{ route('terms-and-conditions') }}" target="_blank" style="color:blue;vertical-align:middle !important"> Terms & Conditions</a>
                                </div>
                                <div class="inline-input submit-reset" style="margin-bottom:2px !important;" >
                                    <center>
                                        <input type="reset" class="reset-btn" />
                                        <input type="submit" class="submitbtn" value="Send" />
                                    </center>
                                   
                                   
                                </div>
                                <div class="inline-input" style="width:94%;margin-top:1px !important;pading-top:1px !important" >
                                    <div class="pull-right">
                                <a href="{{ route('contactpayment',$id) }}"  style="float: right;color: blue" >
                                    <i class="fa fa-unlock-alt" aria-hidden="true" style="padding-right:5px !important"></i>Unlock Business Contact</a>
                                    </div>
                                </div>
                              
                            </form>
                            

                        </div>

                        

                    </article>
                </div>
            </div>
        </div>
    </div>	
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #f9dc06;padding: 25px;margin: -20px">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title" style="color: white">Contact Details</h2>
        </div><br><br>
        <div class="modal-body">
          <p>You need to pay 1299INR rupees for contact details</p>
        </div>
        <br><br>
        <div class="modal-footer">
            <a href="{{ route('contactpayment',$pitchId)}}" class="btn btn-default" style="float: right;padding: 10px;border: 1px solid black" >Ready to pay</a>
        </div>
        <br><br>
      </div>
      
    </div>
  </div>
@endsection