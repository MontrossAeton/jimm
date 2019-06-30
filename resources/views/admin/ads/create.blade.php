@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                @if (auth()->user()->isAdmin())
                                    <h4 class="card-title">Create Ad</h4>
                                @else
                                    <h4 class="card-title">Request Ad</h4>
                                @endif
                            </div>
                            <div class="col text-right">
                                @if (auth()->user()->isAdmin())
                                    <button type="submit" class="btn btn-primary">Create</button>
                                @else
                                    <button type="submit" class="btn btn-primary">Request</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.ads.form')
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
