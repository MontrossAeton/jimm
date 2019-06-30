@extends('layouts.admin')

@section('content')
    @if(auth()->user()->type === 1)
        <div class="row pt-4 text-center">
            <div class="col">
                @if ($gym_rating)
                    @include('admin.partials.gym-rating')
                @else
                    <div class="card">
                        <div class="card-header">
                            {{ $gym->name }}
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
        </div>
    @endif
    <div class="row pt-4">
        <div class="col">
            <h6 class="text-left">{{ $reviews_count }} {{ $reviews_count === 1 ? "review" : "reviews" }}</h6>
            <hr>
            @foreach($reviews as $review)
                @include('admin.partials.gym-review')
            @endforeach
        </div>
    </div>
@endsection
