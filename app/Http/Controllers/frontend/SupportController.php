<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\SupportModel;
use App\Model\Gladtoassist;
class SupportController extends Controller
{
    public function gladeToAssist(Request $request){
    	if ($request->isMethod('post')) {
            // echo "<pre>";print_r($request->input());die;
            $objGlade = new Gladtoassist();
            $result = $objGlade->sendMailGlade($request);
            if($result == 'added'){
                $return['status'] = 'success';
                $return['message'] = 'Your request successfully submitted.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = url()->previous();
            }
            if($result == 'wrong'){
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit();
    	}
    }
    
    public function supportinghand(Request $request){
    	if ($request->isMethod('post')) {
            // echo "<pre>";print_r($request->input());die;
            $objGlade = new SupportModel();
            $result = $objGlade->sendMailGlade($request->input());
            if($result == 'added'){
                $return['status'] = 'success';
                $return['message'] = 'Your request successfully submitted.';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = url()->previous();
            }
            if($result == 'wrong'){
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$("#loader").hide();$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode($return);
            exit();
    	}
    }
}
