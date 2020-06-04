@extends('frontend.layout.layout')
@section('content')<div id="Content-Container">
    <div id="Content-Main">
        <div class="table-div">
            <div id="Content" class="table-cell">
                <article class="textMain ">
                    <h1>Contact</h1>

                    <div class="table-div contact-grid">
                        <div class="table-cell contact-left">
                            <div class="title"></div>
                            <ul>
                            <li class="address-text"><span>India Office</span> 
                            9,2nd cross<br/>adityanagar,vidyaranyapura,
                            <br/> Bangalore - 560097 - India</li>
                            <li class="phone-text" ><i class="fa fa-phone"></i> +91-8296350841</li>
                              
                                <li class="mail-text"><a href="mailto:info@weunite91.com">info@weunite91.com</a></li>
                                <li class="mail-text"><a href="mailto:media@weunite91.com">media@weunite91.com</a></li>
                                <li class="mail-text"><a href="mailto:eu@weunite91.com">eu@weunite91.com</a></li>
                            </ul>	
                        </div>
                        <div class="table-cell contact-right">
                        <div class="title"></div>
                            <div style="color:blue">{{$statusmessage}}</div>
                            <form name="" action="#" method="post" enctype="multipart/form-data">
                                <div class="block-area inline-input">
                                    <input type="text" name="firstname" placeholder="Name *" />
                                </div>
                                <div class="inline-input">
                                    <input type="email" name="email" placeholder="Email *" />
                                </div>

                                <div class="inline-input contact-no" >
                                    <select style="width: 80px" name="country_phone_code">
                                    @foreach($countrieslist as $country)
                                        <option value="{{ $country->phonecode }}" >+{{$country->phonecode}}</option>
                                     @endforeach  
                                    </select>
                                    <input type="text" name="contact" placeholder="Contact Number" />
                                </div>


                                <div class="block-area">
                                    <textarea name="message" placeholder="Your message here"></textarea>
                                </div>
                                <div class="inline-input submit-reset">
                                    <input type="reset" class="reset-btn"/>
                                    <input type="submit" value="Submit Now" />
                                </div>
                        </div>
                    </div>

                    <ul class="locations-list" style="display:none">
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/europe.jpg') }}" alt="" />
                            <span>europe</span>
                            <p>Email ID : <a href="mailto:eu@weunite91.com">eu@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/argentina.jpg') }}" alt="" />
                            <span>Argentina</span>
                            <p>Email ID : <a href="mailto:argentina@weunite91.com">argentina@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/bangladesh.jpg')}}" alt="" />
                            <span>bangladesh</span>
                            <p>Email ID : <a href="mailto:bangladesh@weunite91.com">bangladesh@weunite91.com </a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/brazil.jpg') }}" alt="" />
                            <span>brazil</span>
                            <p>Email ID : <a href="mailto:brazil@weunite91.com">brazil@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/dubai.jpg') }}" alt="" />
                            <span>dubai</span>
                            <p>Email ID : <a href="mailto:dubai@weunite91.com">dubai@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/indonesia.jpg') }}" alt="" />
                            <span>indonesia</span>
                            <p>Email ID : <a href="mailto:indonesia@weunite91.com">indonesia@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/jordan.jpg') }}" alt="" />
                            <span>jordan</span>
                            <p>Email ID : <a href="mailto:jordan@weunite91.com">jordan@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/peru.jpg') }}" alt="" />
                            <span>peru</span>
                            <p>Email ID : <a href="mailto:peru@weunite91.com">peru@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/singapore.jpg') }}" alt="" />
                            <span>singapore</span>
                            <p>Email ID : <a href="mailto:singapore@weunite91.com">singapore@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/srilanka.jpg') }}" alt="" />
                            <span>srilanka</span>
                            <p>Email ID : <a href="mailto:srilanka@weunite91.com">srilanka@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/turkey.jpg') }}" alt="" />
                            <span>turkey</span>
                            <p>Email ID : <a href="mailto:turkey@weunite91.com">turkey@weunite91.com</a></p>
                        </li>
                        <li>
                            <img src="{{ asset('public/frontend/image/locations/ukraine.jpg') }}" alt="" />
                            <span>ukraine</span>
                            <p>Email ID : <a href="mailto:ukraine@weunite91.com">ukraine@weunite91.com</a></p>
                        </li>
                    </ul>

            </div>
        </div>
    </div>
    @endsection