@component('mail::message')

Thank you  for your message<br>
@php
    //dd($data);
@endphp
<strong>Name : <strong/> {{ $data['name'] }} <br>
<strong>Email : <strong/> {{ $data['email'] }} <br>
<strong>Subject : <strong/> {{ $data['subject'] }} <br>
<strong>Message : <strong/>  {{ $data['message'] }} <br>
 
@endcomponent
