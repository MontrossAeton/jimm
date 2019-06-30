<div class="form-group">
    <input type="hidden" name="gym_id" value={{auth()->user()->gym->id}}>
    <label for="title">Name</label>
    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ isset($service) ? $service->name : old('name') }}" name="name" id="title">
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="title">Description</label>
    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ isset($service) ? $service->description : old('description') }}</textarea>
    @if ($errors->has('description'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="title">Rate</label>
    <input type="text" class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" name="rate" value="{{ isset($service) ? $service->rate : old('rate') }}" name="rate" id="title">
    @if ($errors->has('rate'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('rate') }}</strong>
        </span>
    @endif
</div>
<div class="row pt-4">
    <div class="col">
        <label class="badge-pill btn btn-outline-primary cursor-pointer">
            @if (isset($service) && $service->image)
                Change image
            @else
                Add image
            @endif
            <input hidden accept="image/*" type="file" class="upload-service-attachment" name="image">
        </label>
    </div>
    @if ($errors->has('image'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('image') }}</strong>
        </span>
    @endif
</div>
<div class="row pt-4">
    <div class="col service-attachment-container{{ isset($service) ? ($service->image ? "" : " d-none") : ""}}">
        <div class="btn-group-vertical" role="group" aria-label="Basic example">
            <img src="{{ isset($service) ? ($service->image ? asset('storage/' . $service->image) : "") : ""}}" class="service-attachment img-fluid">
            <button type="button" class="remove-service-attachment btn btn-outline-danger">
                Remove image
            </button>
        </div>
    </div>
</div>
