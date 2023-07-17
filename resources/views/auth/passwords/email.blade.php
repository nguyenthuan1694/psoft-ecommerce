@extends('auth.header')
<link rel="stylesheet" href="{{ asset('backend/css/login/login.css') }}" type="text/css" />
<section>
    <div class="main-form_reset-container">
        <div id="form_section" class="form-reset-container">
            <div class="login-form form-wraper">
                <div class="">
                    <div class="form-title">
                        <h2>Reset Password</h2>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}" class="login100-form">
                        @csrf
                        <div class="input-group">
                            <div class="valid-error-css mb-2">
                                @if ($errors->has('email'))
                                <span class="text-danger">
                                <i>{{ $errors->first('email') }}</i>
                                </span>
                                @endif
                            </div>
                            <div class="box">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <span>
                                    <input
                                        placeholder="Email"
                                        class="myInput @error('email') is-invalid @enderror"
                                        type="text"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Vui lòng nhập email"
                                        autofocus
                                        maxlength="50"
                                    />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">    
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="action-button">
                            <button type="submit">{{ __('Send Password Reset Link') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
