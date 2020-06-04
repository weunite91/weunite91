<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Staff extends Model
{
    protected $table = 'users';
    function __construct() {

    }

    public function getstafflist(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'profile_code',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'email',
            4 => 'number',
        );

        $query = Users::from('users')
                    ->where('roles','S')
                    ->where('is_cold','0')
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
           $actionhtml  ='<a href="' . route("edit-crew",$row["id"]) . '" >
                        <button class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"></i>
                         </button></a>
                         <button class="btn btn-danger btn-xs deletestaff" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '">
                             <i class="fa fa-trash-o"></i>
                         </button>
                         <a href="' . route("view-crew",$row["id"]) . '" >
                         <button class="btn btn-success btn-xs deletestaff">
                             <i class="fa fa-eye"></i>
                         </button></a>';
            $nestedData = array();
            $nestedData[] =$i;
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

    public function getstaffdetails($id){
        $result = Staff::select("id","firstname","lastname","email","number","asign_role")
                    ->where("id",$id)
                    ->get();
        return $result;
    }

    public function deleteStaff($data){
        $result = DB::table('users')->delete($data['id']);
        return $result;
    }

    public function getallocattionList(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'profile_code',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'email',
            4 => 'number',
            5 => 'created_at',
        );

        $query = Users::from('users')
                        ->where('roles','!=','S')
                        ->where('roles','!=','A')
                        ->where('is_cold','0')
                        ->where('allocation_id',null);;
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
            $checkbox = '<input type="checkbox" class="usercheckbox" value="'. $row["id"].'" name="usercheckbox" id="usercheckbox">';
           $i++;

            $nestedData = array();
            $nestedData[] =$checkbox;
            $nestedData[] = $row["profile_code"];
            $nestedData[] = $row["firstname"];
            $nestedData[] = $row["lastname"];
            $nestedData[] = $row["email"];
            $nestedData[] = $row["number"];
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

    public function staffList($id){
        $result = Staff::select("id","firstname","lastname")
                    ->where("roles","S")
                    ->where("id","!=",$id)
                    ->get();
        return $result;
    }
    public function staffListAllocation(){
        $result = Staff::select("id","firstname","lastname")
                    ->where("roles","S")
                    ->get();
        return $result;
    }


    public function allocation($request){
        $ids = json_decode($request->input('idarray'));
        foreach($ids as $key => $value){
            $objuserUpdate = Users::find($value);
            $objuserUpdate->allocation_id = $request->input('selectMember');
            $objuserUpdate->allocation_datetime = date("Y-m-d h:i:s");
            $result = $objuserUpdate->save();
        }

        return true ;
    }



    public function userAllocationList($logged_in_id){

        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'email',
            4 => 'number',
            5 => 'allocation_datetime',
            6 => 'profile_code',
        );

        $query = Users::from('users')
                        ->where('roles','!=','S')
                        ->where('roles','!=','A')
                        ->where('is_cold','0')
                        ->where('allocation_id',$logged_in_id);


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
                        ->select('id','allocation_datetime','email','profile_code','firstname','lastname','number','roles','ip')
                        ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            $checkbox = '<input type="checkbox" class="usercheckbox" value="'. $row["id"].'" name="usercheckbox" id="usercheckbox">';
           $i++;

            $nestedData = array();
            $nestedData[] =$checkbox;
            $nestedData[] = $row["profile_code"];
            $nestedData[] = $row["firstname"];
            $nestedData[] = $row["lastname"];
            $nestedData[] = $row["email"];
            $nestedData[] = $row["number"];
            if($row["allocation_datetime"] != null){
                $nestedData[] = date("d-m-Y h:I:s",strtotime($row["allocation_datetime"]));
            }else{
                $nestedData[] = "Not define";
            }
           
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

    public function removeAllocation($request){
        $ids = json_decode($request->input('idarray'));
        foreach($ids as $key => $value){
            $objuserUpdate = Users::find($value);
            $objuserUpdate->allocation_id = NULL;
            $objuserUpdate->allocation_datetime = NULL;
            $result = $objuserUpdate->save();
        }

        return true ;
    }

    public function changeallocation($request){
        $ids = json_decode($request->input('idarray'));
        foreach($ids as $key => $value){
            $objuserUpdate = Users::find($value);
            $objuserUpdate->allocation_id = $request->input('selectMember');
            $objuserUpdate->allocation_datetime = date("Y-m-d h:i:s");
            $result = $objuserUpdate->save();
        }

        return true ;
    }
}
