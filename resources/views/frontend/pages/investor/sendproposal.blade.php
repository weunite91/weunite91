@extends('frontend.layout.layout')
@section('content')
<div id="Container"> 
    <div id="Content-Container">
        <div id="Content-Main">
            <div class="table-div">
                <div id="Content" class="table-cell">
                    <article class="textMain ">
                        <h1>Contact Investor</h1>
                        <div class="contact-form" >	
                            <form name="sendproposal"  method="post" id="sendproposal" enctype="multipart/form-data">
                                <input type="hidden" class="hidden" name="investordetailsid" placeholder="investordetailsid" value="{{ $invester_details->id }}" readonly/>
                                {{ csrf_field() }}

                                <p>From, </p>
                                <div class="row">
                                    <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Name </div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3">{{ $session['logindata'][0]['firstname'] }} </div>
                                    <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Email</div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3">{{ $session['logindata'][0]['email'] }}</div>
                                    
                                </div>
                               
                                <div class="row">
                                    <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Profile Code</div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3"> {{ $session['logindata'][0]['profile_code'] }}</div>
                                    <div  class="contact-from-labeldiv">Location</div>
                                    <div class="colon">:</div>
                                    <div  class="col-md-3 col-lg-3">{{ $userDetails[0]->city }}, {{ $userDetails[0]->country }}</div>
                                </div>

                                <hr/>
                                <p>To, </p>
                                <p>Investor </p>
                                <div class="row">
                                    <div  class="col-md-2 col-lg-2 contact-from-labeldiv">Profile Code</div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3">{{ $invester_all_Details[0]->profile_code }} </div>

                                    <div class="col-md-2 col-lg-2 contact-from-labeldiv">Location</div>
                                    <div class="colon">:</div>
                                    <div class="col-md-3 col-lg-3">{{ $invester_all_Details[0]->cityname }}, {{ $invester_all_Details[0]->countryname }} </div>
                                </div>
                                
                                <div class="inline-input" style="width: 94%;display:none">
                                    <p>Invester Profile Code </p>
                                    <input type="text" name="reciver_profile_code" placeholder="" value="{{ $invester_details->profile_code }}" readonly/>
                                </div>
                                <div class="inline-input" style="display:none">
                                    <input type="text" name="firstname" placeholder="First Name" value="{{ $session['logindata'][0]['firstname'] }}" readonly/>
                                </div>
                                <div class="inline-input" style="display:none">
                                    <input type="text" name="profilecode" placeholder="Profile Code" value="{{ $session['logindata'][0]['profile_code'] }}" readonly/>
                                </div>
                                <div class="inline-input" style="width: 94%;display:none" >
                                    <input type="text" name="subject" placeholder="Subject" />
                                </div>
                                <div class="block-area" style="margin: 10px;">
                                    <textarea name="about" placeholder="Describe yourself (700 words maximum)" maxlength="700"></textarea>
                                </div>
                                <div class="block-area">
                                    <input type="checkbox" id="cbu_checkbox" name="cbu_checkbox" style="vertical-align:middle !important" /> 
                                    <span style="vertical-align:middle !important" >I agree with </span>
                                    <a href="{{ route('terms-and-conditions') }}" target="_blank" style="color:blue;vertical-align:middle !important"> Terms & Conditions</a>
                                </div>
                                <div class="inline-input submit-reset" style="margin-bottom:2px !important;">
                                    <center>
                                        <input type="reset" class="reset-btn" />
                                        <input type="submit" class="submitbtn" value="Send" />
                                    </center>

                                </div>

                                <div class="inline-input" style="width:94%;margin-top:1px !important;pading-top:1px !important" >
                                    <div class="pull-right">
                                <a href="{{ route('contactpayment',$id) }}"  style="float: right;color: blue" >
                                    <i class="fa fa-unlock-alt" aria-hidden="true" style="padding-right:5px !important"></i>Unlock Investor Contact</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="go-back-btn">
                            <a href="{{ route("investorpitch-detail",$id) }}">Go Back</a>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>	
</div>
@endsection