<?php

namespace App\Http\Controllers\backend\cso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Csouserallocation;
class UserallocationController extends Controller
{
    //
    function __construct()
    {

    }


    public  function userlist(Request $request){
            $data['title'] = 'Weunite91 - Cso - User Allocation List';
            $data['css'] = array();
            $data['plugincss'] = array();
            $data['pluginjs'] = array();
            $data['js'] = array('ajaxfileupload.js','jquery.form.min.js','csoUserAllocation.js', 'userfunction.js');
            $data['funinit'] = array('UserAllocation.init()');
            return view('backend.pages.csomanagement.userallocation', $data);

    }


    public function ajaxAction(Request $request){
        $action = $request->input('action');

        $session = $request->session()->all();
        $logged_in_id = $session['logindata'][0]['id'];
        switch ($action) {

         case 'get-cso-user-allocation-datatable':
                $objCSElist = new Csouserallocation();
                $cseList = $objCSElist->cseList();

                $bjCsouserallocation = new Csouserallocation();
                $list = $bjCsouserallocation->getcsouserallocationdatatable($cseList);

             echo json_encode($list);
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
        }
    }
}
