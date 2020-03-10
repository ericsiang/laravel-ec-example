@csrf    
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Account<span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id=""  name="account" class="form-control col-md-7 col-xs-12" value='{{ old("account") ?? $account->account }}'>
        <div style='color:#FF0000;'>{{ $errors->first('account') }}</div>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name<span class="required">*</span>
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id="" name="name"  class="form-control col-md-7 col-xs-12" value='{{ old("name") ?? $account->name }}'>
        <div style='color:#FF0000;'>{{ $errors->first('name') }}</div>
    </div>
   
</div>
<div class="form-group">
    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password<span
            class="required">*</span></label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input id="" class="form-control col-md-7 col-xs-12" type="password" name="password">
        <div style='color:#FF0000;'>{{ $errors->first('password') }}</div>
    </div>
    
</div>

<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</div>
