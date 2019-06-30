@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Subscriptions</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($subscriptions) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            User
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Date Added
                                        </th>
                                        <th>
                                            Expiration
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th colspan="2">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscriptions as $subscription)
                                        <tr>
                                            <td>
                                                {{ $subscription->user->name }}
                                            </td>
                                            <td>
                                                {{ $subscription->type  === "monthly" ? "Monthly" : "" }}
                                                {{ $subscription->type  === "year_1" ? "1 Year" : "" }}
                                            </td>
                                            <td>
                                                {{ $subscription->price }}
                                            </td>
                                            <td>
                                                {{ ($subscription->date_added) ? $subscription->date_added->toDayDateTimeString() : 'N/A'}}
                                            </td>
                                            <td>
                                                {{ ($subscription->date_expired) ? $subscription->date_expired->toDayDateTimeString() : 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $subscription->status }}
                                            </td>
                                            @if ($subscription->status == "Pending")
                                            <td >
                                                <form action="{{ route('admin.subscriptions.approve', ["subscription" => $subscription]) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn btn-outline-info" type="submit">
                                                        <i class="nc-icon nc-ruler-pencil"></i>
                                                        &nbsp;&nbsp;Approve
                                                    </button>
                                                </form>
                                                <br>
                                                <form action="{{ route('admin.subscriptions.reject', ["subscription" => $subscription]) }}" method="POST">
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
                                            @endif 
                                        </tr>
                                        <div class="modal fade" id="delete_subscription{{ $subscription->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenteredLabel">Delete subscription</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete subscription about "{{ $subscription->title }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.subscriptions.destroy', ['subscription' => $subscription]) }}" method="POST">
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
                        No subscriptions yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
