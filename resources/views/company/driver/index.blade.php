@extends('template._app')
    @section('title','ConvenioSoft - Empresas')
    @section('content')
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card" >
                    <div class="card-body">
                        <h2 class="card-title text-center">Convenios Radio Taxi ABC</h2>
                        <div class="text-center" id="spinner">
                            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;"  role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div id="form_services"></div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            jQuery(document).ready(function($){
                servicios();
            });

            function servicios() {
                    axios.post('{{ route('company.services')}}', {
                    }).then(response => {
                        $("#spinner").fadeOut();
                        toastr.success('Bienvenido al ConvenioSoft', {timeOut: 3000});
                        $("#form_services").html(response.data);
                    }).catch(e => {
                        toastr.error('Up! Error cargando la informacion. '+e+'', {timeOut: 3000});
                        $("#spinner").fadeOut();
                        console.log(e);
                    });
            }
        </script>
    @endsection
