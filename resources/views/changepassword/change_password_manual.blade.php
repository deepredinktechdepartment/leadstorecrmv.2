@extends('admin.template_v1')
@section('title', $pageTitle??'')
@section('content')
@include('admin.alerts')

<div class="row">
            <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h4> @yield('title')</h4>
                            </div>
                            <div class="card-body">
<form id="crudTable" action="{{route('verifying.password.manual')}}" method="post">
						@csrf
						 <div class="border-top pt-2">
				
								<div class="row">	
							<div class="col-sm-8">
								<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
									<label>Emai<span style="color: red;">*</span></label>
									</div>
									<div class="col-sm-5">
									{{$userdata->email??''}}
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="row">	
							<div class="col-sm-8">
								<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
									<label>New Password<span style="color: red;">*</span></label>
									</div>
									<div class="col-sm-5">
									<input type="password" class="form-control form-control-sm" name="password" id="password" value="" required />
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="row">	
							<div class="col-sm-8">
								<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
									<label>Confirm New Password<span style="color: red;">*</span></label>
									</div>
									<div class="col-sm-5">
									<input type="password" class="form-control form-control-sm" name="password_confirmation" id="password" value="" required />
									<br>

									<button type="submit" class="btn btn-primary btn-sm">Change</button>
									
								
									</div>
								</div>
								</div>

								 
							</div>
						</div>

						
					</div>
					
					<input type="hidden" name="UserID" value="{{$userdata->id??0}}" > 
					
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
<script>
   $("#crudTable").validate({
  rules: {
new_password:{
		required:false,
		minlength:8,
		},
		password_confirmation:
		{
		required:false,
		minlength:8,
		equalTo: "#new_password",

		}
  }
});
 </script> 
 @endpush