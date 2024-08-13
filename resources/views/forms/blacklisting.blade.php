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
                <h2 class="mb-4">A2AHome Land Blacklisting</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="control-label" for="course">Domain Names<span class="text text-danger">*</span> <small>(Seperate By , With More Domain Names)</small></label>
                            <textarea name="emails" cols="10" rows="5" id="emails" class="form-control" value="" placeholder="Domain Names"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="control-label " for="course">Names<span class="text text-danger">*</span> <small>(Seperate By , With More Names)</small></label>
                            <input type="text" name="names" value="" id="names" class="form-control" placeholder="Names">
                        </div>
                        <div class="form-group mb-3">
                            <button id="send" type="submit" class="btn btn-danger">Update</button>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
