<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SupportModel;
class SupportController extends Controller {

    //
    function __construct() {
        
    }

    public function supportRequest(Request $request) {
        $data['title'] = "Weunite91 | Staff - Support request";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('supportrequest.js');
        $data['funinit'] = array('Support.init()');
        return view('backend.pages.support.allrequest', $data);
    }

    public function ajaxAction(Request $request) {

        $action = $request->input('action');

        switch ($action) {
            case 'get-support-datatable':
                $objperoposal = new SupportModel();
                $list = $objperoposal->GetAllSupportRequest();
                echo json_encode($list);
                exit();
                break;
            case 'deleterequest':
                $objperoposal = new SupportModel();
                $list = $objperoposal->deleterequest($request->input('data'));
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'Supporting hand request Deleted successfully.';
                    $return['redirect'] = route('supportrequest');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
        }
    }

}
