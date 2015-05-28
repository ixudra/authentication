<?php


/**
 * Routing patterns
 */

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');



/**
 * Routing groups
 */

Route::group(array(), function()
{
    Route::get(     'reset-password',                           array('as' => 'resetPassword',                              'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\PasswordController@showResetPassword'));
    Route::post(    'reset-password',                           array('as' => 'resetPassword.process',                      'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\PasswordController@processResetPassword'));
});


Route::group(array('middleware' => 'guest'), function()
{
    Route::get(     'register',                                 array('as' => 'register',                                   'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\RegisterController@showRegister'));
    Route::post(    'register',                                 array('as' => 'register.process',                           'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\RegisterController@processRegister'));

    Route::get(     'login',                                    array('as' => 'login',                                      'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\AuthController@showLogin'));
    Route::post(    'login',                                    array('as' => 'login.process',                              'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\AuthController@processLogin'));
});


Route::group(array('middleware' => 'auth'), function()
{
    Route::get(     'change-email',                             array('as' => 'changeEmail',                                'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\AuthController@showChangeEmail'));
    Route::post(    'change-email',                             array('as' => 'changeEmail.process',                        'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\AuthController@processChangeEmail'));

    Route::get(     'change-password',                          array('as' => 'changePassword',                             'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\PasswordController@showChangePassword'));
    Route::post(    'change-password',                          array('as' => 'changePassword.process',                     'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\PasswordController@processChangePassword'));

    Route::get(     'logout',                                   array('as' => 'logout',                                     'uses' => '\Ixudra\Authentication\Http\Controllers\Auth\AuthController@logout'));
});


Route::group(array('prefix' => 'admin', 'middleware' => array('auth', 'admin')), function()
{
    Route::get(     '',                                         array('as' => 'admin.index',                                'uses' => '\Ixudra\Authentication\Http\Controllers\Admin\AdminController@index'));

    Route::get(     'users/filter',                             array('as' => 'users.filter',                               'uses' => '\Ixudra\Authentication\Http\Controllers\Admin\UserController@filter'));
    Route::post(    'users/filter',                             array('as' => 'users.filter.process',                       'uses' => '\Ixudra\Authentication\Http\Controllers\Admin\UserController@filter'));
    Route::resource('users', '\Ixudra\Authentication\Http\Controllers\Admin\UserController');

    Route::get(     'roles/filter',                             array('as' => 'roles.filter',                               'uses' => '\Ixudra\Authentication\Http\Controllers\Admin\RoleController@filter'));
    Route::post(    'roles/filter',                             array('as' => 'roles.filter.process',                       'uses' => '\Ixudra\Authentication\Http\Controllers\Admin\RoleController@filter'));
    Route::resource('roles', '\Ixudra\Authentication\Http\Controllers\Admin\RoleController');
});


