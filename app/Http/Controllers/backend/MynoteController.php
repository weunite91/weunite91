<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Mynote;
use App\Model\Users;
class MynoteController extends Controller
{
    function __construct()
    {

    }

    public function note(Request $request){
        $session = $request->session()->all();
        $userId = $data['id'] = $session['logindata'][0]['id'];


        $objUser = new Users();
        $data['userdetalis'] = $objUser->userdetails( $userId );

        $objMynote = new Mynote();
        $data['notelist'] = $objMynote->notelist($userId);

        if ( $request->isMethod( 'post' ) ) {
            $objMynote = new Mynote();
            $result = $objMynote->addnote($request ,$userId);
            if ( $result ) {
                $return['status'] = 'success';
                $return['message'] = 'Your note succesfully added.';
                $return['jscode'] = '$(".submitbtn:visible").attr("disabled","disabled");';
                $return['redirect'] = route( 'my-note');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong.Please try again';
                $return['jscode'] = '$(".submitbtn:visible").removeAttr("disabled");';
            }
            echo json_encode( $return );
            exit;
        }

        $data['title'] = 'Weunite91 | Staff - Add user list';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array( 'note.js', 'ajaxfileupload.js', 'jquery.form.min.js' );
        $data['funinit'] = array( 'Note.init()' );
        return view( 'backend.pages.adminnote.note', $data );
    }

    //

    public function ajaxAction(Request $request) {

        $action = $request->input('action');

        switch ($action) {

            case 'deletenote':
                $objMynote = new Mynote();
                $list = $objMynote->deleterequest($request->input('data'));
                if ($list) {
                    $return['status'] = 'success';
                    $return['message'] = 'Your note deleted successfully.';
                    $return['redirect'] = route('my-note');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
        }
    }
}
