<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\All_paymentModel;
use App\Model\PaymentPlans;
use DB;
class Franchise_payment_details extends Model
{
    //
    protected $table = 'franchise_payment_details';
    
    public function update_plan_by_passcode($userid,$amount,$plan_id,$transactionID,$objUsersPasscode)
    {
        $session = session()->all();
        $objPlanlist=new PaymentPlans();
        $plan_details= $objPlanlist->get_payment_list('F',$plan_id);
        $deleterecord = Franchise_payment_details::where('user_id', $userid)->delete();
        $objPaymentdetails = new Franchise_payment_details();
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
    public function addpaymentdetails($userid,$amount,$plan_id,$transactionID){
        $session = session()->all();
        $objPlanlist=new PaymentPlans();
        $plan_details= $objPlanlist->get_payment_list('F',$plan_id);
        $plandays=$plan_details[0]->plan_duration*31;
        $deleterecord = Franchise_payment_details::where('user_id', $userid)->delete();
        $objPaymentdetails = new Franchise_payment_details();
        $objPaymentdetails->user_id = $userid;
        
        $objPaymentdetails->payment_no = $transactionID;
        $objPaymentdetails->amount = $amount;
        $objPaymentdetails->planname = $plan_details[0]->plan_type. "-" .$plan_details[0]->plan_name;
        $objPaymentdetails->paymnet_status = "S";
        $objPaymentdetails->days = strval($plandays) ;
        $objPaymentdetails->created_at = date("Y-m-d h:i:s");
        $objPaymentdetails->updated_at = date("Y-m-d h:i:s");
        
        if($objPaymentdetails->save()){
           

            $objAllpayment = new All_paymentModel();
            $objAllpayment->user_id =  $userid;
            $objAllpayment->profile_code = $session['logindata'][0]['profile_code'];
            $objAllpayment->transaction_id = $transactionID;
            $objAllpayment->paid_amount = $amount;
            $objAllpayment->paid_for = $objPaymentdetails->planname;
            $result1 = $objAllpayment->save();

            $objuserUpdate = Users::find($userid);
            $objuserUpdate->staff_verify_status = "0";
            $objuserUpdate->admin_verify_status = "0";
            $objuserUpdate->updated_at = date("Y-m-d h:i:s");
            $objuserUpdate->save();
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
        
        $getid = DB::table('franchise_payment_details')->select("id")->where('user_id', $id)->get();
        if (count($getid)>0)
        {
            $objPaymentdetails = Franchise_payment_details::find($getid[0]->id);
        }
        else{
            $objPaymentdetails =new Franchise_payment_details();
            $objPaymentdetails->user_id=$id;
        }
        
        $objPaymentdetails->amount = $request->input('amount');
        $objPaymentdetails->planname = $request->input('planname');
        $objPaymentdetails->days = $day;
        $objPaymentdetails->updated_at = date("Y-m-d h:i:s");
        
        if($objPaymentdetails->save()){
            // $objuserUpdate = Users::find($request->input('userid'));
            // $objuserUpdate->staff_verify_status = "0";
            // $objuserUpdate->admin_verify_status = "0";
            // $objuserUpdate->updated_at = date("Y-m-d h:i:s");
            return  $objPaymentdetails->save();
         }else{
             return false;
         }
    }
}
