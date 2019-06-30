@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">Create User</h4>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.users.form')
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
