<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Deleterequest;
class DeleterequestController extends Controller
{
    //
    function __construct() {
        
    }
    
    public function deletelist(Request $request){
        $data['title'] = 'Weunite91 | Admin - Delete profile list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('deleterequest.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Deleterequest.init()'); 
        return view('backend.pages.deleterequest.list',$data);
    }
    
    public function ajaxAction(Request $request){
        $action = $request->input('action');
        switch ($action) {
            
            case 'get-alluser-datatable':
                
                $objList = new Deleterequest();
                $list = $objList->getdeletelist();
                echo json_encode($list);
                break;
            
            case 'apporverrequest':
                
                $objList = new Deleterequest();
                $list = $objList->apporverrequest($request->input('data'));
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = "User's profile delete requested appoved.";
                    $return['redirect'] = route('delete-request');
                }else{
                     $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                break;
            case 'declienrequest':
                
                $objList = new Deleterequest();
                $list = $objList->declienrequest($request->input('data'));
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = "User's profile delete requested declined.";
                    $return['redirect'] = route('delete-request');
                }else{
                     $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                break;
         }
    }
}
