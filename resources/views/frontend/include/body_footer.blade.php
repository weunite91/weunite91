@if(Request::url() === url('/'))
<div id="Partner-With-Us">
    <div id="Partner-With-Us-Intra">
        <div class="table-div">
            <div class="table-cell partner-with-us-l">
                <div class="theme-L"></div>
                <div class="heading">
                    <a href="{{ route("howto-partner") }}">Partner With Us </a><span>We believe in growing together</span>
                </div>
            </div>
            <div class="table-cell partner-with-us-r">
                <div class="theme-R"></div>
                <div class="demo">
                    <ul id="Slider2" class="rslides">
                        <li data-thumb="{{ asset('public/frontend/image/cS-1.jpg') }}" id="Partner0" class="Partner_on" style="float: left; position: relative; opacity: 1; z-index: 2; display: list-item; transition: opacity 1000ms ease-in-out 0s;">
                            <img src="{{ asset('public/frontend/image/cS-1.jpg') }}">
                        </li>
                        <li data-thumb="{{ asset('public/frontend/image/cS-2.jpg') }}" id="Partner1" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 1000ms ease-in-out 0s;" class="">
                            <img src="{{ asset('public/frontend/image/cS-2.jpg') }}">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
<div id="Quick-Links">
    <div id="Quick-Links-Intra">
        <div class="table-div ql-intra">
            <div class="table-cell ql-l">
                <div class="theme-L"></div>
                <p>A Supporting hand in every stage<a href="#popup1">Ask Our Expert</a></p>
                <!-- <a href="raising-finance.html" class="ql-btn">Raising Finance</a> -->
            </div>
            <div class="table-cell ql-r">
                <p>World's most trusted investment platform</p>
                <a href="{{ route("howto-franchise") }}" class="ql-btn">Franchise Your Business</a>
            </div>
        </div>
    </div>
</div>

<div id="popup1" class="overlayPOP">
    <div class="popup popup-enquiry">
        <div class="popupTitle">Get an professional advice</div>
        <a class="close" href="#">&times;</a>
        <form name="supportform" id="supportform" action="{{ route('supporting-hand') }}" method="post" enctype="multipart/form-data">{{ csrf_field() }}
            <div class="block-area">
                <label class="textcenter">
                    <input type="checkbox" name="qureytype[]" value="1" class="agree-box" checked="checked"> Prepare your financial &amp; financial offering
                </label>
            </div>
            <div class="block-area">
                <label class="textcenter">
                    <input type="checkbox" name="qureytype[]" value="2" class="agree-box"> Consulting a legal aspect of the deal
                </label>
            </div>
            <div class="block-area">
                <label class="textcenter">
                    <input type="checkbox" name="qureytype[]" value="3" class="agree-box"> Prepare your pitch deck
                </label>
            </div>
            <div class="block-area">
                <label class="textcenter">
                    <input type="checkbox" name="qureytype[]" value="4" class="agree-box"> Prepare your videos &amp; photos for your pitch deck
                </label>
            </div>
            <div class="inline-input ">
                <input type="text" name="fullname" placeholder="First Name *" />
            </div>
            <div class="inline-input ">
                <input type="text" name="mobilenumber" placeholder="Mobile Number *" onkeypress="return isNumber(event);" />
            </div>
            <div class="inline-input ">
                <input type="email" name="supportemail" placeholder="Email *" />
            </div>
            <div class="inline-input block-area">
                <textarea name="querymsg" placeholder="Query/Feedback" maxlength="240"></textarea>
            </div>
            <div class="inline-input submit-reset">
                <input type="reset" class="reset-btn" />
                <input type="submit" class="submitform" value="Submit Now" />
            </div>
        </form>
    </div>
</div>



<footer>
    <div id="Footer">

        <div class="footer-main-grid">

            <div class="footer-grid footer-united">

                <div class="pHead">WE UNITE 91</div>
                <div class="footer-content">
                    <ul>
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <!-- <li><a href="faq.html">FAQ</a></li> -->
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>


            <div class="footer-grid footer-business">

                <div class="pHead">Business</div>
                <div class="footer-content">
                    <ul>
                        <li><a href="{{ route('raising-finance',1) }}">Invest</a></li>
                        <li><a href="{{ route('raising-finance',1) }}">Sell Your Business</a></li>
                        <li><a href="{{ route('raising-finance',1) }}">Franchise Your Business</a></li>
                    </ul>
                </div>
            </div>


            <div class="footer-grid footer-investor">

                <div class="pHead">Investor</div>
                <div class="footer-content">
                    <ul>
                        <li><a href="{{ route('investor',1) }}">Individual Investor</a></li>
                        <li><a href="{{ route('investor',1) }}">Business Buyer</a></li>
                        <li><a href="{{ route('investor',1) }}">Corporate Investor</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-grid footer-legal" style="width:180px !important">

                <div class="pHead">Legal</div>
                <div class="footer-content">
                    <ul>
                        <li><a href="{{ route('terms-and-conditions') }}">Terms of use</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('refund-policy') }}">Refund Policy</a></li>

                    </ul>
                </div>
            </div>

            <div class="footer-grid pull-right" style="text-align:right !important;width:80px !important;margin:0px 0px !important">

                <div class="pull-right">

                    <ul class="social-footer ">
                        <li ><a rel="nofollow" href="https://www.facebook.com/We-Unite-91-102349501325030/?modal=admin_todo_tour" target="_blank" >
                                <img src="{{ asset('public/frontend/image/fb.png') }}" alt="facebook" >
                            </a></li>
                        <li ><a rel="nofollow" href="https://twitter.com/91Unite" target="_blank" >
                                <img src="{{ asset('public/frontend/image/tw.png') }}" alt="twitter" >
                            </a></li>
                        <li ><a rel="nofollow" href="https://www.google.co.in/" target="_blank" >
                                <img src="{{ asset('public/frontend/image/g.png') }}" alt="google" >
                            </a></li>
                        <li ><a rel="nofollow" href="https://www.instagram.com/" target="_blank" >
                                <img src="{{ asset('public/frontend/image/i.png') }}" alt="google" >
                            </a></li>
                        <li ><a rel="nofollow" href="https://www.linkedin.com/in/we-unite-nine-one-a008461a0/" target="_blank" >
                                <img src="{{ asset('public/frontend/image/in.png') }}" alt="google" >
                            </a></li>
                    </ul>
                </div>

            </div>

        </div>	


        <div class="row">
            <div class="col-md-6 col-lg-6 copyrights" >
                &copy; 2020 WEUNITE91, All Rights Reserved
            </div>
            <div  class="col-md-6 col-lg-6 copyrights" >

                <div class="pull-right">
                    <div class="paymentsimage" >
                        <img id="visa" src="https://weunite91.com/public/frontend/image/img_trans.gif"  alt="payments"/>
                    </div>
                    <div class="paymentsimage">
                        <img id="master" src="{{ asset('public/frontend/image/img_trans.gif') }}"alt="payments"/>
                    </div>
                    <div class="paymentsimage">
                        <img id="amex" src="{{ asset('public/frontend/image/img_trans.gif') }}"alt="payments"/>
                    </div>
                    <div class="paymentsimage">
                        <img id="netbanking" src="{{ asset('public/frontend/image/img_trans.gif') }}"alt="payments"/>
                    </div>
                    <div class="paymentsimage">
                        <img id="upi" src="{{ asset('public/frontend/image/img_trans.gif') }}"alt="payments"/>
                    </div>
                </div>

            </div>

        </div>
</footer>
<button class="material-scrolltop" type="button"></button>
<style>
    .paymentsimage {

        width: auto;
        height: 25px;
        position: relative;
        overflow: hidden;
        float:left !important;
        margin-right:3px !important;
    }
    .paymentsimage img {
        margin: auto;
        display: block;
    }
    #paypal {
        width: 47px;
        height: 30px;
        background: url({{ asset('public/frontend/image/accepted-payments.jpg') }}) 0 0;
    display:none;
    }
    #visa {
        width: 47px;
        height: 30px;
        background: url({{ asset('public/frontend/image/accepted-payments.jpg') }});
    background-position: -55px -1px; 
    }
    #master {
        width: 47px;
        height: 30px;
        background: url({{ asset('public/frontend/image/accepted-payments.jpg') }});
    background-position: -105px -1px; 
    }
    #amex {
        width: 51px;
        height: 30px;
        background: url({{ asset('public/frontend/image/accepted-payments.jpg') }});
    background-position: -153px -1px; 
    }
    #netbanking {
        width: 80px;
        height: 30px;
        background: url({{ asset('public/frontend/image/accepted-payments.jpg') }});
    background-position: -203px -1px; 
    }
    #upi {
        width: 62px;
        height: 30px;
        background: url({{ asset('public/frontend/image/accepted-payments.jpg') }});
    background-position: -283px -1px; 
    }
</style>