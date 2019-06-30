@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <!-- insert banner here -->
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                            @if ($user->profile_picture)
                                <img class="avatar border-gray" src="{{asset('storage/' . $user->profile_picture)}}" alt="...">
                            @else
                                <img class="avatar border-gray" src="{{asset('img/bg-profile-picture.png')}}" alt="...">
                            @endif
                            <h5 class="title">{{$user->name}}</h5>
                        </a>
                        <p class="description">
                            {{$user->email}}
                        </p>
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto mb-4 text-center">
                                <button
                                    class="btn block btn-danger btn-round"
                                    data-toggle="modal"
                                    data-target="#edit-user-modal"
                                    >
                                    <i class="fa fa-pencil"></i> Edit Profile
                                </button>
                            </div>
                        </div>
                        @if ($user_is_premium)
                            <h6 class="description pb-2">Subscription Type: <b class="font-weight-bold text-success">PREMIUM</b></h6>
                        @else
                            <h6 class="description pb-2">Subscription Type: FREE</h6>
                            @if ($subscription_is_pending)
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-outline-primary btn-round disabled-button mb-4" disabled>Your subscription is pending</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button data-toggle="modal" data-target="#payment-instructions" class="btn btn-info btn-round">Payment Instructions</button>
                                    </div>
                                </div>
                            @else
                                <button data-toggle="modal" data-target="#create-subscription-modal" class="btn btn-success btn-round">Upgrade to Premium</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->isPremium())
            <div class="col-md-8">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Gym Profile</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.gyms.delete-gym-logo', ['gym' => $gym]) }}" method="POST" id="delete-gym-logo">
                            @method('DELETE')
                            @csrf
                        </form>
                        <form action="{{ route('admin.gyms.update', ['gym' => $gym]) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row text-center">
                                <div class="col">
                                    @if ($gym->logo)
                                        <img class="avatar border-gray" id="logo" src="{{asset('storage/' . $gym->logo)}}" alt="...">
                                    @else
                                        <img class="avatar border-gray" id="logo" src="{{asset('img/company-logo.png')}}" alt="...">
                                    @endif
                                    <div class="update ml-auto mr-auto">
                                        <div class="row text-center">
                                            <div class="col">
                                                <label class="btn btn-warning text-light btn-round cursor-pointer">
                                                    Change Logo
                                                    <input
                                                        hidden
                                                        accept="image/*"
                                                        type="file"
                                                        name="logo"
                                                        id="change-logo"
                                                        >
                                                </label>
                                            </div>
                                            @if ($gym->logo)
                                                <div class="col">
                                                    <div class="update ml-auto mr-auto">
                                                        <button type="button" class="btn btn-danger btn-round" id="remove-logo">Remove Logo</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('logo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Gym Name</label>
                                        <input name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="gym" value="{{ isset($gym) ? $gym->name : old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <input name="branch" type="text" class="form-control{{ $errors->has('branch') ? ' is-invalid' : '' }}" placeholder="Username" value="{{$gym->branch}}">
                                        @if ($errors->has('branch'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('branch') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input name="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="City" value={{$gym->city}}>
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Street</label>
                                        <input name="street" type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="Email" value={{$gym->street}}>
                                        @if ($errors->has('street'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('street') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Landline</label>
                                        <input name="landline" type="number" class="form-control{{ $errors->has('landline') ? ' is-invalid' : '' }}" placeholder="Last Name" value="{{$gym->landline}}">
                                        @if ($errors->has('landline'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('landline') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input name="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" placeholder="Last Name" value="{{$gym->mobile}}">
                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Operating Hours</label>
                                        <input name="operating_hours" type="text" class="form-control{{ $errors->has('operating_hours') ? ' is-invalid' : '' }}" placeholder="Operating Hours" value="{{$gym->operating_hours}}">
                                        @if ($errors->has('operating_hours'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('operating_hours') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input name="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" placeholder="Country" value="{{$gym->website}}">
                                        @if ($errors->has('website'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Latitude</label>
                                        <input name="lat" type="number" class="form-control{{ $errors->has('lat') ? ' is-invalid' : '' }}" placeholder="ZIP Code" value={{$gym->lat}}>
                                        @if ($errors->has('lat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Longitude</label>
                                        <input name="long" type="number" class="form-control{{ $errors->has('long') ? ' is-invalid' : '' }}" placeholder="ZIP Code" value={{$gym->long}}>
                                        @if ($errors->has('long'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('long') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        @endif
    </div>
    @include('admin.partials.create-premium-ads-subscription-modal')
    @include('edit-profile-modal')
    @include('payment-instructions-modal')
@endsection
