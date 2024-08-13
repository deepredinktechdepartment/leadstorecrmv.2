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
                <h2 class="mb-3">A2AHome Land FRE Template</h2>
                <form action="#">
                    <div class="alert alert-info mb-3" role="alert">
                        <div class="row">
                            <div class="col-md-3">
                                [firstname]<br>[phone]<br>[email]<br>[message]
                            </div>
                            <div class="col-md-3">
                                [utm_source]<br>[utm_medium]<br>[utm_campaign]<br>[utm_term]<br>[utm_content]
                            </div>
                            <div class="col-md-3">
                                [udf1]<br>[udf2]<br>[udf3]<br>[udf4]<br>[udf5]
                            </div>
                            <div class="col-md-3">
                                [attachment_file]<br>[landing_page_title]
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
