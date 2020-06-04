<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use Config;
use Illuminate\Support\Facades\DB;
use Mail;
class SendMail extends Model
{
   public function sendMailltesting(){
        
        $mailData['data']='';
        $mailData['subject'] = 'SENd MAill Testing';
        $mailData['attachment'] = array();
        $mailData['template'] ="emails.testnew";
        $mailData['mailto'] = 'parthkhunt12@gmail.com';
        $sendMail = new Sendmail;
        return $sendMail->sendSMTPMail($mailData);
        
    }
    
    public function sendSMTPMail($mailData)
  {
     
            $pathToFile = $mailData['attachment'];
            $frommail = "noreplay@weunite91.com";
           
            $mailsend = Mail::send($mailData['template'], ['data' => $mailData['data']], 
                    function ($m) use ($mailData,$pathToFile,$frommail) {
                 $m->from($frommail, 'Weunite91 Systeam');
      
                 $m->to($mailData['mailto'], "Weunite91 Systeam")->subject($mailData['subject']);
                 if($pathToFile != ""){
                     // $m->attach($pathToFile);
                 }
                 
                //  $m->cc($mailData['bcc']);
             });
             if($mailsend){
                 return true;
             }else{
                 return false;
             }
  }
}
