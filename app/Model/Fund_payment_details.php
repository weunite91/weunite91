<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\All_paymentModel;
use DB;
class Fund_payment_details extends Model
{
    //
    protected $table = 'fundraiser_payment_details';
    public function get_plan_days($plan)
    {
        $plan=strtolower($plan);
        if($plan=='free'){
            $data['day']=0;
        }elseif ($plan=="treasure") {
            $data['day']=15;
        }elseif ($plan=="gilded") {
            $data['day']=30;
        }elseif ($plan=="platinum") {
            $data['day']=45;
        }elseif ($plan=="preferred") {
            $data['day']=60;
        }elseif ($plan=="royal") {
            $data['day']=60;
        }
        return  $data['day'];
    }
    public function update_plan_by_passcode($userid,$amount,$planname,$transactionID,$objUsersPasscode)
    {
        $session = session()->all();
        $plandays=$this->get_plan_days($planname);
        $deleterecord = Fund_payment_details::where('user_id', $userid)->delete();
        $objPaymentdetails = new Fund_payment_details();
        $objPaymentdetails->user_id = $userid;
        
        $objPaymentdetails->payment_no = $transactionID;
        $objPaymentdetails->amount = $amount;
        $objPaymentdetails->planname = $planname;
        $objPaymentdetails->paymnet_status = "S";
        $objPaymentdetails->days = strval($plandays) ;
        $objPaymentdetails->created_at = date("Y-m-d h:i:s");
        $objPaymentdetails->updated_at = date("Y-m-d h:i:s");
        
        if($objPaymentdetails->save()){
            $objUsersPasscode->is_used='Y';
            $objUsersPasscode->save();
        }
    }
    public function addpaymentdetails($userid,$amount,$planname,$transactionID){
        $session = session()->all();
        $plandays=$this->get_plan_days($planname);
        $deleterecord = Fund_payment_details::where('user_id', $userid)->delete();
        $objPaymentdetails = new Fund_payment_details();
        $objPaymentdetails->user_id = $userid;
        
        $objPaymentdetails->payment_no = $transactionID;
        $objPaymentdetails->amount = $amount;
        $objPaymentdetails->planname = $planname;
        $objPaymentdetails->paymnet_status = "S";
        $objPaymentdetails->days = strval($plandays) ;
        $objPaymentdetails->created_at = date("Y-m-d h:i:s");
        $objPaymentdetails->updated_at = date("Y-m-d h:i:s");
        
        if($objPaymentdetails->save()){

            $objuserUpdate = Users::find($userid);
            $objuserUpdate->staff_verify_status = "0";
            $objuserUpdate->admin_verify_status = "0";
            $objuserUpdate->updated_at = date("Y-m-d h:i:s");
             $objuserUpdate->save();
            if ($planname =='Free')
            {
               
            }
            else{
                $objAllpayment = new All_paymentModel();
                $objAllpayment->user_id =  $userid;
                $objAllpayment->profile_code = $session['logindata'][0]['profile_code'];
                $objAllpayment->transaction_id = $transactionID;
                $objAllpayment->paid_amount = $amount;
                $objAllpayment->paid_for = $planname;
                 $objAllpayment->save();
            }
            $objUserMail=new Users();
            $objUserMail->sendmail_to_user_firsttime( $userid);
            return true;
            

           
         }else{
             return false;
         }
    }

    public function editFundPaymentAdmin($request,$id){

        if($request->input('planname')=='Free'){
            $day='0';
        }elseif ($request->input('planname')=="Treasure") {
            $day='15';
        }elseif ($request->input('planname')=="Gilded") {
            $day='30';
        }elseif ($request->input('planname')=="Platinum") {
            $day='45';
        }elseif ($request->input('planname')=="Preferred") {
            $day='60';
        }elseif ($request->input('planname')=="Royal") {
            $day='60';
        }
        
        $getid = DB::table('fundraiser_payment_details')->select("id")->where('user_id', $id)->get();
        if (count($getid)>0)
        {
            $objPaymentdetails = Fund_payment_details::find($getid[0]->id);
        }
        else{
            $objPaymentdetails =new Fund_payment_details();
            $objPaymentdetails->user_id=$id;
        }
        
        $objPaymentdetails->amount = $request->input('amount');
        $objPaymentdetails->planname = $request->input('planname');
        $objPaymentdetails->days = $day;
        $objPaymentdetails->updated_at = date("Y-m-d h:i:s");
        
        if($objPaymentdetails->save()){
                $objuserUpdate = Users::find($id);
                $objuserUpdate->active_date = date("Y-m-d");
            // $objuserUpdate->admin_verify_status = "0";
            // $objuserUpdate->updated_at = date("Y-m-d h:i:s");
            return  $objuserUpdate->save();
         }else{
             return false;
         }
    }
}
