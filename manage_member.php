<?php
require_once('./DBConnection.php');
require_once('./DBConnection2.php');

if (isset($_GET['id'])) {
    $qry = $conn2->query("SELECT * FROM proto where id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }
}

$sql = "SELECT `id`, `name` FROM doctores";
$result = $conn2->query($sql);
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Agrega la lógica para actualizar el campo "created_by" al hacer clic en el campo "name"
if (isset($_GET['update_id']) && isset($_GET['id_medico'])) {
    $update_id = $_GET['update_id'];
    $id_medico = $_GET['id_medico'];

    // Realiza la actualización en la otra base de datos
    $update_query = "UPDATE otra_tabla SET created_by = '$id_medico' WHERE id = '$update_id'";
    $conn2->query($update_query);
    // Puedes agregar lógica adicional aquí, como mostrar un mensaje de éxito
    echo json_encode(array('status' => 'success', 'msg' => 'Registro actualizado exitosamente.'));
    exit(); // Detiene la ejecución del resto del código
}
?>

<div class="container-fluid">
    <div id="search-results">
        <form action="" id="member-form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="form-group">
                <div>
                    <label for="search">Busque su nombre:</label>
                    <input type="text" name="search" id="search" value="<?php echo $search; ?>">
                </div>
                <?php
                $qry = $conn2->query("SELECT `id`, `name` FROM doctores WHERE `name` LIKE '%$search%'");
                if ($qry->num_rows > 0) {
                    while ($row = $qry->fetch_assoc()) {
                        $Idmedico = $row["id"];
                        $name = $row["name"];
                        // Agrega una clase o atributo de datos para identificar el enlace de actualización
                        echo "<div><a class='update-link' data-id='$id' data-id-medico='$Idmedico' href='#'>$name</a></div>";
                    }
                } else {
                    echo "No se encontraron registros.";
                }
                ?>
            </div>
        </form>
    </div>
</div>
 <!--------------->
<script>
$(function(){
    $('#search').on('keyup', function(){
        var search = $(this).val();
        
        $.ajax({
            url: './manage_member.php', 
            data: { search: search },
            method: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#search-results').html(response);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
});
</script>
<!---------------->
<script>
$(function(){
    $('.update-link').on('click', function(e){
        e.preventDefault();
        var updateId = $(this).data('id');
        var idMedico = $(this).data('id-medico');
        
        $.ajax({
            url: 'post_id.php',
            data: {
                update_id: updateId,
                id_medico: idMedico
            },
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    
                    alert(response.msg);
                } else {
                    
                    alert(response.msg);
                }
            },
            error: function(xhr, status, error) {
                
                console.log(xhr.responseText);
                alert('An error occurred while processing the request.');
            }
        });
    });
});
</script>