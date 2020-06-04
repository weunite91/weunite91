<?php

namespace App\Http\Controllers\backend\cso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Silder;
class SliderController extends Controller
{
    //

    public function slider(Request $request) {

        $data['title'] = 'Weunite91 - Admin - Home Page Silder';
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('ajaxfileupload.js','jquery.form.min.js','slidercso.js', 'userfunction.js');
        $data['funinit'] = array('Slider.init()');
        return view('backend.pages.csomanagement.slider.slider', $data);
    }


    public function addslider(Request $request) {
        $session = $request->session()->all();
     $userid = $session['logindata'][0]['id'];
     if ($request->isMethod('post')) {

         $objSilder = new Silder();
         $result = $objSilder->addSlider($request,$userid);
         if ($result) {
             $return['status'] = 'success';
             $return['message'] = 'Slider Image successfully added';
             $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
             $return['redirect'] = route('cso-slider');
         }else{
             $return['status'] = 'error';
             $return['message'] = 'Something goes to wrong.Please try again';
         }
         echo json_encode($return);
         exit;
     }
     $data['title'] = 'Weunite91 - Admin - Add Home Page Silder';
     $data['css'] = array();
     $data['plugincss'] = array();
     $data['pluginjs'] = array();
     $data['js'] = array('ajaxfileupload.js','jquery.form.min.js','slidercso.js', 'userfunction.js');
     $data['funinit'] = array('Slider.add()');
     return view('backend.pages.csomanagement.slider.addslider', $data);
 }

 public function ajaxAction(Request $request) {

     $action = $request->input('action');
     switch ($action) {

         case 'getdatatable':
             $objSilder = new Silder();
             $list = $objSilder->getSilderlist();
             echo json_encode($list);
             break;

         case 'deleteslider':

             $objSilder = new Silder();
             $list = $objSilder->deleteslider($request->input('data'));
             if ($list) {
                 $return['status'] = 'success';
                 $return['message'] = 'Slider Image Deleted successfully.';
                 $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                 $return['redirect'] = route('cso-slider');
             } else {
                 $return['status'] = 'error';
                 $return['message'] = 'something will be wrong.';
             }
             echo json_encode($return);
             break;
     }
 }
}
