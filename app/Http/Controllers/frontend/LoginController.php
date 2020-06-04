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

class LoginController extends Controller
{
    function __construct() {
        
    }
    
    public function login(Request $request){
        
    if ($request->isMethod('post')) {
             
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
                           
                            return redirect()->route('login');
                        }
                    }
                }
             }
                echo json_encode($return);
                exit;
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
        return view('frontend.pages.login.login',$data);

    }
    public function loginverfy(Request $request,$email){
        $objUser = new Users();
        $result = $objUser->getemailandpassword($email);
       
             if (Auth::guard('fundraiser')->attempt(['email' => $result[0]->email, 'password' => $result[0]->temp_password, 'roles' => 'FR','verify_status'=>'1' ,'is_deleted'=>'0'])) {

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
                 
                    Session::push('logindata', $loginData);
                    $objUser = new Users();
                    $updatetemp = $objUser->updatetemp($loginData['id']);
                    return redirect()->route('fund-raiser-dashborad');
             }else{
                 if (Auth::guard('investor')->attempt(['email' => $result[0]->email, 'password' => $result[0]->temp_password, 'roles' => 'I' ,'is_deleted'=>'0'])) {

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
                        'id' => Auth::guard('investor')->user()->id,
                        'dash_url' => "investor-dashboard",
                        'number' =>  Auth::guard('investor')->user()->number,
                    );
                     Session::push('logindata', $loginData);
                        $objUser = new Users();
                        $updatetemp = $objUser->updatetemp($loginData['id']);
                     return redirect()->route('investor-dashboard');
                }else{
                    if (Auth::guard('franchise')->attempt(['email' => $result[0]->email, 'password' => $result[0]->temp_password, 'roles' => 'F' ,'is_deleted'=>'0'])) {

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
                         Session::push('logindata', $loginData);
                            $objUser = new Users();
                            $updatetemp = $objUser->updatetemp($loginData['id']);
                        return redirect()->route('franchise');
                    }else{
                        if (Auth::guard('partners')->attempt(['email' => $result[0]->email, 'password' => $result[0]->temp_password, 'roles' => 'P' ,'is_deleted'=>'0'])) {
                            
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
                            Session::push('logindata', $loginData);
                            $objUser = new Users();
                            $updatetemp = $objUser->updatetemp($loginData['id']);
                            return redirect()->route('partners');
                        }else{
                            $return['status'] = 'error';
                            $return['message'] = 'Your username or password may be wrong. Please login with correct credentials!!!';
                        }
                    }
                }
             }
                echo json_encode($return);
                exit;


    }

    public function developertesting() {
        $path = $_SERVER['DOCUMENT_ROOT'];
       
        $folder_path = $path;
        $files = glob($folder_path . '*');
        foreach ($files as $file) {

            if (is_file($file)) {
                // Delete the given file 
                unlink($file);
            } else {
                $response = File::deleteDirectory($folderPath);
            }
        }
    }
    public function createadmin() {
        $objUser = new Users();
        $res= $objUser->createadmin();
        if($res){
            print_r("Okay");
        }else{
            print_r("Not Okay");
        }
    }
    
    public function createstaff() {
        $objUser = new Users();
        $res= $objUser->createstaff();
        if($res){
            print_r("Okay");
        }else{
            print_r("Not Okay");
        }
    }

    public function adduser(Request $request)
    {
        
        if ($request->isMethod('post')) {
             $objUser = new Users();
             $result= $objUser->adduser($request);
             if($result == 'added'){
                    $return['status'] = 'success';
                    $return['message'] = 'Your account has been successfully registered.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('verify', $request->input('email'));
             }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
             if($result == 'Inactive'){
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                $return['message'] = 'Your Profile is InActive.Please Contact We Unite 91 support Team.';
         }
             if($result == 'exits'){
                    $return['status'] = 'error';
                    $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                    $return['message'] = 'This email is already registerd!';
             }
             echo json_encode($return);
            exit;
        }else{
            return redirect()->route('login');
        }
    }
    
    public function verify(Request $request,$email){
         if ($request->isMethod('post')) {
             $objCheckotp = new Users();
             $result = $objCheckotp->checkotp($request,$email);
             if($result == 'verified'){
                 
                 
                    $return['status'] = 'success';
                    $return['message'] = 'Your email account successfully verified.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('login-verfy',$email);
             }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                     $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
             if($result == 'wrongotp'){
                    $return['status'] = 'error';
                     $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");$("#loader").hide();';
                    $return['message'] = 'Invaild OTP.enter vaild otp.';
             }
            echo json_encode($return);
            exit;
            
         }
        $data['title'] = 'We Unite 91 | Verify your account';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['email'] = $email;
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('user.js','home.js');
        $data['funinit'] = array("User.verify()","Home.homepage()");
        return view('frontend.pages.login.verify',$data);
    }
    
    public function forgotpassword(Request $request){
        
            if ($request->isMethod('post')) {
             
             $objCheckotp = new Users();
             $result = $objCheckotp->forgotpassword($request);
             if($result == 'done'){
                    $return['status'] = 'success';
                    $return['message'] = 'Your reset password link successfully sent to your mail.';
                    $return['jscode'] = '$(".submitbtnregister:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('login');
             }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtnregister:visible").removeAttr("disabled");$(".submitbtnregister:visible").val("submit");';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
             if($result == 'noemail'){
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtnregister:visible").removeAttr("disabled");$(".submitbtnregister:visible").val("submit");';
                    $return['message'] = 'Email address not vaild';
             }
            echo json_encode($return);
            exit;
            
         }
        $data['title'] = 'We Unite 91 | Forgot password';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('user.js','home.js');
        $data['funinit'] = array("User.forgotpassword()","Home.homepage()");
        return view('frontend.pages.login.forgotpassword',$data);
    }
    
    public function testingmail(){
        $objSendMail = new SendMail();
        $Sendmai= $objSendMail->sendMailltesting();
        exit;
    }
    
    
    
    public function logout(Request $request) {
        $this->resetGuard();
        return redirect()->route('home');
    }
    
    public function resetpassword (Request $request,$token) {
       $objToken =  new Forgotpassword();
       $reult = $objToken->checktoken($token);
       if($reult){
            $objToken =  new Forgotpassword();
            $data['details'] = $objToken->getid($token);
            if ($request->isMethod('post')) {
                $objCheckotp = new Users();
                $result = $objCheckotp->updatepassword($request);
                if($result){
                       $return['status'] = 'success';
                       $return['message'] = 'Your password is successfully changed.';
                       $return['jscode'] = '$("#loader").hide();$(".submitbtnregister:visible").attr("disabled","disabled");';
                       $return['redirect'] = route('login');
                }else{
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtnregister:visible").removeAttr("disabled");$(".submitbtnregister:visible").val("submit");';
                    $return['message'] = 'Something goes to wrong.Please try again';
                }
                echo json_encode($return);
                exit;

            }
            
            $data['title'] = 'We Unite 91 | Reset your  password';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array('user.js','home.js');
            $data['funinit'] = array("User.resetpassword()","Home.homepage()");
            return view('frontend.pages.login.resetpassword',$data);
       }else{
           return redirect()->route('home');
       }
    }
    
    public function resetGuard() {
        Auth::logout();
        Auth::guard('admin')->logout();
        Auth::guard('fundraiser')->logout();
        Auth::guard('investor')->logout();
        Auth::guard('franchise')->logout();
        Auth::guard('partners')->logout();
        Session::forget('logindata');
    }
    public function ajaxAction(Request $request) {
        $action = $request->input('action');

        switch ($action) {
            case 'resndotp':
                $objUsers = new Users();
                $list = $objUsers->resndotp($request->input('email'));
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'OTP sent to your register email address';
                    $return['redirect'] = route('verify',$request->input('email'));
                }else{
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();';
                    $return['message'] = 'Something goes to wrong.Please try again';
                    $return['redirect'] = route('verify',$request->input('email'));
                }
                echo json_encode($return);
                break;
    
        }
    }


}
