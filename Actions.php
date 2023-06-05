<?php 
session_start();
require_once('DBConnection.php');
require_once('DBConnection2.php');

Class Actions extends DBConnection{
    function __construct(){
        parent::__construct();
    }
    function __destruct(){
        parent::__destruct();
    }
    function save_log($data=array()){
        // Array de datos
            // user_id = id unico de usuario
            // action_made = accion hecha por el usuario
            
        if(count($data) > 0){
            extract($data);
            $sql = "INSERT INTO `logs` (`user_id`,`action_made`) VALUES ('{$user_id}','{$action_made}')";
            $save = $this->conn->query($sql);
            if(!$save){
                die($sql." <br> ERROR:".$this->conn->error);
            }
        }
        return true;
    }

    function register(){
        extract($_POST);
        $sql = "INSERT INTO `users` (`name`,`username`,`password`) VALUES ('{$nombre}','{$userregister}','".md5($passwdregister)."')";
        @$qry = $this->conn->query($sql);
        if(!$qry){
            $resp['status'] = "failed";
            $resp['msg'] = "No se ha podido registrar.";
        }else{
            $resp['status'] = "success";
            $resp['msg'] = "Registrando nuevo usuario...";
        }
        return json_encode($resp);
    }


    function login(){
        extract($_POST);
        $sql = "SELECT * FROM users where username = '{$username}' and `password` = '".md5($password)."' ";
        @$qry = $this->conn->query($sql)->fetch_array();
        if(!$qry){
            $resp['status'] = "failed";
            $resp['msg'] = "Usuario o contrasena erronea.";
        }else{
            $resp['status'] = "success";
            $resp['msg'] = "Iniciando Sesion...";
            foreach($qry as $k => $v){
                if(!is_numeric($k))
                $_SESSION[$k] = $v;
            }
            $log['user_id'] = $qry['id'];
            $log['action_made'] = "Inicio sesion.";
            // auditar log
            $this->save_log($log);
        }
        return json_encode($resp);
    }
    function logout(){
        $log['user_id'] = $_SESSION['id'];
        $log['action_made'] = "Cerro sesion.";
        session_destroy();
        // auditar log
        $this->save_log($log);
        header("location:./");
    }

}
$a = isset($_GET['a']) ?$_GET['a'] : '';
$action = new Actions();
switch($a){
    case 'register':
        echo $action->register();
    break;
    case 'login':
        echo $action->login();
    break;
    case 'logout':
        echo $action->logout();
    break;
    case 'save_member':
        echo $action->save_member();
    break;
    case 'save_log':
        $log['user_id'] = $_SESSION['id'];
        $log['action_made'] = $_POST['action_made'];
        echo $action->save_log($log);
    break;
    default:
    // accion x defecto
    echo "Ninguna accion tomada";
    break;
}