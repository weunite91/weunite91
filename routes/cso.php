<?php

$adminPrefix = "";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['cso']], function() {
    Route::match(['get', 'post'], 'cso-dashborad', ['as' => 'cso-dashborad', 'uses' => 'backend\cso\CsoController@dashborad']);


    Route::match(['get', 'post'], 'cso-slider', ['as' => 'cso-slider', 'uses' => 'backend\cso\SliderController@slider']);
    Route::match(['get', 'post'], 'add-cso-slider', ['as' => 'add-cso-slider', 'uses' => 'backend\cso\SliderController@addslider']);
    Route::match(['get', 'post'], 'slider-cso-ajaxAction', ['as' => 'slider-cso-ajaxAction', 'uses' => 'backend\cso\SliderController@ajaxAction']);

    Route::match(['get', 'post'], 'cso-user-allocation-list', ['as' => 'cso-user-allocation-list', 'uses' => 'backend\cso\UserallocationController@userlist']);
    Route::match(['get', 'post'], 'cso-user-allocation-ajaxAction', ['as' => 'cso-user-allocation-ajaxAction', 'uses' => 'backend\cso\UserallocationController@ajaxAction']);

    Route::match(['get', 'post'], 'cso-active-user-allocation-list', ['as' => 'cso-active-user-allocation-list', 'uses' => 'backend\cso\ActiveUserController@userlist']);
    Route::match(['get', 'post'], 'cso-active-user-allocation-list-ajaxAction', ['as' => 'cso-active-user-allocation-list-ajaxAction', 'uses' => 'backend\cso\ActiveUserController@ajaxAction']);

    Route::match(['get', 'post'], 'cso-inactive-user-allocation-list', ['as' => 'cso-inactive-user-allocation-list', 'uses' => 'backend\cso\InactiveUserController@userlist']);
    Route::match(['get', 'post'], 'cso-inactive-user-allocation-list-ajaxAction', ['as' => 'cso-inactive-user-allocation-list-ajaxAction', 'uses' => 'backend\cso\InactiveUserController@ajaxAction']);

    Route::match(['get', 'post'], 'cso-cse-allocation-list', ['as' => 'cso-cse-allocation-list', 'uses' => 'backend\cso\CseallocationController@cselist']);
    Route::match(['get', 'post'], 'view-cso-cse/{id}', ['as' => 'view-cso-cse', 'uses' => 'backend\cso\CseallocationController@viewcse']);
    Route::match(['get', 'post'], 'user-cse-details-cso/{id}', ['as' => 'user-cse-details-cso', 'uses' => 'backend\cso\CseallocationController@viewuserdetails']);
    Route::match(['get', 'post'], 'edit-user-details-cse/{id}', ['as' => 'edit-user-details-cse', 'uses' => 'backend\cso\CseallocationController@edituserdetails']);
    Route::match(['get', 'post'], 'comments-details-cse/{id}', ['as' => 'comments-details-cse', 'uses' => 'backend\cso\CseallocationController@comments']);

    Route::match(['get', 'post'], 'add-note-cse/{id}', ['as' => 'add-note-cse', 'uses' => 'backend\cso\CseallocationController@addnote']);

    Route::match(['get', 'post'], 'edit-fund-detail-cse/{id}', ['as' => 'edit-fund-detail-cse', 'uses' => 'backend\cso\CseallocationController@editFundDetailAdmin']);

    Route::match(['get', 'post'], 'edit-fund-payment-cse/{id}', ['as' => 'edit-fund-payment-cse', 'uses' => 'backend\cso\CseallocationController@editFundPaymentAdmin']);

    Route::match(['get', 'post'], 'edit-franchise-detail-staff/{id}', ['as' => 'edit-franchise-detail-staff', 'uses' => 'backend\StaffmainController@updateFranchiseByadmin']);

    Route::match(['get', 'post'], 'edit-partner-detail-staff/{id}', ['as' => 'edit-partner-detail-staff', 'uses' => 'backend\StaffmainController@updatePartnerByadmin']);
    Route::match(['get', 'post'], 'cso-cse-allocation-ajaxAction', ['as' => 'cso-cse-allocation-ajaxAction', 'uses' => 'backend\cso\CseallocationController@ajaxAction']);
});


