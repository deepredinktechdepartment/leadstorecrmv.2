@extends('admin.template_v1')
@section('content')
  <div class="row">
    <!-- Start col -->
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header">
                <h5 class="card-title">{{$pageTitle??''}}</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  @if(isset($users_data->id))

          
<form id="crudTable" action="{{url('user/update')}} " method="POST"  enctype="multipart/form-data">
<input type="hidden" name="id" value="{{$users_data->id}}">
@else
<form id="crudTable" action="{{url('user/store')}}" method="POST"  enctype="multipart/form-data">
@endif  
      @csrf
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label><b>Role</b><span style="color: red;">*</span></label>
            <select class="form-control" name="role" id="role" required="required">
              <option value="">-- Select --</option>
              @foreach($user_type_data as $usertype)

                <option value="{{$usertype->id??''}}" {{ old('role',$users_data->role??'') == $usertype->id ? 'selected':''}}>{{ucwords($usertype->name??'')}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label><b>First Name</b><span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="firstname" value="{{old('firstname',$users_data->firstname??'')}}" required="required" data-parsley-pattern="/^[a-z\d\-_\s]+$/i"/>
          </div>
          <div class="form-group">
            <label><b>Last Name</b><span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="lastname" value="{{old('lastname',$users_data->lastname??'')}}" required="required" data-parsley-pattern="/^[a-z\d\-_\s]+$/i"/>
          </div>
          <div class="form-group">
            <label><b>Email</b><span style="color: red;">*</span></label>
            <input type="email" name="email" class="form-control" required="required" value="{{old('email',$users_data->email??'')}}">
          </div>
          <div class="form-group">
                <label><b>Mobile</b><span style="color: red;">*</span></label>
                <input type="text" name="phone" id="title" class="form-control" value="{{old('phone',$users_data->phone??'')}}" required="required" data-parsley-minlength="10" data-parsley-maxlength="10">
          </div>
          
      
      <button type="submit" class="btn btn-success btn-sm">Save</button>
      <a href="{{url('admin/users')}}" class="btn btn-default btn-sm">Back</a>

        </div>
        <div class="col-md-5">
          <div class="form-group">
        <label>Profile<span style="color: red">*</span></label>       
        <input type="file"  name="profile" class="file-input" @if(isset($users_data->profile)) @else required @endif  />
      </div>
      <div class="form-group">
        @if(isset($users_data->profile) && !empty($users_data->profile))
        @if(file_exists('assets/uploads/'.$users_data->profile))
        <img src="{{ asset('assets/uploads/'.$users_data->profile) }}" width="100"   />
         @endif
        @else
        @endif
      </div>
          <div class="form-group">
        <label><b>Password</b><span style="color: red;">*</span></label>
        <input name="password" type="password" class="form-control"  pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.cpassword.pattern = this.value;" placeholder="Password" @if(isset($users_data->password)) @else required @endif>
      </div>
      <div class="form-group">
        <label><b>Confirm Password</b><span style="color: red;">*</span></label>
        <input name="cpassword" type="password" class="form-control" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Confirm Password"  @if(isset($users_data->password)) @else required @endif>
      </div>
      <div class="form-group">
        <label><b>Status</b><span style="color: red;">*</span></label>
      </div>
      <div class="form-group">
        <input type="radio" class="rdbtn"  name="is_active_status" value="1" {{ old('is_active_status',$users_data->is_active_status??'') == '1'?'checked':'checked'}}/>
                <label>Active</label>
                <input type="radio" class="rdbtn" name="is_active_status" value="0" required="required"    {{ old('is_active_status',$users_data->is_active_status??'') == '0'?'checked':''}}/>
                  <label>Inactive</label>
      </div>
        </div> 
        </form> 


                </div>
              </div>
                
            </div>
        </div>

    </div>
    <!-- End col -->
</div>
   
 
 @endsection

@push('scripts')
<script>
   $("#crudTable").validate({
  rules: {
  name: {
      required: true,
      minlength:3,
      maxlength:100
    },
    role_id: {
      required: true,
      
    },
    is_active_status:{
      required: true,
    },
    
    password:
      {
         required:false,
         minlength:6,
      },
      mobile:
      {
         required:true,
         minlength:10,
         maxlength:10,
      },

     confirmpassword:
      {
         required:false,
         minlength:6,
         equalTo: "#password",
      
      },
    max_admissions: {
      required: true,
      number:true,
      minlength:1,
      maxlength:100
    },course_fee: {
      required: true,
      number:true,
      minlength:2,
      maxlength:100
    },
    institute_id: {
      required: true
    }
  }
});
 </script> 
 @endpush
 