@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-user">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Services</h4>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('admin.services.create') }}">
                                <button class="btn btn-primary">
                                    <i class="nc-icon nc-simple-add"></i>
                                    &nbsp;&nbsp;Add
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($services) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <td>
                                                @if($service->image)
                                                    <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid" height="75" width="75">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $service->name }}
                                            </td>
                                            <td>
                                                {{ str_limit($service->description, 40) }}
                                            </td>
                                            <td>
                                                {{ $service->status ? "Available" : "Unavailable" }}
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('admin.services.edit', ['service' => $service]) }}">
                                                    <button class="btn btn-outline-info">
                                                        <i class="nc-icon nc-ruler-pencil"></i>
                                                        &nbsp;&nbsp;Edit
                                                    </button>
                                                </a>
                                                <button data-toggle="modal" data-target="#delete_service{{ $service->id }}" class="btn btn-outline-danger">
                                                    <i class="nc-icon nc-simple-remove"></i>
                                                    &nbsp;&nbsp;Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="delete_service{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenteredLabel">Delete Service?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete service about "{{ $service->name }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.services.destroy', ['service' => $service]) }}" method="POST">
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
                        No services yet.
                    @endif
                </div>
            </div> 
        </div>
    </div>
@endsection
