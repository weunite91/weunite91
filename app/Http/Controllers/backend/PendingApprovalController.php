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

class PendingApprovalController extends Controller
{
    //
    function __construct() {

    }

    public function all(Request $request){

        $data['title'] = "Weunite91 | Admin -  All pending approval user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('pendingapproval.js','ajaxfileupload.js', 'jquery.form.min.js','pendingapprovalfunction.js');
        $data['funinit'] = array('Pending.init()',"Pendingfunction.init()");
        return view('backend.pages.pendingapproval.all',$data);
    }


    public function fundraiser(Request $request){
        $data['title'] = "Weunite91 | Admin -  All pending approval fund-raiser user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('fundraiser_pendingapproval.js','ajaxfileupload.js', 'jquery.form.min.js','pendingapprovalfunction.js');
        $data['funinit'] = array('Fundraiser_pending.init()',"Pendingfunction.init()");
        return view('backend.pages.pendingapproval.fundraiser',$data);
    }
    public function investor(Request $request){
        $data['title'] = "Weunite91 | Admin -  All pending approval investor user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('investor_pendingapproval.js','ajaxfileupload.js', 'jquery.form.min.js','pendingapprovalfunction.js');
        $data['funinit'] = array('Investor_pending.init()',"Pendingfunction.init()");
        return view('backend.pages.pendingapproval.investor',$data);
    }
    public function partner(Request $request){
        $data['title'] = "Weunite91 | Admin -  All pending approval partner user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('partner_pendingapproval.js','ajaxfileupload.js', 'jquery.form.min.js','pendingapprovalfunction.js');
        $data['funinit'] = array('Partner_pending.init()',"Pendingfunction.init()");
        return view('backend.pages.pendingapproval.partner',$data);
    }
    public function franchise(Request $request){
        $data['title'] = "Weunite91 | Admin -  All pending approval franchise user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('franchise_pendingapproval.js','ajaxfileupload.js', 'jquery.form.min.js','pendingapprovalfunction.js');
        $data['funinit'] = array('Franchise_pending.init()',"Pendingfunction.init()");
        return view('backend.pages.pendingapproval.franchise',$data);
    }

    public function ajaxAction(Request $request){

        $action = $request->input('action');

        switch ($action) {
            case 'get-pendinguser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getPendingApprovaldatatable();
                echo json_encode($list);
                break;

            case 'get-fr-pendinguser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getPendingApprovaldatatable_fr();
                echo json_encode($list);
                break;
            case 'get-i-pendinguser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getPendingApprovaldatatable_i();
                echo json_encode($list);
                break;
            case 'get-f-pendinguser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getPendingApprovaldatatable_f();
                echo json_encode($list);
                break;
            case 'get-p-pendinguser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getPendingApprovaldatatable_p();
                echo json_encode($list);
                break;

            case 'deleteUser':
                $objUsers = new Users();
                $list = $objUsers->deleteUser($request);
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'User deleted successfully.';
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                break;


            case 'get-alluser-datatable':
                $objUsers = new Users();
                $list = $objUsers->getalldatatable();
                echo json_encode($list);
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
                break;

            case 'get-revoke-datatable':
                $objectRevoke = new Users();
                $list = $objectRevoke->getrevokelist();
                echo json_encode($list);
                break;

            case 'revokestatus':
                $objperoposal = new Users();
                $list = $objperoposal->revokestatuschange($request);
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'Revoke status successfully changed.';
                    $return['redirect'] = route('revokeoffers');
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                break;

        }
    }
}
