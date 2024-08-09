@extends('layouts.app')

@section('content')
<h1 class="mb-4">Settings for {{ $client->client_name }}</h1>
<div class="lead_adds_sec">
    <div class="row">
        <div class="col-lg-3">
            <div class="lead_adds_side_bar py-5 px-4">
                <ul class="setting_menu">
                  <li><a href="#" target="_blank">Dashboard</a></li>

                  <li class="heading">Social</li>
                  <li><a href="#">Facebook</a></li>
                  <li><a href="#">Facebook Pages</a></li>
                   <li><a href="#">Competitor Scores</a></li>

                  <li class="heading">Cloud Telephony</li>
                  <li><a href="#">Exotel</a></li>

                  <li class="heading">Email</li>
                  <li><a href="#">Email Server</a></li>
                  <li><a href="#">First Response Emailer</a></li>
                  <li><a href="#">Lead Notifications</a></li>
                  <li><a href="#">FRE Template</a></li>
                  <li><a href="">Lead Notification Template</a></li>

                  <li class="heading">SMS</li>
                  <li><a href="">SMS Gateway</a></li>
                  <li><a href="#">First Response SMS</a></li>
                  <li><a href="#">Lead Notifications</a></li>
                  <li><a href="#">FRE Template</a></li>
                  <li><a href="#">Lead Notification Template</a></li>

                  <li class="heading">Reporting</li>
                  <li><a href="#">Lead Summary Notifications</a></li>

                  <li class="heading">Goals</li>
                  <li><a href="#">Setup Monthly Goals</a></li>
                  
                  <li class="heading">Forms</li>
                  <li><a href="#">Lead Capture</a></li>
                  <li><a href="#">Lead Actions</a></li>
                  <li><a href="#">Blacklisting</a></li>
                  <li><a href="#">Hide Cust Info</a></li>

                  <li class="heading">Revenue Tracking</li>
                  <li><a href="#"> Revenue Tracking</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="lead_adds_main_wrapper py-5 px-4">
                <h1 class="m-0 p-0">A2AHome Land FB Connect</h1>
            </div>
        </div>
    </div>
</div>

@endsection
