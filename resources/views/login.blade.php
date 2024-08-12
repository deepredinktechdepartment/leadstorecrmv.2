@extends('layouts.app')
@section('title', 'Login')
@section('content')

<div class="p-0 login-sec d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-sm-8 col-md-6 col-lg-4">
        <div class="login-form-wrapper p-4" style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <h2 class="mb-4 text-center">Login</h2>

            <form id="loginForm" class="form-horizontal mt-2 pt-2 needs-validation" novalidate action="{{ route('auth.verify') }}" method="post">
                @csrf
                <div class="mb-1">
                    <label for="tb-email">Username</label>
                    <input type="text" class="form-control" id="tb-email" placeholder="" required name="username" />

                </div>

                <div class="mb-1">
                    <label for="text-password">Password</label>
                    <input type="password" class="form-control" id="text-password" placeholder="" required name="password" />

                </div>

                <div class="d-flex align-items-stretch button-group mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-block w-100 mb-4">Sign in</button>
                </div>
            </form>

            <div class="row">
                <div class="col-sm-12 text-left">
                    <div class="login-info-text">
                    <a href="{{ route('forget.password') }}">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#loginForm').validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Please enter your username"
            },
            password: {
                required: "Please enter your password"
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.mb-1').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
});
</script>
@endpush
