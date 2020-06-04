<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\Users;
use Input;

class DashboardController extends Controller
{
    function __construct()
    {

    }

    public function dashboard1(Request $request)
    {
        if (Auth::check()) {

            $dashboard = 0;
            if (auth()->user()->verify_status == 1) {


            if (auth()->user()->roles == 4) {
                $data['title'] = 'We Unite 91 | Partners';
                $data['css'] = array();
                $data['plugincss'] = array();
                $data['pluginjs'] = array();
                $data['js'] = array("home.js");
                $data['funinit'] = array("Home.homepage()");
                $dashboard = 4;
            } elseif (auth()->user()->roles == 3) {
                $data['title'] = 'We Unite 91 | Franchise';
                $data['css'] = array();
                $data['plugincss'] = array();
                $data['pluginjs'] = array();
                $data['js'] = array("home.js");
                $data['funinit'] = array("Home.homepage()");
                $dashboard = 3;
            } elseif (auth()->user()->roles == 2) {
                $data['title'] = 'We Unite 91 | Investor';
                $data['css'] = array();
                $data['plugincss'] = array();
                $data['pluginjs'] = array();
                $data['js'] = array("home.js");
                $data['funinit'] = array("Home.homepage()");
                $dashboard = 2;
            } elseif (auth()->user()->roles == 1) {
                $data['title'] = 'We Unite 91 | Fund Raiser';
                $data['css'] = array();
                $data['plugincss'] = array();
                $data['pluginjs'] = array();
                $data['js'] = array("home.js");
                $data['funinit'] = array("Home.homepage()");
                $dashboard = 1;
            } else {
                return redirect('login');
            }

            return view('frontend.pages.dashboard.dashboard' . $dashboard, $data);
            }
            else
            {
                Session::flash('success', 'Please Verify Your Account After Login!');
                return view('frontend.pages.login.login');
            }
        }
        return redirect('login');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    // SaveFundraise Data

    public function saveFData(Request $request)
    {
        $data=$request->all();
        $userid=Auth()->user()->id;
        $insert=array();



        if ($request->hasFile('member_picture')) {
            $dest_path = 'public/upload/';
            $files = $request->file('member_picture');
                $destinationPath = 'public/upload/'; // upload path
                $profilefile = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profilefile);
                $data['member_picture']=$profilefile;
        }


        if($request->hasfile('product_picture'))
        {

            foreach($request->file('product_picture') as $file)
            {
                $destinationPath = 'public/upload/';
                $filename=date('YmdHis') .'_'.$file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                array_push($insert,"$filename");

            }
            $data['product_picture']=implode(",",$insert);
        }
        if ($request->hasFile('video')) {
            $dest_path = 'public/upload/';
            $files = $request->file('video');
            $destinationPath = 'public/upload/'; // upload path
            $profilefile = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profilefile);
            $data['video']=$profilefile;
        }

        $data= Users::saveFundraiseData($data,$userid);
        Session::flash('success', 'Data Successfully Added !');
        return back();
    }
}
