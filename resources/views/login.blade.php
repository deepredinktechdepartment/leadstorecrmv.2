@extends('layouts.app')
@section('title', 'Login')
@php
use App\Scopes\ActiveOrgaization;
use App\Models\Themeoptions;
$theme_options_data=Themeoptions::withoutGlobalScope(new ActiveOrgaization)->get()->first();
@endphp
@section('content')



<div class="row auth-wrapper gx-0 d-flex justify-content-center">

    <div
      class="col-lg-6 d-flex align-items-center justify-content-center"
    >
      <div class="row justify-content-center w-100 mt-4 mt-lg-0">
        <div class="col-lg-7 col-xl-7 col-md-7">
          @if(isset($theme_options_data->header_logo) && !empty($theme_options_data->header_logo) )
<div class="text-center">
<img src="{{URL::to($theme_options_data->header_logo??'')}}" alt="Intranet" class="img-fluid mb-2"  style="filter: brightness(0) invert(1);" />
</div>

@else

@endif
          <div class="card" id="loginform">
            <div class="card-body">
                <div class="mb-2">



              </div>
              <h3 class="text-center">Login</h3>

              <form
                class="form-horizontal mt-2 pt-2 needs-validation" novalidate action="#" method="post">

                @csrf
                <div class="mb-3">
                  <label for="tb-email">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="tb-email"
                    placeholder=""
                    required name="i_username"
                  />

                  <div class="invalid-feedback">Username is required</div>
                </div>

                <div class="mb-3">
                  <label for="text-password">Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="text-password"
                    placeholder=""
                    required name="password"
                  />

                  <div class="invalid-feedback">Password is required</div>
                </div>

                <div
                  class="d-flex align-items-stretch button-group mt-4 pt-2"
                >
                 <button type="submit" class="btn btn-primary btn-block">
                    Sign in
                  </button>
                </div>

              </form>

              <p class="text-small mt-2"><a href="#" class="resetpwd_form_title" ><u>Forgot Password?</u></a></p>

            </div>
          </div>
          <div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
