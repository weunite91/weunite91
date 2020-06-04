<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {
    protected $table = 'comments';

    public function commentlist( $id ) {

        $result = Comments::join( 'users', 'users.id', '=', 'comments.add_by' )
        ->where( 'comments.user_id', $id )
        ->select( 'comments.comments', 'comments.created_at', 'comments.add_by', 'users.firstname', 'users.lastname', 'users.roles' )
        ->get();
        return $result;
    }

    public function addcomment( $request, $id, $userId ) {

        $objComment = new Comments();
        $objComment->user_id = $id;
        $objComment->comments = $request->input('message');
        $objComment->add_by = $userId;
        return  $objComment->save();
    
    }
    
}
