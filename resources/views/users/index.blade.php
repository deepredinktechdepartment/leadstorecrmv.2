@extends('layouts.app')
@section('content')
<div class="container">
  <!-- DataTable -->
  <table id="users-table" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Profile Photo</th>
              <th>Actions</th>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
              <tr>
                  <td>{{ $user->fullname }}</td>
                  <td>{{ $user->client_id }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ $user->role == 1 ? 'Admin' : 'User' }}</td>
                  <td>
                      @if($user->profile_photo && $user->profile_photo !== 'default_profile_pic.png')
                          <img src="{{ asset('storage/images/' . $user->profile_photo) }}" class="img-fluid" width="50" alt="Profile Photo">
                      @else
                          <img src="{{ asset('storage/images/default_profile_pic.png') }}" class="img-fluid" width="50" alt="Default Photo">
                      @endif
                  </td>
                  <td>
                      <a href="{{ route('users.edit', ['user' => Crypt::encrypt($user->id)]) }}" class="btn btn-warning btn-sm">Edit</a>
                      <form action="{{ route('users.destroy', ['user' => Crypt::encrypt($user->id)]) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
@endsection
