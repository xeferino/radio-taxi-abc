<form class="forms-sample mt-5" name="form-proccess" id="form-proccess" method="POST">
    <input type="hidden" id="day" value="{{ date('Y-m-d') }}">
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
                          <input type="text" class="form-control" name="movil" id="movil">
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
                        <input type="text" class="form-control" name="paciente" id="paciente" readonly>
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
            <button type="submit" class="btn btn-md btn-primary btn-lg float-right" id="store"> Guardar</button>
          </div>
    </div>
</form>
<!-- Modal -->
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
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
  <!-- /.modal -->
<script>
    jQuery(document).ready(function($){
        $("#zulu").select2();
        getVale();
        var date = new Date().toLocaleDateString();
        let fecha = document.querySelector('#fecha');
            fecha.value = $('#day').val();

        $('#fecha').on('change', function() {
            $("#movil").focus();
        });

        $('#chofer').on('change', function() {
            $("#chofer_select").val(this.value);
                getPorcentaje($("#chofer").val());
        });

        $('#zulu').on('change', function() {
            if(this.value=="MUTUAL DE SEGURIDAD"){
                getPacientes();
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

        /* $("#form-proccess")keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                return false;
            }
        }); */

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
            var paciente    = $("#paciente").val();

        if(fecha=='' || movil=='' || chofer=='' || recorrido=='' || valor=='' || porcentaje=='' || zulu=='0'){
            toastr.error('Atención antes de ingresar un vale debe verificar que todos los campos esten llenos, por favor verifique!', {timeOut: 15000});
        }else{
            axios.post('{{ route('company.store')}}', {
                fecha:fecha,
                movil:movil,
                chofer:chofer,
                porcentaje:porcentaje,
                zulu:zulu,
                vale:vale,
                recorrido:recorrido,
                valor:valor,
                paciente:paciente
            }).then(response => {
                if(response.data.success){
                    toastr.success(''+response.data.msg+'', {timeOut: 10000});
                    clear();
                }else{
                    toastr.error('Up! Error verifique, no se ingresaron los datos correctamente', {timeOut: 10000});
                    clear();
                }
            }).catch(e => {
                toastr.error('Up! Error '+e+'', {timeOut: 10000});
                console.log(e);
            });
        }

        });

    });

    function getPacientes(){
        axios.post('{{ route('company.pacientes')}}', {
        }).then(response => {
            $("#modal_paciente").modal('show');
            $("#pacientes").html(response.data);
        }).catch(e => {
            toastr.error('Up! Error '+e+'', {timeOut: 10000});
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
        console.log(response);
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
        $("#paciente").val('');
    }

</script>
