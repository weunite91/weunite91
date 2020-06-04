<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Franchisecompanydetail;

class FranchiseDeatils extends Model {

    //
    protected $table = 'franchise_details';

    public function getcountryname($id) {

        $result = DB::table('franchise_details')
                ->leftjoin("countries", "countries.id", "=", "franchise_details.country")
                ->where('franchise_details.user_id', $id)
                ->select('countries.name', 'franchise_details.user_id')
                ->get();
        return $result;
    }

    public function getProfileData($userID) {
        $result = DB::table('users')
                ->leftjoin("franchise_details", "franchise_details.user_id", "=", "users.id")
                ->leftjoin("franchise_images", "franchise_images.user_id", "=", "users.id")
                ->leftjoin("franchise_company_details", "franchise_company_details.user_id", "=", "users.id")
                ->leftjoin("franchise_payment_details", "franchise_payment_details.user_id", "=", "users.id")
                ->leftjoin("industry", "franchise_details.industry", "=", "industry.id")
                ->leftjoin("cities", "franchise_details.city", "=", "cities.id")
                ->leftjoin("states", "states.id", "=", "franchise_details.state")
                ->leftjoin("countries", "franchise_details.country", "=", "countries.id")
                ->where('users.id', $userID)
                ->select("*",DB::raw('group_concat(franchise_images.imagename) as images_array'),"users.roles","users.user_image", "users.id","users.active_date","franchise_payment_details.planname", "users.user_note", "users.profile_code", "users.firstname", "users.lastname", "users.email", "users.created_at as join_date","states.name as states","users.admin_verify_status as status", "franchise_company_details.min_investment", "franchise_company_details.max_investment", "industry.industry", "cities.name as city", "countries.name as country", 'franchise_payment_details.planname','franchise_payment_details.paymnet_status', 'franchise_payment_details.created_at as paymentdate',"franchise_payment_details.days")
                ->get();
       
        return $result;
    }

    public function getProfileDataCountry($id) {
        $result = DB::table('franchise_details')
                ->leftjoin("users", "users.id", "=", "franchise_details.user_id")
                ->where('franchise_details.user_id', $id)
                ->select("franchise_details.city", 'franchise_details.state', "franchise_details.country", 'users.firstname', 'users.lastname','users.email')
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
   
    public function updateFranchiseByadmin($request,$id){
                 print_r($request->file());
                 die();
        // $deleterecord = FranchiseDeatils::where('user_id', $id)->delete();
          if($request->file()){
             if($request->file('mul_imgs')){
                $deleterecord = Franchiseimages::where('user_id', $id)->delete();
                for ($i = 0; $i < count($request->file('mul_imgs')); $i++) {
                    $mul_imgs = $request->file('mul_imgs')[$i];
                    $mul_imgsname = time() . $i . '.' . $mul_imgs->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/franchise_details/');
                    $mul_imgs->move($destinationPath, $mul_imgsname);
                    
                    $objFranchiseImage = new Franchiseimages();
                    $objFranchiseImage->user_id = $id;
                    $objFranchiseImage->imagename = $mul_imgsname;
                   
                    $objFranchiseImage->created_at = date("Y-m-d h:i:s");
                    $objFranchiseImage->updated_at = date("Y-m-d h:i:s");
                    $objFranchiseImage->save();
                }
             }
         }
         $getid = DB::table('franchise_details')->select("id")->where('user_id', $id)->get();
              
         $objFranchisedetail = Franchisecompanydetail::find($getid[0]->id);
         // $objFranchisedetail->user_id = $id;
         $objFranchisedetail->min_investment =$request->input('min_investment');
         $objFranchisedetail->max_investment =$request->input('max_investment');
         $objFranchisedetail->min_investment_accepated =$request->input('min_accepted');
         $objFranchisedetail->usp1 =$request->input('usp1');
         $objFranchisedetail->usp2 =$request->input('usp2');
         $objFranchisedetail->usp3 =$request->input('usp3');
         $objFranchisedetail->usp4 =$request->input('usp4');
         $objFranchisedetail->intro =$request->input('introduction');
         $objFranchisedetail->idea =$request->input('idea');
         $objFranchisedetail->team =$request->input('team_overview');
         $objFranchisedetail->team_mem1 =$request->input('member1');
         $objFranchisedetail->team_mem2 =$request->input('member2');
         $objFranchisedetail->team_mem3 =$request->input('member3');
         $objFranchisedetail->team_mem4 =$request->input('member4');
         $objFranchisedetail->team_mem_deg1 =$request->input('position1');
         $objFranchisedetail->team_mem_deg2 =$request->input('position2');
         $objFranchisedetail->team_mem_deg3 =$request->input('position3');
         $objFranchisedetail->team_mem_deg4 =$request->input('position4');
            if($request->file()){
                if($request->file('member_picture')){
                   $image = $request->file('member_picture');
                   $member_picture = time().'.' . $image->getClientOriginalExtension();
                   $destinationPath = public_path('/upload/team_member/');
                   $image->move($destinationPath, $member_picture);
                   $objFranchisedetail->member_image =$member_picture;
                }
            }
            
            if($request->file()){
                if($request->file('up_video')){
                   $video = $request->file('up_video');
                   $video_name = time().'.' . $video->getClientOriginalExtension();
                   $destinationPath = public_path('/upload/video/');
                   $video->move($destinationPath, $video_name);
                   $objFranchisedetail->video =$video_name;
                }
            }
         
         $objFranchisedetail->roi =$request->input('roi');
         $objFranchisedetail->cop =$request->input('coc');
         $objFranchisedetail->pi =$request->input('pi');
         $objFranchisedetail->dividend =$request->input('amd');
         $objFranchisedetail->fa =$request->input('fa');
         $objFranchisedetail->ebitda =$request->input('ebitda');
         // $objFranchisedetail->terms_con ="Yes";
        // $objFranchisedetail->staff_verify_status = "0";
        // $objFranchisedetail->admin_verify_status = "0";
         // $objFranchisedetail->created_at =date("Y-m-d h:s:i");
         $objFranchisedetail->updated_at =date("Y-m-d h:s:i");
         if($objFranchisedetail->save()){
            //  $objuserUpdate = Users::find($id);
            // $objuserUpdate->staff_verify_status = "0";
            // $objuserUpdate->admin_verify_status = "0";
            // $objuserUpdate->updated_at = date("Y-m-d h:i:s");
            return  $objFranchisedetail->save();
         }else{
             return false;
         }
        //         return ;
         
    }
}
