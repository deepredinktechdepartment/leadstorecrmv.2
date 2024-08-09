@extends('layouts.app')
@section('content')
@php
$ClientData = App\Models\Client::orderBy('clients.active', 'DESC')->orderby('client_name')->get(); // Fetch all clients
$selectedClientData = json_decode($users->projects_mapped ?? '[]', true); // Decode JSON data for pre-filling checkboxes
@endphp
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <form id="crudTable" action="{{ isset($users->id) ? route('userUpdateData', $users->id) : route('userstoreData') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($users->id))
                        <input type="hidden" name="id" value="{{ $users->id }}">
                    @endif

                    <div class="row mb-1">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="role" class="form-label">Role<span class="text-danger">*</span></label>
                                <select class="form-select" name="role" id="role" required>
                                    <option value="">-- Select --</option>
                                    @foreach($user_type_data as $usertype)
                                        <option value="{{ $usertype->id }}" {{ old('role', $users->role ?? '') == $usertype->id ? 'selected' : '' }}>
                                            {{ ucwords($usertype->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="firstname" class="form-label">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="{{ old('firstname', $users->fullname ?? '') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $users->username ?? '') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <label for="phone" class="form-label">Mobile (Enter 10 digits mobile number)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $users->phone ?? '') }}" required>
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                          <div class="mb-1">
                              <label for="profile_picture" class="form-label">Profile Picture</label>
                              <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                          </div>
                      </div> --}}

                        <div class="col-md-12">
                            <div class="mb-1">
                                <label class="form-label">Account Active Status<span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_active_status" value="1" {{ old('is_active_status', $users->active ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_active_status" value="0" {{ old('is_active_status', $users->active ?? '') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label">Deactivated</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1 mt-1">
                          <div class="col-md-12">
                            <div class="mb-1">
                                <label class="form-label"><u>Map Projects</u></label>
                                <div class="row" id="clients">
                                    <div class="col-md-6">
                                        @if(!empty($ClientData) && $ClientData->count() > 0)
                                            @foreach($ClientData as $index => $client)
                                                @if($index % 2 == 0)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="client_data[]" value="{{ $client->id }}" {{ in_array($client->id, $selectedClientData) ? 'checked' : '' }}>
                                                        <label class="form-check-label">{{ $client->client_name }}
                                                            <span class="client-status-dot {{ $client->active ? 'active-dot' : 'inactive-dot' }}"></span>

{{--
@if($client->active)
<span class="badge bg-success">Active</span>
@else
<span class="badge bg-danger">Inactive</span>
@endif --}}

                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-danger">No Project data found.</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if(!empty($ClientData) && $ClientData->count() > 0)
                                            @foreach($ClientData as $index => $client)
                                                @if($index % 2 != 0)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="client_data[]" value="{{ $client->id }}" {{ in_array($client->id, $selectedClientData) ? 'checked' : '' }}>
                                                        <label class="form-check-label">{{ $client->client_name }}</label>
                                                        <span class="client-status-dot {{ $client->active ? 'active-dot' : 'inactive-dot' }}"></span>

                                                           {{-- @if($client->active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif --}}
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-danger">No Project data found.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-1">
                                <button type="submit" class="btn btn-primary">{{ isset($users->id) ? 'Update' : 'Save' }}</button>
                            </div>
                        </div>
                    </div>
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
        },
        submitHandler: function(form) {
            // Serialize form data and convert selected client data to JSON
            var formData = $(form).serializeArray();
            var clientData = [];
            $('input[name="client_data[]"]:checked').each(function() {
                clientData.push($(this).val());
            });

            form.submit();
        }
    });
</script>
@endpush
