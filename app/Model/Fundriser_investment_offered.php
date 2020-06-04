<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fundriser_investment_offered extends Model
{
    protected $table = 'fundriser_investment_offered';
       
       function __construct() {
           
       }
       
       public function gettotalmount($pitchid){
            $result = Fundriser_investment_offered::where('pitch_id',$pitchid)
                    ->sum('ammount');
            return $result;
       }
       
       public function totalinvestor($pitchid){
            $result = Fundriser_investment_offered::where('pitch_id',$pitchid)
                    ->count();
            
            return $result;
       }
}
