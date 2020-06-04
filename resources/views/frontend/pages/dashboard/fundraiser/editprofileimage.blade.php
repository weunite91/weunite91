@extends('frontend.layout.layout')
@php

$items = Session::get('logindata');
@endphp
@section('content')
    <style>
        .alert {
            padding: 20px;
            background-color: #4CAF50;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
    <!--#include file="includes/header.shtml"-->
    <div class="main-container">
        @if(Session::has('success'))
        <div class="alert success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>{{ Session::get('success') }} !</strong>
        </div>
        @endif
        @include('frontend.include.profiledetails')
        
        <div class="forms">
            <div class="contact-form">	
                <div class="formtitle">
                    <center>Update Profile Picture</center>
                </div>
                
				
                    <form method="post" action="" enctype="multipart/form-data" id="profileimage">{{ csrf_field() }}
                        <div class="inline-input" style="width: 100%">
                            <input type="file" name="profileimage_new"  placeholder="Enter Partner Code" accept='image/*'/>
                        </div>
                        
                        <div class="inline-input submit-reset">
                            <center>
                                <input type="reset" style="width: 40%" class="reset-btn" />
                                <input type="submit" style="width: 40%" class="submitbtn" name="submit_now" value="Update profile picture"/>
                            </center>
                        </div>
                    </form>
			</div>
			
			
			
		
		
		
		
			

		<div id="popupOTP" class="overlayPOP">
			<div class="popup popup-enquiry">
				<div class="popupTitle">Please enter the 6-digit verification code sent to registered email id.</div>
				<a class="close" href="#">&times;</a>
				<div id="form">
				  <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
				  <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
				  <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
				  <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
				  <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
				  <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
				  <button class="btn btn-primary btn-embossed">Verify</button>
				</div>
				<a href="#" class="send-code-text">Send code again</a>
			</div>
		</div>
			
			
			
			
			
		
	</div>


       


    </div>
    


    

    <script type="text/javascript">
        $('.alert').fadeOut(5000);
    </script>


    <!--#include file="includes/footer.shtml"-->
@endsection
