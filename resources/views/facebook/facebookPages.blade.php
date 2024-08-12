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
                <h2 class="mb-3">A2AHome Land Facebook Pages</h2>
                <a href="#" class="btn btn-blue text-white mb-4">Log in with Facebook!</a>
            </div>
        </div>
    </div>
</div>

@endsection
