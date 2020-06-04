<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Staff;
class UserAllocatioController extends Controller
{
    function __construct() {

    }

    public function userlist(Request $request){
        $objStaff = new Staff();
        $data['stafflist'] = $objStaff->staffListAllocation();

        $data['title'] = "Weunite91 | Admin -  User allocation list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('userallocation.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Userallocation.init()');
        return view('backend.pages.userallocation.list',$data);
    }


    public function ajaxAction(Request $request){
        $action = $request->input('action');
        switch ($action) {

            case 'get-user-allocattion-datatable':

               $objStaff = new Staff();
               $list = $objStaff->getallocattionList();
               echo json_encode($list);
               break;

            case 'allocation':
                $objStaff = new Staff();
                $list = $objStaff->allocation($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'User allocated to crew member successfully.';
                    $return['redirect'] = route('user-allocation');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
            }



    }

}
