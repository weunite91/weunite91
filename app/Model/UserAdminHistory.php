<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class UserAdminHistory extends Model {

//
protected $table = 'user_admin_history';
protected $primaryKey = 'user_admin_history_id';
const UPDATED_AT = null;
function __construct() {
    
}
function get_status_history_by_user_id($user_id)
{
    $result = DB::table('user_admin_history')
    ->join('users',"users.id","=",'user_admin_history.created_by')
    ->where('user_admin_history.user_id',$user_id)
    ->orderBy('user_admin_history.created_at', 'desc')
    ->select('user_admin_history.notes',
            DB::raw("(CASE WHEN user_admin_history.status_to = '0' THEN 'Pending'
                           WHEN user_admin_history.status_to = '1' THEN 'On Hold'
                           WHEN user_admin_history.status_to = '2' THEN 'Approve'
                        END) AS status_to"),
            'users.firstname as created_by',
            DB::raw('DATE_FORMAT(user_admin_history.created_at, "%d-%b-%Y %H:%i") as created_at')
            
    )->get();
    return $result;
}
}
?>