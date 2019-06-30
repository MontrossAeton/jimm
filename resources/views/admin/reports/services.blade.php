@extends('layouts.pdf')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3><strong>Services</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($services) > 0)
                <table class="table table-striped">
                    <thead class="text-primary">
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
                            <th>
                                Rate
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>
                                    @if($service->image)
                                        <img src="{{ public_path() . '/storage/' . $service->image }}" class="img-fluid" height="75" width="75">
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
                                <td>
                                    {{ $service->rate }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No services yet.
            @endif
        </div>
    </div>
@endsection
