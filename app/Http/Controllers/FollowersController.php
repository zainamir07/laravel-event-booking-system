<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\Notification;
use App\Models\Organizer;
use App\Models\Users;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    
    public function new_folow_request(Request $request){
        // return response()->json([$request->org_id]);
       $org_id = $request->org_id;
       $status = $request->status;
        if($status == 1){
          $follow = new Followers;
          $follow->user_id = session()->get('user_id');
          $follow->organizer_id = $org_id;
          $follow->save();
          $notification = new Notification;
          $notification->noti_title = 'User: '.session()->get('user_name').' Follow you.';
          $notification->noti_for = 'OA';
          $notification->noti_forId = $org_id;
          $notification->noti_type = 'F';
          $notification->noti_byId = session()->get('user_id');
          $notification->save();

            return response()->json(['success'=> 'Follow Successfully.']);
        }else if($status == 0){
          $follow = Followers::where('user_id', '=', session()->get('user_id'))->where('organizer_id', '=', $org_id)->first();
          $follow_id = $follow->follow_id;
          $follow->delete();
          $notification = new Notification;
          $notification->noti_title = 'User: '.session()->get('user_name').' UnFollow you.';
          $notification->noti_for = 'OA';
          $notification->noti_forId = $org_id;
          $notification->noti_type = 'F';
          $notification->noti_byId = session()->get('user_id');
          $notification->save();
          return response()->json(['success'=> 'UnFollow Successfully']);
        }
      }

    public function showOrgFollowers(){
     $org_id = session()->get('user_id');
     $followers = Followers::orderBy('follow_id', 'desc')->orderBy('follow_id', 'desc')->where('organizer_id', '=', $org_id)->get();
     $data = compact('followers');
     return view('orgFollowers')->with($data);
    }

    public function org_remove_follower(Request $request){
        $user_id = $request->user_id;
        $org_id = session()->get('user_id');
        $follower = Followers::where('user_id', '=', $user_id)->where('organizer_id', '=', $org_id)->first();
        $follow_id = $follower->follow_id;
        $follower->delete();
        $notification = new Notification;
        $notification->noti_title = 'Organizer: '.session()->get('org_name').' Remove you from their Followers.';
        $notification->noti_for = 'U';
        $notification->noti_forId = $user_id;
        $notification->noti_type = 'F';
        $notification->noti_byId = $org_id;
        $notification->save();
        if($follower){
        return response()->json(['success', 'Follower has beed removed']);
        }
        return response()->json(['errors', 'Something went wrong']);
    }

    public function user_following_check(Request $request){
      $user_id = $request->user_id;
      $following = Followers::where('user_id', '=', $user_id)->get();
      $organizers = $following->pluck('organizer_id');
     $users = array();
     foreach($organizers as $org) {
     $users[] = Organizer::where('id', '=', $org)->first();
     }
     if($users){
       return response()->json([ 'users' => $users]);
     }else{
       return response()->json([ 'errors' => 'Something Went Wrong']);
     }
 }

    public function user_following_remove(Request $request){
      $org_id = $request->org_id;
      $user_id = session()->get('user_id');
      $follower = Followers::where('user_id', '=', $user_id)->where('organizer_id', '=', $org_id)->first();
      $follow_id = $follower->follow_id;
      $follower->delete();
      $notification = new Notification;
      $notification->noti_title = 'User: '.session()->get('user_name').' UnFollow you.';
      $notification->noti_for = 'OA';
      $notification->noti_forId = $org_id;
      $notification->noti_type = 'F';
      $notification->noti_byId = session()->get('user_id');
      $notification->save();
      if($follower){
      return response()->json(['success', 'Success']);
      }
      return response()->json(['errors', 'Something went wrong']);
    }

}
