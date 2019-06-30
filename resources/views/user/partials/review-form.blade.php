<div class="card">
    <div class="card-header">
        Rate us!
    </div>
    <div class="card-body">
        <form action="{{ route('reviews.store', ['gym' => $gym]) }}" method="POST">
            @csrf
            <div class="row pt-4 d-flex align-items-center">
                <div class="col-3">
                    <span class="star-rating editable">
                        <span class="fa fa-star-o" data-rating="1"></span>
                        <span class="fa fa-star-o" data-rating="2"></span>
                        <span class="fa fa-star-o" data-rating="3"></span>
                        <span class="fa fa-star-o" data-rating="4"></span>
                        <span class="fa fa-star-o" data-rating="5"></span>
                        <input type="hidden" name="rating" class="rating-value" value="1">
                    </span>
                </div>
                <div class="col">
                    <textarea placeholder="Tell others what do you think about our gym." class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="1" name="description" required>{{ old('description') }}</textarea>
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col">
                    <button type="submit" class="btn btn-info mt-2">Submit review</button>
                </div>
            </div>
        </form>
    </div>
</div>
