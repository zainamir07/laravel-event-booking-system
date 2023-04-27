@include('admin.layout.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       @include('admin.layout.sidebar')
       
       <!-- Content Wrapper -->
       <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
        <div id="content">
          @include('admin.layout.topbar')
           @yield('content')
           

        </div>
        
    <!-- Bootstrap core JavaScript--> 
    <script src="{{url('Backend/vendor/jquery/jquery.min.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> --}}
    <script src="{{url('Backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('Backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('Backend/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
    <script src="{{url('Backend/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('Backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{url('Backend/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script>
    <script src="{{url('Backend/js/jquery.imagesloader-1.0.1.js')}}"></script>


           @include('admin.layout.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @yield('script')
</body>

</html>