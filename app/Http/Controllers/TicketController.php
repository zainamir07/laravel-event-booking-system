<?php

namespace App\Http\Controllers;

use App\Models\BuyTickets;
use App\Models\EventImages;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Custom;

class TicketController extends Controller
{
    public function index(){
        $tickets = BuyTickets::orderBy('buy_ticket_id', 'desc')->get();
        $data = compact('tickets');
        return view('admin.tickets')->with($data);
    }
    public function viewTicketDetails($id){
        $event = Events::find($id);
        $eventImages = EventImages::where('event_list_id', '=', $id)->get();
        $eventName = Custom::orgName($event->event_author_id);
        if($event->event_subscription == 'P'){
            $eventSubscription = '<span class="badge badge-danger">Paid</span>';
            $eventTicketPrice = '<span>'.$event->event_ticket_price.'</span>';
        }elseif($event->event_subscription == 'F'){
            $eventSubscription = '<span class="badge badge-danger">Free</span>';
            $eventTicketPrice = '<span>0</span>';
        }
        // else{
        //     $eventSubscription = $event->event_subscription;
        // }
        $totalTickets = $event->event_guestCapacity;
        $remainingTickets = Custom::availableSeats($event->event_id);
        $eventLocation = Custom::cityName($event->event_location);
        $eventAddress = $event->event_address;
        $eventStartDate = "(<i class='fa fas fa-calendar-alt text-primary'></i> ".$event->event_start_date .") "." "." (<i class='fa far fa-clock text-primary'></i> ". $event->event_start_time .")";
        $eventEndDate = "(<i class='fa fas fa-calendar-alt text-primary'></i> ".$event->event_end_date .") "." "." (<i class='fa far fa-clock text-primary'></i> ". $event->event_end_time .")";
        if($event){
            return response()->json([
                'event' => $event,
                'eventImages' => $eventImages,
                'eventName' => $eventName,
                'eventSubscription' => $eventSubscription,
                'eventTicketPrice' => $eventTicketPrice,
                'totalTickets' => $totalTickets,
                'remainingTickets' => $remainingTickets,
                'eventLocation' =>$eventLocation,
                'eventAddress' => $eventAddress,
                'eventStartDate' => $eventStartDate,
                'eventEndDate' => $eventEndDate,
            ]);
        }
    }
     

    public function org_tickets(){
        if(session()->get('user_type') == 'OA'){
        $user_id = session()->get('user_id');
        $events = Events::where('event_author_id', '=', $user_id)->get();
        $eventId = $events->pluck('event_author_id')->first();
        $soldTickets = BuyTickets::orderBy('buy_ticket_id', 'desc')->where('buyer_event_author_id', '=', $eventId)->paginate(10);
        $data = compact('soldTickets');
        return view('myTickets')->with($data);   

    }elseif(session()->get('user_type') == 'U'){
        $user_id = session()->get('user_id');
        // $events = Events::where('event_author_id', '=', $user_id)->get();
        // $eventId = $events->pluck('event_author_id')->first();
        $soldTickets = BuyTickets::orderBy('buy_ticket_id', 'desc')->where('buyer_user_id', '=', $user_id)->paginate(10);
        $data = compact('soldTickets');
        return view('myTickets')->with($data);
        // return redirect('events');
    }
      }

      public function org_ticket_details($slug){
         $eventId = Events::where('event_slug', '=', $slug)->first();
         $soldTickets = BuyTickets::where('buyer_event_id', '=', $eventId->event_id)->orderBy('buy_ticket_id', 'desc')->get();
        //  echo '<pre>';
        //  print_r($tickets->toArray());
        //  die;
         $data = compact('soldTickets');
         return view('myTickets')->with($data);
      }


      public function payment(){
        return view('payment');
      }

}
