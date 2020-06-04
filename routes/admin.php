<?php
$adminPrefix = "";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {

    Route::match(['get', 'post'], 'admin-dashborad', ['as' => 'admin-dashborad', 'uses' => 'backend\AdmindashboradController@dashborad']);

    Route::match(['get', 'post'], 'admin-slider', ['as' => 'admin-slider', 'uses' => 'backend\AdmindashboradController@slider']);
    Route::match(['get', 'post'], 'add-slider', ['as' => 'add-slider', 'uses' => 'backend\AdmindashboradController@addslider']);
    Route::match(['get', 'post'], 'admin-email-image', ['as' => 'admin-email-image', 'uses' => 'backend\AdmindashboradController@emailImages']);
    Route::match(['get', 'post'], 'slider-ajaxAction', ['as' => 'slider-ajaxAction', 'uses' => 'backend\AdmindashboradController@ajaxAction']);

    Route::match(['get', 'post'], 'admin-profile', ['as' => 'admin-profile', 'uses' => 'backend\AdminProfileController@admin_profile']);

    
    Route::match(['get', 'post'], 'change-password', ['as' => 'change-password', 'uses' => 'backend\AdminProfileController@change_password']);


    Route::match(['get', 'post'], 'admin-all-user', ['as' => 'admin-all-user', 'uses' => 'backend\ColduserController@all']);
    Route::match(['get', 'post'], 'admin-cold-user', ['as' => 'admin-cold-user', 'uses' => 'backend\ColduserController@list']);
    Route::match(['get', 'post'], 'admin-cold-user-ajaxAction', ['as' => 'admin-cold-user-ajaxAction', 'uses' => 'backend\ColduserController@ajaxAction']);
    //13/2 active
    Route::match(['get', 'post'], 'all-active-users', ['as' => 'all-active-users', 'uses' => 'backend\ActiveUserController@all']);
    Route::match(['get', 'post'], 'edit-active-user-details/{id}', ['as' => 'edit-active-user-details', 'uses' => 'backend\ActiveUserController@edituserdetails']);
    Route::match(['get', 'post'], 'active-user-details/{id}', ['as' => 'active-user-details', 'uses' => 'backend\ActiveUserController@userdetails']);
    Route::match(['get', 'post'], 'activeuser-ajaxAction', ['as' => 'activeuser-ajaxAction', 'uses' => 'backend\ActiveUserController@ajaxAction']);
    Route::match(['get', 'post'], 'active-fund-raiser', ['as' => 'active-fund-raiser', 'uses' => 'backend\ActiveUserController@fundraiser']);
    Route::match(['get', 'post'], 'active-fund-user-ajaxAction', ['as' => 'active-fund-user-ajaxAction', 'uses' => 'backend\ActiveUserController@ajaxAction']);

    Route::match(['get', 'post'], 'active-investor-admin', ['as' => 'active-investor-admin', 'uses' => 'backend\ActiveUserController@investor']);
    Route::match(['get', 'post'], 'active-partner', ['as' => 'active-partner', 'uses' => 'backend\ActiveUserController@partner']);
    Route::match(['get', 'post'], 'active-admin-franchise', ['as' => 'active-admin-franchise', 'uses' => 'backend\ActiveUserController@franchise']);
    Route::match(['get', 'post'], 'active-investor-user-ajaxAction', ['as' => 'active-investor-user-ajaxAction', 'uses' => 'backend\ActiveUserController@ajaxAction']);

    Route::match(['get', 'post'], 'active-partner-user-ajaxAction', ['as' => 'active-partner-user-ajaxAction', 'uses' => 'backend\ActiveUserController@ajaxAction']);
    Route::match(['get', 'post'], 'active-franchise-user-ajaxAction', ['as' => 'active-franchise-user-ajaxAction', 'uses' => 'backend\ActiveUserController@ajaxAction']);



    Route::match(['get', 'post'], 'all-users', ['as' => 'all-users', 'uses' => 'backend\UserController@all']);
    Route::match(['get', 'post'], 'add-note/{id}', ['as' => 'add-note', 'uses' => 'backend\UserController@addnote']);
    Route::match(['get', 'post'], 'comments-details/{id}', ['as' => 'comments-details', 'uses' => 'backend\UserController@comments']);
    Route::match(['get', 'post'], 'fund-raiser', ['as' => 'fund-raiser', 'uses' => 'backend\UserController@fundraiser']);
    Route::match(['get', 'post'], 'investor-admin', ['as' => 'investor-admin', 'uses' => 'backend\UserController@investor']);
    Route::match(['get', 'post'], 'partner', ['as' => 'partner', 'uses' => 'backend\UserController@partner']);
    Route::match(['get', 'post'], 'admin-franchise', ['as' => 'admin-franchise', 'uses' => 'backend\UserController@franchise']);
    Route::match(['get', 'post'], 'user-ajaxAction', ['as' => 'user-ajaxAction', 'uses' => 'backend\UserController@ajaxAction']);


    Route::match(['get', 'post'], 'user-allocation', ['as' => 'user-allocation', 'uses' => 'backend\UserAllocatioController@userlist']);
    Route::match(['get', 'post'], 'user-allocattion-ajaxAction', ['as' => 'user-allocattion-ajaxAction', 'uses' => 'backend\UserAllocatioController@ajaxAction']);


    Route::match(['get', 'post'], 'cse-allocation', ['as' => 'cse-allocation', 'uses' => 'backend\CseAllocatioController@cselist']);
    Route::match(['get', 'post'], 'cse-allocattion-ajaxAction', ['as' => 'cse-allocattion-ajaxAction', 'uses' => 'backend\CseAllocatioController@ajaxAction']);


    Route::match(['get', 'post'], 'crew-list', ['as' => 'crew-list', 'uses' => 'backend\CrewlistController@crewlist']);
    Route::match(['get', 'post'], 'add-crew', ['as' => 'add-crew', 'uses' => 'backend\CrewlistController@addcrew']);
    Route::match(['get', 'post'], 'edit-crew/{id}', ['as' => 'edit-crew', 'uses' => 'backend\CrewlistController@editcrew']);
    Route::match(['get', 'post'], 'view-crew/{id}', ['as' => 'view-crew', 'uses' => 'backend\CrewlistController@viewcrew']);
    Route::match(['get', 'post'], 'crew-ajaxAction', ['as' => 'crew-ajaxAction', 'uses' => 'backend\CrewlistController@ajaxAction']);

    Route::match(['get', 'post'], 'cso-list', ['as' => 'cso-list', 'uses' => 'backend\CsolistController@csolist']);
    Route::match(['get', 'post'], 'add-cso', ['as' => 'add-cso', 'uses' => 'backend\CsolistController@addcso']);
    Route::match(['get', 'post'], 'edit-cso/{id}', ['as' => 'edit-cso', 'uses' => 'backend\CsolistController@editcso']);
    Route::match(['get', 'post'], 'view-cso/{id}', ['as' => 'view-cso', 'uses' => 'backend\CsolistController@viewcso']);
    Route::match(['get', 'post'], 'cso-ajaxAction', ['as' => 'cso-ajaxAction', 'uses' => 'backend\CsolistController@ajaxAction']);


    Route::match(['get', 'post'], 'staff', ['as' => 'staff', 'uses' => 'backend\StaffController@stafflist']);
    Route::match(['get', 'post'], 'staff-admin-ajaxAction', ['as' => 'staff-admin-ajaxAction', 'uses' => 'backend\StaffController@ajaxAction']);
    Route::match(['get', 'post'], 'add-staff', ['as' => 'add-staff', 'uses' => 'backend\StaffController@addstaff']);
    Route::match(['get', 'post'], 'edit-staff/{id}', ['as' => 'edit-staff', 'uses' => 'backend\StaffController@editstaff']);

    Route::match(['get', 'post'], 'inactive-list', ['as' => 'inactive-list', 'uses' => 'backend\UserController@inactive_users_list']);
    Route::match(['get', 'post'], 'inactive-request-ajaxAction', ['as' => 'inactive-request-ajaxAction', 'uses' => 'backend\UserController@ajaxAction']);

    Route::match(['get', 'post'], 'verify-address-list', ['as' => 'verify-address-list', 'uses' => 'backend\UserController@verify_address_users_list']);
    Route::match(['get', 'post'], 'verify-address-ajaxAction', ['as' => 'verify-address-ajaxAction', 'uses' => 'backend\UserController@ajaxAction']);

    Route::match(['get', 'post'], 'pendding-address-list', ['as' => 'pendding-address-list', 'uses' => 'backend\UserController@pendding_address_users_list']);
    Route::match(['get', 'post'], 'pendding-address-ajaxAction', ['as' => 'pendding-address-ajaxAction', 'uses' => 'backend\UserController@ajaxAction']);


    Route::match(['get', 'post'], 'email-verify', ['as' => 'email-verify', 'uses' => 'backend\EmailverifyController@index']);
    Route::match(['get', 'post'], 'email-verify-ajaxAction', ['as' => 'email-verify-ajaxAction', 'uses' => 'backend\EmailverifyController@ajaxAction']);


    Route::match(['get', 'post'], 'delete-request', ['as' => 'delete-request', 'uses' => 'backend\DeleterequestController@deletelist']);
    Route::match(['get', 'post'], 'delete-request-ajaxAction', ['as' => 'delete-request-ajaxAction', 'uses' => 'backend\DeleterequestController@ajaxAction']);

    Route::match(['get', 'post'], 'user-details/{id}', ['as' => 'user-details', 'uses' => 'backend\UserController@userdetails']);
    Route::match(['get', 'post'], 'edit-user-details/{id}', ['as' => 'edit-user-details', 'uses' => 'backend\UserController@edituserdetails']);

    Route::match(['get', 'post'], 'edit-fund-detail/{id}', ['as' => 'edit-fund-detail', 'uses' => 'backend\UserController@editFundDetailAdmin']);

    Route::match(['get', 'post'], 'edit-fund-payment/{id}', ['as' => 'edit-fund-payment', 'uses' => 'backend\UserController@editFundPaymentAdmin']);

    Route::match(['get', 'post'], 'submit-investor-edit-admin/{id}', ['as' => 'submit-investor-edit-admin', 'uses' => 'backend\UserController@updateInvestorByadmin']);

    Route::match(['get', 'post'], 'edit-franchise-detail/{id}', ['as' => 'edit-franchise-detail', 'uses' => 'backend\UserController@updateFranchiseByadmin']);

    Route::match(['get', 'post'], 'edit-partner-detail/{id}', ['as' => 'edit-partner-detail', 'uses' => 'backend\UserController@updatePartnerByadmin']);

    Route::match(['get', 'post'], 'investoredit-admin-ajaxAction', ['as' => 'investoredit-admin-ajaxAction', 'uses' => 'frontend\dashborad\InvestorController@ajaxAction']);

    Route::match(['get', 'post'], 'peoposal', ['as' => 'peoposal', 'uses' => 'backend\peoposal\PeoposalController@index']);
    Route::match(['get', 'post'], 'view-proposal/{id}', ['as' => 'view-proposal', 'uses' => 'backend\peoposal\PeoposalController@viewproposal']);
    Route::match(['get', 'post'], 'edit-proposal/{id}', ['as' => 'edit-proposal', 'uses' => 'backend\peoposal\PeoposalController@editproposal']);
    Route::match(['get', 'post'], 'proposal-ajaxAction', ['as' => 'proposal-ajaxAction', 'uses' => 'backend\peoposal\PeoposalController@ajaxAction']);

    Route::match(['get', 'post'], 'revokeoffers', ['as' => 'revokeoffers', 'uses' => 'backend\UserController@revokeOffers']);
    Route::match(['get', 'post'], 'add-revoke-note/{id}', ['as' => 'add-revoke-note', 'uses' => 'backend\UserController@addRevokeNote']);
    Route::match(['get', 'post'], 'view-rewoke/{id}', ['as' => 'view-rewoke', 'uses' => 'backend\UserController@viewrewoke']);
    Route::match(['get', 'post'], 'revoke-ajaxAction', ['as' => 'revoke-ajaxAction', 'uses' => 'backend\UserController@ajaxAction']);

    Route::match(['get', 'post'], 'pending-approval', ['as' => 'pending-approval', 'uses' => 'backend\PendingApprovalController@all']);
    Route::match(['get', 'post'], 'fund-raiser-pending-approval', ['as' => 'fund-raiser-pending-approval', 'uses' => 'backend\PendingApprovalController@fundraiser']);
    Route::match(['get', 'post'], 'investor-pending-approval', ['as' => 'investor-pending-approval', 'uses' => 'backend\PendingApprovalController@investor']);
    Route::match(['get', 'post'], 'partner-pending-approval', ['as' => 'partner-pending-approval', 'uses' => 'backend\PendingApprovalController@partner']);
    Route::match(['get', 'post'], 'franchise-pending-approval', ['as' => 'franchise-pending-approval', 'uses' => 'backend\PendingApprovalController@franchise']);
    Route::match(['get', 'post'], 'pending-ajaxAction', ['as' => 'pending-ajaxAction', 'uses' => 'backend\PendingApprovalController@ajaxAction']);

    Route::match(['get', 'post'], 'approvedrevoke', ['as' => 'approvedrevoke', 'uses' => 'backend\UserController@approvedRevoke']);
    Route::match(['get', 'post'], 'allpayment', ['as' => 'allpayment', 'uses' => 'backend\AllpaymentController@allpayment']);
    Route::match(['get', 'post'], 'allpayment-ajaxAction', ['as' => 'revoke-ajaxAction', 'uses' => 'backend\AllpaymentController@ajaxAction']);

    Route::match(['get', 'post'], 'supportrequest', ['as' => 'supportrequest', 'uses' => 'backend\SupportController@supportRequest']);
    Route::match(['get', 'post'], 'support-ajaxAction', ['as' => 'support-ajaxAction', 'uses' => 'backend\SupportController@ajaxAction']);

    Route::match(['get', 'post'], 'gladassist', ['as' => 'gladassist', 'uses' => 'backend\GladassistController@requestlist']);
    Route::match(['get', 'post'], 'gladassist-ajaxAction', ['as' => 'gladassist-ajaxAction', 'uses' => 'backend\GladassistController@ajaxAction']);

    Route::match(['get', 'post'], 'kpisupportrequest', ['as' => 'kpisupportrequest', 'uses' => 'backend\KPISupportControl@kpisupportRequest']);
    Route::match(['get', 'post'], 'kpisupport-ajaxAction', ['as' => 'kpisupport-ajaxAction', 'uses' => 'backend\KPISupportControl@ajaxAction']);

    Route::match(['get', 'post'], 'my-note', ['as' => 'my-note', 'uses' => 'backend\MynoteController@note']);
    Route::match(['get', 'post'], 'my-note-ajaxAction', ['as' => 'my-note-ajaxAction', 'uses' => 'backend\MynoteController@ajaxAction']);
});
