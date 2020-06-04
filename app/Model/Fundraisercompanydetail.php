<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Fund_raiser_image;
use DB;

class Fundraisercompanydetail extends Model {

    //
    protected $table = 'fund_raiser_company_details';

    public function adddetails($request, $id, $existing_data) {
        //         print_r($request->file());
        //         die();
        $deleterecord = Fundraisercompanydetail::where('user_id', $id)->delete();
        if ($request->file()) {
            if ($request->file('mul_imgs')) {
                $deleterecord = Fund_raiser_image::where('user_id', $id)->delete();
                for ($i = 0; $i < count($request->file('mul_imgs')); $i++) {
                    $mul_imgs = $request->file('mul_imgs')[$i];
                    $mul_imgsname = time() . $i . '.' . $mul_imgs->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/company_details/');
                    $mul_imgs->move($destinationPath, $mul_imgsname);

                    $objFundaraiserImage = new Fund_raiser_image();
                    $objFundaraiserImage->user_id = $id;
                    $objFundaraiserImage->imagename = $mul_imgsname;

                    $objFundaraiserImage->created_at = date("Y-m-d h:i:s");
                    $objFundaraiserImage->updated_at = date("Y-m-d h:i:s");
                    $objFundaraiserImage->save();
                }
            }
        }
        $is_old_data = false;
        if (count($existing_data) > 0) {
            if ($existing_data[0]->first_active == '1') {
                $is_old_data = true;
            }
        }
        $objFundraisercompanydetail = new Fundraisercompanydetail();
        $objFundraisercompanydetail->user_id = $id;
        if ($is_old_data == true) {
            $objFundraisercompanydetail->min_investment = $existing_data[0]->min_investment;
            $objFundraisercompanydetail->max_investment = $existing_data[0]->max_investment;
            $objFundraisercompanydetail->min_investment_accepated = $existing_data[0]->min_investment_accepated;
        } else {
            $objFundraisercompanydetail->min_investment = $request->input('min_investment');
            $objFundraisercompanydetail->max_investment = $request->input('max_investment');
            if ($request->input('min_accepted')) {
                $objFundraisercompanydetail->min_investment_accepated = $request->input('min_accepted');
            }
        }

        $objFundraisercompanydetail->usp1 = $request->input('usp1');
        $objFundraisercompanydetail->usp2 = $request->input('usp2');
        $objFundraisercompanydetail->usp3 = $request->input('usp3');
        $objFundraisercompanydetail->usp4 = $request->input('usp4');
        $objFundraisercompanydetail->intro = $request->input('introduction');
        $objFundraisercompanydetail->idea = $request->input('idea');
        $objFundraisercompanydetail->team = $request->input('team_overview');
        $objFundraisercompanydetail->team_mem1 = $request->input('member1');
        $objFundraisercompanydetail->team_mem2 = $request->input('member2');
        $objFundraisercompanydetail->team_mem3 = $request->input('member3');
        $objFundraisercompanydetail->team_mem4 = $request->input('member4');
        $objFundraisercompanydetail->team_mem_deg1 = $request->input('position1');
        $objFundraisercompanydetail->team_mem_deg2 = $request->input('position2');
        $objFundraisercompanydetail->team_mem_deg3 = $request->input('position3');
        $objFundraisercompanydetail->team_mem_deg4 = $request->input('position4');
        if ($request->file()) {
            if ($request->file('member_picture')) {
                $image = $request->file('member_picture');
                $member_picture = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/team_member/');
                $image->move($destinationPath, $member_picture);
                $objFundraisercompanydetail->member_image = $member_picture;
            }
        }

        if ($request->file()) {
            if ($request->file('up_video')) {
                $video = $request->file('up_video');
                $video_name = time() . '.' . $video->getClientOriginalExtension();
                $destinationPath = public_path('/upload/video/');
                $video->move($destinationPath, $video_name);
                $objFundraisercompanydetail->video = $video_name;
            }
        }

        $objFundraisercompanydetail->roi = $request->input('roi');
        $objFundraisercompanydetail->cop = $request->input('coc');
        $objFundraisercompanydetail->pi = $request->input('pi');
        $objFundraisercompanydetail->dividend = $request->input('amd');
        $objFundraisercompanydetail->fa = $request->input('fa');
        $objFundraisercompanydetail->ebitda = $request->input('ebitda');
        $objFundraisercompanydetail->terms_con = "Yes";
        // $objFundraisercompanydetail->staff_verify_status = "0";
        // $objFundraisercompanydetail->admin_verify_status = "0";
        $objFundraisercompanydetail->created_at = date("Y-m-d h:s:i");
        $objFundraisercompanydetail->updated_at = date("Y-m-d h:s:i");
        if ($objFundraisercompanydetail->save()) {
            $objuserUpdate = Users::find($id);
            $objuserUpdate->staff_verify_status = "0";
            $objuserUpdate->admin_verify_status = "0";
            $objuserUpdate->updated_at = date("Y-m-d h:i:s");
            return $objuserUpdate->save();
        } else {
            return false;
        }
    }

    public function uploadVideo($request, $id) {
//        $request->file('upload_video')
        $count = Fundraisercompanydetail::where('user_id', $id)->count();

        if ($count == 0) {
            return "addData";
        } else {
            if ($request->file('upload_video')) {

                $video = $request->file('upload_video');
                $video_name = time() . '.' . $video->getClientOriginalExtension();
                $destinationPath = public_path('/upload/video/');
                $video->move($destinationPath, $video_name);
                $res = Fundraisercompanydetail::where('user_id', $id)->update(['video' => $video_name]);
                if ($res) {
                    return "true";
                } else {
                    return "false";
                }
            } else {
                return "false";
            }
        }
    }

    public function financialkpiupdate($request, $id) {
        $fID = Fundraisercompanydetail::where("user_id",$id)->select("id")->get();
        $objFundraisercompanydetail = Fundraisercompanydetail::find($fID[0]->id);
        $objFundraisercompanydetail->roi  = $request->input('roi');
        $objFundraisercompanydetail->cop  = $request->input('coc');
        $objFundraisercompanydetail->pi  = $request->input('pi');
        $objFundraisercompanydetail->dividend  = $request->input('amd');
        $objFundraisercompanydetail->fa  = $request->input('fa');
        $objFundraisercompanydetail->ebitda  = $request->input('ebitda');

        if ($objFundraisercompanydetail->save()) {
            return "true";
        } else {
            return "wrong";
        }
    }

    public function fundraisercompanydetails($id) {
        $result = DB::table('users')
                ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "users.id")
                ->leftjoin("fund_raiser_image", "fund_raiser_image.user_id", "=", "users.id")
                ->GroupBy('fund_raiser_image.user_id')
                ->where("users.id", $id)
                ->get();

        return $result;
    }

}
