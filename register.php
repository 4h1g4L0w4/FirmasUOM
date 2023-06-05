<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['id'] > 0){
    header("Location:./");
    exit;
}
require_once('./DBConnection.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario | Firmas</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
    <style>
        html, body{
            height:100%;
        }
    </style>
</head>
<body class="bg-dark bg-gradient">
   <div class="h-100 d-flex jsutify-content-center align-items-center">
       <div class='w-100'>
        <h3 class="py-5 text-center text-light">Nuevo Usuario</h3>
        <div class="card my-3 col-md-4 offset-md-4">
            <div class="card-body">
                <form action="" id="register-form">
                    <center><small>Complete los siguientes campos.</small></center>
                    <div class="form-group">
                        <label for="nombre" class="control-label">Nombre</label>
                        <input type="text" id="nombre" autofocus name="nombre" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="userregister" class="control-label">Usuario</label>
                        <input type="text" id="userregister" autofocus name="userregister" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="passwdregister" class="control-label">Contrasena</label>
                        <input type="passwdregister" id="passwdregister" autofocus name="passwdregister" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group d-flex w-100 justify-content-end">
                        <button class="btn btn-sm btn-primary rounded-0 my-1">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
       </div>
   </div>
</body>

<script>
    $(function(){
        $('#register-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            _this.find('button[type="submit"]').text('Registrando usuario...')
            $.ajax({
                url:'./Actions.php?a=register',
                method:'POST',
                data:$(this).serialize(),
                dataType:'JSON',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("Ha ocurrido un error.")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        setTimeout(() => {
                            location.replace('./');
                        }, 2000);
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>

</html>