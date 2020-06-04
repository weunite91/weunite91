<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Fundraiserdetails extends Model {

    //
    protected $table = 'fund_raise_details';

    public function getcountryname($id) {

        $result = DB::table('fund_raise_details')
                ->leftjoin("countries", "countries.id", "=", "fund_raise_details.country")
                ->where('fund_raise_details.user_id', $id)
                ->select('countries.name', 'fund_raise_details.user_id')
                ->get();
        return $result;
    }

    public function getProfileData($userID) {
        $result = DB::table('users')
                ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "users.id")
                ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "users.id")
                ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "users.id")
                ->leftjoin("industry", "fund_raise_details.industry", "=", "industry.id")
                ->leftjoin("cities", "fund_raise_details.city", "=", "cities.id")
                ->leftjoin("countries", "fund_raise_details.country", "=", "countries.id")
                ->where('users.id', $userID)
                ->select("users.count","users.user_image", "users.id","users.active_date","fundraiser_payment_details.planname", "users.user_note", "users.profile_code", "users.firstname", "users.lastname", "users.email", "users.created_at as join_date", "users.admin_verify_status as status", "fund_raiser_company_details.min_investment", "fund_raiser_company_details.max_investment","fund_raiser_company_details.min_investment_accepated", "industry.industry", "cities.name as city", "countries.name as country", 'fundraiser_payment_details.planname','fundraiser_payment_details.paymnet_status', 'fundraiser_payment_details.created_at as paymentdate',"fundraiser_payment_details.days")
                ->get();

        return $result;
    }

    public function getProfileDataCountry($id) {
        $result = DB::table('fund_raise_details')
                ->leftjoin("users", "users.id", "=", "fund_raise_details.user_id")
                ->where('fund_raise_details.user_id', $id)
                ->select("fund_raise_details.city", 'fund_raise_details.state', "fund_raise_details.country", 'users.firstname', 'users.lastname','users.email')
                ->get();
        return $result;
    }

    public function investment_offerd($user_id){
        $result = DB::table('fundriser_investment_offered')
                ->leftjoin("users", "users.id", "=", "fundriser_investment_offered.user_id")
                ->where('fundriser_investment_offered.pitch_id', $user_id)
                ->select("*","users.profile_code")
                ->paginate(10);
        return $result;
    }

    public function totalAmmount($user_id){
        $result = DB::table('fundriser_investment_offered')
                ->leftjoin("users", "users.id", "=", "fundriser_investment_offered.user_id")
                ->where('fundriser_investment_offered.pitch_id', $user_id)
                ->sum('fundriser_investment_offered.ammount');
        return $result;
    }

    public function get_payment_invocie_details($user_id)
    {
        $result = DB::table('all_payments')
                        ->join("users", "users.id", "=", "all_payments.user_id")
                    ->leftjoin("tn_invoice"  ,function($join){
                                $join->on("tn_invoice.txn_no", "=" ,"all_payments.transaction_id")
                                    ->on("tn_invoice.customer_id","=","all_payments.user_id");
                             })
        ->where('all_payments.user_id', $user_id)
        ->orderBy('all_payments.created_at', 'desc')
        ->take(1)
        ->select("*")
        ->get();

            return $result;

    }

}
