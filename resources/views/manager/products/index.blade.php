@extends('manager.extends.layout')

@section('title','商品管理')

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>商品列表 <small></small></h3>
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
<div class="x_panel"> 
  <div class="col-md-12 col-sm-12 col-xs-12">
      <form action='/manager/products/search' method='POST'>
        @csrf
      <!--<div class="col-md-2">
          <select id="activity_name" name="activity_name" class="form-control " size="1">
              <option value="">優惠券活動名稱</option>

          </select>
      </div>-->
      <div class="col-md-3">
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left datetimes" id="" placeholder="From-To" aria-describedby="inputSuccess2Status" name='date' value="{{ $input['date'] ?? '' }}">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    <span id="inputSuccess2Status" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </fieldset>
      </div>

      <script>
          //一定要加
          $('.datetimes').on("apply.daterangepicker", function(ev, picker) {
                $(this).val(picker.startDate.format("YYYY/MM/DD") + " - " + picker.endDate.format("YYYY/MM/DD"));
            });
        $('.datetimes').daterangepicker({
          //singleDatePicker: true,//設定為單個的datepicker，而不是有區間的datepicker 預設false
	      showDropdowns: true,//當設定值為true的時候，允許年份和月份通過下拉框的形式選擇 預設false
          autoUpdateInput: false,//是否顯示預設日期
          locale:{
            format: 'YYYY/MM/DD',
            daysOfWeek:["日","一","二","三","四","五","六"],
            monthNames: ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
          }
        });
      </script>
      <div class="col-md-3 row">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="請輸入商品名稱" id="search" name="search"
                  value="{{  $input['search'] ?? '' }}">
              <span class="input-group-btn">
                  <button type="submit" class="btn btn-effect-ripple btn-primary">搜尋</button>
                  <button type="button" class="btn btn-effect-ripple btn-primary"><a href='/manager/products' style='color:#FFF;'>清除</a></button>
              </span>
          </div>
      </div>

    </form>
  </div>
  </div>
</div>

<div class="clearfix"></div>
<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href='/manager/products/create'><button type="button" class="btn btn-primary">新增商品</button></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content"> 
               

                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">建立時間</th>
                                <th class="column-title">商品名稱</th>
                                <th class="column-title">商品價格</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                
                                <!--  批量勾選時，會用到 -->
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                            class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" ">{{ $product->created_at }}</td>
                                    <td class=" ">{{ $product->name }}</td>
                                    <td class="a-right a-right ">{{ $product->price }}</td>
                                    <td class=" last">
                                            <form action="/manager/products/{{ $product-> p_id }}" method="POST" id='myForm'>
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            <button class="btn btn-success"><a href='/manager/products/{{ $product->p_id }}/edit' style='color:#fff;'>編輯<a></button>
                                            <button onClick='on_delete();' class="btn btn-danger">刪除</button>
                                    </td>
                                </tr>
                            @endforeach

                            <!--<tr class="even pointer">
                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records">
                                </td>
                                <td class=" ">121000040</td>
                                <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i></td>
                                <td class="a-right a-right ">$7.45</td>
                                <td class=" last"><a href="#">View</a>
                                </td>
                            </tr>-->
                        </tbody>
                    </table>
                    <script>
                        function on_delete(){
                            //alert(action);
                            $('#myForm').submit();
                        }    
                    </script>


                </div>
                <div class="row">
                    <div class="col-12 text-center d-flex justify-content-center">
                        {{ $products->render() }}
                        @php
                            //dd($products);
                        @endphp
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection