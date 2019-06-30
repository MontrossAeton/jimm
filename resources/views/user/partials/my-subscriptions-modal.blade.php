<div class="modal fade" id="my-subscriptions-modal" tabindex="-1" role="dialog" aria-labelledby="my-subscriptions-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-subscriptions-modal-label">My Subscriptions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($my_subscriptions))
                    @if (count($my_subscriptions) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <tr>
                                        <th>
                                            Date Added
                                        </th>
                                        <th>
                                            Expiration Date
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($my_subscriptions as $subscription)
                                        <tr>
                                            <td>
                                                {{ ($subscription->date_added) ? $subscription->date_added->toDayDateTimeString() : 'N/A'}}
                                            </td>
                                            <td>
                                                {{ ($subscription->date_expired) ? $subscription->date_expired->toDayDateTimeString() : 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $subscription->status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No subscriptions yet.
                    @endif
                @endif
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
