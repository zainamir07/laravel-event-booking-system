<?php

namespace App\Http\Controllers;

use App\Custom;
use App\Models\BuyTickets;
use App\Models\Cities;
use App\Models\EventImages;
use App\Models\eventReviews;
use App\Models\Events;
use App\Models\Followers;
use App\Models\Notification;
use App\Models\Organizer;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
      // $featured = $request['featured'] ?? "";
      // $freeEvents = $request['freeEvents'] ?? "";
      // $paidEvents = $request['paidEvents'] ?? "";
      
      // if($freeEvents != ""){
      //   $events = Events::orderBy('event_id', 'desc')->where("event_subscription", "=", $freeEvents)->paginate(6);
      //   // $eventCount = $events->count();
      // }else if($paidEvents != ""){
      //   $events = Events::orderBy('event_id', 'desc')->where("event_subscription", "=", $paidEvents)->paginate(6);
      //   // $eventCount = $events->count();
      // }else{
        $events = Events::orderBy('event_id', 'desc')->where('event_status', '=', 1)->paginate(6);
        $paidEvents = Events::where('event_subscription', '=', 'P')->orderBy('event_id', 'desc')->paginate(5);
        $freeEvents = Events::where('event_subscription', '=', 'F')->orderBy('event_id', 'desc')->paginate(5);
        $eventCount = "";
      // }

      // $events = Events::all();
      $eventImages = EventImages::all();

      $islamabadEvents = Events::where('event_location', '=', 6)->get();
      $islamabad = $islamabadEvents->where('event_start_date', '>', date('Y-m-d'))->count();
      $lahoreEvents = Events::where('event_location', '=', 14)->get();
      $lahore = $lahoreEvents->where('event_start_date', '>', date('Y-m-d'))->count();
      $karachiEvents = Events::where('event_location', '=', 2)->get();
      $karachi = $karachiEvents->where('event_start_date', '>', date('Y-m-d'))->count();
      $multanEvents = Events::where('event_location', '=', 38)->get();
      $multan = $multanEvents->where('event_start_date', '>', date('Y-m-d'))->count();

      $allOrganizers = Users::where('user_type', '=', 'OA')->get();
      $cities = Cities::all();

      $data = compact('events', 'paidEvents', 'freeEvents', 'eventImages', 'islamabad', 'lahore', 'karachi', 'multan', 'allOrganizers', 'cities');
      return view('home')->with($data);
    }


    
    public function admin(){
      // $notification = Notification::where('noti_status', '=', 0)->get();
      // check($notification);
      // $data = compact('notification');
      //   return view('admin.dashboard')->with($data);
        return view('admin.dashboard');
    }

    public function admin_notifications(){
      $allNotifications = Notification::orderBy('noti_id', 'desc')->paginate(10);
      $data = compact('allNotifications');
      return view('admin.notifications')->with($data);      
    }

    public function eventDetails($slug){
      $events = Events::where('event_slug', '=', $slug)->first();
      $eventId = $events->event_id;
      $eventImages = EventImages::where('event_list_id', '=', $eventId)->get();
      $totalReviews = eventReviews::where('event_id', '=', $eventId)->count();
        $data = compact('events', 'eventImages', 'totalReviews');
        return view('eventDetails')->with($data);
    }


    public function buyEventTicket($slug, Request $request){
      $request->validate([
        'quantity' => 'required|max:1',
      ]);
      $quantity = $request['quantity'];
      $events = Events::where('event_slug', '=', $slug)->first();
      $eventId = $events->event_id;
      $eventImages = EventImages::where('event_list_id', '=', $eventId)->first();
      $checkUserId = session()->get('user_id');
      if($checkUserId > 0){
        $data = compact('events', 'eventImages', 'quantity');
        return view('buyTicket')->with($data);
      }else{
        return redirect()->route('login')->with('error', 'You must be login to buy this ticket');
      }
    }

    public function buyEventTicket_details(Request $request){
      // checkArray($request);
      $request->validate([
        'buyerName' => 'required',
        // 'buyerEmail' => 'required',
        // 'buyerAddress' => 'required',
        // 'buyerContact' => 'required',
        'buyerCnic' => 'required',
        // 'buyerComment' => 'required',
        // 'buyerPaymentMethod' => 'required',
        'buyerTicketPrice' => 'required',
    ]);

    // $buyerName = $request->input('buyerName', []);                     
    // $buyerEmail = $request->input('buyerEmail', []);                   
    // $buyerAddress = $request->input('buyerAddress', []);                   
    // $buyerContact = $request->input('buyerContact', []);                   
    // $buyerComment = $request->input('buyerComment', []);                 
    // $buyerPaymentMethod = $request->input('buyerPaymentMethod', []);
    // checkArray($request);
    $quantity = $request['quantity'];

    $newCategoryArray = [                   
       "buyer_user_name"=> $request->input('buyerName', []),                       
      //  "buyer_user_email"=> $request->input('buyerEmail', []),                            
      //  'buyer_user_address' =>  $request->input('buyerAddress', []),                                  
      //  "buyer_user_contact"=>  $request->input('buyerContact', []),  
       "buyer_user_cnic"=>  $request->input('buyerCnic', []),                            
      //  "buyer_user_comment"=>  $request->input('buyerComment', []),                                  
      //  "buyer_user_payment_method"=> $request->input('buyerPaymentMethod', []),               
       "buyer_user_payment_method"=> $request['buyerPaymentMethod'],
       "buyer_user_ticket_price"=> $request['buyerTicketPrice'],
       "buyer_user_id"=> session()->get('user_id'),
       "buyer_event_id"=> $request['buyerEventId'],
       "buyer_event_author_id"=> $request['buyerEventAuthorId'],
    ];
        // $totalRecords = count($newCategoryArray['buyer_user_name']);
        foreach ($request->input('buyerName', []) as $key => $value) {
          # code...
          $buyTicket = new BuyTickets;
          $buyTicket->buyer_user_name = $newCategoryArray['buyer_user_name'][$key];
          // $buyTicket->buyer_user_email = $newCategoryArray['buyer_user_email'][$key];
          // $buyTicket->buyer_user_address = $newCategoryArray['buyer_user_address'][$key];
          // $buyTicket->buyer_user_contact = $newCategoryArray['buyer_user_contact'][$key];
          $buyTicket->buyer_user_cnic = $newCategoryArray['buyer_user_cnic'][$key];
          // $buyTicket->buyer_user_comment = $newCategoryArray['buyer_user_comment'][$key];
          if($request['buyerPaymentMethod'] != ""){
            $buyTicket->buyer_user_payment_method = $request['buyerPaymentMethod'];
            $buyTicket->buyer_user_payment_status = 'UP';
          }else{
            $buyTicket->buyer_user_payment_method = 'N/A';
            $buyTicket->buyer_user_payment_status = 'P';
          }
          $buyTicket->buyer_user_ticket_price = $newCategoryArray['buyer_user_ticket_price'];
          $buyTicket->buyer_user_id = $newCategoryArray['buyer_user_id'];
          $buyTicket->buyer_event_id = $newCategoryArray['buyer_event_id'];
          $buyTicket->buyer_event_author_id = $newCategoryArray['buyer_event_author_id'];

          $buyTicket->save();
          $ticketId[] = $buyTicket->buy_ticket_id;

          $notification = new Notification;
          $notification->noti_title = 'Ticket Sold: '.$buyTicket->buyer_user_name.' Buy your Event '.Custom::getEventTitle($buyTicket->buyer_event_id).' Ticket';
          $notification->noti_for = 'OA';
          $notification->noti_forId = $buyTicket->buyer_event_author_id;
          $notification->noti_type = 'T';
          $notification->noti_typeId = $buyTicket->buyer_event_id;
          $notification->noti_byId = session()->get('user_id');
          $notification->save();
          }
        
        //  check($ticketId);
    if($buyTicket){
      if($request['payNow'] == 'P'){
        $eventData = Events::where('event_id', '=', $request['buyerEventId'])->first();
        $eventId = $eventData->event_id;
        $eventImages = EventImages::where('event_list_id', '=', $eventId)->first();
        $payMethod = $request['buyer_user_payment_method'];
        $totalAmount = $request['totalAmount'];
        $formUrl = 'payment_confirmed';
        $singleTicketId = BuyTickets::where('buy_ticket_id', '=', $ticketId)->first();
        $data = compact('eventData', 'eventImages', 'payMethod', 'ticketId', 'singleTicketId', 'totalAmount', 'formUrl');
        return view('payment')->with($data);
      }else{
        foreach ($ticketId as $key => $value) {
          $newtickets[] = BuyTickets::where('buy_ticket_id', '=', $ticketId)->first();
        }
        $totalTickets = count($ticketId);
        $eventData = Events::where('event_id', '=', $request['buyerEventId'])->first();
        $totalAmount = $request['totalAmount'];
        $data = compact('eventData', 'totalAmount', 'newtickets', 'totalTickets');
        return view('buyingSuccess')->with($data);
      }
    }else{
      return redirect()->back()->with('error', 'Something Went Wrong');
    }
    }

    public function payment_confirmed(Request $request){
      // check($request['ticketId']);
    //  checkArray($eventData);
     foreach ($request['ticketId'] as $key => $value) {
       $tickets[] = BuyTickets::where('buy_ticket_id', '=', $value)->first();
       $tickets[$key]->buyer_user_payment_status = 'P';
       $tickets[$key]->update();
     }
     $totalTickets = count($tickets);
     $eventData = Events::where('event_id', '=', $request['event'])->first();
     foreach ($request['ticketId'] as $key => $value) {
       $newtickets[] = BuyTickets::where('buy_ticket_id', '=', $value)->first();
     }
     $totalAmount = $request['totalAmount'];
     $data = compact('eventData', 'newtickets', 'totalTickets', 'totalAmount');
     return view('buyingSuccess')->with($data);
   }

   public function late_eventPyment($slug, $id){
    $eventData = Events::where('event_slug', '=', $slug)->first();
    $singleTicketId = BuyTickets::where('buy_ticket_id', '=', $id)->first();
    $ticketId = BuyTickets::where('buy_ticket_id', '=', $id)->first();
    // checkArray($ticketId);
    $eventImages = EventImages::where('event_list_id', '=', $eventData->event_id)->first();
    $totalAmount = $singleTicketId->buyer_user_ticket_price;
    $formUrl = 'events/payment/'.$slug.'/'.$id;
    $data = compact('eventData', 'singleTicketId', 'ticketId', 'totalAmount', 'eventImages', 'formUrl');
    return view('payment')->with($data);
   }
  
   public function update_latePayment(Request $request){
      $ticket = BuyTickets::where('buy_ticket_id', '=', $request['singleticketId'])->first();
      $ticket->buyer_user_payment_status = 'P';
      $ticket->update();
      $eventData = Events::where('event_id', '=', $request['event'])->first();
      // $newtickets = BuyTickets::where('buy_ticket_id', '=', $ticket->buy_ticket_id)->first();
      $totalTickets = '1';
      $newtickets[] = $ticket;
      // check($newtickets);
      $totalAmount = $request['totalAmount'];
      $data = compact('eventData', 'newtickets', 'totalTickets', 'totalAmount');
      return view('buyingSuccess')->with($data);
   }

    public function buyingSuccess(){
      return view('buyingSuccess');
    }

    public function dashboard(){
      $user_id = session()->get('user_id');
      //Event Count and Listing
      $totalEvents = Events::where('event_author_id', '=', $user_id)->count();
      $eventList = Events::orderBy('event_id', 'desc')->where('event_author_id', '=', $user_id)->paginate(3);
      $eventId = $eventList->pluck('event_author_id')->first();
     
      $soldTickets = BuyTickets::orderBy('buy_ticket_id', 'desc')->where('buyer_event_author_id', '=', $eventId)->paginate(3);
      $soldTicketsCount = BuyTickets::orderBy('buy_ticket_id', 'desc')->where('buyer_event_author_id', '=', $eventId)->count();
      $ticketEarnings = $soldTickets->pluck('buyer_user_ticket_price');
      $totalEarnings = 0;
      foreach ($ticketEarnings as $key=>$value) {
        $totalEarnings+= $value;     
      }
      // echo '<pre>';
      // // print_r($soldTickets);
      // print_r($soldTickets->toArray());
      // die;
      // $CompletedEvents = $eventList->where('event_end_date', '<', date('Y-m-d'))->get();
      $data = compact('eventList', 'totalEvents', 'soldTickets', 'soldTicketsCount', 'totalEarnings');
      return view('dashboard')->with($data);
    }

    public function events(Request $request){
      $search = $request['search'] ?? "";
      $organizer = $request['organizer'] ?? "";
      $location = $request['location'] ?? "";
      $locationUpcoming = $request['locationUpcoming'] ?? "";
      
      if($search != ""){
        $events = Events::orderBy('event_id', 'desc')->where("event_name", "LIKE", "%$search%")->orWhere("event_slug", "LIKE", "%$search%")->paginate(3);
        $eventCount = $events->count();
      }else if($organizer != ""){
        $events = Events::orderBy('event_id', 'desc')->where("event_author_id", "=", "$organizer")->paginate(12);
        $eventCount = $events->count();
      }else if($location != ""){
        $events = Events::orderBy('event_id', 'desc')->where("event_location", "=", "$location")->paginate(12);
        $eventCount = $events->count();
      }else if($locationUpcoming != ""){
        $getEvents = Events::orderBy('event_id', 'desc')->where('event_location', '=', $locationUpcoming);
        $events = $getEvents->where('event_start_date', '>', date('Y-m-d'))->paginate(12);
        $eventCount = $events->count();
      }else{
        $events = Events::orderBy('event_id', 'desc')->where('event_status', '=', 1)->paginate(12);
        $eventCount = "";
      }
      $cities = Cities::all();
      $allOrganizers = Users::where('user_type', '=', 'OA')->get();
      $data = compact('events', 'cities' ,'location', 'allOrganizers', 'search', 'eventCount', 'organizer');
      return view('events')->with($data);
      // echo '<pre>';
      // print_r($organizers->toArray());
      // die;
    }

    public function userProfile(){
      $user_id = session()->get('user_id');
      $users = Users::find($user_id);
      $data = compact('users', 'user_id');
      return view('userProfile')->with($data);
    }

    public function updateUserProfile(Request $request){
      $request->validate([
        'userName' => 'required',
        'userEmail' => 'required|email',
    ]);
    $user_id = session()->get('user_id');
    $user = Users::find($user_id);
    $user->name = $request['userName'];
    $user->email = $request['userEmail'];
    $user->address = $request['userAddress'];
    $user->contact = $request['userContact'];
    $user->facebook = $request['facebook'];
    $user->instagram = $request['instagram'];
    $user->twitter = $request['twitter'];
    $user->youtube = $request['youtube'];
    if($request->file('userImage') != ""){
      $imageName = time().".".$request->file('userImage')->extension();
      $request->file('userImage')->move(public_path('Backend/users_images'), $imageName);
      $user->image = $imageName; 
      $user->avatar = $imageName; 
    }
    $user->update();
    if($user){
      return redirect()->back()->with('success', 'Profile Updated Successfully');
    }else{
      return redirect()->back()->with('error', 'Something Went Wrong');
    }
    }

    public function viewUserProfile($id){
      $users = Users::find($id);
      $user_id = $id;
      $data = compact('users', 'user_id');
      return view('userProfile')->with($data);
   }
   
    public function admin_updateUserProfile($id, Request $request){
      $request->validate([
        'userName' => 'required',
        'userEmail' => 'required|email',
    ]);
    $user_id = $id;
    $user = Users::find($user_id);
    $user->name = $request['userName'];
    $user->email = $request['userEmail'];
    $user->address = $request['userAddress'];
    $user->contact = $request['userContact'];
    $user->facebook = $request['facebook'];
    $user->instagram = $request['instagram'];
    $user->twitter = $request['twitter'];
    $user->youtube = $request['youtube'];
    if($request->file('userImage') != ""){
      $imageName = time().".".$request->file('userImage')->extension();
      $request->file('userImage')->move(public_path('Backend/users_images'), $imageName);
      $user->image = $imageName; 
      $user->avatar = $imageName; 
    }
    $user->update();
    if($user){
      return redirect()->back()->with('success', 'Profile Updated Successfully');
    }else{
      return redirect()->back()->with('error', 'Something Went Wrong');
    }
    }


    public function orgProfile(){
      $user_id = session()->get('user_id');
      $users = User::find($user_id);
      $events = Events::where('event_author_id', '=', $users->id)->get();
      $totalEvents = $events->count();
      $followers = Followers::where('organizer_id', '=', $user_id)->count();
      $whereIn = $events->pluck('event_id');
       $totalReviews = 0;
       foreach($whereIn as $column => $values){
         $totalReviews += eventReviews::where('event_id', '=', $values)->count();
      }
      $data = compact('users', 'events', 'totalEvents', 'followers', 'totalReviews');
      return view('orgProfile')->with($data);
    }

    public function allOrganizers(){
      $organizers = User::orderBy('id', 'desc')->where('user_type', '=', 'OA')->get();
      $data = compact('organizers');
      return view('organizers')->with($data);
    }

    public function viewOrgProfile($username){ 
       $users = Users::where('username', '=', $username)->first();
       $user_id = $users->id;
       $events = Events::orderBy('event_id', 'desc')->where('event_author_id', '=', $users->id)->get();
       $totalEvents = $events->count();
       $followers = Followers::where('organizer_id', '=', $user_id)->count();
       $whereIn = $events->pluck('event_id');
       $totalReviews = 0;
       foreach($whereIn as $column => $values){
         $totalReviews += eventReviews::where('event_id', '=', $values)->count();
      }
       $data = compact('users', 'events', 'totalEvents', 'followers', 'totalReviews');
       return view('orgProfile')->with($data);
    }

   

    public function changePassword(Request $request){
       $request->validate([
          'oldPassword' => 'required',
          'password' => 'required | confirmed',
          'password_confirmation' => 'required',
       ]);
           
       $oldPassword = Custom::oldPassword($request['oldPassword']);
       if($oldPassword === true){
        $user_id = session()->get('user_id');
          $user = Users::find($user_id);
          $user->password = md5($request['password']);
          $user->update();
          
          return redirect('logout')->with('success', 'Password Updated Successfully. Login With New Password');
       }else{
        return redirect()->back()->with('error', $oldPassword);
       }
    }


    public function edit_orgProfile($id){
      $user = User::find($id);
      $data = compact('user');
      return view('edit_orgProfile')->with($data);
    }

    public function update_orgProfile($id, Request $request){
      $request->validate([
        'name' => 'required',
        'orgName' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'contact' => 'required',
      ]);

      $user = User::find($id);
      $user->name = $request['name'];
      $user->org_name = $request['orgName'];
      $user->email = $request['email'];
      $user->address = $request['address'];
      $user->contact = $request['contact'];
      $user->website = $request['website'];
      $user->facebook = $request['facebook'];
      $user->instagram = $request['instagram'];
      $user->twitter = $request['twitter'];
      $user->youtube = $request['youtube'];
      if($request->file('image') != ""){
        $imageName = time()."-".rand(1,100).".".$request->file('image')->extension();
        $request->file('image')->move(public_path('Backend/users_images'), $imageName);
        $user->image = $imageName; 
        $user->avatar = $imageName; 
      }
      if($request->file('profileBg') != ""){
        $profileBgName = time()."-".rand(1,1000).".".$request->file('profileBg')->extension();
        $request->file('profileBg')->move(public_path('Backend/users_images'), $profileBgName);
        $user->profile_bg = $profileBgName; 
      }
      // check($user->toArray());
      $user->update();
      if($user){
        return redirect()->route('orgProfile');
      }
    }


}


