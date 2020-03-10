@extends('manager.extends.layout')

@section('title')

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>修改管理員 <small></small></h3>
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
                <form id="demo-form2" data-parsley-validate action='/manager/accounts/{{ $account->id }}' method='POST' class="form-horizontal form-label-left">
                @method('PATCH')
                @include('manager.accounts.form')

                </form>
                </div>
        </div>
    </div>    
</div>
               
@endsection

