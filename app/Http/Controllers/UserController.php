<?php

namespace App\Http\Controllers;

use App\Custom;
use App\Models\Followers;
use App\Models\Notification;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = Users::orderBy('id', 'desc')->where('user_type', '=', 'U')->paginate(10);
        $data = compact('users');
        return view('admin.users')->with($data);
    }

    public function organizations(){
      $users = Users::where('user_type', '=', 'OA')->get();
      $data = compact('users');
      return view('admin.organization')->with($data);
    }

    public function status_check(Request $request){
        $user = $request->user_id;
        $user = Users::find($user);
        
        if($user != ""){
          $user->status = $request->status;
          $user->update();
           return response()->json(['user'=> $user]);
          }else{
           return response()->json(['errors'=> 'Something Went Wrong']);
          }
      }
 
     
      public function admin_user_register(Request $request){
       //   return response()->json([$request]);
       $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required| confirmed',
          'password_confirmation' => 'required',
      ]);
 
      if($validator->fails()){
        return response()->json(['errors'=> $validator->messages()]);
      }else{
         
        $user = new Users;
        $user->name = $request['name'];
        $user->org_name = $request['org_name'];
        $user->email = $request['email'];
        $user->contact = $request['contact'];
        $user->address = $request['address'];
        if($request['org_type'] != ""){
          $user->user_type = $request['org_type'];
        }else{
          $user->user_type = 'U';
        }
        $user->password = md5($request['password']);
        $user->save();
        return response()->json(['success'=> 'You have been Register Successfully. Login now']);
 
      }
      }
 
 
      public function admin_user_edit(Request $request){
           $user_id = $request->user_id;
           $user = Users::find($user_id);
           return response()->json([
             'user' => $user,
         ]);
      }
 
    public function admin_user_update($id, Request $request){
       $validator = Validator::make($request->all(), [
          'editname' => 'required',
          'editemail' => 'required|email',
      ]);
       
      if($validator->fails()){
        return response()->json(['errors'=> $validator->messages()]);
      }else{
         
        $user = Users::find($id);
        $user->name = $request['editname'];
        $user->email = $request['editemail'];
        $user->contact = $request['editcontact'];
        $user->address = $request['editaddress'];
        $user->update();
        return response()->json(['success'=> 'You have been Updated Successfully']);
 
      }
    }  
 
    public function admin_user_delete($id){
    $user = Users::find($id);
    $user->delete();
    if($user){
       return redirect()->back();
    }else{
       return redirect()->back();
    }
    }

    // public function event_notifications_for_follow_users(){
      //Get All Notifications
      // $allNotifications = Notification::orderBy('noti_id', 'desc')->where('noti_type', '=', 'E')->where('noti_for', '=', 'U')->paginate(10);
      // $allNotifications = Notification::orderBy('noti_id', 'desc')->paginate(10);
      // //Get Organizers Id Fron Notifications
      //  $org_id = $allNotifications->pluck('noti_byId');
      //  //user Must Be Follow That Organizer
      //  foreach($org_id as $value) {
      //  $follow_check[] = Followers::where('user_id', '=', session()->get('user_id'))->where('organizer_id', '=', $value)->first();
      //  }

      // //  check($follow_check);

      // //Get All Notifications 
      // // $find_notification = array();
      //  foreach ($follow_check as $key => $value) {
      //       // if ($key == 3) {
      //       //   checkArray($value);
      //       // }
      //    $find_notification[] = Notification::orderBy('noti_id', 'desc')->where('noti_byId', '=', $value->organizer_id ?? '')->where('created_at', '>', $value->created_at ?? '')->pluck('noti_id');
      //   }
      //   // var_dump($final_notification);
      //  $final_notification[] = array_filter($find_notification);
      //   // check($final_notification);

      // $data = compact('final_notification');
      // return view('notifications')->with($data); 
      
    //   $data = compact('allNotifications');
    //   return view('notifications')->with($data); 
    // }

   

}
