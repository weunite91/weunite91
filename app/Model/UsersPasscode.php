<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Mail;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Model\SendMail;
use App\Model\Users;


class UsersPasscode extends Model {
    protected $table = 'user_passcode';
    protected $primaryKey = 'user_pasocde_id';

    public function check_passcode($user_id,$pass_code)
    {
        $passcodeResult =UsersPasscode::
                        where('user_passcode.user_id',"=",$user_id)
                        ->where('user_passcode.pass_code',"=",$pass_code)
                        ->where('user_passcode.is_used',"=","N")
                        ->select('*')
                        ->first();
        return $passcodeResult ;

    }
    public function generate_passcode($request,$session) {
        $data = $request->input('data');
        $user_id=$data['id'];
       $this->user_id=$data['id'];
       $this->is_used="N";
       $this->created_by=$session['logindata'][0]['id'];
       $this->pass_code=rand(10000,99999);
        if ($this->save())
        {
            $toemail=array();
           $users_data= DB::table('users')
                        ->where('users.id',"=",$user_id)
                        ->select('*')
                        ->get();
                        $toemail[]=$users_data[0]->email;
                        if ($users_data[0]->weunite_email!='')
                        {
                            $toemail[]=$users_data[0]->weunite_email;
                        }
                    $mailData['data'] = '';
                    $mailData['subject'] = 'We Unite 91 Passcode';
                    $mailData['attachment'] = array();
                    $mailData['template'] = "emails.passcodemail";
                    $mailData['mailto'] =$toemail;
                    $mailData['data'] = [
                                        "firstname" =>$users_data[0]->firstname,
                                        "lastname" => $users_data[0]->lastname,
                                        "pass_code" => $this->pass_code];
                    $sendMail = new Sendmail;
                    $sendMail->sendSMTPMail($mailData);

        }
        return $this;
    }
    public function get_all_users_passcode()
    {
        $result = DB::table('user_passcode')
                ->select('*')
                ->get();
        return $result;
    }

    public function get_user_pass_code($user_data,$userpasscode_result)
    {
        $session = session()->all();
        $login_data=$session['logindata'][0];
        $login_role=$login_data['roles'];

        $user_id=$user_data['id'];
        $user_role=$user_data['roles'];
        $final_result=null;
        if ($user_role !='FR')
        {
            $return_result['passcode']='NA';
            $return_result['passcode_used']='NA';
            return $return_result;
        }
        foreach($userpasscode_result as $rec)
        {
            if ($rec->user_id==$user_id)
            {
                $final_result=$rec;
            }
        }
        if ($final_result==null)
        {
            if ($login_role=='A')
            {
                $return_result['passcode']='<div id="divPasscode'.$user_id .'"><a href="#" data-toggle="modal" data-target="#passcodeModel"
                data-id="' . $user_id . '" class="generate_passcode">
                generate passcode</a></div>';
            }
            else{
                $return_result['passcode']='';
            }
            $return_result['passcode_used']='No';
        }
        else
        {
            $return_result['passcode']=$final_result->pass_code;
            if ($final_result->is_used=='Y')
            {
                $return_result['passcode_used']='Yes';
            }
            else
            {
                $return_result['passcode_used']='No';
            }
        }
        return $return_result;
    }

}
?>
