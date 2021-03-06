<!DOCTYPE html>
<html lang="en">
    @include('template._head')
    <body>
        {{-- <script>
            NProgress.configure({ showSpinner: false });
            NProgress.start();
        </script> --}}
        <div class="container-scroller">
            <!-- partial:partials/_sidebar.html -->
            @include('template._sisebar')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_navbar.html -->
                @include('template._navbar')
                <!-- partial -->

                <div class="main-panel">
                    <div class="content-wrapper">
                        <input type="hidden" name="conectado"  id="conectado" value="{{ Auth::user()->nombre }}">
                        @yield('content')
                    </div>
                    <!-- content-wrapper ends -->

                    <!-- partial:partials/_footer.html -->
                    {{-- @include('template._footer') --}}
                    <!-- partial -->
                </div>
            <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        @include('template._script_library')
        @yield('script')
    </body>
</html>

