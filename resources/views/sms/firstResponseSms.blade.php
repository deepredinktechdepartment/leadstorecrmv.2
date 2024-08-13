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
                <h2 class="mb-3">A2AHome Land First Response SMS</h2>
                <div class="mb-4">   
                    <div class="mb-2">
                        <p for="#" class="fw-bold">First Response SMS</p>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="yes" onclick="toggleForm(true)">
                        <label class="form-check-label" for="yes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="no" onclick="toggleForm(false)" checked>
                        <label class="form-check-label" for="no">
                            No
                        </label>
                    </div>
                </div>
                <form id="notificationForm" style="display: none;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <small>(Seperate by , with more Phone Numbers)</small>
                                <input type="text" name="first_response_emailer" value="" id="first_response_emailer" class="form-control" placeholder="First Response SMS">
                            </div>
                            <div>
                                <button id="send" type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleForm(isVisible) {
        const form = document.getElementById('notificationForm');
        form.style.display = isVisible ? 'block' : 'none';
    }
</script>
@endsection
