<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fund_Raiser_viewd_Profile extends Model
{
    //
     protected $table = 'fund_raiser_view_profile';
    function __construct() {
        
    }
    
    public function checkdetails($loginid,$pitchid){
        $count = Fund_Raiser_viewd_Profile::where("user_id",$loginid)
                                        ->where("pitchid",$pitchid)
                                        ->count();
        if($count == 0){
            
            $objfrvp = new Fund_Raiser_viewd_Profile();
            $objfrvp->user_id = $loginid;
            $objfrvp->pitchid = $pitchid;
            $objfrvp->created_at = date("Y-m-d h:s:i");
            $objfrvp->updated_at = date("Y-m-d h:s:i");
            $objfrvp->save();
            
            return "added";
        }else{
             return "viewed";
        }
    }
    
    
}
