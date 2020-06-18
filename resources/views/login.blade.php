<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ConvenioSoft - Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/toaster/toastr.min.css') }}">

    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('images/taxi.svg') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-center mb-5">ConvenioSoft</h3>
                <div class="text-center" id="spinner" style="display:none; margin-top:-50px;" >
                    <div class="spinner-grow text-secondary" style="width: 3rem; height: 3rem;"  role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <form method="POST" name="form-login" id="form-login" action="{{ route('login') }}">
                  <div class="form-group">
                    <label>R.U.T. *</label>
                    <input type="text" name="rut" value="{{ old('rut') }}" class="form-control p_input" id="rut">
                  </div>
                  <div class="form-group">
                    <label>Clave *</label>
                    <input type="password" name="password" class="form-control p_input" id="password">
                  </div>
                  <div class="text-center">
                    <button class="btn btn-secondary btn-block enter-btn" id="login_disabled" style="display: none;" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Envinado...
                    </button>
                    <button type="submit" class="btn btn-secondary btn-block enter-btn" id="login"> Login</button>
                    {{-- <button type="submit" class="btn btn-secondary btn-block enter-btn">Login</button> --}}
                  </div>
                  <p class="sign-up">Todos los derechos reservados
                    <br>
                    <a href="#myModal" role="button" class="btnnew" data-toggle="modal">
                        Ayuda ConvenioSoft
                    </a>
                </p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- Modal -->
			  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
                        <h4 class="modal-title text-left">ConvenioSoft</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        </div>
			        <div class="modal-body text-left">
                      Si tiene algún problema técnico con el sistema, contacte con el programador
                      al (+58) 4149585692 o al email: (josegregoriolozadae@gmail.com) para brindarle
                      soporte de manera inmediata.

			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
			        </div>
			      </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			  </div><!-- /.modal -->
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('vendors/toaster/toastr.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>

    <script>
        $("#form-login").submit(function( event ) {
            event.preventDefault();
            var rut       = $("#rut").val();
            var password  = $("#password").val();
            if(rut=="" || password==""){
                toastr.error('Up! Error, los campos (R.U.T. - CLAVE) son obligarios. Intente nuevamente.', {timeOut: 5000});
                clear();
            }else{
                $("#spinner").fadeIn();
                $("#login_disabled").show();
                $("#login").hide();
                axios.post('{{ route('login')}}', {
                    rut:rut,
                    password:password
                }).then(response => {
                    if(response.data.success){
                        toastr.success('Inicio de Sesión Correctamente. Redireccionando...', {timeOut: 2000});
                        $("#login_disabled").hide();
                        $("#login").show();
                        $("#spinner").fadeOut();
                        setTimeout(function () {location.href = '{{ route('company.index') }}'}, 2000);
                        clear();
                    }else if(response.data.error=="invalid"){
                        toastr.error('Up! Error, en las credenciales ingresadas.', {timeOut: 5000});
                        $("#login_disabled").hide();
                        $("#login").show();
                        $("#spinner").fadeOut();
                        clear();
                    }else if(response.data.error=="user"){
                        toastr.error('Up! Error, usuario no existe.', {timeOut: 5000});
                        $("#login_disabled").hide();
                        $("#login").show();
                        $("#spinner").fadeOut();
                        clear();
                    }else{
                        toastr.error('Up! a ocurrido un error, intente nuevamente.', {timeOut: 5000});
                        $("#login_disabled").hide();
                        $("#login").show();
                        $("#spinner").fadeOut();
                        clear();
                    }
                }).catch(e => {
                    toastr.error('Up! Error '+e+'', {timeOut: 10000});
                    $("#login_disabled").hide();
                    $("#login").show();
                        $("#spinner").fadeOut();
                    clear();
                    console.log(e);
                });
            }

        });
        function clear() {
            $("#rut").val('');
            $("#password").val('');
        }

    </script>

    <!-- endinject -->
  </body>
</html>
