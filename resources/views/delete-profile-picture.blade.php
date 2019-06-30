<div class="modal fade" id="delete-profile-picture-modal" tabindex="-1" role="dialog" aria-labelledby="delete-profile-picture-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('user.remove-profile-picture', ["user" => $user]) }}" method="POST">
                @method("DELETE")
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-profile-picture-modal-label">Delete Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to delete your profile picture?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>