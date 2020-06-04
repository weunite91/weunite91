<?php

namespace App\Http\Controllers\backend\peoposal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Investor_proposal;
class PeoposalController extends Controller
{
    function __construct() {
        
    }
    
    public function index(Request  $request){
        $data['title'] = 'Weunite91 | Admin - Peoposal List';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('peoposal.js', 'jquery.form.min.js');
        $data['funinit'] = array('Peoposal.init()'); 
        return view('backend.pages.peoposal.peoposal',$data);
    }
    
    public function viewproposal(Request  $request,$id = null){
        $objInvestor =   new Investor_proposal();
        $data['details'] = $objInvestor->details($id);
        $data['title'] = 'Weunite91 | Admin - View Peoposal Details';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('peoposal.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Peoposal.details()'); 
        return view('backend.pages.peoposal.peoposaldetails',$data);
    }
    
    public function editproposal(Request  $request,$id = null){
        if($request->isMethod('post')){
            $objInvestor =   new Investor_proposal();
            $result = $objInvestor->editePropsalDetails($request,$id);
            if($result=='done'){
                $return['status'] = 'success';
                $return['message'] = 'Proposal Details updated successfully.';
                $return['redirect'] = route('peoposal');
            }else{
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
            }
            echo json_encode($return);
            exit();
        }
        $objInvestor =   new Investor_proposal();
        $data['details'] = $objInvestor->details($id);
        $data['title'] = 'Weunite91 | Admin - Edit Peoposal Details';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('peoposal.js','ajaxfileupload.js', 'jquery.form.min.js');
        $data['funinit'] = array('Peoposal.edit()'); 
        return view('backend.pages.peoposal.editproposal',$data);
    }
    
    public function ajaxAction(Request $request){
        $session = session()->all();
        $action = $request->input('action');
         switch ($action) {
            case 'get-proposal-datatable':
                $objperoposal = new Investor_proposal();
                $list = $objperoposal->getproposallist();
                echo json_encode($list);
                break;
            
            case 'approvechange':
                $objperoposal = new Investor_proposal();
                $list = $objperoposal->approvechange($request,$session['logindata'][0]['id']);
                if($list){
                    $return['status'] = 'success';
                    $return['message'] = 'Approve request change successfully changed.';
                    $return['redirect'] = route('peoposal');
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Something goes to wrong';
                }
                echo json_encode($return);
                break;

                case 'allproposalaction':
                    $objperoposal = new Investor_proposal();
                    $list = $objperoposal->allproposalaction($request,$session['logindata'][0]['id']);
                    if($list){
                        $return['status'] = 'success';
                        $return['message'] = 'Approve request change successfully changed.';
                        $return['redirect'] = route('peoposal');
                    }else{
                        $return['status'] = 'error';
                        $return['message'] = 'Something goes to wrong';
                    }
                    echo json_encode($return);
                    break;
         }
    }
}
