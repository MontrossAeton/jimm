@extends('layouts.pdf')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3><strong>Gym Companies</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($gyms) > 0)
                <table class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                City
                            </th>
                            <th>
                                Landline #
                            </th>
                            <th>
                                Mobile #
                            </th>
                            <th>
                                Website
                            </th>
                            <th>
                                Contact Person
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gyms as $gym)
                            <tr>
                                <td>
                                    {{ $gym->name }}
                                </td>
                                <td>
                                    {{ $gym->city }}
                                </td>
                                <td>
                                    {{ $gym->landline }}
                                </td>
                                <td>
                                    {{ $gym->mobile ? $gym->mobile : "" }}
                                </td>
                                <td>
                                    @if ($gym->website)
                                        <a href="{{ $gym->website }}">{{ $gym->website }}</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $gym->user->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No gym companies yet.
            @endif
        </div>
    </div>
@endsection
