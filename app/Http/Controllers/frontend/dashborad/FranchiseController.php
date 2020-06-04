<?php

namespace App\Http\Controllers\frontend\dashborad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Model\Designation;
use App\Model\Users;
use  App\Model\Country;
use App\Model\State;
use App\Model\City;
use App\Model\Industry;
use App\Model\Franchisecompanydetail;
use App\Model\FranchiseDeatils;
use App\Model\Franchise_payment_details;
use App\Model\PaymentPlans;
use App\Model\Homemodel;
class FranchiseController extends Controller
{
    //
    private function country_state_details(&$data,$user_id)
    {
       
        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();
        
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
       /* $objVerificationDetails = new VerificationDetails();
        $verifyResult= $objVerificationDetails->get_verification_details($user_id);*/
        $data['verifyResult']=null;
    }
    public function dashborad(Request $request){
        $session = $request->session()->all();
        if ($request->isMethod('post')) {
         
            $objUsers = new Users();
            $result =  $objUsers->update_frnachise_profile($request,$session['logindata'][0]['id']);
            
            if($result == 'done'){
                $return['status'] = 'success';
                $return['message'] = 'Your profile details successfully updated.';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('franchise-details');
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
                
        $objUsers = new Users();
        $data['userDetails'] = $objUsers->get_franchise_userdetails($session['logindata'][0]['id']);
        
        
        
        
        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();
        
        $this->country_state_details($data, $session['logindata'][0]['id']);
        $objProfileData = new FranchiseDeatils();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);
       
       
        $data['investment_offerd']=$objProfileData->investment_offerd($session['logindata'][0]['id']);

        $data['payment_details']=$objProfileData->get_payment_invocie_details($session['logindata'][0]['id']);
//          echo "<pre>";print_r($data['profiledata']);die;
       
        $data['title'] = 'We Unite 91 | Franchise - Franchise dashboard';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('franchise.js','home.js');
        $data['funinit'] = array("Franchise.init()","Home.homepage()");
        return view('frontend.pages.dashboard.franchise.dashborad',$data);
    }
    public function franchisedetails(Request $request){
        $session = $request->session()->all();
        $objFudraisercompanydetails = new Franchisecompanydetail();
        $data['details'] = $objFudraisercompanydetails->franchisecompanydetails($session['logindata'][0]['id']);
        if ($request->isMethod('post')) {
            
            
            $objCompanyDetails = new Franchisecompanydetail();
            $result=$objCompanyDetails->adddetails($request,$session['logindata'][0]['id'],$data['details']);
            
            if($result){
                    $return['status'] = 'success';
                    $return['message'] = 'Your company details successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('franchise-planlist');
             }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
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
        $objProfileData = new FranchiseDeatils();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);
        $data['investment_offerd']=$objProfileData->investment_offerd($session['logindata'][0]['id']);
        $data['payment_details']=$objProfileData->get_payment_invocie_details($session['logindata'][0]['id']);
        
        $data['title'] = 'We Unite 91 | Franchise - Details';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('franchise.js','home.js');
        $data['funinit'] = array("Franchise.details()","Home.homepage()");
        return view('frontend.pages.dashboard.franchise.franchisedetails',$data);
    }
    public function franchiseplanlist(Request $request){
        $session = $request->session()->all();

        $objPlanlist=new PaymentPlans();
        $data['all_plan_list'] = $objPlanlist->get_payment_list('F','all');
        $objProfileData = new FranchiseDeatils();
        $objUsers = new Users();
        $data['userDetails'] = $objUsers->getuserdetails($session['logindata'][0]['id']);
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);
        $data['payment_details']=$objProfileData->get_payment_invocie_details($session['logindata'][0]['id']);
        $this->country_state_details($data, $session['logindata'][0]['id']);
        $data['title'] = 'We Unite 91 | Franchise - Choose your Plan';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('franchise.js','home.js');
        $data['funinit'] = array("Franchise.init()","Home.homepage()");
        return view('frontend.pages.dashboard.franchise.franchiseplanlist',$data);
    }
    public function frnachisepayment(Request $request,$plan){
        $objPlanlist=new PaymentPlans();
       $plan_details= $objPlanlist->get_payment_list('F',$plan);
        if (count($plan_details)==0)
        {
            
        }
        else{
            $data['day']= $plan_details[0]->plan_duration*31;
            $data['amount']=$plan_details[0]->plan_amount;
            $data['plan_name']=$plan_details[0]->plan_type ."-".$plan_details[0]->plan_name;
            $data['plan_id']=$plan_details[0]->plan_id;
        }
       
        $session = $request->session()->all();
        $data['phonenumber'] = Users::select('number')
                                ->where("id",$session['logindata'][0]['id'])
                                ->get();
       
        
        
        if ($request->isMethod('post')) {
                $data=$this->call_payu($session,$request->input('amount'),
                $session['logindata'][0]['id'],'payment',$request);
                return view('frontend.pages.home.payumoneyproceed',$data);
                exit();
        }

      
        $data['plan'] = $plan;
        
        $data['title'] = 'We Unite 91 | Franchise - Payment Details';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('franchise.js','home.js');
        $data['funinit'] = array("Franchise.payment()","Home.homepage()");
        return view('frontend.pages.dashboard.franchise.franchisepayment',$data);
    }
    private function call_payu($session,$amount,$pitchid,$frompage,$request)
    {
        $pitchObj = new Homemodel();
        $data['loginid']=$session['logindata'][0]['id'];
        $data['userdetail'] =$pitchObj->userDetails($data['loginid']);
        $data['pitchid']=$pitchid;
        
       
        $data['frompage']='franchise_plan_selection';
        $objPlanlist=new PaymentPlans();
        $plan_details= $objPlanlist->get_payment_list('F',$request->input('plan_id'));
         if (count($plan_details)==0)
         {

         }
         else{
           
            $data['amount']=$plan_details[0]->plan_amount;
            $data['actualamount']=$data['amount'];
            $amount=$data['amount'];
            $objPayumoney = new \App\Services\Payumoney();
        
            $role=$session['logindata'][0]['roles'];
           
           
                $producttype=$plan_details[0]->plan_id;
            $amount=$plan_details[0]->plan_amount;
    
        $objPayumoney->payumoney_common_properties( $amount ,$producttype,$data,$request);
        $data['title'] = 'We Unite 91 | Franchise - Pitch Detail';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.offered()","Home.homepage()");
        return $data;

         }
      
       

    }
    
    public function paymentstatus(){
        $session = session()->all();
        $objProfileData = new Fundraiserdetails();
        $data['profiledata'] = $objProfileData->getProfileData($session['logindata'][0]['id']);
        $data['investment_offerd']=$objProfileData->investment_offerd($session['logindata'][0]['id']);
        $data['title'] = 'We Unite 91 | Franchise - Payment Status';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser.js','home.js');
        $data['funinit'] = array("Fundraiser.planlist()","Home.homepage()");
        return view('frontend.pages.dashboard.fundraiser.paymentstatus',$data);
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

    public function supportemail(Request $request){
        $action = $request->input('action');
        switch ($action) {
            case 'support':
                $objSupport = new Users();
                $supportResp = $objSupport->sendSupportEmail($request->input('support'));
                if($supportResp){
                    $return['status'] = 'success';
                    $return['message'] = 'Your request successfully submited.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = '';
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
