<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Issue;

use App\Http\Requests;

class IssueController extends Controller
{
    public function review($id){
      $issue = Issue::where('id', $id)->first();
      $issue->state = "Under Review";
      $issue->save();
      return redirect('/issues');
    }
    public function forward($id){
      $issue = Issue::where('id', $id)->first();
      $issue->state = "Forwarded";
      $issue->save();
      return redirect('/issues');
    }
    public function close($id){
      $issue = Issue::where('id', $id)->first();
      $issue->state = "Closed";
      $issue->save();
      return redirect('/issues');
    }

    public function getPic($filename){

      $file = Storage::disk('local')->get($filename);

      return (new Response($file, 200)) ->header('Content-Type', 'data:image/png');
    }

    public function issueNumbers(){
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
     $location = $request->input('location');
     $base64 = $request->input('picture');

     //convert base64 string to jpeg
     $jpg = (string) Image::make($base64)->encode('jpg', 75);

     $issue = Issue::create(array(
                       'name' => $name,
                       'location' => $location,
                       'state' => "New",
                     ));

      //picture is saved to storage with name 'id'.jpg returned from model 'create'
      Storage::disk('local')->put($issue->id.'.jpg', $jpg);

      return response()->json(Issue::all());

   }
}
