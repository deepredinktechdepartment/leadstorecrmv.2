@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')

<div class="row card">
<div class="col-lg-12">

<p class="text text-dark small mb-4">{!! Config::get('constants.fa-circle-exclamation') !!} Passwords are encrypted and inaccessible to unauthorized parties.</p>
    <form method="POST" action="{{ route('store.social_media_handler',['type_of_upload'=>$type_of_upload]) }}">
        @csrf


<div class="row">
        <!-- Facebook Column -->
        <div class="col-md-3">
                <!-- Facebook Section -->
                <fieldset>
                <legend>Facebook</legend>
                <div class="form-group">
                <label for="facebook_handle">Facebook Handle:</label>
                <input type="text" name="facebook_handle" id="facebook_handle" class="form-control">
                </div>
                
                <div class="form-group">
                <label for="facebook_password">Facebook Password:</label>
                <input type="password" name="facebook_password" id="facebook_password" class="form-control">
                </div>
                
                <div class="form-group">
                <label for="facebook_password">Facebook Login URL:</label>
                <input type="url" name="facebook_login_url" id="facebook_login_url" class="form-control">
                </div>
                </fieldset>

</div>


        <!-- Facebook Column -->
        <div class="col-md-3">
        <!-- Instagram Section -->
        <fieldset>
            <legend>Instagram</legend>
            <div class="form-group">
                <label for="instagram_handle">Instagram Handle:</label>
                <input type="text" name="instagram_handle" id="instagram_handle" class="form-control">
            </div>

            <div class="form-group">
                <label for="instagram_password">Instagram Password:</label>
                <input type="password" name="instagram_password" id="instagram_password" class="form-control">
            </div>

            <div class="form-group">
                <label for="instagram_password">Instagram Login URL:</label>
                <input type="url" name="instagram_login_url" id="instagram_login_url" class="form-control">
            </div>
        </fieldset>
</div>
        <!-- Twitter Section -->
        

        <!-- Facebook Column -->
        <div class="col-md-3">
        <fieldset>
            <legend>Twitter</legend>
            <div class="form-group">
                <label for="twitter_handle">Twitter Handle:</label>
                <input type="text" name="twitter_handle" id="twitter_handle" class="form-control">
            </div>

            <div class="form-group">
                <label for="twitter_password">Twitter Password:</label>
                <input type="password" name="twitter_password" id="twitter_password" class="form-control">
            </div>

            <div class="form-group">
                <label for="twitter_password">Twitter Login URL:</label>
                <input type="url" name="twitter_login_url" id="twitter_login_url" class="form-control">
            </div>
        </fieldset>

</div>
        <!-- LinkedIn Section -->
    
        <!-- Facebook Column -->
        <div class="col-md-3">
        <fieldset>
            <legend>LinkedIn</legend>
            <div class="form-group">
                <label for="linkedin_handle">LinkedIn Handle:</label>
                <input type="text" name="linkedin_handle" id="linkedin_handle" class="form-control">
            </div>

            <div class="form-group">
                <label for="linkedin_password">LinkedIn Password:</label>
                <input type="password" name="linkedin_password" id="linkedin_password" class="form-control">
            </div>

            <div class="form-group">
                <label for="linkedin_password">LinkedIn Login URL:</label>
                <input type="url" name="linkedin_login_url" id="linkedin_login_url" class="form-control">
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