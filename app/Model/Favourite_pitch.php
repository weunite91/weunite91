<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Favourite_pitch extends Model
{
    protected $table = 'favourite_pitch';
       
       function __construct() {
           
       }
       public function checkfavourite($userid,$pitchid){
            $result = Favourite_pitch::where("user_id",$userid)
                                 ->where("pitch_id",$pitchid)
                                 ->count();
            return $result;
       }
}
