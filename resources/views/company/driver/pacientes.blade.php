<div class="container">
    <div class="table-responsive-xl">
        <div class="alert alert-secondary" role="alert">
            <p>
                Listado de pacientes registrados en la mutual de seguridad. Recuerde colocar un (-) antes de escribir el ultimo digito del R.U.N.
                Click aqui <button type="button" class="btn btn-md btn-primary btn-sm" id="add-paciente">+</button> para agregar un nuevo paciente.

            </p>
        </div>
        <table class="table table-hover table-striped" id="dataTablePaciente" style="background-color: #eee; color:#000; width:100%">
        <thead>
            <tr class="thead-color">
                <th> # </th>
                <th> R.U.N. </th>
                <th> Paciente </th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;?>
            @foreach($pacientes as $paciente)
                <tr class="trs">
                    <td> <?=$i++;?> </td>
                    <td class="run"> {{ $paciente->run }} </td>
                    <td class="pac"> {{ $paciente->paciente }} </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>


<!-- Modal Add Pacientes-->
<div class="modal hide fade in" id="modal_paciente_add" style="z-index: 1400;" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0090e738;">
            <h4 class="modal-title text-left">ConvenioSoft</h4>
            <button type="button" class="close close-paciente">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #586973;">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="run_paciente" id="run_paciente" placeholder="R.U.N" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="nombres_paciente" id="nombres_paciente" placeholder="Paciente" required>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary float-right" type="button" id="paciente_button">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal Add Pacientes-->
</div>
<script>
    jQuery(document).ready(function($){

        var table = $('#dataTablePaciente');
        table.DataTable({
            info:           false,
            scrollY:        '80vh',
            scrollCollapse: true,
            paging:         false,
            ordering:       false,
            select: true,
            "dom": '<"wrapper"flipt>',
            "language": {
                "search": "Buscar:",
                "zeroRecords": "No hay coincidencias"
            }

        });

        $('#dataTablePaciente tbody').on( 'click', 'tr', function () {
            var run = $(this).closest("tr").find(".run").text();
            var pac = $(this).closest("tr").find(".pac").text();
            $("#modal_paciente").modal('hide');
            $("#paciente_select").val(run+' '+pac);
            $("#paciente").val(pac);
            $("#run").val(run);
        });

        $('#add-paciente').on('click', function() {
            $('#paciente_button').prop("disabled", false).text('Agregar');
            $("#run_paciente").val('');
            $("#nombres_paciente").val('');
            $("#modal_paciente_add").modal('show');
            $("#modal_paciente_add").modal({ backdrop: 'static'});
         });

         $('.close-paciente').on('click', function() {
            $("#modal_paciente_add").modal('hide');
            $("#run_paciente").val('');
            $("#nombres_paciente").val('');
         });

         $('#paciente_button').on('click', function() {
            $(this).prop("disabled", true).text('Enviando...');
            var run_pac = $("#run_paciente").val();
            var nom_pac = $("#nombres_paciente").val();
            if(run_pac=="" || nom_pac==""){
                toastr.error('Up! Error, El R.U.N. y Paciente es requerido', {timeOut: 3000});
                $(this).prop("disabled", false).text('Agregar');;
            }else{
                axios.post('{{ route('company.paciente.store')}}', {
                run_pac:run_pac,
                nom_pac:nom_pac
                }).then(response => {
                    if(response.data.success){
                        toastr.success(''+response.data.msg+'', {timeOut: 3000});
                        $("#modal_paciente_add").modal('hide');
                        $("#modal_paciente").modal('hide');
                        $("#paciente_select").val(run_pac+' '+nom_pac);
                        $("#paciente").val(nom_pac);
                        $("#run").val(run_pac);

                    }else if(response.data.paciente){
                        toastr.error(''+response.data.msg+'', {timeOut: 3000});
                    }else if(response.data.error){
                        toastr.error('Up! Error, no se ingresaron los datos correctamente. Intente nuevamente', {timeOut: 3000});
                    }else{
                        toastr.error('Up! Error, no se ingresaron los datos correctamente. Intente nuevamente', {timeOut: 3000});
                    }
                    $(this).prop("disabled", false).text('Agregar');;
                }).catch(e => {
                    toastr.error('Up! Error '+e+'', {timeOut: 5000});
                    $(this).prop("disabled", false).text('Agregar');;
                    console.log(e);
                });
            }
         });




        /* var table = $('#dataTablePaciente').DataTable({
                "info":           false,
                "ordering":       false,
                "searching":      false,
            initComplete: function () {
                this.api().columns().every( function () {
                    var that = this;
                    $('#column2_search').on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                        table
                            .columns( 1 )
                            .search( this.value )
                            .draw();
                        }
                    } );
                    $('#column3_search').on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                        table
                            .columns( 2 )
                            .search( this.value )
                            .draw();
                        }
                    } );
                });
            }
        }); */
    });
</script>
