@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Locations</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <form action="{{ route('admin.locations.index') }}" method="GET">
                                <select name="city" class="form-control" size="30" required>
                                    <option value="" {{ $city_selected ? "" : "selected" }}>---</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->city }}" {{ $city_selected === $city->city ? "selected" : "" }}>{{ $city->city }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit">
                                    <i class="nc-icon nc-zoom-split"></i>
                                    &nbsp;&nbsp;Search
                                </button>
                            </form>
                        </div>
                        <div class="col">
                            @if($city_selected)
                                <h3>City: {{ $city_selected }}</h3>
                            @endif
                            @if (count($gyms) > 0)
                                <h5>Gyms:</h5>
                                @foreach($gyms as $gym)
                                    <a href="{{ route("gyms.show", ['gym' => $gym]) }}"><p>{{ $gym->name }}</p></a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
