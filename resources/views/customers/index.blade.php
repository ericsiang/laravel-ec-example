@extends('layouts.app')

@section('title','Customer List')

@section('content')

<h1>Customer List</h1>

@can('create',App\Customer::class)
    <p><a href='customers/create'>Add New Customer</a></p>
@endcan
<div class='row'>
    
    @foreach($customers as $customer)
        <div class='col-2'>
            {{ $customer->id }}
        </div>

    
        <div class='col-4'>
            @can('view',$customer)
            <a href="/customers/{{ $customer->id }}"> {{ $customer->name }}</a>
            @endcan

            @cannot('view',$customer)
                 {{ $customer->name }}
            @endcannot
        </div>

        <div class='col-4'>
            {{ $customer->company->name }}
        </div>

        <div class='col-2'>
            {{ $customer->active }}
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-12 text-center d-flex justify-content-center">
        {{  $customers->links() }}
    </div>
</div>

@endsection
