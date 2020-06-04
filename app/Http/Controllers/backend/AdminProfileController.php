<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\AdminProfile;

class AdminProfileController extends Controller
{
    function __construct() {
        $this->middleware('admin');
    }
    
    
    public function admin_profile(Request $request){
        
    	$session = $request->session()->all();
        $userid = $session['logindata'][0]['id'];
        
    	$objUser = new AdminProfile();
     	$data['detail']= $objUser->getAdminDetails($userid);
        
    	if ($request->isMethod('post')) {
            $findUser = AdminProfile::where('id', $userid)->first();
            $edituserinfo = $findUser->saveEditUserInfo($request, $findUser->id);
            if ($edituserinfo) {
                $return['status'] = 'success';
                $return['message'] = 'Well Done You login successfully.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('admin-profile');
            }else{
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong please try agin';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
            }
            echo json_encode($return);
                 exit;
    	}
     	
        $data['title'] = 'Weunite91 | Admin - Edit my profile details';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('edit_profile.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Edit_Profile.init()'); 
        return view('backend.pages.adminprofile.admin_profile',$data);
    }

    public function change_password(Request $request){
        $session = $request->session()->all();
        if ($request->isMethod('post')) {
            $userid = $session['logindata'][0]['id'];
            $objUser = new AdminProfile();
            $changepassword = $objUser->UpdateAdminPassword($request->input(), $userid);
            if ($changepassword) {
                $return['status'] = 'success';
                $return['message'] = 'Your password had been change successfully.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('admin-dashborad');
                
            }else{
                $return['status'] = 'error';
                $return['message'] = 'Something went worng, Please try again later!';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('change-password');
            }
            echo json_encode($return);
            exit;
        }
    	$data['title'] = 'Weunite91 | Admin - Change password';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('edit_profile.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Edit_Profile.change()'); 
        return view('backend.pages.adminprofile.change_password',$data);
    }
}
