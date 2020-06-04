<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Mail;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\InvoiceItems;

class ViewContacts extends Model {

    protected $table = 'contact_view_requests';
    protected $primaryKey = 'contact_view_requests_id';

    public function save_view_contacts_request($session,$txnid,$pitchid,$amount)
    {
        $role=$session['logindata'][0]['roles'];
        $from_user_id=$session['logindata'][0]['id'];
        $sender_profile_code=$session['logindata'][0]['profile_code'];
        $objUser=new Users();
        if ($role=='I')
        {
            $getbusinessuserdetails= $objUser->getviewuserdetails($pitchid);
            $to_user_id=$pitchid;
        }
        else{
            $getbusinessuserdetails=$objUser->investor_userId($pitchid);
            $to_user_id=$getbusinessuserdetails[0]->id;
        }
        $receiver_profile_code= $getbusinessuserdetails[0]->profile_code;

        $this->from_profile_code=$sender_profile_code;
        $this->from_user_id= $from_user_id;

        $this->to_profile_code=$receiver_profile_code;
        $this->to_user_id= $to_user_id;
        $this->txn_no=$txnid;
        $this->amount=$amount;
        $this->created_by=$from_user_id;
        $this->modified_by=$from_user_id;
        $result=$this->save();
        return   $result;
        
    }
    function get_contact_details($from_profile_code,$to_profile_code)
    {
        $result = DB::table('contact_view_requests')
                ->join('users' ,"users.profile_code","=","contact_view_requests.to_profile_code")
                ->where('contact_view_requests.from_profile_code','=',$from_profile_code)
                ->where('contact_view_requests.to_profile_code','=',$to_profile_code)
                ->select('users.email','users.number','users.firstname')
                ->get();
        return $result;
    }
}