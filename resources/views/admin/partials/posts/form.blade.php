<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ isset($post) ? $post->title : old('title') }}" name="title" id="title">
    @if ($errors->has('title'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="title">Description</label>
    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ isset($post) ? $post->description : old('description') }}</textarea>
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
                class="upload-post-attachment"
                name="attachment"
                id="{{ isset($post) ? "upload_post_attachment_" . $post->id : "upload_post_attachment" }}"
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
    <div class="col post-attachment-container {{ isset($post) ? ($post->attachment ? "" : "d-none") : "d-none" }}" id="{{ isset($post) ? "post_attachment_container_" . $post->id : "post_attachment_container" }}">
        <div class="btn-group-vertical" role="group" aria-label="Basic example">
            <img
                src="{{ isset($post) ? ($post->attachment ? asset("storage/" . $post->attachment) : "") : "" }}"
                id="{{ isset($post) ? "post_attachment_" . $post->id : "post_attachment" }}"
                class="post-attachment img-fluid"
                >
            <button
                type="button"
                class="remove-post-attachment-admin btn btn-outline-danger"
                id="{{ isset($post) ? "remove_post_attachment_" . $post->id : "remove_post_attachment" }}"
                >
                Remove attachment
            </button>
        </div>
    </div>
</div>
