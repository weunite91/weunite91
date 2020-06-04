
@extends('frontend.layout.layout')

@section('content')

@php
                        $count=1;
                    @endphp

<div id="Container"> 
    <!--#include file="includes/header.shtml"--> 
    <div id="Content-Container">
        <div id="Content-Main">
            <div class="table-div">
                <div id="Content" class="table-cell">
                    <article class="textMain ">
                        <h1></h1>
                        <div class="textmain-intra">
                            <div class="detailed-pitch-l-intra">
                                <div class="detailed-pitch-in-blk">
                                    
                                    <div class="demo">
                                        <ul id="Slider2" class="rslides">
                                            @foreach($image as $key => $value)
                                            <li data-thumb="{{ asset('public/upload/company_details'.'/'.$value->imagename)}}">
                                                <img width="982" height="372" src="{{ asset('public/upload/company_details'.'/'.$value->imagename)}}" alt="" />
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    
                                    @if($detail[0]->planname != "Free")
                                    <div class="floating-payment">
                                        <form  method="post" action="" enctype="multipart/form-data" id="offered">{{ csrf_field() }}
                                        <input type="text"  class="inrformat" name="offered_investment_dis" id="offered_investment_dis_{{ $count}}" onkeypress="return isNumber(event);" value="{{ $detail[0]->min_investment_accepated }}" placeholder="INR 10,00,00,000" />
                                        <input type="hidden"  class="nomoneyformat" name="offered_investment"  id="offered_investment_{{ $count}}" onkeypress="return isNumber(event);" value="{{ $detail[0]->min_investment_accepated }}" placeholder="INR 10,00,00,000"  />
                                        <input type="hidden" id="min_investment_{{$count}}"  name="min_investment_{{$count}}"   value="{{ $detail[0]->min_investment_accepated }}" />
                                        <span class="help-block" id="fav_error_{{$count}}" style="display:none">Please enter a value greater than or equal to {{indian_money_format($detail[0]->min_investment_accepated)}}.</span>
                                        <input type="submit" class="submit-now favouritesubmit" name="" value="Offer Now" onclick="return favouritesubmit({{$count}})"  />
                                        </form>
                                    </div>
                                    @endif

                                </div>
                            </div>	
                            <div class="table-div detailed-pitch-grid">
                                @if($added == '0')
                                <div class="table-cell add-fav">
                                    <p style="font: 600 13px/26px 'Montserrat', sans-serif">Pro. Code : {{ $detail[0]->profile_code }}</p>
                                    <a href="javascript:void(0);" id="add_favourite" data-id="{{ $pitchid }}" data-userid="{{ $loginid }}">Add to Favourites</a>
                                    {{ csrf_field() }}
                                </div>

                                @else
                                <div class="table-cell add-fav">
                                    <p style="font: 600 13px/26px 'Montserrat', sans-serif">Pro. Code : {{ $detail[0]->profile_code }}</p>
                                    <a href="javascript:void(0);" id="remove_favourite" data-id="{{ $pitchid }}" data-userid="{{ $loginid }}">Remove from Favourites</a>
                                </div>
                                @endif

                                <div class="table-cell detailed-pitch-info">

                                    <ul>
                                        <li class="target-dp">
                                                    
                                            Target :<span class="inr"></span> {{ $detail[0]->max_investment != '' ? indian_money_format($detail[0]->max_investment).' INR' :'NO data found'  }}
                                        </li>
                                        <li>
                                            <div class="progressbar home-progress">

                                                @if($profiledata[0]->max_investment > 0 && $profiledata[0]->max_investment !='')
                                                @php
                                                $width=(($gettotalmount*100)/$profiledata[0]->max_investment);
                                                @endphp
                                                @else
                                                @php
                                                $width=0;
                                                @endphp
                                                @endif
                                                @if($width > 100)
                                                <div class="progressbar-intra progressbarfullwidth"  data-width="{{ round($width)}}"></div>
                                                @else
                                                <div class="progressbar-intra" style="background:#f9dc06" data-width="{{round($width)}}"></div>
                                                @endif

                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="detailed-pitch-info-grid">

                                        <li class="funded-icon"><span>{{ indian_money_format($gettotalmount) }} :</span> Offered</li>
                                        <li><span>{{ indian_money_format($totalinvestor)}} :</span> Investors</li>

                                    </ul>

                                </div>
                                <div class="table-cell days-left">
                               
                                    @if(count($viewcontactdetails)==0)
                                    <p class="contact-btn"><a href="{{ route('contact-business',$pitchid) }}"  >Contact Business</a></p>
                                    @else
                                    <p >{{$viewcontactdetails[0]->email}}</p>
                                    @endif
                                    @php 
                                    $date=date_create($profiledata[0]->active_date);
                                    date_add($date,date_interval_create_from_date_string($profiledata[0]->days.'days'));
                                    $finaldate = date_create(date_format($date,"Y-m-d"));
                                    $today = date_create(date("Y-m-d"));
                                    $daysleft = date_diff($finaldate,$today) ;

                                    if ( $finaldate>$today  )
                                    {
                                        $daysleft = date_diff($finaldate,$today) ;
                                        $days=$daysleft->days ;
                                    }
                                    else{
                                        $days=0;
                                    }
                                    @endphp

                                    @if($profiledata[0]->planname != 'Free')
                                    <p>{{ $days }} Days Left</p>
                                    @else
                                    <p></p>
                                    @endif

                                   
                                </div>
                            </div>
                                
                                @if ( $detail[0]->verified_status==1)
                                <div  class="pull-right" style="padding-right:130px!important">
                           <img height="80px" src="{{ asset('public/frontend/image/Varified.png')}}" alt=""/>
                           </div>
                          @endif
                                
                            <div class="table-div detailed-pitch-intro">
                                <div class="table-cell dpi-l">
                                    <div class="title">Introduction</div>
                                    <p>{{ $detail[0]->intro  != '' ? $detail[0]->intro :'NO data found'  }}</p>
                                </div>

                                <div class="table-cell dpi-r">
                                    <ul>	

                                        @if($detail[0]->usp1  != '')
                                        <li>{{ $detail[0]->usp1  != '' ? $detail[0]->usp1 :'NO data found'  }}</li>
                                        @endif
                                        @if($detail[0]->usp2  != '')
                                        <li>{{ $detail[0]->usp2  != '' ? $detail[0]->usp2 :'NO data found'  }}</li>
                                        @endif
                                        @if($detail[0]->usp3  != '')
                                        <li>{{ $detail[0]->usp3  != '' ? $detail[0]->usp3 :'NO data found'  }}</li>
                                        @endif
                                        @if($detail[0]->usp4  != '')
                                        <li>{{ $detail[0]->usp4  != '' ? $detail[0]->usp4 :'NO data found'  }}</li>
                                        @endif

                                    </ul>
                                </div>
                            </div>

                            <div class="table-div detailed-pitch-idea">
                                <div class="table-cell dpi-idea-l">
                                    <div class="title">Idea</div>
                                    <p>{{ $detail[0]->idea  != '' ? $detail[0]->idea :'NO data found'  }}</p>
                                    <div class="title">Team Overview</div>
                                    <p>{{ $detail[0]->team  != '' ? $detail[0]->team :'NO data found'  }}</p>
                                </div>

                                <div class="table-cell dpi-idea-r">
                                    <div class="videoBorder">
                                        @if($detail[0]->video !='')
                                        <video width="400" controls>
                                            <source src="{{ asset('public/upload/video').'/'.$detail[0]->video}}">
                                            Your browser does not support HTML5 video.
                                        </video>
                                        @else
                                        <video width="400" controls>
                                            <source src="vedios/cement-demo.webm" type="video/webm">
                                            <source src="vedios/cement-demo.webm" type="video/mp4">
                                            <source src="vedios/cement-demo.webm" type="video/ogg">
                                            Your browser does not support HTML5 video.
                                        </video>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="table-div detailed-pitch-team">
                                <div class="table-cell dpi-team-l">
                                    @if($detail[0]->member_image !='')
                                    <img width="502" height="342" src="{{ asset('public/upload/team_member').'/'.$detail[0]->member_image }}" alt="">
                                    @else
                                    <img width="502" height="342" src="{{ asset('public/frontend/image/no-image.png') }}" alt="">
                                    @endif
                                </div>
                                <div class="table-cell dpi-team-r">

                                    <div class="table-div">
                                        <div class="table-cell team-list">
                                            <div class="title">Team</div>
                                            <ul>
                                                @if($detail[0]->team_mem1 != '' && $detail[0]->team_mem1) 
                                                <li>{{ explode(" ",$detail[0]->team_mem1)[0] }}<span>{{ $detail[0]->team_mem_deg1 }}</span></li>
                                                @endif
                                                @if($detail[0]->team_mem2 !='' && $detail[0]->team_mem2) 
                                                <li>{{ explode(" ",$detail[0]->team_mem2)[0] }}<span>{{ $detail[0]->team_mem_deg2 }}</span></li>
                                                @endif
                                                @if($detail[0]->team_mem3 !='' && $detail[0]->team_mem3) 
                                                <li>{{ explode(" ",$detail[0]->team_mem3)[0] }}<span>{{ $detail[0]->team_mem_deg3 }}</span></li>
                                                @endif
                                                @if($detail[0]->team_mem4 !='' && $detail[0]->team_mem4) 
                                                <li>{{ explode(" ",$detail[0]->team_mem4)[0] }}<span>{{ $detail[0]->team_mem_deg4 }}</span></li>
                                                @endif
                                            </ul>
                                        </div>

                                        <div class="table-cell kpi-info-cell">
                                            <div class="kpi-info-l">
                                                <div class="title">Financial KPI</div>
                                                <ul class="dpi-r">
                                                    <li>Return on investment (ROI) <span>{{ $detail[0]->roi != '' ? $detail[0]->roi.' %'  :"N/A" }} </span></li>
                                                    <li>Cost of capital (Offered)<span>{{ $detail[0]->cop != '' ?$detail[0]->cop.' %'  :"N/A" }} </span></li>
                                                    <li>Promotors investment<span>{{ $detail[0]->pi != '' ? $detail[0]->pi  :"N/A" }} </span></li>
                                                    <li>Assured minimum dividend<span>{{ $detail[0]->dividend != '' ? $detail[0]->dividend.' %'  :"N/A" }}</span></li>
                                                    <li>Fixed assests<span>{{ $detail[0]->fa != '' ? $detail[0]->fa  :"N/A" }} </span></li>
                                                    <li>EBITDA<span>{{ $detail[0]->ebitda != '' ? $detail[0]->ebitda.' %'  :"N/A" }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection