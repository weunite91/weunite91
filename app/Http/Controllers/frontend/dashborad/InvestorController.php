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
use App\Model\Investor;
class InvestorController extends Controller
{
    //
    
    public function dashborad(Request $request){
        $session = $request->session()->all();
        if ($request->isMethod('post')) {
            
           
            $objInvestor = new Investor();
            $result =  $objInvestor->updateInvestorProfile($request,$session['logindata'][0]['id']);
            if($result == 'done'){
                    $return['status'] = 'success';
                    $return['message'] = 'Your profile details successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('investor-dashboard');
            }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
            }
            if($result == 'exits'){
                    $return['status'] = 'error';
                    $return['message'] = 'This email is already registerd!';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;
        }
        $data['statelist'] = [];
        $data['citylist'] = [];
        $objUsers = new Investor();
        $data['userDetails'] = $objUsers->getinvestordetails($session['logindata'][0]['id']);
        $objdesignation = new Designation();
        $data['designationlist'] = $objdesignation->designationlist();

        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();
        
        $objCountry = new Country();
        $data['countryname'] = $objCountry->countryname();

        $objOffered = new Investor();
        $data['offered_data']=$objOffered->getOfferedDetail($session['logindata'][0]['id']);
        // echo "<pre>";print_r($data['offered_data']);die;
        if($data['userDetails'][0]->country != null || $data['userDetails'][0]->country != ""){
            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userDetails'][0]->country);
        }
        
        if($data['userDetails'][0]->state != null || $data['userDetails'][0]->state != ""){
            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userDetails'][0]->state);
        }
        
        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();

        
        $data['title'] = 'We Unite 91 | Investor - Dashboard';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('investor.js','materialize.min.js','home.js');
        $data['funinit'] = array("Investor.init()","Home.homepage()");
        return view('frontend.pages.dashboard.investor.dashborad',$data);
    }
    
    
    public function ajaxAction(Request $request){
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
                if($deleteprofile){
                    $return['status'] = 'success';
                    $return['message'] = 'Your profile under the review.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('investor-dashboard');
                }else{
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong.Please try again';
                        $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                 }
                echo json_encode($return);
                break;
            case 'revoke_offer':
                $objUser = new Users();
                $deleteprofile = $objUser->revoke_offer($request->input('data'));
                if($deleteprofile){
                    $return['status'] = 'success';
                    $return['message'] = 'Your revoked offer request is under the review.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('investor-dashboard');
                }else{
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong.Please try again';
                        $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                 }
                echo json_encode($return);
                break;
        }
   }
}
