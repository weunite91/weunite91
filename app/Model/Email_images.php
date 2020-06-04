<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use File;
class Email_images extends Model
{
    //
    protected $table = 'email_images';

    public function emailImages($request,$userid) {
      
        if($request->file()){

            $existImage = public_path('/upload/emailImages/').$request['oldfile'];
            if (File::exists($existImage)) { // unlink or remove previous company image from folder
                File::delete($existImage);
            }
           
            $objEmail_images = Email_images::find(1);
            $image = $request->file('add_email_image');
            $name = 'emailimage.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/emailImages/');   
            $image->move($destinationPath, $name);             
            $objEmail_images->imagename = $name;
            $objEmail_images->addedby = $userid;
            $objEmail_images->created_at = date("Y-m-d h:i:s");
            $objEmail_images->updated_at = date("Y-m-d h:i:s");
            return $objEmail_images->save();
        }else{
            return false;
        }
    }

    public function get_emailImages(){
        return Email_images::join("users","users.id","=","email_images.addedby")
                    ->where("email_images.id",1)
                    ->select("email_images.imagename","users.firstname","users.lastname")
                    ->get();
    }

}
