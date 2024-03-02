<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>@yield('title','sky-news')</title>
 
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <!-- CSS Files -->

  <!-- Tinymce CDN -->
  <script src="https://cdn.tiny.cloud/1/xea37h8ryf0jvizl0xrodeakz4w5rymumc47e6xaq26qzocy/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>

  {{-- <link id="pagestyle" href="../assets/css/material-dashboard.css" rel="stylesheet" /> --}}
  <link rel="stylesheet" href="/assets/css/material-dashboard.css">
       <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  
</head>
<body>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-white" id="sidenav-main">
        <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand text-dark m-0" href="../pages/dashboard.html" target="_blank" >
            <img src="/assets/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-dark" id="navbar-logo">MORGANS</span>
        </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link text-dark {{ Request::is('/dashboard') ? 'active bg-gradient-primary' : '' }}" href="/dashboard">
                <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-dark {{ Request::is('contacts') ? 'active bg-gradient-primary' : '' }}" href="{{route('contacts.index')}}">
                <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                <i class='fa fa-user-circle-o material-icons'></i>
                </div>
                <span class="nav-link-text ms-1">contacts</span>
            </a>
            </li>
            <li class="nav-item">

            <a class="nav-link text-dark{{ Request::is('campaigns') ? 'active bg-gradient-primary' : '' }} " href="{{route('Campaigns.index')}}">
                <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                <i class='fa fa-send-o material-icons'></i>
                </div>
                <span class="nav-link-text ms-1">campaigns</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-dark {{ Request::is('news') ? 'active bg-gradient-primary' : '' }}" href="/newsletters">
                <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                <i class='fa fa-newspaper-o material-icons'></i>
                </div>
                <span class="nav-link-text ms-1">news papers</span>
            </a>
            </li>
            @auth
            @if(Auth::user()->role_id === 1)
                <li class="nav-item">
                    <a class="nav-link text-dark {{ Request::is('categories') ? 'active bg-gradient-primary' : '' }}" href="{{ route('categories.index') }}">
                        <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='fa fa-newspaper-o material-icons'></i>
                        </div>
                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                </li>
            @endif
        @endauth
        
            <li class="nav-item">
            <a class="nav-link text-dark {{ Request::is('profile') ? 'active bg-gradient-primary' : '' }}" href="../pages/profile.html">
                <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
                </div>
                <span class="nav-link-text ms-1">profile</span>
            </a>
            </li>
        </ul>
        </div>
    </aside>
      <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>

          <ul class="navbar-nav  justify-content-end">
            <li class="me-3">
              <div class="form-check form-switch ps-0 ms-auto my-auto nav-link text-body font-weight-bold px-0">
                <input class="form-check-input mt-1 ms-auto d-sm-inline d-none" type="checkbox" id="dark-version" onclick="darkMode(this)">
              </div>
            </li>
          @if(! \App\Utils\AuthenticationUtils::isAuthenticated())
            <li class="nav-item d-flex align-items-center me-3">
              <a href="{{url('login')}}" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
          @endif
          @if(\App\Utils\AuthenticationUtils::isAuthenticated())
              <li class="nav-item d-flex align-items-center me-3">
                  <a href="{{url('auth/logout')}}" class="nav-link text-body font-weight-bold px-0">
                      <i class="fa fa-user me-sm-1"></i>
                      <span class="d-sm-inline d-none">logout</span>
                  </a>
              </li>
          @endif
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

        @yield('content')

    </main>

    <!--   Core JS Files   -->
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->

    
    <script src="../assets/js/campaing.js"></script>
    <script src="/assets/js/material-dashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
          $(document).ready( function () {
              console.log('helo');
        $('#myTable').DataTable();
        } );
                $(document).ready(function() {
            // Initialize Select2
            $('.js-example-basic-multiple').select2();
        });

    </script>


    <script>
      const myModal = new bootstrap.Modal(document.getElementById('addModal'));
      const myGroupModal = new bootstrap.Modal(document.getElementById('addGroupModal'));
      const myContactModal = new bootstrap.Modal(document.getElementById('addContactModal'));
      var addGroupBtn = document.getElementById('test');
      var addContactBtn = document.getElementById('contact');
      function hideMain(){
        myModal.show();
          myModal.hide();
      }

      addGroupBtn.addEventListener('click', function(e) {
        hideMain();
          myGroupModal.show();
          myContactModal.show();
          myContactModal.hide();
          var modalBackdrop = document.getElementsByClassName('modal-backdrop')[0];
          modalBackdrop.parentNode.removeChild(modalBackdrop);
          });

      addContactBtn.addEventListener('click', function() {
        hideMain();
          myContactModal.show();
          var modalBackdrop = document.getElementsByClassName('modal-backdrop')[0];
          modalBackdrop.parentNode.removeChild(modalBackdrop);
          });

    </script>

    <script>
      
    </script>

  </body>
  </html>
