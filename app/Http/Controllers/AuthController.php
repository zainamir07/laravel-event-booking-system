<?php

namespace App\Http\Controllers;

use App\Custom;
use App\Models\Notification;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function register_check(Request $request){
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
                    $user->email = $request['email'];
                    $user->password = Hash::make($request['password']);
                    $user->user_type = 'U';
                    $user->username = Custom::slug($request['name']).'-'.time();
                    $user->save();
                     
                    $useNewId = $user->id;
                    $notification = new Notification;
                    $notification->noti_title = 'New user: '.$request['name'].' has been registered successfully.';
                    $notification->noti_for = 'A';
                    $notification->noti_forId = '1';
                    $notification->noti_type = 'Reg';
                    $notification->noti_typeId = $useNewId;
                    $notification->noti_byId = $useNewId;
                    $notification->save();
                    return response()->json(['success'=> 'You have been Register Successfully. Login now']);
    
                  }
        }

   
        public function login_check(Request $request){
          //  return $request->all(); 
        $validator = Validator::make($request->all(), [
                      'email' => 'required|email',
                      'password' => 'required',
                  ]);
                  if($validator->fails()){
                    return response()->json(['errors'=> $validator->messages()]);
                  }
                  // else{ 
                    // if(Auth::guard('organizer')->attempt(['email' => $request['email'], 'password' => $request['password']])){
                    //   $user = Auth::guard('organizer')->user();
                    //     session()->put('user_id', $user->id);
                    //       session()->put('user_name', $user->name);
                    //       session()->put('org_name', $user->org_name);
                    //       session()->put('user_email', $user->email);
                    //       session()->put('user_type', 'OA');
                    //   return response()->json(['success']);
                    // }else
                    if(Auth::guard('web')->attempt(['email' => $request['email'], 'password' => $request['password']])){
                      $user = Auth::guard('web')->user();
                      if($user->user_type == 'U'){
                          session()->put('user_id', $user->id);
                          session()->put('user_name', $user->name);
                          session()->put('org_name', $user->org_name);
                          session()->put('user_email', $user->email);
                          session()->put('user_type', 'U');   
                      }elseif($user->user_type == 'OA'){
                        session()->put('user_id', $user->id);
                        session()->put('user_name', $user->name);
                        session()->put('org_name', $user->org_name);
                        session()->put('user_email', $user->email);
                        session()->put('user_type', 'OA');
                      }
                      return response()->json(['success']);
                    }elseif(Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']])){
                      $user = Auth::guard('admin')->user();
                          session()->put('admin_id', $user->id);
                          session()->put('admin_name', $user->name);
                          session()->put('admin_email', $user->email);
                          session()->put('user_type', 'A');
                      return response()->json(['success']);
                    }else{
                      return response()->json([0]);
                    }
        }


        public function org_register(){
          return view('auth.orgRegister');
        }

        public function org_register_check(Request $request){
          $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'orgName' => 'required',
                        'email' => 'required|email',
                        'address' => 'required',
                        'contact' => 'required',
                        'password' => 'required| confirmed',
                        'password_confirmation' => 'required',
                    ]);
      
                    if($validator->fails()){
                      return response()->json(['errors'=> $validator->messages()]);
                    }else{
                      $user = new User;
                      $user->name = $request['name'];
                      $user->org_name = $request['orgName'];
                      $user->email = $request['email'];
                      $user->address = $request['address'];
                      $user->contact = $request['contact'];
                      $user->website = $request['website'];
                      $user->username = Custom::slug($request['name']).'-'.time();
                      $user->password = Hash::make($request['password']);
                      $user->user_type = 'OA';
                      $user->save();

                      $useNewId = $user->id;
                      $notification = new Notification;
                      $notification->noti_title = 'New Organizer: '.$request['org_name'].' has been registered successfully.';
                      $notification->noti_for = 'A';
                      $notification->noti_forId = '1';
                      $notification->noti_type = 'Reg';
                      $notification->noti_typeId = $useNewId;
                      $notification->noti_byId = $useNewId;
                      $notification->save();

                      return response()->json(['success'=> 'Your Organization has been Register Successfully. Login now']);
      
                    }
          }



        public function logout(){
            session()->forget('user_id');
            session()->forget('user_name');
            session()->forget('org_name');
            session()->forget('user_email');
            session()->forget('user_type');
           if(Auth::guard('organizer')->check()){
            Auth::guard('organizer')->logout();
           }elseif(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
           }elseif(Auth::guard('admin')->check()){
            session()->forget('admin_id');
            session()->forget('admin_name');
            session()->forget('admin_email');
            Auth::guard('admin')->logout();
           }
            return redirect('login');
        }


}
