<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Mail;
use App\Model\Support_qurey_type;
use App\Model\SendMail;

class SupportModel extends Model {

    protected $table = 'support';

    public function sendMailGlade($postData) {
        $qureytypearray = [
            '1' => 'Prepare your financial & financial offering',
            '2' => 'Consulting a legal aspect of the deal',
            '3' => 'Prepare your pitch deck',
            '4' => 'Prepare your videos & photos for your pitch deck',
        ];
        $str = "";

        $SendGlade = new SupportModel();
        $SendGlade->firstname = $postData['fullname'];
        $SendGlade->number = $postData['mobilenumber'];
        $SendGlade->email = $postData['supportemail'];
        $SendGlade->query = $postData['querymsg'];
        $SendGlade->created_at = date("Y-m-d h:i:s");
        $SendGlade->updated_at = date("Y-m-d h:i:s");
        $insertresult = $SendGlade->save();
        $lastid = $SendGlade->id;
        if ($insertresult) {
            for ($i = 0; $i < count($postData['qureytype']); $i++) {
                $temp = '';
                $temp = $qureytypearray[$postData['qureytype'][$i]];
                if ($i == 0) {
                    $str = $temp;
                } else {
                    $str = $str . "," . $temp;
                }

                $objSupportQureyType = new Support_qurey_type();
                $objSupportQureyType->support_id = $lastid;
                $objSupportQureyType->qurey_type = $postData['qureytype'][$i];
                $objSupportQureyType->created_at = date("Y-m-d h:i:s");
                $objSupportQureyType->updated_at = date("Y-m-d h:i:s");
                $objSupportQureyType->save();
            }

            $mailData['data'] = '';
            $mailData['subject'] = 'Support - Get an Professional Advice';
            $mailData['attachment'] = array();
            $mailData['template'] = "emails.supportinghand";
            $mailData['mailto'] = '91weunite@gmail.com';
            $mailData['data'] = ['qureytype' => $str, 'fullname' => $postData['fullname'], 'mobilenumber' => $postData['mobilenumber'], 'supportemail' => $postData['supportemail'], 'querymsg' => $postData['querymsg']];
            $sendMail = new Sendmail;
            $sendMail->sendSMTPMail($mailData);

            if ($insertresult) {
                return "added";
            } else {
                return "wrong";
            }
        }
    }

    public function GetAllSupportRequest() {
        $qureytypearray = [
            '1' => 'Prepare your financial & financial offering',
            '2' => 'Consulting a legal aspect of the deal',
            '3' => 'Prepare your pitch deck',
            '4' => 'Prepare your videos & photos for your pitch deck',
        ];

        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'support.firstname',
            1 => 'support.email',
            2 => 'support.number',
            3 => 'support_qurey_type.query',
            4 => 'support.created_at'
        );

        $query = SupportModel::from('support')
                        ->join("support_qurey_type","support_qurey_type.support_id","=","support.id")
                        ->groupBy('support_qurey_type.support_id');
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

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('support.*',DB::raw('group_concat(DISTINCT(support_qurey_type.qurey_type)) as qurey_type'))
                        ->get();
        $data = array();
        // echo "<pre>";print_r($resultArr);exit;
        $no = 0;
            foreach ($resultArr as $row) {
            $str = '';
            $type = [];
            $type = explode(",",$row["qurey_type"]);
            
            for ($i = 0; $i < count($type); $i++) {
                $temp = '';
                $temp = $qureytypearray[$type[$i]];
                if ($i == 0) {
                    $str = $temp;
                } else {
                    $str = $str . " ,<br>" . $temp;
                }
            }
            
            
            $no++;
            $actionhtml  ='<center><button class="btn btn-danger btn-xs deleterequest" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '">
                             <i class="fa fa-trash-o"></i>
                         </button></center>';
            $nestedData = array();
            $nestedData[] = '<center>' . $no . '</center>';
            $nestedData[] = '<center>' . $str . '</center>';
            $nestedData[] = '<center>' . $row["firstname"] . '</center>';
            $nestedData[] = '<center>' . $row["number"] . '</center>';
            $nestedData[] = '<center>' . $row["email"] . '</center>';
            $nestedData[] = '<center>' . $row["query"] . '</center>';
            $nestedData[] = '<center>' . date("d-m-Y h:i:s",strtotime($row["created_at"])) . '</center>';
            $nestedData[] = $actionhtml;
            $data[] = $nestedData;
        }
        
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }
    
    public function deleterequest($data){
        $result = DB::table('support')->delete($data['id']);
        if($result){
            $res = DB::table('support_qurey_type')->where('support_id', $data['id'])->delete();
            return $res;
        }
    }
}
