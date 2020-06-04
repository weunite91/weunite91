<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class Payumoney {

    private $payu_money_url = "https://sandboxsecure.payu.in/_payment";
    //private $payu_money_url='https://secure.payu.in/_payment';
    private $payu_money_mechant_key = 'pFmUrfYr';
    private $payu_money_salt = 'WBs2gROi1q';

    function __construct() {
       
        //
    }

    function payumoney_common_properties($amount, $producttype, &$data,$request) {

        $full_url=$request->fullUrl();
        $is_dev_env=strpos($full_url,'localhost/',0);
        if ($is_dev_env ==false)
        {
            $this->payu_money_url='https://secure.payu.in/_payment';
        }
        else{
            $this->payu_money_url='https://sandboxsecure.payu.in/_payment';
        }
        $login_id = $data['loginid'];
        $user_details = $data['userdetail'][0];
        // $txn_id=time().rand(1000,99999).$login_id;
        $txn_id = time() . "-" . explode("-", $user_details->profile_code)[1] . "-" . rand(111111, 999999);
        $data['payuurl'] = $this->payu_money_url;
        $data['txn_id'] = $txn_id;
        $data['loginid'] = $login_id;
        $data['amounttopay'] = $amount;
        $data['productinfo'] = $producttype;
        $data['firstname'] = $user_details->firstname;
        $data['email'] = $user_details->email;
        $data['phone'] = $user_details->number;
        $data['service_provider'] = "payu_paisa";
        $data['udf1'] = $data['actualamount'];
        $data['udf2'] = $data['frompage'];
        $data['udf3'] = $data['pitchid'];
        $hashseq = $this->payu_money_mechant_key . '|' . $data['txn_id'] . '|' .
                $data['amounttopay'] . '|' . $data['productinfo'] . '|' .
                $data['firstname'] . '|' . $data['email'] . '|' .
                $data['udf1'] . '|' . $data['udf2'] . '|' .
                $data['udf3'] . '||||||||' . $this->payu_money_salt;
        $hash = strtolower(hash("sha512", $hashseq));
        $data['hash'] = $hash;
        $data['MERCHANT_KEY'] = $this->payu_money_mechant_key;
        $url = url('/');
        $data['surl'] = url('/') . '/payu-response/' . $data['pitchid'];
        $data['furl'] = url('/') . '/payu-cancel/' . $data['pitchid'];
        return $data;
    }

  

    function check_payu_response($request) {
        $key = $request->input('key');
        $salt = $this->payu_money_salt;
        $txnid = $request->input('txnid');
        $amount = $request->input('amount');
        $productInfo = $request->input('productinfo');
        $firstname = $request->input('firstname');
        $email = $request->input('email');
        $udf1 = $request->input('udf1');
        $udf2 = $request->input('udf2');
        $udf3 = $request->input('udf3');
        $mihpayid = $request->input('mihpayid');
        $status = $request->input('status');
        $resphash = $request->input('hash');

        //Calculate response hash to verify	
        $keyString = $key . '|' . $txnid . '|' . $amount . '|' . $productInfo . '|' .
        $firstname . '|' . $email . '|' . $udf1 . '|' .
        $udf2 . '|' . $udf3 . '|||||||';
        $keyArray = explode("|", $keyString);
        $reverseKeyArray = array_reverse($keyArray);
        $reverseKeyString = implode("|", $reverseKeyArray);
        $CalcHashString = strtolower(hash('sha512', $salt . '|' . $status . '|' . $reverseKeyString));

        if ($resphash != $CalcHashString) {
            return 'tampered';
        } else if ($status == 'success') {
            return 'success';
        } else {
            return 'failed';
        }
    }

}

?>