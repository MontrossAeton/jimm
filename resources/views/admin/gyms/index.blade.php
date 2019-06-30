@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Gyms</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($gyms) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Owner
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gyms as $gym)
                                        <tr>
                                            <td>
                                                {{ $gym->name }}
                                            </td>
                                            <td>
                                                {{ $gym->user->name }}
                                            </td>
                                            <td>
                                                {{ $gym->city }}
                                            </td>
                                            <td class="text-right">
                                                @if($gym->trashed())
                                                    <form action="{{ route('admin.gyms.restore', ['gym' => $gym]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Reactivate</button>
                                                    </form>
                                                @else
                                                    <button data-toggle="modal" data-target="#delete_post{{ $gym->id }}" class="btn btn-outline-danger">
                                                        <i class="nc-icon nc-simple-remove"></i>
                                                        &nbsp;&nbsp;Deactivate
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="delete_post{{ $gym->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenteredLabel">Deactivate gym?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to deactivate gym "{{ $gym->name }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.gyms.destroy', ['gym' => $gym]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Deactivate</button>
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
                        No gyms yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
