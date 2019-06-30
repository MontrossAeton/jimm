<div class="modal fade" id="my-reservations-modal" tabindex="-1" role="dialog" aria-labelledby="my-reservations-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-reservations-modal-label">My Reservations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($my_reservations))
                    @if (count($my_reservations) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <tr>
                                        <th>
                                            Reservation Date
                                        </th>
                                        <th>
                                            Date Confirmed
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($my_reservations as $reservation)
                                        <tr>
                                            <td>
                                                {{ ($reservation->reserved_at) ? $reservation->reserved_at->toDayDateTimeString() : 'N/A'}}
                                            </td>
                                            <td>
                                                {{ ($reservation->confirmed_at) ? $reservation->confirmed_at->toDayDateTimeString() : 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $reservation->status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No reservations yet.
                    @endif
                @endif
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
