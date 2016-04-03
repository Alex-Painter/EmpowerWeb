<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    * Display a listing of the resource.
    *
    * @return Response
    */
   public function index()
   {
       return response()->json(Issue::all());
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function store(Request $request)
   {

     $name = $request->input('name');
     $location = $request->input('location');
     $base64 = $request->input('picture');

     //$picture = base64_to_jpeg($base64, $picture);

     Issue::create(array(
                       'name' => $name,
                       'location' => $location,
                       'picture' => $base64,
                       'state' => "New",
                     ));

      return response()->json(Issue::all());

   }

   private function base64_to_jpeg($base64String, $outputFile){
     $stream = fopen($outputFile, "wb");

     $data = explode(',', $base64String);

     fwrite($stream, base64_decode($data[1]));
     fclose($stream);

     return $outputFile;
   }
}
