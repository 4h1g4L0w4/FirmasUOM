<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['name'] !== "Administrador") {
    header("Location:./index.php");
    exit;
}
require_once('./DBConnection.php');
require_once('./DBConnection2.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'log';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firmas</title>
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./DataTables/datatables.min.css">
    <script src="./DataTables/datatables.min.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
    <script src="./js/script.js"></script>
    <style>
    </style>
</head>
<body class="bg-light">
<!-- Inicio barra navegacion -->
    <main>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #353535;" id="topNavBar">
        <div class="container">
            <a class="navbar-brand" href="./">
                
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'home')? 'active' : '' ?>" aria-current="page" href="./"><i class="fa fa-home"></i> Inicio</a>
                    </li>
                </ul>
            </div>
            <div>
            <?php if(isset($_SESSION['id'])): ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle bg-transparent  text-dark border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                         <?php echo $_SESSION['name'] ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="././Actions.php?a=logout">Cerrar Sesion</a></li>
                    </ul>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </nav>
<!-- Fin barra navegacion -->
    <div class="container py-3" id="page-container">
        <?php 
            if(isset($_SESSION['flashdata'])):
        ?>
        <div class="dynamic_alert alert alert-<?php echo $_SESSION['flashdata']['type'] ?>">
        <div class="float-end"><a href="javascript:void(0)" class="text-dark text-decoration-none" onclick="$(this).closest('.dynamic_alert').hide('slow').remove()">x</a></div>
            <?php echo $_SESSION['flashdata']['msg'] ?>
        </div>
        <?php unset($_SESSION['flashdata']) ?>
        <?php endif; ?>
        <?php
            include $page.'.php';
        ?>
    </div>
</body>
</html>