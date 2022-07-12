<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\BedController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\Usercontroller;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\GoyaguideController;
use App\Http\Controllers\backend\TeleConsultationController;
use App\Http\Controllers\backend\ContactPsychlogistController;
use App\Http\Controllers\backend\IsolationSuidelinesController;
use App\Http\Controllers\backend\VacinationCenterController;
use App\Http\Controllers\backend\FeverClinicController;
use App\Http\Controllers\backend\FoodController;
use App\Http\Controllers\backend\PostCovidDietController;
use App\Http\Controllers\backend\MayorExpressController;
use App\Http\Controllers\backend\PublicbikesharingController;
use App\Http\Controllers\backend\BirthRegistrationController;
use App\Http\Controllers\backend\DeathRegistrationController;
use App\Http\Controllers\backend\VoteForYourCityController;
use App\Http\Controllers\backend\MultiLevelParkingController;
use App\Http\Controllers\backend\MyCityMyWallController;
use App\Http\Controllers\backend\SmartQrScannerController;
use App\Http\Controllers\backend\OutdoorMediaManagementController;
use App\Http\Controllers\backend\FeedbackController;
use App\Http\Controllers\backend\AboutUsController;
use App\Http\Controllers\backend\ComplaintController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('dashboard/allservise', 'allservise')->name('dashboard.allservise');
    });
    Route::controller(BedController::class)->group(function () {
        Route::get('bed', 'index')->name('bed.index');
        Route::post('admin/bed/create', 'create')->name('beds.create');
        Route::post('abeds/edit/{id}', 'edit')->name('beds.edit');
        Route::get('beds/delete/{id}', 'delete')->name('beds.delete');
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('service', 'index')->name('service.index');
        Route::post('service/bed', 'create')->name('service.create');
        Route::post('service/edit/{id}', 'edit')->name('service.edit');
        Route::get('service/delete/{id}', 'delete')->name('service.delete');
    });
    Route::controller(Usercontroller::class)->group(function () {
        Route::get('user', 'index')->name('user.index');
        Route::post('user/bed', 'create')->name('user.create');
        Route::post('user/edit/{id}', 'edit')->name('user.edit');
        Route::get('user/delete/{id}', 'delete')->name('user.delete');
    });
    Route::controller(AdminController::class)->group(function () {
        Route::get('admin', 'index')->name('admin.index');
        Route::post('admin/bed', 'create')->name('admin.create');
        Route::post('admin/edit/{id}', 'edit')->name('admin.edit');
        Route::get('admin/delete/{id}', 'delete')->name('admin.delete');
    });
    Route::controller(GoyaguideController::class)->group(function () {
        Route::get('yoga_guide', 'index');
        Route::post('yogaguide.create', 'create')->name('yogaguide.create');
        Route::get('yogaguide/edit/{id}', 'editpath')->name('yogaguide.edit.path');
        Route::post('yogaguide/{id}', 'edit')->name('yogaguide.edit');
        Route::get('admin/yogaguide/{id}', 'delete')->name('yogaguide.delete');
        Route::get('admin/yogaguide/image/{id}', 'imagedelete')->name('yogaguide.imagedelete');
    });
    Route::controller(TeleConsultationController::class)->group(function () {
        Route::get('teleconsultation', 'index');
        Route::post('teleconsultation.create', 'create')->name('teleconsultation.create');
        Route::post('teleconsultation/{id}', 'edit')->name('teleconsultation.edit');
        Route::get('admin/teleconsultation/{id}', 'delete')->name('teleconsultation.delete');
    });
    Route::controller(ContactPsychlogistController::class)->group(function () {
        Route::get('contactpsychlogist', 'index');
        Route::post('contactpsychlogist.create', 'create')->name('contactpsychlogist.create');
        Route::post('contactpsychlogist/{id}', 'edit')->name('contactpsychlogist.edit');
        Route::get('admin/contactpsychlogist/{id}', 'delete')->name('contactpsychlogist.delete');
    });
    Route::controller(IsolationSuidelinesController::class)->group(function () {
        Route::get('isolation_suidelines', 'index');
        Route::post('isolation_suidelines.create', 'create')->name('isolation_suidelines.create');
        Route::post('isolation_suidelines/{id}', 'edit')->name('isolation_suidelines.edit');
        Route::get('admin/update/{id}', 'update')->name('isolation_suidelines.update');
        Route::get('admin/isolation_suidelines/{id}', 'delete')->name('isolation_suidelines.delete');
    });
    Route::controller(VacinationCenterController::class)->group(function () {
        Route::get('vacination_center', 'index');
        Route::post('vacination_center.create', 'create')->name('vacination_center.create');
        Route::post('vacination_center/{id}', 'edit')->name('vacination_center.edit');
        Route::get('admin/vacination_center/{id}', 'delete')->name('vacination_center.delete');
    });

    Route::controller(FeverClinicController::class)->group(function () {
        Route::get('fever_clinic', 'index');
        Route::post('fever_clinic.create', 'create')->name('fever_clinic.create');
        Route::post('fever_clinic/{id}', 'edit')->name('fever_clinic.edit');
        Route::get('admin/fever_clinic/{id}', 'delete')->name('fever_clinic.delete');
    });
    Route::controller(FoodController::class)->group(function () {
        Route::get('food', 'index');
        Route::post('food.create', 'create')->name('food.create');
        Route::post('food/{id}', 'edit')->name('food.edit');
        Route::get('admin/food/{id}', 'delete')->name('food.delete');
    });
    Route::controller(PostCovidDietController::class)->group(function () {
        Route::get('post_covid_diet', 'index');
        Route::post('post_covid_diet.create', 'create')->name('post_covid_diet.create');
        Route::post('post_covid_diet/{id}', 'edit')->name('post_covid_diet.edit');
        Route::get('admin/post_covid_diet/{id}', 'delete')->name('post_covid_diet.delete');
    });

    Route::controller(MayorExpressController::class)->group(function () {
        Route::get('mayor_express', 'index');
        Route::post('mayor_express.create', 'create')->name('mayor_express.create');
        Route::post('mayor_express/{id}', 'edit')->name('mayor_express.edit');
        Route::get('admin/mayor_express/{id}', 'delete')->name('mayor_express.delete');
        Route::get('admin/mayor_express/update/{id}', 'update')->name('mayor_express.update');
    });
    Route::controller(PublicbikesharingController::class)->group(function () {
        Route::get('public_bike_sharing', 'index');
        Route::post('public_bike_sharing.create', 'create')->name('public_bike_sharing.create');
        Route::post('public_bike_sharing/{id}', 'edit')->name('public_bike_sharing.edit');
        Route::get('admin/public_bike_sharing/{id}', 'delete')->name('public_bike_sharing.delete');
        Route::get('admin/public_bike_sharing/update/{id}', 'update')->name('public_bike_sharing.update');
    });
    Route::controller(BirthRegistrationController::class)->group(function () {
        Route::get('birth_registration', 'index');
        Route::post('birth_registration.create', 'create')->name('birth_registration.create');
        Route::post('birth_registration/{id}', 'edit')->name('birth_registration.edit');
        Route::get('admin/birth_registration/{id}', 'delete')->name('birth_registration.delete');
        Route::get('admin/birth_registration/update/{id}', 'update')->name('birth_registration.update');
    });
    Route::controller(DeathRegistrationController::class)->group(function () {
        Route::get('death_registration', 'index');
        Route::post('death_registration.create', 'create')->name('death_registration.create');
        Route::post('death_registration/{id}', 'edit')->name('death_registration.edit');
        Route::get('admin/death_registration/{id}', 'delete')->name('death_registration.delete');
        Route::get('admin/death_registration/update/{id}', 'update')->name('death_registration.update');
    });
    Route::controller(VoteForYourCityController::class)->group(function () {
        Route::get('vote_for_your_city', 'index');
        Route::post('vote_for_your_city.create', 'create')->name('vote_for_your_city.create');
        Route::post('vote_for_your_city/{id}', 'edit')->name('vote_for_your_city.edit');
        Route::get('admin/vote_for_your_city/{id}', 'delete')->name('vote_for_your_city.delete');
        Route::get('admin/vote_for_your_city/update/{id}', 'update')->name('vote_for_your_city.update');
    });
    Route::controller(MultiLevelParkingController::class)->group(function () {
        Route::get('multi_level_parking', 'index');
        Route::post('multi_level_parking.create', 'create')->name('multi_level_parking.create');
        Route::post('multi_level_parking/{id}', 'edit')->name('multi_level_parking.edit');
        Route::get('admin/multi_level_parking/{id}', 'delete')->name('multi_level_parking.delete');
        Route::get('admin/multi_level_parking/update/{id}', 'update')->name('multi_level_parking.update');
    });
    Route::controller(MyCityMyWallController::class)->group(function () {
        Route::get('my_city_my_wall', 'index');
        Route::post('my_city_my_wall.create', 'create')->name('my_city_my_wall.create');
        Route::post('my_city_my_wall/{id}', 'edit')->name('my_city_my_wall.edit');
        Route::get('admin/my_city_my_wall/{id}', 'delete')->name('my_city_my_wall.delete');
        Route::get('admin/my_city_my_wall/update/{id}', 'update')->name('my_city_my_wall.update');
    });
    Route::controller(SmartQrScannerController::class)->group(function () {
        Route::get('smart_qr_scanner', 'index');
        Route::post('smart_qr_scanner.create', 'create')->name('smart_qr_scanner.create');
        Route::post('smart_qr_scanner/{id}', 'edit')->name('smart_qr_scanner.edit');
        Route::get('admin/smart_qr_scanner/{id}', 'delete')->name('smart_qr_scanner.delete');
        Route::get('admin/smart_qr_scanner/update/{id}', 'update')->name('smart_qr_scanner.update');
    });
    Route::controller(OutdoorMediaManagementController::class)->group(function () {
        Route::get('outdoor_media_management', 'index');
        Route::post('outdoor_media_management.create', 'create')->name('outdoor_media_management.create');
        Route::post('outdoor_media_management/{id}', 'edit')->name('outdoor_media_management.edit');
        Route::get('admin/outdoor_media_management/{id}', 'delete')->name('outdoor_media_management.delete');
        Route::get('admin/outdoor_media_management/update/{id}', 'update')->name('outdoor_media_management.update');
    });
    Route::controller(FeedbackController::class)->group(function () {
        Route::get('feedback', 'index')->name('feedback.index');
        Route::get('admin/feedback/{id}', 'delete')->name('feedback.delete');
    });

    Route::controller(AboutUsController::class)->group(function () {
        Route::get('aboutus', 'index')->name('aboutus.index');
        Route::post('aboutus.create', 'create')->name('aboutus.create');
        Route::post('aboutus/{id}', 'edit')->name('aboutus.edit');
        Route::get('admin/aboutus/{id}', 'delete')->name('aboutus.delete');
        Route::get('admin/aboutus/update/{id}', 'update')->name('aboutus.update');
    });
    Route::controller(ComplaintController::class)->group(function () {
        Route::get('complaint', 'index')->name('complaint.index');
        Route::get('admin/complaint/{id}', 'delete')->name('complaint.delete');
        Route::post('complaint/reply/{id}', 'edit')->name('complaint.edit');
    });
});



require __DIR__ . '/auth.php';
