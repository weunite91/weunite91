


<!DOCTYPE html>
<html>
<head>

<title>Payment Processing</title>
	<script>
    function submitForm() {
      var postForm = document.forms.postForm;
     postForm.submit();
    }
</script>
</head>
<body onload="submitForm();">
<div>
	<form name="postForm" action="{{ $payuurl}}" method="POST" >
    {{ csrf_field() }}
		<input type="hidden" name="key" value="{{$MERCHANT_KEY}}" />
        <input type="hidden" name="txnid" value="<?php echo $txn_id;  ?>" />
        <input type="hidden" name="amount" value="<?php echo $amounttopay;  ?>" />
        <input type="hidden" name="productinfo" value="<?php echo $productinfo;  ?>" />
		
		
		
		<input type="hidden" name="firstname" value="<?php echo $firstname;  ?>" />
		<input type="hidden" name="email" value="<?php echo $email;  ?>" />
		<input type="hidden" name="phone" value="<?php echo $phone;  ?>" />

       <input type="hidden" name="udf1" value="<?php echo $udf1;  ?>" />
        <input type="hidden" name="udf2" value="<?php echo $udf2;  ?>" />
        <input type="hidden" name="udf3" value="<?php echo $udf3;  ?>" />
        <input type="hidden" name="hash" value="<?php echo $hash;  ?>"/>
		<input type="hidden" name="surl" value="<?php echo $surl;  ?>" />
        <input type="hidden" name="furl" value="<?php echo $furl;  ?>"/>

		<input type="hidden" name="service_provider" value="<?php echo $service_provider;  ?>" size="64" />
      
		
	</form>
</div>
</body>
</html>