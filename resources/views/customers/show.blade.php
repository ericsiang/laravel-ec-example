@extends('layouts.app')

@section('title','Detials for '.$customer->name)

@section('content')



<div class='row'>
    <div class='col-12'>
        <h1>Detials for {{ $customer->name }} </h1>
        <p><a href='/customers/{{ $customer->id }}/edit'>Edit Customer</a></p>
        <form action="/customers/{{ $customer -> id }}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class='btn btn-danger'>delete</button>
        </form>
    </div>
</div>

<div class='row'>
    <div class='col-12'>
        <p><strong>Name : </strong> {{ $customer->name }} </p>
        <p><strong>Email : </strong> {{ $customer->email }} </p>
        <p><strong>Company : </strong> {{ $customer->company->name }} </p>
        <p><strong>Active : </strong> {{ $customer->active }} </p>
    </div>
</div>

@if($customer->image)
<div class="row">
    <div class="col-12">
        <img src="{{ asset('storage/'.$customer->image) }}" alt="" class='img-thumbnail'>
    </div>
</div>

@endif

@endsection
