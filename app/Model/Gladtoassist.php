<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\SendMail;
use DB;
class Gladtoassist extends Model {

    protected $table = 'gladtoassist';

    public function sendMailGlade($request) {

        $objGladtoassist = new Gladtoassist();
        $objGladtoassist->name = $request->input('glad_fullname');
        $objGladtoassist->mobile = $request->input('glad_mobilenumber');
        $objGladtoassist->email = $request->input('glad_supportemail');
        $objGladtoassist->feedback = $request->input('glad_querymsg');
        $objGladtoassist->created_at = date("Y-m-d h:i:s");
        $objGladtoassist->updated_at = date("Y-m-d h:i:s");
        $insertresult = $objGladtoassist->save();

        $mailData['data'] = '';
        $mailData['subject'] = 'Glad to Assist';
        $mailData['attachment'] = array();
        $mailData['template'] = "emails.gladetoassist";
        $mailData['mailto'] = '91weunite@gmail.com';
        $mailData['data'] = ['fullname' => $request->input('glad_fullname'),'mobilenumber' => $request->input('glad_mobilenumber'),'supportemail' => $request->input('glad_supportemail'), 'querymsg' => $request->input('glad_querymsg')];
        $sendMail = new Sendmail;
        $sendMail->sendSMTPMail($mailData);

        if($insertresult){
            return "added";
        }else{
            return "wrong";
        }
    }

    public function getdatatable(){
       $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'name',
            2 => 'mobile',
            3 => 'email',
            4 => 'feedback',
            5 => 'created_at',
        );

        $query = Gladtoassist::from('gladtoassist')->orderBy('created_at','DESC');


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
        // print_r($requestData);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('id','name','mobile','email','feedback','created_at')->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
           $i++;
           $actionhtml  ='<center><button class="btn btn-danger btn-xs deleterequest" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '">
                             <i class="fa fa-trash-o"></i>
                         </button></center>';
            $nestedData = array();
            $nestedData[] ='<center>'.$i.'</center>';
            $nestedData[] = '<center>'.$row["name"].'</center>';
            $nestedData[] = '<center>'.$row["mobile"].'</center>';
            $nestedData[] = '<center>'.$row["email"].'</center>';
            $nestedData[] = '<center>'.$row["feedback"].'</center>';
            $nestedData[] = '<center>'. date("d-m-Y h:i:s",strtotime($row["created_at"])) .'</center>';
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

    public function deleterequest($data){
        $result = DB::table('gladtoassist')->delete($data['id']);
        return $result;
    }

}
