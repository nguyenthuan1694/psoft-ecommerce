@extends('auth.header')
<link rel="stylesheet" href="{{ asset('backend/css/login/login.css') }}" type="text/css" />
<section>
    <div class="main-form-container">
        <div id="form_section" class="form-container">
            <div class="login-form form-wraper">
                <div>
                    <div class="form-title">
                        <h2>Login</h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="login100-form">
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
                                <span>
                                    <input
                                        placeholder="Email"
                                        class="myInput {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        type="text"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Vui lòng nhập email"
                                        autofocus
                                        maxlength="50"
                                    />
                                </span>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="valid-error-css">
                                @if ($errors->has('password'))
                                <span class="text-danger">
                                    <i>{{ $errors->first('password') }}</i>
                                </span>
                                @endif
                            </div>
                            <div class="box">
                                <span>
                                    <input
                                        placeholder="Password"
                                        class="myInput {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        type="password"
                                        placeholder="Vui lòng nhập mật khẩu"
                                        name="password"
                                        value="{{ old('password') }}"
                                        autocomplete="false"
                                    />
                                </span>
                            </div>
                        </div>
                        <div class="forget-password">
                            <a href="{{ route('password.request') }}">Quên Mật Khẩu</a>
                        </div>
                        <div class="action-button">
                            <button>Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="signUp-form form-wraper">
                <div>
                    <div class="form-title">
                        <h2>Sign Up</h2>
                    </div>
                    <div class="input-group">
                        <div class="box">
                            <span>
                                <input placeholder="Full Name" class="myInput" type="text" />
                            </span>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="box">
                            <span>
                                <input placeholder="Email" class="myInput" type="text" />
                            </span>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="box">
                            <span>
                                <input placeholder="Mobile No." class="myInput" type="number" />
                            </span>
                        </div>
                    </div>
                    <div style="margin-bottom: 0px;" class="input-group">
                        <div class="box">
                            <span>
                                <input placeholder="Password" class="myInput" type="password" />
                            </span>
                        </div>
                    </div>
                    <div class="action-button">
                        <button>Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="multiple-btn" class="bg-btn-container">
            <div class="action-button">
                <button>Login</button>
            </div>
            <div class="action-button">
                <button>Sign Up</button>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    const inputs = document.querySelectorAll("input");
    inputs.forEach(function (input) {
        input.addEventListener("focus", function () {
            const parentElement = input.parentElement.parentElement;
            parentElement.classList.add("box-animation");
        });
        input.addEventListener("blur", function () {
            const parentElement = input.parentElement.parentElement;
            parentElement.classList.remove("box-animation");
        });
    });

    const buttons = document.querySelectorAll("#multiple-btn button");
    const form_container = document.getElementById("form_section");
    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            form_container.classList.toggle("left-right");
        });
    });
</script>
