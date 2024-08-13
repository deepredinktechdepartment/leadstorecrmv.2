@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')

@include('masters._back_button', ['useRoute' => true, 'routeName' => 'organizations.single.project', 'routeParams' => ['projectID'=>Crypt::encryptString($Project->id)], 'url' => ''])

<div class="row">
        <div class="col-lg-4">
        <div class="card">


        <form method="POST" action="{{ route('store.api_credentials') }}">
            @csrf


            <div class="form-group">
                <label for="api_key">API Key:</label>
                <input type="text" name="api_key" id="api_key" class="form-control" value="{{ $ApiCredential->api_key??'' }}" required>
            </div>
            <!-- Add other form fields as needed -->
            <button type="submit" class="btn btn-primary">Save</button>
            <input type="hidden" name="project" value="{{ $Project->id??0 }}" />
        </form>


</div>
</div>
<div class="col-1">
</div>
    <div class="col-lg-7">
    <div class="card">
<h4 class="mb-4">To connect the LeadStore CRM App, you will need the following:</h4>

    <h5><b>LeadStore Account</b></h5>
    <p>If you do not have an account already, call <b>+91-89770 03960</b> or email: <a href="mailto:ranjith@deepredink.com"><b>ranjith@deepredink.com </b></a>.</p>
    <p>If you already have an account, log in to the LeadStore Account.</p>
    <h5 class="mt-4"><b>Creating an API Key</b></h5>
    <p>After logging into your LeadStore Account, create the API Key.</p>
    <h5 class="mt-4"><b>Setup the API Key on your Intranet Account</b></h5>
    <p>Use the API Key and Merchant ID that you copied from LeadStore in the LeadStore Connect screen of your Intranet.</p>

</div>
</div>


</div>





@endsection
@push('scripts')



@endpush