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
