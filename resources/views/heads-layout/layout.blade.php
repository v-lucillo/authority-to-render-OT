<!DOCTYPE html>
<html lang="en">

<head>
  @include('heads-layout.head')
</head>

<body class="g-sidenav-show  bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('heads-layout.navbar')
    <div class="container-fluid py-4">
      @yield('content')
      @include('heads-layout.footer')
    </div>
  </main>
    @include('heads-layout.script')
    @yield('script')
</body>

</html>