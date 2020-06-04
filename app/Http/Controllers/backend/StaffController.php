<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;
use App\Model\Users;
use App\Model\Staff;
class StaffController extends Controller
{
    //
    function __construct() {

    }

    public function stafflist(Request $request){
        $data['title'] = "Weunite91 | Admin -  Staff list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('staff.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Staff.init()');
        return view('backend.pages.staff.stafflist',$data);
    }

    public function addstaff(Request $request){


        if ($request->isMethod('post')) {

            $objStaff= new Users();
            $result = $objStaff->addStaff($request);
            if($result == 'added'){
                    $return['status'] = 'success';
                    $return['message'] = 'Staff account has been successfully registered.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('staff');
             }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
             if($result == 'exits'){
                    $return['status'] = 'error';
                    $return['message'] = 'This email is already registerd!';
             }
             echo json_encode($return);
            exit;
        }
        $data['title'] = "Weunite91 | Admin -  Add new Staff";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('ajaxfileupload.js','jquery.form.min.js','staff.js', 'userfunction.js');
        $data['funinit'] = array('Staff.add()');
        return view('backend.pages.staff.addstaff',$data);
    }

    public function editstaff(Request $request,$id){

        $objStaff  = new Staff();
        $data['staffdetails'] = $objStaff->getstaffdetails($id);
        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();

        if ($request->isMethod('post')) {
            $objStaff= new Users();
            $result = $objStaff->editStaff($request);
            if($result == 'added'){
                    $return['status'] = 'success';
                    $return['message'] = 'Staff details successfully updted.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('staff');
             }
            if($result == 'wrong'){
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong.Please try again';
             }
             if($result == 'exits'){
                    $return['status'] = 'error';
                    $return['message'] = 'This email is already registerd!';
             }
             echo json_encode($return);
            exit;
        }
        $data['title'] = "Weunite91 | Admin -  Edit staff ";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('staff.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Staff.edit()');
        return view('backend.pages.staff.editstaff',$data);
    }

     public function ajaxAction(Request $request){

        $action = $request->input('action');
         switch ($action) {

            case 'get-staff-datatable':

                $objStaff = new Staff();
                $list = $objStaff->getstafflist();
                echo json_encode($list);
                break;

            case 'deleteStaff':

                $objStaff = new Staff();
                $list = $objStaff->deleteStaff($request->input('data'));
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'Staff Deleted successfully.';
                    $return['redirect'] = route('staff');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;

        }

     }
}
