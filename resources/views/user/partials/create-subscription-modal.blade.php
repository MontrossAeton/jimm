<div class="modal fade" id="create-subscription-modal" tabindex="-1" role="dialog" aria-labelledby="create-subscription-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('subscriptions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="action-type" value="create-subscription-modal">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="create-subscription-modal-label">Create subscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="type">Choose subscription type:</label>
                            <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                <option value="monthly">Monthly (₱ 160.00)</option>
                                <option value="year_1">1 Year (₱ 1920.00)</option>
                            </select>
                        </div>
                        @if ($errors->has('type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="left-side">
                        <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="divider"></div>
                    <div class="right-side">
                        <button type="submit" class="btn btn-primary btn-link">Request Subscription</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if(count($errors))
    @if( old('action-type') === "create-subscription-modal" )
        <script>
            window.gym_locator.errors =  {
                error_type: "modal",
                action_type: "{{ old('action-type') }}",
                modal_id: "create-subscription-modal"
            }
        </script>
    @endif
@endif
