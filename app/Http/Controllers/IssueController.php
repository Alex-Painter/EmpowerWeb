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
}
