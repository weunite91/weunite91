<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Designation;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use App\Model\Industry;
use App\Model\Fundraiserdetails;
use App\Model\Fund_payment_details;
use App\Model\FranchiseDeatils;
use App\Model\Partnerdetails;
use App\Model\SupportModel;
use APP\Services\CpanelXMLAPI;


class GenerateEmailController extends Controller
{
    public function emailapi()
    {
      

       

        $ip = '107.180.44.223'; // Need to Change.

$account = "cz6e2b23ikew"; // Need to Change.

$domain = "weunite91.com"; // Need to Change.

$account_pass = "Nagesh@1234"; // Need to Change.

 

$xmlapi = new \App\Services\CpanelXMLAPI($ip);

$xmlapi->password_auth($account, $account_pass);

$xmlapi->set_output('json');

$xmlapi->set_port('2083'); // Need to Change.

$xmlapi->set_debug(1);

$new_email="liveweaptest123";

$results = json_decode($xmlapi->api2_query($account, "Email", "addpop", 
array('domain' => $domain, 'email' => $new_email, 
'password' => 'pw_whatyouwant', 'quota' => '200')), true);

if($results['cpanelresult']['data'][0]['result']){

    echo "success";

} else {

    echo "Error creating email account:\n".$results['cpanelresult']['data'][0]['reason'];

}
 
           



            
    }

    function emailsocket()
    {
        $cpdomain="a2plcpnl0270.prod.iad2.secureserver.net";

        $cpuser = "cz6e2b23ikew";
        $cpassword = "Nagesh@1234";
        $cpskin='x3';
       
        $euser = "abc123";
        $epass = "12345678";
        $edomain='weunite91.com';
        $equota=20;

        $socket = fsockopen($cpdomain,2083);
       
        $authstr = base64_encode("".$cpuser.":".$cpassword."");
        $in = "GET /frontend/$cpskin/mail/doaddpop.html?email=$euser&$edomain&password=$epass&quota=$equota
        HTTP/1.0\r\nAuthorization: Basic $authstr \r\n";
        fputs($socket,$in);
        fclose( $socket );
    }

}
?>