<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Homemodel;
use App\Model\Investor;
use App\Model\Investor_proposal;
use App\Model\Fundriser_investment_offered;
use App\Model\Favourite_pitch;
use DB;
use App\Model\Fund_Raiser_viewd_Profile;
use App\Model\Fund_payment_details;
use App\Model\Users;
use App\Model\ViewContacts;
use App\Model\Country;
use App\Model\Fundraiserdetails;
use App\Model\Franchise_payment_details;
use App\Model\VerificationDetails;
use App\Model\Silder;
class HomeController extends Controller {

    function __construct() {

    }

    public function homepage(Request $request) {

        $objSilder = new Silder();
        $data['slider'] = $objSilder->slider();

        $pitchObj = new Homemodel();
        $data['pitches'] = $pitchObj->getPitches();
        for($i = 0 ; $i < count($data['pitches']) ; $i++){
            $id = $data['pitches'][$i]->userid ;

            $objfro = new Fundriser_investment_offered();
            $data['pitches'][$i]->gettotalmount = $objfro->gettotalmount($id);

            $objfro = new Fundriser_investment_offered();
            $data['pitches'][$i]->totalinvestor = $objfro->totalinvestor($id);

        }



        $data['title'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['description'] = "Word's most effectual dais connecting Investors, Business, Franchisee,Lenders, M&A and Buyers. With a supporting hand in every stage, we are always glad to assist at WeUnite91";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.home.home', $data);
    }

    public function investorpitchDetail(Request $request,$pitchid) {
        $session = session()->all();
        if (!empty($session['logindata'][0])) {
            $pitchObj = new Investor();
            $data['detail'] = $pitchObj->getPitcheDetail($pitchid);
            $data['title'] = 'We Unite 91 | Investor Pitch Details';
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array("home.js");
            $data['funinit'] = array("Home.homepage()");
            return view('frontend.pages.investor.investorpitchdetail', $data);
        } else {
            return redirect('login');
        }
    }


    public function pitchDetail(Request $request,$pitchid){
        $data['pitchid']=$pitchid;

        $session = session()->all();

        if (!empty($session['logindata'][0])) {
            $data['pitchid']=$pitchid;
            $objfrviewdprofile = new Fund_Raiser_viewd_Profile();
            $result = $objfrviewdprofile->checkdetails($session['logindata'][0]['id'],$pitchid);
            if($result == "added"){
                $data['view'] = "no";
            }else{
                $data['view'] = "Yes";
            }
            if ($request->isMethod('post')) {

                if($session['logindata'][0]['roles']=='FR'){
                    $return['status'] = 'error';
                    $return['message'] = 'You are not Investor!';
                    $return['redirect'] = route('pitch-detail',$pitchid);
                    echo json_encode($return);
                    exit();
                }else{
                    if($session['logindata'][0]['user_type']=='R'){
                        echo json_encode(true);
                        return redirect()->route('fundriser_offered', [$request->input("offered_investment"), $pitchid]);
                    }else{
                        $objHome = new Homemodel();
                        $result = $objHome->add_offerd_record_preferd($request->input("offered_investment"),$pitchid,$session['logindata'][0]['id']);
                        if($result == 'added'){
                            $return['status'] = 'success';
                            $return['message'] = 'Your offered successfully submitted.';
                            $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                            $return['redirect'] = route('pitch-detail',$pitchid);
                        }
                        if($result == 'wrong'){
                            $return['status'] = 'error';
                            $return['message'] = 'Something goes to wrong.Please try again';
                            $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';

                        }
                        echo json_encode($return);
                        exit();
                    }
                }
            }
            $pitchObj = new Homemodel();

            $objfavpitch = new Favourite_pitch();
            $data['added'] = $objfavpitch->checkfavourite($session['logindata'][0]['id'],$pitchid);

            $data['loginid']=$session['logindata'][0]['id'];
            $data['detail'] = $data['profiledata'] = $pitchObj->getPitcheDetail($pitchid);

            $objViewContact=new ViewContacts();

            $viewContact=$objViewContact->get_contact_details($session['logindata'][0]['profile_code'],$data['detail'][0]->profile_code);
            $data['viewcontactdetails']=$viewContact;
            $data['image']=$pitchObj->getImage($pitchid);
            $objfro = new Fundriser_investment_offered();
            $data['gettotalmount'] = $objfro->gettotalmount($pitchid);

            $objfro = new Fundriser_investment_offered();
            $data['totalinvestor'] = $objfro->totalinvestor($pitchid);

            $data['desg'] = $pitchObj->getDesignations();
            $data['title'] = 'We Unite 91 | Pitch Detail';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array("home.js");
            $usertype=0;
            if($session['logindata'][0]['roles']=='FR'){
                $usertype=1;
            }elseif($session['logindata'][0]['roles']=='I'){
                if($session['logindata'][0]['user_type']=='P'){
                    $usertype=22;
                }else{
                    $usertype=2;
                }
            }
            $data['funinit'] = array("Home.init(".$usertype.")","Home.homepage()");
            return view('frontend.pages.home.pitchdetails',$data);
        } else {
            return redirect('login');
        }
    }
    public function Payu_Response(Request $request,$pitchid)
    {
        $session = session()->all();
        $commission=$request->input('amount');
        $txnid=$request->input('txnid');
        $commission=$request->input('amount');
        $actual_amount=$request->input('udf1');
        $frompage=$request->input('udf2');
        $pitchid=$request->input('udf3');
        $producttype=$request->input('productinfo');

        $objPayumoney = new \App\Services\Payumoney();
        $status=$objPayumoney->check_payu_response($request);
        if ($status=='success')
        {
            $login_user_id=$session['logindata'][0]['id'];

            if ($frompage=='contactpayment')
            {
                $objViewContacts = new ViewContacts;
                $objViewContacts->save_view_contacts_request( $session ,$txnid, $pitchid,$commission);
            }
            else if ($frompage=='payment')
            {
                $objPaymentDetails = new Fund_payment_details;
                $result=$objPaymentDetails->addpaymentdetails($login_user_id,$commission,$producttype,$txnid);
            }
            else if ($frompage=='franchise_plan_selection')
            {
                $objPaymentDetails = new Franchise_payment_details;
                $result=$objPaymentDetails->addpaymentdetails($login_user_id,$commission,$producttype,$txnid);
            }
            else if ($frompage=='Adddress_Verification')
            {
                $objPaymentDetails = new VerificationDetails;
                $result=$objPaymentDetails->update_payment_details($login_user_id,$commission,$producttype,$txnid);
            }
            else
            {
                $objHome = new Homemodel();
                $result = $objHome->invester_payment($actual_amount,$pitchid,$login_user_id,
                                                        $txnid,$commission);
            }

        }
        else
        {
            if ($status=='tampered')
            {
            }

        }

        $data['loginid']=$session['logindata'][0]['id'];
        $pitchObj = new Homemodel();
        $data['userdetail'] =$pitchObj->userDetails($data['loginid']);
        $data['txnid']=$txnid;
        $data['status']=$status;
        $data['title'] = 'We Unite 91 | Payment status';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.offered()","Home.homepage()");
        return view('frontend.pages.home.paymentstatus',$data);

    }
    public function Payu_Failed(Request $request,$pitchid)
    {
        $session = session()->all();
        $commission=$request->input('amount');
        $txnid=$request->input('txnid');
        $commission=$request->input('amount');
        $actual_amount=$request->input('udf1');
        $frompage=$request->input('udf2');
        $pitchid=$request->input('udf3');
        $producttype=$request->input('productinfo');

        $objPayumoney = new \App\Services\Payumoney();
        $status=$objPayumoney->check_payu_response($request);

            $data['loginid']=$session['logindata'][0]['id'];
            $pitchObj = new Homemodel();
            $data['userdetail'] =$pitchObj->userDetails($data['loginid']);
            $data['txnid']=$txnid;
            $data['status']=$status;
            $data['title'] = 'We Unite 91 | Payu Money Status';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array("home.js");
            $data['funinit'] = array("Home.offered()","Home.homepage()");
            return view('frontend.pages.home.paymentstatus',$data);
    }
    private function call_payu($session,$amount,$pitchid,$frompage,$request)
    {
        $pitchObj = new Homemodel();
        $data['loginid']=$session['logindata'][0]['id'];
        $data['userdetail'] =$pitchObj->userDetails($data['loginid']);
        $data['pitchid']=$pitchid;

        $data['frompage']=$frompage;

        $objPayumoney = new \App\Services\Payumoney();
        $producttype='invester';
        if ($frompage=='contactpayment')
        {
            $commision=1299;
            $producttype="getcontactinfo";
            $data['actualamount']= $commision;
        }
        else{
            $role=$session['logindata'][0]['roles'];
            if ($role=="I")
            {
                $commision=($amount*0.5)/100;
                $producttype="Invester For Business";
                $data['actualamount']=$amount;
            }
            else
            {
                $producttype="Fundraiser For Invester";
            }
        }
        $objPayumoney->payumoney_common_properties( $commision,$producttype,$data,$request);
        $data['title'] = 'We Unite 91 | Payu money';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.offered()","Home.homepage()");
        return $data;

    }
    public function paynow(Request $request,$amount,$pitchid){

        $session = session()->all();
        if (!empty($session['logindata'][0])) {
            if ($request->isMethod('post')) {
                $data=$this->call_payu($session,$amount,$pitchid,'fundriser_offered',$request);

                return view('frontend.pages.home.payumoneyproceed',$data);
                exit();
            }

            $pitchObj = new Homemodel();
            // $data['pitchid']=$pitchid;
            $data['loginid']=$session['logindata'][0]['id'];
            $data['userdetail'] =$pitchObj->userDetails($data['loginid']);
            $data['amount']=$amount;
            $data['commision']=($amount*0.5)/100;
            // echo "<pre>";print_r($data['userdetail']);die;
            // $data['desg'] = $pitchObj->getDesignations();
            $data['title'] = 'We Unite 91 | Pay Now';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array("home.js");
            $data['funinit'] = array("Home.offered()","Home.homepage()");
            return view('frontend.pages.home.offeredinvestment',$data);
        } else {
            return redirect('login');
        }
    }

    public function paynowFromFavPitch(Request $request,$amount,$pitchid){

        $session = session()->all();

        if (!empty($session['logindata'][0])) {
            if ($request->isMethod('post')) {

                $data=$this->call_payu($session,$amount,$pitchid,'fundriser_offered_fav_pitch',$request);
                return view('frontend.pages.home.payumoneyproceed',$data);
                exit;
                $objHome = new Homemodel();
                $result = $objHome->add_offerd_record($amount,$pitchid,$session['logindata'][0]['id']);
                if($result == 'added'){
                    $return['status'] = 'success';
                    $return['message'] = 'Your offered successfully submitted.';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('favourite_pitch','1');
                }
                if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                }
                echo json_encode($return);
                exit();
            }

            $pitchObj = new Homemodel();
            // $data['pitchid']=$pitchid;
            $data['loginid']=$session['logindata'][0]['id'];
            $data['userdetail'] =$pitchObj->userDetails($data['loginid']);
            $data['amount']=$amount;
            $data['commision']=($amount*0.5)/100;
            // echo "<pre>";print_r($data['userdetail']);die;
            // $data['desg'] = $pitchObj->getDesignations();
            $data['title'] = 'We Unite 91 | Pay now Pitch Detail';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array("home.js");
            $data['funinit'] = array("Home.offered()","Home.homepage()");
            return view('frontend.pages.home.offeredinvestment',$data);
        } else {
            return redirect('login');
        }
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');

        switch ($action) {
            case 'addfavourite':
                $session = session()->all();
                if($session['logindata'][0]['roles'] != "I"){
                    $return['status'] = 'error';
                    $return['message'] = 'Sorry You are not investor.';
                }else{
                    $objHome = new Homemodel();
                    $list = $objHome->addFavourite($request->input('data'));
                    if($list=="added"){
                        $return['status'] = 'success';
                        $return['message'] = 'Favourite pitch inserted successfully.';

                        $return['redirect'] = route('favourite_pitch',"1");
                    }else{
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong.Please try again';

                    }

                }
                echo json_encode($return);
                break;
            case 'removefavourite':
                $data = $request->input('data');
                $objHome = new Homemodel();
                $list = $objHome->removefavourite($data);
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'Favourite pitch removed successfully.';
                    $return['redirect'] = route('pitch-detail',$data['pitchid']);
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
                    $return['redirect'] = route('pitch-detail',$request->input('pitchid'));
                }
                echo json_encode($return);
                break;

            case 'removefavorite':

                $pitchObj = new Homemodel();
                $result = $pitchObj->removefavorite($request);
                if($result){
                    $return['status'] = 'success';
                    $return['message'] = 'Favourite pitch removed successfully.';
                    $return['redirect'] = url()->previous();
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
                }
                echo json_encode($return);
                break;

        }
    }

    public function favourite_pitch(Request $request,$id=null){

        $pageno=$id;
        $session = session()->all();
        $perpageitem=10;
        $limit=10;
        if (!empty($session['logindata'][0])) {
            if ($request->isMethod('post')) {

                if($session['logindata'][0]['roles']=='FR'){
                    $return['status'] = 'error';
                    $return['message'] = 'You are not Investor!';
                    $return['redirect'] = route('favourite_pitch');
                    echo json_encode($return);
                    exit();
                }else{
                    if($session['logindata'][0]['user_type']=='R'){
                        return redirect()->route('fundriser_offered_fav_pitch', [$request->input("offered_investment"), $request->input("pitch_id")]);
                    }else{

                        $objHome = new Homemodel();
                        $result = $objHome->add_offerd_record_preferd($request->input("offered_investment"),$request->input("pitch_id"),$session['logindata'][0]['id']);
                        if($result == 'added'){
                            $return['status'] = 'success';
                            $return['message'] = 'Your offered successfully submitted.';
                            $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                            // $return['redirect'] = route('favourite_pitch','1');
                        }
                        if($result == 'wrong'){
                            $return['status'] = 'error';
                            $return['message'] = 'Something goes to wrong.Please try again';
                            $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                        }
                        echo json_encode($return);
                        exit();
                    }
                }
            }

            $data['loginid']=$session['logindata'][0]['id'];
            $data['roles']=$session['logindata'][0]['roles'];

            $pitchObj = new Homemodel();
            $countpitch = $pitchObj->getFavouritePitchesCount($data['loginid']);

            $totalitem=count($countpitch);
            $pagecount=count(array_chunk($countpitch,$perpageitem));
            // echo "<pre>";print_r($count);die;
            if($id=='1'){
                $offset=0;
            }else{
                $offset=($id*$perpageitem)-$perpageitem;
            }

            $pitchObj = new Homemodel();
            $data['pitches'] = $pitchObj->getFavouritePitches($data['loginid'],$offset,$limit);

            for($i = 0 ; $i < count($data['pitches']) ; $i++){
                $id = $data['pitches'][$i]->user_id ;

                $objfro = new Fundriser_investment_offered();
                $data['pitches'][$i]->gettotalmount = $objfro->gettotalmount($id);

                $objfro = new Fundriser_investment_offered();
                $data['pitches'][$i]->totalinvestor = $objfro->totalinvestor($id);

            }
//             echo "<pre>";print_r($data['pitches']);die;
            $data['desg'] = $pitchObj->getDesignations();
            $data['title'] = 'We Unite 91 | Favourite pitch';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array("home.js");
            if($session['logindata'][0]['roles']=='FR'){
                $usertype=1;
            }elseif($session['logindata'][0]['roles']=='I'){
                if($session['logindata'][0]['user_type']=='P'){
                    $usertype=22;
                }else{
                    $usertype=2;
                }
            }

            $data['funinit'] = array("Home.homepage()","Home.offer_submit(".$usertype.",".$pageno.",".$pagecount.",".$totalitem.",".$perpageitem.")","Home.favouritepitch()");
            return view('frontend.pages.raisingfinance.favourite_pitch',$data);
        } else {
            return redirect('login');
        }
    }

    public function sendproposal(Request $request,$id){
         $data['session'] = $session = session()->all();
        $data['pitchId'] = $id;
        if (!empty($session['logindata'][0])) {

            if ($request->isMethod('post')) {
                if($session['logindata'][0]['roles'] !='FR'){
                    $objInvestorperopasal = new Investor_proposal();
                    $result = $objInvestorperopasal->addproposal($request);
                    if($result == 'done'){
                        $return['status'] = 'success';
                        $return['message'] = 'Your proposal details successfully submitted.';
                        $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                        $return['redirect'] = route('pitch-detail',$id);
                    }
                    if($result == 'wrong'){
                            $return['status'] = 'error';
                            $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                            $return['message'] = 'Something goes to wrong.Please try again';
                    }
                    if($result == 'exits'){
                            $return['status'] = 'error';
                            $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                            $return['message'] = 'This email is already registerd!';
                    }
                    echo json_encode($return);
                    exit;
                }else{
                    $return['status'] = 'error';
                    $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
                    $return['message'] = 'You are a Fund Riser.';
                    echo json_encode($return);
                    exit;
                }
            }


            $objeUser=new Users();
           $getbusinessuserdetails= $objeUser->getviewuserdetails($id);

           $objInvestor = new Investor();
           $data['userDetails'] = $objInvestor->getinvestordetails($session['logindata'][0]['id']);
           $objCountry = new Country();
           $data['countryname'] = $objCountry->countryname();


           $objProfileData = new Fundraiserdetails();
           $data['fund_userDetails'] = $objProfileData->getProfileData($id);



            if (count($getbusinessuserdetails)>0)
            {
                $data['business_profile_code']=  $getbusinessuserdetails[0]->profile_code;
            }

            $data['id'] = $id;
            $data['title'] = 'We Unite 91 | Send Proposal';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array('sendproposal.js','home.js');
            $data['funinit'] = array('Sendproposal.init()','Home.homepage()');
            return view('frontend.pages.home.contactbussiness', $data);
        }
    }

    public function contactpayment(Request $request,$id){
        $data['session'] = $session = session()->all();
        $data['pitchId'] = $id;
        if (!empty($session['logindata'][0])) {

            $objUser=new Users();

            $data['id'] = $id;
            if ($session['logindata'][0]['roles']=='I')
            {
                $data['c_headertext']='Business';
                $getbusinessuserdetails= $objUser->getviewuserdetails($id);
                if (count($getbusinessuserdetails)>0)
                {
                    $data['business_profile_code']=  $getbusinessuserdetails[0]->profile_code;
                }
            }
            else
            {
                $data['c_headertext']='Invester';
                $getbusinessuserdetails=$objUser->investor_userId($id);
                if (count($getbusinessuserdetails) >0)
                {
                    $data['business_profile_code']=  $getbusinessuserdetails[0]->profile_code;
                }
            }

            $data['title'] = 'We Unite 91 | Send Proposal Payment';
            $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array('sendproposal.js','home.js');
            $data['funinit'] = array('Sendproposal.contactpayment()','Home.homepage()');
            return view('frontend.pages.home.contactpayment', $data);
        }else{
             return redirect('login');
        }
    }
    public function contact_payment(Request $request){
        if ($request->isMethod('post')) {
            $amount = $request->input('amount');
            $pitchid =  $request->input('investordetailsid');
            $session = session()->all();
            $data=$this->call_payu($session,$amount,$pitchid,'contactpayment',$request);
            return view('frontend.pages.home.payumoneyproceed',$data);
            exit();
        }else{
             return redirect('login');
        }
    }

    public function getnotifications(Request $request)
    {


        $session = session()->all();
        if (!empty($session['logindata'][0])) {
        $loginid=$session['logindata'][0]['id'];
        $objUsers=new Users();
        $result=$objUsers->get_user_proposols( $loginid,$session['logindata'][0]['roles']);
        $json_arr=json_encode( $result);
        echo $json_arr;
        exit();
        }
    }
    public function get_all_proposals(Request $request,$profilecode)
    {
        $session = session()->all();
        if (!empty($session['logindata'][0])) {
        $loginid=$session['logindata'][0]['id'];
        $objUsers=new Homemodel();
        $result=$objUsers->get_all_proposols_contacts( $loginid,
                                                    $session['logindata'][0]['roles']);

        $login_profile_code=$session['logindata'][0]['profile_code'];
       /* $data['proposal_history']='';
        if ($profilecode!='all')
        {
            $history_result=$objUsers->get_proposal_history( $login_profile_code,$profilecode);
            $data['proposal_history']=json_encode( $history_result);
        }

        $data['sender_profilecode']=$profilecode;*/
        $data['title'] = 'We Unite 91 | Get All My Proposals';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['allproposallist']=$result;
        //$data['js'] = array('sendproposal.js','home.js');
    // $data['funinit'] = array('Sendproposal.contactpayment()','Home.homepage()');
        return view('frontend.pages.home.all-my-proposals', $data);
    }
    }
    public function get_proposal_history(Request $request,$profilecode)
    {
        $session = session()->all();
        if (!empty($session['logindata'][0])) {
        $loginid=$session['logindata'][0]['id'];
        $objUsers=new Homemodel();
        $login_profile_code=$session['logindata'][0]['profile_code'];
        $data['proposal_history']='';
        $history_result=$objUsers->get_proposal_history( $login_profile_code,$profilecode);
        $result=json_encode( $history_result);
        echo $result;
        }
    }
    public function reply_proposal(Request $request)
    {
        $session = session()->all();
        if (!empty($session['logindata'][0])) {
        $profile_code=$request->input('profile_code');
        $objUsers=new Users($profile_code);
        $result=$objUsers->get_user_details_by_profile_code($profile_code);
        $objInvestorperopasal = new Investor_proposal();
        $result = $objInvestorperopasal->reply_proposal($request,$result[0]->id,$session);

        echo json_encode(array('message' =>'1'));
        }


    }

}
