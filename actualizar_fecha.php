<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

session_start();
$user_id = $_SESSION['id'];

require_once('./DBConnection.php');
require_once('./DBConnection2.php');


if (isset($_GET['fecha']) && isset($_GET['id'])) {
    // Obtener la fecha y el ID desde la petición GET
    $fecha = $_GET['fecha'];
    $id = $_GET['id'];
    $action_made = "Habilito la firma [id={$id}].";
    $fechaActual = date('Y-m-d H:i:s');

    $update_query = "UPDATE proto SET created_at = '$fechaActual' WHERE id = '$id'";
    $conn2->query($update_query);

    $log_query = "INSERT INTO `logs` (`user_id`,`action_made`) VALUES ('{$user_id}','{$action_made}')";
    $conn->query($log_query);
    
    echo json_encode(array('status' => 'success', 'msg' => 'Registro actualizado exitosamente.'));
} else {
    
    echo json_encode(array('status' => 'error', 'msg' => 'Faltan parámetros requeridos.'));
}
?>
