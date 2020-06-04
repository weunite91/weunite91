<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Risingfinance;
use App\Model\Industry;
use App\Model\Fundriser_investment_offered;
use DB;

class RaisingfinanceController extends Controller {

    //
    function __construct() {
        
    }

    public function raisingfinance(Request $request) {
        $current_page = 0;
        $start_page = 0;
        $page_size = 9;
        $total_records = 0;
        get_current_page_no($request, $page_size, $current_page, $start_page);

        if ($request->isMethod('post')) {
            $pitchObj = new Risingfinance();
            $data['pitches'] = $pitchObj->getPitchesSerch($request, $start_page, $page_size, $total_records);
            $data['fillterdata'] = $request->input();
        } else {
            $pitchObj = new Risingfinance();
            $data['pitches'] = $pitchObj->getPitches($start_page, $page_size, $total_records);
            $data['fillterdata'] = [
                "cities" => [],
                "industry" => [],
                "max_investment" => '',
                "min_investment" => '',
                "profile_code" => ''
            ];
        }

        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();

        $objCityFilter = new Risingfinance();
        $data['citylist'] = $objCityFilter->getCityFromUser();



        for ($i = 0; $i < count($data['pitches']); $i++) {
            $id = $data['pitches'][$i]->userid;

            $objfro = new Fundriser_investment_offered();
            $data['pitches'][$i]->gettotalmount = $objfro->gettotalmount($id);

            $objfro = new Fundriser_investment_offered();
            $data['pitches'][$i]->totalinvestor = $objfro->totalinvestor($id);
        }

        get_total_pages($page_size, $total_records, $data, $current_page);
        $data['title'] = 'We Unite 91 | Raising Finance all pitch deck';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('risingfinance.js', "home.js");
        $data['funinit'] = array("Home.homepage()", "Risingfinance.init()");
        return view('frontend.pages.raisingfinance.raisingfinance', $data);
    }

    public function raisingfinance_active(Request $request) {

        $current_page = 0;
        $start_page = 0;
        $page_size = 9;
        $total_records = 0;
        get_current_page_no($request, $page_size, $current_page, $start_page);
        if ($request->isMethod('post')) {

            $pitchObj = new Risingfinance();
            $data['getPitchesactive'] = $pitchObj->getPitchesactiveSerach($request, $start_page, $page_size, $total_records);
            $data['fillterdata'] = $request->input();
        } else {
            $data['fillterdata'] = [
                "cities" => [],
                "industry" => [],
                "max_investment" => '',
                "min_investment" => '',
                "profile_code" => ''
            ];
            $pitchObj = new Risingfinance();
            $data['getPitchesactive'] = $pitchObj->getPitchesactive($start_page, $page_size, $total_records);
        }
        $objIndustry = new Industry();
        $data['industrylist'] = $objIndustry->industrylist();

        $objCityFilter = new Risingfinance();
        $data['citylist'] = $objCityFilter->getCityFromUser();

        for ($i = 0; $i < count($data['getPitchesactive']); $i++) {
            $id = $data['getPitchesactive'][$i]->userid;

            $objfro = new Fundriser_investment_offered();
            $data['getPitchesactive'][$i]->gettotalmount = $objfro->gettotalmount($id);

            $objfro = new Fundriser_investment_offered();
            $data['getPitchesactive'][$i]->totalinvestor = $objfro->totalinvestor($id);
        }
        get_total_pages($page_size, $total_records, $data, $current_page);
        $data['title'] = 'We Unite 91 | Raising Finance active pitch deck';
        $data['description'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['keywords'] = "We Unite 91 | World's most effectual fund raising dais";
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array();
        $data['js'] = array('risingfinance.js', 'home.js');
        $data['funinit'] = array("Home.homepage()", "Risingfinance.init()");
        return view('frontend.pages.raisingfinance.raisingfinance-active', $data);
    }

}
