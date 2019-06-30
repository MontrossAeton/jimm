@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col text-right">
            <a href="{{ route('admin.users.create') }}">
                <button class="btn btn-primary">
                    <i class="nc-icon nc-simple-add"></i>
                    &nbsp;&nbsp;Add
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col" >
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Super Admin</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 500px !important; overflow: scroll; margin-bottom: 20px;">
                    @if (count($super_admins) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($super_admins as $user)
                                        <tr>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->trashed() ? "Deactivated" : "Active" }}
                                            </td>
                                            <td class="text-right">
                                                @if($user->id !== auth()->user()->id)
                                                    @if($user->trashed())
                                                        <button class="btn btn-outline-success user-restore">
                                                            Reactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.restore', ['user' => $user]) }}" class="user-restore-form" method="POST">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}">
                                                            <button class="btn btn-outline-info">
                                                                <i class="nc-icon nc-ruler-pencil"></i>
                                                                &nbsp;&nbsp;Edit
                                                            </button>
                                                        </a>
                                                        <button class="btn btn-outline-danger user-delete">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Deactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" class="user-delete-form" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No super admin yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card" >
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Gym Admins</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 500px !important; overflow: scroll; margin-bottom: 20px;">
                    @if (count($gym_admins) > 0)
                        <div class="table-responsive">
                            <table class="table" >
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gym_admins as $user)
                                        <tr>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->trashed() ? "Deactivated" : "Active" }}
                                            </td>
                                            <td class="text-right">
                                                @if($user->id !== auth()->user()->id)
                                                    @if($user->trashed())
                                                        <button class="btn btn-outline-success user-restore">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Reactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.restore', ['user' => $user]) }}" class="user-restore-form" method="POST">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}">
                                                            <button class="btn btn-outline-info">
                                                                <i class="nc-icon nc-ruler-pencil"></i>
                                                                &nbsp;&nbsp;Edit
                                                            </button>
                                                        </a>
                                                        <button class="btn btn-outline-danger user-delete">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Deactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" class="user-delete-form" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No gym admins yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card" >
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Customers</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 500px !important; overflow: scroll; margin-bottom: 20px;">
                    @if (count($customers) > 0)
                        <div class="table-responsive">
                            <table class="table" >
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $user)
                                        <tr>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->trashed() ? "Deactivated" : "Active" }}
                                            </td>
                                            <td class="text-right">
                                                @if($user->id !== auth()->user()->id)
                                                    @if($user->trashed())
                                                        <button class="btn btn-outline-success user-restore">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Reactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.restore', ['user' => $user]) }}" class="user-restore-form" method="POST">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}">
                                                            <button class="btn btn-outline-info">
                                                                <i class="nc-icon nc-ruler-pencil"></i>
                                                                &nbsp;&nbsp;Edit
                                                            </button>
                                                        </a>
                                                        <button class="btn btn-outline-danger user-delete">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Deactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" class="user-delete-form" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No customers yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" >
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Staffs</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 500px !important; overflow: scroll; margin-bottom: 20px;">
                    @if (count($staffs) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Email 
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staffs as $user)
                                        <tr>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->trashed() ? "Deactivated" : "Active" }}
                                            </td>
                                            <td class="text-right">
                                                @if($user->id !== auth()->user()->id)
                                                    @if($user->trashed())
                                                        <button class="btn btn-outline-success user-restore">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Reactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.restore', ['user' => $user]) }}" class="user-restore-form" method="POST">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}">
                                                            <button class="btn btn-outline-info">
                                                                <i class="nc-icon nc-ruler-pencil"></i>
                                                                &nbsp;&nbsp;Edit
                                                            </button>
                                                        </a>
                                                        <button class="btn btn-outline-danger user-delete">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Deactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" class="user-delete-form" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No staffs yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col" >
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Content Creators</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 500px !important; overflow: scroll; margin-bottom: 20px;">
                    @if (count($contents) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Email 
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contents as $user)
                                        <tr>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->trashed() ? "Deactivated" : "Active" }}
                                            </td>
                                            <td class="text-right">
                                                @if($user->id !== auth()->user()->id)
                                                    @if($user->trashed())
                                                        <button class="btn btn-outline-success user-restore">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Reactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.restore', ['user' => $user]) }}" class="user-restore-form" method="POST">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}">
                                                            <button class="btn btn-outline-info">
                                                                <i class="nc-icon nc-ruler-pencil"></i>
                                                                &nbsp;&nbsp;Edit
                                                            </button>
                                                        </a>
                                                        <button class="btn btn-outline-danger user-delete">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Deactivate
                                                        </button>
                                                        <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" class="user-delete-form" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No content creators yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
