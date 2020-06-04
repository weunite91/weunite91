<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Fundraisercompanydetail;
class Fund_raiser_image extends Model
{
    //
     protected $table = 'fund_raiser_image';

     public function deleteImageEditFr($data){
        $path = public_path('/upload/company_details/').$data['product_image'] ;
        if(file_exists ($path)){
            unlink($path);
        }
        $result = Fund_raiser_image::where('id',$data['imageid'])->delete();
        return $result;
    }
     
    
    public function deleteVideoEditFr($data){
       
        $path = public_path('/upload/video/').$data['video'] ;
        if(file_exists ($path)){
            unlink($path);
        }
        
        $objFundraisercompanydetail = Fundraisercompanydetail::find($data['id']);
        $objFundraisercompanydetail->video = null;
        return $objFundraisercompanydetail->save();

    }
}
