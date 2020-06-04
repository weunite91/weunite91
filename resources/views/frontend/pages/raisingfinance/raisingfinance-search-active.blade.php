@extends('frontend.layout.layout')
@section('content')
<div id="Content-Container">
    <div id="Content-Main">
        <div class="table-div">
            <div id="Content" class="table-cell">
                <article class="textMain " style="text-align: center;">
                    <!--#include file="includes/filter.shtml"--> 
                    @include('frontend.include.filter')
                    <div class="toggle-wrap raising-wrap">
                        <ul class="toggle-tabs">
                            <a href="{{ route("raising-finance") }}"><li>Live Pitch Deck</li></a>
                            <li class="active-tab"><a href="{{ route("raising-finance-active")}}">Active Pitch Deck</a></li>
                        </ul>
                        <div class="tabbed-content-wrap">
                            <div id="Live-Pitch">
                                <div id="Live-Pitch-Intra">
                                    <div class="content-box active-content-box">
                                        <ul class="live-pitch-list">
                                            @if(!empty($getPitchesactive))
                                            @foreach($getPitchesactive as $key => $value)
                                                <li class="">
                                                    <a href="{{ route('pitch-detail',$value->pitchid)}}">
                                                        @if($value->imagename)
                                                            <img width="300" height="165" src="{{ asset('public/upload/company_details'.'/'.$value->imagename)}}" alt=""/>
                                                            @else
                                                            <img width="300" height="165" src="{{ asset('public/frontend/image/no-image.png')}}" alt=""/>
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
                                                        <span class="thumbnail">{{ $value->planname }} </span>
                                                        <div class="pitch-intra">
                                                            <h3>{{ $value->industryname }}<span>Profile Code : <b>{{ $value->profile_code }}</b></span></h3>
                                                            <p style="height: 120px;">{{ $value->intro }}</p>
                                                             <ul class="one-grid">
                                                                @if($value->user_type == "P")
                                                                    <li >Target <span class="inr">INR</span>&nbsp;{{ $value->max_investment }}</li>
                                                                @else
                                                                    <li>Target <span class="inr">INR</span>&nbsp;&nbsp;&nbsp;{{ $value->max_investment }}</li>                                    
                                                                @endif
                                                               
                                                            </ul>
                                                            <!--<div class="progressbar home-progress">
                                                                <div class="progressbar-intra" data-width="50%">
                                                                </div>
                                                            </div> -->
                                                            <!-- <ul class="three-grid">
                                                                <li class="funded-icon"><span>50,00,000</span> Offered</li>
                                                                <li><span>15</span>Investors</li>
                                                            </ul> -->
                                                            @php 

                                                                if($value->planname == 'Free'){
                                                                        $day = 0;
                                                                }

                                                                if($value->planname == 'Treasure'){
                                                                        $day = '15 days';
                                                                }

                                                                if($value->planname == 'Gilded'){
                                                                        $day = '30 days';
                                                                }

                                                                if($value->planname == 'Platinum'){
                                                                        $day = '45 days';
                                                                }

                                                                if($value->planname == 'Preferred'){
                                                                        $day = '60 days';
                                                                }

                                                                if($value->planname == 'Royal'){
                                                                        $day = '60 days';
                                                                }

                                                               if($value->planname != 'Free'){
                                                                    $date=date_create($value->paymentdate);
                                                                    date_add($date,date_interval_create_from_date_string($day));
                                                                    $finaldate = date_create(date_format($date,"Y-m-d"));
                                                                    $today = date_create(date("Y-m-d"));
                                                                    $daysleft = date_diff($finaldate,$today) ;
                                                               }

                                                               @endphp

                                                            <ul class="two-grid">
                                                                <!-- @if($value->planname != 'Free')
                                                                    <li class="daysleft"><span>{{ $daysleft->days }} Days Left</span> </li>
                                                                @else
                                                                    <li class="daysleft"></li>
                                                                @endif -->
                                                                <li><span>Location</span> {{ $value->cityname }}, {{ $value->countryname }}</li>
                                                            </ul>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                      
                                    </div>
                                    <div class="content-box">
                                        <ul class="live-pitch-list">
                                            @if(!empty($getPitchesactive))
                                            @foreach($getPitchesactive as $key => $value)
                                                
                                                <li class="">
                                                    <a href="{{ route('pitch-detail',$value->pitchid)}}">
                                                        @if($value->imagename)
                                                        <img width="300" height="165" src="{{ asset('public/upload/company_details'.'/'.$value->imagename)}}" alt=""/>
                                                        @else
                                                        <img width="300" height="165" src="{{ asset('public/frontend/image/no-image.png')}}" alt=""/>
                                                        @endif
                                                        <div class="hover-content">
                                                            <div class="title-kpi">Financial KPI</div>
                                                            <ul>
                                                                <li>Return on investment (ROI) <span>{{ $value->roi }}%</span></li>
                                                                <li>Cost of capital (Offered)<span>{{ $value->cop }}%</span></li>
                                                                <li>Promotors investment<span>{{ $value->pi }} Million</span></li>
                                                                <li>Assured minimum dividend<span>{{ $value->dividend }}%</span></li>
                                                                <li>Fixed assests<span>{{ $value->fa }} Million</span></li>
                                                                <li>EBITDA<span>{{ $value->ebitda }}%</span></li>
                                                            </ul>
                                                        </div>
                                                        <span class="thumbnail">{{ ucfirst($value->planname) }} </span>
                                                        <div class="pitch-intra">
                                                            <h3>{{ $value->industryname }}<span>Profile Code : <b>{{ $value->profile_code }}</b></span></h3>
                                                            <p style="height: 120px;">{{ $value->intro }}</p>
                                                            <!-- <ul class="one-grid">
                                                                @if($value->user_type == "P")
                                                                    <li>Target <span class="inr">INR</span>&nbsp;{{ $value->max_investment }}</li>
                                                                @else
                                                                    <li>Target <span class="inr">INR</span>&nbsp;&nbsp;&nbsp;{{ $value->max_investment }}</li>                                    
                                                                @endif
                                                               
                                                            </ul>
                                                             -->
                                                            
                                                            <ul class="two-grid">
                                                                
                                                                <li><span>Location</span> {{ $value->cityname }}, {{ $value->countryname }}</li>
                                                            </ul>
                                                        </div>
                                                    </a>
                                                </li>
                                               
                                            @endforeach
                                            @endif
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pagination" style="display: inline-block;width: 100%"></div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection