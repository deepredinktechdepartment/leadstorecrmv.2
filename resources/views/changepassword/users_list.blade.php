@extends('admin.template_v1')
@section('title', 'Users')
@section('content')
<div class="row">
    <!-- Start col -->
    <div class="col-lg-12">
        <div class="card m-b-30">
            
             <div class="card-header">
                <h5 class="card-title">List of all users</h5>
            </div>
            <div class="card-body">
			
          <div class="table-responsive">
        
          <table id="default-datatable" class="display table Config::get('constants.tablestriped')">
                <thead class="thead-dark">
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email/Username</th>
                        <th>Decrypt Password</th>
                        <th>Phone</th>
                        <th>Role</th>
                      
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  
                      @foreach ($users_data as $user)  
                          <tr>
                              
                              <td>{{$loop->iteration}}</td>
                              <td>{{Str::title($user->firstname??'')}} {{Str::title($user->lastname??'')}}</td>
                              <td>{{$user->email??''}}</td>
                             <td>{{$user->decrypt_password??''}}</td> 
                              <td>{{$user->phone??''}}</td>
                              <td>{{$user->ut_name??''}}</td>
                              
                           
                              
                              <td>
							  
							  <a href="{{url(Config::get('constants.superadmin').'/organizations/edit/'.Crypt::encryptString($user->organization_id))}}" class="edit mr-2" title="Edit" ><i class="fa fa-edit"></i></a>
								
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                      
            </table>
			
			</div>
        </div>
      </div>
</div>
</div>
        @endsection



