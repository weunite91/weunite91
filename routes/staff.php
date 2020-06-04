<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$adminPrefix = "";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['staff']], function() {
    Route::match(['get', 'post'], 'staff-dashborad', ['as' => 'staff-dashborad', 'uses' => 'backend\StaffmainController@dashborad']);

    Route::match(['get', 'post'], 'staff-slider', ['as' => 'staff-slider', 'uses' => 'backend\staff\SliderController@slider']);
    Route::match(['get', 'post'], 'add-staff-slider', ['as' => 'add-staff-slider', 'uses' => 'backend\staff\SliderController@addslider']);
    Route::match(['get', 'post'], 'staff-email-images', ['as' => 'staff-email-images', 'uses' => 'backend\staff\SliderController@emailImages']);
    Route::match(['get', 'post'], 'slider-staff-ajaxAction', ['as' => 'slider-staff-ajaxAction', 'uses' => 'backend\staff\SliderController@ajaxAction']);

    Route::match(['get', 'post'], 'pending-profile', ['as' => 'pending-profile', 'uses' => 'backend\StaffmainController@pendingprofile']);
    Route::match(['get', 'post'], 'staff-ajaxAction', ['as' => 'staff-ajaxAction', 'uses' => 'backend\StaffmainController@ajaxAction']);

    Route::match(['get', 'post'], 'pending-approval-staff', ['as' => 'pending-approval-staff', 'uses' => 'backend\StaffmainController@pendingapprovalstaff']);

    Route::match(['get', 'post'], 'user-details-staff/{id}', ['as' => 'user-details-staff', 'uses' => 'backend\StaffmainController@userdetails']);
    Route::match(['get', 'post'], 'edit-user-details-staff/{id}', ['as' => 'edit-user-details-staff', 'uses' => 'backend\StaffmainController@edituserdetails']);
    Route::match(['get', 'post'], 'submit-investor-edit-staff/{id}', ['as' => 'submit-investor-edit-staff', 'uses' => 'backend\StaffmainController@updateInvestorByadmin']);

    Route::match(['get', 'post'], 'edit-fund-detail-staff/{id}', ['as' => 'edit-fund-detail-staff', 'uses' => 'backend\StaffmainController@editFundDetailAdmin']);

    Route::match(['get', 'post'], 'edit-fund-payment-staff/{id}', ['as' => 'edit-fund-payment-staff', 'uses' => 'backend\StaffmainController@editFundPaymentAdmin']);

    Route::match(['get', 'post'], 'edit-franchise-detail-staff/{id}', ['as' => 'edit-franchise-detail-staff', 'uses' => 'backend\StaffmainController@updateFranchiseByadmin']);

    Route::match(['get', 'post'], 'edit-partner-detail-staff/{id}', ['as' => 'edit-partner-detail-staff', 'uses' => 'backend\StaffmainController@updatePartnerByadmin']);

    Route::match(['get', 'post'], 'add-note-staff/{id}', ['as' => 'add-note-staff', 'uses' => 'backend\StaffmainController@addnote']);

    Route::match(['get', 'post'], 'investoredit-staff-ajaxAction', ['as' => 'investoredit-staff-ajaxAction', 'uses' => 'backend\StaffmainController@ajaxAction']);


    Route::match(['get', 'post'], 'comments-details-staff/{id}', ['as' => 'comments-details-staff', 'uses' => 'backend\StaffmainController@comments']);
    // comments-details-staff
});


