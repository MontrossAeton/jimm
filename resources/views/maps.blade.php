@extends('layouts.app')

@section('content')
<div class="main">
    <div class="section section-buttons">
        <div class="map-content">
            <div class="map-list">
                <input type="text" class="form-control search-list-input" placeholder="Search Gym">
                <div class="map-list-container">
                </div>
            </div>
            <div id="map"></div>
        </div>
    </div>
</div>
@endsection

