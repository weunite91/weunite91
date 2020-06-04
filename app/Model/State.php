<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    
    public function statelist($countryid){
        $result = State::select("*")
                    ->where("country_id",$countryid)
                    ->get();
        return $result;
    }
}
