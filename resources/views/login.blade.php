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
                <form>
                  <div class="form-group">
                    <label>R.U.C. *</label>
                    <input type="text" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Clave *</label>
                    <input type="text" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-secondary btn-block enter-btn">Login</button>
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
                      al (+56) 979008228 o al email: (compuservicergua@hotmail.com) para brindarle
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
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
  </body>
</html>