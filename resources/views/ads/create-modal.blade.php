<div class="modal fade" id="create-ad-modal" tabindex="-1" role="dialog" aria-labelledby="create-ad-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="action-type" value="create-ad-modal">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="create-ad-modal-label">Request for Ad Space</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('ads.form')
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
@if(count($errors))
    @if( old('action-type') === "create-ad-modal" )
        <script>
            window.gym_locator.errors =  {
                error_type: "modal",
                action_type: "{{ old('action-type') }}",
                modal_id: "create-ad-modal"
            }
        </script>
    @endif
@endif
