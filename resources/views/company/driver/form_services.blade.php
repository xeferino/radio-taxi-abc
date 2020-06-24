<form class="forms-sample mt-5" name="form-proccess" id="form-proccess" method="POST">
    <input type="hidden" id="day" value="{{ date('Y-m-d') }}">
    <input type="hidden" name="run" id="run">
    <input type="hidden" name="paciente"  id="paciente">
    <input type="hidden" name="nombre"  id="nombre">
    <div class="row" style="border: 2px solid #eee; padding:20px;">
        <div class="col-md-4">
          <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Fecha</label>
                        <div class="input-group">
                          <input type="date" class="form-control" name="fecha" id="fecha">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-calendar-blank"></i></span>
                          </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
        <div class="col-md-2">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Movil</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="movil" id="movil" readonly>
                          <div class="input-group-append">
                            <span class="input-group-text">#</span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Chofer (es)</label>
                    <select multiple class="form-control" name="chofer" id="chofer">

                    </select>
                </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Porcentaje (%)</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="porcentaje" id="porcentaje" readonly>
                          <div class="input-group-append">
                            <span class="input-group-text">%</span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

    </div>
    <div class="row mt-2" style="border: 2px solid #eee; padding:20px;">
        <div class="col-md-4">
          <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>ZULU</label>
                        <div class="input-group">
                            <select class="form-control" name="zulu" id="zulu" style="width: 100%;">
                                <option value="0">.::Seleccione::.</option>
                                @foreach($zulus as $info)
                                    <option value="{{ $info->zulu }}">{{ $info->zulu }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
          </div>
        </div>
        <div class="col-md-2">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>N° Vale</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="vale" id="vale" readonly>
                          <div class="input-group-append">
                            <span class="input-group-text">#</span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Recorrido</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="recorrido" id="recorrido">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-car"></i></span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Valor ($)</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="valor" id="valor">
                          <div class="input-group-append">
                            <span class="input-group-text">$</span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group" style="border: 2px solid #eee; padding:20px;">
                        <label>Paciente Seleccionado</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="paciente_select" id="paciente_select" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-account-card-details"></i></span>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group" style="border: 2px solid #eee; padding:20px;">
                        <label>Chofer Seleccionado</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="chofer_select" id="chofer_select" readonly>
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-car"></i></span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 mb-2">
            <button class="btn btn-primary btn-lg float-right" id="store_disabled" style="display: none;" type="button" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Envinado...
            </button>
            <button type="submit" class="btn btn-md btn-primary btn-lg float-right" id="store"> Guardar</button>
          </div>
    </div>
</form>
<div class="row  mt-2" style="border: 2px solid #eee; padding:20px;">
    <div class="col-md-12 col-sm-12">
        <div class="table-responsive-xl">
            <table class="table table-hover table-striped" style="background-color: #eee; color:#000; width:100%">
                <thead>
                    <tr class="thead-color">
                        <th> N° Vale </th>
                        <th> ZULU </th>
                        <th> Recorrido </th>
                        <th> % Chofer </th>
                        <th> % Movil </th>
                        <th> Total ZULU </th>
                    </tr>
                </thead>
                <tbody id="list_servicios">
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4 col-xl-4 col-sm-6 mb-2">
        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
            <div class="text-md-center text-xl-left">
                <h6 class="mb-1">% Chofer</h6>
                <p class="text-muted mb-0"></p>
            </div>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0" id="format_pc">0.00</h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-4 col-sm-6 mb-2">
        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
            <div class="text-md-center text-xl-left">
                <h6 class="mb-1">% Movil</h6>
                <p class="text-muted mb-0"></p>
            </div>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0" id="format_pm">0.00</h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-4 col-sm-6 mb-2">
        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
            <div class="text-md-center text-xl-left">
                <h6 class="mb-1">Total</h6>
                <p class="text-muted mb-0"></p>
            </div>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0" id="format_tz">0.00</h6>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0090e738;">
            <h4 class="modal-title text-left">ConvenioSoft</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #586973;">
            <div class="text-center" id="spinner_modal" style="margin-top:-10px; display:none;">
                <div class="spinner-grow text-secondary" style="width: 3rem; height: 3rem;"  role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="alert alert-info" role="alert">
                            <p>Escriba su R.U.T 15.400.400, tenga en cuenta los puntos.</p>
                        </div>
                        <div class="form-group">
                            <label>R.U.T.</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="rut" id="rut" placeholder="15.400.400" >
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="cliente()"><i class="mdi mdi-account-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="form_codigo" style="display: none;">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="alert alert-info" role="alert">
                            <p id="cliente"></p>
                        </div>
                        <div class="form-group">
                            <label>Código</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="codigo" id="codigo" placeholder="xxxxxx" >
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="codigo()">Validar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- Modal Pacientes-->
<div class="modal fade" id="modal_paciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0090e738;">
            <h4 class="modal-title text-left">ConvenioSoft</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #586973;">
            <div id="pacientes"><div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal Pacientes-->

<script>
    jQuery(document).ready(function($){
        $("#zulu").select2();
        getVale();
        getChofer();
        var date = new Date().toLocaleDateString();
        let fecha = document.querySelector('#fecha');
            fecha.value = $('#day').val();

        $('#fecha').on('change', function() {
            $("#movil").focus();
        });

        $('#chofer').on('change', function() {
            if($("#conectado").val().trim() != this.value.trim()){
                toastr.error('Atención no esta permitido cambiar de conductor, solo puede hacer registros del coductor logueado.', {timeOut: 15000});
                getChofer();
            }else{
                $("#chofer_select").val(this.value);
                getPorcentaje($("#chofer").val());
            }
        });

        $('#zulu').on('change', function() {
            if(this.value=="MUTUAL DE SEGURIDAD"){
                $("#spinner").fadeIn();
                getPacientes();
            }else{
                $("#paciente_select").val('');
            }
        });

        $('#movil').on('keyup', function() {
            getMovil($("#movil").val());
            $("#porcentaje").val('');
        });

        $("#form-proccess").keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                return false;
            }
        });

        $('#valor').on('input', function () {
            this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
        });

        /* $("#form-proccess")keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                return false;
            }
        }); */
        const servicios = [];

        $("#form-proccess").submit(function( event ) {
            event.preventDefault();
            var fecha       = $("#fecha").val();
            var movil       = $("#movil").val();
            var chofer      = $("#chofer_select").val();
            var porcentaje  = $("#porcentaje").val();
            var zulu        = $("#zulu").val();
            var vale        = $("#vale").val();
            var recorrido   = $("#recorrido").val();
            var valor       = $("#valor").val();
            var paciente_select    = $("#paciente_select").val();
            var paciente    = $("#paciente").val();
            var run         = $("#run").val();

        if(fecha=='' || movil=='' || chofer=='' || recorrido=='' || valor=='' || porcentaje=='' || zulu=='0'){
            toastr.error('Atención antes de ingresar un vale debe verificar que todos los campos esten llenos, por favor verifique!', {timeOut: 15000});
        }else if(zulu=="MUTUAL DE SEGURIDAD" && paciente_select==""){
            toastr.error('Up! Error verifique, a seleccionado mutual de seguridad y en este proceso debe agregar un paciente', {timeOut: 10000});
        }else{
            $("#spinner").fadeIn();
            $("#modal_cliente").modal('show');
            $("#rut").val('');
            $("#codigo").val('');
            $("#form_codigo").hide();
            cliente();
        }

        });
    });


    function cliente(){
        var rut = $("#rut").val();
        $("#spinner").fadeOut();
        if(rut!=""){
            $("#spinner_modal").fadeIn();
            axios.post('{{ route('company.cliente')}}', {
                rut:rut
            }).then(response => {
                if(response.data.success){
                    $("#cliente").val(response.data.cliente[0].nombres);
                    $("#cliente").html(function () {
                        var html = '';
                            html +='<p>Escriba su codigo de validacion, tenga en cuenta que debe ser validado por el cliente <b>('+response.data.cliente[0].rut+' '+response.data.cliente[0].nombres+')</b> para completar la operacion de registro del recorrido.</p>';
                        return html;
                    });
                    $("#form_codigo").fadeIn();
                    $("#spinner_modal").fadeOut();

                }else{
                    toastr.error('Up! Error buscando el R.U.T del cliente', {timeOut: 10000});
                    $("#spinner_modal").fadeOut();
                    $("#form_codigo").fadeOut();
                }
            }).catch(e => {
                toastr.error('Up! Error '+e+'', {timeOut: 10000});
                $("#spinner_modal").fadeOut();
                console.log(e);
            });
        }else{
            toastr.error('Recuerde que el campo el R.U.T es obligatorio', {timeOut: 10000});
        }
    }

    function codigo(){
        var rut             = $("#rut").val();
        var codigo          = $("#codigo").val();
        var nombre          = $("#cliente").val();

        var movil           = $("#movil").val();
        var chofer          = $("#chofer_select").val();
        var porcentaje      = $("#porcentaje").val();
        var zulu            = $("#zulu").val();
        var vale            = $("#vale").val();
        var recorrido       = $("#recorrido").val();
        var valor           = $("#valor").val();
        var paciente_select = $("#paciente_select").val();
        var paciente        = $("#paciente").val();
        var run             = $("#run").val();

        $("#spinner").fadeOut();
        if(codigo!=""){
            $("#spinner_modal").fadeIn();
            axios.post('{{ route('company.codigo')}}', {
                codigo:codigo,
                rut:rut,
            }).then(response => {
                if(response.data.success){
                        toastr.success('Codigo validado exitosamente, guardando la informacion del recorrido', {timeOut: 5000});
                        $("#store_disabled").show();
                        $("#store").hide();
                        $("#spinner").fadeIn();
                        $("#spinner_modal").fadeOut();
                        $("#modal_cliente").modal('hide');
                        axios.post('{{ route('company.store')}}', {
                            movil:movil,
                            chofer:chofer,
                            porcentaje:porcentaje,
                            zulu:zulu,
                            vale:vale,
                            recorrido:recorrido,
                            valor:valor,
                            paciente:paciente,
                            run:run,
                            rut:rut,
                            nombre: nombre,
                            codigo: codigo
                        }).then(response => {
                            if(response.data.success){
                                toastr.success(''+response.data.msg+'', {timeOut: 10000});
                                $("#store_disabled").hide();
                                $("#store").show();
                                $("#spinner").fadeOut();

                                var porc_chofer =   0;
                                var porc_movil  =   0;
                                var total_zulu  =   0;

                                $.each(response.data.servicios, function(i,item){

                                    porc_chofer+=item.pchofer;
                                    porc_movil+=item.pmovil;
                                    total_zulu+=item.total;
                                });

                                var  format_pc = new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(porc_chofer);
                                var  format_pm = new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(porc_movil);
                                var  format_tz = new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(total_zulu);
                                $("#format_pc").html(''+format_pc+'');
                                $("#format_pm").html(''+format_pm+'');
                                $("#format_tz").html(''+format_tz+'');


                                $('#list_servicios').html(function(){
                                    html = '';
                                    $.each(response.data.servicios, function(i,item){
                                        var  ft_pc = new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(item.pchofer);
                                        var  ft_pm = new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(item.pmovil);
                                        var  ft_tz = new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(item.total);
                                        html += '<tr>';
                                            html += '<td>'+item.vale+'</td>';
                                            html += '<td>'+item.zulu+'</td>';
                                            html += '<td>'+item.recorrido+'</td>';
                                            html += '<td>'+ft_pc+'</td>';
                                            html += '<td>'+ft_pm+'</td>';
                                            html += '<td>'+ft_tz+'</td>';
                                        html += '</tr>';
                                    });
                                    return html;
                                });
                                clear();
                                getChofer();
                            }else{
                                toastr.error('Up! Error, no se ingresaron los datos correctamente. Intente nuevamente', {timeOut: 10000});
                                $("#store_disabled").hide();
                                $("#store").show();
                                $("#spinner").fadeOut();
                                clear();
                                getChofer();
                            }
                        }).catch(e => {
                            toastr.error('Up! Error '+e+'', {timeOut: 10000});
                            $("#store_disabled").hide();
                            $("#store").show();
                            $("#spinner").fadeOut();
                            clear();
                            getChofer();

                            console.log(e);
                        });
                }else{
                    toastr.error('Up! Error buscando el codigo de validacion del cliente', {timeOut: 10000});
                    $("#spinner_modal").fadeOut();
                }

            }).catch(e => {
                    toastr.error('Up! Error '+e+'', {timeOut: 10000});
                    $("#spinner_modal").fadeOut();
                    console.log(e);
            });
        }else{
            toastr.error('Recuerde que el campo el codigo es obligatorio', {timeOut: 10000});
            $("#spinner_modal").fadeOut();
        }
    }

    function getPacientes(){
        axios.post('{{ route('company.pacientes')}}', {
        }).then(response => {
            $("#modal_paciente").modal('show');
            $("#pacientes").html(response.data);
            $("#spinner").fadeOut();
        }).catch(e => {
            toastr.error('Up! Error '+e+'', {timeOut: 10000});
            $("#spinner").fadeOut();
            console.log(e);
        });
    }

    function getMovil(id) {
        if ($("#movil").val()!="") {
            axios.post('{{ route('company.movil')}}', {
                id:id
            }).then(response => {
                if(response.data.success){
                    $('#chofer').html(function(){
                        html = '';
                        if(response.data.choferes){
                            $.each(response.data.choferes, function(i,item){
                                if(item.chofer1!="null"){
                                    html += '<option value="'+item.chofer1+'">'+item.chofer1+'</option>';
                                }
                                if(item.chofer2!="null"){
                                    html += '<option value="'+item.chofer2+'">'+item.chofer2+'</option>';
                                }
                                if(item.chofer3!="null"){
                                    html += '<option value="'+item.chofer3+'">'+item.chofer3+'</option>';
                                }
                            });
                        }
                        return html;
                    });
                }else{
                    toastr.error('El movil ingresado no existe!', {timeOut: 10000});
                    $('#chofer').html('');
                    $("#chofer_select").val('');
                }
            }).catch(e => {
                toastr.error('Up! Error '+e+'', {timeOut: 10000});
                console.log(e);
            });
        }else{
            $('#chofer').html('');
            $("#chofer_select").val('');
        }
    }

    function getChofer() {
        $("#conectado_car").text('cargando...');
        $("#conectado_rut").text('cargando...');
        $("#conectado_porc").text('cargando...');
        axios.post('{{ route('company.chofer')}}', {
        }).then(response => {
            if(response.data.success){
                $("#movil").val(response.data.chofer);
                $("#conectado_car").text(response.data.chofer);
                $("#conectado_rut").text({{ Auth::user()->rut }});
                $("#conectado_porc").text({{ Auth::user()->porcentaje }});
                getPorcentaje(response.data.movil);
                $("#chofer_select").val(response.data.movil);
                getVale();
                $('#chofer').html(function(){
                        html = '';
                        if(response.data.conductores){
                            $.each(response.data.conductores, function(i,item){
                                var select1 = '';
                                var select2 = '';
                                var select3 = '';
                                if(item.chofer1.trim() == response.data.movil.trim()){
                                    select1="selected";
                                }else if(item.chofer2.trim() == response.data.movil.trim()){
                                    select2="selected";
                                }else if(item.chofer3.trim() == response.data.movil.trim()){
                                    select3="selected";
                                }
                                if(item.chofer1!="null"){
                                    html += '<option value="'+item.chofer1+'" '+select1+'>'+item.chofer1+'</option>';
                                }
                                if(item.chofer2!="null"){
                                    html += '<option value="'+item.chofer2+'" '+select2+'>'+item.chofer2+'</option>';
                                }
                                if(item.chofer3!="null"){
                                    html += '<option value="'+item.chofer3+'" '+select3+'>'+item.chofer3+'</option>';
                                }
                            });
                        }
                        return html;
                    });

            }else{
                toastr.error('Up! Error, cosultando los datos de chofer y el movil asociado; es posible que no tenga movil asignado', {timeOut: 10000});
            }
        }).catch(e => {
            toastr.error('Up! Error '+e+'', {timeOut: 10000});
            console.log(e);
        });
    }

    function getPorcentaje(chofer) {
        axios.post('{{ route('company.porcentaje')}}', {
            chofer:chofer
        }).then(response => {
            if(response.data.success){
                $("#porcentaje").val(response.data.porcentaje.porcentaje)
            }else{
                toastr.error('Up! Error buscando el porcentaje del chofer', {timeOut: 10000});
            }
        }).catch(e => {
            toastr.error('Up! Error '+e+'', {timeOut: 10000});
            console.log(e);
        });
    }

    function getVale() {
        axios.post('{{ route('company.vale')}}', {
        }).then(response => {
            if(response.data.success){
                $("#vale").val(response.data.vale)
            }else{
                toastr.error('Up! Error buscando el vale siguiente a ingresar', {timeOut: 10000});
            }
        }).catch(e => {
            toastr.error('Up! Error '+e+'', {timeOut: 10000});
            console.log(e);
        });
    }

    function clear(){
        fecha.value = $('#day').val();
        getVale();
        $("#movil").val('');
        $("#chofer_select").val('');
        $("#chofer").html('');
        $("#porcentaje").val('');
        $("#zulu").select2('val','0');
        $("#recorrido").val('');
        $("#valor").val('');
        $("#paciente_select").val('');
        $("#paciente").val('');
        $("#run").val('');
    }

</script>
