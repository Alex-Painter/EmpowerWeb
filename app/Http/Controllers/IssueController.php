<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Cornford\Googlmapper\Mapper;
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
      . $issue->title .
      ". It is now under review. Thank you.";

      $this->sendNotification($issue->regID, $message);
      return redirect('/issues');
    }

    public function forward($id){
      $issue = Issue::where('id', $id)->first();
      $issue->state = "Forwarded";
      $issue->save();

      $message = Auth::user()->name . " from the council has updated your issue: "
      . $issue->title .
      ". It has now been forwarded on to the relevant department. Thank you.";

      $this->sendNotification($issue->regID, $message);
      return redirect('/issues');
    }

    public function close($id){
      $issue = Issue::where('id', $id)->first();
      $issue->state = "Closed";
      $issue->save();

      $message = Auth::user()->name . " from the council has updated your issue: "
      . $issue->title .
      ". It is now closed. Thank you.";

      $this->sendNotification($issue->regID, $message);
      return redirect('/issues');
    }

    public function sendNotification($regID, $message){
      $device = PushNotification::Device($regID, array());

      $notifMessage = PushNotification::Message($message, array(
        'title' => 'Update on your Issue'
      ));

      $app = PushNotification::app('empowerMobile')->to($regID);

      $app->adapter->setAdapterParameters(['sslverifypeer' => false]);

      $app->send($notifMessage);
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

     $title = $request->input('title');
     $lat = $request->input('lat');
     $long = $request->input('long');
     $base64 = $request->input('picture');
     $regID = $request->input('token');
     $category = $request->input('category');

     //convert base64 string to jpeg
     $jpg = (string) Image::make($base64)->encode('jpg', 75);

     $issue = Issue::create(array(
                       'title' => $title,
                       'category' => $category,
                       'lat' => $lat,
                       'long' => $long,
                       'state' => "New",
                       'regID' => $regID
                     ));

      //picture is saved to storage with name 'id'.jpg returned from model 'create'
      Storage::disk('local')->put($issue->id . ".jpg", $jpg);

      //return response()->json(Issue::all());

   }
}
