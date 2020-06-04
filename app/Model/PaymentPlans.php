<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class PaymentPlans extends Model {

    //
    protected $table = 'payment_plans';

    public function get_payment_list($user_type,$plan_id) {

        $query = DB::table('payment_plans')
                ->where('payment_plans.user_type', $user_type);
        if ($plan_id!='all')
        {
            $query->where('payment_plans.plan_id', $plan_id);
        }
        $query->orderBy('plan_type')
                ->orderBy('plan_duration');
        $result= $query->select('*')
                ->get();
        return $result;
    }

  
}
