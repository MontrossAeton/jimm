<div class="card text-left">
    <div class="card-header">
        <div class="row">
            <div class="col-10">
                @if(auth()->user()->type !== 1)
                    {{ $review->user->name }}'s rating to <a href="{{ route('gyms.show', ['gym' => $review->gym]) }}">{{ $review->gym->name }}</a>
                @else
                    {{ $review->user->name }}
                @endif
            </div>
            @if (auth()->user()->isAdmin())
                <div class="col text-right">
                    <span class="fa fa-trash cursor-pointer text-danger review-delete"></span>
                    <form action="{{ route('admin.feedbacks.destroy', ['review' => $review]) }}" class="review-delete-form" method="POST">
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <span class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="gym-rating" class="rating-value" value="{{ $review->rating }}">
                </span>
                <small class="text-muted">
                    {{ $review->updated_at->toFormattedDateString() }}
                </small>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-text">
                    {{ $review->description }}
                </p>
            </div>
        </div>
    </div>
</div>
