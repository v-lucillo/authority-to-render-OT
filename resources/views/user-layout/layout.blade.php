<!DOCTYPE html>
<html lang="en">

<head>
  @include('user-layout.head')
</head>

<body class="g-sidenav-show  bg-gray-100">
  @include('user-layout.aside')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('user-layout.navbar')
    <div class="container-fluid py-4">
      @yield('content')
      @include('user-layout.footer')
    </div>
  </main>
    @include('user-layout.script')
    @yield('script')
</body>

</html>