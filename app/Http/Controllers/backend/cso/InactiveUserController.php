<?php

namespace App\Http\Controllers\backend\cso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Csouserallocation;
class InactiveUserController extends Controller
{
    //
    function __construct()
    {

    }

    public function userlist(Request $request){
        $data['title'] = 'Weunite91 - Cso - Pendding Approver User Allocation List';
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('ajaxfileupload.js','jquery.form.min.js','activeuserlist.js', 'userfunction.js');
        $data['funinit'] = array('Activeuserlist.inactive()');
        return view('backend.pages.csomanagement.inactive', $data);
    }

    public function ajaxAction(Request $request){
        $action = $request->input('action');
        switch ($action) {

            case 'get-inactive-user-datatable':
                   $objCSElist = new Csouserallocation();
                   $cseList = $objCSElist->cseList();

                   $bjCsouserallocation = new Csouserallocation();
                   $list = $bjCsouserallocation->getinactiveuserdatatable($cseList);

                echo json_encode($list);
                break;
            }

    }

}
