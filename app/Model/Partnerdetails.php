<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users;
use DB;
use Illuminate\Support\Facades\Hash;
class Partnerdetails extends Model
{
    protected $table = 'partner_details';

    public function updateprofile($request, $id) {
        //        print_r($request->input());
        //        die();
        $usercheck = Users::where('email', $request->input("email"))
                ->where('id', "!=", $id)
                ->count();
        if ($usercheck == 0) {
            $objuserUpdate = Users::find($id);
            $objuserUpdate->firstname = $request->input('firstname');
            $objuserUpdate->lastname = $request->input('lastname');
            $objuserUpdate->email = $request->input('email');
            $objuserUpdate->number = $request->input('mnumber');
            if ($request->input('password') != null || $request->input('password') != '') {
                $objuserUpdate->password = Hash::make($request->input('password'));
            }
            $objuserUpdate->staff_verify_status = "0";
            $objuserUpdate->admin_verify_status = "0";

            if ($objuserUpdate->save()) {

                $deleterecord = Partnerdetails::where('user_id', $id)->delete();

                $objFundrasiserDetails = new Partnerdetails();
                $objFundrasiserDetails->user_id = $id;
                $objFundrasiserDetails->designation = $request->input('designation');
                $objFundrasiserDetails->companyname = $request->input('company');
                $objFundrasiserDetails->website = $request->input('website');
                $objFundrasiserDetails->phone_number = $request->input('altnumber');
                $objFundrasiserDetails->address = $request->input('address');
                $objFundrasiserDetails->country = $request->input('country');
                $objFundrasiserDetails->state = $request->input('state');
                if(!empty($request->input('city'))){
                    $objFundrasiserDetails->city =$request->input('city');
                }else{
                    $objFundrasiserDetails->city =NULL;
                }
                $objFundrasiserDetails->pincode = $request->input('pincode');
                $objFundrasiserDetails->intro = $request->input('introduction');
                $objFundrasiserDetails->company_intro = $request->input('companyintro');
                $objFundrasiserDetails->gst = $request->input('gst');
                $objFundrasiserDetails->created_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->updated_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->save();
                return "done";
            }
        } else {
            return "exits";
        }
    }

    public function updatePartnerByadmin($request, $id) {
        //        print_r($request->input());
        //        die();
        // $usercheck = Users::where('email', $request->input("email"))
        //         ->where('id', "!=", $id)
        //         ->count();
        // if ($usercheck == 0) {
            $objuserUpdate = Users::find($id);
            $objuserUpdate->firstname = $request->input('firstname');
            $objuserUpdate->lastname = $request->input('lastname');
            $objuserUpdate->email = $request->input('email');
            $objuserUpdate->number = $request->input('mnumber');
            

            if ($objuserUpdate->save()) {

                $getid = DB::table('partner_details')->select("id")->where('user_id', $id)->get();
              
                $objFundrasiserDetails = Partnerdetails::find($getid[0]->id);

                $objFundrasiserDetails->designation = $request->input('designation');
                $objFundrasiserDetails->companyname = $request->input('company');
                $objFundrasiserDetails->website = $request->input('website');
                $objFundrasiserDetails->phone_number = $request->input('altnumber');
                $objFundrasiserDetails->address = $request->input('address');
                $objFundrasiserDetails->country = $request->input('country');
                $objFundrasiserDetails->state = $request->input('state');
                if(!empty($request->input('city'))){
                    $objFundrasiserDetails->city =$request->input('city');
                }else{
                    $objFundrasiserDetails->city =NULL;
                }
                $objFundrasiserDetails->pincode = $request->input('pincode');
                $objFundrasiserDetails->intro = $request->input('introduction');
                $objFundrasiserDetails->company_intro = $request->input('companyintro');
                $objFundrasiserDetails->gst = $request->input('gst');
                // $objFundrasiserDetails->created_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->updated_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->save();
                return "done";
            }else {
                return "wrong";
            }
    }

    public function getuserdetails($id) {
        $result = DB::table('users')
                ->leftjoin("partner_details", "partner_details.user_id", "=", "users.id")
                ->where("users.id", $id)
                ->select("*", "users.created_at as cretedate")
                ->get();
        return $result;
    }

    public function getProfileData($userID) {
        $result = DB::table('users')
                ->leftjoin("partner_details", "partner_details.user_id", "=", "users.id")
                ->leftjoin("cities", "partner_details.city", "=", "cities.id")
                ->leftjoin("countries", "partner_details.country", "=", "countries.id")
                ->where('users.id', $userID)
                ->select("users.user_image", "users.id","users.active_date","users.user_note", "users.profile_code", "users.firstname", "users.lastname", "users.email", "users.created_at as join_date", "users.admin_verify_status as status","cities.name as city", "countries.name as country")
                ->get();
       
        return $result;
    }
}
