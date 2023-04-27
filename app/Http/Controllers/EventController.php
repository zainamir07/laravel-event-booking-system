<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\EventType;
use App\Models\GuestCapacity;
use App\Custom;
use App\Models\BuyTickets;
use App\Models\EventImages;
use App\Models\Events;
use App\Models\Followers;
use App\Models\Notification;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\EventListCommand;

class EventController extends Controller
{
    public function index(){
      $eventList = Events::orderBy('event_id', 'desc')->paginate(5);
      $paidEvents = Events::where('event_subscription', '=', 'P')->orderBy('event_id', 'desc')->paginate(5);
      $freeEvents = Events::where('event_subscription', '=', 'F')->orderBy('event_id', 'desc')->paginate(5);
      $eventImages = EventImages::all();
      // $guestCapacity = GuestCapacity::all();
      
      $data = compact('eventList', 'paidEvents', 'freeEvents', 'eventImages');
        return view('admin.events')->with($data);
    }
    public function eventTypes(){
        $eventType = EventType::all();
        $data = compact('eventType');
        return view('admin.eventTypes')->with($data);
    }

    public function eventTypes_register(Request $request){
        $validator = Validator::make($request->all(), [
            'eventTypeName' => 'required',
        ]);
   
        if($validator->fails()){
          return response()->json(['errors'=> $validator->messages()]);
        }else{
          $eventType = new EventType;
          $eventType->event_type_name = $request['eventTypeName'];
          $eventType->save();
          return response()->json(['success'=> 'Event Type has been Added Successfully.']);
        }
    }

    public function admin_eventType_edit(Request $request){
        $eventType_id = $request->eventType_id;
        $eventType = EventType::find($eventType_id);
        return response()->json([
          'eventType' => $eventType,
      ]);
    }

    public function admin_eventType_update($id, Request $request){
        $validator = Validator::make($request->all(), [
           'edit_eventTypeName' => 'required',
       ]);
       if($validator->fails()){
         return response()->json(['errors'=> $validator->messages()]);
       }else{
         $eventType = EventType::find($id);
         $eventType->event_type_name = $request['edit_eventTypeName'];
         $eventType->update();
         return response()->json(['success'=> 'Updated Successfully']);
  
       }
     }  
    
     public function admin_eventType_delete($id){
        $eventType = EventType::find($id);
        $eventType->delete();
        if($eventType){
           return redirect('admin/eventTypes');
        }else{
           return redirect('admin/eventType');
        }
        }

        public function admin_createEvent(){
          // $guestCapacity = GuestCapacity::all();
          $cities = Cities::all();
          $images = EventImages::all();
          $data = compact('cities');
          return view('admin.createEvent')->with($data);
        }

        public function admin_storeEvent(Request $request){               
            $request->validate([
                'eventName' => 'required',
                'eventLocation' => 'required',
                'eventAddress' => 'required',
                'startDate' => 'required',
                'startTime' => 'required',
                'endDate' => 'required',
                'endTime' => 'required',
                'guestCapacity' => 'required',
                'eventSubscription' => 'required',
                'eventDescription' => 'required',
                'files' => 'required',
            ]);
            $eventLocation = Custom::cityName($request['eventLocation']);
            $slug = Custom::slug($request['eventName']." in ".$eventLocation." ".time());
     
            $event = new Events;
            
            $event->event_name = $request['eventName'];
            $event->event_location = $request['eventLocation'];
            $event->event_address = $request['eventAddress'];
            $event->event_start_date = $request['startDate'];
            $event->event_start_time = $request['startTime'];
            $event->event_end_date = $request['endDate'];
            $event->event_end_time = $request['endTime'];
            $event->event_guestCapacity = $request['guestCapacity'];
            $event->event_subscription = $request['eventSubscription'];
            if($request['eventTicketPrice'] == ""){
            $event->event_ticket_price = '0';
            }else{
              $event->event_ticket_price = $request['eventTicketPrice'];
            }
            $event->event_description = $request['eventDescription'];
            $event->event_author_id = session()->get('user_id');
            $event->event_slug = $slug;
            $event->save();
            $event_newId = $event->event_id;
            //Image Uploading to the Other Table
            if($request['files'] != ""){
              $i = 1;
              foreach ($request->file('files') as $uploadImages) {
                $eventImages = new EventImages;
                
                $imageName = $event_newId.'_'.$i.'_'.time().".".$uploadImages->extension();
                $uploadImages->move(public_path('Backend/event_images'), $imageName);
                $eventImages->event_image_path = $imageName; 
                $eventImages->event_list_id = $event_newId;
                $eventImages->save();  
                $i++;
              }        
            }

          $followers = Followers::where('organizer_id', '=', session()->get('user_id'))->get();
          $users = $followers->pluck('user_id');
          foreach ($users as $key => $value) {
          $notification = new Notification;
          $notification->noti_title = 'Organizer: '.session()->get('org_name').' created new Event';
          $notification->noti_for = 'U';
          $notification->noti_forId = $value;
          $notification->noti_type = 'E';
          $notification->noti_typeId = $event_newId;
          $notification->noti_byId = session()->get('user_id');
          $notification->save();
          }

       if($eventImages){
        if(session()->get('user_type') == 'A'){
          return redirect()->route('admin.events')->with('success', 'Successfully Added');
        }else{
          return redirect()->route('org_events')->with('success', 'Successfully Added');
         }
       }
        }


        public function admin_editEvent($id){
          $event = Events::find($id);
          $cities = Cities::all();
          $images = EventImages::where('event_list_id', '=', $id)->get();
          $data = compact('event', 'cities', 'images');
          return view('admin.editEvent')->with($data);
        }

        public function admin_editImage($id){
          $images = EventImages::find($id);
          $img_path = public_path("Backend/event_images/".$images->event_image_path);  
          File::delete($img_path);
          $images->delete();
          return response()->json(['success'=> 'Image has been Deleted Successfully']);
       }

       public function admin_updateEvent($id, Request $request){     
        $request->validate([
            'eventName' => 'required',
            'eventLocation' => 'required',
            'eventAddress' => 'required',
            'startDate' => 'required',
            'startTime' => 'required',
            'endDate' => 'required',
            'endTime' => 'required',
            'guestCapacity' => 'required',
            'eventSubscription' => 'required',
            'eventDescription' => 'required',
            // 'files' => 'required',
        ]);
        $eventLocation = Custom::cityName($request['eventLocation']);
        $slug = Custom::slug($request['eventName']." in ".$eventLocation." ".time());
 
        $event = Events::find($id);
        
        $event->event_name = $request['eventName'];
        $event->event_location = $request['eventLocation'];
        $event->event_address = $request['eventAddress'];
        $event->event_start_date = $request['startDate'];
        $event->event_start_time = $request['startTime'];
        $event->event_end_date = $request['endDate'];
        $event->event_end_time = $request['endTime'];
        $event->event_guestCapacity = $request['guestCapacity'];
        $event->event_subscription = $request['eventSubscription'];
        if($request['eventTicketPrice'] == ""){
        $event->event_ticket_price = '0';
        }else{
          $event->event_ticket_price = $request['eventTicketPrice'];
        }
        $event->event_description = $request['eventDescription'];
        $event->event_author_id = session()->get('user_id');
        $event->event_slug = $slug;
        $event->update();

        $event_newId = $event->event_id;
            
      if($request['files'] != ""){
        $i = 1;
        foreach ($request->file('files') as $uploadImages) {
      $eventImages = new EventImages;
      
      $imageName = $event_newId.'_'.$i.'_'.time().".".$uploadImages->extension();
      $uploadImages->move(public_path('Backend/event_images'), $imageName);
      $eventImages->event_image_path = $imageName; 
      $eventImages->event_list_id = $event_newId;
      $eventImages->save();  
      $i++;
    }        
   }
   if($event){
    if(session()->get('user_type') == 'A'){
      return redirect()->route('admin.events')->with('success', 'Successfully Updated');
    }else{
      return redirect()->route('org_events')->with('success', 'Successfully Updated');
     }
   }
    }

    public function editEvent($id){
      $event = Events::find($id);
      $cities = Cities::all();
      $images = EventImages::where('event_list_id', '=', $id)->get();
      $data = compact('event', 'cities', 'images');
      return view('edit_event')->with($data);
    }

        public function deleteEvent($id){
          $events = Events::find($id);
          $eventImages = EventImages::where('event_list_id', '=', $events->event_id)->get();
          $eventTickets = BuyTickets::where('buyer_event_id', '=', $events->event_id)->get();
          $events->delete();
          
          foreach ($eventImages as $img) {
            $img_path = public_path("Backend/event_images/".$img->event_image_path);  
            File::delete($img_path);
            $img->delete();
            }
          foreach ($eventTickets as $ticket) {
            $ticket->delete();
          }
          if(session()->get('user_type') == 'A'){
            return view('admin.events');
          }else{
            return view('myEvents');
           }
        }
        
        // Organizer delete their event 
        public function deleteMyEvent($id){
          $events = Events::find($id);
          $eventImages = EventImages::where('event_list_id', '=', $events->event_id)->get();
          $eventTickets = BuyTickets::where('buyer_event_id', '=', $events->event_id)->get();
          $events->delete();
          
          foreach ($eventImages as $img) {
            $img_path = public_path("Backend/event_images/".$img->event_image_path);  
            File::delete($img_path);
            $img->delete();
            }
          foreach ($eventTickets as $ticket) {
            $ticket->delete();
          }
          if(session()->get('user_type') == 'A'){
            return view('admin.events');
          }else{
            return view('myEvents');
           }
        }


        public function create_event(){
          $guestCapacity = GuestCapacity::all();
          $cities = Cities::all();
          $images = EventImages::all();
          $data = compact('guestCapacity', 'cities');
          return view('createEvent')->with($data);
        }
    
        public function org_events(){
          $user_id = session()->get('user_id');
          $eventList = Events::orderBy('event_id', 'desc')->where('event_author_id', '=', $user_id)->get();
          $totalEvents = $eventList->count();
          // $activeEvents = $eventList->where('event_status', '=', 1)->count();
          // $inActiveEvents = $eventList->where('event_status', '=', 0)->count();
          $date = date('Y-m-d');
          $completedEvents = $eventList->where('event_start_date', '<', $date);
          $completedTotalEvents = $eventList->where('event_start_date', '<', $date)->count();
          $upcommingEvents = $eventList->where('event_start_date', '>', $date);
          $upcommingTotalEvents = $eventList->where('event_start_date', '>', $date)->count();
          $TodayEvents = $eventList->where('event_start_date', '=', $date);
          $TodayTotalEvents = $eventList->where('event_start_date', '=', $date)->count();
          // echo '<pre>';
          // print_r($completedEvents->toArray());
          // die;
          $data = compact('totalEvents', 'upcommingEvents', 'upcommingTotalEvents', 'completedEvents', 'completedTotalEvents', 'TodayEvents', 'TodayTotalEvents');
          return view('myEvents')->with($data);
        }

        public function user_events(){
          $user_id = session()->get('user_id');
          $bookEvents = BuyTickets::orderBy('buy_ticket_id', 'desc')->where('buyer_user_id', '=', $user_id)->get();
          $eventId = $bookEvents->pluck('buyer_event_id');
          // $events = Events::where('event_id', '=', $eventId);
        
        $events = Events::orderBy('event_id', 'desc')->get();
        $whereIn = ['event_id' => $eventId];
        foreach($whereIn as $column => $values){
          $events = $events->whereIn($column, $values);
      }

        $data = compact('events');
        return view('userBookEvents')->with($data);    

        }
}
