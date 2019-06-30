<div class="modal fade" id="create-post" tabindex="-1" role="dialog" aria-labelledby="create-post-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('posts.store' ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="action-type" value="create-post">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="create-post-label">Create Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('posts.form') 
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
    @if( old('action-type') === "create-post" )
        <script>
            window.gym_locator.errors =  {
                error_type: "modal",
                action_type: "{{ old('action-type') }}",
                modal_id: "create-post"
            }
        </script>
    @endif
@endif
