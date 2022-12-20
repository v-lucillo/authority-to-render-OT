<!--
=========================================================
* Soft UI Dashboard - v1.0.5
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('soft-ui-dashboard-main/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('soft-ui-dashboard-main/assets/img/favicon.png')}}">
  <title>
    Autority to Render Overtime (ATROT)
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('soft-ui-dashboard-main/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('soft-ui-dashboard-main/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('soft-ui-dashboard-main/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('soft-ui-dashboard-main/assets/css/soft-ui-dashboard.css?v=1.0.5')}}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style type="text/css">
  .select2-container {
    width: 100% !important;
  }
</style>
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
        Autority to Render Overtime | ATROT
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
          
          <li class="nav-item">
            <a class="nav-link me-2" href="{{route('api.registration')}}">
              <i class="fas fa-user-circle opacity-6  me-1"></i>
              Sign Up
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="/">
              <i class="fas fa-key opacity-6  me-1"></i>
              Sign In
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content ">
    <section class="min-vh-85">
      <?php   $background = asset('soft-ui-dashboard-main/assets/img/curved-images/curved14.jpg') ?>
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{$background}}');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Registration!</h1>
              <p class="text-lead text-white">Use these awesome forms to create new account.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-9 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-body">
                <form role="form text-left" enctype="multipart/form-data" method="POST" action="{{route('api.sign_up')}}">
                  @csrf
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <input value="{{old('first_name')}}" name = "first_name" type="text" class="form-control" placeholder="First name" aria-describedby="email-addon">
                        @error('first_name')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <input value="{{old('last_name')}}" name = "last_name" type="text" class="form-control" placeholder="Last name" aria-describedby="email-addon">
                        @error('last_name')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      </div>
                    </div>
                  </div>


                
                  <div class="mb-3">
                    <input value="{{old('email')}}" name = "email" type="email" class="form-control" placeholder="Email"  aria-describedby="email-addon">
                    @error('email')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                  </div>
                  

                  <div class="mb-3">
                    <input value="{{old('phone')}}" name = "phone" type="text" class="form-control" placeholder="Phone number"  aria-describedby="email-addon">
                    @error('phone')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                  </div>
                  


                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <input value="{{old('password')}}" name = "password" type="password" class="form-control" placeholder="Password" aria-describedby="email-addon">
                        @error('password')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <input name = "password_confirmation" type="password" class="form-control" placeholder="Confirm password" aria-describedby="email-addon">
                      </div>
                    </div>
                  </div>



                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <input value="{{old('time_in')}}" name = "time_in" type="time" class="form-control" placeholder="Time in" aria-describedby="email-addon">
                        <small class="text-info font-weight-700">Time in (eg. 9:00 AM)</small>
                        @error('time_in')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <input name = "time_out" type="time" class="form-control" placeholder="Time out" aria-describedby="email-addon">
                        <small class="text-info font-weight-700">Time out (eg. 5:00 PM) </small>
                        @error('time_out')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <select name = "restday" class="form-select form-control">
                      <option value="">--Please choose a restday--</option>
                      <option value="Monday">Monday</option>
                      <option value="Tuesday">Tuesday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Thursday">Thursday</option>
                      <option value="Friday">Friday</option>
                      <option value="Saturday">Saturday</option>
                      <option value="Sunday">Sunday</option>
                    </select>
                    @error('restday')
                        <div class="text-muted font-italic">
                          <small class="text-warning font-weight-700">{{$message}} </small>
                        </div>
                    @enderror
                  </div>



                  <div class="mb-3">
                    <select name = "department"></select>
                    @error('department')
                        <div class="text-muted font-italic">
                          <small class="text-warning font-weight-700">{{$message}} </small>
                        </div>
                    @enderror
                  </div>

                  <div class="form-group mb-3 row">
                    <div class="col">
                      <div class="mb-3">
                        <input type="file" name = "signature" multiple class="form-control">
                        <small>if no e-signature, please make one here <a href="https://www.signwell.com/online-signature/" target = "_blank"> "Create signature"</a></small>
                      </div>
                        @error('signature')
                            <div class="text-muted font-italic">
                              <small class="text-warning font-weight-700">{{$message}} </small>
                            </div>
                        @enderror
                      <small class="form-hint">
                      </small>
                    </div>
                  </div>
                  <!-- <div class="form-check form-check-info text-left">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                      I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                    </label>
                  </div> -->
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                  </div>
                  <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{route('sign_in')}}" class="text-dark font-weight-bolder">Sign in</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
      <div class="container">
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Soft by Manila Broadcasting Company | Information Technology Department.
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  </main>
  <!--   Core JS Files   --><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script type="text/javascript">
    $("select[name='department']").select2({
      ajax: {
        url: "{{route('admin.get_department_lov')}}",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
          };
        },
        processResults: function (data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;

          return {
            results: data.results,
            pagination: {
              more: (params.page * 30) < data.total_count
            }
          };
        },
        cache: true
      },
      placeholder: 'Select department',
      templateResult: formatRepo,
      templateSelection: formatRepoSelection
    });

    function formatRepo (repo) {
      if (repo.loading) {
        return repo.text;
      }

      return repo.text;
    }

    function formatRepoSelection (repo) {
      return repo.text;
    }
  </script>
</body>

</html>