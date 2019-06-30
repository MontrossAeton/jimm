@extends('layouts.app')

@section('content')
<div class="main">
    <div class="section section-buttons">
        <div class="post-header">
            <h1>{{$post->title}}</h1>
            <p>by: {{ $post->user->name }}</p>
        </div>
        <div class="post-content">
            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        @if ($post->attachment)
                            <img class="mt-4" width="100%" height="100%" src="{{ asset('storage/' . $post->attachment) }}">
                        @endif
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col">
                        @auth
                            @if (auth()->id() === $post->user_id)
                                @if ($post->trashed())
                                    <form action="{{ route('posts.restore', ['post' => $post]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Restore Post</button>
                                    </form>
                                @else
                                    <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Archive Post</button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col">
                        <h3>{{$post->description}}</h3>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h6>{{ $comments->count() }} comments</h6>
                </div>
            </div>
            @foreach($comments as $comment)
                <div class="card">
                    <div class="card-header">
                        {{ $comment->user->name }}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{ $comment->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        @auth
            <div class="container post-comments pt-4">
                <form action="{{ route('comments.store', ["post" => $post]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <textarea placeholder="Write your comment here." class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="1" name="description" required>{{ old('description') }}</textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            <button type="submit" class="btn btn-info mt-2">Reply</button>
                        </div>
                    </div>
                </form>
            </div>
        @endauth
    </div>
</div>

@endsection

