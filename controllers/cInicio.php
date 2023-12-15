<?php

require_once __DIR__ . '/../model/mUsuarios.php';

class CInicio {

    public $nombrePagina;
    public $view;

    public function __construct() {
        $this->view = '';
        $this->nombrePagina ='';
    }

    public function mostrarInicioSesion(){
        $controlador = new mUsuarios();
        
        // Verifica si existe un admin con perfil 'Super' usando el modelo
        if ($controlador->existeAdminSuper()) {
            $this->nombrePagina = 'Inicio Sesion';
            $this->view = 'vInicio';
        } else {
            $this->nombrePagina = 'Registrate como Super Admin';
            $this->view = 'Instalacion';
        }
    }
}

?>