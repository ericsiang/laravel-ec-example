@extends('layouts.app')

@section('title','Add Customer')

@section('content')

<h1>Add Customer</h1>
<form action="/customers" method="post" enctype='multipart/form-data'>

   @include('customers.form')
   
   <button type="submit" class='btn btn-primary'>Add Customer</button>

   
</form>



@endsection
