<div id="popup1" class="overlayPOP">
    <div class="popup popup-enquiry">
        <div class="popupTitle">Get an professional advice</div>
        <a class="close" href="#">&times;</a>
        <form name="assistform" id="assistform" action="{{ route('glad-to-assist' )}}" method="post" enctype="multipart/form-data">{{ csrf_field() }}
            <div class="block-area">
                <label class="textcenter">
                    <input type="checkbox" name="" value="" class="agree-box"> Prepare your financial &amp; financial offering
                </label>
            </div>
            <div class="block-area">
                <label class="textcenter">
                    <input type="checkbox" name="" value="" class="agree-box"> Consulting a legal aspect of the deal
                </label>
            </div>
            <div class="block-area">
                <label class="textcenter">
                    <input type="checkbox" name="" value="" class="agree-box"> Prepare your pitch deck
                </label>
            </div>
            <div class="block-area">
                <label class="textcenter">
                    <input type="checkbox" name="" value="" class="agree-box"> Prepare your videos &amp; photos for your pitch deck
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
                <input type="submit" value="Submit Now" />
            </div>
        </form>
    </div>
</div>