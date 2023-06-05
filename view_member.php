<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

require_once('./DBConnection.php');
require_once('./DBConnection2.php');

$mensaje = "No se encontraron resultados.";
$mostrarBoton = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $qry = $conn2->query("SELECT * FROM proto WHERE id = '{$id}'");

    if ($qry && $qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $fechaCampoTabla = $row['created_at'];

        // Obtener la fecha actual
        $fechaActual = new DateTime();

        $fechaCampoTablaObj = DateTime::createFromFormat('Y-m-d H:i:s', $fechaCampoTabla);

        if ($fechaCampoTablaObj) {
            $fechaCampoTablaObj->modify('+4 hours');

            // Comparar las fechas
            if ($fechaActual > $fechaCampoTablaObj) {
                $mensaje = "Habilite la firma pulsando 'Habilitar Firma'.";
                $mostrarBoton = true;
            } else {
                $mensaje = "La firma está habilitada.";
                $mostrarBoton = false;
            }
        } else {
            $mensaje = "Error al procesar la fecha del campo en la tabla.";
        }
    }
}
?>

<style>
    #uni_modal .modal-footer {
        display: none !important;
    }

    .text-center {
        text-align: center;
    }

    .button-container {
        display: flex;
        justify-content: space-between;
    }
</style>

<div class="container-fluid">
    <dl>
        <dt>Mensaje:</dt>
        <dd class="text-center"><?php echo $mensaje; ?></dd>
    </dl>

    <div class="col-12">
        <div class="w-100 button-container">
            <div>
                <?php if ($mostrarBoton): ?>
                    <button id="actualizarFechaBtn" class="btn btn-sm btn-primary rounded-0" type="button">Habilitar Firma</button>
                <?php endif; ?>
            </div>
            <div>
                <button class="btn btn-sm btn-dark rounded-0" type="button" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("actualizarFechaBtn").addEventListener("click", function() {
        // Obtener la fecha actual
        var fechaActual = new Date().toISOString().slice(0, 19).replace("T", " ");

        // Realizar una petición AJAX para actualizar la fecha en la base de datos
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Actualización exitosa, recargar la página para mostrar la nueva fecha
                //location.reload();
            }
        };
        xhttp.open("GET", "actualizar_fecha.php?fecha=" + fechaActual + "&id=<?php echo $_GET['id']; ?>", true);
        xhttp.send();

        // Mostrar mensaje de confirmación
        var mensaje = "Firma habilitada";
        alert(mensaje);
    });
</script>
