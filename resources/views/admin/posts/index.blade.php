@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Posts</h4>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('admin.posts.create') }}">
                                <button class="btn btn-primary">
                                    <i class="nc-icon nc-simple-add"></i>
                                    &nbsp;&nbsp;Add
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($posts) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        @if (auth()->user()->isAdmin())
                                            <th>
                                                User 
                                            </th>
                                        @endif
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>
                                                {{ $post->title }}
                                            </td>
                                            <td>
                                                {{ str_limit($post->description, 40) }}
                                            </td>
                                            @if (auth()->user()->isAdmin())
                                            <td>
                                                {{ $post->user->name }}  
                                            </td>
                                            @endif
                                            <td class="text-right">
                                                <a href="{{ route('admin.posts.edit', ['post' => $post]) }}">
                                                <button class="btn btn-outline-info">
                                                    <i class="nc-icon nc-ruler-pencil"></i>
                                                    &nbsp;&nbsp;Edit
                                                </button>
                                                </a>
                                                <button data-toggle="modal" data-target="#delete_post{{ $post->id }}" class="btn btn-outline-danger">
                                                    <i class="nc-icon nc-simple-remove"></i>
                                                    &nbsp;&nbsp;Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="delete_post{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenteredLabel">Delete Post?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete post about "{{ $post->title }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.posts.destroy', ['post' => $post]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No posts yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
