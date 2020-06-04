<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users;
class Investor_proposal extends Model
{
    protected $table = 'investor_proposal';

    function __construct() {

    }

    public function addproposal($request){
        $checkprofilecode = Users::where('profile_code',$request->input('profilecode'))
                                ->count();
        if($checkprofilecode == 0){
            return "nomatch";
        }else{
            $objInvestorpropasal = new Investor_proposal();
            $objInvestorpropasal->investordetailsid = $request->input('investordetailsid');
            $objInvestorpropasal->sender_firstname= $request->input('firstname');
            $objInvestorpropasal->sender_profile_code = $request->input('profilecode');
            $objInvestorpropasal->reciever_profile_code = $request->input('reciver_profile_code');
            //$objInvestorpropasal->subject = $request->input('subject');
            $objInvestorpropasal->subject ='';
            $objInvestorpropasal->message = $request->input('about');
            $objInvestorpropasal->appove = "pending";
            $result = $objInvestorpropasal->save();
            if($result){
                 return "done";
            }else{
                return "wrong";
            }
        }

    }


    public function getproposallist(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name

            0 => 'ip.firstname',
            1 => 'ip.sender_profile_code',
            2 => 'ip.subject',
            3 => 'ip.message',
            4 => 'ip.appove',
        );

        $query = Investor_proposal::from('investor_proposal as ip')
                                ->leftjoin("users as u1","u1.id","=","ip.investordetailsid")
                                ->orderBy('ip.created_at','DESC');
        if (!empty($requestData['search']['value'])) {
            // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }
        else{
            $query->where('ip.appove', '!=', 'Rejected');
        }
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select("ip.sender_firstname","ip.id as realid",
                                    "ip.sender_profile_code","ip.subject","ip.message",
                                    "ip.appove","u1.firstname as rfirstname",
                                    "ip.reciever_profile_code as rprofilecode")->get();
        $data = array();


        foreach ($resultArr as $row) {

            $checkbox='<input class="checkID" type="checkbox" data-id="' . $row["realid"] . '" >';
            if ($row["appove"] == 'approve') {
                $approve = '<select class="approve mdl-textfield__input" data-id="' . $row["realid"] . '"> <option class="mdl-menu__item"  value="approve" selected>Approve</option><option class="mdl-menu__item" value="pending">Pending</option><option class="mdl-menu__item"  value="rejected">Rejected</option></select>';
            } else {
                if ($row["appove"] == 'pending') {
                    $approve = '<select class="approve mdl-textfield__input" data-id="' . $row["realid"] . '"> <option class="mdl-menu__item"  value="approve" >Approve</option><option class="mdl-menu__item"  value="pending" selected>Pending</option><option class="mdl-menu__item"  value="rejected">Rejected</option></select>';
                } else {
                    $approve = '<select class="approve mdl-textfield__input" data-id="' . $row["realid"] . '"> <option class="mdl-menu__item"  value="approve" >Approve</option><option class="mdl-menu__item"  value="pending">Pending</option><option value="rejected" class="mdl-menu__item"  selected>Rejected</option></select>';
                }
            }

           $actionhtml  ='<a href="' . route("view-proposal",$row["realid"]) . '" >
                        <button class="btn btn-primary btn-xs deletestaff">
                             <i class="fa fa-eye"></i>
                         </button>
                         <a href="' . route("edit-proposal",$row["realid"]) . '" >
                            <button class="btn btn-success btn-xs">
                                <i class="fa fa-pencil"></i>
                            </button>
                         </a>
                         <button class="btn btn-danger btn-xs deletestaff" id='.$row['realid'].'" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['realid'] . '">
                             <i class="fa fa-trash-o"></i>
                         </button>';
            $nestedData = array();

            $nestedData[] = $checkbox;
            $nestedData[] = $row["sender_firstname"];
            $nestedData[] = $row["sender_profile_code"];
            $nestedData[] = $row["rfirstname"];
            $nestedData[] = $row["rprofilecode"];
            $nestedData[] = $row["subject"];
            $nestedData[] = $approve;
            $nestedData[] = $actionhtml;
            $data[] = $nestedData;
        }
        //echo "<pre>";print_r($data);exit;

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
          return $json_data;
    }

    public function approvechange($request,$id){
        $objInvestorProposal = Investor_proposal::find($request->input('id'));
        $objInvestorProposal->appove = $request->input('val');
        $objInvestorProposal->appoveby = $id;
        $objInvestorProposal->updated_at = date("Y-m-d h:i:s");
        $result = $objInvestorProposal->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function allproposalaction($request,$id){
        $ids=$request->input('id');
        $ids=substr($ids, 0, -1);
        $arrIds=explode(',',$ids);
        $status=$request->input('val');
        foreach($arrIds as $id)
        {
            $objInvestorProposal = Investor_proposal::find($id);
            $objInvestorProposal->appove = $status;
            $objInvestorProposal->appoveby = $id;
            $objInvestorProposal->updated_at = date("Y-m-d h:i:s");
            $result = $objInvestorProposal->save();
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function details($id){
        $result = Investor_proposal::select('investor_proposal.reciever_profile_code as rec_profile_code',
                                        'users.firstname as rev_firstname',
                                        'users.lastname as rev_lastname',
                                        'investor_proposal.sender_firstname',
                                        'investor_proposal.sender_profile_code',
                                        'investor_proposal.subject',
                                        'investor_proposal.message',
                                        'investor_proposal.appove')

                            ->leftjoin('users','users.id','=','investor_proposal.investordetailsid')
                            ->where('investor_proposal.id',$id)
                            ->get();

        return $result;
    }

    public function editePropsalDetails($request,$id){
        $objuserUpdate = Investor_proposal::find($id);
       // $objuserUpdate->firstname = $request->input('firstname');
        $objuserUpdate->subject = $request->input('subject');
        $objuserUpdate->message = $request->input('message');
        if ($objuserUpdate->save()) {
            return "done";
        }else{
            return "notdone";
        }
    }
    public function reply_proposal($request,$investordetailsid,$session)
    {

        $objInvestorpropasal = new Investor_proposal();
        $objInvestorpropasal->investordetailsid =$investordetailsid;
        $objInvestorpropasal->sender_firstname= $session['logindata'][0]['firstname'];
        $objInvestorpropasal->sender_profile_code =$session['logindata'][0]['profile_code'];
        $objInvestorpropasal->reciever_profile_code = $request->input('profile_code');
        $objInvestorpropasal->subject ='';

        $objInvestorpropasal->message = $request->input('txtmessage');
        $objInvestorpropasal->appove = "pending";
        $result = $objInvestorpropasal->save();

    }


    public function changemail(){
        $investorList = Users::where("roles","I")
                        ->where("change_email","0")
                        ->select("id","firstname")
                        ->get();
        foreach($investorList as $key => $value){
            $res = $this->generate_weunite_email($value->firstname,$value->id);
            if($res){

            }else{

            }
        }
        
        print_r("success");
        die();
    }

    function generate_weunite_email($firstname,$id) {
        $ip = '107.180.44.223'; // Need to Change.
        $account = "cz6e2b23ikew"; // Need to Change.
        $domain = "weunite91.com"; // Need to Change.
        $account_pass = "Nagesh@1234"; // Need to Change.
        $xmlapi = new \App\Services\CpanelXMLAPI($ip);
        $xmlapi->password_auth($account, $account_pass);
        $xmlapi->set_output('json');
        $xmlapi->set_port('2083'); // Need to Change.
        $xmlapi->set_debug(1);


        $temp_firstname = str_replace(' ','', $firstname);
        $firstname = preg_replace('/[^A-Za-z0-9\-]/','', $temp_firstname); 
        
        $new_email = strtolower($firstname). rand(1000, 9999) . "@weunite91.com";
        $new_pwd = "Weunite91@".strtolower($firstname);



        $results = json_decode($xmlapi->api2_query($account, "Email", "addpop",
                        array('domain' => $domain, 'email' => $new_email,
                            'password' => $new_pwd, 'quota' => '200')), true);

        if ($results['cpanelresult']['data'][0]['result']) {
            $objUser = Users::find($id);
            $objUser->weunite_email = $new_email;
            $objUser->change_email = "1";

            if($objUser->save()){

            }else{
                print_r($id);
                die();
            }
        } else {
            echo "Error creating email account:\n" . $results['cpanelresult']['data'][0]['reason'];
            die();
        }

    }
}
