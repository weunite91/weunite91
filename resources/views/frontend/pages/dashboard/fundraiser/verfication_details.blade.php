

                <!-- Button to Open the Modal -->
<button type="button" id="btnverficationModal" style="display:none"
class="btn btn-primary" data-toggle="modal" data-target="#verficationModal">
  Open modal
</button>

<!-- The Modal -->
<div class="modal fade bd-example-modal-lg" id="verficationModal"  >
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" >

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Verfication Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">



        <form id="frmVerfication" method="post" action="{{ route('confirm-verify-details')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

            <div class="block-area" style="margin-left:10px ; padding: 0px;">
                <label>Address</label>
                <textarea name="ver_address" id="ver_address" maxlength="250" placeholder="Address *" >{{ $userDetails[0]->address != null ? $userDetails[0]->address : '' }}</textarea>
            </div>

            <div class="inline-input">
                <label>Country</label>
                <select class="full-col ver_country" id="ver_country" name="ver_country" >
                <option value="" >Country *</option>
                @foreach($countryname as $key => $value)
                <option value="{{ $value['id'] }}" {{ $userDetails[0]->country != null && $userDetails[0]->country == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                @endforeach
                </select>

            </div>

                <div class="inline-input">
                <label>State</label>
                    <select class="full-col ver_state" id="ver_state" name="ver_state" >
                        <option value=""> State *</option>
                        @foreach($statelist as $key => $value)
                        <option value="{{ $value['id'] }}" {{ $userDetails[0]->state != null && $userDetails[0]->state == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="inline-input">
                <label>City</label>
                    <select class="full-col ver_city" id="ver_city" name="ver_city">
                        <option value=""> City *</option>
                        @foreach($citylist as $key => $value)
                        <option value="{{ $value['id'] }}" {{ $userDetails[0]->city != null && $userDetails[0]->city == $value['id'] ? 'selected="selected"' : '' }}>{{ $value['name'] }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="inline-input">
                <label>Pincode</label>
                    <input type="text" value="{{ $userDetails[0]->pincode != null ? $userDetails[0]->pincode : '' }}" maxlength="12"
                    name="ver_pincode" id="ver_pincode" placeholder="Pincode *" onkeypress="return isNumber(event);"/>
                </div>

                @php
               $profile_code=$profiledata[0]->profile_code;
               if( $userDetails[0]->country!=null)
               {

                $amount='2,300';
                  $amount_text='Two Thousand Three Hundred';
                if( $userDetails[0]->country==101)
                {
                  $amount='2,300';
                  $amount_text='Two Thousand Three Hundred';
                }
               }
               @endphp

                <div class="inline-input" style="width:100% !important">
                Profile Code: {{$profile_code}}<br/>
                I wish to have my business verified which will be supportive for
                the investors to pursue, I am willing to pay the verification
                charges of INR {{$amount}}- (Rupees {{$amount_text}} only).
              </div>



              <div class="block-area">
                    <input type="checkbox" id="cbu_checkbox" name="cbu_checkbox" style="vertical-align:middle !important" />
                    <span style="vertical-align:middle !important" >I agree with </span>
                    <a href="{{ route('terms-and-conditions') }}" target="_blank" style="color:blue;vertical-align:middle !important"> Terms & Conditions</a>
              </div>
              <div class="block-area">
                  <div style="text-align:center;font-weight:bold">Pay INR {{$amount}}</div>

              </div>
      <!-- Modal footer -->
      <div class="modal-footer">
      <input type="submit" class="btn btn-primary" style="background-color:#fce32a !important" class="verifysubmitbtn" name="verifysubmitbtn"  value="Pay Now"/>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

      </form>

      </div>
    </div>
  </div>
</div>

