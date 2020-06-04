<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cso;
use App\Model\Country;
class CsolistController extends Controller
{
    function __construct() {

    }

    public function csolist(Request $request){
        $data['title'] = "Weunite91 | Admin -  Cusrtomer Support Officer list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cso.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Cso.init()');
        return view('backend.pages.cso.csoList',$data);
    }

    public function addcso(Request $request){
        if ($request->isMethod('post')) {

            $objCso= new Cso();
            $result = $objCso->addCso($request);
            if($result == 'added'){
                    $return['status'] = 'success';
                    $return['message'] = 'Customer support officer successfully added.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('cso-list');
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
        $data['title'] = "Weunite91 | Admin -  Add Cusrtomer Support Officer ";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cso.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Cso.add()');
        return view('backend.pages.cso.addcso',$data);
    }


    public function editcso (Request $request,$id){

        $objCso  = new Cso();
        $data['staffdetails'] = $objCso->getcsodetails($id);

        $objCountry = new Country();
        $data['countrylist'] = $objCountry->countrylist();


        if ($request->isMethod('post')) {
            $objCso  = new Cso();
            $result = $objCso->editCso($request);
            if($result == 'added'){
                    $return['status'] = 'success';
                    $return['message'] = 'Customer support officer successfully updated.';
                    $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                    $return['redirect'] = route('cso-list');
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
        $data['title'] = "Weunite91 | Admin -  Edit Cusrtomer Support Officer Details ";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cso.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Cso.edit()');
        return view('backend.pages.cso.editcso',$data);
    }


    public function viewcso(Request $request,$id){

        $objCso = new Cso();
        $data['csolist'] = $objCso->CsoList($id);


        $data["id"] = $id;

        $data['title'] = "Weunite91 | Admin -  View CSO's alloction list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cso.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Cso.view()');
        return view('backend.pages.cso.csoview',$data);
    }

    public function ajaxAction(Request $request){
        $action = $request->input( 'action' );
        $session = $request->session()->all();
        $logged_in_id = $session['logindata'][0]['id'];
        $action = $request->input('action');
            switch ($action) {
                case 'get-cso-datatable':

                    $objCso= new Cso();
                    $list = $objCso->getcsolist();
                    echo json_encode($list);
                    break;


                case 'get-cse-allocattion-datatable':
                    $objCso= new Cso();
                    $list = $objCso->getcseallocattiondatatable($request->input('data')['csoId']);
                    echo json_encode($list);
                    break;

                case 'changeallocation':
                    $csId = $request->input('csoId') ;
                    $objCso = new Cso();
                    $list = $objCso->changeallocation($request);
                    if ($list) {
                        $return['status'] = 'success';
                        $return['message'] = 'User allocation changed to other crew member successfully.';
                        $return['redirect'] = route('view-cso',$csId);
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'something will be wrong.';
                    }
                    echo json_encode($return);
                    break;

                case 'removeAllocation':
                    $csoId = $request->input('csoId') ;
                    $objCso = new Cso();
                    $list = $objCso->removeAllocation($request);
                    if ($list) {
                        $return['status'] = 'success';
                        $return['message'] = 'User allocation removed successfully.';
                        $return['redirect'] = route('view-cso',$csoId);
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'something will be wrong.';
                    }
                    echo json_encode($return);
                    break;

                case 'deletecso':

                    $objCso = new Cso();
                    $list = $objCso->deletecso($request->input('data'));

                    if ($list) {
                        $return['status'] = 'success';
                        $return['message'] = 'CSO Deleted successfully.';
                        $return['redirect'] = route('cso-list');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'something will be wrong.';
                    }
                    echo json_encode($return);
                    break;

            }
    }

}
