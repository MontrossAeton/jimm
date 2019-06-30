@extends('layouts.pdf')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3><strong>Customers</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Number of new customers per year</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead class="text-primary">
                    <tr>
                        <th>
                            Year
                        </th>
                        <th>
                            New users count
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users_per_year as $user_per_year)
                        <tr>
                            <td>
                                {{ $user_per_year->year }}
                            </td>
                            <td>
                                {{ $user_per_year->user_count }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Customers</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($customers) > 0)
                <table class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Account Creation Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $user)
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->trashed() ? "Deactivated" : "Active" }}
                                </td>
                                <td>
                                    {{ $user->created_at->toDayDateTimeString() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No customers yet.
            @endif
        </div>
    </div>
@endsection
