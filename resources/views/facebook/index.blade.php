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
                <h2 class="mb-3">A2AHome Land FB Connect</h2>
                <p class="mb-4">Do you run Facebook Lead Ads to get leads? Now seamlessly integrate Facebook LeadAds into LeadStore through the following integration.</p>
                <a href="#" class="btn btn-blue text-white mb-4">Log in with Facebook!</a>

                <div>
                    <!-- Accordion Start-->
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                1. Integrating into Facebook Lead Ads flow
                            </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <p class="mb-3">Facebook Lead Ads enable you to create forms in Facebook Ads itself. This integration will pull all the leads from Lead Ads into the LMS directly.</p>
                                <p class="mb-3">Following are the steps for this integration:</p>
                                <ol>
                                    <li>Click on Projects and then Lead Ads Integration - <a href="https://prnt.sc/g3dus7" target="_blank">http://prntscr.com/g3dus7</a></li>
                                    <li>Then click on Login with Facebook and Sign in with your Facebook account which has access to the page where Lead Ads are being launched or are active.</li>
                                    <li>Click Authorize against the page where Lead Ads are active. - <a href="http://prntscr.com/g3e96a" target="_blank">http://prntscr.com/g3e96a</a></li>
                                    <li>Wait for Authorized message and your leads will now be automatically pulled into LeadStore - <a href="http://prntscr.com/g3e9jw" target="_blank">http://prntscr.com/g3e9jw</a></li>
                                </ol>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Accordion End-->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
