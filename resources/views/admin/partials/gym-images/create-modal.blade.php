<div class="modal fade" id="create-gym-images-modal" tabindex="-1" role="dialog" aria-labelledby="create-gym-images-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.gym-images.store') }}" id="gym-images-form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="action-type" value="create-gym-images-modal">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="create-gym-images-modal-label">Upload gym images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($gym_images_store_error)
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Uploading failed.</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <div class="progress mb-4 d-none" id="gym-images-progress-bar">
                                <div
                                    class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                    role="progressbar"
                                    aria-valuenow="0"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: 0%"
                                    >
                                    <strong>0%</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col h-100">
                            <label class="badge-pill btn btn-outline-primary btn-block cursor-pointer">
                                <i class="nc-icon nc-simple-add"></i>
                                &nbsp;&nbsp;Add Images
                                <input hidden accept="image/*" type="file" id="gym-images" name="images[]" multiple>
                            </label>
                        </div>
                    </div>
                    <div class="row d-none" id="gym-images-container">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="left-side">
                        <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="divider"></div>
                    <div class="right-side">
                        <button type="submit" class="btn btn-primary btn-link">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if($gym_images_store_error)
    <script>
        window.gym_locator.errors =  {
            error_type: "modal",
            action_type: "create-gym-images-modal",
            modal_id: "create-gym-images-modal"
        }
    </script>
@endif
