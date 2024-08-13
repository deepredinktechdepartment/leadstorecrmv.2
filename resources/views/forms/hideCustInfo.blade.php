@extends('layouts.app')
@section('content')
<h1 class="mb-4">Settings for {{ $client->client_name }}</h1>
<div class="lead_adds_sec">
    <div class="row">
        <div class="col-lg-3">
             <x-project-side-menu :client="$client" />
        </div>
        <div class="col-lg-9">
            <div class="lead_adds_main_wrapper py-5 px-4">
                <h2 class="mb-4">A2AHome Land Hide Cust Info</h2>
                <div class="mb-4">   
                    <div class="mb-2">
                        <p for="#" class="fw-bold">Hide Email</p>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="weekly" id="weeklyYes">
                        <label class="form-check-label" for="weeklyYes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="weekly" id="weeklyNo" checked>
                        <label class="form-check-label" for="weeklyNo">
                            No
                        </label>
                    </div>
                </div>
                <button id="send" type="submit" class="btn btn-danger">Update</button>
            </div>
        </div>
    </div>
</div>

@endsection
