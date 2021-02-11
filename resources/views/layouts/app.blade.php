<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">

  <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/icon_binawiyata.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    @yield('title') | {{ config('app.name', 'Laravel') }}
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/normalize.css') }}">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('assets/css/material-dashboard.min.css?v=2.1.0') }}" rel="stylesheet">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet">

  @yield('head')

</head>

<body class="">
  <div class="wrapper ">
    @include('layouts.sidebar')
	<div class="main-panel">
      <!-- Navbar -->
	  @include('layouts.navbar')
      <!-- End Navbar -->
      <div class="content">
        @yield('content')
      </div>
      @include('layouts.footer')
    </div>
  </div>
  @include('layouts.plugin')
  @include('layouts.script')
  @yield('script')
</body>

</html>
