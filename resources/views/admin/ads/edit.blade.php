@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.ads.update', ['ad' => $ad]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">Edit ad</h4>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="nc-icon nc-check-2"></i>
                                    &nbsp;&nbsp;Save
                                </button>
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
