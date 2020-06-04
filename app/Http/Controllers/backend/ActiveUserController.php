<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Designation;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use App\Model\Industry;
use App\Model\Fundraiserdetails;
use App\Model\Fund_payment_details;
use App\Model\FranchiseDeatils;
use App\Model\Partnerdetails;
use App\Model\SupportModel;
class ActiveUserController extends Controller
{
    //
    function __construct() {

    }

    public function all(Request $request){
        $data['title'] = "Weunite91 | Admin - All active users's list ";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('activeuser.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('ActiveUser.init()',"Userfunction.init()");
        return view('backend.pages.activeuser.all',$data);
    }

    public function fundraiser(Request $request){
        $data['title'] = "Weunite91 | Admin - Active fund-raiser  users's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('activeuser.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('ActiveUser.fundraiser()',"Userfunction.init()");
        return view('backend.pages.activeuser.fundraiser',$data);
    }
    public function investor(Request $request){
        $data['title'] = "Weunite91 | Admin - Investor active users's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('activeuser.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('ActiveUser.investor()',"Userfunction.init()");
        return view('backend.pages.activeuser.investor',$data);
    }
    public function partner(Request $request){
        $data['title'] = "Weunite91 | Admin - Partner active users's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('activeuser.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('ActiveUser.partner()',"Userfunction.init()");
        return view('backend.pages.activeuser.partner',$data);
    }
    public function franchise(Request $request){
        $data['title'] = "Weunite91 | Admin - Franchise active users's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('activeuser.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('ActiveUser.franchise()',"Userfunction.init()");
        return view('backend.pages.activeuser.franchise',$data);
    }

    public function addnote(Request $request , $id){
        $objUser =  new Users();
        $data['userdetalis'] = $objUser->userdetails($id);
        if ($request->isMethod('post')) {
           $objUser =  new Users();
           $result = $objUser->addnote($request);
           if($result){
                $return['status'] = 'success';
                $return['message'] = 'Staff account has been successfully registered..';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('all-active-users');
            }else{
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] = "Weunite91 | Admin - Add users's note";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('user.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('User.addnote()');
        return view('backend.pages.activeuser.addnote',$data);
    }

    public function ajaxAction(Request $request){

        $action = $request->input('action');

        switch ($action) {
            case 'get-alluser-datatable':

                $objUsers = new Users();
                $list = $objUsers->active_getalldatatable();
                echo json_encode($list);
                exit();
                break;

            case 'get-fundraiser-datatable':
                $objUsers = new Users();
                $list = $objUsers->active_getfundraiserdatatable();
                echo json_encode($list);
                exit();
                break;

            case 'get-investor-datatable':
                $objUsers = new Users();
                $list = $objUsers->active_getinvestordatatable();
                echo json_encode($list);
                exit();
                break;
            case 'get-franchise-datatable':
                $objUsers = new Users();
                $list = $objUsers->active_getfranchisedatatable();
                echo json_encode($list);
                exit();
                break;
            case 'get-partner-datatable':
                $objUsers = new Users();
                $list = $objUsers->active_getpartnerdatatable();
                echo json_encode($list);
                exit();
            break;

            case 'deleteUser':
                $objUsers = new Users();
                $list = $objUsers->deleteUser($request);
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'User deleted successfully.';
                    $return['redirect'] = url()->previous();
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
            break;


            case 'get-alluser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getalldatatable();
                echo json_encode($list);
                exit();
            break;

            case 'changeusertype':

                $objUsers = new Users();
                $list = $objUsers->changeusertype($request);
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'User Type successfully changed.';
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
            break;

            case 'changeadminverify':
                $objUsers = new Users();
                $list = $objUsers->changeadminverify($request);
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'User Profile successfully verified.';
                }else{
                     $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
            break;

            case 'changeemailverify':
                $objUsers = new Users();
                $list = $objUsers->changeemailverify($request);
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'User Email successfully verified.';
                }else{
                     $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
            break;

            case 'get-revoke-datatable':
                $objectRevoke = new Users();
                $list = $objectRevoke->getrevokelist();
                echo json_encode($list);
                exit();
            break;

            case 'revokestatus':
                $objperoposal = new Users();
                $list= $objperoposal->revokestatuschange($request);
                // if($list){
                //     $return['status'] = 'success';
                //     $return['message'] = 'User revoke request successfully approved.';
                //     $return['redirect'] = route('revokeoffers');
                // }else{
                //     $return['status'] = 'error';
                //     $return['message'] = 'Something goes to wrong';
                // }
                echo json_encode($list);
                exit();
            break;

            case 'get-approvedrevoke-datatable':
                    $objectRevoke = new Users();
                    $list = $objectRevoke->getapprovedrevokelist();
                    echo json_encode($list);
                    exit();
            break;
            case 'approverevokestatus':
                    $objperoposal = new Users();
                    $list= $objperoposal->approvedrevokestatuschange($request);
                    if($list){
                        $return['status'] = 'success';
                        $return['message'] = 'Request status successfully updated.';
                        $return['redirect'] = route('approvedrevoke');
                    }else{
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    exit();
            break;
            case 'get-support-datatable':
                    $objperoposal = new SupportModel();
                    $list= $objperoposal->GetAllSupportRequest();
                    echo json_encode($list);
                    exit();
            break;
        }
    }

    public function userdetails(Request $request,$id){
        $objuser = new Users();
        $data['userrole'] = $objuser->getuserrole($id);
        $data['title'] = "Weunite91 | Admin - user's details";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('userdetails.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Userdetails.init()');
        if($data['userrole'][0]->roles == "FR"){
            $objuser = new Users();
            $data['userdetails'] = $objuser->getuserdetailsview($id);
            return view('backend.pages.activeuser.userdetails',$data);
        }
        if($data['userrole'][0]->roles == "I"){
            $objuser = new Users();
            $data['userdetails'] = $objuser->getInvestorDetailsView($id);
            return view('backend.pages.activeuser.investordetails',$data);
        }
        if($data['userrole'][0]->roles == "F"){
            $objuser = new Users();
            $data['userDetails'] = $objuser->getviewuserdetails($id);
            return view('backend.pages.activeuser.franchisedetails',$data);
        }
        if($data['userrole'][0]->roles == "P"){
            $objuser = new Users();
            $data['userDetails'] = $objuser->getviewuserdetails($id);
            return view('backend.pages.activeuser.partnerdetails',$data);
        }

    }

    public function edituserdetails(Request $request,$id){
        $session = $request->session()->all();
        if($request->isMethod('post')){
            $objUsers = new Users();
            $result =  $objUsers->edituserdetailsAdmin($request,$id);
            if($result == 'done'){
                    $return['status'] = 'success';
                    $return['message'] = 'Details successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('edit-user-details',$id);
             }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
             echo json_encode($return);
            exit;
        }
        $data['statelist'] = [];
        $data['citylist'] = [];
        $data['user_id']=$id;
        $objuser = new Users();
        $data['userrole'] = $objuser->getuserrole($id);

        $objdesignation = new Designation();
        $data['designationlist'] = $objdesignation->designationlist();

        $objfundraiser = new Fundraiserdetails();
        $data['fundriserdetais'] = $objfundraiser->getProfileDataCountry($id);

        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();

        $objCountry = new Country();
        $data['countryname'] = $objCountry->countryname();

        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();


        $data['title'] = "Weunite91 | Admin - Edit users's note";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('userdetails.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Userdetails.init()');

        if($data['userrole'][0]->roles == "FR"){
            $objuser = new Users();
            $data['userdetails'] = $objuser->getuserdetailsview($id);

            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userdetails'][0]->country);

            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userdetails'][0]->state);
            return view('backend.pages.activeuser.edituserdetails',$data);
        }
        if($data['userrole'][0]->roles == "I"){
            $objuser = new Users();
            $data['userdetails'] = $objuser->getInvestorDetailsView($id);

            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userdetails'][0]->country);

            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userdetails'][0]->state);

            return view('backend.pages.activeuser.edituserdetailsinvestor',$data);
        }
        if($data['userrole'][0]->roles == "F"){
            $objuser = new FranchiseDeatils();
            $data['userdetails'] = $objuser->getfranchisedetails($id);
            return view('backend.pages.activeuser.edituserdetailsfranchise',$data);
        }
        if($data['userrole'][0]->roles == "P"){
            $objuser = new Partnerdetails();
            $data['userdetails'] = $objuser->getuserdetails($id);

            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userdetails'][0]->country);

            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userdetails'][0]->state);
            return view('backend.pages.activeuser.edituserdetailspartnerdetails',$data);
        }

    }

    public function updateInvestorByadmin(Request $request,$id){
        if ($request->isMethod('post')) {

           $objUser =  new Users();
           $result = $objUser->updateInvestorByAdmin($request,$id);
           if($result){
                $return['status'] = 'success';
                $return['message'] = 'Investor Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('edit-user-details',$id);
            }else{
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function revokeOffers(Request $request){
        $data['title'] = "Weunite91 | Admin - Revoke offers list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('revoke.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Revoke.init()');
        return view('backend.pages.revoke.revoke',$data);
    }

    public function addRevokeNote(Request $request,$id){
        if ($request->isMethod('post')) {
            $objUsers = new Users();
            $result =  $objUsers->addRevokeNote($request,$id);
            if($result == 'done'){
                    $return['status'] = 'success';
                    $return['message'] = 'Revoke note updated successfully.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('add-revoke-note',$id);
             }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
             echo json_encode($return);
            exit;
        }

        $objUsers = new Users();
        $data['revokenote']=  $objUsers->getRevokeNote($id);

        $data['title'] = "Weunite91 | Admin - Add Revoke offers note";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('revoke.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Revoke.addnote()');
        return view('backend.pages.revoke.addrevokenote',$data);
    }

    public function approvedRevoke(Request $request){

        $data['title'] = "Weunite91 | Admin - Approve revoke offers";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('revoke.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Revoke.approved()');
        return view('backend.pages.revoke.approvedrevoke',$data);
    }
    public function viewrewoke(Request $request,$id){
        $objUser = new Users();
        $data['detailsinvestor'] = $objUser->getinvokedetailsinvestor($id);

        $objUser = new Users();
        $data['detailsfr'] = $objUser->getinvokedetailsfr($id);

        $data['title'] = "Weunite91 | Admin - View revoke offers details";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('revoke.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Revoke.revokeview()');
        return view('backend.pages.revoke.revoke-view',$data);

    }

    public function editFundDetailAdmin(Request $request,$id){
        if ($request->isMethod('post')) {
            $objUsers = new Users();
            $result =  $objUsers->editFundDetailAdmin($request,$id);
            if($result == 'done'){
                    $return['status'] = 'success';
                    $return['message'] = 'Details successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('edit-user-details',$id);
             }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
             echo json_encode($return);
            exit;
        }
    }

    public function editFundPaymentAdmin(Request $request,$id){
        if ($request->isMethod('post')) {
            $objPaymentDetails = new Fund_payment_details;
            $result=$objPaymentDetails->editFundPaymentAdmin($request,$id);
            if($result){
                    $return['status'] = 'success';
                    $return['message'] = 'Details successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('edit-user-details',$id);
             }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
            echo json_encode($return);
            exit;
        }
    }

    public function updateFranchiseByadmin(Request $request,$id){
        if ($request->isMethod('post')) {
            $objPaymentDetails = new FranchiseDeatils;
            $result=$objPaymentDetails->updateFranchiseByadmin($request,$id);
            if($result){
                    $return['status'] = 'success';
                    $return['message'] = 'Details successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('edit-user-details',$id);
             }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
            echo json_encode($return);
            exit;
        }
    }

    public function updatePartnerByadmin(Request $request,$id){
        if ($request->isMethod('post')) {
            $objPaymentDetails = new Partnerdetails;
            $result=$objPaymentDetails->updatePartnerByadmin($request,$id);
            if($result=='done'){
                    $return['status'] = 'success';
                    $return['message'] = 'Details successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('edit-user-details',$id);
            }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }
    }


}
