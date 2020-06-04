<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users;
use App\Model\Fundraisercompanydetail;
use App\Model\Fund_payment_details;
use App\Model\Investor;
class Deleterequest extends Model
{
     protected $table = 'users';
    function __construct() {
        
    }
    
    public function getdeletelist(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'email',
            4 => 'number',
        );

        $query = Users::from('users')
                    ->where('roles','!=','A')
                    ->where('roles','!=','S')
                    ->where('delete_profile','1')
                    ->orderBy('created_at','DESC');
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
                        ->select('id','email','profile_code','firstname','lastname','number','roles','ip')->get();
        $data = array();
        
        $i = 0;
        foreach ($resultArr as $row) {
           $i++;
           if($row["roles"] == "A"){
               $usertype = '<span class="label label-sm label-success">Admin</span>';
           }
           
           if($row["roles"] == "I"){
                $usertype = '<span class="label label-sm label-success">Investor</span>';
           }
           
           if($row["roles"] == "FR"){
                $usertype = '<span class="label label-sm label-success">Fund Raaiser</span>';
           }
           
           if($row["roles"] == "F"){
                $usertype = '<span class="label label-sm label-success">Franchise</span>';
           }
           
           if($row["roles"] == "P"){
                $usertype = '<span class="label label-sm label-success">Partner</span>';
           }
           
           $actionhtml = '';
           $actionhtml  ='<button class="btn btn-primary btn-xs apporverrequest" data-toggle="modal" data-target="#apporverrequest" data-id="' . $row['id'] . '" data-usertype="' . $row['roles'] . '">
                            <i class="fa fa-check"></i>
                         </button>
                         <button class="btn btn-danger btn-xs declienrequest" data-toggle="modal" data-target="#declienrequest" data-id="' . $row['id'] . '">
                             <i class="fa fa-close"></i>
                         </button>';
            $nestedData = array();
            $nestedData[] =$i;            
            $nestedData[] =$usertype;            
            $nestedData[] = $row["profile_code"];
            $nestedData[] = $row["firstname"];
            $nestedData[] = $row["lastname"];
            $nestedData[] = $row["email"];
            $nestedData[] = $row["number"];
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
    
    public function apporverrequest($data){
        if($data['usertype']=='FR'){
            $deleterecord = Fundraisercompanydetail::where('user_id', $data['id'])->delete();
            $deleterecord = Fund_payment_details::where('user_id', $data['id'])->delete();
        }elseif($data['usertype']=='I'){
            $deleterecord = Investor::where('user_id', $data['id'])->delete();
        }
        
        
        $objuserUpdate = Users::find($data['id']);
        $objuserUpdate->delete_profile ="2";
        return $objuserUpdate->save();
    }
    public function declienrequest($data){
        $objuserUpdate = Users::find($data['id']);
        $objuserUpdate->delete_profile ="0";
        return $objuserUpdate->save();
    }
}
