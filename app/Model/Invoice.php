<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Mail;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\InvoiceItems;
class Invoice extends Model {
    protected $table = 'tn_invoice';
    protected $primaryKey = 'invoice_id';

    function __construct() {
    }

    public function invoiceitems()
    {
        return $this->hasMany('App\Model\InvoiceItems','invoice_id', 'invoice_id');
    }

    function get_current_financial_year()
    {
        $today_dt=date('Y-m-d');
        DB::enableQueryLog();
        $result = DB::table('invoice_financial_years')
                    ->whereRaw('? between from_dt and to_dt', [ $today_dt])
                   
                    ->select("*")
                    ->get();
        $query = DB::getQueryLog();
        if (count($result) >0)
        {
           return  $result[0]->invoice_financial_years_id;
        }
        return 0;
    }
    function generate_invoice_no( $fy_id)
    {
        $result = DB::table('tn_invoice')
                    ->where("invoice_financial_years_id" ,"=",$fy_id)
                    ->orderby("invoice_id","desc")
                    ->take(1)
                    ->select("invoice_no")
                    ->get();
        $main_inv_prefix='I'.date('y').date('m').'/';
        if (count( $result )==0)
        {
            $inv_no=$main_inv_prefix."1"; 
        }
        else{
            $invoice_no_parts=explode("/",$result[0]->invoice_no);
            if (count($invoice_no_parts)==2)
            {
                $lastinvno=(int)$invoice_no_parts[1];
                $inv_no=$main_inv_prefix.($lastinvno+1);
            }
        }
       
        return $inv_no;

    }
    function save_invoice($objInvoiceItems)
    {
        $fy_id=$this->get_current_financial_year();
        $this->invoice_financial_years_id= $fy_id;
        $this->invoice_no= $this->generate_invoice_no( $fy_id);
        try {
                DB::beginTransaction();
                $this->save();
                $this->invoiceitems()->save($objInvoiceItems);
                DB::commit();
            } 
            catch (Exception $e) 
            {
                DB::rollback();
            }
    }

    function get_invoice($txn_no,$user_id)
    {
        $result = DB::table('tn_invoice')
                    ->join('tn_invoice_items',"tn_invoice_items.invoice_id","=", "tn_invoice.invoice_id")
                    ->where('tn_invoice.txn_no',"=",$txn_no)
                    ->where('tn_invoice.customer_id',"=",$user_id)
                    ->select("*")
                    ->get();
        return $result;
    }

    public function get_gst_details($g_table_name,$user_id)
    {
        $result = DB::table($g_table_name)
                    ->where('user_id', $user_id)
                    ->select("*")
                    ->get();
       return $result;
    }

}

?>