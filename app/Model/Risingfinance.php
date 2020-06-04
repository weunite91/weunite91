<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Risingfinance;
use DB;

class Risingfinance extends Model {

    function __construct(array $attributes = array()) {
        
    }

    public function getAllPitchesCount() {
        $result = DB::table('users')
                        ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "users.id")
                        ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "users.id")
                        ->where("users.verify_status", '1')
                        //->where("users.staff_verify_status", '2')
                        ->where("users.admin_verify_status", '2')
                        ->where("users.is_deleted", '0')
                        ->where("fundraiser_payment_details.paymnet_status", 'S')
                        ->where("fundraiser_payment_details.planname", '!=', 'Free')
                        ->GroupBy('users.id')
                        ->get()->toArray();
        return $result;
    }

    public function getAllPitchesCountActive() {
        $result = DB::table('users')
                        ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "users.id")
                        ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "users.id")
                        ->where("users.verify_status", '1')
                        //->where("users.staff_verify_status", '2')
                        ->where("users.admin_verify_status", '2')
                        ->where("users.is_deleted", '0')
                        ->where("fundraiser_payment_details.planname", 'Free')
                        ->where("fundraiser_payment_details.paymnet_status", 'S')
                        ->get()->toArray();
        return $result;
    }

    public function getPitchesactive($start_page,$pageize,&$totalRocords) {
        // echo $offset."|".$limit;die;
        $query = DB::table('users')
                ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "users.id")
                ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "users.id")
                ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "users.id")
                ->leftjoin("industry", "fund_raise_details.industry", "=", "industry.id")
                ->leftjoin("cities", "fund_raise_details.city", "=", "cities.id")
                ->leftjoin("states", "fund_raise_details.state", "=", "states.id")
                ->leftjoin("countries", "fund_raise_details.country", "=", "countries.id")
                ->leftjoin("fund_raiser_image", "fund_raiser_image.user_id", "=", "fund_raiser_company_details.user_id")
                ->leftjoin("verification_details", "verification_details.user_id", "=", "users.id")
                ->GroupBy('users.id')
                ->where("users.verify_status", '1')
                
                ->where("users.admin_verify_status", '2')
                ->where("users.is_deleted", '0')
                ->where("fundraiser_payment_details.paymnet_status", 'S');
                //->where("fundraiser_payment_details.planname", 'Free')

                $totalRocords = count($query->get());
                $result= $query->skip($start_page)
                ->take($pageize)
                ->select("*", "users.id as pitchid", "users.id as userid", "industry.industry as industryname", "cities.name as cityname", "states.name as statename", "countries.name as countryname", "fundraiser_payment_details.planname as planname", "fundraiser_payment_details.created_at as paymentdate"
                , DB::raw("(CASE WHEN verification_details.status ='Verified'  THEN 1 ELSE 0 END) AS verified_status"))
                ->get();

        return $result;
    }

    public function getPitchesactiveSerach($request,$start_page,$pageize,&$totalRocords) {

        $min = $request->input("min_investment");
        $max = $request->input("max_investment");
        $cities = $request->input("cities");
        $industry = $request->input("industry");
        $profile_code = $request->input("profile_code");
        $query = Users::from('users')
                ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "users.id")
                ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "users.id")
                ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "users.id")
                ->leftjoin("industry", "fund_raise_details.industry", "=", "industry.id")
                ->leftjoin("cities", "fund_raise_details.city", "=", "cities.id")
                ->leftjoin("states", "fund_raise_details.state", "=", "states.id")
                ->leftjoin("countries", "fund_raise_details.country", "=", "countries.id")
                ->leftjoin("fund_raiser_image", "fund_raiser_image.user_id", "=", "fund_raiser_company_details.user_id")
                ->leftjoin("verification_details", "verification_details.user_id", "=", "users.id")
                ->GroupBy('users.id')
                ->where("users.verify_status", '1')
               // ->where("users.staff_verify_status", '2')
                ->where("users.admin_verify_status", '2')
                ->where("users.is_deleted", '0')
              //  ->where("fundraiser_payment_details.planname", 'Free')
                ->where("fundraiser_payment_details.paymnet_status", 'S')
                ->when($profile_code != '', function ($result) use($profile_code) {
                    return $result->where("users.profile_code", '=', $profile_code);
                })
                ->when($min != '', function ($result) use($min) {
                    return $result->where("fund_raiser_company_details.min_investment", '>=', $min);
                })
                ->when($max != '', function ($result) use($max) {
                    return $result->where("fund_raiser_company_details.max_investment", '<=', $max);
                })
                ->when(!empty($cities), function ($result) use($cities) {
                    return $result->whereIn("fund_raise_details.country", $cities);
                })
                ->when(!empty($industry), function ($result) use($industry) {
                    return $result->whereIn("fund_raise_details.industry", $industry);
                });
                $totalRocords = count($query->get());
                $result= $query->skip($start_page)
                ->take($pageize)
                ->select("*", "users.id as pitchid", "users.id as userid", "industry.industry as industryname", "cities.name as cityname", "states.name as statename", "countries.name as countryname", "fundraiser_payment_details.planname as planname", "fundraiser_payment_details.created_at as paymentdate",
                DB::raw("(CASE WHEN verification_details.status ='Verified'  THEN 1 ELSE 0 END) AS verified_status"))
                ->get();

        return $result;
    }

    public function getPitches($start_page, $pageize,&$totalRocords) {
        
       
        $query = DB::table('users')
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
                ->GroupBy('users.id')
                ->where("users.verify_status", '1')
               // ->where("users.staff_verify_status", '2')
                ->where("users.admin_verify_status", '2')
                ->where("users.is_deleted", '0')
                ->where("fundraiser_payment_details.paymnet_status", 'S')
                ->where("fundraiser_payment_details.planname", '!=', 'Free');

                $totalRocords = count($query->get());
                $result= $query->skip($start_page)
                ->take($pageize)
                ->select("*", "users.id as pitchid", "users.id as userid", 
                "industry.industry as industryname", "cities.name as cityname", 
                "states.name as statename", "countries.name as countryname",
                 "fundraiser_payment_details.planname as planname",
                  "fundraiser_payment_details.created_at as paymentdate", 
                  DB::raw('COUNT(fundriser_investment_offered.id) as count_inv'), 
                  DB::raw('group_concat(fundriser_investment_offered.ammount) as total_ammount'),
                   "fundraiser_payment_details.days",
                   DB::raw("(CASE WHEN verification_details.status ='Verified'  THEN 1 ELSE 0 END) AS verified_status"))
                ->get();
                //->paginate(9);

        return $result;
    }

    public function getPitchesSerch($request,$start_page,$pageize,&$totalRocords) {
        
        $min = $request->input("min_investment");
        $max = $request->input("max_investment");
        $cities = $request->input("cities");
        $industry = $request->input("industry");
        $profile_code = $request->input("profile_code");
        $query = Users::from('users')
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

                ->groupBy('users.id')
                ->where("users.verify_status", '1')
                //->where("users.staff_verify_status", '2')
                ->where("users.admin_verify_status", '2')
                ->where("fundraiser_payment_details.paymnet_status", 'S')
                ->where("fundraiser_payment_details.planname", '!=', 'Free')
                ->where("users.is_deleted", '0')
                ->when($profile_code != '', function ($result) use($profile_code) {
                    return $result->where("users.profile_code", '=', $profile_code);
                })
                ->when($min != '', function ($result) use($min) {
                    return $result->where("fund_raiser_company_details.min_investment", '>=', $min);
                })
                ->when($max != '', function ($result) use($max) {
                    return $result->where("fund_raiser_company_details.max_investment", '<=', $max);
                })
                
                ->when(!empty($cities), function ($result) use($cities) {
                    return $result->whereIn("fund_raise_details.country", $cities);
                })
                ->when(!empty($industry), function ($result) use($industry) {
                    return $result->whereIn("fund_raise_details.industry", $industry);
                });
                $totalRocords = count($query->get());
                $result= $query->skip($start_page)
                ->take($pageize)
                ->select("*", "users.id as pitchid", "users.id as userid", "industry.industry as industryname", "cities.name as cityname", "states.name as statename", "countries.name as countryname", "fundraiser_payment_details.planname as planname", "fundraiser_payment_details.created_at as paymentdate", DB::raw('COUNT(fundriser_investment_offered.id) as count_inv'), DB::raw('group_concat(fundriser_investment_offered.ammount) as total_ammount'), 
                "fundraiser_payment_details.days",
                DB::raw("(CASE WHEN verification_details.status ='Verified'  THEN 1 ELSE 0 END) AS verified_status"))
                ->get();
        return $result;
    }

    public function getCityFromUser() {
        $result = DB::table('fund_raise_details')
                ->leftjoin("countries", "fund_raise_details.country", "=", "countries.id")
                ->groupBy('fund_raise_details.country')
                ->select("countries.id", "countries.name")
                ->get();
        return $result;
    }

}
