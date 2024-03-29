@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">Create Post</h4>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.posts.form')
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
