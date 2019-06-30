@extends('layouts.app')

@section('content')
    <div id="profile-content">
        <div class="section">
            <div class="container pt-4">
                <div class="owner">
                    <div class="name pt-4 pb-4">
                        @if ($user->profile_picture)
                            <img class="avatar border-gray" src="{{asset('storage/' . $user->profile_picture)}}" alt="...">
                        @else
                            <img class="avatar border-gray" src="{{asset('img/bg-profile-picture.png')}}" alt="...">
                        @endif
                        <h4 class="title">{{auth()->user()->name}}<br /></h4>
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto text-center">
                                <button
                                    class="btn block btn-danger btn-round"
                                    data-toggle="modal"
                                    data-target="#edit-user-modal"
                                    >
                                    <i class="fa fa-pencil"></i> Edit Profile
                                </button>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-12 ml-auto mr-auto text-center">
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
            </div>
        </div>
    </div>
    @if (!$user_is_premium && !$subscription_is_pending)
        @include('user.partials.create-subscription-modal')
    @endif
    @include('edit-profile-modal')
    @include('payment-instructions-modal')
@endsection
