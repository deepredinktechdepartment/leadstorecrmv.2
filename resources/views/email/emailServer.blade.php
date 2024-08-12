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
                <h2 class="mb-3">A2AHome Land Email Server</h2>
                <p class="mb-3">Send lead notification emails and first response emails through your mail server. Enter the details below to setup your own mail server.</p>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="control-label" for="course">Host</label>
                                <input type="text" name="host" value="" id="host" class="form-control" required="required" placeholder="Host">
                            </div>
                            <div class="mb-3">
                                <label class="control-label " for="course">SMTP Secure</label>
                                <input type="text" name="smtp_secure" value="" id="smtp_secure" class="form-control" required="required" placeholder="SMTP Secure">
                            </div>
                            <div class="mb-3">
                                <label class="control-label" for="course">Port Number</label>
                                <input type="text" name="portno" value="" id="portno" class="form-control" placeholder="Port number">
                            </div>
                            <div class="mb-3">
                                <label class="control-label" for="course">Username</label>
                                <input type="text" name="username" value="" id="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label class="control-label " for="course">Password</label>
                                <input type="password" name="password" value="" id="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label class="control-label " for="course">From Name</label>
                                <input type="text" name="from_name" value="" id="from_name" class="form-control" placeholder="From Name">
                            </div>
                            <div class="mb-3">
                                <label class="control-label" for="course">From Email</label>
                                <input type="text" name="from_email" value="" id="from_email" class="form-control" placeholder="From Email">
                            </div>
                            <div class="mb-3">
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

