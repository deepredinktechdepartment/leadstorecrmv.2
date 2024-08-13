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
                <h2 class="mb-3">A2AHome Land Exotel Connect</h2>
                <p class="mb-4">LeadStore provides an integration with Exotel APIs. If you want to track your calls and call your leads directly from LeadStore, follow the instructions and finish exotel setup. You will need an exotel account for this setup.</p>
                <form>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="text-dark" for="course">Exotel SID</label><br>
                                <small>Your Exotel SID - Get it from here: <br> http://my.exotel.in/settings/site#api-settings</small>
                                <input type="text" name="exotel_sid" value="" id="exotel_sid" class="form-control" placeholder="Exotel SID">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-dark " for="course">Exotel Token</label><br>
                                <small>Your Exotel SID - Get it from here: <br> http://my.exotel.in/settings/site#api-settings</small>
                                <input type="text" name="exotel_token" value="" id="exotel_token" class="form-control" placeholder="Exotel Token">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="course">CallerId</label><br>
                                <small>Your-Exotel-virtual-number</small>
                                <input type="text" name="callerid" value="" id="callerid" class="form-control" placeholder="CallerId">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="course">SRD ID (Livesquare)</label><br>
                                <input type="text" name="srdid" value="" id="srdid" class="form-control" placeholder="SRD">
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="Webhook URL">Webhook for Exotel</label><br>
                                <a href="#">https://leadstore.in/phonelead/capture/70</a>
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label" for="Webhook URL">Webhook for Livesquare</label><br>
                                <a href="#">https://leadstore.in/phonelead/livesquare_capture/70</a>
                            </div>
                            <div class="mb-3">
                                <button id="send" type="submit" class="btn btn-danger">Save</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <p class="mb-4">Exotel is a cloud telephony service provider. Integrate your call center and sales generated leads and audios directly into LeadStore using Webhooks and also automate call center process from LeadStore itself.</p>
                                <!-- Accordion Start-->
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed shadow-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                1. Integrating into existing call flow
                                            </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="mb-3">Track all the calls and recordings directly in the LMS by using Webhooks. Copy the webhook URL and paste it in the Passthru block in Exotel.</p>
                                                <p class="mb-3">Click on Admin -> App Bazar</p>
                                                <a class="mb-3" href="http://prntscr.com/fwosxj">http://prntscr.com/fwosxj</a>
                                                <p class="mb-3">Click on your existing call flow and add a passthrough at the end of the call flow.</p>
                                                <a class="mb-3" href="http://prntscr.com/fwot82">http://prntscr.com/fwot82</a> <br>
                                                <a class="mb-3" href="http://prntscr.com/fwotfq">http://prntscr.com/fwotfq</a>
                                                <p>Save your call flow and that’s it. All your calls will automatically mapped to leads</p>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed shadow-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            2. Automating Calls from LeadStore
                                            </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="mb-3">Go to My Account page in Exotel. <a href="http://prntscr.com/g0ydir">(http://prntscr.com/g0ydir)</a></p>
                                                <p class="mb-3">Click on Settings->API Settings and then copy the SID and Token. <a href="http://prntscr.com/g0ye8b">(http://prntscr.com/g0ye8b)</a></p>
                                                <p class="mb-3">Paste these values in the Exotel Config page in Lead Store.</p>
                                                <p class="mb-3">Enter your Exotel Virtual Number in the Caller ID field. (This is the number from which calls will be made to customers from LeadStore)</p>
                                                <p>Click Save to finish.</p>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed shadow-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            3. LeadStore WebHook Example
                                            </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p>Sample PHP Code: LeadStore WebHook Example</p>
                                            </div>
                                        </div>
                                    </div>
                                <!-- Accordion End-->
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
