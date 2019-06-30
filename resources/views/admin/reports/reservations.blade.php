@extends('layouts.pdf')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3><strong>Reservations</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($reservations) > 0)
                <table class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>
                                Customer
                            </th>
                            <th>
                                Reservation Date
                            </th>
                            <th>
                                Confirmed at
                            </th>
                            <th>
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>
                                    {{ $reservation->user->name }}
                                </td>
                                <td>
                                    {{ ($reservation->reserved_at) ? $reservation->reserved_at->toDayDateTimeString() : 'N/A'}}
                                </td>
                                <td>
                                    {{ ($reservation->confirmed_at) ? $reservation->confirmed_at->toDayDateTimeString() : 'N/A'}}
                                </td>
                                <td>
                                    {{ $reservation->status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No reservations yet.
            @endif
        </div>
    </div>
@endsection
