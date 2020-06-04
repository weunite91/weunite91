<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Mynote extends Model
{
    protected $table = "mynotes";
    //
    function __construct()
    {

    }

    public function notelist($id){
        return Mynote::join("users","users.id","=" , "mynotes.user_id")
                    ->where("mynotes.user_id",$id)
                    ->select("mynotes.*","users.lastname","users.firstname", "mynotes.id as noteId" ,"users.roles" )
                    ->get();
    }

    public function addnote($request , $userId){
        $objMynote = new Mynote();
        $objMynote->user_id = $userId;
        $objMynote->note = $request->input('message');
        $objMynote->updated_at = date("Y-m-d h:i:s");
        $objMynote->created_at = date("Y-m-d h:i:s");
        return  $objMynote->save();
    }

    public function deleterequest($data){
        $result = DB::table('mynotes')
                    ->where('mynotes.id', "=", $data['id'])
                    ->delete();
        return $result;
    }
}
