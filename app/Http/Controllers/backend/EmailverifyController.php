<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
class EmailverifyController extends Controller
{
    //
     public function index(Request $request){
        $data['title'] = "Weunite91 | Admin - Pendding emil verification user's list";
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('emailverify.js','ajaxfileupload.js', 'jquery.form.min.js','userfunction.js');
        $data['funinit'] = array('Emailverify.init()',"Userfunction.init()");
        return view('backend.pages.users.email',$data);
    }


    public function ajaxAction(Request $request){

        $action = $request->input('action');

        switch ($action) {
            case 'get-email-datatable':
                $objUsers = new Users();
                $list = $objUsers->getemaildatatable();
                echo json_encode($list);
                exit();
                break;
        }
    }
}
