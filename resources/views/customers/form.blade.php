<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="" class="form-control" value="{{ old('name') ??   $customer->name }}">
    <div style='color:#FF0000;'>{{ $errors->first('name') }}</div>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" id="" class="form-control" value="{{ old('email')  ?? $customer->email }}">
    <div style='color:#FF0000;'>{{ $errors->first('email') }}</div>
</div>


<div class="form-group">
    <label for="active">Active</label>
    <select name="active" class="form-control">
        <option value=''>請選擇</option>
        @foreach($customer->activeOptions() as $activeOptionsKey => $activeOptionsValue)
            @if($activeOptionsKey!=0) 
                <option value='{{ $activeOptionsKey }}' {{ $customer->active==$activeOptionsValue ? 'selected': ''   }}>{{ $activeOptionsValue }}</option>
            @endif
        @endforeach
    </select>
    <div style='color:#FF0000;'>{{ $errors->first('active') }}</div>
</div>

<div class="form-group">
    <label for="company_id">Company</label>
    <select name="company_id" class="form-control">
        <option value=''>請選擇</option>
        @foreach($companies as $company)
            <option value='{{ $company->id }}' {{ $company->id==$customer->company_id ? 'selected' : ''  }}>{{ $company->name }}</option>
        @endforeach    
    </select>
    <div style='color:#FF0000;'>{{ $errors->first('company_id') }}</div>
</div>

<div class="form-group d-flex flex-column">
  <label for="image">Profile Image</label>
  <input type="file" name="image"  class='py-2'>
  <div style='color:#FF0000;'>{{ $errors->first('image') }}</div>
</div>




@csrf
