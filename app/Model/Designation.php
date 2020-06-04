<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
   protected $table = 'designation';
       
       public function designationlist(){
           
           $result = Designation::select("*")
                   ->get();
           
           return $result;
       }

   	public function getDesignations(){
        $result =  Designation::select("*")
                   ->get();
        // $result = $result->toArray();
        $f_arr=array();
        foreach ($result->toArray() as $key => $value) {
            $f_arr[$result[$key]->de_id]=$result[$key]->de_designation;
            
        }
        return $f_arr;
    }
}
