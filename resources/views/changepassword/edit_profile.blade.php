@extends('admin.template_v1')
@section('content')
@include('admin.pagetitle')

    <div class="paddingleftright pt-2 pb-5" >
           
@include('admin.alerts')
@include('admin.errors')

@if(isset($users_data->id))

          
<form id="crudTable" action="{{url('admin/profile/update')}} " method="POST"  enctype="multipart/form-data">

@else
@endif  
      @csrf
      <div class="row">
        <div class="col-md-5">
          
          <div class="form-group">
            <label><b>Full Name</b><span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="firstname" value="{{old('firstname',$users_data->firstname??'')}}" required="required" />
          </div>
          <div class="form-group">
            <label><b>Email</b><span style="color: red;">*</span></label>
            <input type="email" name="email" class="form-control" required="required" value="{{old('email',$users_data->email??'')}}">
          </div>
          <div class="form-group mb-3">
                <label><b>Mobile</b><span style="color: red;">*</span></label>
                <input type="number" name="phone" id="title" class="form-control" value="{{old('phone',$users_data->phone??'')}}" required="required" data-parsley-minlength="10" data-parsley-maxlength="10" required="required">
          </div>
          
      
      <button type="submit" class="btn btn-primary btn-sm">Save</button>
      <a href="{{url('admin/users')}}" class="btn btn-default btn-sm">Back</a>

        </div>
        <div class="col-md-5">
          <div class="form-group">
        <label>Profile<span style="color: red">*</span></label>       
        <input type="file"  name="profile" class="file-input" @if(isset($users_data->profile)) @else required @endif  />
      </div>
      <div class="form-group">
        @if(isset($users_data->profile) && !empty($users_data->profile))
        <img src="{{ asset('assets/uploads/' . $users_data->profile) }}" width="100"   />
        @else
        @endif
      </div>
          <div class="form-group">
        <label><b>Password</b><span style="color: red;">*</span></label>
        <input name="password" type="password" class="form-control"  id="password" @if(isset($users_data->password)) @else required @endif>
      </div>
      <div class="form-group">
        <label><b>Confirm Password</b><span style="color: red;">*</span></label>
        <input name="cpassword" type="password" class="form-control" data-parsley-equalto="#password"  @if(isset($users_data->password)) @else required @endif>
      </div>
      
        </div> 
        </form> 
      </div>
    </div>
    </div>
 
 @endsection


 