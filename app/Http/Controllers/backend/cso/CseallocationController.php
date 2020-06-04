<?php

namespace App\Http\Controllers\backend\cso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Csocseallocation;
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

class CseallocationController extends Controller
{
    //
    function __construct()
    {

    }


    public function cselist(){
        $data['title'] = 'Weunite91 | CSO - CSE List';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cselist.js', 'jquery.form.min.js');
        $data['funinit'] = array('Cselist.init()');
        return view('backend.pages.csomanagement.cseallocation.list',$data);
    }

    public function viewcse(Request $request,$id){
        $data['id'] = $id;
        $data['title'] = 'Weunite91 | CSO - CSE List';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cselist.js', 'jquery.form.min.js','usercsofunction.js');
        $data['funinit'] = array('Cselist.view()','Usercsefunction.init()');
        return view('backend.pages.csomanagement.cseallocation.viewcse',$data);
    }

    public function addnote(Request $request,$id){
        $data['id'] = $id;
        $objUser = new Users();
        $data['userdetalis'] = $objUser->userdetails( $id );

        if ( $request->isMethod( 'post' ) ) {
            $objUser = new Users();
            $result = $objUser->addnote( $request );
            if ( $result ) {
                $return['status'] = 'success';
                $return['message'] = 'User note successfully added.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'add-note-cse',$id );
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
        $data['js'] = array( 'cselist.js',  'ajaxfileupload.js', 'jquery.form.min.js' );
        $data['funinit'] = array('Cselist.addNote()');

        return view('backend.pages.csomanagement.cseallocation.addNote',$data);
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
                $return['redirect'] = route( 'comments-details-cse',$id );
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
        return view( 'backend.pages.csomanagement.cseallocation.comments', $data );
    }



    public function edituserdetails(Request $request,$id){

        $session = $request->session()->all();
        if ( $request->isMethod( 'post' ) ) {
            $objUsers = new Users();
            $result = $objUsers->edituserdetailsAdmin( $request, $id );
            if ( $result == 'done' ) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'edit-user-details-cse', $id );
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

        $data['id'] = $id;
        $data['title'] = 'Weunite91 | CSO - CSE List';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cselist.js',  'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Cselist.edit()');

        if ( $data['userrole'][0]->roles == 'FR' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getuserdetailsview( $id );

            $objState = new State();
            $data['statelist'] = $objState->statelist( $data['userdetails'][0]->country );

            $objCity = new City();
            $data['citylist'] = $objCity->citylist( $data['userdetails'][0]->state );
            return view( 'backend.pages.csomanagement.cseallocation.edituserdetails.edituserdetails', $data );
        }
        if ( $data['userrole'][0]->roles == 'I' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getInvestorDetailsView( $id );

            $objState = new State();
            $data['statelist'] = $objState->statelist( $data['userdetails'][0]->country );

            $objCity = new City();
            $data['citylist'] = $objCity->citylist( $data['userdetails'][0]->state );

            return view( 'backend.pages.csomanagement.cseallocation.edituserdetails.edituserdetailsinvestor', $data );
        }
        if ( $data['userrole'][0]->roles == 'F' ) {
            $objuser = new FranchiseDeatils();
            $data['userdetails'] = $objuser->getfranchisedetails( $id );
            return view( 'backend.pages.csomanagement.cseallocation.edituserdetails.edituserdetailsfranchise', $data );
        }
        if ( $data['userrole'][0]->roles == 'P' ) {
            $objuser = new Partnerdetails();
            $data['userdetails'] = $objuser->getuserdetails( $id );

            $objState = new State();
            $data['statelist'] = $objState->statelist( $data['userdetails'][0]->country );

            $objCity = new City();
            $data['citylist'] = $objCity->citylist( $data['userdetails'][0]->state );
            return view( 'backend.pages.csomanagement.cseallocation.edituserdetails.edituserdetailspartnerdetails', $data );
        }
    }

    public function viewuserdetails(Request $request,$id){
        $data['id'] = $id;

        $objuser = new Users();
        $data['userrole'] = $objuser->getuserrole( $id );

        $data['title'] = 'Weunite91 | CSO - User details List';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array();
        $data['funinit'] = array();
        if ( $data['userrole'][0]->roles == 'FR' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getuserdetailsview( $id );
            return view('backend.pages.csomanagement.cseallocation.userdetails.fundraiser', $data );
        }
        if ( $data['userrole'][0]->roles == 'I' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getInvestorDetailsView( $id );
            return view( 'backend.pages.csomanagement.cseallocation.userdetails.investordetails', $data );
        }
        if ( $data['userrole'][0]->roles == 'F' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getviewuserdetails( $id );
            return view( 'backend.pages.csomanagement.cseallocation.userdetails.franchisedetails', $data );
        }
        if ( $data['userrole'][0]->roles == 'P' ) {
            $objuser = new Users();
            $data['userdetails'] = $objuser->getviewuserdetails( $id );
            return view( 'backend.pages.csomanagement.cseallocation.userdetails.partnerdetails', $data );
        }
    }


    public function ajaxAction(Request $request){
        $action = $request->input('action');
        $session = $request->session()->all();
        $logged_in_id = $session['logindata'][0]['id'];
        switch ($action) {

            case 'get-cse-list-datatable':
                $objCsocseallocation = new Csocseallocation();
                $cseList = $objCsocseallocation->cseList();

                echo json_encode($cseList);
                break;

            case 'get-cse-view-datatable':

                $objCsocseallocation = new Csocseallocation();
                $cseList = $objCsocseallocation->getcseviewdatatable($request->input('data')['cseId']);

                echo json_encode($cseList);
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



        }
    }

    public function editFundDetailAdmin( Request $request, $id ) {
        if ( $request->isMethod( 'post' ) ) {
            $objUsers = new Users();
            $result = $objUsers->editFundDetailAdmin($request, $id);
            if ( $result == 'done' ) {
                $return['status'] = 'success';
                $return['message'] = 'Details successfully updated.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'edit-user-details-cse', $id );
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
                $return['redirect'] = route( 'edit-user-details-cse', $id );
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode( $return );
            exit;
        }
    }
}
