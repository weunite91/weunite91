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
use App\Model\Comments;
use App\Model\Fund_raiser_image;

class StaffmainController extends Controller {

    function __construct() {

    }

    public function dashborad( Request $request ) {

        $data['title'] = 'Weunite91 | Staff - dashborad';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array();
        $data['funinit'] = array();
        return view( 'backend.pages.staffmain.dashborad', $data );
    }

    public function pendingprofile( Request $request ) {
        $data['title'] = "Weunite91 | Staff - pending profile user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array( 'staffmain.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'pendingapprovalfunction.js' );
        $data['funinit'] = array( 'Staffmain.init()', 'Pendingfunction.init()' );
        return view( 'backend.pages.staffmain.pendingprofile', $data );
    }

    public function pendingapprovalstaff( Request $request ) {
        $data['title'] = "Weunite91 | Staff - pending approval profile user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array( 'staffmain.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'pendingapprovalfunction.js' );
        $data['funinit'] = array( 'Staffmain.pending()', 'Pendingfunction.init()' );
        return view( 'backend.pages.staffmain.pendingapprovalstaff', $data );
    }

    public function ajaxAction( Request $request ) {
        $action = $request->input( 'action' );
        $session = $request->session()->all();
        $logged_in_id = $session['logindata'][0]['id'];
        switch ( $action ) {
            case 'get-pending-datatable':
            $objUsers = new Users();
            $list = $objUsers->getpendingdatatable($logged_in_id);
            echo json_encode( $list );
            break;
            
            case 'get-pendingapproval-datatable':
            $objUsers = new Users();
            $list = $objUsers->getPendingApprovalStaffdatatable($logged_in_id);
            echo json_encode( $list );
            break;

            case 'changeusertypestaff':
            $objUsers = new Users();
            $list = $objUsers->changeusertype( $request );
            if ( $list ) {
                $return['status'] = 'success';
                $return['message'] = 'User Type successfully changed.';
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode( $return );
            break;

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


            case 'changestaffverify':
            $objUsers = new Users();
            $list = $objUsers->changestaffverify( $request, $logged_in_id );
            if ( $list ) {
                $return['status'] = 'success';
                $return['message'] = 'User Profile successfully verified.';
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode( $return );
            break;
            case 'changestaffverifypendingapproval':
            $objUsers = new Users();
            $list = $objUsers->changestaffverify( $request, $logged_in_id );
            if ( $list ) {
                $return['status'] = 'success';
                $return['message'] = 'User Profile successfully verified.';
                // $return['redirect'] = route( 'pending-approval-staff' );
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode( $return );
            break;
            case 'deleteUser':
            $objUsers = new Users();
            $list = $objUsers->deleteUser( $request );
            if ( $list ) {
                $return['status'] = 'success';
                $return['message'] = 'User deleted successfully.';
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode( $return );
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

    public function userdetails( Request $request, $id ) {

        $objuser = new Users();
        $data['userrole'] = $objuser->getuserrole( $id );
        $data['title'] = 'Weunite91 | Staff - User details';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array( 'staffuserdetails.js', 'ajaxfileupload.js', 'jquery.form.min.js' );
        $data['funinit'] = array( 'Staffuserdetails.init()' );
        if ( $data['userrole'][0]->roles == 'FR' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getuserdetailsview( $id );
            return view('backend.pages.staff.userdetails', $data );
        }
        if ( $data['userrole'][0]->roles == 'I' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getInvestorDetailsView( $id );
            return view( 'backend.pages.staff.investordetails', $data );
        }
        if ( $data['userrole'][0]->roles == 'F' ) {
            $objuser = new Users();
            $data['userDetails'] = $objuser->getviewuserdetails( $id );
            return view( 'backend.pages.staff.franchisedetails', $data );
        }
        if ( $data['userrole'][0]->roles == 'P' ) {
            $objuser = new Users();
            $data['userDetails'] = $objuser->getviewuserdetails( $id );
            return view( 'backend.pages.staff.partnerdetails', $data );
        }
    }

    public function edituserdetails( Request $request, $id ) {
        $session = $request->session()->all();
        if ( $request->isMethod( 'post' ) ) {
            $objUsers = new Users();
            $result = $objUsers->edituserdetailsAdmin( $request, $id );
            if ( $result == 'done' ) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'edit-user-details-staff', $id );
            }
            if ( $result == 'wrong' ) {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode( $return );
            exit;
        }
        $data['statelist'] = [];
        $data['citylist'] = [];
        $data['user_id'] = $id;
        $objuser = new Users();
        $data['userrole'] = $objuser->getuserrole( $id );

        $objdesignation = new Designation();
        $data['designationlist'] = $objdesignation->designationlist();

        $objfundraiser = new Fundraiserdetails();
        $data['fundriserdetais'] = $objfundraiser->getProfileDataCountry( $id );

        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();

        $objCountry = new Country();
        $data['countryname'] = $objCountry->countryname();

        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();

        $data['title'] = 'Weunite91 | Staff - edit user details';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array( 'staffuserdetails.js', 'ajaxfileupload.js', 'jquery.form.min.js' );
        $data['funinit'] = array( 'Staffuserdetails.init()' );

        if ( $data['userrole'][0]->roles == 'FR' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getuserdetailsview( $id );

            $objState = new State();
            $data['statelist'] = $objState->statelist( $data['userdetails'][0]->country );

            $objCity = new City();
            $data['citylist'] = $objCity->citylist( $data['userdetails'][0]->state );
            return view( 'backend.pages.staff.edituserdetails', $data );
        }
        if ( $data['userrole'][0]->roles == 'I' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getInvestorDetailsView( $id );

            $objState = new State();
            $data['statelist'] = $objState->statelist( $data['userdetails'][0]->country );

            $objCity = new City();
            $data['citylist'] = $objCity->citylist( $data['userdetails'][0]->state );

            return view( 'backend.pages.staff.edituserdetailsinvestor', $data );
        }
        if ( $data['userrole'][0]->roles == 'F' ) {
            $objuser = new FranchiseDeatils();
            $data['userdetails'] = $objuser->getfranchisedetails( $id );
            return view( 'backend.pages.staff.edituserdetailsfranchise', $data );
        }
        if ( $data['userrole'][0]->roles == 'P' ) {
            $objuser = new Partnerdetails();
            $data['userdetails'] = $objuser->getuserdetails( $id );

            $objState = new State();
            $data['statelist'] = $objState->statelist( $data['userdetails'][0]->country );

            $objCity = new City();
            $data['citylist'] = $objCity->citylist( $data['userdetails'][0]->state );
            return view( 'backend.pages.staff.edituserdetailspartnerdetails', $data );
        }
    }

    public function updateInvestorByadmin( Request $request, $id ) {
        if ( $request->isMethod( 'post' ) ) {

            $objUser = new Users();
            $result = $objUser->updateInvestorByAdmin( $request, $id );
            if ( $result ) {
                $return['status'] = 'success';
                $return['message'] = 'Investor Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'edit-user-details-staff', $id );
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode( $return );
            exit;
        }
    }

    public function editFundDetailAdmin( Request $request, $id ) {
        if ( $request->isMethod( 'post' ) ) {
            $objUsers = new Users();
            $result = $objUsers->editFundDetailAdmin( $request, $id );
            if ( $result == 'done' ) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'edit-user-details-staff', $id );
            }
            if ( $result == 'wrong' ) {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode( $return );
            exit;
        }
    }

    public function editFundPaymentAdmin( Request $request, $id ) {
        if ( $request->isMethod( 'post' ) ) {
            $objPaymentDetails = new Fund_payment_details;
            $result = $objPaymentDetails->editFundPaymentAdmin( $request, $id );
            if ( $result ) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'edit-user-details-staff', $id );
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode( $return );
            exit;
        }
    }

    public function updateFranchiseByadmin( Request $request, $id ) {
        if ( $request->isMethod( 'post' ) ) {
            $objPaymentDetails = new FranchiseDeatils;
            $result = $objPaymentDetails->updateFranchiseByadmin( $request, $id );
            if ( $result ) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'edit-user-details-staff', $id );
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode( $return );
            exit;
        }
    }

    public function updatePartnerByadmin( Request $request, $id ) {
        if ( $request->isMethod( 'post' ) ) {
            $objPaymentDetails = new Partnerdetails;
            $result = $objPaymentDetails->updatePartnerByadmin( $request, $id );
            if ( $result == 'done' ) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'edit-user-details-staff', $id );
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode( $return );
            exit;
        }
    }

    public function addnote( Request $request, $id ) {
        $objUser = new Users();
        $data['userdetalis'] = $objUser->userdetails( $id );
        if ( $request->isMethod( 'post' ) ) {
            $objUser = new Users();
            $result = $objUser->addnote( $request );
            if ( $result ) {
                $return['status'] = 'success';
                $return['message'] = 'Staff account has been successfully registered.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'add-note-staff',$id );
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
        $data['js'] = array( 'staffmain.js', 'ajaxfileupload.js', 'jquery.form.min.js' );
        $data['funinit'] = array( 'Staffmain.addnote()' );
        return view( 'backend.pages.staff.addnote', $data );
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
                $return['redirect'] = route( 'comments-details-staff',$id );
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


}
