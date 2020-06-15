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
                            <select class="form-control" id="zulu" style="width: 100%;">
                                <option value="">.::Seleccione::.</option>
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
                          <input type="text" class="form-control" name="vale" id="vale" value="{{ $vale }}" readonly>
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
          <div class="col-md-12 col-sm-12 mb-2">
            <button class="btn btn-md btn-primary float-right" id="form-guardar"> Guardar</button>
          </div>
          <div class="col-md-12">
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

    </div>
</form>
<div class="row  mt-2" style="border: 2px solid #eee; padding:20px;">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="form-group">
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
</div>
<script>
    jQuery(document).ready(function($){
        $("#zulu").select2();
        var date = new Date().toLocaleDateString();
        var fecha = document.querySelector('#fecha');
            fecha.value = $('#day').val();

        $('#fecha').on('change', function() {
            $("#movil").focus();
        });

        $('#chofer').on('change', function() {
            $("#chofer_select").val(this.value);
                getPorcentaje($("#chofer").val());

        });

        $("#movil").keypress(function(e) {
            e.preventDefault();
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                getMovil($("#movil").val());
                $("#porcentaje").val('');
            }
        });
    });
        $('#form-guardar').on('click', function() {
            $("#form-proccess").submit(function( event ) {
                event.preventDefault();
                console.log($(this).serialize());
            });
        });

    function getMovil(id) {
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

</script>
