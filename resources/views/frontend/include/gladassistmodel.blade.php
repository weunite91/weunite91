
<div class="fixed-contact"> 
    <a class="enquiry" style="cursor: pointer !important">Glad to assist you</a>
    <div class="fixed-contact-intra">
        <a  class="close-btn">X</a>
        <div class="quick-form">    
            <div class="formtitle">Glad to assist</div>
            <form name="gladform" id="gladform" action="{{ route('glad-to-assist' )}}" method="post" enctype="multipart/form-data">{{ csrf_field() }}
              
                <div class="quick-inline-input">
                    <input type="text" name="glad_fullname" placeholder="First Name *" />
                </div>
                <div class="quick-inline-input">
                    <input type="number" name="glad_mobilenumber" placeholder="Mobile Number *" onkeypress="return isNumber(event);" />
                </div>
                <div class="quick-inline-input">
                    <input type="support" name="glad_supportemail" placeholder="Email *" />
                </div>
                <div class="quick-inline-input">
                    <textarea name="glad_querymsg" placeholder="Query/Feedback" maxlength="240"></textarea>
                </div>
                <div class="quick-submit">
                    <input type="reset" class="reset-btn" />
                    <input type="submit" class="submitform" value="Submit Now" />
                </div> 
            </form>
        </div>
    </div>
</div>