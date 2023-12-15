<?php

require_once __DIR__ . '/../model/mUsuarios.php';

class cUsuarios {
    public $nombrePagina;
    public $view;
    public $objModelo;
    public $mensajeError;

    function __construct() {
        $this->objModelo = new mUsuarios();
    }

    public function formularioInicial() {
        $this->view = 'vInicio';
        $this->nombrePagina ='';
    }
    

    public function vJuegos(){
        $this->view = 'vJuegos';
        $this->nombrePagina ='';
    }


    public function comprobarUsuarios() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
            $correo = $_POST['correo'];
            $pw = $_POST['pw'];
    
            $usuario = $this->objModelo->verificarCredenciales($correo, $pw);
    
            if ($usuario) {
                session_start();
                $_SESSION['id_admin'] = $usuario['id_admin'];
                $_SESSION['perfil'] = $usuario['perfil'];
    
                switch ($_SESSION['perfil']) {
                    case 'super':
                        header("Location: index.php?c=cUsuarios&m=vistaSuperAdmin");
                        exit();
                        break;
                    case 'admin':
                        header("Location: index.php?c=cUsuarios&m=vistaAdminJuegos");
                        exit();
                        break;
                    case 'user':
                        header("Location: index.php?c=cUsuarios&m=vJuegos");
                        exit();
                        break;
                }
            } else {
                $this->mensajeError = "Credenciales incorrectas. Por favor, inténtelo de nuevo.";
                $this->formularioInicial();
                exit(); // Agregamos una salida aquí para detener la ejecución después del mensaje de error
            }
        } else {
            $this->formularioInicial();
        }
    }
    

    public function vistaSuperAdmin(){
        session_start();
        if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'super') {
            $this->view = 'Instalacion';
            $this->nombrePagina ='';
        } else {
            header("Location: index.php");
            exit();
        }
    }

    public function vistaAdminJuegos(){
        session_start();
        if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin') {
            $this->view = 'vAdminJuegos';
            $this->nombrePagina ='';
        } else {
            header("Location: index.php");
            exit();
        }
    }
    
    public function crearSuper(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $pw = $_POST['pw'];
            $perfil = 'super';

            $this->objModelo->crearAdmin($nombre, $correo, $pw, $perfil);
            header("Location: index.php");
            exit();
        }
    }

    public function crearBas(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $pw = $_POST['pw'];
            $perfil = 'admin';

            $this->objModelo->crearAdmin($nombre, $correo, $pw, $perfil);
            header("Location: index.php?c=cUsuarios&m=Instalacion");
            exit();
        }
    }
    public function cerrarSesion() {

        session_start();
        session_destroy();

        header("Location: index.php");
        exit();
    }
}
?>