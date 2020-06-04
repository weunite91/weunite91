@extends('frontend.layout.layout')

@section('content')
<div id="Content-Container">
		<div id="Content-Main">
			<div class="table-div">
				<div id="Content" class="table-cell">
					<article class="textMain ">
						<h1>Pay Now</h1>
							
						
						<div class="payment-confirm">
							<form id="paynow" method="post" action="" enctype="multipart/form-data">{{ csrf_field() }}
							<ul>
								<li>Business Code : <span>{{ $userdetail[0]->profile_code}}</span></li>
								<li>Investment Offered : <span>INR {{indian_money_format($amount)}}</span></li>
								<li>Refundable Commitment Amount (0.5%) : <span> INR {{indian_money_format($commision)}}</span></li>
								<li><input type="checkbox" name="terms" value="terms" class="agree-box"> I have read and accepted the <a href="{{ route('terms-and-conditions') }}">terms of use</a></li>
								<li><input type="checkbox" name="refund" value="refund" class="agree-box"> I have read and accepted the <a href="{{ route('refund-policy') }}">refund policies</a></li>
								<li class="pay-now"><span>Pay INR : </span> {{indian_money_format($commision)}}</li>
								<li>
									<div class="inline-input submit-reset">
										<input type="submit" value="Pay Now">
									</div>
								</li>
							</ul>
						</form>
						</div>
						
						
						<div class="go-back-btn">
							<a href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
						</div>
						
					</article>
				</div>
			</div>
		</div>
	</div>	

@endsection