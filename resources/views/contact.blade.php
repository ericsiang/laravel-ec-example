@extends('layouts.app')

@section('title','Contact us')

@section('content')

<h1>Contact us</h1>


@if(! session()->has('msg'))
<form action="/contact" method='POST'>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name"  class="form-control" value="{{ old('name')  }}">
      <div style='color:#FF0000;'>{{ $errors->first('email') }}</div>  
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" id="" class="form-control" value="{{ old('email')  }}">
      <div style='color:#FF0000;'>{{ $errors->first('email') }}</div>
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" name="message"  rows="10" cols='30'>{{ old('message') }}</textarea>
        <div style='color:#FF0000;'>{{ $errors->first('message') }}</div>
    </div>

    @csrf
    <button type="submit" class="btn btn-primary">Send</button>
</form>

@endif

@endsection