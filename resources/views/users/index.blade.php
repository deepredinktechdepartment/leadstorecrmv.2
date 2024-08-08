@extends('layouts.app')
@section('content')

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
                      <button class="btn btn-sm {{ $user->active ? 'btn-success' : 'btn-danger' }}" onclick="toggleStatus('{{ Crypt::encrypt($user->id) }}', {{ $user->active ? 0 : 1 }})">
                          {{ $user->active ? 'Active' : 'Inactive' }}
                      </button>
                  </td>
                  <td>
                      <a href="{{ route('users.edit', ["userID"=>Crypt::encrypt($user->id)]) }}" class="btn btn-warning btn-sm">
                          <i class="{{ config('constants.icons.edit') }}"></i>
                      </a>
                      <button class="btn btn-info btn-sm" onclick="showPasswordModal('{{ Crypt::encrypt($user->id) }}')">
                          <i class="fa fa-key"></i>
                      </button>
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

  <!-- Password Modal -->
  <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="passwordModalLabel">Update Password</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="passwordForm">
                      @csrf
                      <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password" name="password" required>
                      </div>
                      <div class="mb-3">
                          <label for="confirmPassword" class="form-label">Confirm Password</label>
                          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                      </div>
                      <input type="hidden" id="userId" name="userId">
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="updatePassword()">Save changes</button>
              </div>
          </div>
      </div>
  </div>

@endsection

@push('scripts')
<script>
    function showPasswordModal(userId) {
        $('#userId').val(userId);
        $('#passwordModal').modal('show');
    }

    function updatePassword() {
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        var userId = $('#userId').val();

        if(password !== confirmPassword) {
            alert('Passwords do not match.');
            return;
        }

        $.ajax({
            url: '{{ route("users.updatePassword") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                password: password,
                userId: userId
            },
            success: function(response) {
                $('#passwordModal').modal('hide');
                alert('Password updated successfully.');
            },
            error: function(xhr) {
                alert('An error occurred while updating the password.');
            }
        });
    }

    function toggleStatus(userId, status) {
        $.ajax({
            url: '{{ route("users.toggleStatus") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                userId: userId,
                status: status
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('An error occurred while updating the status.');
            }
        });
    }
</script>
@endpush
