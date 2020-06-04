<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Colduser;
use SESSION;
class ColduserController extends Controller
{
    //
    function __construct()
    {
        
    }

    public function all(Request $request){
        $session = $request->session()->all();

        $data['id'] = $session['logindata'][0]['id'];
        
        $data['title'] = 'Weunite91 | Admin - All users list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cold.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Cold.init()');
        return view('backend.pages.colduser.all', $data);
    }

    public function list(Request $request){
        $session = $request->session()->all();

        $data['id'] = $session['logindata'][0]['id'];
        
        $data['title'] = 'Weunite91 | Admin - All users list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('cold.js', 'ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Cold.colduser()');
        return view('backend.pages.colduser.colduser', $data);
    }

    public function ajaxAction(Request $request) {

        $action = $request->input('action');
       
        $session = $request->session()->all();
        switch ($action) {
            case 'get-alluser-datatable':
                $objColduser = new Colduser();
                $list = $objColduser->getalldatatable();
                echo json_encode($list);
                exit();
                break;

            case 'get-cold-user-datatable':
                
                $objColduser = new Colduser();
                $list = $objColduser->getcolddatatable();
                echo json_encode($list);
                exit();
                break;

            case 'movecold':
                    $staffid = $request->input('staffid') ;
                    $id =$session['logindata'][0]['id'];
                    $objColduser = new Colduser();
                    $list = $objColduser->movecold($request,$id);
                    if ($list) {
                        $return['status'] = 'success';
                        $return['message'] = 'Users moved in cold successfully.';
                        $return['redirect'] = route('admin-all-user');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'something will be wrong.';
                    }
                    echo json_encode($return);
                    break;
            case 'removecold':
                    $staffid = $request->input('staffid') ;
                    $id =$session['logindata'][0]['id'];
                    $objColduser = new Colduser();
                    $list = $objColduser->removecold($request,$id);
                    if ($list) {
                        $return['status'] = 'success';
                        $return['message'] = 'Users removed from cold successfully.';
                        $return['redirect'] = route('admin-cold-user');
                    } else {
                        $return['status'] = 'error';
                        $return['message'] = 'something will be wrong.';
                    }
                    echo json_encode($return);
                    break;
        }
    }
}
