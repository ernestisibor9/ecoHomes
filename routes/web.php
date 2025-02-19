<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\Backend\AmenitiesController;
use App\Http\Controllers\Backend\AvailabilityController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\SellerController as BackendSellerController;
use App\Http\Controllers\ChartTrackController;
use App\Http\Controllers\CustomRegistrationController;
use App\Http\Controllers\Frontend\BookPropertyController;
use App\Http\Controllers\frontend\FeaturedPropertyController;
use App\Http\Controllers\Frontend\GuestController;
use App\Http\Controllers\Frontend\ListPropertyController;
use App\Http\Controllers\Frontend\LocationController;
use App\Http\Controllers\Frontend\OwnerPropertyController;
use App\Http\Controllers\Frontend\PropertyReserveController;
use App\Http\Controllers\Frontend\SellerController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\ViewingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ListDetailsController;
use App\Http\Controllers\ShortletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuestUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTrackingController;
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

    Route::get('/users-status', [UserTrackingController::class, 'getUsersStatus']);
    Route::get('/guest-status', [UserTrackingController::class, 'getGuestStatus']);
    Route::get('/online-users', [UserTrackingController::class, 'getOnlineUsersCount']);

    Route::get('/track-guest', [GuestUserController::class, 'trackGuestUser']);
    Route::get('/online-guests', [GuestUserController::class, 'getOnlineGuests']);

    Route::get('/api/locations2', [UserController::class, 'GetLocations2']);
    Route::get('/properties/search2', [UserController::class, 'Search2'])->name('properties.search2');

    Route::post('/track-action', [ChartTrackController::class, 'trackAction'])->name('track.action');
    Route::get('/get-chart-data', [ChartTrackController::class, 'getChartData'])->name('chart.data');

    Route::get('/list-property/details/{id}/{slug}', [ListDetailsController::class, 'listPropertyDetails'])->name('list.property.details');

    // Route::get('/list-property/details/{id}/{slug}', [ListDetailsController::class, 'showPropertyDetails'])->name('show.property.details');

    Route::post('/store/report/listing/{id}', [ListDetailsController::class, 'storeReportListing'])->name('store.report.listing');

    Route::post('/store/feedback/{id}', [FeedbackController::class, 'storeFeedback'])->name('store.feedback');

    Route::get('/feedback/{id}', [FeedbackController::class, 'showFeedback'])->name('feedback.detail');


    Route::get('/request/property', [RequestController::class, 'requestProperty'])->name('request.property');

    Route::post('/store/request/property', [RequestController::class, 'storeRequestProperty'])->name('store.request.property');

    Route::get('/otp-input/{user}', [OtpController::class, 'otpInput'])->name('otp.input');
    Route::post('/verify-otp/user', [OtpController::class, 'verify'])->name('verify.otp');

    Route::get('/register/user', [CustomRegistrationController::class, 'create'])->name('register.user');
    Route::post('/store/register', [CustomRegistrationController::class, 'store'])->name('register.store');

    // Step 5: Complete
    Route::get('/view/hotel/{hotel}', [HotelController::class, 'viewHotel'])->name('view.hotel');

    // Step 6: Complete
    Route::get('/view/shortlet/{shortlet}', [ShortletController::class, 'viewShortlet'])->name('view.shortlet');


    Route::post('/send-guest-otp', [GuestController::class, 'sendOtp'])->name('guest.sendOtp');
    Route::get('/verify-otp', [GuestController::class, 'verifyOtpForm'])->name('guest.verifyOtpForm');
    Route::post('/verify-otp', [GuestController::class, 'verifyOtp'])->name('guest.verifyOtp');

    // Route to display featured properties
    Route::get('/features', [FeaturedPropertyController::class, 'showFeaturedProperties'])->name('featured.properties');

    // Route to display featured properties
    Route::get('/features', [FeaturedPropertyController::class, 'showFeaturedHotel'])->name('featured.hotel');

    // Route to display featured properties
    Route::get('/features', [FeaturedPropertyController::class, 'showFeaturedShortlet'])->name('featured.shortlet');


    // Room Reservation
    Route::post('/calculate-price', [PropertyReserveController::class, 'calculatePrice']);
    Route::post('/check-availability', [PropertyReserveController::class, 'checkAvailability']);






    // Book Search Page
    Route::controller(BookPropertyController::class)->group(function () {
        Route::get('/list/all/property',  'ListAllProperty')->name('list.all.property');
        Route::get('/property/book/{id}',  'BookProperty')->name('property.book');
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
        // regular.user
        Route::get('/regular/user', 'regularUser')->name('regular.user');
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

        // All Properties
        Route::get('/api/locations', 'GetLocations');
        Route::get('/properties/search', 'Search')->name('properties.search');
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

        // Step 1: Create Hotel
        Route::get('/create/hotel', [HotelController::class, 'createStep1'])->name('hotel.create');
        Route::post('/store/hotel', [HotelController::class, 'postStep1'])->name('hotel.store');

        // Step 2: Add Facilities
        Route::get('/facilities/{hotel}', [HotelController::class, 'createStep2'])->name('hotel.facilities');
        Route::post('/store/facilities/{hotel}', [HotelController::class, 'postStep2'])->name('hotel.facilities.store');

        // Step 3: Add Rooms
        Route::get('/rooms/{hotel}', [HotelController::class, 'createStep3'])->name('hotel.rooms');
        Route::post('/store/rooms/{hotel}', [HotelController::class, 'postStep3'])->name('hotel.store.rooms');

        // Step 4: Photos
        Route::get('/add/photos/{hotel}', [HotelController::class, 'createStep4'])->name('hotel.photos');
        Route::post('/store/photos/{hotel}/{room}', [HotelController::class, 'postStep4'])->name('hotel.photos.store');

        // Step 5: Complete
        Route::get('/complete/{hotel}', [HotelController::class, 'complete'])->name('hotel.complete');
    });

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {

        // List Properties
        Route::get('/apartment/flat', [ListPropertyController::class, 'apartmentFlat'])->name('apartment.flat');
        // Store Properties
        Route::post('/store/apartment/flat', [ListPropertyController::class, 'storeApartmentFlat'])->name('store.flat');

        // List Properties
        Route::get('/apartment/house', [ListPropertyController::class, 'apartmentHouse'])->name('apartment.house');
        // Store Properties
        Route::post('/store/apartment/house', [ListPropertyController::class, 'storeApartmentHouse'])->name('store.house');

        // List Properties
        Route::get('/land/property', [ListPropertyController::class, 'landProperty'])->name('land.property');
        // Store Properties
        Route::post('/store/land/property', [ListPropertyController::class, 'storeLandProperty'])->name('store.land');

        // List Properties
        Route::get('/commercial/property', [ListPropertyController::class, 'commercialProperty'])->name('commercial.property');
        // Store Properties
        Route::post('/store/commercial/property', [ListPropertyController::class, 'storeCommercialProperty'])->name('store.commercial');


        // Location controller
        Route::controller(LocationController::class)->group(function () {
            Route::get('/sell/my/property', 'SellMyProperty')->name('sell.my.property');
            Route::get('/get-states/ajax/{countryId}', 'GetStates');
            Route::get('/get-cities/ajax/{stateId}', 'GetCities');
            Route::get('/sell/my/property/details', 'SellMyPropertyDetails')->name('sell.my.property.details');
        });

        // Step 1: Create Hotel
        Route::get('/create/hotel', [HotelController::class, 'createStep1'])->name('hotel.create');
        Route::post('/store/hotel', [HotelController::class, 'postStep1'])->name('hotel.store');

        // Step 2: Add Facilities
        Route::get('/facilities/{hotel}', [HotelController::class, 'createStep2'])->name('hotel.facilities');
        Route::post('/store/facilities/{hotel}', [HotelController::class, 'postStep2'])->name('hotel.facilities.store');

        // Step 3: Add Rooms
        Route::get('/rooms/{hotel}', [HotelController::class, 'createStep3'])->name('hotel.rooms');
        Route::post('/store/rooms/{hotel}', [HotelController::class, 'postStep3'])->name('hotel.store.rooms');

        // Step 4: Photos
        Route::get('/add/photos/{hotel}', [HotelController::class, 'createStep4'])->name('hotel.photos');
        Route::post('/store/photos/{hotel}/{room}', [HotelController::class, 'postStep4'])->name('hotel.photos.store');

        // Step 5: Complete
        Route::get('/complete/{hotel}', [HotelController::class, 'complete'])->name('hotel.complete');










        // Step 1: Create Hotel
        Route::get('/create/shortlet', [ShortletController::class, 'createStep1'])->name('shortlet.create');
        Route::post('/store/shortlet', [ShortletController::class, 'postStep1'])->name('shortlet.store');

        // Step 2: Add Facilities
        Route::get('/shortlet/facilities/{shortlet}', [ShortletController::class, 'createStep2'])->name('shortlet.facilities');
        Route::post('/shortlet/store/facilities/{shortlet}', [ShortletController::class, 'postStep2'])->name('shortlet.facilities.store');

        // Step 3: Add Rooms
        Route::get('/shortlet/rooms/{shortlet}', [ShortletController::class, 'createStep3'])->name('shortlet.rooms');
        Route::post('/shortlet/store/rooms/{shortlet}', [ShortletController::class, 'postStep3'])->name('shortlet.store.rooms');

        // Step 4: Photos
        Route::get('/shortlet/add/photos/{shortlet}', [ShortletController::class, 'createStep4'])->name('shortlet.photos');
        Route::post('/shortlet/store/photos/{shortlet}/{room}', [ShortletController::class, 'postStep4'])->name('shortlet.photos.store');

        // Step 5: Complete
        Route::get('/shortlet/complete/{shortlet}', [ShortletController::class, 'complete'])->name('shortlet.complete');
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

        // Reques
        Route::get('/all/request',  [AdminController::class, 'allRequest'])->name('all.request');

//         Route::post('/track-action', [UserController::class, 'trackAction'])->name('track.action');
// Route::get('/get-chart-data', [UserController::class, 'getChartData'])->name('chart.data');

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


    // Agent routes
    Route::middleware(['auth', 'roles:agent'])->group(function () {
        Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
        Route::get('/agent/manage/rooms', [AgentController::class, 'AgentManageRoom'])->name('manage.rooms');
        Route::get('/agent/details/room/{id}', [AgentController::class, 'AgentDetailsRoom'])->name('room.details');
        Route::get('/agent/edit/room/{id}', [AgentController::class, 'AgentEditRoom'])->name('room.edit');
        Route::post('/agent/update/rooms', [AgentController::class, 'AgentUpdateRoom'])->name('update.room');
        Route::get('/agent/delete//room/{id}', [AgentController::class, 'AgentDeleteRoom'])->name('room.delete');
        Route::post('/update/room/thumbnail', [AgentController::class, 'UpdateRoomThumbnail'])->name('update.room.thumbnail');
        Route::post('/update/room/multiimg', [AgentController::class, 'UpdateRoomMultiImg'])->name('update.room.multiimg');
        Route::get('/change/room/status/{id}', [AgentController::class, 'ChangeRoomStatus'])->name('change.room.status');
        Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
    });


    Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')
        ->middleware(RedirectIfAuthenticated::class);
    Route::get('/agent/register', [AgentController::class, 'AgentRegister'])->name('register');
    Route::post('/agent/store/register', [AgentController::class, 'store'])->name('register.store');


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
