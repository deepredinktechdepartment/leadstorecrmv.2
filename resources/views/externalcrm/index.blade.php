@extends('layouts.app')
@section('content')

@php
use App\Models\Setting;
// Retrieve the setting
$type = 'external_crm_config';
$clientId = $client->id;
$setting = Setting::where('client_id', $clientId)
    ->where('type', $type)
    ->first();

// Initialize formData as an empty array
$crmAccount = [];

// Check if setting exists and form_data is valid JSON
if ($setting) {
    json_decode($setting->form_data);
    if (json_last_error() === JSON_ERROR_NONE) {
        // Decode JSON data if valid
        $crmAccount = json_decode($setting->form_data, true);
    }
}
@endphp

<div class="lead_adds_sec">
    <div class="row">
        <div class="col-lg-3">
            <x-project-side-menu :client="$client" />
        </div>
        <div class="col-lg-9">
            <div class="lead_adds_main_wrapper py-5 px-4">
                <form action="{{ route('store.Or.Update.Setting', [
                    'client_id' => $clientId,
                    'type' => $type,
                ]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- CRM Name -->
                            <div class="form-group mb-0">
                                <label for="crm_name" class="form-label">CRM Name:</label>
                                <input type="text" id="crm_name" name="crm_name" class="form-control" value="{{ old('crm_name', $crmAccount['crm_name'] ?? '') }}" required>
                            </div>

                            <!-- API URL -->
                            <div class="form-group mb-0">
                                <label for="api_url" class="form-label">API URL:</label>
                                <input type="url" id="api_url" name="api_url" class="form-control" value="{{ old('api_url', $crmAccount['api_url'] ?? '') }}" required>
                            </div>

                            <!-- Authentication Method -->
                            <div class="form-group mb-0">
                                <label for="auth_method" class="form-label">Auth Method:</label>
                                <select id="auth_method" name="auth_method" class="form-select" required>
                                    <option value="Bearer Token" {{ old('auth_method', $crmAccount['auth_method'] ?? '') == 'Bearer Token' ? 'selected' : '' }}>Bearer Token</option>
                                    <option value="API Key" {{ old('auth_method', $crmAccount['auth_method'] ?? '') == 'API Key' ? 'selected' : '' }}>API Key</option>
                                    <option value="Username & Password" {{ old('auth_method', $crmAccount['auth_method'] ?? '') == 'Username & Password' ? 'selected' : '' }}>Username & Password</option>
                                </select>
                            </div>

                            <!-- Token Field -->
                            <div class="form-group mb-0" id="token_field" style="display: {{ old('auth_method', $crmAccount['auth_method'] ?? '') == 'Bearer Token' ? 'block' : 'none' }};">
                                <label for="api_token" class="form-label">API Token:</label>
                                <input type="text" id="api_token" name="api_token" class="form-control" value="{{ old('api_token', $crmAccount['api_token'] ?? '') }}">
                            </div>

                            <!-- API Key Field -->
                            <div class="form-group mb-0" id="api_key_field" style="display: {{ old('auth_method', $crmAccount['auth_method'] ?? '') == 'API Key' ? 'block' : 'none' }};">
                                <label for="api_key" class="form-label">API Key:</label>
                                <input type="text" id="api_key" name="api_key" class="form-control" value="{{ old('api_key', $crmAccount['api_key'] ?? '') }}">
                            </div>

                            <!-- Username & Password Fields -->
                            <div class="form-group mb-0" id="username_password_fields" style="display: {{ old('auth_method', $crmAccount['auth_method'] ?? '') == 'Username & Password' ? 'block' : 'none' }};">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $crmAccount['username'] ?? '') }}" placeholder="Enter Username" >
                                <label for="password" class="form-label mt-2">Password:</label>
                                <input type="text" id="password" name="password" class="form-control" value="{{ old('password', $crmAccount['password'] ?? '') }}" placeholder="Enter Password" >
                            </div>
                             <!-- Status -->
<div class="form-group mb-0">
    <label class="form-label">Status:</label>
    <div class="form-check form-check-inline">
        <input type="radio" id="active" name="is_active" value="1" class="form-check-input" {{ old('is_active', $crmAccount['is_active'] ?? 1) == 1 ? 'checked' : '' }}>
        <label for="active" class="form-check-label">Active</label>
    </div>
    <div class="form-check form-check-inline">
        <input type="radio" id="inactive" name="is_active" value="0" class="form-check-input" {{ old('is_active', $crmAccount['is_active'] ?? 1) == 0 ? 'checked' : '' }}>
        <label for="inactive" class="form-check-label">Inactive</label>
    </div>
</div>


                                    <div class="form-group mb-0">
                                        <button id="send" type="submit" class="btn btn-danger">Update</button>
                                    </div>
                            </div>
                            <div class="col-lg-8">

                            <!-- Schema Fields -->
                            <div id="schema_fields">
                                @php
                                    $schemaFields = $crmAccount['schema'] ?? [];
                                    $index = 0;
                                @endphp
                                @foreach ($schemaFields as $key => $value)
                                    <div class="row no-gutters schema-row align-items-end mt-2" data-index="{{ $index }}">
                                        <div class="col-4">
                                            @if( $index==0)
                                            <label for="schema_key_{{ $index }}" class="form-label">Key:</label>
                                            @endif
                                            <input type="text" id="schema_key_{{ $index }}" name="schema_keys[]" class="form-control" value="{{ old('schema_keys.' . $index, $key) }}" placeholder="Enter key">
                                        </div>
                                        <div class="col-4">
                                            @if( $index==0)
                                            <label for="schema_value_{{ $index }}" class="form-label">Value:</label>
                                            @endif
                                            <input type="text" id="schema_value_{{ $index }}" name="schema_values[]" class="form-control" value="{{ old('schema_values.' . $index, $value) }}" placeholder="Enter value">
                                        </div>
                                        <div class="col-4 d-flex align-items-end">
                                            <i class="fa fa-trash remove-schema-field" style="cursor: pointer; color: red;"></i> <!-- Font Awesome trash icon -->
                                        </div>
                                    </div>
                                    @php $index++; @endphp
                                @endforeach
                            </div>
                            <button type="button" id="add_schema_field" class="btn btn-secondary mt-4">Add More Schema Fields</button>


                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        function toggleFields() {
            var authMethod = $('#auth_method').val();
            $('#token_field').hide();
            $('#username_password_fields').hide();
            $('#api_key_field').hide();

            if (authMethod === 'Bearer Token') {
                $('#token_field').show();
            } else if (authMethod === 'Username & Password') {
                $('#username_password_fields').show();
            } else if (authMethod === 'API Key') {
                $('#api_key_field').show();
            }
        }

        // Initialize visibility based on the current value
        toggleFields();

        // Change event for the authentication method select
        $('#auth_method').change(function() {
            toggleFields();
        });

        // Handle adding new schema fields
        $('#add_schema_field').click(function() {
            var fieldIndex = $('#schema_fields .schema-row').length;
            var newField = `
                <div class="row no-gutters schema-row align-items-end mt-2" data-index="${fieldIndex}">
                    <div class="col-4">

                        <input type="text" id="schema_key_${fieldIndex}" name="schema_keys[]" class="form-control" placeholder="Enter key">
                    </div>
                    <div class="col-4">

                        <input type="text" id="schema_value_${fieldIndex}" name="schema_values[]" class="form-control" placeholder="Enter value">
                    </div>
                    <div class="col-4 d-flex align-items-end">
                        <i class="fa fa-trash remove-schema-field" style="cursor: pointer; color: red;"></i>
                    </div>
                </div>
            `;
            $('#schema_fields').append(newField);
        });

        // Handle removing schema fields
        $(document).on('click', '.remove-schema-field', function() {
            $(this).closest('.schema-row').remove();
        });
    });
</script>
@endpush
