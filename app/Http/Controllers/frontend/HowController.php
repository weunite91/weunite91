<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HowController extends Controller
{
    function __construct() {
        
    }
    
    public function invest(Request $request){
        $data['title'] = 'We Unite 91 | How to invest';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.howto.invest',$data);
    }
    
    
    public function sellyourbussiness(Request $request){
        $data['title'] = 'We Unite 91 | How to sell your bussiness';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.howto.sellyourbussiness',$data);
    }
    
    
    public function franchise(Request $request){
        $data['title'] = 'We Unite 91 | Franchise Your Business';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.howto.franchise',$data);
    }
    
    
    public function partner(Request $request){
        $data['title'] = 'We Unite 91 | Partner With Us';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.howto.partner',$data);
    }
}
