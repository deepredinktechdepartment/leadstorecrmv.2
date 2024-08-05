
@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="container">


    <div class="table-responsive">

        <table id="users-datatable-hold" class="display nowrap table Config::get('constants.tablestriped') " style="width:100%">
              <thead class="thead-dark">
                  <tr>
                      <th>S.No</th>
                      <th>User Details</th>
                       <th>Change Password?</th>
                      <th>Mapped Departments</th>
                      <th>Role</th>
                      <th>SLA Level</th>
                      <th>Is Escalation Needed?</th>
                      <th>Account Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>


                    @foreach ($users_data as $user)
                        <tr>

                            <td>{{$loop->iteration}}</td>
                            <td><b>{{Str::title($user->firstname??'')}} {{Str::title($user->lastname??'')}}</b><br>{{$user->email??''}}<br>{{$user->phone??''}}</td>
                             <td align="center"><a href="{{ route('change.user.pwd.manual',['UID'=>Crypt::encryptString($user->id)]) }} "><i class="fas fa-key" aria-hidden="true"></i></a></td>
                            <td>
                                <ol>
                          @php
                          $Departments_Users=Departments_Users::select(DB::raw('group_concat(departments.department_name) as department_name'))
                           ->leftjoin('departments','departments.id','=','user_departments.department_id')
                          ->where("user_id",$user->id)
                          ->groupBy('user_departments.user_id')
                          ->orderBy('department_name','desc')
                          ->get()->first();
                          $user_explodes=explode(",",$Departments_Users->department_name??'');
                      foreach($user_explodes as $key=>$value){
                          @endphp
                            @if($value)
                            <li class="text-wrap">{{$value??''}}</li>
                            @endif

                                @php
                                }
                            @endphp

                            </ol>
                            </td>
                            <td><p class="badge badge-primary">{{$user->ut_name??''}}</p></td>
                             <td>
                                 @if($user->role==2)
                              <span class="badge badge-danger">L3 </span>
                              @elseif($user->role==3)
                              <span class="badge badge-danger">L1 </span>
                              @elseif($user->role==5)
                              <span class="badge badge-danger">L2 </span>
                              @else
                              NA
                              @endif
                            </td>

                          @if(isset($user->need_escalation) && $user->need_escalation== 1)
                         <td align="center"><span class="badge badge-warning">Yes</span></td>
                         @else
                           <td align="center"><span class="badge badge-dark">No</span></td>
                         @endif

                           @if(isset($user->is_active_status) && $user->is_active_status== 1)
                         <td align="center"><span class="badge badge-success">active</span></td>
                         @else
                          <td align="center"><span class="badge badge-danger">Deactivated</span></td>
                         @endif





                            <td>


                            <a href="{{url(Config::get('constants.admin').'/user/edit/'.Crypt::encryptString($user->id))}}" class="edit mr-2" title="Edit" ><i class="feather icon-edit-2"></i></a>
                              <a href="{{url(Config::get('constants.admin').'/user/delete/'.Crypt::encryptString($user->id))}}" class="delete text-danger" title="Delete" onclick="return confirm('Are you sure to delete this?')" ><i class="feather icon-trash"></i></a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

          </table>

          </div>

</div>
@endsection
