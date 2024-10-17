<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <meta name="description" content="{{ $konfigurasi->metadeskripsi ?? 'Default description' }}">
  <meta name="keywords" content="{{ $konfigurasi->metakeyword ?? 'Default keywords' }}">
  <link rel="icon" href="{{ $konfigurasi->favicon ?? 'default-favicon.png' }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') | {{ $konfigurasi->title ?? 'Nama Website Default' }}</title>
  

 @include('layouts.style')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('layouts.navbar')
      @include('layouts.sidebar')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>@yield('header')</h1>
        <div class="section-header-breadcrumb">
          @yield('breadcrumb')
        </div>
      </div>
      <div class="section-body">
        @yield('content')
      </div>
    </section>
  </div>
      <footer class="main-footer">
        <div class="footer-left">
        {{$konfigurasi->footer}}
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  @include('layouts.scripts')
  @stack('scripts')
  
</body>
</html>