@extends('layouts.app')
@section('title', 'Login')
@php
use App\Scopes\ActiveOrgaization;
use App\Models\Themeoptions;
$theme_options_data=Themeoptions::withoutGlobalScope(new ActiveOrgaization)->get()->first();
@endphp
@section('content')

<div class="p-0 login-sec">
    <div class="row m-0 align-items-center h-100">
        <div class="col-sm-7 login-img-bg h-100">
            <div class="text-center h-100 d-flex justify-content-center">
                <img src="https://imgur.com/4KNcw2l.png" alt="Login Bg" class="img-fluid login-img">
            </div>
        </div>
        <div class="col-sm-5 h-100 login-form-bg">
            <div class="login-form-wrapper">
                <h2 class="mb-4 text-sm-start text-center">Login</h2>

                <form id="loginForm" class="form-horizontal mt-2 pt-2 needs-validation" novalidate action="{{ route('auth.verify') }}" method="post">
                    @csrf
                    <div class="mb-1">
                        <label for="tb-email">Username</label>
                        <input type="text" class="form-control" id="tb-email" placeholder="" required name="username" />
                        <div class="invalid-feedback">Username is required</div>
                    </div>

                    <div class="mb-1">
                        <label for="text-password">Password</label>
                        <input type="password" class="form-control" id="text-password" placeholder="" required name="password" />
                        <div class="invalid-feedback">Password is required</div>
                    </div>

                    <div class="d-flex align-items-stretch button-group mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-block w-100 mb-4">Sign in</button>
                    </div>
                </form>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="login-info-text">
                            <a href="{{ route('forget.password') }}">Forgot Password?</a>
                        </div>
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
