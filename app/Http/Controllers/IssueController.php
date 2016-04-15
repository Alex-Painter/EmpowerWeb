<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Cornford\Googlmapper\Mapper;
//use Davibennun\LaravelPushNotification\PushNotification;
use PushNotification;
use App\Issue;
use Auth;

use App\Http\Requests;

class IssueController extends Controller
{
    public function review($id){
      $issue = Issue::where('id', $id)->first();
      $issue->state = "Under Review";
      $issue->save();

      $message = Auth::user()->name . " from the council has updated your issue: "
      . $issue->name .
      ". It is now under review. Thank you.";

      $this->sendNotification($issue->regID, $message);
      return redirect('/issues');
    }

    public function forward($id){
      $issue = Issue::where('id', $id)->first();
      $issue->state = "Forwarded";
      $issue->save();

      $message = Auth::user()->name . " from the council has updated your issue: "
      . $issue->name .
      ". It has now been forwarded on to the relevant department. Thank you:";

      $this->sendNotification($issue->regID, $message);
      return redirect('/issues');
    }

    public function close($id){
      $issue = Issue::where('id', $id)->first();
      $issue->state = "Closed";
      $issue->save();

      $message = Auth::user()->name . " from the council has updated your issue: "
      . $issue->name .
      ". It is now closed. Thank you.";

      $this->sendNotification($issue->regID, $message);
      return redirect('/issues');
    }

    public function sendNotification($regID, $message){
      $device = PushNotification::Device($regID, array());

      $notifMessage = PushNotification::Message($message, array(
        'badge' => 1,
      ));
      $app = PushNotification::app('empowerMobile');

      $new_client = new \Zend\Http\Client(null, array(
                  'adapter' => 'Zend\Http\Client\Adapter\Socket',
                  'sslverifypeer' => false
                ));
      $app->adapter->setHttpClient($new_client);

      $app->to($device)->send($notifMessage);
    }

    /**
    * Return all issues in database in JSON
    *
    * @return Response
    */
   public function index()
   {
       return response()->json(Issue::all());
   }

   /**
    * Create a new issue from POST to domain/issue
    *
    * @return Response
    */
   public function store(Request $request)
   {

     $name = $request->input('name');
     $lat = $request->input('lat');
     $long = $request->input('long');
     $base64 = $request->input('picture');
     $regID = $request->input('regID');

     //convert base64 string to jpeg
     $jpg = (string) Image::make($base64)->encode('jpg', 75);

     $issue = Issue::create(array(
                       'name' => $name,
                       'lat' => $lat,
                       'long' => $long,
                       'state' => "New",
                       'regID' => $regID,
                     ));

      //picture is saved to storage with name 'id'.jpg returned from model 'create'
      Storage::disk('local')->put($issue->id.'.jpg', $jpg);

      //return response()->json(Issue::all());

   }

   public function send(){
     $deviceToken = "eiIFNzphT1U:APA91bElXlxLxiQX5_nn51tRsS2zY81Sq2sKiPWS_Gq1zXLYn4oJJNqSgHpDQ4BXv8CprllV9WMBgL1Z7okqpk0oehCsvxdBywEOvMkSMOF_hMC8LZrabMc29UAzXhIuBPCVCtQc-6n_";
     PushNotification::app('empowerMobile')
                ->to($deviceToken)
                ->send('Hello World, i`m a push message');
   }
}
