@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="common_tabs">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="userTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">
                                Active <span class="badge bg-success">{{ $users->where('active', true)->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="inactive-tab" data-bs-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">
                                Inactive <span class="badge bg-danger">{{ $users->where('active', false)->count() }}</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="userTabsContent">
                        <!-- Active Users Tab -->
                        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                            @component('components.user-table', ['users' => $users->where('active', true), 'tableId' => 'active-users-table'])
                            @endcomponent
                        </div>

                        <!-- Inactive Users Tab -->
                        <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                            @component('components.user-table', ['users' => $users->where('active', false), 'tableId' => 'inactive-users-table'])
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
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

        if (password !== confirmPassword) {
            alert('Passwords do not match.');
            return;
        }

        $.ajax({
            url: '{{ route("users.updatePassword") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                password: password,
                password_confirmation: confirmPassword,
                userId: userId
            },
            success: function(response) {
                $('#passwordModal').modal('hide');
                alert('Password updated successfully.');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    if (errors.password) {
                        alert(errors.password[0]);
                    }
                } else {
                    alert('An error occurred while updating the password.');
                }
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
                status: status ? 1 : 0
            },
            success: function(response) {
                let label = status ? 'Active' : 'Inactive';
                let badgeClass = status ? 'bg-success' : 'bg-danger';
                $('#' + (status ? 'active' : 'inactive') + 'Switch' + userId).next('span').text(label).removeClass('bg-success bg-danger').addClass(badgeClass);
                location.reload();
            },
            error: function(xhr) {
                alert('An error occurred while updating the status.');
            }
        });
    }
</script>
@endpush

@push('styles')
<style>
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #007bff;
    }
</style>
@endpush
