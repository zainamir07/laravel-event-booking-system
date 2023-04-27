<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\GuestCapacityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('auth_guard');
Route::post('login', [AuthController::class, 'login_check'])->name('login_check')->middleware('auth_guard');
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('auth_guard');
Route::post('register', [AuthController::class, 'register_check'])->name('register_check')->middleware('auth_guard');
Route::get('organization_register', [AuthController::class, 'org_register'])->name('org_register')->middleware('auth_guard');
Route::post('organization_register', [AuthController::class, 'org_register_check'])->name('org_register_check')->middleware('auth_guard');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('events', [HomeController::class, 'events'])->name('events');
Route::get('events/{slug}', [HomeController::class, 'eventDetails'])->name('eventDetails');
//Org Event Routes
Route::get('myevents', [EventController::class, 'org_events'])->name('org_events')->middleware('org_guard');
Route::get('create_event', [EventController::class, 'create_event'])->name('create_event')->middleware('org_guard');
Route::post('create_event', [EventController::class, 'admin_storeEvent'])->name('create_event')->middleware('org_guard');
Route::get('myevents/edit/{id}', [EventController::class, 'editEvent'])->name('editEvent')->middleware('org_guard');
Route::post('myevents/edit/{id}', [EventController::class, 'admin_updateEvent'])->name('editEventImage');

Route::get('edit_event/image/{id}', [EventController::class, 'admin_editImage'])->name('admin_editImage');
Route::get('myevents/delete/{id}', [EventController::class, 'deleteMyEvent'])->name('deleteMyEvent');

Route::get('myTickets', [TicketController::class, 'org_tickets'])->name('org_tickets');
Route::get('myTickets/{slug}', [TicketController::class, 'org_ticket_details'])->name('org_ticket_details');

Route::get('tickets/viewTicketDetails/{id}', [TicketController::class, 'viewTicketDetails'])->name('orgViewTicketDetails');

Route::get('events/buyTicket/{slug}', [HomeController::class, 'buyEventTicket'])->name('buyEventTicket');
Route::post('events/buyTicket/{slug}', [HomeController::class, 'buyEventTicket_details'])->name('buyEventTicket_details');
Route::get('buyingSuccess', [HomeController::class, 'buyingSuccess'])->name('buyingSuccess')->middleware('unAuth_guard');
Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('org_guard');

//User Profile Routes
Route::get('myProfile', [HomeController::class, 'userProfile'])->name('userProfile')->middleware('unAuth_guard');
Route::post('myProfile', [HomeController::class, 'updateUserProfile'])->name('updateUserProfile')->middleware('unAuth_guard');
Route::post('changePassword', [HomeController::class, 'changePassword'])->name('changePassword')->middleware('unAuth_guard');

// Admin View User Profile Routes
Route::get('myProfile/{id}', [HomeController::class, 'viewUserProfile'])->name('viewUserProfile')->middleware('admin_guard');
Route::post('myProfile/{id}', [HomeController::class, 'admin_updateUserProfile'])->name('admin_updateUserProfile');
Route::post('user_following_check', [FollowersController::class, 'user_following_check'])->name('user_following_check')->middleware('unAuth_guard');
Route::post('user_following_remove', [FollowersController::class, 'user_following_remove'])->name('user_following_remove')->middleware('unAuth_guard');

//Organizer Profile Routes 
Route::get('organizers', [HomeController::class, 'allOrganizers'])->name('allOrganizers');
Route::get('profile', [HomeController::class, 'orgProfile'])->name('orgProfile')->middleware('org_guard');
Route::get('profile/edit/{id}', [HomeController::class, 'edit_orgProfile'])->name('edit_orgProfile')->middleware('org_guard');
Route::post('profile/edit/{id}', [HomeController::class, 'update_orgProfile'])->name('update_orgProfile')->middleware('org_guard');
Route::get('profile/{username}', [HomeController::class, 'viewOrgProfile'])->name('viewOrgProfile');
Route::post('profile/follow/{id}', [FollowersController::class, 'new_folow_request'])->name('new_folow_request');

//Organizer Follower view  Routes
Route::get('my_followers', [FollowersController::class, 'showOrgFollowers'])->name('my_followers')->middleware('org_guard');
Route::post('remove_follower', [FollowersController::class, 'org_remove_follower'])->name('org_remove_follower')->middleware('org_guard');

Route::get('BookEvents', [EventController::class, 'user_events'])->name('user_events')->middleware('unAuth_guard');
Route::post('BookEvents/event_review', [ReviewsController::class, 'store'])->name('eventReviewStore')->middleware('unAuth_guard');

Route::get('u_notifications', [NotificationController::class, 'u_notifications'])->name('u_notifications')->middleware('unAuth_guard');
Route::get('o_notifications', [NotificationController::class, 'org_notifications'])->name('org_notifications')->middleware('org_guard'); 
// Reviews Routes 
Route::get('reviews', [ReviewsController::class, 'index'])->name('reviews');
Route::get('reviews/{slug}', [ReviewsController::class, 'eventReviews'])->name('eventReviews');
Route::get('user_reviews', [ReviewsController::class, 'user_reviews'])->name('user_reviews');


Route::get('payment', [TicketController::class, 'payment'])->name('payment');
Route::post('payment_confirmed', [HomeController::class, 'payment_confirmed'])->name('payment_confirmed');
Route::get('events/payment/{slug}/{id}', [HomeController::class, 'late_eventPyment'])->name('late_eventPyment');
Route::post('events/payment/{slug}/{id}', [HomeController::class, 'update_latePayment'])->name('late_eventPyment');

Route::get('buySuccess', function(){
   return view('buyingSuccess');
});
Route::get('test', function(){

    return view('test');
});

//Messages Routes
Route::get('messages', [ChatController::class, 'allmessages'])->name('messages');
Route::get('chat/{id}', [ChatController::class, 'chat_box'])->name('chat_box');
Route::post('chat/send', [ChatController::class, 'send_message'])->name('send_message');
Route::post('chat/fetch_out_message', [ChatController::class, 'fetch_out_message'])->name('fetch_out_message');
Route::post('chat/fetch_in_message', [ChatController::class, 'fetch_in_message'])->name('fetch_in_message');



Route::group(['middleware' => 'admin_guard', 'prefix'=> 'admin'], function(){

    Route::get('/', [HomeController::class, 'admin'])->name('admin');
    // User Routes 
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/organizations', [UserController::class, 'organizations'])->name('admin.organization');
    Route::post('/users/register/check', [UserController::class, 'admin_user_register'])->name('admin_user_register');
    Route::post('/users/edit', [UserController::class, 'admin_user_edit'])->name('admin_user_edit');
    Route::post('/users/update/{id}', [UserController::class, 'admin_user_update']);
    Route::get('/users/delete/{id}', [UserController::class, 'admin_user_delete']);
    Route::post('/users/status_check', [UserController::class, 'status_check'])->name('status_check');

    //Event Routes
    Route::get('/events', [EventController::class, 'index'])->name('admin.events');
    Route::get('/createEvent', [EventController::class, 'admin_createEvent'])->name('createEvent');
    Route::post('/createEvent', [EventController::class, 'admin_storeEvent'])->name('storeEvent');
    Route::get('edit_event/{id}', [EventController::class, 'admin_editEvent'])->name('admin_editEvent');
    Route::get('edit_event/image/{id}', [EventController::class, 'admin_editImage'])->name('admin_editImage');
    Route::post('edit_event/{id}', [EventController::class, 'admin_updateEvent'])->name('editEventImage');
    Route::get('/events/delete/{id}', [EventController::class, 'deleteEvent'])->name('admin.deleteEvent');

    //EventTypes Routes
    Route::get('/eventTypes', [EventController::class, 'eventTypes'])->name('admin.eventTypes');
    Route::post('/eventTypes/register/check', [EventController::class, 'eventTypes_register'])->name('eventTypes_register');
    Route::post('/eventTypes/edit', [EventController::class, 'admin_eventType_edit'])->name('admin_eventType_edit');
    Route::post('/eventType/update/{id}', [EventController::class, 'admin_eventType_update']);
    Route::get('/eventType/delete/{id}', [EventController::class, 'admin_eventType_delete']);

    
    // Guest Capacity Routes
    Route::get('/guestCapacity', [GuestCapacityController::class, 'index'])->name('admin.guestCapacity');
    Route::post('/guestCapacity/register/check', [GuestCapacityController::class, 'guestCapacity_register'])->name('guestCapacity_register');
    Route::get('/guestCapacity/delete/{id}', [GuestCapacityController::class, 'admin_guestCapacity_delete']);

    //Tickets Routes
    Route::get('/tickets', [TicketController::class, 'index'])->name('admin.tickets');
    Route::get('/tickets/viewTicketDetails/{id}', [TicketController::class, 'viewTicketDetails'])->name('admin.viewTicketDetails');
    Route::get('/tickets/viewTicketDetails/{id}', [TicketController::class, 'viewTicketDetails'])->name('admin.viewTicketDetails');
    
    //Notification Route
    Route::get('/notifications', [HomeController::class, 'admin_notifications'])->name('admin_notifications');
 
});







Route::get('sessions', function(){
    echo '<pre>';
    print_r(session()->all());
});