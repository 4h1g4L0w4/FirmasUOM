<?php
session_start();
$user_id = $_SESSION['id'];

require_once('./DBConnection.php');
require_once('./DBConnection2.php');

if (isset($_GET['update_id']) && isset($_GET['id_medico'])) {
    $update_id = $_GET['update_id'];
    $id_medico = $_GET['id_medico'];
    $action_made = "se cambio por la firma de [{$update_id}] por [id={$id_medico}].";

    $update_query = "UPDATE proto SET created_by = '$id_medico' WHERE id = '$update_id'";
    $conn2->query($update_query);

    $log_query = "INSERT INTO `logs` (`user_id`,`action_made`) VALUES ('{$user_id}','{$action_made}')";
    $conn->query($log_query);
    
    echo json_encode(array('status' => 'success', 'msg' => 'Registro actualizado exitosamente.'));
} else {
    
    echo json_encode(array('status' => 'error', 'msg' => 'Faltan parámetros requeridos.'));
}
?>
