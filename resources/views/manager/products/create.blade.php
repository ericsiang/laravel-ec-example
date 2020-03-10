@extends('manager.extends.layout')

@section('title','Add product')

@section('content')



@if(session()->has('validator_fail'))
<script>//alert('{{ session()->get("validator_fail") }}');</script>
@endif

<div class="page-title">
    <div class="title_left">
        <h3>新增商品 <small></small></h3>
    </div>
    <!--
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>-->
</div>
<div class="clearfix"></div>

<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
                <div class="x_title">
                    <!--<h2>Table design <small>Custom design</small></h2>-->
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <br />
                <form id="demo-form2" data-parsley-validate action='/manager/products' method='POST' class="form-horizontal form-label-left" enctype='multipart/form-data'>
              
                @include('manager.products.form')

                </form>
                </div>
        </div>
    </div>    
</div>


@endsection