<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use DB;
use App\Model\AdminProfile;
use File;
use Illuminate\Support\Facades\Hash;
class AdminProfile extends Model
{	
	protected $table = 'users';
    function __construct() {
        
    }

    public function getAdminDetails($request){
    	$user = DB::table('users')->where('id', $request)->first();
    	return $user;
    }

    public function saveEditUserInfo($request, $userId)
    {
     
        $name = '';
        $objUser = AdminProfile::find($userId);
        
        if($request->file()){
           
            $existImage = public_path('/upload/').$objUser->user_image;
            if (File::exists($existImage)) { // unlink or remove previous company image from folder
                File::delete($existImage);
            }
            
            $image = $request->file('userimage');
            $name = 'profile_img'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/');
            $image->move($destinationPath, $name);    
            $objUser->user_image = $name;
        }
        // $objUser->name = !empty($request->input('newpassword')) ? Hash::make($request->input('newpassword')) : $request->input('oldpassword');
        $objUser->firstname = $request->input('firstname');
        $objUser->lastname = $request->input('lastname');
        $objUser->email = $request->input('email');
        $objUser->number = $request->input('contactno');

        if ($objUser->save()) {
            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function UpdateAdminPassword($postData,$userid){
        $objAdminPassword = AdminProfile::find($userid);
        $objAdminPassword->password = Hash::make($postData['new_password']);
        if ($objAdminPassword->save()) {
            return TRUE;
        } else {

            return FALSE;
        }
    }
}
