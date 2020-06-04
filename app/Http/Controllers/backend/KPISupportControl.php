<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\KPISupportModel;
class KPISupportControl extends Controller {

    //
    function __construct() {

    }

    public function kpisupportRequest(Request $request) {
        $data['title'] = 'Weunite91 | Admin - KPI support request list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('kpisupportrequest.js');
        $data['funinit'] = array('KPISupport.init()');
        return view('backend.pages.kpisupport.kpisupport', $data);
    }

    public function ajaxAction(Request $request) {

        $action = $request->input('action');

        switch ($action) {
            case 'get-kpisupport-datatable':
                $objperoposal = new KPISupportModel();
                $list = $objperoposal->GetAllKPISupportRequest();
                echo json_encode($list);
                exit();
                break;
            case 'deleterequest':
                $objperoposal = new KPISupportModel();
                $list = $objperoposal->deleterequest($request->input('data'));
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'Supporting hand request Deleted successfully.';
                    $return['redirect'] = route('kpisupportrequest');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
        }
    }

}
