<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Forgotpassword extends Model
{
       protected $table = 'forgotpassword';
       
       function __construct() {
           
       }
       
       public function checktoken($token){
           $count = Forgotpassword::where("token",$token)->count();
           if($count == 1){
               return true;
           }else{
               return false;
           }
       }
       public function getid($token){
           $result = Forgotpassword::select("users.email","users.firstname","users.lastname","users.id","forgotpassword.id as tokenid")
                            ->leftjoin("users","users.id","=","forgotpassword.user_id")
                            ->where("forgotpassword.token",$token)
                            ->get();
            return $result;
       }
}
