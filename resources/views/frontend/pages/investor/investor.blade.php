@extends('frontend.layout.layout')
@section('content')
<div id="Content-Container">
    <div id="Content-Main">
        <div class="table-div">
            <div id="Content" class="table-cell">
                <article class="textMain ">
                <form method="post" action="" enctype="multipart/form-data">{{ csrf_field() }}

                    <h1>Investor Pitch Deck</h1>
                    @include('frontend.include.filter')

                    @if($pitches->isEmpty())
                    <p style="text-align: center;color: red">There is no investor pitch details available.</p>
                    @else
                    <ul class="investor-pitch-list">
                        @foreach($pitches as $key => $value)
                        @if($value->pitchid !='')
                        <li>
                            <h2>{{ $value->investortype }} <span>In {{ $value->countryname }}</span></h2>
                            <p class="ip-info">Posted by : <b>{{ $value->designation }}</b></p>
                            @php
                            $currentdate=date('Y-m-d H:i:s');

                            $date1=date_create($currentdate=date('Y-m-d H:i:s'));
                            $date2=date_create($value->generatedate);
                            $diff=date_diff($date1,$date2);

                            @endphp

                            <p class="profile-code">Profile Code : {{ $value->profile_code }}</p>
                            <div class="investor-pitch-list-intra">
                                <ul>
                                    <li class="" style="height: 60px;text-overflow: ellipsis;overflow: hidden;">
                                        @if(strlen($value->intro) > 110)
                                        {{ substr($value->intro, 0, 140)."..." }}
                                        @else
                                        {{ $value->intro }}
                                        @endif

                                    </li>
                                    <li>Interested in investing: <span>{{ str_replace(',',', ',$value->interestin) }}</span></li>
                                    <li>Preferred Industry type : <span>
                                            @php
                                            $tmarr=explode(",",$value->industry);
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
                                    <li>Investment size : <span><i>INR</i> {{ indian_money_format($value->min_investment) }} - <i>INR</i> {{ indian_money_format($value->max_investment) }}</span></li>
                                    @if($value->user_type == "P")
                                    <li>Preferred Location&nbsp;:<span>{{ str_replace(',',', ',$value->interested_country) }}</span></li>

                                    @else
                                    <li>Preferred Location&nbsp;&nbsp;&nbsp;:  <span>{{ str_replace(',',', ',$value->interested_country) }}</span></li>
                                    @endif

                                </ul>
                            </div>
                            <a href="{{ route('investorpitch-detail',$value->pitchid) }}" class="contact-investor">Contact Investor</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    @include('frontend.include.pitch_paging')
                      @endif
                      </form>
                </article>
            </div>
        </div>
    </div>
</div>

@endsection
