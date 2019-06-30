@extends('layouts.app')

@section('content')
<div class="page-header section-dark" style="background-image: url('/img/antoine-barres.jpg')">
    <div class="filter"></div>
    <div class="content-center">
        <div class="container">
          <div class="title-brand">
            <h1 class="presentation-title">Jimboy</h1>
            <div class="fog-low">
              <img src="assets/img/fog-low.png" alt="">
            </div>
            <div class="fog-low right">
              <img src="assets/img/fog-low.png" alt="">
            </div>
          </div>

          <h2 class="presentation-subtitle text-center">Hanap gym</h2>
        </div>
    </div>
    <div class="moving-clouds" style="background-image: url('/img/clouds.png'); ">
    </div>
    <h6 class="category category-absolute">Designed and coded by
        <a href="https://www.creative-tim.com" target="_blank">
          <img src="{{asset('/img/creative-tim-white-slim2.png')}}" class="creative-tim-logo">
        </a>
    </h6>
</div>
@endsection
