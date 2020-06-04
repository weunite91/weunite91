@extends('frontend.layout.layout')
@section('content')
<div id="Content-Container">
    <div id="Content-Main">
        <div class="table-div">
            {{ csrf_field() }}
            <div id="Content" class="table-cell">
                <article class="textMain ">
                    <h1>My Favourite Pitches</h1>
                    @php
                        $count=1;
                    @endphp
                    @foreach($pitches as $key => $value)
                    @php
                                        $totalArr=explode(",",$value->total_ammount);
                                    @endphp
                                    @if($value->max_investment > 0 && $value->max_investment !='')
                                        @php
                                            $width=(($value->gettotalmount*100)/$value->max_investment);
                                        @endphp

                                    @else
                                        @php
                                            $width=0;
                                        @endphp
                                    @endif
                    <div class="favourite-pitches-list">
                        <div class="table-div">
                            <div class="serial-no"><p>{{$count}}</p></div>
                            <div class="table-cell favourite-pitches-img">
                                @if($value->imagename !='')
                                    <img width="982" height="100" src="{{ asset('public/upload/company_details'.'/'.$value->imagename)}}" alt="" />
                                @else
                                    <img width="982" height="100" src="{{ asset('public/frontend/image/no-image.png')}}" alt="" />
                                @endif
                                <div class="pcode">Profile Code: {{ $value->profile_code}}</div>
                                <div class="pcode" style="background: #f9dc06">Plan : {{ ucfirst($value->planname) }} </div>
                            </div>

                            <div class="table-cell favourite-info">
                                <div class="industry-name">
                                Industry : <span>{{ $value->industryname}}</span>
                                </div>
                                
                                
                                <div style="float:left;width:80%">
                                <div class="target-invt">
                                Target : <span>INR {{ indian_money_format($value->max_investment)}}</span>
                                </div>



                                @if($value->planname != "Free")
                                    <div class="progressbar home-progress">

                                            @if($width > 100)
                                                <div class="progressbar-intra progressbarfullwidth"  data-width="{{ round($width)}}"></div>
                                            @else
                                                <div class="progressbar-intra" style="background:#f9dc06" data-width="{{round($width)}}"></div>
                                            @endif

                                    </div>
                                    @endif
                                </div>
                                
                                <div style="float:left;width:20%">
                                    <div style="float:left;height:60px !important">
                                    @if ($value->verified_status==1)
                                       <img height="80px" src="{{ asset('public/frontend/image/Varified.png')}}" alt=""/>
                                    @endif
                                    </div>
                                </div>
                                 
                                <ul>
                                    @if($value->planname != "Free")
                                    <li><span>{{indian_money_format($value->gettotalmount) }} INR</span>Fund Raised</li>
                                    <li><span>{{ indian_money_format($value->totalinvestor)  }}</span> Investor</li>

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
                                    <li class="days-remaining"><p>{{ $days }} Days Left</p></li>
                                    @endif
                                    <li class="days-remaining"><a href="{{ route('pitch-detail',$value->fav_pitch_id)}}" class=""><p>View</p></a></li>
                                    <li class="days-remaining"><a href="javascript:;" class="removefavorite" data-id="{{ $value->fav_id}}"><p>Remove</p></a></li>


                                </ul>
                            </div>

                            <div class="table-cell favourite-invest">

                                @if($value->planname != "Free")
                                    <p>In multiples of INR ten thousand</p>

                                    <form method="post" class="favouriteform" action="" enctype="multipart/form-data" id="offered{{$count}}">{{ csrf_field() }}
                                        <input type="hidden" name="pitch_id" value="{{$value->fav_pitch_id}}">
                                        <input type="text"  class="inrformat" name="offered_investment_dis" id="offered_investment_dis_{{ $count}}" onkeypress="return isNumber(event);" value="{{ $value->min_investment_accepated }}" placeholder="INR 10,00,00,000" />
                                        <input type="hidden"  class="nomoneyformat" name="offered_investment"  id="offered_investment_{{ $count}}" onkeypress="return isNumber(event);" value="{{ $value->min_investment_accepated }}" placeholder="INR 10,00,00,000"  />
                                        <input type="hidden" id="min_investment_{{$count}}"  name="min_investment_{{$count}}"   value="{{ $value->min_investment_accepated }}" />
                                        <span class="help-block" id="fav_error_{{$count}}" style="display:none">Please enter a value greater than or equal to {{indian_money_format($value->min_investment_accepated)}}.</span>
<input type="submit" class="submit-now favouritesubmit" name="" value="Offer Now" onclick="return favouritesubmit({{$count}})"  />
                                    </form>
                                @else
                                    <p>In Free investor can't make offer</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @php
                        $count++;
                    @endphp
                    @endforeach
                    <div id="pagination" style="display: inline-block;width: 100%">
                        
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection