<?php
use App\Models\Departments;
$Departments=Departments::orderBy('department_name', 'ASC')->get();
?>
@extends('admin.template_v1')
@section('content')
@include('admin.alerts')
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

          
<form id="crudTable" action="{{url(Config::get('constants.admin').'/user/update')}} " method="POST"  enctype="multipart/form-data">
<input type="hidden" name="id" value="{{$users_data->id}}">
@else
<form id="crudTable" action="{{url(Config::get('constants.admin').'/user/store')}}" method="POST"  enctype="multipart/form-data">
@endif  
      @csrf
      <div class="row">
        <div class="col-md-6">
		
		
			<div class="form-group">
			
			@include('masters.organisations',['company_id' =>$users_data->organization_id??Session::get('companyID'),'is_required'=>""])
			</div>

		
		
          <div class="form-group">
            <input type="hidden" name="organization_id" value="{{auth()->user()->organization_id??''}}">
            <label><b>Role</b><span style="color: red;">*</span></label>
            <select class="form-control" name="role" id="role" required="required">
              <option value="">-- Select --</option>
              @foreach($user_type_data as $usertype)

                <option value="{{$usertype->id??''}}" {{ old('role',$users_data->role??'') == $usertype->id ? 'selected':''}}>{{ucwords($usertype->name??'')}}</option>
              @endforeach
            </select>
          </div>
          <!-- <div class="form-group">
            <input type="hidden" name="organization_id" value="{{auth()->user()->organization_id??''}}">
            <label><b>Designation</b><span style="color: red;">*</span></label>
            <select class="form-control" name="designation_id" id="role" required="required">
              <option value="">-- Select --</option>
              @foreach($group_level_data as $group_level)

                <option value="{{$group_level->id??''}}" {{ old('designation_id',$users_data->designation_id??'') == $group_level->id ? 'selected':''}}>{{ucwords($group_level->name??'')}}</option>
              @endforeach
            </select>
          </div> -->
		  
		  <div class="form-group">
             
			
	<!--@include('masters.departments', ['department' =>$Departments_Users??'','is_required'=>"required","multipleselect"=>"yes"])-->
			
			
			
          </div>
          
          
          <!---- Map Department -->
           <div class="form-group mb-0 pb-0">
            
            <label><b>Departments</b><span style="color: red;">(Optional)</span></label>
            <p class="text text-dark"><i class="fa-solid fa-circle-exclamation"></i> Please assign departments to HOD users</p>
            </div>
         
<div class="row">
	<div class="col-md-4">
		@if(isset($Departments) && $Departments->count()>0)
		
			@foreach($Departments as $item)
            @if($loop->iteration % 6 == 0)
            </div><div class="col-md-4">
            @endif
		
				<label class="mr-2"><input type="checkbox" @if (in_array($item->id??0,$Departments_Users??[])) checked @else @endif name="department[]" value="{{$item->id??''}}"> {{$item->department_name??''}}</label>
		
	
			@endforeach
		
			@else
			<p class="text text-danger">No departments are found.</p>
		@endif
	</div>                
</div> 

<!--- End -->

<!--
		  
			<div class="form-group">
			@include('masters.users', ['existvalue' =>$users_data->reportingto??'','is_required'=>""])
			</div>
		  
        -->
          
          <input type="hidden" name="reportingto" id="reportingto" value="">
          
      
      <button type="submit" class="btn btn-primary btn-sm">Save</button>
      <a href="{{url(Config::get('constants.admin').'/users')}}" class="btn btn-default btn-sm">Back</a>

        </div>
        <div class="col-md-5">
            
              <div class="form-group">
            <label><b>Full Name</b><span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="firstname" value="{{old('firstname',$users_data->firstname??'')}}" required="required" />
          </div>
          <!-- <div class="form-group">
            <label><b>Last Name</b><span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="lastname" value="{{old('lastname',$users_data->lastname??'')}}" required="required" />
          </div> -->
          <div class="form-group">
            <label><b>Email</b><span style="color: red;">*</span></label>
            <input type="email" name="email" class="form-control" required="required" value="{{old('email',$users_data->email??'')}}">
          </div>
          
          <div class="form-group">
                <label><b>Mobile (Enter 10 digits mobile number)</b><span style="color: red;">*</span></label>
                <input type="text" name="phone" id="title" class="form-control" value="{{old('phone',$users_data->phone??'')}}" required="required" >
          </div>
         
         <p class="text text-dark"><i class="fa-solid fa-circle-exclamation"></i> Please map escalation if needed for sending notifications to this specific user</p>
        <div class="form-group">
        <label><b>Is Escalation Needed?</b><span style="color: red;">*</span></label>
        <input type="radio" class="rdbtn"  name="need_escalation" value="1" {{ old('need_escalation',$users_data->need_escalation??'') == '1'?'checked':'checked'}}/>
        <label>Yes</label>
        <input type="radio" class="rdbtn" name="need_escalation" value="0" required="required"    {{ old('need_escalation',$users_data->need_escalation??'') == '0'?'checked':''}}/>
        <label>No</label>
        </div>
      
      
  
        <p class="text text-dark"><i class="fa-solid fa-circle-exclamation"></i> Please activate the account to grant access to interviews, reports, and other features for this particular user.</p>
        <div class="form-group">
        <label><b>Account Active Status</b><span style="color: red;">*</span></label>
        <input type="radio" class="rdbtn"  name="is_active_status" value="1" {{ old('is_active_status',$users_data->is_active_status??'') == '1'?'checked':'checked'}}/>
        <label>Active</label>
        <input type="radio" class="rdbtn" name="is_active_status" value="0" required="required"    {{ old('is_active_status',$users_data->is_active_status??'') == '0'?'checked':''}}/>
        <label>Deactivated</label>
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
 