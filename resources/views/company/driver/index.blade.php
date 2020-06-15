@extends('template._app')
    @section('title','ConvenioSoft - Empresas')
    @section('content')
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card" >
                    <div class="card-body">
                        <h2 class="card-title text-center">Sistema Convenios Radio Taxi ABC</h2>
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
                        toastr.success('Bienvenido al ConvenioSoft', {timeOut: 3000});
                        $("#form_services").html(response.data);
                    }).catch(e => {
                        toastr.error('Up! Error '+e+'', {timeOut: 3000});
                        console.log(e);
                    });
            }
        </script>
    @endsection
