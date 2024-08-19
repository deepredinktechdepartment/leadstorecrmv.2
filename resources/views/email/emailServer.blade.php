@extends('layouts.app')
@section('content')

@php

use App\Models\Setting;
  // Retrieve the setting
$type='smtp_credentials_emailer';
$clientId=$client->id;
$setting = Setting::where('client_id', $clientId)
->where('type', $type)
->first();

    // Initialize formData as an empty array
    $formData = [];

    // Check if setting exists and form_data is valid JSON
    if ($setting) {
        json_decode($setting->form_data);
        if (json_last_error() === JSON_ERROR_NONE) {
            // Decode JSON data if valid
            $formData = json_decode($setting->form_data, true);
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
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="control-label" for="host">Host</label>
                                <input type="text" name="host" value="{{ old('host', $formData['host'] ?? '') }}" id="host" class="form-control" required placeholder="Host">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="smtp_secure">SMTP Secure</label>
                                <input type="text" name="smtp_secure" value="{{ old('smtp_secure', $formData['smtp_secure'] ?? '') }}" id="smtp_secure" class="form-control" required placeholder="SMTP Secure">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="portno">Port Number</label>
                                <input type="number" name="portno" value="{{ old('portno', $formData['portno'] ?? '') }}" id="portno" class="form-control" required placeholder="Port Number" min="1" max="65535">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" name="username" value="{{ old('username', $formData['username'] ?? '') }}" id="username" class="form-control" required placeholder="Username">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" name="password" value="{{ old('password', $formData['password'] ?? '') }}" id="password" class="form-control" required placeholder="Password">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="from_name">From Name</label>
                                <input type="text" name="from_name" value="{{ old('from_name', $formData['from_name'] ?? '') }}" id="from_name" class="form-control" required placeholder="From Name">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="from_email">From Email</label>
                                <input type="email" name="from_email" value="{{ old('from_email', $formData['from_email'] ?? '') }}" id="from_email" class="form-control" required placeholder="From Email">
                            </div>
                            <div class="form-group mb-3">
                                <button id="send" type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
