@extends('frontend.layout.layout')
@section('content')
<div id="Content-Container">
    <div id="Content-Main">
        <div class="table-div">
            <div id="Content" class="table-cell">
                <article class="textMain ">
                    <!--#include file="includes/filter.shtml"--> 
                    @include('frontend.include.filter')
                    <div class="toggle-wrap raising-wrap">
                        <ul class="toggle-tabs">
                            <li class="active-tab">Live Pitch Deck</li>
                            <a href="{{ route("raising-finance-active")}}"><li>Active Pitch Deck</li></a>
                        </ul>
                        <div class="tabbed-content-wrap">
                            <div id="Live-Pitch">
                                <div id="Live-Pitch-Intra">
                                    <div class="content-box active-content-box">
                                        <ul class="live-pitch-list">
                                            @foreach($pitches as $key => $value)
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
                                                                    <div class="progressbar-intra" style="background:#f9dc06" data-width="{{round($width)}}"></div>
                                                                @endif
                                                            </div>
                                                            <ul class="three-grid">
                                                                <li class="funded-icon"><span>{{ indian_money_format($value->gettotalmount)}}</span> Offered</li>
                                                                <li><span>{{ indian_money_format($value->totalinvestor)}}</span>Investors</li>
                                                            </ul>
                                                            @php 
                                                                    $date=date_create($value->active_date);
                                                                    date_add($date,date_interval_create_from_date_string($value->days.'days'));
                                                                    $finaldate = date_create(date_format($date,"Y-m-d"));
                                                                    $today = date_create(date("Y-m-d"));
                                                                    $daysleft = date_diff($finaldate,$today) ;
                                                             

                                                               @endphp

                                                            <ul class="two-grid">
                                                                @if($value->planname != 'Free')
                                                                    <li class="daysleft"><span>{{ $daysleft->days }} Days Left</span> </li>
                                                               @else
                                                                    <li class="daysleft"></li>
                                                               @endif
                                                                <li><span>Location</span> {{ $value->cityname }}, {{ $value->countryname }}</li>
                                                            </ul>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                      
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pagination" style="display: inline-block;width: 100%;"></div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection