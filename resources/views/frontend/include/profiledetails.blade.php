@php

$items = Session::get('logindata');
@endphp

<div class="profile-dashboard">
    <div class="table-div">
        <div class="table-cell profile-img">
            <form id="uploadForm" action="" method="post" >
                {{ csrf_field() }}
                <input type="file" id="image" classname="profileimage_new" style="display:none" onChange="submitForm()"/>
                <div class="img_container" onclick="updateimagefunction()"><center>
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
            @php
            $editroute='fund-raiser-dashborad';
            if($userDetails[0]->roles=='F')
            {
            $editroute='franchise';
            }
            @endphp


            @if($profiledata[0]->status == 0)
            <p>Status: Under Review <span>Profile Under<br/> Process/Review...</span></p>
            @elseif($profiledata[0]->status == 1)
            <p>Status: Hold <span>Profile Under<br/> Process/Review...</span></p>
            @else
            <p>Status: Active <span><br/></span></p>
            @endif
            <ul class="profile-cat">
                <li><a href="{{route($editroute) }}">Edit Profile</a></li>
                <!--<li><a href="{{ route('editprofilepic') }}" >Edit Profile Pic</a></li>-->
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
                <li><span>Recent Payment:</span> {{ $profiledata[0]->planname != '' ? $profiledata[0]->planname : "Not available" }}</li>
                <li><span>Location:</span> {{ $profiledata[0]->city }}, {{ $profiledata[0]->country }}</li>
            </ul>
        </div>
        <div class="table-cell profile-note">
            <p style="height: 150px"><span>Note: Attention Required</span> {{ $profiledata[0]->user_note }}</p>
            @if ($userDetails[0]->weunite_email!='')
            <div class="table-cell profile-info">
                <ul>
                    <li><span >Your WeUnite91 Email: </span>
                        <a style="color:blue" href="https://weunite91.com:2096/login/?user={{ $userDetails[0]->weunite_email }}" target="_blank">{{ $userDetails[0]->weunite_email }}</a>
                    </li>
                    <li>(Please check your registered email to know<br/>  WE UNITE 91 mail password.)</li>
                </ul>
            </div>
            @endif
            <ul class="profile-cat">
                <li><a href="javascript:;" id="popupVideo" data-toggle="modal" data-target="#uploadVideoModal">Upload Video</a></li>
                <li><a href="{{route("pitch-detail",$profiledata[0]->id) }}">View Profile</a></li>
                <li><a href="javascript:;"  class="deleteprofile" data-toggle="modal" data-id="{{ $profiledata[0]->id }}" data-target="#deletemodel">Delete Profile</a></li>
                <li><a href="javascript:;"  class="updatefinancialKPI" data-toggle="modal" data-id="{{ $profiledata[0]->id }}" data-target="#updatefinancialKPI">Update Financial KPI</a></li>

                <li>
                    @php
                    if($userDetails[0]->roles=='FR')
                    {
                    if(count($verifyResult)==1)
                    {
                    $verfy_status=$verifyResult[0]['status'];
                    if ($verfy_status=='Pending')
                    $verify_message='Your Business  will be verified in few days.';
                    else if ($verfy_status=='Verified')
                    $verify_message='Your Business  verified Successfully.';
                    else if ($verfy_status=='')
                    $verify_message='';
                    else
                    $verify_message='Your Business  not able to verified.';

                    }
                    }
                    @endphp
                    @if($userDetails[0]->country != null)
                    @if($userDetails[0]->roles=='FR')
                    @if ((count($verifyResult)==1)&&($verify_message!=''))

                    {{$verify_message}}
                    @else
                    <a href="#"  class="verificationprofile" data-target="#verficationModal"
                       data-id="{{ $profiledata[0]->id }}">
                        Verify Business
                    </a>
                    @endif
                    @endif
                    @endif
                </li>

            </ul>
        </div>
        <div class="table-cell profile-info-invest">

            <div class="profile-info-invest-intra">
                <ul>
                    <li>
                        <div class="table-cell">Raising Finance / Business </div>
                    </li>
                    <li>
                        <div class="table-cell">Industry :</div>
                        <div class="table-cell">{{ $profiledata[0]->industry }}</div>
                    </li>
                    <li>
                        <div class="table-cell">Investment Required :</div>
                        <div class="table-cell"> INR {{ indian_money_format($profiledata[0]->min_investment) }} - INR {{ indian_money_format($profiledata[0]->max_investment) }}</div>
                    </li>

                    <li>
                        <div class="table-cell">Minimum Investment Accepted :</div>
                        <div class="table-cell"> INR {{ indian_money_format($profiledata[0]->min_investment_accepated) }}</div>
                    </li>
                    <li>
                        <div class="table-cell">Pitch Deck Valid till :</div>
                        <div class="table-cell">
                            @if($profiledata[0]->days !='')
                            @php
                            $date=date_create($profiledata[0]->active_date);
                            date_add($date,date_interval_create_from_date_string($profiledata[0]->days.'days'));
                            $valid_till=date_format($date,"d/M/Y");
                            @endphp
                            {{$valid_till}}
                            @endif
                        </div>
                    </li>


                    @if($payment_details->count() ==1)
                    @if($profiledata[0]->status < 2)
                    <li>
                        <div class="table-cell gps-icon">The invoice will be generated upon the approval of your pitch within 7 working days.</div>
                    </li>
                    @else
                    @if ($payment_details[0]->invoice_id==null)
                    <li>
                        <div class="table-cell gps-icon">
                            <a href="{{route("generate-invoice",$payment_details[0]->transaction_id) }}"><img src="image/pdf-icon.png" alt=""/>
                                Generate Invoice</a>
                        </div>
                    </li>
                    @else
                    <li>
                        <div class="table-cell gps-icon">Invoice:</div>
                        <div class="table-cell"><a href="#" download><img src="image/pdf-icon.png" alt=""/>
                                Download</a></div>
                    </li>
                    @endif
                    @endif
                    @endif
                </ul>

            </div><br>
            <div class="profile-info-invest-intra">
                <ul>
                    <li>
                        <div class="table-cell">Exclusive introductions of your profile to investors (Via Email) :  <strong> {{ $profiledata[0]->count }} </strong><br>

                        </div>

                    </li>

                </ul>

            </div>

        </div>
    </div>
</div>
@if($userDetails[0]->country != null)
@if($userDetails[0]->roles=='FR')
@include('frontend.pages.dashboard.fundraiser.verfication_details')
@endif
@endif


<div class="modal fade " id="uploadVideoModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Upload Video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="kpi-table-info">
                    <div class="kpi-table-info-intra" style="height: 100%"><br>

                        <form id="videoUpload" name="videoUpload" action="{{ route("upload-video") }}" method="post" enctype="multipart/form-data">
                            <div class="block-area">@csrf
                                <input type="file" class="upload_video" name="upload_video" id="upload_video" accept="video/*" >
                            </div>
                            <div class="submit-reset"><br>
                                <center>
                                    <input type="submit" class="submitbtn" id="submitform" value="submit"  />
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="updatefinancialKPI">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <!-- Modal Header -->
            <div class="modal-header">
                <p>Important Tip : Chances of getting the investment incresses by 95 % if your Finacial KPI is accessible to the investors </p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="kpi-table-info">
                    <div class="kpi-table-info-intra" ><br>
                        <center>
                            <p><b>For any kind of financial assistant please <a href="javascript:;" data-toggle="modal" data-target="#kpiModal" style="color: blue"> click here </a></b></p>

                            <h4 class="modal-title">Financial KPI </h4>
                            <h5><span> (Key Performance Indicators)</span></h5>
                            <p>All the fields are not compulsory</p>

                        </center>

                        <form id="kpiupdateform" name="kpiupdateform" action="{{ route("kpi-update") }}" method="post" enctype="multipart/form-data"> @csrf
                            <div class="row">
                                <div class="inline-input  col-3" style="min-width: 330px; margin-top: 10px; margin-bottom: 10px; margin-left: 10px;">
                                    <label>
                                        Return on Investment (ROI)
                                    </label>
                                    <input type="number" name="roi" id="roi" maxlength="3"   value="{{ $details[0]->roi != null ? $details[0]->roi : '' }}"  placeholder="%" />
                                </div>

                                <div class="inline-input  col-3" style="min-width: 330px; margin-top: 10px; margin-bottom: 10px; margin-left: 10px;">
                                    <label>
                                        Cost of Capital (Offered)
                                    </label>
                                    <input type="number" id="coc" name="coc" maxlength="3"   value="{{ $details[0]->cop != null ? $details[0]->cop : '' }}"  placeholder="%" />
                                </div>

                                <div class="inline-input  col-3" style="min-width: 330px; margin-top: 10px; margin-bottom: 10px; margin-left: 10px;">
                                    <label>
                                        Promotors Investment
                                    </label>
                                    <input type="text" class="inrformat" onkeypress="return isNumber(event);"  id="pi_dis" name="pi_dis" maxlength="15"    value="{{ $details[0]->pi != null ? $details[0]->pi : '' }}"  placeholder="INR" />
                                    <input type="hidden" class="nomoneyformat"  id="pi" name="pi" maxlength="15"    value="{{ $details[0]->pi != null ? $details[0]->pi : '' }}"  placeholder="INR" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="inline-input  col-3" style="min-width: 330px; margin-top: 10px; margin-bottom: 10px; margin-left: 10px;">
                                    <label>
                                        Assured Minimum Dividend<br>
                                    </label>
                                    <input type="number" id="amd" name="amd" maxlength="3"     value="{{ $details[0]->dividend != null ? $details[0]->dividend : '' }}"  placeholder="%" />
                                </div>

                                <div class="inline-input  col-3" style="min-width: 330px; margin-top: 10px; margin-bottom: 10px; margin-left: 10px;">
                                    <label>
                                        Fixed Assests<br>
                                    </label>
                                    <input type="tex" class="inrformat" onkeypress="return isNumber(event);" id="fa_dis" name="fa_dis" maxlength="15"    value="{{ $details[0]->fa != null ? $details[0]->fa : '' }}"  placeholder="INR" />
                                    <input type="hidden" class="nomoneyformat" onkeypress="return isNumber(event);" id="fa" name="fa" maxlength="15"    value="{{ $details[0]->fa != null ? $details[0]->fa : '' }}"  placeholder="INR" />
                                </div>

                                <div class="inline-input  col-3" style="min-width: 330px; margin-top: 10px; margin-bottom: 10px; margin-left: 10px;">
                                    <label>
                                        EBITDA<br>
                                    </label><br>
                                    <input type="number" id="ebitda" name="ebitda" maxlength="3"   value="{{ $details[0]->ebitda != null ? $details[0]->ebitda : '' }}"  placeholder="%" />
                                </div>
                            </div>

                            <br>
                            <div class="modal-footer center">
                                <input type="reset" class="btn"/>
                                <input type="submit" class="btn btn-primary submitbtn" style="background-color:#fce32a !important" id="submitform" value="submit" />

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="kpiModal" ria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">For any kind of financial assistant</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="kpi-table-info">
                    <div class="kpi-table-info-intra" style="height: 100%"><br>
                        <p><b>For any kind of financial assistant please write in the below box and we will revert to you.</b></p>
                        <form name="" action="{{ route("kpi-help") }}" method="post" enctype="multipart/form-data" id="kpiHelp">
                            <div class="block-area">@csrf
                                <textarea name="support" id="supportkpi" placeholder="" maxlength="1000" style="margin: 0px;"></textarea>
                            </div>
                            <div class="submit-reset">
                                <center>
                                    <input type="submit" id="submitform" value="submit"  />
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

