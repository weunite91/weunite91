<?php

namespace App\Http\Controllers\frontend\dashborad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Designation;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use App\Model\Partnerdetails;
class PartnersController extends Controller
{
    //
    
    public function dashborad(Request $request){
        $session = $request->session()->all();
        if ($request->isMethod('post')) {
            // echo "<pre>";print_r($request->input());die;
            $objUsers = new Partnerdetails();
            $result =  $objUsers->updateprofile($request,$session['logindata'][0]['id']);
            
            if($result == 'done'){
                    $return['status'] = 'success';
                    $return['message'] = 'Your profile details successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('partners');
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
        $objdesignation = new Designation();
        $data['designationlist'] = $objdesignation->designationlist();

        $objUsers = new Partnerdetails();
        $data['userDetails'] = $objUsers->getuserdetails($session['logindata'][0]['id']);

        $objCountry = new Country();
        $data['countryname'] = $objCountry->countryname();

        if($data['userDetails'][0]->country != null || $data['userDetails'][0]->country != ""){
            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userDetails'][0]->country);
        }
        
        if($data['userDetails'][0]->state != null || $data['userDetails'][0]->state != ""){
            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userDetails'][0]->state);
        }

        $objProfileData = new Partnerdetails();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);

        $data['title'] = 'We Unite 91 | Partner - Dashboard';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('partners.js','home.js');
        $data['funinit'] = array("Partner.init()","Home.homepage()");
        return view('frontend.pages.dashboard.partner.dashborad',$data);
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
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('fund-raiser-dashborad');
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
