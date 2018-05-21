<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ URL::to('/css/bootstrap.min.css') }}">
  <link rel="stylesheet" onload="if(media!=='all')media='all'" href="{{ URL::to('/css/fontawesome-all.css') }}">
  <link rel="stylesheet" href="{{ URL::to('/css/app.css') }}">
  @yield('styles')
</head>
<body>
  @include('partials.header')

  <div class="container">
    @yield('content')
  </div>

  <script src="{{ URL::to('/js/jquery-1.12.3.min.js') }}"></script>
  <script src="{{ URL::to('/js/bootstrap.min.js') }}"></script>
  @yield('scripts')
</body>
</html>
