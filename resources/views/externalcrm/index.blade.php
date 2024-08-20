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
            @verbatim
            <div class="alert alert-info mb-3 mt-3" role="alert">
                <div class="row">
                    <div class="col-md-3">
                        Name: {{name}}<br> <!-- This will now be treated as plain text -->
                        Phone: {{mobile}}<br>
                        Email: {{email}}<br>
                    </div>
                    <div class="col-md-4">
                        UTM Source: {{utm_source}}<br>
                        UTM Medium: {{utm_medium}}<br>
                        UTM Campaign: {{utm_campaign}}<br>
                        UTM Term: {{utm_term}}<br>
                        UTM Content: {{utm_content}}
                    </div>
                </div>
            </div>
            @endverbatim

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
                            <div class="form-group mb-0">
                                <label for="request_method" class="form-label">Request Method:</label>
                                <select id="request_method" name="request_method" class="form-select" required>
                                    <option value="GET" {{ old('request_method', $crmAccount['request_method'] ?? '') == 'GET' ? 'selected' : '' }}>GET</option>
                                    <option value="POST" {{ old('request_method', $crmAccount['request_method'] ?? '') == 'POST' ? 'selected' : '' }}>POST</option>
                                </select>
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
                                    <option value="API Header" {{ old('auth_method', $crmAccount['auth_method'] ?? '') == 'API Header' ? 'selected' : '' }}>API Header</option>
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
                                <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $crmAccount['username'] ?? '') }}" placeholder="Enter Username">
                                <label for="password" class="form-label mt-2">Password:</label>
                                <input type="text" id="password" name="password" class="form-control" value="{{ old('password', $crmAccount['password'] ?? '') }}" placeholder="Enter Password">
                            </div>

                            <!-- API Header Fields -->
                            <div class="form-group mb-0" id="api_header_fields" style="display: {{ old('auth_method', $crmAccount['auth_method'] ?? '') == 'API Header' ? 'block' : 'none' }};">
                                <label for="x_api_key" class="form-label">x-api-key:</label>
                                <input type="text" id="x_api_key" name="x_api_key" class="form-control" value="{{ old('x_api_key', $crmAccount['x_api_key'] ?? '') }}">
                                <label for="cookie" class="form-label mt-2">Cookie:</label>
                                <input type="text" id="cookie" name="cookie" class="form-control" value="{{ old('cookie', $crmAccount['cookie'] ?? '') }}">
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
                                <h4 class="m-0 p-0">Lead Variables</h4>
                                @php
                                    $schemaFields = $crmAccount['schema'] ?? [];
                                    $index = 0;
                                @endphp
                                @foreach ($schemaFields as $key => $value)
                                    <div class="row no-gutters schema-row align-items-end mt-2" data-index="{{ $index }}">
                                        <div class="col-4">
                                            @if($index==0)
                                            <label for="schema_key_{{ $index }}" class="form-label">Key:</label>
                                            @endif
                                            <input type="text" id="schema_key_{{ $index }}" name="schema_keys[]" class="form-control" value="{{ old('schema_keys.' . $index, $key) }}">
                                        </div>
                                        <div class="col-8">
                                            @if($index==0)
                                            <label for="schema_value_{{ $index }}" class="form-label">Value:</label>
                                            @endif
                                            <input type="text" id="schema_value_{{ $index }}" name="schema_values[]" class="form-control" value="{{ old('schema_values.' . $index, $value) }}">
                                        </div>
                                        <div class="col-12 mt-2">
                                            <button type="button" class="btn btn-danger remove_schema_field">Remove</button>
                                        </div>
                                    </div>
                                    @php $index++; @endphp
                                @endforeach
                            </div>
                            <button type="button" id="add_schema_field" class="btn btn-primary mt-3">Add More Fields</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        var authMethodField = document.getElementById('auth_method');
        var tokenField = document.getElementById('token_field');
        var apiKeyField = document.getElementById('api_key_field');
        var usernamePasswordFields = document.getElementById('username_password_fields');
        var apiHeaderFields = document.getElementById('api_header_fields');

        function updateAuthFields() {
            var selectedAuthMethod = authMethodField.value;

            tokenField.style.display = selectedAuthMethod === 'Bearer Token' ? 'block' : 'none';
            apiKeyField.style.display = selectedAuthMethod === 'API Key' ? 'block' : 'none';
            usernamePasswordFields.style.display = selectedAuthMethod === 'Username & Password' ? 'block' : 'none';
            apiHeaderFields.style.display = selectedAuthMethod === 'API Header' ? 'block' : 'none';
        }

        authMethodField.addEventListener('change', updateAuthFields);

        // Initial setup based on current selection
        updateAuthFields();

        // Add more schema fields dynamically
        document.getElementById('add_schema_field').addEventListener('click', function () {
            var schemaFields = document.getElementById('schema_fields');
            var index = document.querySelectorAll('.schema-row').length;
            var newFieldHtml = `
                <div class="row no-gutters schema-row align-items-end mt-2" data-index="${index}">
                    <div class="col-4">
                        <label for="schema_key_${index}" class="form-label">Key:</label>
                        <input type="text" id="schema_key_${index}" name="schema_keys[]" class="form-control">
                    </div>
                    <div class="col-8">
                        <label for="schema_value_${index}" class="form-label">Value:</label>
                        <input type="text" id="schema_value_${index}" name="schema_values[]" class="form-control">
                    </div>
                    <div class="col-12 mt-2">
                         <button type="button" class="btn btn-danger remove_schema_field">
                        <i class="fa fa-trash"></i>
                    </button>
                    </div>
                </div>`;
            schemaFields.insertAdjacentHTML('beforeend', newFieldHtml);
        });

        // Remove schema field
        document.getElementById('schema_fields').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove_schema_field')) {
                e.target.closest('.schema-row').remove();
            }
        });
    });
</script>
@endpush
