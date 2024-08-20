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


                <!--Content here-->

            </div>
        </div>
    </div>
</div>

@endsection
