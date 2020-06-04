<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Input;
use App\Model\Users;
use App\Model\SendMail;
use App\Model\Country;
use App\Model\Forgotpassword;

class SuperaccessController extends Controller
{
    //
    function __construct() {
        
    }
    
    public function login(Request $request){
        
    if ($request->isMethod('post')) {
             $password = "Weunite91@2020";
             if($password == $request->input('password')){
                if (Auth::guard('fundraiser')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'roles' => 'FR','verify_status'=>'1' ,'is_deleted'=>'0'])) {

                    $loginData = array(
                        'firstname' => Auth::guard('fundraiser')->user()->firstname,
                        'profile_code' => Auth::guard('fundraiser')->user()->profile_code,
                        'lastname' => Auth::guard('fundraiser')->user()->lastname,
                        'email' => Auth::guard('fundraiser')->user()->email,
                        'roles' => Auth::guard('fundraiser')->user()->roles,
                        'user_image' => Auth::guard('fundraiser')->user()->user_image,
                        'verify_status' => Auth::guard('fundraiser')->user()->verify_status,
                        'staff_verify_status' => Auth::guard('fundraiser')->user()->staff_verify_status,
                        'admin_verify_status' => Auth::guard('fundraiser')->user()->admin_verify_status,
                        'id' => Auth::guard('fundraiser')->user()->id,
                        'dash_url' => "fund-raiser-dashborad",
                        'number' =>  Auth::guard('fundraiser')->user()->number,
                    );
   
                   $objUser =  new Users();
                   $result = $objUser->addLastlogin($loginData['id']);
                       Session::push('logindata', $loginData);
                       return redirect()->route('fund-raiser-dashborad');
                }else{
                    if (Auth::guard('investor')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'roles' => 'I','verify_status'=>'1' ,'is_deleted'=>'0'])) {
   
                       $loginData = array(
                           'firstname' => Auth::guard('investor')->user()->firstname,
                           'lastname' => Auth::guard('investor')->user()->lastname,
                           'profile_code' => Auth::guard('investor')->user()->profile_code,
                           'email' => Auth::guard('investor')->user()->email,
                           'roles' => Auth::guard('investor')->user()->roles,
                           'user_image' => Auth::guard('investor')->user()->user_image,
                           'verify_status' => Auth::guard('investor')->user()->verify_status,
                           'staff_verify_status' => Auth::guard('investor')->user()->staff_verify_status,
                           'admin_verify_status' => Auth::guard('investor')->user()->admin_verify_status,
                           'user_type' => Auth::guard('investor')->user()->user_type,
                           'id' => Auth::guard('investor')->user()->id,
                           'dash_url' => "investor-dashboard",
                           'number' =>  Auth::guard('investor')->user()->number,
                       );
                       $objUser =  new Users();
                       $result = $objUser->addLastlogin($loginData['id']);
                        Session::push('logindata', $loginData);
                        return redirect()->route('investor-dashboard');
                   }else{
                       if (Auth::guard('franchise')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'roles' => 'F','verify_status'=>'1' ,'is_deleted'=>'0'])) {
   
                           $loginData = array(
                               'firstname' => Auth::guard('franchise')->user()->firstname,
                               'lastname' => Auth::guard('franchise')->user()->lastname,
                               'profile_code' => Auth::guard('franchise')->user()->profile_code,
                               'email' => Auth::guard('franchise')->user()->email,
                               'roles' => Auth::guard('franchise')->user()->roles,
                               'user_image' => Auth::guard('franchise')->user()->user_image,
                               'verify_status' => Auth::guard('franchise')->user()->verify_status,
                               'staff_verify_status' => Auth::guard('franchise')->user()->staff_verify_status,
                               'admin_verify_status' => Auth::guard('franchise')->user()->admin_verify_status,
                               'id' => Auth::guard('franchise')->user()->id,
                               'number' =>  Auth::guard('franchise')->user()->number,
                               'dash_url' => "franchise",
                           );
                           $objUser =  new Users();
                           $result = $objUser->addLastlogin($loginData['id']);
                            Session::push('logindata', $loginData);
                           return redirect()->route('franchise');
                       }else{
                           if (Auth::guard('partners')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'roles' => 'P','verify_status'=>'1' ,'is_deleted'=>'0'])) {
   
                               $loginData = array(
                                   'firstname' => Auth::guard('partners')->user()->firstname,
                                   'lastname' => Auth::guard('partners')->user()->lastname,
                                   'profile_code' => Auth::guard('partners')->user()->profile_code,
                                   'email' => Auth::guard('partners')->user()->email,
                                   'roles' => Auth::guard('partners')->user()->roles,
                                   'user_image' => Auth::guard('partners')->user()->user_image,
                                   'verify_status' => Auth::guard('partners')->user()->verify_status,
                                   'staff_verify_status' => Auth::guard('partners')->user()->staff_verify_status,
                                   'admin_verify_status' => Auth::guard('partners')->user()->admin_verify_status,
                                   'id' => Auth::guard('partners')->user()->id,
                                   'number' =>  Auth::guard('partners')->user()->number,
                                    'dash_url' => "partners",
                               );
                               $objUser =  new Users();
                               $result = $objUser->addLastlogin($loginData['id']);
                               Session::push('logindata', $loginData);
                               return redirect()->route('partners');
                           }else{
                               $objeUser=new Users();
                               $result=$objeUser->get_user_det_byemail($request->input('email'));
                               if (count($result)==1) {
                                   $request->session()->flash('session_error', 'Your Profile is Inactive. Please contact We Unite 91 Support team!!');
                               }
                               else
                               {
                                   $request->session()->flash('session_error', 
                                   'Your username or password may be wrong. Please login with correct credentials!!!');
                               }
                              
                               return redirect()->route('super-access');
                           }
                       }
                   }
                }
                   echo json_encode($return);
                   exit;
             }else{
                $request->session()->flash('session_error', '11 Your username or password may be wrong. Please login with correct credentials!!!');
                return redirect()->route('super-access');
             }
             
//            $objUser = new User();
        }
        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();
        
        $data['title'] = 'We Unite 91 | Login to your profile';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('user.js');
        $data['funinit'] = array("User.init()");
        return view('frontend.pages.superaccess.login',$data);
}
}