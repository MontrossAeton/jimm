@extends('layouts.pdf')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3><strong>Ratings and Reviews</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($gym_rating)
                <h4><strong>Gym Rating: {{ $gym_rating }}</strong></h4>
                <h5>5 stars: {{ $rate_5 ? $rate_5 : "0" }}%</h5>
                <h5>4 stars: {{ $rate_4 ? $rate_4 : "0" }}%</h5>
                <h5>3 stars: {{ $rate_3 ? $rate_3 : "0" }}%</h5>
                <h5>2 stars: {{ $rate_2 ? $rate_2 : "0" }}%</h5>
                <h5>1 stars: {{ $rate_1 ? $rate_1 : "0" }}%</h5>
            @else
                <h5>No rating yet.</h5>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            @if (count($reviews) > 0)
                <h5>{{ $reviews_count }} reviews</h5>
                <table class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>
                                User
                            </th>
                            <th>
                                Rating
                            </th>
                            <th>
                                Description
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td>
                                    {{ $review->user->name }}
                                </td>
                                <td>
                                    {{ $review->rating }}
                                </td>
                                <td>
                                    {{ $review->description }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No reviews yet.
            @endif
        </div>
    </div>
@endsection
