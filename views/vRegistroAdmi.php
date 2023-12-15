<div class="login wrap">
    <div class="h1">Login</div>
    <form action="index.php?c=cUsuarios&m=crearSuper" method="POST">
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
