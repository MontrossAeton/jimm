@extends('layouts.app')

@section('content')
<div class="page-header" style="background-image: url('/img/login-image.jpg');">
    <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <div class="card card-register">
                        <h3 class="title">Login</h3>
                        <form method="POST" action="{{ route('login') }}" class="register-form">
                            @csrf
                            <label>Email</label>
                            <div class="input-group form-group-no-border">
                                <span class="input-group-addon">
                                    <i class="nc-icon nc-email-85"></i>
                                </span>
                                <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label>Password</label>
                            <div class="input-group form-group-no-border">
                                <span class="input-group-addon">
                                    <i class="nc-icon nc-key-25"></i>
                                </span>
                                <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <button class="btn btn-danger btn-block btn-round">Login</button>
                        </form>
                        <div class="forgot">
                            <a href="{{ route('password.request') }}" class="btn btn-link btn-danger">Forgot password?</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer register-footer text-center">
                <h6>&copy; <script>document.write(new Date().getFullYear())</script>, by Jimboy Team</h6>
            </div>
    </div>
</div>
@endsection
