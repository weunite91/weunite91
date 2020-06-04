@extends('frontend.layout.layout')
@section('content')
<div id="Container"> 
    <div id="Content-Container">
        <div id="Content-Main">
            <div class="table-div">
                <div id="Content" class="table-cell">
                    <article class="textMain ">
                    
                        <h1>Contact {{$c_headertext}} payment details</h1>
                        <div class="contact-form">	
                            <form name="contactbusiness"  method="post" id="contactbusiness1" action="{{ route("contact_payment")}}"enctype="multipart/form-data">
                               
                                {{ csrf_field() }}
                               
                                
                                <input type="hidden" class="hidden" name="investordetailsid" placeholder="investordetailsid" value="{{ $id }}" readonly/>
                                {{ csrf_field() }}
                                <div class="inline-input">
                                <p>{{$c_headertext}} Profile Code </p>
                                    <input type="text" name="reciver_profile_code" placeholder="" value="{{ $business_profile_code }}" readonly/>
                                </div>
                                <div class="inline-input" >
                                    <p>Amount To Pay ( <i class="fa fa-inr" ></i> )</p>
                                    <input type="text" name="amount" placeholder="Payable ammout" value="1299" readonly/>
                                </div>
                                <div class="inline-input">
                                
                                    <input type="text" name="firstname" placeholder="First Name" value="{{ $session['logindata'][0]['firstname'] }}" readonly/>
                                </div>
                                <div class="inline-input">
                                    <input type="text" name="profilecode" placeholder="Profile Code" value="{{ $session['logindata'][0]['profile_code'] }}" readonly/>
                                </div>
                                
                                
                               
                                
                                <div class="inline-input submit-reset">
                                    <center>
                                        <input type="submit" class="submitbtn" value="Submit Now" />
                                    </center>
                                    <br>
                                   
                                </div>
                                
                            </form>
                            

                        </div>

                        

                    </article>
                </div>
            </div>
        </div>
    </div>	
</div>
@endsection