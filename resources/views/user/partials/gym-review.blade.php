<div class="card text-left">
    <div class="card-header">
        {{ $review->user->name }}
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
