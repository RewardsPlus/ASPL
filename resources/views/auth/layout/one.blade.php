<!DOCTYPE html>
<html lang="en">
  <head>
  @include('auth.include.header')
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"> </div>
      <div class="dot"></div>
    </div>
    <!-- Loader ends-->
    @yield('content-area')
  @include('auth.include.foot')
  @include('sweetalert::alert')
  </body>
</html>    