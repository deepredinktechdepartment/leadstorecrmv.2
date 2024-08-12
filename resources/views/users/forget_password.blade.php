@extends('layouts.app')
@section('content')
@php
use App\Models\Themeoptions;
use Illuminate\Support\Facades\Auth;
use App\Scopes\ActiveOrgaization;
$theme_options_data = Themeoptions::withoutGlobalScope(new ActiveOrgaization)->get()->first();
@endphp

<div class="row auth-wrapper gx-0 d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-lg-4 col-md-4 col-sm-12">
        @if(isset($theme_options_data->header_logo) && !empty($theme_options_data->header_logo))
            <div class="text-center mb-4">
              <a href="{{ url('/') }}">
              <h1>{{ env('APP_NAME') }}</h1>
              </a>
            </div>
        @else
            @if(Auth::check())
                <div class="text-center mb-4">
                  <a href="{{ url('/') }}">
                    <h1>{{ env('APP_NAME') }}</h1>
                  </a>
                </div>
            @endif
        @endif

        <div class="card">
            <div class="card-body">
                <div class="text-center mb-0">
                  <h2 class="mb-4 text-center">{{ $pageTitle ?? '' }}</h2>
                </div>

                <form method="POST" action="{{ route('forget.password.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email">{{ __('Username') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Send') }}
                    </button>
                </form>

                <p class="text-small mt-0">
                    <a href="{{ route('login') }}" class="resetpwd_form_title pt-1 mt-1"><u>Sign In</u></a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
