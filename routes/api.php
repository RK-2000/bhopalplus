<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApiController::class)->group(function () {
    Route::post('registration', 'registration')->name('registration');
    Route::post('login', 'Login')->name('login');
    Route::get('logout', 'signOut');
    Route::post('otpverify', 'otpverify')->name('otpverify');

    // ---------auth here---
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('aboutus', 'aboutus');
        Route::post('edit-profile', 'editProfile');
        Route::post('add-profile', 'editProfile');
        Route::get('show-profile', 'showProfile');

        Route::post('complaint', 'complaint');
        Route::get('service', 'service');
        // -----complaint start here-----
        Route::get('allcomplaint-reply', 'allcomplaint');
        Route::get('onecomplaint-reply/{id}', 'onecomplaint');
        // -----complaint End here-----

        // --------feedback start here------
        Route::get('feedback', 'feedback');
        Route::post('create-feedback', 'feedbackcreate');
        Route::post('update-feedback', 'updatefeedback');
        // --------feedback End here------
        // --------all service start here------
        Route::get('yoga-guide', 'yogaguide');
        Route::get('teleconsultation', 'teleconsultation');
        Route::get('contact-psychlogist', 'contactpsychlogist');
        Route::get('isolation-suidelines', 'isolationsuidelines');
        Route::get('vacination-center', 'vacinationcenter');
        Route::get('fever-clinic', 'feverclinic');
        Route::get('food', 'food');
        Route::get('mayor-express', 'mayorexpress');
        Route::get('post-covid-diet', 'postcoviddiet');
        Route::get('public-bike-sharing', 'publicbikesharing');
        Route::get('birth-registration', 'birthregistration');
        Route::get('death-registration', 'deathregistration');
        Route::get('vote-for-your-city', 'voteforyourcity');
        Route::get('multi-level-parking', 'multilevelparking');
        Route::get('my-city-my-wall', 'mycitymywall');
        Route::get('smart-qr-scanner', 'smartqrscanner');
        Route::get('outdoor-media-management', 'outdoormediamanagement');
        // --------all service End here------ outdoor_media_management
    });
});
