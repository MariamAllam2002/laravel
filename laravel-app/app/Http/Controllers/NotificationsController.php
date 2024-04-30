<?php

namespace App\Http\Controllers;
 
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Jobs\SendNotificationsJob;
use App\Imports\NotificationsImport;
use Maatwebsite\Excel\Facades\Excel;

class NotificationsController extends Controller
{
   public function index(){
    // $notifications = Notification::latest()->get(); 
      return('$notifications');   
   }

   public function store(Request $request)
   {
       $validatedData = $request->validate([
           'type' => 'required|string',
           'sender' => 'required|string',
           'recipient_ID' => 'required|integer',
           'content' => 'required|string',
           'status' => 'required|string',
       ]);
       $notification = Notification::create($validatedData); 
       return $notification;
   }
   public function send(){
    SendNotificationsJob::dispatch(new SendNotificationsJob());
    return('ayhaga');
   }
   public function import(Request $request) 
   {    print "in  ";
    //   $request->validate([
    // 'file' => ['required','file'],
    //   ]);
    Excel::import(new NotificationsImport, $request->file('file'));

       return('success, All good!');
   }
}
