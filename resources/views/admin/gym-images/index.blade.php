@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Gym Images</h4>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#create-gym-images-modal">
                                <i class="nc-icon nc-simple-add"></i>
                                &nbsp;&nbsp;Add Images
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($gym_images) > 0)
                        <div class="row">
                            @foreach($gym_images as $image)
                                <div class="col-3">
                                    <a href="#" data-toggle="modal" data-target="#gym-image-modal-{{ $image->id }}">
                                        <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $image->path) }}">
                                    </a>
                                </div>
                                @include('admin.partials.gym-images.gym-image-modal')
                            @endforeach
                        </div>
                    @else
                        No gym images yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.gym-images.create-modal')
@endsection
