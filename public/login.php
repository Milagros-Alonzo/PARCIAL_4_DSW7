<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="loginsrc.php" method="POST">
        <imput type="hidden" name="eventoLogin" value="loginManual">
            <label for="email">Usuario:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Iniciar Sesión">
    </form>
    <div style="margin-top: 20px;">
        <p>¿No tienes una cuenta? <a href="../app/views/auth/register.php">Regístrate aquí</a></p>
    </div>
    <div style="margin-top: 20px;">
        <?php include __DIR__ . '/../app/oauth/sesion_GoogleOauth.php'; ?>
    </div>
</div>
