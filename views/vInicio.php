<div class="login wrap">
    <div class="h1">Login</div>
    <?php
        if (!empty($controlador->mensajeError)) {
            echo '<div class="error-message">' . $controlador->mensajeError . '</div>';
        }
    ?>
    <form action="index.php?c=cUsuarios&m=comprobarUsuarios" method="POST">
        <input placeholder="Email" id="correo" name="correo" type="text">
        <input placeholder="Password" id="pw" name="pw" type="password">
        <input value="enviar" class="btn" name="enviar" type="submit">
    </form>
</div>
