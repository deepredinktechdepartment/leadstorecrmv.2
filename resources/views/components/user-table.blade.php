<!-- resources/views/components/user-table.blade.php -->
<div class="table-responsive">
    <table id="{{ $tableId }}" class="table table-striped table-bordered mt-3 w-100">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Username</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Status</th>
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
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="{{ $tableId }}Switch{{ $user->id }}" {{ $user->active ? 'checked' : '' }} onchange="toggleStatus('{{ Crypt::encrypt($user->id) }}', this.checked)">
                        <span class="badge {{ $user->active ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </td>
                <td>
                    <a href="{{ route('users.edit', ['userID' => Crypt::encrypt($user->id)]) }}">
                        <i class="{{ config('constants.icons.edit') }}"></i>
                    </a>
                    &nbsp;&nbsp;&nbsp; <!-- Add space between icons -->

                    <button class="no-button" onclick="showPasswordModal('{{ Crypt::encrypt($user->id) }}')">
                        <i class="fas fa-key"></i>
                    </button>
                    &nbsp;&nbsp;&nbsp; <!-- Add space between icons -->

                    <form action="{{ route('users.destroy', ['user' => Crypt::encrypt($user->id)]) }}" method="POST" class="delete-form" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="no-button">
                            <i class="{{ config('constants.icons.delete') }}"></i>
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
