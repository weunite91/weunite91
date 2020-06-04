<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Investor;
use App\Model\Industry;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Model\Investor_proposal;
use App\Model\Users;
use App\Model\ViewContacts;
use App\Model\Country;
use App\Model\Fundraiserdetails;

class InvestorController extends Controller {

    function __construct() {
        
    }

    public function investor(Request $request) {
        $current_page = 0;
        $start_page = 0;
        $page_size = 9;
        $total_records = 0;
        get_current_page_no($request, $page_size, $current_page, $start_page);
        if ($request->isMethod('post')) {
            $pitchObj = new Investor();
            $data['fillterdata'] = $request->input();
            $data['pitches'] = $pitchObj->getInvestorPitchesSerch($request, $start_page, $page_size, $total_records);
        } else {
            $data['fillterdata'] = [
                "cities" => [],
                "industry" => [],
                "max_investment" => '',
                "min_investment" => '',
                "profile_code" => ''
            ];
            $pitchObj = new Investor();
            $data['pitches'] = $pitchObj->getInvestorPitches($start_page, $page_size, $total_records);
        }



        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();

        $objCityFilter = new Investor();
        $data['citylist'] = $objCityFilter->getCityFromUser();

        get_total_pages($page_size, $total_records, $data, $current_page);
        $data['title'] = 'We Unite 91 | Investor';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('investor.js', 'home.js');
        $data['funinit'] = array("Home.homepage()", "Investor.init()");
        return view('frontend.pages.investor.investor', $data);
    }

    public function sendproposal(Request $request, $id) {
        $data['session'] = $session = session()->all();

        if (!empty($session['logindata'][0])) {

            if ($request->isMethod('post')) {
                if ($session['logindata'][0]['roles'] != 'I') {
                    $objInvestorperopasal = new Investor_proposal();
                    $result = $objInvestorperopasal->addproposal($request);
                    if ($result == 'done') {
                        $return['status'] = 'success';
                        $return['message'] = 'Your profile details successfully updated.';
                        $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                        $return['redirect'] = route('investorpitch-detail', $id);
                    }
                    if ($result == 'wrong') {
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                        $return['message'] = 'Something goes to wrong.Please try again';
                    }
                    if ($result == 'exits') {
                        $return['status'] = 'error';
                        $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                        $return['message'] = 'This email is already registerd!';
                    }
                    echo json_encode($return);
                    exit;
                } else {
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                    $return['message'] = 'You are an Investor.';
                    echo json_encode($return);
                    exit;
                }
            }
            $data['id'] = $id;
            $objUser = new Users();
            $invester_details = $objUser->investor_userId($id);
            if (count($invester_details) > 0) {
                $data['invester_details'] = $invester_details[0];


                $objInvestor = new Investor();
                $data['invester_all_Details'] = $objInvestor->getinvestordetails($invester_details[0]->id);
                $objCountry = new Country();
                $data['countryname'] = $objCountry->countryname();
            }

            $objProfileData = new Fundraiserdetails();
            $data['userDetails'] = $objProfileData->getProfileData($session['logindata'][0]['id']);


            $data['title'] = 'We Unite 91 | Send Proposal';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array('sendproposal.js', 'home.js');
            $data['funinit'] = array('Sendproposal.init()', "Home.homepage()");
            return view('frontend.pages.investor.sendproposal', $data);
        }
    }

    public function investorpitchDetail($pitchid) {
        $session = session()->all();
        if (!empty($session['logindata'][0])) {
            $pitchObj = new Investor();
            $data['detail'] = $pitchObj->getPitcheDetail($pitchid);

            $objUser = new Users();
            $invester_details = $objUser->investor_userId($pitchid);
            if (count($invester_details) > 0) {
                $objViewContact = new ViewContacts();
                $viewContact = $objViewContact->get_contact_details($session['logindata'][0]['profile_code'], $invester_details[0]->profile_code);
                $data['viewcontactdetails'] = $viewContact;
            } else {
                $data['viewcontactdetails'] = array();
            }

            $objIndustry = new Industry();
            $data['industrylist'] = $objIndustry->industrylist();

            $data['title'] = 'We Unite 91 | Investor Pitch Details';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array('home.js');
            $data['funinit'] = array("Home.homepage()");
            return view('frontend.pages.investor.investorpitchdetail', $data);
        } else {
            return redirect('login');
        }
    }

}
