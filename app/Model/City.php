<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
        protected $table = 'cities';
        
    
    public function citylist($state_id){
        $result = City::select("*")
                    ->where("state_id",$state_id)
                    ->get();
        return $result;
    }
}
