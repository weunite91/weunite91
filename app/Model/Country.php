<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
       protected $table = 'countries';
       
       public function countrylist(){
           
           $result = Country::select("*")
                   ->orderBy('phonecode', 'ASC')
                   ->get();
           return $result;
       }
       
       public function countryname(){
           
           $result = Country::select("*")
                   ->orderBy('name', 'ASC')
                   ->get();
           return $result;
       }
}
