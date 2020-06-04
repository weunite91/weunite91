<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Csocseallocation extends Model
{
    //


    protected $table = "users";

    public function cseList(){

        $userDetails = Session()->all();
        $loginId  = $userDetails['logindata'][0]['id'] ;


        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.profile_code',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.email',
            4 => 'u1.number',
            5 => 'u1.allocation_cse_datetime',
            6 => 'u1.created_at',
        );

        $query = Users::from('users as u1')
                    ->where("u1.is_deleted","0")
                    ->where("u1.is_cold","0")
                    ->where("u1.allocation_cse_id", $loginId);

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
                        ->select('u1.id','u1.allocation_cse_datetime','u1.email','u1.profile_code','u1.allocation_id','u1.firstname','u1.lastname','u1.number','u1.roles')
                        ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
           $i++;
           $actionhtml  ='<a href="' . route("view-cso-cse",$row["id"]) . '" >
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
            if($row["allocation_cse_datetime"] != null){
                $nestedData[] = date("d-m-Y h:i:s",strtotime($row["allocation_cse_datetime"]));
            }else{
                $nestedData[] = "Not Define";
            }
            
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

    public function getcseviewdatatable($cseId){
        if (!empty(Auth()->guard('cso')->user())) {
            $user_data = Auth()->guard('cso')->user();
        }
        if($user_data['asign_role']){
            $role = json_decode($user_data['asign_role']) ;
        }else{
            $role = [];
        }

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
                    ->where("is_deleted","0")
                    ->where("is_cold","0")
                    ->where("allocation_id", $cseId);

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
                        ->select('wip', 'id', 'user_note','profile_code', 'firstname', 'lastname', 'number', 'user_type', 'roles', 'ip', 'verify_status', 'user_type', 'created_at', 'staff_verify_status', 'admin_verify_status')
                        ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type_staff mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type_staff mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }
             if(in_array("sv", $role)){
                if ($row["staff_verify_status"] == '0') {
                    $admin_verify_status = '<select class="staff_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    if ($row["staff_verify_status"] == '1') {
                        $admin_verify_status = '<select class="staff_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                    } else {
                        $admin_verify_status = '<select class="staff_verify_status  mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                    }
                }
            }

            if ($row["admin_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-check"></i></button></centr>';
            } else {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-times"></i> Add </button></centr>';
            }

            $i++;
                $actionhtml = '';

            if(in_array("view", $role)){
                $actionhtml =  $actionhtml.'<a href="' . route('user-cse-details-cso', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;';
            }

            if(in_array("edit", $role)){
                    $actionhtml =  $actionhtml .'<a href="' . route('edit-user-details-cse', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;';
            }
            if(in_array("addNote", $role)){
                 $actionhtml =  $actionhtml. '<a href="' . route('add-note-cse', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;';
            }

            if(in_array("status", $role)){
                $actionhtml =$actionhtml.'<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            }
            $actionhtml = $actionhtml.'<a href="' . route('comments-details-cse', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;';

            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
            // $nestedData[] = $type;
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y H:s:i A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            if(in_array("sv", $role)){
                $nestedData[] = $admin_verify_status;
            }
            $nestedData[] = $emailVerfyHtml;
            $nestedData[] = $staff_verify_status;
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
}
