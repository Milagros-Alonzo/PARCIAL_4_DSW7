<?php define('BASE_URL', '/PARCIALES/PARCIAL_4_DSW7/');
?>
<div id="loginContainer">
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="<?php echo BASE_URL; ?>/public/loginsrc.php" method="POST">
            <imput type="hidden" name="eventoLogin" value="loginManual">
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" placeholder="Ingrese su correo" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

                <input type="submit" value="Iniciar Sesión">
        </form>
        <div style="margin-top: 20px;">
            <p>¿No tienes una cuenta? <a href="./app/views/auth/register.php">Regístrate aquí</a></p>
        </div>
        <div style="margin-top: 20px;">
            <?php include __DIR__ . '/../app/oauth/sesion_GoogleOauth.php'; ?>
        </div>
    </div>
</div>