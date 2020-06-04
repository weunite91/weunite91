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
use App\Model\UserAdminHistory;
use App\Model\UsersPasscode;
use App\Model\VerificationDetails;
use App\Model\Comments;
use App\Model\Fund_raiser_image;
class UserController extends Controller {

    //
    function __construct() {

    }

    public function all(Request $request) {
        $data['title'] = 'Weunite91 | Admin - All users list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('user.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array('User.init()', "Userfunction.init()");
        return view('backend.pages.users.all', $data);
    }

    public function inactive_users_list(Request $request) {
        $data['title'] = 'Weunite91 | Admin - Inactive users list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('inactiveusers.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array("User.init()", "Userfunction.init()");
        return view('backend.pages.users.inactive_users', $data);
    }

    public function verify_address_users_list(Request $request) {
        $data['title'] = "Weunite91 | Admin - Verify address user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('verifyaddressusers.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array("User.init()", "Userfunction.init()");
        return view('backend.pages.users.verify_address_users', $data);
    }

    public function pendding_address_users_list(Request $request) {
        $data['title'] = "Weunite91 | Admin - Panddig address verify user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('penddingaddressusers.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array("Penddingaddressusers.init()", "Userfunction.init()");
        return view('backend.pages.users.pendding_address_users', $data);
    }

    public function fundraiser(Request $request) {
        $data['title'] = "Weunite91 | Admin - Fund Raiser's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array('Fundraiser.init()', "Userfunction.init()");
        return view('backend.pages.users.fundraiser', $data);
    }

    public function investor(Request $request) {
        $data['title'] = "Weunite91 | Admin - Investor's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('investor.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array('Investor.init()', "Userfunction.init()");
        return view('backend.pages.users.investor', $data);
    }

    public function partner(Request $request) {
        $data['title'] = "Weunite91 | Admin - Partner's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('partner.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array('Partner.init()', "Userfunction.init()");
        return view('backend.pages.users.partner', $data);
    }

    public function franchise(Request $request) {
        $data['title'] = "Weunite91 | Admin - Franchise's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('franchise.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array('Franchise.init()', "Userfunction.init()");
        return view('backend.pages.users.franchise', $data);
    }

    public function addnote(Request $request, $id) {
        $objUser = new Users();
        $data['userdetalis'] = $objUser->userdetails($id);
        if ($request->isMethod('post')) {
            $objUser = new Users();
            $result = $objUser->addnote($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Staff account registed successfully created.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('all-users');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] = "Weunite91 | Admin - Add user's note";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('user.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('User.addnote()');
        return view('backend.pages.users.addnote', $data);
    }


    public function comments( Request $request, $id ) {
        $session = $request->session()->all();
        $userId = $data['id'] = $session['logindata'][0]['id'];

        $objComments = new Comments();
        $data['commentlist'] = $objComments->commentlist($id);

        $objUser = new Users();
        $data['userdetalis'] = $objUser->userdetails( $id );
        if ( $request->isMethod( 'post' ) ) {
            $objComments = new Comments();
            $result = $objComments->addcomment( $request ,$id, $userId);
            if ( $result ) {
                $return['status'] = 'success';
                $return['message'] = 'Your comments succesfully added.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'comments-details',$id );
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode( $return );
            exit;
        }

        $data['title'] = 'Weunite91 | Staff - Add user list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array( 'comments.js', 'ajaxfileupload.js', 'jquery.form.min.js' );
        $data['funinit'] = array( 'Comments.init()' );
        return view( 'backend.pages.staff.comments', $data );
    }


    public function ajaxAction(Request $request) {

        $action = $request->input('action');
        $session = $request->session()->all();

        switch ($action) {

            case 'changewipstatus':

                $objUsers = new Users();
                $list = $objUsers->changewipstatus($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'WIP status changed successfully.';
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
                break;

            case 'changeverifyaddressstatus':

                $objUsers = new VerificationDetails();
                $list = $objUsers->changeverifyaddressstatus($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'Address verification status changed successfully.';
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
                break;
            case 'freeaddressverify':

                $objUsers = new VerificationDetails();
                $list = $objUsers->free_verify($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'Address verification status changed successfully.';
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
                break;

            case 'verifyaddress-datatable':
                $objUsers = new Users();
                $list = $objUsers->getverifyaddressusers();
                echo json_encode($list);
                exit();
                break;

            case 'get-pendding-address-user-datatable':
                $objUsers = new Users();
                $list = $objUsers->getpenddingaddressuserdatatable();
                echo json_encode($list);
                exit();
                break;
            case 'inactive-datatable':
                $objUsers = new Users();
                $list = $objUsers->getInactvieusers();
                echo json_encode($list);
                exit();
                break;

                

            case 'get-alluser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getalldatatable();
                echo json_encode($list);
                exit();
                break;

            case 'get-fundraiser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getfundraiserdatatable();
                echo json_encode($list);
                exit();
                break;

            case 'get-investor-datatable':
                $objUsers = new Users();
                $list = $objUsers->getinvestordatatable();
                echo json_encode($list);
                exit();
                break;
            case 'get-franchise-datatable':
                $objUsers = new Users();
                $list = $objUsers->getfranchisedatatable();
                echo json_encode($list);
                exit();
                break;
            case 'get-partner-datatable':
                $objUsers = new Users();
                $list = $objUsers->getpartnerdatatable();
                echo json_encode($list);
                exit();
                break;

            case 'deleteUser':
                $objUsers = new Users();
                $list = $objUsers->deleteUser($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'User deleted successfully.';
                    $return['redirect'] = url()->previous();
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
                break;

            case 'reactivateUser':
                $objUsers = new Users();
                $list = $objUsers->reactivateUser($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'User ReActivated successfully.';
                    $return['redirect'] = url()->previous();
                } else {
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
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'User Type successfully changed.';
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
                break;

            case 'changeadminverify':
                $objUsers = new Users();
                $list = $objUsers->changeadminverify($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'User Profile successfully verified.';
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
                break;

            case 'changeemailverify':
                $objUsers = new Users();
                $list = $objUsers->changeemailverify($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'User Email successfully verified.';
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
                break;
            case 'addressVerify':
                $objUsers = new Users();
                $list = $objUsers->addressVerify($request);
                if ($list == "true") {
                    $return['status'] = 'success';
                    $return['message'] = 'Address successfully verified.';
                } else {
                    if ($list == "data_not_found") {
                        $return['status'] = 'error';
                        $return['message'] = 'User data not found.';
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
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
                $list = $objperoposal->revokestatuschange($request);
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
                $list = $objperoposal->approvedrevokestatuschange($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'Request status successfully updated.';
                    $return['redirect'] = route('approvedrevoke');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                exit();
                break;
            case 'get-support-datatable':
                $objperoposal = new SupportModel();
                $list = $objperoposal->GetAllSupportRequest();
                echo json_encode($list);
                exit();
                break;
            case 'generate-passcode':
                $objPasscode = new UsersPasscode();
                $result = $objPasscode->generate_passcode($request, $session);
                echo json_encode($result);
                exit();
                break;


            case 'deleteImageEditFr':
                $objFund_raiser_image = new Fund_raiser_image();
                $result = $objFund_raiser_image->deleteImageEditFr($request->input('data'));
                return json_encode($result);
                break;

            case 'deleteVideoEditFr':
                $objFund_raiser_image = new Fund_raiser_image();
                $result = $objFund_raiser_image->deleteVideoEditFr($request->input('data'));
                return json_encode($result);
                break;
        }
    }

    public function userdetails(Request $request, $id) {
        $objuser = new Users();
        $data['userrole'] = $objuser->getuserrole($id);
        $data['title'] = "Weunite91 | Admin - User's details";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('userdetails.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Userdetails.init()');
        if ($data['userrole'][0]->roles == "FR") {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getuserdetailsview($id);
            return view('backend.pages.users.userdetails', $data);
        }
        if ($data['userrole'][0]->roles == "I") {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getInvestorDetailsView($id);
            return view('backend.pages.users.investordetails', $data);
        }
        if ($data['userrole'][0]->roles == "F") {
            $objuser = new FranchiseDeatils();
            $data['userdetails'] = $objuser->getProfileData($id);
            return view('backend.pages.users.franchisedetails', $data);
        }
        if ($data['userrole'][0]->roles == "P") {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getPartnerDetailsView($id);

            return view('backend.pages.users.partnerdetails', $data);
        }
    }

    public function edituserdetails(Request $request, $id) {
        $session = $request->session()->all();
        if ($request->isMethod('post')) {
            $objUsers = new Users();
            $result = $objUsers->edituserdetailsAdmin($request, $id);
            if ($result == 'done') {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('edit-user-details', $id);
            }
            if ($result == 'wrong') {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }
        $data['statelist'] = [];
        $data['citylist'] = [];
        $data['user_id'] = $id;
        $objuser = new Users();
        $data['userrole'] = $objuser->getuserrole($id);

        $objdesignation = new Designation();
        $data['designationlist'] = $objdesignation->designationlist();

        $objfundraiser = new Fundraiserdetails();
        $data['fundriserdetais'] = $objfundraiser->getProfileDataCountry($id);
        if (count($data['fundriserdetais']) == 0) {
            $objfundraiser->country = '';
            $objfundraiser->city = '';
            $objfundraiser->state = '';
            $data['fundriserdetais'][] = $objfundraiser;
        }

        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();

        $objCountry = new Country();
        $data['countryname'] = $objCountry->countryname();

        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();


        $data['title'] = "Weunite91 | Admin - Edit user's details";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('userdetails.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Userdetails.init()');

        if ($data['userrole'][0]->roles == "FR") {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getuserdetailsview($id);


            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userdetails'][0]->country);

            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userdetails'][0]->state);
            return view('backend.pages.users.edituserdetails', $data);

        }
        if ($data['userrole'][0]->roles == "I") {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getInvestorDetailsView($id);

            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userdetails'][0]->country);

            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userdetails'][0]->state);

            return view('backend.pages.users.edituserdetailsinvestor', $data);
        }
        if ($data['userrole'][0]->roles == "F") {
            $objuser = new FranchiseDeatils();
            $data['userdetails'] = $objuser->getProfileData($id);
            return view('backend.pages.users.edituserdetailsfranchise', $data);
        }
        if ($data['userrole'][0]->roles == "P") {
            $objuser = new Partnerdetails();
            $data['userdetails'] = $objuser->getuserdetails($id);

            $objState = new State();
            $data['statelist'] = $objState->statelist($data['userdetails'][0]->country);

            $objCity = new City();
            $data['citylist'] = $objCity->citylist($data['userdetails'][0]->state);
            return view('backend.pages.users.edituserdetailspartnerdetails', $data);
        }
    }

    public function updateInvestorByadmin(Request $request, $id) {
        if ($request->isMethod('post')) {

            $objUser = new Users();
            $result = $objUser->updateInvestorByAdmin($request, $id);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Investor Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('edit-user-details', $id);
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function revokeOffers(Request $request) {

        $data['title'] = "Weunite91 | Admin - Rework offer's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('revoke.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Revoke.init()');
        return view('backend.pages.revoke.revoke', $data);
    }

    public function addRevokeNote(Request $request, $id) {
        if ($request->isMethod('post')) {
            $objUsers = new Users();
            $result = $objUsers->addRevokeNote($request, $id);
            if ($result == 'done') {
                $return['status'] = 'success';
                $return['message'] = 'Revoke note updated successfully.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('add-revoke-note', $id);
            }
            if ($result == 'wrong') {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }

        $objUsers = new Users();
        $data['revokenote'] = $objUsers->getRevokeNote($id);

        $data['title'] = "Weunite91 | Admin - Add revoke note";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('revoke.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Revoke.addnote()');
        return view('backend.pages.revoke.addrevokenote', $data);
    }

    public function approvedRevoke(Request $request) {

        $data['title'] = "Weunite91 | Admin - Approve revoke users's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('revoke.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Revoke.approved()');
        return view('backend.pages.revoke.approvedrevoke', $data);
    }

    public function viewrewoke(Request $request, $id) {
        $objUser = new Users();
        $data['detailsinvestor'] = $objUser->getinvokedetailsinvestor($id);

        $objUser = new Users();
        $data['detailsfr'] = $objUser->getinvokedetailsfr($id);

        $data['title'] = "Weunite91 | Admin - View rewoke details";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('revoke.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Revoke.revokeview()');
        return view('backend.pages.revoke.revoke-view', $data);
    }

    public function editFundDetailAdmin(Request $request, $id) {
        if ($request->isMethod('post')) {
            $objUsers = new Users();
            $result = $objUsers->editFundDetailAdmin($request, $id);
            if ($result == 'done') {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('edit-user-details', $id);
            }
            if ($result == 'wrong') {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function editFundPaymentAdmin(Request $request, $id) {
        if ($request->isMethod('post')) {
            $objPaymentDetails = new Fund_payment_details;
            $result = $objPaymentDetails->editFundPaymentAdmin($request, $id);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('edit-user-details', $id);
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function updateFranchiseByadmin(Request $request, $id) {
        if ($request->isMethod('post')) {
            $objPaymentDetails = new FranchiseDeatils;
            $result = $objPaymentDetails->updateFranchiseByadmin($request, $id);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('edit-user-details', $id);
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function updatePartnerByadmin(Request $request, $id) {
        if ($request->isMethod('post')) {
            $objPaymentDetails = new Partnerdetails;
            $result = $objPaymentDetails->updatePartnerByadmin($request, $id);
            if ($result == 'done') {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('edit-user-details', $id);
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }
    }

    public function user_status_history(Request $request, $id) {
        $objUsers = new UserAdminHistory();
        $result = $objUsers->get_status_history_by_user_id($id);

        echo json_encode($result);
    }

}
