@extends('frontend.layout.layout')
@section('content')
<div id="Container"> 
    <!--#include file="includes/header.shtml"--> 
    <div id="Content-Container">
        <div id="Content-Main">
            <div class="table-div">
                <div id="Content" class="table-cell">
                    <article class="textMain ">
                        <h1></h1>

                        <div class="textmain-intra investor-detailed-pitch">
                            <!-- <div class="detailed-pitch-l-intra">
                                    <div class="detailed-pitch-in-blk">
                                    <img src="{{ asset('public/frontend/image/demo.jpg') }}" alt="" />
                                    </div>
                            </div> -->	

                            <div class="add-fav">
                                <a href="{{ route("send-proposal",$detail[0]->id) }}">Send Proposal</a>
                            </div>


                            <div class="investor-dpi-title">
                                <p class="title">Profile Code :<span>{{ $detail[0]->profile_code }}</span></p>
                                <div class="title">Introduction</div>
                                <p style="padding-left: 20px;">{{ $detail[0]->intro }}</p>
                            </div>

                            @if(count($viewcontactdetails)>0)
                            <div class="investor-dpi-title">
                            <p class="title">Email :<span>{{$viewcontactdetails[0]->email}}</span></p>
                            </div>
                            @endif
                            <div class="table-div detailed-pitch-intro" style="padding: 0px 0 10px 0;">

                                <div class="table-cell dpi-l investor-dpi-l">

                                    <div class="title">Company Introduction</div>
                                    <p>{{ $detail[0]->company_intro }}</p>
                                    <ul>
                                        <li>Interested in investing: <span style="font-size:15px;font-weight:bold">{{ str_replace(',',', ',$detail[0]->interestin) }}</span></li>
                                        <li>Industry type : <span>
                                                @php
                                                $tmarr=explode(",",$detail[0]->industry);
                                                $count=0;
                                                @endphp
                                                @foreach($industrylist as $key => $value2)
                                                @if(in_array($value2->id,$tmarr))
                                                @if($count > '0')
                                                {{','}}
                                                @endif
                                                {{ $value2->industry }}
                                                @php
                                                $count++;
                                                @endphp
                                                @endif

                                                @endforeach</span>
                                        </li>
                                        <li>Investment size : <span>INR {{ indian_money_format($detail[0]->min_investment) }} - INR {{ indian_money_format($detail[0]->max_investment) }}</span></li>
                                        <li>Preferred Location : <span style="margin-left:3px;position: absolute;height:50px;overflow:auto"> {{ str_replace(',',', ',$detail[0]->interested_country) }}</span><li>
                                    </ul>
                                </div>

                                <!-- <div class="table-cell dpi-r investor-dpi-r">
                                        <img src="{{ asset('public/frontend/image/team.jpg') }}" alt="" />
                                </div> -->

                            </div>





                        </div>


                        <div class="go-back-btn">
                            <a href="{{ url()->previous() }}">Go Back</a>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>		

    <!--#include file="includes/footer.shtml"--> 
</div>
@endsection