<h1>Update</h1>
<h3>{{$details['title']}}</h3>
<div>{{$details['message']}}</div>
@if($details['title'] !== $details['new_title'])
    <h3>New title - {{$details['new_title']}}</h3>
@endif
@if($details['message'] !== $details['new_message'])
    <h3>New description</h3>
    <div>{{$details['new_message']}}</div>
@endif



