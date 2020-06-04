<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Mail;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\InvoiceItems;
class VerificationDetails extends Model {
    protected $table = 'verification_details';
    protected $primaryKey = 'verfication_id';

    function __construct() {
    }
    public function get_verification_details($user_id)
    {

        $verifyResult= VerificationDetails::where("user_id","=",$user_id)
            ->select("*")
            ->get();
        return $verifyResult;
    }
    public function update_payment_details($login_user_id,$amount,$product_type,$txnid)
    {
        $verifyResult=VerificationDetails::where("user_id","=",$login_user_id)->first();
        $verifyResult->amount=$amount;
        $verifyResult->txn_id=$txnid;
        $verifyResult->status="Pending";
        return $verifyResult->save();
    }
    
    public function save_verfication_details($request,$user_id)
    {
        $verifyResult=VerificationDetails::where("user_id","=",$user_id)->first();
        if ($verifyResult!=null)
        {
            
            $verifyResult->user_id=$user_id;
           $verifyResult->address1=$request->input('ver_address');
           $verifyResult->address2='';
           $verifyResult->city=$request->input('ver_city');
           $verifyResult->state=$request->input('ver_state');
           $verifyResult->country=$request->input('ver_country');
           $verifyResult->pincode=$request->input('ver_pincode');
           $verifyResult->status="";
           $verifyResult->created_by=$user_id;
           $verifyResult->updated_by=$user_id;
           return $verifyResult->save();
        }
        else{
          
           $this->user_id=$user_id;
           $this->address1=$request->input('ver_address');
           $this->address2='';
           $this->city=$request->input('ver_city');
           $this->state=$request->input('ver_state');
           $this->country=$request->input('ver_country');
           $this->pincode=$request->input('ver_pincode');
           $this->status="";
           $this->created_by=$user_id;
           $this->updated_by=$user_id;
           return $this->save();
        }
       
        
    }
    public function changeverifyaddressstatus($request) {
        $objVerificationDetailsUpdate = VerificationDetails::
                                        find($request->input('id'));
                                        
        $objVerificationDetailsUpdate->status = $request->input('val');
        $objVerificationDetailsUpdate->updated_at = date("Y-m-d h:i:s");
        $result = $objVerificationDetailsUpdate->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function free_verify($request)
    {

        $verifyResult=VerificationDetails::where("user_id","=",$request->input('id'))->first();
        if ($verifyResult!=null)
        {
            $verifyResult->status=$request->input('val');
            $verifyResult->updated_by=$request->input('id');
            $result= $verifyResult->save();
            
        }
        else{
            $userDetails = 
            DB::table('fund_raise_details')
                ->where('user_id','=',$request->input('id'))
                ->get();
                
                $this->user_id=$userDetails[0]->user_id;
                $this->address1=$userDetails[0]->address;
                $this->address2='';
                $this->city=$userDetails[0]->city;
                $this->state=$userDetails[0]->state;
                $this->country=$userDetails[0]->country;
                $this->pincode=$userDetails[0]->pincode;
                $this->status=$request->input('val');
                $this->created_by=$request->input('id');
                $this->updated_by=$request->input('id');
                $result= $this->save();
        }
        
        if ($result) {
        return true;
        } else {
        return false;
}

    }
}
?>