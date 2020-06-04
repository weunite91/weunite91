<?php

namespace App\Http\Controllers\frontend\dashborad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Designation;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use App\Model\Industry;
use App\Model\Fundraisercompanydetail;
use App\Model\Fundraiserdetails;
use App\Model\Fund_payment_details;
use App\Model\Homemodel;
use App\Services\Invoicepdf;
use App\Model\KPISupportModel;
use App\Model\UsersPasscode;
use App\Model\VerificationDetails;
use Illuminate\Support\Facades\URL;
class FundraiserController extends Controller {

    //
    function __construct() {

    }

    public function confirm_verify_details(Request $request) {
        $session = $request->session()->all();
        if ($request->isMethod('post')) {
            $objVerificationDetails = new VerificationDetails();
            $result = $objVerificationDetails->save_verfication_details($request, $session['logindata'][0]['id']);

            $amount = 5000;
            if ($request->input('ver_country') == 101) {
                $amount = 2300;
            }
            $data = $this->call_payu_verfication($session, $amount, $session['logindata'][0]['id'], 'Adddress_Verification', 'Adddress_Verification', $request);
            return view('frontend.pages.home.payumoneyproceed', $data);
            exit();
        }
    }

    private function call_payu_verfication($session, $amount, $pitchid, $frompage, $planname, $request) {
        $pitchObj = new Homemodel();
        $data['loginid'] = $session['logindata'][0]['id'];
        $data['userdetail'] = $pitchObj->userDetails($data['loginid']);
        $data['pitchid'] = $pitchid;
        $data['actualamount'] = $amount;
        $data['frompage'] = $frompage;

        $objPayumoney = new \App\Services\Payumoney();
        $objPayumoney->payumoney_common_properties($amount, $planname, $data, $request);
        $data['title'] = 'We Unite 91 | Fund raiser - payumoney verifiction';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.offered()", "Home.homepage()");

        return $data;
    }

    private function country_state_details(&$data, $user_id) {

        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();

        $objCountry = new Country();
        $data['countryname'] = $objCountry->countryname();
        if ($data['userDetails'][0]->country != null || $data['userDetails'][0]->country != "") {
            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userDetails'][0]->country);
        }

        if ($data['userDetails'][0]->state != null || $data['userDetails'][0]->state != "") {
            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userDetails'][0]->state);
        }
        $objVerificationDetails = new VerificationDetails();
        $verifyResult = $objVerificationDetails->get_verification_details($user_id);
        $data['verifyResult'] = $verifyResult;
    }

    public function dashborad(Request $request) {
        $session = $request->session()->all();
        $objFudraisercompanydetails = new Fundraisercompanydetail();
        $data['details'] = $objFudraisercompanydetails->fundraisercompanydetails($session['logindata'][0]['id']);

        if ($request->isMethod('post')) {
            $objUsers = new Users();
            $result = $objUsers->updateprofile($request, $session['logindata'][0]['id']);

            if ($result == 'done') {
                $return['status'] = 'success';
                $return['message'] = 'Your profile details successfully updated.';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");$(".submitbtn:visible").val("Please wait");';
                $return['redirect'] = route('fund-details');
            }
            if ($result == 'wrong') {
                $return['status'] = 'error';

                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");$(".submitbtn:visible").val("Update & Continue");';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            if ($result == 'exits') {
                $return['status'] = 'error';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");$(".submitbtn:visible").val("Update & Continue");';
                $return['message'] = 'This email is already registerd!';
            }
            echo json_encode($return);
            exit;
        }

        $data['statelist'] = [];
        $data['citylist'] = [];

        $objdesignation = new Designation();
        $data['designationlist'] = $objdesignation->designationlist();

        $objUsers = new Users();
        $data['userDetails'] = $objUsers->getuserdetails($session['logindata'][0]['id']);


        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();


        $objProfileData = new Fundraiserdetails();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);



        $this->country_state_details($data, $session['logindata'][0]['id']);
        $objProfileData = new Fundraiserdetails();
        $data['investment_offerd'] = $objProfileData->investment_offerd($session['logindata'][0]['id']);

        $objProfileData = new Fundraiserdetails();
        $data['total_amount_fund'] = $objProfileData->totalAmmount($session['logindata'][0]['id']);

        $objProfileData = new Fundraiserdetails();
        $data['payment_details'] = $objProfileData->get_payment_invocie_details($session['logindata'][0]['id']);
//          echo "<pre>";print_r($data['profiledata']);die;

        $data['title'] = 'We Unite 91 | Fund raiser - Fund raiser dashboard';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser.js', 'validation.js', 'home.js');
        $data['funinit'] = array("Fundraiser.init()", "Home.homepage()", "Validation.init()");
        return view('frontend.pages.dashboard.fundraiser.dashborad', $data);
    }

    public function generateInvoice(Request $request, $txnid) {

        $objProfileData = new Fundraiserdetails();
        $objUsers = new Users();
        $session = $request->session()->all();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);
        $data['userDetails'] = $objUsers->getuserdetails($session['logindata'][0]['id']);
        $data['payment_details'] = $objProfileData->get_payment_invocie_details($session['logindata'][0]['id']);
        if ($request->isMethod('post')) {
            if (count($data['payment_details']) > 0) {
                if ($data['payment_details'][0]->invoice_id == null) {
                    $invoicePDF = new Invoicepdf();
                    $invoicePDF->save_invoice($data['userDetails'], $data['payment_details'], 'fundraiser', $session);
                }
            }
        }

        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);


        if ($data['userDetails'][0]->country != null || $data['userDetails'][0]->country != "") {
            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userDetails'][0]->country);
        }

        if ($data['userDetails'][0]->state != null || $data['userDetails'][0]->state != "") {
            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userDetails'][0]->state);
        }
        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();

        $objCountry = new Country();
        $data['countryname'] = $objCountry->countryname();

        $data['title'] = "We Unite 91 | Fund raiser - Fund raiser's invoice";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();

        return view('frontend.pages.home.generteinvoice', $data);
    }

    public function funddetails(Request $request) {
        $session = $request->session()->all();
        $objFudraisercompanydetails = new Fundraisercompanydetail();
        $data['details'] = $objFudraisercompanydetails->fundraisercompanydetails($session['logindata'][0]['id']);
        if ($request->isMethod('post')) {
            $objCompanyDetails = new Fundraisercompanydetail();
            $result = $objCompanyDetails->adddetails($request, $session['logindata'][0]['id'], $data['details']);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Your company details successfully updated.';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");$(".submitbtn:visible").val("Please wait");';
                $return['redirect'] = route('planlist');
            } else {
                $return['status'] = 'error';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");$(".submitbtn:visible").val("Update & Continue");';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }

        $objUsers = new Users();
        $data['userDetails'] = $objUsers->getuserdetails($session['logindata'][0]['id']);
        $objdesignation = new Designation();
        $data['desg'] = $objdesignation->getDesignations();
        // echo "<pre>";print_r($data['details']);die;
        $objdesignation = new Designation();
        $data['designationlist'] = $objdesignation->designationlist();



        $this->country_state_details($data, $session['logindata'][0]['id']);

        $objProfileData = new Fundraiserdetails();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);
        $data['investment_offerd'] = $objProfileData->investment_offerd($session['logindata'][0]['id']);
        $data['payment_details'] = $objProfileData->get_payment_invocie_details($session['logindata'][0]['id']);
        $data['title'] = 'We Unite 91 | Fund raiser - Fund details';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser.js', 'validation.js', 'home.js');
        $data['funinit'] = array("Fundraiser.details()", "Home.homepage()", "Validation.init()");
        return view('frontend.pages.dashboard.fundraiser.funddetails', $data);
    }

    public function planlist(Request $request) {
        $session = $request->session()->all();
        $objFudraisercompanydetails = new Fundraisercompanydetail();
        $data['details'] = $objFudraisercompanydetails->fundraisercompanydetails($session['logindata'][0]['id']);

        $objProfileData = new Fundraiserdetails();
        $objUsers = new Users();
        $data['userDetails'] = $objUsers->getuserdetails($session['logindata'][0]['id']);

        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);
        $data['payment_details'] = $objProfileData->get_payment_invocie_details($session['logindata'][0]['id']);
        $this->country_state_details($data, $session['logindata'][0]['id']);
        $data['title'] = 'We Unite 91 | Fund raiser - Planlist';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser.js', 'validation.js', 'home.js');
        $data['funinit'] = array("Fundraiser.planlist()", "Home.homepage()", "Validation.init()");
        return view('frontend.pages.dashboard.fundraiser.planlist', $data);
    }

    private function call_payu($session, $amount, $pitchid, $frompage, $planname, $request) {
        $pitchObj = new Homemodel();
        $data['loginid'] = $session['logindata'][0]['id'];
        $data['userdetail'] = $pitchObj->userDetails($data['loginid']);
        $data['pitchid'] = $pitchid;
        $data['actualamount'] = $amount;
        $data['frompage'] = $frompage;

        $objPayumoney = new \App\Services\Payumoney();
        $objPayumoney->payumoney_common_properties($amount, $planname, $data, $request);
        $data['title'] = 'We Unite 91 | Fund raiser - Call payu money payment gatway';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.offered()", "Home.homepage()");

        return $data;
    }

    public function applypasscode(Request $request) {
        $session = $request->session()->all();
        $pass_code = $request->input('pass_code');
        $user_id = $session['logindata'][0]['id'];
        $objUsersPasscode = new UsersPasscode;
        $passcode_result = $objUsersPasscode->check_passcode($user_id, $pass_code);
        if (($passcode_result == null)) {
            return json_encode(array("status_cd" => 0,
                "message" => "Invalid Passcode"));
        } else {
            $plan = 'Treasure';
            $amount = 5000;
            $transactionID = time() . "-FR-" . rand(111111, 999999);
            $objPaymentDetails = new Fund_payment_details;
            $objPaymentDetails->update_plan_by_passcode($user_id, $amount, $plan, $transactionID, $passcode_result);
            return json_encode(array("status_cd" => 1,
                "message" => "Successfully Upgraded to Treasure plan"));
        }
    }

    public function payment(Request $request, $plan) {

        $objPaymentDetails = new Fund_payment_details;
        $data['day'] = $objPaymentDetails->get_plan_days($plan);
        $session = $request->session()->all();
        $data['phonenumber'] = Users::select('number')
                ->where("id", $session['logindata'][0]['id'])
                ->get();



        if ($request->isMethod('post')) {


            if ($plan != 'free') {
                $data = $this->call_payu($session, $request->input('amount'), $session['logindata'][0]['id'], 'payment', $plan, $request);
                return view('frontend.pages.home.payumoneyproceed', $data);
                exit();
            }



            ///
            $plan = 'Free';
            $transactionID = time() . "-FR-" . rand(111111, 999999);

            $result = $objPaymentDetails->addpaymentdetails($session['logindata'][0]['id'], 0, $plan, $transactionID);
            if ($result) {
                $data['loginid'] = $session['logindata'][0]['id'];
                $pitchObj = new Homemodel();
                $data['userdetail'] = $pitchObj->userDetails($data['loginid']);
                $data['txnid'] = $transactionID;
                $status = 'success';
                $data['status'] = $status;
                $data['title'] = 'We Unite 91 | Fund raiser - payu money Payment status';
                $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
                $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
                $data['css'] = array();
                $data['plugincss'] = array();
                $data['pluginjs'] = array();
                $data['js'] = array("home.js");
                $data['funinit'] = array("Home.offered()", "Home.homepage()");
                return view('frontend.pages.home.paymentstatus', $data);
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }

        $objfund_raise_details = new Fundraiserdetails();
        $data['county'] = $objfund_raise_details->getcountryname($session['logindata'][0]['id']);

        $data['plan'] = $plan;

        $data['title'] = 'We Unite 91 | Fund raiser - make your payment';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser.js', 'home.js');
        $data['funinit'] = array("Fundraiser.payment()", "Home.homepage()");
        return view('frontend.pages.dashboard.fundraiser.payment', $data);
    }

    public function paymentstatus() {
        $session = session()->all();
        $objProfileData = new Fundraiserdetails();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);
        $data['investment_offerd'] = $objProfileData->investment_offerd($session['logindata'][0]['id']);
        $data['title'] = 'We Unite 91 | Fund raiser - payment status';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser.js', 'home.js');
        $data['funinit'] = array("Fundraiser.planlist()", "Home.homepage()");
        return view('frontend.pages.dashboard.fundraiser.paymentstatus', $data);
    }

    public function kpihelp(Request $request) {

        if ($request->isMethod('post')) {

            $action = $request->input('action');
            $session = session()->all();

            $objSupport = new KPISupportModel();
            $supportResp = $objSupport->save_kpi_support($session['logindata'][0]['id'], $request->input('support'));
            if ($supportResp) {
                $return['status'] = 'success';
                $return['message'] = 'Your request successfully submited.';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('fund-details');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;
        } else {
            return redirect()->route('home');
        }
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');

        switch ($action) {
            case 'changecountry':
                $objState = new State();
                $statelist = $objState->statelist($request->input('id'));
                echo json_encode($statelist);
                break;

            case 'changestate':

                $objCity = new City();
                $citylist = $objCity->citylist($request->input('id'));
                echo json_encode($citylist);
                break;

            case 'deleteprofile':

                $objUser = new Users();
                $deleteprofile = $objUser->deleteprofile($request->input('data'));
                if ($deleteprofile) {
                    $return['status'] = 'success';
                    $return['message'] = 'Your profile under the review.';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('fund-raiser-dashborad');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                }
                echo json_encode($return);
                break;
        }
    }

    public function supportemail(Request $request) {
        $action = $request->input('action');
        $session = session()->all();

        switch ($action) {
            case 'support':
                $objSupport = new KPISupportModel();
                $supportResp = $objSupport->save_kpi_support($session['logindata'][0]['id'], $request->input('support'));
                if ($supportResp) {
                    $return['status'] = 'success';
                    $return['message'] = 'Your request successfully submited.';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = '';
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                }
                echo json_encode($return);
                break;
        }
    }

    public function editprofilepic(Request $request) {
        $session = $request->session()->all();
        if ($request->isMethod('post')) {

            $objUsers = new Users();
            $result = $objUsers->editprofilepic($request, $session['logindata'][0]['id']);

            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Your profile picture successfully updated.';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('fund-details');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;
        }

        $data['statelist'] = [];
        $data['citylist'] = [];

        $objdesignation = new Designation();
        $data['designationlist'] = $objdesignation->designationlist();

        $objUsers = new Users();
        $data['userDetails'] = $objUsers->getuserdetails($session['logindata'][0]['id']);

        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();

        $objCountry = new Country();
        $data['countryname'] = $objCountry->countryname();


        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();

        if ($data['userDetails'][0]->country != null || $data['userDetails'][0]->country != "") {
            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userDetails'][0]->country);
        }

        if ($data['userDetails'][0]->state != null || $data['userDetails'][0]->state != "") {
            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userDetails'][0]->state);
        }

        $objProfileData = new Fundraiserdetails();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);

        $data['title'] = 'We Unite 91 | Fund raiser - Edit your profile image';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser.js', 'home.js');
        $data['funinit'] = array("Fundraiser.profileimage()", "Home.homepage()");
        return view('frontend.pages.dashboard.fundraiser.editprofileimage', $data);
    }

    public function uploadvideo(Request $request) {
        $session = session()->all();
        $id = $session['logindata'][0]['id'];
        $objFundraisercompanydetail = new Fundraisercompanydetail();
        $result = $objFundraisercompanydetail->uploadVideo($request, $id);
        if ($result == "true") {
            $return['status'] = 'success';
            $return['message'] = 'Your video successfully uploaded.';
            $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
            $return['redirect'] = route("fund-details");
        } else {
            if ($result == "addData") {
                $return['status'] = 'error';
                $return['message'] = 'Please fillup your company details in step 2 . then upload video';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route("fund-details");
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
            }
        }
        echo json_encode($return);
        exit;
    }

    public function financialkpiupdate(Request $request) {
        if ($request->isMethod('post')) {
            $url = url()->previous();

            $session = session()->all();
            $id = $session['logindata'][0]['id'];
            $objFundraisercompanydetail = new Fundraisercompanydetail();
            $result = $objFundraisercompanydetail->financialkpiupdate($request, $id);

            if ($result == "true") {
                $return['status'] = 'success';
                $return['message'] = 'Your financial kpi successfully updated.';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = $url;
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;

        }
    }

}
