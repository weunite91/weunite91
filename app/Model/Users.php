<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Mail;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\Fundraiserdetails;
use App\Model\SendMail;
use App\Model\Investor;
use App\Model\Forgotpassword;
use App\Model\Fundriser_investment_offered;
use App\Model\Investor_revoke_offers;
use App\Model\Fund_raiser_image;
use App\Model\Fundraisercompanydetail;
use App\Model\UserAdminHistory;
use App\Model\UsersPasscode;
use App\Model\FranchiseDeatils;
use App\Model\VerificationDetails;
use Illuminate\Contracts\Session\Session;

class Users extends Model {

    //
    protected $table = 'users';

    function __construct() {

    }

    public function addLastlogin($id){
        $objUSer = Users::find($id);
        $objUSer->last_login = date("Y-m-d h:i:s");
        $objUSer->save();
    }
    public function createadmin() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $res = Users::select("id")->latest('id')->first();
        $lastId = $res->id;
        $profileCode = "UN-A-19000" . $lastId++;
        $objUser = new Users();
        $objUser->profile_code = $profileCode;
        $objUser->firstname = "Admin";
        $objUser->lastname = "Admin";
        $objUser->email = "admin123@gmail.com";
        $objUser->password = Hash::make("123");
        $objUser->number = "1234567890";
        $objUser->roles = "A";
        $objUser->verify_status = "1";
        $objUser->staff_verify_status = "1";
        $objUser->admin_verify_status = "1";
        $objUser->wip = "Yes";
        $objUser->ip = $ip;
        $objUser->active_date = date("Y-m-d h:i:s");
        $objUser->created_at = date("Y-m-d h:i:s");
        $objUser->updated_at = date("Y-m-d h:i:s");
        return ($objUser->save());
    }

    public function createstaff() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $res = Users::select("id")->latest('id')->first();
        $lastId = $res->id;
        $profileCode = "UN-S-19000" . $lastId++;
        $objUser = new Users();
        $objUser->profile_code = $profileCode;
        $objUser->firstname = "Staff";
        $objUser->lastname = "Staff";
        $objUser->email = "staff123@gmail.com";
        $objUser->password = Hash::make("123");
        $objUser->number = "1234567890";
        $objUser->roles = "S";
        $objUser->verify_status = "1";
        $objUser->staff_verify_status = "1";
        $objUser->admin_verify_status = "1";
        $objUser->wip = "Yes";
        $objUser->ip = $ip;
        $objUser->active_date = date("Y-m-d h:i:s");
        $objUser->created_at = date("Y-m-d h:i:s");
        $objUser->updated_at = date("Y-m-d h:i:s");
        return ($objUser->save());
    }

    public function get_user_det_byemail($email) {
        $result = DB::table('users')
                ->where("users.email", $email)
                ->where('is_deleted', '1')
                ->select("*")
                ->get();

        return $result;
    }

    public function getviewuserdetails($id) {
        $result = DB::table('users')
                ->where("users.id", $id)
                ->where('is_deleted', '0')
                ->select("*")
                ->get();

        return $result;
    }

    public function adminforgot($request) {
        $result = DB::table('users')
                ->where('is_deleted', '0')
                ->where("email", $request->input('email'))
                ->count();
        if ($result == '0') {
            return "noemail";
        } else {
            $roles = DB::table('users')
                    ->where("email", $request->input('email'))
                    ->select("roles")
                    ->get();
            if ($roles[0]->roles == 'A' || $roles[0]->roles == 'S') {
                $token = md5(rand());
                $mailData['data'] = '';
                $mailData['subject'] = 'Reset Password Link';
                $mailData['attachment'] = array();
                $mailData['template'] = "emails.adminforgotpassword";
                $mailData['mailto'] = $request->input('email');
                $mailData['data'] = ['token' => $token];
                $sendMail = new Sendmail;
                $sendMail->sendSMTPMail($mailData);

                $userid = DB::table('users')
                        ->where("email", $request->input('email'))
                        ->select("id")
                        ->get();
                $objforgotpassword = new Forgotpassword();
                $objforgotpassword->user_id = $userid[0]->id;
                $objforgotpassword->token = $token;
                $objforgotpassword->created_at = date("Y-m-d h:i:s");
                $objforgotpassword->updated_at = date("Y-m-d h:i:s");
                $insertresult = $objforgotpassword->save();
                if ($insertresult) {
                    return "done";
                } else {
                    return "wrong";
                }
            } else {
                return "noadminstaff";
            }
        }

//        return $result;
    }

    public function forgotpassword($request) {
        $userid = DB::table('users')
                ->where('is_deleted', '0')
                ->where("email", $request->input('email'))
                ->select('*')
                ->get();

        if (count($userid) == 0) {
            return "noemail";
        } else {
            $token = md5(rand());
            $mailData['data'] = '';
            $mailData['subject'] = 'Reset Password Link';
            $mailData['attachment'] = array();
            $mailData['template'] = "emails.forgotpassword";
            $mailData['mailto'] = $request->input('email');
            $mailData['data'] = ['token' => $token,
                "firstname" => $userid[0]->firstname,
                "lastname" => $userid[0]->lastname];
            $sendMail = new Sendmail;
            $sendMail->sendSMTPMail($mailData);

            $objforgotpassword = new Forgotpassword();
            $objforgotpassword->user_id = $userid[0]->id;
            $objforgotpassword->token = $token;
            $objforgotpassword->created_at = date("Y-m-d h:i:s");
            $objforgotpassword->updated_at = date("Y-m-d h:i:s");
            $insertresult = $objforgotpassword->save();
            if ($insertresult) {
                return "done";
            } else {
                return "wrong";
            }
        }

//        return $result;
    }

    public function editprofilepic($request, $id) {

        if ($request->file()) {
            if ($request->file('file')) {
                $image = $request->file('file');
                $profileimage_new = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/userprofile/');
                $image->move($destinationPath, $profileimage_new);
            }

            $objuserUpdate = Users::find($id);
            $objuserUpdate->user_image = $profileimage_new;
            $objuserUpdate->staff_verify_status = "0";
            $objuserUpdate->admin_verify_status = "0";
            $objuserUpdate->updated_at = date("Y-m-d h:i:s");
            $result = $objuserUpdate->save();
        }


        return true;
    }

    public function adduser($request) {
        $usercheck = Users::where('email', $request->input("email"))
                ->get();
        $objUsers = new Users();
        if (count($usercheck) > 0) {
            if ($usercheck[0]->is_deleted == '1') {
                return 'Inactive';
            }
            if ($usercheck[0]->verify_status == '1') {
                return 'exits';
            } else {
                $objUsers = $usercheck[0];
            }
        }


        $otp = rand(111111, 999999);
//           $otp = '080424';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }


        $objUsers->firstname = $request->input('firstname');
        $objUsers->lastname = $request->input('lastname');
        $objUsers->email = $request->input('email');
        $objUsers->password = Hash::make($request->input('newpassword'));
        $objUsers->temp_password = $request->input('newpassword');
        $objUsers->roles = $request->input('published');
        $objUsers->otp = $otp;
        $objUsers->verify_status = '0';
        $objUsers->staff_verify_status = '0';
        $objUsers->admin_verify_status = '0';
        $objUsers->ip = $ip;
        $objUsers->is_deleted = '0';
        $objUsers->user_type = 'R';
        $objUsers->created_at = date("Y-m-d H:i:s");
        $objUsers->updated_at = date("Y-m-d H:i:s");
        $result = $objUsers->save();
        if ($result) {

            $profile_code = "UN-" . $request->input('published') . "-19000" . $objUsers->id;
            $objPFUsers = Users::find($objUsers->id);
            $objPFUsers->profile_code = $profile_code;
            $objPFUsers->updated_at = date('Y-m-d H:i:s');
            if ($objPFUsers->save()) {

                $mailData['data'] = '';
                $mailData['subject'] = 'Account verification';
                $mailData['attachment'] = array();
                $mailData['template'] = "emails.sendotp";
                $mailData['mailto'] = $request->input('email');
                $mailData['data'] = [
                    'otp' => $otp,
                    "firstname" => $request->input('firstname'),
                    "lastname" => $request->input('lastname'),
                    "email" => $request->input('email')
                ];
                $sendMail = new Sendmail;
                $sendMail->sendSMTPMail($mailData);

                return 'added';
            } else {
                return 'wrong';
            }
        } else {
            return 'wrong';
        }
    }

    public function checkotp($request, $email) {
        $usercheck = Users::where('email', $request->input("email"))
                ->where('otp', $request->input("otp"))
                ->where('is_deleted', '0')
                ->count();
        if ($usercheck == 0) {
            return "wrongotp";
        } else {
            $id = Users::select("id")
                    ->where('email', $request->input("email"))
                    ->where('otp', $request->input("otp"))
                    ->where('is_deleted', '0')
                    ->get();

            $objVERFUsers = Users::find($id[0]->id);
            $objVERFUsers->verify_status = "1";
            $objVERFUsers->updated_at = date('Y-m-d H:i:s');
            if ($objVERFUsers->save()) {
                return 'verified';
            } else {
                return 'wrong';
            }
        }
    }

    private function prepare_wip_column($db_wip_value, $id) {

        $wip_statuses = array(' ', 'Yes');
        $html_wip_column = '<select class="wip_status mdl-textfield__input"
        data-id="' . $id . '"> ';
        foreach ($wip_statuses as $rec) {
            $selected = '';
            if ($rec == $db_wip_value) {
                $selected = 'selected';
            }
            $html_wip_column .= '<option class="mdl-menu__item"
                                value="' . $rec . '" ' . $selected . '>'
                    . $rec . '</option>';
        }


        $html_wip_column .= '</select>';
        return $html_wip_column;
    }

    public function getemailandpassword($email) {
        $usercheck = Users::select('email', 'temp_password')
                ->where('email', $email)
                ->where('is_deleted', '0')
                ->get();
        return $usercheck;
    }

    public function updatetemp($id) {
        $objuserUpdate = Users::find($id);
        $objuserUpdate->temp_password = NULL;
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        $result = $objuserUpdate->save();
    }

    public function getalldatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', '!=', 'A')
                ->where('u1.roles', '!=', 'S')
                ->where('u1.roles', '!=', 'CSO')
                ->where('u1.is_deleted', '0')
                ->where('u1.is_cold', '0');
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        $objPasscode = new UsersPasscode();
        $all_passcode_result = $objPasscode->get_all_users_passcode();
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $passcode_rec = $objPasscode->get_user_pass_code($row, $all_passcode_result);
            $nestedData[] = $passcode_rec['passcode'];
            $nestedData[] = $passcode_rec['passcode_used'];

            $nestedData[] = $customerType;
            $nestedData[] = $this->prepare_wip_column($row["wip"], $row["id"]);
            $nestedData[] = $admin_verify_status;
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

    public function active_getalldatatable() {
        $requestData = $_REQUEST;
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', '!=', 'A')
                ->where('u1.roles', '!=', 'S')
                ->where('u1.roles', '!=', 'CSO')
                ->where('u1.admin_verify_status', '2')
                ->where('u1.staff_verify_status', '2')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getemaildatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', '!=', 'A')
                ->where('u1.roles', '!=', 'S')
                ->where('u1.roles', '!=', 'CSO')
                ->where('u1.verify_status', '0')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getinvestordatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'I')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $this->prepare_wip_column($row["wip"], $row["id"]);
            $nestedData[] = $admin_verify_status;
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

    public function active_getinvestordatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'I')
                ->where('u1.admin_verify_status', '2')
                ->where('u1.staff_verify_status', '2')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getfundraiserdatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'users.id',
            1 => 'users.firstname',
            2 => 'users.lastname',
            3 => 'users.profile_code',
            4 => 'users.email',
            5 => 'users.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );


        $query = Users::from('users')
                ->leftjoin("verification_details", "verification_details.user_id", "=", "users.id")
                ->leftjoin("users as u2","u2.id","=","users.allocation_id")
                ->where('users.roles', 'FR')
                ->where('users.is_cold', '0')
                ->where('users.is_deleted', '0');
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
                ->select('users.allocation_id','users.email','users.id', 'users.profile_code', 'users.firstname',
                        'users.lastname', 'users.number', 'users.user_type',
                        'users.roles', 'users.ip', 'users.verify_status', 'users.user_type',
                        'users.created_at', 'users.staff_verify_status',
                        'users.admin_verify_status', 'verification_details.status',
                         'u2.firstname as a_firstname', 'u2.lastname as a_lastname','users.wip')
                ->get();

        $objPasscode = new UsersPasscode();
        $all_passcode_result = $objPasscode->get_all_users_passcode();
        $data = array();
        $i = 0;

        foreach ($resultArr as $row) {
            $passcode_rec = $objPasscode->get_user_pass_code($row, $all_passcode_result);


            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }


            if ($row["status"] == "Verified") {
                $addressVerify = '<button type="button" class="btn btn-circle btn-success">Verified</button>';
            } else {
                $addressVerify = '<select class="addressVerify mdl-textfield__input" data-id="' . $row["id"] . '">
                                    <option class="mdl-menu__item"  value="0" selected="selected">Not Verify</option>
                                    <option class="mdl-menu__item"  value="1" >Verified</option>
                                </select>';
            }


            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];


            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }

            $nestedData[] = $passcode_rec['passcode'];
            $nestedData[] = $passcode_rec['passcode_used'];
            $nestedData[] = $customerType;
            $nestedData[] = $this->prepare_wip_column($row["wip"], $row["id"]);
            $nestedData[] = $admin_verify_status;
            $nestedData[] = $emailVerfyHtml;
            $nestedData[] = $addressVerify;
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

    public function active_getfundraiserdatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'FR')
                ->where('u1.admin_verify_status', '2')
                ->where('u1.staff_verify_status', '2')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                        ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getfranchisedatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'F')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function active_getfranchisedatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'F')
                ->where('u1.admin_verify_status', '2')
                ->where('u1.staff_verify_status', '2')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getpartnerdatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'P')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function active_getpartnerdatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'P')
                ->where('u1.admin_verify_status', '2')
                ->where('u1.staff_verify_status', '2')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getPendingApprovaldatatable() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', '!=', 'A')
                ->where('u1.roles', '!=', 'S')
                ->where('u1.roles', '!=', 'CSO')
                ->where('u1.is_deleted', '0')
                ->where('u1.is_cold', '0')
                ->Where('u1.admin_verify_status', '0');
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-check"></i></button></centr>';
            } else {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-times"></i></button></centr>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
            $nestedData[] = $row["profile_code"];
            $nestedData[] = date("d-m-Y h:s:i A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getPendingApprovaldatatable_fr() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'FR')
                ->where('u1.is_deleted', '0')
                ->where('u1.is_cold', '0')
                ->where('u1.admin_verify_status', '0');
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-check"></i></button></centr>';
            } else {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-times"></i></button></centr>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:s:i A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getPendingApprovaldatatable_i() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'I')
                ->where('u1.admin_verify_status', '0')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-check"></i></button></centr>';
            } else {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-times"></i></button></centr>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:s:i A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getPendingApprovaldatatable_f() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'F')
                ->where('u1.admin_verify_status', '0')
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
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-check"></i></button></centr>';
            } else {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-times"></i></button></centr>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:s:i A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getPendingApprovaldatatable_p() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'u1.id',
            1 => 'u1.firstname',
            2 => 'u1.lastname',
            3 => 'u1.profile_code',
            4 => 'u1.email',
            5 => 'u1.created_at',
            6 => 'u2.firstname',
            7 => 'u2.lastname',
        );

        $query = Users::from('users as u1')
                ->leftjoin("users as u2","u2.id","=","u1.allocation_id")
                ->where('u1.roles', 'P')
                ->where('u1.admin_verify_status', '0')
                ->where('u1.is_cold', '0')
                ->where('u1.is_deleted', '0');
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
        // print_r($requestData);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('u1.wip','u1.email', 'u1.id', 'u1.allocation_id',
                                'u1.profile_code', 'u1.firstname', 'u1.lastname',
                                 'u1.number', 'u1.user_type', 'u1.roles', 'u1.ip',
                                 'u1.verify_status', 'u1.user_type', 'u1.created_at',
                                  'u1.staff_verify_status', 'u1.admin_verify_status','u2.firstname as a_firstname', 'u2.lastname as a_lastname')
                                ->get();
        $data = array();

        $i = 0;
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-check"></i></button></centr>';
            } else {
                $emailVerfyHtml = '<center><button type="button" class="btn btn-circle btn-success"><i class="fa fa-times"></i></button></centr>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#deleteModel" data-id="' . $row['id'] . '" class="deleteuser"><i class="fa fa-trash-o"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="' . route('comments-details', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:s:i A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];
            if($row['allocation_id']){
                $nestedData[] = $row["a_firstname"] . " " . $row["a_lastname"];
            }else{
                $nestedData[] = "Not Define";
            }
            $nestedData[] = $customerType;
            $nestedData[] = $admin_verify_status;
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

    public function getpendingdatatable($logged_in_id) {

        if (!empty(Auth()->guard('staff')->user())) {
            $user_data = Auth()->guard('staff')->user();
        }
        if($user_data['asign_role']){
            $role = json_decode($user_data['asign_role']) ;
        }else{
            $role = [];
        }

        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'profile_code',
            4 => 'allocation_datetime',
            5 => 'created_at',
        );


        $query = Users::from('users')
                ->where('roles', '!=', 'A')
                ->where('roles', '!=', 'S')
                ->where('staff_verify_status', '2')
                ->where('is_deleted', '0')
                ->where('is_cold', '0')
                ->where("allocation_id",$logged_in_id);
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
        $orderbycolumns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'profile_code',
            4 => 'allocation_datetime',
            5 => 'created_at',
        );
        if ($requestData['order'][0]['column'] == 0) {
            $temp = $query->orderBy('created_at', 'DESC');
        } else {
            $order_column_name = $orderbycolumns[$requestData['order'][0]['column']];
            $order_sort = $requestData['order'][0]['dir'];
            $temp = $query->orderBy($order_column_name, $order_sort);
        }



        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('id', 'profile_code', 'firstname',
                                'lastname', 'number', 'user_type', 'roles',
                                'ip', 'verify_status', 'user_type',
                                'created_at', 'staff_verify_status',
                                'admin_verify_status','user_note',
                                'wip','allocation_datetime')->get();
        $data = array();

        $i = 0;
        $objPasscode = new UsersPasscode();
        $all_passcode_result = $objPasscode->get_all_users_passcode();
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
            $actionhtml = '';
            $i++;

            if(in_array("view", $role)){
                $actionhtml =  $actionhtml.'<a href="' . route('user-details-staff', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;';
           }

            if(in_array("edit", $role)){
                    $actionhtml =  $actionhtml .'<a href="' . route('edit-user-details-staff', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;';
            }
            if(in_array("addNote", $role)){
                 $actionhtml =  $actionhtml. '<a href="' . route('add-note-staff', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;';
            }

            if(in_array("status", $role)){
                $actionhtml =$actionhtml.'<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
           }
            $actionhtml = $actionhtml.'<a href="' . route('comments-details-staff', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;';

            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y H:s:i A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];

            $passcode_rec = $objPasscode->get_user_pass_code($row, $all_passcode_result);
            $nestedData[] = $passcode_rec['passcode'];
            $nestedData[] = $passcode_rec['passcode_used'];
            if($row['allocation_datetime'] != null){
                $nestedData[] = date("d-m-Y h:i:s",strtotime($row['allocation_datetime']));

            }else{

                $nestedData[] = "Not Define";
            }

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

    public function getPendingApprovalStaffdatatable($logged_in_id) {

        if (!empty(Auth()->guard('staff')->user())) {
            $user_data = Auth()->guard('staff')->user();
        }
        if($user_data['asign_role']){
            $role = json_decode($user_data['asign_role']) ;
        }else{
            $role = [];
        }

        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'profile_code',
            4 => 'allocation_datetime',
            5 => 'created_at',
        );
        $orderbycolumns = array(
            // datatable column index  => database column name
            0 => 'created_at',
            1 => 'firstname',
            2 => 'profile_code',
            4 => 'allocation_datetime',
            5 => 'created_at',
        );

        $query = Users::from('users')
                ->where('roles', '!=', 'A')
                ->where('roles', '!=', 'S')
                ->whereIn('staff_verify_status', ['0', '1'])
                ->where('is_deleted', '0')
                ->where('is_cold', '0')
                ->where("allocation_id",$logged_in_id);
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
        if ($requestData['order'][0]['column'] == 0) {
            $temp = $query->orderBy('created_at', 'DESC');
        } else {
            $order_column_name = $orderbycolumns[$requestData['order'][0]['column']];
            $order_sort = $requestData['order'][0]['dir'];
            $temp = $query->orderBy($order_column_name, $order_sort);
        }
        // print_r($requestData);exit;


        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('wip','allocation_datetime', 'id', 'user_note','profile_code', 'firstname', 'lastname', 'number', 'user_type', 'roles', 'ip', 'verify_status', 'user_type', 'created_at', 'staff_verify_status', 'admin_verify_status')->get();
        $data = array();

        $i = 0;
        $objPasscode = new UsersPasscode();
        $all_passcode_result = $objPasscode->get_all_users_passcode();
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
                $actionhtml =  $actionhtml.'<a href="' . route('user-details-staff', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;';
            }

            if(in_array("edit", $role)){
                    $actionhtml =  $actionhtml .'<a href="' . route('edit-user-details-staff', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;';
            }
            if(in_array("addNote", $role)){
                 $actionhtml =  $actionhtml. '<a href="' . route('add-note-staff', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;';
            }

            if(in_array("status", $role)){
                $actionhtml =$actionhtml.'<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            }
            $actionhtml = $actionhtml.'<a href="' . route('comments-details-staff', $row["id"]) . '" class=""><i class="fa fa-comments"></i></a>&nbsp;';

            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
            // $nestedData[] = $type;
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y H:s:i A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];

            $passcode_rec = $objPasscode->get_user_pass_code($row, $all_passcode_result);
            $nestedData[] = $passcode_rec['passcode'];
            $nestedData[] = $passcode_rec['passcode_used'];

            if($row['allocation_datetime'] != null){
                $nestedData[] = date("d-m-Y h:i:s",strtotime($row['allocation_datetime']));
            }else{
                $nestedData[] = "Not Define";

            }

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

    public function getuserdetails($id) {
        $result = DB::table('users')
                ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "users.id")
                ->where("users.id", $id)
                ->where('is_deleted', '0')
                ->select("*", "users.created_at as cretedate")
                ->get();
        return $result;
    }

    public function get_franchise_userdetails($id) {
        $result = DB::table('users')
                ->leftjoin("franchise_details", "franchise_details.user_id", "=", "users.id")
                ->where("users.id", $id)
                ->where('is_deleted', '0')
                ->select("*", "users.created_at as cretedate")
                ->get();
        return $result;
    }

    public function updateprofile($request, $id) {
        //        print_r($request->input());
//        die();
        $usercheck = Users::where('email', $request->input("email"))
                ->where('id', "!=", $id)
                ->count();
        if ($usercheck == 0) {
            $objuserUpdate = Users::find($id);
            $objuserUpdate->firstname = $request->input('firstname');
            $objuserUpdate->lastname = $request->input('lastname');
            $objuserUpdate->email = $request->input('email');
            $objuserUpdate->number = $request->input('mnumber');
            if ($request->input('password') != null || $request->input('password') != '') {
                $objuserUpdate->password = Hash::make($request->input('password'));
            }
            $objuserUpdate->staff_verify_status = "0";
            $objuserUpdate->admin_verify_status = "0";

            if ($objuserUpdate->save()) {

                $deleterecord = Fundraiserdetails::where('user_id', $id)->delete();

                $objFundrasiserDetails = new Fundraiserdetails();
                $objFundrasiserDetails->user_id = $id;
                $objFundrasiserDetails->designation = $request->input('designation');
                $objFundrasiserDetails->companyname = $request->input('company');
                $objFundrasiserDetails->website = $request->input('website');
                $objFundrasiserDetails->phone_number = $request->input('altnumber');
                $objFundrasiserDetails->address = $request->input('address');
                $objFundrasiserDetails->country = $request->input('country');
                $objFundrasiserDetails->state = $request->input('state');
                if (!empty($request->input('city'))) {
                    $objFundrasiserDetails->city = $request->input('city');
                } else {
                    $objFundrasiserDetails->city = NULL;
                }
                $objFundrasiserDetails->pincode = $request->input('pincode');
                $objFundrasiserDetails->industry = $request->input('industry');
                $objFundrasiserDetails->gst = $request->input('gst');
                $objFundrasiserDetails->partnercode = $request->input('partnercode');
                $objFundrasiserDetails->created_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->updated_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->save();
                return "done";
            }
        } else {
            return "exits";
        }
    }

    public function update_frnachise_profile($request, $id) {
        //        print_r($request->input());
//        die();
        $usercheck = Users::where('email', $request->input("email"))
                ->where('id', "!=", $id)
                ->count();
        if ($usercheck == 0) {
            $objuserUpdate = Users::find($id);
            $objuserUpdate->firstname = $request->input('firstname');
            $objuserUpdate->lastname = $request->input('lastname');
            $objuserUpdate->email = $request->input('email');
            $objuserUpdate->number = $request->input('mnumber');
            if ($request->input('password') != null || $request->input('password') != '') {
                $objuserUpdate->password = Hash::make($request->input('password'));
            }
            $objuserUpdate->staff_verify_status = "0";
            $objuserUpdate->admin_verify_status = "0";

            if ($objuserUpdate->save()) {

                $deleterecord = FranchiseDeatils::where('user_id', $id)->delete();

                $objFundrasiserDetails = new FranchiseDeatils();
                $objFundrasiserDetails->user_id = $id;
                $objFundrasiserDetails->designation = $request->input('designation');
                $objFundrasiserDetails->companyname = $request->input('company');
                $objFundrasiserDetails->website = $request->input('website');
                $objFundrasiserDetails->phone_number = $request->input('altnumber');
                $objFundrasiserDetails->address = $request->input('address');
                $objFundrasiserDetails->country = $request->input('country');
                $objFundrasiserDetails->state = $request->input('state');
                if (!empty($request->input('city'))) {
                    $objFundrasiserDetails->city = $request->input('city');
                } else {
                    $objFundrasiserDetails->city = NULL;
                }
                $objFundrasiserDetails->pincode = $request->input('pincode');
                $objFundrasiserDetails->industry = $request->input('industry');
                $objFundrasiserDetails->gst = $request->input('gst');
                $objFundrasiserDetails->partnercode = $request->input('partnercode');
                $objFundrasiserDetails->created_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->updated_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->save();
                return "done";
            }
        } else {
            return "exits";
        }
    }

    public function changewipstatus($request) {
        $objuserUpdate = Users::find($request->input('id'));
        $objuserUpdate->wip = $request->input('val');
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        $result = $objuserUpdate->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function changeusertype($request) {
        $objuserUpdate = Users::find($request->input('id'));
        $objuserUpdate->user_type = $request->input('val');
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        $result = $objuserUpdate->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function generate_weunite_email($objUser) {
        $ip = '107.180.44.223'; // Need to Change.
        $account = "cz6e2b23ikew"; // Need to Change.
        $domain = "weunite91.com"; // Need to Change.
        $account_pass = "Nagesh@1234"; // Need to Change.
        $xmlapi = new \App\Services\CpanelXMLAPI($ip);
        $xmlapi->password_auth($account, $account_pass);
        $xmlapi->set_output('json');
        $xmlapi->set_port('2083'); // Need to Change.
        $xmlapi->set_debug(1);

        $person_email = $objUser->email;
        $email_parts = explode("@", $person_email);
        $new_email = $objUser->firstname. rand(1000, 9999) . "@weunite91.com";
        $new_pwd = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        ;

        $results = json_decode($xmlapi->api2_query($account, "Email", "addpop",
                        array('domain' => $domain, 'email' => $new_email,
                            'password' => $new_pwd, 'quota' => '200')), true);

        if ($results['cpanelresult']['data'][0]['result']) {

            $objUser->weunite_email = $new_email;

            $mailData['data'] = '';
            $mailData['subject'] = 'We Unite 91 Email Generated';
            $mailData['attachment'] = array();
            $mailData['template'] = "emails.weuniteemail";
            $mailData['mailto'] = $person_email;
            $mailData['data'] = ['weunite91mail' => $new_email,
                'weunite91mail_pwd' => $new_pwd,
                "firstname" => $objUser->firstname,
                "lastname" => $objUser->lastname];
            $sendMail = new Sendmail;
            $sendMail->sendSMTPMail($mailData);
        } else {

            echo "Error creating email account:\n" . $results['cpanelresult']['data'][0]['reason'];
        }
    }

    private function set_active_date($objuserUpdate, $user_id) {
        if ($objuserUpdate->roles == 'FR') {
            $f_table_name = 'fundraiser_payment_details';
            $f_column = 'fundraiser_payment_details.user_id';
        }
        $result = DB::table($f_table_name)
                ->where($f_column, '=', $user_id)
                ->select('*')
                ->get();
        if (count($result) > 0) {
            if ($result[0]->created_at > $objuserUpdate->active_date) {
                $objuserUpdate->active_date = date("Y-m-d");
            }
        }
    }

    public function changeadminverify($request) {
        $session = $request->session()->all();
        $loggedin_id = $session['logindata'][0]['id'];
        $objuserUpdate = Users::find($request->input('id'));
        if ($objuserUpdate->first_active != 1 && $request->input('val') == 2) {
            $objuserUpdate->active_date = date("Y-m-d");
            $objuserUpdate->first_active = '1';
            $this->generate_weunite_email($objuserUpdate);
        }
        if ($objuserUpdate->roles == 'FR') {

            if ($request->input('val') == 2) {
                $this->set_active_date($objuserUpdate, $request->input('id'));
            }
        }
        $objuserUpdate->admin_verify_status = $request->input('val');
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        $result = $objuserUpdate->save();
        if ($result) {
            $objHistory = new UserAdminHistory();
            $objHistory->user_id = $request->input('id');
            $objHistory->notes = '';
            $objHistory->created_by = $loggedin_id;
            $objHistory->created_at = date("Y-m-d H:i:s");
            $objHistory->status_to = $request->input('val');
            $his_result = $objHistory->save();
            return true;
        } else {
            return false;
        }
    }

    public function changeemailverify($request) {
        $objuserUpdate = Users::find($request->input('id'));

        $objuserUpdate->verify_status = $request->input('val');
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        $result = $objuserUpdate->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function addressVerify($request) {

        $verifyResult = VerificationDetails::where("user_id", "=", $request->input('id'))->first();

        if ($verifyResult != null) {
            $verifyResult->status = "Verified";
            $verifyResult->updated_by = $request->input('id');
            $result = $verifyResult->save();
            if ($result) {
                return "true";
            } else {
                return "false";
            }
        } else {
            $count = DB::table('fund_raise_details')
                    ->where('user_id', '=', $request->input('id'))
                    ->count();
            if ($count != 0) {
                $userDetails = DB::table('fund_raise_details')
                        ->where('user_id', '=', $request->input('id'))
                        ->get();
                $objVerificationDetails = new VerificationDetails();
                $objVerificationDetails->user_id = $userDetails[0]->user_id;
                $objVerificationDetails->address1 = $userDetails[0]->address;
                $objVerificationDetails->address2 = '';
                $objVerificationDetails->city = $userDetails[0]->city;
                $objVerificationDetails->state = $userDetails[0]->state;
                $objVerificationDetails->country = $userDetails[0]->country;
                $objVerificationDetails->pincode = $userDetails[0]->pincode;
                $objVerificationDetails->status = "Verified";
                $objVerificationDetails->created_by = $request->input('id');
                $objVerificationDetails->updated_by = $request->input('id');

                $result = $objVerificationDetails->save();
                if ($result) {
                    return "true";
                } else {
                    return "false";
                }
            } else {
                return "data_not_found";
            }
        }
    }

    public function changestaffverify($request, $loggedin_id) {
        $objuserUpdate = Users::find($request->input('id'));
        $objuserUpdate->staff_verify_status = $request->input('val');
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        $result = $objuserUpdate->save();
        if ($result) {
            $objHistory = new UserAdminHistory();
            $objHistory->user_id = $request->input('id');
            $objHistory->notes = '';
            $objHistory->created_by = $loggedin_id;
            $objHistory->created_at = date("Y-m-d H:i:s");
            $objHistory->status_to = $request->input('val');
            $his_result = $objHistory->save();
            return true;
        } else {
            return false;
        }
    }

    public function addStaff($request) {
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
            $objUsers->roles = "S";
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

                $profile_code = "UN-S-19000" . $objUsers->id;
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

    public function editStaff($request) {
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

    public function sendSupportEmail($supportmsg) {
        $session = session()->all();
        $email = $session['logindata'][0]['email'];

        $mailData['data'] = '';
        $mailData['subject'] = 'Support';
        $mailData['attachment'] = array();
        $mailData['template'] = "emails.supportemail";
        $mailData['mailto'] = 'parthkhunt12@gmail.com';
        $mailData['data'] = ['email' => $email, 'msg' => $supportmsg];
        $sendMail = new Sendmail;
        $sendMail->sendSMTPMail($mailData);
        return true;
    }

    public function userdetails($id) {
        $result = Users::select("id", "firstname", "lastname", "roles", "profile_code","user_note")
                ->where("id", $id)
                ->where('is_deleted', '0')
                ->get();
        return $result;
    }

    public function addnote($request) {
        $objuserUpdate = Users::find($request->input('editid'));
        $objuserUpdate->user_note = $request->input('usernote');
        return $objuserUpdate->save();
    }

    public function deleteprofile($data) {
//        print_r($data['id']);
//        die();
        $objuserUpdate = Users::find($data['id']);
        $objuserUpdate->delete_profile = "1";
        $objuserUpdate->staff_verify_status = "0";
        $objuserUpdate->admin_verify_status = "0";
        return $objuserUpdate->save();
    }

    public function getuserdetailsview($id) {
        $result = DB::table('users')
                ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "users.id")
                ->leftjoin("fundraiser_payment_details", "fundraiser_payment_details.user_id", "=", "users.id")
                ->leftjoin("fund_raiser_company_details", "fund_raiser_company_details.user_id", "=", "users.id")
                ->leftjoin("fund_raiser_image", "fund_raiser_image.user_id", "=", "users.id")
                ->leftjoin("countries", "countries.id", "=", "fund_raise_details.country")
                ->leftjoin("states", "states.id", "=", "fund_raise_details.state")
                ->leftjoin("cities", "cities.id", "=", "fund_raise_details.city")
                ->where("users.id", $id)
                ->where('users.is_deleted', '0')
                ->select("*","fund_raiser_company_details.id as videoId", DB::raw('group_concat(fund_raiser_image.id) as images_array_id'),DB::raw('group_concat(fund_raiser_image.imagename) as images_array'), "users.created_at as cretedate", "countries.name as c_name", "cities.name as city_name", "states.name as states_name")
                ->groupBy('fund_raiser_image.user_id')
                ->get();

        return $result;
    }

    public function getInvestorDetailsView($id) {
        $result = DB::table('users')
                ->leftjoin("investor_details", "investor_details.user_id", "=", "users.id")
                ->leftjoin("industry", "investor_details.industry", "=", "industry.id")
                ->leftjoin("cities", "investor_details.city", "=", "cities.id")
                ->leftjoin("states", "investor_details.state", "=", "states.id")
                ->leftjoin("countries", "investor_details.country", "=", "countries.id")
                ->leftjoin("designation", "designation.de_id", "=", "investor_details.designation")
                ->where("users.id", $id)
                ->where('users.is_deleted', '0')
                ->select("*", "investor_details.id as pitchid", "users.id as userid", "industry.industry as industryname", "cities.name as cityname", "states.name as statename", "countries.name as countryname", "investor_details.industry as industry")
                ->get();
        return $result;
    }
    public function getPartnerDetailsView($id) {
        $result = DB::table('users')
                ->leftjoin("partner_details", "partner_details.user_id", "=", "users.id")
                ->leftjoin("cities", "cities.id", "=", "partner_details.city")
                ->leftjoin("states", "states.id", "=", "partner_details.state")
                ->leftjoin("countries", "countries.id", "=", "partner_details.country")
                ->leftjoin("designation", "designation.de_id", "=", "partner_details.designation")
                ->where("users.id", $id)
                ->where('users.is_deleted', '0')
                ->select("*",  "users.id as userid","designation.de_designation",  "cities.name as cityname", "states.name as statename", "countries.name as countryname")
                ->get();
        return $result;
    }

    public function getuserrole($id) {
        $result = DB::table('users')
                ->where("users.id", $id)
                ->where('users.is_deleted', '0')
                ->select("roles")
                ->get();

        return $result;
    }

    public function updateInvestorByAdmin($request, $id) {
        $usercheck = Users::where('email', $request->input("email"))
                ->where('id', "!=", $id)
                ->count();
        if ($usercheck == 0) {
            $objuserUpdate = Users::find($id);
            $objuserUpdate->firstname = $request->input('firstname');
            $objuserUpdate->lastname = $request->input('lastname');
            $objuserUpdate->email = $request->input('email');
            // $objuserUpdate->country_code =$request->input('code');
            $objuserUpdate->number = $request->input('mnumber');

            // $objuserUpdate->staff_verify_status ="0";
            // $objuserUpdate->admin_verify_status ="0";

            if ($objuserUpdate->save()) {
                $tempInrest = implode(",", $request->input('interestin'));
                $tempIndustry = implode(",", $request->input('industry'));
                $tempInterestedCountry = implode(",", $request->input('interestedcountry'));

                // $detailcheck = Users::where('user_id', $id)->delete();
                $find_id = Investor::select('id')->where('user_id', $id)->first();

                $objFundrasiserDetails = Investor::find($find_id->id);
                $objFundrasiserDetails->user_id = $id;
                $objFundrasiserDetails->designation = $request->input('designation');
                $objFundrasiserDetails->companyname = $request->input('companyname');
                $objFundrasiserDetails->website = $request->input('website');
                $objFundrasiserDetails->phone_number = $request->input('altnumber');
                $objFundrasiserDetails->address = $request->input('address');
                $objFundrasiserDetails->country = $request->input('country');
                $objFundrasiserDetails->state = $request->input('state');
                if (!empty($request->input('city'))) {
                    $objFundrasiserDetails->city = $request->input('city');
                } else {
                    $objFundrasiserDetails->city = NULL;
                }
                $objFundrasiserDetails->pincode = $request->input('pincode');
                $objFundrasiserDetails->industry = $tempIndustry;
                $objFundrasiserDetails->gst = $request->input('gst');
                $objFundrasiserDetails->investortype = $request->input('investortype');
                $objFundrasiserDetails->interestin = $tempInrest;
                $objFundrasiserDetails->intro = $request->input('introduction');
                $objFundrasiserDetails->interested_country = $tempInterestedCountry;
                $objFundrasiserDetails->company_intro = $request->input('companyintro');
                $objFundrasiserDetails->min_investment = $request->input('min_investment');
                $objFundrasiserDetails->max_investment = $request->input('max_investment');
                $objFundrasiserDetails->created_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->updated_at = date("Y-m-d h:i:s");
                $objFundrasiserDetails->save();
                return "done";
            }
        } else {
            return "exits";
        }
    }

    public function deleteUser($request) {
        $data = $request->input('data');
        $objuserUpdate = Users::find($data['id']);
        $objuserUpdate->is_deleted = '1';
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        return $objuserUpdate->save();
    }

    public function reactivateUser($request) {
        $data = $request->input('data');
        $objuserUpdate = Users::find($data['id']);
        $objuserUpdate->is_deleted = '0';
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        return $objuserUpdate->save();
    }

    public function updatepassword($request) {
        $objuserUpdate = Users::find($request->input('editid'));
        $objuserUpdate->password = Hash::make($request->input('password'));
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        if ($objuserUpdate->save()) {
            DB::table('forgotpassword')->where('id', $request->input('tokenid'))->delete();
            return true;
        } else {
            return false;
        }
    }

    public function resndotp($email) {
        $result = Users::select("id")
                ->where('email', $email)
                ->get();
        $userid = $result[0]->id;
        $otp = rand(111111, 999999);
        //$otp = 123456;
        $mailData['data'] = '';
        $mailData['subject'] = 'Account verification';
        $mailData['attachment'] = array();
        $mailData['template'] = "emails.sendotp";
        $mailData['mailto'] = $email;
        $mailData['data'] = ['otp' => $otp, "firstname" => $result[0]->firstname, "lastname" => $result[0]->lastname];
        // $mailData['data'] = ['otp' => $otp];
        $sendMail = new Sendmail;
        $sendMail->sendSMTPMail($mailData);

        $objuserUpdate = Users::find($userid);
        $objuserUpdate->otp = $otp;
        $objuserUpdate->updated_at = date("Y-m-d h:i:s");
        if ($objuserUpdate->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function revoke_offer($data) {

        $objFundrasiserinvestmentDetails = Fundriser_investment_offered::find($data['id']);
        $objFundrasiserinvestmentDetails->is_deleted = '1';
        if ($objFundrasiserinvestmentDetails->save()) {
            return $objFundrasiserinvestmentDetails->save();
        } else {
            return false;
        }

    }

    public function getrevokelist() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'users.email',
            1 => 'u1.firstname',
            2 => 'u1.profile_code',
            3 => 'iro.ammount',
            4 => 'u1.number',
            5 => 'users.created_at',
        );

        $query = Investor_proposal::from('fundriser_investment_offered as iro')
                ->leftjoin('users as u1', 'u1.id', '=', 'iro.user_id')
                ->leftjoin('users as u2', 'u2.id', '=', 'iro.pitch_id')
                ->where('iro.is_deleted', '1')
                ->where('u1.is_deleted', '0')
                
                ->where('u2.is_deleted', '0');
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
                        ->select('iro.id', 'iro.ammount', 'iro.commision', 'iro.payment_status', 'u2.profile_code as frprofilecode', 'u1.profile_code as iprofilecode', 'iro.id as realid', 'iro.transaction_id', 'iro.note', 'iro.created_at')->get();
        $data = array();
        // echo "<pre>";print_r($resultArr);exit;
        $i = 0;

        foreach ($resultArr as $row) {
            $i++;


            $approve = '<select class="approve mdl-textfield__input" data-id="' . $row["realid"] . '">

                        <option class="mdl-menu__item"  value="Pending" selected>Pending</option>
                        <option class="mdl-menu__item"  value="Approve">Approve</option>
                        <option value="Rejected" class="mdl-menu__item">Rejected</option>
                    </select>';
            $actionhtml = '<a href="' . route('view-rewoke', $row["realid"]) . '" class=""><i class="fa fa-eye"></i></a>' . ' <a href="' . route('add-revoke-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = '<center>' . $row["iprofilecode"] . '</center>';
            $nestedData[] = '<center>' . $row["frprofilecode"] . '</center>';
            $nestedData[] = '<center>' . $row["ammount"] . '</center>';
            $nestedData[] = '<center>' . $row["commision"] . '</center>';
            $nestedData[] = '<center>' . $approve . '</center>';
            $nestedData[] = '<center>' . date("d-m-Y H:s:i A", strtotime($row["created_at"])) . '</center>';
            $nestedData[] = '<center>' . $row["transaction_id"] . '</center>';
            $nestedData[] = '<center>' . $actionhtml . '</center>';
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

    public function getapprovedrevokelist() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'users.email',
            1 => 'u1.firstname',
            2 => 'u1.profile_code',
            3 => 'iro.ammount',
            4 => 'u1.number',
            5 => 'users.created_at',
        );

        $query = Investor_proposal::from('investor_revoke_offers as iro')
                ->leftjoin('users as u1', 'u1.id', '=', 'iro.user_id')
                ->leftjoin('users as u2', 'u2.id', '=', 'iro.pitch_id')
                ->where('u1.is_deleted', '0')
                ->where('u2.is_deleted', '0');
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
                        ->select('iro.ammount', 'iro.commision', 'iro.payment_status', 'u2.profile_code as frprofilecode', 'u1.profile_code as iprofilecode', 'iro.id as realid', 'iro.transaction_id')->get();
        $data = array();
        // echo "<pre>";print_r($resultArr);exit;
        $i = 0;

        foreach ($resultArr as $row) {
            $i++;

            if ($row["payment_status"] == 'Paid') {
                $approve = '<select class="approve mdl-textfield__input" data-id="' . $row["realid"] . '">
                    <option class="mdl-menu__item"  value="Paid" selected>Paid</option>
                    <option class="mdl-menu__item" value="Pending">Pending</option>

                </select>';
            } else {

                $approve = '<select class="approve mdl-textfield__input" data-id="' . $row["realid"] . '">
                        <option class="mdl-menu__item"  value="Paid" >Paid</option>
                        <option class="mdl-menu__item"  value="Pending" selected>Pending</option>

                    </select>';
            }
            $actionhtml = '<a href="' . route('view-rewoke', $row["realid"]) . '" class=""><i class="fa fa-eye"></i></a>';
            $nestedData = array();
            $nestedData[] = '<center>' . $row["iprofilecode"] . '</center>';
            $nestedData[] = '<center>' . $row["frprofilecode"] . '</center>';
            $nestedData[] = '<center>' . $row["ammount"] . '</center>';
            $nestedData[] = '<center>' . $row["commision"] . '</center>';
            $nestedData[] = '<center>' . $row["transaction_id"] . '</center>';
            $nestedData[] = '<center>' . $approve . '</center>';
            $nestedData[] = '<center>' . $actionhtml . '</center>';
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

    public function revokestatuschange($request) {
        if ($request->input('val') == 'Approve') {


            $result = DB::table('fundriser_investment_offered')
                    ->where("id", $request->input('id'))
                    ->select("*")
                    ->get();
            $insertRevoke = new Investor_revoke_offers();
            $insertRevoke->pitch_id = $result[0]->pitch_id;
            $insertRevoke->user_id = $result[0]->user_id;
            $insertRevoke->ammount = $result[0]->ammount;
            $insertRevoke->commision = $result[0]->commision;
            $insertRevoke->transaction_id = $result[0]->transaction_id;
            $insertRevoke->created_at = date("Y-m-d h:i:s");
            $insertRevoke->updated_at = date("Y-m-d h:i:s");
            $insertresult = $insertRevoke->save();
            $result = DB::table('fundriser_investment_offered')->where('id', $request->input('id'))->delete();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'User revoke request successfully approved.';
                $return['redirect'] = route('revokeoffers');
                return $return;
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
                return $return;
            }
        } elseif ($request->input('val') == 'Rejected') {
            $objInvestorProposal = Fundriser_investment_offered::find($request->input('id'));
            $objInvestorProposal->is_deleted = '0';
            $objInvestorProposal->updated_at = date("Y-m-d h:i:s");
            $result = $objInvestorProposal->save();
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'User revoke request successfully rejected.';
                $return['redirect'] = route('revokeoffers');
                return $return;
            } else {
                $return['status'] = 'error';
                $return['message'] = 'Something goes to wrong';
                return $return;
            }
        }
    }

    public function approvedrevokestatuschange($request) {
        $objInvestorProposal = Investor_revoke_offers::find($request->input('id'));
        $objInvestorProposal->payment_status = $request->input('val');
        $objInvestorProposal->updated_at = date("Y-m-d h:i:s");
        $result = $objInvestorProposal->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getinvokedetailsinvestor($id) {
        $query = Investor_proposal::from('investor_revoke_offers as iro')
                ->leftjoin('users as u1', 'u1.id', '=', 'iro.user_id')
                ->leftjoin('users as u2', 'u2.id', '=', 'iro.pitch_id')
                ->leftjoin("investor_details", "investor_details.user_id", "=", "u1.id")
                ->leftjoin("cities", "investor_details.city", "=", "cities.id")
                ->leftjoin("states", "investor_details.state", "=", "states.id")
                ->leftjoin("countries", "investor_details.country", "=", "countries.id")
                ->where("iro.id", $id)
                ->where('u1.is_deleted', '0')
                ->where('u2.is_deleted', '0')
                ->select("u1.*", "cities.name as cityname", "states.name as statename", "countries.name as countryname")
                ->get();
        return $query;
    }

    public function getinvokedetailsfr($id) {
        $query = Investor_proposal::from('investor_revoke_offers as iro')
                ->leftjoin('users as u1', 'u1.id', '=', 'iro.user_id')
                ->leftjoin('users as u2', 'u2.id', '=', 'iro.pitch_id')
                ->leftjoin("fund_raise_details", "fund_raise_details.user_id", "=", "u2.id")
                ->leftjoin("cities", "fund_raise_details.city", "=", "cities.id")
                ->leftjoin("states", "fund_raise_details.state", "=", "states.id")
                ->leftjoin("countries", "fund_raise_details.country", "=", "countries.id")
                ->where("iro.id", $id)
                ->where('u1.is_deleted', '0')
                ->where('u2.is_deleted', '0')
                ->select("u2.*", "cities.name as cityname", "states.name as statename", "countries.name as countryname")
                ->get();
        return $query;
    }

    public function edituserdetailsAdmin($request, $id) {

        $objuserUpdate = Users::find($id);
        $objuserUpdate->firstname = $request->input('firstname');
        $objuserUpdate->lastname = $request->input('lastname');
        $objuserUpdate->email = $request->input('email');
        $objuserUpdate->number = $request->input('mnumber');
        $objuserUpdate->count = $request->input('count');
        $objuserUpdate->user_note = $request->input('note');

        if ($objuserUpdate->save()) {

            $deleterecord = DB::table('fund_raise_details')->select("id")->where('user_id', $id)->get();
            if (count($deleterecord) == 0) {
                $objFundrasiserDetails = new Fundraiserdetails();
                $objFundrasiserDetails->user_id = $id;
            } else {
                $objFundrasiserDetails = Fundraiserdetails::find($deleterecord[0]->id);
            }

            $objFundrasiserDetails->designation = $request->input('designation');
            $objFundrasiserDetails->companyname = $request->input('company');
            $objFundrasiserDetails->website = $request->input('website');
            $objFundrasiserDetails->phone_number = $request->input('altnumber');
            $objFundrasiserDetails->address = $request->input('address');
            $objFundrasiserDetails->country = $request->input('country');
            $objFundrasiserDetails->state = $request->input('state');
            if (!empty($request->input('city'))) {
                $objFundrasiserDetails->city = $request->input('city');
            } else {
                $objFundrasiserDetails->city = NULL;
            }
            $objFundrasiserDetails->pincode = $request->input('pincode');
            $objFundrasiserDetails->industry = $request->input('industry');
            $objFundrasiserDetails->gst = $request->input('gst');
            $objFundrasiserDetails->partnercode = $request->input('partnercode');
            $objFundrasiserDetails->updated_at = date("Y-m-d h:i:s");
            $objFundrasiserDetails->save();
            return "done";
        } else {
            return "wrong";
        }
    }

    public function editFundDetailAdmin($request, $id) {

        if ($request->file()) {
            if ($request->file('mul_imgs')) {

                for ($i = 0; $i < count($request->file('mul_imgs')); $i++) {
                    $mul_imgs = $request->file('mul_imgs')[$i];
                    $mul_imgsname = time() . $i . '.' . $mul_imgs->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/company_details/');
                    $mul_imgs->move($destinationPath, $mul_imgsname);

                    $objFundaraiserImage = new Fund_raiser_image();
                    $objFundaraiserImage->user_id = $id;
                    $objFundaraiserImage->imagename = $mul_imgsname;

                    $objFundaraiserImage->created_at = date("Y-m-d h:i:s");
                    $objFundaraiserImage->updated_at = date("Y-m-d h:i:s");
                    $objFundaraiserImage->save();
                }
            }
        }
        $getid = DB::table('fund_raiser_company_details')->select("id")->where('user_id', $id)->get();

        if (count($getid) == 0) {
            $objFundraisercompanydetail = new Fundraisercompanydetail();
            $objFundraisercompanydetail->user_id = $id;
            //$objFundraisercompanydetail->payment_no=time()."-FR-".rand(111111,999999);
        } else {
            $objFundraisercompanydetail = Fundraisercompanydetail::find($getid[0]->id);
        }



        $objFundraisercompanydetail->min_investment = $request->input('min_investment');
        $objFundraisercompanydetail->max_investment = $request->input('max_investment');
        $objFundraisercompanydetail->min_investment_accepated = $request->input('min_accepted');
        $objFundraisercompanydetail->usp1 = $request->input('usp1');
        $objFundraisercompanydetail->usp2 = $request->input('usp2');
        $objFundraisercompanydetail->usp3 = $request->input('usp3');
        $objFundraisercompanydetail->usp4 = $request->input('usp4');
        $objFundraisercompanydetail->intro = $request->input('introduction');
        $objFundraisercompanydetail->idea = $request->input('idea');
        $objFundraisercompanydetail->team = $request->input('team_overview');
        $objFundraisercompanydetail->team_mem1 = $request->input('member1');
        $objFundraisercompanydetail->team_mem2 = $request->input('member2');
        $objFundraisercompanydetail->team_mem3 = $request->input('member3');
        $objFundraisercompanydetail->team_mem4 = $request->input('member4');
        $objFundraisercompanydetail->team_mem_deg1 = $request->input('position1');
        $objFundraisercompanydetail->team_mem_deg2 = $request->input('position2');
        $objFundraisercompanydetail->team_mem_deg3 = $request->input('position3');
        $objFundraisercompanydetail->team_mem_deg4 = $request->input('position4');
        if ($request->file()) {
            if ($request->file('member_picture')) {
                $image = $request->file('member_picture');
                $member_picture = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/upload/team_member/');
                $image->move($destinationPath, $member_picture);
                $objFundraisercompanydetail->member_image = $member_picture;
            }
        }

        if ($request->file()) {
            if ($request->file('up_video')) {
                $video = $request->file('up_video');
                $video_name = time() . '.' . $video->getClientOriginalExtension();
                $destinationPath = public_path('/upload/video/');
                $video->move($destinationPath, $video_name);
                $objFundraisercompanydetail->video = $video_name;
            }
        }

        $objFundraisercompanydetail->roi = $request->input('roi');
        $objFundraisercompanydetail->cop = $request->input('coc');
        $objFundraisercompanydetail->pi = $request->input('pi');
        $objFundraisercompanydetail->dividend = $request->input('amd');
        $objFundraisercompanydetail->fa = $request->input('fa');
        $objFundraisercompanydetail->ebitda = $request->input('ebitda');
        // $objFundraisercompanydetail->terms_con ="Yes";
        // $objFundraisercompanydetail->staff_verify_status = "0";
        // $objFundraisercompanydetail->admin_verify_status = "0";
        // $objFundraisercompanydetail->created_at =date("Y-m-d h:s:i");
        $objFundraisercompanydetail->updated_at = date("Y-m-d h:s:i");
        if ($objFundraisercompanydetail->save()) {
            //     $objuserUpdate = Users::find($id);
            //    $objuserUpdate->staff_verify_status = "0";
            //    $objuserUpdate->admin_verify_status = "0";
            //    $objuserUpdate->updated_at = date("Y-m-d h:i:s");
            return 'done';
        } else {
            return 'wrong';
        }
        //         return ;
    }

    public function getRevokeNote($id) {
        $result = DB::table('fundriser_investment_offered')
                ->where("id", $id)
                ->select("note")
                ->get();

        return $result;
    }

    public function addRevokeNote($request, $id) {
        $obkAddRevokeNote = Fundriser_investment_offered::find($id);
        $obkAddRevokeNote->note = $request->input('revokenote');
        if ($obkAddRevokeNote->save()) {
            //     $objuserUpdate = Users::find($id);
            //    $objuserUpdate->staff_verify_status = "0";
            //    $objuserUpdate->admin_verify_status = "0";
            //    $objuserUpdate->updated_at = date("Y-m-d h:i:s");
            return 'done';
        } else {
            return 'wrong';
        }
    }

    public function get_user_proposols($login_id, $roles) {

        $result = DB::table('investor_proposal')
                ->join('users', 'users.profile_code', "=", 'investor_proposal.sender_profile_code')
                ->where("investor_proposal.investordetailsid", $login_id)
                ->where("investor_proposal.appove", "=", "approve")
                ->select("sender_profile_code", "subject", "message", 'users.id as sender_user_id')
                ->get();
        return $result;
    }

    public function investor_userId($investerid) {

        $result = DB::table('investor_details')
                ->join('users', "investor_details.user_id", "=", "users.id")
                ->where("investor_details.id", $investerid)
                // ->where("investor_proposal.approve", "=","Approved")
                ->select("users.profile_code", "users.id")
                ->get();
        return $result;
    }

    public function get_user_details_by_profile_code($profile_code) {
        $result = DB::table('users')
                ->where("users.profile_code", $profile_code)
                ->select("users.profile_code", "users.id")
                ->get();
        return $result;
    }

    public function getInactvieusers() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'id',
            1 => 'firstname',
            2 => 'lastname',
            3 => 'profile_code',
            4 => 'email',
            5 => 'created_at',
        );

        $query = Users::from('users')
                ->where('roles', '!=', 'A')
                ->where('roles', '!=', 'S')
                ->where('is_cold', '0')
                ->where('is_deleted', '1');
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
                        ->select('wip','email', 'id', 'profile_code', 'firstname', 'lastname', 'number', 'user_type', 'roles', 'ip', 'verify_status', 'user_type', 'created_at', 'staff_verify_status', 'admin_verify_status')->get();
        $data = array();

        $i = 0;
        $objPasscode = new UsersPasscode();
        $all_passcode_result = $objPasscode->get_all_users_passcode();
        foreach ($resultArr as $row) {
            if ($row["user_type"] == 'P') {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item" value="P" selected>P</option><option class="mdl-menu__item" value="R">R</option></select>';
            } else {
                $customerType = '<select class="user_type mdl-textfield__input" data-id="' . $row["id"] . '"><option class="mdl-menu__item" value="P">P</option><option class="mdl-menu__item" value="R" selected>R</option></select>';
            }

            if ($row["admin_verify_status"] == '0') {
                $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" selected>Pending</option><option class="mdl-menu__item" value="1">On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
            } else {
                if ($row["admin_verify_status"] == '1') {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1" selected>On Hold</option><option class="mdl-menu__item"  value="2">Active</option></select>';
                } else {
                    $admin_verify_status = '<select class="admin_verify_status mdl-textfield__input" data-id="' . $row["id"] . '"> <option class="mdl-menu__item"  value="0" >Pending</option><option class="mdl-menu__item"  value="1">On Hold</option><option value="2" class="mdl-menu__item"  selected>Active</option></select>';
                }
            }

            if ($row["staff_verify_status"] == '0') {
                $staff_verify_status = '<button type="button" class="btn btn-circle btn-danger">Pending</button>';
            } else {
                if ($row["staff_verify_status"] == '1') {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-warning">On Hold</button>';
                } else {
                    $staff_verify_status = '<button type="button" class="btn btn-circle btn-success">Active</button>';
                }
            }



            if ($row["verify_status"] == '1') {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" >Pending</option>
                    <option value="2" class="mdl-menu__item"  selected>Active</option>
                </select>';
            } else {
                $emailVerfyHtml = '<select class="email_verify_status mdl-textfield__input" data-id="' . $row["id"] . '">
                    <option class="mdl-menu__item"  value="0" selected>Pending</option>
                    <option value="2" class="mdl-menu__item">Active</option>
                </select>';
            }

            $i++;
            if ($row["roles"] == "F") {
                $type = 'Franchise';
            }
            if ($row["roles"] == "I") {
                $type = 'Investor';
            }
            if ($row["roles"] == "FR") {
                $type = 'Fund Raiser';
            }
            if ($row["roles"] == "P") {
                $type = 'Partner';
            }
            if ($row["roles"] == "S") {
                $type = 'Staff';
            }
            $actionhtml = '<a href="' . route('user-details', $row["id"]) . '" class=""><i class="fa fa-eye"></i></a>&nbsp;'
                    . '<a href="' . route('edit-user-details', $row["id"]) . '" class=""><i class="fa fa-pencil"></i></a>&nbsp;'
                    . '<a href="#" data-toggle="modal" data-target="#ReactivateModel" data-id="' . $row['id'] . '" class="reactivateuser"><i class="fa fa-check-circle"></i></a>&nbsp;'
                    . '<a href="' . route('add-note', $row["id"]) . '" class=""><i class="fa fa-plus"></i></a>&nbsp;'
                    . '<a href="#" class="" onclick="getstatushistory(' . $row["id"] . ')"><i class="fa fa-history"></i></a>&nbsp;';
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
//            $nestedData[] = $row["roles"];
            $nestedData[] = $row["profile_code"];

            $nestedData[] = date("d-m-Y h:i:s A", strtotime($row["created_at"]));
            $nestedData[] = $row["ip"];
            $nestedData[] = $row["email"];

            $passcode_rec = $objPasscode->get_user_pass_code($row, $all_passcode_result);
            $nestedData[] = $passcode_rec['passcode'];
            $nestedData[] = $passcode_rec['passcode_used'];

            $nestedData[] = $customerType;
            //$nestedData[] =$this->prepare_wip_column($row["wip"],$row["id"]);
            $nestedData[] = $admin_verify_status;
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

    public function getverifyaddressusers() {
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'users.id',
            1 => 'users.firstname',
            2 => 'users.lastname',
            3 => 'users.profile_code',
            4 => 'users.email',
            5 => 'verification_details.status',
            6 => 'verification_details.created_at',
        );

        $query = Users::from('verification_details')
                ->join('users', 'users.id', '=', 'verification_details.user_id')
                ->join('countries', 'countries.id', '=', 'verification_details.country')
                ->join('states', 'states.id', '=', 'verification_details.state')
                ->join('cities', 'cities.id', '=', 'verification_details.city')
                ->where('verification_details.status', '!=', '')
                ->where('users.is_deleted', '0')
                ->where('users.is_cold', '0')
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
        // print_r($requestData);exit;
        $temp = $query->orderBy($columns[$requestData['order'][0]['column']],
                $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                        ->take($requestData['length'])
                        ->select('verification_details.*',
                                'users.profile_code',
                                'users.firstname',
                                'users.lastname',
                                'cities.name as city',
                                'countries.name as country',
                                'states.name as state',
                                'users.wip',
                                'users.email'
                        )->get();
        $data = array();

        $i = 0;
        $objPasscode = new UsersPasscode();
        $all_passcode_result = $objPasscode->get_all_users_passcode();
        $addres_verify_status = array('Pending', 'Verified', 'Not able to Verified');
        foreach ($resultArr as $row) {

            $verifciation_status = '<select class="verify_status_type mdl-textfield__input" data-id="' .
                    $row["verfication_id"] . '">';
            foreach ($addres_verify_status as $add_rec) {
                $ver_selected = '';
                if ($add_rec == $row['status']) {
                    $ver_selected = 'selected';
                }
                $verifciation_status .= ' <option class="mdl-menu__item" value="' . $add_rec . '" ' . $ver_selected . '>' . $add_rec . '</option>';
            }




            $i++;


            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = $row["firstname"] . " " . $row["lastname"];
            $nestedData[] = $row["profile_code"];
            $nestedData[] = $row["email"];
            $nestedData[] = $row["address1"];
            $nestedData[] = $row["city"];
            $nestedData[] = $row["state"];
            $nestedData[] = $row["country"];
            $nestedData[] = $row["pincode"];


            $nestedData[] = $verifciation_status;
            $nestedData[] = $row["amount"];
            $nestedData[] = $row["txn_id"];

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

    public function sendmail_to_user_firsttime($user_id) {

        $user = Users::find($user_id);
        if ($user->first_active == 0) {
            $mailData['data'] = '';
            $mailData['subject'] = 'Successful registration of your profile';
            $mailData['attachment'] = array();
            $mailData['template'] = "emails.profileupdate";
            $mailData['mailto'] = $user->email;
            $mailData['data'] = [
                "firstname" => $user->firstname,
                "lastname" => $user->lastname];
            $sendMail = new Sendmail;
            $sendMail->sendSMTPMail($mailData);
        }
    }



}
