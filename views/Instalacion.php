<div>
    ESTAS EN LA ZONA del super DE ADMINISTRADOR
    <a href="index.php?c=cUsuarios&m=cerrarSesion">CERRAR SESION</a>
    <div class="login wrap">
        <div class="h1">REGISTRO DE ADMIN DE JUEGOS</div>
        <form action="index.php?c=cUsuarios&m=crearBas" method="POST">
            <input placeholder="Nombre" id="nombre" name="nombre" type="text">
            <input placeholder="Email" id="correo" name="correo" type="text">
            <input placeholder="Password" id="pw" name="pw" type="password">
            <input value="enviar" class="btn" name="enviar" type="submit">
        </form>
        <?php
            if (!empty($mensajeError)) {
                echo '<div class="error-message">¡' . $mensajeError . '!</div>';
            }
        ?>
    </div>
</div>