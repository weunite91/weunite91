<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Silder;
use App\Model\Email_images;
class AdmindashboradController extends Controller {

    //

    function __construct() {
        $this->middleware('admin');
    }

    public function dashborad(Request $request) {
        $data['title'] = 'Weunite91 | Admin - My Dashborad';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array();
        $data['funinit'] = array();
        return view('backend.pages.dashborad.dashborad', $data);
    }

    public function slider(Request $request) {
        $data['title'] = 'Weunite91 | Admin - Slider list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('slider.js', 'ajaxfileupload.js', 'jquery.form.min.js', 'userfunction.js');
        $data['funinit'] = array('Slider.init()');
        return view('backend.pages.dashborad.slider', $data);
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
                $return['redirect'] = route('admin-slider');
            }else{
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] = 'Weunite91 | Admin - Add new slider';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array( 'ajaxfileupload.js', 'jquery.form.min.js', 'slider.js','userfunction.js');
        $data['funinit'] = array('Slider.add()');
        return view('backend.pages.dashborad.addslider', $data);
    }
    public function emailImages(Request $request) {
        $session = $request->session()->all();
        $userid = $session['logindata'][0]['id'];
        $objEmail_images = new Email_images();
        $data['emailimage'] = $objEmail_images->get_emailImages();

        if ($request->isMethod('post')) {

            $objEmail_images = new Email_images();
            $result = $objEmail_images->emailImages($request,$userid);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Email template image successfully added';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route('admin-email-image');
            }else{
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
            }
            echo json_encode($return);
            exit;
        }

        $data['title'] = 'Weunite91 | Admin - Email Template Image';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array( 'ajaxfileupload.js', 'jquery.form.min.js', 'slider.js','userfunction.js');
        $data['funinit'] = array('Slider.emailImages()');
        return view('backend.pages.dashborad.emailImages', $data);
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
                    $return['redirect'] = route('admin-slider');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
        }
    }

}
