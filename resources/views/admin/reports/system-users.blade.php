@extends('layouts.pdf')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3><strong>System Users</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Super Admins</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($super_admins) > 0)
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
                        @foreach($super_admins as $user)
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
                        @endforeach
                    </tbody>
                </table>
            @else
                No super admins yet.
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Gym Admins</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($gym_admins) > 0)
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
                        @foreach($gym_admins as $user)
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
                        @endforeach
                    </tbody>
                </table>
            @else
                No gym admins yet.
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Staffs</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($staffs) > 0)
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
                        @foreach($staffs as $user)
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
                        @endforeach
                    </tbody>
                </table>
            @else
                No staffs yet.
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Content Creators</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($contents) > 0)
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
                        @foreach($contents as $user)
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
                        @endforeach
                    </tbody>
                </table>
            @else
                No content creators yet.
            @endif
        </div>
    </div>
@endsection
