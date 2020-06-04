@extends('frontend.layout.layout')
@php

$items = Session::get('logindata');
@endphp
@section('content')
    <style>
        .alert {
            padding: 20px;
            background-color: #4CAF50;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>

    <!--#include file="includes/header.shtml"-->
    <div class="main-container">
        @if(Session::has('success'))
        <div class="alert success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>{{ Session::get('success') }} !</strong>
        </div>
        @endif
        @include('frontend.include.profiledetails')


        <div class="investment-summary responsive-table">
            <table>
                <thead>
                <tr>
                    <th scope="col" class="sr-th">SR. No</th>
                    <th scope="col">Investors</th>
                    <th scope="col">Investment Offered</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalamount=0;
                    $cnt=1;
                @endphp
                @foreach($investment_offerd as $key => $value)
                @php
                    $totalamount+=$value->ammount;
                @endphp
                <tr>
                    <td scope="row" data-label="SR. No">{{$cnt}}</td>
                    <td data-label="Investors">{{$value->profile_code}}</td>
                    <td data-label="Investment Offered">INR {{$value->ammount}}</td>
                </tr>
                @php
                    $cnt++;
                @endphp
               @endforeach
                </tbody>
            </table>
        </div>
        <div class="progressbar profile-progress">

            @if($profiledata[0]->max_investment > 0 && $profiledata[0]->max_investment !='')
                @php
                    $width=($totalamount*100)/$profiledata[0]->max_investment;
                @endphp
                @if($width <= 100)
                    @php $width=$width; @endphp
                @else
                    @php $width=100; @endphp
                @endif
            @else
                @php
                    $width=0;
                @endphp
            @endif
            <div class="progressbar-intra" data-width="{{round($width)}}">
                <span><b></b></span>
            </div>
        </div>

        <hr>


        <div class="forms">
			<div class="contact-form">
                            <div class="formtitle"><center>Fundraise</center></div>


				<ul class="steps-btn">
					<li ><a href="{{ route('franchise') }}">Step 1</a></li>
					<li class="active"><a href="{{ route('franchise-details') }}">Step 2</a></li>
					<li><a href="{{ route('franchise-planlist')}}">Step 3</a></li>
				</ul>



				<form name="" action="" method="post" enctype="multipart/form-data" id="frdetails">
                {{ csrf_field() }}
                    @if($details[0]->first_active=='1')
                    <div class="three-grid-inline-input">
                                    <div class="inline-input">
                                    Min Investment Range: <br/> INR {{ $details[0]->min_investment != null ? indian_money_format($details[0]->min_investment) : '' }}

                                    </div>
                                    <div class="inline-input">
                                    Max Investment Range: <br/>INR {{ $details[0]->max_investment != null ? indian_money_format($details[0]->max_investment) : '' }}
                                    </div>

                                </div>
                    @else
                    <div >
                                    <div class="inline-input">
                                    <label>Minimum INVESTMENT RANGE</label>
                                        <input type="text"      class="inrformat"  name="min_investment_dis" id="min_investment_dis" onkeypress="return isNumber(event);" minlength="6" maxlength="15" placeholder="Min Investment Range *" value="{{ $details[0]->min_investment != null ? $details[0]->min_investment : '' }}"/>
                                         <input type="hidden" class="nomoneyformat" name="min_investment" id="min_investment" onkeypress="return isNumber(event);" minlength="6" maxlength="11" placeholder="Min Investment Range *" value="{{ $details[0]->min_investment != null ? $details[0]->min_investment : '' }}"/>
                                    </div>
                                    <div class="inline-input">
                                    <label>Maximum INVESTMENT RANGE</label>
                                            <input type="text"  class="inrformat"      name="max_investment_dis" id="max_investment_dis" onkeypress="return isNumber(event);" minlength="6" maxlength="15" placeholder="Max Investment Range *"  value="{{ $details[0]->max_investment != null ? $details[0]->max_investment : '' }}"/>
                                            <input type="hidden" class="nomoneyformat" name="max_investment" id="max_investment" onkeypress="return isNumber(event);" minlength="6" maxlength="11" placeholder="Max Investment Range *"  value="{{ $details[0]->max_investment != null ? $details[0]->max_investment : '' }}"/>
                                    </div>

                                </div>
                    @endif

                    <div >
                        <div class="inline-input">
                        <label>Minimum SFT</label>
                            <input type="text"      class="inrformat"  name="min_sft_dis" id="min_sft_dis" onkeypress="return isNumber(event);" minlength="3" maxlength="6" placeholder="Min SFT Required *" value="{{ $details[0]->min_sft != null ? $details[0]->min_sft : '' }}"/>
                                <input type="hidden" class="nomoneyformat" name="min_sft" id="min_sft" onkeypress="return isNumber(event);" minlength="3" maxlength="6" placeholder="Min SFT Required *" value="{{ $details[0]->min_sft != null ? $details[0]->min_sft : '' }}"/>
                        </div>
                        <div class="inline-input">
                        <label>Maximum SFT</label>
                                <input type="text"  class="inrformat"      name="max_sft_dis" id="max_sft_dis" onkeypress="return isNumber(event);" minlength="3" maxlength="6" placeholder="Max SFT Required *"  value="{{ $details[0]->max_sft != null ? $details[0]->max_sft : '' }}"/>
                                <input type="hidden" class="nomoneyformat" name="max_sft" id="max_sft" onkeypress="return isNumber(event);" minlength="3" maxlength="6" placeholder="Max SFT Required *"  value="{{ $details[0]->max_sft != null ? $details[0]->max_sft : '' }}"/>
                        </div>

                    </div>


                                <div class="block-area">
                                        <label>Unique Selling Point(USP) About your Product/Company/Project</label>
                                </div>


                                <div class="block-area usp-height">
                                        <label>USP 1.</label>
                                        <textarea name="usp1" id="usp1" placeholder="In 150 Words *" maxlength="150">{{ $details[0]->usp1 != null ? $details[0]->usp1 : '' }}</textarea>
                                </div>

                                <div class="block-area usp-height">
                                        <label>USP 2.</label>
                                        <textarea name="usp2" id="usp2" placeholder="In 150 Words *" maxlength="150">{{ $details[0]->usp2 != null ? $details[0]->usp2 : '' }}</textarea>
                                </div>

                                <div class="block-area usp-height">
                                        <label>USP 3.</label>
                                        <textarea name="usp3" id="usp3" placeholder="In 150 Words" maxlength="150">{{ $details[0]->usp3 != null ? $details[0]->usp3 : '' }}</textarea>
                                </div>

                                <div class="block-area usp-height">
                                        <label>USP 4.</label>
                                        <textarea name="usp4" id="usp4" placeholder="In 150 Words" maxlength="150">{{ $details[0]->usp4 != null ? $details[0]->usp4 : '' }}</textarea>
                                </div>

                                <div class="block-area">
                                        <label>Introduction</label>
                                        <textarea name="introduction" id="introduction" placeholder="Introduce Your Self / Company / Product (In 40 Words Only) *" maxlength="300">{{ $details[0]->intro != null ? $details[0]->intro : '' }}</textarea>
                                </div>
                                <div class="block-area">
                                        <label>Idea</label>
                                        <textarea name="idea" id="idea" placeholder="Describe your business (In 2200 Words Only) *" maxlength="2200">{{ $details[0]->idea != null ? $details[0]->idea : '' }}</textarea>
                                </div>
                                <div class="block-area">
                                        <label>Team Overview</label>
                                        <textarea name="team_overview" id="team_overview" placeholder="About your team members (In 700 Words Only) *"  maxlength="700">{{ $details[0]->team != null ? $details[0]->team : '' }}</textarea>
                                </div>

                                <div class="inline-input">
                                        <input type="text" name="member1" id="member1" onkeypress="return alphaOnly(event);" placeholder="Team Member 1 *" maxlength="30" value="{{ $details[0]->team_mem1 != null ? $details[0]->team_mem1 : '' }}"/>
                                </div>

                                <div class="inline-input">
                                    <select class="full-col" name="position1" id="position1">
                                        <option value="">Designation *</option>
                                        @foreach($designationlist as $key => $value)
                                            <option value="{{ $value->short}}" {{ $details[0]->team_mem_deg1 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="inline-input">
                                        <input type="text" name="member2" id="member2" maxlength="30" onkeypress="return alphaOnly(event);"  placeholder="Team Member 2" value="{{ $details[0]->team_mem2 != null ? $details[0]->team_mem2 : '' }}"/>
                                </div>

                                <div class="inline-input">
                                    <select class="full-col" name="position2" id="position2">
				                       <option value="">Designation *</option>
                                        @foreach($designationlist as $key => $value)
                                            <option value="{{ $value->short}}" {{ $value->de_id}}" {{ $details[0]->team_mem_deg2 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="inline-input">
                                        <input type="text" name="member3" id="member3" onkeypress="return alphaOnly(event);"  placeholder="Team Member 3" maxlength="30"  value="{{ $details[0]->team_mem3 != null ? $details[0]->team_mem3 : '' }}"/>
                                </div>

                                <div class="inline-input">
                                    <select class="full-col" name="position3" id="position3">
                                        <option value="">Designation *</option>
                                        @foreach($designationlist as $key => $value)
                                            <option value="{{ $value->short}}" {{ $value->de_id}}" {{ $details[0]->team_mem_deg3 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="inline-input">
                                        <input type="text" name="member4" id="member4" onkeypress="return alphaOnly(event);"  maxlength="30"  placeholder="Team Member 4" value="{{ $details[0]->team_mem4 != null ? $details[0]->team_mem4 : '' }}"/>
                                </div>

                                <div class="inline-input">
                                    <select class="full-col" name="position4" id="position4">
                                        <option value="">Designation *</option>
                                        @foreach($designationlist as $key => $value)
                                            <option value="{{ $value->short}}" {{ $value->de_id}}" {{ $details[0]->team_mem_deg4 == $value->short ? 'selected="selected"' : '' }}>{{ $value->de_designation}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="block-area">
                                         <label>Upload Picture of your team member</label>
                                         <input type="file" class="team_change" name="member_picture" id="member_picture"  value="">

                                </div>


                                <div class="block-area">
                                         <label>Upload images of your Product/Company/Project (Maximum 10 Files)</label>
                                         <input type="file" class="fileinput" name="mul_imgs[]" multiple="multiple"  id="mul_imgs" value="">

                                </div>

                                <div class="block-area">
                                         <label>Upload Video</label>
                                         <input type="file" class="video_change" name="up_video" id="up_video"  value="">

                                </div>


                                <div class="block-area" style="display:none">
                                         <label class="textcenter kpc-title">Financial KPI <span> (Key Performance Indicators)</span></label>
                                </div>

                                    <div class="kpi-table" style="display:none">
                                        <div class="kpi-table-intra">
                                            <div class="inline-input contact-no">
                                                <label>
                                                        Return of Investment (ROI)
                                                </label>
                                                <input type="number" name="roi" id="roi" maxlength="3"   value="{{ $details[0]->roi != null ? $details[0]->roi : '' }}"  placeholder="%" />
                                            </div>

                                            <div class="inline-input contact-no">
                                                <label>
                                                    Cost of Capital (Offered)
                                                </label>
                                                <input type="number" id="coc" name="coc" maxlength="3"   value="{{ $details[0]->cop != null ? $details[0]->cop : '' }}"  placeholder="%" />
                                            </div>

                                            <div class="inline-input contact-no">
                                                    <label>
                                                            Promotors Investment
                                                    </label>
                                                    <input type="text" class="inrformat" onkeypress="return isNumber(event);"  id="pi_dis" name="pi_dis" maxlength="11"    value="{{ $details[0]->pi != null ? $details[0]->pi : '' }}"  placeholder="INR" />
                                                    <input type="hidden" class="nomoneyformat"  id="pi" name="pi" maxlength="11"    value="{{ $details[0]->pi != null ? $details[0]->pi : '' }}"  placeholder="INR" />
                                            </div>

                                            <div class="inline-input contact-no">
                                                    <label>
                                                            Assured Minimum Dividend
                                                    </label>
                                                    <input type="number" id="amd" name="amd" maxlength="3"     value="{{ $details[0]->dividend != null ? $details[0]->dividend : '' }}"  placeholder="%" />
                                            </div>

                                            <div class="inline-input contact-no">
                                                    <label>
                                                            Fixed Assests
                                                    </label>
                                                    <input type="tex" class="inrformat" onkeypress="return isNumber(event);" id="fa_dis" name="fa_dis" maxlength="11"    value="{{ $details[0]->fa != null ? $details[0]->fa : '' }}"  placeholder="INR" />
                                                    <input type="hidden" class="nomoneyformat" onkeypress="return isNumber(event);" id="fa" name="fa" maxlength="11"    value="{{ $details[0]->fa != null ? $details[0]->fa : '' }}"  placeholder="INR" />
                                            </div>

                                            <div class="inline-input contact-no">
                                                    <label>
                                                            EBITDA
                                                    </label>
                                                    <input type="number" id="ebitda" name="ebitda" maxlength="3"   value="{{ $details[0]->ebitda != null ? $details[0]->ebitda : '' }}"  placeholder="%" />
                                            </div>

                                        </div>
						<div class="kpi-table-info">
							<div class="kpi-table-info-intra" style="height: 100%"><br>
                                <p><b>For any kind of financial assistant please write in the below box and we will revert to you.</b></p>
                                <div class="block-area">

                                    <textarea name="support" id="supportkpi" placeholder="" maxlength="1000" style="margin: 0px;"></textarea>
                                </div>
                                <div class="submit-reset">
                                   <center> <input type="buttion" id="csubmit" value="submit"  /></center>

                                </div>

							</div>
						</div>
					</div>


					<div class="block-area preview-form">
						<p><a href="#" data-toggle="modal" data-target="#myModal" class="preview_pitch">Preview Your Pitch</a></p>
					</div>

					<div class="block-area">
						 <label class="textcenter tc-policy">
						  <input type="checkbox" name="terms" value="1" class="agree-box" {{ $details[0]->terms_con == "Yes" ? 'checked="checked"' : '' }}>I agree to the <a href="#">Terms and Conditions</a> &amp; <a href="#">Privacy Policy</a>
						 </label>
					</div>


					<div class="inline-input submit-reset">
						<center><input type="reset" class="reset-btn" />
                                                    <input type="submit" class="submitbtn" name="submit" value="Submit Now" /></center>
					</div>
				</form>
			</div>
	</div>

    </div>



    <div id="popupOTP" class="overlayPOP">
        <div class="popup popup-enquiry">
            <div class="popupTitle">Please enter the 6-digit verification code sent to registered email id.</div>
            <a class="close" href="#">&times;</a>
            <div id="form">
                <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}"/>
                <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}"/>
                <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}"/>
                <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}"/>
                <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}"/>
                <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}"/>
                <button class="btn btn-primary btn-embossed">Verify</button>
            </div>
            <a href="#" class="send-code-text">Send code again</a>
        </div>
    </div>

<style>
    .product_view .modal-dialog{max-width: 1100px; width: 1100px;}
        .pre-cost{text-decoration: line-through; color: #a5a5a5;}
        .space-ten{padding: 10px 0;}
</style>

<div class="modal fade product_view" id="myModal">
        <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">PREVIEW</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="table-div">
                    <div id="Content" class="table-cell">
                        <article class="textMain ">
                            <div class="textmain-intra">
                                <div class="detailed-pitch-l-intra">
                                    <div class="detailed-pitch-in-blk">
                                        @if($details[0]->imagename !='')
                                            <img src="{{ asset('public/upload/company_details').'/'.$details[0]->imagename }}" alt="" id="change_overview" height="372" width="983"/>
                                        @else
                                            <img src="{{ asset('public/frontend/image/no-image.png') }}" alt="" id="change_overview" height="372" width="983"/>
                                        @endif
                                        <div class="floating-payment">
                                            <form action="pay-now.php">
                                                <label data-tip="Min Invest Accepted">
                                                    <input type="number" name="" placeholder="INR 10,00,00,000" id="pre_min_accept" value="{{$details[0]->min_investment}}" readonly>
                                                </label>
                                                <input type="button" class="submit-now" name="" value="Offer Now" readonly>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="table-div detailed-pitch-grid">

                                    <div class="table-cell add-fav">
                                        <a href="#">Add to Favourites</a>
                                    </div>

                                    <div class="table-cell detailed-pitch-info">
                                        <ul>
                                            <li class="target-dp">
                                                Target <curreny><exchange>INR</exchange> <exvalue>0</exvalue></curreny>
                                            </li>
                                            <li>
                                                <div class="progressbar home-progress">
                                                    <div class="progressbar-intra" data-width="0%">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="detailed-pitch-info-grid">
                                            <li class="funded-icon"><span>0 :</span> Offered</li>
                                            <li><span>0 :</span> Investors</li>
                                        </ul>
                                    </div>

                                    <div class="table-cell days-left">
                                       <p class="contact-btn"> <a href="#" >Contact Business</a><p>
                                        <p> Days Left</p>
                                    </div>

                                </div>


                                <div class="table-div detailed-pitch-intro">

                                    <div class="table-cell dpi-l">
                                        <div class="title">Introduction</div>
                                        <p id="pre_intro">{{ $details[0]->intro }}</p>
                                    </div>

                                    <div class="table-cell dpi-r">
                                        <ul>
                                        @if($details[0]->usp1 !='')
                                            <li id="pre_usp1">{{ $details[0]->usp1  }}</li>
                                        @else
                                        <li id="pre_usp1" style="display: none"></li>
                                        @endif

                                        @if($details[0]->usp2 !='')
                                            <li id="pre_usp2">{{ $details[0]->usp2  }}</li>
                                        @else
                                            <li id="pre_usp2" style="display: none"></li>
                                        @endif

                                        @if($details[0]->usp3 !='')
                                            <li id="pre_usp3">{{ $details[0]->usp3  }}</li>
                                        @else
                                            <li id="pre_usp3" style="display: none"></li>
                                        @endif

                                        @if($details[0]->usp4 !='')
                                            <li id="pre_usp4">{{ $details[0]->usp4  }}</li>
                                        @else
                                            <li id="pre_usp4" style="display: none"></li>
                                        @endif
                                        </ul>
                                    </div>

                                </div>

                                <div class="table-div detailed-pitch-idea">
                                    <div class="table-cell dpi-idea-l">
                                        <div class="title">Idea</div>
                                        <p id="pre_idea">{{ $details[0]->idea  }}</p>
                                        <div class="title">Team Overview</div>
                                        <p id="pre_overview">{{ $details[0]->team  }}</p>

                                    </div>

                                    <div class="table-cell dpi-idea-r">

                                        <div class="videoBorder">
                                            @if($details[0]->video !='')
                                                <video width="400" controls>
                                                    <source id="pre_video_change" src="{{ asset('public/upload/video').'/'.$details[0]->video}}">
                                                  Your browser does not support HTML5 video.
                                                </video>
                                            @else
                                                <video width="400" controls>
                                                    <source id="pre_video_change" src="vedios/cement-demo.webm" type="video/webm">
                                                    Your browser does not support HTML5 video.
                                                </video>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="table-div detailed-pitch-team">
                                    <div class="table-cell dpi-team-l">
                                        @if($details[0]->member_image !='')
                                            <img id="pre_team_change" width="502" height="342" src="{{ asset('public/upload/team_member').'/'.$details[0]->member_image }}" alt="">
                                        @else
                                            <img id="pre_team_change" width="502" height="342" src="{{ asset('public/frontend/image/no-image.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="table-cell dpi-team-r">

                                        <div class="table-div">
                                            <div class="table-cell team-list">
                                                <div class="title">Team</div>
                                                <ul>
                                                    @if($details[0]->team_mem1 != '')
                                                        <li><p id="pre_member1" style="padding: 0;margin-bottom: 0;">{{$details[0]->team_mem1}}</p><span id="pre_position1">{{ $details[0]->team_mem_deg1 }}</span></li>
                                                    @else
                                                        <li id="li1" style="display: none;"><p id="pre_member1" style="padding: 0;margin-bottom: 0;"></p><span id="pre_position1"></span></li>
                                                    @endif

                                                    @if($details[0]->team_mem2 !='')
                                                        <li><p id="pre_member2" style="padding: 0;margin-bottom: 0;">{{$details[0]->team_mem2}}</p><span id="pre_position2">{{ $details[0]->team_mem_deg2 }}</span></li>
                                                    @else
                                                        <li id="li2" style="display: none;"><p id="pre_member2" style="padding: 0;margin-bottom: 0;"></p><span id="pre_position2"></span></li>
                                                    @endif

                                                    @if($details[0]->team_mem3 !='')
                                                        <li><p id="pre_member3" style="padding: 0;margin-bottom: 0;">{{$details[0]->team_mem3}}</p><span id="pre_position3">{{ $details[0]->team_mem_deg3 }}</span></li>
                                                    @else
                                                        <li id="li3" style="display: none;"><p id="pre_member3" style="padding: 0;margin-bottom: 0;"></p><span id="pre_position3"></span></li>
                                                    @endif

                                                    @if($details[0]->team_mem4 !='')
                                                        <li><p id="pre_member4" style="padding: 0;margin-bottom: 0;">{{$details[0]->team_mem4}}</p><span id="pre_position4">{{ $details[0]->team_mem_deg4 }}</span></li>
                                                        @else
                                                        <li id="li4" style="display: none;"><p id="pre_member4" style="padding: 0;margin-bottom: 0;"></p><span id="pre_position4"></span></li>
                                                    @endif
                                                </ul>
                                            </div>


                                            <div class="table-cell kpi-info-cell" style="display:none">
                                                <div class="kpi-info-l" style="min-width:250px!important">
                                                    <div class="title">Financial KPI</div>
                                                    <ul class="dpi-r">
                                                        <li>Return on investment (ROI) <span id="pre_roi">{{ $details[0]->roi }}%</span></li>
                                                        <li>Cost of capital (Offered)<span id="pre_coc">{{ $details[0]->cop }}%</span></li>
                                                        <li>Promotors investment<span id="pre_pi">{{ $details[0]->pi }} Million</span></li>
                                                        <li>Assured minimum dividend<span id="pre_amd">{{ $details[0]->dividend }}%</span></li>
                                                        <li>Fixed assests<span id="pre_fa">{{ $details[0]->fa }} Millio</span></li>
                                                        <li>EBITDA<span id="pre_ebitda">{{ $details[0]->ebitda }}%</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </article>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@endsection
