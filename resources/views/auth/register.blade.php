@extends('layouts.app')

@section('content')
    <div class="page-header" style="background-image: url('/img/login-image.jpg');">
        <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-4 ml-auto mr-auto" id="register-container">

                    <div class="card card-register">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active customer-tab" data-toggle="tab" href="#customer" role="tab">Customer</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link gym-owner-tab" data-toggle="tab" href="#gym" role="tab">Gym Owner</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="customer" role="tabpanel">
                                <h5 class="title">Customer Sign up</h5>
                                <form method="POST" action="/register" class="register-form">
                                    @csrf
                                    <label>Name</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                    <label>{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    <br>
                                    {!! NoCaptcha::display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif

                                    <button class="btn btn-danger btn-block btn-round">Register</button>
                                </form>
                            </div>
                            <div class="tab-pane" id="gym" role="tabpanel">
                                <h5 class="title">Gym Owner Sign up</h5>
                                <form method="POST" action="{{ route('register.admin') }}" class="register-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>Owner's credentials</h6>
                                            <label>Name</label>
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                            <label>Email</label>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif

                                            <label>Password</label>
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif

											<label>{{ __('Confirm Password') }}</label>
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
										</div>
										<div class="col-8">
											<div class="row">
												<div class="col">
													<h6>Gym's credentials</h6>
												</div>
											</div>
											<div class="row">
												<div class="col-6">
													<label>Gym Name</label>
                                                    <input id="name" type="text" class="form-control{{ $errors->has('gym_name') ? ' is-invalid' : '' }}" name="gym_name" value="{{ old('gym_name') }}" required autofocus>

                                                    @if ($errors->has('gym_name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('gym_name') }}</strong>
                                                        </span>
                                                    @endif

                                                    <label>Street</label>
                                                    <input id="street" type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" name="street" required>

                                                    @if ($errors->has('street'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('street') }}</strong>
                                                        </span>
                                                    @endif

                                                    <label>City</label>
                                                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" required>

                                                    @if ($errors->has('city'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('city') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <label>Latitude</label>
                                                    <input id="latitude" type="number"  min="-90" max="90" step="any" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" required>

                                                    @if ($errors->has('latitude'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('latitude') }}</strong>
                                                        </span>
                                                    @endif

                                                    <label>Longitude</label>
                                                    <input id="longitude" type="number" min="-180" max="180" step="any" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" required>

                                                    @if ($errors->has('longitude'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('longitude') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col">
                                                    {!! NoCaptcha::display() !!}
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-danger btn-block btn-round">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer register-footer text-center">
                <h6>&copy; <script>document.write(new Date().getFullYear())</script>, by Jimboy Team
            </div>
        </div>
    </div>
@endsection