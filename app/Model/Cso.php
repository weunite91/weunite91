<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
class Cso extends Model
{
    //

    protected $table = 'users';

    public function addCso($request){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $usercheck = Users::where('email', $request->input("email"))
                ->count();

        if ($usercheck == 0) {
            $objUsers = new Users();
            $objUsers->firstname = $request->input('firstname');
            $objUsers->lastname = $request->input('lastname');
            $objUsers->email = $request->input('email');
            $objUsers->password = Hash::make($request->input('password'));
            if ($request->input('phonenumber') != null) {
                $objUsers->number = $request->input('phonenumber');
            }
            $objUsers->roles = "CSO";
            $objUsers->verify_status = '1';
            $objUsers->staff_verify_status = '2';
            $objUsers->admin_verify_status = '2';
            $objUsers->ip = $ip;
            $objUsers->user_type = 'R';

            if($request->input('role')){
                $objUsers->asign_role = json_encode($request->input("role"));
            }else{
                $objUsers->asign_role = null;
            }

            $objUsers->is_deleted = '0';
            $objUsers->created_at = date("Y-m-d h:i:s");
            $objUsers->updated_at = date("Y-m-d h:i:s");
            $result = $objUsers->save();
            if ($result) {

                $profile_code = "UN-CSO-19000" . $objUsers->id;
                $objPFUsers = Users::find($objUsers->id);
                $objPFUsers->profile_code = $profile_code;
                $objPFUsers->updated_at = date('Y-m-d H:i:s');
                if ($objPFUsers->save()) {
                    return 'added';
                } else {
                    return 'wrong';
                }
            } else {
                return 'wrong';
            }
        } else {
            return 'exits';
        }

    }

    public function getcsolist(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'profile_code',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'email',
            4 => 'number',
            5 =>'created_at',
        );

        $query = Users::from('users')
                    ->where("is_deleted","0")
                    ->where("is_cold","0")
                    ->where('roles','CSO');

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
           $actionhtml  ='<a href="' . route("edit-cso",$row["id"]) . '" >
                        <button class="btn btn-primary btn-xs">
                            <i class="fa fa-pencil"></i>
                         </button></a>
                         <button class="btn btn-danger btn-xs deletecso" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '">
                             <i class="fa fa-trash-o"></i>
                         </button>
                         <a href="' . route("view-cso",$row["id"]) . '" >
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

    public function getcsodetails($id){
        $result = Staff::select("id","firstname","lastname","email","number","asign_role")
                    ->where("id",$id)
                    ->get();
        return $result;
    }

    public function editCso($request){
        $usercheck = Users::where('email', $request->input("email"))
                ->where('id', "!=", $request->input("editid"))
                ->count();
        if ($usercheck == 0) {
            $objuserUpdate = Users::find($request->input("editid"));
            $objuserUpdate->firstname = $request->input('firstname');
            $objuserUpdate->lastname = $request->input('lastname');
            $objuserUpdate->email = $request->input('email');
            if($request->input('role')){
                $objuserUpdate->asign_role = json_encode($request->input('role'));
            }else{
                $objuserUpdate->asign_role = null;
            }

            if ($request->input('password') != null) {
                $objuserUpdate->password = Hash::make($request->input('password'));
            }

            $objuserUpdate->staff_verify_status = "2";
            $objuserUpdate->admin_verify_status = "2";

            if ($objuserUpdate->save()) {
                return "added";
            } else {
                return 'wrong';
            }
        } else {
            return 'exits';
        }
    }


    public function deletecso($data){
        $result = DB::table('users')->delete($data['id']);
        return $result;
    }

    public function CsoList($id){
        $result = Staff::select("id","firstname","lastname")
                    ->where("roles","CSO")
                    ->where("id","!=",$id)
                    ->get();
        return $result;
    }

    public function csoListAllocation(){
        $result = Staff::select("id","firstname","lastname")
                    ->where("roles","CSO")
                    ->get();
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
                        ->where('roles','S')
                        ->where('is_deleted','0')
                        ->where('is_cold','0')                        
                        ->where('allocation_cse_id',null);;
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

    public function allocation($request){
        $ids = json_decode($request->input('idarray'));
        foreach($ids as $key => $value){
            $objuserUpdate = Users::find($value);
            $objuserUpdate->allocation_cse_id = $request->input('selectMember');
            $objuserUpdate->allocation_cse_datetime = date("Y-m-d h:i:s");
            $result = $objuserUpdate->save();
        }

        return true ;
    }


    public function getcseallocattiondatatable($logged_in_id){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'email',
            4 => 'number',
            5 => 'profile_code',
            5 => 'allocation_cse_datetime',
        );

        $query = Users::from('users')
                        ->where('roles','S')
                        ->where("is_deleted","0")
                        ->where("is_cold","0")
                        ->where('allocation_cse_id',$logged_in_id);


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
                        ->select('id','email','profile_code','firstname','lastname','number','roles','ip',"allocation_cse_datetime")
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
            if($row["allocation_cse_datetime"] != null){
                $nestedData[] = date("d-m-Y h:i:s",strtotime($row["allocation_cse_datetime"]));
            }else{
                $nestedData[] = "Not Define";
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


    public function changeallocation($request){
        $ids = json_decode($request->input('idarray'));
        foreach($ids as $key => $value){
            $objuserUpdate = Users::find($value);
            $objuserUpdate->allocation_cse_id = $request->input('selectMember');
            $objuserUpdate->allocation_cse_datetime = date("Y-m-d h:i:s");
            $result = $objuserUpdate->save();
        }

        return true ;
    }

    public function removeAllocation($request){
        $ids = json_decode($request->input('idarray'));
        foreach($ids as $key => $value){
            $objuserUpdate = Users::find($value);
            $objuserUpdate->allocation_cse_id = NULL;
            $objuserUpdate->allocation_cse_datetime = null;
            $result = $objuserUpdate->save();
        }
        return true ;
    }

}
