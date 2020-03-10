@extends('layouts.app')

@section('title','Edit Customer')

@section('content')

<h1>Edit Customer</h1>
<form action="/customers/{{ $customer -> id }}" method="post" enctype='multipart/form-data'>
   @method('PATCH') 

   @include('customers.form')
   
   <button type="submit" class='btn btn-primary'>Edit Customer</button>

</form>



@endsection
