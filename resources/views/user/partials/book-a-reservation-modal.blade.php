<div class="modal fade" id="create-reservation-modal" tabindex="-1" role="dialog" aria-labelledby="create-reservation-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('reservations.store', ["gym" => $gym]) }}" method="POST">
                @csrf
                <input type="hidden" name="action-type" value="create-reservation-modal">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="create-reservation-modal-label">Create reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="reserve_date">Reserve date:</label>
                            <div class='input-group date datetimepicker' id='datetimepicker'>
                                <input type='text' class="form-control datetimepicker" name="reserved_at" placeholder="{{ \Carbon\Carbon::now()->format('Y/m/d h:i:s A') }}" />
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-calendar"><i class="fa fa-calendar" aria-hidden="true"></i></span></button>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('reserved_at'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('reserved_at') }}</strong>
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
                        <button type="submit" class="btn btn-primary btn-link">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if(count($errors))
        @if( old('action-type') === "create-reservation-modal" )
            <script>
                window.gym_locator.errors =  {
                    error_type: "modal",
                    action_type: "{{ old('action-type') }}",
                    modal_id: "create-reservation-modal"
                }
            </script>
        @endif
    @endif
