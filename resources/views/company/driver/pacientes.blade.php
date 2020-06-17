<div class="container">
    <div class="table-responsive-xl">
        <div class="alert alert-secondary" role="alert">
            <p>Listado de pacientes registrados en la mutual de seguridad. Recuerde colocar un (-) antes de escribir el ultimo digito del R.U.N.</p>
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
