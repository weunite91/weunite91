<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;
use App\Model\Users;
use App\Model\Staff;

class CrewlistController extends Controller
{
    //
    function __construct() {

    }

    public function crewlist(Request $request){
        $data['title'] = "Weunite91 | Admin -  Crew list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('crew.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Crew.init()');
        return view('backend.pages.crew.crewlist',$data);
    }

    public function addcrew(Request $request){
        if ($request->isMethod('post')) {

            $objStaff= new Users();
            $result = $objStaff->addStaff($request);
            if($result == 'added'){
                    $return['status'] = 'success';
                    $return['message'] = 'Staff account has been successfully registered.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('crew-list');
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
        $data['title'] = "Weunite91 | Admin -  Crew list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('crew.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Crew.add()');
        return view('backend.pages.crew.addcrew',$data);
    }

    public function editcrew(Request $request,$id){

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
                    $return['redirect'] = route('crew-list');
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
        $data['js'] = array('crew.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Crew.edit()');
        return view('backend.pages.crew.editcrew',$data);
    }


    public function viewcrew(Request $request,$id){
        $objStaff = new Staff();
        $data['stafflist'] = $objStaff->staffList($id);

        $objStaff  = new Staff();
        $data['staffdetails'] = $objStaff->getstaffdetails($id);

        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();
        $data["id"] = $id;

        $data['title'] = "Weunite91 | Admin -  View User alloction list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('crew.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Crew.view()');
        return view('backend.pages.crew.viewcrew',$data);
    }

    public function ajaxAction(Request $request){
        $action = $request->input( 'action' );
        $session = $request->session()->all();
        $logged_in_id = $session['logindata'][0]['id'];
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
                    $return['message'] = 'Crew Deleted successfully.';
                    $return['redirect'] = route('crew-list');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;

                case 'get-user-allocattion-datatable':
                    $objStaff = new Staff();
                    $list = $objStaff->userAllocationList($request->input('data')['staffId']);
                    echo json_encode($list);
                    break;

                case 'removeAllocation':
                    $staffid = $request->input('staffid') ;
                    $objStaff = new Staff();
                    $list = $objStaff->removeAllocation($request);
                    if ($list) {
                        $return['status'] = 'success';
                        $return['message'] = 'User allocation removed successfully.';
                        $return['redirect'] = route('view-crew',$staffid);
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'something will be wrong.';
                    }
                    echo json_encode($return);
                    break;

                case 'changeallocation':
                    $staffid = $request->input('staffid') ;
                    $objStaff = new Staff();
                    $list = $objStaff->changeallocation($request);
                    if ($list) {
                        $return['status'] = 'success';
                        $return['message'] = 'User allocation changed to other crew member successfully.';
                        $return['redirect'] = route('view-crew',$staffid);
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'something will be wrong.';
                    }
                    echo json_encode($return);
                    break;

        }

     }
}
