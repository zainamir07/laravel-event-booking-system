<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    
    public function org_notifications(){
      $followNotifications = Notification::orderBy('noti_id', 'desc')->where('noti_for', '=', 'OA')->where('noti_forId', '=', session()->get('user_id'))->paginate(10);
      foreach ($followNotifications as $key => $value) {
              $notiId = $value->noti_id;
              $update = Notification::find($notiId);
              $update->noti_status = 1;
              $update->update(); 
      }

      $data = compact('followNotifications');
      return view('o_notification')->with($data);
    }

    public function u_notifications(){
        $followNotifications = Notification::orderBy('noti_id', 'desc')->where('noti_for', '=', 'U')->where('noti_forId', '=', session()->get('user_id'))->paginate(10);
        foreach ($followNotifications as $key => $value) {
            $notiId = $value->noti_id;
            $update = Notification::find($notiId);
            $update->noti_status = 1;
            $update->update(); 
    }
        $data = compact('followNotifications');
        return view('u_notifications')->with($data);
      }

      public function total_org_notification(){
          view()->composer('*', function (View $view) {
              $totalNotifications = Notification::orderBy('noti_id', 'desc')->where('noti_for', '=', 'OA')->count();
            $data = compact('totalNotifications');
            $view->with($data);
        });
       
      }

}
