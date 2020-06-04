<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    //
    protected $table = 'industry';
    
    public function industrylist(){
        $result = Industry::select("*")
                ->where("status",'1')
                ->get();
        return $result;
    }
}
