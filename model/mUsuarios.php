<?php
class mUsuarios{
    private $conexion;
    
    function __construct(){
        require_once __DIR__ . '/../config/configdb.php';
        $this->conexion = new mysqli(SERVIDOR, USUARIO, CONTRASENIA, BBDD);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
        
        $mysqliDriver = new mysqli_driver();
        $mysqliDriver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

        // Establecer la codificación a UTF-8
        if (!$this->conexion->set_charset("utf8")) {
            printf("Error al establecer la conexión a UTF-8: %s\n", $this->conexion->error);
            exit();
        }
    }

    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
    }

    public function verificarCredenciales($correo, $contrasenia) {
        $stmt = $this->conexion->prepare("SELECT id_admin, Correo, contrasenia, perfil FROM admins WHERE Correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $contrasenia_hash = $usuario['contrasenia'];
    
            // Verificar la contraseña
            if (password_verify($contrasenia, $contrasenia_hash)) {
                unset($usuario['contrasenia']); // No devolver la contraseña hash en el resultado
                return $usuario;
            }
        }
    
        return null;
    }

    public function crearAdmin($nombre, $correo, $contrasenia, $perfil) {
        $contrasenia_hash = password_hash($contrasenia, PASSWORD_DEFAULT, ['cost' => 12]);

        $stmt = $this->conexion->prepare("INSERT INTO admins (correo, contrasenia, nombre, perfil) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $correo, $contrasenia_hash, $nombre, $perfil);
        $stmt->execute();
    }
    
    public function existeAdminSuper() {
        $stmt = $this->conexion->prepare("SELECT COUNT(*) as count FROM admins WHERE perfil = ?");
        $perfil = 'Super';
        $stmt->bind_param("s", $perfil);
        $stmt->execute();
        $result = $stmt->get_result();
        $fila = $result->fetch_assoc();
        $count = $fila['count'];

        return $count > 0; 
    }
}
?>
