@extends('layouts.app')
@section('content')
<div class="row auth-wrapper gx-0 d-flex justify-content-center min-vh-100 align-items-center">
    <div class="col-lg-4 col-md-4 col-sm-10">
        <div class="text-center mb-4">
          <h1>{{ env('APP_NAME') }}</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                  <a href="{{ url('/') }}">
                    <h2 class="mb-4 text-center">{{ $pageTitle ?? '' }}</h2>
                  </a>
                </div>

                <form method="POST" action="{{ route('setup.password.update', ['userID' => Crypt::encryptString($user->id ?? 0)]) }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">{{ __('Username') }}</label>
                        <input readonly id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->username ?? old('email') }}" required autocomplete="email" readonly>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="text-dark small-text">{!! Config::get('constants.fa-circle-exclamation') !!} Passwords must have at least 8 characters.</p>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        @if($user->active)
                            {{ __('Update Password') }}
                        @else
                            {{ __('Create Password') }}
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
$(document).ready(function() {
    $('form').on('submit', function(event) {
        var password = $('#password').val();
        var confirmPassword = $('#password-confirm').val();
        var isValid = true;

        // Clear previous error messages
        $('.invalid-feedback').remove();
        $('.form-control').removeClass('is-invalid');

        // Check if password is at least 8 characters long
        if (password.length < 8) {
            $('#password').addClass('is-invalid');
            $('#password').after('<span class="invalid-feedback">Password must be at least 8 characters long.</span>');
            isValid = false;
        }

        // Check if password contains empty spaces
        if (/\s/.test(password)) {
            $('#password').addClass('is-invalid');
            $('#password').after('<span class="invalid-feedback">Password cannot contain spaces.</span>');
            isValid = false;
        }

        // Check if password and confirm password match
        if (password !== confirmPassword) {
            $('#password-confirm').addClass('is-invalid');
            $('#password-confirm').after('<span class="invalid-feedback">Passwords do not match.</span>');
            isValid = false;
        }

        // Prevent form submission if invalid
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>
@endpush
