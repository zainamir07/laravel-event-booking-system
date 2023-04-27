<?php 

namespace App;

use App\Models\Brand;
use App\Models\BuyTickets;
use App\Models\CarModels;
use App\Models\Users;
use App\Models\Colors;
use App\Models\Cities;
use App\Models\EventImages;
use App\Models\eventReviews;
use App\Models\Events;
use App\Models\Followers;
use App\Models\GuestCapacity;
use App\Models\Listing;
use App\Models\ListingImages;
use App\Models\Organizer;
use App\Models\User;

class Custom{
    
    public static function cityName($city_id){
        $cities = Cities::find($city_id);
        return $cities->city;
     }
     
     public static function getEventTitle($id){
      $event = Events::find($id);
      return $event->event_name;
   }
   public static function getEventUrl($id){
      $event = Events::find($id);
      return $event->event_slug ?? '/';
   }
   public static function getEventOrgName($id){
      $event = Events::find($id);
      $org_id = $event->event_author_id;
      $user = User::where('id', '=', $org_id)->first();
      return $user->org_name;
   }
   public static function getEventOrgId($id){
      $event = Events::find($id);
      $org_id = $event->event_author_id;
      $user = User::where('id', '=', $org_id)->first();
      return $user->id;
   }
   public static function getEventOrgUsername($id){
      $event = Events::find($id);
      $org_id = $event->event_author_id;
      $user = User::where('id', '=', $org_id)->first();
      return $user->username;
   }
   public static function orgUsername($id){
      $user = User::where('id', '=', $id)->first();
      return $user->username;
   }
   public static function getEventOrgProfile($id){
      $event = Events::find($id);
      $org_id = $event->event_author_id;
      // $user = Users::where('id', '=', $org_id)->first();
      return $org_id;
   }
   public static function getEventReviewUrl($id){
      $review = eventReviews::where('review_id', '=', $id)->first();
      $eventId = Events::where('event_id', '=', $review->event_id)->first();
      return $eventId->event_slug ?? '/';
   }
   public static function totalReviews($authorID){
      $events = Events::where('event_author_id', '=', $authorID)->get();
      $whereIn = $events->pluck('event_id');
      $totalReviews = 0;
      foreach($whereIn as $column => $values){
        $totalReviews += eventReviews::where('event_id', '=', $values)->count();
     }
     return $totalReviews;
      // check($event);
      // $event_author_id = $event->event_author_id;
      
      // $org_id = $event->event_author_id;
      // $user = Users::where('id', '=', $org_id)->first();
      // return $org_id;
   }

   public static function placeRating($id)
   {
       $rates = eventReviews::where('event_id',$id)->select('stars')->get()->toArray();
       $totalEvents = eventReviews::where('event_id', '=', $id)->count();
      //  PlaceRating::where('place_id',$id)->selectRaw('SUM(rating)/COUNT(user_id) AS avg_rating')->first()->avg_rating;
          $rateArray =[];
          foreach ($rates as $rate)
          {
              $rateArray[]= $rate['stars'];
          }

           $sum = array_sum($rateArray);
           $result = $sum == 0 ? 0 : $sum/$totalEvents;

           return number_format($result, 1);
   }
   
   
   public static function eventImagePath($id){
      $image = EventImages::where('event_list_id', '=', $id)->first();
      $image_path = $image->event_image_path;
      return 'Backend/event_images/'.$image_path;
   }

   public static function userImagePath($id){
      $user = User::where('id', '=', $id)->first();
      $image_path = $user->image;
      if($image_path == ""){
         return 'Backend/users_images/default.jpg';
      }else{
         return 'Backend/users_images/'.$image_path;
      }
   }
   // public static function userImagePath($id){
   //    $user = Users::where('id', '=', $id)->first();
   //    $image_path = $user->image;
   //    if($image_path == ""){
   //       return 'Backend/users_images/default.jpg';
   //    }else{
   //       return 'Backend/users_images/'.$image_path;
   //    }
   // }
   public static function userBgImagePath($id){
      $user = User::where('id', '=', $id)->first();
      $image_path = $user->profile_bg;
      if($image_path == ""){
         return 'Backend/user_images/1672255579.jpg';
      }else{
         return 'Backend/users_images/'.$image_path;
      }
   }
   
   // http://127.0.0.1:8000/Backend/users_images/1672083048.jpg
   public static function eventName($id){
      $event = Events::where('event_id', '=', $id)->first();
      $event_name = $event->event_name;
      return $event_name;
   }

   public static function followCheck($user_id, $org_id){
       $follow = Followers::where('user_id', '=', $user_id)->where('organizer_id', '=', $org_id)->first();
      //  return $follow;
      if($follow == ''){
         return false;
      }else{
         return true;
      }
   }

   public static function user_following_count($user_id){
      $following = Followers::where('user_id', '=', $user_id)->count();
      return $following;
   }

   // public static function orgIdByEventId($id){
   //    $event = Events::where('event_author_id', '=', $id)->first();
   //    $event_name = $event->event_name;
   //    return $event_name;
   // }
   
   public static function allYears(){
      $years = range(date('Y'), 1940);
      return $years;
   }
   
   public static function authorName($id){
     $user = User::find($id);
     return $user->name;
   }

   public static function orgName($id){
      $user = User::find($id);
      if($user){
         return $user->org_name;
      }
    }

   //  public static function orgId($id){
   //    $user = Users::find($id);
   //    return $user->id;
   //  }

   public static function userInfo($id, $value){
      $user = User::find($id);
      return $user->$value;
    }

    public static function availableSeats($eventId){
    $buyTicket = BuyTickets::where('buyer_event_id', '=', $eventId)->count();
    $events = Events::find($eventId);
    $total = $events->event_guestCapacity;
    $totalSeats = $total - $buyTicket;
    if($totalSeats <= 0){
      return 'Not Available';
    }else{
       return $totalSeats;
    }
    }

    public static function soldTickets($eventId){
      $buyTicket = BuyTickets::where('buyer_event_id', '=', $eventId)->count();
      return $buyTicket;
      }

    public static function buyTicketCheckUserId($eventID){
      $id = session()->get('user_id');
      $buyTicket = BuyTickets::where('buyer_event_id', '=', $eventID)->get();
      $buyTicketCheck = $buyTicket->where('buyer_user_id', '=', $id)->first();
      $userType = session()->get('user_type');

      
      if($userType == ""){
         return 0;
      }else{

       if($userType == 'OA'){
         return 1;
      }else if($userType == 'A'){
          return 2;
      }else if($userType == 'U'){

         if($buyTicketCheck != ''){
            return 'P';
         }else if($buyTicketCheck == ''){
            return 'NP';
         }
      }

      }
     
   }
      // if($buyTicketeCheck != ''){
      //    return true;
      // }else{
      //    return false;
      // }


   public static function slug($text, string $divider = '-')
   {
     // replace non letter or digits by divider
     $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
   
     // transliterate
     $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
   
     // remove unwanted characters
     $text = preg_replace('~[^-\w]+~', '', $text);
   
     // trim
     $text = trim($text, $divider);
   
     // remove duplicate divider
     $text = preg_replace('~-+~', $divider, $text);
   
     // lowercase
     $text = strtolower($text);
   
     if (empty($text)) {
       return 'n-a';
     }
   
     return $text;
   }

   public static function oldPassword($password){
      $user_id = session()->get('user_id');
      $user = Users::find($user_id);
      $oldPassword = $user->password;
      if(md5($password) == $oldPassword){
         return true;
      }else{
         return "Old Password Does Not Match";
      }
  }

  public static function reviewsCheck($event_id){
    $reviews = eventReviews::where('event_id', '=', $event_id)->where('user_id', '=', session()->get('user_id'))->first();
    if($reviews != ""){
      $stars = $reviews->stars;
      $description = $reviews->description;
      return $stars;
    }else{
      return false;
    }

  }

    }




?>