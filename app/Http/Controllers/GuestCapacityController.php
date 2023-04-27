<?php

namespace App\Http\Controllers;

use App\Models\GuestCapacity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestCapacityController extends Controller
{
    public function index(){
      $guestCapacity = GuestCapacity::all();
      $data = compact('guestCapacity');
        return view('admin.guestCapacity')->with($data);
    }

    public function guestCapacity_register(Request $request){
        $validator = Validator::make($request->all(), [
            'guestCapacity_range' => 'required',
        ]);
   
        if($validator->fails()){
          return response()->json(['errors'=> $validator->messages()]);
        }else{
          $guestCapacity = new GuestCapacity;
          $guestCapacity->guest_capacity_range = $request['guestCapacity_range'];
          $guestCapacity->save();
          return response()->json(['success'=> 'Guest Capacity has been Added Successfully.']);
   
        }
    }


    public function admin_guestCapacity_delete($id){
      $guestCapacity = GuestCapacity::find($id);
      $guestCapacity->delete();
      if($guestCapacity){
         return redirect('admin/guestCapacity');
      }else{
         return redirect('admin/guestCapacity');
      }
      }


}
