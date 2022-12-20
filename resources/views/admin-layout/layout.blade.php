<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin-layout.head')
</head>

<body class="g-sidenav-show  bg-gray-100">
  @include('admin-layout.aside')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('admin-layout.navbar')
    <div class="container-fluid py-4">
      @yield('content')
      @include('admin-layout.footer')
    </div>
  </main>
    @include('admin-layout.script')
    @yield('script')
</body>

</html>