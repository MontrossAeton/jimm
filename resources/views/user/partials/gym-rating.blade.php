<div class="card">
    <div class="card-header">
        Gym Rating
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h2 class="card-title">
                    <strong><b>{{ $gym_rating }}</b></strong>
                </h2>
                <small><span class="fa fa-user"></span>{{ $reviews_count }} total</small>
            </div>
        </div>
        <div class="row d-flex align-items-center pb-4">
            <div class="col">
                <span class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="gym-rating" class="rating-value" value="{{ $gym_rating }}">
                </span>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-5">
                <span class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="gym-rating" class="rating-value" value="5">
                </span>
            </div>
            <div class="col">
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $rate_5 }}%" aria-valuenow="{{ $rate_5 }}" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-5">
                <span class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="gym-rating" class="rating-value" value="4">
                </span>
            </div>
            <div class="col">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $rate_4 }}%" aria-valuenow="{{ $rate_4 }}" aria-valuemin="0" aria-valuemax="100">
                    </div> 
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-5">
                <span class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="gym-rating" class="rating-value" value="3">
                </span>
            </div>
            <div class="col">
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $rate_3 }}%" aria-valuenow="{{ $rate_3 }}" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-5">
                <span class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="gym-rating" class="rating-value" value="2">
                </span>
            </div>
            <div class="col">
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $rate_2 }}%" aria-valuenow="{{ $rate_2 }}" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-5">
                <span class="star-rating">
                    <span class="fa fa-star-o" data-rating="1"></span>
                    <span class="fa fa-star-o" data-rating="2"></span>
                    <span class="fa fa-star-o" data-rating="3"></span>
                    <span class="fa fa-star-o" data-rating="4"></span>
                    <span class="fa fa-star-o" data-rating="5"></span>
                    <input type="hidden" name="gym-rating" class="rating-value" value="1">
                </span>
            </div>
            <div class="col">
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $rate_1 }}%" aria-valuenow="{{ $rate_1 }}" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
