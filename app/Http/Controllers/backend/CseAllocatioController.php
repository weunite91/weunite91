<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cso;
class CseAllocatioController extends Controller
{
    function __construct() {
    }

    public function cselist(){

        $objCso = new Cso();
        $data['csolist'] = $objCso->csoListAllocation();

        $data['title'] = "Weunite91 | Admin -  User allocation list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cseallocation.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Cseallocation.init()');
        return view('backend.pages.cseallocation.list',$data);
    }

    public function ajaxAction(Request $request){
        $action = $request->input('action');
        switch ($action) {

            case 'get-cse-allocattion-datatable':

                $objCso = new Cso();
                $list = $objCso->getallocattionList();
                echo json_encode($list);
                break;

            case 'allocation':
                $objCso = new Cso();
                $list = $objCso->allocation($request);
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'User allocated to crew member successfully.';
                    $return['redirect'] = route('cse-allocation');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
            }



    }
}
