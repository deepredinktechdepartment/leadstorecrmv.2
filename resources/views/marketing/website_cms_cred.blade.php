@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')

<div class="row card">
<div class="col-lg-12">

<p class="text text-dark small mb-4">{!! Config::get('constants.fa-circle-exclamation') !!} Passwords are encrypted and inaccessible to unauthorized parties.</p>



<form method="POST" action="{{ route('store.website_cms',['type_of_upload'=>$type_of_upload]) }}">
    @csrf

    <div class="row">
            <!-- Left Column -->
            <div class="col-md-3">
            <!-- Domain Section -->
            <fieldset>
            <legend>Domain</legend>
            <div class="form-group">
            <label for="domain_url">Domain:</label>
            <input type="url" name="domain_url" id="domain_url" class="form-control">
            </div>
            </div>
            </fieldset>
                <!-- Domain Registration Section -->
                
                <div class="col-md-3">
                <fieldset>
                    <legend>Domain Registration</legend>
                    <div class="form-group">
                        <label for="domain_reg_url">Domain Register URL:</label>
                        <input type="url" name="domain_reg_url" id="domain_reg_url" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="domain_reg_uname">Username:</label>
                        <input type="text" name="domain_reg_uname" id="domain_reg_uname" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="domain_reg_pwd">Password:</label>
                        <input type="password" name="domain_reg_pwd" id="domain_reg_pwd" class="form-control">
                    </div>
                </fieldset>
            
        </div>

        <!-- Right Column -->
        <div class="col-md-3">
            <!-- Hosting Section -->
            <fieldset>
                <legend>Hosting</legend>
                <div class="form-group">
                    <label for="hosting_url">Hosting URL:</label>
                    <input type="url" name="hosting_url" id="hosting_url" class="form-control">
                </div>

                <div class="form-group">
                    <label for="hosting_uname">Username:</label>
                    <input type="text" name="hosting_uname" id="hosting_uname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="hosting_password">Password:</label>
                    <input type="password" name="hosting_password" id="hosting_password" class="form-control">
                </div>
            </fieldset>
            
            </div>
            

            <!-- CMS Section -->
            <div class="col-md-3">
            <fieldset>
                <legend>CMS</legend>
                <div class="form-group">
                    <label for="cms_login_url">CMS URL:</label>
                    <input type="url" name="cms_login_url" id="cms_login_url" class="form-control">
                </div>

                <div class="form-group">
                    <label for="cms_uname">Username:</label>
                    <input type="text" name="cms_uname" id="cms_uname" class="form-control">
                </div>

                <div class="form-group">
                    <label for="cms_password">Password:</label>
                    <input type="password" name="cms_password" id="cms_password" class="form-control">
                </div>
            </fieldset>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-sm mt-4">Save</button>
</form>




</div>
</div>



@endsection
@push('scripts')

@endpush