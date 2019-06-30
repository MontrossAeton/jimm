<div class="form-group">
    <label for="title">Name</label>
    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ isset($user) ? $user->name : old('name') }}" name="name" id="name">
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="title">Email</label>
    <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ isset($user) ? $user->email : old('email') }}" name="email" id="email">
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>
@if (isset($user))
    @if (!($user->type === 1 || $user->type === 2))
        <div class="form-group">
            <label for="title">Role</label>
            <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                <option value="0" {{ "selected" ? $user->type === 0 : "" }}>Super Admin</option>
                <option value="3" {{ "selected" ? $user->type === 3 : "" }}>Staff</option>
                <option value="4" {{ "selected" ? $user->type === 4 : "" }}>Content Creator</option>

            </select>
            @if ($errors->has('type'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
            @endif
        </div>
    @endif
@endif
@if (!isset($user))
    <div class="form-group">
        <label for="title">Role</label>
        <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
            <option value="0">Super Admin</option>
            <option value="3">Staff</option>
            <option value="4">Content Creator</option>

        </select>
        @if ($errors->has('type'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Password</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>
@endif
