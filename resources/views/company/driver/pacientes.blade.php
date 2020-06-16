<div class="table-responsive">
    <table class="table table-dark">
      <thead>
        <tr>
          <th> # </th>
          <th> Nombres y Apellidos </th>
          <th> R.U.C. </th>
        </tr>
      </thead>
      <tbody>
          <?php $i=1;?>
          @foreach($pacientes as $paciente)
            <tr>
                <td> <?=$i++;?> </td>
                <td> {{ $paciente->paciente }} </td>
                <td> {{ $paciente->run }} </td>
            </tr>
          @endforeach

      </tbody>
    </table>
</div>
