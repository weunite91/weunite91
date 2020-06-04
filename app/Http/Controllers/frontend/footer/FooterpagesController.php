<?php

namespace App\Http\Controllers\frontend\footer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;
use App\Model\SendMail;

class FooterpagesController extends Controller
{
    //
    function __construct() {
        
    }
    
    public function terms(Request $request){
        
        $data['title'] = 'We Unite 91s | Terms of use';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.footer.terms', $data);
    }
    
    public function privacy(Request $request){
        
        $data['title'] = 'We Unite 91s | Privacy Policy';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.footer.privacy', $data);
    }
    public function refund(Request $request){
        
        $data['title'] = 'We Unite 91s | Refund Policy';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.footer.refund', $data);
    }
    
    public function aboutus(Request $request){
        
        $data['title'] = 'We Unite 91s | About us';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.footer.aboutus', $data);
    }
    
    public function contactus(Request $request){
        
        $country=new Country();
        $data['countrieslist']=$country->countrylist();
        $data['statusmessage']='';
        if ($request->isMethod('post')) {
            $mailData['data'] = '';
            $mailData['subject'] = 'Contact US';
            $mailData['attachment'] = array();
            $mailData['template'] = "emails.home-contactus-mail";
            $mailData['mailto'] = 'info@weunite91.com';
            $mailData['data'] = [
                                    'name' => $request->input('firstname'),
                                    'email' => $request->input('email'),
                                    'country_code' => $request->input('country_phone_code'),
                                    'phoneno' => $request->input('contact'),
                                    'message' => $request->input('message'),
                                
                                ];
            $sendMail = new Sendmail;
           $status= $sendMail->sendSMTPMail($mailData);
          
            $data['statusmessage']="Your request submitted successfully.Our Representative will get back to you soon.";
           
        }
        $data['title'] = 'We Unite 91s | Contact us';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array("home.js");
        $data['funinit'] = array("Home.homepage()");
        return view('frontend.pages.footer.contactus', $data);
    }
}
