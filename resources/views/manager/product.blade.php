@extends('manager.extends.layout')

@section('title','商品管理')

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>商品管理列表 <small></small></h3>
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
      <div class="col-md-2">
          <select id="activity_name" name="activity_name" class="form-control " size="1">
              <option value="">優惠券活動名稱</option>

          </select>
      </div>
      <div class="col-md-2">
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left datetimes" id="" placeholder="From" aria-describedby="inputSuccess2Status" >
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    <span id="inputSuccess2Status" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </fieldset>
      </div>

      <script>
        $('.datetimes').daterangepicker({
          singleDatePicker: true,//設定為單個的datepicker，而不是有區間的datepicker 預設false
	    	  showDropdowns: true,//當設定值為true的時候，允許年份和月份通過下拉框的形式選擇 預設false
          locale:{
            format: 'YYYY-MM-DD',
            daysOfWeek:["日","一","二","三","四","五","六"],
            monthNames: ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
          }
        });
      </script>
      <div class="col-md-4 row">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="請輸入會員姓名/店家名稱/店家代碼/Email信箱" id="search" name="search"
                  value="">
              <span class="input-group-btn">
                  <button type="button" class="btn btn-effect-ripple btn-primary" onClick="on_search();">搜尋</button>
                  <button type="button" class="btn btn-effect-ripple btn-primary" onClick="on_clear();">清除</button>
              </span>
          </div>
      </div>
  </div>
  </div>
</div>

<div class="clearfix"></div>
<div class='row'>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Table design <small>Custom design</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <button type="button" class="btn btn-primary">Primary</button></li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p>

                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">Invoice </th>
                                <th class="column-title">Invoice Date </th>
                                <th class="column-title">Order </th>
                                <th class="column-title">Bill to Name </th>
                                <th class="column-title">Status </th>
                                <th class="column-title">Amount </th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                            class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="even pointer">
                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records">
                                </td>
                                <td class=" ">121000040</td>
                                <td class=" ">May 23, 2014 11:47:56 PM </td>
                                <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i></td>
                                <td class=" ">John Blank L</td>
                                <td class=" ">Paid</td>
                                <td class="a-right a-right ">$7.45</td>
                                <td class=" last"><a href="#">View</a>
                                </td>
                            </tr>
                            <tr class="odd pointer">
                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records">
                                </td>
                                <td class=" ">121000039</td>
                                <td class=" ">May 23, 2014 11:30:12 PM</td>
                                <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                                </td>
                                <td class=" ">John Blank L</td>
                                <td class=" ">Paid</td>
                                <td class="a-right a-right ">$741.20</td>
                                <td class=" last"><a href="#">View</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

</div>
@endsection