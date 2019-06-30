<div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="edit-user-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-user-modal-label">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="edit-user-modal-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link{{ old('action-type') === ("edit_user_details") || (!old('action-type')) ? " active" : "" }}"
                           id="edit-user-details-tab"
                           data-toggle="tab"
                           href="#edit-user-details"
                           role="tab"
                           aria-controls="edit-user-details"
                           aria-selected="{{ old('action-type') === ("edit_user_details") || (!old('action-type')) ? "true" : "false" }}"
                           >
                           Edit Profile Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ old('action-type') === ("edit_user_profile_picture") ? " active" : "" }}"
                           id="edit-user-profile-picture-tab"
                           data-toggle="tab"
                           href="#edit-user-profile-picture"
                           role="tab"
                           aria-controls="edit-user-profile-picture"
                           aria-selected="{{ old('action-type') === ("edit_user_profile_picture") ? "true" : "false" }}"
                           >
                           Change Profile Picture
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ old('action-type') === ("edit_user_change_password") ? " active" : "" }}"
                           id="edit-user-change-password-tab"
                           data-toggle="tab"
                           href="#edit-user-change-password"
                           role="tab"
                           aria-controls="edit-user-change-password"
                           aria-selected="{{ old('action-type') === ("edit_user_change_password") ? "true" : "false" }}"
                           >
                           Change Password
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="edit-user-modal-tab-contents">
                    <div
                        class="tab-pane fade{{ (old('action-type') === ("edit_user_details")) || (!old('action-type')) ? " show active" : "" }}"
                        id="edit-user-details"
                        role="tabpanel"
                        aria-labelledby="edit-user-details-tab"
                        >
                        <form action={{ route('user.update') }} method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="action-type" value="edit_user_details">
                            <div class="container">
                                <div class="row pt-4">
                                    <div class="col">
                                        <h6><strong>Details</strong></h6>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="name">Name</label>
                                        <input
                                            type="text"
                                            value="<?php
                                                if (old('name') && (old('action-type') === ("edit_user_details"))) {
                                                    echo trim(old('name'));
                                                } else {
                                                    echo trim($user->name);
                                                }
                                            ?>"
                                            class="form-control{{ $errors->has('name') && (old('action-type') === ("edit_user_details")) ? ' is-invalid' : '' }}"
                                            name="name"
                                            required
                                            >
                                            @if ($errors->has('name') && (old('action-type') === ("edit_user_details")))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-row pt-4">
                                    <div class="col">
                                        <label for="email">Email Address</label>
                                        <input
                                            type="email"
                                            value="<?php
                                                if (old('email') && (old('action-type') === ("edit_user_details"))) {
                                                    echo trim(old('email'));
                                                } else {
                                                    echo trim($user->email);
                                                }
                                            ?>"
                                            class="form-control{{ $errors->has('email') && (old('action-type') === ("edit_user_details")) ? ' is-invalid' : '' }}"
                                            name="email"
                                            required
                                            >
                                            @if ($errors->has('email') && (old('action-type') === ("edit_user_details")))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div
                        class="tab-pane fade{{ (old('action-type') === "edit_user_profile_picture") ? " show active" : "" }}"
                        id="edit-user-profile-picture"
                        role="tabpanel"
                        aria-labelledby="edit-user-profile-picture-tab"
                        >
                        <form action={{ route('user.change-profile-picture') }} method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="action-type" value="edit_user_profile_picture">
                            <div class="container">
                                <div class="row pt-4 d-flex justify-content-center">
                                    <div class="col-3">
                                        @if($user->profile_picture)
                                            <img class="img-fluid rounded-circle img-thumbnail" id="replace-profile-picture" src="{{ asset("storage/" . $user->profile_picture) }}" alt="Card image cap">
                                        @else
                                            <img class="img-fluid rounded-circle img-thumbnail" id="replace-profile-picture" src="{{ asset('img/bg-profile-picture.png') }}" alt="Card image cap">
                                        @endif
                                    </div>
                                </div>
                                <div class="row pt-4 d-flex justify-content-center">
                                    <div class="col-8">
                                        <label class="badge-pill btn btn-outline-primary btn-block cursor-pointer">
                                            <i class="fas fa-images"></i>
                                            &nbsp;&nbsp;Select from gallery
                                            <input hidden accept="image/*" type="file" id="profile-picture-input" name="profile_picture" required>
                                        </label>
                                        @if ($errors->has('profile-picture') && (old('action-type') === "edit_user_profile_picture"))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('profile_picture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        @if($user->profile_picture)
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-profile-picture-modal">Delete Profile Picture</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div
                        class="tab-pane fade{{ (old('action-type') === "edit_user_change_password") ? " show active" : "" }}"
                        id="edit-user-change-password"
                        role="tabpanel"
                        aria-labelledby="edit-user-change-password-tab"
                        >
                        <form action={{ route('user.change-password') }} method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="action-type" value="edit_user_change_password">
                            <div class="container">
                                <div class="form-row pt-4">
                                    <div class="col">
                                        <label for="current_password">Current Password</label>
                                        <input
                                            type="password"
                                            class="form-control{{ $errors->has('current_password') && (old('action-type') === "edit_user_change_password") ? ' is-invalid' : '' }}"
                                            name="current_password"
                                            required
                                            >
                                            @if ($errors->has('current_password') && (old('action-type') === "edit_user_change_password"))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('current_password') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-row pt-4">
                                    <div class="col">
                                        <label for="password">New Password</label>
                                        <input
                                            type="password"
                                            class="form-control{{ $errors->has('password') && (old('action-type') === "edit_user_change_password") ? ' is-invalid' : '' }}"
                                            name="password"
                                            required
                                            >
                                            @if ($errors->has('password') && (old('action-type') === "edit_user_change_password"))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-row pt-4">
                                    <div class="col">
                                        <label for="password_confirmation">Confirm New Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('delete-profile-picture')