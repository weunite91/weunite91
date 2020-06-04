<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Model\Users;
use App\Model\Forgotpassword;
use App\Model\Investor_proposal;

class LoginController extends Controller {

    function __construct() {

    }

    public function login(Request $request) {

        if ($request->isMethod('post')) {


            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'roles' => 'A'])) {

                $loginData = array(
                    'firstname' => Auth::guard('admin')->user()->firstname,
                    'lastname' => Auth::guard('admin')->user()->lastname,
                    'email' => Auth::guard('admin')->user()->email,
                    'roles' => Auth::guard('admin')->user()->roles,
                    'country_code' => Auth::guard('admin')->user()->country_code,
                    'number' => Auth::guard('admin')->user()->number,
                    'user_image' => Auth::guard('admin')->user()->user_image,
                    'id' => Auth::guard('admin')->user()->id
                );

                Session::push('logindata', $loginData);
                return redirect()->route('admin-dashborad');
            } else {
                if (Auth::guard('staff')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'roles' => 'S'])) {

                    $loginData = array(
                        'firstname' => Auth::guard('staff')->user()->firstname,
                        'lastname' => Auth::guard('staff')->user()->lastname,
                        'email' => Auth::guard('staff')->user()->email,
                        'roles' => Auth::guard('staff')->user()->roles,
                        'country_code' => Auth::guard('staff')->user()->country_code,
                        'number' => Auth::guard('staff')->user()->number,
                        'user_image' => Auth::guard('staff')->user()->user_image,
                        'asign_role' => Auth::guard('staff')->user()->asign_role,
                        'id' => Auth::guard('staff')->user()->id
                    );

                    Session::push('logindata', $loginData);
                    return redirect()->route('staff-dashborad');
                } else {

                    if (Auth::guard('cso')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'roles' => 'CSO'])) {

                            $loginData = array(
                                'firstname' => Auth::guard('cso')->user()->firstname,
                                'lastname' => Auth::guard('cso')->user()->lastname,
                                'email' => Auth::guard('cso')->user()->email,
                                'roles' => Auth::guard('cso')->user()->roles,
                                'country_code' => Auth::guard('cso')->user()->country_code,
                                'number' => Auth::guard('cso')->user()->number,
                                'user_image' => Auth::guard('cso')->user()->user_image,
                                'asign_role' => Auth::guard('cso')->user()->asign_role,
                                'id' => Auth::guard('cso')->user()->id
                            );

                            Session::push('logindata', $loginData);
                            return redirect()->route('cso-dashborad');
                    }else{
                        $request->session()->flash('session_error',
                            'Your username or password may be wrong. Please login with correct credentials!!!');
                    return redirect()->route('admin');

                    }

                }
            }
        }
        $data['title'] = 'Weunite91 | Admin - Login';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array('validate/jquery.validate.min.js');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js');
        $data['funinit'] = array('Login.init()');
        return view('backend.pages.login.login', $data);
    }

    public function forgotpassword(Request $request) {

        if ($request->isMethod('post')) {
            $objUser = new Users();
            $result = $objUser->adminforgot($request);
            if ($result == 'done') {
                $return['status'] = 'success';
                $return['message'] = 'Your reset password link successfully sent to your mail.';
                $return['jscode'] = '$(".submitbtnregister:visible").attr("disabled","disabled");';
                $return['redirect'] = route('admin');
            }
            if ($result == 'wrong') {
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtnregister:visible").removeAttr("disabled");$(".submitbtnregister:visible").val("submit");';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            if ($result == 'noemail') {
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtnregister:visible").removeAttr("disabled");$(".submitbtnregister:visible").val("submit");';
                $return['message'] = 'Email address not vaild';
            }
            if ($result == 'noadminstaff') {
                $return['status'] = 'error';
                $return['jscode'] = '$(".submitbtnregister:visible").removeAttr("disabled");$(".submitbtnregister:visible").val("submit");';
                $return['message'] = 'Only Admin and Staff can forgot the password';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] = 'Weunite91 | Admin - Forgot password';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array('validate/jquery.validate.min.js');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js');
        $data['funinit'] = array('Login.fpassword()');
        return view('backend.pages.login.forgotpassword', $data);
    }

    public function adminresetpassword(Request $request, $token = null) {
        $objToken = new Forgotpassword();
        $reult = $objToken->checktoken($token);
        if ($reult) {
            $objToken = new Forgotpassword();
            $data['details'] = $objToken->getid($token);
            if ($request->isMethod('post')) {

                $objCheckotp = new Users();
                $result = $objCheckotp->updatepassword($request);
                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Your password is successfully changed.';
                    $return['jscode'] = '$(".submitbtnregister:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('admin');
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$(".submitbtnregister:visible").removeAttr("disabled");$(".submitbtnregister:visible").val("submit");';
                    $return['message'] = 'Something goes to wrong.Please try again';
                }
                echo json_encode($return);
                exit;
            }
            $data['title'] = 'Weunite91 | Admin - Change your password';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array('validate/jquery.validate.min.js');
            $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js');
            $data['funinit'] = array('Login.adminresetpassword()');
            return view('backend.pages.login.adminresetpassword', $data);
        } else {
            return redirect()->route('home');
        }
    }

    public function createpassword() {
        print_r(Hash::make('123'));
    }

    public function logout(Request $request) {
        $this->resetGuard();
        return redirect()->route('admin');
    }

    public function investorchangemail(Request $request) {
        $objInvestor_proposal = new Investor_proposal();
        $result = $objInvestor_proposal->changemail();
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

}
