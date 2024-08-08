@extends('layouts.app')

@section('content')
<div class="container">
  <!-- DataTable -->
  <table id="users-table" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th>S.No.</th>
              <th>Name</th>
              <th>Username</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Active</th>
              <th>Actions</th>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->fullname }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ Str::title($user->ut_name ?? '') }}</td>
                  <td>
                      @if($user->active)
                          <span class="badge bg-success">Active</span>
                      @else
                          <span class="badge bg-danger">Inactive</span>
                      @endif
                  </td>
                  <td>
                    <a href="{{ route('users.edit', ["userID"=>Crypt::encrypt($user->id)]) }}" class="btn btn-warning btn-sm">

                        <i class="{{ config('constants.icons.edit') }}"></i> {{ $user->id }}
                      </a>
                      <form action="{{ route('users.destroy', ['user' => Crypt::encrypt($user->id)]) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                              <i class="{{ config('constants.icons.delete') }}"></i>
                          </button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection
