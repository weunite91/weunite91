<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Homemodel;
use App\Model\Favourite_pitch;
use App\Model\Fundriser_investment_offered;
use App\Model\All_paymentModel;
use DB;

class Homemodel extends Model {

    protected $table = 'users';

    public function getPitches() {
        $result = DB::table('users')
                ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "users.id")
                ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "users.id")
                ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "users.id")
                ->leftjoin("industry", "fund_raise_details.industry", "=", "industry.id")
                ->leftjoin("cities", "fund_raise_details.city", "=", "cities.id")
                ->leftjoin("states", "fund_raise_details.state", "=", "states.id")
                ->leftjoin("countries", "fund_raise_details.country", "=", "countries.id")
                ->leftjoin("fund_raiser_image", "fund_raiser_image.user_id", "=", "fund_raiser_company_details.user_id")
                ->leftjoin("fundriser_investment_offered", "fund_raiser_company_details.user_id", "=", "fundriser_investment_offered.pitch_id")
                ->leftjoin("verification_details", "verification_details.user_id", "=", "users.id")
                ->groupBy('fund_raiser_image.user_id')
                ->groupBy('fundriser_investment_offered.pitch_id')
                ->where("users.verify_status", '1')
                ->where("users.staff_verify_status", '2')
                ->where("users.admin_verify_status", '2')
                ->where("users.is_deleted", '0')
                ->where("fundraiser_payment_details.paymnet_status", 'S')
                ->where("fundraiser_payment_details.planname", '!=', 'Free')
                ->select("*", "users.id as userid", "fund_raiser_company_details.id as pitchid",
                             "users.id as userid", "industry.industry as industryname", 
                             "cities.name as cityname", "states.name as statename", 
                             "countries.name as countryname", 
                             "fundraiser_payment_details.planname as planname", 
                             "fundraiser_payment_details.created_at as paymentdate", 
                             "fund_raiser_company_details.id as pitchid", "industry.industry as industryname", 
                             "fundraiser_payment_details.days", "fundraiser_payment_details.planname",
                             DB::raw("(CASE WHEN verification_details.status ='Verified'  THEN 1 ELSE 0 END) AS verified_status")
                             )
                ->orderby('fund_raise_details.created_at', 'DESC')
                ->limit(9)
                ->get();

        return $result;
    }

    public function getPitcheDetail($pitchID) {
        $result = DB::table('users')
                ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "users.id")
                ->leftjoin("fund_raiser_image", "fund_raiser_image.user_id", "=", "fund_raiser_company_details.user_id")
                ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "users.id")
                ->leftjoin("fundriser_investment_offered", "fundraiser_payment_details.user_id", "=", "fundriser_investment_offered.pitch_id")
                ->leftjoin("verification_details", "verification_details.user_id", "=", "users.id")
                ->GroupBy('fund_raiser_image.user_id')
                ->where("users.id", $pitchID)
                ->select("*", "fund_raiser_company_details.id as pitchid", "fundraiser_payment_details.planname as planname", "fundraiser_payment_details.created_at as paymentdate",
                DB::raw("(CASE WHEN verification_details.status ='Verified'  THEN 1 ELSE 0 END) AS verified_status"))
                ->get();
        return $result;
    }
    public function getImage($id) {
        $result=DB::table('fund_raiser_image')
                ->where("user_id", $id)
                ->select("imagename")
                ->get();
         return $result;
    }

    public function getDesignations() {
        $result = DB::table('designation')->get();
        // $result = $result->toArray();
        $f_arr = array();
        foreach ($result->toArray() as $key => $value) {
            $f_arr[$result[$key]->de_id] = $result[$key]->de_designation;
        }
        return $f_arr;
    }

    public function addFavourite($data) {
        // echo "<pre>";print_r($request->input());die;
        $objFavourite = new Favourite_pitch();
        $objFavourite->pitch_id = $data['pitchid'];
        $objFavourite->user_id = $data['userid'];
        $objFavourite->created_at = date("Y-m-d h:i:s");
        $objFavourite->updated_at = date("Y-m-d h:i:s");
        $result = $objFavourite->save();
        if ($result) {
            return 'added';
        } else {
            return 'wrong';
        }
    }

    public function getFavouritePitchesCount($userid) {
        $result = DB::table('favourite_pitch')
                        ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "favourite_pitch.pitch_id")
                        ->leftjoin("fund_raiser_image", "fund_raiser_image.user_id", "=", "fund_raiser_company_details.user_id")
                        ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "fund_raiser_company_details.user_id")
                        ->leftjoin("users", "users.id", "=", "fund_raiser_company_details.user_id")
                        ->leftjoin("fundriser_investment_offered", "fund_raiser_company_details.user_id", "=", "fundriser_investment_offered.pitch_id")
                        ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "favourite_pitch.pitch_id")
                        ->leftjoin("industry", "fund_raise_details.industry", "=", "industry.id")
                        ->leftjoin("verification_details", "verification_details.user_id", "=", "users.id")
                        ->GroupBy('fund_raiser_image.user_id')
                        ->where("favourite_pitch.user_id", $userid)
                        ->select("*", "favourite_pitch.pitch_id as fav_pitch_id", "favourite_pitch.id as fav_id", "fund_raiser_company_details.id as pitchid", "industry.industry as industryname", DB::raw('COUNT(fundriser_investment_offered.id) as count_inv'), DB::raw('group_concat(fundriser_investment_offered.ammount) as total_ammount'), "fundraiser_payment_details.days",
                        DB::raw("(CASE WHEN verification_details.status ='Verified'  THEN 1 ELSE 0 END) AS verified_status"))
                        ->get()->toArray();

        return $result;
    }

    public function getFavouritePitches($userid, $offset, $limit) {

        $result = DB::table('favourite_pitch')
                ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "favourite_pitch.pitch_id")
                ->leftjoin("fund_raiser_image", "fund_raiser_image.user_id", "=", "fund_raiser_company_details.user_id")
                ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "fund_raiser_company_details.user_id")
                ->leftjoin("users", "users.id", "=", "fund_raiser_company_details.user_id")
                ->leftjoin("fundriser_investment_offered", "fund_raiser_company_details.user_id", "=", "fundriser_investment_offered.pitch_id")
                ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "favourite_pitch.pitch_id")
                ->leftjoin("industry", "fund_raise_details.industry", "=", "industry.id")
                ->leftjoin("verification_details", "verification_details.user_id", "=", "users.id")
                ->GroupBy('fund_raiser_image.user_id')
                ->where("favourite_pitch.user_id", $userid)
                ->select("*", "favourite_pitch.pitch_id as fav_pitch_id", "favourite_pitch.id as fav_id", "fund_raiser_company_details.id as pitchid", "industry.industry as industryname", DB::raw('COUNT(fundriser_investment_offered.id) as count_inv'), DB::raw('group_concat(fundriser_investment_offered.ammount) as total_ammount'), "fundraiser_payment_details.days",
                DB::raw("(CASE WHEN verification_details.status ='Verified'  THEN 1 ELSE 0 END) AS verified_status"))
                ->offset($offset)->limit($limit)
                ->get();

        return $result;
    }

    public function userDetails($user_id) {
        $result = DB::table('users')
                ->where("id", $user_id)
                ->select("*")
                ->get();
        return $result;
    }

    public function invester_payment($amount, $pitch_id, $user_id,$transactionID,$commision) {
        // echo "<pre>";print_r($request->input());die;
        $session = session()->all();
        //$commision = ($amount * 0.5) / 100;
        $objFavourite = new Fundriser_investment_offered();
        $objFavourite->pitch_id = $pitch_id;
        $objFavourite->user_id = $user_id;
        $objFavourite->ammount = $amount;
        $objFavourite->commision = $commision;
        $objFavourite->payment_status = 'S';
        //$transactionID = time() . "-" . explode("-", $session['logindata'][0]['profile_code'])[1] . "-" . rand(111111, 999999);
        $objFavourite->transaction_id = $transactionID;
        $objFavourite->created_at = date("Y-m-d h:i:s");
        $objFavourite->updated_at = date("Y-m-d h:i:s");
        $result = $objFavourite->save();
        if ($result) {
            $objAllpayment = new All_paymentModel();
            $objAllpayment->user_id = $user_id;
            $objAllpayment->profile_code = $session['logindata'][0]['profile_code'];
            $objAllpayment->transaction_id = $transactionID;
            $objAllpayment->paid_amount = $commision;
            $objAllpayment->paid_for = $amount;
            $result1 = $objAllpayment->save();
            return 'added';
        } else {
            return 'wrong';
        }
    }
    public function add_offerd_record($amount, $pitch_id, $user_id) {
        // echo "<pre>";print_r($request->input());die;
        $session = session()->all();
        $commision = ($amount * 0.5) / 100;
        $objFavourite = new Fundriser_investment_offered();
        $objFavourite->pitch_id = $pitch_id;
        $objFavourite->user_id = $user_id;
        $objFavourite->ammount = $amount;
        $objFavourite->commision = $commision;
        $objFavourite->payment_status = 'S';
        $transactionID = time() . "-" . explode("-", $session['logindata'][0]['profile_code'])[1] . "-" . rand(111111, 999999);
        $objFavourite->transaction_id = $transactionID;
        $objFavourite->created_at = date("Y-m-d h:i:s");
        $objFavourite->updated_at = date("Y-m-d h:i:s");
        $result = $objFavourite->save();
        if ($result) {
            $objAllpayment = new All_paymentModel();
            $objAllpayment->user_id = $user_id;
            $objAllpayment->profile_code = $session['logindata'][0]['profile_code'];
            $objAllpayment->transaction_id = $transactionID;
            $objAllpayment->paid_amount = $commision;
            $objAllpayment->paid_for = $amount;
            $result1 = $objAllpayment->save();
            return 'added';
        } else {
            return 'wrong';
        }
    }

    public function add_offerd_record_preferd($amount, $pitch_id, $user_id) {
        // echo "<pre>";print_r($request->input());die;

        $objFavourite = new Fundriser_investment_offered();
        $objFavourite->pitch_id = $pitch_id;
        $objFavourite->user_id = $user_id;
        $objFavourite->ammount = $amount;
        $objFavourite->commision = 0;
        $objFavourite->payment_status = 'S';
        $objFavourite->created_at = date("Y-m-d h:i:s");
        $objFavourite->updated_at = date("Y-m-d h:i:s");
        $result = $objFavourite->save();
        if ($result) {
            return 'added';
        } else {
            return 'wrong';
        }
    }

    public function removefavorite($request) {

        $result = DB::table('favourite_pitch')->delete($request->input('id'));

        return $result;
    }

    public function removefavourite($data) {

        $result = DB::table('favourite_pitch')
                ->where('user_id', $data['userid'])
                ->where('pitch_id', $data['pitchid'])
                ->delete();

        return $result;
    }
    public function get_all_proposols_contacts($login_id,$roles)
    {
        
            $result = DB::table('investor_proposal')
                ->join('users','users.profile_code',"=",'investor_proposal.sender_profile_code')
            ->where("investor_proposal.investordetailsid", $login_id)
            ->where("investor_proposal.appove", "=","approve")
            ->groupBy('investor_proposal.sender_profile_code')
            ->select("sender_profile_code", DB::raw('count(*) as totalcount'))
            ->get();
        return $result;
    }
    public function get_proposal_history($login_profile_code,$sender_profile_code)
    {
       
            $mainquery = DB::table('investor_proposal');
                  
            $mainquery->where(function ($query) use ($login_profile_code,$sender_profile_code){
                $query->where(function ($query)use ($login_profile_code,$sender_profile_code) {
                    $query->where('investor_proposal.sender_profile_code',"=", $sender_profile_code)
                        ->where('investor_proposal.reciever_profile_code',"=",$login_profile_code);
                })->orWhere(function($query)  use ($login_profile_code,$sender_profile_code) {
                    $query->where('investor_proposal.sender_profile_code',"=", $login_profile_code)
                        ->where('investor_proposal.reciever_profile_code',"=", $sender_profile_code);
                });
            });
                $result=$mainquery->where("investor_proposal.appove", "=","approve")
                 ->select("investor_proposal.sender_profile_code",
                        "investor_proposal.reciever_profile_code",
                        "investor_proposal.subject",
                        "investor_proposal.message" ,"investor_proposal.created_at")
            ->get();
         /*$k=   $mainquery->toMySql();
         print_r($k);*/
        return $result;
    }


}
