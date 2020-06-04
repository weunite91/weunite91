<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Gladtoassist;
class GladassistController extends Controller
{
    //
    function __construct() {

    }

    public function requestlist(Request $request){
        $data['title'] = 'Weunite91 | Admin - Glad to assist request list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('gladtoassist.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Gladtoassis.init()');
        return view('backend.pages.gladtoassist.list',$data);
    }

    public function ajaxAction(Request $request){
       $action = $request->input('action');

        switch ($action) {
             case 'get-datatable':
                $objGladtoassist = new Gladtoassist();
                $list = $objGladtoassist->getdatatable();
                echo json_encode($list);
                break;

             case 'deleterequest':
                $objGladtoassist = new Gladtoassist();
                $list = $objGladtoassist->deleterequest($request->input('data'));
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'Glad to assiste request Deleted successfully.';
                    $return['redirect'] = route('gladassist');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
        }
    }
}
