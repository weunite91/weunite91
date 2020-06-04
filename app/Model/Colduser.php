<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Colduser extends Model
{
    //

    public function getalldatatable(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u2.firstname',
            5 => 'u1.last_login',
            6 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', '!=', 'A')
                ->where('u1.roles', '!=', 'S')
                ->where('u1.roles', '!=', 'CSO')
                ->where('u1.is_cold', '0')
                ->where('u1.is_deleted', '0');
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
                        ->select('u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',                                
                                'u1.last_login','u1.last_login','u1.is_cold_date',
                                'u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        $objPasscode = new UsersPasscode();
        $all_passcode_result = $objPasscode->get_all_users_passcode();
        foreach ($resultArr as $row) {
            $checkbox = '<input type="checkbox" class="usercheckbox" value="'. $row["id"].'" name="usercheckbox" id="usercheckbox">';

            $nestedData = array();
            $nestedData[] = $checkbox;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
            $nestedData[] = $row["profile_code"];
            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["email"];
            
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            
            if($row['last_login']){
                $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["last_login"]));
            }else{
                $nestedData[] = "Not Define";
            }

            if($row['is_cold_date']){
                $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["is_cold_date"]));
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
    public function getcolddatatable(){
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u2.firstname',
            5 => 'u1.last_login',
            6 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', '!=', 'A')
                ->where('u1.roles', '!=', 'S')
                ->where('u1.roles', '!=', 'CSO')
                ->where('u1.is_cold', '1')
                ->where('u1.is_deleted', '0');
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
                        ->select('u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',                                
                                'u1.last_login','u1.last_login','u1.is_cold_date',
                                'u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        $objPasscode = new UsersPasscode();
        $all_passcode_result = $objPasscode->get_all_users_passcode();
        foreach ($resultArr as $row) {
            $checkbox = '<input type="checkbox" class="usercheckbox" value="'. $row["id"].'" name="usercheckbox" id="usercheckbox">';

            $nestedData = array();
            $nestedData[] = $checkbox;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
            $nestedData[] = $row["profile_code"];
            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["email"];
            
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            
            if($row['last_login']){
                $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["last_login"]));
            }else{
                $nestedData[] = "Not Define";
            }

            if($row['is_cold_date']){
                $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["is_cold_date"]));
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


    public function movecold($request,$id){
        $ids = json_decode($request->input('idarray'));

        foreach($ids as $key => $value){
            $objuserUpdate = Users::find($value);
            $objuserUpdate->is_cold = "1";
            $objuserUpdate->is_cold_by = $id;
            $objuserUpdate->is_cold_date = date("Y-m-d h:i:s");
            $result = $objuserUpdate->save();
        }

        return true ;
    }
    public function removecold($request,$id){
        $ids = json_decode($request->input('idarray'));

        foreach($ids as $key => $value){
            $objuserUpdate = Users::find($value);
            $objuserUpdate->is_cold = "0";
            $objuserUpdate->is_cold_by = NULL;
            $objuserUpdate->is_cold_date = date("Y-m-d h:i:s");
            $result = $objuserUpdate->save();
        }

        return true ;
    }
}
