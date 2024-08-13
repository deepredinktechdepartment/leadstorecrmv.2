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
                <h2 class="mb-3">A2AHome Land SMS Gateway</h2>

                <div class="row">
                    <div class="col-lg-6">
                    <form action="https://leadstore.in/setting/save_sms/" class="form-horizontal form-label-left" name="emailgateway" id="emailgateway" method="post" accept-charset="utf-8">
                        <div class="form-group mb-3">
                            <label class="control-label text-black" for="course">Secure Key</label>							
                            <input type="text" name="secure_key" value="" id="secure_key" class="form-control" required="required" placeholder="Secure Key">
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label " for="course">Secure URL</label>
                            <input type="text" name="secure_url" value="" id="secure_url" class="form-control" required="required" placeholder="Secure URL">
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label" for="course">Sender Address</label>
                            <input type="text" name="sender_address" value="" id="sender_address" class="form-control" placeholder="Sender Address">
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label" for="course">Username</label>
                            <input type="text" name="username" value="" id="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label" for="course">Password</label>
                            <input type="password" name="password" value="" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group mb-3">
                            <button id="send" type="submit" class="btn btn-danger">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection
