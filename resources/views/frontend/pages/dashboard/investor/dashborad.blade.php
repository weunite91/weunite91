@extends('frontend.layout.layout')
@section('content')
<div id="Container">
 
    <div class="main-container">
        @if(Session::has('success'))
        <div class="alert success">
            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span>
            <strong>{{ Session::get('success') }} !</strong>
        </div>
        @endif
        <div class="profile-dashboard">
            <div class="table-div">
                <div class="table-cell profile-img">
                    <form id="uploadForm" action="" method="post" >
                        {{ csrf_field() }}
                        <input type="file" id="image" classname="profileimage_new" style="display:none" onChange="submitForm()"/>
                        <div class="img_container" onclick="updateimagefunction()"><center>
                                @if($userDetails[0]->user_image == null || $userDetails[0]->user_image == ''   )
                                <img src="{{asset('public/frontend')}}/image/kiran.jpg" alt=""/>
                                @else
                                <img src="{{ asset('public/upload/userprofile/'.$userDetails[0]->user_image) }}" alt=""/>
                                @endif
                            </center>
                            <div class="middle">
                                <div class="text">Click to Change Picture</div>
                            </div>
                        </div>
                    </form>
                    @if($userDetails[0]->admin_verify_status == 0)
                    <p>Status: Under Review <span>Profile Under<br/> Process/Review...</span></p>
                    @elseif($userDetails[0]->admin_verify_status == 1)
                    <p>Status: Hold <span>Profile Under<br/> Process/Review...</span></p>
                    @else
                    <p>Status: Active <span><br/></span></p>
                    @endif

                    <ul class="profile-cat">
                        <li><a href="">Edit Profile</a></li>
                    </ul>


                </div>
                <div class="table-cell profile-info">
                    <ul>
                        <li><span>Name:</span> {{ $userDetails[0]->firstname }} {{ $userDetails[0]->lastname }}</li>
                        <li><span>Email:</span> {{ $userDetails[0]->email }}</li>
                        <li><span>Profile Code:</span>  {{ $userDetails[0]->profile_code }}</li>
                        <li><span>Joined Date:</span>  {{ date("d-m-Y",strtotime($userDetails[0]->cretedate)) }}</li>
                        <li><span>Recent Payment:</span>  Free Trial </li>
                        <li><span>Location:</span>  {{ $userDetails[0]->cityname }}, {{ $userDetails[0]->countryname }}</li>
                       
                    </ul>
                </div>
                <div class="table-cell profile-note">
                    <p style="height: 150px"><span>Note: Attention Required</span> {{ $userDetails[0]->user_note }}</p>
                    @if ($userDetails[0]->weunite_email!='')
                    <div class="table-cell profile-info">
                    <ul>
                    <li><span >Your WeUnite91 Email: </span>
                    <a style="color:blue" href="https://weunite91.com:2096/login/?user={{ $userDetails[0]->weunite_email }}" target="_blank">{{ $userDetails[0]->weunite_email }}</a></li>
                    <li>(Please check your registered email to know <br/> WE UNITE 91 mail password.)</li>
                    </ul>
                    </div>
                    @endif
                    <ul class="profile-cat">
                        <li><a href="{{route("favourite_pitch","1") }}">View favourite pitch</a></li>
                        @if($userDetails[0]->pitchid !='')
                        <li><a href="{{route("investorpitch-detail",$userDetails[0]->pitchid)}}">View Profile</a></li>
                        @endif
                        <li><a href="#"  class="deleteprofile" data-toggle="modal" data-id="{{ $userDetails[0]->id }}" data-target="#deletemodel">Delete Profile</a></li>
                        
                    </ul>
                </div>
                <div class="table-cell profile-info-invest">

                    <div class="profile-info-invest-intra">
                        <ul>
                            <li><div class="table-cell">Investor / Buyer </div><div class="table-cell"> </div></li>
                            <li><div class="table-cell">Industry:</div>

                                @php
                                $tmarr=explode(",",$userDetails[0]->industry);
                                $count=0;
                                $ind_str='';
                                @endphp
                                @foreach($industrylist as $key => $value)
                                @if(in_array($value->id,$tmarr))
                                @if($count > '0')
                                @php
                                $ind_str.=',';
                                @endphp
                                @endif
                                @php
                                $ind_str.=$value->industry;
                                @endphp
                                @php
                                $count++;
                                @endphp
                                @endif

                                @endforeach
                                <div class="table-cell"> {{ substr($ind_str,0,56).'...' }} </div>
                            </li>
                            <li><div class="table-cell">Investment Range:</div><div class="table-cell"> INR {{ indian_money_format($userDetails[0]->min_investment) }} - INR {{ indian_money_format($userDetails[0]->max_investment) }}</div></li>
                            <!-- <li><div class="table-cell">Pitch Deck Valid till:</div><div class="table-cell"> 3-8-2019</div></li> -->
                            <!-- <li><div class="table-cell gps-icon"><img src="image/gps.png" alt="" />GPS:</div><div class="table-cell"> Bangalore, India</div></li> -->
                            <!-- <li><div class="table-cell gps-icon">Credits Left:</div><div class="table-cell">  1</div></li> -->
                            
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="favourite-pitch-summary responsive-table">
            <table>
                <thead>
                    <tr>
                        <th scope="col" class="sr-th">SR. <span>No</span></th>
                        <th scope="col">Profile <span>Code</span></th>
                        <th scope="col">Refundable <span>Deposit</span></th>
                        <th scope="col">Payment <span>Date</span></th>
                        <th scope="col">Investment <span>Offered</span></th>
                        <th scope="col">Live Pitch <span>Valid Till</span></th>
                        <th scope="col">Transaction No</th>
                        <th scope="col">Receipt</th>
                        <th scope="col">Revoke <span>Offer</span></th>
                    </tr>
                </thead>
                <tbody>
                    @php $off_count=1;@endphp
                    @foreach($offered_data as $key => $value)
                    <tr>
                        <td  scope="row" data-label="SR. No">{{$off_count}}</td>
                        <td  scope="row" data-label="Profile Code">{{$value->profile_code}}</td>
                        <td  scope="row" data-label="Refundable Deposit">{{indian_money_format($value->commision)}}</td>
                        <td  scope="row" data-label="Payment Date">{{date_format(date_create($value->pay_date),"d/M/Y")}}</td>

                        <td  scope="row" data-label="Investment Offered">INR {{indian_money_format($value->ammount)}}</td>
                        @php 
                        $date=date_create($value->active_date);
                        date_add($date,date_interval_create_from_date_string($value->days.'days'));
                        $valid_till=date_format($date,"d/M/Y");
                        @endphp
                        <td  scope="row" data-label="Valid Till">{{$valid_till}}</td>
                        <td  scope="row" >
                        {{$value->transaction_id}}
                        </td>
                        <td  scope="row" >
                             @if( $value->transaction_id !='')
                             <a href="{{route("view-invester-reciept",$value->transaction_id) }}" target="_blank"  >Download</a>
                         @endif
                        </td>
                        <td class="revoke-icon" scope="row" data-label="Revoke">
                            @php 
                            $date=date_create($value->active_date);
                            date_add($date,date_interval_create_from_date_string($value->days.'days'));
                            $finaldate = date_create(date_format($date,"Y-m-d"));
                            $today = date_create(date("Y-m-d"));
                            @endphp
                            @if($finaldate > $today)
                            <a href="#" class="revokbuton" data-toggle="modal" data-target="#revokemodel" data-id="{{$value->revok_id}}"><img src="{{asset('public/frontend')}}/image/delete.png" alt="" /></a>

                            @endif
                        </td>
                    </tr>
                    @php $off_count++;@endphp
                    @endforeach
                </tbody>
            </table>
            <div class="pull-right" style="margin-top: 10px">
                {{ $offered_data->links() }}
            </div>
        </div>






        <div class="forms" style="margin-top: 70px">
            <div class="contact-form">
                <div class="formtitle text-center" style="text-align: center;">Investor Profile</div>
                <form method="post" action="" enctype="multipart/form-data" id="myform">{{ csrf_field() }}
                    <div class="inline-input">
                        <input type="text" name="firstname" value="{{ $userDetails[0]->firstname }}" placeholder="First Name *" />
                    </div>
                    <div class="inline-input">
                        <input type="text" name="lastname" placeholder="Last Name *" value="{{ $userDetails[0]->lastname }}"/>
                    </div>
                    <div class="inline-input">
                        <select class="full-col" name="investortype" id="investortype" required>
                            <option value="">Investor Type</option>
                            <option value="Individual Investor" {{ $userDetails[0]->investortype != null && $userDetails[0]->investortype == 'Individual Investor' ? 'selected="selected"' : '' }}>Individual Investor</option>
                            <option value="Business Corporate Investor" {{ $userDetails[0]->investortype != null && $userDetails[0]->investortype == 'Business Corporate Investor' ? 'selected="selected"' : '' }}>Business Corporate Investor</option>
                        </select>
                    </div>
                    <div class="inline-input">
                        <div class="filter-grid-intra multiple-dd" id="sl_interest">
                            <select multiple class="select_all" name="interestin[]" id="interestin">
                                @php
                                $tempInterest =explode(",",$userDetails[0]->interestin);
                                @endphp
                                <option value="Startup" {{ in_array('Startup',$tempInterest) ? 'selected="selected"' : '' }}>Startup</option>
                                <option value="Early Stage"{{ in_array('Early Stage',$tempInterest) ? 'selected="selected"' : '' }}>Early Stage</option>
                                <option value="Expansion"{{ in_array('Expansion',$tempInterest) ? 'selected="selected"' : '' }}>Expansion</option>
                            </select>
                        </div>
                    </div>
                    <div class="inline-input">
                        <!-- <select name="code">
                            @foreach($countrylist as $key => $value)
                                @php
                                $countrycode = "+".$value['phonecode'];
                                @endphp
                                <option value="+{{ $value['phonecode'] }}"  >{{ $value['name'] }}(+{{ $value['phonecode'] }})</option>
                            @endforeach
                        </select> -->
                        <input type="text" value="{{ $userDetails[0]->number != null ? $userDetails[0]->number : '' }}" name="mnumber" minlength="8" maxlength="12" id="mnumber" placeholder="Mobile Number *" class="valid" aria-invalid="false" onkeypress="return isNumber(event);">
                    </div>
                    <div class="inline-input">
                        <input type="text" name="altnumber" id="altnumber"  maxlength="15"  minlength="8" placeholder="Phone Number *" value="{{ $userDetails[0]->phone_number != null ? $userDetails[0]->phone_number : '' }}" onkeypress="return isNumber(event);"/>
                    </div>
                    <div class="inline-input">
                        <select class="full-col " id="country" name="country" >
                            <option value="" >Country *</option>
                            @foreach($countryname as $key => $value)
                            <option value="{{ $value['id'] }}" {{ $userDetails[0]->country != null && $userDetails[0]->country == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                            @endforeach                 
                        </select>
                    </div>
                    <div class="inline-input">
                        <select class="full-col state" id="state" name="state" >
                            <option value=""> State *</option>
                            @foreach($statelist as $key => $value)
                            <option value="{{ $value['id'] }}" {{ $userDetails[0]->state != null && $userDetails[0]->state == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inline-input">
                        <select class="full-col city" id="city" name="city">
                            <option value=""> City *</option>
                            @foreach($citylist as $key => $value)
                            <option value="{{ $value['id'] }}" {{ $userDetails[0]->city != null && $userDetails[0]->city == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inline-input">
                        <input type="text" value="{{ $userDetails[0]->pincode != null ? $userDetails[0]->pincode : '' }}" maxlength="12" name="pincode" id="pincode" placeholder="Pincode *" onkeypress="return isNumber(event);"/>
                    </div>
                    <div class="block-area" style="margin-left:10px ; padding: 0px;">
                        <textarea name="address" id="address" maxlength="100" placeholder="Address *" >{{ $userDetails[0]->address != null ? $userDetails[0]->address : '' }}</textarea>
                    </div>

                    <div class="inline-input">
                        <input type="text" name="website" placeholder="Website" value="{{ $userDetails[0]->website != null ? $userDetails[0]->website : '' }}"/>
                    </div>
                    <div class="inline-input">
                        <input type="email" name="email" id="email" placeholder="Email *" value="{{ $userDetails[0]->email != null ? $userDetails[0]->email : '' }}"/>
                    </div>

                    <div class="inline-input">
                        <input type="text" name="companyname" id="companyname"   maxlength="40" placeholder="Company Name" value="{{ $userDetails[0]->companyname != null ? $userDetails[0]->companyname : '' }}"/>
                    </div>
                    <div class="inline-input">
                        <select class="full-col" name="designation" id="designation">
                            <option value="">Designation *</option>
                            @foreach($designationlist as $key => $value)
                            <option value="{{ $value->short }}" {{ $userDetails[0]->designation != null && $userDetails[0]->designation == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="inline-input">
                        <div class="filter-grid-intra multiple-dd" id="sl_interest2">
                            <select multiple class="full-col select_all2" name="industry[]" id="industry">  
                                @php 
                                $temIndArr=explode(",",$userDetails[0]->industry);
                                @endphp

                                @foreach($industrylist as $key => $value)
                                <option value="{{ $value['id'] }}" {{ !empty($temIndArr) && in_array($value['id'],$temIndArr) ? 'selected' : '' }}>{{ $value['industry'] }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="inline-input">
                        <div class="filter-grid-intra multiple-dd" id="sl_interest3">
                            <select multiple class="select_all3" id="interested_country" name="interestedcountry[]">
                                @php
                                $tempIntCountry =explode(",",$userDetails[0]->interested_country);
                                @endphp

                                @foreach($countryname as $key => $value)
                                <option value="{{ $value['name'] }}" {{ in_array($value['name'],$tempIntCountry) ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                                @endforeach 
                            </select>   
                        </div>
                    </div>
                    <div class="inline-input" style="display:none">
                        <input type="text" name="gst" value="{{ $userDetails[0]->gst != null ? $userDetails[0]->gst : '' }}" placeholder="GST Number" />
                    </div>
                    <div class="block-area" style="margin-left:10px ; padding: 0px;">
                        <textarea name="introduction" id="introduction" placeholder="Introduction in 40 words" maxlength="250">{{ $userDetails[0]->intro != null ? $userDetails[0]->intro : '' }}</textarea>
                    </div>

                    <div class="block-area" style="margin-left:10px ; padding: 0px;">
                        <textarea name="companyintro" id="companyintro" maxlength="2500"  placeholder="Brief introduction about your company">{{ $userDetails[0]->company_intro != null ? $userDetails[0]->company_intro : '' }}</textarea>
                    </div>
                    <div class="inline-input">
                        <input type="text" class="inrformat"     name="min_investment_dis" id="min_investment_dis"  placeholder="Min Investment Offered *" value="{{ $userDetails[0]->min_investment != null ? $userDetails[0]->min_investment : '' }}" />
                       <input type="hidden" class="nomoneyformat"  name="min_investment"    id="min_investment" placeholder="Min Investment Offered *" value="{{ $userDetails[0]->min_investment != null ? $userDetails[0]->min_investment : '' }}" />
                    </div>
                    <div class="inline-input">
                        <input type="text"   class="inrformat"        name="max_investment_dis" id="max_investment_dis" placeholder="Max Investment Offered *" value="{{ $userDetails[0]->max_investment != null ? $userDetails[0]->max_investment : '' }}"/>
                        <input type="hidden" class="nomoneyformat"     name="max_investment"     id="max_investment"    placeholder="Max Investment Offered *" value="{{ $userDetails[0]->max_investment != null ? $userDetails[0]->max_investment : '' }}"/>
                    </div>

                    <div class="inline-input">
                        <input type="password" name="password" id="password" placeholder="New Password" value=""/>
                    </div>
                    <div class="inline-input">
                        <input type="password" value="" name="cpassword" id="cpassword" placeholder="Confirm Password" />
                    </div>




                    <div class="inline-input submit-reset" style="text-align: center;">
                        <input type="reset" class="reset-btn" />
                        <input type="submit" value="Submit Now" />
                    </div>
                </form>
            </div>
        </div>





    </div>
    <!--#include file="includes/footer.shtml"-->
</div>
@endsection
