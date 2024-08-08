@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Start card -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">{{ $pageTitle ?? '' }}</h5>
        </div>
        <div class="card-body">
            <form id="crudTable" action="{{ isset($users_data->id) ? url(Config::get('constants.admin').'/user/update') : url(Config::get('constants.admin').'/user/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $users_data->id ?? '' }}">
                <input type="hidden" name="organization_id" value="{{ auth()->user()->organization_id ?? '' }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label"><b>Role</b><span class="text-danger">*</span></label>
                            <select class="form-select" name="role" id="role" required>
                                <option value="">-- Select --</option>
                                @foreach($user_type_data as $usertype)
                                    <option value="{{ $usertype->id ?? '' }}" {{ old('role', $users_data->role ?? '') == $usertype->id ? 'selected' : '' }}>
                                        {{ ucwords($usertype->name ?? '') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="departments" class="form-label"><b>Departments</b><span class="text-muted">(Optional)</span></label>
                            <p class="text-dark"><i class="fa-solid fa-circle-exclamation"></i> Please assign departments to HOD users</p>
                            <div class="row" id="departments">
                                <div class="col-md-12">
                                    @if(!empty($Departments) && $Departments->count() > 0)
                                        @foreach($Departments as $item)
                                            @if($loop->iteration % 6 == 0)
                                                </div><div class="col-md-4">
                                            @endif
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="department[]" value="{{ $item->id ?? '' }}" {{ in_array($item->id ?? 0, $Departments_Users ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $item->department_name ?? '' }}</label>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-danger">No departments are found.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label"><b>Full Name</b><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="{{ old('firstname', $users_data->firstname ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"><b>Email</b><span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $users_data->email ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label"><b>Mobile (Enter 10 digits mobile number)</b><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $users_data->phone ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><b>Account Active Status</b><span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active_status" value="1" {{ old('is_active_status', $users_data->is_active_status ?? '') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active_status" value="0" {{ old('is_active_status', $users_data->is_active_status ?? '') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label">Deactivated</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ url(Config::get('constants.admin').'/users') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End card -->
</div>
@endsection

@push('scripts')
<script>
    $("#crudTable").validate({
        rules: {
            firstname: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            role: {
                required: true
            },
            is_active_status: {
                required: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10
            }
        }
    });
</script>
@endpush
