<div class="container py-5">
    <h3><b>Firmas</b></h3>
    <div class="card">
        <div class="card-body">
        <div class="input-group mb-4 mt-3">
         <div class="form-outline">
            <input type="text" id="busca"/>
        </div>
            <div class="col-12 my-2 d-flex justify-content-end">
                <!--<button class="btn btn-sm btn-primary rounded-0" id="add_new"><i class="fa fa-plus"></i> Anadir</button> -->
            </div>
            <!-- inicio grilla -->
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="py-1 px-2">#</th>
                        <th class="py-1 px-2">Creado por</th>
                        <th class="py-1 px-2">Fecha</th>
                        <th class="py-1 px-2">Accion</th>
                    </tr>
                </thead>
                <tbody  id="tabla">
            <!-- Fin Grilla -->
                    <?php 
                    $qry = $conn2->query("SELECT proto.*, doctores.name AS doctor_name
                                          FROM proto
                                          INNER JOIN doctores ON proto.created_by = doctores.id");
                    $i = 1;
                    while($row=$qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="py-1 px-2"><?php echo $i++ ?></td>
                        <td class="py-1 px-2"><?php echo $row['doctor_name'] ?></td>
                        <td class="py-1 px-2"><?php echo $row['created_at'] ?></td>

                        <!-- Selecciono todo de la tabla miembros y vuelco contenido en grilla -->
                        <td class="py-1 px-2 text-center">
                            <div class="btn-group" role="group">
                            <!-- Boton de opciones desplegable -->
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm rounded-0 py-0" data-bs-toggle='dropdown' aria-expanded="false" >
                                Opciones
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Editar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <=0): ?>
                        <tr>
                            <th class="tex-center" colspan="6">No hay registros.</th> <!-- en caso de que el nuemro de filas sea 0 -->
                        </tr

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
  $("#busca").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tabla tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script> 


<script>
    $(function(){
        $('.edit_data').click(function(){
            uni_modal('Editar Firma',"manage_member.php?id="+$(this).attr('data-id'));
        })
        $('.view_data').click(function(){
            uni_modal('Habilitar Firma',"view_member.php?id="+$(this).attr('data-id'));
        })
    })
</script>