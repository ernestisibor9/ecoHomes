<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\SellerController as BackendSellerController;
use App\Http\Controllers\Frontend\LocationController;
use App\Http\Controllers\Frontend\OwnerPropertyController;
use App\Http\Controllers\Frontend\SellerController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(["middleware" => "prevent-back-history"], function () {

    Route::get('/', [UserController::class, 'Index'])->name('index');
    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        // Location controller
        Route::controller(LocationController::class)->group(function () {
            Route::get('/sell/my/property', 'SellMyProperty')->name('sell.my.property');
            Route::get('/get-states/ajax/{countryId}', 'GetStates');
            Route::get('/get-cities/ajax/{stateId}', 'GetCities');
            Route::get('/sell/my/property/details', 'SellMyPropertyDetails')->name('sell.my.property.details');
        });
    });

    require __DIR__ . '/auth.php';

    // Admin Profile routes
    Route::middleware(['auth', 'roles:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
        Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
        Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
        Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
        Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
        Route::post('/admin/change/password', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
        Route::get('/manage/sellers', [AdminController::class, 'ManageSellers'])->name('manage.sellers');
        Route::get('/change/status/{id}', [AdminController::class, 'ChangeStatus'])->name('change.status');


        // Seller Route for Admin
        Route::controller(BackendSellerController::class)->group(function () {
            Route::get('/all/seller', 'AllSeller')->name('all.seller');
            Route::get('/all/seller/progress', 'AllSellerProgress')->name('all.seller.progress');
            Route::get('/change/status/{id}/{status}', 'ChangeStatus')->name('change.status');
            Route::get('/change/statuss/{id}/{status}', 'ChangeStatus2')->name('change.status2');
            Route::post('/admin/approve/{userId}', 'AdminApprove')->name('admin.properties.update');


            // Route::get('/all/seller3', 'AllSeller3')->name('all.seller3');
            Route::get('/all/seller3/progress3', 'AllSellerProgress3')->name('all.seller3.progress3');
            Route::get('/change/statuss3/{id}/{status}', 'ChangeStatus3')->name('change.status3');
            Route::post('/admin/approve3/{userId}', 'AdminApprove3')->name('admin.properties.update3');
        });

        // Property Type Route for Admin
        Route::controller(PropertyTypeController::class)->group(function () {
            Route::get('/add/type', 'AddType')->name('add.type');
            Route::post('store/type', 'StoreType')->name('store.type');
            Route::get('/all/type', 'AllType')->name('all.type');
            Route::get('/edit/type/{id}', 'TypeEdit')->name('type.edit');
            Route::post('/update/type', 'UpdateType')->name('update.type');
            Route::get('/delete/type/{id}', 'TypeDelete')->name('type.delete');
        });

        // Amenities Route for Admin
        Route::controller(AmenitiesController::class)->group(function () {
            Route::get('/add/amenities', 'AddAmenities')->name('add.amenities');
            Route::post('/store/amenities', 'StoreAmenities')->name('store.amenities');
            Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
            Route::get('/edit/amenities/{id}', 'AmenitiesEdit')->name('amenities.edit');
            Route::post('/update/amenities', 'UpdateAmenities')->name('update.amenities');
            Route::get('/delete/amenities/{id}', 'AmenitiesDelete')->name('amenities.delete');
        });

        // Amenities Route for Admin
        Route::controller(PropertyController::class)->group(function () {
            Route::get('/add/property', 'AddProperty')->name('add.property');
            Route::post('/store/property', 'StoreProperty')->name('store.property');
            Route::get('/all/property', 'AllProperty')->name('all.property');
            Route::get('/edit/property/{id}', 'EditProperty')->name('property.edit');
            Route::post('/update/property', 'UpdateProperty')->name('update.property');
            Route::get('/delete/property/{id}', 'PropertyDelete')->name('property.delete');

            Route::post('/update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
            Route::post('/update/property/multiimg', 'UpdatePropertyMultiImg')->name('update.property.multiimg');
            Route::get('/delete/multiimages/property/{id}', 'PropertyMultiDelete')->name('property.multiimg.delete');
            Route::get('/details/property/{id}', 'DetailsProperty')->name('property.details');
            Route::get('/change/status/{id}', 'ChangeStatus')->name('change.status');
        });
    });


    // User routes
    Route::controller(FrontendUserController::class)->group(function () {
        Route::get('/get/started', 'GetStarted')->name('get.started');
        Route::post('/store/sell/my/property', 'StoreSellMyProperty')->name('store.sell.my.property');
    });


    // Admin Login
    Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')
        ->middleware(RedirectIfAuthenticated::class);

    // Sell My Property Details
     Route::get('/sell/my/property/details', [LocationController::class, 'SellMyPropertyDetails'])->name('sell.my.property.details');

    // Reach million Details
    Route::get('/reach/million/details', [LocationController::class, 'ReachMillionDetails'])->name('reach.million.details');

    // Expert solution details
    Route::get('/expert/solution/details', [LocationController::class, 'ExpertSolutionDetails'])->name('expert.solution.details');

    // simple.process.details
    Route::get('/simple/process/details', [LocationController::class, 'SimpleProcessDetails'])->name('simple.process.details');

    // Seller Signup
    Route::get('/seller/signup', [SellerController::class, 'SellerSignup'])->name('seller.signup')
        ->middleware(RedirectIfAuthenticated::class);

    // Seller Login
    Route::get('/seller/login', [SellerController::class, 'SellerLogin'])->name('seller.login')
        ->middleware(RedirectIfAuthenticated::class);

    // Seller Registration
    Route::get('/seller/signup', [SellerController::class, 'SellerSignup'])->name('seller.signup');

    // Seller Registration
    Route::post('/seller/registration', [SellerController::class, 'SellerRegister'])->name('seller.register');


    // Seller Route
    Route::middleware(['auth', 'roles:seller'])->group(function () {
        Route::get('/seller/dashboard', [SellerController::class, 'SellerDashboard'])->name('seller.dashboard');
        Route::get('/seller/logout', [SellerController::class, 'SellerLogout'])->name('seller.logout');
        Route::get('/seller/profile', [SellerController::class, 'SellerProfile'])->name('seller.profile');
        Route::post('/seller/profile/store', [SellerController::class, 'SellerProfileStore'])->name('seller.profile.store');
    });


    // Seller2 Route
    Route::get('/property/step1', [OwnerPropertyController::class, 'showStep1Form'])->name('form.step1');
    Route::get('/property/step2', [OwnerPropertyController::class, 'showStep2Form'])->name('form.step2');
    Route::get('/property/step3', [OwnerPropertyController::class, 'showStep3Form'])->name('form.step3');

    // Step 1 Form Submission Route
    // This route processes the form submission from Step 1
    Route::post('/property/step1', [OwnerPropertyController::class, 'submitStep1'])->name('form.submit1');

    // Status Page for User Progress
    Route::get('/status', [OwnerPropertyController::class, 'showStatusPage'])->name('status.page');
});
