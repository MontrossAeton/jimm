@extends('layouts.pdf')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3><strong>Subscriptions</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($subscriptions) > 0)
                <table class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>
                                Customer
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Date Added
                            </th>
                            <th>
                                Expiration Date
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
                                    {{ $subscription->type }}
                                </td>
                                <td>
                                    {{ $subscription->status }}
                                </td>
                                <td>
                                    {{ ($subscription->date_added) ? $subscription->date_added->toDayDateTimeString() : 'N/A'}}
                                </td>
                                <td>
                                    {{ ($subscription->date_expired) ? $subscription->date_expired->toDayDateTimeString() : 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No subscriptions yet.
            @endif
        </div>
    </div>
@endsection
