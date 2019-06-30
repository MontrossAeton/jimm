<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ isset($ad) ? $ad->title : old('title') }}" name="title" id="title">
    @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="title">Size</label>
    <select type="text" class="form-control{{ $errors->has('size') ? ' is-invalid' : '' }}" value="{{ isset($ad) ? $ad->size : old('size') }}" name="size" id="size">
        <option value="">Select ad size</option>
        <option {{isset($ad) && $ad->size == "300x250" ? 'selected' : ''}} value="300x250">300x250</option>
        <option {{isset($ad) && $ad->size == "300x600" ? 'selected' : ''}} value="300x600">300x600</option>
        <option {{isset($ad) && $ad->size == "320x100" ? 'selected' : ''}} value="320x100">320x100</option>
        <option {{isset($ad) && $ad->size == "336x280" ? 'selected' : ''}} value="336x280">336x280</option>
        <option {{isset($ad) && $ad->size == "728x90" ? 'selected' : ''}} value="728x90">728x90</option>
    </select>
    @if ($errors->has('size'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('size') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="title">Duration</label>
    <select type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" value="{{ isset($ad) ? $ad->duration : old('duration') }}" name="duration" id="duration">
        <option value="">Select ad duration</option>
        <option {{isset($ad) && $ad->duration == "Week" ? 'selected' : ''}} value="Week">1 Week (₱897.12)</option>
        <option {{isset($ad) && $ad->duration == "Month" ? 'selected' : ''}} value="Month">1 Month (₱3,588.48)</option>
        <option {{isset($ad) && $ad->duration == "Year" ? 'selected' : ''}} value="Year">1 Year (₱43,061.76)</option>
    </select>
    @if ($errors->has('duration'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('duration') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="title">Url</label>
    <input type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" value="{{ isset($ad) ? $ad->url : old('url') }}" name="url" id="url">
    @if ($errors->has('url'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('url') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="title">Description</label>
    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ isset($ad) ? $ad->description : old('description') }}</textarea>
    @if ($errors->has('description'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
<div class="row pt-4">
    <div class="col">
        <label class="badge-pill btn btn-outline-primary cursor-pointer">
            Upload new image
            <input
                hidden
                accept="image/*"
                type="file"
                class="upload-ad-attachment"
                name="attachment"
                id="{{ isset($ad) ? "upload_ad_attachment_" . $ad->id : "upload_ad_attachment" }}"
                >
        </label>
    </div>
    @if ($errors->has('attachment'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('attachment') }}</strong>
        </span>
    @endif
</div>
<div class="row pt-4">
    <div class="col ad-attachment-container {{ isset($ad) ? ($ad->attachment ? "" : "d-none") : "d-none" }}" id="{{ isset($ad) ? "ad_attachment_container_" . $ad->id : "ad_attachment_container" }}">
        <div class="btn-group-vertical" role="group" aria-label="Basic example">
            <img
                src="{{ isset($ad) ? ($ad->attachment ? asset("storage/" . $ad->attachment) : "") : "" }}"
                id="{{ isset($ad) ? "ad_attachment_" . $ad->id : "ad_attachment" }}"
                class="ad-attachment img-fluid"
                >
            <button
                type="button"
                class="remove-ad-attachment btn btn-outline-danger"
                id="{{ isset($ad) ? "remove_ad_attachment_" . $ad->id : "remove_ad_attachment" }}"
                >
                Remove attachment
            </button>
        </div>
    </div>
</div>
