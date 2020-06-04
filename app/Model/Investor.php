<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use DB;
use App\Model\Investor;
use App\Model\Users;
use Auth;
use Illuminate\Support\Facades\Hash;

class Investor extends Model {

    protected $table = 'investor_details';

    function __construct() {

    }

    public function getinvestordetails($id) {
        $result = DB::table('users')
                ->leftjoin("investor_details", "investor_details.user_id", "=", "users.id")
                ->leftjoin("countries", "countries.id", "=", "investor_details.country")
                ->leftjoin("cities", "cities.id", "=", "investor_details.city")
                ->where("users.id", $id)
                ->select("*", "users.created_at as cretedate", "cities.name as cityname", "countries.name as countryname", "users.id as id", "investor_details.id as pitchid")
                ->get();
        return $result;
    }

    public function updateInvestorProfile($request, $id) {
        $usercheck = Users::where('email', $request->input("email"))
                            ->where("is_deleted","0")
                            ->where('id', "!=", $id)
                            ->count();
        if ($usercheck == 0) {
            $objuserUpdate = Users::find($id);
            $objuserUpdate->firstname = $request->input('firstname');
            $objuserUpdate->lastname = $request->input('lastname');
            $objuserUpdate->email = $request->input('email');
            // $objuserUpdate->country_code =$request->input('code');
            $objuserUpdate->number = $request->input('mnumber');
            if ($request->input('password') != null || $request->input('password') != '') {
                $objuserUpdate->password = Hash::make($request->input('password'));
            }
            $objuserUpdate->staff_verify_status = "0";
            $objuserUpdate->admin_verify_status = "0";

            if ($objuserUpdate->save()) {
                $tempInrest = implode(",", $request->input('interestin'));

                $tempIndustry = implode(",", $request->input('industry'));
                $tempInterestedCountry = implode(",", $request->input('interestedcountry'));

                $deleterecord = Investor::where('user_id', $id)->delete();

                $objFundrasiserDetails = new Investor();
                $objFundrasiserDetails->user_id = $id;
                $objFundrasiserDetails->designation = $request->input('designation');
                $objFundrasiserDetails->companyname = $request->input('companyname');
                $objFundrasiserDetails->website = $request->input('website');
                $objFundrasiserDetails->phone_number = $request->input('altnumber');
                $objFundrasiserDetails->address = $request->input('address');
                $objFundrasiserDetails->country = $request->input('country');
                $objFundrasiserDetails->state = $request->input('state');
                if (!empty($request->input('city'))) {
                    $objFundrasiserDetails->city = $request->input('city');
                } else {
                    $objFundrasiserDetails->city = NULL;
                }

                $objFundrasiserDetails->pincode = $request->input('pincode');
                $objFundrasiserDetails->industry = $tempIndustry;
                $objFundrasiserDetails->gst = $request->input('gst');
                $objFundrasiserDetails->investortype = $request->input('investortype');
                $objFundrasiserDetails->interestin = $tempInrest;
                $objFundrasiserDetails->intro = $request->input('introduction');
                $objFundrasiserDetails->interested_country = $tempInterestedCountry;
                $objFundrasiserDetails->company_intro = $request->input('companyintro');
                $objFundrasiserDetails->min_investment = $request->input('min_investment');
                $objFundrasiserDetails->max_investment = $request->input('max_investment');
                $objFundrasiserDetails->created_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->updated_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->save();
                $objUserMail=new Users();
                $objUserMail->sendmail_to_user_firsttime( $id);
                return "done";
            }
        } else {
            return "exits";
        }
    }

    public function getAllInvestorPItchCount() {
        $result = DB::table('users')
                        ->join("investor_details", "investor_details.user_id", "=", "users.id")
                        //->leftjoin("investor_proposal", "investor_proposal.investordetailsid", "=", "investor_details.id")
                        ->leftjoin("cities", "investor_details.city", "=", "cities.id")
                        ->leftjoin("states", "investor_details.state", "=", "states.id")
                        ->leftjoin("countries", "investor_details.country", "=", "countries.id")
                        ->where("users.roles", 'I')
                        ->where("users.verify_status", '1')
                        //->where("users.staff_verify_status", '2')
                        ->where("users.admin_verify_status", '2')
                        ->select("*", "users.profile_code", "investor_details.id as pitchid", "users.id as userid", "cities.name as cityname", "states.name as statename", "countries.name as countryname", DB::raw("count(investor_proposal.id) as approch"), "users.created_at as generatedate")
                        ->groupBy('users.id')
                        ->get()->toArray();

        return $result;
    }

    public function getInvestorPitchesSerch($request,$start_page,$pageize,&$totalRocords) {

        $min = $request->input("min_investment");
        $max = $request->input("max_investment");
        $countries = $request->input("cities");
        $industry = $request->input("industry");
        $profile_code = $request->input("profile_code");
        $query = DB::table('users')
                ->join("investor_details", "investor_details.user_id", "=", "users.id")
                ->leftjoin("investor_proposal", 'investor_proposal.reciever_profile_code' , "=", 'users.profile_code')
                ->leftjoin("cities", "investor_details.city", "=", "cities.id")
                ->leftjoin("states", "investor_details.state", "=", "states.id")
                ->leftjoin("countries", "investor_details.country", "=", "countries.id")
                ->where("users.roles", 'I')
                ->where("users.verify_status", '1')
               // ->where("users.staff_verify_status", '2')
                ->where("users.admin_verify_status", '2')
                ->where("users.is_deleted", '0');
                if ($industry!=null)
                {
                    $industry_implode=implode("|",$industry);
                    $indusrty_reg='investor_details.industry REGEXP "[[:<:]]('.$industry_implode.')[[:>:]]"';
                    $query->whereRaw($indusrty_reg);
                }
                if ($countries !=null)
                {
                    $countries_implode=implode("|",$countries);
                    $countries_reg='investor_details.interested_country REGEXP "[[:<:]]('.$countries_implode.')[[:>:]]"';
                    $query->whereRaw($countries_reg);
                }

                $query->when($profile_code != '', function ($result) use($profile_code) {
                    return $result->where("users.profile_code", '=', $profile_code);
                })
                ->when($min != '', function ($result) use($min) {
                    return $result->where("investor_details.min_investment", '>=', $min);
                })
                ->when($max != '', function ($result) use($max) {
                    return $result->where("investor_details.max_investment", '<=', $max);
                })
               ->groupBy('users.id');


               /*
                ->when(!empty($cities), function ($result) use($cities) {
                    return $result->whereIn("investor_details.country", $cities);
                })
               ->when(!empty($industry), function ($result) use($industry) {
                        return $result->whereIn("investor_details.industry",$industry);
                   })*/

                $totalRocords = count($query->get());
                $result= $query->skip($start_page)
                ->take($pageize)
                ->select("*", "users.profile_code", "investor_details.id as pitchid",
                        "users.id as userid", "cities.name as cityname",
                        "states.name as statename", "countries.name as countryname",
                        DB::raw("count(investor_proposal.reciever_profile_code) as approch"),
                        "users.created_at as generatedate")
                 ->get();

        return $result;
    }

    public function getInvestorPitches($start_page,$pageize,&$totalRocords) {
        // echo $offset."|".$limit;die;
        $query = DB::table('users')
                ->join("investor_details", "investor_details.user_id", "=", "users.id")
                ->leftjoin("investor_proposal", 'investor_proposal.reciever_profile_code' , "=", 'users.profile_code')
                ->leftjoin("cities", "investor_details.city", "=", "cities.id")
                ->leftjoin("states", "investor_details.state", "=", "states.id")
                ->leftjoin("countries", "investor_details.country", "=", "countries.id")
                ->where("users.roles", 'I')
                ->where("users.verify_status", '1')
                //->where("users.staff_verify_status", '2')
                ->where("users.admin_verify_status", '2')
                ->where("users.is_deleted", '0')
                ->groupBy('users.id');
                $totalRocords = count($query->get());
                $result= $query->skip($start_page)
                ->take($pageize)
                ->select("*", "users.profile_code",
                     "investor_details.id as pitchid",
                      "users.id as userid",
                      "cities.name as cityname",
                      "states.name as statename",
                      "countries.name as countryname",
                       DB::raw("count(investor_proposal.reciever_profile_code) as approch"),
                       "users.created_at as generatedate")

                ->get();
//$k=$result->toSql();
//print_r($k);
        return $result;
    }

    public function getPitcheDetail($pitchid) {
        $result = DB::table('investor_details')
                ->join("users", "users.id", "=", "investor_details.user_id")
                // ->leftjoin("industry","investor_details.industry","=","industry.id")
                // ->join("fund_raiser_company_details","fund_raiser_company_details.user_id","=","users.id")
                // ->leftjoin("industry","fund_raise_details.industry","=","industry.id")
                ->leftjoin("cities", "investor_details.city", "=", "cities.id")
                // ->leftjoin("states","fund_raise_details.state","=","states.id")
                // ->leftjoin("countries","fund_raise_details.country","=","countries.id")
                ->where("investor_details.id", $pitchid)
                // ->where("users.staff_verify_status",'1')
                // ->where("users.admin_verify_status",'1')
                ->select("investor_details.*", "investor_details.id as pitchid", "users.profile_code", "cities.name as cityname")
                ->get();
        return $result;
    }

    public function getCityFromUser() {
        $result = DB::table('investor_details')
                ->leftjoin("countries", "investor_details.country", "=", "countries.id")
                ->groupBy('investor_details.country')
                ->select("countries.id", "countries.name")
                ->get();
        return $result;
    }

    public function getAllInvestorPItchCountPost($request) {
        $result = DB::table('users')
                        ->leftjoin("investor_details", "investor_details.user_id", "=", "users.id")
                        // ->leftjoin("industry","investor_details.industry","=","industry.id")
                        ->leftjoin("cities", "investor_details.city", "=", "cities.id")
                        ->leftjoin("states", "investor_details.state", "=", "states.id")
                        ->leftjoin("countries", "investor_details.country", "=", "countries.id")
                        ->where("users.roles", 'I')
                        ->where("users.verify_status", '1')
                       // ->where("users.staff_verify_status", '2')
                        ->where("users.admin_verify_status", '2')
                        ->when(!empty($request->input('cities')), function ($result) use($request) {
                            return $result->whereIn("investor_details.country", $request->input('cities'));
                        })
                        ->when(!empty($request->input('industry')), function ($result) use($request) {
                            return $result->whereIn("investor_details.industry", $request->input('industry'));
                        })
                        ->when($request->input('min_investment') != '', function ($result) use($request) {
                            return $result->where("investor_details.min_investment", ">=", $request->input('min_investment'));
                        })
                        ->when($request->input('max_investment') != '', function ($result) use($request) {
                            return $result->where("investor_details.industry", "<=", $request->input('max_investment'));
                        })
                        ->select("*", "investor_details.id as pitchid", "users.id as userid", "cities.name as cityname", "states.name as statename", "countries.name as countryname")
                        ->get()->toArray();
        return $result;
    }

    public function getPitchesFromSearch($request, $offset, $limit) {
        $result = DB::table('users')
                ->leftjoin("investor_details", "investor_details.user_id", "=", "users.id")
                ->leftjoin("investor_proposal", 'investor_proposal.reciever_profile_code' , "=", 'users.profile_code')
                ->leftjoin("cities", "investor_details.city", "=", "cities.id")
                ->leftjoin("states", "investor_details.state", "=", "states.id")
                ->leftjoin("countries", "investor_details.country", "=", "countries.id")
                ->where("users.roles", 'I')
                ->where("users.verify_status", '1')
               // ->where("users.staff_verify_status", '2')
                ->where("users.admin_verify_status", '2')
                ->when(!empty($request->input('cities')), function ($result) use($request) {
                    return $result->whereIn("investor_details.country", $request->input('cities'));
                })
                ->when(!empty($request->input('industry')), function ($result) use($request) {
                    return $result->whereIn("investor_details.industry", $request->input('industry'));
                })
                ->when($request->input('min_investment') != '', function ($result) use($request) {
                    return $result->where("investor_details.min_investment", ">=", $request->input('min_investment'));
                })
                ->when($request->input('max_investment') != '', function ($result) use($request) {
                    return $result->where("investor_details.industry", "<=", $request->input('max_investment'));
                })
                ->select("*", "investor_details.id as pitchid", "users.id as userid",
                "cities.name as cityname", "states.name as statename",
                "countries.name as countryname",
                 DB::raw("count(investor_proposal.id) as approch"), "users.created_at as generatedate")
                ->groupBy('users.id')
                ->get();
        return $result;
    }

    public function getOfferedDetail($user_id) {
        $result = DB::table('fundriser_investment_offered')
                ->leftjoin("users", "fundriser_investment_offered.pitch_id", "=", "users.id")
                ->leftjoin("fundraiser_payment_details", "users.id", "=", "fundraiser_payment_details.user_id")
                ->where("fundriser_investment_offered.user_id", $user_id)
                ->where("fundriser_investment_offered.is_deleted", '0')
                ->select("*", "fundriser_investment_offered.created_at as pay_date", "users.active_date", "users.profile_code", "fundraiser_payment_details.days", "fundriser_investment_offered.id as revok_id")
                ->paginate(10);
        return $result;
    }
    public function getTransactionDetail($txnid) {
        $result = DB::table('fundriser_investment_offered')
                ->leftjoin("users", "fundriser_investment_offered.pitch_id", "=", "users.id")
                ->leftjoin("fundraiser_payment_details", "users.id", "=", "fundraiser_payment_details.user_id")
                ->where("fundriser_investment_offered.transaction_id","=" ,$txnid)
                ->where("fundriser_investment_offered.is_deleted", '0')
                ->select("*", "fundriser_investment_offered.created_at as pay_date", "users.active_date", "users.profile_code", "fundraiser_payment_details.days", "fundriser_investment_offered.id as revok_id")
                ->paginate(10);
        return $result;
    }

}
