@extends('frontend.layout.layout')
@section('content')
    <div id="Container">
        <!--#include file="includes/header.shtml"-->
        <div class="main-container">

            <div class="profile-dashboard">
                <div class="table-div">
                    <div class="table-cell profile-img">
                        <form id="uploadForm" action="" method="post" >
                        {{ csrf_field() }}
                            <input type="file" id="image" classname="profileimage_new" style="display:none" onChange="submitForm()"/>
                            <div class="img_container" onclick="updateimagefunction()">
                                <center>
                                    @if($profiledata[0]->user_image == null || $profiledata[0]->user_image == ''   )
                                        <img src="{{asset('public/frontend')}}/image/kiran.jpg" alt=""/>
                                    @else
                                        <img src="{{ asset('public/upload/userprofile/'.$profiledata[0]->user_image) }}" alt=""/>
                                    @endif
                                </center>
                                <div class="middle">
                                    <div class="text">Click to Change Picture</div>
                                </div>
                            </div>
                        </form>
                        @if($profiledata[0]->status == 0)
                            <p>Status: Under Review <span>Profile Under<br/> Process/Review...</span></p>
                        @elseif($profiledata[0]->status == 1)
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
                            <li>
                            <span>Name: </span> {{ $profiledata[0]->firstname }} {{ $profiledata[0]->lastname }}
                        </li>
                        <li>
                                <span>Email:</span> {{ $profiledata[0]->email }}
                        </li>
                        <li><span>Profile Code:</span> {{ $profiledata[0]->profile_code }}
                        </li>
                        <li>
                            <span>Joined Date:</span> {{ date("d-m-Y",strtotime($profiledata[0]->join_date)) }}
                        </li>
                        <li><span>Recent Payment:</span></li>
                        <li><span>Location:</span> {{ $profiledata[0]->city }}, {{ $profiledata[0]->country }}</li>
                        </ul>
                    </div>
                    <div class="table-cell profile-note">
                        <p style="height: 150px"><span>Note: Attention Required</span> {{ $profiledata[0]->user_note }}</p>
                        <ul class="profile-cat">
                            <li><a href="">Update Pitch Deck</a></li>
                            <li><a href="">View Profile</a></li>
                            <li><a href="#"  class="deleteprofile" data-toggle="modal" data-id="{{ $profiledata[0]->id }}" data-target="#deletemodel">Delete Profile</a></li>
                        </ul>
                    </div>
                    <div class="table-cell profile-info-invest">

                        <div class="profile-info-invest-intra">
                            <ul>
                                <li><div class="table-cell">Channel Partner:</div><div class="table-cell"> </div></li>
                                <li><div class="table-cell">Partner:</div><div class="table-cell"> Channel Partner</div></li>
                                <li><div class="table-cell">Date of Joining:</div><div class="table-cell"> 19 - Aug - 2019</div></li>
                                <li><div class="table-cell">Validity Till:</div><div class="table-cell"> 3-8-2019</div></li>
                                
                                <li><div class="table-cell gps-icon">Invoice:</div><div class="table-cell"> <a href="#" download><img src="image/pdf-icon.png" alt="" /> Download</a></div></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>















            <div class="partner-summary responsive-table">
                <div class="filter-business">
                    <form>
                        <div class="filter-intra">
                            <label>From</label><input type="date" name="" />
                        </div>
                        <div class="filter-intra">
                            <label>To</label><input type="date" name="" />
                        </div>
                        <div class="filter-intra">
                            <input type="submit" value="Search" class="search-icon" />
                        </div>
                    </form>
                </div>
                <table>
                    <thead>
                    <tr>
                        <th scope="col" class="sr-th">SR. No</th>
                        <th scope="col">Profile Code</th>
                        <th scope="col">Plan</th>
                        <th scope="col">Fund Raised</th>
                        <th scope="col">Commision Gained (In INR)</th>
                        <th scope="col">Profile Status</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody class="pagination-rows">
                    <tr>
                        <td  scope="row" data-label="SR. No">1</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">2</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">3</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">4</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">5</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">6</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">7</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">8</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">9</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    <tr>
                        <td  scope="row" data-label="SR. No">10</td>
                        <td data-label="Profile Code">I-AB0003293</td>
                        <td data-label="Plan">ABC</td>
                        <td data-label="Fund Raised">10,00,00,000</td>
                        <td data-label="Profile Status">36000</td>
                        <td data-label="Commision Gained (In INR)">Active</td>
                        <td data-label="Date">21-Aug-2019</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div id="pagination-container"></div>


            <div id="bargraph">
                <div class="chart">
                    <div class="formtitle">Revenue</div>
                    <table id="data-table" border="1" cellpadding="10" cellspacing="0" summary="skillset">
                        <thead>
                        <tr>
                            <td>&nbsp;</td>
                            <th scope="col">Sept 18</th>
                            <th scope="col">Oct 18</th>
                            <th scope="col">Nov 18</th>
                            <th scope="col">Dec 18</th>
                            <th scope="col">Jan 19</th>
                            <th scope="col">Feb 19</th>
                            <th scope="col">March 19</th>
                            <th scope="col">April 19</th>
                            <th scope="col">May 19</th>
                            <th scope="col">June 19</th>
                            <th scope="col">July 19</th>
                            <th scope="col">Aug 19</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>90</td>
                            <td>50</td>
                            <td>80</td>
                            <td>95</td>
                            <td>80</td>
                            <td>55</td>
                            <td>85</td>
                            <td>95</td>
                            <td>75</td>
                            <td>85</td>
                            <td>95</td>
                            <td>90</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>




            <div class="forms">
                <div class="contact-form">
                    <div class="formtitle">Profile</div>
                    <form action="" method="post" enctype="multipart/form-data" id="partnerdetails">{{ csrf_field() }}
                        <div class="inline-input">
                                <input type="text" name="firstname" id="firstname" placeholder="First Name *" maxlength="20" value="{{ $userDetails[0]->firstname != null ? $userDetails[0]->firstname : '' }}"/>
                        </div>
                        <div class="inline-input">
                                <input type="text" name="lastname" id="lastname" placeholder="Last Name *" value="{{ $userDetails[0]->lastname != null ? $userDetails[0]->lastname : '' }}"  maxlength="20"  />
                        </div>
                        <div class="inline-input">
                            <select class="full-col" name="designation" id="designation">
                                <option value="">Designation *</option>
                                @foreach($designationlist as $key => $value)
                                    <option value="{{ $value->de_id}}" {{ $userDetails[0]->designation != null && $userDetails[0]->designation == $value->de_id ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="inline-input">
                                <input type="email" name="email" id="email" placeholder="Email *" value="{{ $userDetails[0]->email != null ? $userDetails[0]->email : '' }}"/>
                        </div>
                        <div class="inline-input">
                                <input type="text" name="company"   maxlength="40" placeholder="Company Name" value="{{ $userDetails[0]->companyname != null ? $userDetails[0]->companyname : '' }}"/>
                        </div>
                        
                        <div class="inline-input">
                                <input type="text" name="website" placeholder="Website" value="{{ $userDetails[0]->website != null ? $userDetails[0]->website : '' }}"/>
                        </div>

                        <div class="inline-input">
                            
                            <input type="text" value="{{ $userDetails[0]->number != null ? $userDetails[0]->number : '' }}" name="mnumber" minlength="8" maxlength="12" id="mnumber" placeholder="Mobile Number *" class="valid " onkeypress="return isNumber(event);" aria-invalid="false">
                        </div>
                        <div class="inline-input ">
                            
                            <input type="text" name="altnumber" id="altnumber"  maxlength="15"  minlength="8" placeholder="Phone Number *" value="{{ $userDetails[0]->phone_number != null ? $userDetails[0]->phone_number : '' }}" onkeypress="return isNumber(event);"/>
                        </div>
                        <div class="block-area" style="margin-left:10px ; padding: 0px;">
                            <textarea name="address" id="address" maxlength="250" placeholder="Address *" >{{ $userDetails[0]->address != null ? $userDetails[0]->address : '' }}</textarea>
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
                        <div class="inline-input" style="width: 94%;">
                            <input type="text" name="gst" value="{{ $userDetails[0]->gst != null ? $userDetails[0]->gst : '' }}" placeholder="GST Number" />
                        </div>
                        <div class="block-area" style="margin: 10px 28px 0 auto;"> 
                            <textarea name="introduction" id="introduction" placeholder="Introduction in 40 words" maxlength="300">{{ $userDetails[0]->intro != null ? $userDetails[0]->intro : '' }}</textarea>
                        </div>
                        <div class="block-area" style="margin: 10px 28px 0 auto;">
                           <textarea name="companyintro" id="companyintro" maxlength="2500"  placeholder="Brief introduction about your company">{{ $userDetails[0]->company_intro != null ? $userDetails[0]->company_intro : '' }}</textarea>
                        </div>
                        <div class="inline-input">
                                <input type="password" name="password" id="password" placeholder="New Password" value=""/>
                        </div>
                        <div class="inline-input">
                                <input type="password" value="" name="cpassword" id="cpassword" placeholder="Confirm Password" />
                        </div>




                        <div class="inline-input submit-reset">
                            <center>
                                <input type="reset" class="reset-btn" />
                                <input type="submit" class="submitbtn" name="submit" value="Submit Now" />
                            </center>
                        </div>
                    </form>
                </div>
            </div>




            <!-- <button id="myBtn">Open Modal</button> -->
        </div>
        <!--#include file="includes/footer.shtml"-->
    </div>
@endsection
