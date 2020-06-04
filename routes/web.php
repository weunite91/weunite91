
<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
// Front End route
//Route::get('/', 'frontend\HomeController@homepage');
Route::match(['get', 'post'], '/', ['as' => 'home', 'uses' => 'frontend\HomeController@homepage']);
Route::match(['get', 'post'], 'glad-to-assist', ['as' => 'glad-to-assist', 'uses' => 'frontend\SupportController@gladeToAssist']);
Route::match(['get', 'post'], 'supporting-hand', ['as' => 'supporting-hand', 'uses' => 'frontend\SupportController@supportinghand']);

Route::match(['get', 'post'], 'pitch-detail/{id}', ['as' => 'pitch-detail', 'uses' => 'frontend\HomeController@pitchDetail']);


Route::match(['get', 'post'], 'fundriser_offered/{id}/{pitchid}', ['as' => 'fundriser_offered', 'uses' => 'frontend\HomeController@paynow']);
Route::match(['get', 'post'], 'fundriser_offered_fav_pitch/{id}/{pitchid}', ['as' => 'fundriser_offered_fav_pitch', 'uses' => 'frontend\HomeController@paynowFromFavPitch']);


Route::match(['get', 'post'], 'developertesting', ['as' => 'developertesting', 'uses' => 'frontend\LoginController@developertesting']);
Route::match(['get', 'post'], 'create-admin', ['as' => 'create-admin', 'uses' => 'frontend\LoginController@createadmin']);
Route::match(['get', 'post'], 'create-staff', ['as' => 'create-staff', 'uses' => 'frontend\LoginController@createstaff']);


Route::match(['get', 'post'], 'contact-business/{id}', ['as' => 'contact-business', 'uses' => 'frontend\HomeController@sendproposal']);
Route::match(['get', 'post'], 'contactpayment/{id}', ['as' => 'contactpayment', 'uses' => 'frontend\HomeController@contactpayment']);
Route::match(['get', 'post'], 'contact_payment', ['as' => 'contact_payment', 'uses' => 'frontend\HomeController@contact_payment']);

Route::match(['get', 'post'], 'home-ajaxAction', ['as' => 'home-ajaxAction', 'uses' => 'frontend\HomeController@ajaxAction']);

Route::match(['get', 'post'], 'favourite_pitch/{id}', ['as' => 'favourite_pitch', 'uses' => 'frontend\HomeController@favourite_pitch']);

Route::match(['get', 'post'], 'testingmail', ['as' => 'testingmail', 'uses' => 'frontend\LoginController@testingmail']);

Route::match(['get', 'post'], 'raising-finance', ['as' => 'raising-finance', 'uses' => 'frontend\RaisingfinanceController@raisingfinance']);

Route::match(['get', 'post'], 'raising-finance-active', ['as' => 'raising-finance-active', 'uses' => 'frontend\RaisingfinanceController@raisingfinance_active']);


Route::match(['get', 'post'], 'super-access', ['as' => 'super-access', 'uses' => 'frontend\SuperaccessController@login']);
Route::match(['get', 'post'], 'login', ['as' => 'login', 'uses' => 'frontend\LoginController@login']);

Route::match(['get', 'post'], 'forgot-password', ['as' => 'forgot-password', 'uses' => 'frontend\LoginController@forgotpassword']);
Route::match(['get', 'post'], 'resetpassword/{token}', ['as' => 'resetpassword', 'uses' => 'frontend\LoginController@resetpassword']);
Route::match(['get', 'post'], 'login-verfy/{email}', ['as' => 'login-verfy', 'uses' => 'frontend\LoginController@loginverfy']);
Route::match(['get', 'post'], 'logout', ['as' => 'logout', 'uses' => 'frontend\LoginController@logout']);
Route::match(['get', 'post'], 'add-user', ['as' => 'add-user', 'uses' => 'frontend\LoginController@adduser']);
Route::match(['get', 'post'], 'verify/{id}', ['as' => 'verify', 'uses' => 'frontend\LoginController@verify']);
Route::match(['get', 'post'], 'login-ajaxAction', ['as' => 'login-ajaxAction', 'uses' => 'frontend\LoginController@ajaxAction']);


Route::match(['get', 'post'], 'investor', ['as' => 'investor', 'uses' => 'frontend\InvestorController@investor']);

Route::match(['get', 'post'], 'howto-invest', ['as' => 'howto-invest', 'uses' => 'frontend\HowController@invest']);
Route::match(['get', 'post'], 'howto-sell-your-bussiness', ['as' => 'howto-sell-your-bussiness', 'uses' => 'frontend\HowController@sellyourbussiness']);
Route::match(['get', 'post'], 'howto-franchise', ['as' => 'howto-franchise', 'uses' => 'frontend\HowController@franchise']);
Route::match(['get', 'post'], 'howto-partner', ['as' => 'howto-partner', 'uses' => 'frontend\HowController@partner']);

Route::match(['get', 'post'], 'terms-and-conditions', ['as' => 'terms-and-conditions', 'uses' => 'frontend\footer\FooterpagesController@terms']);
Route::match(['get', 'post'], 'privacy-policy', ['as' => 'privacy-policy', 'uses' => 'frontend\footer\FooterpagesController@privacy']);
Route::match(['get', 'post'], 'refund-policy', ['as' => 'refund-policy', 'uses' => 'frontend\footer\FooterpagesController@refund']);

Route::match(['get', 'post'], 'about-us', ['as' => 'about-us', 'uses' => 'frontend\footer\FooterpagesController@aboutus']);
Route::match(['get', 'post'], 'contact-us', ['as' => 'contact-us', 'uses' => 'frontend\footer\FooterpagesController@contactus']);



// Admin Route
Route::match(['get', 'post'], 'admin', ['as' => 'admin', 'uses' => 'backend\LoginController@login']);
Route::match(['get', 'post'], 'admin-forgot-password', ['as' => 'admin-forgot-password', 'uses' => 'backend\LoginController@forgotpassword']);
Route::match(['get', 'post'], 'adminresetpassword/{token}', ['as' => 'adminresetpassword', 'uses' => 'backend\LoginController@adminresetpassword']);
Route::match(['get', 'post'], 'createpassword', ['as' => 'createpassword', 'uses' => 'backend\LoginController@createpassword']);


Route::match(['get', 'post'], 'investor-changemail', ['as' => 'investor-changemail', 'uses' => 'backend\LoginController@investorchangemail']);

Route::match(['get', 'post'], 'admin-logout', ['as' => 'admin-logout', 'uses' => 'backend\LoginController@logout']);


Route::match(['get', 'post'], 'editprofilepic', ['as' => 'editprofilepic', 'uses' => 'frontend\dashborad\FundraiserController@editprofilepic']);
Route::match(['get', 'post'], 'partners', ['as' => 'partners', 'uses' => 'frontend\dashborad\PartnersController@dashborad']);
Route::match(['get', 'post'], 'partner-ajaxAction', ['as' => 'partner-ajaxAction', 'uses' => 'frontend\dashborad\PartnersController@ajaxAction']);

//Fund Raiser
$adminPrefix = "";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['fundraiser']], function() {
//    fund-raiser
    Route::match(['get', 'post'], 'fund-raiser-dashborad', ['as' => 'fund-raiser-dashborad', 'uses' => 'frontend\dashborad\FundraiserController@dashborad']);

    Route::match(['get', 'post'], 'fund-details', ['as' => 'fund-details', 'uses' => 'frontend\dashborad\FundraiserController@funddetails']);
    Route::match(['get', 'post'], 'kpi-update', ['as' => 'kpi-update', 'uses' => 'frontend\dashborad\FundraiserController@financialkpiupdate']);
    Route::match(['get', 'post'], 'kpi-help', ['as' => 'kpi-help', 'uses' => 'frontend\dashborad\FundraiserController@kpihelp']);
    Route::match(['get', 'post'], 'upload-video', ['as' => 'upload-video', 'uses' => 'frontend\dashborad\FundraiserController@uploadvideo']);
    Route::match(['get', 'post'], 'planlist', ['as' => 'planlist', 'uses' => 'frontend\dashborad\FundraiserController@planlist']);
    Route::match(['get', 'post'], 'paymentstatus-status', ['as' => 'payment-status', 'uses' => 'frontend\dashborad\FundraiserController@paymentstatus']);
    Route::match(['get', 'post'], 'payment/{id}', ['as' => 'payment', 'uses' => 'frontend\dashborad\FundraiserController@payment']);
    Route::match(['get', 'post'], 'fundraiser-ajaxAction', ['as' => 'fundraiser-ajaxAction', 'uses' => 'frontend\dashborad\FundraiserController@ajaxAction']);
    Route::match(['get', 'post'], 'support-email', ['as' => 'support-email', 'uses' => 'frontend\dashborad\FundraiserController@supportemail']);
    Route::match(['get', 'post'], 'confirm-verify-details', ['as' => 'confirm-verify-details', 'uses' => 'frontend\dashborad\FundraiserController@confirm_verify_details']);
});
Route::match(['post'], 'apply-passcode', ['as' => 'apply-passcode', 'uses' => 'frontend\dashborad\FundraiserController@applypasscode']);


$adminPrefix = "";
Route::match(['get', 'post'], 'investorpitch-detail/{id}', ['as' => 'investorpitch-detail', 'uses' => 'frontend\InvestorController@investorpitchDetail']);

Route::match(['get', 'post'], 'send-proposal/{id}', ['as' => 'send-proposal', 'uses' => 'frontend\InvestorController@sendproposal']);


Route::group(['prefix' => $adminPrefix, 'middleware' => ['investor']], function() {
    Route::match(['get', 'post'], 'investor-dashboard', ['as' => 'investor-dashboard', 'uses' => 'frontend\dashborad\InvestorController@dashborad']);

    Route::match(['get', 'post'], 'investor-ajaxAction', ['as' => 'investor-ajaxAction', 'uses' => 'frontend\dashborad\InvestorController@ajaxAction']);

});

$franchisePrefix = "";
Route::group(['prefix' => $franchisePrefix, 'middleware' => ['franchise']], function()     {
    Route::match(['get', 'post'], 'franchise', ['as' => 'franchise', 'uses' => 'frontend\dashborad\FranchiseController@dashborad']);
    Route::match(['get', 'post'], 'franchise-details', ['as' => 'franchise-details', 'uses' => 'frontend\dashborad\FranchiseController@franchisedetails']);
    Route::match(['get', 'post'], 'franchise-planlist', ['as' => 'franchise-planlist', 'uses' => 'frontend\dashborad\FranchiseController@franchiseplanlist']);
    Route::match(['get', 'post'], 'franchise-payment/{id}', ['as' => 'franchise-payment', 'uses' => 'frontend\dashborad\FranchiseController@frnachisepayment']);
    Route::match(['get', 'post'], 'franchise-ajaxAction', ['as' => 'franchise-ajaxAction', 'uses' => 'frontend\dashborad\FranchiseController@ajaxAction']);
    Route::match(['get', 'post'], 'support-email-franchise', ['as' => 'support-email', 'uses' => 'frontend\dashborad\FranchiseController@supportemail']);

});

Route::match(['get', 'post'], 'payu-cancel/{pitchid}', ['as' => 'payu-cancel',    'uses' => 'frontend\HomeController@Payu_Failed']);

Route::match(['get', 'post'], 'payu-response/{pitchid}', ['as' => 'payu-response',    'uses' => 'frontend\HomeController@Payu_Response']);

Route::match(['get', 'post'], 'get-invoice/{txnid}', ['as' => 'get-invoice',    'uses' => 'frontend\HomeController@save_invoice']);

Route::match(['get', 'post'], 'view-invester-reciept/{txnid}', ['as' => 'view-invester-reciept', 'uses' => 'frontend\PDFController@viewinveseterreciept']);
Route::match(['get', 'post'], 'generate-invoice/{txnid}', ['as' => 'generate-invoice', 'uses' => 'frontend\dashborad\FundraiserController@generateInvoice']);
Route::match(['get', 'post'], 'view-invoice/{txnid}', ['as' => 'view-invoice', 'uses' => 'frontend\PDFController@view_invoice']);
Route::match(['get', 'post'], 'get-notifications', ['as' => 'get-notifications', 'uses' => 'frontend\HomeController@getnotifications']);
Route::match(['get', 'post'], 'get-all-proposal-list/{profilecode}', ['as' => 'get-all-proposal-list', 'uses' => 'frontend\HomeController@get_all_proposals']);
Route::match(['get', 'post'], 'get-proposal-history/{profilecode}', ['as' => 'get-proposal-history', 'uses' => 'frontend\HomeController@get_proposal_history']);
Route::match(['get', 'post'], 'reply-proposal', ['as' => 'reply-proposal', 'uses' => 'frontend\HomeController@reply_proposal']);

Route::match(['get', 'post'], 'get-status-history/{id}', ['as' => 'get-status-history', 'uses' => 'backend\UserController@user_status_history']);


Route::get('/sendotp', function(){
    $data['data']=array('firstname'=>'hh','lastname' =>'ll','otp'=>'123456');
    return view('emails.sendotp', $data);
 });
 Route::get('/welcomekit', function(){
    $data['data']=array('firstname'=>'hh','lastname' =>'ll',
    'weunite91mail'=>'a@weunite91.com',
     'weunite91mail_pwd'=>'abcdef');
    return view('emails.weuniteemail', $data);
 });
 Route::get('/registermail', function(){
    $data['data']=array('firstname'=>'hh','lastname' =>'ll','otp'=>'123456');
    return view('emails.profi leupdate', $data);
 });
