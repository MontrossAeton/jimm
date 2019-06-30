<div class="modal fade" id="gym-image-modal-{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="gym-image-modal-{{ $image->id }}-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" name="action-type" value="gym-image-modal-{{ $image->id }}">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="gym-image-modal-{{ $image->id }}-label"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" src="{{ asset('storage/' . $image->path) }}">
            </div>
            <div class="modal-footer">
                <div class="left-side">
                </div>
                <div class="divider"></div>
                <div class="right-side">
                    <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
