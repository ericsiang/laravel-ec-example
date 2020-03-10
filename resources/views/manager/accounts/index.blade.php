@extends('manager.extends.layout')

@section('title','管理員管理')

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>管理員列表 <small></small></h3>
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
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="/manager/accounts/create"><button type="button" class="btn btn-primary">新增管理員</button></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th>
                                    <!--<input type="checkbox" id="check-all" class="flat">-->
                                </th>
                                <th class="column-title">姓名 </th>
                                <th class="column-title">帳號</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>

                                 <!--  批量勾選時，會用到 -->
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                            class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($accounts as $account)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <!--<input type="checkbox" class="flat" name="table_records">-->
                                    </td>
                                    <td class=" "><a href="/manager/accounts/{{ $account->id }}/edit">{{ $account->name }}</a></td>
                                    <td class=" ">{{ $account->account }}</td>
                                    @if($account->id !=1 ) 
                                    <td class=" last">
                                        <form action="" method="POST" id='myForm'>
                                            @csrf
                                        </form>
                                        <button onClick='on_btn(1);' class="btn btn-{{ $account->status==1 ? 'warning' : 'success'    }}">{{ $account->status==1 ? '禁用' : '啟用'    }}</button>
                                        
                                        <!-- 數量大於1才能有刪除btn -->
                                        
                                        <button onClick='on_btn(2);' class="btn btn-danger">刪除</button>
                                       
                                    </td>
                                    @endif  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        function on_btn(type){
                           var input_value='';
                           var action='';
                           if(type==1){
                                input_value='PATCH';
                                action='/manager/accounts/{{ $account-> id }}/status';
                           }
                           if(type==2){
                                input_value='DELETE';
                                action='/manager/accounts/{{ $account-> id }}';
                           }

                            $('<input>', {
                                type: 'hidden',
                                name: '_method',
                                value: input_value
                            }).appendTo('#myForm');

                            //alert(action);
                            $('#myForm').attr('action', action).submit();
                        }    
                    </script>
                </div>
                <div class="row">
                    <div class="col-12 text-center d-flex justify-content-center">
                        {{  $accounts->links() }}
                    </div>
                </div>
   
            </div>
        </div>
    </div>

</div>

@endsection