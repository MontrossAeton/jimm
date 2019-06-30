<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->

        <script>
            window.gym_locator = {}
        </script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset("css/fontawesome/css/font-awesome.css") }}">

        <!-- Styles -->
        <link href="{{ asset('css/paper-kit.css') }}" rel="stylesheet">
        <link href="{{ asset('css/creative.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>

    <body id="page-top">
        @include('user.partials.navbar')

        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bold">Jimboy</h1>
                        <hr class="divider my-4">
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">Jimboy helps people find nearby quality gyms. We also help the management of different gyms through our organized and authorized system. Start using Jimboy now and find your nearest gym!</p>
                        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- About Section -->
        <section class="page-section bg-primary" id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">We've got what you need!</h2>
                        <hr class="divider light my-4">
                        <p class="text-light mb-4">JIMBOY is a mobile and web-enabled application that will serve as a platform for gyms and will be a one stop solution for gym information. The application enables the customers to locate the nearest gym within his/her vicinity by simply entering their preferred location. However, it will only be available in Metro Manila. The application will be offering free and premium features. Moreover, the system includes features like GPS, online registration, account verification, self-assessment, free pass reservation, blog posts, feedback, business profile and advertisements.</p>
                        <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">See Latest Blogs</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="page-section" id="services">
            <div class="container">
                <h2 class="text-center mt-0">The latest from our blog</h2>
                <hr class="divider my-4">
                <div class="row">
                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                @if ($post->attachment)
                                    <img class="card-img-top" style="height: 180px;" src="{{ asset('storage/' . $post->attachment) }}">
                                @else
                                    <img class="card-img-top" data-src="holder.js/100px180/" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1692ffb097b%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1692ffb097b%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.6%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <small class="text-muted mb-4">by {{ $post->user->name }}</small>
                                    <p class="card-text mt-4 mb-4">{{str_limit($post->description, 50)}}</p>
                                    <a href="{{route('posts.show', ['id' => $post->id])}}" class="btn btn-primary post-navigate-btn">View Post</a>
                                    @if(auth()->check() && $post->user->id == auth()->user()->id)
                                        <button class="btn btn-primary post-navigate-btn" data-toggle="modal" data-target="#edit-post-{{$post->id}}">Edit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                    <div class="col text-center">
                        <div class="jumbotron">
                            <h5>Nothing to see here.</h5>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        @if(count($ads) > 0)
            <section class="page-section bg-dark text-white">
                <div class="container text-center">
                    <h2 class="mb-4">Advertisements</h2>
                <hr class="divider my-4">
                    @foreach($ads as $ad)
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <div class="jumbotron d-flex align-items-center advertisements" style="cursor: pointer; width: {{ $ad->width }}px; height: {{ $ad->height }}px;" data-url="{{ $ad->url }}">
                                    <div class="row">
                                        @if ($ad->attachment)
                                            <div class="col" style="max-width: 100%; max-height: 100%">
                                                <img src="{{ asset("storage/" . $ad->attachment) }}" class="img-fluid" alt="" style="max-height: {{ $ad->height }}px;">
                                            </div>
                                        @endif
                                        @if($ad->title || $ad->description)
                                            <div class="col" style="max-width: 100%; max-height: 100%">
                                                <p class="text-dark"><b style="font-weight: bold;">{{ $ad->title }}</b></p>
                                                <p class="text-dark">{{ $ad->description }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if($message = session('message-success'))
            @include('alerts.flash-message-success')
        @endif
        @if($message = session('message-info'))
            @include('alerts.flash-message-info')
        @endif
        @if($message = session('message-danger'))
            @include('alerts.flash-message-danger')
        @endif
        @if(count($errors))
            @if( (old('action-type') === ("edit_user_details")) )
                <script>
                    window.gym_locator.errors =  {
                        error_type: "modal",
                        action_type: "{{ old('action-type') }}",
                        modal_id: "edit-user-modal"
                    }
                </script>
            @elseif( (old('action-type') === "edit_user_profile_picture") )
                <script>
                    window.gym_locator.errors =  {
                        error_type: "modal",
                        action_type: "{{ old('action-type') }}",
                        modal_id: "edit-user-modal"
                    }
                </script>
            @elseif( (old('action-type') === "edit_user_change_password") )
                <script>
                    window.gym_locator.errors =  {
                        error_type: "modal",
                        action_type: "{{ old('action-type') }}",
                        modal_id: "edit-user-modal"
                    }
                </script>
            @endif
        @endif
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery-easing.js')}}"></script>
        <script src="{{ asset('js/creative.js')}}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB65i1E8mirdYerNBvxpG3j49_DAbPK8KI&callback=initMap">
        </script>
    </body>
</html>
