@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Reservations</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($reservations) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            User
                                        </th>
                                        @if(auth()->user()->type === 0)
                                            <th>
                                                Gym name
                                            </th>
                                        @endif
                                        <th>
                                            Reservation Date
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        @if(auth()->user()->type === 1)
                                            <th colspan="2">
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <td>
                                                {{ $reservation->user->name }}
                                            </td>
                                            @if(auth()->user()->type === 0)
                                                <td>
                                                    {{ $reservation->gym->name }}
                                                </td>
                                            @endif
                                            <td>
                                                {{ ($reservation->reserved_at) ? $reservation->reserved_at->toDayDateTimeString() : 'N/A'}}
                                            </td>
                                            <td>
                                                {{ $reservation->status }}
                                            </td>
                                            @if(auth()->user()->type === 1)
                                                @unless ($reservation->confirmed_at)
                                                    <td class="d-flex justify-content-end">
                                                        <form action="{{ route('admin.reservations.approve', ["reservation" => $reservation]) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button class="btn btn-outline-info" type="submit">
                                                                <i class="nc-icon nc-ruler-pencil"></i>
                                                                &nbsp;&nbsp;Approve
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td class="d-flex justify-content-end">
                                                        <form action="{{ route('admin.reservations.reject', ["reservation" => $reservation]) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <button class="btn btn-outline-danger" type="submit">
                                                                <i class="nc-icon nc-simple-remove"></i>
                                                                &nbsp;&nbsp;Reject
                                                            </button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            @endif
                                        </tr>
                                        <div class="modal fade" id="delete_reservation{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenteredLabel">Delete Reservation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete reservation about "{{ $reservation->title }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.reservations.destroy', ['reservation' => $reservation]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No reservations yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
