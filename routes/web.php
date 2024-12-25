<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Backend\AvailabilityController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\SellerController as BackendSellerController;
use App\Http\Controllers\Frontend\BookPropertyController;
use App\Http\Controllers\frontend\FeaturedPropertyController;
use App\Http\Controllers\Frontend\LocationController;
use App\Http\Controllers\Frontend\OwnerPropertyController;
use App\Http\Controllers\Frontend\SellerController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\ViewingController;
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

Route::get('/', [UserController::class, 'Index'])->name('index');


Route::group(["middleware" => "prevent-back-history"], function () {

    // Route::get('/test-location', function () {
    //     $location = geoip()->getLocation();
    //     return response()->json($location);
    // });

    // Route to display featured properties
Route::get('/features', [FeaturedPropertyController::class, 'showFeaturedProperties'])->name('featured.properties');

    // Book Search Page
    Route::controller(BookPropertyController::class)->group(function () {
        Route::get('/list/all/property',  'ListAllProperty')->name('list.all.property');
        Route::get('/book/search',  'BookSearch')->name('book.search');
        Route::get('/get-states-book/ajax/{countryId}', 'GetStatesBook');
        Route::get('/get-cities-book/ajax/{stateId}', 'GetCitiesBook');
        Route::get('/properties/filter', 'BookPropertyFilter')->name('properties.filter');
        Route::post('/search/book/properties', 'SearchBookProperty')->name('search.book.properties');
        Route::get('/properties', 'filterStatusProperties')->name('filter.status.properties');
        Route::get('/properties/sort', 'filterSortProperties')->name('filter.sort.properties');
        Route::get('/properties/type', 'filterTypeProperties')->name('filter.type.properties');
        Route::get('search/price/properties', function () {
            return redirect()->back(); // Redirect back or to a default page
        });

        // Route::get('/properties/{propertyId}/availability/{date}', [ViewingController::class, 'checkAvailability']);
        // Route::post('/properties/{propertyId}/viewing-request', [ViewingController::class, 'submitViewingRequest']);
        Route::post('/store/{propertyId}/viewing/request', 'SubmitRequest')->name('viewing.request');

        Route::post('/search/price/properties', 'SearchPriceProperty')->name('search.price.properties');
        Route::get('/property/details/{id}/{slug}', 'BookPropertyDetails')->name('book.details.properties');
        Route::get('/user/property/book/{id}', 'UserAuthBook')->name('user.auth.booking');
        Route::post('/book-property/{propertyId}', 'BookPropertyNow')->name('book.property.now');
        Route::post('/store/booking', 'StoreBooking')->name('store.booking');
        Route::post('/store/booking/guest', 'StoreBookingGuest')->name('store.booking.guest');
        Route::get('/rent/properties', 'RentProperties')->name('rent.properties');
        Route::get('/buy/properties', 'BuyProperties')->name('buy.properties');
    });

    Route::middleware(['auth', 'roles:user', 'verified'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
        Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');


        // Seller2 Route
        Route::get('/property/step1', [OwnerPropertyController::class, 'showStep1Form'])->name('form.step1');
        Route::get('/property/step2', [OwnerPropertyController::class, 'showStep2Form'])->name('form.step2');
        Route::get('/property/step3', [OwnerPropertyController::class, 'showStep3Form'])->name('form.step3');

        // Step 1 Form Submission Route
        // This route processes the form submission from Step 1
        Route::post('/property/step1', [OwnerPropertyController::class, 'submitStep1'])->name('form.submit1');
        // Status Page for User Progress
        Route::get('/status', [OwnerPropertyController::class, 'showStatusPage'])->name('status.page');
        // Upload Properties
        Route::get('/upload/property/docs', [OwnerPropertyController::class, 'uploadProperty'])->name('upload.property');
        Route::post('/store/upload/property/docs', [OwnerPropertyController::class, 'storeUploadProperty'])->name('store.upload.property');

        // Terms and Conditions routes
        Route::get('/terms/conditions', [OwnerPropertyController::class, 'termsConditions'])->name('terms.conditions');
        Route::get('/agree-page', [OwnerPropertyController::class, 'agreePage'])->name('agree.page');

        // Consent routes
        Route::post('/store/consent/pdf', [OwnerPropertyController::class, 'storeConsent'])->name('store.consent');

        // Location controller
        Route::controller(LocationController::class)->group(function () {
            Route::get('/sell/my/property', 'SellMyProperty')->name('sell.my.property');
            Route::get('/get-states-location/ajax/{countryId}', 'GetStatesLocation');
            Route::get('/get-cities-location/ajax/{stateId}', 'GetCitiesLocation');
            Route::get('/sell/my/property/details', 'SellMyPropertyDetails')->name('sell.my.property.details');
        });

        // trusted.owner.details
        Route::get('/trusted/owner/details', [LocationController::class, 'TrustedOwnerDetails'])->name('trusted.owner.details');
        // unmatched.variety.details
        Route::get('/unmatched/variety/details', [LocationController::class, 'UnmatchedVarietyDetails'])->name('unmatched.variety.details');

        // smart.search.details
        Route::get('/smart/search/details', [LocationController::class, 'SmartSearchDetails'])->name('smart.search.details');
    });

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

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
            Route::post('/change/statuss3/{id}/{status}', 'ChangeStatus3')->name('change.status3');
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

            Route::get('/get-states/ajax/{countryId}', 'GetStates');
            Route::get('/get-cities/ajax/{stateId}', 'GetCities');

            Route::post('/update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
            Route::post('/update/property/multiimg', 'UpdatePropertyMultiImg')->name('update.property.multiimg');
            Route::get('/delete/multiimages/property/{id}', 'PropertyMultiDelete')->name('property.multiimg.delete');
            Route::get('/details/property/{id}', 'DetailsProperty')->name('property.details');
            Route::get('/change/property/status/{id}', 'ChangeStatus')->name('change.property.status');
        });

        // Availability Management
        Route::controller(AvailabilityController::class)->group(function () {
            Route::get('/properties/{propertyId}/availability/create', 'CreateAvailability')->name('availability.create');
            Route::post('/properties/{propertyId}/availability', 'StoreAvailability')->name('availability.store');
        });

        // Notifications
        Route::controller(NotificationController::class)->group(function () {
            Route::get('/notifications', 'Notifications')->name('notifications.index');
            Route::get('/notifications/{id}/mark-as-read', 'MarkAsRead')->name('notifications.markAsRead');
            Route::get('/notifications/mark-all-as-read', 'MarkAllAsRead')->name('notifications.markAllAsRead');
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

    // Book My Property Details
    Route::get('/book/my/property/details', [LocationController::class, 'BookMyPropertyDetails'])->name('book.my.property.details');


    // Reach million Details
    Route::get('/reach/million/details', [LocationController::class, 'ReachMillionDetails'])->name('reach.million.details');

    // trusted.owner.details
    // Route::get('/trusted/owner/details', [LocationController::class, 'TrustedOwnerDetails'])->name('trusted.owner.details');

    // unmatched.variety.details
    //Route::get('/unmatched/variety/details', [LocationController::class, 'UnmatchedVarietyDetails'])->name('unmatched.variety.details');

    // smart.search.details
    //Route::get('/smart/search/details', [LocationController::class, 'SmartSearchDetails'])->name('smart.search.details');

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
});
