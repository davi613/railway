    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ $title }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset  ('back-end/vendors/simple-line-icons/css/simple-line-icons.css') }}">
        <link rel="stylesheet" href="{{ asset  ('back-end/vendors/flag-icon-css/css/flag-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset  ('back-end/vendors/css/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset  ('back-end/vendors/font-awesome/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset  ('back-end/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset  ('back-end/vendors/jvectormap/jquery-jvectormap.css') }}">
        <link rel="stylesheet" href="{{ asset  ('back-end/vendors/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset  ('back-end/vendors/chartist/chartist.min.css') }}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset ('back-end/css/vertical-light-layout/style.css') }}">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset ('back-end/images/favicon.png') }}" />
    </head>
    <body>
        <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
            @yield('navbar')
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @yield('sidebar')
            <!-- partial -->
            <div class="main-panel">
                @yield('content')
            <div class="content-wrapper">
                
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 Stellar. All rights reserved. <a href="#"> Terms of use</a><a href="#">Privacy Policy</a></span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart text-danger"></i></span>
                </div>
            </footer>
            <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ asset ('back-end/vendors/js/vendor.bundle.base.js') }}"></script>
        
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ asset ('back-end/vendors/chart.js/chart.umd.js') }}"></script>
        <script src="{{ asset ('back-end/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
        <script src="{{ asset ('back-end/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset ('back-end/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset ('back-end/vendors/moment/moment.min.js') }}"></script>
        <script src="{{ asset ('back-end/vendors/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset ('back-end/vendors/chartist/chartist.min.js') }}"></script>
        <script src="{{ asset ('back-end/vendors/progressbar.js/progressbar.min.js') }}"></script>
        <script src="{{ asset ('back-end/js/jquery.cookie.js') }}"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset ('back-end/js/off-canvas.js') }}"></script>
        <script src="{{ asset ('back-end/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset ('back-end/js/misc.js') }}"></script>
        <script src="{{ asset ('back-end/js/settings.js') }}"></script>
        <script src="{{ asset ('back-end/js/todolist.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ asset ('back-end/js/dashboard.js') }}"></script>
        
        <!-- End custom js for this page -->
    </body>
    </html>

  