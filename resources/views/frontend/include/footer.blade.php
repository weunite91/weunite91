@php
$currentRoute = Route::current()->getName();
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<!-- <script src="{{ asset('public/frontend/js/customjs/sweetalert2.js') }}"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{ asset('public/frontend/js/responsiveslides.js') }}"></script>
<script src="{{ asset('public/frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('public/frontend/js/chart.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.simplePagination.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('public/frontend/js/material-scrolltop.js') }}"></script>
<script src="{{ asset('public/frontend/js/html5.js') }}"></script>
<script src="{{ asset('public/frontend/js/functions.js') }}"></script>
<script src="{{ asset('public/frontend/js/validate/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/backend/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" ></script>
<script src="{{ asset('public/frontend/js/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/frontend/js/ajaxfileupload.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/frontend/js/jquery.form.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/frontend/js/comman_function.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/frontend/js/materialize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/frontend/js/comman_validate.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>


@if (!empty($pluginjs))
@foreach ($pluginjs as $value)
<script src="{{ url('public/frontend/assets/js/plugins/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif

@if (!empty($js))
@foreach ($js as $value)
<script src="{{ url('public/frontend/js/customjs/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif
@if( $currentRoute == 'planlist' )
@if($userDetails[0]->first_active == '0')
  <style type="text/css">
   #swal2-content{
    text-align: left !important;
   }
  </style>
    <script>
   Swal.fire({
 title: '<p style:"font-size:16px;text-align:left;"><u>Congratulations </u>!</p>',
 html: '<p style="font-size:14px;font-weight:900;">Your Profile is Successfully Uploaded.</p><br><p style="font-size:12px;">To make your Profile Active,<i>Two Steps Verifications </i> will be performed :</p><br> <ul type = "disc"><li style="list-style-type: circle;margin-left: 10%;font-size: 12px;">&nbsp;Our Customer Support Officer will be calling you in 2 working days to approve your profile.</li><li style="list-style-type: circle;margin-left: 10%;font-size: 12px;">You will be receiving a welcome message in your WhatsApp./SMS.</li></ul>',

});
     
    </script>

@endif
@endif


<script>
jQuery(document).ready(function() {
@if (!empty($funinit))
        @foreach ($funinit as $value)
{{ $value }}
@endforeach
        @endif
        });</script>
<script src="{{ asset('public/frontend/js/my.js') }}" type="text/javascript"></script>

