<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\SendMail;
class KPISupportModel extends Model {

    protected $table = 'kpi_support';
    protected $primaryKey = 'kpi_support_id';

    public function save_kpi_support($user_id, $message) {

        $session = session()->all();
        $email = $session['logindata'][0]['email'];
        $name = $session['logindata'][0]['firstname'] . " " . $session['logindata'][0]['lastname'];
        $profile_code = $session['logindata'][0]['profile_code'];
        $number = $session['logindata'][0]['number'];
        $objKPISupportModel = new KPISupportModel();

        $objKPISupportModel->user_id = $user_id;
        $objKPISupportModel->query = $message;

        if ($objKPISupportModel->save()) {

            $session = session()->all();
            $mailData['data'] = '';
            $mailData['subject'] = 'Request for KPI support';
            $mailData['attachment'] = array();
            $mailData['template'] = "emails.supportemail";
            $mailData['mailto'] = 'info@weunite91.com';
            $mailData['data'] = ['email' => $email,
                                 'msg' => $message ,
                                 'name'=>$name ,
                                 'profileCode'=>$profile_code ,
                                 'number'=>$number
                                ];

            $sendMail = new Sendmail;
            $sendMail->sendSMTPMail($mailData);            
            return true;
        } else {
            return false;
        }
    }

    public function GetAllKPISupportRequest() {


        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'users.firstname',
            1 => 'users.email',
            2 => 'users.profile_code',
            3 => 'kpi_support.query',
            4 => 'kpi_support.created_at'
        );

        $query = SupportModel::from('kpi_support')
                            ->join("users", "users.id", "=", "kpi_support.user_id");
        ;
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
                        ->select('kpi_support.*',
                                'users.firstname', 'users.profile_code', 'users.email')->get();
        $data = array();
//         echo "<pre>";print_r($resultArr);exit;
        $i = 0;

        foreach ($resultArr as $row) {

            $i++;
            $actionhtml = '<center>
            <button class="btn btn-danger btn-xs deleterequest"
            data-toggle="modal" data-target="#deleteModel" data-id="' . $row['kpi_support_id'] . '">
                             <i class="fa fa-trash-o"></i>
                         </button></center>';
            $nestedData = array();
            $nestedData[] = '<center>' . $i . '</center>';

            $nestedData[] = '<center>' . $row["firstname"] . '</center>';

            $nestedData[] = '<center>' . $row["email"] . '</center>';
            $nestedData[] = '<center>' . $row["profile_code"] . '</center>';
            $nestedData[] = '<center>' . $row["query"] . '</center>';
            $nestedData[] = '<center>' . date("d-m-Y h:i:s",strtotime($row["created_at"])). '</center>';
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

    public function deleterequest($data) {
        $result = DB::table('kpi_support')
                ->where('kpi_support.kpi_support_id', "=", $data['id'])
                ->delete();
        return $result;
    }

}
