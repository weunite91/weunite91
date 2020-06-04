<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\All_paymentModel;
use DB;
class AllpaymentController extends Controller
{
    public function allpayment(Request $request){
    	$data['title'] = 'Weunite91 | Admin - All payment list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('allpayment.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Allpayment.init()'); 
        return view('backend.pages.allpayment.allpaymentlist',$data);
    }

    public function ajaxAction(Request $request){
         
        $action = $request->input('action');

        switch ($action) {
            case 'get-allpayment-datatable':
                $objectRevoke = new All_paymentModel();
                $list = $objectRevoke->getallpaymentlist();
                echo json_encode($list);
                exit();
                break;
        }
    }
}
