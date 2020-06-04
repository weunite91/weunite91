<?php

namespace App\Http\Controllers\backend\cso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CsoController extends Controller
{
    //
    function __construct() {

    }

    public function dashborad(Request  $request){
        $data['title'] = 'Weunite91 | CSO - Dashborad';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('csodashborad.js', 'jquery.form.min.js');
        $data['funinit'] = array('Csodashborad.init()');
        return view('backend.pages.csomanagement.dashborad.dashborad',$data);
    }

}
