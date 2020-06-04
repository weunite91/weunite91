@extends('frontend.layout.layout')

@section('content')
<div id="Content-Container">
		<div id="Content-Main">
			<div class="table-div">
				<div id="Content" class="table-cell">
					<article class="textMain ">
					{{ csrf_field() }}
					
					@if ($status=='success')

					<div class="payment-confirm">
						<p style="text-align:center">
							<i class="fa fa-check-circle" aria-hidden="true" style="font-size:48px;color:green"></i>
							</p>
								<p style="text-align:center;color:black !important;clear:both !important ">
									Your Transaction Id: <b>{{$txnid}} </b>. 
</p>
								<p style="text-align:center !important;color:black !important;clear:both !important ">
								Your Transaction is Successfull.
</p>
								<p style="text-align:center !important;color:black !important ;clear:both !important">
								Thank You
</p>
							
						</div>
						@else
						<div class="payment-confirm">
						
							<p style="text-align:center">
							<i class="fa fa-times-circle" aria-hidden="true" style="font-size:48px;color:red"></i>
								<div class="row" style="text-align:center;color:black !important ">
									<h3 style="text-align:center;color:black !important ">Your Transaction Id:{{$txnid}}</h3>	
									<h3 style="text-align:center;color:black !important ">Your Transaction is Failure.Please Try again.</h3>	
									<h3 style="text-align:center;color:black !important ">Thank You</h3>
								</div>
							</p>
						
						</div>
						@endif
						
						
						<div class="go-back-btn" style="display:none">
							<a href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
						</div>
						
					</article>
				</div>
			</div>
		</div>
	</div>	

@endsection