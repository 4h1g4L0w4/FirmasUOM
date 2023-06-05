<?php
session_start();
if(!isset($_SESSION['id']) || (isset($_SESSION['id']) && $_SESSION['id'] <= 0)){
    header("Location:./login.php");
    exit;
}
require_once('./DBConnection.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
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
                        <!--<a class="nav-link <?php echo ($page == 'home')? 'active' : '' ?>" aria-current="page" href="./"><i class="fa fa-home"></i> Inicio</a> -->
                    </li>
                    <li class="nav-item">
                      <!--  <a class="nav-link <?php echo ($page == 'logs')? 'active' : '' ?>" aria-current="page" href="./?page=logs"><i class="fa fa-th-list"></i> Registros</a> -->
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

<body class="bg-dark bg-gradient">
   <div class="h-100 d-flex jsutify-content-center align-items-center">
       <div class='w-100'>
        <h3 class="py-5 text-center text-light"></h3>
        <div class="card my-3 col-md-4 offset-md-4">
            <div class="card-body">
                <form action="" id="register-form">
                    <center><small></small></center>
                    <div class="form-group">
                        <center> <input type="button" class="btn btn-sm btn-primary rounded-0 my-1" onclick="window.location.href='./cambiofirma.php';" value="Cambiar Firma" /></center>
                    </div>
                    <div class="form-group">
                        <center> <input type="button" class="btn btn-sm btn-primary rounded-0 my-1" onclick="window.location.href='./habilitarmod.php';" value="Habilitar Modificacion" /></center>
                    </div>
                </form>
            </div>
        </div>
       </div>
   </div>
</body>

</body>
</html>