@extends('frontend.layout.layout')
@section('content')
<div id="Slider-Container"> 
    <div id="Slider">
        <ul id="Slider1" class="rslides">
            @foreach($slider as $key => $value)
            <li class="banner1" style="background-image:url({{ asset('public/upload/slider/'.$value->image)}})"></li>
            @endforeach
        </ul>
        <div class="slider-content">
            <div class="slider-tabs">
                <ul>
                    @foreach($slider as $key => $value)
                        <li><a href="javascript:void(0);"></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div> 
</div>


<section>
    <div id="Info">
        <div id="Info-Intra">
            <p><span>World's</span> most effectual fund raising dais</p>
        </div>
    </div>
    <div id="Info-Grid">
        <div id="Info-Grid-Intra">
            <p class="main-text">Expand your horizons with what you can,<br/> what you have, what you want and where you are.</p>
            <ul class="info-grif-list">
                <li>
                    <span>Approved Profile</span>
                    <p>Every Profile is fully vetted to be an investor or buyer.</p>
                </li>
                <li>
                    <span>Confidential</span>
                    <p>Identity disclosed only after successful completion.</p>
                </li>
                <li>
                    <span>Business &amp; Geographical Globe</span>
                    <p>Connect with all categories of people and organisation globally.</p>
                </li>
            </ul>
        </div>
    </div>

    <div id="Live-Pitch">
        <div id="Live-Pitch-Intra">
            <h2>Live Pitch Decks</h2>
            @if($pitches->isEmpty())
            <p style="text-align: center;color: #f9dc06">There is no live pitch details available.</p><br>
            @else
            <ul class="live-pitch-list">
                @foreach($pitches as $key => $value)
                @php 
                $date=date_create($value->active_date);
                date_add($date,date_interval_create_from_date_string($value->days.'days'));
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
                <li class="">
                    <a href="{{ route('pitch-detail',$value->userid)}}">
                        @if($value->imagename)
                        <img width="300" height="165" src="{{ asset('public/upload/company_details'.'/'.$value->imagename)}}" alt="Unable to display pitches image"/>
                        @else
                        <img width="300" height="165" src="{{ asset('public/frontend/image/no-image.png')}}" alt="Unable to display pitches image"/>
                        @endif
                        <div class="hover-content">
                            <div class="title-kpi">Financial KPI</div>
                            <ul>
                                <li>Return on investment (ROI) <span>{{ $value->roi }}%</span></li>
                                <li>Cost of capital (Offered)<span>{{ $value->cop }}%</span></li>
                                <li>Promotors investment<span>{{ $value->pi }} </span></li>
                                <li>Assured minimum dividend<span>{{ $value->dividend }}%</span></li>
                                <li>Fixed assests<span>{{ $value->fa }} </span></li>
                                <li>EBITDA<span>{{ $value->ebitda }}%</span></li>
                            </ul>
                        </div>
                        <span class="thumbnail">{{ ucfirst($value->planname) }} </span>
                        <div class="pitch-intra">
                            <h3>{{ $value->industryname }}<span>Profile Code : <b>{{ $value->profile_code }}</b></span></h3>
                            <p style="height: 120px;">{{ $value->intro }}</p>
                            <ul class="one-grid">
                                @if($value->user_type == "P")
                                <li>Target <span class="inr">INR</span>&nbsp;{{ indian_money_format($value->max_investment) }}</li>
                                @else
                                <li>Target <span class="inr">INR</span>&nbsp;&nbsp;&nbsp;{{ indian_money_format($value->max_investment) }}</li>                                    
                                @endif

                            </ul>
                            <div class="progressbar home-progress">

                                @if($value->max_investment > 0 && $value->max_investment !='')
                                @php
                                $width=(($value->gettotalmount*100)/$value->max_investment);
                                @endphp

                                @else
                                @php
                                $width=0;
                                @endphp
                                @endif
                                @if($width > 100)
                                <div class="progressbar-intra progressbarfullwidth"  data-width="{{ round($width)}}"></div>
                                @else
                                <div class="progressbar-intra" style="background:#f9dc06"  data-width="{{round($width)}}"></div>
                                @endif
                            </div>



                        </div>

                        <div style="float:left;width:100%;padding-right:5%">

                            @if ($value->verified_status==1)
                            <div style="float:left;width:25%;vertical-align:middle;padding-top:5%;padding-left:1%">
                                <img  src="{{ asset('public/frontend/image/Varified.png')}}" alt="Unable to display image"/>
                            </div>
                            @endif

                            @if ($value->verified_status==1)
                            <div style="float:left;width:65%">
                                <ul class="three-grid" >
                                    @else
                                    <div style="float:left;width:100%;">
                                        <ul class="three-grid" >
                                            @endif


                                            <li class="funded-icon">

                                                <span>{{ indian_money_format($value->gettotalmount)}}</span> Offered</li>
                                            <li><span>{{ indian_money_format($value->totalinvestor)}}</span>Investors</li>

                                        </ul>



                                        <ul class="two-grid" >
                                            @if($value->planname  != 'Free')
                                            <li class="daysleft"><span>{{ $days }} Days Left</span> </li>
                                            @else
                                            <li class="daysleft"></li>
                                            @endif

                                            <li><span>Location</span> {{ $value->cityname }}, {{ $value->countryname }}</li>
                                        </ul>
                                    </div>
                            </div>
                    </a>
                </li>
                @endforeach
            </ul>
            <a href="{{ route("raising-finance") }}" class="view-pitch">View all</a>
            @endif
        </div>
    </div>


</section>

@endsection