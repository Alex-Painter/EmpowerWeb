@extends('layouts.master')

@section('content')

<table class="table">
  <tr>
    <th>Issue #</th>
    <th>Title</th>
    <th>Location</th>
    <th>Date Submitted</th>
    <th>Picture</th>
    <th>State</th>
  </tr>
    @foreach ($issues as $issue)
    <tr>
      <td>{{ $issue->id }}</td>
      <td>{{ $issue->name }}</td>
      <td>Location</td>
      <td>{{ $issue->created_at }}</td>
      <td><img src="pictures/{{ $issue->picture }}" style="width:150px;"></td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-default">{{ $issue->state }}</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('review', ['id' =>$issue->id]) }}">Under Review</a></li>
            <li><a href="{{ route('forward', ['id' =>$issue->id]) }}">Forward to Department</a></li>
            <li><a href="{{ route('close', ['id' =>$issue->id]) }}">Close Issue</a></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
</table>

@endsection
