<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <script>
      window.gym_locator = {}
  </script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link rel="stylesheet" href="/maps/documentation/javascript/cgc/demos.css">
  <link rel="stylesheet" href="{{asset("css/fontawesome/css/font-awesome.css") }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<style type="text/css">
    #map {
        height: 100vh;
        width: 100%;
      }
</style>

<body>
  <div class="">
    <div class="wrapper">
        @include('admin.partials.sidebar')

        @include('admin.partials.navbar')

        <div class="content">
            @yield('content')
        </div>
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
    </div>
  </div>
</body>

<!-- Scripts -->


<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/admin.js') }}" defer></script>
</html>
