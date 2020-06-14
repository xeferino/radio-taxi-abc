@extends('template._app')
    @section('title','ConvenioSoft - Empresas')
    @section('content')
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Sistema Convenios Radio Taxi ABC</h2>
                        <form class="forms-sample mt-5">
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
                                                <option>Category1</option>
                                                <option selected>Category2</option>
                                                <option>Category3</option>
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
                                                  <input type="text" class="form-control" name="porcentaje" id="porcentaje">
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
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
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
                                                  <input type="text" class="form-control" name="vale" id="vale">
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
                                                  <input type="text" list="recorridos" class="form-control" name="recorrido" id="recorrido">
                                                  <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-car"></i></span>
                                                  </div>
                                                  <datalist id="recorridos">
                                                    <option value="Azul"></option>
                                                    <option value="Amarillo"></option>
                                                    <option value="Burdeos"></option>
                                                    <option value="Caoba"></option>
                                                    <option value="Marrón"></option>
                                                    <option value="Naranja"></option>
                                                    <option value="Verde"></option>
                                                  </datalist>
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
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            jQuery(document).ready(function($){
                $("#zulu").select2();
                $('#fecha').on('change', function() {
                    $("#movil").focus();
                });

                $("#movil").keypress(function(e) {
                    var code = (e.keyCode ? e.keyCode : e.which);
                    if(code==13){
                        alert($("#movil").val());
                    }
                });


            });
        </script>
    @endsection
