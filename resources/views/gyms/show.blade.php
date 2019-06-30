@extends('layouts.app')

@section('content')
<div class="main">
    <div class="section section-buttons">
        <div class="gym-header">
            @if ($gym->logo)
                <img class="avatar border-gray" id="logo" src="{{asset('storage/' . $gym->logo)}}" alt="..." width="75" height="75">
            @endif
            <h3>{{$gym->name}}</h3>
        </div>
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#services" role="tab">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#gym-images" role="tab">Gym Images</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#blogs" role="tab">Blogs</a>
                    </li>
                    @if (auth()->check() && auth()->user()->isPremium())
                        @if (auth()->user()->type === 2)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Actions</a>
                                <ul class="dropdown-menu">
                                    <a data-toggle="modal" data-target="#create-reservation-modal" class="dropdown-item" href="#">Book a reservation</a>
                                </ul>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
        <!-- Tab panes -->
        <div class="tab-content text-center">
            <div class="tab-pane active" id="profile" role="tabpanel">
                <div class="row pt-4">
                    <div class="col"><h1 class="text-dark"><b>Profile</b></h1></div>
                </div>
                <div class="row pt-4">
                    <div class="col"><h3><b>Branch:</b></h3><br> {{$gym->branch}}</div>
                    <div class="col"><h3><b>Street:</b></h3><br> {{$gym->street}}</div>
                    <div class="col"><h3><b>City:</b></h3><br> {{$gym->city}}</div>
                </div>
                <div class="row pt-4">
                    <div class="col"><h3><b>Landline:</b></h3> {{$gym->landline}}</div>
                    <div class="col"><h3><b>Mobile:</b></h3> {{$gym->mobile}}</div>
                    <div class="col">
                        <h3><b>Operating Hours</b></h3>
                        {{ $gym->operating_hours }}
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col"><h3><b>Website:</b></h3> <a href="{{$gym->website}}">{{$gym->website}}</a></div>
                </div>
            </div>
            <div class="tab-pane" id="reviews" role="tabpanel">
                <div class="container">
                    <div class="row pt-4">
                        <div class="col">
                            @if ($gym_rating)
                                @include('user.partials.gym-rating')
                            @else
                                <div class="card">
                                    <div class="card-header">
                                        Gym Rating
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h4 class="card-title">
                                                    <strong>No ratings yet.</strong>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if (auth()->check())
                            @if (auth()->user()->type !== 1)
                                <div class="col-8">
                                    @if ($user_can_review)
                                        @include('user.partials.review-form')
                                    @elseif ($user_has_review)
                                        <div class="card">
                                            <div class="card-header text-left">
                                                <div class="row">
                                                    <div class="col">
                                                        Your gym review
                                                    </div>
                                                    <div class="col text-right">
                                                        <span class="fa fa-pencil cursor-pointer text-primary" id="my-review-edit"></span>
                                                        <span class="fa fa-trash cursor-pointer text-danger" id="my-review-delete"></span>
                                                        <form action="{{ route('reviews.destroy', ['gym' => $gym, 'review' => $my_review]) }}" id="my-review-delete-form" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div id="my-review">
                                                    <div class="row text-left">
                                                        <div class="col">
                                                            <span class="star-rating">
                                                                <span class="fa fa-star-o" data-rating="1"></span>
                                                                <span class="fa fa-star-o" data-rating="2"></span>
                                                                <span class="fa fa-star-o" data-rating="3"></span>
                                                                <span class="fa fa-star-o" data-rating="4"></span>
                                                                <span class="fa fa-star-o" data-rating="5"></span>
                                                                <input type="hidden" name="gym-rating" class="rating-value" value="{{ $my_review->rating }}">
                                                            </span>
                                                            <small class="text-muted">
                                                                {{ $my_review->updated_at->toFormattedDateString() }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="row text-left">
                                                        <div class="col">
                                                            <p class="card-text">
                                                                {{ $my_review->description }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="my-review-editing" class="d-none">
                                                    <form action="{{ route('reviews.update', ['gym' => $gym, 'review' => $my_review]) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row pt-4 d-flex align-items-center">
                                                            <div class="col-3">
                                                                <span class="star-rating editable">
                                                                    <span class="fa fa-star-o" data-rating="1"></span>
                                                                    <span class="fa fa-star-o" data-rating="2"></span>
                                                                    <span class="fa fa-star-o" data-rating="3"></span>
                                                                    <span class="fa fa-star-o" data-rating="4"></span>
                                                                    <span class="fa fa-star-o" data-rating="5"></span>
                                                                    <input type="hidden" name="rating" class="rating-value" value="{{ $my_review->rating }}">
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <textarea placeholder="Tell others what do you think about our gym." class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="1" name="description" required>{{ old('description') ? old('description') : $my_review->description }}</textarea>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('description') }}</strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row pt-4">
                                                            <div class="col">
                                                                <button type="submit" class="btn btn-info mt-2">Save</button>
                                                            </div>
                                                            <div class="col">
                                                                <button type="button" class="btn btn-danger mt-2" id="cancel-my-review-editing">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @else
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-header">
                                        Rate us!
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <p>You must be <a href="/login">logged in</a> first before you can post a review.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row pt-4">
                        <div class="col">
                            <h6 class="text-left">{{ $reviews_count }} {{ $reviews_count === 1 ? "review" : "reviews" }}</h6>
                            <hr>
                            @foreach($reviews as $review)
                                @include('user.partials.gym-review')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="services" role="tabpanel">
                <div class="row pt-4">
                    <div class="col"><h1 class="text-dark"><b>Services</b></h1></div>
                </div>
                <div class="row pt-4">
                    <div class="col">
                        @if(count($gym->services) > 0)
                            <div class="row">
                                @foreach($gym->services as $service)
                                    <div class="col">
                                        @if($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid" height="200" width="200">
                                        @endif
                                        <h3><b>{{$service->name}}</b></h3> - {{$service->description}} <br><b>Rate:</b> {{$service->rate}}<br>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            No services yet
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="gym-images" role="tabpanel">
                <div class="container">
                    @if (count($gym_images) > 0)
                        <div class="row">
                            @foreach($gym_images as $image)
                                <div class="col-3">
                                    <a href="#" data-toggle="modal" data-target="#gym-image-modal-{{ $image->id }}">
                                        <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $image->path) }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body">
                                No gym images yet.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="tab-pane" id="blogs" role="tabpanel">
                <div class="container">
                    @if (count($gym->user->posts) > 0)
                        <div class="row">
                            @foreach($gym->user->posts as $post)
                                <div class="col-md-4">
                                    <div class="card" style="width: 18rem;">
                                        @if ($post->attachment)
                                            <img class="card-img-top" style="height: 180px;" src="{{ asset('storage/' . $post->attachment) }}">
                                        @else
                                            <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1692ffb097b%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1692ffb097b%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.6%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{$post->title}}</h5>
                                            <p class="card-text mb-4">{{str_limit($post->description, 50)}}</p>
                                            <a href="{{route('posts.show', ['id' => $post->id])}}" class="btn btn-primary post-navigate-btn">Check Description</a>
                                            @if(auth()->check() && $post->user->id == auth()->user()->id)
                                                <button class="btn btn-primary post-navigate-btn" data-toggle="modal" data-target="#edit-post-{{$post->id}}">Edit</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body">
                                No posts yet.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.partials.book-a-reservation-modal')
@foreach($gym_images as $image)
    @include('user.partials.gym-image-modal')
@endforeach
@endsection

