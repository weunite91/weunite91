<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Mail;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;



class InvoiceItems extends Model {
    protected $table = 'tn_invoice_items';
    protected $primaryKey = 'invoice_items_id';

    function __construct() {
        
    }
   
}
?>