@extends('layouts.app')

@section('content')
    @auth
        @if(auth()->user()->isPostable())
            @include('posts.create-modal')
        @endif
    @endauth
    <div class="main">
        <div class="section section-buttons">
            <div class="container">
                <div class="tim-title">
                    <div class="row">
                        <div class="col">
                            <h2>Blogs</h2>
                        </div>
                        @auth
                            @if(auth()->user()->isPostable())
                                <div class="col-2 text-right pt-4">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#create-post">Create Post</button>
                                </div>
                            @else
                                <div class="col-2 text-right pt-4">
                                    <button class="btn btn-dark disabled-button">Upgrade to Premium to Post</button>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <hr>
                </div>
                <div class="row pt-4">
                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                @if ($post->attachment)
                                    <img class="card-img-top" style="height: 180px;" src="{{ asset('storage/' . $post->attachment) }}">
                                @else
                                    <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1692ffb097b%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1692ffb097b%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.6%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <small class="text-muted mb-4">by {{ $post->user->name }}</small>
                                    <p class="card-text mt-4 mb-4">{{str_limit($post->description, 50)}}</p>
                                    <a href="{{route('posts.show', ['id' => $post->id])}}" class="btn btn-primary post-navigate-btn">View Post</a>
                                    @if(auth()->check() && $post->user->id == auth()->user()->id)
                                        <button class="btn btn-primary post-navigate-btn" data-toggle="modal" data-target="#edit-post-{{$post->id}}">Edit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @foreach($posts as $post)
        @include('posts.edit-modal', ['post' => $post])
    @endforeach
    @if(count($errors))
        @if( old('action-type') === "edit-post" )
            <script>
                window.gym_locator.errors =  {
                    error_type: "modal",
                    action_type: "{{ old('action-type') }}",
                    modal_id: "edit-post-{{ session('post-id-error') }}"
                }
            </script>
        @endif
    @endif

@endsection

